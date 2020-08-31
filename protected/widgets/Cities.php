<?php
class Cities extends CWidget
{
    public function init(){}

    public function run()
    {
        $cities=City::model()->findAll();
        $this->render('Cities',array('cities'=>$cities));
    }
}