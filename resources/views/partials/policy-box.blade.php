<div class="col-md-4 col-sm-6">
    <div class="well well-sm policy-well">
        <?php 
            $policy->political_rating = round($policy->political_rating);
            if($policy->political_rating == -0)
                $policy->political_rating = 0;
        ?>
        <div class="details_section">
            <span class="title"><a href="{{ route('policies.show',$policy->id) }}">{{$policy->name}}</a></span>
            <div class="short_synopsis">{{$policy->short_synopsis}}</div>
        </div>
        <div class="small">
        {!!\App\Rating::getPolicyThumbs($policy)!!}
        </div>
        <span class="policy-rating rating_{{$policy->political_rating}}"> {{number_format($policy->ratings_count,0)}} votes </span>
        <div class="text-right"><a href="{{ route('policies.show',$policy->id) }}" class="btn btn-xs btn-primary btn-view-more">read more <span class="glyphicon glyphicon-triangle-right"></span></a></div>
    </div>
</div>
