<?php

class MessageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/account';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
            'language',
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','create','update','success'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>UserModule::getAdmins(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->layout='//layouts/'.(UserModule::isAdmin()?'column2':'account');
        $message=$this->loadModel($id);
        if($message->recipient==U::id()){
            $message->isopened=1;
            $message->update();
        }
		$this->render('view',array(
			'model'=>$message,
            'to'=>$message->recipient,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($to=1)
	{
		$model=new Message;
        $this->layout='//layouts/'.(UserModule::isAdmin()?'column2':'account');

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];

            if($model->save()){
                $link=YII::app()->controller->createAbsoluteUrl('/message/view',array('id'=>$model->id));
				M::s($model->toUser->email,'Поступило новое сообщение',"Для более детальной информации перейдите по ссылке: {$link}");
                $this->redirect(array(UserModule::isAdmin()?'admin':'success'));
            }
		}

		$this->render('create',array(
			'model'=>$model,
            'to'=>$to,
		));
	}
    public function actionSuccess(){
        $this->render('success');
    }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Message']))
		{
			$model->attributes=$_POST['Message'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        foreach(explode(',',$id) as $id){
            $this->loadModel($id)->delete();
        }

        $this->redirect(array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($box='inbox')
	{
        $uid=U::id();

        $criteria=new CDbCriteria;
        $criteria->order='added DESC';
        $criteria->condition=$box=='inbox'?"recipient = {$uid}":"sender = {$uid}";
        $dataProvider=new CActiveDataProvider('Message',array('criteria'=>$criteria));

        $this->render('index',array(
			'dataProvider'=>$dataProvider,
            'box'=>$box,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($box='inbox',$searchBy='')
	{
        $this->layout='//layouts/column2';
		$model=new Message('search');
		$model->unsetAttributes();  // clear any default values
        $_GET['Message'][($box=='inbox'?'recipient':'sender')]=U::id();
        $model->attributes=$_GET['Message'];

        $dp=$model->search($searchBy);
        $dp->sort=array('defaultOrder'=>'isOpened ASC, added DESC');

		$this->render('admin',array('model'=>$model,'box'=>$box,'dp'=>$dp));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Message the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Message::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Message $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='message-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
