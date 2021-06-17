<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecordsRequest;
use App\Models\Records;

class RecordsController extends Controller
{
    public function submit(RecordsRequest $request)
    {
        $record = new Records();
        $record->source = $request->input('source');
        $record->password = $request->input('pass');
        $record->login = $request->input('login');
        $record->url = $request->input('url');
        $record->comment = $request->input('comment');
        $record->tag = $request->input('tag');
        
        $record->save();

        return redirect()->route('records-data');
    }

    public function updateSubmit($id, RecordsRequest $request)
    {
        $record = Records::find($id);
        $record->source = $request->input('source');
        $record->password = $request->input('pass');
        $record->login = $request->input('login');
        $record->url = $request->input('url');
        $record->comment = $request->input('comment');
        $record->tag = $request->input('tag');
        
        $record->save();

        return redirect()->route('records-data');
    }

    public function showAllRecords()
    {
        return view("myInfo", ["data" => Records::all()]);
    }

    public function editRecord($id){    
        return view('edit', ['data' => Records::find($id)]); //по айдишнику переходим на редактирование записи
    }
    
    public function deleteRecord($id){    
        Records::find($id)->delete();
        return redirect()->route('records-data');
    }
    
}
