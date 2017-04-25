<?php

/**
 * This is the model class for table "ser_hydropower".
 *
 * The followings are the available columns in table 'ser_hydropower':
 * @property string $id
 * @property string $ser_contract_id
 * @property integer $hydropower_type
 * @property integer $electricity_fees
 * @property integer $electricity_unit
 * @property integer $hot_water
 * @property string $hot_unit
 * @property integer $middle_water
 * @property string $middle_unit
 * @property integer $cold_water
 * @property string $cold_unit
 * @property integer $gas_meter
 * @property string $gas_unit
 * @property integer $ctime
 * @property integer $show_order
 * @property integer $deleted
 * @property string $del_user
 */
class SerHydropower extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ser_hydropower';
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
			array('hydropower_type, electricity_fees, electricity_unit, hot_water, middle_water, cold_water, gas_meter, ctime, show_order, deleted', 'numerical', 'integerOnly'=>true),
			array('id, ser_contract_id, del_user', 'length', 'max'=>36),
			array('hot_unit, middle_unit, cold_unit, gas_unit', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ser_contract_id, hydropower_type, electricity_fees, electricity_unit, hot_water, hot_unit, middle_water, middle_unit, cold_water, cold_unit, gas_meter, gas_unit, ctime, show_order, deleted, del_user', 'safe', 'on'=>'search'),
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
			'ser_contract_id' => 'Ser Contract',
			'hydropower_type' => 'Hydropower Type',
			'electricity_fees' => 'Electricity Fees',
			'electricity_unit' => 'Electricity Unit',
			'hot_water' => 'Hot Water',
			'hot_unit' => 'Hot Unit',
			'middle_water' => 'Middle Water',
			'middle_unit' => 'Middle Unit',
			'cold_water' => 'Cold Water',
			'cold_unit' => 'Cold Unit',
			'gas_meter' => 'Gas Meter',
			'gas_unit' => 'Gas Unit',
			'ctime' => 'Ctime',
			'show_order' => 'Show Order',
			'deleted' => 'Deleted',
			'del_user' => 'Del User',
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
		$criteria->compare('ser_contract_id',$this->ser_contract_id,true);
		$criteria->compare('hydropower_type',$this->hydropower_type);
		$criteria->compare('electricity_fees',$this->electricity_fees);
		$criteria->compare('electricity_unit',$this->electricity_unit);
		$criteria->compare('hot_water',$this->hot_water);
		$criteria->compare('hot_unit',$this->hot_unit,true);
		$criteria->compare('middle_water',$this->middle_water);
		$criteria->compare('middle_unit',$this->middle_unit,true);
		$criteria->compare('cold_water',$this->cold_water);
		$criteria->compare('cold_unit',$this->cold_unit,true);
		$criteria->compare('gas_meter',$this->gas_meter);
		$criteria->compare('gas_unit',$this->gas_unit,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('show_order',$this->show_order);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('del_user',$this->del_user,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SerHydropower the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
