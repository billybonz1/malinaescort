<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
	'Messages'=>array('index'),
	'Create',
);
$this->menu=array(
    array('label'=>L::t('Inbox'), 'url'=>array('/message','box'=>'inbox')),
    array('label'=>L::t('Outbox'), 'url'=>array('/message','box'=>'outbox'))
);

echo $this->renderPartial('_form', array('model'=>$model,'to'=>$to)); ?>