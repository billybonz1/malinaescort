<div class="center-align-box">
    <div class="new-message-box box-bg">
            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'message-form',
                'enableAjaxValidation'=>false,
            )); ?>

            <?php echo $form->errorSummary($model); ?>
            <?=CHtml::hiddenField('Message[recipient]',isset($to)?$to:0)?>
            <div class="form-box">
                <h4><?=L::t('New message');?></h4>
                <div class="row">
                    <?php echo $form->labelEx($model,'title'); ?>
                    <div class="relax">&nbsp;</div>
                    <?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50,'class'=>'text')); ?>
                    <?php echo $form->error($model,'title'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model,'massage'); ?>
                    <div class="relax">&nbsp;</div>
                    <?php echo $form->textArea($model,'massage',array('rows'=>6, 'cols'=>50)); ?>
                    <?php echo $form->error($model,'massage'); ?>
                </div>
                <button type="submit" class="btn sign-in round-7">
                    <span><?=L::t( 'Send')?></span>
                </button>
                <div class="relax">&nbsp;</div>
            </div>
        <?php $this->endWidget(); ?>
    </div>
</div>