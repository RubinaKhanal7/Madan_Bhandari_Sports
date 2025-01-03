<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index()
    {
        $sitesettings = SiteSetting::all();
        return view('backend.sitesetting.index', ['sitesettings' => $sitesettings, 'page_title' => 'Site Settings']);
    }

    public function create()
    {
        $socialmedias = SocialMedia::all(); // Get social media options
        return view('backend.sitesetting.create', ['socialmedias' => $socialmedias, 'page_title' => 'Create Site Setting']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'main_logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'alt_logo' => 'nullable|image|mimes:jpg,jpeg,png',
            'google_map' => 'nullable|url',
        ]);

        $sitesetting = new SiteSetting();
        $sitesetting->title_ne = $request->title_ne;
        $sitesetting->title_en = $request->title_en;
        $sitesetting->slogan_ne = $request->slogan_ne;
        $sitesetting->slogan_en = $request->slogan_en;

        // Handle file uploads
        if ($request->hasFile('main_logo')) {
            $main_logo = $request->file('main_logo');
            $main_logo_name = time() . '-' . $main_logo->getClientOriginalName();
            $main_logo->move(public_path('uploads/sitesetting'), $main_logo_name);
            $sitesetting->main_logo = $main_logo_name;
        }

        if ($request->hasFile('alt_logo')) {
            $alt_logo = $request->file('alt_logo');
            $alt_logo_name = time() . '-' . $alt_logo->getClientOriginalName();
            $alt_logo->move(public_path('uploads/sitesetting'), $alt_logo_name);
            $sitesetting->alt_logo = $alt_logo_name;
        }

        $sitesetting->phone_no = json_encode($request->phone_no);
        $sitesetting->email = json_encode($request->email);
        $sitesetting->established_year = $request->established_year;
        $sitesetting->description_ne = $request->description_ne;
        $sitesetting->description_en = $request->description_en;
        $sitesetting->socialmedia = $request->socialmedia;
        $sitesetting->google_map = $request->google_map;
        $sitesetting->save();

        return redirect()->route('admin.site-settings.index')->with('success', 'Site settings created successfully!');
    }

    public function edit($id)
    {
        $sitesetting = SiteSetting::findOrFail($id);
        $socialmedias = SocialMedia::all(); // Get social media options
        return view('backend.sitesetting.update', ['sitesetting' => $sitesetting, 'socialmedias' => $socialmedias, 'page_title' => 'Edit Site Setting']);
    }

    public function update(Request $request, $id)
{
    $sitesetting = SiteSetting::findOrFail($id);

    // Process main logo
    if ($request->has('main_logo_cropped') && $request->main_logo_cropped != '') {
        // Remove header from base64 string
        $image_parts = explode(";base64,", $request->main_logo_cropped);
        $image_base64 = base64_decode($image_parts[1]);
        
        // Generate unique filename
        $filename = 'main_logo_' . time() . '.png';
        
        // Save file
        Storage::disk('public')->put('uploads/sitesetting/' . $filename, $image_base64);
        
        // Update database
        $sitesetting->main_logo = $filename;
    }

    // Process alt logo
    if ($request->has('alt_logo_cropped') && $request->alt_logo_cropped != '') {
        // Remove header from base64 string
        $image_parts = explode(";base64,", $request->alt_logo_cropped);
        $image_base64 = base64_decode($image_parts[1]);
        
        // Generate unique filename
        $filename = 'alt_logo_' . time() . '.png';
        
        // Save file
        Storage::disk('public')->put('uploads/sitesetting/' . $filename, $image_base64);
        
        // Update database
        $sitesetting->alt_logo = $filename;
    }

    // Update other fields
    $sitesetting->update($request->except(['main_logo', 'alt_logo', 'main_logo_cropped', 'alt_logo_cropped', 'main_logo_crop_data', 'alt_logo_crop_data']));

    return redirect()->back()->with('success', 'Site settings updated successfully');
}

    public function destroy($id)
    {
        $sitesetting = SiteSetting::findOrFail($id);

        // Delete files if exists
        if (File::exists(public_path('uploads/sitesetting/' . $sitesetting->main_logo))) {
            File::delete(public_path('uploads/sitesetting/' . $sitesetting->main_logo));
        }

        if (File::exists(public_path('uploads/sitesetting/' . $sitesetting->alt_logo))) {
            File::delete(public_path('uploads/sitesetting/' . $sitesetting->alt_logo));
        }

        $sitesetting->delete();
        return redirect()->route('admin.site-settings.index')->with('success', 'Site settings deleted successfully!');
    }
}
