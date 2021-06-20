<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecordsRequest;
use App\Models\Records;
use App\Models\RoleRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;

class RecordsController extends Controller
{
    public function addRecord(RecordsRequest $request)
    {
        $record = new Records();
        $roleRecord = new RoleRecord();
        $record->source = $request->input('source');
        $record->password = encrypt($request->input('pass'));
        $record->login = $request->input('login_rec');
        $record->url = $request->input('url');
        $record->comment = $request->input('comment');
        $record->tag = $request->input('tag');
        
        $record->save();

        return redirect()->route('records-data');
    }

    public function showRecord($id)
    {
        $records = Records::find($id);
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

    public function showAllRecords()
    {  
        $records = Records::orderby('source')->paginate(10);
        return view("myInfo", ['data' => $records]);
    }

    public function editRecord($id){    
        return view('edit', ['data' => Records::find($id)]); //по айдишнику переходим на редактирование записи
    }
    
    public function deleteRecord($id){    
        Records::find($id)->delete();
        return redirect()->route('records-data');
    }
    
}
