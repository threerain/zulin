<?php

/**
 * This is the model class for table "urs_goods_storage".
 *
 * The followings are the available columns in table 'urs_goods_storage':
 * @property string $id
 * @property string $goods_name
 * @property string $goods_unit
 * @property string $create_user_id
 * @property string $deleted
 * @property integer $ctime
 */
class UrsGoodsStorage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'urs_goods_storage';
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
			array('ctime', 'numerical', 'integerOnly'=>true),
			array('id, create_user_id', 'length', 'max'=>36),
			array('goods_name, goods_unit, deleted', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, goods_name, goods_unit, create_user_id, deleted, ctime', 'safe', 'on'=>'search'),
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
			'goods_name' => 'Goods Name',
			'goods_unit' => 'Goods Unit',
			'create_user_id' => 'Create User',
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
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('goods_unit',$this->goods_unit,true);
		$criteria->compare('create_user_id',$this->create_user_id,true);
		$criteria->compare('deleted',$this->deleted,true);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UrsGoodsStorage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
