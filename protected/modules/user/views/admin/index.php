<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
$users=$model->search($searchBy);
$users->sort = array('defaultOrder'=>'id ASC');
$this->widget('GridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$users,
	'filter'=>$model,
    'showPublishBtn'=>false,
    'showPublishOffBtn'=>false,
    'showGridSearch'=>true,
	'columns'=>array(
		array(
            'header'=>'Имя пользователя',
			'value'=>'$data->profile["fullname"]',
		),
        array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
        array(
            'header'=>'Номер телефона',
            'value'=>'$data->profile["cell_phone"]',
        ),
		'lastvisit_at',
        array(
            'header'=>'IP',
            'name'=>'lastvisit_IP',
            'value'=>'CHtml::link($data->lastvisit_IP,"https://apps.db.ripe.net/search/query.html?searchtext={$data->lastvisit_IP}#resultsAnchor#resultsAnchor",array("target"=>"_blank"))',
            'type'=>'raw'
        ),
        array(
            'name'=>'amount',
            'value'=>'CHtml::textField("amount",
                $data->amount,
                array("data-saveUrl"=>Yii::app()->createUrl((isset(Yii::app()->controller->module)?Yii::app()->controller->module->id."/":"") . Yii::app()->controller->getId() . "/setAmount",
                array("id"=>$data->id)),"class"=>"jsAmount")
            )',
            'header'=>'Баланс',
            'type'=>'raw',
        ),
        array(
            'header'=>'Количество анкет',
            'value'=>'$count=$data->getFormsCount()?CHtml::link($data->getFormsCount(),array("/form/admin","Form[user_id]"=>$data->id)):"0"',
            'type'=>'raw',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
));

if($id):?>
    <script>$(document).ready(function(){selectFrom(<?=$id?>)});</script>
<?php endif;