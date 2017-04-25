<?php

/**
 * This is the model class for table "cms_acquisition_commission".
 *
 * The followings are the available columns in table 'cms_acquisition_commission':
 * @property string $id
 * @property string $contract_id
 * @property string $acq_fan
 * @property integer $acq_real_commission
 * @property integer $acq_monthly_rent
 * @property integer $acq_other
 * @property integer $acq_price
 * @property string $acq_remark
 * @property string $acq_broker
 * @property string $acq_bank
 * @property string $acq_bank_num
 * @property integer $acq_real_rent
 * @property integer $acq_type
 * @property string $acq_reason
 * @property string $acq_user
 * @property string $channel_id
 * @property integer $center_time
 */
class CmsAcquisitionCommission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_acquisition_commission';
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
			array('acq_real_commission, acq_monthly_rent, acq_other, acq_price, acq_real_rent, acq_type, center_time', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, acq_user, channel_id', 'length', 'max'=>36),
			array('acq_fan', 'length', 'max'=>30),
			array('acq_remark, acq_broker, acq_reason', 'length', 'max'=>255),
			array('acq_bank', 'length', 'max'=>40),
			array('acq_bank_num', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, acq_fan, acq_real_commission, acq_monthly_rent, acq_other, acq_price, acq_remark, acq_broker, acq_bank, acq_bank_num, acq_real_rent, acq_type, acq_reason, acq_user, channel_id, center_time', 'safe', 'on'=>'search'),
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
			'acq_fan' => 'Acq Fan',
			'acq_real_commission' => 'Acq Real Commission',
			'acq_monthly_rent' => 'Acq Monthly Rent',
			'acq_other' => 'Acq Other',
			'acq_price' => 'Acq Price',
			'acq_remark' => 'Acq Remark',
			'acq_broker' => 'Acq Broker',
			'acq_bank' => 'Acq Bank',
			'acq_bank_num' => 'Acq Bank Num',
			'acq_real_rent' => 'Acq Real Rent',
			'acq_type' => 'Acq Type',
			'acq_reason' => 'Acq Reason',
			'acq_user' => 'Acq User',
			'channel_id' => 'Channel',
			'center_time' => 'Center Time',
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
		$criteria->compare('acq_fan',$this->acq_fan,true);
		$criteria->compare('acq_real_commission',$this->acq_real_commission);
		$criteria->compare('acq_monthly_rent',$this->acq_monthly_rent);
		$criteria->compare('acq_other',$this->acq_other);
		$criteria->compare('acq_price',$this->acq_price);
		$criteria->compare('acq_remark',$this->acq_remark,true);
		$criteria->compare('acq_broker',$this->acq_broker,true);
		$criteria->compare('acq_bank',$this->acq_bank,true);
		$criteria->compare('acq_bank_num',$this->acq_bank_num,true);
		$criteria->compare('acq_real_rent',$this->acq_real_rent);
		$criteria->compare('acq_type',$this->acq_type);
		$criteria->compare('acq_reason',$this->acq_reason,true);
		$criteria->compare('acq_user',$this->acq_user,true);
		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('center_time',$this->center_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsAcquisitionCommission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
