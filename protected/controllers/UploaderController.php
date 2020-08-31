<?php
class UploaderController extends Controller
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
				'actions'=>array('upload'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

    public function actionUpload(){
        if (!empty($_FILES)) {
            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if (in_array(strtolower($fileParts['extension']),array('jpg','jpeg','gif','png'))) {
                $fileName = uniqid().'.'.$fileParts['extension'];

                foreach(Image::model()->sizes as $size){
                    $thumb = new Imagick($_FILES['Filedata']['tmp_name']);
                    $thumb->cropthumbnailimage($size['w'],$size['h']);
                    $f=$_SERVER['DOCUMENT_ROOT'].'/images/forms/'.$size['w'].'x'.$size['h'].'/';
                    if(!is_dir($f)) mkdir($f,0777);
                    $thumb->writeImage($f.$fileName);
                }

                move_uploaded_file($_FILES['Filedata']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/forms/original/'.$fileName);

                echo $fileName;
            } else echo 'Invalid file type.';
        } else echo 'Please select file';
    }
}