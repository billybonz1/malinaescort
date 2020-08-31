<?php
/* @var $this MetroController */
/* @var $model Metro */

$this->breadcrumbs=array(
	'Metros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Metro', 'url'=>array('index')),
	array('label'=>'Manage Metro', 'url'=>array('admin')),
);
?>

<h1>Create Metro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>