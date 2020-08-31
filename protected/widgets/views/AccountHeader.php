<div class="menu-with-balance box">
    <ul>
        <li><?=CHtml::link(L::t('My forms'),array('/form/my'))?></li>
        <li><?=CHtml::link(L::t('Place form'),array('/form/create'))?></li>
        <li><?=CHtml::link(L::t('Messages') . (($messages=Message::getMyMessagesCount())?"&nbsp;<b>(<span class='red'>{$messages}</span>)</b>":''),array('/message'));?></li>
        <li><?=CHtml::link(L::t('Prices'),array('/admin/price'))?></li>
        <li><?=CHtml::link(L::t('Fill up the account'),array('/PaymentRequest/create'))?></li>
        <li><?=CHtml::link(L::t('Profile'),array('/user/profile/edit'))?></li>
    </ul>
    <div class="balance">
        <span><?=L::t('Balance')?>: <?=$user?$user->amount:''?> <?=L::t('UAH')?></span>
    </div>
    <div class="relax">&nbsp;</div>
</div>