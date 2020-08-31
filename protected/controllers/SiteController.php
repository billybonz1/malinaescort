<?php
   
class SiteController extends Controller
{
    public $layout = '//layouts/home';
    public $meta_description = '';
    public $meta_keywords = '';
      
    
    /**
     * Declares class-based actions.
     */
 
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionSitemap()
    {
       
		if(isset($_SERVER['HTTPS'])){
			$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		} else {
			$protocol = 'http';
		}
		$domen = $protocol . "://" . $_SERVER['SERVER_NAME'];
		$this->pageTitle = '';
        $this->meta_description = '';
		$lang = Language::getActive();
		
		$area = new Area();
		$areas = $area->getAllAreas();
		
		$article = new articles();
		$articles = $article->getArticles();
		
		$form = new Form();
		$forms = $form->getFormsList();
		$profiles = array();
		
		if ($forms) {
			foreach ($forms as $form) {
				$images = $form->getHomeImageProfile($form['id']);
				if ($images) {
					$image = $domen . '/images/forms/original/' . $images[0]['src'];
				} else {
					$image = NULL;
				}
				$profiles[] = array(
					'url'   => $form->generateURL(),
					'added' => $form['added'],
					'name'  => $form['name_'.$lang],
					'image' => $image,
				);
			}
		}
		
		$service = new Service();
		$services = $service->findAll('published=1');


        $this->renderPartial('sitemap',
            array(
				'domen'    => $domen,
				'lang'     => $lang,
				'areas'    => $areas,
				'articles' => $articles,
				'profiles' => $profiles,
				'services' => $services,
				
            ));
    }

    /**
     *  robot.txt
     */
    public function actionRobots()
    {
        header('Content-Type: text/plain');
        $host = Yii::app()->request->hostInfo;
        $host = preg_replace("/w+\./", '', $host);
        $host = str_replace("http://", "", $host);
        $this->renderPartial('robots', array(
            'host' => $host,
            'sitemap' => "http://$host/sitemap.xml",
        ));

    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        if($_SERVER['REQUEST_URI']=='/site/index'){
            if(strpos(Yii::app()->request->hostInfo, 'en.')){
                $this->redirect('https://en.malinaescort.com');
            } else if(strpos(Yii::app()->request->hostInfo, 'tr.')){
                $this->redirect('https://tr.malinaescort.com');
            } else {
                 $this->redirect('https://malinaescort.com');
            }
        }
        if($this->getM()){
            $this->layout='Mobile';
        }
        if (isset($_GET['action']) && $_GET['action'] == 'login') {
            Yii::app()->clientScript->registerScript('Login', "$('.log-in .show-popup').click()");
        }

        if (isset($_GET['lang'])) {

            foreach ($langs = Language::getList() as $values) {
                if ($_GET['lang'] == $values) {
                    $this->redirect('http://' . $_GET['lang'] . '.natashaescort.com');
                }
            }

        }
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'


        if (isset($_GET['service'])) {

            $serv = $_GET['service'];

            if (!is_numeric($serv)) {
                $_GET['service'] = array(Service::model()->getIdSeoName($serv));
                $serv_id = Service::model()->getIdSeoName($serv);

            } else {
                $_GET['service'] = array($serv);
                $serv_id = $serv;
            }
            $service = Service::model()->findByPK($serv_id);

           $lg=Language::getActive();
            if($lg=='en'){

                   $this->pageTitle = "Escort girls {$service->name} | {$service->name} Independent Escorts | Girl Directory";
                   if($service->meta_description_en){
                     $this->meta_description = $service->meta_description_en;
                   } else {
                     $this->meta_description = "On our website you find a large selection girls escorts {$service->name} .";
                   }
            
            } else if($lg=='tr') {
              $this->pageTitle = "Eskort kızlar {$service->name} | {$service->name} Bağımsız Escort | Kız Dizini";
              if($service->meta_description_tr){
                     $this->meta_description = $service->meta_description_tr;
                   } else {
                     $this->meta_description = "Web sitemizde çok sayıda kız eskort bulabilirsiniz {$service->name} .";
                   }
            
            } else {
             $this->pageTitle = "Проститутки {$service->name} | {$service->name} Независимые эскорты | Женский каталог";
             if($service->meta_description_ru){
                $this->meta_description = $service->meta_description_ru;
             } else {
                $this->meta_description = "На нашем сайте вы найдете большой выбор девушек эскорт {$service->name} .";
             }
            
            }
       
        $this->meta_keywords = $service->meta_keywords;
            $expand = Yii::app()->clientScript->registerScript('expand', "$('.show-hidden-block').click();", CClientScript::POS_READY);
            $checked = Yii::app()->clientScript->registerScript('checked', "document.getElementById('service['+$serv_id+']').checked = true", CClientScript::POS_END);
            $scrol = Yii::app()->clientScript->registerScript('scrol', '$("html, body").animate({scrollTop: $("#JSFormsList").offset().top+350}, 500,function() {
                                                               $.each($(".formImage"),function(el){isScrolledIntoView(this)})
                                                                 });
                                                               initIntemsOverlay();
                                                               $.each($(".formImage"),function(el){isScrolledIntoView(this)})', CClientScript::POS_READY);

            $this->render('index', array($checked, $expand, $scrol));
        } else {
            if (!empty($_GET)) {
                $scrol = Yii::app()->clientScript->registerScript('scrol', '$("html, body").animate({scrollTop: $("#JSFormsList").offset().top-10}, 500,function() {
                                                               $.each($(".formImage"),function(el){isScrolledIntoView(this)})
                                                                 });
                                                               initIntemsOverlay();
                                                               $.each($(".formImage"),function(el){isScrolledIntoView(this)})', CClientScript::POS_READY);
                $this->render('index', array($scrol));
            } else {
                $this->render('index');
            }


        }
    }


    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $this->layout = '//layouts/error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $message = "<strong>Имя:</strong> {$model->name}<br>"
                    . "<strong>Емейл:</strong> {$model->email}<br/>"
                    . "<strong>Тема:</strong> {$model->subject}<br/>"
                    . "<strong>Текст сообщения:</strong> <br />{$model->body}";
                M::s('natasha.escort@ya.ru', $model->subject, htmlspecialchars($message), 'noreply@natashaescort.com');
                Yii::app()->user->setFlash('contact',
                    L::t('Thank you for contacting us. We will respond to you as soon as possible.'));
                $this->refresh();
            }
        }
        $this->renderPartial('contact', array('model' => $model));
    }

    public function actionWriteSms($id = 0)
    {
        $model = new SmsForm;

        if($id)
        {
            $model->id = $id;
        }

        if (isset($_POST['SmsForm'])) {
            $model->attributes = $_POST['SmsForm'];

            if ($model->validate()) {
                $form = Form::model()->findByPK($model->id);
                SMS::s($form->cell_phone, 'NATASHAESCORT: ' . $model->text . '. Сообщение от: ' . $model->phone);

                Yii::app()->user->setFlash('writeSms',
                    L::t('Thank you for contacting the girl. She will review your message and reply to you soon.'));
                $this->refresh();
            }
        }

        $this->renderPartial('writeSms', array('model' => $model, 'id' => $id ? $id : $model->id));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionClearCache()
    {
        $c = Image::model()->cleanUp();
        $js = $_SERVER['DOCUMENT_ROOT'] . '/js/all.js';
        $css = $_SERVER['DOCUMENT_ROOT'] . '/style/css/all.css';
        if (file_exists($js) && unlink($js))
            echo "Кеш JS удачно очищен \n";

        if (file_exists($css) && unlink($css))
            echo "Кеш CSS удачно очищен \n";

        Yii::app()->cache->flush();
        $size = round($c['size'], 2);
        echo L::t('Статический кеш успешно очищен.') . ($c['c'] > 0 ? "\nУдалено {$c['c']} устаневших файлов ({$size} MB)" : '');
    }

    public function actionViewService($id)
    {
        $this->layout='//layouts/service';
        if($this->getM()){
            $this->layout='Mobile';
        }

        $id = abs(intval($id));
 
        if (!$id) {
            throw new CHttpException(404,L::t("This service temporary isn't available."));
        }

        $model = new ServiceCategory();
        $service = Service::model()->findByPK($id);


           $lg=Language::getActive();
            if($lg=='en'){

                   $this->pageTitle = "Escort Kiev - {$service->name}";
                   if($service->meta_description_en){
                     $this->meta_description = $service->meta_description_en;
                   } else {
                     $this->meta_description = "On our website you find a large selection girls escorts {$service->name} .";
                   }
            
            } else if($lg=='tr') {
              $this->pageTitle = "Eskort Kiev - {$service->name}";
              if($service->meta_description_tr){
                     $this->meta_description = $service->meta_description_tr;
                   } else {
                     $this->meta_description = "Web sitemizde çok sayıda kız eskort bulabilirsiniz {$service->name} .";
                   }
            
            } else {
             $this->pageTitle = "Проститутки Киева - {$service->name}";
             if($service->meta_description_ru){
                $this->meta_description = $service->meta_description_ru;
             } else {
                $this->meta_description = "На нашем сайте вы найдете большой выбор девушек эскорт {$service->name} .";
             }
            
            }
       
        $this->meta_keywords = $service->meta_keywords;

        $this->breadcrumbs = array($service->category->name, $service->name);

        $forms = Form::model()->getFormsList(['service'=>[$service->id]]);
        shuffle($forms);

        $this->render('serviceInfo', array('serviceCategories' => $model->findAll('published'),'service' => $service, 'id' => $id, 'forms'=>$forms));
    }
    public function actionViewArticles($id)
    {
        $this->layout='//layouts/articles';
        $id = abs(intval($id));

        if (!$id) {
            throw new CHttpException(404,L::t("This service temporary isn't available."));
        }
        $articles = articles::model()->findByPK($id);
        if($articles->publish==0)
        {
            throw new CHttpException(404,L::t("This service temporary isn't available."));
        }
        $lang=Language::getActive();
        $this->breadcrumbs = array($articles['name_'.$lang]);

        $this->pageTitle = $articles->name;
        $this->meta_description = $articles->meta_description;
        $this->meta_keywords = $articles->meta_keywords;

        $forms = Form::model()->getFormsList();
        shuffle($forms);
        $art = articles::model()->findAll();
        shuffle($art);
        $this->render('articleInfo',['articles'=>$articles,'lang'=>$lang,'forms'=>$forms,'art'=>$art]);
    }

    public function actionViewContent($id)
    {
        $this->layout='//layouts/service';
        $id = abs(intval($id));

        if (!$id) {
            throw new CHttpException(404,L::t("This content temporary isn't available."));
        }

        $model = new Content();
        $content = $model->findByPK($id);

        $this->render('contentView', array('content' => $content, 'id' => $id));
    }
    public function actionAjaxurlclick()
    {
        if(isset($_REQUEST['id']))
        {
            var_dump($_REQUEST);
            $model=baners::model()->findbypk($_REQUEST['id']);

            $model->views = $model->views+1;
            $model->save(false);
            var_dump($model);
        }
    }
    public function actionArea($id)
    {
        $this->layout='//layouts/service';
        $id = abs(intval($id));
         if($this->getM()){
            $this->layout='Mobile';
        }
       // if (!$id) {
            throw new CHttpException(404,L::t("This service temporary isn't available."));
      //  }

        $model = new ServiceCategory();
        $area = Area::model()->findByPK($id);
        $this->pageTitle = $area->name;

        $this->breadcrumbs = array($area->name);
       
        $forms = Form::model()->getFormsList(['region'=>intval($area->id)]);
       

        $this->render('serviceInfo', array('serviceCategories' => $model->findAll('published'),'area' => $area, 'id' => $id, 'forms'=>$forms));
    }
    public function actionajAxreting(){

        $reting=$_GET['reting'];
        $allreting=reting::model()->findAll('ip =?',[$_SERVER["REMOTE_ADDR"]]);
        if(!$allreting)
        {
            $model = new Reting();
            $model->ip =$_SERVER["REMOTE_ADDR"];
            $model->ball=$reting;
            $model->save(false);

        }
        $aRes = array('count' => count(reting::model()->findAll()) ,'ball' => reting::model()->ocenka(), 'width'=>reting::model()->retingWith());
        echo json_encode($aRes);
        exit();

    }
    public function actionSitemaps(){
	
        $this->pageTitle = 'Sitemap';
        $this->meta_description = 'Sitemap';

        $host = Yii::app()->request->hostInfo;
        $host = preg_replace("/w+\./", '', $host);
        $host = str_replace("http://", "", $host);
        $model = Form::model()->getFormsList();
        $this->render('sitemaps',
            array('model' => $model,
                'host' => $host,
            ));
    }

}