<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = ['name','policy_id','user_id','revision_id','parent_section_id','display_order'];

}
