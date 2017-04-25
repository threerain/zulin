<?php

/**
 * This is the model class for table "user_news".
 *
 * The followings are the available columns in table 'user_news':
 * @property string $id
 * @property string $action_user_id
 * @property integer $news_type
 * @property string $news_content_id
 * @property string $news_title
 * @property string $user_news_id
 * @property integer $ctime
 * @property integer $status
 */
class UserNews extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_news';
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
			array('news_type, ctime, status', 'numerical', 'integerOnly'=>true),
			array('id, action_user_id, news_content_id, user_news_id', 'length', 'max'=>36),
			array('news_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, action_user_id, news_type, news_content_id, news_title, user_news_id, ctime, status', 'safe', 'on'=>'search'),
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
			'action_user_id' => '创建人',
			'news_type' => '消息类型多人消息提醒    2=公告 3=收购合同状态发生改变  4=添加或者修改收购合同 5=出车合同状态改变  6=添加或者修改出车合同状态  7=添加销控 8= 移除销控  9=财务发布收款人是谁  10 = 已找到收款人是谁',
			'news_content_id' => '消息内容id',
			'news_title' => '消息标题',
			'user_news_id' => '消息通知给谁',
			'ctime' => 'Ctime',
			'status' => '0=已通知  1=已读  2=删除  3=已知',
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
		$criteria->compare('action_user_id',$this->action_user_id,true);
		$criteria->compare('news_type',$this->news_type);
		$criteria->compare('news_content_id',$this->news_content_id,true);
		$criteria->compare('news_title',$this->news_title,true);
		$criteria->compare('user_news_id',$this->user_news_id,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserNews the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
