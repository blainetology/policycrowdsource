<div class="col-md-12">
    <div class="document-list rfp-list">
        <?php 
            $rfp->political_rating = round($rfp->political_rating);
            if($rfp->political_rating == -0)
                $rfp->political_rating = 0;
        ?>
        <div class="details_section">
            <span class="pull-right">
                &nbsp; &nbsp; 
                <?php
                $ratings_avg = $rfp->ratings_avg ?: 1;
                $ratingthumb = \App\Rating::getRatingThumb($ratings_avg);
                ?>
                <i class="fa {{$ratingthumb[1]}} rating-thumb rating{{$ratings_avg}} document-rating-thumb" aria-hidden="true" title="overall average rating: {{$ratingthumb[0]}}"></i> 
                <span class="document-rating rating_{{$rfp->political_rating}}"> {{number_format($rfp->ratings_count,0)}} votes </span>
            </span>

            @if($rfp->isEditor())
            <a href="{{ route('rfp.edit',$rfp->id) }}" class="text-info glyphicon glyphicon-pencil pull-right" title="edit"></a>
            @endif

            <strong class="title"><a href="{{ route('rfp.show',$rfp->id) }}">{{$rfp->name}}</a></strong>
            <br/>

            @if($rfp->house_document==1)
            <span class="small label label-xs label-info">House Policy</span>
            @else
            <span class="small text-info">Published {{\Shared\ViewHelpers::date($rfp->published,true)}}</span>
            @endif
            &nbsp; &nbsp; 
            <span class="small text-danger">
            @if($rfp->no_expiration==1)
                This RFP always accepts policy proposals
            @else
                Submit proposals by {{\Shared\ViewHelpers::date($rfp->submission_cutoff,true)}}
            @endif
            </span>
            <br clear="all" />

            <span class="small text-info pull-right">{{ $rfp->child_count }} submitted</span>

            <div class="short_synopsis" style="margin-top:3px;">{{$rfp->short_synopsis}}</div>
        </div>
    </div>
</div>
