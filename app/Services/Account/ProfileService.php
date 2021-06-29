<?php

namespace App\Services\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    public function getUser()
    {
        return User::find(request()->cookie('user_id'));
    }
 
    public function checkPassword($request){
        $user = $this->getUser();
        if (Hash::check($request->input('password'),$user->password)) return true;
        else return false;
    }

    public function changeMail($request)
    {
        $user = $this->getUser();
        foreach(User::all() as $user_el){
            if ($request->input('email') === $user_el->login)
                return false;
            }

            $user->login = $request->input('email');
            $user->save();

            return true;
    }

    public function changePassword($request)
    {
        $user = $this->getUser();
        if ($request->input('passwordNew')===$request->input('passwordConfirm')){
            $user->password = Hash::make($request->input('passwordNew'));
            $user->save();
            return true;
        } else {
        return false;
        }
    }
    
}