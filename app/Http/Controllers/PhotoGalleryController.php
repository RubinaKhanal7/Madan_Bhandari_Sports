<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        // Fetch paginated galleries
        $photoGalleries = PhotoGallery::paginate(5); 
        return view('backend.photogallery.index', [
            'photoGalleries' => $photoGalleries,
            'page_title' => 'Photo Gallery'
        ]);
    }

    public function create()
    {
        return view('backend.photogallery.create', ['page_title' => 'Create Photo Gallery']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title_en' => 'required|string',
            'title_ne' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ne' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048',
            'is_active' => 'required|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        try {
            $convertedImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/photogallery/'), $imageName);
                $convertedImages[] = 'uploads/photogallery/' . $imageName;
            }

            PhotoGallery::create([
                'title_en' => $request->title_en,
                'title_ne' => $request->title_ne,
                'description_en' => $request->description_en,
                'description_ne' => $request->description_ne,
                'images' => json_encode($convertedImages), // Store as JSON string
                'is_active' => $request->is_active,
                'is_featured' => $request->is_featured,
            ]);

            return redirect()->route('admin.photo-galleries.index')
                ->with('success', 'Gallery created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $gallery = PhotoGallery::find($id);
        return view('backend.photogallery.update', [
            'gallery' => $gallery,
            'page_title' => 'Update Photo Gallery'
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title_en' => 'required|string',
            'title_ne' => 'required|string',
            'description_en' => 'nullable|string',
            'description_ne' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif,webp|max:2048',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        try {
            $gallery = PhotoGallery::findOrFail($id);

            $gallery->title_en = $request->title_en;
            $gallery->title_ne = $request->title_ne;
            $gallery->description_en = $request->description_en;
            $gallery->description_ne = $request->description_ne;
            $gallery->is_active = $request->is_active;
            $gallery->is_featured = $request->is_featured;

            if ($request->hasFile('images')) {
                $convertedImages = [];
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/photogallery/'), $imageName);
                    $convertedImages[] = 'uploads/photogallery/' . $imageName;
                }
                $gallery->images = json_encode($convertedImages); // Store as JSON string
            }

            $gallery->save();
            return redirect()->route('admin.photo-galleries.index')
                ->with('success', 'Gallery updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating gallery. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $gallery = PhotoGallery::find($id);
        if ($gallery) {
            foreach (json_decode($gallery->images, true) as $image) {
                File::delete(public_path($image));
            }
            $gallery->delete();
            return redirect()->route('admin.photo-galleries.index')
                ->with('success', 'Gallery deleted successfully.');
        } else {
            return redirect()->route('admin.photo-galleries.index')
                ->with('error', 'Gallery not found.');
        }
    }
}
