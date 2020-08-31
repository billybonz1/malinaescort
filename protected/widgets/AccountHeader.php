<?php
class AccountHeader extends CWidget
{
    public function init(){}

    public function run()
    {
        $this->render('AccountHeader',array('user' => User::model()->findByPk(U::id())));
    }
}