<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
    
        return view('backend.roles.index', compact('roles', 'permissions'));
    }
    

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');
    
        $role->syncPermissions($permissions);
    
        return redirect()->back()->with('success', 'Role created successfully!');
    }
    
    public function update(Request $request, $id)
{
    $role = Role::findById($id);
    $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');

    $role->syncPermissions($permissions);

    return redirect()->back()->with('success', 'Role updated successfully!');
}



    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}

