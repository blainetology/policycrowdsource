<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Policy;
use App\Section;
use App\Rfp;
use App\Rating;

class CalculateRatings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:ratings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process and calculate new section and policy ratings when someone clicks a rating.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        Section::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($sections){
            foreach($sections as $section){
                $ratingstotal = Rating::where('section_id',$section->id)->active()->sum('weighted_rating');
                $ratingscount = Rating::where('section_id',$section->id)->active()->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $section->political_rating=$rating;
                $section->ratings_count=Rating::where('section_id',$section->id)->active()->count();
                $section->ratings_minus2=Rating::where('section_id',$section->id)->active()->where('rating','-2')->count();
                $section->ratings_minus1=Rating::where('section_id',$section->id)->active()->where('rating','-1')->count();
                $section->ratings_plus1=Rating::where('section_id',$section->id)->active()->where('rating','1')->count();
                $section->ratings_plus2=Rating::where('section_id',$section->id)->active()->where('rating','2')->count();
                $ratings_avg = (($section->ratings_minus2*-2)+($section->ratings_minus1*-1)+($section->ratings_plus1*1)+($section->ratings_plus2*2))/$section->ratings_count;
                if($ratings_avg<-1)
                    $ratings_avg=-2;
                elseif($ratings_avg<0)
                    $ratings_avg=-1;
                elseif($ratings_avg>1)
                    $ratings_avg=2;
                else
                    $ratings_avg=1;
                $section->ratings_avg=$ratings_avg;
                $section->recalculate=null;
                $section->save();                
            }
        });
        Policy::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($policies){
            foreach($policies as $policy){
                $ratingstotal = Rating::where('policy_id',$policy->id)->active()->sum('weighted_rating');
                $ratingscount = Rating::where('policy_id',$policy->id)->active()->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $policy->political_rating=$rating;
                $policy->ratings_count=Rating::where('policy_id',$policy->id)->active()->count();
                $policy->ratings_minus2=Rating::where('policy_id',$policy->id)->active()->where('rating','-2')->count();
                $policy->ratings_minus1=Rating::where('policy_id',$policy->id)->active()->where('rating','-1')->count();
                $policy->ratings_plus1=Rating::where('policy_id',$policy->id)->active()->where('rating','1')->count();
                $policy->ratings_plus2=Rating::where('policy_id',$policy->id)->active()->where('rating','2')->count();
                $ratings_avg = (($policy->ratings_minus2*-2)+($policy->ratings_minus1*-1)+($policy->ratings_plus1*1)+($policy->ratings_plus2*2))/$policy->ratings_count;
                if($ratings_avg<-1)
                    $ratings_avg=-2;
                elseif($ratings_avg<0)
                    $ratings_avg=-1;
                elseif($ratings_avg>1)
                    $ratings_avg=2;
                else
                    $ratings_avg=1;
                $policy->ratings_avg=$ratings_avg;
                $policy->ratings_total=($policy->ratings_minus2*-2)+($policy->ratings_minus1*-1)+($policy->ratings_plus1*1)+($policy->ratings_plus2*2);
                $policy->recalculate=null;
                $policy->save();                
            }
        });
        Rfp::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($rfps){
            foreach($rfps as $rfp){
                $ratingstotal = Rating::where('rfp_id',$rfp->id)->active()->sum('weighted_rating');
                $ratingscount = Rating::where('rfp_id',$rfp->id)->active()->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $rfp->political_rating=$rating;
                $rfp->ratings_count=Rating::where('rfp_id',$rfp->id)->active()->count();
                $rfp->ratings_minus2=Rating::where('rfp_id',$rfp->id)->active()->where('rating','-2')->count();
                $rfp->ratings_minus1=Rating::where('rfp_id',$rfp->id)->active()->where('rating','-1')->count();
                $rfp->ratings_plus1=Rating::where('rfp_id',$rfp->id)->active()->where('rating','1')->count();
                $rfp->ratings_plus2=Rating::where('rfp_id',$rfp->id)->active()->where('rating','2')->count();
                $ratings_avg = (($rfp->ratings_minus2*-2)+($rfp->ratings_minus1*-1)+($rfp->ratings_plus1*1)+($rfp->ratings_plus2*2))/$rfp->ratings_count;
                if($ratings_avg<-1)
                    $ratings_avg=-2;
                elseif($ratings_avg<0)
                    $ratings_avg=-1;
                elseif($ratings_avg>1)
                    $ratings_avg=2;
                else
                    $ratings_avg=1;
                $rfp->ratings_avg=$ratings_avg;
                $rfp->ratings_total=($rfp->ratings_minus2*-2)+($rfp->ratings_minus1*-1)+($rfp->ratings_plus1*1)+($rfp->ratings_plus2*2);
                $rfp->recalculate=null;
                $rfp->save();                
            }
        });
    }
}
