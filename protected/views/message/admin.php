<?php
/* @var $this MessageController */
/* @var $model Message */

echo CHtml::link('Входящие',array('/message/admin','box'=>'inbox'))
    . '&nbsp;'
    . CHtml::link('Исходящие',array('/message/admin','box'=>'outbox'))
    . CHtml::tag('br')
    . CHtml::tag('br')
    . CHtml::tag('h1',array(),L::t($box=='inbox'?'Inbox':'Outbox'));

$this->widget('GridView', array(
    'showPublishBtn'=>false,
    'showPublishOffBtn'=>false,
    'showCreateBtn'=>false,
    'showGridSearch'=>true,
	'id'=>'message-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
	'columns'=>array(
		'title',
		'massage',
        $box=='inbox'
            ? array('value'=>'$data->fromUser["email"]?$data->fromUser["email"]:"<b>Пользователь удален</b>"','type'=>'raw','header'=>'От кого')
            : array('value'=>'$data->toUser["email"]?$data->toUser["email"]:"<b>Пользователь удален</b>"','type'=>'raw','header'=>'Кому'),
		'added',
        array(
            'name'=>'isopened',
            'value'=>'$data->isopened?"да":"нет"',
            'header'=>'Прочтен',
            'filter'=>array(
                '1' => 'Да',
                '0' => 'Нет',
            ),
        ),
		array(
			'class'=>'CButtonColumn',
            'template'=>'{update}{view}{delete}',
            'buttons'=>array(
                'update' => array
                (
                    'label'=>'Ответить на сообщение',
                    'url'=>'Yii::app()->createUrl("message/create", array("to"=>$data->sender))',
                ),
            ),
		),
	),
));
