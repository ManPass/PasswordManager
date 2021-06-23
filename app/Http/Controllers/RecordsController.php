<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecordsRequest;
use App\Models\Records;
use App\Models\RoleRecord;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\users;
use Illuminate\Http\RedirectResponse;

class RecordsController extends Controller
{
    public function addRecord(RecordsRequest $req)
    {
        $roleId = $req->cookie('p');
        $userRoleId = UserRole::all()->where('user_id', $req->cookie('u'))
            ->where('role_id', $roleId)->first()->id;
        //dd($userRoleId);
        $record = Records::create(
            [
                'source' => $req->source,
                'password' => encrypt($req->pass),
                'login' => $req->login_rec,
                'url' => $req->url,
                'comment' => $req->comment,
                'tag' => $req->tag
            ]
        );

        $roleRecord = RoleRecord::create(
            [
                'user_role_id' => $userRoleId,
                'records_id' => $record->id
            ]
        );

        /*$record = new Records();
        $record->source = $request->input('source');
        $record->password = encrypt($request->input('pass'));
        $record->login = $request->input('login_rec');
        $record->url = $request->input('url');
        $record->comment = $request->input('comment');
        $record->tag = $request->input('tag');
*/
        $record->save();
        $roleRecord->save();


        return redirect()->route('records-data')->withCookie($roleId);
    }

    public function showRecord($id)
    {
        return view('show', ['data' => Records::find($id)]);
    }

    public function searchRecord(Request $req)
    {
        if($req->choose === null)
        {
            return view('myInfo', ['data' => []]);
        }
        $searchRecords = Records::where($req->choose, 'LIKE', "%{$req->search}%")->orderby('source')->paginate(10);
        return view('myInfo', ['data' => $searchRecords]);
    }

    public function updateSubmit($id, RecordsRequest $request)
    {
        $record = Records::find($id);
        $record->source = $request->input('source');
        $record->password = encrypt($request->input('pass'));
        $record->login = $request->input('login_rec');
        $record->url = $request->input('url');
        $record->comment = $request->input('comment');
        $record->tag = $request->input('tag');

        $record->save();

        return redirect()->route('records-data');
    }

    public function showAllRecords(Request $req)
    {
        $role_id = $req->cookie('p');

        //Получение id UserRole текущего пользователя и его текущей роли
        $urId = UserRole::all()->where('user_id', $req->cookie('u'))
            ->where('role_id', $role_id)->first()->id;

        //Получение всех RoleRecord по id UserRole
        $roleRecords = RoleRecord::all()->where('user_role_id', $urId);
        $records = [];

        //Получение всех записей текущей роли
        foreach($roleRecords as $rr)
        {
            $records = Records::where('id', $rr->records_id)->orderby('source')->paginate(10);
        }

        //Получение ролей для выпадающего списка
        $roles = $this->getRoles($req);
        return view("myInfo", ['data' => $records, 'roles' => $roles]);
    }

    public function editRecord($id){
        return view('edit', ['data' => Records::find($id)]); //по айдишнику переходим на редактирование записи
    }

    public function deleteRecord($id){
        Records::find($id)->delete();
        return redirect()->route('records-data');
    }

    private function getUserRoles(Request $req)
    {
        return users::find($req->cookie('u'))->userRoles;
    }

    //Получение ролей
    private function getRoles(Request $req)
    {
        //Получаем все UserRole'ы
        $userRoles = $this->getUserRoles($req);
        $roles = [];
        for($i = 0; $i < count($userRoles); $i++)
        {
            //Поиск всех ролей, привязанных к юзеру и преобразование в массив
            $roles[$i] = Role::find($userRoles[$i]["role_id"])->toArray();
        }

        return $roles;
    }
}
