<?php

/**
 * This is the model class for table "service".
 *
 * The followings are the available columns in table 'service':
 * @property string $id
 * @property string $category_id
 * @property string $name_ru
 * @property string $name_pl
 * @property string $name_en
 * @property string $name_tr
 * @property string $name_de
 * @property string $name_fr
 * @property string $name_ua
 * @property string $name_es
 *
 * @property string $description_ru
 * @property string $description_pl
 * @property string $description_en
 * @property string $description_tr
 * @property string $description_de
 * @property string $description_fr
 * @property string $description_ua
 * @property string $description_es
 *
 * @property integer $published
 *
 * The followings are the available model relations:
 * @property FormService[] $formServices
 * @property ServiceCategory $category
 */
class Service extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Service the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'service';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id', 'required'),
			array('published', 'numerical', 'integerOnly'=>true),
			array('category_id', 'length', 'max'=>10),
			array('name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es', 'length', 'max'=>100),
			array('meta_keywords_ru,meta_keywords_pl,meta_keywords_en,meta_keywords_tr,meta_keywords_de,meta_keywords_fr,meta_keywords_ua,meta_keywords_es, meta_description_ru, meta_description_pl, meta_description_en, meta_description_tr, meta_description_de, meta_description_fr, meta_description_ua, meta_description_es, description_ru,	description_pl, description_en, description_tr, description_de, description_fr, description_ua, description_es', 'length', 'max'=>10000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es, description_ru,	description_pl, description_en, description_tr, description_de, description_fr, description_ua, description_es,meta_keywords_ru,meta_keywords_pl,meta_keywords_en,meta_keywords_tr,meta_keywords_de,meta_keywords_fr,meta_keywords_ua,meta_keywords_es, meta_description_ru, meta_description_pl, meta_description_en, meta_description_tr, meta_description_de, meta_description_fr, meta_description_ua, meta_description_es, published', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'formServices' => array(self::HAS_MANY, 'FormService', 'service_id'),
			'category' => array(self::BELONGS_TO, 'ServiceCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'name_ru' => 'Service Name Ru',
			'name_en' => 'Service Name En',
			'name_pl' => 'Service Name Pl',
			'name_tr' => 'Service Name Tr',
			'name_de' => 'Service Name De',
			'name_fr' => 'Service Name Fr',
			'name_ua' => 'Service Name Ua',
			'name_es' => 'Service Name Es',
			'description_ru' => 'Service Description Ru',
			'description_en' => 'Service Description En',
			'description_pl' => 'Service Description Pl',
			'description_tr' => 'Service Description Tr',
			'description_de' => 'Service Description De',
			'description_fr' => 'Service Description Fr',
			'description_ua' => 'Service Description Ua',
			'description_es' => 'Service Description Es',

			'meta_keywords_ru'=> 'meta keywords ru',
			'meta_keywords_pl'=> 'meta keywords pl',
			'meta_keywords_en'=> 'meta keywords en',
			'meta_keywords_tr'=> 'meta keywords tr',
			'meta_keywords_de'=> 'meta keywords de',
			'meta_keywords_fr'=> 'meta keywords fr',
			'meta_keywords_ua'=> 'meta keywords Ua',
			'meta_keywords_es'=> 'meta keywords es',

			'meta_description_ru'=> 'meta description ru',
			'meta_description_pl'=> 'meta description pl',
			'meta_description_en'=> 'meta description en',
			'meta_description_tr'=> 'meta description tr',
			'meta_description_de'=> 'meta description de',
			'meta_description_fr'=> 'meta description fr',
			'meta_description_ua'=> 'meta description Ua',
			'meta_description_es'=> 'meta description es',

			'published' => 'Published',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
    public static function  getServiceID($name)
    {
        $criteria=new CDbCriteria();
        $criteria->condition = 'name_en = :nameEn';
        $criteria->params = array(':nameEn'=>$name);
        $serviceid = self::model()->find($criteria);

        return $serviceid->id;
    }
    public static function getTitleid($service)
    {
        $id=$_GET['service'];
        $id=$id[0];
        $criteria=new CDbCriteria();
        $criteria->condition = 'id = :di';
        $criteria->params = array(':di'=>$id);
        $servicename = self::model()->find($criteria);
        return $servicename->name;
    }
    public static function getIdSeoName($service)
    {
        $seo_name=$service;

        $criteria=new CDbCriteria();
        $criteria->condition = 'seo_name = :name_seo';
        $criteria->params = array(':name_seo'=>$seo_name);
        $servicename = self::model()->find($criteria);
        return $servicename->id;
    }
    public function generateServiceURL(){
        return YII::app()->controller->createAbsoluteUrl('site/index',array('service'=>$this->seo_name));
    }
    public function getServiceAll()
    {
        return self::model()->findAll();
    }

	public function getLink()
	{
		$lang = Language::getActive();
		$r = strtolower(YII::app()->controller->createAbsoluteUrl('/site/viewService',array('id'=>$this->id,'title'=>preg_replace("/[^a-zA-Z0-9\+]/", '_',$this->name_en))));
		if($lang != 'ru'){
            if(!strpos($_SERVER['SERVER_NAME'],$lang)){
              $r = str_replace($_SERVER['SERVER_NAME'], $_SERVER['SERVER_NAME'].'/'.$lang,  $r);
            }
        }
        $r = str_replace('tr/tr','tr',str_replace('en/en','en',$r));
		 return $r;
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_pl',$this->name_pl,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_tr',$this->name_tr,true);
		$criteria->compare('name_de',$this->name_de,true);
		$criteria->compare('name_fr',$this->name_fr,true);
		$criteria->compare('name_ua',$this->name_ua,true);
		$criteria->compare('name_es',$this->name_es,true);

		$criteria->compare('description_ru',$this->description_ru,true);
		$criteria->compare('description_pl',$this->description_pl,true);
		$criteria->compare('description_en',$this->description_en,true);
		$criteria->compare('description_tr',$this->description_tr,true);
		$criteria->compare('description_de',$this->description_de,true);
		$criteria->compare('description_fr',$this->description_fr,true);
		$criteria->compare('description_ua',$this->description_ua,true);
		$criteria->compare('description_es',$this->description_es,true);

		$criteria->compare('meta_description_ru',$this->meta_description_ru,true);
		$criteria->compare('meta_description_pl',$this->meta_description_pl,true);
		$criteria->compare('meta_description_en',$this->meta_description_en,true);
		$criteria->compare('meta_description_tr',$this->meta_description_tr,true);
		$criteria->compare('meta_description_de',$this->meta_description_de,true);
		$criteria->compare('meta_description_fr',$this->meta_description_fr,true);
		$criteria->compare('meta_description_ua',$this->meta_description_ua,true);
		$criteria->compare('meta_description_es',$this->meta_description_es,true);

		$criteria->compare('meta_keywords_ru',$this->meta_keywords_ru,true);
		$criteria->compare('meta_keywords_pl',$this->meta_keywords_pl,true);
		$criteria->compare('meta_keywords_en',$this->meta_keywords_en,true);
		$criteria->compare('meta_keywords_tr',$this->meta_keywords_tr,true);
		$criteria->compare('meta_keywords_de',$this->meta_keywords_de,true);
		$criteria->compare('meta_keywords_fr',$this->meta_keywords_fr,true);
		$criteria->compare('meta_keywords_ua',$this->meta_keywords_ua,true);
		$criteria->compare('meta_keywords_es',$this->meta_keywords_es,true);

		$criteria->compare('published',$this->published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}