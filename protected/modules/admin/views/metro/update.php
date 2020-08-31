<?php
/* @var $this MetroController */
/* @var $model Metro */

$this->breadcrumbs=array(
	'Metros'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Metro', 'url'=>array('index')),
	array('label'=>'Create Metro', 'url'=>array('create')),
	array('label'=>'View Metro', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Metro', 'url'=>array('admin')),
);
?>

<h1>Update Metro <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>