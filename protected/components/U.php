<?php
// User API alias
class U {
    public static function id(){
        return Yii::app()->user->id;
    }
    public static function name(){
        return Yii::app()->user->name;
    }
}