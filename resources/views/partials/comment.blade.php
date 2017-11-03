<div class="comment-div small" data-comment="{{$comment->id}}" id="comment{{$comment->id}}"> 
	{{\Shared\ViewHelpers::date($comment->created_at,true)}} by {{$comment->user ? $comment->user->short_name() : '[DELETED]'}}<br/>
	<p>{{$comment->comment}}</p>
</div>
