<?php
/* @var $this payment requestController */
/* @var $model payment request */

$this->breadcrumbs=array(
	'Payment Requests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>L::t('List payment request'), 'url'=>array('index')),
	array('label'=>L::t('Create payment request'), 'url'=>array('create')),
);
?>

<h1><?php echo L::t('View payment request');?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'value',
		'payment_type',
	),
)); ?>
