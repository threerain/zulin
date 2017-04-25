<?php

/**
 * This is the model class for table "quality_decoration_property".
 *
 * The followings are the available columns in table 'quality_decoration_property':
 * @property string $id
 * @property string $decoration_id
 * @property string $property_id
 * @property integer $ctime
 * @property integer $deleted
 */
class QualityDecorationProperty extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quality_decoration_property';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, decoration_id, property_id', 'required'),
			array('ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, decoration_id, property_id', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, decoration_id, property_id, ctime, deleted', 'safe', 'on'=>'search'),
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
	 * @return QualityDecorationProperty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
