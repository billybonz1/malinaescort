<?php if(isset($vipforms)):?>
<div class="viplist js-viplist-horizontal clearfix">
<?php    shuffle($vipforms);
    foreach($vipforms as $form):
        if(!($img=$form->getRandomPhotoForHomePage('216x300'))) continue; ?>
        <div class="viplist-item">
            <div class="photo">
                <?=CHtml::link(CHtml::image(ThumbnailHelper::getThumb(Yii::getPathOfAlias('webroot') .$img, [
                                'width' => 800,
                                'height' => 600,
                            ]),$form->name_en,array('title'=>$form->name_en)),str_replace('tr/tr','tr',str_replace('en/en','en',$form->generateURL())));?>
                <?//=CHtml::link(CHtml::image($img,$form->name_en,array('title'=>$form->name_en)),$form->generateURL());?>
            </div>
        </div><!--/.viplist-item-->
    <?php endforeach; ?>
</div><!--/.viplist-->
<?php endif;?>