<?php
/* @var $this PriceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(L::t('My account')=>$this->createUrl('/user/profile'), L::t('Prices'));
?>
<div class="admin-price-wr center-align-box">
	<div class="price-box box-bg">
		<div class="container">
	    	<h4 class="text-center"><?php echo L::t('Prices'); ?></h4>
	        <div class="table-box">
	        	<div class="row title">
		        	<div class="col"><?php echo L::t('Term'); ?></div>
			        <div class="col"><?php echo L::t('Price'); ?></div>
			        <div class="col small"><?php echo L::t('Price Vip'); ?></div>
	        	</div>
	        	<?php foreach($prices as $price): ?>
	        		<div class="row">
		        		<div class="col"><?php echo $price->days.' '.L::t('Days'); ?></div>
		        		<div class="col"><?php echo $price->price.' '.L::t('UAH'); ?></div>
		        		<div class="col small"><?php echo $price->price_vip.' '.L::t('UAH'); ?></div>
		        	</div>
	    		<?php endforeach; ?>
	        </div>
	     	<div class="relax">&nbsp;</div>
		</div>
	</div>
</div>