<?php

/**
 * This is the model class for table "urs_sales_follow".
 *
 * The followings are the available columns in table 'urs_sales_follow':
 * @property string $id
 * @property string $property_id
 * @property integer $type
 * @property string $creater_id
 * @property string $department_id
 * @property string $region_id
 * @property string $channel_id
 * @property string $channel_manager_id
 * @property string $channel_phone
 * @property string $customer_business
 * @property string $budget
 * @property integer $demand_area
 * @property string $demand_district
 * @property integer $responsible_person
 * @property string $follow_detail
 * @property integer $room_time
 * @property integer $ctime
 * @property integer $deleted
 */
class UrsSalesFollow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'urs_sales_follow';
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
			array('type, demand_area, responsible_person, room_time, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, property_id, creater_id, department_id, region_id, channel_id, channel_manager_id', 'length', 'max'=>36),
			array('channel_phone', 'length', 'max'=>11),
			array('customer_business, budget, demand_district, follow_detail', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, type, creater_id, department_id, region_id, channel_id, channel_manager_id, channel_phone, customer_business, budget, demand_area, demand_district, responsible_person, follow_detail, room_time, ctime, deleted', 'safe', 'on'=>'search'),
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
			'department_id' => 'Department',
			'region_id' => 'Region',
			'channel_id' => 'Channel',
			'channel_manager_id' => 'Channel Manager',
			'channel_phone' => 'Channel Phone',
			'customer_business' => 'Customer Business',
			'budget' => 'Budget',
			'demand_area' => 'Demand Area',
			'demand_district' => 'Demand District',
			'responsible_person' => 'Responsible Person',
			'follow_detail' => 'Follow Detail',
			'room_time' => 'Room Time',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('department_id',$this->department_id,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('channel_manager_id',$this->channel_manager_id,true);
		$criteria->compare('channel_phone',$this->channel_phone,true);
		$criteria->compare('customer_business',$this->customer_business,true);
		$criteria->compare('budget',$this->budget,true);
		$criteria->compare('demand_area',$this->demand_area);
		$criteria->compare('demand_district',$this->demand_district,true);
		$criteria->compare('responsible_person',$this->responsible_person);
		$criteria->compare('follow_detail',$this->follow_detail,true);
		$criteria->compare('room_time',$this->room_time);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UrsSalesFollow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
