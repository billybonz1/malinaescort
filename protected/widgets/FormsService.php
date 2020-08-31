<?php
class FormsService extends CWidget
{
    public $forms;
    public function init(){}

    public function run()
    {
        $arr = explode(".", $_SERVER['HTTP_HOST']);
        if($arr['0']=='m'){
            $getM=true;
        }
        else
        {
            $getM=false;
        }
        
        $this->render('application.views.form.formslistservice',array('forms'=>$this->forms,'m'=>$getM));
    }
}