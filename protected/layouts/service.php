<?php
$this->beginContent('//layouts/kharkov');
if (isset($this->breadcrumbs))?>
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
            'homeLink'=>"<li><a href='/'>".CHtml::link(L::t($home_text),'/')."</a></li>",
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
<?php echo $content;
$this->endContent();
?>
