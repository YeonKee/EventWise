<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller
{

    public static function verifyEmail($to, $studID)
    {
        Mail::send(['html' => 'emailTemplate.verifyEmail'], ['studID' => $studID], function ($message) use ($to) {
            $message->to($to)->subject('EventWise Email Verification');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });
    }

    public static function resentVerifyEmail($to, $studID)
    {
        Mail::send(['html' => 'emailTemplate.verifyEmail'], ['studID' => $studID], function ($message) use ($to) {
            $message->to($to)->subject('EventWise Email Verification');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });

        // Set a flash message
        Session::flash('emailSent', true);
    }

    public static function resetPassword($to, $code)
    {
        Mail::send(['html' => 'emailTemplate.resetPassword'], ['code' => $code], function ($message) use ($to) {
            $message->to($to)->subject('EventWise Account Reset Password');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });
    }
    
    public static function approveAppEmail($to, $title)
    {
        Mail::send(['html' => 'emailTemplate.approvedApp'], ['title' => $title], function ($message) use ($to) {
            $message->to($to)->subject('Appointment Approval');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });
    }

    public static function furtherDiscussEmail($to, $title)
    {
        Mail::send(['html' => 'emailTemplate.pendingApp'], ['title' => $title], function ($message) use ($to) {
            $message->to($to)->subject('Further Discussion on Appointment');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });
    }

    public static function cancelAppEmail($to, $title)
    {
        Mail::send(['html' => 'emailTemplate.cancelApp'], ['title' => $title], function ($message) use ($to) {
            $message->to($to)->subject('Cancellation on Appointment');
            $message->from(config('mail.mailers.smtp.username'), 'EventWise');
        });
    }

}