<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::latest()->paginate(20);
        return view('backend.province.index', compact('provinces'));
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
    ]);

    $data = $request->only('title');
    $data['is_active'] = $request->has('is_active') ? 1 : 0;

    Province::create($data);

    return redirect()->route('admin.provinces.index')->with('success', 'Province created successfully.');
}


public function update(Request $request, Province $province)
{
    $request->validate([
        'title' => 'required|string|max:255',
    ]);

    $data = $request->only('title');
    $data['is_active'] = $request->has('is_active') ? 1 : 0;

    $province->update($data);

    return redirect()->route('admin.provinces.index')->with('success', 'Province updated successfully.');
}


    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->route('admin.provinces.index')->with('success', 'Province deleted successfully.');
    }
}
