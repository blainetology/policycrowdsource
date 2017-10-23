@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" id="homepageslide">
            <br/><br/><br/><br/>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="well">
                        <h3 class="text-center text-primary">{{config('app.description')}}</h3>
                        <br/>
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="input-group">
                                    <input type="text" class="form-control input-primary" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Go!</button>
                                    </span>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                        <br/>
                        <div class="row">
                            <div class="col-lg-12 text-center hidden-xs">
                                <a href="{{route('policies.index')}}" class="btn btn-info">Browse Policies</a> &nbsp; 
                                <a href="#" class="btn btn-warning">Draft a Policy</a> &nbsp; 
                                <a href="#" class="btn btn-success">Submit a RFP</a>
                            </div>
                            <div class="col-lg-12 text-center hidden-sm hidden-md hidden-lg">
                                <a href="{{route('policies.index')}}" class="btn btn-sm btn-info">View Policies</a> 
                                <a href="#" class="btn btn-sm btn-warning">Draft Policy</a>
                                <a href="#" class="btn btn-sm btn-success">Submit RFP</a>
                            </div>
                        </div>
                        <br/>

                    </div>
                </div>
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

<div class="container-fluid bg-info">
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
<div class="container-fluid bg-success">
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

<div class="container-fluid bg-warning">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Respond to Requests For Policy</h3>
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
    #homepageslide{background:url(/images/homepagebg.jpg) center center no-repeat; background-size: cover; height:70vh; min-height: 400px;}
</style>
@append
