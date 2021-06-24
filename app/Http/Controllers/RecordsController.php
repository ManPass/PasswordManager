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
    //============public==========================================================
    /*
     * Добавление новой записи
     */
    public function addRecord(RecordsRequest $req): RedirectResponse
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

        $record->save();
        $roleRecord->save();

        return redirect()->route('records-data')->withCookie($roleId);
    }

    //Показать конкретную запись
    public function showRecord($id)
    {
        return view('show', ['data' => Records::find($id)]);
    }

    //Поиск записей
    public function searchRecord(Request $req)
    {
        if($req->choose === null || $req->search == null)
        {
            return redirect()->route('records-data')->with("message", "Choose search");
        }
        $roleRecords = $this->getRoleRecords($req);
        $searchRecords = [];
        $count = 0;
        foreach($roleRecords as $rr)
        {
            $searchRecords[$count] = Records::where('id', $rr->records_id)
                ->where($req->choose, 'LIKE', "%$req->search%")
                ->orderby('source')->paginate(10);
            $count++;
        }

        return view('myInfo', ['data' => $searchRecords, 'roles' => $this->getRoles($req)]);
    }

    //Редактирование записи
    public function updateSubmit($id, RecordsRequest $request): RedirectResponse
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

    //Показ всех записей
    public function showAllRecords(Request $req)
    {
        return view("myInfo", ['data' => $this->getRecords($req), 'roles' => $this->getRoles($req)]);
    }

    //Переход на редактирование записи
    public function editRecord($id){
        return view('edit', ['data' => Records::find($id)]); //по айдишнику переходим на редактирование записи
    }

    //Удаление записи
    public function deleteRecord($id): RedirectResponse
    {
        Records::find($id)->delete();
        return redirect()->route('records-data');
    }

    //===========================private=============================

    //Получить userrole текущего пользователя текущей роли
    private function getUserRoles(Request $req)
    {
        return users::find($req->cookie('u'))->userRoles;
    }

    //Получение ролей
    private function getRoles(Request $req): array
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

    //Получить RoleRecords
    private function getRoleRecords(Request $req)
    {
        $role_id = $req->cookie('p');

        $userRole = UserRole::all()->where('user_id', $req->cookie('u'))
            ->where('role_id', $role_id)->first();

        //Получение id UserRole текущего пользователя и его текущей роли

        if(isset($userRole))
        {
            $urId = UserRole::all()->where('user_id', $req->cookie('u'))
            ->where('role_id', $role_id)->first()->id;

            return RoleRecord::all()->where('user_role_id', $urId);
        }

        return null;
    }

    //Получить все записи
    private function getRecords(Request $req): array
    {
        $roleRecords = $this->getRoleRecords($req);

        if(!isset($roleRecords))
        {
            return [];
        }

        $records = [];

        //Получение всех записей текущей роли
        $count = 0;
        foreach($roleRecords as $rr)
        {
            $records[$count] = Records::where('id', $rr->records_id)->orderBy('source')->paginate(10);
            $count++;
        }

        return $records;
    }
}
