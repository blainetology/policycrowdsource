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
                $ratingstotal = Rating::where('section_id',$section->id)->sum('weighted_rating');
                $ratingscount = Rating::where('section_id',$section->id)->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $section->rating=$rating;
                $section->rating_count=Rating::where('section_id',$section->id)->count();
                $section->ratings_minus2=Rating::where('section_id',$section->id)->where('rating','-2')->count();
                $section->ratings_minus1=Rating::where('section_id',$section->id)->where('rating','-1')->count();
                $section->ratings_plus1=Rating::where('section_id',$section->id)->where('rating','1')->count();
                $section->ratings_plus2=Rating::where('section_id',$section->id)->where('rating','2')->count();
                $section->recalculate=null;
                $section->save();                
            }
        });
        Policy::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($policies){
            foreach($policies as $policy){
                $ratingstotal = Rating::where('policy_id',$policy->id)->sum('weighted_rating');
                $ratingscount = Rating::where('policy_id',$policy->id)->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $policy->rating=$rating;
                $policy->rating_count=Rating::where('policy_id',$policy->id)->count();
                $policy->ratings_minus2=Rating::where('policy_id',$policy->id)->where('rating','-2')->count();
                $policy->ratings_minus1=Rating::where('policy_id',$policy->id)->where('rating','-1')->count();
                $policy->ratings_plus1=Rating::where('policy_id',$policy->id)->where('rating','1')->count();
                $policy->ratings_plus2=Rating::where('policy_id',$policy->id)->where('rating','2')->count();
                $policy->recalculate=null;
                $policy->save();                
            }
        });
        Rfp::whereNotNull('recalculate')->orderBy('recalculate','asc')->chunk(25,function($rfps){
            foreach($rfps as $rfp){
                $ratingstotal = Rating::where('rfp_id',$rfp->id)->sum('weighted_rating');
                $ratingscount = Rating::where('rfp_id',$rfp->id)->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $rfp->rating=$rating;
                $rfp->rating_count=Rating::where('rfp_id',$rfp->id)->count();
                $rfp->ratings_minus2=Rating::where('rfp_id',$rfp->id)->where('rating','-2')->count();
                $rfp->ratings_minus1=Rating::where('rfp_id',$rfp->id)->where('rating','-1')->count();
                $rfp->ratings_plus1=Rating::where('rfp_id',$rfp->id)->where('rating','1')->count();
                $rfp->ratings_plus2=Rating::where('rfp_id',$rfp->id)->where('rating','2')->count();
                $rfp->recalculate=null;
                $rfp->save();                
            }
        });
    }
}
