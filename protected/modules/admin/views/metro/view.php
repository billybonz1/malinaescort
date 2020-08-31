<?php
/* @var $this MetroController */
/* @var $model Metro */

$this->breadcrumbs=array(
	'Metros'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Metro', 'url'=>array('index')),
	array('label'=>'Create Metro', 'url'=>array('create')),
	array('label'=>'Update Metro', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Metro', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Metro', 'url'=>array('admin')),
);
?>

<h1>View Metro #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'city_id',
		'name_ru',
		'name_en',
		'name_tr',
		'name_de',
		'name_fr',
		'name_it',
		'name_es',
		'last_hit',
	),
)); ?>
