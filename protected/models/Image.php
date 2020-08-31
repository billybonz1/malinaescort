<?php

/**
 * This is the model class for table "image".
 *
 * The followings are the available columns in table 'image':
 * @property string $id
 * @property string $form_id
 * @property string $src
 * @property string $added
 * @property integer $published
 *
 * The followings are the available model relations:
 * @property Form $form
 */
class Image extends BaseModel
{
    public $x1=0;
    public $x2=0;
    public $y1=0;
    public $y2=0;
    public $w=0;
    public $h=0;

    public $sizes = array(
        array('w'=>84,'h'=>110),
        array('w'=>96,'h'=>120),
        array('w'=>100,'h'=>150),
        array('w'=>112,'h'=>142),
        array('w'=>142,'h'=>180),
        array('w'=>216,'h'=>300),
        array('w'=>290,'h'=>374),
    );

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Image the static model class
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
		return 'image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_id, src', 'required'),
			array('published', 'numerical', 'integerOnly'=>true),
			array('form_id', 'length', 'max'=>10),
			array('src', 'length', 'max'=>18),
//            array('added','default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, form_id, src, added, published', 'safe', 'on'=>'search'),
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
			'src' => 'Src',
			'added' => 'Added',
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
		$criteria->compare('form_id',$this->form_id,true);
		$criteria->compare('src',$this->src,true);
		$criteria->compare('added',$this->added,true);
		$criteria->compare('published',$this->published);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getThumbImageSrc(){
        return Yii::app()->request->baseUrl.'/images/forms/100x150/'.$this->src;
    }

    public function getImageSrc($size){
        return Yii::app()->request->baseUrl.'/images/forms/'.$size.'/'.$this->src;
    }

    public function beforeSave(){
        $image = isset($_REQUEST['Image']) ? $_REQUEST['Image'] : null;
        if(isset($image['x1']) && $image['x1']) {
            $f=$_SERVER['DOCUMENT_ROOT'].'/images/forms/';
            $original=$f.'/original/'.$this->src;

            $thumbTemp=$f.$this->src;

            $thumb = new Imagick($original);
            $thumb->cropimage($image['w'],$image['h'],$image['x1'],$image['y1']);
            $thumb->writeImage($thumbTemp);

            foreach(Image::model()->sizes as $size){
                $thumb = new Imagick($thumbTemp);
                $thumb->cropthumbnailimage($size['w'],$size['h']);
                $thumb->writeImage($f.$size['w'].'x'.$size['h'].'/'.$this->src);
            }
            unlink($thumbTemp);
        }
        $this->added=date('Y-m-d H:i:s');
        return parent::beforeSave();
    }

    public function cleanUp(){
        $c=$fsize=0;
        $arr=array_map(function($img){return $img->src;},Image::model()->findAll());
        $f=$_SERVER['DOCUMENT_ROOT'].'/images/forms/';
        $files = $this->readAllFiles($f.$this->sizes[0]['w'].'x'.$this->sizes[0]['h']);
        foreach($files as $file){
            if(in_array($file,$arr)) continue;

            foreach($this->sizes as $size){
                $image=$f.$size['w'].'x'.$size['h'].'/'.$file;
                if(is_file($image)){
                    $fsize+=filesize($image)/1024/1024;
                    unlink($image);
                    $c++;
                }
            }
        }

        return array('c'=>$c,'size'=>$fsize);
    }

    private function readAllFiles($root = '.'){
        $files  = array();
        if ($handle = opendir($root)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $files[]=$entry;
                }
            }
            closedir($handle);
        }
        return $files;
    }
}