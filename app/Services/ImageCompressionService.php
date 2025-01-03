<?php
namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageCompressionService
{
    /**
     * Base path for uploads
     */
    protected $basePath = 'uploads/cover-images'; // Ensure it's relative to public directory

    /**
     * Compress and store the image
     * 
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $folderName
     * @param int $quality
     * @param int $maxWidth
     * @return string
     */
    public function compressAndStore($image, $folderName, $quality = 60, $maxWidth = 1024)
    {
        // Create full directory path within the public folder
        $directory = public_path($this->basePath);
        
        // Create directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
        
        // Create instance of Intervention Image
        $img = Image::make($image);

        // Resize image if width is greater than maximum width
        if ($img->width() > $maxWidth) {
            $img->resize($maxWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Full path for saving
        $fullPath = $directory . '/' . $filename;

        // Save compressed image
        $img->save($fullPath, $quality);

        // Return relative path for database storage
        return $this->basePath . '/' . $filename; // Store relative path
    }

    /**
     * Get the size of the file in MB
     * 
     * @param string $path
     * @return float
     */
    public function getFileSize($path)
    {
        $fullPath = public_path($path);
        return round(File::size($fullPath) / 1024 / 1024, 2);
    }

    /**
     * Delete an image
     * 
     * @param string $path
     * @return bool
     */
    public function deleteImage($path)
    {
        $fullPath = public_path($path);
        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }
        return false;
    }
}
