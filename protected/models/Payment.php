<?php

/**
 * This is the model class for table "payment".
 *
 * The followings are the available columns in table 'payment':
 * @property string $id
 * @property string $form_id
 * @property integer $days
 * @property integer $price
 * @property string $date
 * @property integer $vip
 *
 * The followings are the available model relations:
 * @property Form $form
 */
class Payment extends BaseModel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
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
		return 'payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_id', 'required'),
			array('days, price, vip', 'numerical', 'integerOnly'=>true),
			array('form_id', 'length', 'max'=>10),
            array('date','default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, form_id, days, price, date, vip', 'safe', 'on'=>'search'),
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
			'form' => array(self::BELONGS_TO, 'Form', 'form_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'form_id' => 'Form',
			'days' => 'Days',
			'price' => 'Price',
			'date' => 'Date',
			'vip' => 'Vip',
		);
	}
    public function beforeSave(){
        parent::beforeSave();
        return $this->doPayment();
    }

    function doPayment(){
    	if(!$this->days){
    		$this->addError('days', 'Please check the term');
    		return false;
    	}
        $form = Form::model()->findByPk($this->form_id);
        $priceObject = Price::model()->findByPk($this->days);
        $price = $this->vip ? $priceObject->price_vip : $priceObject->price;
        $user = UserModule::user();
        if($user->amount >= $price) {
            if(($time = strtotime($form->payed_till)) < time())
                $time = time();
            $form->payed_till = date('Y-m-d H:i:s',$time + $priceObject->days*3600*24);
            if($this->vip) {
                if(($timeVip = strtotime($form->payed_till_vip)) < time())
                    $timeVip = time();
                $form->payed_till_vip = date('Y-m-d H:i:s',$timeVip + $priceObject->days*3600*24);
            }
            $form->update();

            $user->amount -= $price;
            $user->save();

            $this->price = $price;
            $this->days = $priceObject->days;
            return true;
        }
        else {
            $this->addError('',L::t('Low amount'));
            return false;
        }
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
		$criteria->compare('form_id',$this->form_id,true);
		$criteria->compare('days',$this->days);
		$criteria->compare('price',$this->price);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('vip',$this->vip);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}