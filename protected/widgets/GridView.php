<?php

Yii::import('zii.widgets.grid.CGridView');

class GridView extends CGridView{
    var $showRemoveBtn=true;
    var $showPublishBtn=true;
    var $showPublishOffBtn=true;
    var $showCreateBtn=true;
    var $showGridSearch=false;

    function init() {
        $this->cssFile=Yii::app()->request->baseUrl.'/style/gridview/styles.css';

        $this->dataProvider->pagination=array('pageSize'=>100);

        $this->selectableRows=2;
        array_unshift($this->columns,
            array(
                'name'=>'id',
                'htmlOptions'=>array('width'=>'20px'),
            ),
            array(
                'id'=>'selectedItems',
                'class'=>'CCheckBoxColumn',
            ));
        $this->summaryText='';
        parent::init();
    }
    function renderItems(){
        $path = (isset(Yii::app()->controller->module)?Yii::app()->controller->module->id."/":'') . Yii::app()->controller->getId();


        echo CHtml::openTag('div', array('id'=>'navigationBar'));
        if($this->showGridSearch)
            echo CHtml::label('Поиск: ', 'search') . CHtml::textField('search',isset($_GET['searchBy'])?$_GET['searchBy']:'',array('id'=>'jsGridSearch','data-url'=>Yii::app()->createUrl($path.'/admin')));

        if($this->showCreateBtn)
            echo CHtml::button(L::t('Create'),array('id'=>'jsGridCreate','data-url'=>Yii::app()->createUrl($path.'/create')));
        if($this->showPublishBtn)
            echo CHtml::button(L::t('Publish selected'),array('id'=>'jsGri  dPublishSelected','data-url'=>Yii::app()->createUrl($path.'/publishUp')));
        if($this->showPublishOffBtn)
            echo CHtml::button(L::t('Unpublish selected'),array('id'=>'jsGridUnpublishSelected','data-url'=>Yii::app()->createUrl($path.'/publishOff')));
        if($this->showRemoveBtn)
            echo CHtml::button(L::t('Delete selected'),array('id'=>'jsGridDeleteSelected','data-url'=>
            Yii::app()->createUrl($path.'/delete')));

        echo CHtml::closeTag('div');

        $approveMsg=L::t('Are you sure?');

        Yii::app()->clientScript->registerScript('Grid', "
                $('#jsGridCreate').live('click',function(){
                    window.location=$(this).data('url');
                });

                $(document).live('keydown',function(e) {
                    if (e.keyCode == 13 && $('#jsGridSearch').is(':focus')) {
                        var ajaxRequest = $('#jsGridSearch').data('url')+'?searchBy='+$('#jsGridSearch').val();
                        $.fn.yiiGridView.update('{$this->id}',{data: ajaxRequest});
                    }
                });

                $('#navigationBar').find('input[type=button]').live('click',function(){
                    var list = $('.select-on-check:checked').map(function(){return $(this).val();}).get();

                    if(!list.length) return false;

                    if(confirm('{$approveMsg}')){
                        $.fn.yiiGridView.update('{$this->id}',{url:$(this).data('url'), data: 'id='+list});
                    }
                })
            ");
        parent::renderItems();
    }
}