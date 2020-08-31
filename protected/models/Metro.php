<?php

/**
 * This is the model class for table "metro".
 *
 * The followings are the available columns in table 'metro':
 * @property string $id
 * @property string $city_id
 * @property string $name_ru
 * @property string $name_pl
 * @property string $name_en
 * @property string $name_tr
 * @property string $name_de
 * @property string $name_fr
 * @property string $name_ua
 * @property string $name_es
 * @property string $last_hit
 *
 * The followings are the available model relations:
 * @property Form[] $forms
 * @property City $city
 */
class Metro extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Metro the static model class
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
		return 'metro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('city_id', 'required'),
			array('city_id', 'length', 'max'=>10),
			array('name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, city_id, name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es, last_hit', 'safe', 'on'=>'search'),
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
			'forms' => array(self::HAS_MANY, 'Form', 'metro_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'city_id' => 'City',
			'name_ru' => 'Metro Name',
			'name_pl' => 'Metro Name',
			'name_en' => 'Metro Name',
			'name_tr' => 'Metro Name',
			'name_de' => 'Metro Name',
			'name_fr' => 'Metro Name',
			'name_ua' => 'Metro Name',
			'name_es' => 'Metro Name',
			'last_hit' => 'Last Hit',
		);
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
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_pl',$this->name_pl,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_tr',$this->name_tr,true);
		$criteria->compare('name_de',$this->name_de,true);
		$criteria->compare('name_fr',$this->name_fr,true);
		$criteria->compare('name_ua',$this->name_ua,true);
		$criteria->compare('name_es',$this->name_es,true);
		$criteria->compare('last_hit',$this->last_hit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}