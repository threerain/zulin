

<?php

class OutroomController extends BackgroundBaseController
{
	 public function actionIndex(){
		 	 $search = Yii::app()->request->getParam('search');
		 	 $keyword_id=Yii::app()->request->getParam("keyword_id");
			 $keyword_estates=Yii::app()->request->getParam("keyword_estates");
			 $keyword_building=Yii::app()->request->getParam("keyword_building");
			 $keyword_room_number=Yii::app()->request->getParam("keyword_room_number");
			 $keyword_area = Yii::app()->request->getParam("keyword_area");
			 $keyword_check_type=Yii::app()->request->getParam("keyword_check_type");
			 $keyword_start1 = Yii::app()->request->getParam("keyword_start1");
			 $keyword_start2 = Yii::app()->request->getParam("keyword_start2");
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
					 $areas=Basearea::model()->findAll("name like '%".$keyword_area."%' and deleted=0");
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
			 $contract_id="";
			 if($property_id){
					 $contract_id="";
					 $res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.")");
					 foreach($res as $key=>$value){
							 if ($key==0){
									 $contract_id.="'".$value->contract_id."'";
							 }
							 else{
									 $contract_id.=","."'".$value->contract_id."'";
							 }
					 }
			 }



			 //
			//  $search = $keyword_id.$keyword_estates.$keyword_building.$keyword_room_number.$keyword_check_type;
			// 如果搜索条件为空，则显示全部



			 $condition = '1=1';

			 $condition.=" and  (1=1 and deleted=0 and type='1'  ";

			 //查看自己需求的信息
				//李冰查看的信息
						$newout = CmsOutroom::model()->findAll();
						$id = Yii::app()->session['admin_uid'];
						$user = AdminUser::model()->find("id='$id'");
						if($newout!=null && $user->nickname=='李冰') {
									$lb_id ='';
									foreach($newout as $k=>$v) {
												if($v->check_type==1 ) {

																	$lb_id .= ","."'".$v->contract_id."'";

												}
									}
									if($lb_id!=null) {
										$lb_id = substr($lb_id,1);
										$condition .= " and id in ($lb_id) ";
									}else {
										$condition .= ' and 1=0';
									}

						}else if($newout!=null && $user->nickname=="牛腾飞") {                    //查询牛腾飞所查询的条件
										$n_id = '';
										foreach($newout as $k => $v) {
													if($v->check_type ==2) {

																		$n_id .= ","."'".$v->contract_id."'";
													}
										}
										if($n_id) {
											$n_id = substr($n_id,1);
											$t_id = [];
											$t_id = explode(",",$n_id);
												if($t_id!=null) {
													$f_id = '';
													$nf_id = '';
															foreach($t_id as $k=>$v) {
																					$f_id = CmsPurchaseProperty::model()->find("contract_id= $v ");
																					$nt_id = CmsProperty::model()->find("id='$f_id->property_id'");
																					if($nt_id->area_id=='201512301527450D819A7A04D08B198C3C59'|| $nt_id->area_id == '2015123015293947544FCE0AA217BCB1DD12' ) {
																								$nf_id .= ",".$v;
																					}

															}
															if($nf_id!=null) {
																$nf_id = substr($nf_id,1);
																$condition .= " and id in ($nf_id) ";

															}else {
																$condition .= ' and 1=0';
															}
												}
										}else {
													$condition .=' and 1=0 ';
										}

						}else if($newout!=null && $user->nickname=="何红梅") {                    //查询何红梅所查询的条件
										$n_id = '';
										foreach($newout as $k => $v) {
													if($v->check_type ==2) {

																		$n_id .= ","."'".$v->contract_id."'";
													}
										}
										if($n_id!=null) {
											$n_id = substr($n_id,1);
											$t_id = [];
											$t_id = explode(",",$n_id);
												if($t_id!=null) {
													$f_id = '';
													$nf_id = '';
															foreach($t_id as $k=>$v) {
																					$f_id = CmsPurchaseProperty::model()->find("contract_id= $v ");
																					$nt_id = CmsProperty::model()->find("id='$f_id->property_id'");
																					if($nt_id->area_id=='2015123015290704998CB33D3829637C2F43'|| $nt_id->area_id == '20151230154742667BC5F6E1F5982E75474C' || $nt_id->area_id=='20151230152949E99C7217FDD2004453130E') {
																								$nf_id .= ",".$v;
																					}

															}
															if($nf_id!=null) {
																$nf_id = substr($nf_id,1);
																$condition .= " and id in ($nf_id) ";

															}else {
																$condition .= ' and 1=0';
															}
														}
											}else {
														$condition .=' and 1=0 ';
											}

										}else	if($newout!=null && $user->nickname=='尹卓') {   //尹卓查看审批信息
																$lb_id ='';
																foreach($newout as $k=>$v) {
																			if($v->check_type==3 ) {

																								$lb_id .= ","."'".$v->contract_id."'";

																			}
																}
																if($lb_id!=null) {
																	$lb_id = substr($lb_id,1);
																	$condition .= " and id in ($lb_id) ";
																}else {
																	$condition .= ' and 1=0';
																}
											}else	if($newout!=null && $user->nickname=='黄鑫') {  //黄鑫查看信息
																	$lb_id ='';
																	foreach($newout as $k=>$v) {
																				if($v->check_type==6 ) {

																									$lb_id .= ","."'".$v->contract_id."'";

																				}
																	}
																	if($lb_id!=null) {
																		$lb_id = substr($lb_id,1);
																		$condition .= " and id in ($lb_id) ";
																	}else {
																		$condition .= ' and 1=0';
																	}
													}else	if($newout!=null && $user->nickname=='陈淑明') {  //陈淑明审批信息
																			$lb_id ='';
																			foreach($newout as $k=>$v) {
																						if($v->check_type==7 || $v->check_type == 10 ) {

																											$lb_id .= ","."'".$v->contract_id."'";

																						}
																			}
																			if($lb_id!=null) {
																				$lb_id = substr($lb_id,1);
																				$condition .= " and id in ($lb_id) ";
																			}else {
																				$condition .= ' and 1=0';
																			}
															}else	if($newout!=null && $user->nickname=='韩剑侠') {  //韩剑侠确认信息
																					$lb_id ='';
																					foreach($newout as $k=>$v) {
																								if($v->check_type==8 ) {

																													$lb_id .= ","."'".$v->contract_id."'";

																								}
																					}
																					if($lb_id!=null) {
																						$lb_id = substr($lb_id,1);
																						$condition .= " and id in ($lb_id) ";
																					}else {
																						$condition .= ' and 1=0';
																					}
																		}




			//  商圈
			if($keyword_area || $keyword_estates || $keyword_building || $keyword_room_number){
					if($contract_id){
							$condition.= " and id in ($contract_id) ";
					}else{
							$condition.= " and  id in ('') ";
					}
			}


	//合同ID搜索
	if ($keyword_id !=null){
			$condition.= " and id like ('%".$keyword_id."%') ";
	}




	//类型搜索
				if($keyword_check_type){
							$check_type_id = '';
							if($keyword_check_type==2 || $keyword_check_type==3 ) {

											$check = CmsOutroom::model()->findAll("check_type in (2,3) ");

							}else if($keyword_check_type == 9) {

								$check_over = CmsOutroom::model()->findAll("check_type in (1,2,3,4,5,6,7,8,10) ");
								$check_over_id = "";
								foreach($check_over as $k => $v) {
									if($k==0) {
												$check_over_id .= "'".$v->contract_id."'";
									}else  {
												$check_over_id .= ","."'".$v->contract_id."'";
									}
								}
							}else {

											$check = CmsOutroom::model()->findAll("check_type = '$keyword_check_type' ");

							}

							 if($check ) {

								 		foreach($check as $k => $v) {

												if($k==0) {
															$check_type_id .= "'".$v->contract_id."'";
												}else  {
															$check_type_id .= ","."'".$v->contract_id."'";
												}
										}

										if($check_type_id!=null) {
											$condition .= " and id in ($check_type_id)";
										}
							 }else {
								 	if($check_over_id !=null) {

										$condition .= " and id not in ($check_over_id)";
									}else {
										$condition .=" and 1=0";
									}
							 }
				}
	//申请时间
	//创建时间
	// $k_start=strtotime($keyword_start1);
	// $k_end=strtotime($keyword_start2)+24*3600;
	//
	// 		if ($keyword_start1) {
	// 				$condition.=" and ctime >= '$k_start' ";
	// 		}
	// 		if ($keyword_start2) {
	// 				$condition.=" and ctime <= '$k_end' ";
	// 		}

				        $condition.=")";
				$referer = $_SERVER['HTTP_REFERER'];
			 $criteria=new CDbCriteria;
			 // if($keyword){
			 //     $criteria->addCondition("t.room_number like '%$keyword%' ");
			 // }
			 // $criteria->addCondition("t.deleted=0  and type=1");
			 $criteria->condition=$condition;
			 $criteria->order="t.otime desc";
			 $count=CmsPurchaseContract::model()->count($criteria);
			 $pager=new CPagination($count);
			 $pager->pageSize=$pagesize;
			 $pager->applyLimit($criteria);

			 $list = CmsPurchaseContract::model()->findAll($criteria);
			 $this->render('index',array(
				 	 'list'=>$list,
					 'referer' => $referer,
					 'pages'=>$pager,
					 'keyword_start1' => $keyword_start1,
					 'keyword_start2' => $keyword_start2,
					 'keyword_id'=>$keyword_id,
					 'keyword_estates'=>$keyword_estates,
					 'keyword_check_type' => $keyword_check_type,
					 'keyword_building'=>$keyword_building,
					 'keyword_room_number'=>$keyword_room_number,
					 'search' => $search,

	));
	 }
	 //编辑页面
	 public function actionEdit(){
		 $referer = $_SERVER['HTTP_REFERER'];
		 $id = Yii::app()->request->getParam('id');
		 $estates = BaseEstate::model()->findAll(" id = '$id'");
		 $model = CmsPurchaseContract::model()->find("id='$id' ");
		 $list = CmsOutroom::model()->find("contract_id = '$id'");
		 $property = Property::allinfo($id);
		 $criteria = new CDbCriteria;
		 $criteria->addCondition("t.deleted=0 and contract_id='$id' and type=2 and the_order>1");
		 $criteria->order="t.the_order";

		 $this->render('edit',array(
			 				'id' => $id,
							'list2' => $list2,
							'referer' => $referer,
							'estates' => $estates,
							'model' => $model,
							'list' => $list,
							'property' => $property
		 ));
	 }
	//  //确定出车佣金
	//  public function actionEditSave(){
	 //
	// 		 		$id = Yii::app()->request->getParam('contract_id');
	// 				$outroom_id = Yii::app()->request->getParam('outroom_id');
	// 				$referer = Yii::app()->request->getParam('referer');
	// 				$remark = Yii::app()->request->getParam('remark');
	// 				$invoice = Yii::app()->request->getParam('invoice');
	// 				$newid = Yii::app()->request->getParam('newid');
	// 				$invoice_type = Yii::app()->request->getParam('invoice');
	// 				$remark = Yii::app()->request->getParam('remark');
	// 				$commission_user = Yii::app()->request->getParam('commission_user');
	// 				$commission_bank = Yii::app()->request->getParam('commission_bank');
	// 				$commission_num = Yii::app()->request->getParam('commission_num');
	// 				$amount_money = Yii::app()->request->getParam('amount_money');
	 //
	// 				// $commission = Yii::app()->request->getParam('commission');
	// 				// $operator_id = Yii::app()->session['admin_uid'];
	// 				$model = CmsOutroom::model()->find("contract_id='$id'");
	 //
	// 				if($newid){
	// 						$model->contract_id = $newid;
  //   			}
	// 				// $model->invoice_type = $invoice;
	// 				$model->remark = $remark;
	// 				$model->commission_user = $commission_user;
	// 				$model->commission_bank = $commission_bank;
	// 				$model->commission_num = $commission_num;
	// 				$model->amount_money = $amount_money*100;
	// 				$model->check_type = 1;
	// 				// $model->commission = $commission;
	// 				// $model->operator_id = $operator_id;
	// 				if(!$model->save()){
	// 							if(Yii::app()->request->isAjaxRequest){
	// 											$this->OutputJson(0,$model->errors,null);
	// 							}
	// 				}
	// 				if(Yii::app()->request->isAjaxRequest){
	// 										$this->OutputJson(301,'','/admin/outroom');
	// 				}else{
	// 					          $this->redirect($referer);
	// 				}
	 //
	//  }
	 //一审界面
	 public function actionEnter(){

			 		$id = Yii::app()->request->getParam('id');
					$referer = $_SERVER['HTTP_REFERER'];
					$estates = BaseEstate::model()->findAll(" t.id = '$id'");
		 		 	$model = CmsPurchaseContract::model()->find("t.id='$id'");
					$pay = CmsPurchasePayRule::model()->find("contract_id='$id'");
		 		 	$list = CmsOutroom::model()->find("contract_id = '$id'");
		 		 	$property = Property::allinfo($id);

					$this->render('enter',array(
								'id' => $id,
							 'referer' => $referer,
							 'estates' => $estates,
							 'pay'=>$pay,
							 'model' => $model,
							 'list' => $list,
							 'property' => $property
					));
	 }
	 //二审界面
	 public function actionEnterMore(){

					$id = Yii::app()->request->getParam('id');
					$referer = $_SERVER['HTTP_REFERER'];
					$estates = BaseEstate::model()->findAll(" t.id = '$id'");
					$model = CmsPurchaseContract::model()->find("t.id='$id'");
					$pay = CmsPurchasePayRule::model()->find("contract_id='$id'");
					$list = CmsOutroom::model()->find("contract_id = '$id'");
					$property = Property::allinfo($id);

					$this->render('entermore',array(
								'id' => $id,
							 'referer' => $referer,
							 'estates' => $estates,
							 'pay'=>$pay,
							 'model' => $model,
							 'list' => $list,
							 'property' => $property
					));
	 }
	 //全部审核

	 public function actionPass(){

		 			$id = Yii::app()->request->getParam('id');//合同ID
					$referer = Yii::app()->request->getParam('referer');
					$model = CmsOutroom::model()->find("contract_id='$id'");

					if(!$model){
							$model = new CmsOutroom();
							$model->contract_id = $id;
							$model->id = Guid::create_guid();
							$model->check_type = 1;
					}else{
						if($model->check_type == 6) {
								$model->check_type = 7;
								$model->money_one_type = Yii::app()->session['admin_uid'];
						}else if($model->check_type == 7) {
								$model->check_type = 8;
								$model->money_two_type = Yii::app()->session['admin_uid'];
						}else if($model->check_type == 8) {
								$model->check_type == 10;
								$model->money_center = Yii::app()->session['admin_uid'];
						}
						if($model->check_type == 5) {
								$model->check_type == 1;
						}
						if($model->check_type == 1 ){
								$model->check_type = 2;
								$model->check_one = Yii::app()->session['admin_uid'];
						}else if($model->check_type == 2) {
								$model->check_type = 3;
								$model->check_two = Yii::app()->session['admin_uid'];
						}else if($model->check_type == 3) {
								$model->check_type = 6;
								$model->check_three = Yii::app()->session['admin_uid'];
						}

						if(!$model->check_type){
								$model->check_type = 2;
						}

					}


					if(!$model->save()){
								if(Yii::app()->request->isAjaxRequest){
											$this->OutputJson(0,$model->errors,null);
								}
					}
					if(Yii::app()->request->isAjaxRequest){
										$this->OutputJson(301,'','/admin/outroom');
					}else{
										$this->redirect('index');
					}

										$this->redirect($referer);
	 }

		// 	财务打款，终结此操作
			public function actionOver() {

				$referer = Yii::app()->request->getParam('referer');
				$id = Yii::app()->request->getParam("id");
				$model = CmsOutroom::model()->find("contract_id='$id'");
				$model->check_type = 10;
				if(!$model->save()) {
					if(Yii::app()->request->isAjaxRequest){
								$this->OutputJson(0,$model->errors,null);
					}
				}
					$this->redirect($referer);
			}
	 //二审通过
	 public function actionMorePass(){

					$id = Yii::app()->request->getParam('id');
					$referer = Yii::app()->request->getParam('referer');
					$commission = Yii::app()->request->getParam("commission");
					$model = CmsOutroom::model()->find("contract_id='$id'");

					$model->check_type = 3;
					if($commission){
							$model->commission = $commission*100;
					}
							$model->check_two = Yii::app()->session['admin_uid'];

					if(!$model->save()){
								if(Yii::app()->request->isAjaxRequest){
											$this->OutputJson(0,$model->errors,null);
								}
					}
					if(Yii::app()->request->isAjaxRequest){
										$this->OutputJson(301,'','/admin/outroom');
					}else{
										$this->redirect($referer);
					}

										$this->redirect($referer);
	 }
	 //详情页
	 public function actionDetails(){
		 $referer  = $_SERVER['HTTP_REFERER'];
		 $id = Yii::app()->request->getParam('id');
		 $a = Yii::app()->request->getParam('a');
		 $estates = BaseEstate::model()->findAll(" t.id = '$id'");
		 $model = CmsPurchaseContract::model()->find("t.id='$id'");
		 $list = CmsOutroom::model()->find("contract_id = '$id'");
		 $property = Property::allinfo($id);

		 		 $this->render('details',array(
							'id' => $id,
							'a' => $a,
							'estates' => $estates,
							'referer' => $referer,
							'model' => $model,
							'list' => $list,
							'property' => $property
		 ));

	 }
	 //审核不通过
	public function actionNoPass(){
	  	$id = Yii::app()->request->getParam('id');

			$referer = Yii::app()->request->getParam('referer');
			$reason = Yii::app()->request->getParam('reason');
			$model = CmsOutroom::model()->find("contract_id='$id'");
			if(!$model){
						$model = new CmsOutroom();
						$model->id =  Guid::create_guid();
			}
			$model->reason = $reason;
			$model->contract_id = $id;
			$model->check_type = 5;

			if(!$model->save()){
					if(Yii::app()->request->isAjaxRequest){
									$this->OutputJson(0,$model->errors,null);
					}
			}
			if(Yii::app()->request->isAjaxRequest){
								 $this->OutputJson(301,'','/admin/outroom');
			}else{
								 $this->redirect($referer);
			}
			    			 $this->redirect($referer);
	}
	//新增佣金单
	public function actionCreate(){
			// $referer = $_SERVER['HTTP_REFERER'];
			$referer = Yii::app()->request->getParam('referer');
			$id = Yii::app()->request->getParam('id'); //合同ID
      $invoice = Yii::app()->request->getParam("invoice");//是否提交发票
			// $contract = Yii::app()->request->getParam("contract_id");
			$operator_id = Yii::app()->request->getParam("operator_id"); //申请人ID
			$director_id = Yii::app()->request->getParam("director_id"); //申请部门总监ID
			$remark = Yii::app()->request->getParam('remark'); //备注
			$commission_user = Yii::app()->request->getParam('commission_user'); //返佣用户
			$commission_bank = Yii::app()->request->getParam('commission_bank'); //返佣银行
			$commission_num = Yii::app()->request->getParam('commission_num');  //返佣账号
			$amount_money = Yii::app()->request->getParam('amount_money');   //实际返佣金额
			$pay_type = Yii::app()->request->getParam('pay_type'); //支付方式



	  // $model = CmsPurchaseContract::model()->find("id='$id'");
		//判断佣金单是否存在
		$list = CmsOutroom::model()->find("contract_id='$id'");
		if($list==null){
				$list = new CmsOutroom();
				$list->id = Guid::create_guid();
				$list->contract_id = $id;
        $list->ctime = time();
				$list->invoice_type = $invoice;
				$list->remark = $remark;
				$list->commission_user = $commission_user;
				$list->commission_bank = $commission_bank;
				$list->commission_num  = $commission_num;
				$list->amount_money = $amount_money*100;
				$list->proposer_id = Yii::app()->session['admin_uid'];//制单人
				$list->operator_id = $operator_id;
				$list->director_id = $director_id;
				$list->check_type = 1;
				$list->pay_type = $pay_type;
				$purchase = CmsPurchaseContract::model()->find("id='$id'");
				$purchase->otime = time();
				if (!$purchase->save()){
						if(Yii::app()->request->isAjaxRequest){

								$this->OutputJson(0,$purchase->errors,null);
						}

				}

				if(!$list->save()){
							if(Yii::app()->request->isAjaxRequest){
											$this->OutputJson(0,$list->errors,null);
							}
						}
				}else {
					$list->contract_id = $id;
					$list->ctime = time();
					$list->invoice_type = $invoice;
					$list->remark = $remark;
					$list->commission_user = $commission_user;
					$list->commission_bank = $commission_bank;
					$list->commission_num  = $commission_num;
					$list->amount_money = $amount_money*100;
					$list->proposer_id = Yii::app()->session['admin_uid'];//制单人
					$list->operator_id = $operator_id;
					$list->director_id = $director_id;
					$list->check_type = 1;
					$list->pay_type = $pay_type;
					$purchase = CmsPurchaseContract::model()->find("id='$id'");
					$purchase->otime = time();

					if(!$list->save()){
								if(Yii::app()->request->isAjaxRequest){
												$this->OutputJson(0,$list->errors,null);
								}
							}
				}
				$this->redirect("/admin/outroom");
}
	//返佣金
	public function actionSureDetails(){
		$referer = $_SERVER["HTTP_REFERER"];
		$id = Yii::app()->request->getParam('id');
		$estates = BaseEstate::model()->findAll(" t.id = '$id'");
		$model = CmsPurchaseContract::model()->find("t.id='$id'");
		$list = CmsOutroom::model()->find("contract_id = '$id'");
		$property = Property::allinfo($id);

				$this->render('suredetails',array(
						 'id' => $id,
						 'estates' => $estates,
						 'model' => $model,
						 'list' => $list,
						 'property' => $property,
						 'referer' => $referer
		));

	}
	//确认返佣金
	public function actionEnterCommission(){
		$referer = Yii::app()->request->getParam('referer');
    $id = Yii::app()->request->getParam('id');
		$model = CmsOutroom::model()->find("contract_id='$id'");
		$model->check_type = 6;

				if(!$model->save()){
							if(Yii::app()->request->isAjaxRequest){
											$this->OutputJson(0,$model->errors,null);
							}
				}
				if(Yii::app()->request->isAjaxRequest){
										$this->OutputJson(301,'',"/admin/outroom");
				}else{
										$this->redirect($referer);
				}
										$this->redirect($referer);
	}
	//得到车源
		public function actionGetPurchase(){
			$resource = '';
			$data=[];
			$room_id = Yii::app()->request->getParam("id");
			// $contract = CmsPurchaseProperty::model()->findAll("property_id='$room_id'");
			$resource = Property::OutSaleContract($room_id);
			if($room_id){
			 	$date = CmsProperty::model()->find("id='$room_id'");
				if($date){
					$item = BaseEstate::model()->find("id='$date->estate_id'");
					$building = BaseBuilding::model()->find("id='$date->building_id'");
					$data['estate'] = $item->name;
					$data['building'] = $building->name;
				}
			}
			// foreach($contract as $key=>$value){
			// 		$resource = CmsPurchaseContract::model()->find("id='$value->contract_id' and type=1");
			// }


			if($resource !=''){
					// $resource = CmsPurchaseContract::model()->find("id='$contract->contract_id'");
					$res=CmsPurchaseProperty::model()->findAll("contract_id='$resource->id'");
					if($res){
						foreach ($res as $key => $value) {
							$house=CmsProperty::model()->find("id='$value->property_id'");
							$data[0][$key] = $house->house_no;
						}
					}
					$channel = CmsChannel::model()->find("id='$resource->channel_id'");
					if($channel){
							$data['channel'] = $channel->name;
					}else{
						  $data['channel'] = '';
					}
					$channel_manager = CmsChannelManager::model()->find("id='$resource->channel_manager_id'");
					if($channel_manager){
						$data['manager'] = $channel_manager->name;
					}else{
						$data['manager'] = '';
					}
					$pay = CmsPurchasePayRule::model()->find("contract_id='$resource->id'");
					if($pay){
						$data['rent'] = $pay->monthly_rent/100;
					}else{
							$data['rent'] = '';
					}
					if($resource){
						$commission = CmsOutroom::model()->find("contract_id='$resource->id'");
						if($commission){
							$data['commission_user'] = $commission->commission_user;
							$data['commission_bank'] = $commission->commission_bank;
							$data['commission_num']  = $commission->commission_num;
							$data['amount_money']    = $commission->amount_money;
						}else{
							$data['commission_user'] = '';
							$data['commission_bank'] = '';
							$data['commission_num']  = '';
							$data['amount_money']    = '';
						}
						if($commission){
								$data['commission'] = $commission->commission/100;
						}else{
							$data['commission'] = $resource->commission/100;
						}
					}else{
						$data['commission'] = '';
					}
			}
			if($resource !=null){
						$data['contract'] = $resource->id?$resource->id:'';
			}else{
				    $data['contract'] = '';
			}
			if($resource !=null){
				$sure = CmsOutroom::model()->find("contract_id='$resource->id'");
				if($sure){
						$data['contract'] = '1';
				}

			}

			header('Content-Type:application/json;charset=utf-8');
			echo json_encode($data,JSON_UNESCAPED_UNICODE);

			die();
		}
		//提交返佣支出单
		public function actionSureCommission(){
			$referer = $_SERVER['HTTP_REFERER'];
			$data['referer'] = $referer;
			$commission_id = Yii::app()->request->getParam("id");
			$contract = CmsPurchaseProperty::model()->find("contract_id='$commission_id'");
			if($contract){
					$resource = CmsPurchaseContract::model()->find("id='$commission_id' ");
					$property = CmsProperty::model()->find("id='$contract->property_id'");
					if($property){
						$estates = BaseEstate::model()->find("id='$property->estate_id'");
						$building = BaseBuilding::model()->find("id='$property->building_id'");
						$data['house_no'] = $property->house_no;
						if($estates){
									$data['estate'] = $estates->name;
						}
						if($building){
									$data['building'] = $building->name;
						}
					}

					$channel = CmsChannel::model()->find("id='$resource->channel_id'");
					if($channel){
							$data['channel'] = $channel->name;
					}else{
							$data['channel'] = '';
					}
					$channel_manager = CmsChannelManager::model()->find("id='$resource->channel_manager_id'");
					if($channel_manager){
						$data['manager'] = $channel_manager->name;
					}else{
						$data['manager'] = '';
					}
					$pay = CmsPurchasePayRule::model()->find("contract_id='$resource->id'");
					if($pay){
						$data['rent'] = $pay->monthly_rent/100;
					}else{
							$data['rent'] = '';
					}
					$reall = CmsOutroom::model()->find("contract_id='$resource->id'");
					if($reall){
							$data['reall'] = $reall->commission/100;
							$data['type'] = $reall->invoice_type;
					}else{
						  $data['reall'] = '';
					}
					if($resource){

								$data['commission'] = $resource->commission/100;
						}else{
								$data['commission'] = '';
						}

			}
			if($contract){
				$data['contract'] = $resource->id;
			}else{
				$data['contract'] = '';
			}

			header('Content-Type:application/json;charset=utf-8');
			echo json_encode($data,JSON_UNESCAPED_UNICODE);

			die();
				}
		//接受返佣金支出单信息
		public function actionSubmitCommission(){
			$referer = Yii::app()->request->getParam('referer');
			$avatar = Yii::app()->request->getParam('avatar');
			$contract_id = Yii::app()->request->getParam('contract');
			$commission = Yii::app()->request->getParam("real_commission");
			$model = CmsOutroom::model()->find("contract_id='$contract_id'");
			if($model){
					$model->commission = $commission*100;
					$model->check_type = 5;
					if($avatar !=''){
						$model->avatar = $avatar;
					}
					$model->proposer_id = Yii::app()->session['admin_uid'];
			}
			if(!$model->save()){
						if(Yii::app()->request->isAjaxRequest){
										$this->OutputJson(0,$model->errors,null);
						}
			}
			if(Yii::app()->request->isAjaxRequest){
									$this->OutputJson(301,'',"/admin/outroom");
			}else{
									$this->redirect($referer);
			}
									$this->redirect($referer);
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
				download($filename, '发票图片');
		}
		public function actionAjaxlist()
{
		$data=null;
		$criteria=new CDbCriteria;
		$keyword =Yii::app()->request->getParam("q");
		if ($keyword){
				$criteria->condition="1=1 and t.deleted=0 and t.nickname like '%$keyword%'";
		}

		// else
		// {
		//     $criteria->condition="1=1 and t.deleted=0";
		// }

		//$criteria->order='t.ctime DESC';
		$count = AdminUser::model()->count($criteria);

		// var_dump($criteria);
		// die();

		$pager=new CPagination($count);
		$pager->pageSize=10;//$pagesize;
		$pager->applyLimit($criteria);

		$list =AdminUser::model()->findAll($criteria);
		//$data["total"]=10;

		foreach ($list as $key => $user) {
				$_data["id"]=$user->id;
				$_data["title"]=$user->nickname;
				// $_data['name'] = $user->department_id;
				$area_name1 = AdminDepartment::model()->find("id='$user->department_id'");
				$area_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");
				$_data['one'] = $area_name1->name;
				$_data['two'] = $area_name->name;
				$data["movies"][]=$_data;
		}
		//$data["more"]=false;
		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($data,JSON_UNESCAPED_UNICODE);

		die();


	}


			/**
			*数字金额转换成中文大写金额的函数
			*String Int $num 要转换的小写数字或小写字符串
			*return 大写字母
			*小数位为两位
			**/
			function num_to_rmb($num){
			$c1 = "零壹贰叁肆伍陆柒捌玖";
			$c2 = "分角元拾佰仟万拾佰仟亿";
			//精确到分后面就不要了，所以只留两个小数位
			$num = round($num, 2);
			//将数字转化为整数
			$num = $num * 100;
			if (strlen($num) > 10) {
			    return "金额太大，请检查";
			}
			$i = 0;
			$c = "";
			while (1) {
			    if ($i == 0) {
			        //获取最后一位数字
			        $n = substr($num, strlen($num)-1, 1);
			    } else {
			        $n = $num % 10;
			    }
			    //每次将最后一位数字转化为中文
			    $p1 = substr($c1, 3 * $n, 3);
			    $p2 = substr($c2, 3 * $i, 3);
			    if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
			        $c = $p1 . $p2 . $c;
			    } else {
			        $c = $p1 . $c;
			    }
			    $i = $i + 1;
			    //去掉数字最后一位了
			    $num = $num / 10;
			    $num = (int)$num;
			    //结束循环
			    if ($num == 0) {
			        break;
			    }
			}
			$j = 0;
			$slen = strlen($c);
			while ($j < $slen) {
			    //utf8一个汉字相当3个字符
			    $m = substr($c, $j, 6);
			    //处理数字中很多0的情况,每次循环去掉一个汉字“零”
			    if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
			        $left = substr($c, 0, $j);
			        $right = substr($c, $j + 3);
			        $c = $left . $right;
			        $j = $j-3;
			        $slen = $slen-3;
			    }
			    $j = $j + 3;
			}
			//这个是为了去掉类似23.0中最后一个“零”字
			if (substr($c, strlen($c)-3, 3) == '零') {
			    $c = substr($c, 0, strlen($c)-3);
			}
			//将处理的汉字加上“整”
			if (empty($c)) {
			    return "零元整";
			}else{
			    return $c . "整";
			}
			}

			  //打支出单
			public function actionZhiChu() {

			  $file_name = '财务支出凭单'.date('Y-m-d',time());
			  $id = Yii::app()->request->getParam("id"); //合同ID
			  $contract_id = Yii::app()->request->getParam("contract_id"); //合同ID
			  header('Content-Type: text/xls');
			  header("Content-type:application/vnd.ms-excel;charset=utf-8");
			  $str = mb_convert_encoding($file_name, 'gbk', 'utf-8');
			  header('Content-Disposition: attachment;filename="' . $str . '.xls"');
			  header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
			  header('Expires:0');
			  header('Pragma:public');

			  $list = CmsOutroom::model()->find("id='$id'");//出车和同的报修单
			  $user = AdminUser::model()->find("id='$list->operator_id'");
			  $area_name1 = AdminDepartment::model()->find("id='$user->department_id'");
			  $area_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");
			  $pay = CmsPurchasePayRule::model()->find("contract_id='$contract_id' order by the_order");
			  $res = CmsPurchaseProperty::model()->find("contract_id='$contract_id'");
			  $res1 = CmsPurchaseProperty::model()->findAll("contract_id='$contract_id'");
			  if($res){
			    $data = CmsProperty::model()->find("id='$res->property_id'");
			    if($data){
			      $item = BaseEstate::model()->find("id='$data->estate_id'");  //品牌
			      $item2 = BaseBuilding::model()->find("id='$data->building_id'");	//系列
			    }
			    $item_id = '';
			    foreach ($res1 as $key => $value) {
			      $item3 = CmsProperty::model()->find("id='$value->property_id'");
			      $item_id .= $item3->house_no.' ';    //编号
			      }
			   }
			   $real_commission = $list->amount_money/100;
			   $real_commission1 = $this->num_to_rmb($real_commission);
			   $b = $list->pay_type;  //支付类型
			   if(1==$b){
			     $c = '√';
			   }
			   if(2==$b){
			     $d = '√';
			   }
			   if(3==$b){
			     $f = '√';
			   }
			   $check_three = AdminUser::model()->find("id='$list->check_three'");
			   $g =	$check_three->nickname;  //公司领导
				 $check_two = AdminUser::model()->find("id='$list->check_two'");
			   $t =	$check_two->nickname;  //审批人
			   $money_two = AdminUser::model()->find("id='$list->money_two_type'");
			   $h =	$money_two->nickname;  //财务主管
			   $money_one = AdminUser::model()->find("id='$list->money_one_type'");
			   $i =	$money_one->nickname;  //会计

			   preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/',$list->commission_num,$match);
			   unset($match[0]);
			   $m = implode(' ', $match);
				 $gs = "月租金".$pay->monthly_rent/100;
				 $gs .= "*";
				 $gs .= 12;
				 $gs .="*";
				 $gs .=0.8;
				 $gs .= "=";
				 $gs .= number_format($pay->monthly_rent/100*0.96,2);
			        $table_data.= '<table width="744"  border="1">
			                                <caption><h2>出 房 佣 金 支 出 凭 单</h2><br><p style="text-align:left;padding:0;margin:0;">No:'.$list->id.'+.</p></caption>
			                                <tbody>
			                                  <tr >
			                                    <td height="40"  colspan="2"><b>申请部门：</b>'.$area_name->name." ".$area_name1->name.'</td>
			                                    <td height="40"	width="230"><b>申请人：</b>'.$user->nickname.'</td>
			                                    <td height="40" width="230"><div align="left">'.date("Y年m月d日",$list->ctime).'</div></td>
			                                  </tr>
			                                  <tr>
			                                    <td width="255" height="89"><div align="center"><b>摘 要</b></div></td>
			                                    <td colspan="3"><div align="left"><b>佣 金</b>:'.number_format($pay->monthly_rent/100*0.96,2).'元<b><br>项 目:</b>'.$item->name." ".$item2->name." ".$item_id.'<br><b>公 式:</b>'.$gs.'<br><b>备 注:</b>'.$list->remark.'</div></td>
			                                  </tr>
			                                  <tr >
			                                    <td height="40" height="25"><div align="center"><b>金 额</b></div></td>
			                                    <td height="40" colspan="3"><div align="center">'.$real_commission1.'&nbsp;&nbsp;￥<u>'.number_format($real_commission,2).'元</u></div></td>
			                                  </tr>
			                                  <tr >
			                                    <td height="40" height="30"><div align="center"><b>收款人/单位名称</b></div></td>
			                                    <td height="40" colspan="3"><div align="center">'.$list->commission_user.'</div></td>
			                                  </tr>
			                                  <tr>
			                                    <td height="40"><div align="center"><b>开户银行</b></div></td>
			                                    <td height="40" colspan="3"><div align="center">'.$list->commission_bank.'</div></td>
			                                  </tr>
			                                  <tr>
			                                    <td height="40"><div align="center"><b>银行账号</b></div></td>
			                                    <td height="40" colspan="3"><div align="center">'.$m.'</div></td>
			                                  </tr>
			                                  <tr>
			                                    <td height="40" colspan="2"><div  align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;附单据&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;张&nbsp;&nbsp;</b></div></td>
			                                    <td height="40" colspan="2">现金支付（'.$c.'）&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行汇款（'.$d.'）&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;转账支票（'.$f.'）</td>
			                                  </tr>

			                                </tbody>
			                              </table>
			                              <div align="left"><b>公司领导：</b>'.$g.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>财务主管：</b>'.$h.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>会计：</b>'.$i.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>审批人：</b>'.$t.'</div>
			                                         ';
			                                  echo $table_data;
			                                  die();
			  }

				//批量打印功能
				public function actionNewOutroom()
				{
					header("Content-type: text/html; charset=utf-8");
					$id = Yii::app()->request->getParam('id');


					             if($id) {
					                  foreach($id as $k=>$v) {
					                      $list = CmsOutroom::model()->find("contract_id= '$v'");
																$user = AdminUser::model()->find("id='$list->operator_id'");
																$area_name1 = AdminDepartment::model()->find("id='$user->department_id'");
																$area_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");
																$pay = CmsPurchasePayRule::model()->find("contract_id='$v' order by the_order");
																$res = CmsPurchaseProperty::model()->find("contract_id='$v'");
																$res1 = CmsPurchaseProperty::model()->findAll("contract_id='$v'");
																if($res){
																	$data = CmsProperty::model()->find("id='$res->property_id'");
																	if($data){
																		$item = BaseEstate::model()->find("id='$data->estate_id'");  //品牌
																		$item2 = BaseBuilding::model()->find("id='$data->building_id'");	//系列
																	}
																	$item_id = '';
																	foreach ($res1 as $key => $value) {
																		$item3 = CmsProperty::model()->find("id='$value->property_id'");
																		$item_id .= $item3->house_no.' ';    //编号
																		}
																 }
																 $real_commission = $list->amount_money/100;
																 $real_commission1 = $this->num_to_rmb($real_commission);
																 $b = $list->pay_type;  //支付类型
																 $c = '';
					                       $d = '';
					                       $f = '';
					                  	   if($b==1){
					                  	     $c = '√';
					                  	   }else if($b==2){
					                  	     $d = '√';
					                  	   }else if($b==3){
					                  	     $f = '√';
					                  	   }
																 $check_three = AdminUser::model()->find("id='$list->check_three'");
																 $g =	$check_three->nickname;  //公司领导
																 $check_two = AdminUser::model()->find("id='$list->check_two'");
																 $t =	$check_two->nickname;  //审批人
																 $money_two = AdminUser::model()->find("id='$list->money_two_type'");
																 $h =	$money_two->nickname;  //财务主管
																 $money_one = AdminUser::model()->find("id='$list->money_one_type'");
																 $i =	$money_one->nickname;  //会计

																 preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/',$list->commission_num,$match);
																 unset($match[0]);
																 $m = implode(' ', $match);
																 $gs = "月租金".$pay->monthly_rent/100;
																 $gs .= "*";
																 $gs .= 12;
																 $gs .="*";
																 $gs .=0.8;
																 $gs .= "=";
																 $gs .= number_format($pay->monthly_rent/100*0.96,2);
					                       if($list!=null) {

					                       $table .=   '<style>
																								 	.printbottom{margin-bottom:280px;}
																								 	.printbottom:last-child{margin-bottom:0px;}
																 							</style><table width="850"  border="1" style="border-collapse:collapse!important">
					                                                 <caption><h2>出 房 佣 金 支 出 凭 单</h2><p style="text-align:left;padding:0;margin:0;">No:'.$list->id.'</p></caption>
					                                                 <tbody>
					                                                   <tr >
					                                                     <td height="40" width="300"  colspan="2"><b>申请部门：</b>'.$area_name->name." ".$area_name1->name.'</td>
					                                                     <td height="40"	width="230"><b>申请人：</b>'.$user->nickname.'</td>
					                                                     <td height="40" width="230"><div align="left">'.date("Y年m月d日",$list->ctime).'</div></td>
					                                                   </tr>
					                                                   <tr>
					                                                     <td width="255" height="89"><div align="center"><b>摘 要</b></div></td>
					                                                     <td colspan="3"><div align="left"><b>佣 金</b>:'.number_format($pay->monthly_rent/100*0.96,2).'元<b><br>项 目:</b>'.$item->name." ".$item2->name." ".$item_id.'<br><b>公 式:</b>'.$gs.'<br><b>备 注:</b>'.$list->remark.'</div></td>
					                                                   </tr>
					                                                   <tr >
					                                                     <td height="40" height="25"><div align="center"><b>金 额</b></div></td>
					                                                     <td height="40" colspan="3"><div align="center">'.$real_commission1.'&nbsp;&nbsp;￥<u style="text-decoration:none;border-bottom:1px solid #555;padding-bottom:2px;">'.number_format($real_commission,2).'元</u></div></td>
					                                                   </tr>
					                                                   <tr >
					                                                     <td height="40" height="30"><div align="center"><b>收款人/单位名称</b></div></td>
					                                                     <td height="40" colspan="3"><div align="center">'.$list->commission_user.'</div></td>
					                                                   </tr>
					                                                   <tr>
					                                                     <td height="40"><div align="center"><b>开户银行</b></div></td>
					                                                     <td height="40" colspan="3"><div align="center">'.$list->commission_bank.'</div></td>
					                                                   </tr>
					                                                   <tr>
					                                                     <td height="40"><div align="center"><b>银行账号</b></div></td>
					                                                     <td height="40" colspan="3"><div align="center">'.$m.'</div></td>
					                                                   </tr>
					                                                   <tr>
					                                                     <td height="40" colspan="2"><div  align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;附单据&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;张&nbsp;&nbsp;</b></div></td>
					                                                     <td height="40" colspan="2">现金支付（'.$c.'）&nbsp;&nbsp;&nbsp;&nbsp;银行汇款（'.$d.'）&nbsp;&nbsp;&nbsp;&nbsp;转账支票（'.$f.'）</td>
					                                                   </tr>

					                                                 </tbody>
					                                               </table>
					                                               <div align="left" class="printbottom" ><b>公司领导：</b>'.$g.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>财务主管：</b>'.$h.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>会计：</b>'.$i.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>审批人：</b>'.$t.'</div>';


					              					 }
					               		}
					            		}
															echo $table;
															die();
											}
											//批量审核
													public function actionPassMore() {
														$id = Yii::app()->request->getParam("id");
														$user_id = Yii::app()->session['admin_uid'];
														$referer = Yii::app()->request->getParam('referer');
														$user = AdminUser::model()->find("id='$user_id'");


															//尹卓批量审核
															if($user->nickname=='尹卓') {
																	if($id) {
																			foreach($id as $k=>$v) {
																					$outroom = CmsOutroom::model()->find("contract_id= '$v'");
																					if($outroom->check_type==3) {
																									$outroom->check_type = 6;
																									$outroom->check_three = Yii::app()->session['admin_uid'];
																									$purchase = CmsPurchaseContract::model()->find("id='$v'");
																									$purchase->otime = time();
																									if (!$purchase->save()){
																											if(Yii::app()->request->isAjaxRequest){

																													$this->OutputJson(0,$purchase->errors,null);
																										}
																									}

																										if(!$outroom->save()) {
																											$this->OutputJson(0,$model->errors,null);
																										}
																					}


																				}
																			}
																		}
														//陈淑明批量审核
														if($user->nickname=='陈淑明') {
																if($id) {
																		foreach($id as $k=>$v) {
																				$outroom = CmsOutroom::model()->find("contract_id= '$v'");
																				if($outroom->check_type==7) {
																								$outroom->check_type = 8;
																								$outroom->money_two_type = Yii::app()->session['admin_uid'];
																								$purchase = CmsPurchaseContract::model()->find("id='$v'");
																								$purchase->otime = time();
																								if (!$purchase->save()){
																										if(Yii::app()->request->isAjaxRequest){

																												$this->OutputJson(0,$purchase->errors,null);
																									}
																								}

																								if(!$outroom->save()) {
																									$this->OutputJson(0,$model->errors,null);
																								}
																				}

																			}
																		}
																	}
														//韩剑侠批量审核
													if($user->nickname=='韩剑侠') {
															if($id) {
																	foreach($id as $k=>$v) {
																			$outroom = CmsOutroom::model()->find("contract_id= '$v'");
																			if($outroom->check_type==8) {
																							$outroom->check_type = 10;
																							$outroom->money_center = Yii::app()->session['admin_uid'];
																							$purchase = CmsPurchaseContract::model()->find("id='$v'");
																							$purchase->otime = time();
																							if (!$purchase->save()){
																									if(Yii::app()->request->isAjaxRequest){

																											$this->OutputJson(0,$purchase->errors,null);
																								}
																							}

																								if(!$outroom->save()) {
																									$this->OutputJson(0,$model->errors,null);
																								}
																						}
																					}
																				}
																			}


																$this->redirect("/admin/outroom ");

												}
											}
