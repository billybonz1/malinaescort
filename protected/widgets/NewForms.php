<?php

class NewForms extends CWidget
{
    public function init()
    {

    }

    public function run()
    {
        $form=new Form();
        $newForms=$form->findAll(array('condition'=>'hide_from_admin_home_page<>1 AND NOT TIMESTAMPDIFF(MONTH,added,NOW())','order'=>'added DESC'));
        $evidence=$form->findAll(array('condition'=>'evidence_photo','order'=>'added DESC'));
        $closedSoon=$form->getListWillBeClisedSoon();
        $this->render('NewFormsList',array('evidence'=>$evidence,'newForms'=>$newForms,'closedSoon'=>$closedSoon));
    }
}