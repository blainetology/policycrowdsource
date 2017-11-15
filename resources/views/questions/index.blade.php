@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-10">
            <h1>Browse Questions</h1>
        </div>
        <div class="col-lg-2 text-right">
            @if(\Auth::check())
            <br/>
            <a href="{{route('questions.create')}}" class="btn btn-warning pull-right">Draft a Question</a>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($questions as $question)
            @include('partials.question-box',['question'=>$question])
        @endforeach
    </div>
</div>
@endsection
