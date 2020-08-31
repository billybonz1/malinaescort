<?php
/* @var $this ServiceCategoryController */
/* @var $model ServiceCategory */

$this->breadcrumbs=array(
	'Service Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create ServiceCategory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('service-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'service-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name_'.Language::getActive(),
        array(
            'name'=>'published',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->published?"g":"x").".png")',
            'type'=>'raw',
        ),
		/*
		'name_it',
		'name_es',
		'published',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
