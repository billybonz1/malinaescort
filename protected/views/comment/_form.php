<?php
/* @var $this CommentController */
/* @var $model Comment */
/* @var $form CActiveForm */
$form_id = isset($_REQUEST['id'])?$_REQUEST['id']:null;
if(!$form_id)
	$form_id = isset($_REQUEST['Comment']['form_id'])?$_REQUEST['Comment']['form_id']:$form_id;
?>
<div class="col-md-5"  id="jsCommentForm">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'comment-form',
            'enableAjaxValidation'=>false,
            'action'=>array('/comment/create'),
            'htmlOptions'=>array(
            'class'=>'form form-review',
    ),
        )); ?>
        <h2 class="review-form-title">
            <?=L::t('Leave comment')?>
        </h2>

        <div class="form-group">
            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'text'); ?>
            <?php echo $form->textArea($model,'text',array('rows'=>5, 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'text'); ?>
        </div>
        <?=CHtml::hiddenField('Comment[form_id]', $form_id); ?>
        <div class="form-group capcha">

            <div class="img-captcha"><?php $form->widget('CCaptcha'); ?></div>

            <label for="ContactForm_verifyCode"><?=L::t('Enter the code')?></label>
            <?php echo $form->textField($model,'verifyCode',array('class'=>'form-control')); ?>
            <?php echo $form->error($model,'verifyCode'); ?>

        </div>

        <div class="text-center mt_25">
            <button class="btn btn-search" type="submit"><?=L::t('Send')?></button>
        </div>
    <?php $this->endWidget(); ?>
</div>


    <?php return;?>
	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'added'); ?>
		<?php echo $form->textField($model,'added'); ?>
		<?php echo $form->error($model,'added'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'form_id'); ?>
		<?php echo $form->textField($model,'form_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'form_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>



</div><!-- form -->

<form class="form form-review">
    <h2 class="review-form-title">
        <?=L::t('REVIEWS')?>
    </h2>
    <div class="form-group">
        <label for="exampleInputName5">Ваше имя</label>
        <input type="text" class="form-control" id="exampleInputName5">
    </div>

    <div class="form-group">
        <label for="exampleInput5">Текст сообщения</label>
        <textarea class="form-control" rows="5" id="exampleInput5"></textarea>
    </div>

    <div class="form-group capcha">
        <div class="img-captcha">
            <img id="yw3" src="img/capcha.png" alt="картинка капчі">
            <a id="yw2_button" href="#!">Получить новый код</a>
        </div>
        <label for="capcha7">Введите код</label>
        <input class="form-control" name="capcha7" id="capcha7" type="text">
    </div>

    <div class="text-center mt_25">
        <button class="btn btn-order" type="submit">Оставить отзыв</button>
    </div>
</form>