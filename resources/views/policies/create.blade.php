@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>{{!empty($document['id']) ? 'Update' : 'Draft a '}} Policy</h1>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            @if(!empty($document['id']))
            {{Form::open(['route'=>['policies.update',$document['id']], 'method'=>'PUT', 'class'=>'form'])}}
            @else
            {{Form::open(['route'=>'policies.store', 'class'=>'form'])}}
            @endif
                <label for="policytitle">Policy Title</label><br/>
                {{Form::text('policytitle',(!empty($input['name']) ? $input['name'] : null),['name'=>'policy[name]', 'class'=>'form-control'])}}
                <br/>

                <label for="policytitle">Short Synopsis</label><br/>
                {{Form::text('shortsynopsis',(!empty($input['short_synopsis']) ? $input['short_synopsis'] : null),['name'=>'policy[short_synopsis]', 'class'=>'form-control'])}}
                <br/>

                <label for="policytitle">Full Synopsis</label><br/>
                {{Form::textarea('fullsynopsis',(!empty($input['full_synopsis']) ? $input['full_synopsis'] : null),['name'=>'policy[full_synopsis]', 'class'=>'form-control auto-size', 'rows'=>4])}}
                <br/>

                @if(!empty($document))
                    <hr/>
                    <div class="text-left"><a href="javascript:PCApp.add_{{$document['type']}}_section({{$document['id']}},0)" class="btn btn-xs btn-info">new top section</a></div>
                    <div id="subSections0">
                        @include('partials.sectionsedit',['sections'=>$sections,'document'=>$document])         
                    </div>
                    <br/>
                @endif

                <button type="submit" class="btn btn-lg btn-success">{{!empty($document['id']) ? 'Update' : 'Create'}} Policy</button>
                <br/><br/>
            {{Form::close()}}
        </div>
    </div>
</div>
@endsection

@section('styles')
<style type="text/css">
    textarea.auto-size{height:1em; overflow:hidden;}
</style>
@append

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function($){
        PCApp.textarea_auto_size();
        @if(!empty($document))
        $('.document-section').on('keyup',function(){
            var section_id = $(this).data('section');
            PCApp.update_rfp_section({{(int)$document['id']}},section_id,$('#sectionTitle'+section_id).val(),$('#sectionContent'+section_id).val());
        });
        @endif
    });
</script>
@append