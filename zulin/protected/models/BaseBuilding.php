<?php

/**
 * This is the model class for table "base_building".
 *
 * The followings are the available columns in table 'base_building':
 * @property string $id
 * @property string $estate_id
 * @property string $name
 * @property integer $room_type
 * @property integer $type
 * @property string $room_number_rule
 * @property integer $deleted
 * @property integer $ctime
 */
class BaseBuilding extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'base_building';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_type, type, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, estate_id', 'length', 'max'=>36),
			array('name', 'length', 'max'=>20),
			array('room_number_rule', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estate_id, name, room_type, type, room_number_rule, deleted, ctime', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'room_type' => 'Room Type',
			'type' => 'Type',
			'room_number_rule' => 'Room Number Rule',
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
		$criteria->compare('estate_id',$this->estate_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('room_type',$this->room_type);
		$criteria->compare('type',$this->type);
		$criteria->compare('room_number_rule',$this->room_number_rule,true);
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
	 * @return BaseBuilding the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
