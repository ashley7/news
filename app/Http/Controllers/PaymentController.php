<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Loan;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $loans = Loan::all();
        $payments = Payment::all();
        $data = ["loan"=>$loans,"payments"=>$payments];
        return view("pages.transactions")->with($data);
    }
 
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        $this->validate($request,['amount'=>'required','loan_id'=>'required']);
        $save_payment = new Payment();
        $save_payment->amount = str_replace(",", "", $request->amount);
        $save_payment->loan_id = $request->loan_id;
        $save_payment->user_id = \Auth::user()->id;

        $current_balance = Payment::all()->where('loan_id',$request->loan_id)->last();
        $loan = Loan::find($request->loan_id);
        $balance =  $current_balance->balance - (int)str_replace(",", "", $request->amount);
        if ($balance <= 0) {
            $loan->status = 2;
            $loan->save();
        }
        $save_payment->balance = $balance;
        try {
            $save_payment->save();
            $status = "Operation successfull";
        } catch (\Exception $e) {
            $status = "Failed operation";
        }

        return redirect()->route('loan.show',$request->loan_id)->with(['status'=>$status]);
    }

 
    public function show($id)
    {
        //
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
