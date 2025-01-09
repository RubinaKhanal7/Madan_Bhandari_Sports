<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use App\Models\Metadata;
use Illuminate\Support\Str;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = VideoGallery::latest()->get();
        return view('backend.videogallery.index', compact('videos'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title_ne' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'url' => [
            'nullable',
            'url'
        ],
        'videos' => 'nullable|file|mimes:mp4,mkv,avi|max:102400', // 100MB max
        'description_ne' => 'nullable|string',
        'description_en' => 'nullable|string',
        'is_featured' => 'nullable',
        'is_active' => 'nullable'
    ]);

    // Handle boolean fields properly
    $validated['is_featured'] = $request->has('is_featured');
    $validated['is_active'] = $request->has('is_active');

    // Compress the video if uploaded
    if ($request->hasFile('videos')) {
        $originalVideo = $request->file('videos');
        $compressedVideoPath = $this->compressVideo($originalVideo);
        $validated['videos'] = $compressedVideoPath; // Save the compressed video path
    }

    VideoGallery::create($validated);
    return redirect()->back()->with('success', 'Video Gallery item added successfully.');
}

private function compressVideo($video)
{
    $ffmpeg = FFMpeg::create();
    $videoPath = $video->store('videos/original', 'public'); // Save original
    $outputPath = storage_path('app/public/videos/compressed/' . uniqid() . '.mp4'); // Define compressed path

    $video = $ffmpeg->open(storage_path('app/public/' . $videoPath));
    $format = new X264('aac', 'libx264');
    $format->setAudioCodec('aac');
    $format->setKiloBitrate(1000); 
    $video->save($format, $outputPath);

    return 'videos/compressed/' . basename($outputPath); 
}

public function update(Request $request, VideoGallery $videoGallery)
{
    $validated = $request->validate([
        'title_ne' => 'required|string|max:255',
        'title_en' => 'required|string|max:255',
        'url' => [
            'nullable',
            'url'
        ],
        'videos' => 'nullable|file|mimes:mp4,mkv,avi|max:102400', // 100MB max
        'description_ne' => 'nullable|string',
        'description_en' => 'nullable|string',
        'is_featured' => 'nullable',
        'is_active' => 'nullable'
    ], [
        'url.required' => 'Please provide a video URL.',
        'url.url' => 'Please enter a valid URL.',
        'title_ne.required' => 'Please enter the title in Nepali.',
        'title_en.required' => 'Please enter the title in English.',
    ]);

    // Handle boolean fields properly
    $validated['is_featured'] = $request->has('is_featured');
    $validated['is_active'] = $request->has('is_active');

    // Compress the video if uploaded
    if ($request->hasFile('videos')) {
        $originalVideo = $request->file('videos');
        $compressedVideoPath = $this->compressVideo($originalVideo);
        $validated['videos'] = $compressedVideoPath; // Save the compressed video path
    }

    // Convert URL to embed format if needed
    $validated['url'] = $this->convertToEmbedUrl($validated['url']);

    $videoGallery->update($validated);
    return redirect()->back()->with('success', 'Video Gallery item updated successfully.');
}


    public function destroy(VideoGallery $videoGallery)
    {
        $videoGallery->delete();
        return redirect()->back()->with('success', 'Video Gallery item deleted successfully.');
    }

    private function convertToEmbedUrl($url)
    {
        // YouTube
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // YouTube short URL
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // Vimeo
        if (preg_match('/vimeo\.com\/([0-9]+)/', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }
        
        // Already an embed URL
        if (strpos($url, 'youtube.com/embed/') !== false || strpos($url, 'player.vimeo.com/video/') !== false) {
            return $url;
        }
        
        // Return original URL if no conversion needed
        return $url;
    }

    public function toggleFeatured(VideoGallery $videoGallery)  
{
    $videoGallery->update(['is_featured' => !$videoGallery->is_featured]);
    return back()->with('success', 'Featured status updated successfully');
}

public function toggleStatus(VideoGallery $videoGallery)   
{
    $videoGallery->update(['is_active' => !$videoGallery->is_active]);
    return back()->with('success', 'Status updated successfully');
}

public function storeMetadata(Request $request, $id)
{
    $videoGallery = VideoGallery::findOrFail($id);
    $request->validate([
        'metaTitle' => 'required|string|max:255',
        'metaDescription' => 'nullable|string',
        'metaKeywords' => 'nullable|string',
    ]);

    $metadata = $videoGallery->metaData;

    if (!$metadata) {
        $metadata = Metadata::create([
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'metaKeywords' => $request->metaKeywords,
            'slug' => Str::slug($request->metaTitle),
        ]);
        $videoGallery->meta_data_id = $metadata->id;
        $videoGallery->save();
    } else {
        $metadata->update([
            'metaTitle' => $request->metaTitle,
            'metaDescription' => $request->metaDescription,
            'metaKeywords' => $request->metaKeywords,
        ]);
    }
    return redirect()->route('admin.video-galleries.index')->with('success', 'Metadata saved successfully!');
}
}