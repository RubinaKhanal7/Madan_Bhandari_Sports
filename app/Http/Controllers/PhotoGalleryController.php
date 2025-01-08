<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use App\Models\Metadata;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PhotoGalleryController extends Controller
{
    protected $imageService;

    public function __construct(ImageCompressionService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $galleries = PhotoGallery::latest()->paginate(10);
        return view('backend.photogallery.index', compact('galleries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ne' => 'nullable|string',
            'description_en' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            $imagePaths = [];
            
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $this->imageService->compressAndStore(
                        $image,
                        [
                            'quality' => 60,
                            'maxWidth' => 1024,
                            'subfolder' => 'photo-gallery/'
                        ]
                    );
                    $imagePaths[] = $imagePath;
                }
            }

            
            $gallery = PhotoGallery::create([
                'title_ne' => $request->title_ne,
                'title_en' => $request->title_en,
                'description_ne' => $request->description_ne,
                'description_en' => $request->description_en,
                'images' => $imagePaths,
                'is_featured' => (bool) $request->is_featured,
                'is_active' => (bool) $request->is_active,
            ]);

            return redirect()->route('admin.photo-galleries.index')
                ->with('success', 'Photo Gallery created successfully!');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $gallery = PhotoGallery::findOrFail($id);

        $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ne' => 'nullable|string',
            'description_en' => 'nullable|string',
            'new_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'existing_images' => 'nullable|array',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            $imagePaths = [];
            
            // Handle existing images
            if ($request->has('existing_images')) {
                $imagePaths = $request->existing_images;
                
                // Delete removed images
                $removedImages = array_diff($gallery->images ?? [], $request->existing_images);
                foreach ($removedImages as $image) {
                    $this->imageService->deleteImage($image);
                }
            }

            // Handle new images
            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $image) {
                    $imagePath = $this->imageService->compressAndStore(
                        $image,
                        [
                            'quality' => 60,
                            'maxWidth' => 1024,
                            'subfolder' => 'photo-gallery/'
                        ]
                    );
                    $imagePaths[] = $imagePath;
                }
            }

            $gallery->update([
                'title_ne' => $request->title_ne,
                'title_en' => $request->title_en,
                'description_ne' => $request->description_ne,
                'description_en' => $request->description_en,
                'images' => $imagePaths,
                'is_featured' => (bool) $request->is_featured,
                'is_active' => (bool) $request->is_active,
            ]);

            return redirect()->route('admin.photo-galleries.index')
                ->with('success', 'Photo Gallery updated successfully!');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $gallery = PhotoGallery::findOrFail($id);
            
            // Delete all associated images
            if (!empty($gallery->images)) {
                foreach ($gallery->images as $image) {
                    $this->imageService->deleteImage($image);
                }
            }
            
            $gallery->delete();
            
            return redirect()->route('admin.photo-galleries.index')
                ->with('success', 'Photo Gallery deleted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateStatus($id)
    {
        $gallery = PhotoGallery::findOrFail($id);
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();

        return redirect()->route('admin.photo-galleries.index')
            ->with('success', 'Status updated successfully.');
    }

    public function updateFeatured($id)
{
    try {
        $gallery = PhotoGallery::findOrFail($id);
        $gallery->is_featured = !$gallery->is_featured;
        $gallery->save();

        return redirect()->route('admin.photo-gallery.index')
            ->with('success', 'Featured status updated successfully.');
    } catch (Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

public function storeMetadata(Request $request, $id)
{
    $gallery = PhotoGallery::findOrFail($id);
    $request->validate([
        'metaTitle' => 'required|string|max:255',
        'metaDescription' => 'nullable|string',
        'metaKeywords' => 'nullable|string',
    ]);

    $metadata = $gallery->metaData;

    if (!$metadata) {
        $metadata = Metadata::create([
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'metaKeywords' => $request->metaKeywords,
            'slug' => Str::slug($request->metaTitle),
        ]);
        $gallery->meta_data_id = $metadata->id;
        $gallery->save();
    } else {
        $metadata->update([
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'metaKeywords' => $request->metaKeywords,
        ]);
    }
    return redirect()->route('admin.photo-galleries.index')->with('success', 'Metadata saved successfully!');
}

}