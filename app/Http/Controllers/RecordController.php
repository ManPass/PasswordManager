<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;
use App\Models\Record;
use Illuminate\Http\RedirectResponse;
use App\Services\RecordService;

class RecordController extends Controller
{
    protected $record;

    protected $recordService;

    public function __construct(Record $record, RecordService $recordService)
    {
        $this->record = $record;
        $this->recordService = $recordService;
    }
    /*
     * Добавление новой записи
     */
    public function addRecord(RecordRequest $req): RedirectResponse
    {
        $record = Record::create(
            [
                'source' => $req->source,
                'password' => $req->pass,
                'login' => $req->login_rec,
                'url' => $req->url,
                'comment' => $req->comment,
                'tag' => $req->tag
            ]
        );
        if(request()->personal)
        {
            $this->recordService->addPersonalRecord($record);
        }
        else
        {
            $record->roles()->attach($req->cookie('role_id'));
        }
        

        return redirect()->route('records-data');
    }

    //Показать конкретную запись
    public function showRecord($id)
    {
        return view('show', ['data' => $this->recordService->getRecord($id)]);
    }

    //Поиск записей
    public function searchRecord(Request $req)
    {
        return view('myInfo',
            [
                'records' => $this->recordService->getRecords()->where($req->choose, $req->search),
                'personal' => $this->recordService->getPersonalRecords()->where($req->choose, $req->search),
                'roles' => $this->recordService->getRoles()
            ]);
    }

    //Редактирование записи
    public function updateRecord($id, RecordRequest $request): RedirectResponse
    {
        $record = $this->recordService->getRecord($id);
        $record->source = $request->input('source');
        $record->password = $request->input('pass');
        $record->login = $request->input('login_rec');
        $record->url = $request->input('url');
        $record->comment = $request->input('comment');
        $record->tag = $request->input('tag');

        $record->save();

        return redirect()->route('records-data');
    }

    //Показ всех записей
    public function showAllRecords()
    {
        return view("myInfo", [
            'records' => $this->recordService->getRecords(),
            'personal' => $this->recordService->getPersonalRecords(),
            'roles' => $this->recordService->getRoles()
        ]);
    }

    //Переход на редактирование записи
    public function editRecord($id){
        return view('edit', ['data' => $this->recordService->getRecord($id)]); //по айдишнику переходим на редактирование записи
    }

    //Удаление записи
    public function deleteRecord($id): RedirectResponse
    {
        $this->recordService->getRecord($id)->delete();
        return redirect()->route('records-data');
    }
}
