<div class="comments-div" id="commentsBox{{$section_id}}">
	<strong>Comments</strong><br/>
	<div id="commentsList{{$section_id}}">
	@foreach($comments as $comment)
		<div class="comment-div small" data-comment="{{$comment->id}}" id="comment{{$comment->id}}"> 
			{{\Shared\ViewHelpers::date($comment->created_at,true)}} by {{$comment->user ? $comment->user->short_name() : '[DELETED]'}}<br/>
			<p>{{$comment->comment}}</p>
		</div>
	@endforeach
	</div>
	{{Form::textarea('commentInput'.$section_id,null,['class'=>'form-control comment-input','aria-label'=>'leave a comment','placeholder'=>'leave a comment...','rows'=>2,'maxlength'=>400, 'onKeyPress'=>"postsectioncomment(event, this, $section_id)"])}}
</div>