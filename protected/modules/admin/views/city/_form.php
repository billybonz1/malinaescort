<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'city-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo L::t('required');?></p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,"domain_alias"); ?>
        <?php echo $form->textField($model,"domain_alias"); ?>
        <?php echo $form->error($model,"domain_alias"); ?>
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

    <div class="row">
        <?php echo $form->labelEx($model,"use_for_search"); ?>
        <?php echo $form->checkBox($model,"use_for_search"); ?>
        <?php echo $form->error($model,"use_for_search"); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? L::t('Create') : L::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->