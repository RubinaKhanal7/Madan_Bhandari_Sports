<?php
namespace App\Services;

use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ImageCompressionService
{
    protected $basePath;
    protected $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
    protected $maxFileSize = 10485760;

    public function __construct(string $basePath = 'uploads')
    {
        $this->basePath = $basePath;
    }

    /**
     * Compress and store the image
     * 
     * @param UploadedFile|string $image
     * @param array $options
     * @return string
     * @throws Exception
     */
    public function compressAndStore($image, array $options = [])
    {
        $options = array_merge([
            'quality' => 60,
            'maxWidth' => 1024,
            'subfolder' => '',
            'crop' => null
        ], $options);

        try {
            // Create directory if it doesn't exist
            $directory = public_path($this->basePath . '/' . trim($options['subfolder'], '/'));
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // Handle base64 image
            if (is_string($image) && strpos($image, 'data:image') === 0) {
                $img = Image::make($image);
            } 
            // Handle uploaded file
            else if ($image instanceof UploadedFile) {
                $this->validateImage($image);
                $img = Image::make($image->getRealPath());
            } else {
                throw new Exception('Invalid image input');
            }

            // Generate unique filename
            $filename = uniqid('img_') . '_' . time() . '.webp';
            
            // Apply crop if specified
            if ($options['crop']) {
                $img->crop(
                    $options['crop']['width'],
                    $options['crop']['height'],
                    $options['crop']['x'],
                    $options['crop']['y']
                );
            }

            // Resize if needed
            if ($img->width() > $options['maxWidth']) {
                $img->resize($options['maxWidth'], null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            // Optimize and save
            $fullPath = $directory . '/' . $filename;
            $img->encode('webp', $options['quality'])->save($fullPath);

            // Return relative path
            return trim($this->basePath . '/' . trim($options['subfolder'], '/') . '/' . $filename, '/');
        } catch (Exception $e) {
            Log::error('Image compression failed: ' . $e->getMessage());
            throw new Exception('Failed to process image: ' . $e->getMessage());
        }
    }

    /**
     * Validate uploaded image
     */
    protected function validateImage(UploadedFile $image): void
    {
        if (!in_array($image->getMimeType(), $this->allowedMimes)) {
            throw new Exception('Invalid image type. Allowed types: ' . implode(', ', $this->allowedMimes));
        }

        if ($image->getSize() > $this->maxFileSize) {
            throw new Exception('Image size exceeds maximum allowed size of ' . ($this->maxFileSize / 1048576) . 'MB');
        }
    }

    /**
     * Delete an image and its directory if empty
     */
    public function deleteImage(string $path): bool
    {
        try {
            $fullPath = public_path($path);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
                
                // Delete parent directory if empty
                $directory = dirname($fullPath);
                if (File::exists($directory) && count(File::files($directory)) === 0) {
                    File::deleteDirectory($directory);
                }
                
                return true;
            }
            return false;
        } catch (Exception $e) {
            Log::error('Failed to delete image: ' . $e->getMessage());
            return false;
        }
    }
}