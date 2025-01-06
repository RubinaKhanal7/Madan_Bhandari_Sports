<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the video galleries.
     *
     * @return \Illuminate\View\View
     */
    public function index()
{
    $videos = VideoGallery::latest()->paginate(10); // Adjust the number per page as needed
    $page_title = "Video Galleries";

    return view('backend.videogallery.index', compact('videos', 'page_title'));
}

    /**
     * Show the form for creating a new video gallery.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.videogallery.index');
    }

    /**
     * Store a newly created video gallery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'videos' => 'required|string|max:255',
            'url' => 'required|url',
            'description_ne' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        VideoGallery::create($validatedData);

        return redirect()->route('video_galleries.index')->with('success', 'Video gallery created successfully.');
    }

    /**
     * Show the form for editing the specified video gallery.
     *
     * @param  VideoGallery  $videoGallery
     * @return \Illuminate\View\View
     */
    public function edit(VideoGallery $videoGallery)
    {
        return view('video_galleries.edit', compact('videoGallery'));
    }

    /**
     * Update the specified video gallery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  VideoGallery  $videoGallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, VideoGallery $videoGallery)
    {
        $validatedData = $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'videos' => 'required|string|max:255',
            'url' => 'required|url',
            'description_ne' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $videoGallery->update($validatedData);

        return redirect()->route('video_galleries.index')->with('success', 'Video gallery updated successfully.');
    }

    /**
     * Remove the specified video gallery from storage.
     *
     * @param  VideoGallery  $videoGallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(VideoGallery $videoGallery)
    {
        $videoGallery->delete();

        return redirect()->route('video_galleries.index')->with('success', 'Video gallery deleted successfully.');
    }

    /**
     * Toggle the 'is_featured' status.
     *
     * @param  VideoGallery  $videoGallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleFeatured(VideoGallery $videoGallery)
    {
        $videoGallery->is_featured = !$videoGallery->is_featured;
        $videoGallery->save();

        return redirect()->route('video_galleries.index')->with('success', 'Featured status updated successfully.');
    }

    /**
     * Toggle the 'is_active' status.
     *
     * @param  VideoGallery  $videoGallery
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleActive(VideoGallery $videoGallery)
    {
        $videoGallery->is_active = !$videoGallery->is_active;
        $videoGallery->save();

        return redirect()->route('video_galleries.index')->with('success', 'Active status updated successfully.');
    }
}
