<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'Baners'=>array('index'),
	'Manage',
);


$this->widget('GridView', array(
	'id'=>'content-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
    'showPublishBtn'=>true,
    'showPublishOffBtn'=>true,
	'columns'=>array(
        array(
            'name'=>'city',
            'value'=>'$data->city',
            'header'=>'Город'
        ),
        array(
            'header'=>'Баннер',
            'name'=>'image',
            'value'=>'$data->image',
            'type'=>'raw',

        ),
        array(
            'header'=>'Cсылка',
            'name'=>'hreff',
            'value'=>'$data->hreff',
            'type'=>'raw',
        ),
        array(
            'header'=>'Переходов',
            'name'=>'views',
            'value'=>'$data->views',
            'type'=>'raw',
        ),
        array(
            'name'=>'hiden',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->hiden==1?"g":"x").".png")',
            'type'=>'raw',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
));