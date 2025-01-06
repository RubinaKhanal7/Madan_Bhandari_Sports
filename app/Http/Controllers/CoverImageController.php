<?php
namespace App\Http\Controllers;

use App\Models\CoverImage;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Exception;

class CoverImageController extends Controller
{
    protected $imageService;

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

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ne' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'cropped_image' => 'nullable|string',
        ]);

        try {
            $imagePath = null;

            if ($request->has('cropped_image')) {
                $imagePath = $this->imageService->compressAndStore(
                    $request->cropped_image,
                    [
                        'quality' => 60,
                        'maxWidth' => 1024,
                        'subfolder' => date('Y/m')
                    ]
                );
            } elseif ($request->hasFile('image')) {
                $imagePath = $this->imageService->compressAndStore(
                    $request->file('image'),
                    [
                        'quality' => 60,
                        'maxWidth' => 1024,
                        'subfolder' => date('Y/m')
                    ]
                );
            }

            if (!$imagePath) {
                return redirect()->back()
                    ->withErrors(['image' => 'Please upload an image'])
                    ->withInput();
            }

            CoverImage::create([
                'title_en' => $request->title_en,
                'title_ne' => $request->title_ne,
                'image' => $imagePath,
                'is_active' => (bool) $request->is_active,
            ]);

            return redirect()->route('admin.cover-images.index')
                ->with('success', 'Cover image created successfully.');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $coverImage = CoverImage::findOrFail($id);

        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ne' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'cropped_image' => 'nullable|string',
        ]);

        try {
            $imagePath = $coverImage->image;

            if ($request->has('cropped_image') || $request->hasFile('image')) {
                // Delete old image
                if ($coverImage->image) {
                    $this->imageService->deleteImage($coverImage->image);
                }

                $imagePath = $this->imageService->compressAndStore(
                    $request->has('cropped_image') ? $request->cropped_image : $request->file('image'),
                    [
                        'quality' => 60,
                        'maxWidth' => 1024,
                        'subfolder' => date('Y/m')
                    ]
                );
            }

            $coverImage->update([
                'title_en' => $request->title_en,
                'title_ne' => $request->title_ne,
                'image' => $imagePath,
                'is_active' => (bool) $request->is_active,
            ]);

            return redirect()->route('admin.cover-images.index')
                ->with('success', 'Cover image updated successfully');

        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }
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
