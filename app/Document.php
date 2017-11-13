<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //

    protected $fillable = ['type','name','content','forked_id','numbering_pattern_id','document_id','public','short_synopsis','full_synopsis','published','submission_cutoff','political_rating','house_document','starter_document','child_count'];


    // RELATIONSHIPS

    public function sections(){
        return $this->hasMany('\App\Section')->with('comments')->orderBy('display_order','asc');
    }
    public function topLevelSections(){
    	return $this->hasMany('\App\Section')->where('parent_section_id',0)->orderBy('display_order','asc');
    }
    public function topLevelSectionsNested(){
        return $this->hasMany('\App\Section')->where('parent_section_id',0)->orderBy('display_order','asc')->with('subsections');
    }
    public function parent(){
        return $this->belongsTo('\App\Document','document_id');
    }
    public function children(){
        return $this->hasMany('\App\Document','document_id');
    }
    public function collaborators(){
        return $this->hasMany('\App\Collaborator')->with('user')->orderBy('owner','desc')->orderBy('admin','desc')->orderBy('editor','desc')->orderBy('reviewer','desc');
    }
    public function comments(){
        return $this->hasMany('\App\Comment')->with('user')->orderBy('created_at','asc');
    }
    public function tags(){
        return $this->belongsToMany('\App\Tag','document_tags')->wherePivot('type','tag');
    }
    public function categories(){
        return $this->belongsToMany('\App\Tag','document_tags')->wherePivot('type','cat');
    }

    // SCOPES

    public function scopeRfp($query){
        return $query->where('type','rfp');
    }
    public function scopePolicy($query){
        return $query->where('type','policy');
    }
    public function scopeViewable($query){
        return $query->whereNotNull('published')->where('public',1);
    }
    public function scopeStarter($query){
        return $query->where('starter_document',1);
    }
    public function scopeHouse($query){
        return $query->where('house_document',1);
    }
    public function scopeUserSubmitted($query){
        return $query->where('house_document',0);
    }
    public function scopePublished($query){
        return $query->where('published',1);
    }
    public function scopeUnpublished($query){
        return $query->whereNotNull('published');
    }
    public function scopePublic($query){
        return $query->where('public',1);
    }
    public function scopePrivate($query){
        return $query->where('public',0);
    }
    public function scopeUserCollaboratingOn($query){
        return $query->whereIn('id',\App\Collaborator::where('user_id',\Auth::user()->id)->whereNotNull('document_id')->pluck('document_id'));
    }
    public function scopeUserRatedBy($query){
        return $query->whereIn('id',\App\Rating::where('user_id',\Auth::user()->id)->whereNotNull('document_id')->pluck('document_id'));
    }

    // METHODS

    public function isHouse(){
        return !empty($this->house_document);
    }
    public function isStarter(){
        return !empty($this->starter_document);
    }


}
