<?php
/* @var $this CommentController */
/* @var $model Comment */


$this->widget('GridView', array(
	'id'=>'comment-grid',
	'dataProvider'=>$model->search($searchBy),
	'filter'=>$model,
    'showCreateBtn'=>false,
    'showGridSearch'=>true,
	'columns'=>array(
        array(
            'name'=>'text',
            'htmlOptions'=>array('width'=>'300px'),
        ),
        array(
            'name'=>'name',
            'value'=>'$data->name."<br/>".CHtml::link($data->ip,"https://apps.db.ripe.net/search/query.html?searchtext={$data->ip}#resultsAnchor",array("target"=>"_blank"))',
            'type'=>'raw',
            'header'=>L::t('User name / IP')
        ),
        array(
            'value'=>'CHtml::link($data->form["name_ru"]." ID".$data->form["id"],array("/form/view","id"=>$data->form["id"]),array("target"=>"_blank"))',
            'type'=>'raw',
            'header'=>'Form name'
        ),
        array(
            'name'=>'added',
            'value'=>'"<div class=\'dataValue\'>".$data->added."</div>"',
            'type'=>'raw',
            'header'=>'Added',
        ),
        array(
            'name'=>'isviewed',
            'type'=>'raw',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->isviewed?"g":"x").".png")',
            'htmlOptions'=>array('width'=>'30px'),
            'header'=>'Просмотрено',
        ),
		array(
            'name'=>'status',
            'type'=>'raw',
            'value'=>'CHtml::image(Yii::app()->request->baseUrl."/style/images/icons/publish_".($data->status?"g":"x").".png")',
            'filter'=>Comment::itemAlias("status"),
            'htmlOptions'=>array('width'=>'30px'),
            'header'=>'Одобренно',
        ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
