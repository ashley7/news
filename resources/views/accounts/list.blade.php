@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                     <a style="float: right;" class="btn btn-primary" href="{{route('account.create')}}">Add account</a>

                  <h3>{{$group->name}} MEMBERS</h3>
                  <br><br>

                    <table class="table" id="table_display">
                        <thead>
                            <th>Account Number</th> <th>Name</th> <th>Phone</th> <th>Business</th> <th>Balance</th>
                        </thead>

                        <tbody>
                            @foreach($accounts as $account)
                              <tr>
                                <td>{{$account->id}}</td>
                                <td><a href="{{route('account.show',$account->id)}}">{{$account->name}}</a></td>
                                <td>{{$account->phone_number}}</td>
                                <td>{{$account->business}}</td>
                                <td>
                                    <?php $balances = 0; ?>
                                    @foreach($account->loan as $loans)
                                       <?php
                                        $balance = App\Payment::all()->where('loan_id',$loans->id)->last();
                                        $balances = $balances + $balance->balance;
                                        ?>
                                    @endforeach
                                    {{number_format($balances)}}
                                </td>
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