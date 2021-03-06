<div class="col-md-4 col-sm-6">
    <div class="well well-sm document-well policy-well">
        <?php 
            $policy->political_rating = round($policy->political_rating);
            if($policy->political_rating == -0)
                $policy->political_rating = 0;
        ?>
        <div class="details_section">
            <span class="title"><a href="{{ route('policies.show',$policy->id) }}">{{$policy->name}}</a></span>
            @if($policy->house_document==0)
            <div class="small text-info">Published {{\Shared\ViewHelpers::date($policy->published,true)}}</div>
            @endif
            <div class="short_synopsis">{{$policy->short_synopsis}}</div>
        </div>
        <span class="document-rating rating_{{$policy->political_rating}}"> {{number_format($policy->ratings_count,0)}} votes </span>
        <?php
        $ratings_avg = $policy->ratings_avg ?: 1;
        $ratingthumb = \App\Rating::getRatingThumb($ratings_avg);
        ?>
        <i class="fa {{$ratingthumb[1]}} rating-thumb rating{{$ratings_avg}} document-rating-thumb" aria-hidden="true" title="overall average rating: {{$ratingthumb[0]}}"></i> 
        @if($policy->isEditor())
        <a href="{{ route('policies.edit',$policy->id) }}" class="text-info glyphicon glyphicon-pencil" title="edit" style="position: absolute; top:10px; right: 10px;"></a>
        @endif
        <div class="text-right"><a href="{{ route('policies.show',$policy->id) }}" class="btn btn-xs btn-primary btn-view-more">read more <span class="glyphicon glyphicon-triangle-right"></span></a></div>
    </div>
</div>
