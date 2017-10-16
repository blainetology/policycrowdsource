@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <span class="pull-right policy-rating rating_{{round($policy->rating)}}"> &nbsp; RATING &nbsp; </span><br clear="both" />
            @if(\Auth::check())
            <div class="rating-box policy-rating pull-right text-right" id="ratingBoxPolicy{{$policy->id}}">
                <a href="javascript:rate_ajax({{$policy->id}},null,-2,'not-support-2')" title="strongly do not support" class="rating-thumb not-support-2"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> &nbsp;
                <a href="javascript:rate_ajax({{$policy->id}},null,-1,'not-support-1')" title="do not support" class="rating-thumb not-support-1"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a> &nbsp;
                <a href="javascript:rate_ajax({{$policy->id}},null,1,'support-1')" title="support" class="rating-thumb support-1"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> &nbsp;
                <a href="javascript:rate_ajax({{$policy->id}},null,2,'support-2')" title="strongly support" class="rating-thumb support-2"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
            </div>
            @else
            <div class="rating-box" align="center" style="margin-top:3px;">
                <a href="javascript:showLoginModal()" class="btn btn-xs btn-default">Login to Rate</a>
            </div>
            @endif
            <h1 class="policy-title">{{$policy->name}}</h1>
            <hr class="clearfix" />
            {{ print_r($ratings,true) }}
            @foreach($sections as $section1)
                <div id="section-container-{{$section1['id']}}" class="section-container rating_{{round($section1['rating'])}} row">
                    <div class="col-md-12">
                        <div class="row policy-section" id="section-{{$section1['id']}}">
                            <div class="col-md-10">
                                @if(!empty($section1['title']))
                                    <h2>{{$section1['title']}} <small>({{$section1['id']}})</small></h2>
                                @endif
                                @if(!empty($section1['content']))
                                    <p>{{$section1['content']}}</p>
                                @endif
                            </div>
                            <div class="col-md-2">
                               @include('partials.ratings-thumbs', ['pid'=>$policy->id,'sid'=>$section1['id'], 'rated'=>\App\Rating::getSectionRating($section1['id'],$ratings)])
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
                                                        <h3>{{$section2['title']}} <small>({{$section2['id']}})</small></h3>
                                                    @endif
                                                    @if(!empty($section2['content']))
                                                        <p>{{$section2['content']}}</p>
                                                    @endif
                                                </div>
                                                <div class="col-md-2">
                                                  @include('partials.ratings-thumbs',['pid'=>$policy->id, 'sid'=>$section2['id'], 'rated'=>\App\Rating::getSectionRating($section2['id'],$ratings)])
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
                                                                            <h4>{{$section3['title']}} <small>({{$section3['id']}})</small></h4>
                                                                        @endif
                                                                        @if(!empty($section3['content']))
                                                                            <p>{{$section3['content']}}</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                       @include('partials.ratings-thumbs',['pid'=>$policy->id, 'sid'=>$section3['id'], 'rated'=>\App\Rating::getSectionRating($section3['id'],$ratings)])
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
function rate_ajax(pid,sid,rating,which){
    if(sid){
        $.get('/rate/p/'+pid+'/s/'+sid+'/r/'+rating);
        $('#ratingBoxSection'+sid+' .rating-thumb').not('.'+which).removeClass('selected').addClass('not-selected');
        $('#ratingBoxSection'+sid+' .'+which).addClass('selected');
    }
    else{
        $.get('/rate/p/'+pid+'/r/'+rating);
        $('#ratingBoxPolicy'+pid+' .rating-thumb').not('.'+which).removeClass('selected').addClass('not-selected');
        $('#ratingBoxPolicy'+pid+' .'+which).addClass('selected');
    }
}
    
</script>
@append
