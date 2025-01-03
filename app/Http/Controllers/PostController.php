<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    protected $imageService;

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
        $validated = $request->validate([
            'title_ne' => 'required|string|max:5000',
            'title_en' => 'required|string|max:5000',
            'description_ne' => 'nullable|string|max:10000',
            'description_en' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'cropped_image' => 'nullable|string',
            'pdf' => 'nullable|array',
            'pdf.*' => 'file|mimes:pdf|max:10240',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = null;
        $directory = public_path('uploads/posts');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if ($request->has('cropped_image') && $request->cropped_image) {
            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);
            $imagePath = 'uploads/posts/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);
        }
        elseif ($request->hasFile('image')) {
            $imagePath = $this->imageService->compressAndStore(
                $request->file('image'),
                'posts',
                60,
                1024
            );
        }

        $validated['image'] = $imagePath;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title_ne' => 'required|string|max:5000',
            'title_en' => 'required|string|max:5000',
            'description_ne' => 'nullable|string|max:10000',
            'description_en' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'cropped_image' => 'nullable|string',
            'pdf' => 'nullable|array',
            'pdf.*' => 'file|mimes:pdf|max:10240',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $post->image;
        if ($request->has('cropped_image') && $request->cropped_image) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);
            $imagePath = 'uploads/posts/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);
        }
        elseif ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $imagePath = $this->imageService->compressAndStore(
                $request->file('image'),
                'posts',
                60,
                1024
            );
        }

        $validated['image'] = $imagePath;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}