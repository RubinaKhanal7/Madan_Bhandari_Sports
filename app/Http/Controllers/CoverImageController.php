<?php

namespace App\Http\Controllers;

use App\Models\CoverImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CoverImageController extends Controller
{

    public function index()
    {
        $coverImages = CoverImage::latest()->paginate(5);
        return view('backend.coverimage.index', [
            'coverImages' => $coverImages,
            'page_title' => 'Cover Image'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_ne' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'crop_width' => 'nullable|numeric',
            'crop_height' => 'nullable|numeric',
            'crop_x' => 'nullable|numeric',
            'crop_y' => 'nullable|numeric',
        ]);

        $imagePath = $this->handleImageUpload($request->file('image'), [
            'width' => $request->crop_width,
            'height' => $request->crop_height,
            'x' => $request->crop_x,
            'y' => $request->crop_y,
        ]);

        CoverImage::create([
            'title_en' => $request->title_en,
            'title_ne' => $request->title_ne,
            'image' => $imagePath,
            'description_en' => $request->description_en,
            'description_ne' => $request->description_ne,
            'is_active' => $request->is_active ? true : false,
        ]);

        return redirect()->route('admin.cover-images.index')
            ->with('success', 'Cover image created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title_en' => 'required',
            'title_ne' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'cropped_data' => 'nullable|string',
        ]);
    
        $coverImage = CoverImage::findOrFail($id);
        $imagePath = $coverImage->image;
    
        // Handle image upload
        if ($request->has('cropped_data')) {
            // Delete old image
            $this->deleteOldImage($coverImage->image);
            
            // Process and save the cropped image
            $imagePath = $this->handleCroppedImage($request->cropped_data);
        }
    
        $coverImage->update([
            'title_en' => $request->title_en,
            'title_ne' => $request->title_ne,
            'image' => $imagePath,
            'is_active' => $request->is_active ? true : false,
        ]);
    
        return redirect()->route('admin.cover-images.index')
            ->with('success', 'Cover image updated successfully.');
    }
    
    private function handleCroppedImage($base64Image)
    {
        // Remove data URI scheme prefix
        $image_parts = explode(";base64,", $base64Image);
        $image_base64 = base64_decode($image_parts[1]);
    
        // Create path
        $path = 'uploads/cover-images/';
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true);
        }
    
        // Generate filename
        $filename = $path . time() . '_' . Str::random(10) . '.jpg';
        
        // Save image
        File::put(public_path($filename), $image_base64);
        
        return $filename;
    }

    public function destroy($id)
    {
        $coverImage = CoverImage::findOrFail($id);
        $this->deleteOldImage($coverImage->image);
        $coverImage->delete();

        return redirect()->route('admin.cover-images.index')
            ->with('success', 'Cover image deleted successfully.');
    }

    private function handleImageUpload($image, $cropData)
{
    $path = 'uploads/cover-images/';
    if (!File::exists(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true);
    }

    $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
    
    // Create image instance
    $img = Image::make($image->getRealPath());
    
    // Crop image if crop data is provided
    if ($cropData['width'] && $cropData['height']) {
        $img->crop(
            (int)$cropData['width'],
            (int)$cropData['height'],
            (int)$cropData['x'],
            (int)$cropData['y']
        );
    }
    
    // Resize and compress image
    $img->resize(1200, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    
    // Save compressed image
    $img->save(public_path($path . $filename), 80); // 80 is the quality (0-100)
    
    return $path . $filename;
}

private function deleteOldImage($path)
{
    if ($path && File::exists(public_path($path))) {
        File::delete(public_path($path));
    }
}
}