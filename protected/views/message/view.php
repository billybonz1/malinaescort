<?php
$this->menu=array(
    array('label'=>'Исходящие', 'url'=>array('/message/admin','box'=>'outbox')),
    array('label'=>'Входящие', 'url'=>array('/message/admin','box'=>'inbox')),
);
?>
<div class="center-align-box">
    <div class="new-message-box box-bg">
        <div class="form-box">
            <h4><?=isset($model->fromUser)?L::t('View message from:').' '.$model->fromUser->profile['fullname']:'';?></h4>
            <div class="row">
                <label><?=$model->title;?></label>
            </div>
            <div class="row">
                <label><?=str_replace(array("\r\n", "\n", "\r"),"<br/>",$model->massage);?></label>
            </div>
            <?php
                if($model->sender!=U::id())
                    echo CHtml::link(L::t('Reply'),array('/message/create','to'=>$model->sender),array('class'=>'btn'));
            ?>
            <div class="relax">&nbsp;</div>
        </div>
    </div>
</div>