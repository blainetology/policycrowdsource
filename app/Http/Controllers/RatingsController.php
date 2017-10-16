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
                $rated->auto_tallied=0;
                $rated->rating=$rating;
                $rated->save();
            }
        }

    }
    public function ratesection($pid,$sid,$rating)
    {
        //
        if(\Auth::check()){
            $policy = Policy::find($pid);
            if($policy){
                $section = Section::where('id',$sid)->where('policy_id',$policy->id)->first();
                if($section){
                    $rated = Rating::firstOrNew(['user_id'=>\Auth::user()->id,'section_id'=>$sid]);
                    $rated->auto_tallied=0;
                    $rated->rating=$rating;
                    $rated->save();
                }
            }
        }
    }
}
