<div class="col-md-4 col-sm-6">
    <div class="well well-sm policy-well">
        <?php 
            $policy->rating = round($policy->rating);
            if($policy->rating == -0)
                $policy->rating = 0;
        ?>
        <div class="details_section">
            <strong><a href="{{ route('policies.show',$policy->id) }}" style="font-size: 16px;">{{$policy->name}}</a></strong>
            <div class="short_synopsis">{{$policy->short_synopsis}}</div>
        </div>
        <div class="small">
        {!!\App\Rating::getPolicyThumbs($policy)!!}
        </div>
        <span class="policy-rating rating_{{$policy->rating}}"> {{number_format($policy->rating_count,0)}} votes </span>
        <div class="text-right"><a href="{{ route('policies.show',$policy->id) }}" class="btn btn-xs btn-primary btn-view-more">view policy &gt;&gt;</a></div>
    </div>
</div>
