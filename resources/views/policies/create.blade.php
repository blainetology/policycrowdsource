@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Draft a Policy</h1>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            {{Form::open(['route'=>'policies.store', 'class'=>'form'])}}
                <label for="policytitle">Policy Title</label><br/>
                {{Form::text('policytitle',null,['name'=>'policy[name]', 'class'=>'form-control'])}}
                <br/>

                <label for="policytitle">Short Synopsis</label><br/>
                {{Form::text('shortsynopsis',null,['name'=>'policy[short_synopsis]', 'class'=>'form-control'])}}
                <br/>

                <label for="policytitle">Full Synopsis</label><br/>
                {{Form::textarea('fullsynopsis',null,['name'=>'policy[full_synopsis]', 'class'=>'form-control', 'rows'=>4])}}
                <br/>

                <button type="submit" class="btn btn-lg btn-success">Create Policy</button>
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection
