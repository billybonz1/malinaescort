<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'payment-form',
	'enableAjaxValidation'=>false,
));

$pricesArray = array();
foreach(Price::model()->findAll('published=1') as $price)
	$pricesArray[] = array('id'=>$price->id,'price'=>$price->price,'priceVip'=>$price->price_vip); ?>
	<?php echo CHtml::hiddenField('Payment[form_id]',$formId);?>
	<div class="center-align-box">
		<div class="pay-box box-bg" data-confirmation="<?=L::t('Payment confirmation', array('{UAH}'=>L::t('UAH')));?>">
	    	<div class="container form-box">
	        	<h4><?=L::t('Form payment').': ID '.$formId?></h4>
	        	<?php echo $form->errorSummary($model); ?>
	        	<div class="left-col table-box" id="JSFormPrices">
	        		<div class="row title">
	        			<div class="col">&nbsp;</div>
	        			<div class="col middle"><?=L::t('Term')?></div>
	        			<div class="col"><?=L::t('Price')?></div>
	        		</div>
	        		<?php foreach(Price::model()->findAll('published=1') as $price): ?>
			        	<div class="row">
			        		<div class="col">
			        			<?=CHtml::radioButton('Payment[days]',false,array('value'=>$price->id))?>
			        		</div>
			        		<div class="col middle"><?=$price->days.' '.L::t('Days')?></div>
			        		<div class="col price">
			        			<?=$price->price.' '.L::t('UAH')?>
		        			</div>
		        			<div class="col price_vip">
			        			<?=$price->price_vip.' '.L::t('UAH')?>
		        			</div>
			        	</div>
		        	<?php endforeach; ?>
		        	<div class="row last">
                        <button type="submit" class="btn"><span><?=L::t( 'Do form payment')?></span></button>
		        	</div>
		        </div>
		        <div class="right-col">
		        	<div class="row">
						<?=$form->checkBox($model,'vip',array('id'=>'JSPlaceInVIP')); ?>
			        	<?=$form->labelEx($model,'vip'); ?>
		        	</div>
		        	<div class="relax">&nbsp;</div>
                    <div id="jsVIPPaymentText"><?=C::i('payment_description')?></div>
		        </div>
	        	<div class="relax">&nbsp;</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>