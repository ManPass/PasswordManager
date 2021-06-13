<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
class ContactController extends Controller
{
    public function submith(ContactRequest $req){
        //$validaton = $req->validate([
        //    'password' => 'required|min:5|max:15',
        //    'email' => 'required|email'
        //]);
        return "Your registration was successful";
    }
}
