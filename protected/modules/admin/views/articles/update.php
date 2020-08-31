<?php
/* @var $this ServiceController */
/* @var $model Service */

$this->breadcrumbs=array(
	'Articles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Articles', 'url'=>array('index')),
	array('label'=>'Create Articles', 'url'=>array('create')),
	array('label'=>'View Articles', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Articles', 'url'=>array('admin')),
);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/wysiwyg/wysiwyg.js');
$cs->registerScriptFile($baseUrl.'/js/wysiwyg/wysiwyg-editor.js');
$cs->registerCssFile($baseUrl.'/js/wysiwyg/wysiwyg-editor.css');

$arr = [];
foreach(Language::getList() as $l)
{
    array_push($arr, "#Service_description_{$l}");
}

?>
<script>
/*$(document).ready(function(){$('--><?//=implode(',',$arr)?>').wysiwyg(
		{
            toolbar: 'top-selection',
            buttons: {
                bold: {
                    title: 'Жирный (Ctrl+B)',
                    image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'b'
                },
                italic: {
                    title: 'Наклонить (Ctrl+I)',
                    image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'i'
                },
                underline: {
                    title: 'Подчеркнуть (Ctrl+U)',
                    image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'u'
                }
            }
		}
	)});*/i
</script>

<h1>Update Articles <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>