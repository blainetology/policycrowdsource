<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
	protected $fillable = ['name','slug','parent_category'];

	// RELATIONSHIPS

	public function documents(){
		return $this->belongsToMany('\App\Document','document_tags');
	}

	// SCOPES

    public function scopeIsTag($query){
        return $query->where('is_tag',1);
    }

    public function scopeIsCategory($query){
        return $query->where('is_category',1);
    }

}
