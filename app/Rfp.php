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

    // SCOPES

    public function scopeViewable($query){
        return $query->where('published',1)->where('public',1);
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

    // STATIC METHODS


}
