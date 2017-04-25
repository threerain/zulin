<?php

/**
 * This is the model class for table "cms_channel_manager".
 *
 * The followings are the available columns in table 'cms_channel_manager':
 * @property string $id
 * @property string $channel_id
 * @property string $name
 * @property string $creater_id
 * @property integer $deleted
 * @property integer $ctime
 */
class CmsChannelManager extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_channel_manager';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, channel_id, creater_id', 'length', 'max'=>36),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, channel_id, name, creater_id, deleted, ctime', 'safe', 'on'=>'search'),
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
			'channel_id' => '渠道公司ID',
			'name' => '渠道公司人员名',
			'creater_id' => '创建人',
			'deleted' => '删除标记',
			'ctime' => '创建时间',
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
		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('name',$this->name,true);
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
	 * @return CmsChannelManager the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
