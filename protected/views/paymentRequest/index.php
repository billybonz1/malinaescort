<?php
/* @var $this PaymentRequestController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Payment Requests',
);

$this->menu=array(
    array('label'=>'Оплатить', 'url'=>array('')),
    array('label'=>'История оплат', 'url'=>array('PaymentRequest/history'))
);
?>
<div class="messages-box box-bg">
<div class="messages-list">

    <div class="row title">
        <div class="col first">Пользователь</div>
        <div class="col second">Дата пополнения</div>
        <div class="col third">Сумма</div>
        <div class="col fourth">Срок действия</div>
    </div>

    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
//            'summary'=>false,
    )); ?>

</div>
<div class="relax">&nbsp;</div>
</div>