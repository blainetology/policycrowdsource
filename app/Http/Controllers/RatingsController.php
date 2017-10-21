<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use App\Section;
use App\Rating;

class RatingsController extends Controller
{
    public function ratepolicy($pid,$rating)
    {
        //
        if(\Auth::check()){
            $policy = Policy::find($pid);
            if($policy){                
                $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'policy_id'=>$policy->id]);
                $rated->rating=$rating;
                $rated->rating_count=abs($rating);
                $rated->political_weight=\Auth::user()->political_weight;
                $rated->weighted_rating = $rated->rating*$rated->political_weight;
                $rated->save();
                if($policy->recalculate==null)
                    $policy->recalculate=\DB::raw('NOW()');
                $policy->save();
            }
        }

    }
    public function ratesection($pid,$sid,$rating)
    {
        //
        $response = [];
        if(\Auth::check()){
            $policy = Policy::find($pid);
            if($policy){
                $section = Section::where('id',$sid)->where('policy_id',$policy->id)->first();
                if($section){
                    $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'section_id'=>$sid]);
                    $rated->rating=$rating;
                    $rated->rating_abs_val=abs($rating);
                    $rated->political_weight=\Auth::user()->political_weight;
                    $rated->weighted_rating = $rated->rating*$rated->political_weight;
                    $rated->calculated_rating=null;
                    $rated->calculated_weighted_rating=null;
                    $rated->save();
                    if($section->recalculate==null)
                        $section->recalculate=\DB::raw('NOW()');
                    $section->save();
                    // if not part of a parent section, updated calculated value of policy
                    if(!$section->parent_section_id){
                        $policy = Policy::find($section->policy_id);
                        if($policy){
                            $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'policy_id'=>$section->policy_id]);
                        }
                    }
                    // if part of a parent section, updated calculated value of parent section
                    elseif($section->parent_section_id>0){
                        $parentsection = Section::find($section->parent_section_id);
                        if($parentsection){
                            $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'section_id'=>$section->parent_section_id]);

                            $ratingstotal = Rating::where('user_id',\Auth::user()->id)->whereIn('section_id',Section::where('parent_section_id',$section->parent_section_id)->pluck('id'))->sum('rating');
                            $ratingscount = Rating::where('user_id',\Auth::user()->id)->whereIn('section_id',Section::where('parent_section_id',$section->parent_section_id)->pluck('id'))->count();
                            if($ratingscount==0)
                                $rating=0;
                            else
                                $rating = $ratingstotal/$ratingscount;
                            if($rating<-1)
                                $rating=-2;
                            elseif($rating<0)
                                $rating=-1;
                            elseif($rating>1)
                                $rating=2;
                            else
                                $rating=1;
                            if($rated->rating!=$rating || $rated->weighted_rating!=($rated->rating*\Auth::user()->political_weight)){
                                $rated->calculated_rating=$rating;
                                $rated->calculated_weighted_rating=($rating*\Auth::user()->political_weight);
                                $rated->save();
                                $response['calculated']=[$parentsection->id,$rated];
                            }
                        }
                    }
                }
            }
        }
        return response()->json($response);
    }
}
