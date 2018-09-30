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
                            <th>Amount out</th>
                            <th>Expected Amount</th>
                            <th>Paid amount</th>
                            <th>Balance</th>
                        </thead>

                        <tbody>
                            @foreach($groups as $group)
                              <tr>
                                  <td>{{$group->name}}</td>
                                  <td>{{$group->account->count()}}</td>
                                  <td></td>

                                  <td></td>

                                  <td></td>
                                  
                                  <td></td>
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