<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //

    protected $fillable = ['user_id','policy_id','section_id','rating','auto_tallied','political_weight','weighted_rating','rating_count'];

    // SCOPES

    public function scopeByUser($query){
        return $query->where('user_id',\Auth::user()->id);
    }


    // STATIC METHODS
    public static function getColor($rating){
    	$rating = round($rating);
    	switch ($rating){
    		case 5: return 'rgb(250,0,0)'; 
    		case 4: return 'rgb(250,50,50)'; 
    		case 3: return 'rgb(225,75,75)'; 
    		case 2: return 'rgb(200,100,100)'; 
    		case 1: return 'rgb(175,125,125)'; 
    		case 0: return 'rgb(150,150,150)'; 
    		case -1: return 'rgb(125,125,175)'; 
    		case -2: return 'rgb(100,100,200)'; 
    		case -3: return 'rgb(75,75,225)'; 
    		case -4: return 'rgb(50,50,250)'; 
    		case -5: return 'rgb(0,0,250)'; 
    		default: return 'rgb(150,150,150)'; 
    	}
    }

    public static function getSectionRating($sid,$ratings){
        if(empty($ratings))
            return null;
        if(is_array($ratings) && isset($ratings[$sid]))
            return $ratings[$sid];
        return null;        
    }
}
