<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;

class SessionController extends Controller
{
    public function show(){
        return view('session.login');
    }
    public function check(){
        $credentials = request()->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:50',
        ]);

        // DD($credentials);
        if (! auth()->attempt($credentials))
        {
            throw ValidationException::withMessages([
                'email'=>'your provided credentials could not be verified'
            ]);
        }

        session()->regenerate();
            return redirect('/')->with('success','Welcome Back' );

    }
}
