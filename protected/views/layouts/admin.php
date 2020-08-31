<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<!-- blueprint CSS framework -->
    <?php $bu=Yii::app()->request->baseUrl ?>
	<link rel="stylesheet" type="text/css" href="<?=$bu?>/style/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=$bu; ?>/style/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?=$bu; ?>/style/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?=$bu?>/style/css/admin.css" />
	<link rel="stylesheet" type="text/css" href="<?=$bu?>/style/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?=$bu?>/style/css/imgareaselect-animated.css" />

    <script src="<?=$bu?>/js/jquery.1.8.js" type="text/javascript"></script>
    <?php
        Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );
        Yii::app()->clientScript->registerCoreScript('maskedinput');
    ?>

    <title><?=CHtml::encode(C::i('site_title') )?></title>
    <script src="<?=$bu?>/js/AdminCard.js" type="text/javascript"></script>
    <script src="<?=$bu?>/js/jcarousel.js" type="text/javascript"></script>
    <script src="<?=$bu?>/js/ConfirmMessage.js" type="text/javascript"></script>
    <script src="<?=$bu?>/js/Image.js" type="text/javascript"></script>
    <script src="<?=$bu?>/js/PaymentCard.js" type="text/javascript"></script>
    <script src="<?=$bu?>/js/app.js" type="text/javascript"></script>
    <script src="<?=$bu?>/js/jquery.imgareaselect.min.js" type="text/javascript"></script>

</head>

<body data-language="<?=Language::getActive()?>">

<div class="container page" id="page">

	<div id="header" class="header">
		<div id="logo"></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
        $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Главная страница', 'url'=>array('/admin')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			),
		));
        echo CHtml::openTag('div',array('id'=>'homePageUrl'))
        . CHtml::link('На сайт',Yii::app()->homeUrl)
        . CHtml::link('Выход',array('/site/logout'))
        . CHtml::closeTag('div'); ?>
	</div><!-- mainmenu -->

	<?=$content?>

	<div class="clear"></div>

	<div id="footer">
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
