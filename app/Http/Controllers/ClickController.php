<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clicks;
use App\Models\Logins;

class ClickController extends Controller
{
    public function click(Request $request){
        return Clicks::click($request);
    }

    public function login(Request $request){
        return Logins::login($request);
    }
}
