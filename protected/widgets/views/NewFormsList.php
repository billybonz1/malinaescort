<br/><hr/>
<div id="">
    <?php
    echo CHtml::tag('br')
    . CHtml::button('Напомнить об окончании срока',array('id'=>'jsRemind',
            'data-link'=>YII::app()->controller->createAbsoluteUrl('/form/remind'),
            'data-msg'=>'Пользователям будет отправлено напоминание на email. Отправить?',
        ))
    . CHtml::button('Очистить кеш',array('id'=>'jsClearCache',
            'data-link'=>YII::app()->controller->createAbsoluteUrl('/site/clearCache'),
            'data-msg'=>'Будет очищен весь кеш и удалены устаревшие изображения. Продолжить?'
        ));

    if(count($newForms)): ?>
        <br/><br/><hr/>
        <div id="jsNewForms">
        <?php
            foreach($newForms as $form) {
                echo CHtml::openTag('div');
                echo CHtml::link(CHtml::image($form->getThumbImageSrc(),$form->name.','.$form->added),$form->generateURL(),array('target'=>'_blank'));
                echo CHtml::button('Убрать',array('data-url'=>Yii::app()->createAbsoluteUrl('/form/hideFromHomePage',array('id'=>$form->id))));
                echo CHtml::closeTag('div');
            }
        ?>
        </div>
    <?php endif;

    if(count($evidence)): ?>
        <br/><br/><hr/>
        <div id="evidencePhoto">
        <?php
            foreach($evidence as $form) {
                if($form->no_photoshop_approved) continue;
                $src = $form->getEvidence();
                echo CHtml::openTag('div')
                . CHtml::link('Открыть анкету',$form->generateURL(),array('target'=>'_blank'))
                . CHtml::link(CHtml::image($src),$src,array('target'=>'_blank'))
                . CHtml::tag('br')
                . CHtml::button('100%',array('data-url'=>Yii::app()->createAbsoluteUrl('/form/evidence',array('id'=>$form->id,'val'=>'1'))))
                . CHtml::button('Убрать',array('data-url'=>Yii::app()->createAbsoluteUrl('/form/evidence',array('id'=>$form->id,'val'=>'-1'))))
                . CHtml::closeTag('div');
            }
        ?>
        </div>
    <?php endif; ?>
</div>
