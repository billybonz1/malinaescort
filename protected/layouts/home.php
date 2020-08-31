<?php $this->beginContent('//layouts/kharkov');?>
<?php $model = baners::model()->getBuners(1); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div class="container" style="
    width: 980px;
    height: 200px;
    /* margin: 10px; */
    text-align: center;
    margin-bottom: 20px;
"><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img src="<?=$url;?>"></a></div>
    <?php endif; endforeach;?>
<?php

        echo $content;?>
<?php $model = baners::model()->getBuners(3); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="container baner-full-width container-l" ><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive" src="<?=$url;?>"></a></div>
    <?php endif; endforeach;?>
<?php  $this->endContent();