<?php

/**
 * This is the model class for table "validation".
 *
 * The followings are the available columns in table 'validation':
 * @property integer $id
 * @property string $headimgurl
 * @property string $nickname
 * @property string $openid
 * @property string $account
 * @property integer $status
 * @property string $ctime
 */
class Validation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'validation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('headimgurl, nickname, openid, account', 'length', 'max'=>255),
			array('ctime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, headimgurl, nickname, openid, account, status, ctime', 'safe', 'on'=>'search'),
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
			'headimgurl' => 'Headimgurl',
			'nickname' => 'Nickname',
			'openid' => 'Openid',
			'account' => 'Account',
			'status' => 'Status',
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
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('account',$this->account,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('ctime',$this->ctime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Validation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
