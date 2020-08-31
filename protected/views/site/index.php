
<?php if($this->getM()) { ?>
    <div class="main" id="JSFormsList">
        <?php $this->widget('Forms'); ?>
    </div><!--/.main-->
	
	<div class="pagination-wrap clearfix">
		<div id="Load_more" type="button" class="btn btn-default btn-load-more" data-limit="40">
			<span><?=L::t("Load more")?></span>
			<span class="dots"></span>
		</div>
	</div>
	
<?php } else { ?>

<div class="main container">
<?php $this->widget('VIP');?>
<?php $model = baners::model()->getBuners(1); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="container baner-full-width container-l" style="margin: 20px;"><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)' ><img class="img-responsive"  src="<?=$url;?>" style="margin: auto"></a></div>
    <?php endif; endforeach;?>
    <div class="row">
	
    <div class="col-md-2">
        <aside class="left-navbar">
            <h5 class="header"> <?=YII::t('lang','CATEGORIES')?></h5>
            <nav class="clearfix">
                <ul class="left-menu">
                    <?php foreach(ServiceCategory::model()->findAll('published=1') as $key => $c)
                    {
                        echo '<li><h4>';
                        echo CHtml::tag('a',
                            array('class'=>'collapsed',
                                'data-toggle'=>'collapse',
                                'aria-expanded'=>'false',
                                'href'=>'#service'.$key
                            ),
                            $c->name.' '
                        );
                        echo '</h4>';
                        echo '<ul class="category-nav" id="'.'service'.$key.'" style="overflow: hidden; display: none;">';
                        foreach($c->services as $s)
                        {
                            if($s->id == $id){ $class='active';} else {$class='';};
                            echo "<li class='$class'>".CHtml::link($s->name, $s->getLink()) . "</li>";
                        }
                        echo '</ul></li>';
                    } ?>
                    <?php
                    echo '<li><h4>';
                    echo CHtml::tag('a',
                        array('class'=>'collapsed',
                            'data-toggle'=>'collapse',
                            'aria-expanded'=>'false',
                            'href'=>'#service'.'6'
                        ),
                        L::t('Areas').' '
                    );
                    $model= Area::model()->findAll('city_id=5');
                    echo '</h4>';
                    echo '<ul class="category-nav" id="'.'service'.'6'.'" style="overflow: hidden; display: none;">';
                    foreach($model as $s)
                    {
                        if($s->name == $id){ $class='active';} else {$class='';};
                        echo "<li class='$class'>".CHtml::link($s->name, $s->getLink()). "</li>";
                    }
                    echo '</ul></li>';
                    ?>
                </ul>
            </nav>
        </aside><!--/.left-aside-->
		
		<?php if ((Yii::app()->controller->getId().'/'.Yii::app()->controller->getAction()->getId()) == 'site/index'  ) { ?>
			<?php $model = baners::model()->getBuners(13); foreach ($model as $value):
			$domen=Language::getActive();
			if ($value->domen==$domen||$value->domen==''):
				$url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
				<div  class="baner-full-width" ><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive" src="<?=$url;?>"></a></div>
			<?php endif; endforeach;?>
		<?php } ?>
		
		
    </div>
	
        <div id="JSFormsList" class="col-md-8">
            <?php $this->widget('Forms'); ?>
        </div>

        <aside class="col-md-2">
            <?php $model = baners::model()->getBuners(2); foreach ($model as $value):
                $domen=Language::getActive();
                if ($value->domen==$domen||$value->domen==''):
                    $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
                    <div><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img src="<?=$url;?>"></a></div>
                <?php endif; endforeach;?>
    </div>
    </aside><!--/.right-aside-->
	
	<?php $model = baners::model()->getBuners(10); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="baner-full-width" ><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive" src="<?=$url;?>"></a></div>
    <?php endif; endforeach;?>
	
	<div class="pagination-wrap clearfix">
		<div id="Load_more" type="button" class="btn btn-default btn-load-more" data-limit="40">
			<span><?=L::t("Load more")?></span>
			<span class="dots"></span>
		</div>
	</div>

</div>
</div><!--/.main-->
<div class="container container-l text-justify"><?php $this->widget('About');?></div>
<?php if(isset($_GET['message']) && $_GET['message']=='thanks'): ?>
    <script> showMessage("<?=L::t('Account activation')?>","<?=L::t('Your account has been activated. Now you can login.')?>"); </script>
<?php endif;?>

    </div>
</div><!--/.main-->
<?php } ?>