<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property string $id
 * @property string $domain_alias
 * @property string $name_ru
 * @property string $name_pl
 * @property string $name_en
 * @property string $name_tr
 * @property string $name_de
 * @property string $name_fr
 * @property string $name_ua
 * @property string $name_es
 * @property int $use_for_search
 *
 * The followings are the available model relations:
 * @property Area[] $areas
 * @property Form[] $forms
 * @property Metro[] $metros
 */
class City extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
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
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('domain_alias,name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es, use_for_search', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, domain_alias, name_ru,name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es, use_for_search', 'safe', 'on'=>'search'),
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
			'areas' => array(self::HAS_MANY, 'Area', 'city_id'),
			'forms' => array(self::HAS_MANY, 'Form', 'city_id'),
			'metros' => array(self::HAS_MANY, 'Metro', 'city_id'),
		);
	}

    static function buildJSON(){
        $array = array();

        foreach(self::model()->findAll() as $city) {
            $array[$city->id]['subways']=array();
            foreach($city->metros as $subway) {
                $array[$city->id]['subways'][$subway->id]=$subway->name;
            }

            $array[$city->id]['areas']=array();
            foreach($city->areas as $area) {
                $array[$city->id]['areas'][$area->id]=$area->name;
            }
        }

        return $array;
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'domain_alias' => 'Domain alias',
			'name_ru' => 'City Name Ru',
			'name_pl' => 'City Name Pl',
			'name_en' => 'City Name En',
			'name_tr' => 'City Name Tr',
			'name_de' => 'City Name De',
			'name_fr' => 'City Name Fr',
			'name_ua' => 'City Name Ua',
			'name_es' => 'City Name Es',
			'use_for_search' => 'Use for search',
		);
	}

    function getList($addDefault=true){
        $cities=array();
        if($addDefault)
            $cities[0]='по умолчанию';
        foreach(City::model()->findAll() as $city){
            $cities[$city->id]=$city->name;
        }
        return $cities;
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('domain_alias',$this->domain_alias,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_ru',$this->name_pl,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_tr',$this->name_tr,true);
		$criteria->compare('name_de',$this->name_de,true);
		$criteria->compare('name_fr',$this->name_fr,true);
		$criteria->compare('name_ua',$this->name_ua,true);
		$criteria->compare('name_es',$this->name_es,true);
		$criteria->compare('use_for_search',$this->use_for_search,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}