<?php

/**
 * This is the model class for table "service_category".
 *
 * The followings are the available columns in table 'service_category':
 * @property string $id
 * @property string $name_ru
 * @property string $name_pl
 * @property string $name_en
 * @property string $name_tr
 * @property string $name_de
 * @property string $name_fr
 * @property string $name_ua
 * @property string $name_es
 * @property integer $published
 *
 * The followings are the available model relations:
 * @property Service[] $services
 */
class ServiceCategory extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceCategory the static model class
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
		return 'service_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('published', 'numerical', 'integerOnly'=>true),
			array('name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es, published', 'safe', 'on'=>'search'),
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
			'services' => array(self::HAS_MANY, 'Service', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name_ru' => 'Service category Name Ru',
			'name_pl' => 'Service category Name Pl',
			'name_en' => 'Service category Name En',
			'name_tr' => 'Service category Name Tr',
			'name_de' => 'Service category Name De',
			'name_fr' => 'Service category Name Fr',
			'name_ua' => 'Service category Name Ua',
			'name_es' => 'Service category Name Es',
			'published' => 'Published',
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
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_pl',$this->name_pl,true);
		$criteria->compare('name_en',$this->name_en,true);
		$criteria->compare('name_tr',$this->name_tr,true);
		$criteria->compare('name_de',$this->name_de,true);
		$criteria->compare('name_fr',$this->name_fr,true);
		$criteria->compare('name_ua',$this->name_ua,true);
		$criteria->compare('name_es',$this->name_es,true);
		$criteria->compare('published',$this->published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}