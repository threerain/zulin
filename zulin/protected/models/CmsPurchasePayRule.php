<?php

/**
 * This is the model class for table "cms_purchase_pay_rule".
 *
 * The followings are the available columns in table 'cms_purchase_pay_rule':
 * @property string $id
 * @property string $contract_id
 * @property integer $the_order
 * @property string $title
 * @property integer $start_time
 * @property integer $end_time
 * @property integer $monthly_rent
 * @property integer $price_per_meter
 * @property integer $increasing_mode
 * @property string $increasing_number
 * @property integer $deleted
 * @property integer $ctime
 */
class CmsPurchasePayRule extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_purchase_pay_rule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('the_order, start_time, end_time, monthly_rent, price_per_meter, increasing_mode, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, contract_id', 'length', 'max'=>36),
			array('title, increasing_number', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, the_order, title, start_time, end_time, monthly_rent, price_per_meter, increasing_mode, increasing_number, deleted, ctime', 'safe', 'on'=>'search'),
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
			'the_order' => '付款顺序',
			'title' => '文字标识如第一年第二年等',
			'start_time' => '付款时段开始时间',
			'end_time' => '付款时段结束时间',
			'monthly_rent' => '月租金',
			'price_per_meter' => '每平米每天价格',
			'increasing_mode' => '递增方式 1=% 2=元',
			'increasing_number' => '递增数量  %  元',
			'deleted' => '删除标记 0=初始 1=删除',
			'ctime' => '创建时间',
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
		$criteria->compare('the_order',$this->the_order);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('monthly_rent',$this->monthly_rent);
		$criteria->compare('price_per_meter',$this->price_per_meter);
		$criteria->compare('increasing_mode',$this->increasing_mode);
		$criteria->compare('increasing_number',$this->increasing_number,true);
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
	 * @return CmsPurchasePayRule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
