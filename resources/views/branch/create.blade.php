@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <h3>Add new Branch</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('branch.store')}}">
                        @csrf
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">

                        <label>Location</label>
                        <input type="text" name="location" class="form-control">

                        <label>Branch Admin name</label>
                        <input type="text" name="admin_name" class="form-control">

                        <label>Branch Admin Email</label>
                        <input type="text" name="email" class="form-control">

                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection