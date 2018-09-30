@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">              
                <div class="card-body">
                    <h3>Add Account</h3>
                    <br><br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('account.store')}}">
                        @csrf
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">

                        <label>Phone number</label>
                        <input type="text" name="phone_number" class="form-control">

                        <label>Business</label>
                        <input type="text" name="business" class="form-control">

                        <label>Group</label>
                        <select name="group_id" class="form-control">
                            <option></option>
                            @foreach($groups as $group)
                              <option value="{{$group->id}}">{{$group->name}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="group_id" value="{{$group->id}}">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection