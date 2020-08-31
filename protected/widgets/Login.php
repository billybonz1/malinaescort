<?php
class Login extends CWidget
{
    public function init(){}

    public function run()
    {
      if(Language::getActive()!='ru') return;
        $this->render(Yii::app()->user->isGuest?'LoginForm':'LogoutForm',
            array(
                'model' => new RegistrationForm,
                'profile'=>new Profile,
                'userModel'=>new UserLogin,
            )
        );
    }
}