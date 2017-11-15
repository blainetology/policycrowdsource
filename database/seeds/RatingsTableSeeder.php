<?php

use Illuminate\Database\Seeder;
use App\Rating;
use App\Section;
use App\Document;
use App\User;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        // Seed Policy & Section ratings
        foreach(Document::where('id','!=',20007)->get() as $document){
            $did = $document->id;
        	echo " - ".$document->name." ratings \n";
            $ratings_array = [];
            $parents = [];
            // figure out the parent sectiond ids
            $allsections = Section::where('document_id',$did)->orderBy('id','desc')->get();
            foreach($allsections as $section){
            	if(!isset($parents[(int)$section->parent_section_id]))
            		$parents[(int)$section->parent_section_id] = [];
            	$parents[(int)$section->parent_section_id][]=$section->id;
            }

            $allusers = User::all();
            echo " --- individual section user ratings\n";
            foreach($allsections as $section){
                $sid=$section->id;
            	// if it is a parent section, get the aggregate rating for the section for each user
            	if(isset($parents[(int)$section->id])){
            		foreach($allusers as $user){
            			if(rand(1,5)!=3){
	            			$ratingstotal = Rating::user($user->id)->whereIn('section_id',$parents[(int)$sid])->sum('rating');
	            			$ratingscount = Rating::user($user->id)->whereIn('section_id',$parents[(int)$sid])->count();
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
	    	                Rating::create(['user_id'=>$user->id,'section_id'=>$sid,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	    	            }
            		}
            	}
            	// if not a parent section, randomly assign a rating for each user
            	else{
            		foreach($allusers as $user){
            			if(rand(1,5)!=3){
                            if($user->political_weight<0 && $sid%2==1)
                                $rating = rand(1,3);
                            else if($user->political_weight<0 && $sid%2==0)
                                $rating = rand(2,4);
                            else if($user->political_weight>0 && $sid%2==1)
                                $rating = rand(2,4);
                            else if($user->political_weight>0 && $sid%2==0)
                                $rating = rand(1,3);
                            else
    	            			$rating = rand(1,4);
	            			if($rating==1)
	            				$rating=-2;
	            			elseif($rating==2)
	            				$rating=-1;
	            			elseif($rating==3)
	            				$rating=1;
	            			else
	            				$rating=2;
	    	                Rating::create(['user_id'=>$user->id,'section_id'=>$sid,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	    	            }
    	            }
            	}
            }

            // now get the overall ratings for the sections
            echo " --- overall section ratings\n";
            foreach($allsections as $section){
                $sid=$section->id;
    			$section->political_rating=Rating::politicalWeightCalculate(Rating::section($sid)->sum('weighted_rating'),Rating::section($sid)->sum('rating_abs_val'));
                $section->political_rating_minus2=Rating::politicalWeightCalculate(Rating::section($sid)->rating(-2)->sum('political_weight'),Rating::section($sid)->rating(-2)->count());
                $section->political_rating_minus1=Rating::politicalWeightCalculate(Rating::section($sid)->rating(-1)->sum('political_weight'),Rating::section($sid)->rating(-1)->count());
                $section->political_rating_plus1=Rating::politicalWeightCalculate(Rating::section($sid)->rating(1)->sum('political_weight'),Rating::section($sid)->rating(1)->count());
                $section->political_rating_plus2=Rating::politicalWeightCalculate(Rating::section($sid)->rating(2)->sum('political_weight'),Rating::section($sid)->rating(2)->count());
                $section->ratings_count=Rating::section($sid)->count();
                $section->ratings_count_minus2=Rating::section($sid)->rating(-2)->count();
                $section->ratings_count_minus1=Rating::section($sid)->rating(-1)->count();
                $section->ratings_count_plus1=Rating::section($sid)->rating(1)->count();
                $section->ratings_count_plus2=Rating::section($sid)->rating(2)->count();
                $section->ratings_avg=Rating::ratingsAvgCalculate($section);
                $section->ratings_total=($section->ratings_count_minus2*-2)+($section->ratings_count_minus1*-1)+($section->ratings_count_plus1*1)+($section->ratings_count_plus2*2);
    			$section->save();
            }

            // now get the overall ratings for the policy
            echo " --- individual document user ratings\n";
    		foreach($allusers as $user){
    			if(rand(1,5)!=3){
	                $ratingstotal = Rating::user($user->id)->whereIn('section_id',Section::where('document_id',$did)->topLevel()->pluck('id'))->sum('rating');
	                $ratingscount = Rating::user($user->id)->whereIn('section_id',Section::where('document_id',$did)->topLevel()->pluck('id'))->count();
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
	                Rating::create(['user_id'=>$user->id,'document_id'=>$did,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	            }
    		}

            echo " --- overall document ratings\n";
            $document->political_rating=Rating::politicalWeightCalculate(Rating::document($did)->sum('weighted_rating'),Rating::document($did)->sum('rating_abs_val'));
            $document->political_rating_minus2=Rating::politicalWeightCalculate(Rating::document($did)->rating(-2)->sum('political_weight'),Rating::document($did)->rating(-2)->count());
            $document->political_rating_minus1=Rating::politicalWeightCalculate(Rating::document($did)->rating(-1)->sum('political_weight'),Rating::document($did)->rating(-1)->count());
            $document->political_rating_plus1=Rating::politicalWeightCalculate(Rating::document($did)->rating(1)->sum('political_weight'),Rating::document($did)->rating(1)->count());
            $document->political_rating_plus2=Rating::politicalWeightCalculate(Rating::document($did)->rating(2)->sum('political_weight'),Rating::document($did)->rating(2)->count());
            $document->ratings_count=Rating::where('document_id',$did)->count();
            $document->ratings_count_minus2=Rating::document($did)->rating(-2)->count();
            $document->ratings_count_minus1=Rating::document($did)->rating(-1)->count();
            $document->ratings_count_plus1=Rating::document($did)->rating(1)->count();
            $document->ratings_count_plus2=Rating::document($did)->rating(2)->count();
            $document->ratings_avg=Rating::ratingsAvgCalculate($document);
            $document->ratings_total=($document->ratings_count_minus2*-2)+($document->ratings_count_minus1*-1)+($document->ratings_count_plus1*1)+($document->ratings_count_plus2*2);
			$document->save();
        }

    }

}
