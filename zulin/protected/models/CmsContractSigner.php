<?php

/**
 * This is the model class for table "cms_contract_signer".
 *
 * The followings are the available columns in table 'cms_contract_signer':
 * @property integer $id
 * @property string $signer
 * @property string $contract_id
 * @property string $type
 * @property integer $ctime
 * @property integer $sign_date
 * @property integer $deleted
 */
class CmsContractSigner extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_contract_signer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctime, sign_date, deleted', 'numerical', 'integerOnly'=>true),
			array('signer, contract_id', 'length', 'max'=>36),
			array('type', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, signer, contract_id, type, ctime, sign_date, deleted', 'safe', 'on'=>'search'),
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
			'signer' => 'Signer',
			'contract_id' => 'Contract',
			'type' => 'Type',
			'ctime' => 'Ctime',
			'sign_date' => 'Sign Date',
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
		$criteria->compare('signer',$this->signer,true);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('sign_date',$this->sign_date);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsContractSigner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
