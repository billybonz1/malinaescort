<?php
class Forms extends CWidget
{
    public function init(){}

    public function run()
    {
        $getM=$this->controller->getM();
		
		if ($getM) {
			$limit = 8;
		} else {
			$limit = 20;
		}

        $forms=Form::model()->getFormsListIndex($_GET,false);
        //shuffle($forms);
        $this->render('application.views.form.formsListIndex',array(
												'forms'=>$forms,
												'm'=>$getM,
												'limit'=>$limit,
												));
    }
}