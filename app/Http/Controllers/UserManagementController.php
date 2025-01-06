<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\AccountApproved;
use Illuminate\Support\Facades\Log;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('backend.usermanagement.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'User created successfully');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error creating user: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }
    public function approve($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update(['is_approved' => true]);
            
            try {
                $user->notify(new AccountApproved());
                Log::info('Approval notification sent to user:', ['user_id' => $user->id, 'email' => $user->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send approval notification:', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
                return redirect()->back()->with('error', 'User approved but failed to send notification email.');
            }
            
            return redirect()->back()->with('success', 'User has been approved successfully and notification sent.');
            
        } catch (\Exception $e) {
            Log::error('Failed to approve user:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to approve user.');
        }
    }

}