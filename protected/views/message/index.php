<?php
/* @var $this MessageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Messages',
);

$this->menu=array(
    array('label'=>L::t('New message'), 'url'=>array('/message/create')),
    array('label'=>L::t('Inbox'), 'url'=>array('/message','box'=>'inbox')),
    array('label'=>L::t('Outbox'), 'url'=>array('/message','box'=>'outbox'))
);
?>
<div class="messages-box box-bg">
    <div class="messages-list">
        <div class="row title">
            <div class="col first"><?=L::t('Title')?></div>
            <div class="col second">Дата и время создания</div>
            <div class="col third">Отправитель</div>
            <div class="col fourth">Состояние</div>
        </div>

        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
            'pager'=>array(
		    	'header'=>'<span class="header-pag">'.L::t('Перейти к странице').':</span>',
		    	'nextPageLabel'=>L::t('Следующая').' &raquo;',
		    	'prevPageLabel'=>'&laquo; '.L::t('Предыдущая')
		   	 )
//            'summary'=>false,
        )); ?>

    </div>
    <div class="relax">&nbsp;</div>
</div>

