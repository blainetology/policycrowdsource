<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['name','policy_id','user_id','revision_id','parent_section_id','display_order','rating'];

    // RELATIONSHIPS

    public function subsections(){
    	return $this->hasMany('\App\Section','parent_section_id');
    }

    // SCOPES

    public function scopeTopLevel($query){
        return $query->where('parent_section_id',0);
    }

}
