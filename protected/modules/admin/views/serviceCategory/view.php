<?php
/* @var $this ServiceCategoryController */
/* @var $model ServiceCategory */

$this->breadcrumbs=array(
	'Service Categories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ServiceCategory', 'url'=>array('index')),
	array('label'=>'Create ServiceCategory', 'url'=>array('create')),
	array('label'=>'Update ServiceCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ServiceCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ServiceCategory', 'url'=>array('admin')),
);
?>

<h1>View ServiceCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name_ru',
		'name_en',
		'name_tr',
		'name_de',
		'name_fr',
		'name_it',
		'name_es',
		'published',
	),
)); ?>
