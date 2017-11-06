<?php

use Illuminate\Database\Seeder;
use App\Rating;
use App\Section;
use App\Policy;
use App\Rfp;
use App\User;

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

        // Seed Policy & Section ratings
        foreach(Policy::where('id','!=',20007)->get() as $policyrow){
        	echo " - ".$policyrow->name." policy ratings \n";
            $ratings_array = [];
            $parents = [];
            // figure out the parent sectiond ids
            $allsections = Section::where('policy_id',$policyrow->id)->orderBy('id','desc')->get();
            foreach($allsections as $sectionrow){
            	if(!isset($parents[(int)$sectionrow->parent_section_id]))
            		$parents[(int)$sectionrow->parent_section_id] = [];
            	$parents[(int)$sectionrow->parent_section_id][]=$sectionrow->id;
            }

            $allusers = User::all();
            echo " --- individual section user ratings\n";
            foreach($allsections as $sectionrow){
            	// if it is a parent section, get the aggregate rating for the section for each user
            	if(isset($parents[(int)$sectionrow->id])){
            		foreach($allusers as $user){
            			if(rand(1,5)!=3){
	            			$ratingstotal = Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->sum('rating');
	            			$ratingscount = Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->count();
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
	    	                Rating::create(['user_id'=>$user->id,'section_id'=>$sectionrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	    	            }
            		}
            	}
            	// if not a parent section, randomly assign a rating for each user
            	else{
            		foreach($allusers as $user){
            			if(rand(1,5)!=3){
	            			$rating = rand(1,4);
	            			if($rating==1)
	            				$rating=-2;
	            			elseif($rating==2)
	            				$rating=-1;
	            			elseif($rating==3)
	            				$rating=1;
	            			else
	            				$rating=2;
	    	                Rating::create(['user_id'=>$user->id,'section_id'=>$sectionrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	    	            }
    	            }
            	}
            }

            // now get the overall ratings for the sections
            echo " --- overall section ratings\n";
            foreach($allsections as $sectionrow){
    			$ratingstotal = Rating::where('section_id',$sectionrow->id)->sum('weighted_rating');
    			$ratingscount = Rating::where('section_id',$sectionrow->id)->sum('rating_abs_val');
				if($ratingscount==0)
					$rating=0;
				else
	        		$rating = $ratingstotal/$ratingscount;
    			if($rating > 5)
    				$rating = 5;
    			elseif($rating < -5)
    				$rating = -5;
    			$sectionrow->political_rating=$rating;
                $sectionrow->ratings_count=Rating::where('section_id',$sectionrow->id)->count();
                $sectionrow->ratings_minus2=Rating::where('section_id',$sectionrow->id)->where('rating','-2')->count();
                $sectionrow->ratings_minus1=Rating::where('section_id',$sectionrow->id)->where('rating','-1')->count();
                $sectionrow->ratings_plus1=Rating::where('section_id',$sectionrow->id)->where('rating','1')->count();
                $sectionrow->ratings_plus2=Rating::where('section_id',$sectionrow->id)->where('rating','2')->count();
                $ratings_avg = (($sectionrow->ratings_minus2*-2)+($sectionrow->ratings_minus1*-1)+($sectionrow->ratings_plus1*1)+($sectionrow->ratings_plus2*2))/$sectionrow->ratings_count;
                if($ratings_avg<-1)
                    $ratings_avg=-2;
                elseif($ratings_avg<0)
                    $ratings_avg=-1;
                elseif($ratings_avg>1)
                    $ratings_avg=2;
                else
                    $ratings_avg=1;
                $sectionrow->ratings_avg=$ratings_avg;
                $sectionrow->ratings_total=($sectionrow->ratings_minus2*-2)+($sectionrow->ratings_minus1*-1)+($sectionrow->ratings_plus1*1)+($sectionrow->ratings_plus2*2);
    			$sectionrow->save();
            }

            // now get the overall ratings for the policy
            echo " --- individual policy user ratings\n";
    		foreach($allusers as $user){
    			if(rand(1,5)!=3){
	                $ratingstotal = Rating::where('user_id',$user->id)->whereIn('section_id',Section::where('policy_id',$policyrow->id)->topLevel()->pluck('id'))->sum('rating');
	                $ratingscount = Rating::where('user_id',$user->id)->whereIn('section_id',Section::where('policy_id',$policyrow->id)->topLevel()->pluck('id'))->count();
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
	                Rating::create(['user_id'=>$user->id,'policy_id'=>$policyrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	            }
    		}

            echo " --- overall policy ratings\n";
			$ratingstotal = Rating::where('policy_id',$policyrow->id)->sum('weighted_rating');
			$ratingscount = Rating::where('policy_id',$policyrow->id)->sum('rating_abs_val');
			echo $ratingstotal." / ".$ratingscount."\n";
			if($ratingscount==0)
				$rating=0;
			else
	    		$rating = $ratingstotal/$ratingscount;
			if($rating > 5)
				$rating = 5;
			elseif($rating < -5)
				$rating = -5;
			$policyrow->political_rating=$rating;
            $policyrow->ratings_count=Rating::where('policy_id',$policyrow->id)->count();
            $policyrow->ratings_minus2=Rating::where('policy_id',$policyrow->id)->where('rating','-2')->count();
            $policyrow->ratings_minus1=Rating::where('policy_id',$policyrow->id)->where('rating','-1')->count();
            $policyrow->ratings_plus1=Rating::where('policy_id',$policyrow->id)->where('rating','1')->count();
            $policyrow->ratings_plus2=Rating::where('policy_id',$policyrow->id)->where('rating','2')->count();
            $ratings_avg = (($policyrow->ratings_minus2*-2)+($policyrow->ratings_minus1*-1)+($policyrow->ratings_plus1*1)+($policyrow->ratings_plus2*2))/$policyrow->ratings_count;
            if($ratings_avg<-1)
                $ratings_avg=-2;
            elseif($ratings_avg<0)
                $ratings_avg=-1;
            elseif($ratings_avg>1)
                $ratings_avg=2;
            else
                $ratings_avg=1;
            $policyrow->ratings_avg=$ratings_avg;
            $policyrow->ratings_total=($policyrow->ratings_minus2*-2)+($policyrow->ratings_minus1*-1)+($policyrow->ratings_plus1*1)+($policyrow->ratings_plus2*2);
			$policyrow->save();
        }




        // Seed RFP & Section ratings
        foreach(Rfp::where('id','!=',20007)->get() as $rfprow){
            echo " - ".$rfprow->name." rfp ratings \n";
            $ratings_array = [];
            $parents = [];
            // figure out the parent sectiond ids
            $allsections = Section::where('rfp_id',$rfprow->id)->orderBy('id','desc')->get();
            foreach($allsections as $sectionrow){
                if(!isset($parents[(int)$sectionrow->parent_section_id]))
                    $parents[(int)$sectionrow->parent_section_id] = [];
                $parents[(int)$sectionrow->parent_section_id][]=$sectionrow->id;
            }

            $allusers = User::all();
            echo " --- individual section user ratings\n";
            foreach($allsections as $sectionrow){
                // if it is a parent section, get the aggregate rating for the section for each user
                if(isset($parents[(int)$sectionrow->id])){
                    foreach($allusers as $user){
                        if(rand(1,5)!=3){
                            $ratingstotal = Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->sum('rating');
                            $ratingscount = Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$sectionrow->id])->count();
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
                            Rating::create(['user_id'=>$user->id,'section_id'=>$sectionrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
                        }
                    }
                }
                // if not a parent section, randomly assign a rating for each user
                else{
                    foreach($allusers as $user){
                        if(rand(1,5)!=3){
                            $rating = rand(1,4);
                            if($rating==1)
                                $rating=-2;
                            elseif($rating==2)
                                $rating=-1;
                            elseif($rating==3)
                                $rating=1;
                            else
                                $rating=2;
                            Rating::create(['user_id'=>$user->id,'section_id'=>$sectionrow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
                        }
                    }
                }
            }

            // now get the overall ratings for the sections
            echo " --- overall section ratings\n";
            foreach($allsections as $sectionrow){
                $ratingstotal = Rating::where('section_id',$sectionrow->id)->sum('weighted_rating');
                $ratingscount = Rating::where('section_id',$sectionrow->id)->sum('rating_abs_val');
                if($ratingscount==0)
                    $rating=0;
                else
                    $rating = $ratingstotal/$ratingscount;
                if($rating > 5)
                    $rating = 5;
                elseif($rating < -5)
                    $rating = -5;
                $sectionrow->political_rating=$rating;
                $sectionrow->ratings_count=Rating::where('section_id',$sectionrow->id)->count();
                $sectionrow->ratings_minus2=Rating::where('section_id',$sectionrow->id)->where('rating','-2')->count();
                $sectionrow->ratings_minus1=Rating::where('section_id',$sectionrow->id)->where('rating','-1')->count();
                $sectionrow->ratings_plus1=Rating::where('section_id',$sectionrow->id)->where('rating','1')->count();
                $sectionrow->ratings_plus2=Rating::where('section_id',$sectionrow->id)->where('rating','2')->count();
                $ratings_avg = (($sectionrow->ratings_minus2*-2)+($sectionrow->ratings_minus1*-1)+($sectionrow->ratings_plus1*1)+($sectionrow->ratings_plus2*2))/$sectionrow->ratings_count;
                if($ratings_avg<-1)
                    $ratings_avg=-2;
                elseif($ratings_avg<0)
                    $ratings_avg=-1;
                elseif($ratings_avg>1)
                    $ratings_avg=2;
                else
                    $ratings_avg=1;
                $sectionrow->ratings_avg=$ratings_avg;
                $sectionrow->ratings_total=($sectionrow->ratings_minus2*-2)+($sectionrow->ratings_minus1*-1)+($sectionrow->ratings_plus1*1)+($sectionrow->ratings_plus2*2);
                $sectionrow->save();
            }

            // now get the overall ratings for the policy
            echo " --- individual policy user ratings\n";
            foreach($allusers as $user){
                if(rand(1,5)!=3){
                    $ratingstotal = Rating::where('user_id',$user->id)->whereIn('section_id',Section::where('rfp_id',$rfprow->id)->topLevel()->pluck('id'))->sum('rating');
                    $ratingscount = Rating::where('user_id',$user->id)->whereIn('section_id',Section::where('rfp_id',$rfprow->id)->topLevel()->pluck('id'))->count();
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
                    Rating::create(['user_id'=>$user->id,'rfp_id'=>$rfprow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
                }
            }

            echo " --- overall policy ratings\n";
            $ratingstotal = Rating::where('rfp_id',$rfprow->id)->sum('weighted_rating');
            $ratingscount = Rating::where('rfp_id',$rfprow->id)->sum('rating_abs_val');
            echo $ratingstotal." / ".$ratingscount."\n";
            if($ratingscount==0)
                $rating=0;
            else
                $rating = $ratingstotal/$ratingscount;
            if($rating > 5)
                $rating = 5;
            elseif($rating < -5)
                $rating = -5;
            $rfprow->political_rating=$rating;
            $rfprow->ratings_count=Rating::where('rfp_id',$rfprow->id)->count();
            $rfprow->ratings_minus2=Rating::where('rfp_id',$rfprow->id)->where('rating','-2')->count();
            $rfprow->ratings_minus1=Rating::where('rfp_id',$rfprow->id)->where('rating','-1')->count();
            $rfprow->ratings_plus1=Rating::where('rfp_id',$rfprow->id)->where('rating','1')->count();
            $rfprow->ratings_plus2=Rating::where('rfp_id',$rfprow->id)->where('rating','2')->count();
            $ratings_avg = (($rfprow->ratings_minus2*-2)+($rfprow->ratings_minus1*-1)+($rfprow->ratings_plus1*1)+($rfprow->ratings_plus2*2))/$policyrow->ratings_count;
            if($ratings_avg<-1)
                $ratings_avg=-2;
            elseif($ratings_avg<0)
                $ratings_avg=-1;
            elseif($ratings_avg>1)
                $ratings_avg=2;
            else
                $ratings_avg=1;
            $rfprow->ratings_avg=$ratings_avg;
            $rfprow->ratings_total=($rfprow->ratings_minus2*-2)+($rfprow->ratings_minus1*-1)+($rfprow->ratings_plus1*1)+($rfprow->ratings_plus2*2);
            $rfprow->save();
        }


/*        foreach(Rfp::all() as $rfprow){
            echo " - ".$rfprow->name." RFP ratings \n";
            echo " --- overall RFP ratings\n";
            foreach($allusers as $user){
                if(rand(1,5)!=3){
                    $rating = rand(1,4);
                    if($rating==1)
                        $rating=-2;
                    elseif($rating==2)
                        $rating=-1;
                    elseif($rating==3)
                        $rating=1;
                    else
                        $rating=2;
                    Rating::create(['user_id'=>$user->id,'rfp_id'=>$rfprow->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
                }
            }
            echo " --- overall RFP ratings\n";
            $ratingstotal = Rating::where('rfp_id',$rfprow->id)->sum('weighted_rating');
            $ratingscount = Rating::where('rfp_id',$rfprow->id)->sum('rating_abs_val');
            echo $ratingstotal." / ".$ratingscount."\n";
            if($ratingscount==0)
                $rating=0;
            else
                $rating = $ratingstotal/$ratingscount;
            if($rating > 5)
                $rating = 5;
            elseif($rating < -5)
                $rating = -5;
            $rfprow->political_rating=$rating;
            $rfprow->ratings_count=Rating::where('rfp_id',$rfprow->id)->count();
            $rfprow->ratings_minus2=Rating::where('rfp_id',$rfprow->id)->where('rating','-2')->count();
            $rfprow->ratings_minus1=Rating::where('rfp_id',$rfprow->id)->where('rating','-1')->count();
            $rfprow->ratings_plus1=Rating::where('rfp_id',$rfprow->id)->where('rating','1')->count();
            $rfprow->ratings_plus2=Rating::where('rfp_id',$rfprow->id)->where('rating','2')->count();
            $ratings_avg = (($rfprow->ratings_minus2*-2)+($rfprow->ratings_minus1*-1)+($rfprow->ratings_plus1*1)+($rfprow->ratings_plus2*2))/$rfprow->ratings_count;
            if($ratings_avg<-1)
                $ratings_avg=-2;
            elseif($ratings_avg<0)
                $ratings_avg=-1;
            elseif($ratings_avg>1)
                $ratings_avg=2;
            else
                $ratings_avg=1;
            $rfprow->ratings_avg=$ratings_avg;
            $rfprow->ratings_total=($rfprow->ratings_minus2*-2)+($rfprow->ratings_minus1*-1)+($rfprow->ratings_plus1*1)+($rfprow->ratings_plus2*2);
            $rfprow->save();

        }
*/
    }
}
