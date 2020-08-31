<?php
/* @var $this MessageController */
/* @var $model Message */

$this->menu=array(
	array('label'=>'Manage Message', 'url'=>array('admin')),
);

echo $this->renderPartial('_form', array('model'=>$model));