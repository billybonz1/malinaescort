<?php

class CCity
{
	static function getActive(){
        $domain=explode('.',$_SERVER['HTTP_HOST']);
        $city=$domain[(count($domain)==4?1:0)];
        return count($domain)>2 && in_array($city,self::getList())?$city:0;
	}

	static function getList(){
		return array_map(function($city){return $city->domain_alias;},City::model()->findAll());
	}

    static function getActiveId(){
        return self::getActive()?City::model()->findByAttributes(array("domain_alias"=>self::getActive()))->id:0;
    }
}