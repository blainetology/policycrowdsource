@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <h1>Browse</h1>
        </div>
        <div class="col-lg-2 text-right">
            @if(\Auth::check())
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-4">
            @include('partials.search-sidebar')
        </div>
        <div class="col-md-9 col-sm-8">  
            <div class="row">           
                @foreach($documents as $document)
                    @include('partials.policy-list',['policy'=>$document])
                @endforeach
            </div>
        </div>
    </div>
</div>
                <br/>
                <br/>
                <br/>
@endsection
