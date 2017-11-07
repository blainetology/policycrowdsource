<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //

    protected $fillable = ['user_id','document_id','section_id','rating','rating_abs_val','auto_tallied','political_weight','weighted_rating'];

    // SCOPES

    public function scopeByUser($query){
        return $query->where('user_id',\Auth::user()->id);
    }

    public function scopeActive($query){
        return $query->where('user_active',1)->where('banned',0)->where('flagged',0);
    }

    // STATIC METHODS
    
    public static function getSectionRating($sid,$ratings){
        if(empty($ratings))
            return null;
        if(is_array($ratings) && isset($ratings[$sid]))
            return $ratings[$sid];
        return null;        
    }

    public static function getThumbs($policy){
        $html = "";

        if($policy->ratings_count>0){
            $thumbs = self::$thumbs;
            krsort($thumbs);
            foreach($thumbs as $value=>$thumb){
                ${$thumb[2]} = round($policy->{'ratings_'.$thumb[2]}/$policy->ratings_count*100,1);
                $html .= '<i class="fa '.$thumb[1].' rating-thumb rating'.$value.'" aria-hidden="true" style="width:30px; margin-top:1px;"></i>'.${$thumb[2]}.'% '.$thumb[0].'<br/>';
            }
        }
        else{
            $html .= '<h4 class="text-center text-warning">This has no ratings yet.</h4>';
        }        
        return $html;
    }

    // STATIC VARS

    public static $thumbs = [
        '-2'    =>['strongly do not support','fa-thumbs-down','minus2'],
        '-1'    =>['do not support','fa-thumbs-down','minus1'],
        '1'     =>['support','fa-thumbs-up','plus1'],
        '2'     =>['strongly support','fa-thumbs-up','plus2']
    ];

}
