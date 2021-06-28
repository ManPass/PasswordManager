<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class RoleController extends Controller
{
    function changeSelectedRole(Request $req): RedirectResponse
    {
        $role = cookie('role_id', $req->input('role_choose'));

        return redirect()->route('records-data')->withCookie($role);
    }
}
