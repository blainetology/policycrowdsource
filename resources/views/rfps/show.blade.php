@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <strong class="label label-sm label-success">Request for Policy</strong>
            <h1>{{$document->name}}<br/><small>{!!$document->short_synopsis!!}</small></h1>
            <p class="small">
                <strong>categories:</strong> {{$document->categories}}
            </p>
            <p class="small">
                <strong>tags:</strong> {{$document->tags}}
            </p>
            <p class="small">
            <strong>Prepared and Submitted By:</strong> 
                <?php 
                $collabs=[]; 
                foreach($document->collaborators as $cindex=>$collaborator){
                    if($collaborator->user)
                        $collabs[]=$collaborator->user->full_name();
                }
                ?>
                {{implode(', ',$collabs)}} 
            </p>
            @include('partials/comments',['comments'=>\App\Comment::forDocument($document->id)->with('user')->get(),'type'=>'document','id'=>$document->id])
        </div>
        <div class="col-md-3">
            <div class="well well-sm">
                <?php 
                    $document->political_rating = round($document->political_rating);
                    if($document->political_rating == -0)
                        $document->political_rating = 0;
                ?>
                <span class="pull-left document-rating policy-rating rating_{{$document->political_rating}}"> {{number_format($document->ratings_count,0)}} Votes </span>
                &nbsp; &nbsp; 
                <a href="javascript:PCApp.show_comments('document',{{$document->id}})" class="comment-icon" title="{{$document->comments->count()>0 ? 'View Comments' : 'Leave a Comment'}}"> {!!$document->comments->count() > 0 ? '<i class="fa fa-comment" aria-hidden="true"></i> <i class="fa fa-caret-right" aria-hidden="true"></i>' : '<i class="fa fa-comment-o" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>'!!}</a>   
                <div class="rating-box document-rating pull-right text-right" id="ratingBoxDocument{{$document->id}}">
                    @if(\Auth::check())
                        <?php 
                        if($ratings['document']){
                            $rated=$ratings['document']['rating'];
                            $calculated=$ratings['document']['calculated_rating'];
                        }
                        ?>
                        @foreach(\App\Rating::$thumbs as $value=>$thumb)
                        <a href="javascript:PCApp.rate_ajax({{$document->id}},null,{{$value}})" title="{{!empty($calculated) && $calculated==$value ? 'calculated - ' : ''}} {{$thumb[0]}}" class="rating-thumb rating{{$value}} {{!empty($rated) && $rated==$value ? 'selected' : ''}} {{!empty($rated) && $rated!=$value ? 'not-selected' : ''}} {{!empty($calculated) && $calculated==$value ? 'calculated' : ''}}"><i class="fa {{$thumb[1]}}" aria-hidden="true"></i></a>
                        @endforeach
                    @else
                        <a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
                    @endif
                </div>
                <br clear="both"/>
                <div style="padding:6px 0 0;">
                    {!!\App\Rating::getThumbs($document)!!}
                </div>
            </div>
        </div>
    </div>
    <hr class="clearfix" />
    <div id="subSections0">
        @include('partials.sections',['sections'=>$sections,'document'=>$document])         
    </div>
    <br/>
    @if($document->children->count()>0)
        <div class="row">
            <div class="col-lg-12"> 
                <hr/>
                <h3 class="text-info">Proposed Policies Submitted for This RFP</h3>           
            </div>
        </div>
        <div class="row">
            @foreach($document->children as $policy)
                @include('partials.policy-box',['policy'=>$policy])
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script type="text/javascript">
jQuery(document).ready(function(){
    $('[data-toggle="popover"]').popover()
})
    
</script>
@append
