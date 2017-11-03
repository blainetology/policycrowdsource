<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['name','policy_id','user_id','revision_id','parent_section_id','display_order','political_rating'];

    // RELATIONSHIPS

    public function subsections(){
    	return $this->hasMany('\App\Section','parent_section_id')->with('subsections');
    }

    public function comments(){
        return $this->hasMany('\App\Comment')->with('user')->orderBy('created_at','asc');
    }

    // SCOPES

    public function scopeTopLevel($query){
        return $query->where('parent_section_id',0);
    }

}
