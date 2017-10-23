<?php
namespace Shared;

class Geocode{


	private static function curl($url,$post=NULL){
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $url);
        $contents = curl_exec($c);
        curl_close($c);

        if($contents) 
			return $contents;
        else 
			return false;
	}
	public static function address($address){
		
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=".urlencode($address);
        $resp_json = self::curl($url);
        $resp = json_decode($resp_json, true);
        if($resp['status']=='OK'){
            return $resp['results'][0]['geometry'];
        }else{
            return false;
        }
		
	}

	public static function ip($address){


	}
}