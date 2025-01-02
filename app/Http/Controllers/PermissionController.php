<?php

namespace App\Http\Controllers;
use App\Models\Permission;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Display the list of permissions
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('backend.permissions.index', compact('permissions'));
    }

    // Show the form for creating a new permission
    public function create()
    {
        return view('permissions.create');
    }

    // Store a newly created permission in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required',
        ]);

        Permission::create($request->all());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    // Show the form for editing the specified permission
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    // Update the specified permission in storage
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required',
        ]);

        $permission->update($request->all());

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    // Remove the specified permission from storage
    public function destroy($id)
{
    $permission = Permission::findOrFail($id);
    $permission->delete();

    return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
}

}
