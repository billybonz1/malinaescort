<?php
class About extends CWidget
{
    public function init()
    {

    }

    public function run()
    {
        $this->render('AboutView',array('content'=>C::i('site_description')));
    }
}