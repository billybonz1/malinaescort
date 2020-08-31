<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>
<div class="form">
    <?php $form=$this->beginWidget('UActiveForm', array(
            'id'=>'jsRegistrationForm',
            'action'=>array('/user/registration'),
            'enableAjaxValidation'=>false,
            'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
            'htmlOptions' => array('enctype'=>'multipart/form-data','class'=>'form'),
        )); ?>
        <h2 class="popup-title"><?php echo L::t("REGISTRATION"); ?></h2>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'email'); ?>
                </div>
                <div class="form-group">
                    <?php
                    if ($profileFields=$profile->getFields()) {
                        foreach($profileFields as $field) {
                            ?>
                            <div class="form-row">
                                <?php echo $form->labelEx($profile,$field->varname); ?>
                                <?php
                                if ($widgetEdit = $field->widgetEdit($profile)) {
                                    echo $widgetEdit;
                                } elseif ($field->range) {
                                    echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
                                } elseif ($field->field_type=="TEXT") {
                                    echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
                                } else {
                                    echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255), 'class'=>'form-control'));
                                }
                                ?>
                                <?php echo $form->error($profile,$field->varname); ?>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'password'); ?>
                    <?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'password'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'verifyPassword'); ?>
                    <?php echo $form->passwordField($model,'verifyPassword',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'verifyPassword'); ?>
                </div>

                <div class="form-group capcha">

                    <div class="img-captcha"><?php $form->widget('CCaptcha'); ?></div>

                    <label for="ContactForm_verifyCode"><?=L::t('Enter the code')?></label>
                    <?php echo $form->textField($model,'verifyCode',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'verifyCode'); ?>

                </div>
            </div>

            <div class="col-xs-12 mt_5 text-center">
                <button class="btn btn-search" type="submit">Отправить</button>
            </div>
        </div>
    </form>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>