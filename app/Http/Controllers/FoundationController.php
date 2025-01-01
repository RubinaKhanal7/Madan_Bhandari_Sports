<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoundationController extends Controller
{

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'datePlace' => 'required|string|max:500',
            'eventDescription' => 'required|string|max:1000',
            'suggestions' => 'nullable|string|max:1000',
        ]);

        try {
            $verificationToken = Str::random(32);

            $voluntary = Voluntary::create(array_merge($validatedData, [
                'verification_token' => $verificationToken,
                'status' => 'Pending',
            ]));

            // Queue email if email is provided
            if (!empty($validatedData['email'])) {
                Mail::to($validatedData['email'])->queue(new VoluntarySubmission($validatedData, $verificationToken));
            }

            return redirect()->back()->with('success', 'Your report has been submitted.');
        } catch (\Illuminate\Mail\TransportException $e) {
            Log::error('Mail transport error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was a problem submitting your report. Please try again later.');
        } catch (\Exception $e) {
            Log::error('General error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was a problem submitting your report.');
        }
    }

    /**
     * Verify the email address using the token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail($token)
    {
        $voluntary = Voluntary::where('verification_token', $token)->first();

        if ($voluntary) {
            $voluntary->update([
                'verified_at' => now(),
                'verification_token' => null,
            ]);

            return redirect()->route('portal.email.show')->with('success', 'Email verified successfully.');
        }

        return redirect()->route('portal.email.show')->with('error', 'Invalid verification link.');
    }

    /**
     * Remove the specified voluntary record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
}
