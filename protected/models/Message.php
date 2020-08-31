<?php

/**
 * This is the model class for table "message".
 *
 * The followings are the available columns in table 'message':
 * @property integer $id
 * @property string $title
 * @property string $massage
 * @property integer $sender
 * @property integer $recipient
 * @property string $added
 * @property integer $isopened
 * @property integer $isremoved
 */
class Message extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Message the static model class
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
		return 'message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isopened, isremoved', 'numerical', 'integerOnly'=>true),
			array('sender, recipient', 'length', 'max'=>10),
			array('massage, added', 'safe'),
			array('massage,title', 'required'),
            array('added','default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, massage, sender, recipient, added, isopened, isremoved', 'safe', 'on'=>'search'),
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
            'fromUser' => array(self::BELONGS_TO, 'User', 'sender'),
            'toUser' => array(self::BELONGS_TO, 'User', 'recipient'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'massage' => 'Massage',
			'title' => 'Message title',
			'sender' => 'From',
			'recipient' => 'To',
			'added' => 'Added',
			'isopened' => 'Isopened',
			'isremoved' => 'Isremoved',
		);
	}

    public function beforeSave(){
        if(!parent::beforeSave())
            return false;

        if(!$this->sender)
            $this->sender=U::id();

        if(!$this->recipient)
            $this->recipient=1;

        return true;
    }

    public function afterSave(){
        if($this->recipient == 1){
            $message="Поступило новое сообщение. Для более детальной информации перейдите "
                . CHtml::link('по ссылке', YII::app()->controller->createAbsoluteUrl('/message/view',array('id'=>$this->id)));
            M::s(Yii::app()->params['adminEmail'],"Новое сообщение",$message);
        }
        return parent::afterSave();
    }

    static public function getMyMessagesCount(){
        return Message::model()->countByAttributes(array("recipient"=>U::id(),'isopened'=>0));
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
            $criteria->condition="id LIKE '%{$searchBy}%' "
                . "OR title LIKE '%{$searchBy}%'"
                . "OR massage LIKE '%{$searchBy}%'";

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('massage',$this->massage,true);
        if($this->sender)
		    $criteria->compare('sender',$this->sender);
        if($this->recipient)
		    $criteria->compare('recipient',$this->recipient);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('isopened',$this->isopened);
		$criteria->compare('isremoved',$this->isremoved);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}