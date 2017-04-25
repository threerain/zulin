				<?php

				class SeraftersalesController extends BackgroundBaseController
				{

					// 售后主页面
					public function actionIndex(){
						$search =Yii::app()->request->getParam("search");
						$keyword_area = Yii::app()->request->getParam('keyword_area');//区域
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
						$keyword_hope_end_start = Yii::app()->request->getParam('keyword_hope_end_time');//与车主约定时间
						$keyword_hope_end_end = Yii::app()->request->getParam('keyword_hope_end_time1');//与车主约定时间
						$pagesize=10;
						/*
								根据车源查出车源的ID对应上合同
						 */
						//如果车源四个参数齐全查出固定的合同
						$proarr0=[];
						$proarr1=[];
						$proarr2=[];
						$proarr3=[];
						//商圈
						if($keyword_area){
								$areas=BaseArea::model()->findAll("name like '%".$keyword_area."%' and deleted=0");
								if($areas){
										$areas_id="";
										foreach ($areas as $key => $value) {
												if ($key==0){
														$areas_id.="'".$value->id."'";
												}
												else{
														$areas_id.=","."'".$value->id."'";
												}
										}
										$property=CmsProperty::model()->findAll("area_id in ($areas_id)");
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

						if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_room_number)){
								$res_arr = array_intersect($proarr0,$proarr1,$proarr2,$proarr3);
						}else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_building)){
								$res_arr = array_intersect($proarr0,$proarr1,$proarr2);
						}else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_room_number)){
								$res_arr = array_intersect($proarr0,$proarr1,$proarr3);
						}else if(!empty($keyword_area) && !empty($keyword_building) && !empty($keyword_room_number)){
								$res_arr = array_intersect($proarr0,$proarr2,$proarr3);
						}else if(!empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_room_number)){
								$res_arr = array_intersect($proarr1,$proarr2,$proarr3);
						}else if(!empty($keyword_area) && !empty($keyword_estates)){
								$res_arr = array_intersect($proarr0,$proarr1);
						}else if(!empty($keyword_area) && !empty($keyword_building)){
								$res_arr = array_intersect($proarr0,$proarr2);
						}else if(!empty($keyword_area) && !empty($keyword_room_number)){
								$res_arr = array_intersect($proarr0,$proarr3);
						}else if(!empty($keyword_estates) && !empty($keyword_building)){
								$res_arr = array_intersect($proarr1,$proarr2);
						}else if(!empty($keyword_estates) && !empty($keyword_room_number)){
								$res_arr = array_intersect($proarr1,$proarr3);
						}else if(!empty($keyword_building) && !empty($keyword_room_number)){
								$res_arr = array_intersect($proarr2,$proarr3);
						}else{
								$res_arr=array_merge($proarr0,$proarr1,$proarr2,$proarr3);
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


						$condition = "(1=1 and deleted=0 ";
						if($keyword_area || $keyword_estates || $keyword_building || $keyword_room_number){
								if($property_id){
										$condition.= " and property_id in ($property_id) ";
								}else{
										$condition.= " and  property_id in ('') ";
								}
						}

				  //制单人
					if($keyword_criter){
									$criter_id = AdminUser::model()->findAll("nickname like '%".$keyword_criter."%'");

						      $criter_id1 = '';

									if($criter_id!=null) {
										 		foreach($criter_id as $key => $value) {
														if($key==0) {
																$criter_id1.="'".$value->id."'";
														}
														 if($key!=0) {
																$criter_id1.=","."'".$value->id."'";
														}
												}
									}
									if($criter_id1!=null){
												$condition.= " and criter_id in ($criter_id1) ";
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

						$keyword_ctime_start=strtotime($keyword_ctime);
						$keyword_ctime_end=strtotime($keyword_ctime1)+24*3600;
				        if ($keyword_ctime) {
				            $condition.=" and ctime >= '$keyword_ctime_start' ";
				        }
				        if ($keyword_ctime1) {
				            $condition.=" and  ctime <= '$keyword_ctime_end' ";
				        }
						$keyword_hope_start=strtotime($keyword_hope_end_start);
						$keyword_hope_end=strtotime($keyword_hope_end_end);
								if ($keyword_hope_start) {
										$condition.=" and hope_end_time>= '$keyword_hope_start' ";
								}
								if ($keyword_hope_end) {
										$condition.=" and  hope_end_time<= '$keyword_hope_end' ";
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
								'keyword_area' => $keyword_area,
								'keyword_building' => $keyword_building,
								'keyword_estates'  => $keyword_estates,
								'keyword_room_number' => $keyword_room_number,
								'keyword_ctime' => $keyword_ctime,
								'keyword_ctime1' => $keyword_ctime1,
								'keyword_hope_end_time' => $keyword_hope_end_start,
								'keyword_hope_end_time1' => $keyword_hope_end_end,
								'keyword_criter' => $keyword_criter,
								'keyword_repair_type'=> $keyword_repair_type,
								'keyword_name' => $keyword_name,
								'keyword_urs_user' => $keyword_urs_user,
								'keyword_evolve_type' => $keyword_evolve_type,
								'search' => $search,
						));
					}
					// 新建保修单主页面
					public function actionNewOrder() {
							$referer = $_SERVER['HTTP_REFERER'];
						  $this->render('neworder',array(
										'referer' => $referer,
							));
					}
					//添加方法
					public function actionCreate(){
						 $referer = $_SERVER['HTTP_REFERER'];
						 $solve =  Yii::app()->request->getParam('solve'); //接受判别信息
						 $criter_id = Yii::app()->session['admin_uid']; //制单人
						 $repair_user_type = Yii::app()->request->getParam('repair_user_type');//报修人类型
						 $repair_type  = Yii::app()->request->getParam('repair_type'); //报修类型
						 $name = Yii::app()->request->getParam('name');//租户姓名
						 $department_id = Yii::app()->request->getParam('department_id'); //部门ID
						 $urs_user_id = Yii::app()->request->getParam('urs_user_id'); //公司内部员工ID
						//  var_dump($urs_user_id); die();
						 $phone = Yii::app()->request->getParam('phone'); //电话
						 $estate_id = Yii::app()->request->getParam('estate_id'); // 品牌ID
						 $building_id = Yii::app()->request->getParam('building_id'); //系列ID
						 $house_room = Yii::app()->request->getParam('room_number'); //车源ID
						 $hidden = Yii::app()->request->getParam('hidden'); //报修隐患
						 $hidden_infor = Yii::app()->request->getParam('hidden_infor'); //隐患详情
						 $repair_type = Yii::app()->request->getParam('repair_type');//报修类型
						 $bear_type = Yii::app()->request->getParam('bear_type'); //费用承担方
						 $service_type = Yii::app()->request->getParam('service_type');//维修方
						 $hidden_photo = Yii::app()->request->getParam('hidden_photo');//隐患图片

						 $model =  new SerAfterSales();
						 $guid =	Guid::create_guid();
						 $model->id = $guid;
						 $list = new SerHiddenPhoto();
						 $list->id =  Guid::create_guid();
						 $list->after_id = $guid;
						 $list->url = $hidden_photo;
						 //合同id
						 if(!$list->save()){
								 $this->OutputJson(0,json_encode($list->errors,JSON_UNESCAPED_UNICODE),null);
						 }
						 $contract = Property::SaleContractAll("$house_room");
		         if (empty($contract)){
		             $this->OutputJson(0,"合同不存在",null);
		         }
						//  $contract = Property::SaleContractAll("$house_room"); //查询出所有合同
						//  var_dump($contract);die();
						 $model->contract_id = $contract;
						//  var_dump($contract);die();
						 if($solve==0){
							 	$model->evolve_type  = 6;
						 }
						 if($solve==1){
							 	$model->evolve_type = 1;
						 }
						 if($solve==2){
							 	$model->evolve_type = 7;
						 }
						 $model->criter_id = $criter_id;
						 $model->repair_user_type = $repair_user_type;
						 $model->repair_type = $repair_type;
						 $model->name = $name;
						 $model->department_id = $department_id;
						 $model->urs_user_id = $urs_user_id;
						 if($bear_type) {
							 	$bear_type_id = '';
							 		foreach($bear_type as $key=>$value) {
													$bear_type_id .= $value.',';
									}
								$bear_type_id = rtrim($bear_type_id,',');
								$model->bear_type = $bear_type_id;
						 }

						 $model->service_type = $service_type;
						 $model->phone = $phone;
						 $model->property_id = $house_room;
						 $model->hidden = $hidden;
						 $model->hidden_infor = $hidden_infor;
						 $model->ctime = time();
						 if(!$model->save()){
							  if(Yii::app()->request->isAjaxRequest){
										$this->OutputJson(0,$model->errors,'');
								}
						 }
						 if(Yii::app()->request->isAjaxRequest){
							 			$this->OutputJson(301,'','/admin/Seraftersales');
						 }else{
							 			$this->redirect($referer);
						 }
					}
					//详情页
					public function actionDetails(){
							$id = Yii::app()->request->getParam('id');
							$model = SerAfterSales::model()->find("id='$id'");
							$this->render('details',array(
									'model' => $model,
									'id' => $id,
							));
					}
					//修改界面
					public function actionEdit(){
						$referer = $_SERVER['HTTP_REFERER'];
						$id = Yii::app()->request->getParam('id'); //隐患ID
						$contract_id = SerAfterSales::model()->find("id='$id'");
						$hope_end_time = '';
						if($contract_id->repair_type==1){
								$new_id = $contract_id->contract_id;
								$new_id = explode(',',$new_id);
								foreach($new_id as $key=>$val){
									$contract = SerPurContract::model()->find("contract_id='$val'");
									if($contract){
											$contract1 = $contract;
									}
								}
								if($contract1){
									$hope_end_time = $contract1->hope_end_time;
								}
						}else if($contract_id->repair_type==2){
									$new_id = $contract_id->contract_id;
									$new_id = explode(',',$new_id);
									foreach($new_id as $key=>$val){
										$contract = SerSellContract::model()->find("contract_id='$val'");
										if($contract){
												$contract1 = $contract;
										}
									}
									if($contract1){
										$hope_end_time = $contract1->hope_end_time;
									}
						}
						$model = SerAfterSales::model()->find("id='$id'");
						$invoice = SerHiddenPhoto::model()->find("after_id='$id'");
						$this->render('edit',array(
							  'model' => $model,
								'id'=> $id,
								'invoice'=> $invoice,
								'referer' => $referer,
								'hope_end_time'=> $hope_end_time,
						));
					}
					//修改方法
					public function actionEnterEdit(){
						$referer = Yii::app()->request->getParam('referer');
						$solve = Yii::app()->request->getParam('solve'); //客服已解决信号
						$id = Yii::app()->request->getParam("id"); //需修改信息的ID
						$repair_user_type = Yii::app()->request->getParam('repair_user_type');//报修人类型
						$repair_type  = Yii::app()->request->getParam('repair_type'); //报修类型
						$service_type = Yii::app()->request->getParam("service_type");//维修方
						$name = Yii::app()->request->getParam('name');//租户姓名
						$department_id = Yii::app()->request->getParam('department_id'); //部门ID
						$urs_user_id = Yii::app()->request->getParam('urs_user_id'); //公司内部员工ID
					 //  var_dump($urs_user_id); die();
						$phone = Yii::app()->request->getParam('phone'); //电话
						$estate_id = Yii::app()->request->getParam('estate_id'); // 品牌ID
						$building_id = Yii::app()->request->getParam('building_id'); //系列ID
						$house_room = Yii::app()->request->getParam('room_number'); //车源ID
						$hidden = Yii::app()->request->getParam('hidden'); //报修隐患
						$hidden_infor = Yii::app()->request->getParam('hidden_infor'); //隐患详情
						$repair_type = Yii::app()->request->getParam('repair_type');//报修类型
						$bear_type = Yii::app()->request->getParam('bear_type'); //费用承担方
						$repair_type = Yii::app()->request->getParam("repair_type");//维修方
						$hidden_photo = Yii::app()->request->getParam('hidden_photo'); //隐患照片
						$url = SerHiddenPhoto::model()->find("after_id='$id'");

						// var_dump($url); die();
						// var_dump($hidden_photo);die();
						if($url!=null){
							$url->url= $hidden_photo;
							if(!$url->save()){
										$this->OutputJson(0,$url->errors,'');
							}
						}

						$model =  SerAfterSales::model()->find("id='$id'");
						$hope_end_time = Yii::app()->request->getParam('hope_time');
						$real_end_time = strtotime(Yii::app()->request->getParam('end_time'));
						if($hope_end_time!=null) {
									$hope_end_time = strtotime($hope_end_time);
									$model->hope_end_time = $hope_end_time;
						}
						if($real_end_time!=null) {
									$real_end_time = strtotime($real_end_time);
						}
						// //修改收房列表里面的时间
						// if($model->repair_type==1){
						// 					$new_id = $model->contract_id;
						// 					$new_id = explode(',',$new_id);
						//
						// 					foreach($new_id as $key=>$val){
						// 						$contract1 = SerPurContract::model()->find("contract_id='$val'");
						// 						// var_dump($contract1);
						// 						if($contract1){
						// 								$contract4 = $contract1;
						// 						}
						// 					}
						// 					if($contract4){
						// 						$contract4->hope_end_time = $hope_end_time;
						// 					}
						// 					if(!$contract4->save()){
						// 						 if(Yii::app()->request->isAjaxRequest){
						// 								 $this->OutputJson(0,$contract1->errors,'');
						// 						 }
						// 					}
						// }else if($model->repair_type==2){
						//
						// 					$new_id = $model->contract_id;
						// 					$new_id = explode(',',$new_id);
						// 					foreach($new_id as $key=>$val){
						// 						$contract2 = SerSellContract::model()->find("contract_id='$val'");
						// 						if($contract2){
						// 								$contract3 = $contract2;
						// 						}
						// 					}
						// 					if($contract3){
						// 						$contract3->hope_end_time = $hope_end_time;
						// 						if(!$contract3->save()){
						// 							 if(Yii::app()->request->isAjaxRequest){
						// 									 $this->OutputJson(0,$contract2->errors,'');
						// 							 }
						// 						}
						// 					}
						//
						//
						// }
						if($solve==0){
								$model->evolve_type = 6;
						}

						$contract = Property::SaleContractAll("$house_room");

						if (empty($contract)){
								$this->OutputJson(0,"合同不存在",null);
						}
					 	$model->contract_id = $contract;
						if($real_end_time){
							$model->real_end_time = $real_end_time;
						}
						$model->repair_user_type = $repair_user_type;
						$model->name = $name;
						$model->department_id = $department_id;
						$model->urs_user_id = $urs_user_id;
						if($bear_type) {
							 $bear_type_id = '';
								 foreach($bear_type as $key=>$value) {
												 $bear_type_id .= $value.',';
								 }
							 $bear_type_id = rtrim($bear_type_id,',');
							 $model->bear_type = $bear_type_id;
						}
						// $model->repair_type = $repair_type;
						$model->service_type = $service_type;
						$model->phone = $phone;
						$model->property_id = $house_room;
						$model->hidden = $hidden;
						$model->hidden_infor = $hidden_infor;
						if(!$model->save()){
							 if(Yii::app()->request->isAjaxRequest){
									 $this->OutputJson(0,$model->errors,'');
							 }
						}

						if(Yii::app()->request->isAjaxRequest){
									 $this->OutputJson(301,'','/admin/seraftersales');
						}else{
									 $this->redirect($referer);
						}
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
											$this->OutputJson(301,'','/admin/seraftersales');
							}else{
										$this->redirect($referer);
							}
					}
				//部门搜索select
					public function actionAjaxlist(){
						$data=null;
						$criteria=new CDbCriteria;
						$keyword =Yii::app()->request->getParam("q");
						if ($keyword){
								$criteria->condition="1=1 and t.deleted=0 and t.name like '%$keyword%'";
						}
						else
						{
								$criteria->condition="1=1 and t.deleted=0";
						}

						//$criteria->order='t.ctime DESC';
						$count = AdminDepartment::model()->count($criteria);



						$pager=new CPagination($count);
						$pager->pageSize=10;//$pagesize;
						$pager->applyLimit($criteria);

						$list = AdminDepartment::model()->findAll($criteria);
						//$data["total"]=10;

						foreach ($list as $key => $user) {
								$_data["id"]=$user->id;
								$_data["title"]=$user->name;
								$_data["type"]=$user->parent_id;
								// $_data["room_number_rule"]=$user->room_number_rule;
								$data["movies"][]=$_data;
						}
						//$data["more"]=false;
						header('Content-Type:application/json;charset=utf-8');
						echo json_encode($data,JSON_UNESCAPED_UNICODE);

						die();
				 }
				 //幼狮人员ID

				 public function actionAjaxlistByID()
				 {
					 $data=null;
					 $criteria=new CDbCriteria;
					 $keyword =Yii::app()->request->getParam("q");
					 $department_id =Yii::app()->request->getParam("department_id");

					 if ($keyword){
							 $criteria->condition="1=1 and t.deleted=0 and t.nickname like '%$keyword%'";
					 }
					 $count = AdminUser::model()->count($criteria);
					 $pager=new CPagination($count);
					 $pager->pageSize=10;//$pagesize;
					 $pager->applyLimit($criteria);
					 $list =AdminUser::model()->findAll($criteria);
					 foreach ($list as $key => $user) {
									 $_data["id"]=$user->id;
									 $_data["title"]=$user->nickname;
									 $data["movies"][]=$_data;

					 }
					 header('Content-Type:application/json;charset=utf-8');
					 echo json_encode($data,JSON_UNESCAPED_UNICODE);
				 }
				 public function actionAjaxitem()
				 {
						 $id =Yii::app()->request->getParam("id");
						 $criteria=new CDbCriteria;
						 $item =AdminUser::model()->find("id='$id'");

						 $_data["id"]=$item->id;
						 $_data["title"]=$item->nickname;
						 $data=$_data;

						 header('Content-Type:application/json;charset=utf-8');
						 echo json_encode($data,JSON_UNESCAPED_UNICODE);

						 die();
				 }
				 //下载图片
				 public function actionDownLoad(){

						 $filename = Yii::app()->request->getParam('id');
						 if($filename != null){
								 $filename = Yii::app()->basePath.'/../'.$filename;
						 }
						 header("Content-type:text/html;charset=utf-8");

						 function download($file, $down_name){
							$suffix = substr($file,strrpos($file,'.')); //获取文件后缀
							$down_name = $down_name.$suffix; //新文件名，就是下载后的名字
							//判断给定的文件存在与否
							if(!file_exists($file)){
							 die("您要下载的文件已不存在，可能是被删除");
							}
							$fp = fopen($file,"r");

							$file_size = filesize($file);
							//下载文件需要用到的头
							header("Content-type: application/octet-stream");
							header("Accept-Ranges: bytes");
							header("Accept-Length:".$file_size);
							header("Content-Disposition: attachment; filename=".$down_name);
							$buffer = 1024;
							$file_count = 0;
							//向浏览器返回数据
							while(!feof($fp) && $file_count < $file_size){
							 $file_con = fread($fp,$buffer);
							 $file_count += $buffer;
							 echo $file_con;
							}
							fclose($fp);
						 }
						 download($filename, '售后图片');
				 }
				}
