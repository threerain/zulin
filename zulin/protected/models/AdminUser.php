<?php

/**
 * This is the model class for table "admin_user".
 *
 * The followings are the available columns in table 'admin_user':
 * @property string $id
 * @property string $account
 * @property string $password
 * @property string $nickname
 * @property string $department_id
 * @property string $position_id
 * @property string $avatar
 * @property string $gender
 * @property string $birth_year
 * @property string $birth_month
 * @property string $birth_day
 * @property integer $birthday
 * @property string $phone
 * @property string $id_card
 * @property string $id_card_img
 * @property string $bank
 * @property string $bank_card
 * @property string $bank_card_img
 * @property string $work_no
 * @property string $address
 * @property string $create_user_id
 * @property integer $last_login_time
 * @property integer $type
 * @property integer $status
 * @property integer $source
 * @property integer $deleted
 * @property integer $ctime
 * @property integer $login_time
 */
class AdminUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('birthday, last_login_time, type, status, source, deleted, ctime, login_time', 'numerical', 'integerOnly'=>true),
			array('id, department_id, position_id, create_user_id', 'length', 'max'=>36),
			array('account, nickname, id_card, bank, work_no', 'length', 'max'=>20),
			array('password', 'length', 'max'=>32),
			array('avatar, id_card_img, bank_card_img, address', 'length', 'max'=>100),
			array('gender', 'length', 'max'=>1),
			array('birth_year', 'length', 'max'=>4),
			array('birth_month, birth_day', 'length', 'max'=>2),
			array('phone', 'length', 'max'=>11),
			array('bank_card', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, account, password, nickname, department_id, position_id, avatar, gender, birth_year, birth_month, birth_day, birthday, phone, id_card, id_card_img, bank, bank_card, bank_card_img, work_no, address, create_user_id, last_login_time, type, status, source, deleted, ctime, login_time', 'safe', 'on'=>'search'),
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
			'account' => 'Account',
			'password' => 'Password',
			'nickname' => 'Nickname',
			'department_id' => 'Department',
			'position_id' => 'Position',
			'avatar' => 'Avatar',
			'gender' => 'Gender',
			'birth_year' => 'Birth Year',
			'birth_month' => 'Birth Month',
			'birth_day' => 'Birth Day',
			'birthday' => 'Birthday',
			'phone' => 'Phone',
			'id_card' => 'Id Card',
			'id_card_img' => 'Id Card Img',
			'bank' => 'Bank',
			'bank_card' => 'Bank Card',
			'bank_card_img' => 'Bank Card Img',
			'work_no' => 'Work No',
			'address' => 'Address',
			'create_user_id' => 'Create User',
			'last_login_time' => 'Last Login Time',
			'type' => 'Type',
			'status' => 'Status',
			'source' => 'Source',
			'deleted' => 'Deleted',
			'ctime' => 'Ctime',
			'login_time' => 'Login Time',
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
		$criteria->compare('account',$this->account,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('department_id',$this->department_id,true);
		$criteria->compare('position_id',$this->position_id,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('birth_year',$this->birth_year,true);
		$criteria->compare('birth_month',$this->birth_month,true);
		$criteria->compare('birth_day',$this->birth_day,true);
		$criteria->compare('birthday',$this->birthday);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('id_card',$this->id_card,true);
		$criteria->compare('id_card_img',$this->id_card_img,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('bank_card',$this->bank_card,true);
		$criteria->compare('bank_card_img',$this->bank_card_img,true);
		$criteria->compare('work_no',$this->work_no,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('create_user_id',$this->create_user_id,true);
		$criteria->compare('last_login_time',$this->last_login_time);
		$criteria->compare('type',$this->type);
		$criteria->compare('status',$this->status);
		$criteria->compare('source',$this->source);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('login_time',$this->login_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AdminUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
