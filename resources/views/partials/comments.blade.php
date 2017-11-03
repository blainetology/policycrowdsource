<div class="comments-div" id="commentsBox{{$section_id}}">
	<strong>Comments</strong><br/>
	<div id="commentsList{{$section_id}}">
	@foreach($comments as $comment)
		@include('partials.comment',['comment'=>$comment])
	@endforeach
	</div>
	@if(\Auth::check())
	{{Form::textarea('commentInput'.$section_id,null,['class'=>'form-control comment-input','aria-label'=>'leave a comment','placeholder'=>'leave a comment...','rows'=>2,'maxlength'=>400, 'onKeyPress'=>"postsectioncomment(event, this, $section_id)"])}}
	@else
	<a href="javascript:showLoginModal()" class="btn btn-sm btn-default">Login to Leave a Comment</a>
	@endif
</div>