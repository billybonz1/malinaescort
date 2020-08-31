<?php

class ModelHelper {
    static function getArray($model, $params = array(), $fieldName = 'name') {
        $items = array();
        foreach($model->findAll($params) as $item) {
            $items[$item->id] = $item->$fieldName;
        }
        return $items;
    }
}