<?php


namespace App\Services\Email;


use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public $registrationConfirmLink='http://localhost:8000/auth/registration-confirm?token=';
    public $resetPasswordLink='http://localhost:8000/auth/password-reset?token';
    public function sendRegistrationConfirmMessage($login,$token){
        Mail::to($login)->send(new ConfirmEmail($this->registrationConfirmLink.$token));
    }
    public function sendResetPasswordMessage($login,$token){
        Mail::to($login)->send(new ConfirmEmail($this->resetPasswordLink.$token));
    }
}
