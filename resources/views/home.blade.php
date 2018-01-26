@extends('layouts.app')

@section('content')
<div class="container-fluid" id="homepageslide">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="hidden-xs hidden-sm"><br/><br/><br/><br/></div>
                <div class="hidden-xs"><br/><br/><br/><br/></div>
                <div><br/><br/><br/><br/></div>

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                        <div class="well">
                            <h3 class="text-center text-primary">{{config('app.description')}}</h3>
                            <br/>
                            <div class="row">
                                {{Form::open(['route'=>'browse.index','method'=>'GET'])}}
                                <div class="col-lg-10 col-lg-offset-1">
                                    <div class="input-group">
                                        <input type="text" class="form-control input-primary" placeholder="Search for...">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">Go!</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div><!-- /.col-lg-6 -->
                                {{Form::close()}}
                            </div><!-- /.row -->
                            <br/>

                        </div>
                    </div>
                </div>

                <div class="hidden-xs hidden-sm"><br/><br/><br/><br/></div>
                <div class="hidden-xs"><br/><br/><br/><br/></div>
                <div><br/><br/><br/><br/></div>

            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Try Rating These Classic Documents to Get You Started</h3>
                <p>{{config('app.name')}} was created, in part, to encourage everyone to take more time to read and scrutinize the policies that we follow today. Who is this policy good for? Does it unfairly favor a group? Does it seem rather arbitrary? Here are some famous historical documents. Read them and rate each section. Decide for yourself what still holds up or what hundreds of years of application could use some revising.</p>
            </div>
        </div>
        <div class="row">
            @foreach($house_policies as $policy)
                @include('partials.policy-box',['policy'=>$policy])
            @endforeach
        </div>
    </div>
</div>

<div class="container-fluid container-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Review and Rate Policies Submitted By Our Users</h3>
                <p>{{config('app.name')}} encourages everyone to collaborate and propose new policies. They best policies should come when more an more people are allowed to give input on them. Whether it is a school, homeowners association, or goverment policy.</p>
            </div>
        </div>
        <div class="row">
            @foreach($submitted_policies as $policy)
                @include('partials.policy-box',['policy'=>$policy])
            @endforeach
        </div>
    </div>
</div>

@if(isset($my_policies) && $my_policies->count()>0)
<div class="container-fluid container-two">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>My Policies</h3>
            </div>
        </div>
        <div class="row">
            @foreach($my_policies as $policy)
                @include('partials.policy-box',['policy'=>$policy])
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="container-fluid container-three">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Respond to Questionnaires</h3>
                <p>{{config('app.name')}} attempts to check the pulse of the country on any range of issues. It doesn't always need to be through a new prooposed policy. Sometimes this can be accomplished through a series of questions to establish a baseline and a good starting point when crafting a policy. Responding to these questionnaires helps all policy makers understand better where we stand collectively.</p>
            </div>
        </div>
        <div class="row">
            @foreach($questions as $question)
                @include('partials.question-box',['question'=>$question])
            @endforeach
        </div>
    </div>
</div>
<div class="container-fluid container-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Respond to Requests For Policy</h3>
                <p>Ask the world for their proposals for specific policies. We may not always know the best way to change policy, but we know what topics need to be addressed. {{config('app.name')}} encourages anyone to submit a request for policy and encourages anyone to respond with a proposed policy.</p>
            </div>
        </div>
        <div class="row">
            @foreach($rfps as $rfp)
                @include('partials.rfp-box',['rfp'=>$rfp])
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
    #homepageslide{background:url(/images/homepagebg.jpg) center center no-repeat fixed; background-size: cover; }
    #filler2{background:url(/images/homepagebg4.jpg) center center no-repeat fixed #69C; background-size: cover; }
</style>
@append
