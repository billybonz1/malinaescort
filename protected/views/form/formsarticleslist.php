<section class="questionnaires  clearfix">
    <?php
    if(!count($forms)){
        echo CHtml::tag('h1',array('class'=>'no-results box-bg'),L::t('No search results'));
        return;
    }
    ?>
    <div class="col-xs-12">
    <div class="row">
        <?php $i=0; foreach($forms as $form):
            $criteria=new CDbCriteria;
            $criteria->condition="form_id={$form->id}";
            $criteria->limit=3;
            $criteria->order="id ASC";
            $images=Image::model()->findAll($criteria);
            ?>

                <div class="questionnaire-item clearfix">
                    <div class="col-sm-7 col-md-12 col-lg-7">
                        <div class="row photo-wrap">
                            <?php foreach ($images as $image):?>
                                <div class="col-xs-4">
                                    <div class="photo"><?=CHtml::link(CHtml::image($image->getImageSrc('142x180'),$form->name_en,array('title'=>$form->name_en)),$form->generateURL())?>

                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>

                    <div class="col-sm-5 col-md-12 col-lg-5">
                        <div class="row info-wrap">
                            <div class="col-xs-5 ">
                                <div class="girl-info">
                                    <div class="girl-info-list">
                                        <dl class="gi-list-item">
                                            <dt><?=L::t('Age:')?></dt>    <dd><?=$form->age?></dd>
                                        </dl>
                                        <dl class="gi-list-item">
                                            <dt><?=L::t('Rise:')?></dt>   <dd><?=$form->rise?></dd>
                                        </dl>
                                        <dl class="gi-list-item">
                                            <dt><?=L::t('Weight:')?></dt>   <dd><?=$form->weight?></dd>
                                        </dl>
                                        <dl class="gi-list-item">
                                            <dt><?=L::t('Breast short:')?></dt>   <dd><?=$form->breast?></dd>
                                        </dl>
                                    </div><!--/.girl-info-list-->

                                    <div class="girl-info-list">
                                        <?php if($price_hour = $form->price_hour): ?>
                                            <dl class="gi-list-item">
                                                <dt><?=L::t('One hour')?>:</dt>  <dd><?=$price_hour?> <?=L::t('UAH')?></dd>
                                            </dl>
                                        <?php endif; ?>

                                        <?php if($price_two_hour = $form->price_two_hour): ?>
                                            <dl class="gi-list-item">
                                                <dt><?=L::t('Two hours')?>:</dt>  <dd><?=$form->price_two_hour?> <?=L::t('UAH')?></dd>
                                            </dl>
                                        <?php endif; ?>
                                        <?php if($price_night = $form->price_night): ?>
                                            <dl class="gi-list-item ">
                                                <dt><?=L::t('Over night')?>:</dt>  <dd><?=$form->price_night?> <?=L::t('UAH')?></dd>
                                            </dl>
                                        <?php endif; ?>
                                    </div><!--/.girl-info-list-->

                                </div><!--/.girl-info-->
                            </div>

                            <div class="col-xs-7">
                                <header class="questionnaire-header clearfix">
                                    <div class="name"><?=CHtml::link(htmlspecialchars(($form->name ? $form->name : $form->name_en), ENT_QUOTES),$form->generateURL())?></div>
                                    <?php if($form->cell_phone): ?>
                                        <div class="tel"> <?=CHtml::link($form->cell_phone,$form->generateURL())?></div>
                                    <?php endif; ?>
                                </header><!--/.header-->
                                <div class="questionnaire-text">
                                    <p><?php
                                        if($form->about!="")
                                        {
                                            $string = substr($form->about, 0, 222);
                                            $string = substr($form->about, 0, strrpos($string, ' '));
                                            echo $string."...";
                                        }
                                        ?></p>
                                </div>

                                <div class="questionnaire-link text-center">
                                    <?=CHtml::link(L::t('Details'),$form->generateURL(),['class'=>'btn btn-order btn-w_100'])?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--/.questionnaire-item-->

        <?php endforeach;?>
         </div>
    </div><!--/.end row-->

</section><!--/.center-->