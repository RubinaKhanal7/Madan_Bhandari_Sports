<?php

namespace App\Http\Controllers;

use App\Models\MetaData;
use Illuminate\Http\Request;

class MetaDataController extends Controller
{
    public function index()
    {
        $metaData = MetaData::all();
        return view('backend.metadata.index', compact('metaData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'metaTitle' => 'required|string|max:255',
            'slug' => 'required|string|unique:meta_data,slug|max:255',
        ]);

        MetaData::create($request->all());
        return redirect()->back()->with('success', 'MetaData created successfully!');
    }

    public function update(Request $request, $id)
{
    try {
        $metaData = MetaData::findOrFail($id);
        
        $request->validate([
            'metaTitle' => 'required|string|max:255',
            'slug' => 'required|string|unique:meta_data,slug,' . $id . '|max:255',
        ]);

        $updated = $metaData->update($request->all());
        
        return redirect()->back()->with('success', 'MetaData updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update MetaData: ' . $e->getMessage());
    }
}

public function destroy($id)
{
    try {
        $metaData = MetaData::findOrFail($id);
        
        $deleted = $metaData->delete();
        
        if ($deleted) {
            return redirect()->back()->with('success', 'MetaData deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete MetaData');
        }
        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to delete MetaData: ' . $e->getMessage());
    }
}
}

