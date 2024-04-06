<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function show(){
        return view('session.login');
    }
    public function store(){
        return "hiii";
    }
}
