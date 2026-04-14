<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Emailcontroller extends Controller
{
    public function sendEmail()
    {
        $toEmail = 'gaonkars193@gmail.com';
        $msg = 'This is a test email from Laravel.';
        $subject = 'Test Email from Laravel';

        $req = Mail::to($toEmail)->send(new WelcomeEmail($msg, $subject));
        if ($req) {
            return "Email sent successfully!";
        } else {
            return "Failed to send email.";
        }
    }
}
