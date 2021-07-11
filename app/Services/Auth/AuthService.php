<?php


namespace App\Services\Auth;


use App\Http\Requests\ChangePasswordRequest;
use App\Models\Expectant;
use App\Models\User;
use App\Policies\AuthPolice;
use App\Services\Email\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function createUser($registrationToken):bool{
        $tempData = Expectant::where('token', $registrationToken)->first();
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
    public function resetPasswordValid($request,EmailService $emailService){
        if (!$this->authPolice->uniqueLogin($request->input('login')) == true){
            $token = Hash::make(Str::random(60));
            $resetPasswordQueue = Expectant::create([
                'login' => $request->input('login'),
                'password' => 'null',
                'token'=> $token
            ]);
            $resetPasswordQueue->save();

            $emailService->sendResetPasswordMessage($request->input('login'),$token);
            return true;
        }
        return false;
    }
    public function changePassword(Request $request):bool{
        $tempData = Expectant::where('token', $request->input('reset_token'))->first();
        if($tempData == null) return false;
        if ($request->input('password')!= $request->input('password_confirm'))
            return false;
        $user = User::where('login',$tempData->login)->first();
        $user->fill(['password'=>Hash::make($request->input('password'))]);

        $user->save();
        $tempData->delete();
        return true;
    }

}
