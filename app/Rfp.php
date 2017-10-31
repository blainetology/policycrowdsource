<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfp extends Model
{
    //
    public $table = 'rfps';

    protected $fillable = ['name','short_overview','full_details','submission_start','submission_cutoff','no_expiration','public','published','house_rfp','rating','rating_count'];


    // RELATIONSHIPS

    public function policies(){
    	return $this->hasMany('\App\Policy');
    }
    public function collaborators(){
        return $this->hasMany('\App\Collaborator')->with('user')->orderBy('owner','desc')->orderBy('admin','desc')->orderBy('editor','desc')->orderBy('reviewer','desc');
    }
    public function comments(){
        return $this->hasMany('\App\Comment')->with('user')->orderBy('created_at','asc');
    }

    // SCOPES

    public function scopeViewable($query){
        return $query->where('published',1)->where('public',1)->where(function($query){
            $query->whereRaw("CURRENT_DATE BETWEEN `submission_start` AND `submission_cutoff`")->orWhere('no_expiration',1);
        });
    }
    public function scopeHouse($query){
        return $query->where('house_rfp',1);
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
        return $query->whereIn('id',\App\Collaborator::where('user_id',\Auth::user()->id)->whereNotNull('rfp_id')->get()->pluck('rfp_id'));
    }
    public function scopeUserRatedBy($query){
        return $query->whereIn('id',\App\Rating::where('user_id',\Auth::user()->id)->whereNotNull('rfp_id')->pluck('rfp_id'));
    }

    // STATIC METHODS


}
