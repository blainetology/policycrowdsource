@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>{{!empty($document['id']) ? 'Update' : 'Draft a '}} Questionnaire</h1>
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

                <div class="text-left"><a href="javascript:PCApp.add_question({{$document['id']}})" class="btn btn-sm btn-info">add question</a></div><br/>
                <div id="questionsContainer">
                    @if($sections)
                        @foreach($sections as $secindex=>$section)
                        <div class="form-group" id="question{{$secindex}}">
                            <div class="input-group" id="subSections{{$secindex}}">
                                <span class="input-group-addon" id="basic-addon{{$secindex}}">Ques. {{$secindex+1}}</span>
                                {{Form::text('sectioncontent'.$secindex,(!empty($section['content']) ? $section['content'] : null),['name'=>'sections['.$section['id'].'][content]', 'id'=>'sectioncontent'.$secindex, 'class'=>'form-control', 'placeholder'=>'Question'])}}
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <button type="submit" class="btn btn-lg btn-success">{{!empty($document['id']) ? 'Update' : 'Create'}} Questionnaire</button>
            {{Form::close()}}
            <br/>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function($){
        PCApp.textarea_auto_size();
    });
</script>
@append