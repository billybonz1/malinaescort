<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21.11.2015
 * Time: 14:42
 */
class articles extends BaseModel
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
        return 'articles';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['seo_name', 'required'],
            array('city, publish,name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es', 'length', 'max'=>100),
            array('meta_keywords_ru,meta_keywords_pl,meta_keywords_en,meta_keywords_tr,meta_keywords_de,meta_keywords_fr,meta_keywords_ua,meta_keywords_es, meta_description_ru, meta_description_pl, meta_description_en, meta_description_tr, meta_description_de, meta_description_fr, meta_description_ua, meta_description_es, description_ru,	description_pl, description_en, description_tr, description_de, description_fr, description_ua, description_es', 'length', 'max'=>1000000),

            ['name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es, description_ru,	description_pl, description_en, description_tr, description_de, description_fr, description_ua, description_es,meta_keywords_ru,meta_keywords_pl,meta_keywords_en,meta_keywords_tr,meta_keywords_de,meta_keywords_fr,meta_keywords_ua,meta_keywords_es, meta_description_ru, meta_description_pl, meta_description_en, meta_description_tr, meta_description_de, meta_description_fr, meta_description_ua, meta_description_es, publish', 'safe', 'on'=>'search'],

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
            'image' => 'Image',
            'name_ru' => 'Articles Name Ru',
            'name_en' => 'Articles Name En',
            'name_pl' => 'Articles Name Pl',
            'name_tr' => 'Articles Name Tr',
            'name_de' => 'Articles Name De',
            'name_fr' => 'Articles Name Fr',
            'name_ua' => 'Articles Name Ua',
            'name_es' => 'Articles Name Es',
            'description_ru' => 'Articles Description Ru',
            'description_en' => 'Articles Description En',
            'description_pl' => 'Articles Description Pl',
            'description_tr' => 'Articles Description Tr',
            'description_de' => 'Articles Description De',
            'description_fr' => 'Articles Description Fr',
            'description_ua' => 'Articles Description Ua',
            'description_es' => 'Articles Description Es',

            'meta_keywords_ru'=> 'meta keywords ru',
            'meta_keywords_pl'=> 'meta keywords pl',
            'meta_keywords_en'=> 'meta keywords en',
            'meta_keywords_tr'=> 'meta keywords tr',
            'meta_keywords_de'=> 'meta keywords de',
            'meta_keywords_fr'=> 'meta keywords fr',
            'meta_keywords_ua'=> 'meta keywords Ua',
            'meta_keywords_es'=> 'meta keywords es',

            'meta_description_ru'=> 'meta description ru',
            'meta_description_pl'=> 'meta description pl',
            'meta_description_en'=> 'meta description en',
            'meta_description_tr'=> 'meta description tr',
            'meta_description_de'=> 'meta description de',
            'meta_description_fr'=> 'meta description fr',
            'meta_description_ua'=> 'meta description ua',
            'meta_description_es'=> 'meta description es',
            'publish' => Yii::t('application', 'Видимость'),
        ];
    }
    public function search($searchBy='')
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

        $criteria->compare('description_ru',$this->description_ru,true);
        $criteria->compare('description_pl',$this->description_pl,true);
        $criteria->compare('description_en',$this->description_en,true);
        $criteria->compare('description_tr',$this->description_tr,true);
        $criteria->compare('description_de',$this->description_de,true);
        $criteria->compare('description_fr',$this->description_fr,true);
        $criteria->compare('description_ua',$this->description_ua,true);
        $criteria->compare('description_es',$this->description_es,true);

        $criteria->compare('meta_description_ru',$this->meta_description_ru,true);
        $criteria->compare('meta_description_pl',$this->meta_description_pl,true);
        $criteria->compare('meta_description_en',$this->meta_description_en,true);
        $criteria->compare('meta_description_tr',$this->meta_description_tr,true);
        $criteria->compare('meta_description_de',$this->meta_description_de,true);
        $criteria->compare('meta_description_fr',$this->meta_description_fr,true);
        $criteria->compare('meta_description_ua',$this->meta_description_ua,true);
        $criteria->compare('meta_description_es',$this->meta_description_es,true);

        $criteria->compare('meta_keywords_ru',$this->meta_keywords_ru,true);
        $criteria->compare('meta_keywords_pl',$this->meta_keywords_pl,true);
        $criteria->compare('meta_keywords_en',$this->meta_keywords_en,true);
        $criteria->compare('meta_keywords_tr',$this->meta_keywords_tr,true);
        $criteria->compare('meta_keywords_de',$this->meta_keywords_de,true);
        $criteria->compare('meta_keywords_fr',$this->meta_keywords_fr,true);
        $criteria->compare('meta_keywords_ua',$this->meta_keywords_ua,true);
        $criteria->compare('meta_keywords_es',$this->meta_keywords_es,true);


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    protected function beforeSave()
    {
        if (!parent::beforeSave()) {
            return false;
        }
        if(isset($_FILES['articles']))
        {
            if(is_uploaded_file($_FILES['articles']['tmp_name']['image'])) {
                move_uploaded_file($_FILES["articles"]["tmp_name"]['image'], $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .'images'. DIRECTORY_SEPARATOR .'articles'.DIRECTORY_SEPARATOR. $_FILES["articles"]["name"]['image']);
                $this->image = $_FILES["articles"]["name"]['image'];
            }
        }
        return true;
    }
    public function getLink()
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ', '-', '/', '|', ':', '.', ',', '–', '?', '<','>','"','"',')','(','{','}','[',']','<','>','!','+','%','?');
        $lat = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_');
        $text_trans = str_replace($rus, $lat, $this->seo_name);
        //$text_trans=preg_replace('/[^a-zа-яё]+\W+/iu','',$text_trans);
        $text_trans= preg_replace("|[^a-z\d\s-'\"]|i", "_", $text_trans);
     //   $text_trans = str_replace(array('--', '---', '----'), '-', $text_trans);

        return strtolower(YII::app()->controller->createAbsoluteUrl('site/ViewArticles',array('title'=>$text_trans,'id'=>$this->id)));
    }
    public function getArticles()
    {
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
        $criteria->addColumnCondition(['publish' => 1, 'city'=> $cities]);
        $articles=$this->findAll($criteria);
        shuffle($articles);
        $model=[];
        $i=0;
        foreach ($articles as $value)
        {
            $i++;
            $model[]=$value;
            if($i>=4){
                break;
            }
        }
        return  $model;
    }


}

