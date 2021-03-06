<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
	protected $fillable = ['name','slug'];

	// RELATIONSHIPS

	public function documents(){
		return $this->belongsToMany('\App\Document','document_tags');
	}

	// SCOPES

    public function scopeHasCount($query){
        return $query->where('count','>',0);
    }

}
