@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" id="homepageslide">
            <br/><br/><br/><br/>
            <h1 align="center" style="font-weight: 900; color:#FFF; text-shadow: 2px 2px #000; ">{{config('app.description')}}</h1>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Try Rating These Classic Documents to Get You Started</h3>
            </div>
        </div>
        <div class="row">
            @foreach($house_policies as $policy)
            <div class="col-md-4">
                <div class="well well-sm" style="min-height: 200px;">
                <?php 
                    $policy->rating = round($policy->rating);
                    if($policy->rating == -0)
                        $policy->rating = 0;
                ?>
                <span class="policy-rating rating_{{$policy->rating}}"> {{$policy->rating_count}} votes </span> &nbsp; <strong><a href="{{ route('policies.show',$policy->id) }}" style="font-size: 14pt;">{{$policy->name}}</a></strong><br/>
                &nbsp; &nbsp; {{$policy->short_synopsis}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
    #homepageslide{background:url(/images/homepagebg.jpg) center -100px; background-size: cover; height:70vh;}
</style>
@append
