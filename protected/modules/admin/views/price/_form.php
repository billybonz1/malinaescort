<?php
/* @var $this PriceController */
/* @var $model Price */
/* @var $form CActiveForm */
?>
<div class="center-align-box">
	<div class="form">
	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'price-form',
		'enableAjaxValidation'=>false,
	)); ?>
	
		<p class="note"><?php echo L::t('required');?></p>
	
		<?php echo $form->errorSummary($model); ?>
	
		<div class="row">
			<?php echo $form->labelEx($model,'days'); ?>
			<?php echo $form->textField($model,'days'); ?>
			<?php echo $form->error($model,'days'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'price'); ?>
			<?php echo $form->textField($model,'price'); ?>
			<?php echo $form->error($model,'price'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'price_vip'); ?>
			<?php echo $form->textField($model,'price_vip'); ?>
			<?php echo $form->error($model,'price_vip'); ?>
		</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'published'); ?>
			<?php echo $form->checkBox($model,'published'); ?>
			<?php echo $form->error($model,'published'); ?>
		</div>
	
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? L::t('Create') : L::t('Save')); ?>
		</div>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->
</div>