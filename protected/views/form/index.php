<?php
/* @var $this FormController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>L::t('Total').': '.$model->getMyTotalCount()),
	array('label'=>L::t('Published').': '.$model->getMyPublishedCount()),
	array('label'=>L::t('Not published').': '.$model->getMyNotPublishedCount()),
	array('label'=>L::t('Will shut down soon').': '.$model->getMyWillBeClosedInAFew()),
);?>

<div class="area-ankets">
	<div class="">
		<?php foreach($forms as $count=>$form): ?>
	    	<div class="item box">
	        	<div class="indent-area">
	        		<div class="left-col">
	        			<div class="photo">
	        				<?=CHtml::image($form->getImageSrc('112x142'),'',array('class'=>'rodund'));?>
	        				<?php if($form->no_photoshop_approved): ?>
	        					<div class="check"><span>Проверено</span></div>
	        				<?php endif; ?>
	        				<?php if($form->isVip()): ?> 
	        					<div class="vip">VIP </div>
	        				<?php endif; ?>
	        			</div>
	        			<div class="info">
	        				<h5>Просмотров:</h5>
	        				<div class="row">сегодня: <a href="#"><?=$form->hits_today?></a></div>
	        				<div class="row">всего: <a href="#"><?=$form->hits?></a></div>
	        				<div class="row review">Отзывов: <a href="#"><?=$form->getFormCommentsCount()?></a></div>
	        			</div>
	        		</div>
	        		<div class="right-col">
	        		<div class="ui-helper-clearfix mb_12">
	        			<h4 class="to-left"><?=CHtml::link($form->name, array('form/view','id'=>$form->id))?></h4>
	        			<span class="to-right id-info">id <?=$form->id?></span>
	        		</div>
	        			
	        			<?php if($form->cell_phone): ?>
	        				<span class="phone info"><?=$form->cell_phone?></span>
	        			<?php endif; ?>
	        			<span class="location info">г. <?=$form->city?$form->city->name:'-'?></span>
	        			<div class="text">
	        				<p>Статус: <?=$form->published ? 'опубликовано' : 'не опубликовано';?></p>
                            <?php if($form->isPayed()): ?>
	        				    <p>Оплачено до <?=date('d.m.Y',strtotime($form->payed_till));?></p>
                            <?php else: ?>
	        				    <p>Не оплачена</p>
                            <?php endif; ?>
	        			</div>
	        			<div class="area-links round">
	        				<ul>
	        					<li class="pay"><?=CHtml::link(L::t('Pay for form'),array('payment/create','id'=>$form->id))?></li>
	        					<li class="publ">
                                    <?=$form->published
                                        ? CHtml::link(L::t("Don't publish form"),array('form/publishDown','id'=>$form->id))
                                        : CHtml::link(L::t('Publish form'),array('form/publishUp','id'=>$form->id))?>
                                </li>
	        					<li class="edit"><?=CHtml::link(L::t('Edit'),array('form/update','id'=>$form->id))?></li>
	        					<li class="del"><?=CHtml::link(L::t('Remove'),array('form/delete','id'=>$form->id))?></li>
	        				</ul>
	        				<div class="relax">&nbsp;</div>
	        			</div>
	        		</div>
					<div class="relax">&nbsp;</div>
	        	</div>
	        </div>
        <?php endforeach;
        $count=isset($count)?$count:0;
        while(++$count%3):?>
	       	<div class="item box empty">
	        	<div class="indent-area">
	        		<?=CHtml::link(L::t('Place form'),array('form/create'));?>
					<div class="relax">&nbsp;</div>
	        	</div>
	    	</div>
    	<?php endwhile; ?>
	</div>
</div>

<?php if(isset($_GET['showDeleteMessage']) && $_GET['showDeleteMessage']==1): ?>
    <script> showMessage("<?=L::t('Form removed')?>","<?=L::t('The form has been stressfully removed.')?>"); </script>
<?php endif; ?>

<?php if(isset($_GET['showMessage']) && $_GET['showMessage']==1): ?>
    <script> showMessage("<?=L::t('Thank you for payment.')?>","<?=L::t('Money will be enrolled in 3 hours.')?>"); </script>
<?php endif; ?>
<?php if($days):?>
    <script>showMessage("<?=L::t('Payment')?>","<?=L::t("Payed for").' '.$days.' '.L::t('days')?>");</script>
<?php endif;?>