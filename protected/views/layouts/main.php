<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=Language::getActive()?>" lang="<?=Language::getActive()?>">
<head>
 
	<title><?=Yii::app()->controller->id=='form'&&Yii::app()->controller->action->id=='view'||Yii::app()->controller->action->id=='viewService'||Yii::app()->controller->action->id=='ViewArticles' ? $this->pageTitle : CHtml::encode(C::i('site_title')); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php if (substr_count($_SERVER['REQUEST_URI'],'?')!=0):?>
            <meta name="robots" content="noindex, follow">
            <link rel="canonical" href="<?=Yii::app()->request->hostInfo.'/'.Yii::app()->getRequest()->getPathInfo()?>"/>
   <?php endif?>
    <?=Location::isHP()?CHtml::tag('meta',array('name'=>'description','content'=>C::i('meta_description'))):''?>
    <?php
    if(Location::isSP())
    {
        echo CHtml::tag('meta',array('name'=>'description','content'=>$this->meta_description));
        echo CHtml::tag('meta',array('name'=>'keywords','content'=>$this->meta_keywords));
    }
    ?>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?=($bu=Yii::app()->request->baseUrl)?>/style/css/ie-jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="<?=$bu?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?=$bu?>/style/css/all.css" />
    <script src="<?=$bu?>/js/jquery.js"  type="text/javascript"></script>
    <script src="<?=$bu?>/js/all.js"  type="text/javascript"></script>
    <!-- Google abalytics -->
    <?=C::i('google_analytics')?>
	
</head>
<?php
if($_SERVER['REQUEST_URI'] != strtolower($_SERVER['REQUEST_URI'])){
    header('Location: http://'.$_SERVER['HTTP_HOST'].strtolower($_SERVER['REQUEST_URI']), true, 301);
    exit();
}
?>
<body data-language="<?=Language::getActive()?>" data-baseurl="<?=$bu?>" data-city="<?=CCity::getActiveId()?>" data-show="<?=L::t('Show')?>" data-hide="<?=L::t('Hide')?>">
<?php //echo (Yii::app()->controller->action->id=='view')? baners::model()->getBaner('4'):baners::model()->getBaner('2');?>
    <div id="container" class="container">
        <!--Page -->
        <div id="page" class="page ui-helper-clearfix">
        <!--Header -->
            <div id="header" class="header">
                <div class="ui-helper-clearfix">
                  <?php
                    $this->widget('LanguagePicker');
                    $this->widget('Login');
                    ?>  
                </div>
                <div class="logo-wrap">
                    <?=CHtml::link(CHtml::image($bu.'/style/images/logo_new.png','logo',array('title'=>'natashaescort')),$bu.'/',array('class'=>'logo'));?>
                </div>
            </div>
            <!--Content -->
           <div id="content" class="content">
                <?=$content?>
            </div>
            <!--Footer -->
            <div id="footer">
                <!-- <div class="citiesList">
                    <?php $this->widget('Cities'); ?>
                </div> -->
                
                <div class="left-col mt_35">

                    <div class="foot-text">

                    </div>
                    <div class="copy">
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="overlay">&nbsp;</div>
</body>
</html>
