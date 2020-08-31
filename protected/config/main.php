<?php
Yii::setPathOfAlias('evidence','images/evidence');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Natasha escort',
    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.widgets.*',
        'application.components.*',
        'ext.yii-ckeditor-master.CKEditorWidget',
        'application.modules.user.UserModule',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.components.CImageHandler',
    ),


    'modules'=>array(
        // uncomment the following to enable the Gii tool
//        'gii'=>array(
//            'class'=>'system.gii.GiiModule',
//            'password'=>'Ser1alize',
//            // If removed, Gii defaults to localhost only. Edit carefully to taste.
//          //  'ipFilters'=>array('*','::1'),
//        ),
        'user'=>array(
            'hash' => 'md5',
            'sendActivationMail' => false,
            'loginNotActiv' => false,
            'activeAfterRegister' => true,
            'autoLogin' => true,
            'registrationUrl' => array('/user/registration'),
            'recoveryUrl' => array('/user/recovery'),
            'loginUrl' => array('/site/index','action'=>'login'),
            'returnUrl' => array('/user/profile'),
            'returnLogoutUrl' => array('/user/login'),
        ),
        'admin',
    ),

    // application components
    'components'=>array(
        'ih'=>array(
            'class'=>'CImageHandler',
        ),
        'clientScript'=>array(
            'class' => 'CClientScript',
            'scriptMap' => array(
                'jquery.js'=>false,
            ),
            'coreScriptPosition' => CClientScript::POS_END,
        ),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
        'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/site/index','action'=>'login'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                'edit/<id:\d+>'=>'form/update',
                'robots.txt' => 'site/robots',
				'sitemap.xml' => 'site/sitemap',
                'sitemap' => 'site/sitemaps',
                'generator'=>'gii',
                'administrator'=>'admin',
                'admin/payments'=>'paymentRequest/admin',
                'prices'=>'admin/price',
                'messages'=>'message',
				'area/<id:\d+>'=>'site/area',
                '<id:\d+>/<name:\w+>/<phone:\d+>'=>'form/view',
                '<title:\w+>-<id:\d+>'=>'site/viewService',
                'article/<title:\w+>-<id:\d+>'=>'site/ViewArticles',
               'profile'=>'form/my/',
                'profile/days/<days:\d+>'=>'form/my/',
                'logout'=>'user/logout',
                'activate'=>'/user/activation/activation',
                'pay'=>'PaymentRequest/create',
//                '/<lang:\w+>/'=>'site/index',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/delete?id=<id:\d+>'=>'<controller>/delete',
                'admin/<controller:\w+>s'=>'admin/<controller>/admin',
                'admin/<controller:\w+>'=>'<controller>/admin',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',

                //'<service:\w+>'=>'site/index',
                '<language:\w+>/form/AjaxLoad'=>'form/ajaxLoad',
                '<language:\w+>/form/ajaxSearch'=>'form/ajaxSearch',
                '<language:\w+>/edit/<id:\d+>'=>'form/update',
                '<language:\w+>/robots.txt' => 'site/robots',
                '<language:\w+>/sitemap.xml' => 'site/sitemap',
                '<language:\w+>/sitemap' => 'site/sitemaps',
                '<language:\w+>/generator'=>'gii',
                '<language:\w+>/administrator'=>'admin',
                '<language:\w+>/admin/payments'=>'paymentRequest/admin',
                '<language:\w+>/prices'=>'admin/price',
                '<language:\w+>/messages'=>'message',
                '<language:\w+>/area/<id:\d+>'=>'site/area',
                '<language:\w+>/<id:\d+>/<name:\w+>/<phone:\d+>'=>'form/view',
                '<language:\w+>/<title:\w+>-<id:\d+>'=>'site/viewService',
                '<language:\w+>/article/<title:\w+>-<id:\d+>'=>'site/ViewArticles',
               '<language:\w+>/profile'=>'form/my/',
                '<language:\w+>/profile/days/<days:\d+>'=>'form/my/',
                '<language:\w+>/logout'=>'user/logout',
                '<language:\w+>/activate'=>'/user/activation/activation',
                '<language:\w+>/pay'=>'PaymentRequest/create',
//                '/<lang:\w+>/'=>'site/index',
                '<language:\w+>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<language:\w+>/<controller:\w+>/delete?id=<id:\d+>'=>'<controller>/delete',
                '<language:\w+>/admin/<controller:\w+>s'=>'admin/<controller>/admin',
                '<language:\w+>/admin/<controller:\w+>'=>'<controller>/admin',
                '<language:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',

            ), 
        ),
        // Local congfig
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=sexlviv',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),

//        'log'=>array(
//            'class'=>'CLogRouter',
//            'routes'=>array(
//                array(
//                    'class'=>'CFileLogRoute',
//                    'levels'=>'trace,log',
//                    'categories' => 'system.db.CDbCommand',
//                    'logFile' => 'db.log',
//                ),
//            ),
//        ),
//     'log'=>array(
//            'class'=>'CLogRouter',
//            'routes'=>array(
//               array(
//                  'class'=>'CEmailLogRoute',
//                   'levels'=>'error',
//                    'emails'=>array('alexey.a.nekrasov@gmail.com'),
//                ),
//                array(
//                    'class'=>'CWebLogRoute',
//                    'showInFireBug'=>true
//                ),
//            ),
//        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        'onRegisterEmail'=>'natashaescort.com@gmail.com,natasha.escort@ya.ru',
        'adminEmail'=>'info@natashaescort.com',
        'developerEmail'=>'code.craft.labs@gmail.com',
        'webRoot' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'hairs'=>array(0=>"Doesn't mater",1=>'Black',2=>'Brunette',3=>'Redhead',4=>'Blond',5=>'Blonde'),
    ),
);

if($_SERVER['REMOTE_ADDR'] != "127.0.0.1")
    $config['components']['db']=require 'prodConfig.php';

return $config;
