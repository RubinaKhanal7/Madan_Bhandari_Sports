<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MemberType;
use Illuminate\Http\Request;

class MemberTypeController extends Controller
{
    public function index()
    {
        $memberTypes = MemberType::all();
        return view('backend.member_types.index', compact('memberTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'nullable|boolean', // Validate is_active field
        ]);

        // Handle is_active checkbox input
        $is_active = $request->has('is_active') ? true : false;

        MemberType::create([
            'title' => $request->input('title'),
            'is_active' => $is_active,
        ]);

        return redirect()->route('admin.member_types.index')->with('success', 'Member Type created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'nullable|boolean', // Validate is_active field
        ]);

        $memberType = MemberType::findOrFail($id);

        // Handle is_active checkbox input
        $is_active = $request->has('is_active') ? true : false;

        $memberType->update([
            'title' => $request->input('title'),
            'is_active' => $is_active,
        ]);

        return redirect()->route('admin.member_types.index')->with('success', 'Member Type updated successfully!');
    }

    public function toggleStatus(MemberType $memberType)
    {
        $memberType->is_active = !$memberType->is_active;
        $memberType->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function destroy($id)
    {
        $memberType = MemberType::findOrFail($id);
        $memberType->delete();

        return redirect()->route('admin.member_types.index')->with('success', 'Member Type deleted successfully!');
    }
}
