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
            @if(!empty($document['id']))
            {{Form::open(['route'=>['rfp.update',$document['id']], 'method'=>'PUT', 'class'=>'form'])}}
            @else
            {{Form::open(['route'=>'rfp.store', 'class'=>'form'])}}
            @endif
                <label for="policytitle">RFP Title</label><br/>
                {{Form::text('policytitle',null,['name'=>'rfp[name]', 'class'=>'form-control'])}}
                <br/>

                <label for="shortsynopsis">Short Overview</label><br/>
                {{Form::text('shortsynopsis',null,['name'=>'rfp[short_overview]', 'class'=>'form-control', 'maxlength'=>250])}}
                <br/>

                <label for="fullsynopsis">Full Details</label><br/>
                {{Form::textarea('fullsynopsis',null,['name'=>'rfp[full_details]', 'class'=>'form-control auto-size', 'rows'=>4])}}
                <br/>

                <div class="text-left"><a href="#" class="btn btn-xs btn-info">new top section</a></div>
                <div id="subSections0">
                    @include('partials.sectionsedit',['sections'=>$sections,'document'=>$document])         
                </div>

                <pre>
                <?php print_r($sections); ?>
                </pre>


                <button type="submit" class="btn btn-lg btn-success">Create RFP</button>
            {{Form::close()}}
        </div>
    </div>
    <br/><br/>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function($){
        PCApp.textarea_auto_size();
    });
</script>
@append
