@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">

    @include('account.menu')

    <div class="col-lg-9">
      <h2>My Settings</h2>

      <div class="well">
        <h4>Update Information</h4>
        <form method="POST" role="form">
         	@if(!empty($user->facebook_id)) 
           	<small><em>Your name and email address are maintained by <a href="https://www.facebook.com/people/@/{{ $user->facebook_id }}" target="_blank">Facebook</a> and cannot be changed here.</em></small><br/><br/>
          	<h4>{{ $user->first_name }} {{ $user->last_name }}<br/>{{ $user->email }}</h4><br/><br/>
          @else
  			    <div class="form-group">
              <label for="first_name">First Name</label>
          		<input type="text" name="first_name" value="{{ $user->first_name }}" placeholder="first name" class="form-control" id="first_name" required />
            </div>
  			    <div class="form-group">
              <label for="first_name">Last Name</label>
           		<input type="text" name="last_name" value="{{ $user->last_name }}" placeholder="last name" class="form-control" id="last_name" required />
            </div>
  			    <div class="form-group">
              <label for="first_name">Email Address</label>
           		<input type="email" name="email" value="{{ $user->email }}" placeholder="email" class="form-control" id="email" required />
            </div>
          @endif
          <br/>
          <h4>Political Leaning</h4>
          <div class="small" style="line-height:1.3;">In order to properly rank and gauge the ideaological support of each policy, we ask that you specify how you see yourself on the political spectrum. This information will not be seen or used by other people.</div>
          <div style="padding:10px 0 0; height: 36px;">
          <a href="#" class="rating_-4 setting-rating {{\Auth::user()->political_weight==-4 ? 'selected' : ''}}">liberal</a>
          <a href="#" class="rating_-3 setting-rating {{\Auth::user()->political_weight==-3 ? 'selected' : ''}}">&nbsp;</a>
          <a href="#" class="rating_-2 setting-rating {{\Auth::user()->political_weight==-2 ? 'selected' : ''}}">&nbsp;</a>
          <a href="#" class="rating_-1 setting-rating {{\Auth::user()->political_weight==-1 ? 'selected' : ''}}">&nbsp;</a>
          <a href="#" class="rating_0 setting-rating {{\Auth::user()->political_weight==0 ? 'selected' : ''}}">moderate</a>
          <a href="#" class="rating_1 setting-rating {{\Auth::user()->political_weight==1 ? 'selected' : ''}}">&nbsp;</a>
          <a href="#" class="rating_2 setting-rating {{\Auth::user()->political_weight==2 ? 'selected' : ''}}">&nbsp;</a>
          <a href="#" class="rating_3 setting-rating {{\Auth::user()->political_weight==3 ? 'selected' : ''}}">&nbsp;</a>
          <a href="#" class="rating_4 setting-rating {{\Auth::user()->political_weight==4 ? 'selected' : ''}}">conservative</a>
          </div>
          <br/>
          <br/>
          <div class="form-group">
            <input type="submit" value="update information" class="btn btn-md btn-primary" />
          </div>

        </form>
      </div>


                
      <div class="well">
        <h4>Update Password</h4>

        @if(!empty($submit_message)){
          <p><em>{{ $submit_message }}</em></p>
        @endif
        <form method="POST" role="form">
			    <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" placeholder="new password" class="form-control" required />
  				</div>
			    <div class="form-group">
            <label for="password_confirm">New Password</label>
            <input type="password" name="password_confirm" id="password_confirm" placeholder="confirm password" class="form-control" required />
			  	</div>
			    <div class="form-group">
            <input type="submit" value="update password" class="btn btn-md btn-primary" />
			   	</div>
        </form>
      </div>


      <br/>
      Member since {{ \Shared\ViewHelpers::date(\Auth::user()->created_at,true) }}
      <br/><br/><br/>
    
    </div>       
	</div>
</div>
@stop