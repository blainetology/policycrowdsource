@if(\Auth::check())
<?php
$rated=$rating['rating'];
$calculated=$rating['calculated_rating'];
?>
<div class="rating-box text-right visible-sm visible-xs {{!empty($calculated) && $rated!=$calculated ? 'rating-calculated' : ''}}" id="ratingBoxSection{{$sid}}">
	@foreach(\App\Rating::$thumbs as $value=>$thumb)
    <a href="javascript:rate_ajax({{$pid}},{{$sid}},{{$value}})" title="{{!empty($calculated) && $calculated==$value ? 'calculated - ' : ''}} {{$thumb[0]}}" class="rating-thumb rating{{$value}} {{!empty($rated) && $rated==$value ? 'selected' : ''}} {{!empty($rated) && $rated!=$value ? 'not-selected' : ''}} {{!empty($calculated) && $calculated==$value ? 'calculated' : ''}}"><i class="fa {{$thumb[1]}}" aria-hidden="true"></i></a>
    @endforeach
</div>
@else
<div class="rating-box text-right" id="ratingBoxSection{{$sid}}" style="margin-top:3px;">
	<a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
</div>
@endif
