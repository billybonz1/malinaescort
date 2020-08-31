<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 28.02.2016
 * Time: 16:54
 */
class Reting extends CActiveRecord
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
        return 'reting';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['ip, ball', 'required'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function ocenka()
    {
        $model=reting::model()->findAll();
        foreach($model as $value)
        {
            $mod[]=$value->ball;
        }
        if(!isset($mod))
        {
           return 0;
        }
        return array_sum($mod)/count($mod);
    }
    public function retingWith(){
        $model=reting::model()->find('ip=?',[$_SERVER['REMOTE_ADDR']]);
        if($model){
            if($model->ball==5){
                return '100%';
            }
            if($model->ball==4){
                return '80%';
            }
            if($model->ball==3){
                return '60%';
            }
            if($model->ball==2){
                return '40%';
            }
            if($model->ball==1){
                return '20%';
            }
            if($model->ball==0){
                return '0%';
            }
        }
        else
        {
            return '0%';
        }
    }


}