@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" id="homepageslide">
        </div>
    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
    #homepageslide{background:url(/images/homepagebg.jpg) center -100px; background-size: cover; height:75vh;}
</style>
@append
