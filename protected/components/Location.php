<?php
class Location {
    static function getIP(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }
    static function isHP(){
        return Yii::app()->controller->id=='site'&&Yii::app()->controller->action->id=='index';
    }
    static function isPDP(){
        return Yii::app()->controller->id=='product'&&Yii::app()->controller->action->id=='view';
    }
    static function isPLP(){
        return Yii::app()->controller->id=='product'&&Yii::app()->controller->action->id=='index';
    }
    static function isSP(){// service page
        return Yii::app()->controller->action->id=='viewService'||Yii::app()->controller->action->id=='ViewArticles';
    }
}