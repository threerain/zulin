<?php

/**
 * This is the model class for table "base_area".
 *
 * The followings are the available columns in table 'base_area':
 * @property string $id
 * @property string $district_id
 * @property string $name
 * @property string $memo
 * @property string $creater_id
 * @property integer $deleted
 * @property integer $ctime
 */
class BaseArea extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'base_area';
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
			array('id, district_id, creater_id', 'length', 'max'=>36),
			array('name', 'length', 'max'=>32),
			array('memo', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, district_id, name, memo, creater_id, deleted, ctime', 'safe', 'on'=>'search'),
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
			'district_id' => '行政区ID',
			'name' => '圈商名',
			'memo' => '注备',
			'creater_id' => '创建人ID',
			'deleted' => '除删标记',
			'ctime' => '建创时间',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('creater_id',$this->creater_id,true);
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
	 * @return BaseArea the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
