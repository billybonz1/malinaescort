<?php
/* @var $this FormController */
/* @var $data Form */
?>

<div class="view">

    <b><?php echo L::t( 'Name');?>: </b>
    <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id)); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
	<?php echo CHtml::encode($data->city->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_id')); ?>:</b>
	<?php echo CHtml::encode($data->area->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('metro_id')); ?>:</b>
	<?php echo CHtml::encode($data->metro->name); ?>
	<br />

    <?php if($data->daysLeft()):?>
    <b><?php echo L::t( 'Active till'); ?>:</b>
    <?php echo $data->payed_till; ?>
    <?php if(strtotime($data->payed_till_vip)): ?>
        <br />
        <b><?php echo L::t( 'VIP active till'); ?>:</b>
        <?php echo $data->payed_till_vip; ?>
        <?php endif;?>
    <?php else:?>
        <b><?php echo L::t( 'Not active');?></b>
    <?php endif; ?>
    <br />
    <?php echo CHtml::link(L::t('Pay'), array('/payment/create','id'=>$data->id))?>

</div>