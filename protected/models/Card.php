<?php

/**
 * This is the model class for table "card".
 *
 * The followings are the available columns in table 'card':
 * @property string $id
 * @property string $number
 * @property string $password
 * @property string $check
 * @property integer $value
 * @property string $comment
 * @property integer $approved
 * @property string $decline_reson
 * @property string $payment_request_id
 *
 * The followings are the available model relations:
 * @property PaymentRequest $paymentRequest
 */
class Card extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Card the static model class
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
		return 'card';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('payment_request_id', 'required'),
			array('value, approved', 'numerical', 'integerOnly'=>true),
			array('number, password, check', 'length'),
			array('payment_request_id', 'length', 'max'=>10),
			array('comment, decline_reson', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, number, password, check, value, comment, approved, decline_reson, payment_request_id', 'safe', 'on'=>'search'),
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
			'paymentRequest' => array(self::BELONGS_TO, 'PaymentRequest', 'payment_request_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'number' => 'Number',
			'password' => 'Password',
			'check' => 'Check',
			'value' => 'Value',
			'comment' => 'Comment',
			'approved' => 'Approved',
			'decline_reson' => 'Decline Reson',
			'payment_request_id' => 'Payment Request',
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
		$criteria->compare('number',$this->number,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('check',$this->check,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('approved',$this->approved);
		$criteria->compare('decline_reson',$this->decline_reson,true);
		$criteria->compare('payment_request_id',$this->payment_request_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getNotApprovedCount() {
        return self::model()->count('approved=0');
    }
}