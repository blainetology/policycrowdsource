<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    //
    public $table = 'policies';

    protected $fillable = ['name','content','forked_id','numbering_pattern_id','rfp_id','public','published','short_synopsis','full_synopsis','rating','house_policy'];


    // RELATIONSHIPS

    public function sections(){
        return $this->hasMany('\App\Section')->orderBy('display_order','asc');
    }
    public function topLevelSections(){
    	return $this->hasMany('\App\Section')->where('parent_section_id',0)->orderBy('display_order','asc');
    }
    public function rfp(){
        return $this->belongsTo('\App\Rfp');
    }
    public function collaborators(){
        return $this->hasMany('\App\Collaborator')->with('user')->orderBy('owner','desc')->orderBy('admin','desc')->orderBy('editor','desc')->orderBy('reviewer','desc');
    }

    // SCOPES

    public function scopeViewable($query){
        return $query->where('published',1)->where('public',1);
    }
    public function scopeStarter($query){
        return $query->where('starter_policy',1);
    }
    public function scopeHouse($query){
        return $query->where('house_policy',1);
    }
    public function scopeUserSubmitted($query){
        return $query->where('house_policy',0);
    }
    public function scopePublished($query){
        return $query->where('published',1);
    }
    public function scopeUnpublished($query){
        return $query->where('published',0);
    }
    public function scopePublic($query){
        return $query->where('public',1);
    }
    public function scopePrivate($query){
        return $query->where('public',0);
    }
    public function scopeUserCollaboratingOn($query){
        return $query->whereIn('id',\App\Collaborator::where('user_id',\Auth::user()->id)->whereNotNull('policy_id')->pluck('policy_id'));
    }
    public function scopeUserRatedBy($query){
        return $query->whereIn('id',\App\Rating::where('user_id',\Auth::user()->id)->whereNotNull('policy_id')->pluck('policy_id'));
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
