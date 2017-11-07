<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['name','document_id','user_id','revision_id','parent_section_id','display_order','political_rating'];

    // RELATIONSHIPS

    public function document(){
        return $this->belongsTo('\App\Document');
    }

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

    // STATIC METHODS

    public static function sortSections($basesections,$parent_id=null){
        $sections = [];
        foreach($basesections as $section){
            if($section['parent_section_id'] == $parent_id){
                $sections[$section['display_order']] = $section;
            }
        }
        if(!empty($sections)){
            foreach($sections as $secID => $section)
                $sections[$secID]['sections']=self::sortSections($basesections,$section['id']);
        }
        return $sections;
    }

}
