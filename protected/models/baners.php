<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21.11.2015
 * Time: 14:42
 */
class Baners extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     * @return Baners the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'baners';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['position, hreff, hiden', 'required'],
            ['position, city, hreff', 'length', 'max' => 255],
            ['domen', 'length', 'max' => 10],
           // ['createdAt', 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('application', 'ID'),
            'image' => Yii::t('application', 'Картинка'),
            'hreff' => Yii::t('application', 'Ссылка'),
            'position'=> Yii::t('application', 'Позиция'),
            'domen' => Yii::t('application', 'Домены'),
            'hiden' => Yii::t('application', 'Публиковать'),
            'city' => Yii::t('application', 'Город'),
            'views' => Yii::t('application', 'Переходы'),
        ];
    }
    public function search($searchBy='')
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        if($searchBy)
            $criteria->condition="id LIKE '%{$searchBy}%' OR name LIKE '%{$searchBy}%' OR text LIKE '%{$searchBy}%' OR added LIKE '%{$searchBy}%' OR ip LIKE '%{$searchBy}%'";

        $criteria->compare('id',$this->id,true);
        $criteria->compare('name',$this->image,true);
        $criteria->compare('text',$this->position,true);
        $criteria->compare('status',$this->domen);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id DESC',
            )
        ));
    }
    public function GetDomensList()
    {
        return [
            ''=>'На всех',
            'ru'=>'ru',
            'en'=>'en',
            'tr'=>'tr',
            'de'=>'de',
            'fr'=>'fr',
            'it'=>'it',
            'es'=>'es',
            'pl'=>'pl',
        ];
    }
    protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }
        if(isset($_FILES['Baners']))
        {
            if(is_uploaded_file($_FILES['Baners']['tmp_name']['image'])) {
                move_uploaded_file($_FILES["Baners"]["tmp_name"]['image'], $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .'images'. DIRECTORY_SEPARATOR . $_FILES["Baners"]["name"]['image']);
                $this->image = $_FILES["Baners"]["name"]['image'];
            }
        }
        return true;
    }
    public function getBuners($position){
        $criteria = new CDbCriteria;
        $domain=explode('.',$_SERVER['HTTP_HOST']);
        $city=$domain[(count($domain)==4?1:0)];
        $cities='';
        if(isset($city))
        {
            foreach (CCity::getList() as $value)
            {
                if($city==$value)
                {
                    $cities=$city;
                }
            }
        }
        $domen=Language::getActive();
        $criteria = new CDbCriteria;
        $criteria->addColumnCondition(['position' => $position,'hiden' => 1, 'city'=> $cities]);
        $model=baners::model()->findAll($criteria);

        return $model;
    }
}
