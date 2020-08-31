<div>
    <div id="adminPanel">
        <?=CHtml::link(L::t('Messages').(($messages=Message::getMyMessagesCount())?"&nbsp;(<b>{$messages}</b>)":''),array('/message/admin'))
            . CHtml::link(L::t('Payment requests').(($cards = Card::getNotApprovedCount())?"&nbsp;(<b>{$cards}</b>)":''), array('/paymentRequest/admin'))
            . CHtml::link(L::t('Comments').(($comments=Comment::getNotViewedCount())?"&nbsp;(<b>{$comments}</b>)":''),array('/comment/admin'))
            . CHtml::link(L::t('Forms'), array('/form/admin'))
            . CHtml::link(L::t('Users'), array('/user/admin'))
            . CHtml::link(L::t('Content'),array('/admin/content/admin'))
            . CHtml::link(L::t('Cities'), array('/admin/city/admin'))
            . CHtml::link(L::t('Areas'), array('/admin/area/admin'))
            . CHtml::link(L::t('Metros'), array('/admin/metro/admin'))
            . CHtml::link(L::t('Service categories'), array('/admin/serviceCategory/admin'))
            . CHtml::link(L::t('Services'), array('/admin/service/admin'))
            . CHtml::link(L::t('Prices'), array('/admin/price/admin'))
            . CHtml::link(L::t('Images'), array('/admin/image/admin'))
            . CHtml::link(L::t('Baners'), array('/admin/baners/admin'))
            . CHtml::link(L::t('Articles'), array('/admin/articles/admin'));
        ?>
    </div>
    <?php $this->widget('NewForms'); ?>
</div>