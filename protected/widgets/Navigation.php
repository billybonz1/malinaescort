<?php
class Navigation extends CWidget
{
	public $items=array();
	
    public function init()
    {

    }

    public function run()
    {
    	if(!$this->items) return false;
        CWidget::render('NavigationBar', array('items'=>$this->items));
    }

}