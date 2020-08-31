<?php
/* @var $this ImageController */
/* @var $model Image */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'image-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'form_id'); ?>
		<?php echo $form->textField($model,'form_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'form_id'); ?>
	</div>

    <div id="jsImageEditor" class="imageEditor" style="display: block; overflow: scroll"><?=CHtml::image($model->getImageSrc('original'));?></div>
    <?php
        echo CHtml::hiddenField('Image[x1]','',array('id'=>'x1'))
            . CHtml::hiddenField('Image[y1]','',array('id'=>'y1'))
            . CHtml::hiddenField('Image[x2]','',array('id'=>'x2'))
            . CHtml::hiddenField('Image[y2]','',array('id'=>'y2'))
            . CHtml::hiddenField('Image[w]','',array('id'=>'w'))
            . CHtml::hiddenField('Image[h]','',array('id'=>'h'));

        foreach($model->sizes as $size){
            echo $size['w'].'x'.$size['h']
            . CHtml::tag('br')
            . CHtml::image($model->getImageSrc($size['w'].'x'.$size['h']))
            . CHtml::tag('br');
        }
    ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    $(document).ready(function(){initEditor()});
</script>