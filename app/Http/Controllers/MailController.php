<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {

    public static function reset_password($to, $code) {           
        Mail::send(['html' => 'email_template.reset_password'], ['code' => $code], function ($message) use ($to) {
            $message->to($to)->subject('BeeVU Account Reset Password');
            $message->from(config('mail.mailers.smtp.username'), 'BeeVU');
        });
    }

}
