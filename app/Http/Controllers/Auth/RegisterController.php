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
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
{
    $messages = [
        'name.required' => 'Your full name is required.',
        'name.string' => 'Name must be text only.',
        'name.max' => 'Name cannot be longer than 255 characters.',
        
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        
        'phonenumber.required' => 'Phone number is required.',
        'phonenumber.regex' => 'Please enter a valid phone number.',
        'phonenumber.min' => 'Phone number must be at least 10 digits.',
        'phonenumber.unique' => 'This phone number is already registered.',
        
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Password confirmation does not match.',
        
        'pin.size' => 'PIN must be exactly 4 digits.',
        'pin.regex' => 'PIN must contain only numbers.',
        'pin.confirmed' => 'PIN confirmation does not match.',
        
        'citizenship_front.required' => 'Front side of citizenship is required for admin registration.',
        'citizenship_front.image' => 'Front citizenship must be an image file (jpg, jpeg, png).',
        'citizenship_front.mimes' => 'Front citizenship must be a jpeg, png, or jpg file.',
        'citizenship_front.max' => 'Front citizenship image must not be larger than 2MB.',
        
        'citizenship_back.required' => 'Back side of citizenship is required for admin registration.',
        'citizenship_back.image' => 'Back citizenship must be an image file (jpg, jpeg, png).',
        'citizenship_back.mimes' => 'Back citizenship must be a jpeg, png, or jpg file.',
        'citizenship_back.max' => 'Back citizenship image must not be larger than 2MB.',
    ];

    $rules = [
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
        'is_admin' => ['nullable', 'boolean']
    ];

    if (!empty($data['is_admin']) && $data['is_admin'] == 1) {
        $rules['citizenship_front'] = [
            'required',
            'file',  // Add this
            'image',
            'mimes:jpeg,png,jpg',
            'max:2048'
        ];
        $rules['citizenship_back'] = [
            'required',
            'file',  // Add this
            'image',
            'mimes:jpeg,png,jpg',
            'max:2048'
        ];
    }

    return Validator::make($data, $rules, $messages);
}

// Update the register method
public function register(Request $request)
{
    try {
        $validator = $this->validator($request->all());
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->has('is_admin') && $request->is_admin == 1) {
            if (!$request->hasFile('citizenship_front') || !$request->hasFile('citizenship_back')) {
                return redirect()->back()
                    ->withErrors(['citizenship' => 'Both citizenship front and back images are required for admin registration'])
                    ->withInput();
            }
        }

        DB::beginTransaction();

        $user = $this->create($request->all());

        if ($request->has('is_admin') && $request->is_admin == 1) {
            try {
                $frontPath = $request->file('citizenship_front')->store('upload/citizenships', 'public');
                $backPath = $request->file('citizenship_back')->store('upload/citizenships', 'public');
                
                $user->citizenship_front = $frontPath;
                $user->citizenship_back = $backPath;
                $user->save();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->withErrors(['image_upload' => 'Failed to upload citizenship images. Please try again.'])
                    ->withInput();
            }
        }

        DB::commit();
        
        event(new Registered($user));
        Auth::login($user);
        
        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')
                    ->with('success', 'Registration successful! A verification link has been sent to your email.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->withErrors(['general' => 'Registration failed. Please try again.'])
            ->withInput();
    }
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
            'is_admin' => !empty($data['is_admin']) ? true : false,
        ];

        if (!empty($data['pin'])) {
            $userData['pin'] = Hash::make($data['pin']);
        }

        return User::create($userData);
    }
}