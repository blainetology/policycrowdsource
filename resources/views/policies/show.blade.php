@extends('layouts.app')

@section('content')
<br/>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <h1>{{$policy->name}}</h1>
                    <p class="small">
                    <strong>Prepared by:</strong> 
                    @foreach($policy->collaborators as $cindex=>$collaborator)
                        @if($cindex<$policy->collaborators->count()-1 && $policy->collaborators->count()>2)
                            {{$collaborator->user->full_name()}},  
                        @elseif($cindex<$policy->collaborators->count()-1)
                            {{$collaborator->user->full_name()}}  
                        @else 
                            &amp; {{$collaborator->user->full_name()}} 
                        @endif
                    @endforeach
                    </p>
                    <p>{{$policy->full_synopsis}}</p>
                </div>
                <div class="col-md-3">
                    <span class="pull-left policy-rating rating_{{round($policy->rating)}}"> {{number_format($policy->rating_count,0)}} Votes </span>
                    <div class="rating-box policy-rating pull-right text-right" id="ratingBoxPolicy{{$policy->id}}">
                    @if(\Auth::check())
                        <a href="javascript:rate_ajax({{$policy->id}},null,-2)" title="strongly do not support" class="rating-thumb rating-2"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> 
                        <a href="javascript:rate_ajax({{$policy->id}},null,-1)" title="do not support" class="rating-thumb rating-1"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> 
                        <a href="javascript:rate_ajax({{$policy->id}},null,1)" title="support" class="rating-thumb rating1"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> 
                        <a href="javascript:rate_ajax({{$policy->id}},null,2)" title="strongly support" class="rating-thumb rating2"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
                    @else
                        <a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
                    @endif
                    </div>
                    <br clear="both"/>
                    {!!\App\Rating::getPolicyThumbs($policy)!!}
                </div>
            </div>
            <hr class="clearfix" />
            @foreach($sections as $section1)
                <div id="section-container-{{$section1['id']}}" class="section-container rating_{{round($section1['rating'])}} row">
                    <div class="col-md-12">
                        <div class="row policy-section" id="section-{{$section1['id']}}">
                            <div class="col-md-10">
                                @if(!empty($section1['title']))
                                    <h2>{{$section1['title']}}</h2>
                                @endif
                                @if(!empty($section1['content']))
                                    <p>{!!nl2br($section1['content'])!!}</p>
                                @endif
                            </div>
                            <div class="col-md-2">
                               @include('partials.ratings-thumbs', ['pid'=>$policy->id,'sid'=>$section1['id'], 'rating'=>\App\Rating::getSectionRating($section1['id'],$ratings)])
                            </div>
                        </div>
                        @if(!empty($section1['sections']))
                            <div id="sub-sections-{{$section1['id']}}">
                                @foreach($section1['sections'] as $section2)
                                    <div id="section-container-{{$section2['id']}}" class="section-container rating_{{round($section2['rating'])}} row">
                                        <div class="col-md-12">
                                            <div class="row policy-section" id="section-{{$section2['id']}}">
                                                <div class="col-md-10">
                                                    @if(!empty($section2['title']))
                                                        <h3>{{$section2['title']}}</h3>
                                                    @endif
                                                    @if(!empty($section2['content']))
                                                        <p>{!!nl2br($section2['content'])!!}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                  @include('partials.ratings-thumbs',['pid'=>$policy->id, 'sid'=>$section2['id'], 'rating'=>\App\Rating::getSectionRating($section2['id'],$ratings)])
                                                </div>
                                            </div>
                                            @if(!empty($section2['sections']))
                                                <div id="sub-sections-{{$section2['id']}}">
                                                    @foreach($section2['sections'] as $section3)
                                                        <div id="section-container-{{$section3['id']}}" class="section-container rating_{{round($section3['rating'])}} row">
                                                            <div class="col-md-12">
                                                                <div class="row policy-section" id="section-{{$section3['id']}}">
                                                                    <div class="col-md-10">
                                                                        @if(!empty($section3['title']))
                                                                            <h4>{{$section3['title']}}</h4>
                                                                        @endif
                                                                        @if(!empty($section3['content']))
                                                                            <p>{!!nl2br($section3['content'])!!}</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                       @include('partials.ratings-thumbs',['pid'=>$policy->id, 'sid'=>$section3['id'], 'rating'=>\App\Rating::getSectionRating($section3['id'],$ratings)])
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            <br/><br/>
            <pre style="display:none;">
            {!! print_r($sections,true) !!}
            </pre>
        </div>
    </div>
</div>
@include('auth.login-modal')
@endsection

@section('scripts')
<script type="text/javascript">
function rate_ajax(pid,sid,rating){
    if(sid){
        $.get('/rate/p/'+pid+'/s/'+sid+'/r/'+rating,null,function(html){console.log(html)});
        $('#ratingBoxSection'+sid+' .rating-thumb').not('.rating'+rating).removeClass('selected').addClass('not-selected');
        $('#ratingBoxSection'+sid+' .rating'+rating).addClass('selected');
    }
    else{
        $.get('/rate/p/'+pid+'/r/'+rating);
        $('#ratingBoxPolicy'+pid+' .rating-thumb').not('.rating'+rating).removeClass('selected').addClass('not-selected');
        $('#ratingBoxPolicy'+pid+' .rating'+rating).addClass('selected');
    }
}
jQuery(document).ready(function(){
    $('[data-toggle="popover"]').popover()
})
    
</script>
@append
