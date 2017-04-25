<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>详情信息</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
		<style>
			h4{padding-left:20px;height:30px;line-height:30px;}
			.datahui .left{display:inline-block;width:170px;text-align:justify;margin-right:5px;padding-left:20px;}
			.datahui p{clear:both;color:#222;}
			.datahui{margin-bottom:20px;}
			.mui-content{background:#fff;}
		</style>
	</head>

	<body>
		<div class="mui-content">
			<div class="mui-content-padded">
		    <h4>基础信息</h4>
			<hr color="#a37f41" size="1">
		    <div class='datahui'>
		    	<p><span class='left'>区域:</span><span class='right'><?php echo $department->name?></span></p>
		    	<p><span class='left'>签单人:</span><span class='right'></span><?php echo $user?></p>
          <p><span class='left'>签约面积:</span><span class='right'><?php echo $house_area?>㎡</span></p>
          <p><span class='left'>签约套数:</span><span class='right'></span><?php echo $len?></p>
		    	<p><span class='left'>业绩量/整体业绩:</span><span class='right'><?php echo  sprintf("%.2f",$house_area/$area1*100); ?>%</span></p>
		    </div>

		    <div class='datahui'>
					<?php
						foreach($contract_id as $k=>$v) {

							$pur_id= Contract::purchasecontract($v);

							foreach($pur_id as $key=>$value) {
									$mode = UrsSalesControl::model()->find("contract_id='$value->contract_id' and deleted=0 ");
							}

							$list = CmsPurchaseContract::model()->find("id='$v'");

								if($mode==null) {?>
									<h4>荣誉房</h4>
								<hr color="#a37f41" size="1">
									<p><span class='left'>项目名称:</span><span class='right'><?php

													$res = CmsPurchaseProperty::model()->find("contract_id='$v'");
													if($res){
														$data = CmsProperty::model()->find("id='$res->property_id'");
														if($data){
															$item = BaseEstate::model()->find("id='$data->estate_id'");
															echo $item?$item->name:"";
														}
													 }

									?></span></p>
									<p><span class='left'>编号:</span><span class='right'><?php
									$res=CmsPurchaseProperty::model()->find("contract_id='$v'");

											if($res){
												$data=CmsProperty::model()->find("id='$res->property_id'");
												if($data){
													$item=BaseBuilding::model()->find("id='$data->building_id'");
													echo $item?$item->name:"";
												}
											 }
											 $res=CmsPurchaseProperty::model()->findAll("contract_id='$v' ");
											 $house ='';
											 if($res){
												 foreach ($res as $key => $value) {
													 $item=CmsProperty::model()->find("id='$value->property_id'");
													 $house .= $item->house_no.'/';
													//  echo $item->house_no;
												 }
												 echo rtrim($house,'/');

											 }
									?></span></p>
									<p><span class='left'>面积:</span><span class='right'><?php
												$house1= '';
												$item=CmsPurchaseProperty::model()->findAll("contract_id='$v' and deleted=0");
												//合同上所有的面积汇总
												foreach($item as $k2=>$v2) {
															$size = $v2->area ;
															$house1 += $size;
												}
												$len = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
												echo $house1*$len->scale;
								 			?>m<sup>2</sup></span></p>
									<p><span class='left'>月租金:</span><span class='right'><?php 	$pay = CmsPurchasePayRule::model()->find("contract_id='$v' order by the_order"); echo $pay?number_format($pay->monthly_rent/100,2):'';

									?></span></p>
									<p><span class='left'>套数:</span><span class='right'><?php
																		$scale = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																		echo $scale->scale;
									?></span></p>
							<?php	}else{
														if($list->signing_date - $mode->live_date<=9*24*60*60) {?>

															<h4>荣誉房</h4>
														<hr color="#a37f41" size="1">
															<div class='datahui'>

																				<p><span class='left'>项目名称:</span><span class='right'><?php

																								$res = CmsPurchaseProperty::model()->find("contract_id='$v'");
																								if($res){
																									$data = CmsProperty::model()->find("id='$res->property_id'");
																									if($data){
																										$item = BaseEstate::model()->find("id='$data->estate_id'");
																										echo $item?$item->name:"";
																									}
																								 }

																				?></span></p>
																				<p><span class='left'>编号:</span><span class='right'><?php
																				$res=CmsPurchaseProperty::model()->find("contract_id='$v'");

																						if($res){
																							$data=CmsProperty::model()->find("id='$res->property_id'");
																							if($data){
																								$item=BaseBuilding::model()->find("id='$data->building_id'");
																								echo $item?$item->name:"";
																							}
																						 }
																						 $res=CmsPurchaseProperty::model()->findAll("contract_id='$v' ");
																						 $house ='';
																						 if($res){
																							 foreach ($res as $key => $value) {
																								 $item=CmsProperty::model()->find("id='$value->property_id'");
																								 $house .= $item->house_no.'/';

																							 }
																							 echo rtrim($house,'/');

																						 }
																				?></span></p>
																				<p><span class='left'>面积:</span><span class='right'><?php
																							$item=CmsPurchaseProperty::model()->findAll("contract_id='$v' and deleted=0");
																							$house1='';
																							//合同上所有的面积汇总
																							foreach($item as $k2=>$v2) {
																										$size = $v2->area ;
																										$house1 += $size;
																							}
																							$len = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																							echo $house1*$len->scale;
																						?>m<sup>2</sup></span></p>
																				<p><span class='left'>月租金:</span><span class='right'><?php 	$pay = CmsPurchasePayRule::model()->find("contract_id='$v' order by the_order"); echo $pay?number_format($pay->monthly_rent/100,2):'';

																				?></span></p>
																				<p><span class='left'>套数:</span><span class='right'><?php
																													$scale = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																													echo $scale->scale;
																				?></span></p>
									<?php					}else if(($list->signing_date - $mode->live_date>=10*24*60*60) && ($list->signing_date - $mode->live_date<=20*24*60*60)) {?>
										<h4>快销房</h4>
									<hr color="#a37f41" size="1">
										<div class='datahui'>


															<p><span class='left'>项目名称:</span><span class='right'><?php

																			$res = CmsPurchaseProperty::model()->find("contract_id='$v'");
																			if($res){
																				$data = CmsProperty::model()->find("id='$res->property_id'");
																				if($data){
																					$item = BaseEstate::model()->find("id='$data->estate_id'");
																					echo $item?$item->name:"";
																				}
																			 }

															?></span></p>
															<p><span class='left'>编号:</span><span class='right'><?php
															$res=CmsPurchaseProperty::model()->find("contract_id='$v'");

																	if($res){
																		$data=CmsProperty::model()->find("id='$res->property_id'");
																		if($data){
																			$item=BaseBuilding::model()->find("id='$data->building_id'");
																			echo $item?$item->name:"";
																		}
																	 }
																	 $res=CmsPurchaseProperty::model()->findAll("contract_id='$v' ");
																	 $house ='';
																	 if($res){
																		 foreach ($res as $key => $value) {
																			 $item=CmsProperty::model()->find("id='$value->property_id'");
																			 $house .= $item->house_no.'/';

																		 }
																		 echo rtrim($house,'/');

																	 }
															?></span></p>
															<p><span class='left'>面积:</span><span class='right'><?php
																		$item=CmsPurchaseProperty::model()->findAll("contract_id='$v' and deleted=0");
																			$house1='';
																		//合同上所有的面积汇总
																		foreach($item as $k2=>$v2) {
																					$size = $v2->area ;
																					$house1 += $size;
																		}
																		$len = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																		echo $house1*$len->scale;
																	?>m<sup>2</sup></span></p>
															<p><span class='left'>月租金:</span><span class='right'><?php 	$pay = CmsPurchasePayRule::model()->find("contract_id='$v' order by the_order"); echo $pay?number_format($pay->monthly_rent/100,2):'';

															?></span></p>
															<p><span class='left'>套数:</span><span class='right'><?php
																								$scale = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																								echo $scale->scale;
															?></span></p>
							<?php		}else if(($list->signing_date - $mode->live_date>=21*24*60*60) && ($list->signing_date - $mode->live_date<=35*24*60*60)) {?>
								<h4>风险房</h4>
							<hr color="#a37f41" size="1">
								<div class='datahui'>

													<p><span class='left'>项目名称:</span><span class='right'><?php

																	$res = CmsPurchaseProperty::model()->find("contract_id='$v'");
																	if($res){
																		$data = CmsProperty::model()->find("id='$res->property_id'");
																		if($data){
																			$item = BaseEstate::model()->find("id='$data->estate_id'");
																			echo $item?$item->name:"";
																		}
																	 }

													?></span></p>
													<p><span class='left'>编号:</span><span class='right'><?php
													$res=CmsPurchaseProperty::model()->find("contract_id='$v'");

															if($res){
																$data=CmsProperty::model()->find("id='$res->property_id'");
																if($data){
																	$item=BaseBuilding::model()->find("id='$data->building_id'");
																	echo $item?$item->name:"";
																}
															 }
															 $res=CmsPurchaseProperty::model()->findAll("contract_id='$v' ");
															 $house ='';
															 if($res){
																 foreach ($res as $key => $value) {
																	 $item=CmsProperty::model()->find("id='$value->property_id'");
																	 $house .= $item->house_no.'/';

																 }
																 echo rtrim($house,'/');

															 }
													?></span></p>
													<p><span class='left'>面积:</span><span class='right'><?php
																$item=CmsPurchaseProperty::model()->findAll("contract_id='$v' and deleted=0");
																	$house1='';
																//合同上所有的面积汇总
																foreach($item as $k2=>$v2) {
																			$size = $v2->area ;
																			$house1 += $size;
																}
																$len = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																echo $house1*$len->scale;
															?>m<sup>2</sup></span></p>
													<p><span class='left'>月租金:</span><span class='right'><?php 	$pay = CmsPurchasePayRule::model()->find("contract_id='$v' order by the_order"); echo $pay?number_format($pay->monthly_rent/100,2):'';

													?></span></p>
													<p><span class='left'>套数:</span><span class='right'><?php
																						$scale = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																						echo $scale->scale;
													?></span></p>
						<?php	}else if($list->signing_date - $mode->live_date>36*24*60*60) {?>
							<h4>亏损房</h4>
						<hr color="#a37f41" size="1">
							<div class='datahui'>

												<p><span class='left'>项目名称:</span><span class='right'><?php

																$res = CmsPurchaseProperty::model()->find("contract_id='$v'");
																if($res){
																	$data = CmsProperty::model()->find("id='$res->property_id'");
																	if($data){
																		$item = BaseEstate::model()->find("id='$data->estate_id'");
																		echo $item?$item->name:"";
																	}
																 }

												?></span></p>
												<p><span class='left'>编号:</span><span class='right'><?php
												$res=CmsPurchaseProperty::model()->find("contract_id='$v'");

														if($res){
															$data=CmsProperty::model()->find("id='$res->property_id'");
															if($data){
																$item=BaseBuilding::model()->find("id='$data->building_id'");
																echo $item?$item->name:"";
															}
														 }
														 $res=CmsPurchaseProperty::model()->findAll("contract_id='$v' ");
														 $house ='';
														 if($res){
															 foreach ($res as $key => $value) {
																 $item=CmsProperty::model()->find("id='$value->property_id'");
																 $house .= $item->house_no.'/';
															 }
															 echo rtrim($house,'/');

														 }
												?></span></p>
												<p><span class='left'>面积:</span><span class='right'><?php
															$item=CmsPurchaseProperty::model()->findAll("contract_id='$v' and deleted=0");
																$house1='';
															//合同上所有的面积汇总
															foreach($item as $k2=>$v2) {
																		$size = $v2->area ;
																		$house1 += $size;
															}
															$len = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
															echo $house1*$len->scale;
														?>m<sup>2</sup></span></p>
												<p><span class='left'>月租金:</span><span class='right'><?php 	$pay = CmsPurchasePayRule::model()->find("contract_id='$v' order by the_order"); echo $pay?number_format($pay->monthly_rent/100,2):'';

												?></span></p>
												<p><span class='left'>套数:</span><span class='right'><?php
																					$scale = CmsContractSigner::model()->find("contract_id='$v' and signer='$id'");
																					echo $scale->scale;
												?></span></p>
											</div>

					<?php	}
								}
						}


					?>



		</div>
		<script src="js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>
	</body>

</html>
