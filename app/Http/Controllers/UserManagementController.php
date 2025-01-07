<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phonenumber' => 'required|string',
            'password' => 'nullable|min:8|required_without:pin|confirmed',
            'pin' => 'nullable|digits:4|required_without:password|confirmed',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phonenumber' => $request->phonenumber,
            ];

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            } elseif ($request->pin) {
                $data['password'] = Hash::make($request->pin); // Hash the pin as well
            }

            User::create($data);

            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'Something went wrong, please try again.');
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
            return redirect()->back()->with('error', 'Something went wrong while approving the user.');
        }
    }
}
