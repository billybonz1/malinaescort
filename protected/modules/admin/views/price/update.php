<?php
/* @var $this PriceController */
/* @var $model Price */

$this->breadcrumbs=array(
	'Prices'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
    L::t('Update Price'),
);

$this->menu=array(
	array('label'=>'List Price', 'url'=>array('index')),
	array('label'=>'Create Price', 'url'=>array('create')),
	array('label'=>'View Price', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Price', 'url'=>array('admin')),
);
?>

<h1><?php echo L::t('Update Price'); ?> <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>