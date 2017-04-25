<?php

/**
 * This is the model class for table "ser_special_cost".
 *
 * The followings are the available columns in table 'ser_special_cost':
 * @property string $id
 * @property string $ser_contract_id
 * @property string $house_no
 * @property integer $type
 * @property string $details
 * @property integer $amount
 * @property integer $show_order
 * @property integer $ctime
 * @property integer $deleted
 */
class SerSpecialCost extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ser_special_cost';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, ser_contract_id', 'required'),
			array('type, amount, show_order, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, ser_contract_id, house_no', 'length', 'max'=>36),
			array('details', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, ser_contract_id, house_no, type, details, amount, show_order, ctime, deleted', 'safe', 'on'=>'search'),
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
			'house_no' => 'House No',
			'type' => 'Type',
			'details' => 'Details',
			'amount' => 'Amount',
			'show_order' => 'Show Order',
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
		$criteria->compare('ser_contract_id',$this->ser_contract_id,true);
		$criteria->compare('house_no',$this->house_no,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('show_order',$this->show_order);
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
	 * @return SerSpecialCost the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
