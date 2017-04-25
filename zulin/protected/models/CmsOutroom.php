<?php

/**
 * This is the model class for table "cms_outroom".
 *
 * The followings are the available columns in table 'cms_outroom':
 * @property string $id
 * @property string $contract_id
 * @property string $commission
 * @property string $operator_id
 * @property string $check_one
 * @property string $check_two
 * @property string $commission_user
 * @property string $commission_bank
 * @property string $commission_num
 * @property integer $amount_money
 * @property string $avatar
 * @property integer $check_type
 * @property string $remark
 * @property integer $invoice_type
 * @property string $reason
 * @property integer $ctime
 */
class CmsOutroom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_outroom';
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
			array('amount_money, check_type, invoice_type, ctime', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, operator_id, check_one, check_two, commission_user', 'length', 'max'=>36),
			array('commission', 'length', 'max'=>11),
			array('commission_bank', 'length', 'max'=>40),
			array('commission_num', 'length', 'max'=>20),
			array('avatar', 'length', 'max'=>100),
			array('remark, reason', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, commission, operator_id, check_one, check_two, commission_user, commission_bank, commission_num, amount_money, avatar, check_type, remark, invoice_type, reason, ctime', 'safe', 'on'=>'search'),
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
			'commission' => 'Commission',
			'operator_id' => 'Operator',
			'check_one' => 'Check One',
			'check_two' => 'Check Two',
			'commission_user' => 'Commission User',
			'commission_bank' => 'Commission Bank',
			'commission_num' => 'Commission Num',
			'amount_money' => 'Amount Money',
			'avatar' => 'Avatar',
			'check_type' => 'Check Type',
			'remark' => 'Remark',
			'invoice_type' => 'Invoice Type',
			'reason' => 'Reason',
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
		$criteria->compare('commission',$this->commission,true);
		$criteria->compare('operator_id',$this->operator_id,true);
		$criteria->compare('check_one',$this->check_one,true);
		$criteria->compare('check_two',$this->check_two,true);
		$criteria->compare('commission_user',$this->commission_user,true);
		$criteria->compare('commission_bank',$this->commission_bank,true);
		$criteria->compare('commission_num',$this->commission_num,true);
		$criteria->compare('amount_money',$this->amount_money);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('check_type',$this->check_type);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('invoice_type',$this->invoice_type);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsOutroom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
