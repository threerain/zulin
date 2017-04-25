<?php

/**
 * This is the model class for table "base_estate_photo".
 *
 * The followings are the available columns in table 'base_estate_photo':
 * @property string $id
 * @property string $estate_id
 * @property integer $type
 * @property string $url
 * @property integer $ctime
 * @property integer $show_order
 */
class BaseEstatePhoto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'base_estate_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, ctime, show_order', 'numerical', 'integerOnly'=>true),
			array('id, estate_id', 'length', 'max'=>36),
			array('url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estate_id, type, url, ctime, show_order', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'estate_id' => 'Estate',
			'type' => 'Type',
			'url' => 'Url',
			'ctime' => 'Ctime',
			'show_order' => 'Show Order',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('estate_id',$this->estate_id,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('show_order',$this->show_order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseEstatePhoto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
