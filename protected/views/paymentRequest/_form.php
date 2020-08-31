<?php
/* @var $this PaymentRequestController */
/* @var $model PaymentRequest */
/* @var $form CActiveForm */
?>
<div class="center-align-box">
	<div class="means_of_pay mb15 box-bg">
    	<div class="container form-box">
        	<h4 class="text-center">Выберите способ оплаты</h4>
        	<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'payment-request-form',
				'enableAjaxValidation'=>false,
			));
		    $WMCards = isset($_REQUEST['wmCard']) ? $_REQUEST['wmCard'] : null;
		    $InternetCards = isset($_REQUEST['internetCard']) ? $_REQUEST['internetCard'] : null;?>
			
			<?php echo $form->errorSummary($model); ?>
			<div id="jsPaymentType">
	        	<div class="row">
			        <?php echo CHtml::radioButton('PaymentRequest[payment_type]', !$model->payment_type || $model->payment_type=='webmoney', array('value'=>'webmoney', 'id'=>'webmoney'));?>
			        <?php echo CHtml::label(L::t( 'Webmoney payment'), 'webmoney'); ?>
				</div>
        		<div class="row">
			        <?php echo CHtml::radioButton('PaymentRequest[payment_type]', $model->payment_type == 'webmoney_cards', array('value'=>'webmoney_cards', 'id'=>'webmoney_cards'));?>
		        	<?php echo CHtml::label(L::t( 'WM Cards payment'), 'webmoney_cards'); ?>
				</div>
        		<div class="row">
				    <?php echo CHtml::radioButton('PaymentRequest[payment_type]', $model->payment_type == 'internet_cards', array('value'=>'internet_cards', 'id'=>'internet_cards'));?>
		        	<?php echo CHtml::label(L::t( 'Internet money cards'), 'internet_cards'); ?>
	        	</div>
			</div>
			<div class="extra-content">
        		<span class="warning">Для перевода денег по WebMoney с кошелька на кошелек Вам нужно написать сообщение администратору и запросить номер кошелька.</span>
        	</div>
			<div id="jsCards" class="extra-content">
		        <div class="small-area" id="jsCardsList" data-config='{"value":"<?=L::t( 'Value')?>",
		        "number":"<?=L::t( 'Amount')?>",
		        "password":"<?=L::t( 'Password')?>",
		        "check":"<?=L::t( 'Check')?>"}'></div>
		        <div class="control-area" style="display: none;">
		        	<?php echo CHtml::link('+', 'javascript:;',array('id'=>'jsAddCard','class'=>"plus")); ?>
		        	<?php echo CHtml::link('-', 'javascript:;',array('id'=>'jsRemoveCard','class'=>"minus")); ?>
	        	</div>
		    </div>
        	<div class="row">
                <button type="submit" class="btn sign-in round-7">
                    <span><?=L::t( 'Send')?></span>
                </button>
        	</div>
        </div>
	<?php $this->endWidget(); ?>
	 </div>
	 </div>