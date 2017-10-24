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
            <a href="{{route('policies.create')}}" class="btn btn-success pull-right">Draft Policy</a>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($policies as $policy)
            @include('partials.policy-box',['policy'=>$policy])
        @endforeach
    </div>
</div>
@endsection
