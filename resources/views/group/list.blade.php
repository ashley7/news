@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">        
             

                <div class="card-body">
                   <a style="float: right;" class="btn btn-primary" href="{{route('group.create')}}">Add group</a>

                   <h3>Groups</h3>
                   <br><br>

                    <table class="table" id="table_display">
                        <thead>
                            <th>#</th> <th>Name</th> <th>No. of members</th>
                        </thead>

                        <tbody>
                            @foreach($groups as $group)
                              <tr>
                                  <td>{{$group->id}}</td>
                                  <td><a href="{{route('group.show',$group->id)}}">{{$group->name}}</a></td>
                                  <td>{{$group->account->count()}}</td>                                
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