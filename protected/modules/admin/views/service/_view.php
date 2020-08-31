<?php
/* @var $this ServiceController */
/* @var $data Service */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_ru')); ?>:</b>
	<?php echo CHtml::encode($data->name_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_en')); ?>:</b>
	<?php echo CHtml::encode($data->name_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_tr')); ?>:</b>
	<?php echo CHtml::encode($data->name_tr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_de')); ?>:</b>
	<?php echo CHtml::encode($data->name_de); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_fr')); ?>:</b>
	<?php echo CHtml::encode($data->name_fr); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('name_it')); ?>:</b>
	<?php echo CHtml::encode($data->name_it); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_es')); ?>:</b>
	<?php echo CHtml::encode($data->name_es); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published')); ?>:</b>
	<?php echo CHtml::encode($data->published); ?>
	<br />

	*/ ?>

</div>