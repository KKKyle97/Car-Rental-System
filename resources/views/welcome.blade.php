<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                color:white;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: black;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links > a:hover {
                border-bottom:1px solid black;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .welcome {
                text-align:center;
                width:80%;
                height:75%;
                color:black;
            }

            .welcome_header {
                text-transform: uppercase;
                font-size:90px;
                font-weight:500;
                height:20%;
            }

            .welcome_body {
                text-transform: uppercase;
                font-size:40px;
                font-weight:500;
                height:15%;
            }

            .welcome_button {
                text-transform: uppercase;
                font-size:20px;
                font-weight:1000;
                margin:0% 1%;
            }

            .welcome_button:hover {
                border:1px solid black;
            }


        </style>
    </head>
    <body style="background-image:url({{asset('/image_test/background.jpg')}}); background-size:100% 100%; background-repeat:no-repeat">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <div class="welcome">
                <div class="welcome_header">
                    <p>Car Rental System</p>
                </div>

                <div class="welcome_body">
                    <p>Find a perfect car for your trip</p>
                </div>
                
                <div>
                    @if(Auth::check() && Auth::user()->roles=="admin")
                   <a href="{{ route('rentals.index') }}" class="btn welcome_button">Check Rental Orders</a>
                   @elseif(Auth::check() && Auth::user()->roles=="customer")
                   <a href="{{ route('rentals.book') }}" class="btn welcome_button">Book A Car</a>
                   <a href="{{ route('rentals.view') }}" class="btn welcome_button">Check My Rental</a>
                   @else
                   <a href="{{ route('rentals.book') }}" class="btn welcome_button">Book A Car</a>
                   <a href="{{ route('rentals.view') }}" class="btn welcome_button">Check My Rental</a>
                   @endif
                </div>
            </div>
                
        </div>
    </body>
</html>
