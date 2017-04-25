<?php

/**
 * This is the model class for table "urs_sales_control".
 *
 * The followings are the available columns in table 'urs_sales_control':
 * @property string $id
 * @property string $property_id
 * @property string $contract_id
 * @property string $unit_price
 * @property integer $live_date
 * @property string $price_maker
 * @property string $creater_id
 * @property integer $ctime
 * @property integer $deleted
 */
class UrsSalesControl extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'urs_sales_control';
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
			array('live_date, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, property_id, contract_id, price_maker, creater_id', 'length', 'max'=>36),
			array('unit_price', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, contract_id, unit_price, live_date, price_maker, creater_id, ctime, deleted', 'safe', 'on'=>'search'),
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
			'property_id' => 'Property',
			'contract_id' => 'Contract',
			'unit_price' => 'Unit Price',
			'live_date' => 'Live Date',
			'price_maker' => 'Price Maker',
			'creater_id' => 'Creater',
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
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('unit_price',$this->unit_price,true);
		$criteria->compare('live_date',$this->live_date);
		$criteria->compare('price_maker',$this->price_maker,true);
		$criteria->compare('creater_id',$this->creater_id,true);
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
	 * @return UrsSalesControl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
