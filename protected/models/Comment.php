<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property string $name
 * @property string $text
 * @property integer $status
 * @property integer $isviewed
 * @property string $added
 * @property string $form_id
 * @property string $ip
 */
class Comment extends BaseModel
{
	public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_id,name,text', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'min'=>3),
			array('text', 'length', 'min'=>20),
			array('name, text, added', 'safe'),
            array('text','filter','filter'=>'strip_tags'),
            array('status','default', 'value' => '0'),
			array('added','default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			array('ip','default', 'value' => Location::getIP(), 'setOnEmpty' => true, 'on' => 'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, text, status, added, form_id,ip,isviewed', 'safe', 'on'=>'search'),
			array('verifyCode', 'captcha', 'allowEmpty'=>(!CCaptcha::checkRequirements()||UserModule::isAdmin())),
		);
	}

    public static function itemAlias($type,$code=NULL) {
        $_items = array(
            'status' => array(
                '1' => L::t('Approved'),
                '0' => L::t('Not approved'),
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'form' => array(self::BELONGS_TO, 'Form', 'form_id'),
		);
	}

    public function afterSave(){
        M::s($this->form->user->email,
            "К Вашей анкете добавлен комментарий",
            "К Вашей анкете ".CHtml::link("#".$this->form->id,$this->form->generateURL(),array('target'=>'_blank'))." был доавлен комментарий<br/><strong>Текст сообщения:</strong><br/>{$this->text}");
        return parent::afterSave();
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Your name',
			'text' => 'Message text',
			'status' => 'Status',
			'added' => 'Added',
			'form_id' => 'Form',
			'isviewed' => 'Is viewed',
			'ip' => 'User IP',
		);
	}

    static function getNotViewedCount(){
        return Comment::model()->countByAttributes(array('isviewed'=>0));
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($searchBy='')
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

        if($searchBy)
            $criteria->condition="id LIKE '%{$searchBy}%' OR name LIKE '%{$searchBy}%' OR text LIKE '%{$searchBy}%' OR added LIKE '%{$searchBy}%' OR ip LIKE '%{$searchBy}%'";

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('form_id',$this->form_id,true);
		$criteria->compare('isviewed',$this->isviewed,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id DESC',
            )
        ));
	}
}