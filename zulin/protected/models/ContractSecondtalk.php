<?php

/**
 * This is the model class for table "contract_secondtalk".
 *
 * The followings are the available columns in table 'contract_secondtalk':
 * @property integer $id
 * @property string $contract_id
 * @property string $content
 * @property string $follower
 * @property string $ctime
 * @property integer $talk_time
 * @property integer $deleted
 */
class ContractSecondtalk extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contract_secondtalk';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('talk_time, deleted', 'numerical', 'integerOnly'=>true),
			array('contract_id', 'length', 'max'=>36),
			array('follower', 'length', 'max'=>255),
			array('content, ctime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, content, follower, ctime, talk_time, deleted', 'safe', 'on'=>'search'),
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
			'content' => 'Content',
			'follower' => 'Follower',
			'ctime' => 'Ctime',
			'talk_time' => 'Talk Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('follower',$this->follower,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('talk_time',$this->talk_time);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ContractSecondtalk the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
