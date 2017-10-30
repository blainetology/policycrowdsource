@if($comments->count() > 0)
<div class="comments-div" id="commentsBox{{$section_id}}">
	<strong>Comments</strong><br/>
	@foreach($comments as $comment)
		<div class="comment-div small bg-info" data-comment="{{$comment->id}}" id="comment{{$comment->id}}"> 
			{{\Shared\ViewHelpers::date($comment->created_at,true)}} by {{$comment->user ? $comment->user->short_name() : '[DELETED]'}}<br/>
			<p>{{$comment->comment}}</p>
		</div>
	@endforeach
</div>
@endif