@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <strong class="label label-sm label-info">
            @if($policy->starter_policy==1)
            Example Policy
            @else
            Submitted Policy
            @endif
            </strong>
            <h1>{{$policy->name}}</h1>
            <p class="small">
                <strong>Prepared by:</strong> 
                <?php 
                $collabs=[]; 
                foreach($policy->collaborators as $cindex=>$collaborator){
                    if($collaborator->user)
                        $collabs[]=$collaborator->user->full_name();
                }
                ?>
                {{implode(', ',$collabs)}} 
            </p>
            <p>{{$policy->full_synopsis}}</p>
        </div>
        <div class="col-md-3">
            <div class="well well-sm">
                <span class="pull-left policy-rating rating_{{round($policy->rating)}}"> {{number_format($policy->ratings_count,0)}} Votes </span>
                <div class="rating-box policy-rating pull-right text-right" id="ratingBoxPolicy{{$policy->id}}">
                @if(\Auth::check())
                    <?php 
                    if($ratings['policy']){
                        $rated=$ratings['policy']['rating'];
                        $calculated=$ratings['policy']['calculated_rating'];
                    }
                    ?>
                    @foreach(\App\Rating::$thumbs as $value=>$thumb)
                    <a href="javascript:rate_ajax({{$policy->id}},null,{{$value}})" title="{{!empty($calculated) && $calculated==$value ? 'calculated - ' : ''}} {{$thumb[0]}}" class="rating-thumb rating{{$value}} {{!empty($rated) && $rated==$value ? 'selected' : ''}} {{!empty($rated) && $rated!=$value ? 'not-selected' : ''}} {{!empty($calculated) && $calculated==$value ? 'calculated' : ''}}"><i class="fa {{$thumb[1]}}" aria-hidden="true"></i></a>
                    @endforeach
                @else
                    <a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
                @endif
                </div>
                <br clear="both"/>
                <div style="padding:6px 0 0;">
                    {!!\App\Rating::getPolicyThumbs($policy)!!}
                </div>
            </div>
        </div>
    </div>
    <hr class="clearfix" />
    <div id="subSections0">
        @include('policies.sections',['sections'=>$sections])         
    </div>
    <br/><br/>

</div>
@include('auth.login-modal')
@endsection

@section('scripts')
<script type="text/javascript">
function get_policy_sections(parent_id){
    $('#subSections'+parent_id).html('Loading...').css({borderBottom:'8px solid #F00',padding:'15px 0',marginBottom:'16px'});
    $.get('/policies/sections/{{$policy->id}}/'+parent_id,null,function(html){
        $('#subSections'+parent_id).html(html);
    });
}
function show_section_comments(section_id){
    $('#commentsBox'+section_id).slideDown(500);
}
function rate_ajax(pid,sid,rating){
    if(sid){
        $.get('/rate/p/'+pid+'/s/'+sid+'/r/'+rating,null,function(data){
            if(data['calculated']){
                if(data['calculated'][2]=='section'){
                    $('#ratingBoxSection'+data['calculated'][0]+' .rating-thumb').removeClass('calculated');
                    if(data['calculated'][1]){
                        $('#ratingBoxSection'+data['calculated'][0]).addClass('rating-calculated');
                        $('#ratingBoxSection'+data['calculated'][0]+' .rating'+data['calculated'][1]).addClass('calculated');
                    }
                    else
                        $('#ratingBoxSection'+data['calculated'][0]).removeClass('rating-calculated');
                }
                else if(data['calculated'][2]=='policy'){
                    $('#ratingBoxPolicy'+data['calculated'][0]+' .rating-thumb').removeClass('calculated');
                    if(data['calculated'][1])
                        $('#ratingBoxPolicy'+data['calculated'][0]+' .rating'+data['calculated'][1]).addClass('calculated');
                }
            }
        });
        $('#ratingBoxSection'+sid+' .rating-thumb').not('.rating'+rating).removeClass('selected').addClass('not-selected');
        $('#ratingBoxSection'+sid+' .rating'+rating).removeClass('calculated').addClass('selected');
        $('#ratingBoxSection'+sid).removeClass('rating-calculated');
    }
    else{
        $.get('/rate/p/'+pid+'/r/'+rating);
        $('#ratingBoxPolicy'+pid+' .rating-thumb').not('.rating'+rating).removeClass('selected').addClass('not-selected');
        $('#ratingBoxPolicy'+pid+' .rating'+rating).addClass('selected');
    }
}
function postsectioncomment(e, textarea, sid){
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code == 13)
        axios.post('/comment/section/'+sid,{section_id:sid, comment:textarea.value}).then(function(response){ $('#commentsList'+sid).append(response.data); }).catch(function(error){ console.log(error); });
}
function postpolicycomment(e, textarea, pid){
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code == 13)
        axios.post('/comment/policy/'+pid,{policy_id:pid, comment:textarea.value}).then(function(response){ $('#commentsList'+sid).append(response.data); }).catch(function(error){ console.log(error); });
}
jQuery(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    //get_policy_sections(0);
});
    
</script>
@append
