<?php 
use App\Customer;
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Car Rental') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Styles -->


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/nav.css') }}" rel="stylesheet" type="text/css">
</head>

<body style="background-image:url({{asset('/image_test/background.jpg')}}); background-size:100% 100%; background-repeat:no-repeat; min-height:100vh;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand navbar-head" href="{{route('welcome')}}">
                    Car Rental System
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link navbar-word" href="{{ route('login') }}" style="color:black;">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="navbar-word nav-link " href="{{ route('register') }}" style="color:black;">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        @can('create',App\RentalOrder::class)
                            <li class="nav-item">
                                <a id="navbarDropdown"  style="color:black;" class="nav-link navbar-word" href="{!! route('rentals.book')!!}" role="button"  aria-haspopup="true" aria-expanded="false" v-pre>
                                    Book 
                                </a>
                            </li>

                            <li class="nav-item">
                                <a id="navbarDropdown"  style="color:black;" class="nav-link navbar-word" href="{!! route('rentals.view')!!}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                                    View Order 
                                </a>
                            </li>
                            @endcan
                            @if (Auth::user()->can('update', Customer::where('email',Auth::user()->email)->first()))
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link navbar-word" style="color:black;" role="button" aria-haspopup="true" aria-expanded="false" v-pre
                                    href="{{route('customers.edit',Auth::user()->email)}}">
                                    {{ __('Edit Profile') }}
                                </a>
                            </li>
                            @endif

                            <li class="nav-item">
                                <a id="navbarDropdown"  style="color:black;" class="nav-link navbar-word" href="{!! route('rentals.gallery')!!}" role="button"  aria-haspopup="true" aria-expanded="false" v-pre>
                                    Car gallery 
                                </a>
                            </li>

                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link navbar-word" style="color:black;" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>

                            <li class="nav-item">
                            <a class="navbar-word nav-link " href="{{ route('home') }}" style="color:black;">Home</a>
                        </li>
                    

                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link navbar-word" style="color:black;" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="text-transform:uppercase;">
            @yield('content')
        </main>
    </div>
</body>

</html>