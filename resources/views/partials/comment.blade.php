<div class="comment-div small" data-comment="{{$comment->id}}" id="comment{{$comment->id}}"> 
	<strong class="text-primary">{{\Shared\ViewHelpers::date($comment->created_at,true)}}</strong> by <strong class="text-primary">{{$comment->user ? $comment->user->short_name() : '[DELETED]'}}</strong>
	<p>{{$comment->comment}}</p>
</div>
