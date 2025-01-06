<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;

class PostController extends Controller
{
    protected $imageService;
    private const MAX_IMAGE_SIZE = 2048; // 2MB
    private const MAX_PDF_SIZE = 10240;  // 10MB
    private const IMAGE_UPLOAD_PATH = 'posts';
    private const PDF_UPLOAD_PATH = 'posts/pdf';

    public function __construct(ImageCompressionService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        $categories = Category::all();
        return view('backend.post.index', compact('posts', 'categories'));
    }

    public function store(Request $request)
    {
        $validator = $this->validatePostRequest($request);

        if ($validator->fails()) {
            return $this->handleValidationFailure($validator);
        }

        try {
            $data = $this->processPostData($request);
            Post::create($data);

            return redirect()->route('admin.posts.index')
                ->with('success', 'Post created successfully!');

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(Request $request, Post $post)
    {
        $validator = $this->validatePostRequest($request);

        if ($validator->fails()) {
            return $this->handleValidationFailure($validator);
        }

        try {
            $data = $this->processPostData($request, $post);
            $post->update($data);

            return redirect()->route('admin.posts.index')
                ->with('success', 'Post updated successfully!');

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function destroy(Post $post)
    {
        try {
            if ($post->image) {
                $this->imageService->deleteImage($post->image);
            }
            
            if ($post->pdf) {
                foreach ($post->pdf as $pdfPath) {
                    if (file_exists(public_path($pdfPath))) {
                        unlink(public_path($pdfPath));
                    }
                }
            }

            $post->delete();
            return redirect()->route('admin.posts.index')
                ->with('success', 'Post deleted successfully!');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    protected function validatePostRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'title_ne' => 'required|string|max:5000',
            'title_en' => 'required|string|max:5000',
            'description_ne' => 'nullable|string|max:10000',
            'description_en' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:' . self::MAX_IMAGE_SIZE,
            'cropped_image' => 'nullable|string',
            'pdf' => 'nullable|array',
            'pdf.*' => 'file|mimes:pdf|max:' . self::MAX_PDF_SIZE,
            'category_id' => 'required|exists:categories,id',
        ], [
            'image.max' => 'The image size must not be greater than 2MB.',
            'pdf.*.max' => 'Each PDF file size must not be greater than 10MB.',
            'pdf.*.mimes' => 'Only PDF files are allowed.',
        ]);
    }

    protected function processPostData(Request $request, ?Post $post = null): array
    {
        $imagePath = $post?->image;
        $pdfPaths = $post?->pdf ?? [];

        // Process image
        if ($request->has('cropped_image') || $request->hasFile('image')) {
            if ($post && $post->image) {
                $this->imageService->deleteImage($post->image);
            }

            $imagePath = $this->imageService->compressAndStore(
                $request->has('cropped_image') ? $request->cropped_image : $request->file('image'),
                [
                    'quality' => 60,
                    'maxWidth' => 1024,
                    'subfolder' => self::IMAGE_UPLOAD_PATH
                ]
            );
        }

        // Process PDFs
        if ($request->hasFile('pdf')) {
            $pdfPaths = $this->processPDFFiles($request->file('pdf'));
        }

        return [
            'title_ne' => $request->title_ne,
            'title_en' => $request->title_en,
            'description_ne' => $request->description_ne,
            'description_en' => $request->description_en,
            'image' => $imagePath,
            'pdf' => $pdfPaths,
            'category_id' => $request->category_id,
            'is_featured' => (bool) $request->is_featured,
            'is_active' => (bool) $request->is_active,
        ];
    }

    protected function processPDFFiles(array $files): array
    {
        $pdfPaths = [];
        $pdfDirectory = public_path(self::PDF_UPLOAD_PATH);

        if (!File::exists($pdfDirectory)) {
            File::makeDirectory($pdfDirectory, 0755, true);
        }

        foreach ($files as $file) {
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move($pdfDirectory, $filename);
            $pdfPaths[] = self::PDF_UPLOAD_PATH . '/' . $filename;
        }

        return $pdfPaths;
    }

    protected function handleValidationFailure($validator)
    {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please check the file size limits: Images (2MB) and PDFs (10MB)');
    }

    protected function handleException(Exception $e)
    {
        Log::error('Post operation failed: ' . $e->getMessage());
        return redirect()->back()
            ->withErrors(['error' => 'Operation failed: ' . $e->getMessage()])
            ->withInput();
    }
}