<?php
// Content items helper

class C{
    static function i($contentId){
        $contentObject=Content::model()->findByAttributes(array('name'=>$contentId,'city_id'=>CCity::getActiveId()));
        return $contentObject['text_'.Language::getActive()];
    }
}