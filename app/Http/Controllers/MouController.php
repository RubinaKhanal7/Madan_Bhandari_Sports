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

            return redirect()->route('admin.mous.index')
                ->with('success', 'MOU created successfully!');

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

            return redirect()->route('admin.mous.index')
                ->with('success', 'MOU updated successfully!');

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
                foreach ($mou->other_images as $imagePath) {
                    $this->imageService->deleteImage($imagePath);
                }
            }

            $mou->delete();
            return redirect()->route('admin.mous.index')
                ->with('success', 'MOU deleted successfully!');

        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    protected function validateMouRequest(Request $request)
    {
        $rules = [
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'local' => 'required|string|max:255',
            'university' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,webp|max:' . self::MAX_IMAGE_SIZE;
        }

        if ($request->has('cropped_image') && !empty($request->cropped_image)) {
            $rules['cropped_image'] = 'string';
        }

        return Validator::make($request->all(), $rules, [
            'image.max' => 'The image size must not be greater than 2MB.',
        ]);
    }

    protected function processMouData(Request $request, ?Mou $mou = null): array
    {
        $imagePath = $mou?->image;
    
        if ($request->hasFile('image') || ($request->has('cropped_image') && !empty($request->cropped_image))) {
            if ($mou && $mou->image) {
                $this->imageService->deleteImage($mou->image);
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
    
        return [
            'state' => $request->state,
            'district' => $request->district,
            'local' => $request->local,
            'university' => $request->university,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ];
    }
    public function toggleStatus(Mou $mou)
    {
        $mou->update(['is_active' => !$mou->is_active]);
    
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function toggleFeatured(Mou $mou)
{
    $mou->update(['is_featured' => !$mou->is_featured]);

    return redirect()->back()->with('success', 'Featured status updated successfully');
}

public function addImages(Request $request, Mou $mou)
{
    $validator = Validator::make($request->all(), [
        'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:' . self::MAX_IMAGE_SIZE
    ], [
        'images.*.max' => 'Each image must not be greater than 2MB.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    try {
        if ($request->hasFile('images')) {
            $otherImages = $mou->other_images ?? [];

            foreach ($request->file('images') as $image) {
                $imagePath = $this->imageService->compressAndStore($image, [
                    'quality' => 60,
                    'maxWidth' => 1024,
                    'subfolder' => self::IMAGE_UPLOAD_PATH
                ]);

                $otherImages[] = $imagePath;
            }

            $mou->update(['other_images' => $otherImages]);

            return redirect()->back()->with('success', 'Images uploaded successfully');
        }

        return redirect()->back()->with('error', 'No images were uploaded');
    } catch (Exception $e) {
        Log::error('Error uploading additional images: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to upload images');
    }
}

public function deleteImage(Mou $mou, $index)
{
    try {
        $otherImages = $mou->other_images ?? [];

        if (isset($otherImages[$index])) {
            $imagePath = $otherImages[$index];
            $this->imageService->deleteImage($imagePath);

            unset($otherImages[$index]);
            $otherImages = array_values($otherImages);

            $mou->update(['other_images' => $otherImages]);

            return redirect()->back()->with('success', 'Image deleted successfully');
        }

        return redirect()->back()->with('error', 'Image not found');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Failed to delete image');
    }
}

    protected function handleValidationFailure($validator)
    {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Please check the form fields and try again.');
    }

    protected function handleException(Exception $e)
    {
        Log::error('MOU operation failed: ' . $e->getMessage());
        return redirect()->back()
            ->withErrors(['error' => 'Operation failed: ' . $e->getMessage()])
            ->withInput();
    }
    public function getDistricts(Request $request)
    {
        $districts = District::where('province_id', $request->province_id)
                           ->where('is_active', true)
                           ->get(['id', 'title']);
        
        return response()->json($districts);
    }
    
    public function getLocals(Request $request)
    {
        $locals = LocalGovernment::where('district_id', $request->district_id)
                                ->where('is_active', true)
                                ->get(['id', 'title']);
        
        return response()->json($locals);
    }
}