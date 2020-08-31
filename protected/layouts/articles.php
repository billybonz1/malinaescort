<!--<div id="servicesPage">-->
<?php
$this->beginContent('//layouts/kharkov');
if (isset($this->breadcrumbs))?>
<div class="container container-l">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'homeLink'=>"<li>".CHtml::link(L::t('Prostitutes Ukraine'),'/')."</li>",
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
$this->endContent();?>
<!--</div>-->