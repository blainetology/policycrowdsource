@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>{{!empty($policy['id']) ? 'Update' : 'Draft a '}} Policy</h1>
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

@section('styles')
<style type="text/css">
    textarea.section-content{height:1em; overflow:hidden;}
</style>
@append

@section('scripts')
<script type="text/javascript">
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function textareainit () {
    var text = $('.section-content');

    function resize () {
        console.log('resize');
        $.each(text,function(index,value){
            var scrollHeight = this.scrollHeight;
            //$(this).css('height','auto');
            this.style.height = scrollHeight+'px';
        });
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    $.each(text,function(index,value){
        observe(this, 'change',  resize);
        observe(this, 'cut',     delayedResize);
        observe(this, 'paste',   delayedResize);
        observe(this, 'drop',    delayedResize);
        observe(this, 'keydown', delayedResize);
    });

    resize();
}    
$(document).ready(function(){
    textareainit();
});
</script>
@append