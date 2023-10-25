<?php

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show()
    {
        // Logic to show the email verification notice
    }

    public function verify(Request $request, $id)
    {
        // Logic to handle email verification
        $student = Student::findOrFail($id);
        if ($student->hasVerifiedEmail()) {
            // Redirect as the email has already been verified
        }

        if ($student->markEmailAsVerified()) {
            event(new Verified($student));
        }

        // Redirect with success message
    }

    public function sendVerificationEmail(Request $request)
    {
        // Logic to send the email verification notification
        $request->user()->sendEmailVerificationNotification();

        // Redirect with success message
    }
}