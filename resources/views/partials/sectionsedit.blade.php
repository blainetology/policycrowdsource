@foreach($sections as $section)
    <div id="sectionContainer{{$section['id']}}" class="section-container section-edit rating_{{round($section['political_rating'])}} row">
        <div class="col-md-12">
            <div class="row  document-section" data-section="{{$section['id']}}" id="section{{$section['id']}}">
                <div class="col-md-12">
                    <div class="form-group"> 
                    {{Form::text('section'.$section['id'],$section['staged_title'],['name'=>'section['.$section['id'].'][staged_title]', 'class'=>'form-control document-section section-title', 'placeholder'=>'section title', 'id'=>'sectionTitle'.$section['id'], 'data-section'=>$section['id']])}}
                    </div>
                    <div class="form-group"> 
                    {{Form::textarea('section'.$section['id'],$section['staged_content'],['name'=>'section['.$section['id'].'][staged_content]', 'class'=>'form-control auto-size document-section section-content', 'placeholder'=>'section content', 'id'=>'sectionContent'.$section['id'], 'data-section'=>$section['id']])}}
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
