<?php

/**
 * This is the model class for table "fin_receivables".
 *
 * The followings are the available columns in table 'fin_receivables':
 * @property string $id
 * @property string $contract_id
 * @property integer $ctime
 * @property integer $deleted
 * @property string $admin_id
 * @property integer $cycle_start
 * @property integer $cycle_end
 * @property integer $payee_money
 */
class FinReceivables extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'fin_receivables';
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
			array('ctime, deleted, cycle_start, cycle_end, payee_money', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, admin_id', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, ctime, deleted, admin_id, cycle_start, cycle_end, payee_money', 'safe', 'on'=>'search'),
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
			'ctime' => 'Ctime',
			'deleted' => 'Deleted',
			'admin_id' => 'Admin',
			'cycle_start' => 'Cycle Start',
			'cycle_end' => 'Cycle End',
			'payee_money' => 'Payee Money',
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
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('admin_id',$this->admin_id,true);
		$criteria->compare('cycle_start',$this->cycle_start);
		$criteria->compare('cycle_end',$this->cycle_end);
		$criteria->compare('payee_money',$this->payee_money);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FinReceivables the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
