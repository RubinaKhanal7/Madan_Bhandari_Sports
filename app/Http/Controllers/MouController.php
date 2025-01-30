<?php

namespace App\Http\Controllers;

use App\Models\Mou;
use App\Services\ImageCompressionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Province;
use App\Models\District;
use App\Models\LocalGovernment;

class MouController extends Controller
{
    protected $imageService;
    private const MAX_IMAGE_SIZE = 2048; // 2MB
    private const IMAGE_UPLOAD_PATH = 'mous';

    public function __construct(ImageCompressionService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $mous = Mou::latest()->paginate(10);
        $provinces = Province::where('is_active', true)->get();
        $districts = District::where('is_active', true)->get();
        $locals = LocalGovernment::where('is_active', true)->get();
        
        return view('backend.mou.index', compact('mous', 'provinces', 'districts', 'locals'));
    }

    public function store(Request $request)
    {
        $validator = $this->validateMouRequest($request);
        if ($validator->fails()) {
            return $this->handleValidationFailure($validator);
        }
        try {
            $data = $this->processMouData($request);
            Mou::create($data);
            return redirect()->route('admin.mous.index')->with('success', 'MOU created successfully!');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(Request $request, Mou $mou)
    {
        $validator = $this->validateMouRequest($request);
        if ($validator->fails()) {
            return $this->handleValidationFailure($validator);
        }
        try {
            $data = $this->processMouData($request, $mou);
            $mou->update($data);
            return redirect()->route('admin.mous.index')->with('success', 'MOU updated successfully!');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function destroy(Mou $mou)
    {
        try {
            if ($mou->image) {
                $this->imageService->deleteImage($mou->image);
            }
            if ($mou->other_images) {
                foreach (json_decode($mou->other_images, true) as $imagePath) {
                    $this->imageService->deleteImage($imagePath);
                }
            }
            $mou->delete();
            return redirect()->route('admin.mous.index')->with('success', 'MOU deleted successfully!');
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    protected function validateMouRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:' . self::MAX_IMAGE_SIZE,
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:' . self::MAX_IMAGE_SIZE
        ]);
    }

    protected function processMouData(Request $request, ?Mou $mou = null): array
    {
        $imagePath = $mou?->image;
        $otherImages = json_decode($mou?->other_images, true) ?? [];
    
        if ($request->hasFile('image')) {
            if ($mou && $mou->image) {
                $this->imageService->deleteImage($mou->image);
            }
            $imagePath = $this->imageService->compressAndStore($request->file('image'), [
                'quality' => 60, 'maxWidth' => 1024, 'subfolder' => self::IMAGE_UPLOAD_PATH
            ]);
        }
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $otherImages[] = $this->imageService->compressAndStore($image, [
                    'quality' => 60, 'maxWidth' => 1024, 'subfolder' => self::IMAGE_UPLOAD_PATH
                ]);
            }
        }
    
        return [
            'state' => $request->state,
            'district' => $request->district,
            'local' => $request->local,
            'university' => $request->university,
            'description' => $request->description,
            'image' => $imagePath,
            'other_images' => json_encode($otherImages),
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ];
    }

    public function deleteImage(Mou $mou, $index)
    {
        try {
            $otherImages = json_decode($mou->other_images, true) ?? [];
            if (isset($otherImages[$index])) {
                $this->imageService->deleteImage($otherImages[$index]);
                unset($otherImages[$index]);
                $mou->update(['other_images' => json_encode(array_values($otherImages))]);
                return redirect()->back()->with('success', 'Image deleted successfully');
            }
            return redirect()->back()->with('error', 'Image not found');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete image');
        }
    }

    protected function handleValidationFailure($validator)
    {
        return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Please check the form fields and try again.');
    }

    protected function handleException(Exception $e)
    {
        Log::error('MOU operation failed: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Operation failed: ' . $e->getMessage()])->withInput();
    }
}
