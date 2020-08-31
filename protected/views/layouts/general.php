<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/kharkov'); ?>
<?php $model = baners::model()->getBuners(1); foreach ($model as $value):
    $domen=Language::getActive();
    if ($value->domen==$domen||$value->domen==''):
        $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
        <div  class="container baner-full-width container-l"><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img class="img-responsive"  src="<?=$url;?>" style="margin: auto"></a></div>
    <?php endif; endforeach;?>
	<?php
	//	$this->widget('SearchForm');?>
    <?php if(isset($this->breadcrumbs)):?>
	<?php 
		$lang = Language::getActive();
		if ($lang == 'ru') {
			$home_text = 'Проститутки Киева';
		} else {
			$home_text = 'Escort Kiev';
		}
	?> 
    <div class="container container-l">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                              'links'=>$this->breadcrumbs,
                               'homeLink'=>"<li itemprop='itemListElement' itemscope
                itemtype='https://schema.org/ListItem'><a href='/' itemprop='item'><span itemprop='name'>".L::t($home_text)."</span></a><meta itemprop='position' content='1' /></li>",
                               'tagName'=>'ol',
                                'inactiveLinkTemplate'=>"<li itemprop='itemListElement' itemscope
                itemtype='https://schema.org/ListItem'><span itemprop='name'>{label}</span><meta itemprop='position' content='2' /></li>",
                                'activeLinkTemplate'=>'<li itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem"><a href="{url}" itemprop="item"><span itemprop="name">{label}</span></a><meta itemprop="position" content="3" /></li>',
                              'separator'=>'',
                                'htmlOptions' => array(
                                    'class' => 'breadcrumb',
                                    'itemtype'=>"https://schema.org/BreadcrumbList",
                                    'itemscope'=>''
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