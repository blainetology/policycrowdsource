<div class="comments-div" id="{{$type}}CommentsBox{{$id}}">
	<div class="comment-label"><strong>Comments</strong> <span class="badge" id="{{$type}}CommentsCount{{$id}}">{{number_format($comments->count())}}</span></div>
	<div id="{{$type}}CommentsList{{$id}}">
	@foreach($comments as $comment)
		@include('partials.comment',['comment'=>$comment])
	@endforeach
	</div>
	@if(\Auth::check())
	{{Form::textarea($type.'CommentInput'.$id,null,['class'=>'form-control comment-input','aria-label'=>'leave a comment','placeholder'=>'leave a comment...','rows'=>2,'maxlength'=>400, 'onKeyPress'=>"PCApp.post_comment(event, this, '$type', $id)"])}}
	@else
	<a href="javascript:showLoginModal()" class="btn btn-sm btn-info">Login to Leave a Comment</a>
	@endif
</div>