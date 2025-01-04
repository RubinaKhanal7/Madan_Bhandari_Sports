<?php
namespace App\Http\Controllers;

use App\Models\CoverImage;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoverImageController extends Controller
{
    protected $imageService;
    protected $maxFileSize = 3; 

    public function __construct(ImageCompressionService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $coverImages = CoverImage::latest()->paginate(5);
        return view('backend.coverimage.index', [
            'coverImages' => $coverImages,
            'page_title' => 'Cover Image'
        ]);
    }

    protected function checkImageSize($image)
    {
        $sizeInMB = $image->getSize() / 1024 / 1024;
        if ($sizeInMB > $this->maxFileSize) {
            return false;
        }
        return true;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required',
            'title_ne' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'cropped_image' => 'nullable|string',
        ]);

        $imagePath = null;
        $directory = public_path('uploads/cover-images');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        if ($request->has('cropped_image') && $request->cropped_image) {
            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);
            $imagePath = 'uploads/cover-images/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);

            session()->flash('success', 'Cropped image has been saved. Now you can submit the form.');
        }
        if (!$imagePath && $request->hasFile('image')) {
            $imagePath = $this->imageService->compressAndStore(
                $request->file('image'),
                'cover-images',
                60,
                1024
            );
        }

        if ($imagePath) {
            CoverImage::create([
                'title_en' => $request->title_en,
                'title_ne' => $request->title_ne,
                'image' => $imagePath,
                'is_active' => $request->is_active ? true : false,
            ]);
    
            return redirect()->route('admin.cover-images.index')->with('success', 'Cover image created successfully.');
        }
    
        return redirect()->back()->withErrors('Please upload a cropped image or a regular image.');
    }
    
    
    public function update(Request $request, $id)
    {
        $coverImage = CoverImage::findOrFail($id);
    
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ne' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            'cropped_image' => 'nullable|string',
        ]);
    
        $imagePath = $coverImage->image; 

        if ($request->has('cropped_image') && $request->cropped_image) {
            if ($coverImage->image && file_exists(public_path($coverImage->image))) {
                unlink(public_path($coverImage->image));
            }
    
            $croppedImageData = $request->cropped_image;
            $imageData = str_replace('data:image/jpeg;base64,', '', $croppedImageData);
            $imageData = base64_decode($imageData);
            $imagePath = 'uploads/cover-images/' . uniqid() . '.jpg';
            file_put_contents(public_path($imagePath), $imageData);
        }
        elseif ($request->hasFile('image')) {
            if ($coverImage->image && file_exists(public_path($coverImage->image))) {
                unlink(public_path($coverImage->image));
            }
    
            $imagePath = $this->imageService->compressAndStore(
                $request->file('image'),
                'cover-images',
                60,
                1024
            );
        }
    
        $coverImage->update([
            'title_en' => $request->title_en,
            'title_ne' => $request->title_ne,
            'image' => $imagePath,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
    
        return redirect()->route('admin.cover-images.index')
            ->with('success', 'Cover image updated successfully');
    }
    
    public function destroy($id)
    {
        $coverImage = CoverImage::findOrFail($id);
        $this->imageService->deleteImage($coverImage->image);
        $coverImage->delete();

        return redirect()->route('admin.cover-images.index')
            ->with('success', 'Cover image deleted successfully.');
    }
}
