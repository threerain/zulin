<?php

/**
 * This is the model class for table "cms_purchase_received".
 *
 * The followings are the available columns in table 'cms_purchase_received':
 * @property string $id
 * @property string $contract_id
 * @property string $payable_id
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $type
 * @property integer $amount
 * @property integer $payment_date
 * @property string $creater_id
 * @property integer $deleted
 * @property string $memo
 * @property integer $ctime
 */
class CmsPurchaseReceived extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_purchase_received';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_time, end_time, type, amount, payment_date, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, payable_id, creater_id', 'length', 'max'=>36),
			array('memo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, payable_id, start_time, end_time, type, amount, payment_date, creater_id, deleted, memo, ctime', 'safe', 'on'=>'search'),
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
			'contract_id' => '合同ID',
			'payable_id' => 'Payable',
			'start_time' => '付款时段开始时间',
			'end_time' => 'end_time',
			'type' => '付款类型 1=押金 2=房租 3=免租期',
			'amount' => 'Amount',
			'payment_date' => '付款日期',
			'creater_id' => 'Creater',
			'deleted' => 'Deleted',
			'memo' => '备注',
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
		$criteria->compare('payable_id',$this->payable_id,true);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('type',$this->type);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('payment_date',$this->payment_date);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsPurchaseReceived the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
