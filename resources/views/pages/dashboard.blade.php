@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
             <div class="col-md-4">
                <div class="card">
                    <div class="card-body"> 
                      <center> 
                        <h1>Branches</h1>                      
                        {{$branch_count}}
                       </center>
                    </div>
                </div>               
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <h1>Accounts</h1>
                            {{$number_of_clients}}
                        </center>                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                     <center>
                      <h1>Collections</h1>
                      {{number_format($payments)}}
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
                            <th>Branch</th>
                            <th>Accounts</th>
                            <th>Amount out</th>
                            <th>Expected Amount</th>
                            <th>Paid amount</th>
                            <th>Balance</th>
                        </thead>

                        <tbody>
                            @foreach($branch as $branches)
                              <tr>
                                  <td>{{$branches->name}}</td>
                                  <td>
                                      @foreach($branches->group as $groups)
                                         {{$groups->account->count()}}
                                      @endforeach
                                  </td>
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