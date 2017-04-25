<?php

class SalescontrolController extends BackgroundBaseController
{
	public function actionIndex(){
		$search = Yii::app()->request->getParam("search");
		$keyword_area = Yii::app()->request->getParam('keyword_area');//区域
		$keyword_estate_group = Yii::app()->request->getParam("keyword_estate_group_id");//组团
		$news_content_id = Yii::app()->request->getParam('news_content_id');//消息内容id
		$news_type = Yii::app()->request->getParam('news_type');//消息类型
		$news_id = Yii::app()->request->getParam('news_id');//消息类型
		$keyword_estates = Yii::app()->request->getParam('keyword_estates');//品牌
		$keyword_building = Yii::app()->request->getParam('keyword_building');//系列
		$keyword_room_number = Yii::app()->request->getParam('keyword_room_number');//编号
		$keyword_decoration_status = Yii::app()->request->getParam('keyword_decoration_status');//装修状态
		$keyword_sale_rhythm = Yii::app()->request->getParam('keyword_sale_rhythm');//出车节奏
		$keyword_orientation = Yii::app()->request->getParam('keyword_orientation');//房间朝向
		$pagesize=10;
		/*
				根据车源查出车源的ID对应上合同
		 */
		//如果车源三个参数齐全查出固定的合同
		$proarr0=[];
		$proarr1=[];
		$proarr2=[];
		$proarr3=[];
		$proarr4=[];
		$proarr5=[];
		//商圈
		if($keyword_area){
				$districts=BaseArea::model()->findAll("name like '%".$keyword_area."%' and deleted=0");
				if($districts){
						$districts_id="";
						foreach ($districts as $key => $value) {
								if ($key==0){
										$districts_id.="'".$value->id."'";
								}
								else{
										$districts_id.=","."'".$value->id."'";
								}
						}
						$property=CmsProperty::model()->findAll("area_id in ($districts_id)");
						foreach ($property as $key => $value) {
										$proarr0[] = $value->id;
						}
				}
		}
		// 组团
		if($keyword_estate_group){
				$group=BaseEstateGroup::model()->findAll("name like '%".$keyword_estate_group."%' and deleted=0");
				if($group){
						$group_id="";
						foreach ($group as $key => $value) {
								if ($key==0){
										$group_id.="'".$value->id."'";
								}
								else{
										$group_id.=","."'".$value->id."'";
								}
						}
						$property=CmsProperty::model()->findAll("estate_group_id in ($group_id)");
						foreach ($property as $key => $value) {
										$proarr5[] = $value->id;
						}
				}
		}
		//品牌
		if($keyword_estates){
				$estates=BaseEstate::model()->findAll("name like '%".$keyword_estates."%' and deleted=0");
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
		if($keyword_building){
				$building=BaseBuilding::model()->findAll("name like '%".$keyword_building."%'  and deleted=0");
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
						$property5=CmsProperty::model()->findAll("building_id in ($building_id)");
						foreach ($property5 as $key => $value) {
								$proarr5[] = $value->id;
						}
				}
		}

		//编号
		if($keyword_room_number){
				$property3=CmsProperty::model()->findAll("house_no like '%".$keyword_room_number."%' and deleted=0");
				foreach ($property3 as $key => $value) {
						$proarr3[] = $value->id;
				}
		}
		//房间朝向
		if($keyword_orientation){
				$property4 = CmsProperty::model()->findAll("orientation='$keyword_orientation' and deleted=0" );
			foreach($property4 as $key => $value){
					$proarr4[] = $value->id;
			}
		}
		//查询判断是否为空
		if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_room_number) && !empty($keyword_decoration_status) && !empty($keywrod_estate_group_id)){
				$res_arr = array_intersect($proarr0,$proarr1,$proarr2,$proarr3,$proarr4,$proarr5);
		}else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_building)){
				$res_arr = array_intersect($proarr0,$proarr1,$proarr2);
		}else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_room_number)){
				$res_arr = array_intersect($proarr0,$proarr1,$proarr3);
		}else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_decoration_status)){
				$res_arr = array_intersect($proarr0,$proarr1,$proarr4);
		}else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_estate_group)) {
				$res_arr = array_intersect($proarr0,$proarr1,$proarr5);
		}else if(!empty($keyword_area) && !empty($keyword_building) && !empty($keyword_room_number)){
				$res_arr = array_intersect($proarr0,$proarr2,$proarr3);
		}else if(!empty($keyword_area) && !empty($keyword_building) && !empty($keyword_decoration_status)){
			  $res_arr = array_intersect($proarr0,$proarr2,$proarr4);
		}else if(!empty($keyword_area) && !empty($keyword_building) && !empty($keyword_estate_group)) {
				$res_arr = array_intersect($proarr0,$proarr2,$proarr5);
		}else if(!empty($keyword_area) && !empty($keyword_room_number) && !empty($keyword_decoration_status)){
		  	$res_arr = array_intersect($proarr0,$proarr3,$proarr4);
		}else if(!empty($keyword_area) && !empty($keyword_room_number) && !empty($keyword_estate_group)) {
				$res_arr = array_intersect($proarr0,$proarr3,$proarr5);
		}else if(!empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_room_number)){
				$res_arr = array_intersect($proarr1,$proarr2,$proarr3);
		}else if(!empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_decoration_status)){
			  $res_arr = array_intersect($proarr1,$proarr2,$proarr4);
		}else if(!empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_estate_group)) {
				$res_arr = array_intersect($proarr1,$proarr2,$proarr5);
		}else if(!empty($keyword_building) && !empty($keyword_room_number) && !empty($keyword_decoration_status)){
				$res_arr = array_intersect($proarr2,$proarr3,$proarr4);
		}else if(!empty($keyword_building) && !empty($keyword_room_number) && !empty($keyword_estate_group)) {
				$res_arr = array_intersect($proarr2,$proarr3,$proarr5);
		}else if(!empty($keyword_area) && !empty($keyword_estates)){
				$res_arr = array_intersect($proarr0,$proarr1);
		}else if(!empty($keyword_area) && !empty($keyword_building)){
				$res_arr = array_intersect($proarr0,$proarr2);
		}else if(!empty($keyword_area) && !empty($keyword_room_number)){
				$res_arr = array_intersect($proarr0,$proarr3);
		}else if(!empty($keyword_area) && !empty($keyword_decoration_status)){
			$res_arr = array_intersect($proarr0,$proarr4);
		}else if(!empty($keyword_area) && !empty($keyword_estate_group)) {
			$res_arr = array_intersect($proarr0,$proarr5);
		}else if(!empty($keyword_estates) && !empty($keyword_building)){
				$res_arr = array_intersect($proarr1,$proarr2);
		}else if(!empty($keyword_estates) && !empty($keyword_room_number)){
				$res_arr = array_intersect($proarr1,$proarr3);
		}else if(!empty($keyword_estates) && !empty($keyword_decoration_status)){
				$res_arr = array_intersect($proarr1,$proarr4);
		}else if(!empty($keyword_estates) && !empty($keyword_estate_group)) {
				$res_arr = array_intersect($proarr1,$proarr5);
		}else if(!empty($keyword_building) && !empty($keyword_room_number)){
				$res_arr = array_intersect($proarr2,$proarr3);
		}else if(!empty($keyword_building) && !empty($keyword_decoration_status)){
			  $res_arr = array_intersect($proarr2,$proarr4);
		}else if(!empty($keyword_building) && !empty($keyword_estate_group)) {
			$res_arr = array_intersect($proarr2,$proarr5);
		}else if(!empty($keyword_room_number) && !empty($keyword_decoration_status)){
			$res_arr = array_intersect($proarr3,$proarr4);
		}else if(!empty($keyword_room_number) && !empty($keyword_estate_group)) {
			$res_arr = array_intersect($proarr3,$proarr5);
		}else if(!empty($keyword_decoration_status) && !empty($keyword_estate_group)) {
			$res_arr = array_intersect($proarr4,$proarr5);
		}else{
				$res_arr=array_merge($proarr0,$proarr1,$proarr2,$proarr3,$proarr4,$proarr5);
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
			//根据车源ID查出合同ID
		$contract_id="";
		if($property_id){
				$contract_id="";
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

		//出车节奏
		if($keyword_sale_rhythm!=0){
				$ursproperty=UrsPropertyDetail::model()->findAll("sale_rhythm='$keyword_sale_rhythm'");
				$contract_id_rhythm=[];
				foreach($ursproperty as $value){
						$res=CmsPurchaseProperty::model()->findAll("property_id='$value->property_id'");

						foreach ($res as $key => $value){
								$contract_id_rhythm[]="'".$value->contract_id."'";
						}
				}
				$contract_id_rhythm=implode(",",$contract_id_rhythm);
		}

		//装修状态

		if(	$keyword_decoration_status!=null){//装修状态

				$decoration_status='';
				foreach ($keyword_decoration_status as $key => $value) {
						if ($key==0){
								$decoration_status.="'".$value."'";
						}
						else{
								$decoration_status.=","."'".$value."'";
						}
				}

				$ursproperty=UrsDecorationFollow::model()->findAll("decoration_status in ($decoration_status) and deleted='0'");
				$decoration_id=[];
				foreach($ursproperty as $value){
						$item=UrsDecorationFollow::model()->find(array(
								'condition'=>"decoration_id='$value->decoration_id' and deleted='0'",
								'order'=>'ctime desc',
						));
						// var_dump($item);
						// var_dump($item);
						// var_dump($item);
						// var_dump($item);
						if(in_array("$item->decoration_status",$keyword_decoration_status)){
								$res=QualityDecoration::model()->findAll("id='$item->decoration_id' and deleted='0'");
								foreach ($res as $key => $value){
										$decoration_id[]="'".$value->contract_id."'";
								}
						}
				}
				$decoration_id=array_flip($decoration_id);
				$decoration_id=array_flip($decoration_id);
				$decoration_id=implode(",",$decoration_id);
		}

		$condition="1=1 and t.deleted=0";


		//新添销控  消息提醒
		if(!empty($news_type) && !empty($news_content_id)){
		    $usernews = UserNews::model()->find("1=1 and news_type = '$news_type' and user_news_id = '{$_SESSION['admin_uid']}'");
		    if(!empty($usernews)){
		        $condition.= " and property_id ='$news_content_id' ";
		    }else{
		        $this->redirect('/admin/home');
		    }
		}


		$condition.=" and  ( 1=1  ";
		//区域.品牌.系列.编号查询条件
		if($keyword_area || $keyword_estates || $keyword_building || $keyword_room_number || $keyword_orientation || $keyword_estate_group){
				if($contract_id){
						$condition.= " and  contract_id in ($contract_id) ";
				}else{
						$condition.= " and  contract_id in ('') ";
				}
		}
		//出车节奏查询合同值
		if($keyword_sale_rhythm){
				if($contract_id_rhythm){
						$condition.= " and  contract_id in ($contract_id_rhythm)";
				}else{
						$condition.= " and  contract_id in ('')";
				}

		}

		//装修状态查询合同值
		if($keyword_decoration_status){
				if($decoration_id){
						$condition.= " and  contract_id in ($decoration_id)";
				}else{
						$condition.= " and  contract_id in ('')";
				}

		}

		$condition.=")";

		//主页面的分页
		$criteria = new CDbCriteria;
		$criteria->condition = $condition;
		$criteria->order = 't.ctime desc';
		$count = UrsSalesControl::model()->count($criteria);
		$pager = new CPagination($count);
		$pager->pageSize = $pagesize;
		$pager->appLylimit($criteria);
		$userarr =  UrsPropertyDetail::model()->arr();//调用下拉框的方法
		$ursarr=UrsPropertyDetail::model()->arr();
		if($keyword_decoration_status==null){
			 $keyword_decoration_status=[];
		}
		$list = UrsSalesControl::model()->findAll($criteria);

		if(!empty($news_type) && !empty($news_content_id)){
	        $modelnewss = UserNews::model()->find("1=1 and id='$news_id'  and user_news_id='{$_SESSION['admin_uid']}'");
	        $modelnewss->status = 1;
	        $modelnewss->save();
			if(empty($list)){
				$alert_error = 7;
		    	$this->redirect("/admin/usernews?alert_error=".$alert_error.'&news_type='.$news_type);
			}
		}
		// var_dump($list);
		$this->render('index',array(
							'list' => $list,
							'userarr' => $userarr,
							'ursarr' => $ursarr,
							'pages' => $pager,
							'keyword_area' => $keyword_area,
							'keyword_estates' => $keyword_estates,
							'keyword_building' => $keyword_building,
							'keyword_room_number' => $keyword_room_number,
							'keyword_decoration_status' =>$keyword_decoration_status,
							'keyword_sale_rhythm' => $keyword_sale_rhythm,
							'keyword_orientation' => $keyword_orientation,
							'search' => $search,
							'keyword_estate_group_id' => $keyword_estate_group,
							'news_content_id' => $news_content_id,
		));
	}
		// 修改报价
		public function actioneditunit() {
					$property_id = Yii::app()->request->getParam("property_id");

					$referer = $_SERVER['HTTP_REFERER'];
					$unit = Yii::app()->request->getParam("unit_price");
					$model = UrsSalesControl::model()->find("property_id = '$property_id' and deleted = 0");
					if($unit!=null) {
							$model->unit_price = $unit*100;
							if(!$model->save()) {
									$this->OutputJson(0,$model->errors,null);
							}
							$this->redirect($referer);
					}
		}
	//幼狮车源销控详情
	public function actiondetail()
	{
			$referer= $_SERVER['HTTP_REFERER'];

			//车源id
			$property_id =Yii::app()->request->getParam("id");

			//车源图片
			$propertyphoto=CmsPropertyPhoto::model()->findAll("property_id='$property_id' order by show_order");
			$v1=[];
			foreach($propertyphoto as $val){
					$v1[$val->type_photo][]=$val;
			}
			$ursproperty=UrsPropertyDetail::model()->find("property_id='$property_id'");
			//幼狮车源图片
			$v=[];
			if($ursproperty){
					//幼狮车源信息表有这条数据时
					$ursproperty_id=$ursproperty->id;
					$ursphoto=UrsPhoto::model()->findAll("property_id='$ursproperty_id' order by show_order");
					foreach($ursphoto as $value){
						 $v[$value->type_photo][]=$value;
					}
			}

			//查询车源管理表信息
			$property=CmsProperty::model()->find("id='$property_id'");
			$arrproperty=CmsProperty::model()->arr();
			$arr=UrsPropertyDetail::model()->arr();
			$this->render("detail",array(
					'property_id'=>$property_id,
					'property_photo'=>$v1,
					'photo'=>$v,
					'ursproperty'=>$ursproperty,
					'property'=>$property,
					'referer'=>$referer,
					'arr'=>$arr,
					'arrproperty'=>$arrproperty,
			));
	}
	//移除销控
	public function actionDelete(){
				$referer = $_SERVER['HTTP_REFERER'];
				$property_id = Yii::app()->request->getParam('id');
				$model = UrsSalesControl::model()->find("property_id='$property_id' and deleted=0");
				// var_dump($model);die;
				$model->deleted = 1;

				$transaction = Yii::app()->db->beginTransaction(); //开启事务
				try {

					if (!$model->save()){
						if(Yii::app()->request->isRjaxReturn){
							$this->OutputJson(0,$model->errors,null);
						}

					}
					$ursgoods = UrsGoodsDetail::model()->findAll("property_id='$property_id'");
					foreach ($ursgoods as $key => $value) {
						$value->deleted = 2;
						if (!$value->save()){
							if(Yii::app()->request->isRjaxReturn){
								$this->OutputJson(0,$value->errors,null);
							}

						}
					}
					//消息提醒开始
					$house_no = '-'.CmsProperty::model()->find("id = '$model->property_id' and deleted = 0")['house_no'];
					$information = CmsProperty::model()->find("id = '$model->property_id' and deleted = 0");
					// 品牌
					$estate_id = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
					//系列
					$building_id = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];

					$news_title = '下销控('.$estate_id.' '.$building_id.$house_no.')';
					CmsNews::user_news($model->property_id,8,'1101_08',$news_title);
					//短信提醒
					// $content = '【幼狮空间】幼狮空间提醒您：移除销控［'.$estate_id.' '.$building_id.''.$house_no.'，'.$information['area'].'㎡］>>请登录幼狮ERP系统查看消息详情';
					//
					// $message = new Message();
					// $status = $message->sendmsg('1201_02',$content);


				    $transaction->commit(); //提交事务会真正的执行数据库操作
				} catch (Exception $e) {
				    $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
				    $transaction->rollback(); //如果操作失败, 数据回滚
				}
				$this->redirect($referer);
	}
	// 销控跟进
	public function actionSaleFollow()
	{
			$property_id = Yii::app()->request->getParam('property_id'); // 车源ID
			$type = Yii::app()->request->getParam('type');  // 跟进类型
			$channel_id = Yii::app()->request->getParam('channel_id'); // 渠道公司
			$channel_manager_id = Yii::app()->request->getParam('channel_manager_id'); //渠道人员
			$phone = Yii::app()->request->getParam('phone'); //电话
			$customer_business = Yii::app()->request->getParam('customer_business'); //客户业态
			$budget = Yii::app()->request->getParam('budget'); //预算
			$demand_area = Yii::app()->request->getParam('demand_area'); //需求面积
			$demand_district = Yii::app()->request->getParam('demand_district'); //需求区域
			$responsible_person = Yii::app()->request->getParam('responsible_person'); // 是否负责人
			$follow_detail = Yii::app()->request->getParam('follow_detail'); //跟进情况
			$room_time = strtotime(Yii::app()->request->getParam('room_time')); //订房时间
			$creater_id=Yii::app()->session['admin_uid'];//跟进人
			$item = AdminUser::model()->find("id = '$creater_id'");
			$data = AdminDepartment::model()->find("id = '$item->department_id'");
			$property_id = explode(",",$property_id);

			foreach($property_id as $value){
				$salefollow = new UrsSalesFollow();
				$salefollow->id = Guid::create_guid();
				$salefollow->property_id = $value;
				$salefollow->type = $type;
				if($data){
					$salefollow->department_id = $data->id;
				}
				$salefollow->channel_id = $channel_id;
				$salefollow->channel_manager_id = $channel_manager_id;
				$salefollow->channel_phone = $phone;
				$salefollow->customer_business = $customer_business;
				$salefollow->budget = $budget;
				$salefollow->demand_area = $demand_area*100;
				$salefollow->demand_district = $demand_district;
				$salefollow->responsible_person = $responsible_person;
				$salefollow->follow_detail = $follow_detail;
				$salefollow->creater_id = $creater_id;
				$salefollow->ctime=time();
				$salefollow->room_time = $room_time;
				$salefollow->deleted=0;
					if (!$salefollow->save()){
							$this->redirect(0,$salefollow->errors,null);
					}
			}
			if(Yii::app()->request->isAjaxRequest){
					$this->OutputJson(301,'',"/admin/salescontrol");
			}
			else{
					$this->redirect("/admin/salescontrol");
			}


	}
	//查看跟进
	public function actionLookFollow(){

		$property_id = Yii::app()->request->getParam('id'); //接受车源ID
		$keyword_signing_date1 = Yii::app()->request->getParam('keyword_signing_date1');//带看日期
		$keyword_signing_date2 = Yii::app()->request->getParam('keyword_signing_date2');//带看日期
		$keyword_channel_id = Yii::app()->request->getParam('keyword_channel_id'); //渠道公司
		$keyword_channel_manager_id = Yii::app()->request->getParam('keyword_channel_manager_id'); //渠道人员
		$keyword_creater_id = Yii::app()->request->getParam('keyword_creater_id'); //带看人ID
		$keyword_department_id = Yii::app()->request->getParam('keyword_department_id');//带看人组名
		$pagesize = 10;
		$condition = "(1=1 and t.deleted=0";
		$condition.=" and property_id='$property_id' ";
		//搜索渠道人员
		if($keyword_channel_manager_id){
					$channel_manager = CmsChannelManager::model()->findAll("name like '%".$keyword_channel_manager_id."%'");
					// var_dump($channel_manager);
					if($channel_manager){
								$channel_manager_id = '';
								foreach($channel_manager as $key=>$value){
									if ($key==0){
											$channel_manager_id.="'".$value->id."'";
									}
									else{
											$channel_manager_id.=","."'".$value->id."'";
									}
								}
								$condition.=" and channel_manager_id in ($channel_manager_id)";
					}else{
								$condition.=" and 1=0";
					}
		}
		// 搜索渠道公司
		if($keyword_channel_id){
					$channel = CmsChannel::model()->findAll("name like '%".$keyword_channel_id."%'");
					if($channel){
								$channel_id = '';
								foreach($channel as $key=>$value){
									if ($key==0){
											$channel_id.="'".$value->id."'";
									}
									else{
											$channel_id.=","."'".$value->id."'";
									}
								}
								$condition.=" and channel_id in ($channel_id)";
					}else{
						   $condition.=" and 1=0";
					}
		}
		//带看人搜索
		if($keyword_creater_id){
					$creater = AdminUser::model()->findAll("nickname like '%".$keyword_creater_id."%'");
					if($creater){
								$creater_id = '';
								foreach($creater as $key=>$value){
									if ($key==0){
											$creater_id.="'".$value->id."'";
									}
									else{
											$creater_id.=","."'".$value->id."'";
									}
								}
								$condition.=" and creater_id in ($creater_id)";
					}else{
						   $condition.=" and 1=0";
					}
		}
		//搜索组名
		if($keyword_department_id){
					$department = AdminDepartment::model()->findAll("name like '%".$keyword_department_id."%'");
					if($department){
								$department_id = '';
								foreach($department as $key=>$value){
									if ($key==0){
											$department_id.="'".$value->id."'";
									}
									else{
											$department_id.=","."'".$value->id."'";
									}
								}
								$condition.=" and department_id in ($department_id)";
					}else{
						   $condition.=" and 1=0";
					}
		}
		// 搜索带看日期
				$keyword_signing_start=strtotime($keyword_signing_date1);
				$keyword_signing_end=strtotime($keyword_signing_date2)+24*3600;
				if ($keyword_signing_date1) {
						$condition.=" and ctime >= '$keyword_signing_start' ";
				}
				if ($keyword_signing_date2) {
						$condition.=" and ctime <= '$keyword_signing_end' ";
				}
		$condition.=")";
		$criteria = new CDbCriteria();
		$criteria->condition = $condition;
		$criteria->order = 't.ctime desc';
		$count = 	UrsSalesFollow::model()->count($criteria);
		$pager = new CPagination($count);
		$pager->pagesize = $pagesize;
		$pager->applyLimit($criteria);

		$list = UrsSalesFollow::model()->findAll($criteria);
		$this->render('lookfollow',array(
				'list' => $list,
				'pages' => $pager,
				'property_id' => $property_id,
				'channel_manager_id' => $keyword_channel_manager_id,
				'channel_id' => $keyword_channel_id,
				'creater_id' => $keyword_creater_id,
				'department_id' => $keyword_department_id,
				'signing_date1' => $keyword_signing_date1,
				'signing_date2' => $keyword_signing_date2,
		));

	}
	//修改礼品
	public function actionEdit()
	{
		$referer= $_SERVER['HTTP_REFERER'];
		$property_id = Yii::app()->request->getParam('property_id');
		$contract_id = Yii::app()->request->getParam('contract_id');



		//车源图片
		$propertyphoto=CmsPropertyPhoto::model()->findAll("property_id='$property_id' order by show_order");
		$v1=[];
		foreach($propertyphoto as $val){
				$v1[$val->type_photo][]=$val;
		}
		$ursproperty=UrsPropertyDetail::model()->find("property_id='$property_id'");
          //幼狮车源图片
		$v=[];
		if($ursproperty){
				//幼狮车源信息表有这条数据时
				$ursproperty_id=$ursproperty->id;
				$ursphoto=UrsPhoto::model()->findAll("property_id='$ursproperty_id' order by show_order");
				foreach($ursphoto as $value){
					 $v[$value->type_photo][]=$value;
				}
		}

		//查询车源管理表信息
		$property=CmsProperty::model()->find("id='$property_id'");
		$arrproperty=CmsProperty::model()->arr();
		$arr=UrsPropertyDetail::model()->arr();


		$this->render("edit",array(
			'property' => $property,
			'property_id' => $property_id,
			'contract_id' => $contract_id,
			'ursproperty'=>$ursproperty,
			'referer'=>$referer,
			'arr'=>$arr,
			'arrproperty'=>$arrproperty,
		));
	}
	//修改礼品
	public function actionDoEdit()
	{
		$property_id = Yii::app()->request->getParam('property_id');
		$contract_id = Yii::app()->request->getParam('contract_id');
		$referer = Yii::app()->request->getParam('referer');
		$up_creater=Yii::app()->session['admin_uid'];
		$acq = Yii::app()->request->getParam('acq_broker');
		$number = Yii::app()->request->getParam('number');
		$json = [];
		$json[$number[0].'-'.$number[1]] = $acq[0].','.$acq[1];
		$json[$number[2].'-'.$number[3]] = $acq[2].','.$acq[3];
		$json[$number[4].'-'.$number[5]] = $acq[4].','.$acq[5];
		$json[$number[6].'-'.$number[7]] = $acq[6].','.$acq[7];
		$json = json_encode($json);

		$area = Yii::app()->request->getParam('area');// 销售面积
		$orientation = Yii::app()->request->getParam('orientation'); //房间朝向
		$unit_price = Yii::app()->request->getParam('unit_price');  //参考单价
		$live_date = Yii::app()->request->getParam("live_date"); //可入住时间
		$name = Yii::app()->request->getParam('name'); //联系人
		$phone = Yii::app()->request->getParam('phone'); //联系人电话
		$name = implode(',',$name);
		$phone = implode(',',$phone);


		if($orientation!=null) {
					$item = CmsProperty::model()->find("id='$property_id'");
					$item->orientation = $orientation;
					if(!$item->save()) {
								$this->OutputJson(0,$item->errors,null);
					}
		}
		if($unit_price!=null) {
			$item=UrsSalesControl::model()->find("property_id='$property_id' and deleted=0");
			$item->unit_price = $unit_price*100;
			if(!$item->save()) {
							$this->OutputJson(0,$item->errors,null);
			}
		}
		if($live_date!=null) {
					$item=UrsSalesControl::model()->find("property_id='$property_id'");
					$live_date = strtotime($live_date);
					$item->live_date = $live_date;
					if(!$item->save()) {
									$this->OutputJson(0,$item->errors,null);
					}
		}
		if($name!=null) {
			$item=UrsSalesControl::model()->find("property_id='$property_id' and deleted=0");
			$item->name = $name;
			if(!$item->save()) {
							$this->OutputJson(0,$item->errors,null);
			}
		}
		if($phone!=null) {
			$item=UrsSalesControl::model()->find("property_id='$property_id' and deleted=0");
			$item->phone = $phone;
			if(!$item->save()) {
							$this->OutputJson(0,$item->errors,null);
			}
		}
		//写进礼品
		$goods = UrsGoodsDetail::model()->find("property_id = '$property_id'  and deleted=0");
		if($goods){
			$goods->json=$json;
			$goods->up_creater=$up_creater;
			$goods->ctime=time();
			$goods->deleted=0;
			if (!$goods->save()){
			    $this->result(0,$goods->errors,null);
			}
		}
		$this->redirect($referer);
	}
 }
