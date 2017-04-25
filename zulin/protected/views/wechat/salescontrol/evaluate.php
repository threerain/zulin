<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
		<script src="/css/wechat/js/jquery-1.8.2.min.js"></script>
		<script src="/css/wechat/js/mui.min.js"></script>
	</head>

	<body>
		<script type="text/javascript">
			mui.init()
		</script>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">评价</h1>
		</header>
		<div class="mui-content">
			<form class="" action="/wechat/salescontrol/saveeval" method="post"  onsubmit="return test()">
				<input type="hidden" name="id" value="<?php echo $id?>">
				<input type="hidden" name="referer" value="<?php echo $referer?>">
				<input type="hidden" name="openid" value="<?php echo $openid?>">
		  	  <textarea rows="10" name="eval" id='text'></textarea>
		  	  <div style='text-align:center;'>
			  	 <button type="submit" class="mui-btn mui-btn-blue">评价</button>
			  	 <button type="button" class="mui-btn mui-btn-blue" onclick="history.go(-1)">取消</button>
		  	  </div>




		    </form>
		</div>
	</body>
			<script type="text/javascript">
						function test() {
							var a = document.getElementById("text");
										if(a.value == '') {
												mui.toast("评价不能为空");
												return false;
										}
						}
			</script>
</html>
