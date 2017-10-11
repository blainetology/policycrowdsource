@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Published Policies</h1>
            <div class="well well-sm">
            @foreach($policies as $policy)
            	<strong><a href="{{ route('policies.show',$policy->id) }}">{{$policy->name}}</a></strong> <span style="background:{{\App\Rating::getColor($policy->rating)}}; border:2px solid #000;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><br/>
            	&nbsp; &nbsp; {{$policy->short_synopsis}}<br/><br/>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
