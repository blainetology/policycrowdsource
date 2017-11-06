@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <strong class="label label-sm label-success">Request for Policy</strong>
            <h1>{{$rfp->name}}<br/><small>{!!$rfp->short_overview!!}</small></h1>
            <p class="small">
            <strong>Prepared and Submitted By:</strong> 
                <?php 
                $collabs=[]; 
                foreach($rfp->collaborators as $cindex=>$collaborator){
                    if($collaborator->user)
                        $collabs[]=$collaborator->user->full_name();
                }
                ?>
                {{implode(', ',$collabs)}} 
            </p>
            @include('partials/comments',['comments'=>\App\Comment::forRfp($rfp->id)->with('user')->get(),'type'=>'rfp','id'=>$rfp->id])
        </div>
        <div class="col-md-3">
            <div class="well well-sm">
                <span class="pull-left document-rating rfp-rating rating_{{round($rfp->rating)}}"> {{number_format($rfp->ratings_count,0)}} Votes </span>
                &nbsp; &nbsp; 
                <a href="javascript:PCApp.show_comments('rfp',{{$rfp->id}})" class="comment-icon" title="{{$rfp->comments->count()>0 ? 'View Comments' : 'Leave a Comment'}}"> {!!$rfp->comments->count() > 0 ? '<i class="fa fa-comment" aria-hidden="true"></i> <i class="fa fa-caret-right" aria-hidden="true"></i>' : '<i class="fa fa-comment-o" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>'!!}</a>   
                <div class="rating-box document-rating pull-right text-right" id="ratingBoxPolicy{{$rfp->id}}">
                    @if(\Auth::check())
                        <?php 
                        if($ratings['document']){
                            $rated=$ratings['document']['rating'];
                            $calculated=$ratings['document']['calculated_rating'];
                        }
                        ?>
                        @foreach(\App\Rating::$thumbs as $value=>$thumb)
                        <a href="javascript:PCApp.rate_ajax('rfp',{{$rfp->id}},null,{{$value}})" title="{{!empty($calculated) && $calculated==$value ? 'calculated - ' : ''}} {{$thumb[0]}}" class="rating-thumb rating{{$value}} {{!empty($rated) && $rated==$value ? 'selected' : ''}} {{!empty($rated) && $rated!=$value ? 'not-selected' : ''}} {{!empty($calculated) && $calculated==$value ? 'calculated' : ''}}"><i class="fa {{$thumb[1]}}" aria-hidden="true"></i></a>
                        @endforeach
                    @else
                        <a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
                    @endif
                </div>
                <br clear="both"/>
                <div style="padding:6px 0 0;">
                    {!!\App\Rating::getThumbs($rfp)!!}
                </div>
            </div>
        </div>
    </div>
    <hr class="clearfix" />
    <div id="subSections0">
        @include('partials.sections',['sections'=>$sections,'document'=>$rfp])         
    </div>
    <br/>
    @if($rfp->policies->count()>0)
        <div class="row">
            <div class="col-lg-12"> 
                <hr/>
                <h3 class="text-info">Proposed Policies Submitted for This RFP</h3>           
            </div>
        </div>
        <div class="row">
            @foreach($rfp->policies as $policy)
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
