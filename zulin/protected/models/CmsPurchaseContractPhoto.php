<?php

/**
 * This is the model class for table "cms_purchase_payable".
 *
 * The followings are the available columns in table 'cms_purchase_payable':
 * @property string $id
 * @property string $contract_id
 * @property integer $the_order
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $amount
 * @property integer $type
 * @property integer $deleted
 * @property integer $ctime
 */
class CmsPurchaseContractPhoto extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_purchase_contract_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
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
//		return array(
//			'id' => 'ID',
//			'contract_id' => '合同ID',
//			'the_order' => '付款顺序',
//			'start_time' => '付款时段开始时间',
//			'end_time' => '付款时段结束时间',
//			'amount' => '应付金额',
//			'type' => '应付类型 1=收房押金 2=收房租金',
//			'deleted' => '删除标记 0=初始 1=删除',
//			'ctime' => '创建时间',
//		);s
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
//	public function search()
//	{
//		// @todo Please modify the following code to remove attributes that should not be searched.
//
//		$criteria=new CDbCriteria;
//
//		$criteria->compare('id',$this->id,true);
//		$criteria->compare('contract_id',$this->contract_id,true);
//		$criteria->compare('the_order',$this->the_order);
//		$criteria->compare('start_time',$this->start_time);
//		$criteria->compare('end_time',$this->end_time);
//		$criteria->compare('amount',$this->amount);
//		$criteria->compare('type',$this->type);
//		$criteria->compare('deleted',$this->deleted);
//		$criteria->compare('ctime',$this->ctime);
//
//		return new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//		));
//	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsPurchasePayable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
