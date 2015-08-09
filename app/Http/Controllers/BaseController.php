<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public function dashboard(){
        $page_title = 'Dashboard';
        return view('dashboard')->with(compact('page_title'));
    }

}
