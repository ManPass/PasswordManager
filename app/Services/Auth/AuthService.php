<?php


namespace App\Services\Auth;


use App\Models\Expectant;
use App\Models\User;
use App\Policies\AuthPolice;
use App\Services\Email\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthService
{
    protected $authPolice;//проверяет всю логику доступа юзера

    public function __construct(AuthPolice $authPolice){
        $this->authPolice = $authPolice;//является зависимостью для класса AuthService, поэтому иньъекция через конструктор
    }
    /**
     * @param Request $request
     * @return bool
     */
    public function createUser($RegistrationToken):bool{
        $tempData = Expectant::where('token', $RegistrationToken)->first();
        if($tempData == null) return false;
        else {
            $user = User::create(
                [
                    'login' => $tempData->login,
                    'password' => $tempData->password
                ]
            );
            $user->save();
            $tempData->delete();
            return true;
        }
    }
    public function registrationValid(Request $request,EmailService $emailService):bool{
        if ($this->authPolice->uniqueLogin($request->input('login')) == false)
            return false;

            $token = Hash::make(Str::random(60));

            $userQueue = Expectant::create([
                'login' => $request->input('login'),
                'password' => Hash::make($request->input('password')),
                'token'=> $token
            ]);
            $userQueue->save();

            $emailService->sendRegistrationConfirmMessage($request->input('login'),$token);//отправка подтверждения регистрации

            return true;
    }
    public function getUserByVerifivation(Request $request){
        return $this->authPolice->userExists($request);
    }
    public function loginValid(Request $request ){
        return $this->authPolice->uniqueLogin($request->input('login'));
    }

}
