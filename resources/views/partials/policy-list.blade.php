<div class="col-md-12">
    <div class="document-list policy-list">
        <?php 
            $policy->political_rating = round($policy->political_rating);
            if($policy->political_rating == -0)
                $policy->political_rating = 0;
        ?>
        <div class="details_section">
            <div class="text-right pull-right"><a href="{{ route('policies.show',$policy->id) }}" class="btn btn-xs btn-primary btn-view-more">read more <span class="glyphicon glyphicon-triangle-right"></span></a></div>

            <span class="pull-right">
                <span class="document-rating rating_{{$policy->political_rating}}"> {{number_format($policy->ratings_count,0)}} votes </span>
                <?php
                $ratings_avg = $policy->ratings_avg ?: 1;
                $ratingthumb = \App\Rating::getRatingThumb($ratings_avg);
                ?>
                <i class="fa {{$ratingthumb[1]}} rating-thumb rating{{$ratings_avg}} document-rating-thumb" aria-hidden="true" title="overall average rating: {{$ratingthumb[0]}}"></i> 
                &nbsp; &nbsp; 
            </span>

            @if($policy->house_document==1)
            <span class="small label label-xs label-info">House Policy</span>
            @else
            <span class="small text-info">Published {{\Shared\ViewHelpers::date($policy->published,true)}}</span>
            @endif
            <br clear="all" />
            <strong class="title"><a href="{{ route('policies.show',$policy->id) }}">{{$policy->name}}</a></strong>
            <span class="short_synopsis">{{$policy->short_synopsis}}</span>
        </div>

        @if($policy->isEditor())
        <a href="{{ route('policies.edit',$policy->id) }}" class="text-info glyphicon glyphicon-pencil" title="edit" style="position: absolute; top:10px; right: 10px;"></a>
        @endif
    </div>
</div>
