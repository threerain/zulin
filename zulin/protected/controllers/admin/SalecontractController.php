
<?php

/*
出车合同
*/

class SalecontractController extends BackgroundBaseController
{
    //const PAGE_SIZE = 20;
    //protected function beforeRender($view)
    //{
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/ui/js/admin/faxingorder.js",CClientScript::POS_END );
    //    return true;
    //}
    public $contract_id = 0;
    public function actionIndex(){
		$k_id=Yii::app()->request->getParam("k_id");
        $k_estates=Yii::app()->request->getParam("k_estates");
        $news_type=Yii::app()->request->getParam("news_type");//消息提醒类型
        $news_content_id=Yii::app()->request->getParam("news_content_id");//消息内容id
        $news_id=Yii::app()->request->getParam("news_id");//消息内容id
        $k_building=Yii::app()->request->getParam("k_building");
        $k_room_number=Yii::app()->request->getParam("k_room_number");
        $k_lessee_type=Yii::app()->request->getParam("k_lessee_type");
        $k_admin=Yii::app()->request->getParam("k_admin");
		$k_status=Yii::app()->request->getParam("k_status");
		$k_papers_ok=Yii::app()->request->getParam("k_papers_ok");
		$k_ctime1=Yii::app()->request->getParam("k_ctime1");
		$k_ctime2=Yii::app()->request->getParam("k_ctime2");
		$k_signing_date1=Yii::app()->request->getParam("k_signing_date1");
        $k_signing_date2=Yii::app()->request->getParam("k_signing_date2");
        $lessor=Yii::app()->request->getParam("lessor");
		$reviewed=Yii::app()->request->getParam("reviewed");

        $pagesize=10;

	   /*
            根据车源查出车源的ID对应上合同
         */
        //如果车源三个参数齐全查出固定的合同
		$proarr1=[];
		$proarr2=[];
		$proarr3=[];
		//papers_ok
        //品牌
        if($k_estates){
            $estates=BaseEstate::model()->findAll("name like '%".$k_estates."%' and deleted=0");
			if($estates){
				$estates_id="";
				foreach ($estates as $key => $value) {
					if ($key==0){
						$estates_id.="'".$value->id."'";
					}
					else{
						$estates_id.=","."'".$value->id."'";
					}
				}
				$property=CmsProperty::model()->findAll("estate_id in ($estates_id)");
				foreach ($property as $key => $value) {
						$proarr1[] = $value->id;
				}
			}
        }

        //系列
        if($k_building){
			$building=BaseBuilding::model()->findAll("name like '%".$k_building."%'  and deleted=0");
			if($building){
				$building_id="";
				foreach ($building as $key => $value) {
					if ($key==0){
						$building_id.="'".$value->id."'";
					}
					else{
						$building_id.=","."'".$value->id."'";
					}
				}
				$property2=CmsProperty::model()->findAll("building_id in ($building_id)");
				foreach ($property2 as $key => $value) {
					$proarr2[] = $value->id;
				}
			}
        }

        //编号
        if($k_room_number){
            $property3=CmsProperty::model()->findAll("house_no like '%".$k_room_number."%' and deleted=0");
            foreach ($property3 as $key => $value) {
                $proarr3[] = $value->id;
            }
        }

        if(!empty($k_estates) && !empty($k_building) && !empty($k_room_number)){
            $res_arr = array_intersect($proarr1,$proarr2,$proarr3);
        }else if(!empty($k_estates) && !empty($k_building)){
            $res_arr = array_intersect($proarr1,$proarr2);
        }else if(!empty($k_building) && !empty($k_room_number)){
            $res_arr = array_intersect($proarr2,$proarr3);
        }else if(!empty($k_estates) && !empty($k_room_number)){
            $res_arr = array_intersect($proarr1,$proarr3);
        }else{
            $res_arr=array_merge($proarr1,$proarr2,$proarr3);
        }
		$data=[];
		foreach($res_arr as $value ){
			$data[]=$value;
		}

        $property_id='';
        foreach ($data as $key => $value) {
            if ($key==0){
                $property_id.="'".$value."'";
            }
            else{
                $property_id.=","."'".$value."'";
            }
        }

		$contract_id="";
		if($property_id){
			$res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.")");
			foreach($res as $key=>$value){
				//$contract_id[]=$value;
				if ($key==0){
					$contract_id.="'".$value->contract_id."'";
				}
				else{
					$contract_id.=","."'".$value->contract_id."'";
				}
			}

		}

		//录入人
        $admin=AdminUser::model()->findAll("nickname like '%".$k_admin."%'");
        $admin_id="";
        foreach ($admin as $key => $value) {
            if ($key==0){
                $admin_id.="'".$value->id."'";
            }
            else{
                $admin_id.=","."'".$value->id."'";
            }

        }
        $search = $k_id.$k_estates.$k_building.$k_room_number.$k_lessee_type.$k_admin.$k_papers_ok.$k_ctime1.$k_ctime2.$k_signing_date1.$k_signing_date2.$lessor.$reviewed;
        //如果搜索条件为空，则显示全部
        if($search==''){
            $condition="1=1 and t.deleted=0 and type=1 ";
        //如果搜索房间信息并且为空，
        }elseif($k_estates.$k_building.$k_room_number!=''){
            if($contract_id==''){
                $condition = '1=0';
            }else{
                $condition="1=1 and t.deleted=0 and type=1 ";
            }
        //如果不搜索房间信息
        }else{
            $condition="1=1 and t.deleted=0 and type=1 ";
        }
        //新建或修改收房合同  收房合同状态发生改变  消息提醒
        if(!empty($news_type) && !empty($news_content_id) && !empty($news_id)){
            $usernews = UserNews::model()->find("1=1 and id= '$news_id' and user_news_id = '{$_SESSION['admin_uid']}'");
            if(!empty($usernews)){
                $condition.= " and id ='$news_content_id' ";
            }else{
                $this->redirect('/admin/home');
            }
        }
        $condition.=" and  ( 1=1  ";
        //合同ID搜索
        if ($k_id){
            $condition.= " and id like ('%".$k_id."%') ";
        }

        //品牌,系列,编号搜索
        if($contract_id){
            $condition.= " and  id in ($contract_id) ";
        }

        //承租人
        if ($k_lessee_type) {
            $condition.=" and lessee_type ='$k_lessee_type' ";
        }
        if ($lessor) {
            $condition.=" and lessor like ('%".$lessor."%') ";
        }
        //录入人
        if ($k_admin) {
            if($admin_id){
                $condition.=" and creater_id in (".$admin_id.")";
            }else{
                $condition = '(1=0';
            }
        }

        //状态
        if ($k_status!='') {
            $condition.=" and status ='$k_status' ";
        }

        //证件
        if ($k_papers_ok) {
            $condition.=" and papers_ok = '$k_papers_ok' ";
        }
        if ($reviewed!='') {
            $condition.=" and reviewed = '$reviewed' ";
        }
        //录入时间
        $k_start=strtotime($k_ctime1);
        $k_end=strtotime($k_ctime2)+24*3600;
        if ($k_ctime1) {
            $condition.=" and ctime >= '$k_start' ";
        }
        if ($k_ctime2) {
            $condition.=" and ctime <= '$k_end' ";
        }

        //签约日期
        $k_signing_start=strtotime($k_signing_date1);
        $k_signing_end=strtotime($k_signing_date2)+24*3600;
        if ($k_signing_date1) {
            $condition.=" and signing_date >= '$k_signing_start' ";
        }
        if ($k_signing_date2) {
            $condition.=" and signing_date <= '$k_signing_end' ";
        }

        $admin_uid = Yii::app()->session['admin_uid'];
        $admin = AdminUser::model()->find("id='$admin_uid'");
        if($admin->type!=0){
            //查看本人签约合同
            if(AdminPositionModul::has_modul("1103_06")) {
                $name = Yii::app()->session['admin_uid'];

                $condition .= " and salesman_id = '$name' ";

            }

            //查看本商圈的合同
            if(AdminPositionModul::has_modul("1103_07")) {
              $admin_uid = Yii::app()->session['admin_uid'];
              $area_id = AdminUser::model()->find("id='$admin_uid'");
              $area_name1 = AdminDepartment::model()->find("id='$area_id->department_id'");
              $de_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");
              if($de_name->name == '销售部') {
                  $area_name = $area_name1;
              }
              if($area_name) {
                $base_id = BaseArea::model()->find("name='$area_name->name'");
                if($base_id!=null) {
                  $name = CmsProperty::model()->findAll("area_id='$base_id->id'");
                  if($name!=null) {
                        $contract_id1 = [];

                        foreach($name as $key => $value) {
                            $date=CmsPurchaseProperty::model()->find("property_id='$value->id' and deleted=0 and type=1");
                            $contract_id1[]= $date->contract_id;
                        }
                        $contract_id1=implode("','",$contract_id1);
                        $contract_id1="'$contract_id1'";
                        if($contract_id1!= null) {
                              $condition.=" and id in ($contract_id1)";
                        }
                  }
                }
              }
            }


        }
        $condition.=")";

        $criteria=new CDbCriteria;
        // if($keyword){
        //     $criteria->addCondition("t.room_number like '%$keyword%' ");
        // }
        // $criteria->addCondition("t.deleted=0  and type=1");
        $criteria->condition=$condition;
        $criteria->order="t.last_time desc";
        $count=CmsPurchaseContract::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list = CmsPurchaseContract::model()->findAll($criteria);
        if(!empty($news_type) && !empty($news_content_id) && !empty($news_id)){
            $modelnewss = UserNews::model()->find("id='$news_id' and user_news_id='{$_SESSION['admin_uid']}'");
            $modelnewss->status = 1;
            $modelnewss->save();
            if(empty($list)){
                $alert_error = 6;
                $this->redirect("/admin/usernews?alert_error=".$alert_error.'&news_type='.$news_type);
            }
        }
        if($reviewed!=''){
            $reviewed = (int)$reviewed;
        }
        if($k_status!=''){
            $k_status = (int)$k_status;
        }
        $search=Yii::app()->request->getParam("search");

            $this->render('index',array(
                'list'=>$list,
                'pages'=>$pager,
                'k_id'=>$k_id,
                'k_estates'=>$k_estates,
                'k_building'=>$k_building,
                'k_room_number'=>$k_room_number,
    			'k_lessee_type'=>$k_lessee_type,
                'k_admin'=>$k_admin,
    			'k_status'=>$k_status,
    			'k_papers_ok'=>$k_papers_ok,
                'k_ctime1'=>$k_ctime1,
                'k_ctime2'=>$k_ctime2,
    			'k_signing_date1'=>$k_signing_date1,
                'k_signing_date2'=>$k_signing_date2,
                'lessor'=>$lessor,
                'news_type'=>$news_type,
                'news_content_id'=>$news_content_id,
                'search'=>$search,
                'reviewed'=>$reviewed,
    		));

    }

    public function actionCreate(){
        $referer=$_SERVER['HTTP_REFERER'];
        $this->render("create",array(
            'referer'=>$referer,
        ));
    }
    public function actionCreateSave(){
        /*获取参数*/

        $referer=$_SERVER['HTTP_REFERER'];
        $property_id =Yii::app()->request->getParam("property_id");
        $papers_ok =Yii::app()->request->getParam("papers_ok");
        $property_ids = $property_id;
        $lease_term_month = Yii::app()->request->getParam('lease_term_month');
        $lease_term_day = Yii::app()->request->getParam('lease_term_day');
        $free_type = Yii::app()->request->getParam('free_type');

        $wuye_money =Yii::app()->request->getParam("wuye_money"); //物业费数组
        $wuye_start =Yii::app()->request->getParam("wuye_start"); //物业费付款开始时间数组
        $wuye_end =Yii::app()->request->getParam("wuye_end"); //物业费付款结束时间数组

        $qunuan_money =Yii::app()->request->getParam("qunuan_money"); //取暖费数组
        $qunuan_start =Yii::app()->request->getParam("qunuan_start"); //取暖费付款开始时间数组
        $qunuan_end =Yii::app()->request->getParam("qunuan_end"); //取暖费付款结束时间数组

        $business_license_text =Yii::app()->request->getParam("business_license_text");// 营业执照文字说明
        $corporation_text =Yii::app()->request->getParam("corporation_text"); //法人文字说明
        $id_card_text =Yii::app()->request->getParam("id_card_text"); //承租人证件说明
        $accredited_representative_text =Yii::app()->request->getParam("accredited_representative_text"); //承租人授权代理人委托书
        $authorized_id_card_text =Yii::app()->request->getParam("authorized_id_card_text"); //委托人身份证复印件说明
        $house_delivery_order_text =Yii::app()->request->getParam("house_delivery_order_text"); //车源交割单说明
        $lessee_type =Yii::app()->request->getParam("lessee_type");//承租人类型
        $lessee_company_type=Yii::app()->request->getParam("lessee_company_type");
        $monthly_rent_room = Yii::app()->request->getParam("monthly_rent_room");  //每套车源的租金，数组
        $lessee =Yii::app()->request->getParam("lessee");  //承租人
        $lessor =Yii::app()->request->getParam("lessor"); //出租人
        $owner_gender = Yii::app()->request->getParam("owner_gender"); //车主性别
        $owner_phone = Yii::app()->request->getParam("owner_phone"); //车主电话
        $owner_id_card = Yii::app()->request->getParam("owner_id_card"); //车主身份证号

        $agent =Yii::app()->request->getParam("agent");  //代理人
        $agent_gender = Yii::app()->request->getParam("agent_gender"); //代理人性别
        $agent_phone = Yii::app()->request->getParam("agent_phone"); //代理人电话
        $agent_id_card = Yii::app()->request->getParam("agent_id_card"); //代理人身份证号

        $payee =Yii::app()->request->getParam("payee"); //收款人
        $payee_id_card =Yii::app()->request->getParam("payee_id_card"); //收款人身份证
		$pay_memo = Yii::app()->request->getParam("pay_memo"); //付款方式备注


        // $lessee_type =Yii::app()->request->getParam("lessee_type"); //承租人类型
        $owner =Yii::app()->request->getParam("owner"); //承租人数组
        $owner_gender =Yii::app()->request->getParam("owner_gender"); //承租人性别数组
        $owner_phone =Yii::app()->request->getParam("owner_phone"); //承租人电话数组
        $owner_id_card =Yii::app()->request->getParam("owner_id_card"); //承租人身份证号数组

        $company_name = Yii::app()->request->getParam("company_name");  //公司名称
        $corporation=Yii::app()->request->getParam("corporation"); //公司法人
        $corporation_gender=Yii::app()->request->getParam("corporation_gender");//法人性别
        $corporation_id_card=Yii::app()->request->getParam("corporation_id_card"); //公司法人身份证号
        $contractor = Yii::app()->request->getParam("contractor");  //签约人
        $contractor_gender = Yii::app()->request->getParam("contractor_gender");//签约人性别
        $contractor_id_card = Yii::app()->request->getParam("contractor_id_card");//签约人身份证号
        $contractor_phone = Yii::app()->request->getParam("contractor_phone");  //签约人手机号

        $business_license=Yii::app()->request->getParam("business_license","")=="on"?1:0;  //营业执照有无

        $business_license_photo =Yii::app()->request->getParam("business_license_photo");
        $business_license_photo = explode(",",$business_license_photo);
        array_shift($business_license_photo);


        $corporation_pic=Yii::app()->request->getParam("corporation_pic","")=="on"?1:0; //法人照片
        $corporation_photo =Yii::app()->request->getParam("corporation_photo");

        $corporation_photo = explode(",",$corporation_photo);
        array_shift($corporation_photo);

        $client_id_card=Yii::app()->request->getParam("client_id_card","")=="on"?1:0; //租户照片
        $client_id_card_photo =Yii::app()->request->getParam("client_id_card_photo");
        $client_id_card_photo = explode(",",$client_id_card_photo);
        array_shift($client_id_card_photo);

        $house_property_card=Yii::app()->request->getParam("house_property_card","")=="on"?1:0; //房产证
        $house_property_card_photo =Yii::app()->request->getParam("house_property_card_photo");
        $house_property_card_photo = explode(",",$house_property_card_photo);
        array_shift($house_property_card_photo);

        $immovable_authorisation=Yii::app()->request->getParam("immovable_authorisation","")=="on"?1:0; //不动产授权委托书
        $immovable_authorisation_photo =Yii::app()->request->getParam("immovable_authorisation_photo");
        $immovable_authorisation_photo = explode(",",$immovable_authorisation_photo);
        array_shift($immovable_authorisation_photo);

        $accredited_representative=Yii::app()->request->getParam("accredited_representative","")=="on"?1:0;
        $accredited_representative_photo =Yii::app()->request->getParam("accredited_representative_photo");  //车主授权代理人委托书
        $accredited_representative_photo = explode(",",$accredited_representative_photo);
        array_shift($accredited_representative_photo);

        $authorized_id_card=Yii::app()->request->getParam("authorized_id_card","")=="on"?1:0;
        $authorized_id_card_photo =Yii::app()->request->getParam("authorized_id_card_photo");  //委托人身份证复印件
        $authorized_id_card_photo = explode(",",$authorized_id_card_photo);
        array_shift($authorized_id_card_photo);

        $house_delivery_order=Yii::app()->request->getParam("house_delivery_order","")=="on"?1:0;       //车源交割单
        $house_delivery_order_photo =Yii::app()->request->getParam("house_delivery_order_photo");
        $house_delivery_order_photo = explode(",",$house_delivery_order_photo);
        array_shift($house_delivery_order_photo);

        $operator =Yii::app()->request->getParam("operator");  //经办人？？？？


        $bank =Yii::app()->request->getParam("bank");  //银行

        $bank_account =Yii::app()->request->getParam("bank_account");       //银行账号
        $bank_account = str_replace(' ', '',$bank_account);

        $lease_term_start =Yii::app()->request->getParam("lease_term_start");   //租期开始

        $lease_term_end =Yii::app()->request->getParam("lease_term_end");       //租期结束

        $lease_term_year =Yii::app()->request->getParam("lease_term_year");     //租期时长



        $deposit =Yii::app()->request->getParam("deposit");     //押金
        $deposit_memo =Yii::app()->request->getParam("deposit_memo");

        $deposit_pay_time =Yii::app()->request->getParam("deposit_pay_time");     //押金付款日期
        $rent_start_time =Yii::app()->request->getParam("rent_start_time");     //首期租金付款日期
        $rent_second_time =Yii::app()->request->getParam("rent_second_time");//二期租金付款日期       //押金注释

        $deposit_month =Yii::app()->request->getParam("deposit_month");     //压几个月
        $pay_month =Yii::app()->request->getParam("pay_month");     //付几个月
        $deposit_start_time =Yii::app()->request->getParam("deposit_start_time");     //开始时间
        $deposit_end_time =Yii::app()->request->getParam("deposit_end_time");     //结束时间



        $advance_days =Yii::app()->request->getParam("advance_days");       //提前几天付
        $advance_memo =Yii::app()->request->getParam("advance_memo");       //提前几天付
        //续约期限

        $property_fee=Yii::app()->request->getParam("property_fee","")=="on"?1:0;   //有无物业费

        $heating_fee=Yii::app()->request->getParam("heating_fee","")=="on"?1:0;     //有无取暖费

        $invoice=Yii::app()->request->getParam("invoice","")=="on"?1:0;     //有无发票

        $cool=Yii::app()->request->getParam("cool","")=="on"?1:0;     //有无制冷
        $other=Yii::app()->request->getParam("other","")=="on"?1:0;
        $tax_rate = Yii::app()->request->getParam("tax_rate");  //税率
        $tax = Yii::app()->request->getParam("tax");  //税金
        $property_memo = Yii::app()->request->getParam("property_memo");  //其他

        $rent_sum = Yii::app()->request->getParam("rent_sum");  //总应付租金
        $rent_sum_memo = Yii::app()->request->getParam("rent_sum_memo");  //总应付注释

        $commission =Yii::app()->request->getParam("commission");   //佣金
        $commission_shou =Yii::app()->request->getParam("commission_shou");   //佣金明细-华亮实际收房佣金
        $commission_bu =Yii::app()->request->getParam("commission_bu");   //佣金明细-幼师补贴华亮佣金f
        $commission_tui =Yii::app()->request->getParam("commission_tui");   //佣金明细-华亮退回幼师佣金

        $salesman_id =Yii::app()->request->getParam("salesman_id");     //市场收购签约人

        $channel_id =Yii::app()->request->getParam("channel_id");       //渠道公司

        $channel_manager_id =Yii::app()->request->getParam("channel_manager_id");       //渠道公司负责人

        $the_date =Yii::app()->request->getParam("the_date");       //客服收房日
        $recycle_id =Yii::app()->request->getParam("recycle_id");       //客服收房日

        $signing_date =Yii::app()->request->getParam("signing_date");       //签约日

        $status =Yii::app()->request->getParam("status");       //合同状态

        $addition =Yii::app()->request->getParam("addition");       //附加条件
        $memo =Yii::app()->request->getParam("memo");       //注释

        $term_start =Yii::app()->request->getParam("term_start");       //租金年列表，开始时间
        $term_end =Yii::app()->request->getParam("term_end");       //租金年列表，结束时间

        if(!empty($term_start)){
            foreach ($term_start as $key => $value) {
               if($value==''){
                    $this->OutputJson(0,'每一年租期开始时间都不能为空',null);

               }
            }
            foreach ($term_end as $key => $value) {
                # code...
                if($value==''){
                    $this->OutputJson(0,'每一年租期结束时间都不能为空',null);
                }
            }
        }else{
            $this->OutputJson(0,'每一年租期结束时间都不能为空',null);
        }
        $free_lease_start =Yii::app()->request->getParam("free_lease_start");       //免租期开始时间
        $free_lease_end =Yii::app()->request->getParam("free_lease_end");        //免租期结束时间

        $sub_monthly_rent =Yii::app()->request->getParam("sub_monthly_rent");       //租金年列表，月租金
        $sub_price_per_meter =Yii::app()->request->getParam("sub_price_per_meter");  //租金年列表，每天没平米价格
        $increasing_mode =Yii::app()->request->getParam("increasing_mode");     //租金年列表，递增方式
        $increasing_number =Yii::app()->request->getParam("increasing_number");     //租金年列表，递增值

        /*合同ID*/
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {

            $property_id =  implode(',', $property_id);
            $model1 = CmsPurchaseProperty::model()->findAll("property_id in ('$property_id') and deleted=0 ");
            $model2=null;
            if($model1){
                foreach($model1 as $value){
                    if(!empty($value->contract_id)){
                        $model2 = CmsPurchaseContract::model()->find("id='".$value->contract_id."' and deleted=0 and type=1 and status =0");
                        if($model2!=null){
                            $this->OutputJson(0,"合同已存在",null);
                        }
                    }
                }
            }
            if($model2==null){
                $property_id = explode(',',$property_id);
                $thread_model= CmsThread::model()->find("type=1");
                if($thread_model){
                    $ym=$thread_model->ym;
                    if($ym==date("ym")){
                        $id=$thread_model->the_index+1;
                        $thread_model->the_index= $thread_model->the_index+1;
                        $id=str_pad($id, 4, '0', STR_PAD_LEFT);
                        $this->contract_id = 'URS-XS-KJ-'.date("ym").$id;

                    }else{
                        $thread_model->ym=date("ym");
                        $thread_model->the_index=1;
                        $id='0001';
                        $this->contract_id = 'URS-XS-KJ-'.date("ym").$id;
                    }
                }else{
                    $thread_model = new CmsThread;
                    $thread_model->the_index=1;
                    $thread_model->type=1;
                    $thread_model->ym=date("ym");
                    $id='0001';
                    $this->contract_id = 'URS-XS-KJ-'.date("ym").$id;
                }
                if(!$thread_model->save()){
                    $this->OutputJson(0,json_encode($thread_model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }


        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            /*写入合同表*/

            //拼接车源id
            $model =new CmsPurchaseContract;

            $model->id= $this->contract_id;

            $model->lessee=$lessee;$model->free_type=$free_type;
            $model->lease_term_month=$lease_term_month;
            $model->lease_term_day = $lease_term_day;
            $model->lessor=$lessor;
            $model->payee=$payee;
            $model->payee_id_card=$payee_id_card;

            $model->lessee_type=$lessee_type;

            $model->business_license=$business_license;
            $model->client_id_card=$client_id_card;

            $model->corporation_pic=$corporation_pic;

            $model->house_property_card=$house_property_card;

            $model->immovable_authorisation=$immovable_authorisation;

            $model->accredited_representative=$accredited_representative;

            $model->authorized_id_card=$authorized_id_card;
            $model->lessee_company_type=$lessee_company_type;
            $model->house_delivery_order=$house_delivery_order;

            $model->bank=$bank;

            $model->bank_account=$bank_account;

            if ($lease_term_start){
                $lease_term_start=strtotime($lease_term_start);
                $model->lease_term_start=$lease_term_start;
            }

            if ($lease_term_end){
                $lease_term_end=strtotime($lease_term_end);
                $model->lease_term_end=$lease_term_end;
            }

            $model->lease_term_year=$lease_term_year;
            //$model->free_lease_term=$free_lease_term;

            $model->deposit=$deposit*100;
            if($deposit_pay_time){
                $model->deposit_pay_time=strtotime($deposit_pay_time);
            }
            if($rent_start_time){
                $model->rent_start_time =strtotime($rent_start_time);
            }
            if($rent_second_time){
                $model->rent_second_time=strtotime($rent_second_time);
            }

            $model->deposit_memo=$deposit_memo;


            $model->advance_days=$advance_days;
            $model->advance_memo=$advance_memo;

            $model->property_fee=$property_fee;

            $model->heating_fee=$heating_fee;

            $model->invoice=$invoice;
            $model->cool=$cool;
            $model->other=$other;
            $model->property_memo=$property_memo;
			$model->pay_memo=$pay_memo;
            $model->rent_sum = $rent_sum*100;
            $model->rent_sum_memo = $rent_sum_memo;

            $model->commission=$commission*100;
            $model->commission_shou=$commission_shou*100;
            $model->commission_bu=$commission_bu*100;
            $model->commission_tui=$commission_tui*100;

            $model->salesman_id=$salesman_id;

            $model->channel_id=$channel_id;

            $model->channel_manager_id=$channel_manager_id;

            if ($the_date){
                $the_date=strtotime($the_date);
            }
                $model->the_date=$the_date;

            if ($signing_date){
                $signing_date=strtotime($signing_date);
            }
                $model->signing_date=$signing_date;

        /*            if($lessee_type == 1){ //公司
                        if(($business_license == 1) && ($corporation_pic == 1 ) && ($accredited_representative == 1 ) && ($house_delivery_order == 1 ) && ($authorized_id_card == 1 )){
                            $papers_ok = 1;  //判断你证件是否完整
                        }else{
                            $papers_ok = 2;
                        }
                    }else if($lessee_type == 2){  //个人
                        if(($client_id_card == 1) && ($accredited_representative == 1 ) && ($house_delivery_order == 1 ) && ($authorized_id_card == 1 )){
                            $papers_ok = 1;  //判断你证件是否完整
                        }else{
                            $papers_ok = 2;
                        }
                    }else{
                        $papers_ok = 2;
                    }*/
            $model->papers_ok = $papers_ok;
            $model->recycle_id = $recycle_id;
            $model->status=$status;
            $model->tax=$tax*100;
            $model->tax_rate=$tax_rate*100;
            $model->type=1;
            $model->addition=$addition;
            $model->memo=$memo;
            $model->creater_id=Yii::app()->session['admin_uid'];
            $model->ctime=time();
            $model->last_time=time();

            $model->business_license_text=$business_license_text; //营业执照文字说明
            $model->corporation_text=$corporation_text;
            $model->id_card_text=$id_card_text;
            $model->accredited_representative_text=$accredited_representative_text;
            $model->authorized_id_card_text=$authorized_id_card_text;
            $model->house_delivery_order_text=$house_delivery_order_text;
            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }
            //写入消息
            // $modul_id = $model->status != 0 ? '1101_05'  : '1101_05' ;
            // $news_type = $model->status != 0 ? 5  : 6 ;


            $house_nos='';
            foreach ($property_id as $key => $value) {
                if($key>0){
                    $house_nos .= '/'.CmsProperty::model()->find("id = '$value' and deleted = 0")['house_no'];
                }else{
                    $house_nos .= '-'.CmsProperty::model()->find("id = '$value' and deleted = 0")['house_no'];
                }
                $information = CmsProperty::model()->find("id = '{$property_id[$key]}' and deleted = 0");
            }
            // 品牌
            $estate_id = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
            //系列
            $building_id = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];

            $news_title = '新增出车合同('.$estate_id.' '.$building_id.$house_nos.')';
            CmsNews::user_news($model->id,6,'1101_06',$news_title);


            //消息提醒开始
                // CmsNews::user_news($model->id,$news_type,$modul_id);
            //消息结束
            /*写交房*/
            $SerSellContract = new SerSellContract();
            $SerSellContract->id = Guid::create_guid();
            $SerSellContract->contract_id = $model['id'];
            $SerSellContract->deleted = 0;
            $SerSellContract->source = 1;
            $SerSellContract->ctime = time();
            if(!$SerSellContract->save()){
                $this->OutputJson(0,json_encode($purchasereceivable->errors,JSON_UNESCAPED_UNICODE),null);
            }

            /*写入年付款规则表*/
            if ($term_start && $term_end){
                foreach ($term_start as $key => $term_start_item) {
                    $term_start_data=$term_start[$key];
                    $term_end_data=$term_end[$key];
                    $purchasereceivable=new CmsPurchasePayRule();
                    $purchasereceivable->id=Guid::create_guid();
                    $purchasereceivable->contract_id=$this->contract_id;
                    $purchasereceivable->the_order=$key;
                    $purchasereceivable->title="第"+$key+"年";
                    $purchasereceivable->start_time=strtotime($term_start_data);
                    $purchasereceivable->end_time=strtotime($term_end_data);
                    $purchasereceivable->monthly_rent=$sub_monthly_rent[$key]*100;
                    $purchasereceivable->price_per_meter=$sub_price_per_meter[$key]*100;
                    $purchasereceivable->increasing_mode=$increasing_mode[$key];
                    if ($increasing_mode[$key]==1){//%
                        $purchasereceivable->increasing_number=$increasing_number[$key];
                    }
                    elseif ($increasing_mode[$key]==2) {//元/分
                        $purchasereceivable->increasing_number=$increasing_number[$key]*100;
                    }

                    $purchasereceivable->deleted=0;
                    $purchasereceivable->ctime=time();

                    if(!$purchasereceivable->save()){
                        $this->OutputJson(0,json_encode($purchasereceivable->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //payable
            //

           

            /*写入合同免租期表*/
            if ($free_lease_start && $free_lease_end){
                foreach ($free_lease_start as $key => $free_lease_start_item) {
                    if ($free_lease_start_item && $free_lease_end[$key]){
                        $free_lease_start_data=$free_lease_start[$key];
                        $free_lease_end_data=$free_lease_end[$key];

                        $pruchase_free_lease=new CmsPruchaseFreeLease();
                        $pruchase_free_lease->id=Guid::create_guid();
                        $pruchase_free_lease->contract_id=$this->contract_id;
                        $pruchase_free_lease->the_order=$key;
                        $pruchase_free_lease->start_time=strtotime($free_lease_start_data);
                        $pruchase_free_lease->end_time=strtotime($free_lease_end_data);



                        if(!$pruchase_free_lease->save()){
                            $this->OutputJson(0,json_encode($pruchase_free_lease->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            //写入合同关联的车源表
            if(!empty($property_id)){
                $contract_id = $this->contract_id;
                foreach($property_id as $k => $v){
                    $purchase_property = new CmsPurchaseProperty();
                    $purchase_property->id = Guid::create_guid();
                    $purchase_property->contract_id = $contract_id;
                    $purchase_property->property_id = $v;
                    $purchase_property->area = $_POST['area'][$k];
                    $purchase_property->house_area = $_POST['house_area'][$k];
                    $purchase_property->monthly_rent_room = $monthly_rent_room[$k];
                    $purchase_property->ctime = time();
                    $purchase_property->type = 1;
                    $purchase_property->status = 0;
                    $purchase_property->deleted = 0;
                    if(!$purchase_property->save()){
                        $this->OutputJson(0,json_encode($purchase_property->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }

            }

            //把车源类型也写入车源表 车源类型 1=轿车 2=客车 3=SUV 4=商务
            if(!empty($property_id)){
                foreach ($property_id as $key => $value) {
                    $property = CmsProperty::model()->find("id = '$value'");
                    $property ->room_type = $_POST['room_type'][$key];
                    if(!$property->save()){
                        $this->OutputJson(0,json_encode($property->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //图片数据存储

                foreach($business_license_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 1;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }


                foreach($corporation_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 2;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }


                foreach($house_property_card_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 4;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }



                foreach($immovable_authorisation_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 5;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }



                foreach($accredited_representative_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 6;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }



                foreach($authorized_id_card_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 7;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }



                foreach($house_delivery_order_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 8;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }



                foreach($client_id_card_photo as $k => $v){
                    $purchase_contract_photo = new CmsPurchaseContractPhoto;
                    $purchase_contract_photo->id = Guid::create_guid();
                    $purchase_contract_photo->contract_id = $this->contract_id;
                    $purchase_contract_photo->type = 9;
                    $purchase_contract_photo->url = $v;
                    $purchase_contract_photo->ctime = time()+$k;
                    if(!$purchase_contract_photo->save()){
                        $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }


            //承租人存储
            if($lessee_type == 2 && !empty($owner)){
                foreach($owner as $k => $v){
                    //判断产权人是否已经存在
                    if($owner_id_card[$k]!=''){
                        $owner_model = CmsOwner::model()->find("id_card_no = '$owner_id_card[$k]'");
                    }else{
                        $owner_model=null;
                    }
                    if($owner_model){
                        //如果产权人已经存在，那么搜出其ID
                        $owner_id = $owner_model->id;$owner_model->gender = $owner_gender[$k];
                        $owner_model->name = $v;
                        $owner_model->mobile = $owner_phone[$k];
                        if(!$owner_model->save()){
                        $this->OutputJson(0,json_encode($owner_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }else{
                        $owner_model = new CmsOwner();
                        $owner_model->id = Guid::create_guid();
                        $owner_model->name = $v;
                        $owner_model->gender = $owner_gender[$k];
                        $owner_model->id_card_no = $owner_id_card[$k];
                        $owner_model->mobile = $owner_phone[$k];
                        $owner_model->ctime = time()+$k;
                        $owner_id = $owner_model->id;$owner_model->gender = $owner_gender[$k];
                        if(!$owner_model->save()){
                        $this->OutputJson(0,json_encode($owner_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                    //把ID插入合同与产权人的关联表
                    $owner = new CmsPurchaseContractOwner();
                    $owner->id=Guid::create_guid();
                    $owner->contract_id = $this->contract_id;
                    $owner->owner_id = $owner_id;
                    $owner->ctime=time(); $owner->type = 1;
                    if(!$owner->save()){
                        $this->OutputJson(0,json_encode($owner->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //代理人存储
            if($lessee_type == 2 ){

                    //判断代理人是否已经存在
                    if($agent_id_card!=''){
                        $agent_model = CmsOwner::model()->find("id_card_no = '$agent_id_card'");
                    }else{
                        $agent_model = null;
                    }
                    if($agent_model){
                        //如果代理人已经存在，那么搜出其ID
                        $agent_model->name = $agent;
                        $agent_model->gender = $agent_gender;
                        $agent_model->id_card_no = $agent_id_card;
                        $agent_model->mobile = $agent_phone;
                        $agent_model->ctime = time();
                        if(!$agent_model->save()){
                        $this->OutputJson(0,json_encode($agent_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $agent_id = $agent_model->id;
                    }else{

                        $agent_model = new CmsOwner();
                        $agent_model->id = Guid::create_guid();
                        $agent_model->name = $agent;
                        $agent_model->gender = $agent_gender;
                        $agent_model->id_card_no = $agent_id_card;
                        $agent_model->mobile = $agent_phone;
                        $agent_model->ctime = time();
                        $agent_id = $agent_model->id;

                        if(!$agent_model->save()){
                        $this->OutputJson(0,json_encode($agent_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                    //把ID插入合同与承租人的关联表
                    $owner = new CmsPurchaseContractOwner();
                    $owner->id=Guid::create_guid();
                    $owner->contract_id = $this->contract_id;
                    $owner->owner_id = $agent_id;
                   $owner->ctime=time(); $owner->type = 2;
                    if(!$owner->save()){
                        $this->OutputJson(0,json_encode($owner->errors,JSON_UNESCAPED_UNICODE),null);
                    }
            }

            //产权公司存储
            if($lessee_type == 1){
                $owner_company = new CmsCompany();
                $owner_company->id = Guid::create_guid();
                $owner_company->contract_id = $this->contract_id;

                if(!empty($company_name)){
                    $owner_company->company_name = $company_name;
                }
                if(!empty($corporation)){
                    $owner_company->corporation = $corporation;
                }
                if(!empty($corporation_id_card)){
                    $owner_company->corporation_id_card = $corporation_id_card;
                }
                if(!empty($corporation_gender)){
                    $owner_company->corporation_gender = $corporation_gender;
                }
                if(!empty($contractor_gender)){
                    $owner_company->contractor_gender = $contractor_gender;
                }
                if(!empty($contractor_id_card)){
                    $owner_company->contractor_id_card = $contractor_id_card;
                }
                if(!empty($contractor)){
                    $owner_company->contractor = $contractor;
                }

                    $owner_company->contractor_phone = $contractor_phone;

                $owner_company->ctime = time();
                if(!$owner_company->save()){
                    $this->OutputJson(0,json_encode($owner_company->errors,JSON_UNESCAPED_UNICODE),null);
                }

            }

            //压几付几信息存储
            foreach($deposit_month as $k => $v){
                $deposit_pay = new CmsDepositPay();
                $deposit_pay->id = Guid::create_guid();
                $deposit_pay->contract_id = $this->contract_id;
                $deposit_pay->deposit_month = $v;
                $deposit_pay->pay_month = $pay_month[$k];
                $deposit_pay->start_time = strtotime($deposit_start_time[$k]);
                $deposit_pay->end_time = strtotime($deposit_end_time[$k]);
                if(!$deposit_pay->save()){
                    $this->OutputJson(0,json_encode($deposit_pay->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            //物业费存储
            if($wuye_money){
                $order=0;
                foreach($wuye_money as $k=>$value){
                    if($value){
                        $wuye = new CmsPurchaseContractWuye;
                        $wuye->id = Guid::create_guid();
                        $wuye->contract_id = $this->contract_id;
                        $wuye->type = 1;
                        $wuye->money = $value;
                        $wuye->start_time =strtotime($wuye_start[$k]);
                        $wuye->end_time = strtotime($wuye_end[$k]);
                        $wuye->the_order = $order;
                        $wuye->ctime = time();
                        if(!$wuye->save()){
                            $this->OutputJson(0,json_encode($wuye->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $order++;
                    }
                }
            }
            //取暖费存储
            if($qunuan_money){
                $order=0;
                foreach($qunuan_money as $k=>$value){
                    if($value){
                        $qunuan = new CmsPurchaseContractWuye;
                        $qunuan->id = Guid::create_guid();
                        $qunuan->contract_id = $this->contract_id;
                        $qunuan->type = 2;
                        $qunuan->money = $value;
                        $qunuan->start_time = strtotime($qunuan_start[$k]);
                        $qunuan->end_time = strtotime($qunuan_end[$k]);
                        $qunuan->the_order = $order;
                        $qunuan->ctime = time();
                        if(!$qunuan->save()){
                            $this->OutputJson(0,json_encode($qunuan->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $order++;
                    }
                }
            }

            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $transaction->rollback(); //如果操作失败, 数据回滚
            $thread_model= CmsThread::model()->find("type=1");
            $thread_model->the_index= $thread_model->the_index-1;
            if(!$thread_model->save()){
                $this->OutputJson(0,json_encode($thread_model->errors,JSON_UNESCAPED_UNICODE),null);
            }
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/salecontract");
    }
    public function actionEdit(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model=CmsPurchaseContract::model()->find("t.id='$id'");
        $photo=CmsPurchaseContractPhoto::model()->findAll("contract_id='$id' order by ctime ");
        $wuye=CmsPurchaseContractWuye::model()->findAll("contract_id='$id' and type=1 order by the_order");
        $qunuan=CmsPurchaseContractWuye::model()->findAll("contract_id='$id' and type=2 order by the_order");
        $property = Property::allinfo($id);
        //证件图片
        $business_license_photo=[];
        $corporation_photo=[];
        $house_property_card_photo=[];
        $accredited_representative_photo=[];
        $authorized_id_card_photo=[];
        $house_delivery_order_photo=[];
        $client_id_card_photo=[];

        if($photo){
            foreach ($photo as $key => $value) {
                if($value->type==1){
                    $business_license_photo[]=$value->url;
                }
                if($value->type==2){
                    $corporation_photo[]=$value->url;
                }
                if($value->type==4){
                    $house_property_card_photo[]=$value->url;
                }
                if($value->type==6){
                    $accredited_representative_photo[]=$value->url;
                }
                if($value->type==7){
                    $authorized_id_card_photo[]=$value->url;
                }
                if($value->type==8){
                    $house_delivery_order_photo[]=$value->url;
                }
                if($value->type==9){
                    $client_id_card_photo[]=$value->url;
                }
            }

        }
		// $pay=CmsDepositPay::model()->findAll("contract_id='$model->id'");
    	// var_dump($pay[0]->contract_id);
    	// die();
        $this->render('edit',array(
            'contract_id'=>$id,
            'model'=>$model,
            'referer'=>$referer,
            'business_license_photo'=>$business_license_photo,
            'corporation_photo'=>$corporation_photo,
            'house_property_card_photo'=>$house_property_card_photo,
            'accredited_representative_photo'=>$accredited_representative_photo,
            'authorized_id_card_photo'=>$authorized_id_card_photo,
            'house_delivery_order_photo'=>$house_delivery_order_photo,
            'client_id_card_photo'=>$client_id_card_photo,
            'property'=>$property,
            'wuye'=>$wuye,
            'qunuan'=>$qunuan,
        ));
    }
    public function actionEditSave(){
        /*获取参数*/
        $lessee_company_type=Yii::app()->request->getParam("lessee_company_type");
        $break_contract=Yii::app()->request->getParam("break_contract");
        $break_contract_text=Yii::app()->request->getParam("break_contract_text");
        $referer=$_SERVER['HTTP_REFERER'];
        $property_id =Yii::app()->request->getParam("property_id");
        $papers_ok =Yii::app()->request->getParam("papers_ok");
        $property_ids=$property_id;
        $lease_term_month = Yii::app()->request->getParam('lease_term_month');
        $lease_term_day = Yii::app()->request->getParam('lease_term_day');
        $free_type = Yii::app()->request->getParam('free_type');
        $contract_id =Yii::app()->request->getParam("contract_id");
        $monthly_rent_room = Yii::app()->request->getParam("monthly_rent_room");  //每套车源的租金，数组
        $lessee =Yii::app()->request->getParam("lessee");  //承租人

        $wuye_money =Yii::app()->request->getParam("wuye_money"); //物业费数组
        $wuye_start =Yii::app()->request->getParam("wuye_start"); //物业费付款开始时间数组
        $wuye_end =Yii::app()->request->getParam("wuye_end"); //物业费付款结束时间数组

        $qunuan_money =Yii::app()->request->getParam("qunuan_money"); //取暖费数组
        $qunuan_start =Yii::app()->request->getParam("qunuan_start"); //取暖费付款开始时间数组
        $qunuan_end =Yii::app()->request->getParam("qunuan_end"); //取暖费付款结束时间数组

            //        $owner =Yii::app()->request->getParam("owner");  //车主
        $owner_gender = Yii::app()->request->getParam("owner_gender"); //车主性别
        $owner_phone = Yii::app()->request->getParam("owner_phone"); //车主电话
        $owner_id_card = Yii::app()->request->getParam("owner_id_card"); //车主身份证号

        $business_license_text =Yii::app()->request->getParam("business_license_text");// 营业执照文字说明
        $corporation_text =Yii::app()->request->getParam("corporation_text"); //法人文字说明
        $id_card_text =Yii::app()->request->getParam("id_card_text"); //承租人证件说明
        $accredited_representative_text =Yii::app()->request->getParam("accredited_representative_text"); //承租人授权代理人委托书
        $authorized_id_card_text =Yii::app()->request->getParam("authorized_id_card_text"); //委托人身份证复印件说明
        $house_delivery_order_text =Yii::app()->request->getParam("house_delivery_order_text"); //车源交割单说明

        $agent =Yii::app()->request->getParam("agent");  //代理人
        $agent_gender = Yii::app()->request->getParam("agent_gender"); //代理人性别
        $agent_phone = Yii::app()->request->getParam("agent_phone"); //代理人电话
        $agent_id_card = Yii::app()->request->getParam("agent_id_card"); //代理人身份证号

        $payee =Yii::app()->request->getParam("payee"); //收款人
        $payee_id_card =Yii::app()->request->getParam("payee_id_card"); //收款人身份证
		$pay_memo = Yii::app()->request->getParam("pay_memo"); //付款方式备注
        $lessee_type =Yii::app()->request->getParam("lessee_type"); //承租人类型
        $owner =Yii::app()->request->getParam("owner"); //承租人数组
        $owner_gender =Yii::app()->request->getParam("owner_gender"); //承租人性别数组
        $owner_phone =Yii::app()->request->getParam("owner_phone"); //承租人电话数组
        $owner_id_card =Yii::app()->request->getParam("owner_id_card"); //承租人身份证号数组

        $company_name = Yii::app()->request->getParam("company_name");  //公司名称
        $corporation=Yii::app()->request->getParam("corporation"); //公司法人
        $corporation_gender=Yii::app()->request->getParam('corporation_gender');//法人性别
        $corporation_id_card=Yii::app()->request->getParam("corporation_id_card"); //公司法人身份证号
        $contractor = Yii::app()->request->getParam("contractor");  //签约人
        $contractor_gender = Yii::app()->request->getParam("contractor_gender");//签约人性别
        $contractor_id_card = Yii::app()->request->getParam('contractor_id_card');//签约人身份证账号

        $contractor_phone = Yii::app()->request->getParam("contractor_phone");  //签约人手机号

        $business_license=Yii::app()->request->getParam("business_license","")=="on"?1:0;  //营业执照有无

        $business_license_photo =Yii::app()->request->getParam("business_license_photo");
        $business_license_photo = explode(",",$business_license_photo);
        array_shift($business_license_photo);

        $corporation_pic=Yii::app()->request->getParam("corporation_pic","")=="on"?1:0; //法人照片
        $corporation_photo =Yii::app()->request->getParam("corporation_photo");
        $corporation_photo = explode(",",$corporation_photo);
        array_shift($corporation_photo);
        // var_dump($corporation_photo);exit;

        $client_id_card=Yii::app()->request->getParam("client_id_card","")=="on"?1:0; //租户照片
        $client_id_card_photo =Yii::app()->request->getParam("client_id_card_photo");
        $client_id_card_photo = explode(",",$client_id_card_photo);
        array_shift($client_id_card_photo);
        //        $corporation_text =Yii::app()->request->getParam("corporation_text");

        $house_property_card=Yii::app()->request->getParam("house_property_card","")=="on"?1:0; //房产证
        $house_property_card_photo =Yii::app()->request->getParam("house_property_card_photo");
        $house_property_card_photo = explode(",",$house_property_card_photo);
        array_shift($house_property_card_photo);
          //        $house_property_card_text =Yii::app()->request->getParam("house_property_card_text");

        $immovable_authorisation=Yii::app()->request->getParam("immovable_authorisation","")=="on"?1:0; //不动产授权委托书
        $immovable_authorisation_photo =Yii::app()->request->getParam("immovable_authorisation_photo");
        $immovable_authorisation_photo = explode(",",$immovable_authorisation_photo);
        array_shift($immovable_authorisation_photo);


        $accredited_representative=Yii::app()->request->getParam("accredited_representative","")=="on"?1:0;
        $accredited_representative_photo =Yii::app()->request->getParam("accredited_representative_photo");  //车主授权代理人委托书
        $accredited_representative_photo = explode(",",$accredited_representative_photo);
        array_shift($accredited_representative_photo);


        $authorized_id_card=Yii::app()->request->getParam("authorized_id_card","")=="on"?1:0;
        $authorized_id_card_photo =Yii::app()->request->getParam("authorized_id_card_photo");  //委托人身份证复印件
        $authorized_id_card_photo = explode(",",$authorized_id_card_photo);
        array_shift($authorized_id_card_photo);
         //        $authorized_id_card_text =Yii::app()->request->getParam("authorized_id_card_text");

        $house_delivery_order=Yii::app()->request->getParam("house_delivery_order","")=="on"?1:0;       //车源交割单
        $house_delivery_order_photo =Yii::app()->request->getParam("house_delivery_order_photo");
        $house_delivery_order_photo = explode(",",$house_delivery_order_photo);
        array_shift($house_delivery_order_photo);
         //        $house_delivery_order_text =Yii::app()->request->getParam("house_delivery_order_text");

        $operator =Yii::app()->request->getParam("operator");  //经办人？？？？

        //        $id_card_text =Yii::app()->request->getParam("id_card_text");

        $bank =Yii::app()->request->getParam("bank");  //银行

        $bank_account =Yii::app()->request->getParam("bank_account");       //银行账号
        $bank_account = str_replace(' ', '',$bank_account);



        $lease_term_start =Yii::app()->request->getParam("lease_term_start");   //租期开始

        $lease_term_end =Yii::app()->request->getParam("lease_term_end");       //租期结束

        $lease_term_year =Yii::app()->request->getParam("lease_term_year");     //租期时长


        //$free_lease_term =Yii::app()->request->getParam("free_lease_term");

        $deposit =Yii::app()->request->getParam("deposit");     //押金
        $deposit_memo =Yii::app()->request->getParam("deposit_memo");     //押金

        $deposit_pay_time =Yii::app()->request->getParam("deposit_pay_time");     //押金付款日期
        $rent_start_time =Yii::app()->request->getParam("rent_start_time");     //首期租金付款日期
        $rent_second_time =Yii::app()->request->getParam("rent_second_time");//二期租金付款日期       //押金注释

        $deposit_month =Yii::app()->request->getParam("deposit_month");     //压几个月
        $pay_month =Yii::app()->request->getParam("pay_month");     //付几个月
        $deposit_start_time =Yii::app()->request->getParam("deposit_start_time");     //开始时间
        $deposit_end_time =Yii::app()->request->getParam("deposit_end_time");     //结束时间


        $advance_days =Yii::app()->request->getParam("advance_days");       //提前几天付
        $advance_memo =Yii::app()->request->getParam("advance_memo");       //提前几天付
        //续约期限
        // $renewal_period =Yii::app()->request->getParam("renewal_period");

        $property_fee=Yii::app()->request->getParam("property_fee","")=="on"?1:0;   //有无物业费

        $heating_fee=Yii::app()->request->getParam("heating_fee","")=="on"?1:0;     //有无取暖费

        $invoice=Yii::app()->request->getParam("invoice","")=="on"?1:0;     //有无发票

        $cool=Yii::app()->request->getParam("cool","")=="on"?1:0;     //有无制冷
        $other=Yii::app()->request->getParam("other","")=="on"?1:0;
        $tax_rate = Yii::app()->request->getParam("tax_rate");  //税率
        $tax = Yii::app()->request->getParam("tax");  //税金
        $property_memo = Yii::app()->request->getParam("property_memo");  //其他

        $rent_sum = Yii::app()->request->getParam("rent_sum");  //总应付租金
        $rent_sum_memo = Yii::app()->request->getParam("rent_sum_memo");  //总应付注释

        $commission =Yii::app()->request->getParam("commission");   //佣金
        $commission_shou =Yii::app()->request->getParam("commission_shou");   //佣金明细-华亮实际收房佣金
        $commission_bu =Yii::app()->request->getParam("commission_bu");   //佣金明细-幼师补贴华亮佣金f
        $commission_tui =Yii::app()->request->getParam("commission_tui");   //佣金明细-华亮退回幼师佣金
          //        $commission_unflag=Yii::app()->request->getParam("commission_unflag","")=="on"?1:0;

        $salesman_id =Yii::app()->request->getParam("salesman_id");     //市场收购签约人

        $channel_id =Yii::app()->request->getParam("channel_id");       //渠道公司

        $channel_manager_id =Yii::app()->request->getParam("channel_manager_id");       //渠道公司负责人

        $the_date =Yii::app()->request->getParam("the_date");       //客服收房日
        $recycle_id =Yii::app()->request->getParam("recycle_id");       //客服收房日

        $signing_date =Yii::app()->request->getParam("signing_date");       //签约日

        $status =Yii::app()->request->getParam("status");       //合同状态

        $addition =Yii::app()->request->getParam("addition");       //附加条件
        $memo =Yii::app()->request->getParam("memo");       //注释

        $term_start =Yii::app()->request->getParam("term_start");       //租金年列表，开始时间
        $term_end =Yii::app()->request->getParam("term_end");       //租金年列表，结束时间


        if(!empty($term_start)){
            foreach ($term_start as $key => $value) {
               if($value==''){
                    $this->OutputJson(0,'每一年租期开始时间都不能为空',null);

               }
            }
            foreach ($term_end as $key => $value) {
                # code...
                if($value==''){
                    $this->OutputJson(0,'每一年租期结束时间都不能为空',null);
                }
            }
        }else{
            $this->OutputJson(0,'每一年租期结束时间都不能为空',null);
        }
        $free_lease_start =Yii::app()->request->getParam("free_lease_start");       //免租期开始时间
        $free_lease_end =Yii::app()->request->getParam("free_lease_end");        //免租期结束时间

        $sub_monthly_rent =Yii::app()->request->getParam("sub_monthly_rent");       //租金年列表，月租金
        $sub_price_per_meter =Yii::app()->request->getParam("sub_price_per_meter");  //租金年列表，每天没平米价格
        $increasing_mode =Yii::app()->request->getParam("increasing_mode");     //租金年列表，递增方式
        $increasing_number =Yii::app()->request->getParam("increasing_number");     //租金年列表，递增值
        $lessor=Yii::app()->request->getParam("lessor");

        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {

            $this->contract_id = $contract_id;
            $model = CmsPurchaseContract::model()->find("id = '$contract_id'");

            $starts_arr = [0=>'正常', 2=>'我司违约',3=>'合同到期退租',4=>'合同到期续约',5=>'租户违约',6=>'租户转租',7=>'到期换房',8=>'合同作废',9=>'违约中','-1'=>'未付全首期款'];
            $starts = $starts_arr[$model->status] ? $starts_arr[$model->status] : '';
            

            $model->lessee=$lessee;$model->free_type=$free_type;
            $model->lease_term_month=$lease_term_month;
            $model->lease_term_day = $lease_term_day;
            $model->lessor =$lessor;
            $model->payee=$payee;
            $model->payee_id_card=$payee_id_card;
            $model->lessee_type=$lessee_type;
            $model->business_license=$business_license;
            $model->lessee_company_type=$lessee_company_type;

            if($status==5){
                $model->break_contract=$break_contract;
                if($break_contract==6){
                    $model->break_contract_text=$break_contract_text;
                }
            }
            $model->client_id_card=$client_id_card;
            //$model->corporation=$corporation; //原字段指的是法人是否有图片
            $model->corporation_pic=$corporation_pic;
            $model->house_property_card=$house_property_card;
            $model->immovable_authorisation=$immovable_authorisation;
            $model->accredited_representative=$accredited_representative;
            $model->authorized_id_card=$authorized_id_card;
            $model->house_delivery_order=$house_delivery_order;
            $model->bank=$bank;
            $model->bank_account=$bank_account;
            if ($lease_term_start){
                $lease_term_start=strtotime($lease_term_start);
                $model->lease_term_start=$lease_term_start;
            }
            if ($lease_term_end){
                $lease_term_end=strtotime($lease_term_end);
                $model->lease_term_end=$lease_term_end;
            }

            $model->lease_term_year=$lease_term_year;
            //$model->free_lease_term=$free_lease_term;

            $model->deposit=$deposit*100;
            if($deposit_pay_time){
                $model->deposit_pay_time=strtotime($deposit_pay_time);
            }
            if($rent_start_time){
                $model->rent_start_time =strtotime($rent_start_time);
            }
            if($rent_second_time){
                $model->rent_second_time=strtotime($rent_second_time);
            }

            $model->deposit_memo=$deposit_memo;
			$model->pay_memo=$pay_memo;
            $model->advance_days=$advance_days;
            $model->advance_memo=$advance_memo;
            //续约期限
            // if ($renewal_period){
            //     $renewal_period=strtotime($renewal_period);
            //     $model->renewal_period=$renewal_period;
            // }

            $model->property_fee=$property_fee;

            $model->heating_fee=$heating_fee;

            $model->invoice=$invoice;
            $model->cool=$cool;
            $model->other=$other;
            $model->property_memo=$property_memo;

            $model->rent_sum = $rent_sum*100;
            $model->rent_sum_memo = $rent_sum_memo;

            $model->commission=$commission*100;
            $model->commission_shou=$commission_shou*100;
            $model->commission_bu=$commission_bu*100;
            $model->commission_tui=$commission_tui*100;

            $model->salesman_id=$salesman_id;

            $model->channel_id=$channel_id;

            $model->channel_manager_id=$channel_manager_id;

            if ($the_date){
                $the_date=strtotime($the_date);
            }
                $model->the_date=$the_date;

            if ($signing_date){
                $signing_date=strtotime($signing_date);
            }
                $model->signing_date=$signing_date;

                /*            if($lessee_type == 1){ //公司
                if(($business_license == 1) && ($corporation_pic == 1 ) && ($accredited_representative == 1 ) && ($house_delivery_order == 1 ) && ($authorized_id_card == 1 )){
                    $papers_ok = 1;  //判断你证件是否完整
                }else{
                    $papers_ok = 2;
                }
            }else if($lessee_type == 2){  //个人
                if(($client_id_card == 1) && ($accredited_representative == 1 ) && ($house_delivery_order == 1 ) && ($authorized_id_card == 1 )){
                    $papers_ok = 1;  //判断你证件是否完整
                }else{
                    $papers_ok = 2;
                }
            }else{
                $papers_ok = 2;
            }*/
            $model->papers_ok = $papers_ok;


            $model->recycle_id = $recycle_id;
            if($model->status==0||$model->status==9||$model->status==-1){
                $model->status=$status;    
            }
            $model->tax=$tax*100;
            $model->tax_rate=$tax_rate*100;
            $model->type=1;
            $model->addition=$addition;
            $model->memo=$memo;
            $model->last_time=time();

            $model->business_license_text=$business_license_text; //营业执照文字说明
            $model->corporation_text=$corporation_text;
            $model->id_card_text=$id_card_text;
            $model->accredited_representative_text=$accredited_representative_text;
            $model->authorized_id_card_text=$authorized_id_card_text;
            $model->house_delivery_order_text=$house_delivery_order_text;

            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }

            //二次收房添加客服管理收房列表(2我司违约  3合同到期退租  5租户违约  6 租户转租  7到期换房)
            if($status==2 ||$status==3 || $status==5 || $status==6 || $status==7){
                //添加客服管理收房列表
                $sercontract =new SerPurContract();
                $sercontract->id=Guid::create_guid();
                $sercontract->contract_id=$this->contract_id;
                $sercontract->source=1;
                $sercontract->purchase_contract_date=$purchase_contract_date;
                $sercontract->ctime=time();
                $sercontract->deleted=0;
                if (!$sercontract->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(0,json_encode($sercontract->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //写入消息
            $ends = $starts_arr[$model->status] ? $starts_arr[$model->status] : '';
            $house_no='';
            foreach ($property_ids as $key => $value) {
                if($key>0){
                    $house_no .= '/'.CmsProperty::model()->find("id = '$value' and deleted = 0")['house_no'];
                }else{
                    $house_no .= '-'.CmsProperty::model()->find("id = '$value' and deleted = 0")['house_no'];
                }
                $information = CmsProperty::model()->find("id = '{$property_ids[$key]}' and deleted = 0");
            }
            // 品牌
            $estate_id = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
            //系列
            $building_id = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];

            $news_title = '出车合同状态发生改变('.$estate_id.' '.$building_id.$house_no.' '.$starts.'->'.$ends.')';
            // var_dump(expression)
            if($starts != $ends){
                CmsNews::user_news($model->id,5,'1101_05',$news_title);
            }
            if($model->status == 8){
                $sersell = SerSellContract::model()->find("contract_id = '$model->id'");
                if(!$sersell['actual_date']){
                    $sersell->deleted = 1;
                    if (!$sersell->save()){
                        if(Yii::app()->request->isAjaxRequest){
                            $this->OutputJson(0,json_encode($sersell->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }



            // $modul_id = $model->status != 0 ? '1101_05'  : '1101_06' ;
            // $news_type = $model->status != 0 ? 5  : 6 ;
            //消息提醒开始
                // CmsNews::user_news_edit($model->id,$news_type,$modul_id);
            //消息结束
            //
            //

            /*写入年付款规则表*/
            $purchasereceivable = CmsPurchasePayRule::model()->deleteAll("contract_id = '$contract_id'");

            if ($term_start && $term_end){
                foreach ($term_start as $key => $term_start_item) {
                    $term_start_data=$term_start[$key];
                    $term_end_data=$term_end[$key];
                    $purchasereceivable=new CmsPurchasePayRule();
                    $purchasereceivable->id=Guid::create_guid();
                    $purchasereceivable->contract_id=$this->contract_id;
                    $purchasereceivable->the_order=$key;
                    $purchasereceivable->title="第"+$key+"年";
                    $purchasereceivable->start_time=strtotime($term_start_data);
                    $purchasereceivable->end_time=strtotime($term_end_data);
                    $purchasereceivable->monthly_rent=$sub_monthly_rent[$key]*100;
                    $purchasereceivable->price_per_meter=$sub_price_per_meter[$key]*100;
                    $purchasereceivable->increasing_mode=$increasing_mode[$key];
                    if ($increasing_mode[$key]==1){//%
                        $purchasereceivable->increasing_number=$increasing_number[$key];
                    }
                    elseif ($increasing_mode[$key]==2) {//元/分
                        $purchasereceivable->increasing_number=$increasing_number[$key]*100;
                    }

                    $purchasereceivable->deleted=0;
                    $purchasereceivable->ctime=time();

                    if(!$purchasereceivable->save()){
                        $this->OutputJson(0,json_encode($purchasereceivable->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //产生应付
            if($status!=5&&$status!=9){
                $this ->payableCreate();
            }
        
            /*写入合同免租期表*/

            $pruchase_free_lease = CmsPruchaseFreeLease::model()->deleteAll("contract_id = '$contract_id'");
            if ($free_lease_start && $free_lease_end){
                foreach ($free_lease_start as $key => $free_lease_start_item) {
                    if ($free_lease_start_item && $free_lease_end[$key]){
                        $free_lease_start_data=$free_lease_start[$key];
                        $free_lease_end_data=$free_lease_end[$key];

                        $pruchase_free_lease=new CmsPruchaseFreeLease();
                        $pruchase_free_lease->id=Guid::create_guid();
                        $pruchase_free_lease->contract_id=$this->contract_id;
                        $pruchase_free_lease->the_order=$key;
                        $pruchase_free_lease->start_time=strtotime($free_lease_start_data);
                        $pruchase_free_lease->end_time=strtotime($free_lease_end_data);

                        if(!$pruchase_free_lease->save()){
                            $this->OutputJson(0,json_encode($pruchase_free_lease->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            //写入合同关联的车源表
           CmsPurchaseProperty::model()->deleteAll("contract_id = '$contract_id'");

            if(!empty($property_id)){
                $contract_id = $this->contract_id;
                foreach($property_id as $k => $v){
                    $purchase_property = new CmsPurchaseProperty();
                    $purchase_property->id = Guid::create_guid();
                    $purchase_property->contract_id = $contract_id;
                    $purchase_property->property_id = $v;
                    $purchase_property->area = $_POST['area'][$k];
                    $purchase_property->house_area = $_POST['house_area'][$k];
                    $purchase_property->monthly_rent_room = $monthly_rent_room[$k];
                    $purchase_property->ctime = time();
                    $purchase_property->type = 1;
                    $purchase_property->status = 0;
                    $purchase_property->deleted = 0;
                    if(!$purchase_property->save()){
                        $this->OutputJson(0,json_encode($purchase_property->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }

            }

            //把车源类型也写入车源表 车源类型 1=轿车 2=客车 3=SUV 4=商务
            if(!empty($property_id)){
                foreach ($property_id as $key => $value) {
                    $property = CmsProperty::model()->find("id = '$value'");
                    $property ->room_type = $_POST['room_type'][$key];
                    if(!$property->save()){
                        $this->OutputJson(0,json_encode($property->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //图片数据存储
            if(!empty($business_license_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 1");


                foreach($business_license_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 1;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }


                }
            }
            if(!empty($corporation_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 2");
                foreach($corporation_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 2;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }
            if(!empty($house_property_card_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 4");
                foreach($house_property_card_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 4;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($immovable_authorisation_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 5");
                foreach($immovable_authorisation_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 5;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($accredited_representative_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 6");
                foreach($accredited_representative_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 6;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($authorized_id_card_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 7");
                foreach($authorized_id_card_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 7;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($house_delivery_order_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 8");
                foreach($house_delivery_order_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 8;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($client_id_card_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 9");
                foreach($client_id_card_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 9;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }
            CmsPurchaseContractOwner::model()->deleteAll("contract_id = '$contract_id'");

            //承租人存储
            if($lessee_type == 2 && !empty($owner)){
                foreach($owner as $k => $v){
                    //判断产权人是否已经存在
                    if($owner_id_card[$k]!=''){
                        $owner_model = CmsOwner::model()->find("id_card_no = '$owner_id_card[$k]'");
                    }else{
                        $owner_model=null;
                    }
                    if($owner_model){
                        //如果产权人已经存在，那么搜出其ID
                        $owner_id = $owner_model->id;$owner_model->gender = $owner_gender[$k];
                        $owner_model->name = $v;
                        $owner_model->mobile = $owner_phone[$k];
                        if(!$owner_model->save()){
                        $this->OutputJson(0,json_encode($owner_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }else{
                        $owner_model = new CmsOwner();
                        $owner_model->id = Guid::create_guid();
                        $owner_model->name = $v;
                        $owner_model->gender = $owner_gender[$k];
                        $owner_model->id_card_no = $owner_id_card[$k];
                        $owner_model->mobile = $owner_phone[$k];
                        $owner_model->ctime = time()+$k;
                        $owner_id = $owner_model->id;$owner_model->gender = $owner_gender[$k];
                        if(!$owner_model->save()){
                        $this->OutputJson(0,json_encode($owner_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                    //把ID插入合同与产权人的关联表
                    $owner = new CmsPurchaseContractOwner();
                    $owner->id=Guid::create_guid();
                    $owner->contract_id = $this->contract_id;
                    $owner->owner_id = $owner_id;
                    $owner->ctime=time(); $owner->type = 1;
                    if(!$owner->save()){
                        $this->OutputJson(0,json_encode($owner->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //代理人存储
            if($lessee_type == 2 ){
                    //判断代理人是否已经存在
                    if($agent_id_card!=''){
                        $agent_model = CmsOwner::model()->find("id_card_no = '$agent_id_card'");
                    }else{
                        $agent_model = null;
                    }

                    if($agent_model){
                        //如果代理人已经存在，那么搜出其ID
                        $agent_model->name = $agent;
                        $agent_model->gender = $agent_gender;
                        $agent_model->id_card_no = $agent_id_card;
                        $agent_model->mobile = $agent_phone;
                        $agent_model->ctime = time();
                        if(!$agent_model->save()){
                        $this->OutputJson(0,json_encode($agent_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $agent_id = $agent_model->id;

                    }else{
                        $agent_model = new CmsOwner();
                        $agent_model->id = Guid::create_guid();
                        $agent_model->name = $agent;
                        $agent_model->gender = $agent_gender;
                        $agent_model->id_card_no = $agent_id_card;
                        $agent_model->mobile = $agent_phone;
                        $agent_model->ctime = time();
                        $agent_id = $agent_model->id;

                        if(!$agent_model->save()){
                        $this->OutputJson(0,json_encode($agent_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                    //把ID插入合同与承租人的关联表
                    $owner = new CmsPurchaseContractOwner();
                    $owner->id=Guid::create_guid();
                    $owner->contract_id = $this->contract_id;
                    $owner->owner_id = $agent_id;
                   $owner->ctime=time(); $owner->type = 2;
                    if(!$owner->save()){
                        $this->OutputJson(0,json_encode($owner->errors,JSON_UNESCAPED_UNICODE),null);
                    }
            }

            //产权公司存储
            if($lessee_type == 1){
                $owner_company = CmsCompany::model()->find("contract_id = '$contract_id'");
                if($owner_company==null){
                    $owner_company = new CmsCompany();
                    $owner_company->id = Guid::create_guid();
                    $owner_company->contract_id = $this->contract_id;
                }

                // $owner_company = new CmsCompany();
                // $owner_company->id = Guid::create_guid();
                $owner_company->contract_id = $this->contract_id;
                if(!empty($company_name)){
                    $owner_company->company_name = $company_name;
                }
                if(!empty($corporation)){
                    $owner_company->corporation = $corporation;
                }
                if(!empty($corporation_gender)){
                    $owner_company->corporation_gender = $corporation_gender;
                }
                if(!empty($corporation_id_card)){
                    $owner_company->corporation_id_card = $corporation_id_card;
                }
                if(!empty($contractor)){
                    $owner_company->contractor = $contractor;
                }
                if(!empty($contractor_gender)){
                    $owner_company->contractor_gender = $contractor_gender;
                }
                if(!empty($contractor_id_card)){
                    $owner_company->contractor_id_card = $contractor_id_card;
                }

                    $owner_company->contractor_phone = $contractor_phone;

                $owner_company->ctime = time();
                if(!$owner_company->save()){
                    $this->OutputJson(0,json_encode($owner_company->errors,JSON_UNESCAPED_UNICODE),null);
                }

            }

            //压几付几信息存储
            CmsDepositPay::model()->deleteAll("contract_id = '$contract_id'");
            foreach($deposit_month as $k => $v){
                $deposit_pay = new CmsDepositPay();
                $deposit_pay->id = Guid::create_guid();
                $deposit_pay->contract_id = $this->contract_id;
                $deposit_pay->deposit_month = $v;
                $deposit_pay->pay_month = $pay_month[$k];
                $deposit_pay->start_time = strtotime($deposit_start_time[$k]);
                $deposit_pay->end_time = strtotime($deposit_end_time[$k]);
                if(!$deposit_pay->save()){
                    $this->OutputJson(0,json_encode($deposit_pay->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }


            //物业费存储
            CmsPurchaseContractWuye::model()->deleteAll("contract_id = '$contract_id' and type=1");
            if($wuye_money){
                $order=0;
                foreach($wuye_money as $k=>$value){
                    if($value){
                        $wuye = new CmsPurchaseContractWuye;
                        $wuye->id = Guid::create_guid();
                        $wuye->contract_id = $this->contract_id;
                        $wuye->type = 1;
                        $wuye->money = $value;
                        $wuye->start_time =strtotime($wuye_start[$k]);
                        $wuye->end_time = strtotime($wuye_end[$k]);
                        $wuye->the_order = $order;
                        $wuye->ctime = time();
                        if(!$wuye->save()){
                            $this->OutputJson(0,json_encode($wuye->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $order++;
                    }
                }
            }
            //取暖费存储
            CmsPurchaseContractWuye::model()->deleteAll("contract_id = '$contract_id' and type=2");
            if($qunuan_money){
                $order=0;
                foreach($qunuan_money as $k=>$value){
                    if($value){
                        $qunuan = new CmsPurchaseContractWuye;
                        $qunuan->id = Guid::create_guid();
                        $qunuan->contract_id = $this->contract_id;
                        $qunuan->type = 2;
                        $qunuan->money = $value;
                        $qunuan->start_time = strtotime($qunuan_start[$k]);
                        $qunuan->end_time = strtotime($qunuan_end[$k]);
                        $qunuan->the_order = $order;
                        $qunuan->ctime = time();
                        if(!$qunuan->save()){
                            $this->OutputJson(0,json_encode($qunuan->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $order++;
                    }
                }
            }



            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
                // var_dump('bb');
                // die();
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/salecontract");
    }

    /*
    *合同ID
    *预付款周期开始 $strar_date
    *合同月租
    *
    */
    public function get_monthly_rent($contract_id,$start_date){
        $rule=CmsPurchasePayRule::model()->find("t.contract_id='$contract_id' and $start_date>=start_time and $start_date<end_time");
        if ($rule){
            return $rule->monthly_rent;
        }
//        else{
//            return $monthly_rent;
//        }
    }

    public function actionDelete(){
		$referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=CmsPurchaseContract::model()->find("t.id='$id'");
        $model->deleted=1;
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }

        $purchaseproperty=CmsPurchaseProperty::model()->find("t.contract_id='$id'");
        $purchaseproperty->deleted=1;
        if(!$purchaseproperty->save()){
            $this->OutputJson(0,json_encode($purchaseproperty->errors,JSON_UNESCAPED_UNICODE),null);
        }


        $this->redirect($_SERVER['HTTP_REFERER']);

    }

    //应收
    public function actionPayable(){
        //$referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $criteria=new CDbCriteria;
        $criteria->addCondition("t.deleted=0 and contract_id='$id' and type=2 and the_order>1");
        $criteria->order="t.the_order";
        $list = CmsPurchaseReceivable::model()->findAll($criteria);

        $criteria2=new CDbCriteria;
        $criteria2->addCondition("t.deleted=0 and contract_id='$id'  and the_order<2");
        $criteria2->order="t.start_time";
        $list2 = CmsPurchaseReceivable::model()->findAll($criteria2);
        $contract=CmsPurchaseContract::model()->find("t.id='$id'");


        $this->render("payable",array(
            'list'=>$list,
            'list2'=>$list2,
            'contract'=>$contract,
            'contract_id'=>$id,
        ));
    }

    //收款
    public function actionPayment(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $this->render("payment",array(
            'referer'=>$referer,
            'id'=>$id,
        ));
    }

    //收款
    public function actionPaymentSave(){
        //$referer= $_SERVER['HTTP_REFERER'];
        $referer =Yii::app()->request->getParam("referer");

        $type =Yii::app()->request->getParam("type");
        $payable_id =Yii::app()->request->getParam("id");
        $amount =Yii::app()->request->getParam("amount");
        $payment_date =Yii::app()->request->getParam("payment_date");
        $memo=Yii::app()->request->getParam("memo");

        $payable=CmsPurchaseReceivable::model()->find("t.id='$payable_id'");

        $contract=CmsPurchaseContract::model()->find("t.id='$payable->contract_id'");

        $model =new CmsPurchaseReceived();
        $model->id=Guid::create_guid();
        $model->contract_id=$payable->contract_id;
        $model->payable_id=$payable_id;
        $model->start_time=$payable->start_time;
        $model->end_time=$payable->end_time;
        $model->type=$type;
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->amount=$amount*100;
        $model->payment_date=strtotime($payment_date);
        $model->memo=$memo;
        $model->deleted=0;
        $model->ctime=time();


        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',$referer);
        }
        else{
            $controller->redirect($referer);
        }

        $this->redirect($referer);
    }

    //付款列表
    public function actionPaymentList(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $criteria=new CDbCriteria;
        $criteria->addCondition("t.deleted=0 and payable_id='$id'");
        $criteria->order="t.id desc";
        $list = CmsPurchaseReceived::model()->findAll($criteria);
// var_dump($list);
// die();
        // $contract=CmsPurchaseContract::model()->find("t.payable_id='$id'");

        $this->render("paymentlist",array(
            'list'=>$list,
            // 'contract'=>$contract,
        ));
    }

    public function actionDetail(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model=CmsPurchaseContract::model()->find("t.id='$id'");
        $photo=CmsPurchaseContractPhoto::model()->findAll("contract_id='$id' order by ctime ");
        $wuye=CmsPurchaseContractWuye::model()->findAll("contract_id='$id' and type=1 order by the_order");
        $qunuan=CmsPurchaseContractWuye::model()->findAll("contract_id='$id' and type=2 order by the_order");
        $property = Property::allinfo($id);
        //证件图片
        $business_license_photo=[];//营业执照
        $corporation_photo=[];//法人照片
        $house_property_card_photo=[];//房产证件
        $accredited_representative_photo=[];//车主授权代理人委托书
        $authorized_id_card_photo=[];//委托人身份证复印件
        $house_delivery_order_photo=[];//车源交割单
        $client_id_card_photo=[];//租户证件

        if($photo){
            foreach ($photo as $key => $value) {
                if($value->type==1){
                    $business_license_photo[]=$value->url;
                }
                if($value->type==2){
                    $corporation_photo[]=$value->url;
                }
                if($value->type==4){
                    $house_property_card_photo[]=$value->url;
                }
                if($value->type==6){
                    $accredited_representative_photo[]=$value->url;
                }
                if($value->type==7){
                    $authorized_id_card_photo[]=$value->url;
                }
                if($value->type==8){
                    $house_delivery_order_photo[]=$value->url;
                }
                if($value->type==9){
                    $client_id_card_photo[]=$value->url;
                }
            }

        }
        if(AdminPositionModul::has_modul("1104_05")){
            $this->render('detail',array(
                'contract_id'=>$id,
                'model'=>$model,
                'referer'=>$referer,
                'business_license_photo'=>$business_license_photo,
                'corporation_photo'=>$corporation_photo,
                'house_property_card_photo'=>$house_property_card_photo,
                'accredited_representative_photo'=>$accredited_representative_photo,
                'authorized_id_card_photo'=>$authorized_id_card_photo,
                'house_delivery_order_photo'=>$house_delivery_order_photo,
                'client_id_card_photo'=>$client_id_card_photo,
                'property'=>$property,
                'wuye'=>$wuye,
                'qunuan'=>$qunuan,
            ));
        }else{
            if(AdminPositionModul::has_modul("1104_01")){
                $limit['id_card_photo'] = $id_card_photo;
            }
            if(AdminPositionModul::has_modul("1104_02")){
                $limit['house_property_card_photo'] = $house_property_card_photo;
            }
            if(AdminPositionModul::has_modul("1104_03")){
                $limit['house_property_card_text'] = $model->house_property_card_text;
            }
            if(AdminPositionModul::has_modul("1104_04")){
                $limit['house_delivery_order_photo'] = $house_delivery_order_photo;
            }
            // if(AdminPositionModul::has_modul("1103_08")){
            //     $limit['lease_term_start']=$model->lease_term_start;
            //     $limit['lease_term_end']=$model->lease_term_end;
            //     $limit['lease_term_year']=$model->lease_term_year;
            //     $limit['lease_term_month']=$model->lease_term_month;
            //     $limit['lease_term_day']=$model->lease_term_day;
            // }
            if(AdminPositionModul::has_modul("1104_01")||AdminPositionModul::has_modul("1104_02")||AdminPositionModul::has_modul("1104_03")||AdminPositionModul::has_modul("1104_04")) {
                $this->render('detaillimit',array(
                    'limit'=>$limit,
                    'id'=>$model->id,
                ));
            }
        }



    }

    public function actionReviewed(){
       $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model=CmsPurchaseContract::model()->find("t.id='$id'");
        $photo=CmsPurchaseContractPhoto::model()->findAll("contract_id='$id' order by ctime ");
        $wuye=CmsPurchaseContractWuye::model()->findAll("contract_id='$id' and type=1 order by the_order");
        $qunuan=CmsPurchaseContractWuye::model()->findAll("contract_id='$id' and type=2 order by the_order");
        $property = Property::allinfo($id);
        //证件图片
        $business_license_photo=[];
        $corporation_photo=[];
        $house_property_card_photo=[];
        $accredited_representative_photo=[];
        $authorized_id_card_photo=[];
        $house_delivery_order_photo=[];
        $client_id_card_photo=[];

        if($photo){
            foreach ($photo as $key => $value) {
                if($value->type==1){
                    $business_license_photo[]=$value->url;
                }
                if($value->type==2){
                    $corporation_photo[]=$value->url;
                }
                if($value->type==4){
                    $house_property_card_photo[]=$value->url;
                }
                if($value->type==6){
                    $accredited_representative_photo[]=$value->url;
                }
                if($value->type==7){
                    $authorized_id_card_photo[]=$value->url;
                }
                if($value->type==8){
                    $house_delivery_order_photo[]=$value->url;
                }
                if($value->type==9){
                    $client_id_card_photo[]=$value->url;
                }
            }

        }
        // $pay=CmsDepositPay::model()->findAll("contract_id='$model->id'");
        // var_dump($pay[0]->contract_id);
        // die();
        $this->render('reviewed',array(
            'contract_id'=>$id,
            'model'=>$model,
            'referer'=>$referer,
            'business_license_photo'=>$business_license_photo,
            'corporation_photo'=>$corporation_photo,
            'house_property_card_photo'=>$house_property_card_photo,
            'accredited_representative_photo'=>$accredited_representative_photo,
            'authorized_id_card_photo'=>$authorized_id_card_photo,
            'house_delivery_order_photo'=>$house_delivery_order_photo,
            'client_id_card_photo'=>$client_id_card_photo,
            'property'=>$property,
            'wuye'=>$wuye,
            'qunuan'=>$qunuan,
        ));
    }

    public function actionReviewedSave(){
        /*获取参数*/

        $referer=$_SERVER['HTTP_REFERER'];
        $lessee_company_type=Yii::app()->request->getParam("lessee_company_type");
        $property_id =Yii::app()->request->getParam("property_id");
        $papers_ok =Yii::app()->request->getParam("papers_ok");
        $lease_term_month = Yii::app()->request->getParam('lease_term_month');
        $lease_term_day = Yii::app()->request->getParam('lease_term_day');
        $free_type = Yii::app()->request->getParam('free_type');
        $contract_id =Yii::app()->request->getParam("contract_id");
        $monthly_rent_room = Yii::app()->request->getParam("monthly_rent_room");  //每套车源的租金，数组
        $lessee =Yii::app()->request->getParam("lessee");  //承租人
            //        $owner =Yii::app()->request->getParam("owner");  //车主
        $owner_gender = Yii::app()->request->getParam("owner_gender"); //车主性别
        $owner_phone = Yii::app()->request->getParam("owner_phone"); //车主电话
        $owner_id_card = Yii::app()->request->getParam("owner_id_card"); //车主身份证号

        $wuye_money =Yii::app()->request->getParam("wuye_money"); //物业费数组
        $wuye_start =Yii::app()->request->getParam("wuye_start"); //物业费付款开始时间数组
        $wuye_end =Yii::app()->request->getParam("wuye_end"); //物业费付款结束时间数组

        $qunuan_money =Yii::app()->request->getParam("qunuan_money"); //取暖费数组
        $qunuan_start =Yii::app()->request->getParam("qunuan_start"); //取暖费付款开始时间数组
        $qunuan_end =Yii::app()->request->getParam("qunuan_end"); //取暖费付款结束时间数组

        $business_license_text =Yii::app()->request->getParam("business_license_text");// 营业执照文字说明
        $corporation_text =Yii::app()->request->getParam("corporation_text"); //法人文字说明
        $id_card_text =Yii::app()->request->getParam("id_card_text"); //承租人证件说明
        $accredited_representative_text =Yii::app()->request->getParam("accredited_representative_text"); //承租人授权代理人委托书
        $authorized_id_card_text =Yii::app()->request->getParam("authorized_id_card_text"); //委托人身份证复印件说明
        $house_delivery_order_text =Yii::app()->request->getParam("house_delivery_order_text"); //车源交割单说明

        $agent =Yii::app()->request->getParam("agent");  //代理人
        $agent_gender = Yii::app()->request->getParam("agent_gender"); //代理人性别
        $agent_phone = Yii::app()->request->getParam("agent_phone"); //代理人电话
        $agent_id_card = Yii::app()->request->getParam("agent_id_card"); //代理人身份证号

        $payee =Yii::app()->request->getParam("payee"); //收款人
        $payee_id_card =Yii::app()->request->getParam("payee_id_card"); //收款人身份证
        $pay_memo = Yii::app()->request->getParam("pay_memo"); //付款方式备注
        $lessee_type =Yii::app()->request->getParam("lessee_type"); //承租人类型
        $owner =Yii::app()->request->getParam("owner"); //承租人数组
        $owner_gender =Yii::app()->request->getParam("owner_gender"); //承租人性别数组
        $owner_phone =Yii::app()->request->getParam("owner_phone"); //承租人电话数组
        $owner_id_card =Yii::app()->request->getParam("owner_id_card"); //承租人身份证号数组

        $company_name = Yii::app()->request->getParam("company_name");  //公司名称
        $corporation=Yii::app()->request->getParam("corporation"); //公司法人
        $corporation_id_card=Yii::app()->request->getParam("corporation_id_card"); //公司法人身份证号
        $contractor = Yii::app()->request->getParam("contractor");  //签约人
        $contractor_phone = Yii::app()->request->getParam("contractor_phone");  //签约人手机号

        $business_license=Yii::app()->request->getParam("business_license","")=="on"?1:0;  //营业执照有无

        $business_license_photo =Yii::app()->request->getParam("business_license_photo");
        $business_license_photo = explode(",",$business_license_photo);
        array_shift($business_license_photo);

        $corporation_pic=Yii::app()->request->getParam("corporation_pic","")=="on"?1:0; //法人照片
        $corporation_photo =Yii::app()->request->getParam("corporation_photo");
        $corporation_photo = explode(",",$corporation_photo);
        array_shift($corporation_photo);
        // var_dump($corporation_photo);exit;

        $client_id_card=Yii::app()->request->getParam("client_id_card","")=="on"?1:0; //租户照片
        $client_id_card_photo =Yii::app()->request->getParam("client_id_card_photo");
        $client_id_card_photo = explode(",",$client_id_card_photo);
        array_shift($client_id_card_photo);
        //        $corporation_text =Yii::app()->request->getParam("corporation_text");

        $house_property_card=Yii::app()->request->getParam("house_property_card","")=="on"?1:0; //房产证
        $house_property_card_photo =Yii::app()->request->getParam("house_property_card_photo");
        $house_property_card_photo = explode(",",$house_property_card_photo);
        array_shift($house_property_card_photo);
          //        $house_property_card_text =Yii::app()->request->getParam("house_property_card_text");

        $immovable_authorisation=Yii::app()->request->getParam("immovable_authorisation","")=="on"?1:0; //不动产授权委托书
        $immovable_authorisation_photo =Yii::app()->request->getParam("immovable_authorisation_photo");
        $immovable_authorisation_photo = explode(",",$immovable_authorisation_photo);
        array_shift($immovable_authorisation_photo);


        $accredited_representative=Yii::app()->request->getParam("accredited_representative","")=="on"?1:0;
        $accredited_representative_photo =Yii::app()->request->getParam("accredited_representative_photo");  //车主授权代理人委托书
        $accredited_representative_photo = explode(",",$accredited_representative_photo);
        array_shift($accredited_representative_photo);


        $authorized_id_card=Yii::app()->request->getParam("authorized_id_card","")=="on"?1:0;
        $authorized_id_card_photo =Yii::app()->request->getParam("authorized_id_card_photo");  //委托人身份证复印件
        $authorized_id_card_photo = explode(",",$authorized_id_card_photo);
        array_shift($authorized_id_card_photo);
         //        $authorized_id_card_text =Yii::app()->request->getParam("authorized_id_card_text");

        $house_delivery_order=Yii::app()->request->getParam("house_delivery_order","")=="on"?1:0;       //车源交割单
        $house_delivery_order_photo =Yii::app()->request->getParam("house_delivery_order_photo");
        $house_delivery_order_photo = explode(",",$house_delivery_order_photo);
        array_shift($house_delivery_order_photo);
         //        $house_delivery_order_text =Yii::app()->request->getParam("house_delivery_order_text");

        $operator =Yii::app()->request->getParam("operator");  //经办人？？？？

        //        $id_card_text =Yii::app()->request->getParam("id_card_text");

        $bank =Yii::app()->request->getParam("bank");  //银行

        $bank_account =Yii::app()->request->getParam("bank_account");       //银行账号
        $bank_account = str_replace(' ', '',$bank_account);

        $lease_term_start =Yii::app()->request->getParam("lease_term_start");   //租期开始

        $lease_term_end =Yii::app()->request->getParam("lease_term_end");       //租期结束

        $lease_term_year =Yii::app()->request->getParam("lease_term_year");     //租期时长


        //$free_lease_term =Yii::app()->request->getParam("free_lease_term");

        $deposit =Yii::app()->request->getParam("deposit");     //押金
        $deposit_memo =Yii::app()->request->getParam("deposit_memo");     //押金

        $deposit_pay_time =Yii::app()->request->getParam("deposit_pay_time");     //押金付款日期
        $rent_start_time =Yii::app()->request->getParam("rent_start_time");     //首期租金付款日期
        $rent_second_time =Yii::app()->request->getParam("rent_second_time");//二期租金付款日期       //押金注释

        $deposit_month =Yii::app()->request->getParam("deposit_month");     //压几个月
        $pay_month =Yii::app()->request->getParam("pay_month");     //付几个月
        $deposit_start_time =Yii::app()->request->getParam("deposit_start_time");     //开始时间
        $deposit_end_time =Yii::app()->request->getParam("deposit_end_time");     //结束时间


        $advance_days =Yii::app()->request->getParam("advance_days");       //提前几天付
        $advance_memo =Yii::app()->request->getParam("advance_memo");       //提前几天付
        //续约期限
        // $renewal_period =Yii::app()->request->getParam("renewal_period");

        $property_fee=Yii::app()->request->getParam("property_fee","")=="on"?1:0;   //有无物业费

        $heating_fee=Yii::app()->request->getParam("heating_fee","")=="on"?1:0;     //有无取暖费

        $invoice=Yii::app()->request->getParam("invoice","")=="on"?1:0;     //有无发票

        $cool=Yii::app()->request->getParam("cool","")=="on"?1:0;     //有无制冷
        $other=Yii::app()->request->getParam("other","")=="on"?1:0;
        $tax_rate = Yii::app()->request->getParam("tax_rate");  //税率
        $tax = Yii::app()->request->getParam("tax");  //税金
        $property_memo = Yii::app()->request->getParam("property_memo");  //其他

        $rent_sum = Yii::app()->request->getParam("rent_sum");  //总应付租金
        $rent_sum_memo = Yii::app()->request->getParam("rent_sum_memo");  //总应付注释

        $commission =Yii::app()->request->getParam("commission");   //佣金
        $commission_shou =Yii::app()->request->getParam("commission_shou");   //佣金明细-华亮实际收房佣金
        $commission_bu =Yii::app()->request->getParam("commission_bu");   //佣金明细-幼师补贴华亮佣金f
        $commission_tui =Yii::app()->request->getParam("commission_tui");   //佣金明细-华亮退回幼师佣金
          //        $commission_unflag=Yii::app()->request->getParam("commission_unflag","")=="on"?1:0;

        $salesman_id =Yii::app()->request->getParam("salesman_id");     //市场收购签约人

        $channel_id =Yii::app()->request->getParam("channel_id");       //渠道公司

        $channel_manager_id =Yii::app()->request->getParam("channel_manager_id");       //渠道公司负责人

        $the_date =Yii::app()->request->getParam("the_date");       //客服收房日
        $recycle_id =Yii::app()->request->getParam("recycle_id");       //客服收房日

        $signing_date =Yii::app()->request->getParam("signing_date");       //签约日

        $status =Yii::app()->request->getParam("status");       //合同状态

        $addition =Yii::app()->request->getParam("addition");       //附加条件
        $memo =Yii::app()->request->getParam("memo");       //注释

        $term_start =Yii::app()->request->getParam("term_start");       //租金年列表，开始时间
        $term_end =Yii::app()->request->getParam("term_end");       //租金年列表，结束时间
        if(!empty($term_start)){
            foreach ($term_start as $key => $value) {
               if($value==''){
                    $this->OutputJson(0,'每一年租期开始时间都不能为空',null);

               }
            }
            foreach ($term_end as $key => $value) {
                # code...
                if($value==''){
                    $this->OutputJson(0,'每一年租期结束时间都不能为空',null);
                }
            }
        }else{
            $this->OutputJson(0,'每一年租期结束时间都不能为空',null);
        }
        $free_lease_start =Yii::app()->request->getParam("free_lease_start");       //免租期开始时间
        $free_lease_end =Yii::app()->request->getParam("free_lease_end");        //免租期结束时间

        $sub_monthly_rent =Yii::app()->request->getParam("sub_monthly_rent");       //租金年列表，月租金
        $sub_price_per_meter =Yii::app()->request->getParam("sub_price_per_meter");  //租金年列表，每天没平米价格
        $increasing_mode =Yii::app()->request->getParam("increasing_mode");     //租金年列表，递增方式
        $increasing_number =Yii::app()->request->getParam("increasing_number");     //租金年列表，递增值
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {

            $this->contract_id = $contract_id;
            $model = CmsPurchaseContract::model()->find("id = '$contract_id'");
            // $model->lessee=$lessee;$model->free_type=$free_type;$model->lease_term_month=$lease_term_month;$model->lease_term_day = $lease_term_day;
            $model->lessor =Yii::app()->request->getParam("lessor");
            $model->payee=$payee;
            $model->payee_id_card=$payee_id_card;
            $model->lessee_type=$lessee_type;
            $model->business_license=$business_license;
            $model->client_id_card=$client_id_card;
            //$model->corporation=$corporation; //原字段指的是法人是否有图片
            $model->corporation_pic=$corporation_pic;
            $model->house_property_card=$house_property_card;
            $model->immovable_authorisation=$immovable_authorisation;
            $model->accredited_representative=$accredited_representative;
            $model->authorized_id_card=$authorized_id_card;
            $model->house_delivery_order=$house_delivery_order;
            $model->lessee_company_type=$lessee_company_type;
            $model->bank=$bank;
            $model->bank_account=$bank_account;
            if ($lease_term_start){
                $lease_term_start=strtotime($lease_term_start);
                $model->lease_term_start=$lease_term_start;
            }
            if ($lease_term_end){
                $lease_term_end=strtotime($lease_term_end);
                $model->lease_term_end=$lease_term_end;
            }

            $model->lease_term_year=$lease_term_year;
            //$model->free_lease_term=$free_lease_term;

            $model->deposit=$deposit*100;
            if($deposit_pay_time){
                $model->deposit_pay_time=strtotime($deposit_pay_time);
            }
            if($rent_start_time){
                $model->rent_start_time =strtotime($rent_start_time);
            }
            if($rent_second_time){
                $model->rent_second_time=strtotime($rent_second_time);
            }

            $model->deposit_memo=$deposit_memo;
            $model->pay_memo=$pay_memo;
            $model->advance_days=$advance_days;
            $model->advance_memo=$advance_memo;
            //续约期限
            // if ($renewal_period){
            //     $renewal_period=strtotime($renewal_period);
            //     $model->renewal_period=$renewal_period;
            // }

            $model->property_fee=$property_fee;

            $model->heating_fee=$heating_fee;

            $model->invoice=$invoice;
            $model->cool=$cool;
            $model->other=$other;
            $model->property_memo=$property_memo;

            $model->rent_sum = $rent_sum*100;
            $model->rent_sum_memo = $rent_sum_memo;

            $model->commission=$commission*100;
            $model->commission_shou=$commission_shou*100;
            $model->commission_bu=$commission_bu*100;
            $model->commission_tui=$commission_tui*100;

            $model->salesman_id=$salesman_id;

            $model->channel_id=$channel_id;

            $model->channel_manager_id=$channel_manager_id;

            if ($the_date){
                $the_date=strtotime($the_date);
            }
                $model->the_date=$the_date;

            if ($signing_date){
                $signing_date=strtotime($signing_date);
            }
                $model->signing_date=$signing_date;

            /*if($lessee_type == 1){ //公司
                if(($business_license == 1) && ($corporation_pic == 1 ) && ($accredited_representative == 1 ) && ($house_delivery_order == 1 ) && ($authorized_id_card == 1 )){
                    $papers_ok = 1;  //判断你证件是否完整
                }else{
                    $papers_ok = 2;
                }
            }else if($lessee_type == 2){  //个人
                if(($client_id_card == 1) && ($accredited_representative == 1 ) && ($house_delivery_order == 1 ) && ($authorized_id_card == 1 )){
                    $papers_ok = 1;  //判断你证件是否完整
                }else{
                    $papers_ok = 2;
                }
            }else{
                $papers_ok = 2;
            }*/
            $model->papers_ok = $papers_ok;
            $model->recycle_id = $recycle_id;
            $model->status=$status;
            $model->tax=$tax*100;
            $model->tax_rate=$tax_rate*100;
            $model->type=1;
            $model->addition=$addition;
            $model->memo=$memo;
            $model->last_time=time();

            $model->business_license_text=$business_license_text; //营业执照文字说明
            $model->corporation_text=$corporation_text;
            $model->id_card_text=$id_card_text;
            $model->accredited_representative_text=$accredited_representative_text;
            $model->authorized_id_card_text=$authorized_id_card_text;
            $model->house_delivery_order_text=$house_delivery_order_text;

            //审核通过
            $model->reviewed=1;
            $model->reviewer_id=Yii::app()->session['admin_uid'];
            $model->reviewed_time=time();

            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }

            /*写入年付款规则表*/
            $purchasereceivable = CmsPurchasePayRule::model()->deleteAll("contract_id = '$contract_id'");

            if ($term_start && $term_end){
                foreach ($term_start as $key => $term_start_item) {
                    $term_start_data=$term_start[$key];
                    $term_end_data=$term_end[$key];
                    $purchasereceivable=new CmsPurchasePayRule();
                    $purchasereceivable->id=Guid::create_guid();
                    $purchasereceivable->contract_id=$this->contract_id;
                    $purchasereceivable->the_order=$key;
                    $purchasereceivable->title="第"+$key+"年";
                    $purchasereceivable->start_time=strtotime($term_start_data);
                    $purchasereceivable->end_time=strtotime($term_end_data);
                    $purchasereceivable->monthly_rent=$sub_monthly_rent[$key]*100;
                    $purchasereceivable->price_per_meter=$sub_price_per_meter[$key]*100;
                    $purchasereceivable->increasing_mode=$increasing_mode[$key];
                    if ($increasing_mode[$key]==1){//%
                        $purchasereceivable->increasing_number=$increasing_number[$key];
                    }
                    elseif ($increasing_mode[$key]==2) {//元/分
                        $purchasereceivable->increasing_number=$increasing_number[$key]*100;
                    }

                    $purchasereceivable->deleted=0;
                    $purchasereceivable->ctime=time();

                    if(!$purchasereceivable->save()){
                        $this->OutputJson(0,json_encode($purchasereceivable->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //生成应收
            if($status!=5&&$status!=9){
                $this->payableCreate();
            }

          
            /*写入合同免租期表*/

            $pruchase_free_lease = CmsPruchaseFreeLease::model()->deleteAll("contract_id = '$contract_id'");
            if ($free_lease_start && $free_lease_end){
                foreach ($free_lease_start as $key => $free_lease_start_item) {
                    if ($free_lease_start_item && $free_lease_end[$key]){
                        $free_lease_start_data=$free_lease_start[$key];
                        $free_lease_end_data=$free_lease_end[$key];

                        $pruchase_free_lease=new CmsPruchaseFreeLease();
                        $pruchase_free_lease->id=Guid::create_guid();
                        $pruchase_free_lease->contract_id=$this->contract_id;
                        $pruchase_free_lease->the_order=$key;
                        $pruchase_free_lease->start_time=strtotime($free_lease_start_data);
                        $pruchase_free_lease->end_time=strtotime($free_lease_end_data);



                        if(!$pruchase_free_lease->save()){
                            $this->OutputJson(0,json_encode($pruchase_free_lease->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            //写入合同关联的车源表
           CmsPurchaseProperty::model()->deleteAll("contract_id = '$contract_id'");

            if(!empty($property_id)){
                $contract_id = $this->contract_id;
                foreach($property_id as $k => $v){
                    $purchase_property = new CmsPurchaseProperty();
                    $purchase_property->id = Guid::create_guid();
                    $purchase_property->contract_id = $contract_id;
                    $purchase_property->property_id = $v;
                    $purchase_property->area = $_POST['area'][$k];
                    $purchase_property->house_area = $_POST['house_area'][$k];
                    $purchase_property->monthly_rent_room = $monthly_rent_room[$k];
                    $purchase_property->ctime = time();
                    $purchase_property->type = 1;
                    $purchase_property->status = 0;
                    $purchase_property->deleted = 0;
                    if(!$purchase_property->save()){
                        $this->OutputJson(0,json_encode($purchase_property->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }

            }

            //把车源类型也写入车源表 车源类型 1=轿车 2=客车 3=SUV 4=商务
            if(!empty($property_id)){
                foreach ($property_id as $key => $value) {
                    $property = CmsProperty::model()->find("id = '$value'");
                    $property ->room_type = $_POST['room_type'][$key];
                    if(!$property->save()){
                        $this->OutputJson(0,json_encode($property->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //图片数据存储
            if(!empty($business_license_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 1");


                foreach($business_license_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 1;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }


                }
            }
            if(!empty($corporation_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 2");
                foreach($corporation_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 2;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }
            if(!empty($house_property_card_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 4");
                foreach($house_property_card_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 4;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($immovable_authorisation_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 5");
                foreach($immovable_authorisation_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 5;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($accredited_representative_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 6");
                foreach($accredited_representative_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 6;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($authorized_id_card_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 7");
                foreach($authorized_id_card_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 7;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($house_delivery_order_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 8");
                foreach($house_delivery_order_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 8;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            if(!empty($client_id_card_photo)){

                CmsPurchaseContractPhoto::model()->deleteAll("contract_id = '$contract_id' and type = 9");
                foreach($client_id_card_photo as $k => $v){
                    if($v){
                        $purchase_contract_photo = new CmsPurchaseContractPhoto;
                        $purchase_contract_photo->id = Guid::create_guid();
                        $purchase_contract_photo->contract_id = $this->contract_id;
                        $purchase_contract_photo->type = 9;
                        $purchase_contract_photo->url = $v;
                        $purchase_contract_photo->ctime = time()+$k;
                        if(!$purchase_contract_photo->save()){
                            $this->OutputJson(0,json_encode($purchase_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }

            CmsPurchaseContractOwner::model()->deleteAll("contract_id = '$contract_id'");
            if($lessee_type == 2 && !empty($owner)){
                foreach($owner as $k => $v){
                    //判断产权人是否已经存在
                    if($owner_id_card[$k]!=''){
                        $owner_model = CmsOwner::model()->find("id_card_no = '$owner_id_card[$k]'");
                    }else{
                        $owner_model=null;
                    }
                    if($owner_model){
                        //如果产权人已经存在，那么搜出其ID
                        $owner_id = $owner_model->id;$owner_model->gender = $owner_gender[$k];
                        $owner_model->name = $v;
                        $owner_model->mobile = $owner_phone[$k];
                        if(!$owner_model->save()){
                        $this->OutputJson(0,json_encode($owner_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }else{
                        $owner_model = new CmsOwner();
                        $owner_model->id = Guid::create_guid();
                        $owner_model->name = $v;
                        $owner_model->gender = $owner_gender[$k];
                        $owner_model->id_card_no = $owner_id_card[$k];
                        $owner_model->mobile = $owner_phone[$k];
                        $owner_model->ctime = time()+$k;
                        $owner_id = $owner_model->id;$owner_model->gender = $owner_gender[$k];
                        if(!$owner_model->save()){
                        $this->OutputJson(0,json_encode($owner_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                    //把ID插入合同与产权人的关联表
                    $owner = new CmsPurchaseContractOwner();
                    $owner->id=Guid::create_guid();
                    $owner->contract_id = $this->contract_id;
                    $owner->owner_id = $owner_id;
                    $owner->ctime=time(); $owner->type = 1;
                    if(!$owner->save()){
                        $this->OutputJson(0,json_encode($owner->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            //代理人存储
            if($lessee_type == 2 ){

                    //判断代理人是否已经存在
                    if($agent_id_card!=''){
                        $agent_model = CmsOwner::model()->find("id_card_no = '$agent_id_card'");
                    }else{
                        $agent_model = null;
                    }

                    if($agent_model){
                        //如果代理人已经存在，那么搜出其ID
                        $agent_model->name = $agent;
                        $agent_model->gender = $agent_gender;
                        $agent_model->id_card_no = $agent_id_card;
                        $agent_model->mobile = $agent_phone;
                        $agent_model->ctime = time();
                        if(!$agent_model->save()){
                        $this->OutputJson(0,json_encode($agent_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $agent_id = $agent_model->id;
                    }else{

                        $agent_model = new CmsOwner();
                        $agent_model->id = Guid::create_guid();
                        $agent_model->name = $agent;
                        $agent_model->gender = $agent_gender;
                        $agent_model->id_card_no = $agent_id_card;
                        $agent_model->mobile = $agent_phone;

                        $agent_model->ctime = time();
                        $agent_id = $agent_model->id;

                        if(!$agent_model->save()){
                        $this->OutputJson(0,json_encode($agent_model->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                    //把ID插入合同与承租人的关联表
                    $owner = new CmsPurchaseContractOwner();
                    $owner->id=Guid::create_guid();
                    $owner->contract_id = $this->contract_id;
                    $owner->owner_id = $agent_id;
                   $owner->ctime=time(); $owner->type = 2;
                    if(!$owner->save()){
                        $this->OutputJson(0,json_encode($owner->errors,JSON_UNESCAPED_UNICODE),null);
                    }
            }

            //产权公司存储
            if($lessee_type == 1){
                $owner_company = CmsCompany::model()->find("contract_id = '$contract_id'");

                if($owner_company==null){
                    $owner_company = new CmsCompany();
                    $owner_company->id = Guid::create_guid();
                    $owner_company->contract_id = $this->contract_id;
                }

                // $owner_company = new CmsCompany();
                // $owner_company->id = Guid::create_guid();
                $owner_company->contract_id = $this->contract_id;
                if(!empty($company_name)){
                    $owner_company->company_name = $company_name;
                }
                if(!empty($corporation)){
                    $owner_company->corporation = $corporation;
                }

                if(!empty($corporation_id_card)){
                    $owner_company->corporation_id_card = $corporation_id_card;
                }


                if(!empty($contractor)){
                    $owner_company->contractor = $contractor;
                }

                    $owner_company->contractor_phone = $contractor_phone;

                $owner_company->ctime = time();
                if(!$owner_company->save()){
                    $this->OutputJson(0,json_encode($owner_company->errors,JSON_UNESCAPED_UNICODE),null);
                }

            }

            //压几付几信息存储
            CmsDepositPay::model()->deleteAll("contract_id = '$contract_id'");
            foreach($deposit_month as $k => $v){
                $deposit_pay = new CmsDepositPay();
                $deposit_pay->id = Guid::create_guid();
                $deposit_pay->contract_id = $this->contract_id;
                $deposit_pay->deposit_month = $v;
                $deposit_pay->pay_month = $pay_month[$k];
                $deposit_pay->start_time = strtotime($deposit_start_time[$k]);
                $deposit_pay->end_time = strtotime($deposit_end_time[$k]);
                if(!$deposit_pay->save()){
                    $this->OutputJson(0,json_encode($deposit_pay->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            //物业费存储
            CmsPurchaseContractWuye::model()->deleteAll("contract_id = '$contract_id' and type=1");
            if($wuye_money){
                $order=0;
                foreach($wuye_money as $k=>$value){
                    if($value){
                        $wuye = new CmsPurchaseContractWuye;
                        $wuye->id = Guid::create_guid();
                        $wuye->contract_id = $this->contract_id;
                        $wuye->type = 1;
                        $wuye->money = $value;
                        $wuye->start_time =strtotime($wuye_start[$k]);
                        $wuye->end_time = strtotime($wuye_end[$k]);
                        $wuye->the_order = $order;
                        $wuye->ctime = time();
                        if(!$wuye->save()){
                            $this->OutputJson(0,json_encode($wuye->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $order++;
                    }
                }
            }
            //取暖费存储
            CmsPurchaseContractWuye::model()->deleteAll("contract_id = '$contract_id' and type=2");
            if($qunuan_money){
                $order=0;
                foreach($qunuan_money as $k=>$value){
                    if($value){
                        $qunuan = new CmsPurchaseContractWuye;
                        $qunuan->id = Guid::create_guid();
                        $qunuan->contract_id = $this->contract_id;
                        $qunuan->type = 2;
                        $qunuan->money = $value;
                        $qunuan->start_time = strtotime($qunuan_start[$k]);
                        $qunuan->end_time = strtotime($qunuan_end[$k]);
                        $qunuan->the_order = $order;
                        $qunuan->ctime = time();
                        if(!$qunuan->save()){
                            $this->OutputJson(0,json_encode($qunuan->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                        $order++;
                    }
                }
            }

            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
                // var_dump('bb');
                // die();
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/salecontract");


    }
    public function get_month_day($date1,$date2){
        //判断后者的天数是否大于前者的天数
        $date2 = date('Y-m-d',strtotime("+ 1 day",strtotime($date2)));
        $day1 = date('d',strtotime($date1));
        $day2 = date('d',strtotime($date2));
        $y1 = date('Y',strtotime($date1));
        $m1 = date('m',strtotime($date1));
        $m2 = date('m',strtotime($date2));
        $arr = [];
        if($day2>=$day1){
            $arr['m'] = $m2-$m1;
            $arr['d'] = $day2-$day1;
        }else{

            $daytmp = date("t",strtotime("$y1".'-'."$m1".'-'.'01'));
            $arr['m'] = $m2-$m1-1;
            $arr['d'] = $daytmp - $day1 +$day2;
        }
        return $arr;
    }
/*合同扫描件*/
    public function actionCopyadd(){
        //获取合同ID
        $contract_id = Yii::app()->request->getParam("id");
        $referer = $_SERVER['HTTP_REFERER'];
        $this->render('copyadd',array(
            'contract_id'=>$contract_id,
            'referer'=>$referer,
            ));

    }
    public function actionCopyaddsave(){
        //获取合同ID
        $contract_id = Yii::app()->request->getParam("contract_id");
        $contract_copy = Yii::app()->request->getParam("contract_copy");
        $referer = Yii::app()->request->getParam("referer");
        $contract_copy = explode(",",$contract_copy);
        array_shift($contract_copy);

        try{
            foreach ($contract_copy as $key => $value) {
                $contract_copy = new CmsContractCopy();
                $contract_copy ->id = Guid::create_guid();
                $contract_copy ->contract_id = $contract_id;
                $contract_copy ->url = $value;
                $contract_copy ->deleted = 0;
                $contract_copy ->ctime = time()+$key;
                if(!$contract_copy->save()){
                    $this->OutputJson(0,json_encode($thread_model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }

         } catch (Exception $e) {

            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);

        }

        $this->OutputJson(301,'',"$referer");

    }

    public function actionCopyedit(){
        $contract_id = Yii::app()->request->getParam("id");
        $referer = $_SERVER['HTTP_REFERER'];
        $contract_copy = CmsContractCopy::model()->findAll("contract_id = '$contract_id' and deleted =0 order by ctime ");
        $arr = [];
        foreach ($contract_copy as $key => $value) {
           $arr[] = $value->url;
        }
        $this->render('copyedit',array(
            'contract_id'=>$contract_id,
            'contract_copy'=>$contract_copy,
            'referer'=>$referer,
            'arr'=>$arr,
            ));

    }
    public function actionCopyeditsave(){
        $contract_id = Yii::app()->request->getParam("contract_id");
        $contract_copy = Yii::app()->request->getParam("contract_copy");
        $referer = Yii::app()->request->getParam("referer");
        $contract_copy = explode(",",$contract_copy);
        array_shift($contract_copy);
        try{
            if(!empty($contract_copy)){
                CmsContractCopy::model()->deleteAll("contract_id = '$contract_id' and deleted =0");
                foreach($contract_copy as $k => $v){
                    if($v){
                        $contract_copy = new CmsContractCopy;
                        $contract_copy ->id = Guid::create_guid();
                        $contract_copy ->contract_id = $contract_id;
                        $contract_copy ->url = $v;
                        $contract_copy ->deleted = 0;
                        $contract_copy ->ctime = time()+$k;
                        if(!$contract_copy->save()){
                            $this->OutputJson(0,json_encode($contract_copy->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }

                }
            }
         } catch (Exception $e) {

            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);

        }
        $this->OutputJson(301,'',"$referer");

    }

    public function actionCopydetail(){

        $contract_id = Yii::app()->request->getParam("id");
        $contract_copy = CmsContractCopy::model()->findAll("contract_id = '$contract_id' and deleted =0 order by ctime ");

        $this->render('copydetail',array(
            'contract_id'=>$contract_id,
            'contract_copy'=>$contract_copy,
            ));
    }
    public function actionCopydelete(){
        $contract_id = Yii::app()->request->getParam("id");
        $contract_copy = CmsContractCopy::model()->findAll("contract_id = '$contract_id'");
        try{
            if(!empty($contract_copy)){
                foreach($contract_copy as $k => $v){
                        $v ->deleted = 1;
                    if(!$v->save()){
                        $this->OutputJson(0,json_encode($contract_copy->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }
         } catch (Exception $e) {

            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);

        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',$_SERVER['HTTP_REFERER']);
        }
        else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function actionWeiyue(){
        try {
            
            $contract_id=$_POST['contract_id'];
            $status=$_POST['w_status'];
            $break_contract=$_POST['break_contract'];
            $break_contract_text=$_POST['break_contract_text'];
            $purchasecontract = CmsPurchaseContract::model()->find("id = '$contract_id'");
            $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
            $cpp = CmsPurchaseProperty::model()->findAll("contract_id = '$contract_id'");
            foreach ($cpp as $key => $value) {
               $value->status =$status;
               if(!$value->save()){
                    $this->OutputJson(0,json_encode($value->errors,JSON_UNESCAPED_UNICODE),null);
               }
            }
            //消息提醒开始
            $starts_arr = [0=>'正常', 2=>'我司违约',3=>'合同到期退租',4=>'合同到期续约',5=>'租户违约',6=>'租户转租',7=>'到期换房',8=>'合同作废',9=>'违约中','-1'=>'未付全首期款'];
            $starts = $starts_arr[$purchasecontract->status] ? $starts_arr[$purchasecontract->status] : '';

            $purchasecontract->status = $status;
            $purchasecontract->break_contract = $break_contract;
            $purchasecontract->break_contract_text = $break_contract_text;
            if(!$purchasecontract->save()){
                $this->OutputJson(0,json_encode($purchasecontract->errors,JSON_UNESCAPED_UNICODE),null);
            }else{
                //接消息提醒
                $ends = $starts_arr[$purchasecontract->status] ? $starts_arr[$purchasecontract->status] : '';
                $property_id = CmsPurchaseProperty::model()->findAll("contract_id = '$purchasecontract->id' and deleted=0");
                $house_no='';
                if(!empty($property_id)){
                    foreach ($property_id as $key => $value) {
                        if($key>0){
                            $house_no .= '/'.CmsProperty::model()->find("id = '$value->property_id' and deleted = 0")['house_no'];
                        }else{
                            $house_no .= '-'.CmsProperty::model()->find("id = '$value->property_id' and deleted = 0")['house_no'];
                        }
                        $information = CmsProperty::model()->find("id = '$value->property_id' and deleted = 0");
                    }
                    // 品牌
                    $estate_id = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
                    //系列
                    $building_id = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];

                    $news_title = '出车合同状态发生改变('.$estate_id.' '.$building_id.$house_no.' '.$starts.'->'.$ends.')';
                    if($starts != $ends){
                        CmsNews::user_news($contract_id,5,'1101_05',$news_title);

                    }
                }

                //客服没有出车的情况下合同作废，删除客服出车列表的这条数据
                if($status==8){
                   $dat=SerSellContract::model()->find("contract_id = '$contract_id' and deleted = 0");
                   if($dat){
                        if(!$dat->actual_date){
                            $dat->deleted = 1;
                            if(!$dat->save()){
                                $this->OutputJson(0,json_encode($dat->errors,JSON_UNESCAPED_UNICODE),null);
                            }
                        }                
                   }

                }

                //签约人删除
                $signer = CmsContractSigner::model()->findAll("contract_id = '$contract_id'");
                foreach ($signer as $key => $value) {
                    $value->deleted = 1;
                    if(!$value->save()){
                        $this->OutputJson(0,json_encode($value->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }

                $transaction1->commit();     

                $this->redirect($_SERVER['HTTP_REFERER']);
            }    
        } catch (Exception $e) {
                $transaction1->rollback(); //如果操作失败, 数据回滚
            
        }
        
    }

    public function payableCreate()
    {   

        $free_lease_start   =Yii::app()->request->getParam("free_lease_start");       //免租期开始时间
        $free_lease_end     =Yii::app()->request->getParam("free_lease_end");        //免租期结束时间
        $advance_days       =Yii::app()->request->getParam("advance_days");        //提前天数
        $rent_second_time   =Yii::app()->request->getParam("rent_second_time");//二期租金付款日期
        $day_str            =substr($rent_second_time,-2,2); //获取二期付款日期的最后日子
        $pay_month          =Yii::app()->request->getParam("pay_month");//付几月
        $deposit_start_time =Yii::app()->request->getParam("deposit_start_time");//阶段周期开始时间
        $deposit_end_time   =Yii::app()->request->getParam("deposit_end_time");//阶段周期结束时间
        $deposit_pay_time   =Yii::app()->request->getParam("deposit_pay_time");     //押金付款日期
        $lease_term_end     =Yii::app()->request->getParam("lease_term_end");       //租期结束
        $lease_term_start   =Yii::app()->request->getParam("lease_term_start");       //租期开始
        $lease_term_end     =strtotime($lease_term_end);
        $deposit            =Yii::app()->request->getParam("deposit");       //押金
        $rent_start_time    =Yii::app()->request->getParam("rent_start_time");     //首期租金付款日期


        //删除所有的数据重新生成
        CmsPurchaseReceivable::model()->deleteAll("contract_id = '$this->contract_id'");

        $day_str = substr($rent_second_time,-2,2); //获取二期付款日期的最后日子
        $pay_month =Yii::app()->request->getParam("pay_month");//付几月
        $deposit_start_time =Yii::app()->request->getParam("deposit_start_time");//阶段周期开始时间
        $deposit_end_time =Yii::app()->request->getParam("deposit_end_time");//阶段周期结束时间
        $order=0;

        //建立第一条数据（首期款项）
        $purchasereceivable=new CmsPurchaseReceivable();
        $purchasereceivable->id=Guid::create_guid();
        $purchasereceivable->contract_id=$this->contract_id;
        $purchasereceivable->the_order=$order;
        $purchasereceivable->pay_date= strtotime($deposit_pay_time);//首期押金付款日
        $purchasereceivable->type=1;//1=押金
        $purchasereceivable->start_time = strtotime($lease_term_start);//时间为租期开始时间
        $purchasereceivable->end_time = $lease_term_end;//租期结束时间
        $purchasereceivable->deleted = 0;
        $purchasereceivable->amount = $deposit*100;
        $purchasereceivable->ctime = time();
        if(!$purchasereceivable->save()){
            $this->OutputJson(0,json_encode($purchasereceivable->errors,JSON_UNESCAPED_UNICODE),null);
        }
        $advance_days_compare = $advance_days;

        //以多付款方式为基准，来确认租期的长短
        foreach ($pay_month as $key => $value) {

            if($key==0){
                $the_end_date= strtotime($deposit_start_time[0]);
            }else{
                $the_end_date = $the_end_date;
            }

            while($the_end_date<strtotime($deposit_end_time[$key])){
                $order++;
                $mark =0;
                //计算付款租期
                $the_start_date = strtotime("+1 day", $the_end_date);
                if($order==1){
                    $the_start_date = $the_end_date;
                }
                $the_end_date   = strtotime("+".$value." months -1 day", $the_start_date);
                $purchasereceivable=new CmsPurchaseReceivable();
                $purchasereceivable->id=Guid::create_guid();
                $purchasereceivable->contract_id=$this->contract_id;
                $purchasereceivable->the_order=$order;
                //付款日计算方法
                //先获取真实的提前天数
                if($order==2){
                    $advance_days= ($the_start_date - strtotime($rent_second_time))/86400;
                }
                //计算的提前天数不能与实际提前天数相去甚远
                if(abs($advance_days_compare-$advance_days)>2){
                    $this->OutputJson(0,'二期租金付款日期不符合正确合同规则，或修改，或者将被禁止录入请联系管理员',null);
                }
                $day = strtotime(date('Y-m-',$the_start_date-86400*$advance_days).$day_str);
                if($day_str>28){
                    if(date('m',$the_start_date-86400*$advance_days)==2){
                        //如果付款日>28,并且付款日子为2月的话，那么该日子就是月底
                        $day = strtotime(date('Y-m-t',$the_start_date-86400*$advance_days));                            
                    }
                    if($day_str==31){
                        $day = strtotime(date('Y-m-t',$the_start_date-86400*$advance_days));                            
                    }
                }

                $purchasereceivable->pay_date= $day;  //付款日期
                if($order==1){
                    $purchasereceivable->pay_date= strtotime($rent_start_time); //首期付款日期
                }
                //抛出免租期 ，开始时间，结束时间，金额
                //
                $purchasereceivable->start_time=$the_start_date;
                $purchasereceivable->end_time=$the_end_date;
                $purchasereceivable->amount     = $this->get_monthly_rent($this->contract_id,$the_start_date)*$value;
                //判断面租期是否在
                $the_amount = $this->get_monthly_rent($this->contract_id,$the_start_date);
                if($the_end_date>$lease_term_end){
                    $purchasereceivable->end_time  = $lease_term_end;
                    //付钱也应该少了
                    $last_date = $this->get_month_day(date('Y-m-d',$the_start_date),date('Y-m-d',$lease_term_end));
                    $purchasereceivable->amount    = (int)($the_amount*$last_date['m']+$the_amount*12/365*$last_date['d']);
                }
                $purchasereceivable->type=2; //租金
                $purchasereceivable->deleted=0;
                $purchasereceivable->ctime=time();
                if($mark==0){
                    if(!$purchasereceivable->save()){
                        $this->OutputJson(0,json_encode($purchasereceivable->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }


            }

        }
    }

}
