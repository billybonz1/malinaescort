<?php

class ActivationController extends Controller
{
	public $defaultAction = 'activation';
    public $layout = '//layouts/general';

	/**
	 * Activation user account
	 */
	public function actionActivation () {
		$email = $_GET['email'];
        $activkey = $_GET['activkey'];
		if ($email&&$activkey) {
			$find = User::model()->notsafe()->findByAttributes(array('email'=>$email));
			if (isset($find)&&$find->status) {
                $this->redirect(array('/site/index','message'=>'thanks'));
			} elseif(isset($find->activkey) && ($find->activkey==$activkey)) {
				$find->activkey = UserModule::encrypting(microtime());
				$find->status = 1;
				$find->save();
                $this->redirect(array('/site/index','message'=>'thanks'));
			} else {
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
			}
		} else {
			$this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
		}
	}

}