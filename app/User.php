<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','admin','edit','moderate','analyze','social_media','blog','last_login','political_weight'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    // RELATIONSHIPS

    


    // OTHER METHODS

    public function account_name(){
        $name = "";
        if(!empty($this->first_name))
            $name .= $this->first_name;
        if(!empty($this->last_name))
            $name .= " ".$this->last_name;
        if(empty($name))
            $name = $this->email;
        return $name;
    }

    public function full_name(){
        $name = "";
        if(!empty($this->first_name))
            $name .= $this->first_name;
        if(!empty($this->last_name))
            $name .= " ".$this->last_name;
        return $name;
    }

    public function short_name(){
        $name = "";
        if(!empty($this->first_name))
            $name .= $this->first_name;
        if(!empty($this->last_name))
            $name .= " ".substr($this->last_name,0,1).".";
        return $name;
    }

}
