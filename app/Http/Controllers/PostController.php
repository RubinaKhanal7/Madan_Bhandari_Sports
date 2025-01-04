<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    protected $imageService;
    protected const MAX_IMAGE_SIZE = 2048;
    protected const MAX_PDF_SIZE = 1023;

    public function __construct(ImageCompressionService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        $categories = Category::all();
        return view('backend.post.index', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $messages = [
            'image.max' => 'The image size must not be greater than 2MB.',
            'pdf.*.max' => 'Each PDF file size must not be greater than 10MB.',
            'pdf.*.mimes' => 'Only PDF files are allowed.',
        ];

        $validator = Validator::make($request->all(), [
            'title_ne' => 'required|string|max:5000',
            'title_en' => 'required|string|max:5000',
            'description_ne' => 'nullable|string|max:10000',
            'description_en' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:'.self::MAX_IMAGE_SIZE,
            'cropped_image' => 'nullable|string',
            'pdf' => 'nullable|array',
            'pdf.*' => 'file|mimes:pdf|max:'.self::MAX_PDF_SIZE,
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput()
                           ->with('error', 'Please check the file size limits: Images (2MB) and PDFs (10MB)');
        }

        $validated = $validator->validated();
        $imagePath = null;
        if ($request->has('cropped_image') && $request->cropped_image) {
            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);

            if (strlen($imageData) > self::MAX_IMAGE_SIZE * 1024) {
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'The cropped image size must not be greater than 2MB.');
            }
            
            $imagePath = 'uploads/posts/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);
        }
        elseif ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->getSize() > self::MAX_IMAGE_SIZE * 1024) {
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'The image size must not be greater than 2MB.');
            }
            
            $imagePath = $this->imageService->compressAndStore(
                $image,
                'posts',
                60,
                1024
            );
        }

        $pdfPaths = [];
        if ($request->hasFile('pdf')) {
            $pdfDirectory = public_path('uploads/pdf');
            if (!File::exists($pdfDirectory)) {
                File::makeDirectory($pdfDirectory, 0755, true);
            }

            foreach ($request->file('pdf') as $pdfFile) {
                if ($pdfFile->getSize() > self::MAX_PDF_SIZE * 1024) {
                    return redirect()->back()
                                   ->withInput()
                                   ->with('error', 'Each PDF file size must not be greater than 10MB. File "' . $pdfFile->getClientOriginalName() . '" is too large.');
                }

                $filename = uniqid() . '_' . $pdfFile->getClientOriginalName();
                $pdfFile->move($pdfDirectory, $filename);
                $pdfPaths[] = 'uploads/pdf/' . $filename;
            }
        }

        Post::create([
            'title_ne' => $validated['title_ne'],
            'title_en' => $validated['title_en'],
            'description_ne' => $validated['description_ne'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'image' => $imagePath,
            'pdf' => $pdfPaths,
            'category_id' => $validated['category_id'],
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        $messages = [
            'image.max' => 'The image size must not be greater than 2MB.',
            'pdf.*.max' => 'Each PDF file size must not be greater than 10MB.',
            'pdf.*.mimes' => 'Only PDF files are allowed.',
        ];

        $validator = Validator::make($request->all(), [
            'title_ne' => 'required|string|max:5000',
            'title_en' => 'required|string|max:5000',
            'description_ne' => 'nullable|string|max:10000',
            'description_en' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:'.self::MAX_IMAGE_SIZE,
            'cropped_image' => 'nullable|string',
            'pdf' => 'nullable|array',
            'pdf.*' => 'file|mimes:pdf|max:'.self::MAX_PDF_SIZE,
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput()
                           ->with('error', 'Please check the file size limits: Images (2MB) and PDFs (10MB)');
        }

        $validated = $validator->validated();

        $imagePath = $post->image;
        if ($request->has('cropped_image') && $request->cropped_image) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);

            if (strlen($imageData) > self::MAX_IMAGE_SIZE * 1024) {
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'The cropped image size must not be greater than 2MB.');
            }

            $imagePath = 'uploads/posts/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);
        }
        elseif ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->getSize() > self::MAX_IMAGE_SIZE * 1024) {
                return redirect()->back()
                               ->withInput()
                               ->with('error', 'The image size must not be greater than 2MB.');
            }
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $imagePath = $this->imageService->compressAndStore(
                $image,
                'posts',
                60,
                1024
            );
        }

        $pdfPaths = $post->pdf ?? [];
        if ($request->hasFile('pdf')) {
            $pdfDirectory = public_path('uploads/pdf');
            if (!File::exists($pdfDirectory)) {
                File::makeDirectory($pdfDirectory, 0755, true);
            }

            foreach ($request->file('pdf') as $pdfFile) {
                if ($pdfFile->getSize() > self::MAX_PDF_SIZE * 1024) {
                    return redirect()->back()
                                   ->withInput()
                                   ->with('error', 'Each PDF file size must not be greater than 10MB. File "' . $pdfFile->getClientOriginalName() . '" is too large.');
                }

                $filename = uniqid() . '_' . $pdfFile->getClientOriginalName();
                $pdfFile->move($pdfDirectory, $filename);
                $pdfPaths[] = 'uploads/pdf/' . $filename;
            }
        }

        $post->update([
            'title_ne' => $validated['title_ne'],
            'title_en' => $validated['title_en'],
            'description_ne' => $validated['description_ne'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
            'image' => $imagePath,
            'pdf' => $pdfPaths,
            'category_id' => $validated['category_id'],
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }


    public function destroy(Post $post)
    {
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }
        if ($post->pdf) {
            foreach ($post->pdf as $pdfPath) {
                if (file_exists(public_path($pdfPath))) {
                    unlink(public_path($pdfPath));
                }
            }
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}