<?php

/**
 * This is the model class for table "urs_decoration_follow".
 *
 * The followings are the available columns in table 'urs_decoration_follow':
 * @property string $id
 * @property string $decoration_id
 * @property string $property_id
 * @property string $creater_id
 * @property integer $decoration_status
 * @property string $responsible_people
 * @property string $decoration_team
 * @property string $phone
 * @property integer $money
 * @property string $decoration_details
 * @property integer $actual_start_time
 * @property integer $actual_end_time
 * @property integer $actual_expected
 * @property string $reason
 * @property integer $total_settlement_days
 * @property integer $settlement
 * @property integer $construction_quality
 * @property string $feedback_remarks
 * @property integer $ctime
 * @property integer $deleted
 */
class UrsDecorationFollow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'urs_decoration_follow';
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
			array('decoration_status, money, actual_start_time, actual_end_time, actual_expected, total_settlement_days, settlement, construction_quality, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, decoration_id, property_id, creater_id, responsible_people', 'length', 'max'=>36),
			array('decoration_team, decoration_details, reason, feedback_remarks', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, decoration_id, property_id, creater_id, decoration_status, responsible_people, decoration_team, phone, money, decoration_details, actual_start_time, actual_end_time, actual_expected, reason, total_settlement_days, settlement, construction_quality, feedback_remarks, ctime, deleted', 'safe', 'on'=>'search'),
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
			'decoration_id' => 'Decoration',
			'property_id' => 'Property',
			'creater_id' => 'Creater',
			'decoration_status' => 'Decoration Status',
			'responsible_people' => 'Responsible People',
			'decoration_team' => 'Decoration Team',
			'phone' => 'Phone',
			'money' => 'Money',
			'decoration_details' => 'Decoration Details',
			'actual_start_time' => 'Actual Start Time',
			'actual_end_time' => 'Actual End Time',
			'actual_expected' => 'Actual Expected',
			'reason' => 'Reason',
			'total_settlement_days' => 'Total Settlement Days',
			'settlement' => 'Settlement',
			'construction_quality' => 'Construction Quality',
			'feedback_remarks' => 'Feedback Remarks',
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
		$criteria->compare('decoration_id',$this->decoration_id,true);
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('decoration_status',$this->decoration_status);
		$criteria->compare('responsible_people',$this->responsible_people,true);
		$criteria->compare('decoration_team',$this->decoration_team,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('money',$this->money);
		$criteria->compare('decoration_details',$this->decoration_details,true);
		$criteria->compare('actual_start_time',$this->actual_start_time);
		$criteria->compare('actual_end_time',$this->actual_end_time);
		$criteria->compare('actual_expected',$this->actual_expected);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('total_settlement_days',$this->total_settlement_days);
		$criteria->compare('settlement',$this->settlement);
		$criteria->compare('construction_quality',$this->construction_quality);
		$criteria->compare('feedback_remarks',$this->feedback_remarks,true);
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
	 * @return UrsDecorationFollow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
