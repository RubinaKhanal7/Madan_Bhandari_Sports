<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        event(new Registered($user));

        Auth::login($user);
        
        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')
                    ->with('message', 'A verification link has been sent to your email.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phonenumber' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'unique:users'],
            'password' => [
                'required',
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
            ],
        ]);
    }

    protected function create(array $data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phonenumber' => $data['phonenumber'],
            'password' => Hash::make($data['password']),
            'created_by_admin' => false,
            'is_approved' => false,
        ];

        if (!empty($data['pin'])) {
            $userData['pin'] = Hash::make($data['pin']);
        }

        return User::create($userData);
    }

    public function redirectPath()
    {
        return $this->redirectTo;
    }
}