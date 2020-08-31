<?php
// echo '<pre>';
// var_dump($_SERVER['HTTP_HOST']);
if(strpos($_SERVER['HTTP_HOST'], 'en.') !== false || strpos($_SERVER['HTTP_HOST'], 'm.en.' !== false) || strpos($_SERVER['REQUEST_URI'], 'en/en')){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://malinaescort.com/en".str_replace('en/en/', '',$_SERVER['REQUEST_URI']));
    exit();
} else if(strpos($_SERVER['HTTP_HOST'], 'tr.') !== false || strpos($_SERVER['HTTP_HOST'], 'm.tr.' !== false) || strpos($_SERVER['REQUEST_URI'], 'tr/tr')){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://malinaescort.com/tr".str_replace('tr/tr/', '',$_SERVER['REQUEST_URI']));
    exit();
} else if(strpos($_SERVER['HTTP_HOST'], 'm.') !== false) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://malinaescort.com".$_SERVER['REQUEST_URI']);
    exit();
} else if(strpos($_SERVER['REQUEST_URI'], '/m/') !== false) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://malinaescort.com/".str_replace('/m/', '', $_SERVER['REQUEST_URI']));
    exit();
}

// var_dump($_SERVER['REQUEST_URI']);
require_once 'protected/components/Mobile_Detect.php';
$detect = new Mobile_Detect;
 
// Any mobile device (phones or tablets).
// if ($detect->isMobile()) {
// 	$http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '') . '://';
// 	$url = $http . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// 	if(stristr($url, $http . 'm.') === FALSE) {
// 		$mobile_url = $http . 'm.' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
// 		header('Location: ' . $mobile_url);
// 	}
// } 

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-1.1.13.e9e4a0/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_ENABLE_EXCEPTION_HANDLER', true);
error_reporting(E_ALL ^ E_NOTICE);
// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',false);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
require_once($yii);
Yii::createWebApplication($config)->run();
