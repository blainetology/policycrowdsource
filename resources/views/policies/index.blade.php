@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Browse Policies</h1>
                </div>
            </div>
            <div class="row">
                @foreach($policies as $policy)
                    @include('partials.policy-box',['policy'=>$policy])
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
