@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Requests for Policies</h1>
        </div>
    </div>
    <div class="row">
        @foreach($documents as $document)
            @include('partials.rfp-box',['rfp'=>$document])
        @endforeach
    </div>
</div>
@endsection