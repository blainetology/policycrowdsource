<div class="col-md-4 col-sm-6">
    <div class="well well-sm document-well rfp-well">
        <?php 
            $rfp->political_rating = round($rfp->political_rating);
            if($rfp->political_rating == -0)
                $rfp->political_rating = 0;
        ?>
        <div class="details_section">
            <span class="title"><a href="{{ route('rfp.show',$rfp->id) }}">{{$rfp->name}}</a></span>
            <div class="small text-danger" style="line-height: 120%;">
                <span class="small text-info pull-right">{{ $rfp->child_count }} submitted</span>
                @if($rfp->house_document==0)
                <span class="text-info">Published {{\Shared\ViewHelpers::date($rfp->published,true)}}</span><br/>
                @endif
                <span class="text-danger">
                @if($rfp->no_expiration==1)
                    This RFP always accepts policy proposals
                @else
                    Submit proposals by {{\Shared\ViewHelpers::date($rfp->submission_cutoff,true)}}
                @endif
                </span>
            </div>
            <div class="short_synopsis" style="margin-top:3px;">{{$rfp->short_synopsis}}</div>
        </div>
        <?php
        $ratings_avg = $policy->ratings_avg ?: 1;
        $ratingthumb = \App\Rating::getRatingThumb($ratings_avg);
        ?>
        <i class="fa {{$ratingthumb[1]}} rating-thumb rating{{$ratings_avg}} document-rating-thumb" aria-hidden="true" title="overall average rating: {{$ratingthumb[0]}}"></i> 
        @if($rfp->isEditor())
        <a href="{{ route('rfp.edit',$rfp->id) }}" class="text-info glyphicon glyphicon-pencil" title="edit" style="position: absolute; top:10px; right: 10px;"></a>
        @endif
        <span class="document-rating rating_{{$rfp->political_rating}}"> {{number_format($rfp->ratings_count,0)}} votes </span>
        <div class="text-right"><a href="{{ route('rfp.show',$rfp->id) }}" class="btn btn-xs btn-primary btn-view-more">read more <span class="glyphicon glyphicon-triangle-right"></span></a></div>
    </div>
</div>
