<?php
class FormsArticles extends CWidget
{
    public function init(){}

    public function run()
    {
        $forms=Form::model()->getFormsList($_GET);
        shuffle($forms);
        $this->render('application.views.form.formsarticleslist',array('forms'=>$forms));
    }
}