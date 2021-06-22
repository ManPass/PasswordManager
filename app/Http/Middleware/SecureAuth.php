<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\users;
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

        if ($request->hasCookie('tk') != false && $request->hasCookie('l') != false && $request->hasCookie('u') != false){//если куки найдены
            $user = users::find($request->cookie('u'));//ищем юзера по кукам
            $session = Hash::check($request->cookie('tk'),$user->remember_token);//сравниваем хэш токена в куках и в базе для аутендификации
            if($session){          //если все норм то даем доступ дальше
                $request->request->add(['login'=> $request->cookie('l')]);
                return $next($request);
            }
        }
        //если куки были подменены или удалены то отправляем на перелогин
            return redirect()->route('login');

    }

}
