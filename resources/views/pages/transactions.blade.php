@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body"> 
          <h1>Investment and Income</h1>
          
           <ul class="nav nav-tabs">
              <li class="nav-item active"><a class="nav-link" data-toggle="tab" href="#investments">Investments  </a></li>
              <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payments"> Payments </a></li>              
             </ul>

            <div class="tab-content">

              <div id="investments" class="tab-pane active">

                <h3>All investments</h3>
                 <div class="table-responsive">

                    <table class="table table-hover" id="table_display">
                        <thead>
                            <th>Name</th>
                            <th>Date</th> 
                            <th>Repayment date</th>
                            <th>Particular</th>
                            <th>Principal(UGX)</th> 
                            <th>Profit(UGX)</th>
                            <th>Expected(UGX)</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>By</th>
                        </thead>

                        <tbody>
                          <?php
                          $principal = $profit = 0; 

                           ?>
                            @foreach($loan as $loans)
                            <?php
                             $principal = $principal + $loans->principal;
                             $profit = $profit + $loans->rate;

                             ?>
                             <tr>
                                 <td>
                                  <a href="{{route('account.show',$loans->account->id)}}">{{$loans->account->name}}</a> </td>
                                 <td>{{$loans->created_at}}</td>
                                 <td>{{$loans->date_of_payment}}</td>
                                 <td>{{$loans->particular}}</td>
                                 <td>{{number_format($loans->principal)}}</td>
                                 <td>{{number_format($loans->rate)}}</td>
                                 <td>
                                    {{number_format($loans->principal + $loans->rate)}}
                                 </td>
                                 <td>
                                    @if($loans->status == 1)
                                      <span class="text-warning">Pending</span>
                                      @else
                                      <span class="text-success">Complete</span>
                                    @endif
                                  </td>

                                 <td>
                                     <a class="btn btn-primary" href="{{route('loan.show',$loans->id)}}">Details</a>
                                 </td>

                                 <td>{{$loans->user->name}}</td>
                             </tr>

                            @endforeach

                            <tr>
                              <th><span style="color: white">z</span></th>
                              <th>Total</th> 
                              <th></th>
                              <th></th>
                              <th>{{number_format($principal)}}</th> 
                              <th>{{number_format($profit)}}</th>
                              <th>{{number_format($profit + $principal)}}</th>
                              <th></th>
                              <th></th>
                              <th></th>
                            </tr>
                        </tbody>
                    </table>
                     
                </div>

              </div>

              <div id="payments" class="tab-pane">

                <h1>Payments</h1>

                 <table class="table" id="pay">
                      <thead>
                         <th>Name</th>
                         <th>Date</th>
                         <th>Amount paid</th>
                         <th>Balance</th>
                         <th>Investemnt id</th>
                         <th>By</th>
                      </thead>

                      <tbody>
                        <?php $amount_paid = 0; ?>
                          @foreach($payments as $payment)
                          <?php $amount_paid = $amount_paid +  $payment->amount; ?>
                            <tr>
                              <td>
                                <a href="{{route('account.show',$payment->loan->account->id)}}">{{$payment->loan->account->name}} ({{$payment->loan->account->also_known_as}})</a>
                                </td>                             
                              <td>{{$payment->created_at}}</td>
                              <td>{{number_format($payment->amount)}}</td>
                              <td>{{number_format($payment->balance)}}</td>
                              <td><a href="{{route('loan.show',$payment->loan->id)}}">{{$payment->loan->id}} ({{$payment->loan->created_at}})</a></td>
                              <td>{{$payment->user->name}}</td>
                            </tr>
                          @endforeach

                          <tr>
                            <th><span style="color: white">z</span></th>
                            <th></th>
                            <th>{{number_format($amount_paid)}}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                      </tbody>                       
                  </table>   

              </div>

            </div>
          </div>
        </div>
      </div>
@endsection
@push('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
@endpush
@include('layouts.datatable')