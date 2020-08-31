<?php

class FormController extends Controller
{
    public $images = array();
     public $meta_description = '';
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
	
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				));
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
				'actions'=>array('index','view', 'ajaxMore' ,'ajaxSearch', 'AjaxLoad','ajaxSearchService','captcha','SearchByService'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','my','uploadFile'),
				'users'=>array('@'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('update','delete','publishDown','publishUp'),
                'expression'=>"Form::canBeEditedByTheCurrentUser()",
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','approve','publishUp','publishOff','hideFromHomePage','evidence','prolong','remind'),
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
	public function actionView($id, $days=0,$phone)
	{
        $this->layout='//layouts/general';
        if($this->getM()){
            $this->layout='Mobile';
        }
        $model=$this->loadModel($id);
        
        $ph =  preg_replace('/\D/', '',str_replace(' ','',str_replace('+', '',$model->cell_phone)));
     
        if($ph !== $phone){
        	throw new CHttpException(404,L::t("This form temporary isn't available."));
        }

           $lg=Language::getActive();
     
	        if($lg=='en'){
	        	   $this->pageTitle="{$model->name} - {$model->cell_phone}";
	        	   $this->meta_description = "Escort girl {$model->name}. This girl is waiting for you - call the number {$model->cell_phone} to meet  {$model->name}.";
	        } else if($lg=='tr') {
	        	  $this->pageTitle="{$model->name} - {$model->cell_phone}";
	        	  $this->meta_description = "Eskort kız {$model->name}. Bu kız seni bekliyor - numarayı ara {$model->cell_phone} tanışmak  {$model->name}.";
	        } else {
	        	 $this->pageTitle="{$model->name} - {$model->cell_phone}";
	        	 $this->meta_description = "Проститутка {$model->name}. Эта девушка ждет тебя - позвони по номеру {$model->cell_phone} встречаться {$model->name}.";
	        }

        if(!$model->isPayed() && !$model->canBeEditedByTheCurrentUser())
            throw new CHttpException(404,L::t("This form temporary isn't available."));

        $model->doHit();
        $criteria=new CDbCriteria;
        $criteria->condition="form_id={$id}";
        $criteria->limit=5;
        $criteria->order="id ASC";
        $images=Image::model()->findAll($criteria);
        

		$this->render('view',array(
			'model'=>$model,
            'images'=>$images,
            'serviceCategories'=>ServiceCategory::model()->findAll('published=1'),
            'formServices'=>$this->getFormServices($model),
            'comments'=>Comment::model()->findAllByAttributes(array('form_id'=>$model->id,'status'=>1)),
            'days'=>$days,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Form;
		if(isset($_POST['Form']))
		{
			$model->attributes=$_POST['Form'];
			if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('form/my'));
		}
        $images = isset($_REQUEST['Form']['images']) ? $_REQUEST['Form']['images'] : null;
		$this->render('create',array(
			'model'=>$model, 'serviceCategories' => ServiceCategory::model()->findAll('published=1'),
            'formServices'=>$this->getFormServices($model),
            'images'=>$images,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Form']))
		{
			$model->attributes=$_POST['Form'];

            if($model->save())
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('form/my'));
		}
        $this->render('update',array(
			'model'=>$model, 'serviceCategories' => ServiceCategory::model()->findAll('published=1'),
            'formServices'=>$this->getFormServices($model),
            'images' => array_map(function($image){return $image->src;},Image::model()->findAllByAttributes(array('form_id'=>$id))),
		));
        
	}
    
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
        if(isset($_GET['ajax'])){
            foreach(explode(',',$id) as $formId){
                $model=$this->loadModel($formId);
                $model->deleteImage();
                $model->delete();
            }

            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else{
            $model = $this->loadModel($id);
            $model->deleteImage();
            $model->delete();

            $this->redirect(array('/form/my','showDeleteMessage'=>true));
        }
	}

    private function getFormServices(Form $model) {
        $formServices = array();
        if(isset($_POST['Form']['services']))
            $formServices = array_merge($formServices, $_POST['Form']['services']);
        foreach($model->formServices as $formService) {
            $formServices[] = $formService->service_id;
        }
        return $formServices;
    }

    function actionMy($days=0){
    	$this->render('index',array(
            'forms'=>Form::model()->getAllMyFroms(),
    		'model'=>Form::model(),
            'days'=>$days,
        ));
    }

	/**
	 * Manages all models.
	 */
	public function actionAdmin($user_id=0, $id=0, $searchBy='', $payed_till=null)
	{
		$model=new Form('search');
        $this->layout='column2';
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Form']))
			$model->attributes=$_GET['Form'];

        $dp=$model->search($searchBy);
        $dp->pagination = array('pageSize'=>($id ? 999 : 50));
        $dp->sort = array('defaultOrder'=>'id DESC');

		$this->render('admin',array(
			'dp'=>$dp,
            'model'=>$model,
            'user_id'=>$user_id,
            'id'=>$id,
            'searchBy'=>$searchBy
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Form::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionAjaxSearch(){

		$forms=Form::model()->getFormsList($_GET,false,$_GET['page']);
		 
		$forms_total  =Form::model()->getFormsList($_GET);
        //shuffle($forms);

        $this->renderPartial('formsList',array(
								'forms'=>$forms,
								'forms_total'=>$forms_total,
							));
    }
    public function actionAjaxSearchService(){

        $forms=Form::model()->getFormsList($_GET);
        shuffle($forms);
        $this->renderPartial('formslistservice',array('forms'=>$forms));
    }
    public function actionSearchByService($service)
    {
        $this->layout='//layouts/home';
        unset($_GET['name']);
        $_GET=array('service'=>$_GET);
        $forms = Form::model()->getFormsList($_GET);
        shuffle($forms);
        $this->render('formsList',array('forms'=>$forms));
    }
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionApprove($id, $val){
		Form::model()->findByPk($id)->saveAttributes(array('no_photoshop_approved'=>($val=='true'?1:0)));
	}

    public function actionEvidence($id, $val){
		Form::model()->findByPk($id)->saveAttributes(array('no_photoshop_approved'=>intval($val)));
    }

    public function actionPublishDown($id){
        Form::model()->findByPk($id)->saveAttributes(array('published'=>0));
        $this->redirect(array('form/my'));
    }

    public function actionPublishUp($id,$ajax=''){
        foreach(explode(',',$id) as $id) {
            $this->loadModel($id)->saveAttributes(array('published'=>1));
        }
        $this->redirect(($ajax?'admin':'/form/my'));
    }

    public function actionPublishOff($id){
        foreach(explode(',',$id) as $id) {
            $this->loadModel($id)->saveAttributes(array('published'=>0));
        }
        $this->redirect('admin');
    }

    public function actionHideFromHomePage($id){
        $this->loadModel($id)->hide();
    }

    public function actionProlong($id, $value){
        $this->loadModel($id)->prolong($value);
    }

    public function actionRemind(){
        $forms=Form::model()->getListWillBeClisedSoon(array('order'=>'user_id'));
        $formList=$email='';
        $userId=$forms[0]->user_id;
        $title="У Ваших анкет скоро закончится публикация";
        $msgHeader="<tr><td><b>ID</b></td><td><b>Имя</b></td><td><b>Осталось дней</b></td><td></td></tr>";

        foreach($forms as $form){
            if($userId!=$form->user_id){
                $userId=$form->user_id;
                $message=$title."<table border='1'>{$msgHeader}{$formList}</table>";
                M::s($email,$title,$message);
                $formList='';
            }
            $link=CHtml::link($form->name,$form->generateURL(),array('target'=>'_blank'));
            $payLink=CHtml::link('Продлить',YII::app()->controller->createAbsoluteUrl('/payment/create',array('id'=>$form->id)),array('target'=>'_blank'));
            $formList.="<tr><td>{$form->id}</td><td>{$link}</td><td>{$form->daysLeft()}</td><td>{$payLink}</td></tr>";
            $email=$form->user->email;
        }
        echo L::t('Reminder has been sent.');
    }
	
	
	
    public function actionAjaxMore(){
		$offset = $_GET['offset'];
		$limit = $_GET['limit']; 
		$_GET['offset'] = $offset;
		$_GET['limit'] = $limit;
        $forms=Form::model()->getFormsList($_GET);
        //shuffle($forms);
		//echo json_encode($forms);
        $this->renderPartial('formslistservice',array('forms'=>$forms));
    }
	
	
    public function actionAjaxLoad(){
		$forms=Form::model()->getFormsListIndex($_GET,false,$_GET['page']);
		
		$limit = $_GET['limit'];
	
		$forms_total  =Form::model()->getFormsListIndex($_GET);
        //shuffle($forms);
        $this->renderPartial('formsListIndex',array(
								'forms'=>$forms,
								'forms_total'=>$forms_total,
								'limit'=>$limit,
							));
    }
	
	
	
	
	
	
}