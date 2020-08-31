<?php
/* @var $this ServiceCategoryController */
/* @var $model ServiceCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo L::t('required');?></p>

	<?php echo $form->errorSummary($model); ?>

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

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->checkBox($model,'published'); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->