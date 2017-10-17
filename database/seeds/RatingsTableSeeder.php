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
        foreach(\App\Policy::all() as $policyrow){
        	echo " - ".$policyrow->name." ratings \n";
            $ratings_array = [];
            $parents = [];
            // figure out the parent sectiond ids
            $allsections = \App\Section::where('policy_id',$policyrow->id)->orderBy('id','desc')->get();
            foreach($allsections as $sectionrow){
            	if(!isset($parents[(int)$sectionrow->parent_section_id]))
            		$parents[(int)$sectionrow->parent_section_id] = [];
            	$parents[(int)$sectionrow->parent_section_id][]=$sectionrow->id;
            }

            $allusers = \App\User::all();
            echo " --- individual section user ratings\n";
            foreach($allsections as $sectionrow){
            	// if it is a parent section, get the aggregate rating for the section for each user
            	if(isset($parents[(int)$sectionrow->id])){
            		foreach($allusers as $user){
            			if(rand(1,6)!=4){
	            			$ratingstotal = \App\Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->sum('rating');
	            			$ratingscount = \App\Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->count();
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
	    	                \App\Rating::create(['user_id'=>$user->id,'section_id'=>$sectionrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_count'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	    	            }
            		}
            	}
            	// if not a parent section, randomly assign a rating for each user
            	else{
            		foreach($allusers as $user){
            			if(rand(1,6)!=4){
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
            }

            // now get the overall ratings for the sections
            echo " --- overall section ratings\n";
            foreach($allsections as $sectionrow){
    			if(rand(1,6)!=4){
	    			$ratingstotal = \App\Rating::where('section_id',$sectionrow->id)->sum('weighted_rating');
	    			$ratingscount = \App\Rating::where('section_id',$sectionrow->id)->sum('rating_count');
					if($ratingscount==0)
						$rating=0;
					else
		        		$rating = $ratingstotal/$ratingscount;
	    			if($rating > 5)
	    				$rating = 5;
	    			elseif($rating < -5)
	    				$rating = -5;
	    			$sectionrow->rating=$rating;
	                $sectionrow->rating_count=\App\Rating::where('section_id',$sectionrow->id)->count();
	    			$sectionrow->save();
    			}
            }

            // now get the overall ratings for the policy
            echo " --- individual policy user ratings\n";
    		foreach($allusers as $user){
    			if(rand(1,6)!=4){
	                $ratingstotal = \App\Rating::where('user_id',$user->id)->whereIn('section_id',\App\Section::where('policy_id',$policyrow->id)->whereNull('parent_section_id')->pluck('id'))->sum('weighted_rating');
	                $ratingscount = \App\Rating::where('user_id',$user->id)->whereIn('section_id',\App\Section::where('policy_id',$policyrow->id)->whereNull('parent_section_id')->pluck('id'))->count();
	                $rating = $ratingstotal/$ratingscount;
	                if($rating==1)
	                    $rating=-2;
	                elseif($rating==2)
	                    $rating=-1;
	                elseif($rating==3)
	                    $rating=1;
	                else
	                    $rating=2;
	                \App\Rating::create(['user_id'=>$user->id,'policy_id'=>$policyrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_count'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	            }
    		}

            echo " --- overall section ratings\n";
			$ratingstotal = \App\Rating::where('policy_id',$policyrow->id)->sum('weighted_rating');
			$ratingscount = \App\Rating::where('policy_id',$policyrow->id)->sum('rating_count');
			echo $ratingstotal." / ".$ratingscount."\n";
			if($ratingscount==0)
				$rating=0;
			else
	    		$rating = $ratingstotal/$ratingscount;
			if($rating > 5)
				$rating = 5;
			elseif($rating < -5)
				$rating = -5;
			$policyrow->rating=$rating;
            $policyrow->rating_count=\App\Rating::where('policy_id',$policyrow->id)->count();
			$policyrow->save();
        }


    }
}
