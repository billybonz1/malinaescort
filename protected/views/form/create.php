<?php
/* @var $this FormController */
/* @var $model Form */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Create',
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'serviceCategories'=>$serviceCategories,
    'formServices'=>$formServices,
    'images'=>$images)); ?>