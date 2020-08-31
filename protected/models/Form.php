<?php

/**
 * This is the model class for table "form".
 *
 * The followings are the available columns in table 'form':
 * @property string $id
 * @property string $city_id
 * @property string $area_id
 * @property string $metro_id
 * @property string $user_id
 * @property string $name_ru
 * @property string $name_pl
 * @property string $name_en
 * @property string $name_tr
 * @property string $name_de
 * @property string $name_fr
 * @property string $name_ua
 * @property string $name_es
 * @property string $about_ru
 * @property string $about_en
 * @property string $about_pl
 * @property string $about_tr
 * @property string $about_de
 * @property string $about_fr
 * @property string $about_ua
 * @property string $about_es
 * @property integer $weight
 * @property integer $hair
 * @property integer $speak_english
 * @property integer $age
 * @property integer $breast
 * @property integer $rise
 * @property string $cell_phone
 * @property integer $price_hour
 * @property integer $price_two_hour
 * @property integer $price_night
 * @property integer $price_per_hour_exit
 * @property integer $price_two_hour_exit
 * @property integer $price_night_exit
 * @property integer $price_anal_exit
 * @property integer $mood_prices
 * @property integer $no_photoshop
 * @property integer $no_photoshop_approved
 * @property integer $real_photo
 * @property integer $best_girl
 * @property file $evidence_photo
 * @property string $added
 * @property string $payed_till
 * @property string $payed_till_vip
 * @property integer $hits
 * @property integer $hits_today
 * @property string $last_hit
 * @property integer $published
 * @property integer $hide_from_admin_home_page
 * @property string $decline_reson
 *
 * The followings are the available model relations:
 * @property City $city
 * @property Area $area
 * @property Metro $metro
 * @property User $user
 * @property FormService[] $formServices
 * @property Image[] $images
 * @property Payment[] $payments
 */
class Form extends BaseModel
{
    public $evidence_photo;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Form the static model class
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
        return 'form';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cell_phone, name_ru, name_en', 'required'),
            array('age, hair, speak_english, weight, breast, rise, price_hour, price_two_hour, price_night, price_per_hour_exit, price_two_hour_exit, price_night_exit, price_anal_exit, mood_prices, no_photoshop, no_photoshop_approved, real_photo, best_girl, hits, hits_today, published', 'numerical', 'integerOnly' => true),
            array('city_id, area_id, metro_id, user_id', 'length', 'max' => 10),
            array('city_id', 'validateCityBeforeSave'),
            array('name_ru, name_en, name_tr, name_de, name_fr, name_ua, name_es', 'length', 'max' => 100),
            array('cell_phone', 'length', 'min' => 13),
            array('name_ru', 'length', 'min' => 4),
            array('name_en', 'length', 'min' => 4),
            array('added', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('published', 'default', 'value' => '1', 'setOnEmpty' => true, 'on' => 'insert'),
            array('about_ru, about_en, about_tr, about_de, about_fr, about_ua, about_es, decline_reson', 'safe'),
            array('evidence_photo', 'file', 'types' => 'jpg, jpeg, gif, png', 'maxSize' => (2 * 1024 * 1024), 'allowEmpty' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, city_id, area_id, metro_id, user_id, name_ru, name_pl, name_en, name_tr, name_de, name_fr, name_ua, name_es, about_ru, about_pl, about_en, about_tr, about_de, about_fr, about_ua, about_es, age, breast, rise, cell_phone, price_hour, price_two_hour, price_night, price_per_hour_exit, price_two_hour_exit, price_night_exit, price_anal_exit, mood_prices, no_photoshop, no_photoshop_approved, real_photo, best_girl, added, hits, hits_today, last_hit, published, decline_reson, payed_till,payed_till_vip,hide_from_admin_home_page', 'safe', 'on' => 'search'),
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
            'area' => array(self::BELONGS_TO, 'Area', 'area_id'),
            'metro' => array(self::BELONGS_TO, 'Metro', 'metro_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'formServices' => array(self::HAS_MANY, 'FormService', 'form_id'),
            'images' => array(self::HAS_MANY, 'Image', 'form_id'),
            'payments' => array(self::HAS_MANY, 'Payment', 'form_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'form_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'city_id' => 'City:',
            'area_id' => 'Area:',
            'metro_id' => 'Metro:',
            'user_id' => 'User',
            'name_ru' => 'Name Ru:',
            'name_pl' => 'Name Pl',
            'name_en' => 'Name En:',
            'name_tr' => 'Name Tr',
            'name_de' => 'Name De',
            'name_fr' => 'Name Fr',
            'name_ua' => 'Name Ua',
            'name_es' => 'Name Es',
            'about_ru' => 'About Ru',
            'about_pl' => 'About Pl',
            'about_en' => 'About En',
            'about_tr' => 'About Tr',
            'about_de' => 'About De',
            'about_fr' => 'About Fr',
            'about_ua' => 'Обо мне на Украинском',
            'about_es' => 'About Es',
            'age' => 'Age:',
            'breast' => 'Breast:',
            'rise' => 'Rise:',
            'cell_phone' => 'Cell Phone',
            'price_hour' => 'Price Hour',
            'price_two_hour' => 'Price Two Hour',
            'price_night' => 'Price Night',
            'price_per_hour_exit' => 'Price Per Hour Exit',
            'price_two_hour_exit' => 'Price Two Hour Exit',
            'price_night_exit' => 'Price Night Exit',
            'price_anal_exit' => 'Price Anal Exit',
            'mood_prices' => 'Mood Prices',
            'no_photoshop' => 'No Photoshop',
            'no_photoshop_approved' => 'No Photoshop Approved',
            'real_photo' => 'Real Photo',
            'best_girl' => 'Best Girl',
            'evidence_photo' => 'Evidence Photo',
            'added' => 'Added',
            'hits' => 'Hits',
            'Hair' => 'Hair:',
            'speak_english' => 'Speaks English',
            'weight' => 'Weight:',
            'hits_today' => 'Hits Today',
            'last_hit' => 'Last Hit',
            'published' => 'Published',
            'decline_reson' => 'Decline Reson',
            'payed_till' => 'Payed till',
            'payed_till_vip' => 'Payed till vip',
            'hide_from_admin_home_page' => 'Hide from admin home page',
        );
    }

    function beforeSave()
    {
        if (!parent::beforeSave())
            return false;

        if (!$this->validateNames()) {
            $this->addError('name_' . Language::getActive(), L::t('Should be at least one name'));
            return false;
        }
        $evidence_photo = CUploadedFile::getInstance($this, 'evidence_photo');

        if (!$this->evidence_photo && $this->real_photo && !$evidence_photo) {
            //$this->addError('evidence_photo', L::t('Please choose an evidence photo for upload'));
            //return false;
        }
        if (($this->scenario == 'insert' || $this->scenario == 'update') && $evidence_photo) {
            $this->deleteImage();
            $this->real_photo = true;
            $this->evidence_photo = $evidence_photo;

            $imgName = uniqid() . '.' . pathinfo($this->evidence_photo->name, PATHINFO_EXTENSION);
            $this->evidence_photo->saveAs(
                Yii::getPathOfAlias('evidence') . DIRECTORY_SEPARATOR . $imgName);
            $this->evidence_photo = $imgName;

            $thumb = new Imagick(Yii::getPathOfAlias('evidence') . DIRECTORY_SEPARATOR . $imgName);
            $thumb->cropthumbnailimage(111, 137);
            $f = Yii::getPathOfAlias('evidence') . '/thumb/';
            if (!is_dir($f)) mkdir($f, 0777);
            $thumb->writeImage($f . $imgName);

            $this->no_photoshop_approved = 0;
        }

        if ($this->scenario == 'insert')
            $this->user_id = U::id();

        return true;
    }

    private function validateNames()
    {
        foreach (Language::getList() as $lang) {
            $label = 'name_' . $lang;
            if ($this->$label)
                return true;
        }
        return false;
    }

    public function beforeDelete()
    {
        if (!$this->canBeEditedByTheCurrentUser())
            return false;
        FormService::model()->deleteAll("form_id={$this->id}");
        Image::model()->deleteAll("form_id={$this->id}");
        return true;
    }

    public function afterSave()
    {

        if (isset($_REQUEST['Form']['images'])) {
            Image::model()->deleteAllByAttributes(array("form_id" => $this->id));
            foreach ($_REQUEST['Form']['images'] as $name) {
                $model = new Image();
                $model->form_id = $this->id;
                $model->src = $name;
                $model->published = 1;
                $model->save();
            }
        }

        if (isset($_POST['Form']['services'])) {
            FormService::model()->deleteAllByAttributes(array("form_id" => $this->id));
            foreach ($_POST['Form']['services'] as $serviceId) {
                $model = new FormService();
                $model->form_id = $this->id;
                $model->service_id = abs(intval($serviceId));
                $model->save();
            }
        }

        return true;
    }

    public function deleteImage()
    {
        $imagePath = Yii::getPathOfAlias('evidence') . DIRECTORY_SEPARATOR .
            $this->evidence_photo;
        if (is_file($imagePath))
            unlink($imagePath);
    }

    function daysLeft()
    {
        $days = round((strtotime($this->payed_till) - time()) / 60 / 60 / 24);
        if ($days <= 0) $days = 0;
        return $days;
    }


    function getFormsList(Array $input = array(), $isVip = false, $page=null, $limit=null)
    {
        $input['vip'] = $isVip;

        if ($formsList = Yii::app()->cache->get('formsList_' . serialize($input) . $_SERVER['SERVER_NAME'])) {
            return $formsList;
        }

        $params['published'] = 1;
        $lang = Language::getActive();
		$criteria = new CDbCriteria;
		
        if(!empty($limit)){
            if($page!=0&&$page!=null){
                $page=$page*$limit;
            }
            $criteria->offset = 0;
            $criteria->limit = $limit;
        }
		
		$criteria->order='RAND()';
		
        $condition = 'payed_till>NOW()';

        if (isset($input['new']) && $input['new'])
            $condition .= ' AND NOT TIMESTAMPDIFF(MONTH,added,NOW())';

        if ($isVip)
            $condition .= ' AND payed_till_vip>NOW()';

        if (isset($input['price']) && $prices = strval($input['price'])) {
            list($from, $to) = explode('-', $prices);
            $condition .= " AND price_hour BETWEEN {$from} AND {$to}";
        }

        if (isset($input['age']) && $age = $input['age']) {
            list($from, $to) = explode('-', $age);
            $condition .= " AND age BETWEEN {$from} AND {$to}";
        }

        if (isset($input['rise']) && $rise = $input['rise']) {
            list($from, $to) = explode('-', $rise);
            $condition .= " AND rise BETWEEN {$from} AND {$to}";
        }

        if (isset($input['weight']) && $weight = $input['weight']) {
            list($from, $to) = explode('-', $weight);
            $condition .= " AND weight BETWEEN {$from} AND {$to}";
        }

        if (isset($input['chip']) && $input['chip'])
            $condition .= " AND price_hour<=600";

        if (isset($input['expensive']) && $input['expensive'])
            $condition .= " AND price_hour>=700";

        if (isset($input['breast']) && $breast = $input['breast'])
            $condition .= " AND breast={$breast}";

        if (isset($input['hair']) && $hair = $input['hair'])
            $condition .= " AND hair=" . ($hair - 1);



        if (isset($input['speak_english']) && $input['speak_english'] == 1)
		    //$condition .= " AND speak_english=1";
			$params['speak_english'] = 1;
		
        if (isset($input['real_photo']) && $input['real_photo'] == 1)
		    //$condition .= " AND real_photo=1";
			$params['real_photo'] = 1;
		 

        if (isset($input['city']) && $id = $input['city'])
            $params['city_id'] = $id;
        elseif (!isset($input['city']) && $id = CCity::getActiveId())
            $params['city_id'] = $id;

        if (isset($input['metro']) && $id = $input['metro'])
            $params['metro_id'] = $id;

        if (isset($input['region']) && $id = $input['region'])
            $params['area_id'] = $id;

        if (isset($input['no_photoshop_approved']) && $input['no_photoshop_approved'])
            $params['no_photoshop_approved'] = 1;

        if (isset($input['name']) && $name = $input['name'])
            $condition .= " AND name_{$lang} LIKE '%{$name}%'";

        if (isset($input['cell_phone']) && $phone = $input['cell_phone'])
            $condition .= " AND cell_phone LIKE '%{$phone}%'";
			
		if (isset($input['offset'])) {
			$offset = $input['offset'];
		} else {
			$offset = 0;
		}
		
		/*
		if (isset($input['limit'])) {
			$limit = $input['limit'];
		} else {
			$limit = 10;
		}*/
		
		/*
		$attributes = array(
			'offset' => $offset,
			'limit' => $limit,
		);
		*/
		$attributes = array();


        if (isset($input['service']))
        {
            $this->with(array(
                'formServices' => array(
                    'select' => false,
                    'joinType' => 'INNER JOIN',
                    'condition' => 'service_id IN (' . implode(',', $input['service']) . ')',
                ),
            ));
        }
 
        $formsList = $this->findAllByAttributes($params, $condition);

		shuffle($formsList);
      
        Yii::app()->cache->set('formsList_' . serialize($input), $formsList);
		
        return $formsList;
    }

    public function prolong($days)
    {
        $days = intval($days);
        if (($time = strtotime($this->payed_till)) < time())
            $time = time();
        $this->payed_till = date('Y-m-d H:i:s', $time + $days * 3600 * 24);
        $this->update();
    }

    public function getVipForms()
    {
        $city = CCity::getActiveId();
        if (isset($_GET['city']) && intval($_GET['city']) > 0) {
            $city = $_GET['city'];
        }
        return $this->findAll('published=1 AND payed_till_vip>NOW()' . ($city ? " AND city_id={$city}" : ""));
    }

    function getThumbImageSrc()
    {
        return count($this->images) >= 1
            ? Yii::app()->request->baseUrl . '/images/forms/100x150/' . $this->images[0]->src
            : false;
    }

    function getRandomPhotoForHomePage($size)
    {
        if (!count($this->images)) return false;
        $images = $this->images;
        //shuffle($images);
        $img = Yii::app()->request->baseUrl . "/images/forms/{$size}/" . $images[0]->src;
        return $img;
    }

    function getImageSrc($size)
    {
        if (is_dir($dir = Yii::app()->request->baseUrl . '/images/forms/' . $size))
            return $this->getThumbImageSrc();

        return count($this->images) >= 1
            ? $dir . '/' . $this->images[0]->src
            : false;
    }

    static function canBeEditedByTheCurrentUser($formUserId = null)
    {
        if (!$formUserId && isset($_GET['id'])) {
            if (!($form = Form::model()->findByPk($_GET['id']))) {
                return false;
            }
            $formUserId = $form->user_id;
        }


        return ($formUserId == U::id()) || UserModule::isAdmin();
    }

    function doHit()
    {
        $this->hits++;
        if (date('Y-m-d', strtotime($this->last_hit)) != date('Y-m-d'))
            $this->hits_today = 0;
        $this->hits_today++;
        $this->last_hit = date('Y-m-d H:i:s', time());
        $this->update();
    }

    function getAllMyFroms()
    {
        return $this->findAllByAttributes(array('user_id' => U::id()), array('order' => 'payed_till_vip DESC, payed_till DESC'));
    }

    function getMyTotalCount()
    {
        return $this->countByAttributes(array('user_id' => U::id()));
    }

    function getMyPublishedCount()
    {
        return $this->countByAttributes(array('user_id' => U::id()), "published=1 AND payed_till>NOW()");
    }

    function getMyNotPublishedCount()
    {
        return $this->countByAttributes(array('user_id' => U::id()), "published=0 OR payed_till=0 OR payed_till<NOW()");
    }

    function getMyWillBeClosedInAFew()
    {
        return $this->countByAttributes(array('user_id' => U::id()), "payed_till<>0 AND payed_till-NOW()>0 AND payed_till BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()");
    }

    function areClosed()
    {
        return $this->countByAttributes(array(), "payed_till<NOW()");
    }

    function getListWillBeClisedSoon()
    {
        return $this->findAll(array("condition" => "payed_till<>0 AND payed_till-NOW()>0 AND payed_till BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()", 'order' => 'user_id'));
    }

    function isVip()
    {
        return strtotime($this->payed_till_vip) > time();
    }

    function isNew()
    {
        return (time() - strtotime($this->added)) < 30 * 3600 * 24;
    }

    public function isPayed()
    {
        return $this->payed_till && (strtotime($this->payed_till) > (time() - (24 * 60 * 60)));
    }

    public function getFormCommentsCount()
    {
        return Comment::model()->countByAttributes(array('form_id' => $this->id, "status" => 1));
    }

    public function hide()
    {
        $this->hide_from_admin_home_page = 1;
        $this->update();
    }

    public function getEvidence()
    {
        return Yii::app()->request->baseUrl . '/images/evidence/' . $this->evidence_photo;
    }

    public function getEvidenceThumb()
    {
        return $this->evidence_photo ? Yii::app()->request->baseUrl . '/images/evidence/thumb/' . $this->evidence_photo : '';
    }

    public function generateURL()
    {
         $lang = Language::getActive();
   
        $r = strtolower(str_replace('+', '',YII::app()->controller->createAbsoluteUrl('/form/view', array('id' => $this->id, 'name' => preg_replace("/[^a-zA-Z0-9]/", '_', ($this->name_en ? $this->name_en : $this->name_tr)), 'phone' => preg_replace('/\D/', '',str_replace('+', '', $this->cell_phone))))));
      
        if($lang != 'ru'){
            if(!strpos($_SERVER['SERVER_NAME'],$lang)){
              $r = str_replace($_SERVER['SERVER_NAME'], $_SERVER['SERVER_NAME'].'/'.$lang,  $r);
            }
        }
        return $r;
    }

    public function generateNewURL()
    {
        return YII::app()->controller->createAbsoluteUrl('/site/index', array('new' => 'new'));
    }
    //public function generateRealPhotoURL(){
    //   return YII::app()->controller->createAbsoluteUrl('/site/index',array('no_ph'=>'no_ph'));
    // }
    public function generateChipURL()
    {
        return YII::app()->controller->createAbsoluteUrl('/site/index', array('chip' => 'chip'));
    }

    public function generateExpensiveURL()
    {
        return YII::app()->controller->createAbsoluteUrl('/site/index', array('expensive' => 'expensive'));
    }

    public function generateIndividualURL()
    {
        return YII::app()->controller->createAbsoluteUrl('/site/index/', array('individual' => 'individual'));
    }


    function validateCityBeforeSave()
    {
        if (City::model()->findByPk($this->city_id)) {
            return true;
        }
        $this->addError('city_id', L::t('Please select a city'));
        return false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($searchBy = '')
    {
        $criteria = new CDbCriteria;

        if ($searchBy)
            $criteria->condition = "id LIKE '%{$searchBy}%' "
                . "OR user_id LIKE '%{$searchBy}%'"
                . "OR cell_phone LIKE '%{$searchBy}%'"
                . "OR name_" . Language::getActive() . " LIKE '%{$searchBy}%'"
                . "OR about_" . Language::getActive() . " LIKE '%{$searchBy}%'";

        $criteria->compare('id', $this->id, true);
        $criteria->compare('city_id', $this->city_id, false);
        $criteria->compare('area_id', $this->area_id, true);
        $criteria->compare('metro_id', $this->metro_id, true);
        $criteria->compare('user_id', $this->user_id, false);
        $criteria->compare('name_ru', $this->name_ru, true);
        $criteria->compare('name_pl', $this->name_pl, true);
        $criteria->compare('name_en', $this->name_en, true);
        $criteria->compare('name_tr', $this->name_tr, true);
        $criteria->compare('name_de', $this->name_de, true);
        $criteria->compare('name_fr', $this->name_fr, true);
        $criteria->compare('name_ua', $this->name_ua, true);
        $criteria->compare('name_es', $this->name_es, true);
        $criteria->compare('about_ru', $this->about_ru, true);
        $criteria->compare('about_pl', $this->about_pl, true);
        $criteria->compare('about_en', $this->about_en, true);
        $criteria->compare('about_tr', $this->about_tr, true);
        $criteria->compare('about_de', $this->about_de, true);
        $criteria->compare('about_fr', $this->about_fr, true);
        $criteria->compare('about_ua', $this->about_ua, true);
        $criteria->compare('about_es', $this->about_es, true);
        $criteria->compare('age', $this->age);
        $criteria->compare('breast', $this->breast);
        $criteria->compare('rise', $this->rise);
        $criteria->compare('cell_phone', $this->cell_phone, true);
        $criteria->compare('price_hour', $this->price_hour);
        $criteria->compare('price_two_hour', $this->price_two_hour);
        $criteria->compare('price_night', $this->price_night);
        $criteria->compare('price_per_hour_exit', $this->price_per_hour_exit);
        $criteria->compare('price_two_hour_exit', $this->price_two_hour_exit);
        $criteria->compare('price_night_exit', $this->price_night_exit);
        $criteria->compare('price_anal_exit', $this->price_anal_exit);
        $criteria->compare('mood_prices', $this->mood_prices);
        $criteria->compare('no_photoshop', $this->no_photoshop);
        $criteria->compare('no_photoshop_approved', $this->no_photoshop_approved);
        $criteria->compare('real_photo', $this->real_photo);
        $criteria->compare('best_girl', $this->best_girl);
        $criteria->compare('evidence_photo', $this->evidence_photo);
        $criteria->compare('added', $this->added, true);
        $criteria->compare('hits', $this->hits);
        $criteria->compare('hits_today', $this->hits_today);
        $criteria->compare('last_hit', $this->last_hit, true);
        $criteria->compare('published', $this->published);
        $criteria->compare('decline_reson', $this->decline_reson, true);

        if (intval($this->payed_till) == 1)
            $criteria->addCondition('payed_till<NOW()');

        $criteria->compare('payed_till_vip', $this->payed_till_vip, true);
        $criteria->compare('hair', $this->hair, true);
        $criteria->compare('speak_english', $this->speak_english, true);
        $criteria->compare('weight', $this->weight, true);
        $criteria->compare('hide_from_admin_home_page', $this->hide_from_admin_home_page, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    } 
	
	public function getHomeImageProfile($form_id){
        $image = Yii::app()->db
            ->createCommand("SELECT * FROM image WHERE form_id = '" . $form_id . "' ORDER BY id ASC LIMIT 1")
            ->queryAll();

        return $image;
    }
	
    function getFormsListIndex(Array $input = array(), $isVip = false, $page=null, $limit=null)
    {
        $input['vip'] = $isVip;

		$formsList=Yii::app()->cache->get($time_list);

		if($formsList===false) {

			$params['published'] = 1;
			$lang = Language::getActive();
			
			/*
			$criteria = new CDbCriteria;
			
			if(!empty($limit)){
				if($page!=0&&$page!=null){
					$page=$page*$limit;
				}
				$criteria->offset = 0;
				$criteria->limit = $limit;
			}
			
			$criteria->order='RAND()';
			*/
			
			$condition = 'payed_till>NOW()';

				
			if (isset($input['offset'])) {
				$offset = $input['offset'];
			} else {
				$offset = 0;
			}

			$attributes = array();


			if (isset($input['service']))
			{
				$this->with(array(
					'formServices' => array(
						'select' => false,
						'joinType' => 'INNER JOIN',
						'condition' => 'service_id IN (' . implode(',', $input['service']) . ')',
					),
				));
			}
          
			$formsList = $this->findAllByAttributes($params, $condition);
			shuffle($formsList);
		
			Yii::app()->cache->set($time_list, $formsList, 60);
			
		}
		
        return $formsList;
    }
	
	
	
	
	
}