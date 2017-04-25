<?php

/**
 * This is the model class for table "scale".
 *
 * The followings are the available columns in table 'scale':
 * @property integer $id
 * @property double $area_start
 * @property string $area_end
 * @property integer $level
 * @property double $scale
 * @property integer $type
 * @property integer $deleted
 * @property string $ctime
 */
class Scale extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'scale';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level, type, deleted', 'numerical', 'integerOnly'=>true),
			array('area_start, scale', 'numerical'),
			array('area_end', 'length', 'max'=>10),
			array('ctime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, area_start, area_end, level, scale, type, deleted, ctime', 'safe', 'on'=>'search'),
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
			'area_start' => 'Area Start',
			'area_end' => 'Area End',
			'level' => 'Level',
			'scale' => 'Scale',
			'type' => 'Type',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('area_start',$this->area_start);
		$criteria->compare('area_end',$this->area_end,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('scale',$this->scale);
		$criteria->compare('type',$this->type);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('ctime',$this->ctime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Scale the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
