@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>{{!empty($policy['id']) ? 'Update' : 'Draft a '}} Questionnaire</h1>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            {{Form::open(['route'=>'policies.store', 'class'=>'form'])}}
                <label for="policytitle">Policy Title</label><br/>
                {{Form::text('policytitle',(!empty($input['name']) ? $input['name'] : null),['name'=>'policy[name]', 'class'=>'form-control'])}}
                <br/>

                <label for="policytitle">Short Synopsis</label><br/>
                {{Form::text('shortsynopsis',(!empty($input['short_synopsis']) ? $input['short_synopsis'] : null),['name'=>'policy[short_synopsis]', 'class'=>'form-control'])}}
                <br/>

                <label for="policytitle">Full Synopsis</label><br/>
                {{Form::textarea('fullsynopsis',(!empty($input['full_synopsis']) ? $input['full_synopsis'] : null),['name'=>'policy[full_synopsis]', 'class'=>'form-control', 'rows'=>4])}}
                <br/>

                <hr/>

                <div class="text-left"><a href="#" class="btn btn-xs btn-info">new top section</a></div>
                <div id="subSections0">
                    @include('partials.sectionsedit',['sections'=>$sections,'document'=>$document])         
                </div>

                <pre>
                <?php print_r($sections); ?>
                </pre>

                <button type="submit" class="btn btn-lg btn-success">{{!empty($policy['id']) ? 'Update' : 'Create'}} Policy</button>
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection
