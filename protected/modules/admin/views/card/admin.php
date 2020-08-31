<?php
/* @var $this CardController */
/* @var $model Card */

$this->breadcrumbs=array(
	'Cards'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>L::t('Manage Payment Requests'), 'url'=>array('/paymentRequest/admin')),
);

$this->widget('GridView', array(
	'id'=>'card-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'showPublishBtn'=>false,
    'showPublishOffBtn'=>false,
    'showCreateBtn'=>false,
	'columns'=>array(
		'id',
		'number',
		'password',
		'check',
        array(
            'name'=>'value',
            'value'=>'CHtml::textField("value",
                $data->value,
                array("data-saveUrl"=>Yii::app()->createUrl((isset(Yii::app()->controller->module)?Yii::app()->controller->module->id."/":"") . Yii::app()->controller->getId() . "/setValue",
                array("id"=>$data->id)),"class"=>"jsValue")
            )',
            'type'=>'raw',
        ),
		'comment:html',
		'decline_reson:html',
		array(
            'name'=>'approved',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->approved?"g":"x").".png")',
            'type'=>'raw',
            'header'=>'Статус'
        ),
        array('class'=>'CButtonColumn','template'=>'{update}',),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{approve} {decline} {approved} {declined}',
            'buttons' => array(
                'approve' => array(
                    'url'=>'Yii::app()->createUrl("/admin/card/approve",array("id"=>$data->id))',
                    'visible'=>'$data->approved==0',
                    'label'=>YII::t("lang","Approve"),
                    'click'=>'function(){card.approve(this);return false;}',
                ),
                'approved' => array('visible'=>'$data->approved==1', 'label'=>YII::t("lang","Approved")),
                'decline' => array(
                    'url'=>'Yii::app()->createUrl("/admin/card/decline",array("id"=>$data->id))',
                    'label'=>YII::t("lang","Decline"),
                    'visible'=>'$data->approved==0',
                    'click'=>'function(){card.decline(this);return false;}'
                ),
                'declined' => array('visible'=>'$data->approved==-1', 'label'=>YII::t("lang","Declined")),
            ),
		),
	),
)); ?>
