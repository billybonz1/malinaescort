<?php
/* @var $this PaymentRequestController */
/* @var $data PaymentRequest */
?>
<div class="view">
    <div class="row">
        <div class="col first"><?=CHtml::link($data->user->profile->fullname,array(),array('target'=>'_blank'))?></div>
        <div class="col second"><?=CHtml::encode($data->date); ?></div>
        <div class="col third"><?=CHtml::encode($data->payment_type); ?></div>
        <div class="col fourth"><?=CHtml::encode($data->date); ?></div>
    </div>
</div>