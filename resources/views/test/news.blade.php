@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h1>{{$number_of_articals}} Posts</h1>
                <div class="card-body">
                    <ul>
                        @foreach($news as $new)
                        <h4>{{$new->title}}</h4>

                         <li>
                         <p>                             
                             <img src="{{asset('/images')}}/{{$new->file_url}}" width="200px;" style="float: left; padding: 10px;">
                             <span>{{$new->description}}</span>
                            <form action="/news/{{$new->id}}" method="POST">
                                {{method_field('DELETE')}}
                                @csrf
                                <span class="glyphicon glyphicon-trash"></span>
                                <input type="submit"  class="btn btn-danger" value="Delete Records"/>
                            </form>
                          </p>
                         </li>  
                         <br><br><br><br><br><br>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection