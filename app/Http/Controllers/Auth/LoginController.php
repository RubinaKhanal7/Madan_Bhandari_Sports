<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'showLoginForm']);
    }

    /**
     * Show the application's login form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        // If force_logout is true and user is logged in, log them out
        if ($request->query('force_logout') === 'true') {
            if (Auth::check()) {
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();
                return redirect()->route('login')
                    ->with('info', 'Please log in to access your account.');
            }
        }

        // If user is already logged in, log them out (for approval email case)
        if (Auth::check()) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect()->route('login')
                ->with('info', 'Please log in to access your account.');
        }

        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */


     public function login(Request $request)
     {
         // Validate input (either email/phone number and password or pin)
         $request->validate([
             'login_field' => 'required|string',
             'password' => 'required|string',
         ]);
     
         // Check if the input is an email or phone number
         $loginField = filter_var($request->login_field, FILTER_VALIDATE_EMAIL) ? 'email' : 'phonenumber';
     
         // Check if the password is a PIN (numeric check)
         $isPin = is_numeric($request->password);
     
         // Attempt login using either email/phone number and password or pin
         if ($isPin) {
             // If it's a PIN, check the pin column directly
             $user = User::where($loginField, $request->login_field)->first();
     
             // Check if user exists and the hashed PIN matches
             if ($user && Hash::check($request->password, $user->pin)) {
                 Auth::login($user, $request->remember);
                 return redirect()->intended($this->redirectTo);
             }
         } else {
             // If it's a password, proceed with the normal authentication check
             if (Auth::attempt([$loginField => $request->login_field, 'password' => $request->password], $request->remember)) {
                 $user = Auth::user();
                 if (!$user->is_approved) {
                     Auth::logout();
                     return redirect()->route('login')->withErrors(['login_field' => 'Please wait for the admin to approve your account.']);
                 }
                 return redirect()->intended($this->redirectTo);
             }
         }
     
         // If login fails for either PIN or password, show error
         return back()->withErrors(['login_field' => 'These credentials do not match our records.']);
     }     


    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // If the user's account is not approved, log them out and redirect to login page
        if (!$user->is_approved) {
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('error', 'Your account is pending approval from the administrator.');
        }

        // Redirect to the intended page or the default redirect path
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
}
