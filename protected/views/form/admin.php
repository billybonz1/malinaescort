<?php
/* @var $this FormController */

$this->breadcrumbs=array(
	'Forms'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('form-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

echo CHtml::link("У " . $model->areClosed() . " анкет закончилась оплата",'#',array('id'=>'jsShowFormsAreClosed'));
echo CHtml::link("Все анкеты",'#',array('id'=>'jsShowAllForms','style'=>'display:none'));

$this->widget('GridView', array(
	'id'=>'form-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
    'summaryText'=>'',
    'showGridSearch'=>true,
	'columns'=>array(
		array(
            'name'=>'name_'.Language::getActive(),
            'value'=>'CHtml::link($data->name,array("/form/view","id"=>$data->id))',
            'type'=>'raw',
            'header'=>'Имя девушки'
        ),
        array(
            'header'=>'Пользователь',
            'value'=>'$data->user?CHtml::link($data->user->email,array("/user/admin","id"=>$data->user->id)):""',
            'type'=>'raw',
        ),
        array(
            'name'=>'city_id',
            'header'=>'Город',
            'value'=>'$data->city["name_'.Language::getActive().'"]',
            'type'=>'raw',
            'filter'=>City::model()->getList(false),
        ),

        'cell_phone',
        array(
            'name'=>'payed_till',
            'value'=>'"На " . $data->daysLeft() . " д."
                . CHtml::tag("br")
                . CHtml::button("Продлить на",array("class"=>"jsProlong","data-url"=>Yii::app()->createUrl((isset(Yii::app()->controller->module)?Yii::app()->controller->module->id."/":"") . Yii::app()->controller->getId() . "/prolong",array("id"=>$data->id))))
                . CHtml::textField("","30",array("class"=>"jsProlongValue","style"=>"width:20px","maxlength"=>3)) . " дней"',
            'header'=>'Оплачено',
            'type'=>'raw',
        ),
        array(
            'header'=>'Статус',
            'type'=>'raw',
            'value'=>'($data->isVip()?" Vip ":"").($data->no_photoshop_approved==1?" 100% ":"").($data->isNew()?" New ":"")'
        ),
        array(
            'header'=>'Изображения',
            'type'=>'raw',
            'value'=>'CHtml::link(count($data->images),array("admin/images?Image[form_id]=".$data->id))'
        ),
        array(
            'name'=>'published',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->published?"g":"x").".png")',
            'header'=>'Публикация',
            'type'=>'raw',
            'htmlOptions'=>array('width'=>'20px'),
        ),
		array('class'=>'CButtonColumn'),
	),
));

if($id):?>
    <script>$(document).ready(function(){selectFrom(<?=$id?>)});</script>
<?php endif;