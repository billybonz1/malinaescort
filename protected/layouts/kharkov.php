<!doctype html>
<html class="no-js" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=Language::getActive()?>" lang="<?=Language::getActive()?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=Yii::app()->controller->id=='form'&&Yii::app()->controller->action->id=='view'||Yii::app()->controller->action->id=='viewService'||Yii::app()->controller->action->id=='ViewArticles' ? $this->pageTitle : CHtml::encode(C::i('site_title')); ?></title>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="apple-touch-icon" sizes="57x57" href="/images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
    <meta name="msapplication-TileImage" content="/images/ms-icon-144x144.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/style/css/kharkov/normalize.css">
    <link rel="stylesheet" href="/style/css/kharkov/bootstrap.min.css">
    <link rel="stylesheet" href="/style/css/kharkov/star-rating.min.css">
    <link rel="stylesheet" href="/style/css/kharkov/jquery.fancybox.css">
    <link rel="stylesheet" href="/style/css/kharkov/slick.css">
    <link rel="stylesheet" href="/style/css/kharkov/main.css">
    <script type="text/javascript"><?=C::i('google_analytics')?></script>
    <script src="<?=$bu?>/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="<?=$bu?>/js/allJS.php"  type="text/javascript"></script>
    <?php if($_GET['mobile']!='m'&& $_SESSION['m']!='m'):
        $_SESSION['m']='m'?>
        <script type='text/javascript'>
            if(window.innerWidth<767)
                location.href='http://m.kharkovescort.com/';
        </script>
    <?php endif;?>

</head>
<?php
if($_SERVER['REQUEST_URI'] != strtolower($_SERVER['REQUEST_URI'])){
    header('Location: http://'.$_SERVER['HTTP_HOST'].strtolower($_SERVER['REQUEST_URI']), true, 301);
    exit();
}
?>
<body data-language="<?=Language::getActive()?>" data-baseurl="<?=$bu?>" data-city="<?=CCity::getActiveId()?>" data-show="<?=L::t('Show')?>" data-hide="<?=L::t('Hide')?>">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="wrapper">
<header class="header">
<div class="container top-header">
    <?php $this->widget('LanguagePicker');?>
    <?php $this->widget('Login');?>
</div><!--/.top-header-->

<div class="brand-block text-center">
    <a class="brand-link" href="/">kharkovescort.com</a>
</div><!--/.brand-block-->

<?php $this->widget('SearchForm',array('hideSearchBar'=>false));?>
</header><!--/.header-->


<?=$content?>
    <?php if(articles::model()->getArticles()):?>
        <?php $lang=Language::getActive();?>

        <section class="news-wrap container">
            <h2 class="title"><?=L::t('Articles')?></h2>
            <div class="news-body row">
                <?php foreach (articles::model()->getArticles() as $value):?>
                    <article class="col-md-3 col-sm-6 clearfix news-item">
                        <div class="news-img"><a href="<?php echo $value->getLink();?>">  <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/articles/'.$value->image,$value['name_'.$lang]);?></div>
                        <h4><a href="<?php echo $value->getLink();?>"><?php echo $value['name_'.$lang];?></a></h4>
                    </article><!--/.news-item-->
                <?php endforeach;?>
            </div><!--/.news-body-->
        </section><!--/.news-wrap-->
    <?php endif;?>
</div><!--/.wrapper-->

<footer class="footer">
    <div class="footer-top">
        <div class="container">

            <div class="rating-wrap pull-right">
                <form class="rating-block">
                    <input id="siteRating"  type="number" class="rating">
                </form>

                <div class="rating-result">
                    (<span id="rating-count"> <?php echo count(reting::model()->findAll());?></span> оценок, в среднем: <span id="rating-mark"><?php echo round(reting::model()->ocenka());?></span> из 5)
                </div>
            </div><!--/.rating-wrap-->

            <ul class="footer-nav">
                <li class="active"><a href="#!">Форум</a></li>
                <li><a href="#!"><?=L::t('Marketing')?></a></li>
                <li><a class="fancy-popup" href="#contact-popup"><?php $this->widget('Contact'); ?></li>
            </ul><!--/.footer-nav-->
        </div>
    </div><!--/.footer-top-->

    <div class="footer-copyright container text-center">
        <?php echo Content::model()->find('name=?',['text_footer'])->text;?>
    </div><!--/.footer-compyright-->
</footer><!--/.footer-->


<script src="<?=$bu?>/js/vendor/star-rating.min.js"></script>
<script src="<?=$bu?>/js/vendor/jquery.fancybox.js"></script>
<script src="<?=$bu?>/js/vendor/slick.min.js"></script>
<script src="<?=$bu?>/js/main.js"></script>
<script>
    $('.rating-stars').css({width:'<?php echo reting::model()->retingWith()?>'});
</script>
<script>
    $('.rating-stars').click(function(){
        var reting = $('.rating-stars:last').width();
        reting = parseInt(reting);
        var  retingball;
        if(reting >= 80){
            retingball = 5;
        }
        if(reting >= 60 && reting < 80){
            retingball = 4;
        }
        if(reting >=40 && reting < 60){
            retingball = 3;
        }
        if(reting >= 20 && reting < 40){
            retingball = 2;
        }
        if(reting >= 0 && reting < 20){
            retingball = 1;
        }
        $.ajax(
            {
                type: 'GET',
                url: '/site/ajaxreting',
                data: {reting : retingball},
                success:function(data) {
                    var res = JSON.parse(data);
                    $('.rating-stars').css({width: res['width']});
                    $('#rating-count').text(res['count']);
                    $('#rating-mark').text(res['ball']);
                }

            }
        )
    });



</script>
</body>
</html>
