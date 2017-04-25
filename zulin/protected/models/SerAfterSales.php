<?php

/**
 * This is the model class for table "ser_after_sales".
 *
 * The followings are the available columns in table 'ser_after_sales':
 * @property string $id
 * @property string $contract_id
 * @property string $ser_contract_id
 * @property string $property_id
 * @property integer $repair_user_type
 * @property string $name
 * @property string $phone
 * @property string $criter_id
 * @property string $department_id
 * @property string $urs_user_id
 * @property integer $repair_type
 * @property integer $evolve_type
 * @property string $hidden
 * @property string $hidden_infor
 * @property integer $hope_end_time
 * @property integer $real_end_time
 * @property integer $hidden_cost
 * @property integer $service_type
 * @property string $bear_type
 * @property integer $deleted
 * @property integer $ctime
 */
class SerAfterSales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ser_after_sales';
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
			array('repair_user_type, repair_type, evolve_type, hope_end_time, real_end_time, hidden_cost, service_type, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, ser_contract_id, property_id, name, criter_id, department_id, urs_user_id', 'length', 'max'=>36),
			array('contract_id', 'length', 'max'=>80),
			array('phone', 'length', 'max'=>11),
			array('hidden, hidden_infor', 'length', 'max'=>255),
			array('bear_type', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, ser_contract_id, property_id, repair_user_type, name, phone, criter_id, department_id, urs_user_id, repair_type, evolve_type, hidden, hidden_infor, hope_end_time, real_end_time, hidden_cost, service_type, bear_type, deleted, ctime', 'safe', 'on'=>'search'),
		);
	}
	/*
			维修类型,进展状态方法调用
	*/
			public function arr()
			{
					return array(
							"repair_type" => array('3'=>'咨询开发票','4'=>'注册迁址','5'=>'投诉','6'=>'维修','7'=>'租户意向装修','8'=>'装修二次升级'),
							"evolve_type" => array('1'=>'质管未接单','2'=>'质管已接单','3'=>'已联系维修','4'=>'已完工','5'=>'车主维修','6'=>'客服已解决','7'=>'客服未解决','8'=>'租户维修'),
					);
			}
			public function arr1()
			{
					return array(
							"repair_type" => array('1'=>'收房隐患','2'=>'交房隐患','3'=>'咨询开发票','4'=>'注册迁址','5'=>'投诉','6'=>'维修','7'=>'租户意向装修','8'=>'装修二次升级'),
							"evolve_type" => array('1'=>'质管未接单','2'=>'质管已接单','3'=>'已联系维修','4'=>'已完工','5'=>'车主维修','6'=>'客服已解决','7'=>'客服未解决','8'=>'租户维修'),
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
			'contract_id' => 'Contract',
			'ser_contract_id' => 'Ser Contract',
			'property_id' => 'Property',
			'repair_user_type' => 'Repair User Type',
			'name' => 'Name',
			'phone' => 'Phone',
			'criter_id' => 'Criter',
			'department_id' => 'Department',
			'urs_user_id' => 'Urs User',
			'repair_type' => 'Repair Type',
			'evolve_type' => 'Evolve Type',
			'hidden' => 'Hidden',
			'hidden_infor' => 'Hidden Infor',
			'hope_end_time' => 'Hope End Time',
			'real_end_time' => 'Real End Time',
			'hidden_cost' => 'Hidden Cost',
			'service_type' => 'Service Type',
			'bear_type' => 'Bear Type',
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
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('ser_contract_id',$this->ser_contract_id,true);
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('repair_user_type',$this->repair_user_type);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('criter_id',$this->criter_id,true);
		$criteria->compare('department_id',$this->department_id,true);
		$criteria->compare('urs_user_id',$this->urs_user_id,true);
		$criteria->compare('repair_type',$this->repair_type);
		$criteria->compare('evolve_type',$this->evolve_type);
		$criteria->compare('hidden',$this->hidden,true);
		$criteria->compare('hidden_infor',$this->hidden_infor,true);
		$criteria->compare('hope_end_time',$this->hope_end_time);
		$criteria->compare('real_end_time',$this->real_end_time);
		$criteria->compare('hidden_cost',$this->hidden_cost);
		$criteria->compare('service_type',$this->service_type);
		$criteria->compare('bear_type',$this->bear_type,true);
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
	 * @return SerAfterSales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
