<?php

/**
 * This is the model class for table "client_follow".
 *
 * The followings are the available columns in table 'client_follow':
 * @property string $id
 * @property string $follow_id
 * @property string $openid
 * @property string $property_id
 * @property string $area
 * @property string $company
 * @property string $linkman
 * @property integer $phone
 * @property string $format
 * @property string $budget
 * @property integer $two_see
 * @property string $house_no
 * @property integer $prineinal
 * @property string $order_time
 * @property string $follow_info
 * @property string $urs_people
 * @property string $ctime
 */
class ClientFollow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'client_follow';
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
			array('phone, two_see, prineinal', 'numerical', 'integerOnly'=>true),
			array('id, follow_id, property_id', 'length', 'max'=>36),
			array('openid', 'length', 'max'=>50),
			array('area, budget, house_no', 'length', 'max'=>20),
			array('company, linkman, format, order_time, follow_info, urs_people', 'length', 'max'=>255),
			array('ctime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, follow_id, openid, property_id, area, company, linkman, phone, format, budget, two_see, house_no, prineinal, order_time, follow_info, urs_people, ctime', 'safe', 'on'=>'search'),
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
			'follow_id' => 'Follow',
			'openid' => 'Openid',
			'property_id' => 'Property',
			'area' => 'Area',
			'company' => 'Company',
			'linkman' => 'Linkman',
			'phone' => 'Phone',
			'format' => 'Format',
			'budget' => 'Budget',
			'two_see' => 'Two See',
			'house_no' => 'House No',
			'prineinal' => 'Prineinal',
			'order_time' => 'Order Time',
			'follow_info' => 'Follow Info',
			'urs_people' => 'Urs People',
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
		$criteria->compare('follow_id',$this->follow_id,true);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('linkman',$this->linkman,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('format',$this->format,true);
		$criteria->compare('budget',$this->budget,true);
		$criteria->compare('two_see',$this->two_see);
		$criteria->compare('house_no',$this->house_no,true);
		$criteria->compare('prineinal',$this->prineinal);
		$criteria->compare('order_time',$this->order_time,true);
		$criteria->compare('follow_info',$this->follow_info,true);
		$criteria->compare('urs_people',$this->urs_people,true);
		$criteria->compare('ctime',$this->ctime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClientFollow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
