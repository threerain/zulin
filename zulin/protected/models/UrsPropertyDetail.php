<?php

/**
 * This is the model class for table "urs_property_detail".
 *
 * The followings are the available columns in table 'urs_property_detail':
 * @property string $id
 * @property string $property_id
 * @property string $contract_id
 * @property integer $base_price
 * @property string $gift_one
 * @property string $gift_two
 * @property string $gift_three
 * @property integer $deleted
 * @property integer $ctime
 */
class UrsPropertyDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'urs_property_detail';
	}
	public function arr()
	{
		return array(
			'type_photo'=>array('0'=>'请选择图片类型','1'=>'楼梯外观','2'=>'交通图','3'=>'格局图','4'=>'平面图','5'=>'外景图','6'=>'办公室内(地面)','7'=>'办公室内(室内吊顶)','8'=>'消防喷淋头'),
			'status_now'=>array('0'=>'全部','1'=>'未租','2'=>'已租'),
			'decoration_status'=>array(1=>'精装交付',2=>'精装升级(第一次)',3=>'精装升级(第二次)',4=>'精装升级(第三次)',5=>'可租升级(可看房)',6=>'可租升级(可看房，提前电话联系)',7=>'可租升级(不可看房)',8=>'预租(不可看房)'),
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
			array('id', 'required'),
			array('base_price, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, property_id, contract_id', 'length', 'max'=>36),
			array('gift_one, gift_two, gift_three', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, contract_id, base_price, gift_one, gift_two, gift_three, deleted, ctime', 'safe', 'on'=>'search'),
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
			'base_price' => 'Base Price',
			'gift_one' => 'Gift One',
			'gift_two' => 'Gift Two',
			'gift_three' => 'Gift Three',
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
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('base_price',$this->base_price);
		$criteria->compare('gift_one',$this->gift_one,true);
		$criteria->compare('gift_two',$this->gift_two,true);
		$criteria->compare('gift_three',$this->gift_three,true);
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
	 * @return UrsPropertyDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
