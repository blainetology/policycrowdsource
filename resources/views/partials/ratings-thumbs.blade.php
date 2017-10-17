@if(\Auth::check())
<div class="rating-box text-right" id="ratingBoxSection{{$sid}}">
    <a href="javascript:rate_ajax({{$pid}},{{$sid}},-2)" title="strongly do not support" class="rating-thumb rating-2 {{!empty($rated) && $rated==-2 ? 'selected' : ''}} {{!empty($rated) && $rated!=-2 ? 'not-selected' : ''}}"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> &nbsp;
    <a href="javascript:rate_ajax({{$pid}},{{$sid}},-1)" title="do not support" class="rating-thumb rating-1 {{!empty($rated) && $rated==-1 ? 'selected' : ''}} {{!empty($rated) && $rated!=-1 ? 'not-selected' : ''}}"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> &nbsp;
    <a href="javascript:rate_ajax({{$pid}},{{$sid}},1)" title="support" class="rating-thumb rating1 {{!empty($rated) && $rated==1 ? 'selected' : ''}} {{!empty($rated) && $rated!=1 ? 'not-selected' : ''}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> &nbsp;
    <a href="javascript:rate_ajax({{$pid}},{{$sid}},2)" title="strongly support" class="rating-thumb rating2 {{!empty($rated) && $rated==2 ? 'selected' : ''}} {{!empty($rated) && $rated!=2 ? 'not-selected' : ''}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
</div>
@else
<div class="rating-box text-right" id="ratingBoxSection{{$sid}}" style="margin-top:3px;">
	<a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
</div>
@endif
