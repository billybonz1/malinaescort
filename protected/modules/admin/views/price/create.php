<?php
/* @var $this PriceController */
/* @var $model Price */

$this->breadcrumbs=array(
	'Prices'=>array('index'),
    L::t('Create Price'),
);

$this->menu=array(
	array('label'=>'List Price', 'url'=>array('index')),
	array('label'=>'Manage Price', 'url'=>array('admin')),
);
?>

<h1><?php echo L::t('Create Price'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>