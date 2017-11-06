
@if(\Auth::check())
<?php
$rated=$rating['rating'];
$calculated=$rating['calculated_rating'];
?>
<div class="rating-box text-right visible-sm visible-xs {{!empty($calculated) && $rated!=$calculated ? 'rating-calculated' : ''}}" id="ratingBoxSection{{$sid}}">
	<a href="javascript:PCApp.show_comments('section',{{$sid}})" class="pull-left comment-icon" title="{{$comments>0 ? 'View Comments' : 'Leave a Comment'}}"> {!!$comments > 0 ? '<i class="fa fa-comment" aria-hidden="true"></i> <i class="fa fa-caret-right" aria-hidden="true"></i>' : '<i class="fa fa-comment-o" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>'!!}</a>	
	@foreach(\App\Rating::$thumbs as $value=>$thumb)
    <a href="javascript:PCApp.rate_ajax('{{$type}}',{{$id}},{{$sid}},{{$value}})" title="{{!empty($calculated) && $calculated==$value ? 'calculated - ' : ''}} {{$thumb[0]}}" class="rating-thumb rating{{$value}} {{!empty($rated) && $rated==$value ? 'selected' : ''}} {{!empty($rated) && $rated!=$value ? 'not-selected' : ''}} {{!empty($calculated) && $calculated==$value ? 'calculated' : ''}}"><i class="fa {{$thumb[1]}}" aria-hidden="true"></i></a>
    @endforeach
</div>
@else
<div class="rating-box text-right" id="ratingBoxSection{{$sid}}" style="margin-top:3px;">
	<a href="javascript:PCApp.Documents.show_comments('section',{{$sid}})" class="pull-left comment-icon" title="{{$comments>0 ? 'View Comments' : 'Leave a Comment'}}"> {!!$comments > 0 ? '<i class="fa fa-comment" aria-hidden="true"></i> <i class="fa fa-caret-right" aria-hidden="true"></i>' : '<i class="fa fa-comment-o" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>'!!}</a>	
	<a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
</div>
@endif
