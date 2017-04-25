<?php

/**
 * This is the model class for table "cms_purchase_contract".
 *
 * The followings are the available columns in table 'cms_purchase_contract':
 * @property string $id
 * @property string $estate_id
 * @property string $building_id
 * @property string $room_number
 * @property integer $room_type
 * @property double $area
 * @property string $property_id
 * @property string $owner
 * @property string $owner_gender
 * @property string $lessee
 * @property string $payee
 * @property string $phone
 * @property integer $contact_information_type
 * @property integer $owner_type
 * @property integer $lessee_type
 * @property string $lessee_company_type
 * @property integer $business_license
 * @property string $business_license_photo
 * @property string $business_license_text
 * @property integer $organization_codexx
 * @property string $organization_code_photoxx
 * @property integer $corporation
 * @property string $corporation_photo
 * @property string $corporation_text
 * @property string $operator
 * @property integer $id_card
 * @property string $id_card_photo
 * @property string $id_card_text
 * @property integer $house_property_card
 * @property string $house_property_card_photo
 * @property string $house_property_card_text
 * @property string $house_property_card_text1
 * @property integer $immovable_authorisation
 * @property string $immovable_authorisation_photo
 * @property string $immovable_authorisation_text
 * @property integer $accredited_representative
 * @property string $accredited_representative_photo
 * @property string $accredited_representative_text
 * @property integer $authorized_id_card
 * @property string $authorized_id_card_photo
 * @property string $authorized_id_card_text
 * @property integer $house_delivery_order
 * @property string $house_delivery_order_photo
 * @property string $house_delivery_order_text
 * @property string $bank
 * @property string $bank_account
 * @property integer $lease_term_start
 * @property integer $lease_term_end
 * @property integer $lease_term_year
 * @property integer $free_lease_term
 * @property integer $deposit
 * @property string $deposit_memo
 * @property integer $deposit_month
 * @property integer $pay_month
 * @property integer $monthly_rent
 * @property integer $day_meter_rentxx
 * @property integer $advance_days
 * @property integer $renewal_period
 * @property integer $property_fee
 * @property integer $heating_fee
 * @property integer $invoice
 * @property integer $tax
 * @property integer $tax_rate
 * @property integer $commission
 * @property integer $commission_unflag
 * @property string $gift_name
 * @property integer $gift_price
 * @property string $salesman_id
 * @property string $channel_id
 * @property string $channel_manager_id
 * @property string $channel_id2
 * @property string $channel_manager_id2
 * @property integer $the_date
 * @property integer $signing_date
 * @property integer $status
 * @property integer $type
 * @property string $purhase_contract_id
 * @property string $addition
 * @property string $memo
 * @property string $lessor
 * @property string $creater_id
 * @property integer $reviewed
 * @property string $reviewer_id
 * @property integer $reviewed_time
 * @property integer $deleted
 * @property string $advance_memo
 * @property integer $corporation_pic
 * @property string $payee_id_card
 * @property string $recycle_id
 * @property integer $commission_tui
 * @property integer $commission_bu
 * @property integer $commission_shou
 * @property string $rent_sum_memo
 * @property integer $rent_sum
 * @property string $property_memo
 * @property integer $papers_ok
 * @property string $other
 * @property integer $cool
 * @property string $pay_memo
 * @property integer $client_id_card
 * @property integer $the_time
 * @property integer $ctime
 * @property integer $free_type
 * @property integer $lease_term_month
 * @property integer $lease_term_day
 * @property integer $deposit_pay_time
 * @property integer $rent_start_time
 * @property integer $rent_second_time
 * @property integer $last_time
 */
class CmsPurchaseContract extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cms_purchase_contract';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('room_type, contact_information_type, owner_type, lessee_type, business_license, organization_codexx, corporation, id_card, house_property_card, immovable_authorisation, accredited_representative, authorized_id_card, house_delivery_order, lease_term_start, lease_term_end, lease_term_year, free_lease_term, deposit, deposit_month, pay_month, monthly_rent, day_meter_rentxx, advance_days, renewal_period, property_fee, heating_fee, invoice, tax, tax_rate, commission, commission_unflag, gift_price, the_date, signing_date, status, type, reviewed, reviewed_time, deleted, corporation_pic, commission_tui, commission_bu, commission_shou, rent_sum, papers_ok, cool, client_id_card, the_time, ctime, free_type, lease_term_month, lease_term_day, deposit_pay_time, rent_start_time, rent_second_time, last_time', 'numerical', 'integerOnly'=>true),
			array('area', 'numerical'),
			array('id, estate_id, building_id, property_id, lessee_company_type, salesman_id, channel_id, channel_id2, channel_manager_id2, purhase_contract_id, creater_id, reviewer_id, recycle_id', 'length', 'max'=>36),
			array('room_number, owner, house_property_card_text1, immovable_authorisation_text, accredited_representative_text, authorized_id_card_text, house_delivery_order_text, bank_account, gift_name, lessor', 'length', 'max'=>50),
			array('owner_gender', 'length', 'max'=>1),
			array('lessee, payee, operator', 'length', 'max'=>20),
			array('phone, business_license_photo, business_license_text, organization_code_photoxx, corporation_photo, corporation_text, id_card_photo, id_card_text, house_property_card_photo, immovable_authorisation_photo, accredited_representative_photo, authorized_id_card_photo, house_delivery_order_photo, bank', 'length', 'max'=>100),
			array('house_property_card_text', 'length', 'max'=>150),
			array('deposit_memo, memo', 'length', 'max'=>200),
			array('channel_manager_id, advance_memo, payee_id_card, rent_sum_memo, property_memo, other, pay_memo', 'length', 'max'=>255),
			array('addition', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, estate_id, building_id, room_number, room_type, area, property_id, owner, owner_gender, lessee, payee, phone, contact_information_type, owner_type, lessee_type, lessee_company_type, business_license, business_license_photo, business_license_text, organization_codexx, organization_code_photoxx, corporation, corporation_photo, corporation_text, operator, id_card, id_card_photo, id_card_text, house_property_card, house_property_card_photo, house_property_card_text, house_property_card_text1, immovable_authorisation, immovable_authorisation_photo, immovable_authorisation_text, accredited_representative, accredited_representative_photo, accredited_representative_text, authorized_id_card, authorized_id_card_photo, authorized_id_card_text, house_delivery_order, house_delivery_order_photo, house_delivery_order_text, bank, bank_account, lease_term_start, lease_term_end, lease_term_year, free_lease_term, deposit, deposit_memo, deposit_month, pay_month, monthly_rent, day_meter_rentxx, advance_days, renewal_period, property_fee, heating_fee, invoice, tax, tax_rate, commission, commission_unflag, gift_name, gift_price, salesman_id, channel_id, channel_manager_id, channel_id2, channel_manager_id2, the_date, signing_date, status, type, purhase_contract_id, addition, memo, lessor, creater_id, reviewed, reviewer_id, reviewed_time, deleted, advance_memo, corporation_pic, payee_id_card, recycle_id, commission_tui, commission_bu, commission_shou, rent_sum_memo, rent_sum, property_memo, papers_ok, other, cool, pay_memo, client_id_card, the_time, ctime, free_type, lease_term_month, lease_term_day, deposit_pay_time, rent_start_time, rent_second_time, last_time', 'safe', 'on'=>'search'),
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
			'estate_id' => '品牌ID 增加property_id字段，此字段冗余',
			'building_id' => '系列ID 增加property_id字段，此字段冗余',
			'room_number' => '增加property_id字段，此字段冗余',
			'room_type' => '车源类型 1=轿车 2=客车 3=SUV 增加property_id字段，此字段冗余',
			'area' => '积面 增加property_id字段，此字段冗余',
			'property_id' => '车源编号',
			'owner' => '车主',
			'owner_gender' => '车主性别  产权人为个人时使用',
			'lessee' => '承租人',
			'payee' => '收款人(车主)',
			'phone' => '联系人系联方式 手机号等',
			'contact_information_type' => '联系方式类型 1=联系车主 2=联系代理人',
			'owner_type' => '车主类型 1=公司 2=个人',
			'lessee_type' => '承租人类型  1=公司 2=个人',
			'lessee_company_type' => '承租公司类型',
			'business_license' => '营业执照  车主为公司 0无 1有',
			'business_license_photo' => '营业执照照片  主业为公司',
			'business_license_text' => '营业执照文字说明',
			'organization_codexx' => '组代  主业为公司 0无 1有  此字段废弃',
			'organization_code_photoxx' => '组代 照片  此字段废弃',
			'corporation' => '法人 主业为公司 0无 1有',
			'corporation_photo' => '法人 照片',
			'corporation_text' => '法人 文字说明',
			'operator' => '经办人 主业为公司',
			'id_card' => '身份证  车主为个人 0无 1有',
			'id_card_photo' => '身份证 照片',
			'id_card_text' => '身份证业  车主为个人 文字说明',
			'house_property_card' => '房产证  0无 1有',
			'house_property_card_photo' => '房产证 照片',
			'house_property_card_text' => '房产证 文字说明',
			'house_property_card_text1' => 'House Property Card Text1',
			'immovable_authorisation' => '不动产授权委托书   0无 1有',
			'immovable_authorisation_photo' => '不动产授权委托书 照片',
			'immovable_authorisation_text' => '不动产授权委托书 文字说明',
			'accredited_representative' => '车主授权代理人委托书 0=无 1=有',
			'accredited_representative_photo' => '车主授权代理人委托书 照片',
			'accredited_representative_text' => '车主授权代理人委托书 文字说明',
			'authorized_id_card' => '委托人身份证复  0=无 1=有',
			'authorized_id_card_photo' => '委托人身份证复 照片',
			'authorized_id_card_text' => '委托人身份证复 文字说明',
			'house_delivery_order' => '车源交割单  0=无 1=有',
			'house_delivery_order_photo' => '车源交割单 照片',
			'house_delivery_order_text' => '车源交割单 文字说明',
			'bank' => '开户行（车主） 改为银行',
			'bank_account' => '银行账号  此字段已废弃',
			'lease_term_start' => '租期开始时间',
			'lease_term_end' => '租期结束时间',
			'lease_term_year' => '租期 单位：年',
			'free_lease_term' => '免租期 单位 天',
			'deposit' => '押金',
			'deposit_memo' => '押金备注？？压几付几',
			'deposit_month' => '押金几个月 付款方式一部分',
			'pay_month' => '付租金几个月 付款方式一部分',
			'monthly_rent' => '月租金',
			'day_meter_rentxx' => '价单 /m/d  此字段废弃',
			'advance_days' => '提前几天付款',
			'renewal_period' => '续约期限',
			'property_fee' => '物业费 0=不含物业费 1=含物业费',
			'heating_fee' => '取暖费 0=不含取暖费 1=含取暖费',
			'invoice' => '发票 0=不含发票 1=含发票',
			'tax' => '税金 单位：分',
			'tax_rate' => '税率 %',
			'commission' => '佣金金额',
			'commission_unflag' => '佣金合同未标注 0=否 1=是',
			'gift_name' => '礼品名',
			'gift_price' => '礼品金额 单位：分',
			'salesman_id' => '司公业务员ID（市场部签约人）',
			'channel_id' => '渠道商ID 出车合同里渠道人员2个',
			'channel_manager_id' => '片区负责人ID（渠道人员姓名 外公司） 出车合同里渠道人员2个',
			'channel_id2' => '渠道商ID2',
			'channel_manager_id2' => '片区负责人ID2（渠道人员姓名 外公司）',
			'the_date' => '收房日\出车日',
			'signing_date' => '签约日',
			'status' => '同合状态 0=正常 1=到期退租 2=中途违约 3=提前续租',
			'type' => '合同类型 0=收房合同 1=出车合同',
			'purhase_contract_id' => '收房合同ID 仅出车合同使用 ',
			'addition' => '补充条款',
			'memo' => 'Memo',
			'lessor' => '出租人 出车合同使用',
			'creater_id' => '入录人员',
			'reviewed' => '审核状态 0未审核 1=审核通过',
			'reviewer_id' => '审核人',
			'reviewed_time' => '核审时间',
			'deleted' => 'Deleted',
			'advance_memo' => '提前几天交钱的备注',
			'corporation_pic' => '法人图片打勾来确定有无图片的',
			'payee_id_card' => '收款人身份证',
			'recycle_id' => '客户收房人',
			'commission_tui' => '华亮退回幼狮佣金明细',
			'commission_bu' => '华亮补给幼狮佣金明细',
			'commission_shou' => '华亮退回幼狮佣金明细',
			'rent_sum_memo' => '总应付租金备注',
			'rent_sum' => '总应付租金',
			'property_memo' => '物业费备注',
			'papers_ok' => '证件是否全',
			'other' => '物业后面其他',
			'cool' => 'Cool',
			'pay_memo' => '付款方式备注',
			'client_id_card' => '租户身份证是否上传',
			'the_time' => 'The Time',
			'ctime' => '创建时间',
			'free_type' => '1=期外免租 2=期内免租',
			'lease_term_month' => 'Lease Term Month',
			'lease_term_day' => 'Lease Term Day',
			'deposit_pay_time' => 'Deposit Pay Time',
			'rent_start_time' => 'Rent Start Time',
			'rent_second_time' => 'Rent Second Time',
			'last_time' => 'Last Time',
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
		$criteria->compare('estate_id',$this->estate_id,true);
		$criteria->compare('building_id',$this->building_id,true);
		$criteria->compare('room_number',$this->room_number,true);
		$criteria->compare('room_type',$this->room_type);
		$criteria->compare('area',$this->area);
		$criteria->compare('property_id',$this->property_id,true);
		$criteria->compare('owner',$this->owner,true);
		$criteria->compare('owner_gender',$this->owner_gender,true);
		$criteria->compare('lessee',$this->lessee,true);
		$criteria->compare('payee',$this->payee,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('contact_information_type',$this->contact_information_type);
		$criteria->compare('owner_type',$this->owner_type);
		$criteria->compare('lessee_type',$this->lessee_type);
		$criteria->compare('lessee_company_type',$this->lessee_company_type,true);
		$criteria->compare('business_license',$this->business_license);
		$criteria->compare('business_license_photo',$this->business_license_photo,true);
		$criteria->compare('business_license_text',$this->business_license_text,true);
		$criteria->compare('organization_codexx',$this->organization_codexx);
		$criteria->compare('organization_code_photoxx',$this->organization_code_photoxx,true);
		$criteria->compare('corporation',$this->corporation);
		$criteria->compare('corporation_photo',$this->corporation_photo,true);
		$criteria->compare('corporation_text',$this->corporation_text,true);
		$criteria->compare('operator',$this->operator,true);
		$criteria->compare('id_card',$this->id_card);
		$criteria->compare('id_card_photo',$this->id_card_photo,true);
		$criteria->compare('id_card_text',$this->id_card_text,true);
		$criteria->compare('house_property_card',$this->house_property_card);
		$criteria->compare('house_property_card_photo',$this->house_property_card_photo,true);
		$criteria->compare('house_property_card_text',$this->house_property_card_text,true);
		$criteria->compare('house_property_card_text1',$this->house_property_card_text1,true);
		$criteria->compare('immovable_authorisation',$this->immovable_authorisation);
		$criteria->compare('immovable_authorisation_photo',$this->immovable_authorisation_photo,true);
		$criteria->compare('immovable_authorisation_text',$this->immovable_authorisation_text,true);
		$criteria->compare('accredited_representative',$this->accredited_representative);
		$criteria->compare('accredited_representative_photo',$this->accredited_representative_photo,true);
		$criteria->compare('accredited_representative_text',$this->accredited_representative_text,true);
		$criteria->compare('authorized_id_card',$this->authorized_id_card);
		$criteria->compare('authorized_id_card_photo',$this->authorized_id_card_photo,true);
		$criteria->compare('authorized_id_card_text',$this->authorized_id_card_text,true);
		$criteria->compare('house_delivery_order',$this->house_delivery_order);
		$criteria->compare('house_delivery_order_photo',$this->house_delivery_order_photo,true);
		$criteria->compare('house_delivery_order_text',$this->house_delivery_order_text,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('bank_account',$this->bank_account,true);
		$criteria->compare('lease_term_start',$this->lease_term_start);
		$criteria->compare('lease_term_end',$this->lease_term_end);
		$criteria->compare('lease_term_year',$this->lease_term_year);
		$criteria->compare('free_lease_term',$this->free_lease_term);
		$criteria->compare('deposit',$this->deposit);
		$criteria->compare('deposit_memo',$this->deposit_memo,true);
		$criteria->compare('deposit_month',$this->deposit_month);
		$criteria->compare('pay_month',$this->pay_month);
		$criteria->compare('monthly_rent',$this->monthly_rent);
		$criteria->compare('day_meter_rentxx',$this->day_meter_rentxx);
		$criteria->compare('advance_days',$this->advance_days);
		$criteria->compare('renewal_period',$this->renewal_period);
		$criteria->compare('property_fee',$this->property_fee);
		$criteria->compare('heating_fee',$this->heating_fee);
		$criteria->compare('invoice',$this->invoice);
		$criteria->compare('tax',$this->tax);
		$criteria->compare('tax_rate',$this->tax_rate);
		$criteria->compare('commission',$this->commission);
		$criteria->compare('commission_unflag',$this->commission_unflag);
		$criteria->compare('gift_name',$this->gift_name,true);
		$criteria->compare('gift_price',$this->gift_price);
		$criteria->compare('salesman_id',$this->salesman_id,true);
		$criteria->compare('channel_id',$this->channel_id,true);
		$criteria->compare('channel_manager_id',$this->channel_manager_id,true);
		$criteria->compare('channel_id2',$this->channel_id2,true);
		$criteria->compare('channel_manager_id2',$this->channel_manager_id2,true);
		$criteria->compare('the_date',$this->the_date);
		$criteria->compare('signing_date',$this->signing_date);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type);
		$criteria->compare('purhase_contract_id',$this->purhase_contract_id,true);
		$criteria->compare('addition',$this->addition,true);
		$criteria->compare('memo',$this->memo,true);
		$criteria->compare('lessor',$this->lessor,true);
		$criteria->compare('creater_id',$this->creater_id,true);
		$criteria->compare('reviewed',$this->reviewed);
		$criteria->compare('reviewer_id',$this->reviewer_id,true);
		$criteria->compare('reviewed_time',$this->reviewed_time);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('advance_memo',$this->advance_memo,true);
		$criteria->compare('corporation_pic',$this->corporation_pic);
		$criteria->compare('payee_id_card',$this->payee_id_card,true);
		$criteria->compare('recycle_id',$this->recycle_id,true);
		$criteria->compare('commission_tui',$this->commission_tui);
		$criteria->compare('commission_bu',$this->commission_bu);
		$criteria->compare('commission_shou',$this->commission_shou);
		$criteria->compare('rent_sum_memo',$this->rent_sum_memo,true);
		$criteria->compare('rent_sum',$this->rent_sum);
		$criteria->compare('property_memo',$this->property_memo,true);
		$criteria->compare('papers_ok',$this->papers_ok);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('cool',$this->cool);
		$criteria->compare('pay_memo',$this->pay_memo,true);
		$criteria->compare('client_id_card',$this->client_id_card);
		$criteria->compare('the_time',$this->the_time);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('free_type',$this->free_type);
		$criteria->compare('lease_term_month',$this->lease_term_month);
		$criteria->compare('lease_term_day',$this->lease_term_day);
		$criteria->compare('deposit_pay_time',$this->deposit_pay_time);
		$criteria->compare('rent_start_time',$this->rent_start_time);
		$criteria->compare('rent_second_time',$this->rent_second_time);
		$criteria->compare('last_time',$this->last_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CmsPurchaseContract the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
