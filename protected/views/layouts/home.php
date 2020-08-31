<?php $this->beginContent('//layouts/kharkov');?>
<?php

        echo $content;?>
<?php $model = baners::model()->getBuners(3); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="container baner-full-width container-l" ><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive" src="<?=$url;?>"></a></div>
    <?php endif; endforeach;?>
<?php  $this->endContent();