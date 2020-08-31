<?php if (Yii::app()->user->hasFlash('writeSms')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('writeSms'); ?>
    </div>

<?php else: ?>
    <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'sms-form',
            'action' => array('/site/writeSms'),
            'enableClientValidation' => false,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions' => array(
                'id' => 'jsSmsForm',
                'class'=>"form",
            )

        )); ?>
        <h2 class="review-form-title text-center">
            <?= L::t('Write to the Girl') ?>
        </h2>
    <?php echo $form->hiddenField($model, 'id', array('class' => 'textinput')); ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'phone'); ?>
            <?php echo $form->textField($model, 'phone', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'text'); ?>
            <?php echo $form->textArea($model, 'text', array('rows' => 5,  'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'text'); ?>
        </div>

        <div class="form-group capcha">
            <div class="img-captcha"><?php $this->widget('CCaptcha', array('showRefreshButton' => true)); ?></div>
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
            <?php echo $form->textField($model, 'verifyCode', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'verifyCode'); ?>
        </div>

        <div class="text-center mt_25">
            <button class="btn btn-search" type="submit"><?= L::t('Send') ?></button>
        </div>
    <?php $this->endWidget(); ?>
<?php endif; ?>
