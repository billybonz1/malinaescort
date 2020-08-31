<h4 class="popup-title mb_15 mt_25">ЗАБЫЛИ ПАРОЛЬ?</h4>

<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
    </div>
<?php else: ?>
    <?php echo CHtml::beginForm('/user/recovery','post',array('id'=>'jsForgetPass')); ?>
        <?php echo CHtml::errorSummary($form); ?>
        <div class="form-group">
            <?php echo CHtml::activeLabel($form,'login_or_email' ); ?>
            <?php echo CHtml::activeTextField($form,'login_or_email', array('class'=>'form-control')) ?>
        </div>

        <div class="form-row text-center">
            <button type="submit" class="btn btn-search"><span>Отправить</span></button>
        </div>
    <?php echo CHtml::endForm(); ?>
<?php endif; ?>