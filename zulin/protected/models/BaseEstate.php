<?php

/**
 * This is the model class for table "base_estate".
 *
 * The followings are the available columns in table 'base_estate':
 * @property string $id
 * @property string $area_id
 * @property string $estate_group_id
 * @property string $name
 * @property double $long
 * @property double $lat
 * @property string $address
 * @property string $introduce
 * @property integer $average_price
 * @property string $parking_space
 * @property string $building_age
 * @property string $property_fee
 * @property string $creater_id
 * @property integer $deleted
 * @property integer $ctime
 */
class BaseEstate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'base_estate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('average_price, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('long, lat', 'numerical'),
			array('id, area_id, creater_id', 'length', 'max'=>36),
			array('estate_group_id', 'length', 'max'=>255),
			array('name', 'length', 'max'=>50),
			array('address', 'length', 'max'=>100),
			array('parking_space, building_age, property_fee', 'length', 'max'=>10),
			array('introduce', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, area_id, estate_group_id, name, long, lat, address, introduce, average_price, parking_space, building_age, property_fee, creater_id, deleted, ctime', 'safe', 'on'=>'search'),
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
			'area_id' => 'Area',
			'estate_group_id' => 'Estate Group',
			'name' => 'Name',
			'long' => 'Long',
			'lat' => 'Lat',
			'address' => 'Address',
			'introduce' => 'Introduce',
			'average_price' => 'Average Price',
			'parking_space' => 'Parking Space',
			'building_age' => 'Building Age',
			'property_fee' => 'Property Fee',
			'creater_id' => 'Creater',
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
		$criteria->compare('area_id',$this->area_id,true);
		$criteria->compare('estate_group_id',$this->estate_group_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('long',$this->long);
		$criteria->compare('lat',$this->lat);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('introduce',$this->introduce,true);
		$criteria->compare('average_price',$this->average_price);
		$criteria->compare('parking_space',$this->parking_space,true);
		$criteria->compare('building_age',$this->building_age,true);
		$criteria->compare('property_fee',$this->property_fee,true);
		$criteria->compare('creater_id',$this->creater_id,true);
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
	 * @return BaseEstate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
