<a class="fancy-popup" href="#contact-popup" id="jsContactsOpen"><?=L::t('Contact')?></a>

<div id="contact-popup" class="popup popup-xl" style="display: none">
    <?php Yii::app()->runController('site/contact');?>
</div>