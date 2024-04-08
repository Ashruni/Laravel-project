<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Operation;

class DashboardController extends Controller
{
    public function home(){
        $userId = auth()->user()->id;
        $email = auth()->user()->email;
        $depositAmount=DB::table('operations')->where('user_id',$userId)->sum('deposits');
        $transferAmount = DB::table('operations')->where('user_id',$userId)->sum('transfers');
        $withdrawalAmount = DB::table('operations')->where('user_id',$userId)->sum('withdrawals');
        $surplusAmount=DB::table('operations')->where('email',$email)->sum('transfers');
        $balance = ($depositAmount+$surplusAmount) - ($transferAmount + $withdrawalAmount);

        return view('dashboard.home')->with('balance',$balance);
    }

    public function display(){
        return view('dashboard.deposits');
    }

    public function store(){
        $depositAmount= request()->validate([

            'deposits'=>'required|numeric|min:1|max:30000000',

        ], [
            'deposits.min' => 'The deposits amount must be at least 1 rupee.',
            'deposits.max' => 'The deposits amount must not exceed 30,000,000.']

    );
        // DD($depositAmount);
        $userId = Auth::id();
        // DD($userId);

        if($depositAmount){
            $operations= Operation::create([
                'deposits' => $depositAmount['deposits'],
                'user_id'=>$userId,
            ]);
            return redirect('/deposits')->with('success','Deposited successfully');
            // session()->flash('success','Your account has been created');

        }

        return view('dashboard.deposits');
    }
    public function show(){
        return view('dashboard.withdrawal');
    }
    public function withdraw(){
        $userId = Auth::id();

        $withdrawAmount = request()->validate([
            'withdrawals'=>'required|numeric|min:1|max:3000000'],
            [
                'withdrawals.min' => 'The deposits amount must be at least 1 rupee.',
                'withdrawals.max' => 'The deposits amount must not exceed 30,000,000.']
        );
        $depositAmount=DB::table('operations')->where('user_id',$userId)->sum('deposits');
        $transferAmount = DB::table('operations')->where('user_id',$userId)->sum('transfers');
        $withdrawalAmount = DB::table('operations')->where('user_id',$userId)->sum('withdrawals');
        $balance = $depositAmount - ($transferAmount + $withdrawalAmount);
        // DD($balance);
        $amount = $withdrawAmount['withdrawals'];
        // DD();
        if($amount<=$balance){
            Operation::create([
                'withdrawals' =>$withdrawAmount['withdrawals'],
                'user_id'=>$userId,
            ]);
            $balance = $balance-$withdrawAmount['withdrawals'];
            // DD($balance);
            return redirect('/withdraw')->with('success','withdrawn successfully');
            // return view('dashboard.withdrawal');

        }
        else{
            return redirect('/withdraw')->with('error','Insufficient bank balance');

        }

    }
    public function shows(){
      return view('dashboard.transfer');
    }
    public function save(){
        $email=auth()->user()->email;

        $validated = request()->validate([
            'email' => 'required|email|exists:users,email',
            'transfers' => 'required|numeric|min:1|max:3000000',
        ]);
        $userId = auth()->user()->id;
        $userEmail = auth()->user()->email;
        $depositAmount=DB::table('operations')->where('user_id',$userId)->sum('deposits');
        $userTransfer = DB::table('operations')->where('email',$userEmail)->sum('transfers');
        $transferAmount = DB::table('operations')->where('user_id',$userId)->sum('transfers');
        $withdrawalAmount = DB::table('operations')->where('user_id',$userId)->sum('withdrawals');
        $balance = ($depositAmount+$userTransfer)-($transferAmount + $withdrawalAmount);

        // DD($balance);

        if($validated['transfers']<=$balance){
            if($validated['email']!= $email){
                $user_id =auth()->user()->id;
                $balance = ($depositAmount+$userTransfer)-($transferAmount + $withdrawalAmount);
                $validated = Operation::create([
                    'email'=>$validated['email'],
                    'transfers'=>$validated['transfers'],
                    'user_id'=>$user_id

                ]);
                return redirect('/transfer')->with('success','transfered');
            }
            else{
                return redirect('/transfer')->with('error','enter email id of the other user');

            }



        }
        else{
            return redirect('/transfer')->with('error','insufficient bank balance');
        }
    }
    public function displays(){
        $userId = auth()->user()->id;

        $userEmail = auth()->user()->email;
        $depositAmount=DB::table('operations')->where('user_id',$userId)->sum('deposits');
        $userTransfer = DB::table('operations')->where('email',$userEmail)->sum('transfers');
        $transferAmount = DB::table('operations')->where('user_id',$userId)->sum('transfers');
        $withdrawalAmount = DB::table('operations')->where('user_id',$userId)->sum('withdrawals');
        $balances = ($depositAmount+$userTransfer)-($transferAmount + $withdrawalAmount);
        $statements = DB::table('operations')->where('user_id',$userId)->get();
        // DD($statements);
        return view('dashboard.statements')->with('statements',$statements)->with('balances',$balances);
    }


}

