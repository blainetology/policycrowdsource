<?php
namespace Shared;

class ViewHelpers{

	public static function date($timestamp,$full=false){
        if($full)
            return date('F j, Y',strtotime($timestamp));
        return date('m/d/Y',strtotime($timestamp));
	}

    public static function datetime($timestamp,$full=false,$military=false){
        if($full){
            if($military)
                return date('F j, Y @ H:i',strtotime($timestamp));
            else
                return date('F j, Y @ h:iA',strtotime($timestamp));
        }
        else{
            if($military)
                return date('m/d/Y @ H:i',strtotime($timestamp));
            else
                return date('m/d/Y @ h:iA',strtotime($timestamp));
        }
        return date('m/d/Y @ h:iA',strtotime($timestamp));
    }

    public static function time($timestamp,$military=false){
        if($military)
            return date('H:i',strtotime($timestamp));
        return date('h:iA',strtotime($timestamp));
    }

}