<?php

/**
 * This is the model class for table "report".
 *
 * The followings are the available columns in table 'report':
 * @property string $id
 * @property string $area
 * @property string $estate_group_id
 * @property string $estate_type
 * @property string $room_type
 * @property string $estate
 * @property string $building
 * @property string $house_no
 * @property string $aream
 * @property string $signing_date
 * @property string $freelease_str
 * @property string $freelease_day
 * @property string $price_per_meter
 * @property string $price_per_meter_sale
 * @property string $actual_date
 * @property string $sale_signing_date
 * @property string $lease_term_start
 * @property string $lease_term_end
 * @property string $sale_count
 * @property string $status
 * @property string $is_sell
 */
class Report extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'report';
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
			array('id', 'length', 'max'=>36),
			array('area, estate_group_id, estate_type, room_type, estate, building, house_no, aream, signing_date, freelease_str, freelease_day, price_per_meter, price_per_meter_sale, actual_date, sale_signing_date, lease_term_start, lease_term_end, sale_count, status, is_sell', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, area, estate_group_id, estate_type, room_type, estate, building, house_no, aream, signing_date, freelease_str, freelease_day, price_per_meter, price_per_meter_sale, actual_date, sale_signing_date, lease_term_start, lease_term_end, sale_count, status, is_sell', 'safe', 'on'=>'search'),
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
			'area' => '商圈',
			'estate_group_id' => '组团',
			'estate_type' => '类别',
			'room_type' => '产品类型',
			'estate' => '项目名称',
			'building' => '系列',
			'house_no' => '编号',
			'aream' => '建筑面积',
			'signing_date' => '收房签约日',
			'freelease_str' => '收房免租期',
			'freelease_day' => '收房免租天数',
			'price_per_meter' => '收购单价',
			'price_per_meter_sale' => '出车单价',
			'actual_date' => '产品收房日',
			'sale_signing_date' => '出车签约日',
			'lease_term_start' => '出车起租日',
			'lease_term_end' => '前租户房租截止日',
			'sale_count' => '出车次数',
			'status' => '备注',
			'is_sell' => '是否交房',
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
		$criteria->compare('area',$this->area,true);
		$criteria->compare('estate_group_id',$this->estate_group_id,true);
		$criteria->compare('estate_type',$this->estate_type,true);
		$criteria->compare('room_type',$this->room_type,true);
		$criteria->compare('estate',$this->estate,true);
		$criteria->compare('building',$this->building,true);
		$criteria->compare('house_no',$this->house_no,true);
		$criteria->compare('aream',$this->aream,true);
		$criteria->compare('signing_date',$this->signing_date,true);
		$criteria->compare('freelease_str',$this->freelease_str,true);
		$criteria->compare('freelease_day',$this->freelease_day,true);
		$criteria->compare('price_per_meter',$this->price_per_meter,true);
		$criteria->compare('price_per_meter_sale',$this->price_per_meter_sale,true);
		$criteria->compare('actual_date',$this->actual_date,true);
		$criteria->compare('sale_signing_date',$this->sale_signing_date,true);
		$criteria->compare('lease_term_start',$this->lease_term_start,true);
		$criteria->compare('lease_term_end',$this->lease_term_end,true);
		$criteria->compare('sale_count',$this->sale_count,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('is_sell',$this->is_sell,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Report the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
