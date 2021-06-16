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

    public function showAllRecords()
    {
        return view("myInfo", ["data" => Records::all()]);
    }
}
