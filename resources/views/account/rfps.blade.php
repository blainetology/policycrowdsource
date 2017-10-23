@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    @include('account.menu')

    <div class="col-lg-10">
      <div class="row">
          <div class="col-lg-12">
              <h1>{{$headertitle}}</h1>
          </div>
      </div>
      <div class="row">
          @foreach($rfps as $rfp)
              @include('partials.rfp-box',['rfp'=>$rfp])
          @endforeach
      </div>
    </div>       
	</div>
</div>
@stop