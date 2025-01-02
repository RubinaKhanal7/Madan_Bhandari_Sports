<?php

namespace App\Http\Controllers;

use App\Models\TeamType;
use Illuminate\Http\Request;

class TeamTypeController extends Controller
{
    public function index()
    {
        $teamTypes = TeamType::latest()->paginate(10);
        return view('backend.team_types.index', compact('teamTypes'));
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
        ]);

        TeamType::create([
            'title_ne' => $request->title_ne,
            'title_en' => $request->title_en,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.team-types.index')
            ->with('success', 'Team type created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withInput()
            ->withErrors(['error' => 'Failed to create team type. ' . $e->getMessage()]);
    }
}

    public function update(Request $request, TeamType $teamType)
    {
        $request->validate([
            'title_ne' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
        ]);

        $teamType->update([
            'title_ne' => $request->title_ne,
            'title_en' => $request->title_en,
            'is_active' => $request->has('is_active') 
        ]);

        return redirect()->route('admin.team-types.index')
            ->with('success', 'Team type updated successfully.');
    }

    public function destroy(TeamType $teamType)
    {
        $teamType->delete();
        return redirect()->route('admin.team-types.index')
            ->with('success', 'Team type deleted successfully.');
    }
}