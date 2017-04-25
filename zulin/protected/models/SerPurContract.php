<?php

/**
 * This is the model class for table "ser_pur_contract".
 *
 * The followings are the available columns in table 'ser_pur_contract':
 * @property string $id
 * @property string $contract_id
 * @property string $creater_id
 * @property integer $purchase_contract_date
 * @property integer $actual_date
 * @property string $hualiang_id
 * @property string $sale_id
 * @property string $quality_id
 * @property string $decorate_id
 * @property string $pay_method
 * @property integer $actual_payment
 * @property integer $hope_end_time
 * @property string $owner_phone
 * @property integer $ctime
 * @property integer $deleted
 */
class SerPurContract extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ser_pur_contract';
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
			array('purchase_contract_date, actual_date, actual_payment, hope_end_time, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, creater_id, hualiang_id, sale_id, quality_id, decorate_id', 'length', 'max'=>36),
			array('pay_method', 'length', 'max'=>255),
			array('owner_phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, creater_id, purchase_contract_date, actual_date, hualiang_id, sale_id, quality_id, decorate_id, pay_method, actual_payment, hope_end_time, owner_phone, ctime, deleted', 'safe', 'on'=>'search'),
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
			'creater_id' => 'Creater',
			'purchase_contract_date' => 'Purchase Contract Date',
			'actual_date' => 'Actual Date',
			'hualiang_id' => 'Hualiang',
			'sale_id' => 'Sale',
			'quality_id' => 'Quality',
			'decorate_id' => 'Decorate',
			'pay_method' => 'Pay Method',
			'actual_payment' => 'Actual Payment',
			'hope_end_time' => 'Hope End Time',
			'owner_phone' => 'Owner Phone',
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
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('purchase_contract_date',$this->purchase_contract_date);
		$criteria->compare('actual_date',$this->actual_date);
		$criteria->compare('hualiang_id',$this->hualiang_id,true);
		$criteria->compare('sale_id',$this->sale_id,true);
		$criteria->compare('quality_id',$this->quality_id,true);
		$criteria->compare('decorate_id',$this->decorate_id,true);
		$criteria->compare('pay_method',$this->pay_method,true);
		$criteria->compare('actual_payment',$this->actual_payment);
		$criteria->compare('hope_end_time',$this->hope_end_time);
		$criteria->compare('owner_phone',$this->owner_phone,true);
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
	 * @return SerPurContract the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
