<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Group;
use App\Loan;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $accounts = array();
        if (\Auth::user()->hasRole('main_admin')) {
            $accounts = Account::all();
        }else{
            $account = Account::all();
            foreach ($account as $user_value) {
                if ($user_value->group->branch_id == \Auth::user()->branch_id) {
                    $accounts[] = Account::find($user_value->id);
                }
            }

        }
        
        return view('accounts.all_accounts')->with(['accounts'=>$accounts]);
    }

 
    public function create()
    {
        $groups = Group::all()->where('branch_id',\Auth::user()->branch->id);
        return view('accounts.create')->with(['groups'=>$groups]);
    }
 
    public function store(Request $request)
    {

        $this->validate($request,['name'=>'required','phone_number'=>'required','group_id'=>'required']);
        $accounts = new Account();
        $accounts->name = $request->name;
        $accounts->phone_number = $request->phone_number;
        $accounts->business = $request->business;
        $accounts->group_id = $request->group_id;
        try {
            $accounts->save();
            return redirect()->route('group.show',$accounts->group_id);
        } catch (\Exception $e) {}        
    }
 
    public function show($id)
    {
        $account = Account::find($id);
        $pending_loans = Loan::all()->where('account_id',$id)->where('status',1);
        return view('accounts.loan')->with(['account'=>$account,'pending_loans'=>$pending_loans]);
    }

 
    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {
        //
    }
 
    public function destroy($id)
    {
        //
    }
}
