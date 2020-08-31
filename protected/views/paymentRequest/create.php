<?php
/* @var $this PaymentRequestController */
/* @var $model PaymentRequest */

$this->breadcrumbs=array(
	'Payment Requests'=>array('index'),
	'Create',
);
$this->menu=array(
    array('label'=>'Оплатить', 'url'=>array('PaymentRequest/create')),
    array('label'=>'История оплат', 'url'=>array('Payment/history')),
);

echo $this->renderPartial('_form', array('model'=>$model));
