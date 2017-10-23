<div class="col-md-4 col-sm-6">
    <div class="well well-sm policy-well rfp-well">
        <?php 
            $rfp->rating = round($rfp->rating);
            if($rfp->rating == -0)
                $rfp->rating = 0;
        ?>
        <div class="details_section">
            <strong><a href="{{ route('rfp.show',$rfp->id) }}" style="font-size: 16px;">{{$rfp->name}}</a></strong>
            <div class="small text-danger">
                @if($rfp->no_expiration==1)
                    This RFP always accepts policy proposals
                @else
                    Submit proposals by {{\Shared\ViewHelpers::date($rfp->submission_cutoff,true)}}
                @endif
                <span class="small text-info pull-right">{{ $rfp->submission_count }} submitted</span>
            </div>
            <div class="short_synopsis">{{$rfp->short_overview}}</div>
        </div>
        <div class="small">
        {!!\App\Rating::getPolicyThumbs($rfp)!!}
        </div>
        <span class="policy-rating rating_{{$rfp->rating}}"> {{number_format($rfp->rating_count,0)}} votes </span>
        <div class="text-right"><a href="{{ route('rfp.show',$rfp->id) }}" class="btn btn-xs btn-primary btn-view-more">view RFP &gt;&gt;</a></div>
    </div>
</div>
