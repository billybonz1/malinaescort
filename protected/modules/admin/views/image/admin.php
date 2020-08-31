<?php
$dp=$model->search();
$dp->sort = array('defaultOrder'=>'added DESC');

$this->widget('GridView', array(
	'id'=>'image-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
    'showCreateBtn'=>false,
	'columns'=>array(
        array(
            'name'=>'src',
            'type'=>'raw',
            'value'=>'CHtml::image($data->getThumbImageSrc())',
        ),
        array(
            'name'=>'form_id',
            'type'=>'raw',
            'value'=>'CHtml::link($data->form["name"],array("/form/admin","id"=>$data->form["id"]))'
        ),
		'added',
		array(
            'name'=>'published',
            'type'=>'raw',
            'header'=>'Публикация',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->published?"g":"x").".png")',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
));