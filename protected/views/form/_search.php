<?php
/* @var $this FormController */
/* @var $model Form */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'city_id'); ?>
		<?php echo $form->textField($model,'city_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'area_id'); ?>
		<?php echo $form->textField($model,'area_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'metro_id'); ?>
		<?php echo $form->textField($model,'metro_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_ru'); ?>
		<?php echo $form->textField($model,'name_ru',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_en'); ?>
		<?php echo $form->textField($model,'name_en',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_tr'); ?>
		<?php echo $form->textField($model,'name_tr',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_de'); ?>
		<?php echo $form->textField($model,'name_de',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_fr'); ?>
		<?php echo $form->textField($model,'name_fr',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_it'); ?>
		<?php echo $form->textField($model,'name_it',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name_es'); ?>
		<?php echo $form->textField($model,'name_es',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about_ru'); ?>
		<?php echo $form->textArea($model,'about_ru',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about_en'); ?>
		<?php echo $form->textArea($model,'about_en',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about_tr'); ?>
		<?php echo $form->textArea($model,'about_tr',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about_de'); ?>
		<?php echo $form->textArea($model,'about_de',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about_fr'); ?>
		<?php echo $form->textArea($model,'about_fr',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about_it'); ?>
		<?php echo $form->textArea($model,'about_it',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'about_es'); ?>
		<?php echo $form->textArea($model,'about_es',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'age'); ?>
		<?php echo $form->textField($model,'age'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'breast'); ?>
		<?php echo $form->textField($model,'breast'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rise'); ?>
		<?php echo $form->textField($model,'rise'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cell_phone'); ?>
		<?php echo $form->textField($model,'cell_phone',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_hour'); ?>
		<?php echo $form->textField($model,'price_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_two_hour'); ?>
		<?php echo $form->textField($model,'price_two_hour'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_night'); ?>
		<?php echo $form->textField($model,'price_night'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_per_hour_exit'); ?>
		<?php echo $form->textField($model,'price_per_hour_exit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_two_hour_exit'); ?>
		<?php echo $form->textField($model,'price_two_hour_exit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_night_exit'); ?>
		<?php echo $form->textField($model,'price_night_exit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_anal_exit'); ?>
		<?php echo $form->textField($model,'price_anal_exit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mood_prices'); ?>
		<?php echo $form->textField($model,'mood_prices'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_photoshop'); ?>
		<?php echo $form->textField($model,'no_photoshop'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_photoshop_approved'); ?>
		<?php echo $form->textField($model,'no_photoshop_approved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'real_photo'); ?>
		<?php echo $form->textField($model,'real_photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'best_girl'); ?>
		<?php echo $form->textField($model,'best_girl'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evidence_photo'); ?>
		<?php echo $form->textField($model,'evidence_photo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'added'); ?>
		<?php echo $form->textField($model,'added'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hits'); ?>
		<?php echo $form->textField($model,'hits'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hits_today'); ?>
		<?php echo $form->textField($model,'hits_today'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_hit'); ?>
		<?php echo $form->textField($model,'last_hit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'published'); ?>
		<?php echo $form->textField($model,'published'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'decline_reson'); ?>
		<?php echo $form->textArea($model,'decline_reson',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->