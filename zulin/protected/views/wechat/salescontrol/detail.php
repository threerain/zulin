<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>销控详情</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
			<script src="/css/wechat/js/jquery-1.8.2.min.js"></script>
		<style>
			.detail{padding:10px;padding-left:20px;border:1px solid #aaa;}
			.detail p{color:#333;}
			.twotext{margin-left:100px;}
			.detailtwo{padding-top:10px;overflow: hidden;}
			.detailtwo p{float:left;width:25%;text-align:center;color:#000;}
			.textwenxian{color:#00f;}
			.zhuangxiu,.present{padding-left:20px;margin-top:20px;}
			.zhuangxiu,.present p{color:#222;}
			.zhuangxiu,.presentdetail{color:#00f!important;}
			.mui-slider {
		    width: 100%;
		    height: 140px;
		}
		/*轮播图片*/

		.mui-slider img {
		    height: 140px;
		    width: 100%;
		}
		/*轮播指示点*/

		.mui-slider-indicator .mui-active {
		    background-color: #FF6696 !important;
				/*display:none;*/
		}
		.mui-slider-indicator .mui-indicator {
		    box-shadow: none !important;
		    background-color: #EEEEEE;
		    opacity: 0.7;  /*透明度*/
				/*display:none;*/

		}
		</style>
	</head>

	<body>
		<script src="/css/wechat/js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>

		<nav class="mui-bar mui-bar-tab">
		    <a class="mui-tab-item"  id="info" style='border-right:1px solid #aaa'>
		        <span class="mui-tab-label">卖相评价</span>
		    </a>
		    <a class="mui-tab-item" id="image" style='border-right:1px solid #aaa'>
		        <span class="mui-tab-label">上传照片</span>
		    </a>
	    	<a class="mui-tab-item" id="editimage" >
		        <span class="mui-tab-label">编辑照片</span>
		    </a>
		</nav>
		<div class="mui-content" style='padding-bottom:50px;'>
		 <div id="slider" class="mui-slider" style='height:300px;;'>
				<div class="mui-slider-group ">
					<!-- 额外增加的一个节点(循环轮播：第一个节点是最后一张轮播) -->
					<?php if($list_photo){
						 foreach($list_photo as $key => $value):?>

							<div class="mui-slider-item">
								<a href="#">
									<img src="<?php  echo $value?>" class="tupian"  style="height:300px;overflow:hidden;">
								</a>
							</div>

						<?php endforeach?>
					<?php  }
					if(UrsSalesControl::model()->find("property_id='$property->id' and deleted=0")->url!=null) {?>
									<?php  $item = UrsSalesControl::model()->find("property_id='$property->id' and deleted=0")->url;
														$url = explode(',',$item);
														$len = count($url);
														foreach($url as $k=>$v) {
																		if($k!=$len-1) {?>
																			<div class="mui-slider-item">
																				<a href="#">
																					<img src="<?php  echo $v?>" class="tupian" style="height:300px;overflow:hidden;">
																				</a>
																			</div>
														<?php				}
													}

									?>

				<?php	}
							$item = UrsSalesControl::model()->find("property_id='$property->id' and deleted=0")->url;
				 	if($list_photo == null &&  $item == null){?>
									<div class="mui-slider-item ">
										<a href="#">
											<img src="/css/wechat/img/1.jpg" style="height:300px;">
										</a>
									</div>

									<!-- 额外增加的一个节点(循环轮播：最后一个节点是第一张轮播) -->

								<?php	}?>

				</div>
				<div class="mui-slider-indicator mui-text-right">
					<div class="mui-indicator mui-active"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
					<div class="mui-indicator"></div>
				</div>
			</div>
			<div class='detail'>
				<p><?php
										$area = CmsProperty::model()->find("id='$property_id'");
										$estate = BaseEstate::model()->find("id='$area->estate_id'");
										echo $estate->name.'&nbsp';
										$name = BaseBuilding::model()->find("id='$area->building_id'");
										echo $name->name."&nbsp";
										echo $area->house_no;
				?></p>
				<p>产品类型：<?php if($property->room_type){echo $arrproperty['room_type']["$property->room_type"]; }?>
					<span class='twotext'>项目属性：<?php $item=BaseBuilding::model()->find("id='$property->building_id'"); echo $item?str_replace([1,2,3],['A1','A2','A3'],$item->type):""; ?></span></p>
				<p>组团：<?php $item=BaseEstateGroup::model()->find("id='$property->estate_group_id'"); echo $item?$item->name:""; ?></p>

				<?php
									$item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");

				if($item->name!=null) {
										$name = rtrim($item->name,',');
										$phone = rtrim($item->phone,',');
										$name = explode(',',$name);
										$phone = explode(',',$phone);

										foreach($name as $k=>$v) {?>


													<p>联系人：
														<?php
														if($v!=null) {
															echo $v;
														}

															?>
												</p>

												<p>电话：<?php
														if($v!=null) {
															echo $phone[$k];

														}


												 ?>
												</p>

											<?php
									}

				}?>
			</div>
			<div class="detailtwo">
				<p>价格<br><span class='textwenxian'>  <?php
						$item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
						echo $item?$item->unit_price/100:"";
					?>元/m<sup>2</sup>/天</span></p>
				<p>月租金<br><span class='textwenxian'><?php
					$item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
					if($item->sales_type==2) {
							echo $item?round($item->unit_price/100*$item->area*365/12,2):"";
					}else {
							echo $item?round($item->unit_price/100*$property->area*365/12,2):"";

					}
					?>元</span></p>
				<p>面积<br><span class='textwenxian'><?php
							$item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
							if($item->sales_type==2) {

									echo $item->area;

							}else {

								echo $property->area;

							}

			 			?>m<sup>2</sup></span></p>
				<p>朝向<br><span class='textwenxian'><?php echo $property->orientation; ?></span></p>
			</div>
			<div class='present'>
				<p>礼品</p>

				<?php
				 $res=UrsSalesControl::model()->findAll("contract_id='$contract_id' and deleted='0'");
				 $res_actual_date=SerPurContract::model()->find("contract_id='$contract_id' and deleted='0'")['actual_date'];
				 if(!$res_actual_date){
						$res_actual_date=CmsPurchaseContract::model()->find("id='$contract_id'")['the_date'];
				 }
					if($res){
						if(!$res_actual_date){
								foreach ($res as $key => $value) {
										$item=UrsGoodsDetail::model()->find("property_id='$id' and contract_id='$contract_id' and deleted = 0")['json'];
										$item=(Array)json_decode($item);
										$check= 1;
										foreach ($item as $key_item => $value_item) {
												if($check == 1){
														$key_item = explode('-',$key_item);
														$value_item_one = explode(',',$value_item);
												}
												$check++;
										}

										if($value_item_one){
												foreach ($value_item_one as $key_s => $value_s) {
														$goods = UrsGoodsStorage::model()->find("id = '$value_s'");
														if($goods){
																echo $goods['goods_name'].'('.$goods['goods_unit'].')' ."<br>";
														}
												}
										}
										unset($value_item_one);
										unset($check);

										$count++;
								}
						}else{
								$data_set = ceil((time()-$res_actual_date)/(24*60*60));
								$count=1;
								foreach ($res as $key => $value) {
										$item=UrsGoodsDetail::model()->find("property_id='$value->property_id' and contract_id='$value->contract_id' and deleted = 0")['json'];
										$item=(Array)json_decode($item);
										$check= 1;
										foreach ($item as $key_item => $value_item) {
												if($check == 1){
														$key_item = explode('-',$key_item);
														$value_item_one = explode(',',$value_item);
												}else{
														$key_item = explode('-',$key_item);
														if($key_item[0] <= $data_set && $key_item[1] >= $data_set){
																$value_items = explode(',',$value_item);
														}
												}
												$check++;
										}
										$value_items = $value_items ? $value_items : $value_item_one;
										echo '<p class="presentdetail">';
										if($value_items){
												foreach ($value_items as $key_s => $value_s) {
														$goods = UrsGoodsStorage::model()->find("id = '$value_s'");
														if($goods){
																echo $goods['goods_name'].'('.$goods['goods_unit'].')' ."<br>";
														}
												}
										}
										unset($value_items);
										unset($value_item_one);
										echo '</p>';
										$count++;
								}
						}

					}
				?>

				<!-- <p class='presentdetail'>大望路慈云寺商圈 银河SOHO A座 2503</p>
				<p class='presentdetail'>大望路慈云寺商圈 银河SOHO A座 2503</p> -->
			</div>

			<div class='zhuangxiu'>
				<p>装修状态</p>
				<?php
				 $res=UrsSalesControl::model()->findAll("contract_id='$contract_id' and deleted='0'");
					if($res){
						$count=1;
						foreach ($res as $key => $value) {
							$item=CmsProperty::model()->find("id='$value->property_id'");
							echo '<p class="presentdetail">';
							if($item){
							$item1 =  UrsDecorationFollow::model()->find(array(
										'condition' => "property_id='$item->id' and deleted=0",
											'order' => 'ctime desc',
							));
							if($item1){
								$ursarr=UrsPropertyDetail::model()->arr();
									echo $ursarr?$ursarr['decoration_status']["$item1->decoration_status"]:'';
							}else{
									echo '';
							}
						}
							echo '</p>';
							$count++;
						}

					}
				?>
			</div>

						<div class='zhuangxiu'>
							<p>卖相评价</p>
							<?php
							 $res=UrsSalesEval::model()->findAll("contract_id='$contract_id' ");
								if($res){

									foreach ($res as $key => $value) {
											echo '<p class="presentdetail">';
											echo $value->eval;
											echo '</p>';
								}
							}
							?>
						</div>
		</div>
	<script src="/css/wechat/js/mui.zoom.js"></script>
<script src="/css/wechat/js/mui.previewimage.js"></script>
	<script type="text/javascript">
	//图片预览加载完成
			// mui.previewImage();
	</script>
<script>
	document.getElementById('info').addEventListener('tap', function() {
	//打开关于页面
	mui.openWindow({
		url: '/wechat/salescontrol/evaluate/id/<?php echo $contract_id?>/openid/<?php echo $openid?>',
		id:'info'
	});
	});

	document.getElementById('image').addEventListener('tap', function() {
	//打开关于页面
	mui.openWindow({
		url: '/wechat/salescontrol/uploadimage/id/<?php echo $contract_id?>/openid/<?php echo $openid?>',
		id:'info'
	});
	});

	document.getElementById('editimage').addEventListener('tap', function() {
	//打开关于页面
	mui.openWindow({
		url: '/wechat/salescontrol/editimage/id/<?php echo $contract_id?>/openid/<?php echo $openid?>',
		id:'info'
	});
	});


</script>

		<script>
					mui.init({
					swipeBack:false //启用右滑关闭功能
					});
					var slider = mui("#slider");
					slider.slider({
					interval: 3000
					});
					// document.getElementById("switch").addEventListener('toggle', function(e) {
					// if (e.detail.isActive) {
					// slider.slider({
					// interval: 5000
					// });
					// } else {
					// slider.slider({
					// interval: 0
					// });
					// }
					// });
		</script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
		<script type="text/javascript">
		wx.config({
				debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
				appId: "<?php echo $signPackage['appId'] ?>", // 必填，公众号的唯一标识
				timestamp: <?php echo  $signPackage['timestamp'] ?>, // 必填，生成签名的时间戳
				nonceStr: "<?php echo $signPackage['nonceStr'] ?>", // 必填，生成签名的随机串
				signature: "<?php echo $signPackage['signature'] ?>",// 必填，签名，见附录1
				jsApiList: [
					'checkJsApi',
				'chooseImage',
				'previewImage',
				'uploadImage',
				'downloadImage',
				], // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
		});


		$(".tupian").click(function(){
			var img = $(this).attr('src');
			img = "http://erp.youshispace.com"+img;
			var c = document.getElementsByClassName("tupian");

			var all = [];
			for(var i=0;i<c.length;i++){
				if(i!=c.length) {

					all[i] = "http://erp.youshispace.com"+$(c[i]).attr('src');

					}
				}
				console.log('这是一则招聘信息，当你看到这个的时候，你就可以联系我们的人事部了，祝你好运');
			// alert(all);
			wx.previewImage({
							current: img, // 当前显示图片的http链接
							urls: all // 需要预览的图片http链接列表
							});

		})

		</script>
	</body>

</html>
