@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                     <a style="float: right;" class="btn btn-primary" href="{{route('branch.create')}}">Add branch</a>
                     <br><br>

                     <h2>Branches</h2>

                    <table class="table" id="table_display">
                        <thead>
                            <th>#</th> <th>Name</th> <th>Location</th> <th>Admin name</th> <th>Phone number</th>
                        </thead>

                        <tbody>
                            @foreach($branch as $branches)
                              <tr>
                                  <td>{{$branches->id}}</td>
                                  <td>{{$branches->name}}</td> 
                                  <td>{{$branches->location}}</td> 
                                  <td>{{$branches->admin->name}} ~{{$branches->admin->email}}</td> 
                                  <td>{{$branches->admin->phone_number}}</td>                               
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