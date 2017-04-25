<?php

/**
 * This is the model class for table "ser_sell_contract".
 *
 * The followings are the available columns in table 'ser_sell_contract':
 * @property string $id
 * @property string $contract_id
 * @property string $creater_id
 * @property integer $actual_date
 * @property integer $information_type
 * @property string $tenant
 * @property string $tenant_phone
 * @property string $agent
 * @property string $agent_phone
 * @property string $hidden_phone
 * @property integer $hope_end_time
 * @property integer $agent_type
 * @property integer $ctime
 * @property integer $deleted
 * @property string $pay_method
 * @property integer $actual_payment
 * @property integer $set_date
 * @property integer $source
 */
class SerSellContract extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ser_sell_contract';
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
			array('actual_date, information_type, hope_end_time, agent_type, ctime, deleted, actual_payment, set_date, source', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, creater_id', 'length', 'max'=>36),
			array('tenant, agent, pay_method', 'length', 'max'=>255),
			array('tenant_phone, agent_phone, hidden_phone', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, creater_id, actual_date, information_type, tenant, tenant_phone, agent, agent_phone, hidden_phone, hope_end_time, agent_type, ctime, deleted, pay_method, actual_payment, set_date, source', 'safe', 'on'=>'search'),
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
			'contract_id' => '合同id',
			'creater_id' => '创建人/外勤人员',
			'actual_date' => '实际出车日期',
			'information_type' => 'l收房人类型 1=车主 2 =代理人',
			'tenant' => '租户本人',
			'tenant_phone' => '租户电话',
			'agent' => '代理人姓名',
			'agent_phone' => '代理人电话',
			'hidden_phone' => '维修时留下的车主电话',
			'hope_end_time' => '约定维修结束日期',
			'agent_type' => '代理人类型 1=朋友 2=华亮 3=物业公司 4=职员 5=亲戚',
			'ctime' => '创建时间',
			'deleted' => '删除标记  0=没删，1=删除',
			'pay_method' => '支付方式：',
			'actual_payment' => '实际付款 水电燃气费用 存数据库乘以100，从数据库调出来除以100',
			'set_date' => '规定交房日',
			'source' => '来源 0=收房合同(车主)  1=出车合同(租户)',
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
		$criteria->compare('actual_date',$this->actual_date);
		$criteria->compare('information_type',$this->information_type);
		$criteria->compare('tenant',$this->tenant,true);
		$criteria->compare('tenant_phone',$this->tenant_phone,true);
		$criteria->compare('agent',$this->agent,true);
		$criteria->compare('agent_phone',$this->agent_phone,true);
		$criteria->compare('hidden_phone',$this->hidden_phone,true);
		$criteria->compare('hope_end_time',$this->hope_end_time);
		$criteria->compare('agent_type',$this->agent_type);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('pay_method',$this->pay_method,true);
		$criteria->compare('actual_payment',$this->actual_payment);
		$criteria->compare('set_date',$this->set_date);
		$criteria->compare('source',$this->source);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SerSellContract the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
