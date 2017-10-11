<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    //
    public $table = 'policies';

    protected $fillable = ['title','content','forked_id','numbering_pattern_id','rfp_id','public','published','short_synopsis','full_synopsis'];


    public function sections(){
    	return $this->hasMany('\App\Section')->orderBy('display_order','asc');
    }

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
