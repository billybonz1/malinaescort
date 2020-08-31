<?php
/* @var $this MetroController */
/* @var $model Metro */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'metro-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo L::t('required');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
        <?php echo CHtml::dropDownList('Metro[city_id]',0,ModelHelper::getArray(City::model()))?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>

    <div id="languagesList"><?php Language::getHtmlList('a', array('href'=>"#")); ?></div>

    <?php foreach(Language::getList() as $lang): ?>
    <div class="forms_edit" id="form_<?=$lang?>">
        <div class="row">
            <?php echo $form->labelEx($model,"name_{$lang}"); ?>
            <?php echo $form->textField($model,"name_{$lang}",array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,"name_{$lang}"); ?>
        </div>
    </div>
    <?php endforeach; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->