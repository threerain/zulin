<?php

/**
 * This is the model class for table "cms_property_photo".
 *
 * The followings are the available columns in table 'cms_property_photo':
 * @property string $id
 * @property string $property_id
 * @property string $url
 * @property integer $type_photo
 * @property integer $show_order
 * @property string $ctime
 * @property integer $deleted
 */
class CmsPropertyPhoto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_property_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('type_photo, show_order, deleted', 'numerical', 'integerOnly'=>true),
			array('id, property_id', 'length', 'max'=>36),
			array('url', 'length', 'max'=>255),
			array('ctime', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, url, type_photo, show_order, ctime, deleted', 'safe', 'on'=>'search'),
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
			'property_id' => 'Property',
			'url' => 'Url',
			'type_photo' => 'Type Photo',
			'show_order' => 'Show Order',
			'ctime' => 'Ctime',
			'deleted' => 'Deleted',
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
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('type_photo',$this->type_photo);
		$criteria->compare('show_order',$this->show_order);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsPropertyPhoto the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
