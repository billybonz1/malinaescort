<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    protected $_m;
    public  function getM()
    {
        require_once 'protected/components/Mobile_Detect.php';
        $detect = new Mobile_Detect;
        if($detect->isMobile()){
            return true;
        }
        return false;
    }
    public function filters(){
        return array('Language');
    }
    public function filterLanguage($filterChain){
        CHtml::$afterRequiredLabel='';
        Yii::app()->setLanguage(Language::getActive());
        $filterChain->run();
    }
    public function actionPublishUp($id){
        foreach(explode(',',$id) as $id) {
            $this->loadModel($id)->saveAttributes(array('status'=>1));
        }
        $this->redirect('admin');
    }

    public function actionPublishOff($id){
        foreach(explode(',',$id) as $id) {
            $this->loadModel($id)->saveAttributes(array('status'=>0));
        }
        $this->redirect('admin');
    }

    public function actionApprove($id, $val){
        $this->loadModel($id)->saveAttributes(array('status'=>($val=='true'?1:0)));
        $this->redirect('admin');
    }
    
}