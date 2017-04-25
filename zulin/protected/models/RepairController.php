				<?php
				class RepairController extends BackgroundBaseController
				{

					// 售后主页面
					public function actionIndex(){
						$search =Yii::app()->request->getParam("search");
						$keyword_district = Yii::app()->request->getParam('keyword_district');//区域
						$keyword_estates = Yii::app()->request->getParam('keyword_estates');//品牌
						$keyword_building = Yii::app()->request->getParam('keyword_building');//系列
						$keyword_room_number = Yii::app()->request->getParam('keyword_room_number');//编号
						$keyword_ctime = Yii::app()->request->getParam('keyword_ctime');//报修时间
						$keyword_ctime1 = Yii::app()->request->getParam('keyword_ctime1');
						$keyword_criter = Yii::app()->request->getParam('keyword_criter'); //制单人
						$keyword_repair_type = Yii::app()->request->getParam('keyword_repair_type');//报修类型
						$keyword_name = Yii::app()->request->getParam('keyword_name');//报修人
						$keyword_urs_user = Yii::app()->request->getParam('keyword_urs_user'); //幼狮员工
						$keyword_evolve_type = Yii::app()->request->getParam('keyword_evolve_type'); //进展状态
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
						//区域
						if($keyword_district){
								$districts=BaseDistrict::model()->findAll("name like '%".$keyword_district."%' and deleted=0");
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
										$property=CmsProperty::model()->findAll("district_id in ($districts_id)");
										foreach ($property as $key => $value) {
														$proarr0[] = $value->id;
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
										$property2=CmsProperty::model()->findAll("building_id in ($building_id)");
										foreach ($property2 as $key => $value) {
												$proarr2[] = $value->id;
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

						//查询判断是否为空
						if(!empty($proarr0) && !empty($proarr1) && !empty($proarr2) && !empty($proarr3) && !empty($proarr4)){
								$res_arr = array_intersect($proarr0,$proarr1,$proarr2,$proarr3,$proarr4);
						}else if(!empty($proarr0) && !empty($proarr1) && !empty($proarr2)){
								$res_arr = array_intersect($proarr0,$proarr1,$proarr2);
						}else if(!empty($proarr0) && !empty($proarr1) && !empty($proarr3)){
								$res_arr = array_intersect($proarr0,$proarr1,$proarr3);
						}else if(!empty($proarr0) && !empty($proarr1) && !empty($proarr4)){
								$res_arr = array_intersect($proarr0,$proarr1,$proarr4);
						}else if(!empty($proarr0) && !empty($proarr2) && !empty($proarr3)){
								$res_arr = array_intersect($proarr0,$proarr2,$proarr3);
						}else if(!empty($proarr0) && !empty($proarr2) && !empty($proarr4)){
								$res_arr = array_intersect($proarr0,$proarr2,$proarr4);
						}else if(!empty($proarr0) && !empty($proarr3) && !empty($proarr4)){
								$res_arr = array_intersect($proarr0,$proarr3,$proarr4);
						}else if(!empty($proarr1) && !empty($proarr2) && !empty($proarr3)){
								$res_arr = array_intersect($proarr1,$proarr2,$proarr3);
						}else if(!empty($proarr1) && !empty($proarr2) && !empty($proarr4)){
								$res_arr = array_intersect($proarr1,$proarr2,$proarr4);
						}else if(!empty($proarr2) && !empty($proarr3) && !empty($proarr4)){
								$res_arr = array_intersect($proarr2,$proarr3,$proarr4);
						}else if(!empty($proarr0) && !empty($proarr1)){
								$res_arr = array_intersect($proarr0,$proarr1);
						}else if(!empty($proarr0) && !empty($proarr2)){
								$res_arr = array_intersect($proarr0,$proarr2);
						}else if(!empty($proarr0) && !empty($proarr3)){
								$res_arr = array_intersect($proarr0,$proarr3);
						}else if(!empty($proarr0) && !empty($proarr4)){
							$res_arr = array_intersect($proarr0,$proarr4);
						}else if(!empty($proarr1) && !empty($proarr2)){
								$res_arr = array_intersect($proarr1,$proarr2);
						}else if(!empty($proarr1) && !empty($proarr3)){
								$res_arr = array_intersect($proarr1,$proarr3);
						}else if(!empty($proarr1) && !empty($proarr4)){
								$res_arr = array_intersect($proarr1,$proarr4);
						}else if(!empty($proarr2) && !empty($proarr3)){
								$res_arr = array_intersect($proarr2,$proarr3);
						}else if(!empty($proarr2) && !empty($proarr4)){
								$res_arr = array_intersect($proarr2,$proarr4);
						}else if(!empty($proarr3) && !empty($proarr4)){
							$res_arr = array_intersect($proarr3,$proarr4);
						}else{
								$res_arr=array_merge($proarr0,$proarr1,$proarr2,$proarr3,$proarr4);
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
						$condition = "(1=1 and deleted=0 and evolve_type not in (5,6,7,8) ";
					//制单人
					if($keyword_criter){
									$criter_id = AdminUser::model()->find("nickname like '%".$keyword_criter."%'");
									if($criter_id){
												$condition.=" and criter_id = '$criter_id->id'";
									}else{
												$condition.=' and 1=0';
									}
					}
					//报修人(租户)
					if($keyword_name){
									$condition.= " and name like '%".$keyword_name."%'";
					}
					//报修人(幼狮内部员工)
					if($keyword_urs_user){
								$urs_user_id = AdminUser::model()->findAll("nickname like '%".$keyword_urs_user."%'");
								$urs_user_id1 = '';
								if($urs_user_id){
										foreach($urs_user_id as $key=>$val){
													if($key==0){
																$urs_user_id1.= "'". $val['id']."'";
													}else{
															$urs_user_id1.= ","."'".$val['id']."'";
													}
										}
								}

					}
				 //幼狮内部员工搜素条件
					if($keyword_urs_user){
							if($urs_user_id1){
										$condition.=" and urs_user_id in ($urs_user_id1)";
							}else{
										$condition.=" and 1=0";
							}
					}
				 //报修类型
					 if($keyword_repair_type!=null){
						 if($keyword_repair_type==0){
								 $condition.=" and 1=1";
						 }else{
							 $condition.=" and repair_type ='$keyword_repair_type' ";
						 }
					 }
				//报修进展状态
				if($keyword_evolve_type!=null){
						if($keyword_evolve_type==0){
								$condition.=' and 1=1';
						}	else{
								$condition.=" and evolve_type='$keyword_evolve_type'";
						}
				}
						if($keyword_district !=null || $keyword_estates!=null || $keyword_building!=null || $keyword_room_number!=null){
								if($property_id){
										$condition.= " and  property_id in ($property_id) ";
								}else{
										$condition.= " and  property_id in ('') ";
								}
						}
						$keyword_ctime_start=strtotime($keyword_ctime);
						$keyword_ctime_end=strtotime($keyword_ctime1)+24*3600;
								if ($keyword_ctime) {
										$condition.=" and ctime >= '$keyword_ctime_start' ";
								}
								if ($keyword_ctime1) {
										$condition.=" and  ctime <= '$keyword_ctime_end' ";
								}

						$condition.= ')';
						$criteria = new CDbCriteria;
						$criteria->order = 't.ctime desc';
						$criteria->condition = $condition;
						$count = SerAfterSales::model()->count($criteria);
						$pager=new CPagination($count);
						$pager->pagesize = $pagesize;
						$pager->applyLimit($criteria);
						$list = SerAfterSales::model()->findAll($criteria);
						$this->render('index',array(
								'pages' => $pager,
								'list' => $list,
								'keyword_district' => $keyword_district,
								'keyword_building' => $keyword_building,
								'keyword_estates'  => $keyword_estates,
								'keyword_room_number' => $keyword_room_number,
								'keyword_ctime' => $keyword_ctime,
								'keyword_ctime1' => $keyword_ctime1,
								'keyword_criter' => $keyword_criter,
								'keyword_repair_type'=> $keyword_repair_type,
								'keyword_name' => $keyword_name,
								'keyword_urs_user' => $keyword_urs_user,
								'keyword_evolve_type' => $keyword_evolve_type,
								'search' => $search,
						));
					}
					// 查看单子
					public function actionLookOrder() {
               	$id = Yii::app()->request->getParam('id');
								$model = SerAfterSales::model()->find("id='$id'");
								$this->render('lookorder',array(
										'model' => $model,
										'id' => $id,
								));
					}
					//接单方法
					public function actiongetorder() {
						$referer = $_SERVER['HTTP_REFERER'];
						$id = Yii::app()->request->getParam('id'); //接受接单的ID值
						$transaction = Yii::app()->db->beginTransaction();
						try{
									$model = Seraftersales::model()->find("id='$id'");
									$model->evolve_type = 2;
									if(!$model->save()) {
										$this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
								}

								if($model->repair_type==8) {
									$list = new QualityDecoration();
									$guid = Guid::create_guid();
									$list->id = $guid;
									$contract = [];
									$contract = explode(',',$model->contract_id);
									foreach($contract as $value) {
											$contract_id = CmsPurchaseContract::model()->find("id='$value'");
											if($contract_id->type == 0) {
														$list->contract_id = $value;
											}
									}
									$list->status = 2;
									$list->decoration_type = 2;
									$list->deleted = 0;
									$list->ctime = time();
									if(!$list->save()) {
												$this->OutputJson(0,json_encode($list->errors,JSON_UNESCAPED_UNICODE),null);
									}
								 	$property = new QualityDecorationProperty();
								 	$property->id = Guid::create_guid();
								 	$property->decoration_id = $guid;
								 	$property->property_id = $model->property_id;
									$property->deleted = 0;
								 	if(!$property->save()) {
											$this->OutputJson(0,json_encode($property->errors,JSON_UNESCAPED_UNICODE),null);
							  	}
								}
									$transaction->commit();
						} catch (Exception $e){
									$this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
									$transaction->rollback(); //如果操作失败, 数据回滚
						}
						$this->redirect("/admin/repair");
					  // $this->OutputJson(301,"","/admin/repair");
					}
					//删除方法
					public function actionDelete(){
							$referer = $_SERVER['HTTP_REFERER'];
							$id = Yii::app()->request->getParam('id'); //接受要删除信息的ID值
							$model = SerAfterSales::model()->find("id='$id'");
							$model->deleted  = 1;
							if(!$model->save()){
										if(Yii::app()->request->isAjaxRequest){
													$this->OutputJson(0,$model->errors,'');
										}
							}
							if(Yii::app()->request->isAjaxRequest){
											$this->OutputJson(301,'','/admin/SerAfterSales');
							}else{
										$this->redirect($referer);
							}
					}
				//添加施工单位
				public function actionCreateOrder() {
						$after_id = Yii::app()->request->getParam("after_id"); //售后ID
						$name = Yii::app()->request->getParam('name');//维修队名字
						$phone = Yii::app()->request->getParam('phone'); //维修队电话
						$subjection = Yii::app()->request->getParam('subjection'); //工程维修隶属
						$project_cost = Yii::app()->request->getParam('project_cost'); //工程内部报价
						$real_option = Yii::app()->request->getParam('real_option'); // 实际维修项目
						$option_infor = Yii::app()->request->getParam('option_infor'); //维修详情
						$mass_time = Yii::app()->request->getParam('mass_time'); //质量保修期
						$mass_time1 = Yii::app()->request->getParam("mass_time1");
						$start_time = Yii::app()->request->getParam("start_time"); //开始维修时间
						$hope_end_time = Yii::app()->request->getParam("hope_end_time"); // 预计完成期限

						$transaction = Yii::app()->db->beginTransaction(); //开启事务
						try{
									$model = new QualityProject();
									$model->id = Guid::create_guid();
									$model->after_id = $after_id;
									$model->name = $name;
									$model->phone = $phone;
									$model->subjection = $subjection;
									$model->project_cost = $project_cost*100;
									$model->real_option = $real_option;
									$model->option_infor = $option_infor;
									$model->mass_time = strtotime($mass_time);
									$model->mass_time1 = strtotime($mass_time1);
									$model->start_time = strtotime($start_time);
									$model->hope_end_time = strtotime($hope_end_time);
									$model->ctime = time();
									if(!$model->save()) {
											$this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
									}
									$list = Seraftersales::model()->find("id='$after_id'");
									if($list) {
										$list->evolve_type = 3;
										if(!$list->save()) {
												$this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
										}
									}

										$transaction->commit();
						}catch(Exception $e) {
					      		$this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
										$transaction->rollback();
						}
							$this->redirect("/admin/repair");
				}
				// 详情页
				public function actionDetails(){
						$id = Yii::app()->request->getParam('id');
						$model = SerAfterSales::model()->find("id='$id'");
						$list = QualityProject::model()->find("after_id='$id'");
						$this->render('details',array(
								'model' => $model,
								'list' => $list,
								'id' => $id,
						));
				}
				//更改工程队基本信息
				public function actionEdit() {
					$referer = $_SERVER['HTTP_REFERER'];
					$id = Yii::app()->request->getParam('id'); //接收修改的售后信息
					$model = QualityProject::model()->find("after_id='$id'");
					$this->render('edit',array(
							'id' => $id,
							'model' => $model,
							'referer' => $referer
					));
				}
				//接收更改信息
				public function actionEnterEdit() {
					$after_id = Yii::app()->request->getParam("after_id"); //售后ID
					$name = Yii::app()->request->getParam('name');//维修队名字
					$phone = Yii::app()->request->getParam('phone'); //维修队电话
					$subjection = Yii::app()->request->getParam('subjection'); //工程维修隶属
					$project_cost = Yii::app()->request->getParam('project_cost'); //工程内部报价
					$real_option = Yii::app()->request->getParam('real_option'); // 实际维修项目
					$option_infor = Yii::app()->request->getParam('option_infor'); //维修详情
					$mass_time = Yii::app()->request->getParam('mass_time'); //质量保修期
					$mass_time1 = Yii::app()->request->getParam("mass_time1");
					$start_time = Yii::app()->request->getParam("start_time"); //开始维修时间
					$hope_end_time = Yii::app()->request->getParam("hope_end_time"); // 预计完成期限

					$transaction = Yii::app()->db->beginTransaction(); //开启事务
					try{
								$model = QualityProject::model()->find("after_id='$after_id'");
								$model->id = Guid::create_guid();
								$model->name = $name;
								$model->phone = $phone;
								$model->subjection = $subjection;
								$model->project_cost = $project_cost*100;
								$model->real_option = $real_option;
								$model->option_infor = $option_infor;
								$model->mass_time = strtotime($mass_time);
								$model->mass_time1 = strtotime($mass_time1);
								$model->start_time = strtotime($start_time);
								$model->hope_end_time = strtotime($hope_end_time);
								if(!$model->save()) {
										$this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
								}
								$list = Seraftersales::model()->find("id='$after_id'");
								if($list) {
									$list->evolve_type = 3;
									if(!$list->save()) {
											$this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
									}
								}

									$transaction->commit();
					}catch(Exception $e) {
									$this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
									$transaction->rollback();
					}
						$this->redirect("/admin/repair");
				}
				//添加装修跟进
				public function actionCreateFollow() {
					$after_id = Yii::app()->request->getParam('after_id1');
					$project_type = Yii::app()->request->getParam('project_type');
					$project_infor = Yii::app()->request->getParam("project_infor1");
					$end_time = Yii::app()->request->getParam('end_time');
					$real_cost = Yii::app()->request->getParam('real_cost');
					$spread = Yii::app()->request->getParam('spread'); //预计花费差额
					$bear_type = Yii::app()->request->getParam('bear_type'); //费用承担方
					$spread_reason = Yii::app()->request->getParam('spread_reason'); //差额原因
					$reason = Yii::app()->request->getParam('reason'); //原因
					$transaction = Yii::app()->db->beginTransaction();
					try{
								$follow = new ProjectFollow();
								$follow->id = Guid::create_guid();
								$follow->criter_id = Yii::app()->session['admin_uid'];
								$follow->after_id = $after_id;
								$follow->project_infor = $project_infor;
								$follow->project_type = $project_type;
								if($project_type==2) {
										$list = Seraftersales::model()->find("id='$after_id'");
										$list->evolve_type =4;
										if(!$list->save()) {
												$this->OutputJson(0,json_encode($list->errors,JSON_UNESCAPED_UNICODE),null);
										}
								}
								if($end_time) {
									$follow->end_time = strtotime($end_time);
								}
								$follow->real_cost = $real_cost*100;
								$follow->spread = $spread*100;
								$follow->bear_type = $bear_type;
								$follow->spread_reason = $spread_reason;
								$follow->reason = $reason;
								$follow->ctime = time();
								if(!$follow->save()) {
											$this->OutputJson(0,json_encode($follow->errors,JSON_UNESCAPED_UNICODE),null);
								}

								$transaction->commit();
					}catch(Exception $e) {
								$this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
								$transaction->rollback();;
					}
							$this->redirect("/admin/repair");
				}
				//查看跟进
				public function actionLookFollow() {
					$id = Yii::app()->request->getParam('id'); //售后的ID
					$criteria = new CDbCriteria;
					$criteria->order = 't.ctime desc';
					$condition = "( after_id='$id')";
	 				$criteria->condition = $condition;
	 				$count = ProjectFollow::model()->count($criteria);
	 				$pager=new CPagination($count);
	 				$pager->pagesize = 10;
	 				$pager->applyLimit($criteria);
					$model = ProjectFollow::model()->findAll($criteria);
				  $this->render('follow',array(
						 		'id' => $id,
						 		'model' => $model,
								'pages' => $pager,
					 ));
				}
			}
