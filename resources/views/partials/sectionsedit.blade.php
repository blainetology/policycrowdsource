@foreach($sections as $section)
    <div id="sectionContainer{{$section['id']}}" class="section-container section-edit rating_{{round($section['political_rating'])}} row">
        <div class="col-md-12">
            <div class="row  document-section" data-section="{{$section['id']}}" id="section{{$section['id']}}">
                <div class="col-md-12">
                    <div class="form-group"> 
                    {{Form::text('section'.$section['id'],$section['title'],['name'=>'section['.$section['id'].'[title]', 'class'=>'form-control', 'placeholder'=>'section title'])}}
                    </div>
                    <div class="form-group"> 
                    {{Form::textarea('section'.$section['id'],$section['content'],['name'=>'section['.$section['id'].'[content]', 'class'=>'form-control auto-size', 'placeholder'=>'section content'])}}
                    </div>
                    <input type="hidden" name="section[{{$section['id']}}][parent_section_id]" value="{{$section['parent_section_id']}}">
                    <div class="text-left"><a href="javascript:PCApp.add_{{$document['type']}}_section({{$document['id']}},{{$section['id']}})" class="btn btn-xs btn-info">new subsection</a></div>
                </div>
            </div>
            <div id="subSections{{$section['id']}}">
                @if(!empty($section['sections']))
                    @include('partials.sectionsedit',['sections'=>$section['sections'],'document'=>$document]) 
                @endif
            </div>
        </div>
    </div>
@endforeach
