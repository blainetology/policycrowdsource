@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    @include('account.menu')

    <div class="col-lg-9">
      <div class="row">
          <div class="col-lg-12">
              <h1>{{$headertitle}}</h1>
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
@stop