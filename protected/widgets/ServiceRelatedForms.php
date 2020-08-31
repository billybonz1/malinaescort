<?php

class ServiceRelatedForms extends CWidget
{
    public function init()
    {

    }

    public function run()
    {
        if (!count($forms = Form::model()->getFormsList(array('service' => array($_GET['id'])), true))) {
            return;
        }
        shuffle($forms);

        $this->render('RelatedForms', array('forms' => $forms));
    }
}