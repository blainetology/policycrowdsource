<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{!empty($pagetitle) ? $pagetitle.' | ' : ''}}{{config('app.name')}}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .navbar{margin-bottom:0;}
    </style>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
    function showLoginModal(){
        $('#loginModal').modal('show');
    }
    </script>
    @yield('scripts')

    @yield('styles')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="/">
                        {{ config('app.name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="{{route('browse.index')}}">Browse</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Create <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('policies.create')}}">Policy</a></li>
                                <li><a href="{{route('rfp.create')}}">RFP</a></li>
                                <li><a href="{{route('questions.create')}}">Questionnaire</a></li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="javascript:showLoginModal()" style="padding:10px;"><span class="btn btn-sm btn-success">Login</span></a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->short_name() }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{route('accountsettings')}}">Settings</a></li>
                                    <li><a href="{{route('accountmypolicies')}}">My Policies</a></li>
                                    <li><a href="{{route('accountmyrfps')}}">My RFPs</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div id="content" style="min-height:75vh;">
        @yield('content')
        </div>

        <footer class="bg-primary">
        <br/>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <strong>Use the Site</strong><br/>
                    <a href="{{route('browse.index')}}">Browse</a><br/>
                    <a href="{{route('policies.create')}}">Draft a Policy</a><br/>
                    <a href="{{route('rfp.create')}}">Submit a Policy Request</a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <strong>Legal Stuff</strong><br/>
                    <a href="#">Terms &amp; Conditions</a><br/>
                    <a href="#">Our Privacy Policy</a><br/>
                </div>
                <div class="col-md-3 col-sm-6">
                    <strong>The Company</strong><br/>
                    <a href="#">About Us</a><br/>
                    <a href="#">Our Mission</a><br/>
                    <a href="#">Our Team</a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <strong>Support</strong><br/>
                    <a href="#">Donate</a><br/>
                </div>
            </div>
        </div>
        <br/>
        <div align="center">&copy;{{date('Y')}} Policy Crowdsource, LLC</div>
        <br/>

        </footer>
    </div>

    @include('auth.login-modal')

</body>
</html>
