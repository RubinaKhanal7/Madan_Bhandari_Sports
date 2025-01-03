<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favicon;
use Illuminate\Http\Request;

class FaviconController extends Controller
{
    public function index()
    {
        $favicons = Favicon::all();
        return view('backend.favicon.index', compact('favicons'));
    }

    public function update(Request $request, $id)
    {
        $favicon = Favicon::findOrFail($id);

        $request->validate([
            'fav_16' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'fav_32' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'fav_ico' => 'nullable|image|mimes:ico,png,jpg,jpeg,webp',
            'fav_apple' => 'nullable|image|mimes:pngpng,jpg,jpeg,webp',
            'fav_192' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'fav_512' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'site_manifest' => 'nullable|url',
            'is_active' => 'required|boolean',
        ], [
            'mimes' => 'Only PNG, JPG, JPEG, and ICO formats are allowed for :attribute.',
            'max' => 'The file size for :attribute must not exceed 2MB.',
        ]);
        foreach (['fav_16', 'fav_32', 'fav_ico', 'fav_apple', 'fav_192', 'fav_512'] as $field) {
            if ($request->hasFile($field)) {
                $image = $request->file($field);
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/favicons'), $imageName);
                $favicon->{$field} = $imageName;
            }
        }

        $favicon->site_manifest = $request->site_manifest;
        $favicon->is_active = $request->is_active;

        $favicon->save();

        return redirect()->route('admin.favicons.index')->with('success', 'Favicon updated successfully');
    }
}
