<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=Language::getActive()?>" lang="<?=Language::getActive()?>">
<head>
    <title><?=Yii::app()->controller->id=='form'&&Yii::app()->controller->action->id=='view' ? $this->pageTitle : CHtml::encode(C::i('site_title')); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if (substr_count($_SERVER['REQUEST_URI'],'?')!=0):?>
        <meta name="robots" content="noindex, follow">
        <link rel="canonical" href="<?=Yii::app()->request->hostInfo.'/'.Yii::app()->getRequest()->getPathInfo()?>"/>
    <?php endif?>
    <?=Location::isHP()?CHtml::tag('meta',array('name'=>'description','content'=>C::i('meta_description'))):''?>

    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?=($bu=Yii::app()->request->baseUrl)?>/style/css/ie-jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?=$bu?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?=$bu?>/style/css/allCSS.php" />
    <script src="<?=$bu?>/js/allJS.php"  type="text/javascript"></script>
    <!-- Google abalytics -->
    <script type="text/javascript"><?=C::i('google_analytics')?></script>
</head>

<body data-language="<?=Language::getActive()?>" data-baseurl="<?=$bu?>" data-city="<?=CCity::getActiveId()?>" data-show="<?=L::t('Show')?>" data-hide="<?=L::t('Hide')?>">
<div id="container">
    <!--Page -->
    <div id="page" class="page">
        <!--Header -->
        <div id="header" class="header">
            <?php
            $this->widget('LanguagePicker');
            $this->widget('Login');
            ?>
            <div class="relax">&nbsp;</div>
            <?=CHtml::link(CHtml::image($bu.'/style/images/logo_new.png','logo',array('title'=>'natashaescort')),$bu.'/',array('class'=>'logo'));?>
        </div>
        <!--Content -->
        <div id="content" class="content">
            <?=$content?>
        </div>
        <!--Footer -->
        <div id="footer">
            <div class="error-left-col">
                <ul>
                    <li><a href="#"><?=L::t('Marketing')?></a></li>
                    <li><?php $this->widget('Contact'); ?></li>
                </ul>
            </div>
            <div class="error-right-col">
                <span>Администрация сайта, исключительно,</span>
                <span>предоставляет площадку для размещения рекламы</span>
                <span>и ответственности за ее содержимое не несет</span>
            </div>
        </div>
    </div>
</div>
<div class="overlay">&nbsp;</div>
</body>
</html>
