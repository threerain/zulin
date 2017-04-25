<?php

/**
 * This is the model class for table "quality_project".
 *
 * The followings are the available columns in table 'quality_project':
 * @property string $id
 * @property string $after_id
 * @property string $name
 * @property string $phone
 * @property string $subjection
 * @property integer $project_cost
 * @property string $real_option
 * @property string $option_infor
 * @property integer $mass_time
 * @property integer $mass_time1
 * @property integer $start_time
 * @property integer $hope_end_time
 * @property integer $ctime
 */
class QualityProject extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quality_project';
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
			array('project_cost, mass_time, mass_time1, start_time, hope_end_time, ctime', 'numerical', 'integerOnly'=>true),
			array('id, after_id', 'length', 'max'=>36),
			array('name, subjection, real_option, option_infor', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, after_id, name, phone, subjection, project_cost, real_option, option_infor, mass_time, mass_time1, start_time, hope_end_time, ctime', 'safe', 'on'=>'search'),
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
			'after_id' => 'After',
			'name' => 'Name',
			'phone' => 'Phone',
			'subjection' => 'Subjection',
			'project_cost' => 'Project Cost',
			'real_option' => 'Real Option',
			'option_infor' => 'Option Infor',
			'mass_time' => 'Mass Time',
			'mass_time1' => 'Mass Time1',
			'start_time' => 'Start Time',
			'hope_end_time' => 'Hope End Time',
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
		$criteria->compare('after_id',$this->after_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('subjection',$this->subjection,true);
		$criteria->compare('project_cost',$this->project_cost);
		$criteria->compare('real_option',$this->real_option,true);
		$criteria->compare('option_infor',$this->option_infor,true);
		$criteria->compare('mass_time',$this->mass_time);
		$criteria->compare('mass_time1',$this->mass_time1);
		$criteria->compare('start_time',$this->start_time);
		$criteria->compare('hope_end_time',$this->hope_end_time);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return QualityProject the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
