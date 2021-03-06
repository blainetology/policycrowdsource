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
            @if(!empty($document['id']))
            {{Form::open(['route'=>['questions.update',$document['id']], 'method'=>'PUT', 'class'=>'form'])}}
            @else
            {{Form::open(['route'=>'questions.store', 'class'=>'form'])}}
            @endif
                <label for="policytitle">Questionnaire Title</label><br/>
                {{Form::text('policytitle',(!empty($input['name']) ? $input['name'] : null),['name'=>'document[name]', 'class'=>'form-control'])}}
                <br/>

                <label for="shortsynopsis">Short Synopsis</label><br/>
                {{Form::text('shortsynopsis',(!empty($input['short_synopsis']) ? $input['short_synopsis'] : null),['name'=>'document[short_synopsis]', 'class'=>'form-control'])}}
                <br/>

                <label for="fullsynopsis">Full Synopsis</label><br/>
                {{Form::textarea('fullsynopsis',(!empty($input['full_synopsis']) ? $input['full_synopsis'] : null),['name'=>'document[full_synopsis]', 'class'=>'form-control auto-size', 'rows'=>4])}}
                <br/>

                @if(!empty($document))
                    <hr/>

                    <div class="text-left"><a href="javascript:PCApp.add_question_section({{$document['id']}})" class="btn btn-sm btn-info">add question</a></div><br/>
                    <div id="questionsContainer">
                        @if($sections)
                            @foreach($sections as $secindex=>$section)
                            <div class="form-group" id="question{{$secindex}}">
                                <input type="hidden" value="'.$count.'" id="sectionorder{{$secindex}}" />
                                <div class="input-group" id="subSections{{$secindex}}">
                                    <span class="input-group-addon" id="basic-addon{{$secindex}}">Ques. {{$secindex+1}}</span>
                                    {{Form::text('sectioncontent'.$secindex,(!empty($section['staged_content']) ? $section['content'] : null),['name'=>'sections['.$section['id'].'][staged_content]', 'id'=>'sectioncontent'.$secindex, 'class'=>'form-control question-section question-content', 'placeholder'=>'Question'])}}
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                @endif
                
                <button type="submit" class="btn btn-lg btn-success">{{!empty($document['id']) ? 'Update' : 'Create'}} Questionnaire</button>
            {{Form::close()}}
            <br/>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function update_section(document_id,section_id){

    }
    jQuery(document).ready(function($){
        PCApp.textarea_auto_size();
    });
</script>
@append