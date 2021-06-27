<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;
use App\Models\Record;
use App\Models\RoleRecord;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    /*
     * Добавление новой записи
     */
    public function addRecord(RecordRequest $req): RedirectResponse
    {

        $roleId = $req->cookie('p');
        $userRoleId = UserRole::all()->where('user_id', $req->cookie('u'))
            ->where('role_id', $roleId)->first()->id;
        $record = Record::create(
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

        return redirect()->route('records-data');
    }

    //Показать конкретную запись
    public function showRecord($id)
    {
        return view('show', ['data' => Record::find($id)]);
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
            $searchRecords[$count] = Record::where('id', $rr->records_id)
                ->where($req->choose, 'LIKE', "%$req->search%")
                ->orderby('source')->paginate(10);
            $count++;
        }

        return view('myInfo', ['data' => $searchRecords, 'roles' => $this->getRoles($req)]);
    }

    //Редактирование записи
    public function updateRecord($id, RecordRequest $request): RedirectResponse
    {
        $record = Record::find($id);
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
        return view('edit', ['data' => Record::find($id)]); //по айдишнику переходим на редактирование записи
    }

    //Удаление записи
    public function deleteRecord($id): RedirectResponse
    {
        Record::find($id)->delete();
        return redirect()->route('records-data');
    }

    private function getRoles(Request $req)
    {
        return User::find($req->cookie('u'))->roles->all('id', $req->cookie('p')) ?? [];
    }

    //Получить RoleRecords
    private function getRoleRecords(Request $req)
    {
        $role_id = $req->cookie('p');
        $user = User::find($req->cookie('u'));

        $userRole = UserRole::all()->where('user_id', $req->cookie('u'))
            ->where('role_id', $role_id)->first();

        //Получение id UserRole текущего пользователя и его текущей роли

        if(isset($userRole))
        {
            $urId = UserRole::all()->where('user_id', $req->cookie('u'))
            ->where('role_id', $role_id)->first()->id;

            return RoleRecord::all()->where('user_role_id', $urId);
        }

        return [];
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
            $records[$count] = Record::where('id', $rr->records_id)->orderBy('source')->paginate(10);
            $count++;
        }

        return $records;
    }
}
