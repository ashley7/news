<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="icon" href="{{asset('images/chims.png')}}"> -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.dataTables.min.css') }}"> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @section('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <!-- <img src="{{asset('images/chims.png')}}" width="50px"> -->
                    @guest
                  
                    @else
                     <span style="margin-left: 10px;"> {{Auth::user()->branch->name}} </span>
                    @endguest
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

 

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @role(["manager","main_admin"])

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('account.index')}}">Accounts</a>
                        </li>

                            @role(["manager"])

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('group.index')}}">Groups</a>
                            </li>

                            @endrole
                        @endrole
                        
                        @role(['main_admin'])
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('branch.index')}}">Markets</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('payment.index')}}">Transaction</a>
                            </li>
                        @endrole
                       

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
 
                        @else
                            <li class="nav-item">
                               
                                    {{ Auth::user()->name }}  
                                 
 
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   @stack('scripts')
</body>
</html>
