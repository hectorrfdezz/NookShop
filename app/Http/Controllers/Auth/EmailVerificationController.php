<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/**
 * Manage email verification.
 *
 * This controller shows the verification notice, handles signed verification
 * links, and allows resending of the verification email. It relies on
 * Laravel's built-in email verification logic via the
 * EmailVerificationRequest class.
 */
class EmailVerificationController extends Controller
{
    /**
     * Show the email verification notice.
     */
    public function notice()
    {
        return view('auth.verify-email');
    }

    /**
     * Mark the authenticated user's email address as verified.
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/')->with('success', 'Tu correo ha sido verificado correctamente.');
    }

    /**
     * Resend the email verification notification.
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'Se ha reenviado el enlace de verificación.');
    }
}