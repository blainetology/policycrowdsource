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
            {{Form::open(['route'=>'rfp.store', 'class'=>'form'])}}
                <label for="policytitle">RFP Title</label><br/>
                {{Form::text('policytitle',null,['name'=>'rfp[name]', 'class'=>'form-control'])}}
                <br/>

                <label for="shortsynopsis">Short Overview</label><br/>
                {{Form::text('shortsynopsis',null,['name'=>'rfp[short_overview]', 'class'=>'form-control', 'maxlength'=>250])}}
                <br/>

                <label for="fullsynopsis">Full Details</label><br/>
                {{Form::textarea('fullsynopsis',null,['name'=>'rfp[full_details]', 'class'=>'form-control', 'rows'=>16])}}
                <br/>

                <button type="submit" class="btn btn-lg btn-success">Create RFP</button>
            {{Form::close()}}
        </div>
    </div>
    <br/><br/>
</div>
@endsection
