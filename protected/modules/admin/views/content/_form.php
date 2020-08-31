<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
));

    echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    <div class="row">
		<?php echo $form->labelEx($model,'city_id'); ?>
		<?php echo $form->dropDownList($model,'city_id',City::model()->getList()); ?>
		<?php echo $form->error($model,'city_id'); ?>
	</div>
    <div id="languagesList"><?php Language::getHtmlList('a', array('href'=>"#")); ?></div>

    <?php foreach(Language::getList() as $lang): ?>
        <div class="forms_edit" id="form_<?=$lang?>">
            <div class="row">
                <?php $this->widget('CKEditorWidget', array(
                        'model' => $model,
                        'attribute' => "text_{$lang}",

                        'config' => array(
                            'toolbarSet'=>'Basic',
                            'toolbar'=>
                                array('Source', 'Bold',  'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','Image','Flash', '-', 'About'),
                            'language' => 'ru',
                        ),
                    ));?>

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