<?php
/* @var $this PaymentRequestController */
/* @var $model PaymentRequest */

$this->breadcrumbs=array(
	'Payment Requests'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('payment-request-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$dp=$model->search();
$dp->sort = array('defaultOrder'=>'date DESC');

$this->widget('GridView', array(
	'id'=>'payment-request-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'showPublishBtn'=>false,
    'showPublishOffBtn'=>false,
    'showCreateBtn'=>false,
	'columns'=>array(
		array(
            'header'=>'Пользователь',
            'type'=>'raw',
            'value'=>'CHtml::link($data->user["email"], array("user/admin","id"=>$data->user_id))'
        ),
		'date',
		'value',
        array(
            'name'=>'payment_type',
            'value'=>'YII::t("lang",$data->payment_type)'
        ),
        array(
            'header'=>L::t('Approved'),
            'value'=>'($CC = $data->cardsCount(1)) ? "$CC" : "-"',
        ),
        array(
            'header'=>L::t('Declined'),
            'value'=>'($CC = $data->cardsCount(-1)) ? "$CC" : "-"'
        ),
        array(
            'header'=>L::t('Not processed'),
            'value'=>'($CC = $data->cardsCount(0)) ? "$CC" : "-"',
        ),
        array(
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".(($data->cardsCount(0))?"x":"g").".png")',
            'type'=>'raw'
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{view} {delete}',
            'buttons'=>array(
                'view' => array(
                    'url'=>'Yii::app()->createUrl("/admin/card/admin",array("reqID"=>$data->id))'
                ),
            ),
		),
	),
));