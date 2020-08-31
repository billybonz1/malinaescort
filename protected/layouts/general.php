<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/kharkov'); ?>
<?php $model = baners::model()->getBuners(1); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="container baner-full-width container-l"a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive"  src="<?=$url;?>"></a></div>
    <?php endif; endforeach;?>
	<?php
	//	$this->widget('SearchForm');?>
    <?php if(isset($this->breadcrumbs)):?>
    <div class="container container-l">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                              'links'=>$this->breadcrumbs,
                               'homeLink'=>"<li>".CHtml::link(L::t('Prostitutes kharkova'),'/')."</li>",
                               'tagName'=>'ol',
                                'inactiveLinkTemplate'=>'<li>{label}</li>',
                                'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
                              'separator'=>'',
                                'htmlOptions' => array(
                                    'class' => 'breadcrumb'
                                )
                             )
        ); ?><!-- breadcrumbs -->
    </div>
    <?php endif?>
    <?php echo $content;
    ?>
<?php $model = baners::model()->getBuners(3); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="container baner-full-width container-l" ><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive" src="<?=$url;?>"></a></div>
    <?php endif; endforeach;?>
<?php $this->endContent(); ?>