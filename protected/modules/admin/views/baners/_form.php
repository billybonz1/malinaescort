<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => [
        'enctype' => 'multipart/form-data',
    ],
));

    echo $form->errorSummary($model); ?>


	<div class="row">
        <?php echo ($model->image)?CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image,'baner',['style'=>'width: 200px;']):'';?>
        <?//= CHtml::FileField('Baners[image]',$model->image,['value'=>$model->image])?>
        <?= $form->fileField($model,'image'); ?>
<!--		--><?php //echo $form->labelEx($model,'image'); ?>
<!--		--><?php //echo $form->textField($model,'image',array('size'=>45,'maxlength'=>45)); ?>
<!--		--><?php //echo $form->error($model,'image'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'hreff'); ?>
        <?php echo $form->textField($model,'hreff',array('size'=>45)); ?>
        <?php echo $form->error($model,'hreff'); ?>
    </div>
    <div class="row">
		<?php echo $form->labelEx($model,'domen'); ?>
		<?php echo $form->dropDownList($model,'domen',Baners::model()->GetDomensList()); ?>
		<?php echo $form->error($model,'domen'); ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,"city"); ?>
        <?php echo $form->dropDownList($model,'city',CMap::mergeArray([''=>'Без города'],CHtml::listData(City::model()->findAll(), 'domain_alias', 'name_en'))); ?>
        <?php echo $form->error($model,"city"); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'position'); ?>
        <?php echo $form->dropDownList($model,'position',array('1'=>'сверху','2'=>'справа','3'=>'снизу','4'=>'сверху на странице услуг','5'=>'снизу на странице услуг','6'=>'справа на странице услуг','7'=>'сверху на странице статьей','8' => 'снизу на странице статьей', '9' => 'снизу под логотипом на главной', '10' => 'перед кнопкой Загрузить ещё', '11' => 'на странице анкеты вверху над логотипом', '12' => 'на странице анкеты внизу под логотипом', '13' => 'под списком категорий', '14' => 'перед кнопкой написать девушке (мобильная)')) ?>
        <?php echo $form->error($model,'position'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'hiden'); ?>
		<?php echo $form->checkBox($model,'hiden'); ?>
		<?php echo $form->error($model,'hiden'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->