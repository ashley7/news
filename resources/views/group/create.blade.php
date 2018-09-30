@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
       

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Add Group</h3>
                    <br><br>

                    <form method="POST" action="{{route('group.store')}}">
                        @csrf
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">                         
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection