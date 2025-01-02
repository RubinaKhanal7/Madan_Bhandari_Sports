<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMedia;

class SocialmediaController extends Controller
{
    public function edit($id)
    {
        $socialmedia = SocialMedia::findOrFail($id);
        return view('backend.socialmedia.update', compact('socialmedia'));
    }
    
    public function update(Request $request, $id)
    {
        $socialmedia = SocialMedia::findOrFail($id);
        $socialmedia->update($request->all());
    
        return redirect()->route('admin.site-settings.index')->with('success', 'Social Media updated successfully.');
    }
    
}
