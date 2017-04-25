<?php

/**
 * This is the model class for table "admin_position_modul".
 *
 * The followings are the available columns in table 'admin_position_modul':
 * @property string $id
 * @property string $position_id
 * @property string $modul_id
 * @property string $create_user_id
 * @property integer $deleted
 * @property integer $ctime
 */
class AdminPositionModul extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'admin_position_modul';
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
			array('deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, position_id, modul_id, create_user_id', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, position_id, modul_id, create_user_id, deleted, ctime', 'safe', 'on'=>'search'),
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
			'position_id' => '职务ID',
			'modul_id' => '模块ID',
			'create_user_id' => '创建人ID',
			'deleted' => '删除标记 0=初始 1=已删除',
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
		$criteria->compare('position_id',$this->position_id,true);
		$criteria->compare('modul_id',$this->modul_id,true);
		$criteria->compare('create_user_id',$this->create_user_id,true);
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
	 * @return AdminPositionModul the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function show_menu($uid,$type)
	{

		// $user_position=AdminUserPosition::model()->find("user_id='$uid'"); //用户职务
		$user_position=AdminUser::model()->find("id='$uid'");
		// var_dump($uid,$type,$user_position->position_id);
		// die();

		if ($user_position->type==0){
			return true;
		}
		if ($user_position){
			$position_moduls=AdminPositionModul::model()->findAll("position_id='$user_position->position_id'");  //职务权限
			if($position_moduls){

				$modul=AdminModul::model()->find("type='$type'");
				$moduls_id=$modul->id;
				$moduls_id=substr($moduls_id, 0,2);  //权限ID的第一位标识模块

				$has=false;

				foreach ($position_moduls as $key => $value) {
					if (substr($value->modul_id, 0,2)== $moduls_id){
						return true;
					}
				}

				return $has;
			}
			else {
				return false;
			}
		}
		else{
			return false;
		}
	}
	/*
	是否有权限
	*/
	public static function has_modul($modul_id)
	{
		$uid=Yii::app()->session['admin_uid'];
		// $user_position=AdminUserPosition::model()->find("user_id='$uid'"); //用户职务
		$user_position=AdminUser::model()->find("id='$uid'");
		if ($user_position->type==0){
			return true;
		}

		if ($user_position){
			$position_moduls=AdminPositionModul::model()->find("position_id='$user_position->position_id' and modul_id='$modul_id'");  //职务权限
			if($position_moduls){
				return true;
			}
			else {
				return false;
			}
		}
		else{
			return false;
		}
	}



}
