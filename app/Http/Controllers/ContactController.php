<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('backend.contact.index', [
            'contacts' => $contacts,
            'page_title' => 'Contact Us'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email',
                'phone_no' => 'required|string',
                'message' => 'required|string',
            ]);

            $verificationToken = Str::random(40);

            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'message' => $request->message,
                'verification_token' => $verificationToken,
            ]);

            // Get admin email from .env
            $adminEmail = env('ADMIN_EMAIL', 'info@saarcmusicfoundation.org');

            // Send verification email to the admin
            Mail::to($adminEmail)->send(new VerifyEmail($contact));

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Your message has been submitted successfully! An admin will verify it shortly.']);
            } else {
                return redirect()->back()->with('success', 'Your message has been submitted successfully! An admin will verify it shortly.');
            }
        } catch (\Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred while processing your request.'], 500);
            } else {
                return redirect()->back()->with('error', 'An error occurred while processing your request.')->withInput();
            }
        }
    }

    public function verifyEmail($token)
    {
        Log::info("Email verification attempt with token: $token");

        $contact = Contact::where('verification_token', $token)->first();

        if (!$contact) {
            Log::warning("Invalid verification token used: $token");
            return 'Invalid verification token.';
        }

        Log::info("Email verified for contact ID: {$contact->id}");

        $contact->update(['is_verified' => true, 'verification_token' => null]);

        return 'Email verified successfully! The contact submission has been approved.';
    }
}
