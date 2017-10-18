@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Requests for Policies</h1>
            <div class="well well-sm">
            @foreach($rfps as $rfp)
            	<?php 
            		$rfp->rating = round($rfp->rating);
            		if($rfp->rating == -0)
            			$rfp->rating = 0;
            	?>
            	<span class="policy-rating rating_{{$rfp->rating}}"> {{$rfp->rating_count}} votes </span> &nbsp; <strong><a href="{{ route('rfp.show',$rfp->id) }}" style="font-size: 14pt;">{{$rfp->name}}</a></strong><br/>
            	&nbsp; &nbsp; {{$rfp->short_overview}}<br/><br/>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
