<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class EmailController extends Controller{
    public function test(){
        /* рассылка текстов
        Mail::send(['text'=>'Email/ConfirmEmail'],['name','Web'],function ($message){
            $message->to('laravelprovider@gmail.com','To web')->subject('Test email');
            $message->from('laravelprovider@gmail.com','web blog');
        });
        */

        Mail::to('laravelprovider@gmail.com')->send(new ConfirmEmail('http://localhost:8000/login'));
    }
}
