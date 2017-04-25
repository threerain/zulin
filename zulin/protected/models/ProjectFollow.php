<?php

/**
 * This is the model class for table "project_follow".
 *
 * The followings are the available columns in table 'project_follow':
 * @property string $id
 * @property string $criter_id
 * @property string $after_id
 * @property integer $project_type
 * @property string $project_infor
 * @property integer $end_time
 * @property integer $real_cost
 * @property integer $spread
 * @property integer $bear_type
 * @property string $spread_reason
 * @property string $reason
 * @property integer $ctime
 */
class ProjectFollow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'project_follow';
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
			array('project_type, end_time, real_cost, spread, bear_type, ctime', 'numerical', 'integerOnly'=>true),
			array('id, criter_id, after_id', 'length', 'max'=>36),
			array('project_infor, spread_reason, reason', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, criter_id, after_id, project_type, project_infor, end_time, real_cost, spread, bear_type, spread_reason, reason, ctime', 'safe', 'on'=>'search'),
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
			'criter_id' => 'Criter',
			'after_id' => 'After',
			'project_type' => 'Project Type',
			'project_infor' => 'Project Infor',
			'end_time' => 'End Time',
			'real_cost' => 'Real Cost',
			'spread' => 'Spread',
			'bear_type' => 'Bear Type',
			'spread_reason' => 'Spread Reason',
			'reason' => 'Reason',
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
		$criteria->compare('criter_id',$this->criter_id,true);
		$criteria->compare('after_id',$this->after_id,true);
		$criteria->compare('project_type',$this->project_type);
		$criteria->compare('project_infor',$this->project_infor,true);
		$criteria->compare('end_time',$this->end_time);
		$criteria->compare('real_cost',$this->real_cost);
		$criteria->compare('spread',$this->spread);
		$criteria->compare('bear_type',$this->bear_type);
		$criteria->compare('spread_reason',$this->spread_reason,true);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectFollow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
