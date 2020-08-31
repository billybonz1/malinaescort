<?php
/* @var $this PaymentController */
/* @var $data Payment */
?>
<div class="view">
    <div class="row">
        <div class="col first"><?=CHtml::link($data->form->name,array('form/view','id'=>$data->form->id),
                array('target'=>'_blank'))?></div>
        <div class="col second"><?=CHtml::encode($data->date); ?></div>
        <div class="col third"><?=CHtml::encode($data->price); ?></div>
        <div class="col fourth"><?=CHtml::encode($data->days); ?></div>
    </div>
</div>