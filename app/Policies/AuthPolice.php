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

}
