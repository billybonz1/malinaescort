<?php

/**
 * This is the model class for table "payment_request".
 *
 * The followings are the available columns in table 'payment_request':
 * @property string $id
 * @property integer $user_id
 * @property string $date
 * @property integer $value
 * @property string $payment_type
 *
 * The followings are the available model relations:
 * @property Card[] $cards
 * @property Users $user
 */
class PaymentRequest extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PaymentRequest the static model class
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
		return 'payment_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, value', 'numerical', 'integerOnly'=>true),
			array('user_id', 'default', 'value'=>U::id()),
			array('payment_type', 'length', 'max'=>50),
			array('date','default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, date, value, payment_type', 'safe', 'on'=>'search'),
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
			'cards' => array(self::HAS_MANY, 'Card', 'payment_request_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'date' => 'Added',
			'value' => 'Value',
			'payment_type' => 'Payment Type',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('value',$this->value);
		$criteria->compare('payment_type',$this->payment_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    function beforeSave(){
        if($this->payment_type!='webmoney') {
            try{
                $this->validateCards($cards = $_REQUEST['card']);
                $this->value = $this->getRequestTotalValue($cards);
            }
            catch(Exception $e) {
                $this->addError('webmoney_cards', L::t( $e->getMessage()));
                return false;
            }
        }
        // Send mail to Admin
        return parent::beforeSave();
    }

    function afterSave() {
        if($this->payment_type!='webmoney') {
            $cards = $_REQUEST['card'];
            $this->saveCards($cards);
        }
        return parent::afterSave();
    }
    private function getRequestTotalValue($cards){
        return array_sum($cards['value']);
    }
    private function saveCards($cards){
        $paymentRequestID = $this->id;
        for($i=0; $i<count($cards['value']); $i++) {
            $card=new Card();
            $card->payment_request_id=$paymentRequestID;
            $card->value=abs(intval($cards['value'][$i]));
            $card->password=$cards['password'][$i];
            $card->number=$cards['number'][$i];
            $card->check=isset($cards['check_value'])?$cards['check_value'][$i]:'';
            $card->save();
        }
        return true;
    }

    function cardsCount($status){
        return Card::model()->count("payment_request_id={$this->id} AND approved={$status}");
    }

    private function validateCards($cards) {
        foreach($cards['value'] as $num => $val) {
            if($val == '' || !abs(intval($val)))
                throw new CException("The card #".($num+1)." value is invalid");
        }
        foreach($cards['number'] as $num => $number) {
            if($number == '')
                throw new Exception("The card #".($num+1)." number is invalid");
        }
        foreach($cards['password'] as $num => $password) {
            if($password == '')
                throw new Exception("The card #".($num+1)." password is invalid");
        }
    }

    public function afterDelete(){
        Card::model()->deleteAll('payment_request_id='.$this->id);
        return parent::afterDelete();
    }
}