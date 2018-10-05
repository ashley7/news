@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">              
                <div class="card-body">
                    <h3>Add New Account</h3>
                    <br><br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('account.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">

                                <label>Group</label>
                                <select name="group_id" class="form-control">
                                    <option></option>
                                    @foreach($groups as $group)
                                      <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                                </select>


                                <label>Name</label>
                                <input type="text" name="name" class="form-control">

                                <label>Also known as</label>
                                <input type="text" name="also_known_as" class="form-control">

                                <label>Date of birth</label>
                                <input type="date" name="date_of_birth" class="form-control">

                                <label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                <label>Marital status</label>
                                <select name="marital_status" class="form-control">
                                    <option></option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                    <option value="Devoced">Devoced</option>
                                    <option value="Seperated">Seperated</option>
                                </select>

                                <label>Title</label>
                                <input type="text" name="title" class="form-control">

                                <label>Phone number</label>
                                <input type="text" name="phone_number" class="form-control">



                                
                            </div>

                            <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">

                                <label>Language</label>
                                <input type="text" name="language" class="form-control">

                                <label>Addreess</label>
                                <input type="text" name="addreess" class="form-control">

                                <label>Addreess period</label>
                                <input type="text" name="addreess_period" class="form-control">

                                <label>Stall number</label>
                                <input type="text" name="stall_number" class="form-control">

                                <label>Business description</label>
                                <input type="text" name="business" class="form-control">
                                
                                <label>Number of dependants</label>
                                <input type="text" name="number_of_dependants" class="form-control">

                                <label>ID number</label>
                                <input type="text" name="id_number" class="form-control">

                                <label>ID Type</label>
                                <input type="text" name="id_type" class="form-control">
                                
                            </div>
                        </div>
                        
                         
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </form>

                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection