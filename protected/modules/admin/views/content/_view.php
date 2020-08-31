<?php
/* @var $this ContentController */
/* @var $data Content */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_ru')); ?>:</b>
	<?php echo CHtml::encode($data->text_ru); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_en')); ?>:</b>
	<?php echo CHtml::encode($data->text_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_tr')); ?>:</b>
	<?php echo CHtml::encode($data->text_tr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_de')); ?>:</b>
	<?php echo CHtml::encode($data->text_de); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_fr')); ?>:</b>
	<?php echo CHtml::encode($data->text_fr); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('text_it')); ?>:</b>
	<?php echo CHtml::encode($data->text_it); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_pl')); ?>:</b>
	<?php echo CHtml::encode($data->text_pl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text_es')); ?>:</b>
	<?php echo CHtml::encode($data->text_es); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published')); ?>:</b>
	<?php echo CHtml::encode($data->published); ?>
	<br />

	*/ ?>

</div>