<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\RecordRequest;
use App\Models\Record;
use Illuminate\Http\RedirectResponse;
use App\Services\Account\RecordService;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class RecordController extends Controller
{
    protected $recordService;

    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;
    }
    /*
     * Добавление новой записи
     */
    public function addRecord(RecordRequest $req): RedirectResponse
    {
        $record = Record::create($req->record);
        if(request()->personal)
        {
            $this->recordService->addPersonalRecord($record);
        }
        else
        {
            $record->roles()->attach(request()->cookie('role_id'));
        }

        return redirect()->route('records-data');
    }

    //Показать конкретную запись
    public function showRecord($id)
    {
        return view('show', ['data' => $this->recordService->getRecord($id)]);
    }

    //Поиск записей
    public function searchRecord()
    {
        return view('myInfo',
            [
                'records' => $this->recordService->getSearchableRecords(),
                'roles' => $this->recordService->getRoles()
            ]);
    }

    //Редактирование записи
    public function updateRecord($id, RecordRequest $request): RedirectResponse
    {
        $record = $this->recordService->getRecord($id);
        $record->source = $request->record["source"];
        $record->password = $request->record["password"];
        $record->login = $request->record["login"];
        $record->url = $request->record["url"];
        $record->comment = $request->record["comment"];
        $record->tag = $request->record["tag"];

        $record->save();

        return redirect()->route('records-data');
    }

    //Показ всех записей
    /*public function showAllRecords()
    {
        return view("myInfo", [
            'records' => $this->recordService->getRecords(),
            'personal' => $this->recordService->getPersonalRecords(),
            'roles' => $this->recordService->getRoles()
        ]);
    } */

    public function showAllRecords()
    {
        return view("myInfo", ['records' => $this->recordService->getRecords(),
        'roles' => $this->recordService->getRoles()]);
    }

    //Переход на редактирование записи
    public function editRecord($id){
        $req = new RecordRequest();

        return view('edit', ['data' => $this->recordService->getRecord($id)]); //по айдишнику переходим на редактирование записи
    }

    //Удаление записи
    public function deleteRecord($id): RedirectResponse
    {
        $this->recordService->getRecord($id)->delete();
        return redirect()->route('records-data');
    }
}
