<?php class BanersController extends Controller
{
    public $classModel = 'baners';
    public $img;
    public $oldimg;

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
                'actions'=>array('index','view'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete','publishUp','publishOff'),
                'users'=>UserModule::getAdmins(),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('baners');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }


    public function actionAdmin()
    {
        $model=new baners('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Content']))
            $model->attributes=$_GET['Content'];

        $dp=$model->search();
        //$dp->criteria=array("condition"=>"name<>'google_analytics'");
//        $dp->condition="name<>'google_analytics'";
        $dp->sort = array('defaultOrder'=>'id ASC');

        $this->render('admin',array(
            'model'=>$model,
            'dp'=>$dp,
        ));
    }
    public function actionCreate()
    {
        $model=new baners();

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if(isset($_POST['Baners']))
        {
            $model->attributes=$_POST['Baners'];
            if($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

        if(isset($_POST['Baners']))
        {
            if($_POST['Baners']['image']=="")
            {
                $_POST['Baners']['image']=$model->image;
            }
            $model->attributes=$_POST['Baners'];

            if($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }
    public function loadModel($id)
    {
        $model=baners::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='content-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionPublishUp($id){
        foreach(explode(',',$id) as $id) {
            $model=$this->loadModel($id);
            $model->hiden=1;
            $model->save();
            }
        $this->redirect('admin');
    }
    public function actionPublishOff($id){
        foreach(explode(',',$id) as $id) {
            $model=$this->loadModel($id);
            $model->hiden=0;
            $model->save();
        }
        $this->redirect('admin');
    }


}