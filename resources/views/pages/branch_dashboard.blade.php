@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
             <div class="col-md-6">
                <div class="card">
                    <div class="card-body"> 
                      <center> 
                        <h1>Groups</h1>                      
                        {{$groups->count()}}
                       </center>
                    </div>
                </div>               
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h1>Balance</h1>
                            UGX {{number_format($balances)}}                             
                        </center>                        
                    </div>
                </div>
            </div> 
        </div>

        <br><br>

        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table" id="table_display">
                        <thead>
                            <th>Group</th>
                            <th>Accounts</th>
                            <th>Amount out (UGX)</th>
                            <th>Expected Amount (UGX)</th>
                            <th>Paid amount (UGX)</th>
                            <th>Balance (UGX)</th>
                        </thead>

                        <tbody>
                            @foreach($groups as $group)

                            <?php $sum_loans = $sum_expected = $sum_paid = 0; ?>

                            @foreach($group->account as $accounts)
                                 @foreach($accounts->loan as $account_loan)
                                  <?php
                                     $sum_loans = $sum_loans + $account_loan->principal;

                                     $sum_expected = $sum_expected + ( $account_loan->principal + ($account_loan->principal * ($account_loan->rate/100)) );
                                   ?>
                                 @foreach($account_loan->payment as $payments)
                                  <?php 
                                    $sum_paid = $sum_paid + $payments->amount;
                                   ?>
                                 @endforeach

                                 @endforeach
                               @endforeach


                              <tr>
                                  <td>{{$group->name}}</td>
                                  <td>{{$group->account->count()}}</td>
                                  <td>{{number_format($sum_loans)}}</td>

                                  <td>{{number_format($sum_expected)}}</td>

                                  <td>{{number_format($sum_paid)}}</td>
                                  
                                  <td>{{number_format($sum_expected - $sum_paid)}}</td>
                              </tr>
                            @endforeach                            
                        </tbody>           
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@include('layouts.datatable')