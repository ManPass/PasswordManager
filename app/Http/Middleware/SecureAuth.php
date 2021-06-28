<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class SecureAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        //можно сделать полноценную проверку из базы с поиском совпадений, а не просто присутствие куков
        //находим юзера по айди из куков
        //dd($user);

        if ($request->hasCookie('token') != false && $request->hasCookie('login') != false &&
            $request->hasCookie('user_id') != false){//если куки найдены

            $user = User::find($request->cookie('user_id'));//ищем юзера по кукам

            $session = Hash::check($request->cookie('token'),$user->remember_token);//сравниваем хэш токена в куках и в базе для аутендификации
            if($session){          //если все норм то даем доступ дальше
                $request->request->add(['loginAcc'=> $request->cookie('login')]);
                return $next($request);
            }
        }
        //если куки были подменены или удалены то отправляем на перелогин
            return redirect()->route('login');

    }

}
