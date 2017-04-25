<?php

/**
 * This is the model class for table "cms_owner_sg".
 *
 * The followings are the available columns in table 'cms_owner_sg':
 * @property string $id
 * @property string $property_id
 * @property string $owner_name
 * @property string $owner_contact
 * @property string $id_card
 * @property integer $owner_gender
 * @property integer $owner_age
 * @property string $owner_city
 * @property string $owner_roots
 * @property string $owner_position
 * @property string $owner_trade
 * @property string $company
 * @property string $business_scope
 * @property string $business_project
 * @property string $company_type
 * @property string $core_project
 * @property integer $people
 * @property string $rel_company
 * @property string $relation_company
 * @property string $friend_company
 * @property string $friend_company1
 * @property integer $deleted
 * @property integer $ctime
 */
class CmsOwnerSg extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_owner_sg';
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
			array('owner_gender, owner_age, people, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, property_id', 'length', 'max'=>36),
			array('owner_name, owner_roots', 'length', 'max'=>10),
			array('owner_contact, business_scope, business_project, company_type, core_project', 'length', 'max'=>255),
			array('id_card', 'length', 'max'=>18),
			array('owner_city, owner_position, owner_trade, company, rel_company, friend_company, friend_company1', 'length', 'max'=>20),
			array('relation_company', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, owner_name, owner_contact, id_card, owner_gender, owner_age, owner_city, owner_roots, owner_position, owner_trade, company, business_scope, business_project, company_type, core_project, people, rel_company, relation_company, friend_company, friend_company1, deleted, ctime', 'safe', 'on'=>'search'),
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
			'property_id' => 'Property',
			'owner_name' => 'Owner Name',
			'owner_contact' => 'Owner Contact',
			'id_card' => 'Id Card',
			'owner_gender' => 'Owner Gender',
			'owner_age' => 'Owner Age',
			'owner_city' => 'Owner City',
			'owner_roots' => 'Owner Roots',
			'owner_position' => 'Owner Position',
			'owner_trade' => 'Owner Trade',
			'company' => 'Company',
			'business_scope' => 'Business Scope',
			'business_project' => 'Business Project',
			'company_type' => 'Company Type',
			'core_project' => 'Core Project',
			'people' => 'People',
			'rel_company' => 'Rel Company',
			'relation_company' => 'Relation Company',
			'friend_company' => 'Friend Company',
			'friend_company1' => 'Friend Company1',
			'deleted' => 'Deleted',
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
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('owner_contact',$this->owner_contact,true);
		$criteria->compare('id_card',$this->id_card,true);
		$criteria->compare('owner_gender',$this->owner_gender);
		$criteria->compare('owner_age',$this->owner_age);
		$criteria->compare('owner_city',$this->owner_city,true);
		$criteria->compare('owner_roots',$this->owner_roots,true);
		$criteria->compare('owner_position',$this->owner_position,true);
		$criteria->compare('owner_trade',$this->owner_trade,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('business_scope',$this->business_scope,true);
		$criteria->compare('business_project',$this->business_project,true);
		$criteria->compare('company_type',$this->company_type,true);
		$criteria->compare('core_project',$this->core_project,true);
		$criteria->compare('people',$this->people);
		$criteria->compare('rel_company',$this->rel_company,true);
		$criteria->compare('relation_company',$this->relation_company,true);
		$criteria->compare('friend_company',$this->friend_company,true);
		$criteria->compare('friend_company1',$this->friend_company1,true);
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
	 * @return CmsOwnerSg the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
