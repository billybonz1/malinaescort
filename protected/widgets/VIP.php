<?php
class VIP extends CWidget
{
    public function init()
    {

    }

    public function run()
    {
        if(!count($forms=Form::model()->getFormsList($_GET,true))) return;
        shuffle($forms);
        $this->render('VIPList', array('vipforms'=>$forms));
    }
}