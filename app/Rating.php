<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //

    protected $fillable = ['user_id','policy_id','section_id','rating','rating_abs_val','auto_tallied','political_weight','weighted_rating'];

    // SCOPES

    public function scopeByUser($query){
        return $query->where('user_id',\Auth::user()->id);
    }


    // STATIC METHODS
    
    public static function getSectionRating($sid,$ratings){
        if(empty($ratings))
            return null;
        if(is_array($ratings) && isset($ratings[$sid]))
            return $ratings[$sid];
        return null;        
    }
}
