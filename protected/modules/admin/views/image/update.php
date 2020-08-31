<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Управление изображениями', 'url'=>array('admin')),
);

echo $this->renderPartial('_form', array('model'=>$model));