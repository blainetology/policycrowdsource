@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Published Policies</h1>
            <div class="well well-sm">
            @foreach($policies as $policy)
            	<span class="policy-rating rating_{{round($policy->rating)}}"> {{$policy->rating_count}} votes </span> &nbsp; <strong><a href="{{ route('policies.show',$policy->id) }}" style="font-size: 14pt;">{{$policy->name}}</a></strong><br/>
            	&nbsp; &nbsp; {{$policy->short_synopsis}}<br/><br/>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
