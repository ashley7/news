@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary" href="{{route('account.show',$read_loan->account->id)}}">Back</a>

                  <h1>Account No. {{$read_loan->account->id}}, {{$read_loan->account->name}}</h1>

                    @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                    @endif

                  <h5>Loan issue date: {{$read_loan->created_at}}<br> Principal: UGX {{number_format($read_loan->principal)}}<br> Rate: {{$read_loan->rate}}% <br>Expected amount: UGX {{number_format($read_loan->principal + ($read_loan->principal*($read_loan->rate/100)))}}</h5>

                    <table class="table" id="table_display">
                        <thead>
                            <th>Date</th> <th>Amount paid</th> <th>Balance</th>
                        </thead>

                        <tbody>
                            @foreach($payments as $payment)
                              <tr>
                                <td>{{$payment->created_at}}</td>
                                <td>{{number_format($payment->amount)}}</td>
                                <td>{{number_format($payment->balance)}}</td>
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