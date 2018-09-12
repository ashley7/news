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
                             <a href="{{route('news.destroy',$new->id)}}" style="float: right;">Delete</a>
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