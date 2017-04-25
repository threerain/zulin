<?php

/**
 * This is the model class for table "quality_decoration".
 *
 * The followings are the available columns in table 'quality_decoration':
 * @property string $id
 * @property string $contract_id
 * @property integer $decoration_type
 * @property integer $status
 * @property string $supervisor
 * @property string $foreman
 * @property string $docking_people
 * @property integer $project_start_time
 * @property integer $project_end_time
 * @property integer $docking_date
 * @property string $creater_id
 * @property integer $ctime
 * @property integer $deleted
 */
class QualityDecoration extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quality_decoration';
	}
	public function status()
	{
		return array(
			'status'=>array('1' => '已添加预算单信息','2' => '未添加预算信息','3' => '已添加结算信息'),//预算结算状态
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
			array('decoration_type, status, project_start_time, project_end_time, docking_date, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, supervisor, docking_people, creater_id', 'length', 'max'=>36),
			array('foreman', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, decoration_type, status, supervisor, foreman, docking_people, project_start_time, project_end_time, docking_date, creater_id, ctime, deleted', 'safe', 'on'=>'search'),
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
			'contract_id' => 'Contract',
			'decoration_type' => 'Decoration Type',
			'status' => 'Status',
			'supervisor' => 'Supervisor',
			'foreman' => 'Foreman',
			'docking_people' => 'Docking People',
			'project_start_time' => 'Project Start Time',
			'project_end_time' => 'Project End Time',
			'docking_date' => 'Docking Date',
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
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('decoration_type',$this->decoration_type);
		$criteria->compare('status',$this->status);
		$criteria->compare('supervisor',$this->supervisor,true);
		$criteria->compare('foreman',$this->foreman,true);
		$criteria->compare('docking_people',$this->docking_people,true);
		$criteria->compare('project_start_time',$this->project_start_time);
		$criteria->compare('project_end_time',$this->project_end_time);
		$criteria->compare('docking_date',$this->docking_date);
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
	 * @return QualityDecoration the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
