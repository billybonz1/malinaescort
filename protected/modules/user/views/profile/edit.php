<?php $this->pageTitle=C::i('site_title') . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile")=>array('profile'),
	UserModule::t("Edit"),
);
?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>

<div class="center-align-box">
	<div class="profile-box box-bg">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'profile-form',
			'enableAjaxValidation'=>true,
			'htmlOptions' => array('enctype'=>'multipart/form-data'),
		)); ?>
		<?php echo $form->errorSummary(array($model,$profile)); ?>
	    	<div class="form-box">
	        	<h4 class="text-center">Мой профиль</h4>
	        	<p>Это Ваши персональные данные. Они на сайте НЕ ПОКАЗЫВАЮТСЯ.<br />Эти данные нужны только администратору для связи с Вами.<br />Здесь Ваш e-mail и пароль к личному кабинету. <br />Пароль можно изменить в любое время.</p>
    			<div class="row">
    				<?php echo $form->labelEx($model,'email'); ?>
		        	<div class="relax">&nbsp;</div>
					<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'text long')); ?>
					<?php echo $form->error($model,'email'); ?>
    			</div>
    			<?php 
    			$profileFields=$profile->getFields();
				if ($profileFields) {
					foreach($profileFields as $field) {
					?>
						<div class="row">
							<?php echo $form->labelEx($profile,$field->varname);?>
							<div class="relax">&nbsp;</div>
							<?php if ($widgetEdit = $field->widgetEdit($profile)) {
								echo $widgetEdit;
							} elseif ($field->range) {
								echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
							} elseif ($field->field_type=="TEXT") {
								echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
							} else {
								echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'text long'));
							}
							?><div class="relax">&nbsp;</div><?php 
							echo $form->error($profile,$field->varname); ?>
						</div>	
					<?php
					}
				} ?>
    			<div class="row">
                    <?=CHtml::link('Изменить пароль',array('/user/profile/changepassword'),array('class'=>'change-pwd'))?>
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
