<?php
/* @var $this MetroController */
/* @var $model Metro */

$this->breadcrumbs=array(
	'Metros'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Metro', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('metro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'metro-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'city.name_'.Language::getActive(),
		'name_ru',
		'name_en',
		'name_tr',
		'name_de',
		/*
		'name_fr',
		'name_it',
		'name_es',
		'last_hit',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
