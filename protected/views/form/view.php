
<?php $langs=Language::getActive();?>
  <?php 
   if($langs=='en'){
     $alt = "Individual ".$model->name_en." ".$model->city->name." ".$model->cell_phone;
   } else if($langs=='tr'){
     $alt = "Fahişe ".$model->name_en." ".$model->city->name." ".$model->cell_phone;
   } else {
    $alt = "Проститутка ".$model->name." ".$model->city->name." ".$model->cell_phone;
   }
?> 
<?php if($this->getM()):?>
    <div class="main" id="JSFormsList">
        <div class="girl-anket"  >
            <figure class="girl-anket__photo">
				<div id="card-gallery">
                <?php if($model->no_photoshop_approved == 1):?>
                    <?php if($langs == 'ru'): ?>
                        <div class="sing"><img src="/images/KharkovEscort_Podpis_rus.png" style="real_img"></div>
                    <?php else:?>
                        <div class="sing"><img src="/images/KharkovEscort_Podpis_eng.png" style="real_img"></div>
                    <?php endif;;?>
                <?php endif;?>
                <?php foreach($images as $image): ?>
					<?=CHtml::link(CHtml::image(ThumbnailHelper::getThumb(Yii::getPathOfAlias('webroot') .$image->getImageSrc('216x300')),$alt,['title'=>$alt]));?>
                <?php endforeach; ?>
				</div>
                <table class="price-table">
                    <tr>
                        <?php if($price_hour = $model->price_hour): ?>
                            <td><?=L::t('One hour')?>:<br><?=$price_hour?> <?=L::t('UAH')?></td>
                        <?php endif; ?>
                        <?php if($price_two_hour = $model->price_two_hour): ?>
                            <td><?=L::t('Two hours')?>:<br><?=$model->price_two_hour?> <?=L::t('UAH')?></td>
                        <?php endif; ?>
                        <?php if($price_night = $model->price_night): ?>
                            <td><?=L::t('Over night')?>:<br><?=$model->price_night?> <?=L::t('UAH')?></td>
                        <?php endif; ?>
                    </tr>
                </table>
            </figure><!--/.girl-anket__photo-->
            <div class="girl-anket__base-info">
                <div class="girl-anket__name">
                    <?=($model->name ? $model->name : $model->name_en);?>
                </div>

                <a href="tel:<?=$model->cell_phone?>" class="girl-anket__tel">
                    <span class="icon-tel"></span><?=$model->cell_phone?>
                </a>

                <div class="girl-anket__attention">
                    <?=L::t("Girls are wary of calls, so tell her that you know about it on the site MalinaEscort.com")?>
                </div><!--/.girl-anket__attention-->
            </div><!--/.girl-anket__base-info-->

            <div class="girl-anket__other-info">
                <div class="panel">
                    <div class="panel__header">
                        <span class="panel__icon"></span>
                        <a href="#!"><?=L::t('More about it')?></a>
                    </div>

                    <div class="panel__body">
                        <div class="girl-info-list">
                            <dl class="gi-list-item">
                                <dt><?=L::t('Age:')?>:</dt>   <dd><?=$model->age?></dd>
                            </dl>

                            <dl class="gi-list-item">
                                <dt><?=L::t('Rise:')?></dt>  <dd><?=$model->rise?></dd>
                            </dl>

                            <dl class="gi-list-item">
                                <dt><?=L::t('Weight:')?></dt>  <dd><?=$model->weight?></dd>
                            </dl>

                            <dl class="gi-list-item">
                                <dt><?=L::t('Breast:')?></dt>  <dd><?=$model->breast?></dd>
                            </dl>

                            <dl class="gi-list-item">
                                <dt><?=L::t('Hair:')?></dt>  <dd><?=L::t(Yii::app()->params['hairs'][$model->hair])?></dd>
                            </dl>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel-->

                <div class="panel">
                    <div class="panel__header">
                        <span class="panel__icon"></span>
                        <a href="#!"><?=L::t('intim_uslugi')?></a>
                    </div>

                    <div class="panel__body">
                        <dl class="card-services card-block">
                            <?php
                            $prevCat='';$c=$counter=0;
                            foreach($model->formServices as $service){
                                $s = $service->service;
                                $catName = ($s && $s->category) ? $s->category->name : '';
                                if($prevCat != $catName){
                                    echo"</dd>";
                                    $counter=0;
                                    echo (++$c==1)?CHtml::tag('dd'):'';
                                    echo CHtml::tag('dt', array(), $prevCat=$catName);
                                    echo "<dd>";
                                }

                                if($s && $s->name)
                                {
                                    echo ($counter++?', ':'').CHtml::link($s->name, $s->getLink());
                                }
                            }
                            ?>
                        </dl>
                    </div><!--/.panel-body-->
                </div><!--/.panel-->

                <div class="panel">
                    <div class="panel__header">
                        <span class="panel__icon"></span>
                        <a href="#!"><?=L::t('REVIEWS')?></a>
                    </div>

                    <div class="panel__body">
                        <div class="girl-info-list">
                            <div class="review-wrap">
                                <?php foreach($comments as $comment):?>
                                    <div class="review">
                                        <div class="review__info">
                                            <div class="review__owner"><?=$comment->name?></div>
                                            <div class="review__date"><?=date('d/m/Y',strtotime($comment->added))?></div>
                                        </div>
                                        <div class="review__text">
                                            <p><?=$comment->text?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <?php if(!$comments): ?>
                                    <p lass="text-center"><?=L::t('No reviews, yet.')?></p>
                                <?php endif; ?>
                            </div><!--/.review-wrap-->
                            <div  id="jsAddCommentBlock" data-url="<?=$this->createAbsoluteUrl('comment/create')?>">
                                <?php Yii::app()->runController('comment/create');?>

                            </div>
                        </div>
                    </div><!--/.panel-body-->
                </div><!--/.panel-->

            </div>
        </div><!--/.girl-anket-->
		
		<?php $model = baners::model()->getBuners(14); foreach ($model as $value):
		$domen=Language::getActive();
		if ($value->domen==$domen||$value->domen==''):
			$url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
			<div  class="container baner-full-width container-l" ><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive" src="<?=$url;?>"></a></div>
		<?php endif; endforeach;?>

        <div class="mv-25 text-center">
            <a href="#message-popup" class="btn btn-search fancy-popup" id="jsContactsOpen"><?=L::t('Send SMS')?></a>
        </div>
        <?php $vipforms=Form::model()->getFormsList([],true);
        shuffle($vipforms);?>
        <?php if(isset($vipforms)):?>

            <div class="girl-list">
                <h3 class="girl-list__header">
					<?php if($langs == 'ru') { ?>
						<?=L::t('Топ проститутки Киева')?>
					<?php } elseif($langs == 'en') { ?>
						<?=L::t('Top Independents in Kiev')?>
					<?php } else { ?>
						<?=L::t('Ukrayna\'nın güzel bayanlar')?>
					<?php } ?>
					</h3>
                <div class="girl-list__row">
					<?php $j = 0; ?>
                    <?php foreach($vipforms as $form):?>
						<?php if ($j == 6) { break; } ?>
                        <div class="girl-list_col_2">
                            <article class="girl-item">
                                <div class="girl-item__name"> <?=CHtml::link($form->name_en,$form->generateURL());?></div>
                                <?php  
                                if($langs=='en'){
                                     $alt = "Individual ".$form->name_en." ".$form->city->name." ".$form->cell_phone;
                                   } else if($langs=='tr'){
                                     $alt = "Fahişe ".$form->name_en." ".$form->city->name." ".$form->cell_phone;
                                   } else {
                                    $alt = "Проститутка ".$form->name." ".$form->city->name." ".$form->cell_phone;
                                 } ?>
                                <figure class="girl-item__photo">
                                    <?php $img=$form->getRandomPhotoForHomePage('142x180');?>
                                    <?=CHtml::link(CHtml::image($img,$alt,array('title'=>$alt)),$form->generateURL());?></figure>

                                <div class="girl-item__info">
                                    <a class="girl-item__tel" href="tel:<?=$form->cell_phone?>"><?=$form->cell_phone?></a>
                                    <div class="girl-item__price"><?=L::t('from:')?> <?=$form->price_hour?> <?=L::t('UAH')?></div>
                                </div>
                            </article><!--/.girl-item-->
                        </div><!--/.girl-list_col_2-->
						<?php $j++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif;?>
        <?php if($days):?>
            <script>showMessage("<?=L::t('Payment')?>","<?=L::t("Payed for").' '.$days.' '.L::t('days')?>");</script>
        <?php endif;?>
        <div id="message-popup" class="popup popup-l" style="display: none">
            <?php Yii::app()->runController('site/writeSms', array('id'=>$model->id));?>
        </div><!--message-popup-->
    </div><!--/.main-->
<?php else:?>
<?php $this->breadcrumbs=array(
    $model->name,
);?>

<div class="main container container-l"><!--змінився клас в порівнянні з головною сторінкою-->
<div id="JSFormsList" class="clearfix">
    <?php// $this->widget('FormsArticles'); ?>
</div>
<div class="row card">
    <div class="col-md-6">
        <div class="gallery">
            <?php if($model->no_photoshop_approved == 1):?>
                <?php if($langs == 'ru'): ?>
                    <div class="sing"><img src="/images/KharkovEscort_Podpis_rus.png" style="real_img"></div>
                <?php else:?>
                    <div class="sing"><img src="/images/KharkovEscort_Podpis_eng.png" style="real_img"></div>
                <?php endif;;?>
            <?php endif;?>
            <div class="big-slide">
                <?php foreach($images as $image): ?>
                <div class="big-slide-item">
                    <a href="<?=$image->getImageSrc('original')?>" class="fancy-gallery" data-fancybox-group="gilr-gallery">
                        <img src="<?=$image->getImageSrc('original')?>"  alt="<?php echo $alt; ?>" title="<?php echo $alt; ?>">
                    </a>
                </div><!--/.big-slide-item-->
                <?php endforeach; ?>
            </div><!--/.-->

            <div class="small-slides">
                <?php foreach($images as $image): ?>
                <div class="small-slide-item">
                    <img src="<?=$image->getImageSrc('84x110')?>"  alt="<?php echo $alt; ?>" title="<?php echo $alt; ?>"> 
                </div><!--/.small-slide-item-->
                <?php endforeach; ?>
            </div><!--/.big-slide-->
        </div><!--/.gallery-->
        <div class="info-block border-special">
            <h4 class="info-block-title"><?=L::t('About me:')?></h4>
            <p><?=$model->about?></p>
        </div>
    </div><!--/.col-end-->

    <div class="col-md-6">
        <div class="row">
            <div class="col-xs-12">
				<?php 
					$lang = Language::getActive();
					if ($lang == 'ru') {
						$attention = 'Девушки с осторожностью относятся к звонкам, поэтому скажите ей, что Вы узнали о ней на сайте malinaescort.com';
					} else {
						$attention = 'Girls are wary of calls, so tell her that you know about it on the site MalinaEscort.com';
					}
				?> 
                <div class="attention">
                    <p class="text-center"><?=L::t($attention)?></p>
                </div><!--/.attention-->
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="card--base-info">
                    <header class="clearfix">
                           <div class="name"><h1><?=($model->name ? $model->name : $model->name_en);?></h1></div>
						<div class="name"><?=($model->canBeEditedByTheCurrentUser()?CHtml::link(L::t('Edit'),array('/form/update', 'id'=>$model->id),array('class'=>'btn')):'');?></div>
                        <a class="number-card tel-icon" href="tel:<?=$model->cell_phone?>"><?=$model->cell_phone?></a>
                    </header>

                    <div class="girl-info-list">
                        <dl class="gi-list-item">
                            <dt><?=L::t('Age:')?></dt>   <dd><?=$model->age?></dd>
                        </dl>

                        <dl class="gi-list-item">
                            <dt><?=L::t('Rise:')?></dt>  <dd><?=$model->rise?></dd>
                        </dl>

                        <dl class="gi-list-item">
                            <dt><?=L::t('Weight:')?></dt>  <dd><?=$model->weight?></dd>
                        </dl>

                        <dl class="gi-list-item">
                            <dt><?=L::t('Breast:')?></dt>  <dd><?=$model->breast?></dd>
                        </dl>

                        <dl class="gi-list-item">
                            <dt><?=L::t('Hair:')?></dt>  <dd><?=L::t(Yii::app()->params['hairs'][$model->hair])?></dd>
                        </dl>
                    </div><!--/.girl-info-list-->

                    <h4>Месторасположение:</h4>
                    <div class="girl-info-list">
                        <dl class="gi-list-item">
                            <dt><?=L::t('Location')?>:</dt>  <dd><?=$model->city?$model->city->name:'-'?></dd>
                        </dl>

                        <dl class="gi-list-item">
                        
                            <dt><?=L::t('Area:')?></dt>  <dd><?=$model->area?$model->area->name:'-'?></dd>
                        </dl>

                        <dl class="gi-list-item">
                            <dt><?=L::t('Metro:')?></dt>  <dd><?=$model->metro?'м. '.$model->metro->name:'-'?></dd>
                        </dl>
                    </div><!--/.girl-info-list-->
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="card-price-block card-block">
                    <h4><?=L::t('Price apartment')?>:</h4>
                    <div class="girl-info-list">
                        <?php if($price_hour = $model->price_hour): ?>
                        <dl class="gi-list-item">
                            <dt><?=L::t('One hour')?>:</dt>  <dd><?=$price_hour?> <?=L::t('UAH')?></dd>
                        </dl>
                        <?php endif; ?>
                        <?php if($price_two_hour = $model->price_two_hour): ?>
                        <dl class="gi-list-item">
                            <dt><?=L::t('Two hours')?>:</dt>  <dd><?=$model->price_two_hour?> <?=L::t('UAH')?></dd>
                        </dl>
                        <?php endif; ?>
                        <?php if($price_night = $model->price_night): ?>
                            <dl class="gi-list-item">
                                <dt><?=L::t('Over night')?>:</dt>  <dd><?=$model->price_night?> <?=L::t('UAH')?></dd>
                            </dl>
                        <?php endif; ?>
                    </div><!--/.girl-info-list-->
                    <h4><?=L::t('Price for departure')?>:</h4>
                    <div class="girl-info-list">
                        <?php if($price_per_hour_exit = $model->price_per_hour_exit): ?>
                        <dl class="gi-list-item">
                            <dt><?=L::t('One hour')?>:</dt>  <dd><?=$model->price_per_hour_exit?> <?=L::t('UAH')?></dd>
                        </dl>
                        <?php endif; ?>
                        <?php if($price_two_hour_exit = $model->price_two_hour_exit): ?>
                        <dl class="gi-list-item">
                            <dt><?=L::t('Two hours')?>:</dt>  <dd><?=$model->price_two_hour_exit?> <?=L::t('UAH')?></dd>
                        </dl>
                        <?php endif; ?>
                        <?php if($price_night_exit = $model->price_night_exit): ?>
                        <dl class="gi-list-item">
                            <dt><?=L::t('Over night')?>:</dt>  <dd><?=$model->price_night_exit?> <?=L::t('UAH')?></dd>
                        </dl>
                        <?php endif; ?>
                    </div><!--/.girl-info-list-->

                    <div class="girl-info-list">
                        <dl class="gi-list-item">
                            <?php if($model->speak_english): ?>
                            <dt class="label">Speaks English:</dt>  <dd></dd>
                            <?php endif; ?>
                        </dl>
                    </div>

                    <div class="mt_20 text-center">
                        <a href="#message-popup" data-rel="write_sms" class="btn btn-order fancy-popup btn-w_100" id="jsContactsOpen" style="display: block;text-align: center"><?=L::t('Send SMS')?></a>

                    </div>
                </div>
            </div>

            <div class="col-xs-12 mt_25">
                <dl class="card-services card-block">
                    <?php
                    $prevCat='';$c=$counter=0;
                    foreach($model->formServices as $service){
                        $s = $service->service;
                        $catName = ($s && $s->category) ? $s->category->name : '';
                        if($prevCat != $catName){
                            echo"</dd>";
                            $counter=0;
                            echo (++$c==1)?CHtml::tag('dd'):'';
                            echo CHtml::tag('dt', array(), $prevCat=$catName);
                            echo "<dd>";
                        }

                        if($s && $s->name)
                        {
                            echo ($counter++?', ':'').CHtml::link($s->name, $s->getLink());
                        }
                    }
                    ?>
                </dl>
            </div>
        </div>
    </div><!--/.col-end-->
</div>

<hr>

<div class="row" >
    <div  id="jsAddCommentBlock" data-url="<?=$this->createAbsoluteUrl('comment/create')?>">
        <?php Yii::app()->runController('comment/create');?>

    </div>

    <div class="col-md-7">
        <div class="comments-wrap">
            <h2 class="comments-title text-center"><?=L::t('REVIEWS')?></h2>
            <?php foreach($comments as $comment):?>
            <div class="comment-item clearfix">
                <header class="comment-header">
                                  <span class="name">
                                   <?=$comment->name?>
                                  </span>
                    <span class="comment-separator">/</span>
                                  <span class="date">
                                    <?=date('d/m/Y',strtotime($comment->added))?>
                                  </span>
                </header>

                <div class="comment">
                    <?=$comment->text?>
                </div>
            </div><!--/.comment-item-->

            <?php endforeach; ?>
            <?php if(!$comments): ?>
                <p lass="text-center"><?=L::t('No reviews, yet.')?></p>
            <?php endif; ?>
        </div>
        </div>
    </div>

    <div class="col-xs-12">

    </div>
</div>
</div><!--/.main-->

<div id="message-popup" class="popup popup-l" style="display: none">
    <?php Yii::app()->runController('site/writeSms', array('id'=>$model->id));?>
</div><!--message-popup-->
    <?php if($days):?>
        <script>
            window.onload=function()
            {
                $.fancybox.open("#pay-popup");
            }

        </script>
        <div id="pay-popup" class="popup popup-l" style="display: none">
            <h2 class="review-form-title text-center" style="color:#fff">
                <?=L::t('Payment')?>
            </h2>
            <div class="form-group" style="color:#fff">
                <?=L::t("Payed for").' '.$days.' '.L::t('days')?>
            </div>
        </div><!--message-popup-->
    <?php endif;?>

<?php endif;?>

