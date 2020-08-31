<?php if(!$this->getM()):?><div class="main container">

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
    </div>
    <div id="JSFormsList">
        <?php $this->widget('FormsService',['forms'=>$forms]);  ?>
    </div>
    <aside class="col-md-2">
        <?php $model = baners::model()->getBuners(6); foreach ($model as $value):
            $domen=Language::getActive();
            if ($value->domen==$domen||$value->domen==''):
                $url=Yii::app()->request->baseUrl.'/images/'.$value->image;?>
                <div><a href="<?=$value->hreff?>" target="_blank" onclick='urlclick(<?=$value->id?>)'><img src="<?=$url;?>"></a></div>
            <?php endif; endforeach;?>
    </aside><!--/.right-aside-->
</div><!--/.main-->
<div class="main container">
    <div class="text-justify page-article">
    <?php if(isset($service)):?>
        <?= CHtml::tag('h1', array(), $service->name);?>
        <?= CHtml::tag('p', array('class' => 'serviceDescription'), $service->description);?>
    <?php endif?>
    </div>
</div><!--/.main-->
<?php else:?>
    <div class="main container">
        <div id="JSFormsList">

            <?php $this->widget('FormsService',['forms'=>$forms]); ?>
        </div>
        <div class="text-justify page-article">
            <?php if(isset($service)):?>
                <?= CHtml::tag('h1', array(), $service->name);?>
                <?= CHtml::tag('p', array('class' => 'serviceDescription'), $service->description);?>
            <?php endif?>
        </div>
    </div><!--/.main-->
<?php endif;?>