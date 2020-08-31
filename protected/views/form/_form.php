<?php
/* @var $this FormController */
/* @var $model Form */
/* @var $form CActiveForm */

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'form-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
));

echo $form->errorSummary($model);
$lang = Language::getActive(); ?>
<script src="<?=Yii::app()->request->baseUrl?>/js/Image.js" type="text/javascript"></script>
<div class="fileUploader">
    <div class="uploader">
        <span class="uploadify-button btn">
            <span class="uploadify-button-text">Загрузить фото</span>
            <input type="file" name="file_upload" id="jsFilesUpload" multiple>
        </span>
    </div>

    <div class="msg">
        <?=L::t('Please select one or more images for your form.')?>
    </div>
</div>

<div class="new_anket">
    <div class="photos-box box">
        <div class="container" id="jsUploadedImages" data-config='{"remove":"<?=L::t('Remove')?>"}' data-images='<?=json_encode($images)?>'>
            <div class="relax">&nbsp;</div>
        </div>
    </div>
    <div class="price-box box">
        <div class="container">
            <div class="form-box">
                <div class="row title">
                    <div class="col first"><?=L::t('Price')?></div>
                    <div class="col"><?=L::t('Price Hour')?></div>
                    <div class="col"><?=L::t('Price Two')?></div>
                    <div class="col"><?=L::t('Price Night')?></div>
                </div>
                <div class="row">
                    <div class="col first"><label for="price1"><?=L::t('Apartments')?></label></div>
                    <div class="col">
                        <?php echo $form->textField($model,'price_hour',array('size'=>5,'maxlength'=>5, 'class'=>'text'));?>
                        <?php echo $form->error($model,'price_hour'); ?>
                        <span class="labelprice"><?=L::t('UAH')?></span>
                    </div>
                    <div class="col">
                        <?=$form->textField($model,'price_two_hour',array('size'=>5,'maxlength'=>5, 'class'=>'text'));?>
                        <?=$form->error($model,'price_two_hour'); ?>
                        <span class="labelprice"><?=L::t('UAH')?></span>
                    </div>
                    <div class="col">
                        <?=$form->textField($model,'price_night',array('size'=>5,'maxlength'=>5, 'class'=>'text'));?>
                        <?=$form->error($model,'price_night'); ?>
                        <span class="labelprice"><?=L::t('UAH')?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col first"><label for="price4"><?=L::t('Departure')?></label></div>
                    <div class="col">
                        <?=$form->textField($model,'price_per_hour_exit',array('size'=>5,'maxlength'=>5, 'class'=>'text'));?>
                        <?=$form->error($model,'price_per_hour_exit'); ?>
                        <span class="labelprice"><?=L::t('UAH')?></span>
                    </div>
                    <div class="col">
                        <?=$form->textField($model,'price_two_hour_exit',array('size'=>5,'maxlength'=>5, 'class'=>'text'));?>
                        <?=$form->error($model,'price_two_hour_exit'); ?>
                        <span class="labelprice"><?=L::t('UAH')?></span>
                    </div>
                    <div class="col">
                        <?=$form->textField($model,'price_night_exit',array('size'=>5,'maxlength'=>5, 'class'=>'text'));?>
                        <?=$form->error($model,'price_night_exit'); ?>
                        <span class="labelprice"><?=L::t('UAH')?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col first"><?=$form->labelEx($model,'price_anal_exit'); ?>&nbsp;</div>
                    <?=$form->textField($model,'price_anal_exit',array('size'=>5,'maxlength'=>5,'class'=>'text')); ?><span class="labelprice"><?=L::t('UAH')?> (<?=L::t('if there is')?>)</span>
                    <?=$form->error($model,'price_anal_exit'); ?>
                </div>
                <div class="price-for-mood">
                    <?=$form->checkBox($model,'mood_prices'); ?>
                    <?=$form->labelEx($model,'mood_prices'); ?>
                    <?=$form->error($model,'mood_prices'); ?>
                </div>
            </div>
            <div class="relax">&nbsp;</div>
        </div>
    </div>
    <div class="relax">&nbsp;</div>
    <div class="param-girl box-bg">
        <div class="form-box">
            <div class="row">
                <?=$form->labelEx($model,"name_{$lang}"); ?>
                <?=$form->textField($model,"name_{$lang}",array('size'=>60,'maxlength'=>100,'class'=>'text')); ?>
                <?=$form->error($model,"name_{$lang}"); ?>
            </div>
            <div class="row">
                <?=$form->labelEx($model,"name_en"); ?>
                <?=$form->textField($model,"name_en",array('size'=>60,'maxlength'=>100,'class'=>'text')); ?>
                <?=$form->error($model,"name_en"); ?>
            </div>
            <div class="row">
                <?=$form->labelEx($model,'age'); ?>
                <?=CHtml::dropDownList('Form[age]',$model->age,array_combine(range(18,58), range(18,58)))?>
                <?=$form->error($model,'age'); ?>
            </div>
            <div class="row">
                <?=$form->labelEx($model,'rise'); ?>
                <?=CHtml::dropDownList('Form[rise]',$model->rise,array_combine(range(150,205), range(150,205)))?>
                <?=$form->error($model,'rise'); ?>
            </div>
            <div class="row">
                <?=$form->labelEx($model,'weight'); ?>
                <?=CHtml::dropDownList('Form[weight]',$model->weight,array_combine(range(41,100), range(41,100)))?>
                <?=$form->error($model,'weight'); ?>
            </div>
            <div class="row">
                <?=$form->labelEx($model,'breast'); ?>
                <?=CHtml::dropDownList('Form[breast]',$model->breast,array_combine(range(1,7), range(1,7)))?>
                <?=$form->error($model,'breast'); ?>
            </div>
            <div class="row">
                <?=$form->labelEx($model,'Hair'); ?>
                <?=CHtml::dropDownList('Form[hair]',$model->hair,array_map((function($el){return L::t($el);}),Yii::app()->params['hairs']))?>
                <?=$form->error($model,'hair'); ?>
            </div>
            <div class="row">
                <input type="hidden" value="5" name="Form[city_id]">
            </div>

            <div class="row">
                <label for="JSAreaList"><?=Yii::t('lang', 'Area:');?></label>
                <select name="Form[area_id]" id="JSAreaList">
                    <option value="0">-</option>
                    <?php
                    foreach(Area::model()->findAll('city_id=5') as $value)
                    {
                        echo "<option value='$value->id'>".$value->name."</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="row">
                <label for="JSSubwayList"><?=Yii::t('lang', 'Metro:');?></label>
                <select name="Form[metro_id]" id="JSSubwayList"><option value="0">-</option></select>
            </div>


            <script>initLocation(<?=$model->city_id?>,<?=$model->area_id?>,<?=$model->metro_id?>)</script>

            <div class="row">
                <?=$form->labelEx($model,'cell_phone'); ?>
                <?=$form->textField($model,'cell_phone',array('size'=>13,'maxlength'=>13,'class'=>'text')); ?>
                <?=$form->error($model,'cell_phone'); ?>
            </div>
            <div class="row ckeck-box">
                <?=$form->labelEx($model,'speak_english'); ?>
				<?=$form->checkBox($model,'speak_english',array('id'=>'speakEnglish')); ?>
            </div>
            <div class="relax">&nbsp;</div>
        </div>
    </div>
    <div class="services-girl box-bg">
        <div class="form-box">
            <?php foreach($serviceCategories as $num=>$cat): ?>
                <div class="col<?=!(++$num%3)?' last':''?>">
                    <h6><?=$cat->name?></h6>
                    <?php foreach($cat->services as $servNum => $service): ?>
                        <div class="row<?=$servNum>4?' hidden':''?>">
                            <?=CHtml::checkBox("Form[services][]", in_array($service->id, $formServices),
                                    array('value'=>$service->id,'id'=>"Form[services][{$service->id}]"));?>
                            <?=CHtml::label($service->name, "Form[services][{$service->id}]")?>
                        </div>
                        <?php if($servNum==4 && count($cat->services)>5): ?>
                            <div class="row"><a class="more-link" href="#"><?=L::t('More »')?></a></div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <?=!($num%3)?CHtml::tag('div',array('class'=>'relax'),'&nbsp;'):'';?>
            <?php endforeach;?>
        </div>
    </div>
    <div class="relax">&nbsp;</div>
    <div class="yourself-info box">
        <div class="col">
            <?=$form->labelEx($model,"about_{$lang}"); ?><br/>
            <?=$form->textArea($model,"about_{$lang}",array('rows'=>6, 'cols'=>50)); ?>
            <?=$form->error($model,"about_{$lang}"); ?>
        </div>
        <div class="col right">
            <?=$form->labelEx($model,"about_en"); ?><br/>
            <?=L::t('You can translate the text on translate.google.com')?>
            <?=$form->textArea($model,"about_en",array('rows'=>6, 'cols'=>50)); ?>
            <?=$form->error($model,"about_en"); ?>
        </div>
        <div class="col">
            <?=$form->labelEx($model,"about_tr"); ?><br/>
            <?=$form->textArea($model,"about_tr",array('rows'=>6, 'cols'=>50)); ?>
            <?=$form->error($model,"about_tr"); ?>
        </div>
        <div class="relax">&nbsp;</div>
    </div>
    <div class="real-photo box-bg">
    	<div class="new-photo">
    		<div class="item">
				<div class="photo">
                    <?=CHtml::image($model->getEvidenceThumb());?>
				</div>
                <div class="btn"><?=L::t('Upload').$form->fileField($model,'evidence_photo'); ?></div>
			</div>
    	</div>
        <div class="left-col">
            <?=C::i('real_photo')?>
            <?=$form->error($model,'evidence_photo'); ?>
            <?php if($model->no_photoshop_approved==-1):?>
                <strong class="red"><?=L::t('This photo has been declined. Please upload other one. From more info please contact administrator.')?></strong>
            <?php elseif($model->no_photoshop_approved==0): ?>
                <strong><?=L::t('This photo is to be verified.')?></strong>
            <?php endif; ?>
            <?php if($model->evidence_photo): ?>
                <div id="evidence_photo">
                    <?=CHtml::image($model->getEvidence());?>
                </div>
            <?php endif; ?>
        </div>
        <div class="right-col">
            <h6><?=L::t('Photo sample for checking')?></h6>
            <?=CHtml::image(Yii::app()->request->baseUrl.'/style/images/pictures/example-photo-1.jpg','',array('class'=>'photoDemo'));?>
        </div>
        <div class="relax">&nbsp;</div>
    </div>
    <div class="add-box">
   		<button type="submit" class="btn large"><span><?=$model->id?L::t('Save'):L::t('Add form')?></span></button>
    </div>
</div>
<?php $this->endWidget(); ?>
