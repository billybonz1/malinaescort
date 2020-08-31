<!doctype html>
<html class="no-js" lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?=Yii::app()->controller->id=='form'&&Yii::app()->controller->action->id=='view'||Yii::app()->controller->action->id=='viewService'||Yii::app()->controller->action->id=='ViewArticles' ? $this->pageTitle : CHtml::encode(C::i('site_title')); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/style/css_mobile/normalize.css">
    <link rel="stylesheet" href="/style/css_mobile/jquery.fancybox.css">
    <link rel="stylesheet" href="/style/css_mobile/main.css">
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="<?=$bu?>/js/allJS.php"  type="text/javascript"></script>
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
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137561843-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-137561843-1');
</script>

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="wrapper">
<header class="header">
    <div class="header-toolbar clearfix">
        <div class="header-toolbar__left">
            <button id="openNavButton" class="btn-open-nav">
                <span class="btn-open-nav__sep"></span>
                <span class="btn-open-nav__sep"></span>
                <span class="btn-open-nav__sep"></span>
            </button>
        </div>

        <div class="header-toolbar__right">
            <button id="openFilter" class="serach-filter-btn"></button>
        </div>

        <div class="header-toolbar__center">
            <?php $this->widget('LanguagePicker');?>
        </div>
    </div>
    <div class="logo-container">
        <a class="logo" href="/">
            <img src="/images/img_mobile/logo.png"  alt="Логотип">
        </a>
    </div>
</header><!--/.header-->

<div class="hidden">
    <nav id="leftNavMenu" class="nav-categories">
        <h2 class="nav-categories__header"><span><?=L::t('CATEGORIES')?></span></h2>
        <ul class="left-menu">
        <?php foreach(ServiceCategory::model()->findAll('published=1') as $key => $c)
        {
            echo '<li class=""><h4 class="left-menu__link">';
            echo CHtml::tag('a',
                array('class'=>'collapsed',
                    'data-toggle'=>'collapse',
                    'aria-expanded'=>'false',
                    'href'=>'service'.$key
                ),
                $c->name.'<span class="icon-arrow"></span>'
            );
            echo '</h4>';
            echo '<ul class="inner-nav" data-id="'.'service'.$key.'" style="display: none;" >';
            foreach($c->services as $s)
            {
                if($s->id == $id){ $class='active';} else {$class='';};
                echo "<li class='$class'>".CHtml::link($s->name, $s->getLink()) . "</li>";
            }
            echo '</ul></li>';
        } ?>
        
        </ul>
    </nav><!--/.nav-->
</div>

<?php $this->widget('SearchForm',array('hideSearchBar'=>false)); ?>

<?php echo $content;?>
<footer class="footer">
    <p class="footer__paragraph">
        <?php unset( $_SESSION['m']);$sn=$_SERVER['SERVER_NAME']; $path=parse_url($_SERVER['REQUEST_URI'])['path'];$prefix=$lang!='ru'?$lang.'.':'';?>
        <a href="http://<?php echo substr($sn,2);?>?mobile=m" class="link"><?php echo L::t('Full Site')?></a>
        <span class="copy">&copy; 2011-2019 MalinaEscort.com </span>
    </p>
</footer><!--/.footer-->
</div><!--/.wrapper-->



<div class="hidden">
    <!--==========================================================
                            Тут всі попапи
    =============================================================-->
    <div id="contact-popup" class="popup popup-xl">
        <form class="form">
            <h2 class="popup-title">Контакты</h2>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputName">Ваш  имя</label>
                        <input type="text" class="form-control" id="exampleInputName">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ваш E-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1">
                    </div>

                    <div class="form-group capcha">
                        <div class="img-captcha">
                            <img id="yw1" src="/images/img_mobile/capcha.png" alt="картинка капчі">
                            <a id="yw1_button" href="#!">Получить новый код</a>
                        </div>
                        <label for="ContactForm_verifyCode">Введите код</label>
                        <input class="form-control" name="ContactForm[verifyCode]" id="ContactForm_verifyCode" type="text">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="exampleInputTheme">Тема</label>
                        <input type="text" class="form-control" id="exampleInputTheme">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputMessage">Текст сообщения</label>
                        <textarea name="exampleInputMessage" id="exampleInputMessage" rows="6" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-xs-12 text-center">
                    <button class="btn btn-search" type="submit">Отправить</button>
                </div>
            </div>
        </form>
    </div><!--/#contact-popup-->

    <div id="enter-popup" class="popup popup-l">
        <form class="form">
            <h2 class="popup-title">вход для девушек</h2>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail2">E-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail2">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Пароль</label>
                        <a class="link pull-right" href="#!">Забыли пароль?</a>
                        <input type="password" class="form-control" id="exampleInputPassword">
                        <a class="link fancy-popup pull-right" href="#reg-popup">Регистрация</a>
                    </div>
                </div>

                <div class="col-xs-12 mt_15 text-center">
                    <button class="btn btn-search" type="submit">Отправить</button>
                </div>
            </div>
        </form>
    </div><!--/#enter-popup-->

    <div id="reg-popup" class="popup popup-l">
        <form class="form">
            <h2 class="popup-title">Регистрация</h2>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputEmail3">E-mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail3">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName2">Настоящее имя</label>
                        <input type="text" class="form-control" id="exampleInputName2">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword2">Пароль</label>
                        <input type="password" class="form-control" id="exampleInputPassword2">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword3">Подтверждение пароля</label>
                        <input type="password" class="form-control" id="exampleInputPassword3">
                    </div>

                    <div class="form-group capcha">
                        <div class="img-captcha">
                            <img id="yw2" src="/images/img_mobile/capcha.png" alt="картинка капчі">
                            <a id="yw2_button" href="#!">Получить новый код</a>
                        </div>
                        <label for="ContactForm_verifyCode">Введите код</label>
                        <input class="form-control" name="ContactForm[verifyCode]" id="ContactForm_verifyCode2" type="text">
                    </div>
                </div>

                <div class="col-xs-12 mt_5 text-center">
                    <button class="btn btn-search" type="submit">Отправить</button>
                </div>
            </div>
        </form>
    </div><!--/#enter-popup-->

</div><!--end hidden block-->
<script src="/js/js_mobile/vendor/slick.min.js"></script>
<script src="/js/js_mobile/vendor/jquery.fancybox.js"></script>
<script src="/js/js_mobile/vendor/jquery.jpanelmenu.min.js"></script>
<script src="/js/js_mobile/main.js"></script>
</body>
</html>
