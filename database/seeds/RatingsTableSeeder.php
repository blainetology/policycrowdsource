<?php

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ratings_array = [];
        $parents = [];
        // figure out the parent sectiond ids
        $allsections = \App\Section::orderBy('id','desc')->get();
        foreach($allsections as $sectionrow){
        	if(!isset($parents[(int)$sectionrow->parent_section_id]))
        		$parents[(int)$sectionrow->parent_section_id] = [];
        	$parents[(int)$sectionrow->parent_section_id][]=$sectionrow->id;
        }

        $allusers = \App\User::all();
        foreach($allsections as $sectionrow){
        	// if it is a parent section, get the aggregate rating for the section for each user
        	if(isset($parents[(int)$sectionrow->id])){
        		foreach($allusers as $user){
        			$ratingstotal = \App\Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->sum('rating');
        			$ratingscount = \App\Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->count();
	        		$rating = $ratingstotal/$ratingscount;
	        		if($rating<-1)
	        			$rating=-2;
	        		elseif($rating<0)
	        			$rating=-1;
	        		elseif($rating>1)
	        			$rating=2;
	        		else
	        			$rating=1;
	                \App\Rating::create(['user_id'=>$user->id,'section_id'=>$sectionrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_count'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
        		}
        	}
        	// if not a parent section, randomly assign a rating for each user
        	else{
        		foreach($allusers as $user){
        			$rating = rand(1,4);
        			if($rating==1)
        				$rating=-2;
        			elseif($rating==2)
        				$rating=-1;
        			elseif($rating==3)
        				$rating=1;
        			else
        				$rating=2;
	                \App\Rating::create(['user_id'=>$user->id,'section_id'=>$sectionrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_count'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	            }
        	}
        }

        // now get the overall ratings for the sections
        foreach($allsections as $sectionrow){
			$ratingstotal = \App\Rating::where('section_id',$sectionrow->id)->sum('weighted_rating');
			$ratingscount = \App\Rating::where('section_id',$sectionrow->id)->sum('rating_count');
    		$rating = round($ratingstotal/$ratingscount);
			if($rating > 5)
				$rating = 5;
			elseif($rating < -5)
				$rating = -5;
			$sectionrow->rating=$rating;
			$sectionrow->save();
        }

        // now get the overall ratings for the policy
        foreach(\App\Policy::all() as $policyrow){
    		foreach($allusers as $user){
    		}
			$ratingstotal = \App\Section::where('policy_id',$policyrow->id)->whereNull('parent_section_id')->sum('rating');
			$ratingscount = \App\Section::where('policy_id',$policyrow->id)->whereNull('parent_section_id')->count();
			echo $ratingstotal." / ".$ratingscount."\n";
			if($ratingscount==0)
				$rating=0;
			else
	    		$rating = round($ratingstotal/$ratingscount);
			if($rating > 5)
				$rating = 5;
			elseif($rating < -5)
				$rating = -5;
			$policyrow->rating=$rating;
			$policyrow->save();
        }


    }
}
