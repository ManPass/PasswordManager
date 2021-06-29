<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\MailChangeRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\User;
use App\Services\Account\ProfileService;
//use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class ProfileController extends Controller
{
    protected $user;
    protected $profileService;

    public function __construct(User $user, ProfileService $profileService)
    {
        $this->user = $user;
        $this->profileService = $profileService;
    }

    public function viewProfile()
    {
        return view('profile', ['data' => $this->profileService->getUser()]);
    }

    public function viewMailChange(){
        return view('change-mail', ['data' => $this->profileService->getUser()]);
    }
    public function viewPasswordChange(){
        return view('change-password', ['data' => $this->profileService->getUser()]);
    }

    public function changeMail(MailChangeRequest $request){
        if ($this->profileService->checkPassword($request) == true){
            if ($this->profileService->changeMail($request) == true)
                return redirect()->route('profile-data')->with('message','Почта изменена');
            else
                return redirect()->route('change-mail',$this->profileService->getUser())->with('message','Данная почта уже существует');

        } else return redirect()->route('change-mail',$this->profileService->getUser())->with('message','Неверный пароль');
    }


    public function changePassword($id, PasswordChangeRequest $request){
        if ($this->profileService->checkPassword($request) == true){
            if ($this->profileService->changePassword($request) == true)
                return redirect()->route('profile-data')->with('message','Пароль изменён');
            else
                return redirect()->route('change-password',$this->profileService->getUser())->with('message','Пароли не совпадают');

        } else return redirect()->route('change-password',$this->profileService->getUser())->with('message','Неверный пароль');


    }






}
