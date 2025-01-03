<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    protected $imageService;

    public function __construct(ImageCompressionService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ne' => 'required',
            'title_en' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'cropped_image' => 'nullable|string',
        ]);

        $imagePath = null;
        $directory = public_path('uploads/categories');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if ($request->has('cropped_image') && $request->cropped_image) {
            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);
            $imagePath = 'uploads/categories/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);
        }
        elseif ($request->hasFile('image')) {
            $imagePath = $this->imageService->compressAndStore(
                $request->file('image'),
                'categories',
                60,
                1024
            );
        }

        Category::create([
            'title_ne' => $request->title_ne,
            'title_en' => $request->title_en,
            'description_ne' => $request->description_ne,
            'description_en' => $request->description_en,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'title_ne' => 'required',
            'title_en' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'cropped_image' => 'nullable|string',
        ]);

        $imagePath = $category->image;
        if ($request->has('cropped_image') && $request->cropped_image) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);
            $imagePath = 'uploads/categories/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);
        }
        elseif ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $imagePath = $this->imageService->compressAndStore(
                $request->file('image'),
                'categories',
                60,
                1024
            );
        }

        $category->update([
            'title_ne' => $request->title_ne,
            'title_en' => $request->title_en,
            'description_ne' => $request->description_ne,
            'description_en' => $request->description_en,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $this->imageService->deleteImage($category->image);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}