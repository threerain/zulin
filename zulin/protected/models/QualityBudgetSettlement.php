<?php

/**
 * This is the model class for table "quality_budget_settlement".
 *
 * The followings are the available columns in table 'quality_budget_settlement':
 * @property string $id
 * @property string $decoration_id
 * @property integer $type
 * @property string $list_material
 * @property string $unit
 * @property string $material_brands
 * @property integer $number
 * @property integer $unit_price
 * @property integer $total
 * @property string $creater_id
 * @property integer $show_order
 * @property integer $ctime
 * @property integer $deleted
 */
class QualityBudgetSettlement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quality_budget_settlement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, decoration_id', 'required'),
			array('type, number, unit_price, total, show_order, ctime, deleted', 'numerical', 'integerOnly'=>true),
			array('id, decoration_id, creater_id', 'length', 'max'=>36),
			array('list_material, material_brands', 'length', 'max'=>255),
			array('unit', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, decoration_id, type, list_material, unit, material_brands, number, unit_price, total, creater_id, show_order, ctime, deleted', 'safe', 'on'=>'search'),
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
			'decoration_id' => 'Decoration',
			'type' => 'Type',
			'list_material' => 'List Material',
			'unit' => 'Unit',
			'material_brands' => 'Material Brands',
			'number' => 'Number',
			'unit_price' => 'Unit Price',
			'total' => 'Total',
			'creater_id' => 'Creater',
			'show_order' => 'Show Order',
			'ctime' => 'Ctime',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('decoration_id',$this->decoration_id,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('list_material',$this->list_material,true);
		$criteria->compare('unit',$this->unit,true);
		$criteria->compare('material_brands',$this->material_brands,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('unit_price',$this->unit_price);
		$criteria->compare('total',$this->total);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('show_order',$this->show_order);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('deleted',$this->deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return QualityBudgetSettlement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
