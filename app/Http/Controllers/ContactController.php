<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Users;
use App\Models\Role;

class ContactController extends Controller
{
    public function submith(ContactRequest $req){
        //$validaton = $req->validate([
        //    'password' => 'required|min:5|max:15',
        //    'email' => 'required|email'
        //]);
        $user = new Users();
        //$user->name = $req->input("name");
        $user->login = $req->input("email");
        $user->password = $req->input("password");
        
        //$user->RoleID = 3;//default

        $user->save();

        return redirect()->route('home');
    }
    public function myInfo(){
        return view("myInfo",["data" => Users::all(), "role" => Role::all()]);
    }
}
