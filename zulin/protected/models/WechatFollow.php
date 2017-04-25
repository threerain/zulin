<?php

/**
 * This is the model class for table "wechat_follow".
 *
 * The followings are the available columns in table 'wechat_follow':
 * @property string $id
 * @property string $openid
 * @property integer $district
 * @property integer $group
 * @property integer $project_channel
 * @property integer $group_channel
 * @property integer $estate_channel
 * @property integer $big_channel
 * @property integer $other_channel
 * @property integer $new_channel_num
 * @property integer $wechat_channel_num
 * @property integer $phone_num
 * @property integer $look_one_num
 * @property integer $look_two_num
 * @property double $meet_area_num
 * @property integer $meet_muit_num
 * @property integer $client
 * @property double $sign_area
 * @property integer $sign_muit
 * @property integer $see_muit_num
 * @property string $remark
 * @property string $ctime
 * @property string $url
 */
class WechatFollow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'wechat_follow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, openid, district, group, project_channel, group_channel, estate_channel, big_channel, other_channel, new_channel_num, wechat_channel_num, phone_num, look_one_num, look_two_num, meet_area_num, meet_muit_num, client, sign_area, sign_muit, see_muit_num', 'required'),
			array('district, group, project_channel, group_channel, estate_channel, big_channel, other_channel, new_channel_num, wechat_channel_num, phone_num, look_one_num, look_two_num, meet_muit_num, client, sign_muit, see_muit_num', 'numerical', 'integerOnly'=>true),
			array('meet_area_num, sign_area', 'numerical'),
			array('id', 'length', 'max'=>36),
			array('openid', 'length', 'max'=>50),
			array('remark, url', 'length', 'max'=>255),
			array('ctime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, district, group, project_channel, group_channel, estate_channel, big_channel, other_channel, new_channel_num, wechat_channel_num, phone_num, look_one_num, look_two_num, meet_area_num, meet_muit_num, client, sign_area, sign_muit, see_muit_num, remark, ctime, url', 'safe', 'on'=>'search'),
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
			'district' => 'District',
			'group' => 'Group',
			'project_channel' => 'Project Channel',
			'group_channel' => 'Group Channel',
			'estate_channel' => 'Estate Channel',
			'big_channel' => 'Big Channel',
			'other_channel' => 'Other Channel',
			'new_channel_num' => 'New Channel Num',
			'wechat_channel_num' => 'Wechat Channel Num',
			'phone_num' => 'Phone Num',
			'look_one_num' => 'Look One Num',
			'look_two_num' => 'Look Two Num',
			'meet_area_num' => 'Meet Area Num',
			'meet_muit_num' => 'Meet Muit Num',
			'client' => 'Client',
			'sign_area' => 'Sign Area',
			'sign_muit' => 'Sign Muit',
			'see_muit_num' => 'See Muit Num',
			'remark' => 'Remark',
			'ctime' => 'Ctime',
			'url' => 'Url',
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
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('district',$this->district);
		$criteria->compare('group',$this->group);
		$criteria->compare('project_channel',$this->project_channel);
		$criteria->compare('group_channel',$this->group_channel);
		$criteria->compare('estate_channel',$this->estate_channel);
		$criteria->compare('big_channel',$this->big_channel);
		$criteria->compare('other_channel',$this->other_channel);
		$criteria->compare('new_channel_num',$this->new_channel_num);
		$criteria->compare('wechat_channel_num',$this->wechat_channel_num);
		$criteria->compare('phone_num',$this->phone_num);
		$criteria->compare('look_one_num',$this->look_one_num);
		$criteria->compare('look_two_num',$this->look_two_num);
		$criteria->compare('meet_area_num',$this->meet_area_num);
		$criteria->compare('meet_muit_num',$this->meet_muit_num);
		$criteria->compare('client',$this->client);
		$criteria->compare('sign_area',$this->sign_area);
		$criteria->compare('sign_muit',$this->sign_muit);
		$criteria->compare('see_muit_num',$this->see_muit_num);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WechatFollow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
