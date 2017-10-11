@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$policy->name}}</h1>
            <pre>
            {!! print_r($sections,true) !!}
            </pre>
        </div>
    </div>
</div>
@endsection
