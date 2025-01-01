<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamMembers = Team::paginate(10);
        return view('backend.team.index', compact('teamMembers'));
    }


    public function orderIndex(){
        $teams = Team::orderBy('order')->get();
    
        return view('backend.team.order', ['teams' => $teams, 'page_title' =>'Team']);
    
    }
    
    
    
    
        public function updateOrder(Request $request)
    {
    
        // dd($request);
        $teamOrders = $request->input('teamOrders');
        // $teamName = $request->input('teamName');
    
        foreach($teamOrders as $order => $teamId){
            $team = Team::findOrFail($teamId);
            $team->order = $order +1;
            $team->save();
        }
        
    
        // $team->name = $teamName;
      
    
        // return response()->json(['message' => 'Team order updated successfully']);
        return redirect()->route('admin.team.orderindex')->with(['message' => 'Team order updated successfully']);
    
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
            'role' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'boolean|required',
        ]);

        try {
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/team'), $imageName);
            }

            Team::create([
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'phone_no' => $request->input('phone_no'),
                'role' => $request->input('role'),
                'email' => $request->input('email'),
                'description' => $request->input('description'),
                'image' => $imageName,
                'status' => $request->input('status'),
            ]);

            return redirect()->route('admin.teams.index')->with('success', 'Team member created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while saving the team member.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('backend.team.update', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_no' => 'required|string|max:20',
            'role' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' =>'boolean|required'
        ]);

        try {
            $team = Team::find($id);


            $imageName = $team->image;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/team'), $imageName);
            }

            $team->update([
                'name' => $request->input('name'),
                'position' => $request->input('position'),
                'phone_no' => $request->input('phone_no'),
                'role' => $request->input('role'),
                'email' => $request->input('email'),
                'description' => $request->input('description'),
                'image' => $imageName,
                'status' => $request->input('status'),
            ]);

            return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the team member.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teamMember = Team::findOrFail($id);
        $teamMember->delete();
    
        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully.');
    }
}
