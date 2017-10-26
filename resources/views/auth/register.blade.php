@extends('layouts.app')

@section('content')
<br/><br/>
<div class="container">

    <div class="row">
        <div class="col-lg-12">
            <h1>Create an Account</h1>
        </div>
    </div>
    <hr/>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <h4 class="text-primary">Personal Info</h4>
                        <div class="well">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-3 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-3 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <h4 class="text-primary">Password</h4>
                        <div class="well">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-3 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <h4 class="text-primary">Political Leaning</h4>
                        <div class="well">
                            <input type="hidden" name="political_weight" id="political_weight" value="0"/>
                            <div class="small" style="line-height:1.3;">In order to properly rank and gauge the ideaological support of each policy, we ask that you specify how you see yourself on the political spectrum. This information will not be viewed by {{config('app.name')}} or used by other people.</div>
                            <div style="padding:10px 0 0; height: 36px;">
                                <a href="javascript:setPoliWeight(-4)" class="rating_-4 setting-rating">liberal</a>
                                <a href="javascript:setPoliWeight(-3)" class="rating_-3 setting-rating">&nbsp;</a>
                                <a href="javascript:setPoliWeight(-2)" class="rating_-2 setting-rating">&nbsp;</a>
                                <a href="javascript:setPoliWeight(-1)" class="rating_-1 setting-rating">&nbsp;</a>
                                <a href="javascript:setPoliWeight(0)" class="rating_0 setting-rating">moderate</a>
                                <a href="javascript:setPoliWeight(1)" class="rating_1 setting-rating">&nbsp;</a>
                                <a href="javascript:setPoliWeight(2)" class="rating_2 setting-rating">&nbsp;</a>
                                <a href="javascript:setPoliWeight(3)" class="rating_3 setting-rating">&nbsp;</a>
                                <a href="javascript:setPoliWeight(4)" class="rating_4 setting-rating">conservative</a>
                            </div>
                        </div>
                        <br/>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function setPoliWeight(weight){
        $('#political_weight').val(weight);
        $('.setting-rating.selected').removeClass('selected');
        $('.setting-rating.rating_'+weight).addClass('selected');
    }
</script>
@append
