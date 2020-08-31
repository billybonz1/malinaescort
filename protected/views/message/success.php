<?php
$this->menu=array(
    array('label'=>L::t('Inbox'), 'url'=>array('/message','box'=>'inbox')),
    array('label'=>L::t('Outbox'), 'url'=>array('/message','box'=>'outbox'))
);
?>
<div class="flash-success">Спасибо за Ваше сообщение. Мы свяжимся с Вами скоро.</div>
<script>
    setTimeout(function() {window.location="<?=$this->createAbsoluteUrl('/message')?>";},2000);
</script>