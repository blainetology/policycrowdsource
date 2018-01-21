<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $table = "categories";
	protected $fillable = ['name','slug','parent'];

	// RELATIONSHIPS

	public function documents(){
		return $this->belongsToMany('\App\Document','document_categories');
	}

	// SCOPES

    public function scopeHasCount($query){
        return $query->where('count','>',0);
    }

}
