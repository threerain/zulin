<?php

class PerformanceController extends Controller
{
		/*
			手机端
		**/
	public $layout="//layouts/phonelogin.php";

	//	展示页面为我的业绩
	public function actionIndex()
	{
		//找到登陆用户的OPENID
		// $openid = Yii::app()->request->getParam("openid");
		//通过登录名查询用户表找到签约者的ID号,通过签约者ID找到相对应的一系列信息
		// $user = Validation::model()->find("openid='$openid'")['account'];
		// $id = AdminUser::model()->find("account="$user"")['id'];

		//本月
		$month = date("m",time());
		//本月开始时间
		$BeginDate = date('Y-m-01', strtotime(date("Y-m-d")));
		//本月结束时间
		$EndDate =  strtotime("$BeginDate +1 month -1 day");

		$BeginDate = strtotime($BeginDate);
		//查询签约人
		$name = Yii::app()->request->getParam('name');

		if($name!=null) {
			$user_id = AdminUser::model()->findAll( "nickname like '%".$name."%'");
		}
		//签约人ID
		$name_id = [];
		if($user_id!=null) {
					foreach($user_id as $k=>$v) {
									$name_id[] = $v->id;
					}
		}

			$model = CmsContractSigner::model()->findAll(" sign_date>='$BeginDate' and sign_date<='$EndDate' and type=1 and deleted=0 group by signer");


			//	存储签约人ID
			$signer_id = [];

			foreach($model as  $v) {
									$signer_id[] = $v->signer;
			}

			if($name_id!=null) {
								$signer_id = 	array_intersect($name_id,$signer_id);
			}
			//寻找签约人所签署的合同及签约比例
			$contract_id = [];
			$scale = [];
			if($signer_id) {
					  foreach($signer_id as $k=>$v) {

										$contract = CmsContractSigner::model()->findAll("signer='$v' and type=1 and sign_date>='$BeginDate' and deleted=0 and sign_date<='$EndDate'");

											foreach($contract as $key=>$va) {
												$model = CmsPurchaseContract::model()->find("id='$va->contract_id' and deleted=0 ");
														if($model!=null) {
															$contract_id[$v][] = $va->contract_id;
															$scale[$v][] = $va->scale;
														}

											}

						}

			}

			/*
						多重遍历
						第一层遍历:遍历出签约人所对应的合同 $k 为签约人ID
						第二层遍历：计算出合同所对应的车源面积及签约比例，算出每个签约人所签约的面积
			**/

				if($contract_id) {
								foreach($contract_id as $k=>$v) {
										$a = $scale[$k];

									$hosue_area = [];
									$house = '';
									foreach($v as $k1 => $v1) {
												$area = CmsPurchaseProperty::model()->findAll("contract_id='$v1'");

												$house1  = '';
												//合同上所有的面积汇总
												foreach($area as $k2=>$v2) {
															$size = $v2->area ;
															$house1 += $size;
												}
												//按比例填写出最后签约总面积
											$house += $house1*$a[$k1];

									}
											$house_area[$k] = $house ;
											unset($house);
								}
							}

											if($house_area!=null) {
															arsort($house_area);
											}else {
															$house_area = [];
											}
											$area = '';
											foreach($house_area as $v) {
													$area += $v;
											}

								$this->render('index',array(
												'name' => $name,
												'house_area' => $house_area,
												'month' => $month,
												'area' => $area,
 								));
							}
				//详情
				public function actionDetail() {
						//接收签约人ID
					$id = Yii::app()->request->getParam('id');
						//签约的总面积
					$area1 = Yii::app()->request->getParam('area');

					//查询签约人所在的区域ID
					$user = AdminUser::model()->find("id='$id'");
					//区域名称
					$department = AdminDepartment::model()->find("id='$user->department_id'");
					//本月开始时间
					$BeginDate = date('Y-m-01', strtotime(date("Y-m-d")));
					//本月结束时间
					$EndDate =  strtotime("$BeginDate +1 month -1 day");

					$BeginDate = strtotime($BeginDate);

						$model = CmsContractSigner::model()->findAll(" sign_date>='$BeginDate' and sign_date<='$EndDate' and type=1 and deleted=0 and signer='$id'");
						//查询出签约人在本月份签约的合同
						$contract_id = [];
						if($model!=null) {
										foreach($model as $k=>$v) {
											$list = CmsPurchaseContract::model()->find("id='$v->contract_id'  and deleted=0");
											if($list!=null) {
												$contract_id[] = $v->contract_id;
												$scale[] = $v->scale;
											}

										}
						}

							//查看签约套数
									foreach($scale as $k=>$v) {
														$len += $v;
									}
								if($contract_id) {
									foreach($contract_id as $k1 => $v1) {
												$area = CmsPurchaseProperty::model()->findAll("contract_id='$v1'");
												//合同上所有的面积汇总
												foreach($area as $k2=>$v2) {
															$size = $v2->area ;
															$house1 += $size;
												}
												//按比例填写出最后签约总面积
											$house += $house1*$scale[$k1];
											$house1 = '';
									}

											$house_area = $house;
										}

							//所有签约的总面积
							$list = CmsContractSigner::model()->findAll(" sign_date>='$BeginDate' and sign_date<='$EndDate' and type=1 ");

							$contract_id1 = [];
							foreach($list as $k=>$v) {
									$contract_id1[] = $v->contract_id;
							}
							if($contract_id1) {
								$contract_id1 = array_unique($contract_id1);
								foreach($contract_id1 as $k=>$v) {

												$area = CmsPurchaseProperty::model()->findAll("contract_id='$v'");
												//合同上所有的面积汇总
												foreach($area as $k2=>$v2) {
															$size = $v2->area ;
															$house1 += $size;
												}
								}
							}
					$this->render('detail',array(
						'house1' => $house1,
						'id' => $id,
						'contract_id' => $contract_id,
						'area1' => $area1,
						'len' => $len,
						'house_area' => $house_area,
						'department' => $department,
						'user' => $user->nickname,
					));
				}
	}
