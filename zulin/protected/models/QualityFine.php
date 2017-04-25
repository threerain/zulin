<?php

/**
 * This is the model class for table "quality_fine".
 *
 * The followings are the available columns in table 'quality_fine':
 * @property string $id
 * @property string $decoration_id
 * @property string $fine_items
 * @property integer $fine_date
 * @property integer $fine_amount
 * @property string $fine_reason
 * @property string $fine_settlement
 * @property string $punish_people
 * @property string $punished_people
 * @property string $creater_id
 * @property integer $ctime
 * @property integer $deleted
 */
class QualityFine extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quality_fine';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, decoration_id', 'required'),
			array('fine_date, fine_amount, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, decoration_id, creater_id', 'length', 'max'=>36),
			array('fine_items', 'length', 'max'=>150),
			array('fine_reason, fine_settlement', 'length', 'max'=>255),
			array('punish_people, punished_people', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, decoration_id, fine_items, fine_date, fine_amount, fine_reason, fine_settlement, punish_people, punished_people, creater_id, ctime, deleted', 'safe', 'on'=>'search'),
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
			'fine_items' => 'Fine Items',
			'fine_date' => 'Fine Date',
			'fine_amount' => 'Fine Amount',
			'fine_reason' => 'Fine Reason',
			'fine_settlement' => 'Fine Settlement',
			'punish_people' => 'Punish People',
			'punished_people' => 'Punished People',
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
		$criteria->compare('decoration_id',$this->decoration_id,true);
		$criteria->compare('fine_items',$this->fine_items,true);
		$criteria->compare('fine_date',$this->fine_date);
		$criteria->compare('fine_amount',$this->fine_amount);
		$criteria->compare('fine_reason',$this->fine_reason,true);
		$criteria->compare('fine_settlement',$this->fine_settlement,true);
		$criteria->compare('punish_people',$this->punish_people,true);
		$criteria->compare('punished_people',$this->punished_people,true);
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
	 * @return QualityFine the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
