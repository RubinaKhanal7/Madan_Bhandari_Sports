<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

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
                'required',
                'url'
            ],
            'videos' => 'nullable|string|max:255',
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
        
        // Convert URL to embed format if needed
        $validated['url'] = $this->convertToEmbedUrl($validated['url']);

        VideoGallery::create($validated);
        return redirect()->back()->with('success', 'Video Gallery item added successfully.');
    }

    public function update(Request $request, VideoGallery $videoGallery)
    {
        $validated = $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'url' => [
                'required',
                'url'
            ],
            'videos' => 'nullable|string|max:255',
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
}