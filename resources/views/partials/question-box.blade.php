<div class="col-md-4 col-sm-6">
    <div class="well well-sm document-well question-well">
        <?php 
            $question->political_rating = round($question->political_rating);
            if($question->political_rating == -0)
                $question->political_rating = 0;
        ?>
        <div class="details_section">
            <span class="title"><a href="{{ route('questions.show',$question->id) }}">{{$question->name}}</a></span>
            @if($question->house_document==0)
            <div class="small text-info">Published {{\Shared\ViewHelpers::date($question->published,true)}}</div>
            @endif
            <div class="short_synopsis">{{$question->short_synopsis}}</div>
        </div>
        @if($question->isEditor())
        <a href="{{ route('questions.edit',$question->id) }}" class="text-info glyphicon glyphicon-pencil" title="edit" style="position: absolute; top:10px; right: 10px;"></a>
        @endif
        <div class="text-right"><a href="{{ route('questions.show',$question->id) }}" class="btn btn-xs btn-primary btn-view-more">answer the questions <span class="glyphicon glyphicon-triangle-right"></span></a></div>
    </div>
</div>
