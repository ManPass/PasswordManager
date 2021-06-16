<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RecordsRequest;
use App\Models\Records;

class RecordsController extends Controller
{
    public function showAllRecords()
    {
        return view("myInfo", ["data" => Records::all()]);
    }
}
