<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    //
    protected $fillable = ['policy_id','rfp_id','user_id','accepted','owner','admin','editor','reviewer','viewer'];

    // RELATIONSHIPS

    public function user(){
    	return $this->belongsTo('\App\User');
    }

}
