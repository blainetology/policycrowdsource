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
        </div>
        <div class="col-md-3">
            <div class="well well-sm">
                <span class="pull-left policy-rating rating_{{round($rfp->rating)}}"> {{number_format($rfp->rating_count,0)}} Votes </span>
                <div class="rating-box policy-rating pull-right text-right" id="ratingBoxRfp{{$rfp->id}}">
                @if(\Auth::check())
                    <?php 
                    if($ratings['rfp']){
                        $rated=$ratings['rfp']['rating'];
                        $calculated=$ratings['rfp']['calculated_rating'];
                    }
                    ?>
                    @foreach(\App\Rating::$thumbs as $value=>$thumb)
                    <a href="javascript:rate_ajax({{$rfp->id}},{{$value}})" title="{{!empty($calculated) && $calculated==$value ? 'calculated - ' : ''}} {{$thumb[0]}}" class="rating-thumb rating{{$value}} {{!empty($rated) && $rated==$value ? 'selected' : ''}} {{!empty($rated) && $rated!=$value ? 'not-selected' : ''}} {{!empty($calculated) && $calculated==$value ? 'calculated' : ''}}"><i class="fa {{$thumb[1]}}" aria-hidden="true"></i></a>
                    @endforeach
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
