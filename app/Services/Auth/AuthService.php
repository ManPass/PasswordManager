<?php


namespace App\Services\Auth;


use App\Models\Expectant;
use App\Models\User;
use App\Policies\AuthPolice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthService
{
    protected $authPolice;//проверяет всю логику доступа юзера

    public function __construct(AuthPolice $authPolice){
        $this->authPolice = $authPolice;

    }

    /**
     * @param Request $request
     * @return bool
     */
    public function registrationValid(Request $request):bool{
        if ($this->authPolice->uniqueLogin($request->input('login')) == false)
            return false;
        else
            $user = User::create(
                [
                    'login' => $request->input('login'),
                    'password' => Hash::make($request->input('password'))
                ]
            );
            $user->save();
            /**
             *заготовка для регистрации с подтверждением логина, замена для кода выше
             *сохраняет введенные данные пользователя в ожидателя, на почту отправляется
             *ссылка на подобии localhost:8000/registration-confirm-{{token}}, будет
             *ссылка будет является временной, если срок истем то Link not valid
            */
            $userQueue = Expectant::create([
                'login' => $request->input('login'),
                'password' => Hash::make($request->input('password')),
                'token'=> Hash::make(Str::random(60))
            ]);
            $userQueue->save();

            return true;
    }
    public function loginValid(Request $request ){
        $user = $this->authPolice->userExists($request);//проверка введенных данных
        if ($user == null) return null;
        return $user;
    }

}
