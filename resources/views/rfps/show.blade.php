@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-9">
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
        </div>
        <div class="col-md-3">
            <div class="well well-sm">
                <span class="pull-left policy-rating rating_{{round($rfp->rating)}}"> {{number_format($rfp->rating_count,0)}} Votes </span>
                <div class="rating-box policy-rating pull-right text-right" id="ratingBoxRfp{{$rfp->id}}">
                @if(\Auth::check())
                    <a href="javascript:rate_ajax({{$rfp->id}},-2)" title="strongly do not support" class="rating-thumb rating-2"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> 
                    <a href="javascript:rate_ajax({{$rfp->id}},-1)" title="do not support" class="rating-thumb rating-1"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> 
                    <a href="javascript:rate_ajax({{$rfp->id}},1)" title="support" class="rating-thumb rating1"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> 
                    <a href="javascript:rate_ajax({{$rfp->id}},2)" title="strongly support" class="rating-thumb rating2"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
                @else
                    <a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
                @endif
                </div>
                <br clear="both"/>
                <div style="padding:6px 0 0;">
                    {!!\App\Rating::getPolicyThumbs($rfp)!!}
                </div>
            </div>
        </div>
    </div>
    <hr class="clearfix" />
    <div class="row">
        <div class="col-md-12">
            <p>{!!$rfp->full_details!!}</p>
        </div>
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
@include('auth.login-modal')
@endsection

@section('scripts')
<script type="text/javascript">
function rate_ajax(rid,rating){
    $.get('/rate/r/'+rid+'/r/'+rating);
    $('#ratingBoxRfp'+rid+' .rating-thumb').not('.rating'+rating).removeClass('selected').addClass('not-selected');
    $('#ratingBoxRfp'+rid+' .rating'+rating).addClass('selected');
}
jQuery(document).ready(function(){
    $('[data-toggle="popover"]').popover()
})
    
</script>
@append
