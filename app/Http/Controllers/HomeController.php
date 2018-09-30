<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use App\Account;
use App\Payment;
use App\Loan;
use App\Group;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        if (\Auth::user()->hasRole('main_admin')) {
            $branch = Branch::all()->where('name','!=','Setup');
            $branch_count = $branch->count();
            $number_of_clients = Account::all()->count();
            $loans_out = Loan::all()->sum('principal');
            $payments = Payment::all()->sum('amount');
            $data = ['branch'=>$branch,'branch_count'=>$branch_count,'number_of_clients'=>$number_of_clients,'loans_out'=>$loans_out,'payments'=>$payments];

            return view("pages.dashboard")->with($data);
        }else{
            $user_branch = \Auth::user()->branch;
            $groups = Group::all()->where('branch_id',$user_branch->id);

            $balances = 0;

            foreach ($groups as $group_value) {
                foreach ($group_value->account as $accounts) {
                    foreach ($accounts->loan as $loans) {
                        $balance = Payment::all()->where('loan_id',$loans->id)->last();
                        $balances = $balances + $balance->balance;
                    }
                    
                }
            }
            $data = ['groups'=>$groups,'balances'=>$balances];
            return view("pages.branch_dashboard")->with($data);
        }
        return view('home');
    }
    
}
