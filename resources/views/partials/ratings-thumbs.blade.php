
@if(\Auth::check())
<?php
$rated=$rating['rating'];
$calculated=$rating['calculated_rating'];
?>
<div class="rating-box text-right visible-sm visible-xs {{!empty($calculated) && $rated!=$calculated ? 'rating-calculated' : ''}}" id="ratingBoxSection{{$sid}}">
    @if($document->type != 'question')
	<a href="javascript:PCApp.show_comments('section',{{$sid}})" class="pull-left comment-icon" title="{{$comments>0 ? 'View Comments' : 'Leave a Comment'}}"> {!!$comments > 0 ? '<i class="fa fa-comment" aria-hidden="true"></i> <i class="fa fa-caret-right" aria-hidden="true"></i>' : '<i class="fa fa-comment-o" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>'!!}</a>@endif

	@foreach(\App\Rating::$thumbs as $value=>$thumb)
    <a href="javascript:PCApp.rate_ajax({{$id}},{{$sid}},{{$value}})" title="{{!empty($calculated) && $calculated==$value ? 'calculated - ' : ''}} {{$document->type=='question' ? str_replace('support','agree',$thumb[0]) : $thumb[0]}}" class="rating-thumb rating{{$value}} {{!empty($rated) && $rated==$value ? 'selected' : ''}} {{!empty($rated) && $rated!=$value ? 'not-selected' : ''}} {{!empty($calculated) && $calculated==$value ? 'calculated' : ''}}"><i class="fa {{$thumb[1]}}" aria-hidden="true"></i></a>
    @endforeach
</div>
@else
<div class="rating-box text-right" id="ratingBoxSection{{$sid}}">
    @if($document->type != 'question')
	<a href="javascript:PCApp.show_comments('section',{{$sid}})" class="pull-left comment-icon" title="{{$comments>0 ? 'View Comments' : 'Leave a Comment'}}"> {!!$comments > 0 ? '<i class="fa fa-comment" aria-hidden="true"></i> <i class="fa fa-caret-right" aria-hidden="true"></i>' : '<i class="fa fa-comment-o" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>'!!}</a>	
	<a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
    @elseif($document->type == 'question')	
		<a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Answer</a>
    @endif
</div>
@endif
