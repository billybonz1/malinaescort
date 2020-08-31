<?php
/* @var $this CommentController */
/* @var $model Comment */

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comment', 'url'=>array('index')),
	array('label'=>'Create Comment', 'url'=>array('create')),
	array('label'=>'View Comment', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Comment', 'url'=>array('admin')),
);
?>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'card-form',
    'enableAjaxValidation'=>false,
)); ?>
<div class="row">
    Comment: #<?=$model->id?>
</div>
<div class="row">
    <?php echo $form->labelEx($model,'text'); ?><br/>
    <?php echo $form->textArea($model,'text'); ?>
    <?php echo $form->error($model,'text'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'status'); ?>
    <?php echo $form->checkbox($model,'status'); ?>
    <?php echo $form->error($model,'status'); ?>
</div>

<div class="row">
    <?php echo CHtml::submitButton('Save'); ?>
</div>
<?php $this->endWidget(); ?>