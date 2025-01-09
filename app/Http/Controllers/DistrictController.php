<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::with('province')->paginate(20);
        $provinces = Province::where('is_active', true)->get();
        return view('backend.district.index', compact('districts', 'provinces'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        District::create([
            'title' => $request->title,
            'province_id' => $request->province_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.districts.index')
            ->with('success', 'District created successfully.');
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'province_id' => 'required|exists:provinces,id',
        ]);

        $district->update([
            'title' => $request->title,
            'province_id' => $request->province_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.districts.index')
            ->with('success', 'District updated successfully.');
    }

    public function updateStatus(Request $request, District $district)
    {
        $district->update([
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.districts.index')
            ->with('success', 'District status updated successfully.');
    }

    public function destroy(District $district)
    {
        $district->delete();

        return redirect()->route('admin.districts.index')
            ->with('success', 'District deleted successfully.');
    }
}