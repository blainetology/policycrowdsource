@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <h1>Browse Policies</h1>
        </div>
        <div class="col-lg-2 text-right">
            @if(\Auth::check())
            <br/>
            <a href="{{route('policies.create')}}" class="btn btn-warning pull-right">Draft a Policy</a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-4">
            @include('partials.search-sidebar')
        </div>
        <div class="col-md-9 col-sm-8">  
            <div class="row">           
                @foreach($policies as $policy)
                    @include('partials.policy-box',['policy'=>$policy])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
