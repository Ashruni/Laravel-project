<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthenticationController extends Controller
{

    public function show(){
        return view('auth.registration');
    }
    public function store(){
        $credentials = request()->validate([
            'name'=>['required','min:3','max:255'],
            'password'=>['required','min:8','max:50'],
            'email'=>['required','min:5','email','max:255','unique:users,email'],
        ]);
        $credentials['password'] = bcrypt($credentials['password']);

        $user=User::create($credentials);
        auth()->login($user);
        $userId=auth()->user()->id;
        if($credentials){
            return redirect('/welcome');
        }
        else{
            return redirect('/reg')->with('error','Something went wrong');

        }
        // DD($userId);
    }
    public function destroy(){
        auth()->logout();
        // DD('LOGGED OUT');
        return redirect('/login');
    }

}

