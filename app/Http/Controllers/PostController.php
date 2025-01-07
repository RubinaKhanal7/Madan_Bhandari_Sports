<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\MetaData;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $imageService;
    private const MAX_IMAGE_SIZE = 2048; // 2MB
    private const MAX_PDF_SIZE = 10240;  // 10MB
    private const IMAGE_UPLOAD_PATH = 'posts';
    private const PDF_UPLOAD_PATH = 'uploads/posts/pdf'; 

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
            // Delete image if exists
            if ($post->image) {
                $this->imageService->deleteImage($post->image);
            }
            
            // Delete PDFs if they exist
            if ($post->pdf) {
                foreach ($post->pdf as $pdfPath) {
                    $fullPath = public_path($pdfPath);
                    if (File::exists($fullPath)) {
                        File::delete($fullPath);
                    }
                }
            }

            $post->delete();
            return redirect()->route('admin.posts.index')
                ->with('success', 'Post deleted successfully!');

        } catch (Exception $e) {
            Log::error('Error deleting post: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to delete post: ' . $e->getMessage()]);
        }
    }

    protected function validatePostRequest(Request $request)
    {
        $rules = [
            'title_ne' => 'required|string|max:5000',
            'title_en' => 'required|string|max:5000',
            'description_ne' => 'nullable|string|max:10000',
            'description_en' => 'nullable|string|max:10000',
            'category_id' => 'required|exists:categories,id',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:' . self::MAX_IMAGE_SIZE;
        }

        if ($request->has('cropped_image') && !empty($request->cropped_image)) {
            $rules['cropped_image'] = 'string';
        }

        if ($request->hasFile('pdf')) {
            $rules['pdf'] = 'array';
            $rules['pdf.*'] = 'file|mimes:pdf|max:' . self::MAX_PDF_SIZE;
        }

        return Validator::make($request->all(), $rules, [
            'image.max' => 'The image size must not be greater than 2MB.',
            'pdf.*.max' => 'Each PDF file size must not be greater than 10MB.',
            'pdf.*.mimes' => 'Only PDF files are allowed.',
        ]);
    }


    protected function processPostData(Request $request, ?Post $post = null): array
    {
        $imagePath = $post?->image;
        $pdfPaths = $post?->pdf ?? [];
        if ($request->hasFile('image') || ($request->has('cropped_image') && !empty($request->cropped_image))) {
            if ($post && $post->image) {
                $this->imageService->deleteImage($post->image);
            }

            $imagePath = $this->imageService->compressAndStore(
                $request->has('cropped_image') && !empty($request->cropped_image) 
                    ? $request->cropped_image 
                    : $request->file('image'),
                [
                    'quality' => 60,
                    'maxWidth' => 1024,
                    'subfolder' => self::IMAGE_UPLOAD_PATH
                ]
            );
        }
        if ($request->hasFile('pdf')) {
            if ($post) {
                $newPdfPaths = $this->processPDFFiles($request->file('pdf'));
                $pdfPaths = array_merge($pdfPaths, $newPdfPaths);
            } else {
                $pdfPaths = $this->processPDFFiles($request->file('pdf'));
            }
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
            if ($file->isValid()) {
                $filename = uniqid() . '_' . Str::slug($file->getClientOriginalName());
                $file->move($pdfDirectory, $filename);
                $pdfPaths[] = self::PDF_UPLOAD_PATH . '/' . $filename;
            }
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
    public function storeMetadata(Request $request, Post $post)
    {
        $request->validate([
            'metaTitle' => 'required|string|max:255',
            'metaDescription' => 'nullable|string',
            'metaKeywords' => 'nullable|string',
        ]);
    
        try {
            $metadata = MetaData::create([
                'metaTitle' => $request->metaTitle,
                'metaDescription' => $request->metaDescription,
                'metaKeywords' => $request->metaKeywords,
                'slug' => Str::slug($request->metaTitle)
            ]);
    
            $post->update(['meta_data_id' => $metadata->id]);
    
            return redirect()->back()->with('success', 'Metadata added successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }
    
    public function updateMetadata(Request $request, Post $post)
    {
        $request->validate([
            'metaTitle' => 'required|string|max:255',
            'metaDescription' => 'nullable|string',
            'metaKeywords' => 'nullable|string',
        ]);
    
        try {
            if ($post->metadata) {
                $post->metadata->update([
                    'metaTitle' => $request->metaTitle,
                    'metaDescription' => $request->metaDescription,
                    'metaKeywords' => $request->metaKeywords,
                    'slug' => Str::slug($request->metaTitle)
                ]);
            } else {
                $this->storeMetadata($request, $post);
            }
    
            return redirect()->back()->with('success', 'Metadata updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }
    public function toggleFeatured(Post $post)
    {
        $post->update(['is_featured' => !$post->is_featured]);
        
        return back()->with('success', 'Post featured status updated successfully');
    }
    
    public function toggleStatus(Post $post)
    {
        $post->update(['is_active' => !$post->is_active]);
        
        return back()->with('success', 'Post status updated successfully');
    }
}