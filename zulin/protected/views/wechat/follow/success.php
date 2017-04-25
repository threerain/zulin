<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>跟进成功</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
		<style>
			.pic{text-align:center;}
			.btncontainer{text-align:center;}
			html{background:#fff;}
		</style>
	</head>
	<body>
		<div class="mui-content">
		    <div class="mui-content-padded">
		    	<div class='pic'>
		    		<img src="/css/image/success.png">
		    	</div>
		    	<div class='btncontainer'>
						<a href="/wechat/follow/index/openid/<?php echo $openid?>"><button type="button" class="mui-btn mui-btn-blue mui-btn-outlined" style='margin-right:10px;'>继续跟进</button></a>
						<a href="/wechat/follow/myfollow/openid/<?php echo $openid?>"><button type="button" class="mui-btn mui-btn-blue mui-btn-outlined" style='margin-left:10px;'>我的跟进</button></a>
		    	</div>

		    </div>
		</div>

		<script src="/css/wechat/js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>
	</body>

</html>
