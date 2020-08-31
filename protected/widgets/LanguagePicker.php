<?php
class LanguagePicker extends CWidget
{
    public function init()
    {

    }

    public function run()
    {
        CWidget::render('LanguagesBar', array('list'=>Language::getList()));
    }
}