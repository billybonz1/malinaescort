<?php
/* @var $this ContentController */
/* @var $model Content */

$this->breadcrumbs=array(
	'baners'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Content', 'url'=>array('index')),
	array('label'=>'Create Content', 'url'=>array('create')),
	array('label'=>'Update Content', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Content', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Content', 'url'=>array('admin')),
);
?>

<h1>View Content #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'id',
            'value'=>$model->id,
            'header'=>'id'
        ),
        array(
            'header'=>'baner',
            'name'=>'image',
            'value'=>CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->image,'baner',['style'=>'width: 100px;']),
            'type'=>'raw',
        ),
        array(
            'header'=>'hreff',
            'name'=>'hreff',
            'value'=>$model->hreff,
            'type'=>'raw',
        ),
        array(
            'header'=>'views',
            'name'=>'views',
            'value'=>$model->views,
            'type'=>'raw',
        ),
        array(
            'name'=>'hiden',
            'value'=>CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($model->hiden==1?"g":"x").".png"),
            'type'=>'raw',
        ),

	),
)); ?>
