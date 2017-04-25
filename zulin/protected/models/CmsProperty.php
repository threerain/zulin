<?php

/**
 * This is the model class for table "cms_property".
 *
 * The followings are the available columns in table 'cms_property':
 * @property string $id
 * @property string $district_id
 * @property string $estate_group_id
 * @property string $area_id
 * @property string $estate_id
 * @property string $building_id
 * @property string $house_no
 * @property string $room_type
 * @property integer $ting
 * @property integer $shi
 * @property integer $chu
 * @property integer $wei
 * @property string $orientation
 * @property double $room_area
 * @property double $area
 * @property string $property_certificate_address
 * @property integer $idle_time
 * @property integer $pay
 * @property integer $status
 * @property integer $deposit
 * @property integer $status_now
 * @property integer $price
 * @property integer $end_time
 * @property string $time_memo
 * @property integer $split
 * @property string $split_partent_id
 * @property integer $merge
 * @property string $ascription_id
 * @property string $creater_id
 * @property integer $deleted
 * @property integer $utime
 * @property integer $ctime
 */
class CmsProperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_property';
	}
	public function arr()
    {
        return array(
            'room_type'=>array('0'=>'请选择','1'=>'轿车','2'=>'客车','3'=>'SUV','4'=>'商务'),
            'status'=>array('1'=>'未租','2'=>'他租'),
            'status_now'=>array('0'=>'全部','1'=>'未出库','2'=>'近期可出库','3'=>'近期不可出库','4'=>'维修中'),
            'see_way'=>array('1'=>'实勘','2'=>'目标','3'=>'预约未见','4'=>'约见','5'=>'成交'),
            'house_status'=>array('0'=>'请选择','1'=>'空置','2'=>'未租','3'=>'他租'),
            'meet'=>array('0'=>'请选择','1'=>'一次','2'=>'两次','3'=>'多次'),
            'sunshine'=>array('0'=>'优','1'=>'良','2'=>'差'),
            'french_window'=>array('0'=>'否','1'=>'是'),
            'crutch'=>array('0'=>'无','1'=>'有'),
            'door'=>array('0'=>'单扇','1'=>'双扇'),
            'spray'=>array('0'=>'朝上','1'=>'朝下'),
            'corridor_toilet'=>array('0'=>'优','1'=>'良','2'=>'差'),
            'owner_gender'=>array('1'=>'女','2'=>'男'),
        );
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, ctime', 'required'),
			array('ting, shi, chu, wei, idle_time, pay, status, deposit, status_now, price, end_time, split, merge, deleted, utime, ctime', 'numerical', 'integerOnly'=>true),
			array('area', 'numerical'),
			array('id, district_id, estate_group_id, area_id, estate_id, building_id, split_partent_id, ascription_id, creater_id', 'length', 'max'=>36),
			array('house_no, room_type', 'length', 'max'=>20),
			array('orientation', 'length', 'max'=>10),
			array('property_certificate_address', 'length', 'max'=>200),
			array('time_memo', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, district_id, estate_group_id, area_id, estate_id, building_id, house_no, room_type, ting, shi, chu, wei, orientation,  area, property_certificate_address, idle_time, pay, status, deposit, status_now, price, end_time, time_memo, split, split_partent_id, merge, ascription_id, creater_id, deleted, utime, ctime', 'safe', 'on'=>'search'),
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
			'district_id' => 'District',
			'estate_group_id' => 'Estate Group',
			'area_id' => 'Area',
			'estate_id' => 'Estate',
			'building_id' => 'Building',
			'house_no' => 'House No',
			'room_type' => 'Room Type',
			'ting' => 'Ting',
			'shi' => 'Shi',
			'chu' => 'Chu',
			'wei' => 'Wei',
			'orientation' => 'Orientation',
			'area' => 'Area',
			'property_certificate_address' => 'Property Certificate Address',
			'idle_time' => 'Idle Time',
			'pay' => 'Pay',
			'status' => 'Status',
			'deposit' => 'Deposit',
			'status_now' => 'Status Now',
			'price' => 'Price',
			'end_time' => 'End Time',
			'time_memo' => 'Time Memo',
			'split' => 'Split',
			'split_partent_id' => 'Split Partent',
			'merge' => 'Merge',
			'ascription_id' => 'Ascription',
			'creater_id' => 'Creater',
			'deleted' => 'Deleted',
			'utime' => 'Utime',
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
		$criteria->compare('district_id',$this->district_id,true);
		$criteria->compare('estate_group_id',$this->estate_group_id,true);
		$criteria->compare('area_id',$this->area_id,true);
		$criteria->compare('estate_id',$this->estate_id,true);
		$criteria->compare('building_id',$this->building_id,true);
		$criteria->compare('house_no',$this->house_no,true);
		$criteria->compare('room_type',$this->room_type,true);
		$criteria->compare('ting',$this->ting);
		$criteria->compare('shi',$this->shi);
		$criteria->compare('chu',$this->chu);
		$criteria->compare('wei',$this->wei);
		$criteria->compare('orientation',$this->orientation,true);
		$criteria->compare('area',$this->area);
		$criteria->compare('property_certificate_address',$this->property_certificate_address,true);
		$criteria->compare('idle_time',$this->idle_time);
		$criteria->compare('pay',$this->pay);
		$criteria->compare('status',$this->status);
		$criteria->compare('deposit',$this->deposit);
		$criteria->compare('status_now',$this->status_now);
		$criteria->compare('price',$this->price);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('time_memo',$this->time_memo,true);
		$criteria->compare('split',$this->split);
		$criteria->compare('split_partent_id',$this->split_partent_id,true);
		$criteria->compare('merge',$this->merge);
		$criteria->compare('ascription_id',$this->ascription_id,true);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('utime',$this->utime);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
