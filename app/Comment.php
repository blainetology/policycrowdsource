<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = ['user_id','policy_id','section_id','comment'];

    // RELATIONSHIPS

    public function user(){
    	return $this->belongsTo('\App\User');
    }

    // SCOPES

    public function scopeForSection($query,$section_id){
    	return $query->where('section_id',$section_id)->orderBy('created_at','asc');
    }

    // STATIC METHODS


}
