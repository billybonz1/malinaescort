<?php
/* @var $this MessageController */
/* @var $data Message */
?>

<div class="view">
    <div class="row">
        <div class="col first"><?=CHtml::link($data->title,array('/message/view','id'=>$data->id)); ?></div>
        <div class="col second"><?=CHtml::encode($data->added); ?></div>
        <div class="col third">
            <?php echo UserModule::isAdmin()?CHtml::link($data->fromUser['profile']['fullname'],array('/user/admin/view','id'=>$data->sender),array('target'=>'_blank')) : $data->fromUser['profile']['fullname']; ?>
            &nbsp;
        </div>
        <div class="col fourth"><?=L::t($data->isopened?L::t('Opened'):L::t('Not opened'));?></div>
    </div>
</div>