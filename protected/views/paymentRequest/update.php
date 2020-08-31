<?php
/* @var $this PaymentRequestController */
/* @var $model PaymentRequest */

$this->breadcrumbs=array(
	'Payment Requests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PaymentRequest', 'url'=>array('index')),
	array('label'=>'Create PaymentRequest', 'url'=>array('create')),
	array('label'=>'View PaymentRequest', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PaymentRequest', 'url'=>array('admin')),
);
?>

<h1>Update PaymentRequest <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>