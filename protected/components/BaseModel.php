<?php
class BaseModel extends CActiveRecord {
    function __get($name) {
        try{
            return parent::__get($name);
        }
        catch(Exception $e) {
            $val=parent::__get($name.'_'.Language::getActive());
            return $val?$val:parent::__get($name.'_en');
        }
    }
    public function getAttributeLabel($attribute)
    {
        return L::t(parent::getAttributeLabel($attribute));
    }
}