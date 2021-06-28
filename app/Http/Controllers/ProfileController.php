<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\MailChangeRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\Contact;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class ProfileController extends Controller
{
    /*public function profileView(){
        $users = Users::all();
        dd($users);

    }*/

    public function viewProfile(Request $request)
    {
        $users = User::find($request->cookie('u'));
        return view('profile', ['data' => User::find($request->cookie('user_id'))]);
    }

    public function viewChange1($id){
        return view('change-mail', ['data' => User::find($id)]);
    }
    public function viewChange2($id){
        return view('change-password', ['data' => User::find($id)]);
    }

    public function changeMail($id, MailChangeRequest $request){
        $user = User::find($id);
        if (Hash::check($request->input('password'),$user->password)){
            foreach(User::all() as $user_el){
                if ($request->input('email') === $user_el->login)

                    return redirect()->route('change-mail', $id)->with("message","Такой адрес электронной почты уже существует");
            }

            $user = User::find($id);
            $user->login = $request->input('email');
            $user->save();

            return redirect()->route('profile-data')->with("message","Адрес эл. почты изменён");
        }
        else {
            return redirect()->route('change-mail', $id)->with("message","Неверный пароль");
        }

    }

    public function changePassword($id, PasswordChangeRequest $request){
        $user = User::find($id);
        if (Hash::check($request->input('password1'),$user->password)){
            if ($request->input('password2')===$request->input('password3')){
                $user = User::find($id);
                $user->password = Hash::make($request->input('password2'));
                $user->save();
                return redirect()->route('profile-data')->with("message","Пароль изменён");
            } else {
            return redirect()->route('change-password', $id)->with("message","Пароли не совпадают");
            }
        }
        else {
            return redirect()->route('change-password', $id)->with("message","Неверный пароль");
        }

    }






}
