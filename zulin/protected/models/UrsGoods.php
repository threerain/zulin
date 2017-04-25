<?php

/**
 * This is the model class for table "urs_goods".
 *
 * The followings are the available columns in table 'urs_goods':
 * @property string $id
 * @property string $admin_uname
 * @property string $admin_uid
 * @property string $department
 * @property string $department_group
 * @property string $department_principal
 * @property string $check_one_reason
 * @property integer $check_one_time
 * @property string $check_two
 * @property string $check_two_reason
 * @property integer $check_two_time
 * @property string $check_finance
 * @property string $check_finance_reason
 * @property integer $check_finance_time
 * @property string $cheques_user
 * @property integer $cheques_user_time
 * @property string $information_user
 * @property integer $information_time
 * @property string $buy_user
 * @property integer $buy_way
 * @property integer $buy_money
 * @property string $buy_invoice
 * @property integer $subsidy_money
 * @property integer $subsidy_type
 * @property integer $subsidy_time
 * @property integer $subsidy_pass_time
 * @property string $subsidy_pass_user
 * @property integer $subsidy_fail_time
 * @property integer $subsidy_fail_user
 * @property integer $back_money
 * @property integer $back_type
 * @property integer $back_time
 * @property string $back_pass_user
 * @property integer $back_pass_time
 * @property integer $harvest_time
 * @property string $harvest_user
 * @property string $types
 * @property string $harvest_remark
 * @property string $contract_id
 * @property string $channel_id
 * @property string $channel_manager_id
 * @property integer $totals
 * @property string $totals_user
 * @property integer $totals_way
 * @property string $totals_banks
 * @property string $totals_name
 * @property integer $totals_number
 * @property integer $totals_time
 * @property string $remark
 * @property string $status
 * @property integer $deleted
 * @property integer $ctime
 */
class UrsGoods extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'urs_goods';
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
			array('check_one_time, check_two_time, check_finance_time, cheques_user_time, information_time, buy_way, buy_money, subsidy_money, subsidy_type, subsidy_time, subsidy_pass_time, subsidy_fail_time, subsidy_fail_user, back_money, back_type, back_time, back_pass_time, harvest_time, totals, totals_way, totals_number, totals_time, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, admin_uid, department, department_group, department_principal, check_two, check_finance, cheques_user, information_user, subsidy_pass_user, back_pass_user, harvest_user, contract_id, channel_id, channel_manager_id, totals_user', 'length', 'max'=>36),
			array('admin_uname', 'length', 'max'=>200),
			array('check_one_reason, check_two_reason, check_finance_reason, buy_user, buy_invoice, harvest_remark, totals_banks, totals_name, remark', 'length', 'max'=>255),
			array('types, status', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, admin_uname, admin_uid, department, department_group, department_principal, check_one_reason, check_one_time, check_two, check_two_reason, check_two_time, check_finance, check_finance_reason, check_finance_time, cheques_user, cheques_user_time, information_user, information_time, buy_user, buy_way, buy_money, buy_invoice, subsidy_money, subsidy_type, subsidy_time, subsidy_pass_time, subsidy_pass_user, subsidy_fail_time, subsidy_fail_user, back_money, back_type, back_time, back_pass_user, back_pass_time, harvest_time, harvest_user, types, harvest_remark, contract_id, channel_id, channel_manager_id, totals, totals_user, totals_way, totals_banks, totals_name, totals_number, totals_time, remark, status, deleted, ctime', 'safe', 'on'=>'search'),
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
			'admin_uname' => 'Admin Uname',
			'admin_uid' => 'Admin Uid',
			'department' => 'Department',
			'department_group' => 'Department Group',
			'department_principal' => 'Department Principal',
			'check_one_reason' => 'Check One Reason',
			'check_one_time' => 'Check One Time',
			'check_two' => 'Check Two',
			'check_two_reason' => 'Check Two Reason',
			'check_two_time' => 'Check Two Time',
			'check_finance' => 'Check Finance',
			'check_finance_reason' => 'Check Finance Reason',
			'check_finance_time' => 'Check Finance Time',
			'cheques_user' => 'Cheques User',
			'cheques_user_time' => 'Cheques User Time',
			'information_user' => 'Information User',
			'information_time' => 'Information Time',
			'buy_user' => 'Buy User',
			'buy_way' => 'Buy Way',
			'buy_money' => 'Buy Money',
			'buy_invoice' => 'Buy Invoice',
			'subsidy_money' => 'Subsidy Money',
			'subsidy_type' => 'Subsidy Type',
			'subsidy_time' => 'Subsidy Time',
			'subsidy_pass_time' => 'Subsidy Pass Time',
			'subsidy_pass_user' => 'Subsidy Pass User',
			'subsidy_fail_time' => 'Subsidy Fail Time',
			'subsidy_fail_user' => 'Subsidy Fail User',
			'back_money' => 'Back Money',
			'back_type' => 'Back Type',
			'back_time' => 'Back Time',
			'back_pass_user' => 'Back Pass User',
			'back_pass_time' => 'Back Pass Time',
			'harvest_time' => 'Harvest Time',
			'harvest_user' => 'Harvest User',
			'types' => 'Types',
			'harvest_remark' => 'Harvest Remark',
			'contract_id' => 'Contract',
			'channel_id' => 'Channel',
			'channel_manager_id' => 'Channel Manager',
			'totals' => 'Totals',
			'totals_user' => 'Totals User',
			'totals_way' => 'Totals Way',
			'totals_banks' => 'Totals Banks',
			'totals_name' => 'Totals Name',
			'totals_number' => 'Totals Number',
			'totals_time' => 'Totals Time',
			'remark' => 'Remark',
			'status' => 'Status',
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
		$criteria->compare('admin_uname',$this->admin_uname,true);
		$criteria->compare('admin_uid',$this->admin_uid,true);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('department_group',$this->department_group,true);
		$criteria->compare('department_principal',$this->department_principal,true);
		$criteria->compare('check_one_reason',$this->check_one_reason,true);
		$criteria->compare('check_one_time',$this->check_one_time);
		$criteria->compare('check_two',$this->check_two,true);
		$criteria->compare('check_two_reason',$this->check_two_reason,true);
		$criteria->compare('check_two_time',$this->check_two_time);
		$criteria->compare('check_finance',$this->check_finance,true);
		$criteria->compare('check_finance_reason',$this->check_finance_reason,true);
		$criteria->compare('check_finance_time',$this->check_finance_time);
		$criteria->compare('cheques_user',$this->cheques_user,true);
		$criteria->compare('cheques_user_time',$this->cheques_user_time);
		$criteria->compare('information_user',$this->information_user,true);
		$criteria->compare('information_time',$this->information_time);
		$criteria->compare('buy_user',$this->buy_user,true);
		$criteria->compare('buy_way',$this->buy_way);
		$criteria->compare('buy_money',$this->buy_money);
		$criteria->compare('buy_invoice',$this->buy_invoice,true);
		$criteria->compare('subsidy_money',$this->subsidy_money);
		$criteria->compare('subsidy_type',$this->subsidy_type);
		$criteria->compare('subsidy_time',$this->subsidy_time);
		$criteria->compare('subsidy_pass_time',$this->subsidy_pass_time);
		$criteria->compare('subsidy_pass_user',$this->subsidy_pass_user,true);
		$criteria->compare('subsidy_fail_time',$this->subsidy_fail_time);
		$criteria->compare('subsidy_fail_user',$this->subsidy_fail_user);
		$criteria->compare('back_money',$this->back_money);
		$criteria->compare('back_type',$this->back_type);
		$criteria->compare('back_time',$this->back_time);
		$criteria->compare('back_pass_user',$this->back_pass_user,true);
		$criteria->compare('back_pass_time',$this->back_pass_time);
		$criteria->compare('harvest_time',$this->harvest_time);
		$criteria->compare('harvest_user',$this->harvest_user,true);
		$criteria->compare('types',$this->types,true);
		$criteria->compare('harvest_remark',$this->harvest_remark,true);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('channel_manager_id',$this->channel_manager_id,true);
		$criteria->compare('totals',$this->totals);
		$criteria->compare('totals_user',$this->totals_user,true);
		$criteria->compare('totals_way',$this->totals_way);
		$criteria->compare('totals_banks',$this->totals_banks,true);
		$criteria->compare('totals_name',$this->totals_name,true);
		$criteria->compare('totals_number',$this->totals_number);
		$criteria->compare('totals_time',$this->totals_time);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('status',$this->status,true);
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
	 * @return UrsGoods the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
