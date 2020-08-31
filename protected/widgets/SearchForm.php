<?php
class SearchForm extends CWidget
{
	public $hideSearchBar=true;
	
    public function init()
    {

    }

    public function run()
    {
        $cities = City::model()->findAll();
        $metros = Metro::model()->findAll();
        $areas = Area::model()->findAll();
        CWidget::render('SearchForm', array(
            'serviceCategories'=>ServiceCategory::model()->findAll('published=1'),
            'cities'=>$this->prepareArray($cities),
            'metros'=>$this->prepareArray($metros),
            'areas'=>$this->prepareArray($areas),
            'hideSearchBar'=>$this->hideSearchBar,
        ));
    }

    private function prepareArray($arr){
        $result = array(0=>L::t("Doesn't mater"));
        foreach($arr as $el){
            $result[$el->id]=$el->name;
        }
        return $result;
    }
}