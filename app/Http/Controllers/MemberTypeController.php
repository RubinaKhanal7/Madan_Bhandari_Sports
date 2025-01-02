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
        ]);

        MemberType::create($request->all());

        return redirect()->route('admin.member_types.index')->with('success', 'Member Type created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $memberType = MemberType::findOrFail($id);
        $memberType->update($request->all());

        return redirect()->route('admin.member_types.index')->with('success', 'Member Type updated successfully!');
    }

    public function destroy($id)
    {
        $memberType = MemberType::findOrFail($id);
        $memberType->delete();

        return redirect()->route('admin.member_types.index')->with('success', 'Member Type deleted successfully!');
    }
}
