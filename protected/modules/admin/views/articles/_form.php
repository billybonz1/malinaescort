<?php
/* @var $this ServiceController */
/* @var $model Service */
/* @var $form CActiveForm */
?>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'Articles-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => [
        'enctype' => 'multipart/form-data',
    ],
)); ?>

	<p class="note"><?php echo L::t('required');?></p>

	<?php echo $form->errorSummary($model); ?>


    <div id="languagesList"><?php Language::getHtmlList('a', array('href'=>"#")); ?></div>
    <div class="row">
        <?php echo $form->labelEx($model,"city"); ?>
        <?php echo $form->dropDownList($model,'city',CMap::mergeArray([''=>'Без города'],CHtml::listData(City::model()->findAll(), 'domain_alias', 'name_en'))); ?>
        <?php echo $form->error($model,"city"); ?>
    </div>
    <div class="row">
    <?php echo $form->labelEx($model,"image"); ?>
    <?php echo ($model->image)?CHtml::image(Yii::app()->request->baseUrl.'/images/articles/'.$model->image,'aricles',['style'=>'width: 200px;']):'';?>
    <?//= CHtml::FileField('Baners[image]',$model->image,['value'=>$model->image])?>
    <?= $form->fileField($model,'image'); ?>
    </div>
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
		<?php echo $form->labelEx($model,'publish'); ?>
		<?php echo $form->checkBox($model,'publish'); ?>
		<?php echo $form->error($model,'publish'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,"seo_name"); ?>
        <?php echo $form->textField($model,"seo_name",array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($model,"seo_name"); ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->