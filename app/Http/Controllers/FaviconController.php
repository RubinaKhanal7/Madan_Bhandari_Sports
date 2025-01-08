<?php

namespace App\Http\Controllers;

use App\Models\Favicon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

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
            'fav_apple' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'fav_192' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'fav_512' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'site_manifest' => 'nullable|url',
            'is_active' => 'nullable|boolean',
        ]);

        try {
            foreach (['fav_16', 'fav_32', 'fav_ico', 'fav_apple', 'fav_192', 'fav_512'] as $field) {
                if ($request->hasFile($field)) {
                    $image = $request->file($field);
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/favicons'), $imageName);
                    
                    // Delete old image if exists
                    if ($favicon->{$field}) {
                        $oldPath = public_path('uploads/favicons/' . $favicon->{$field});
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
                    
                    $favicon->{$field} = $imageName;
                }
            }

            $favicon->site_manifest = $request->site_manifest;
            $favicon->is_active = $request->has('is_active');

            if ($favicon->is_active) {
                Favicon::where('id', '!=', $favicon->id)->update(['is_active' => false]);
            }

            $favicon->save();

            return redirect()->route('admin.favicons.index')
                ->with('success', 'Favicon updated successfully');

        } catch (Exception $e) {
            Log::error('Favicon update failed: ' . $e->getMessage());
            return redirect()->back()
                ->withErrors(['error' => 'Update failed: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function toggleStatus(Favicon $favicon)
{
    $favicon->is_active = !$favicon->is_active;
    $favicon->save();
    
    return redirect()->back()->with('success', 'Status updated successfully');
}
}