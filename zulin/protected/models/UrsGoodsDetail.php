<?php

/**
 * This is the model class for table "urs_goods_detail".
 *
 * The followings are the available columns in table 'urs_goods_detail':
 * @property string $id
 * @property string $property_id
 * @property string $contract_id
 * @property string $json
 * @property integer $deleted
 * @property integer $ctime
 * @property string $creater
 * @property string $up_creater
 */
class UrsGoodsDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'urs_goods_detail';
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
			array('deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, property_id, contract_id, creater, up_creater', 'length', 'max'=>36),
			array('json', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, contract_id, json, deleted, ctime, creater, up_creater', 'safe', 'on'=>'search'),
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
			'json' => 'Json',
			'deleted' => 'Deleted',
			'ctime' => 'Ctime',
			'creater' => 'Creater',
			'up_creater' => 'Up Creater',
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
		$criteria->compare('json',$this->json,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('creater',$this->creater,true);
		$criteria->compare('up_creater',$this->up_creater,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UrsGoodsDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
