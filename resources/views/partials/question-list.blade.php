<div class="col-md-12">
    <div class="document-list question-list">
        <?php 
            $question->political_rating = round($question->political_rating);
            if($question->political_rating == -0)
                $question->political_rating = 0;
        ?>
        <div class="details_section">

            @if($question->isEditor())
            <a href="{{ route('questions.edit',$question->id) }}" class="text-info glyphicon glyphicon-pencil pull-right" title="edit"></a>
            @endif

            <strong class="title"><a href="{{ route('questions.show',$question->id) }}">{{$question->name}}</a></strong>
            @if($question->house_document==0)
            <div class="small text-info">Published {{\Shared\ViewHelpers::date($question->published,true)}}</div>
            @endif
            <div class="short_synopsis">{{$question->short_synopsis}}</div>
        </div>
    </div>
</div>
