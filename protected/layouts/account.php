<?php 
	$this->beginContent('//layouts/main');
	$this->widget('AccountHeader');
	$this->widget('Navigation',array('items'=>$this->menu));
	echo $content;
	$this->endContent(); 