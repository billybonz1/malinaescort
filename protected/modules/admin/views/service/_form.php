<?php
/* @var $this ServiceController */
/* @var $model Service */
/* @var $form CActiveForm */
?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note"><?php echo L::t('required');?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
        <?php echo CHtml::dropDownList('Service[category_id]',0,ModelHelper::getArray(ServiceCategory::model()))?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

    <div id="languagesList"><?php Language::getHtmlList('a', array('href'=>"#")); ?></div>

    <?php foreach(Language::getList() as $lang): ?>
    <div class="forms_edit" id="form_<?=$lang?>">
        <div class="row">
            <?php echo $form->labelEx($model,"name_{$lang}"); ?>
            <?php echo $form->textField($model,"name_{$lang}",array('size'=>60,'maxlength'=>100)); ?>
            <?php echo $form->error($model,"name_{$lang}"); ?>
        </div>


		<div class="row">
        <?php $this->widget('CKEditorWidget', array(
            'model' => $model,
            'attribute' => "description_{$lang}",
            'config' => array(
                'toolbar'=>
                    array('Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','Image','Flash', '-', 'About'),
                'language' => 'ru',
            ),
        ));?>
<!--			--><?php //echo $form->labelEx($model,"description_{$lang}"); ?>
<!--			--><?php //echo $form->textArea($model,"description_{$lang}"); ?>
<!--			--><?php //echo $form->error($model,"description_{$lang}"); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,"meta_description_{$lang}"); ?>
			<?php echo $form->textArea($model,"meta_description_{$lang}"); ?>
			<?php echo $form->error($model,"meta_description_{$lang}"); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,"meta_keywords_{$lang}"); ?>
			<?php echo $form->textArea($model,"meta_keywords_{$lang}"); ?>
			<?php echo $form->error($model,"meta_keywords_{$lang}"); ?>
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