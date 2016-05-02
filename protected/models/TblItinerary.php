<?php

/**
 * This is the model class for table "tbl_itinerary".
 *
 * The followings are the available columns in table 'tbl_itinerary':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $duration
 * @property string $highlights
 * @property string $status
 * @property string $image_path
 * @property string $duration_title
 * @property string $date_added
 * @property string $date_updated
 * @property integer $country_id
 * @property integer $user_id
 *
 * The followings are the available model relations:
 * @property TblUsers $user
 * @property TblCountry $country
 * @property TblJourneythemeMeta[] $tblJourneythemeMetas
 * @property TblJourneytypeMeta[] $tblJourneytypeMetas
 */
class TblItinerary extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_itinerary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description, highlights, status, image_path, duration_title, date_added, date_updated', 'required'),
			array('duration, country_id, user_id', 'numerical', 'integerOnly'=>true),
			array('title, duration_title', 'length', 'max'=>50),
			array('highlights, image_path', 'length', 'max'=>128),
			array('status', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, duration, highlights, status, image_path, duration_title, date_added, date_updated, country_id, user_id', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'TblUsers', 'user_id'),
			'country' => array(self::BELONGS_TO, 'TblCountry', 'country_id'),
			'tblJourneythemeMetas' => array(self::HAS_MANY, 'TblJourneythemeMeta', 'itinerary_id'),
			'tblJourneytypeMetas' => array(self::HAS_MANY, 'TblJourneytypeMeta', 'itinerary_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'duration' => 'Duration',
			'highlights' => 'Highlights',
			'status' => 'Status',
			'image_path' => 'Image Path',
			'duration_title' => 'Duration Title',
			'date_added' => 'Date Added',
			'date_updated' => 'Date Updated',
			'country_id' => 'Country',
			'user_id' => 'User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('duration',$this->duration);
		$criteria->compare('highlights',$this->highlights,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('image_path',$this->image_path,true);
		$criteria->compare('duration_title',$this->duration_title,true);
		$criteria->compare('date_added',$this->date_added,true);
		$criteria->compare('date_updated',$this->date_updated,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblItinerary the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
