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
use Illuminate\Validation\Rules\Password;

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
            'email' => 'nullable|string|email|max:255|unique:users',
            'phonenumber' => 'required|string|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => [
                'nullable',
                'string',
                Password::min(8),
                'confirmed'
            ],
            'pin' => [
                'nullable',
                'string',
                'size:4',
                'regex:/^[0-9]+$/',
                'confirmed'
            ],], [
                'pin.confirmed' => 'PIN confirmation does not match',
                'password.confirmed' => 'Password confirmation does not match',
                'pin.digits' => 'PIN must be exactly 6 digits',
                'password.min' => 'Password must be at least 8 characters'
        ]);

        // Custom validation to ensure either password or PIN is provided
        $validator->after(function ($validator) use ($request) {
            if (empty($request->password) && empty($request->pin)) {
                $validator->errors()->add('auth', 'Either Password or PIN must be provided');
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'phonenumber' => $request->phonenumber,
                'created_by_admin' => true, 
                'is_approved' => true, 
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            if ($request->filled('pin')) {
                $userData['pin'] = Hash::make($request->pin);
            }

            User::create($userData);

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
            
            // Only allow approval of self-registered users
            if ($user->created_by_admin) {
                return redirect()->back()->with('error', 'Admin-created users do not need approval.');
            }
            
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