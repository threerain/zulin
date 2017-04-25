<?php

/**
 * This is the model class for table "cms_company".
 *
 * The followings are the available columns in table 'cms_company':
 * @property string $id
 * @property string $contract_id
 * @property string $company_name
 * @property string $corporation
 * @property string $corporation_gender
 * @property string $corporation_id_card
 * @property string $contractor
 * @property string $contractor_phone
 * @property integer $ctime
 * @property string $contractor_id_card
 * @property string $contractor_gender
 */
class CmsCompany extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_company';
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
			array('ctime', 'numerical', 'integerOnly'=>true),
			array('id, contract_id, corporation, contractor, contractor_phone', 'length', 'max'=>36),
			array('company_name', 'length', 'max'=>50),
			array('corporation_gender, contractor_gender', 'length', 'max'=>1),
			array('corporation_id_card, contractor_id_card', 'length', 'max'=>18),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contract_id, company_name, corporation, corporation_gender, corporation_id_card, contractor, contractor_phone, ctime, contractor_id_card, contractor_gender', 'safe', 'on'=>'search'),
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
			'company_name' => 'Company Name',
			'corporation' => 'Corporation',
			'corporation_gender' => 'Corporation Gender',
			'corporation_id_card' => 'Corporation Id Card',
			'contractor' => 'Contractor',
			'contractor_phone' => 'Contractor Phone',
			'ctime' => 'Ctime',
			'contractor_id_card' => 'Contractor Id Card',
			'contractor_gender' => 'Contractor Gender',
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('corporation',$this->corporation,true);
		$criteria->compare('corporation_gender',$this->corporation_gender,true);
		$criteria->compare('corporation_id_card',$this->corporation_id_card,true);
		$criteria->compare('contractor',$this->contractor,true);
		$criteria->compare('contractor_phone',$this->contractor_phone,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('contractor_id_card',$this->contractor_id_card,true);
		$criteria->compare('contractor_gender',$this->contractor_gender,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
