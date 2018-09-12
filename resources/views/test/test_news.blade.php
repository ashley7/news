@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
   

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/news" enctype="multipart/form-data">
                        @csrf
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">

                        <label>Body</label>
                        <textarea name="description" class="form-control"></textarea>
                        <br>
                        <input type="file" name="file_url">
                        <br><br>
                        <button type="submit">Save</button>
                    </form>

                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection