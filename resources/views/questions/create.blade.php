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
            {{Form::open(['route'=>'questions.store', 'class'=>'form'])}}
                <label for="policytitle">Questionnaire Title</label><br/>
                {{Form::text('policytitle',(!empty($input['name']) ? $input['name'] : null),['name'=>'document[name]', 'class'=>'form-control'])}}
                <br/>

                <label for="shortsynopsis">Short Synopsis</label><br/>
                {{Form::text('shortsynopsis',(!empty($input['short_synopsis']) ? $input['short_synopsis'] : null),['name'=>'document[short_synopsis]', 'class'=>'form-control'])}}
                <br/>

                <label for="fullsynopsis">Full Synopsis</label><br/>
                {{Form::textarea('fullsynopsis',(!empty($input['full_synopsis']) ? $input['full_synopsis'] : null),['name'=>'document[full_synopsis]', 'class'=>'form-control', 'rows'=>4])}}
                <br/>

                <hr/>

                @if($sections)
                <div class="text-left"><a href="#" class="btn btn-sm btn-info">add question</a></div><br/>
                @foreach($sections as $secindex=>$section)
                <div class="form-group">
                    <div class="input-group" id="subSections{{$secindex}}">
                        <span class="input-group-addon" id="basic-addon{{$secindex}}">Ques. {{$secindex+1}}</span>
                        {{Form::text('sectioncontent'.$secindex,(!empty($section['content']) ? $section['content'] : null),['name'=>'sections['.$section['id'].'][content]', 'id'=>'sectioncontent'.$secindex, 'class'=>'form-control', 'placeholder'=>'Question'])}}
                    </div>
                </div>
                @endforeach
                <pre class="hidden">
                <?php print_r($sections); ?>
                </pre>
                @endif

                <button type="submit" class="btn btn-lg btn-success">{{!empty($policy['id']) ? 'Update' : 'Create'}} Questionnaire</button>
            {{Form::close()}}
            <br/>
        </div>
    </div>
</div>
@endsection
