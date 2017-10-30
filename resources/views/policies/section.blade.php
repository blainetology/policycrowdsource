@foreach($sections as $section)
    <div id="sectionContainer{{$section->id}}" class="section-container rating_{{round($section->rating)}} row">
        <div class="col-md-12">
            <div class="row policy-section" id="section{{$section->id}}">
                <div class="col-md-10">
                    @if(!empty($section->title))
                        <h2>{{$section->title}}</h2>
                    @endif
                    @if(!empty($section->content))
                        <p>{!!nl2br($section->content)!!}</p>
                    @endif
                </div>
                <div class="col-md-2">
                   @include('partials.ratings-thumbs', ['pid'=>$policy->id,'sid'=>$section->id, 'rating'=>\App\Rating::getSectionRating($section->id,$ratings['sections'])])
                </div>
            </div>
            <div id="subSections{{$section->id}}">
                @if($section->subsections->count()>0)
                    <a href="javascript:get_policy_sections({{$section->id}})">show sections</a> 
                @endif
            </div>
        </div>
    </div>
@endforeach
