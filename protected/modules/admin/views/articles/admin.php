<?php
/* @var $this ServiceController */
/* @var $model Service */

$this->breadcrumbs=array(
	'articles'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create articles', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('articles-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$this->widget('GridView', array(
	'id'=>'articles-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'showPublishBtn'=>true,
    'showPublishOffBtn'=>true,
	'columns'=>array(
		'id',
		'name_ru',
        array(
            'name'=>'city',
            'value'=>'$data->city',
            'type'=>'raw',
        ),
        array(
            'name'=>'publish',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->publish?"g":"x").".png")',
            'type'=>'raw',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
