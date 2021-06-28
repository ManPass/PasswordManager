<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Hash;

class AuthPolice
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *с
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function uniqueLogin(string $login):bool{
        foreach (User::all() as $user) {
            if ($login === $user->login)
                return false;
        }
        return true;
    }
    public function userExists(Request $request): ?User{
        $user = User::where('login',$request->input('login'))->first();
        if ($user == null) return null;
        if (Hash::check($request->input('password'),$user->password) == true)
            return $user;
        return null;
    }
    public function userValid(Request $request):?Request{
        if ($request->hasCookie('token') != false && $request->hasCookie('login') != false &&
            $request->hasCookie('user_id') != false){

            $user = User::find($request->cookie('user_id'));//ищем юзера по кукам
            $session = Hash::check($request->cookie('token'),$user->remember_token);

            if ($session==true){
                $data['loginAcc'] = $request->cookie('login');
                if ($this->extendedRights($user) == true)
                    $data['right'] = 'Admin';
                $request->request->add($data);
                return $request;
            }
        }
        return null;
    }
    public function adminValid(Request $request):?Request{
        if ($request->hasCookie('user_id') != false){
            $user = User::find($request->cookie('user_id'));
            if ($this->extendedRights($user)==true)
                return $request;
        }
        return null;
    }
    public function extendedRights(User $user):bool{
        $role = ($user->roles->where('role','Admin')->first());
        if ($role!= null){
            return true;
        }
        else return false;
    }

}
