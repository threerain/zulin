<?php

/**
 * This is the model class for table "cms_property_detail".
 *
 * The followings are the available columns in table 'cms_property_detail':
 * @property string $id
 * @property string $property_id
 * @property integer $width
 * @property integer $height
 * @property integer $area_one
 * @property integer $sum_area
 * @property integer $ti
 * @property integer $hu
 * @property integer $sunshine
 * @property integer $french_window
 * @property integer $crutch
 * @property integer $door
 * @property integer $spray
 * @property integer $hide
 * @property integer $leak
 * @property integer $house_same
 * @property integer $corridor_toilet
 * @property integer $other_rentor
 * @property integer $original_decoration
 * @property integer $toplight
 * @property integer $ground
 * @property integer $baseboard
 * @property integer $logo_front
 * @property integer $plug
 * @property integer $door_window
 * @property integer $room_layout
 * @property integer $ceiling
 * @property integer $lamp
 * @property integer $wall
 * @property integer $partition
 * @property integer $deleted
 * @property integer $ctime
 */
class CmsPropertyDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_property_detail';
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
			array('width, height, area_one, sum_area, ti, hu, sunshine, french_window, crutch, door, spray, hide, leak, house_same, corridor_toilet, other_rentor, original_decoration, toplight, ground, baseboard, logo_front, plug, door_window, room_layout, ceiling, lamp, wall, partition, deleted, ctime', 'numerical', 'integerOnly'=>true),
			array('id, property_id', 'length', 'max'=>36),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, property_id, width, height, area_one, sum_area, ti, hu, sunshine, french_window, crutch, door, spray, hide, leak, house_same, corridor_toilet, other_rentor, original_decoration, toplight, ground, baseboard, logo_front, plug, door_window, room_layout, ceiling, lamp, wall, partition, deleted, ctime', 'safe', 'on'=>'search'),
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
			'width' => 'Width',
			'height' => 'Height',
			'area_one' => 'Area One',
			'sum_area' => 'Sum Area',
			'ti' => 'Ti',
			'hu' => 'Hu',
			'sunshine' => 'Sunshine',
			'french_window' => 'French Window',
			'crutch' => 'Crutch',
			'door' => 'Door',
			'spray' => 'Spray',
			'hide' => 'Hide',
			'leak' => 'Leak',
			'house_same' => 'House Same',
			'corridor_toilet' => 'Corridor Toilet',
			'other_rentor' => 'Other Rentor',
			'original_decoration' => 'Original Decoration',
			'toplight' => 'Toplight',
			'ground' => 'Ground',
			'baseboard' => 'Baseboard',
			'logo_front' => 'Logo Front',
			'plug' => 'Plug',
			'door_window' => 'Door Window',
			'room_layout' => 'Room Layout',
			'ceiling' => 'Ceiling',
			'lamp' => 'Lamp',
			'wall' => 'Wall',
			'partition' => 'Partition',
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
		$criteria->compare('width',$this->width);
		$criteria->compare('height',$this->height);
		$criteria->compare('area_one',$this->area_one);
		$criteria->compare('sum_area',$this->sum_area);
		$criteria->compare('ti',$this->ti);
		$criteria->compare('hu',$this->hu);
		$criteria->compare('sunshine',$this->sunshine);
		$criteria->compare('french_window',$this->french_window);
		$criteria->compare('crutch',$this->crutch);
		$criteria->compare('door',$this->door);
		$criteria->compare('spray',$this->spray);
		$criteria->compare('hide',$this->hide);
		$criteria->compare('leak',$this->leak);
		$criteria->compare('house_same',$this->house_same);
		$criteria->compare('corridor_toilet',$this->corridor_toilet);
		$criteria->compare('other_rentor',$this->other_rentor);
		$criteria->compare('original_decoration',$this->original_decoration);
		$criteria->compare('toplight',$this->toplight);
		$criteria->compare('ground',$this->ground);
		$criteria->compare('baseboard',$this->baseboard);
		$criteria->compare('logo_front',$this->logo_front);
		$criteria->compare('plug',$this->plug);
		$criteria->compare('door_window',$this->door_window);
		$criteria->compare('room_layout',$this->room_layout);
		$criteria->compare('ceiling',$this->ceiling);
		$criteria->compare('lamp',$this->lamp);
		$criteria->compare('wall',$this->wall);
		$criteria->compare('partition',$this->partition);
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
	 * @return CmsPropertyDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
