<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>我的跟进</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
		<style>
			.mui-table-view-cell{padding-right:20px;padding-left:20px;font-size:14px;}
			.mui-table-view-cell .mui-pull-right{margin-right:20px;}
		</style>
	</head>

	<body>
		<div class="mui-content">
		    <ul class="mui-table-view">
					<?php if($model) {
									foreach($model as $k=>$v) {?>
										<li class="mui-table-view-cell">
				                <a class="mui-navigate-right mui-ellipsis" href="/wechat/follow/detail/id/<?php echo $v['id']?>">
				                    	<?php echo Property::estate($v['property_id']).Property::building($v['property_id']).Property::house_no($v['property_id'])?> <span class="mui-pull-right"><?php echo $v['ctime']?></span>
				                </a>
				            </li>

					<?php
							}
					}?>

		        </ul>

		</div>
		<script src="js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>
	</body>

</html>
