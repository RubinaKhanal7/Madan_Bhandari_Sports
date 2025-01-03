<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['verify']); 
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Handle the email verification process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $user = \App\Models\User::find($request->route('id'));
    
        if (!$user) {
            Log::error('User not found during verification');
            return redirect()->route('login')->with('error', 'Invalid verification link.');
        }
    
        // Check if the user has already verified their email
        if ($user->hasVerifiedEmail()) {
            Log::info('User attempted to verify an already verified email: ', ['user' => $user->email]);
            return redirect()->route('login')->with('message', 'Your email is already verified. Please login.');
        }
    
        // Attempt to mark email as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
            Log::info('User email verified successfully: ', ['user' => $user->email]);
            
            // Log out the user if they're logged in
            Auth::logout();
    
            return redirect()->route('login')
                           ->with('verified', true)
                           ->with('message', 'Your email has been verified successfully. Please login to continue.');
        } else {
            Log::error('Email verification failed for user: ', ['user' => $user->email]);
            return redirect()->route('login')
                           ->with('error', 'Your email could not be verified. Please try again.');
        }
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath())->with('message', 'Your email is already verified.');
        }

        $request->user()->sendEmailVerificationNotification();

        Log::info('Verification email resent: ', ['user' => $request->user()->email]);

        return back()->with('resent', true)
                    ->with('message', 'A fresh verification link has been sent to your email address.');
    }
}