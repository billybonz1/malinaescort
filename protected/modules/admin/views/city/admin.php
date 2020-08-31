<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create City', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('city-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'city-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'domain_alias',
		'name_ru',
        array(
            'name'=>'use_for_search',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->use_for_search?"g":"x").".png")',
            'type'=>'raw',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
));