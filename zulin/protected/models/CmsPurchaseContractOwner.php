<?php

/**
 * This is the model class for table "cms_purchase_contract_owner".
 *
 * The followings are the available columns in table 'cms_purchase_contract_owner':
 * @property string $id
 * @property string $contract_id
 * @property string $owner_id
 * @property integer $ctime
 */
class CmsPurchaseContractOwner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_purchase_contract_owner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctime', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, owner_id', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, owner_id, ctime', 'safe', 'on'=>'search'),
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
			'owner_id' => 'Owner',
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
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('owner_id',$this->owner_id,true);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsPurchaseContractOwner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
