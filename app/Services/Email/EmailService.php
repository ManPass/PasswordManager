<?php


namespace App\Services\Email;


use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendRegistrationConfirmMessage($login,$token){
        Mail::to($login)->send(new ConfirmEmail('http://localhost:8000/auth/registration-confirm?token='.$token));
    }
    public function sendChangePasswordMessage($token){
        //..
    }
}
