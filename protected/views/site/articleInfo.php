<div class="main container container-l">
    <div id="JSFormsList" class="clearfix">
        <?php// $this->widget('FormsArticles'); ?>
    </div>
    
    <div class="artical-container row text-justify">
        <div class="col-md-2 col-sm-3">
            <div class="viplist viplist-vertical js-viplist-vertical clearfix">
                <?php  if(!count($vipforms=Form::model()->getFormsList($_GET,true)));
                shuffle($vipforms);?>
                <?php if(isset($vipforms)):?>
                        <?php    shuffle($vipforms);
                        foreach($vipforms as $form):
                            if(!($img=$form->getRandomPhotoForHomePage('142x180'))) continue; ?>
                            <div class="viplist-item">
                            <div class="photo">

                                    <?=CHtml::link(CHtml::image($img,$form->name_en,array('title'=>$form->name_en)),$form->generateURL(),['tabindex'=>'-1']);?>
                            </div><!--/.viplist-item-->
                            </div><!--/.viplist-->
                        <?php endforeach; ?>

                <?php endif;?>


            </div><!--/.viplist-->

        </div>

        <div class="col-md-10 col-sm-9">
            <h1 class="arctical-container-title"><?php echo $articles['name_'.$lang];//.;?></h1>
            <div class="artical-body">
                <div class="img-artical">
                    <?php
                        echo CHtml::image(Yii::app()->request->baseUrl.'/images/articles/'.$articles->image,$articles['name_'.$lang]);
                    ?>
                </div>
                <div class="text-artical">
                    
                    <!-- <hr class="artical-separator"> -->
                    <?php echo $articles['description_'.$lang];?>
<!--                    <p class="text-right"><small>Опубликовано <strong>29.06.2012 15:55</strong></small></p>-->
                    <hr class="artical-separator">
<!--                  s <p class="text-center back-to-article"><span class="glyphicon glyphicon-play"></span><a href="#!">Вернуться к списку статей</a></p>-->
                </div>
            </div>
        </div>        
    </div>

</div>

