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

    /**
     * Добавление нового пароля
     * @param RecordRequest $req
     * @return RedirectResponse
     */
    public function addRecord(RecordRequest $req): RedirectResponse
    {
        $record = Record::create($req->record);
        //Если указано, что пароль личный...
        if(request()->personal)
        {
            $this->recordService->addPersonalRecord($record);
        }
        //Если указаны роли...
        if(request()->roles)
        {
            $this->recordService->attachRecord($record);
        }
        //Если не то и не другое...
        if(!request()->personal && !request()->roles)
        {
            redirect()->route('add')->with("message", "Ошибка: выберите \"личное\" или роль(и) при добавлении!");
        }

        return redirect()->route('records-data');
    }

    /**
     * Метод для отображения страницы добавления с передачей ролей для чекбоксов
     */
    public function showAddView()
    {
        return view("add", ['roles' => $this->recordService->getRoles()]);
    }

    /**
     * @param $id
     * Отображение конкретного пароля
     */
    public function showRecord($id)
    {
        return view('show', ['data' => $this->recordService->getRecord($id)]);
    }

    /**
     * Поиск паролей
     */
    public function searchRecord()
    {
        //Если не выбрана категория поиска...
        if(!isset(request()->choose))
        {
            return redirect()->route('records-data')->with("message", "Не выбрана категория поиска");
        }
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


    /**
     * Отображение всех паролей. Роли нужны для чекбоксов
     */
    public function showAllRecords()
    {
        return view("myInfo", ['records' => $this->recordService->getRecords(),
        'roles' => $this->recordService->getRoles()]);
    }

    /**
     * @param $id
     * Переход на редактирование конкретного пароля
     */
    public function editRecord($id){
        return view('edit', ['data' => $this->recordService->getRecord($id)]);
    }

    /**
     * Удаление пароля
     * @param $id
     * @return RedirectResponse
     */
    public function deleteRecord($id): RedirectResponse
    {
        $this->recordService->getRecord($id)->delete();
        return redirect()->route('records-data');
    }
}
