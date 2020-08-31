<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastVisit();
                    echo 1;
                    return;
				}
			}
			// display the login form
			$this->renderPartial('/user/login',array('model'=>$model));
		}
	}
	
	private function lastVisit() {
		$lastVisit = User::model()->notsafe()->findByPk(U::id());
		$lastVisit->lastvisit = time();
		$lastVisit->lastvisit_IP = $this->getRealIpAddr();
		$lastVisit->save();
	}

    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            return $_SERVER['REMOTE_ADDR'];
    }

}