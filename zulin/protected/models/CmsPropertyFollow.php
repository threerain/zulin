<?php

/**
 * This is the model class for table "cms_property_follow".
 *
 * The followings are the available columns in table 'cms_property_follow':
 * @property string $id
 * @property string $property_id
 * @property integer $type
 * @property string $creater_id
 * @property integer $follow_time
 * @property integer $see_way
 * @property integer $start_time
 * @property integer $end_time
 * @property string $detail
 * @property integer $house_status
 * @property integer $deleted
 * @property integer $ctime
 */
class CmsPropertyFollow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_property_follow';
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
			array('type, follow_time, see_way, start_time, end_time, house_status, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, property_id, creater_id', 'length', 'max'=>36),
			array('detail', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, type, creater_id, follow_time, see_way, start_time, end_time, detail, house_status, deleted, ctime', 'safe', 'on'=>'search'),
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
			'type' => 'Type',
			'creater_id' => 'Creater',
			'follow_time' => 'Follow Time',
			'see_way' => 'See Way',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
			'detail' => 'Detail',
			'house_status' => 'House Status',
			'deleted' => 'Deleted',
			'ctime' => 'Ctime',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('follow_time',$this->follow_time);
		$criteria->compare('see_way',$this->see_way);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('house_status',$this->house_status);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsPropertyFollow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
