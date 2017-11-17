@foreach($sections as $section)
    <div id="sectionContainer{{$section['id']}}" class="section-container rating_{{round($section['political_rating'])}} row">
        <div class="{{ $document->type == 'question' ? 'col-md-9' : 'col-md-12' }}">
            <div class="row  document-section" data-section="{{$section['id']}}" id="section{{$section['id']}}">
                <div class="col-md-10">
                    @if(!empty($section['title']))
                        @if($document->type == 'question')
                        <h4>{{$section['title']}}</h4>
                        @elseif($section['parent_section_id']==0)
                        <h2>{{$section['title']}}</h2>
                        @else
                        <h3>{{$section['title']}}</h3>
                        @endif
                    @endif
                    @if(!empty($section['content']))
                        <p>{!!nl2br($section['content'])!!}</p>
                    @endif
                    @if($document->type != 'question')
                        @include('partials/comments',['comments'=>\App\Comment::forSection($section['id'])->with('user')->get(),'type'=>'section','id'=>$section['id']])
                    @endif
                </div>
                <div class="col-md-2">
                   @include('partials.ratings-thumbs', ['id'=>$document->id,'sid'=>$section['id'], 'rating'=>\App\Rating::getSectionRating($section['id'],$ratings['sections']),'comments'=>$section['comments_count']])
                </div>
            </div>
            <div id="subSections{{$section['id']}}">
                @if(!empty($section['sections']))
                    @include('partials.sections',['sections'=>$section['sections'],'document'=>$document]) 
                @endif
            </div>
        </div>
    </div>
@endforeach
