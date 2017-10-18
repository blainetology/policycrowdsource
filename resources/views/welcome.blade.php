@extends('layouts.app')

@section('content')
        <div class="flex-center position-ref full-height">
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
@endsection

@section('styles')
        <style>
            html, body {
                height: 100vh;
                margin: 0;
            }
            body{
                background: linear-gradient(#47A,#69C);
            }
            .full-height {
                font-family: 'Montserrat', 'Arial', 'Raleway', sans-serif;
                font-weight: 100;
                height: 85vh;
                color:#FFF;
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

@append
