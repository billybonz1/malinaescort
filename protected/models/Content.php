<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property string $id
 * @property string $name
 * @property string $text_ru
 * @property string $text_en
 * @property string $text_tr
 * @property string $text_de
 * @property string $text_fr
 * @property string $text_ua
 * @property string $text_pl
 * @property string $text_es
 * @property integer $city_id
 * @property integer $published
 */
class Content extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
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
		return 'content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, published', 'required'),
			array('published,city_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>45),
			array('text_ru, text_en, text_tr, text_de, text_fr, text_ua, text_pl, text_es, city_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, text_ru, text_en, text_tr, text_de, text_fr, text_ua, text_pl, text_es, city_id, published', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'text_ru' => 'Text Ru',
			'text_en' => 'Text En',
			'text_tr' => 'Text Tr',
			'text_de' => 'Text De',
			'text_fr' => 'Text Fr',
			'text_ua' => 'Text Ua',
			'text_pl' => 'Text Pl',
			'text_es' => 'Text Es',
			'city_id' => 'City',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('text_ru',$this->text_ru,true);
		$criteria->compare('text_en',$this->text_en,true);
		$criteria->compare('text_tr',$this->text_tr,true);
		$criteria->compare('text_de',$this->text_de,true);
		$criteria->compare('text_fr',$this->text_fr,true);
		$criteria->compare('text_ua',$this->text_ua,true);
		$criteria->compare('text_pl',$this->text_pl,true);
		$criteria->compare('text_es',$this->text_es,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('published',$this->published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}