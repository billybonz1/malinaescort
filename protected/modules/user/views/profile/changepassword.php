<?php $this->pageTitle=C::i('site_title') . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Profile") => array('/user/profile'),
	UserModule::t("Change Password"),
);
?>
<div class="center-align-box">
    <div class="profile-box box-bg">
        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'changepassword-form',
            'enableAjaxValidation'=>false,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        <?php echo $form->errorSummary($model); ?>
        <div class="form-box">
            <div class="row">
                <?php echo $form->labelEx($model,'oldPassword'); ?>
                <div class="relax">&nbsp;</div>
                <?php echo $form->passwordField($model,'oldPassword',array('size'=>60,'maxlength'=>128,'class'=>'text long')); ?>
                <?php echo $form->error($model,'oldPassword'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'password'); ?>
                <div class="relax">&nbsp;</div>
                <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'text long')); ?>
                <?php echo $form->error($model,'password'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'verifyPassword'); ?>
                <div class="relax">&nbsp;</div>
                <?php echo $form->passwordField($model,'verifyPassword',array('size'=>60,'maxlength'=>128,'class'=>'text long')); ?>
                <?php echo $form->error($model,'verifyPassword'); ?>
            </div>
            <div class="row">
                <button type="submit" class="btn sign-in round-7">
                    <span><?=L::t('Send')?></span>
                </button>
            </div>
            <div class="relax">&nbsp;</div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>