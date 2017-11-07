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
        	echo " - ".$document->name." ratings \n";
            $ratings_array = [];
            $parents = [];
            // figure out the parent sectiond ids
            $allsections = Section::where('document_id',$document->id)->orderBy('id','desc')->get();
            foreach($allsections as $section){
            	if(!isset($parents[(int)$section->parent_section_id]))
            		$parents[(int)$section->parent_section_id] = [];
            	$parents[(int)$section->parent_section_id][]=$section->id;
            }

            $allusers = User::all();
            echo " --- individual section user ratings\n";
            foreach($allsections as $section){
            	// if it is a parent section, get the aggregate rating for the section for each user
            	if(isset($parents[(int)$section->id])){
            		foreach($allusers as $user){
            			if(rand(1,5)!=3){
	            			$ratingstotal = Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$section->id])->sum('rating');
	            			$ratingscount = Rating::where('user_id',$user->id)->whereIn('section_id',$parents[(int)$section->id])->count();
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
	    	                Rating::create(['user_id'=>$user->id,'section_id'=>$section->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
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
	    	                Rating::create(['user_id'=>$user->id,'section_id'=>$section->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	    	            }
    	            }
            	}
            }

            // now get the overall ratings for the sections
            echo " --- overall section ratings\n";
            foreach($allsections as $section){
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
    			$section->political_rating=$rating;
                $section->ratings_count=Rating::where('section_id',$section->id)->count();
                $section->ratings_minus2=Rating::where('section_id',$section->id)->where('rating','-2')->count();
                $section->ratings_minus1=Rating::where('section_id',$section->id)->where('rating','-1')->count();
                $section->ratings_plus1=Rating::where('section_id',$section->id)->where('rating','1')->count();
                $section->ratings_plus2=Rating::where('section_id',$section->id)->where('rating','2')->count();
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
                $section->ratings_total=($section->ratings_minus2*-2)+($section->ratings_minus1*-1)+($section->ratings_plus1*1)+($section->ratings_plus2*2);
    			$section->save();
            }

            // now get the overall ratings for the policy
            echo " --- individual document user ratings\n";
    		foreach($allusers as $user){
    			if(rand(1,5)!=3){
	                $ratingstotal = Rating::where('user_id',$user->id)->whereIn('section_id',Section::where('document_id',$document->id)->topLevel()->pluck('id'))->sum('rating');
	                $ratingscount = Rating::where('user_id',$user->id)->whereIn('section_id',Section::where('document_id',$document->id)->topLevel()->pluck('id'))->count();
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
	                Rating::create(['user_id'=>$user->id,'document_id'=>$document->id,'political_weight'=>$user->political_weight,'rating'=>$rating,'rating_abs_val'=>abs($rating),'weighted_rating'=>($user->political_weight*$rating)]);
	            }
    		}

            echo " --- overall document ratings\n";
			$ratingstotal = Rating::where('document_id',$document->id)->sum('weighted_rating');
			$ratingscount = Rating::where('document_id',$document->id)->sum('rating_abs_val');
			echo $ratingstotal." / ".$ratingscount."\n";
			if($ratingscount==0)
				$rating=0;
			else
	    		$rating = $ratingstotal/$ratingscount;
			if($rating > 5)
				$rating = 5;
			elseif($rating < -5)
				$rating = -5;
			$document->political_rating=$rating;
            $document->ratings_count=Rating::where('document_id',$document->id)->count();
            $document->ratings_minus2=Rating::where('document_id',$document->id)->where('rating','-2')->count();
            $document->ratings_minus1=Rating::where('document_id',$document->id)->where('rating','-1')->count();
            $document->ratings_plus1=Rating::where('document_id',$document->id)->where('rating','1')->count();
            $document->ratings_plus2=Rating::where('document_id',$document->id)->where('rating','2')->count();
            $ratings_avg = (($document->ratings_minus2*-2)+($document->ratings_minus1*-1)+($document->ratings_plus1*1)+($document->ratings_plus2*2))/$document->ratings_count;
            if($ratings_avg<-1)
                $ratings_avg=-2;
            elseif($ratings_avg<0)
                $ratings_avg=-1;
            elseif($ratings_avg>1)
                $ratings_avg=2;
            else
                $ratings_avg=1;
            $document->ratings_avg=$ratings_avg;
            $document->ratings_total=($document->ratings_minus2*-2)+($document->ratings_minus1*-1)+($document->ratings_plus1*1)+($document->ratings_plus2*2);
			$document->save();
        }

    }
}
