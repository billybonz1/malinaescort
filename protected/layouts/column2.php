<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/admin'); ?>
    <div class="span-19">
        <div id="content" class="content">

            <?php
                $this->beginWidget('zii.widgets.CPortlet', array());
                $this->widget('zii.widgets.CMenu', array(
                    'items'=>$this->menu,
                    'htmlOptions'=>array('class'=>'operations'),
                ));
                $this->endWidget();
                echo $content;
            ?>
        </div><!-- content -->
    </div>
<?php $this->endContent(); ?>