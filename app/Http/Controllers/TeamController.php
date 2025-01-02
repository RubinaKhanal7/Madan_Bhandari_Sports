<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamType;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
            $teams = Team::with('teamType')->latest()->paginate();
            $teamTypes = TeamType::where('is_active', true)->get();
            return view('backend.team.index', compact('teams', 'teamTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_type_id' => 'required|exists:team_types,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);
    
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
    
        try {
            Team::create($validated);
    
            return redirect()->route('admin.teams.index')
                ->with('success', 'Team member added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to add team member. Please try again.')
                ->withInput();
        }
    }
    

    public function edit($id)
    {
            $team = Team::findOrFail($id);
            $teamTypes = TeamType::where('is_active', true)->get();
            return view('backend.team.edit', compact('team', 'teamTypes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'team_type_id' => 'required|exists:team_types,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);
    
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
    
        try {
            $team = Team::findOrFail($id);
            $team->update($validated);
    
            return redirect()->route('admin.teams.index')
                ->with('success', 'Team member updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update team member.')
                ->withInput();
        }
    }
    

    public function destroy($id)
    {
        try {
            $team = Team::findOrFail($id);
            $team->delete();
    
            return redirect()->route('admin.teams.index')
                ->with('success', 'Team member deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete team member.');
        }
    }
    
}