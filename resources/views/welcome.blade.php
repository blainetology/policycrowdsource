<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600|Montserrat:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #47A;
                color: #FFF;
                font-family: 'Montserrat', 'Arial', 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            body{
                background: linear-gradient(#47A,#69C);
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

            .bottom-right {
                position: absolute;
                right: 10px;
                bottom: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 72px;
                font-weight: 600;
                text-transform: uppercase;
            }
            .description {
                font-size: 36px;
                font-weight: 300;
                text-transform: lowercase;
            }

            .links > a {
                color: #FFF;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
                <div class="bottom-right links">
                    <a href="{{ url('/home') }}">About Us</a>
                    <a href="{{ url('/home') }}">Our Mission</a>
                </div>

            <div class="content">
                <div class="title m-b-md">
                    {{config('app.name')}}
                </div>
                <div class="description m-b-md">
                    {{config('app.description')}}
                </div>
                <br/><br/>
                <div class="links">
                    <a href="{{ route('policies.index') }}">Browse Policies</a>
                    <a href="#">Draft a Policy</a>
                    <a href="#">Request a Policy</a>
                </div>
            </div>
        </div>
    </body>
</html>
