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
          		<input type="text" name="first_name" value="{{ $user->first_name }}" placeholder="first name" class="form-control" required />
            </div>
  			    <div class="form-group">
           		<input type="text" name="last_name" value="{{ $user->last_name }}" placeholder="last name" class="form-control" required />
            </div>
  			    <div class="form-group">
           		<input type="email" name="email" value="{{ $user->email }}" placeholder="email" class="form-control" required />
            </div>
  			    <div class="form-group">
            	<input type="submit" value="update information" class="btn btn-md btn-primary" />
    				</div>
          @endif
        </form>
      </div>


                
      <div class="well">
        <h4>Update Password</h4>

        @if(!empty($submit_message)){
          <p><em>{{ $submit_message }}</em></p>
        @endif
        <form method="POST" role="form">
			    <div class="form-group">
            <input type="password" name="password1" placeholder="new password" class="form-control" required />
  				</div>
			    <div class="form-group">
            <input type="password" name="password2" placeholder="confirm password" class="form-control" required />
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