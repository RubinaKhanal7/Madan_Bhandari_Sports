<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ImageHandlerService
{
    protected $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    protected $quality = 80; // Default compression quality
    
    /**
     * Handle image upload with compression and optional cropping
     *
     * @param UploadedFile $image
     * @param string $path
     * @param array|null $crop
     * @param int|null $quality
     * @return string|false
     */
    public function handleImageUpload(UploadedFile $image, string $path, ?array $crop = null, ?int $quality = null)
    {
        try {
            if (!in_array($image->getMimeType(), $this->allowedMimeTypes)) {
                throw new \Exception('Invalid image type');
            }

            // Create intervention image instance
            $img = Image::make($image);

            // Apply cropping if coordinates are provided
            if ($crop && isset($crop['width'], $crop['height'], $crop['x'], $crop['y'])) {
                $img->crop(
                    (int) $crop['width'],
                    (int) $crop['height'],
                    (int) $crop['x'],
                    (int) $crop['y']
                );
            }

            // Generate unique filename
            $filename = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $fullPath = $path . '/' . $filename;

            // Compress and save the image
            Storage::put(
                $fullPath,
                $img->encode(
                    $image->getClientOriginalExtension(),
                    $quality ?? $this->quality
                )->encoded
            );

            return $fullPath;
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete an image
     *
     * @param string $path
     * @return bool
     */
    public function deleteImage(string $path): bool
    {
        try {
            if (Storage::exists($path)) {
                return Storage::delete($path);
            }
            return false;
        } catch (\Exception $e) {
            Log::error('Image deletion failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Set compression quality
     *
     * @param int $quality
     * @return void
     */
    public function setQuality(int $quality): void
    {
        $this->quality = max(0, min(100, $quality));
    }
}