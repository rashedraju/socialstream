<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){
        $statuses = Status::orderBy('id', 'desc')->get();
        
        return view('welcome', ['statuses'=>$statuses]);
    }
}
