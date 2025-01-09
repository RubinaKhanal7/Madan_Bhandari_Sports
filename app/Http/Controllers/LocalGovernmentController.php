<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LocalGovernment;
use App\Models\District;
use Illuminate\Http\Request;

class LocalGovernmentController extends Controller
{
    public function index()
    {
        $localGovernments = LocalGovernment::with('district')->paginate(10);
        $districts = District::where('is_active', true)->get();
        return view('backend.localgovernment.index', compact('localGovernments', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        LocalGovernment::create([
            'title' => $request->title,
            'district_id' => $request->district_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.local-governments.index')
            ->with('success', 'Local Government created successfully.');
    }

    public function update(Request $request, LocalGovernment $localGovernment)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
        ]);

        $localGovernment->update([
            'title' => $request->title,
            'district_id' => $request->district_id,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.local-governments.index')
            ->with('success', 'Local Government updated successfully.');
    }

    public function updateStatus(Request $request, LocalGovernment $localGovernment)
    {
        $localGovernment->update([
            'is_active' => $request->is_active
        ]);

        return redirect()->route('admin.local-governments.index')
            ->with('success', 'Local Government status updated successfully.');
    }

    public function destroy(LocalGovernment $localGovernment)
    {
        $localGovernment->delete();

        return redirect()->route('admin.local-governments.index')
            ->with('success', 'Local Government deleted successfully.');
    }
}