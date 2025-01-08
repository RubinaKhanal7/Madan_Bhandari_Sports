<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MetaData;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    protected $imageService;

    public function __construct(ImageCompressionService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('backend.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ne' => 'nullable|string|max:1000',
            'description_en' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'cropped_image' => 'nullable|string',
        ]);
    
        try {
            $imagePath = null;
            
            // Only process image if it's provided
            if ($request->has('cropped_image') && !empty($request->cropped_image)) {
                $imagePath = $this->imageService->compressAndStore(
                    $request->cropped_image,
                    [
                        'quality' => 60,
                        'maxWidth' => 1024,
                        'subfolder' => 'categories/'
                    ]
                );
            } elseif ($request->hasFile('image')) {
                $imagePath = $this->imageService->compressAndStore(
                    $request->file('image'),
                    [
                        'quality' => 60,
                        'maxWidth' => 1024,
                        'subfolder' => 'categories/'
                    ]
                );
            }
    
            Category::create([
                'title_ne' => $request->title_ne,
                'title_en' => $request->title_en,
                'description_ne' => $request->description_ne,
                'description_en' => $request->description_en,
                'image' => $imagePath,
                'is_active' => (bool) $request->is_active,
            ]);
    
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully!');
    
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    $request->validate([
        'title_ne' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'description_ne' => 'nullable|string|max:1000',
        'description_en' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        'cropped_image' => 'nullable|string',
    ]);

    try {
        $imagePath = $category->image;

        if (($request->has('cropped_image') && !empty($request->cropped_image)) || $request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                $this->imageService->deleteImage($category->image);
            }

            $imagePath = $this->imageService->compressAndStore(
                $request->has('cropped_image') && !empty($request->cropped_image) 
                    ? $request->cropped_image 
                    : $request->file('image'),
                [
                    'quality' => 60,
                    'maxWidth' => 1024,
                    'subfolder' => 'categories/'
                ]
            );
        }

        $category->update([
            'title_ne' => $request->title_ne,
            'title_en' => $request->title_en,
            'description_ne' => $request->description_ne,
            'description_en' => $request->description_en,
            'image' => $imagePath,
            'is_active' => (bool) $request->is_active,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');

    } catch (Exception $e) {
        return redirect()->back()
            ->withErrors(['error' => $e->getMessage()])
            ->withInput();
    }
}

    public function destroy(Category $category)
    {
        try {
            if ($category->image) {
                $this->imageService->deleteImage($category->image);
            }
            $category->delete();
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function storeMetadata(Request $request, Category $category)
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

        $category->update(['meta_data_id' => $metadata->id]);

        return redirect()->back()->with('success', 'Metadata added successfully!');
    } catch (Exception $e) {
        return redirect()->back()
            ->withErrors(['error' => $e->getMessage()])
            ->withInput();
    }
}

public function updateMetadata(Request $request, Category $category)
{
    $request->validate([
        'metaTitle' => 'required|string|max:255',
        'metaDescription' => 'nullable|string',
        'metaKeywords' => 'nullable|string',
    ]);

    try {
        if ($category->metadata) {
            $category->metadata->update([
                'metaTitle' => $request->metaTitle,
                'metaDescription' => $request->metaDescription,
                'metaKeywords' => $request->metaKeywords,
                'slug' => Str::slug($request->metaTitle)
            ]);
        } else {
            $this->storeMetadata($request, $category);
        }

        return redirect()->back()->with('success', 'Metadata updated successfully!');
    } catch (Exception $e) {
        return redirect()->back()
            ->withErrors(['error' => $e->getMessage()])
            ->withInput();
    }
}
public function updateStatus($categoryId)
{
    $category = Category::findOrFail($categoryId);
    $category->is_active = !$category->is_active; 
    $category->save();

    return redirect()->route('admin.categories.index')->with('success', 'Status updated successfully.');
}

}
