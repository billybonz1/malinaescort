<?php
?>
<div class="main container sitemaps">
<a href="/"><h1><?=$host?></h1></a>
    <div class="row">
    <?php if($model!=''):?>

        <ul>
        <?php foreach ($model as $values):?>
            <?php  $url=$values->generateURL();?>
            <div class="col-md-4"> <li><a href="<?=$url;?>"><?=$values->name?></a></li></div>
        <?php endforeach;?>
    <?php endif?>
    </div>
    <div class="row">
        <h3><?=L::t('Services')?></h3>
        <?php $service= Service::model()->getServiceAll();?>
        <ul>
        <?php foreach ($service as $serv):
            $url=$serv->getLink();?>
            <div class="col-md-4"> <li><a href="<?=$url;?>"><?=$serv->name?></a></li></div>
        <?php endforeach?>
        </ul>
    </div>
    <div class="row">
        <h3><?=L::t('Articles')?></h3>
        <?php $articles= articles::model()->findAll();  $lang=Language::getActive();?>
        <ul>
            <?php foreach ($articles as $articl):
                $url=$articl->getLink();?>
                <div class="col-md-4"> <li><a href="<?=$url;?>"><?=$articl['name_'.$lang]?></a></li></div>
            <?php endforeach?>
        </ul>
    </div>
</div>

