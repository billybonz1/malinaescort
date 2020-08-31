<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	'Manage',
);


$this->widget('GridView', array(
	'id'=>'content-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
    'showPublishBtn'=>false,
    'showPublishOffBtn'=>false,
	'columns'=>array(
		'name',
		array(
            'name'=>'text_ru',
            'value'=>'substr($data->text_ru,0,500)."..."',
            'header'=>'Текст'
        ),
        array(
            'header'=>'Город',
            'name'=>'city.name',
            'value'=>'$data->city["name_ru"]',
            'type'=>'raw',
        ),
        array(
            'name'=>'published',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->published?"g":"x").".png")',
            'type'=>'raw',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
));