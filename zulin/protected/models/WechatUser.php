<?php

/**
 * This is the model class for table "wechat_user".
 *
 * The followings are the available columns in table 'wechat_user':
 * @property integer $id
 * @property string $openid
 * @property string $nickname
 * @property integer $sex
 * @property string $headimgurl
 * @property string $country
 * @property string $province
 * @property string $city
 * @property string $access_token
 * @property string $refresh_token
 * @property string $created_at
 */
class WechatUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wechat_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sex', 'numerical', 'integerOnly'=>true),
			array('openid, headimgurl, access_token, refresh_token', 'length', 'max'=>255),
			array('nickname, country, province, city', 'length', 'max'=>50),
			array('created_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, nickname, sex, headimgurl, country, province, city, access_token, refresh_token, created_at', 'safe', 'on'=>'search'),
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
			'openid' => 'Openid',
			'nickname' => 'Nickname',
			'sex' => 'Sex',
			'headimgurl' => 'Headimgurl',
			'country' => 'Country',
			'province' => 'Province',
			'city' => 'City',
			'access_token' => 'Access Token',
			'refresh_token' => 'Refresh Token',
			'created_at' => 'Created At',
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
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('access_token',$this->access_token,true);
		$criteria->compare('refresh_token',$this->refresh_token,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WechatUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
