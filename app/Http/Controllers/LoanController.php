<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Loan;

class LoanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

 
    public function create()
    {
        //
    }
 
    public function store(Request $request)
    {
        $this->validate($request,['principal'=>'required','rate'=>'required']);
        $save_loan = new Loan();
        $principal = (double)str_replace(",", "", $request->principal);
        $save_loan->principal = $principal;
        $save_loan->rate = (double)str_replace(",", "",$request->rate);
        $save_loan->account_id = $request->account_id;
        $save_loan->user_id = \Auth::user()->id;     
        $expected =  $principal + (double)str_replace(",","",$request->rate);
        $save_loan->expected = $expected;
        $save_loan->date_of_payment = $request->date_of_payment;
        $save_loan->particular = $request->particular;
        try {
            $save_loan->save();
            $payment_default = new Payment();
            $payment_default->amount = 0.00;
            $payment_default->balance = $save_loan->expected;
            $payment_default->loan_id = $save_loan->id;
            $payment_default->user_id = \Auth::user()->id;
            $payment_default->save();
        } catch (\Exception $e) {
            echo $e->getMessage(); exit();
        }
        return back()->with(['status'=>'Loan created']);
    }
 
    public function show($id)
    {
        $read_loan = Loan::find($id);
        $payments = Payment::all()->where('loan_id',$read_loan->id);
        $data = ['read_loan'=>$read_loan,'payments'=>$payments];
        return view("accounts.payments")->with($data);
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
