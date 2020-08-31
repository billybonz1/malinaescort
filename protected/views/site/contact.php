<div>
    <?php if(Yii::app()->user->hasFlash('contact')): ?>

        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('contact'); ?>
        </div>

    <?php else: ?>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'contact-form',
        'action'=>array('/site/contact'),
        'enableClientValidation'=>false,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions'=>array(
            'id'=>'jsContactForm',
            'class'=>'form',
        )

    )); ?>
            <h2 class="popup-title"><?=L::t('Contact')?></h2>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'name'); ?>
                        <?php echo $form->textField($model,'name',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'name'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email'); ?>
                        <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'email'); ?>
                    </div>

                    <div class="form-group capcha">
                        <div class="img-captcha"><?php $this->widget('CCaptcha',array('showRefreshButton'=>true)); ?></div>
                        <?php echo $form->labelEx($model,'verifyCode'); ?>
                        <?php echo $form->textField($model,'verifyCode',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'verifyCode'); ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'subject'); ?>
                        <?php echo $form->textField($model,'subject',array('class'=>'form-control')); ?>
                        <?php echo $form->error($model,'subject'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model,'body'); ?>
                        <?php echo $form->textArea($model,'body',array('rows'=>6,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'body'); ?>
                    </div>
                </div>

                <div class="col-xs-12 text-center">
                    <button class="btn btn-search" type="submit"><?=L::t('Send')?></button>
                </div>
            </div>
    <?php $this->endWidget(); ?>
    <?php endif; ?>
</div>