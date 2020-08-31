<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
    L::t('My forms')=>array('/form/my'),
    L::t('Create Payment'),
);?>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'formId'=>$formId));