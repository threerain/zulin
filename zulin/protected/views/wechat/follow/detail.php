<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>跟进详情</title>
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
		    <h4>销售日汇</h4>
			<hr color="#a37f41" size="1">
		    <div class='datahui'>
		    	<p><span class='left'>区域:</span><span class='right'><?php
							if($list->district==1) {
									echo '大望路慈云寺';
								}else if($list->district==2) {
										echo '朝阳门东直门';
								}else if($list->district==3) {
										echo '三里屯三元桥';
								}else if($list->district==4) {
										echo 'CBD崇文门';
								}else if($list->district==5) {
										echo 'CBD核心建国门';
								}

					?>

				</span></p>
		    	<p><span class='left'>组团:</span><span class='right'><?php
											if($list->group==1) {
													echo '第一组团';
											}else if($list->group==2) {
													echo '第二组团';
											}else if($list->group==3) {
													echo '第三组团';
											}

					?></span></p>
		    	<p><span class='left'>每日标识负责项目渠道:</span><span class='right'><?php echo $list->project_channel?></span></p>
		    	<p><span class='left'>每日标识组团渠道:</span><span class='right'><?php echo $list->group_channel?></span></p>
		    	<p><span class='left'>每日标识区域渠道:</span><span class='right'><?php echo $list->estate_channel?></span></p>
		    	<p><span class='left'>每日标识大区渠道:</span><span class='right'><?php echo $list->big_channel?></span></p>
		    	<p><span class='left'>每日标识其他渠道:</span><span class='right'><?php echo $list->other_channel?></span></p>
		    	<p><span class='left'>每日添加新渠道数量:</span><span class='right'><?php echo $list->new_channel_num?></span></p>
		    	<p><span class='left'>微信通讯录渠道总数:</span><span class='right'><?php echo $list->wechat_channel_num?></span></p>
		    	<p><span class='left'>每日电话咨询量:</span><span class='right'>0</span><?php echo $list->phone_num?></p>
		    	<p><span class='left'>今日首次带看量汇总:</span><span class='right'><?php echo $list->look_one_num?></span></p>
		    	<p><span class='left'>今日复看带看量汇总:</span><span class='right'><?php echo $list->look_two_num?></span></p>
		    	<p><span class='left'>今日约见面积汇总:</span><span class='right'><?php echo $list->meet_area_num?></span></p>
		    	<p><span class='left'>今日约见套数汇总:</span><span class='right'><?php echo $list->meet_muit_num?></span></p>
		    	<p><span class='left'>今日意向客户:</span><span class='right'><?php echo $list->client?></span></p>
		    	<p><span class='left'>签约面积:</span><span class='right'><?php echo $list->sign_area?></span></p>
		    	<p><span class='left'>签约套数:</span><span class='right'><?php echo $list->sign_muit?></span></p>
		    </div>
		    <h4>客户跟进</h4>
		 	<hr color="#a37f41" size="1">
		    <div class='datahui'>
		    	<p><span class='left'>楼 &nbsp;&nbsp;&nbsp;盘:</span><span class='right'><?php echo Property::estate($model->property_id)?></span></p>
		    	<p><span class='left'>楼&nbsp;&nbsp;&nbsp; 栋:</span><span class='right'><?php echo Property::building($model->property_id)?></span></p>
		    	<p><span class='left'>编号:</span><span class='right'><?php echo Property::house_no($model->property_id)?></span></p>
		    	<p><span class='left'>面积:</span><span class='right'><?php echo $model->area?></span></p>

		    	<p><span class='left'>经纪公司:</span><span class='right'><?php echo $model->company?></span></p>
		    	<p><span class='left'>联系人:</span><span class='right'><?php echo $model->linkman?></span></p>
		    	<p><span class='left'>电话:</span><span class='right'><?php echo $model->phone?></span></p>
		    	<p><span class='left'>客户业态:</span><span class='right'><?php echo $model->format?></span></p>
		    	<p><span class='left'>预算:</span><span class='right'><?php echo $model->budget?></span></p>
		    	<p><span class='left'>是否二看:</span><span class='right'><?php
                    if($model->two_see==1) {
                        echo '是';
                    }else if($model->two_see==2) {
                        echo '否';
                    }
          ?></span></p>
		    	<p><span class='left'>意向客户项目编号:</span><span class='right'><?php echo $model->house_no?></span></p>
		    	<p><span class='left'>是否负责人:</span><span class='right'><?php
                  if($model->prineinal==1) {
                      echo '是';
                  } else if($model->prineinal==2) {
                      echo '否';
                  }

          ?></span></p>
		    	<p><span class='left'>订房时间:</span><span class='right'><?php echo $model->order_time?></span></p>
          <p><span class='left'>幼狮对接人:</span><span class='right'><?php echo $model->urs_people?></span></p>
		    	<p><span class='left'>跟进详情:</span><span class='right'><?php echo $model->follow_info?></span></p>
		    	<p><span class='left'>备注:</span><span class='right'><?php echo $list->remark?></span></p>
		    </div>
		   </div>
		</div>
		<script src="js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>
	</body>

</html>
