<!doctype html>
<html>


		<meta charset="UTF-8">
		<title>2017年<?php echo $month?>月销售排名</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
		<script src="/css/wechat/js/mui.min.js"></script>
		<link type="text/css" rel="stylesheet" href="/css/wechat/css/demo.css">
		<script src="/css/wechat/js/jquery-1.8.2.min.js"></script>
		<script src="/css/wechat/js/demo.js"></script>
		<style>
			.mui-table-view-cell{padding-right:20px;padding-left:20px;font-size:14px;}
			.mui-table-view-cell .mui-pull-right{margin-right:20px;}
			.search{
				border:1px solid #f4f4f4;
				position:absolute;
				top:0px;
				left:0px;
				width: 100%;
				height: 40px;
			}
			.s_con{
				position: relative;
				float: left;
				display: block;
				width: 80%;
				height: 40px;
			}
			.s_con input{
				display: inline-block;
				border: 0px;
				width: 100%;
				height: 40px;
				line-height: 40px;
				padding-left:10px;
			}
			.s_con .clear{
				display: none;
				position: absolute;
				right: 0px;
				top:6px;
				content: "";
				width: 25px;
				height: 25px;
				background-image:url(img/del.svg)
				background-size: 25px 25px;
				cursor:pointer;

			}
			.s_btn{
				float: left;
				display: block;
				background-color: #009DFF;
				width: 20%;
				height: 40px;
				line-height: 40px;
				color: #fff;
				font-size: 13px;
				text-align: center;
				cursor: pointer;
			}
			.list{
				margin:50px auto;
				width: 96%;
				height: auto;
				border-radius: 5px;
				border:1px solid #f4f4f4;
			}
			.list ul li{
				border-bottom:1px solid #f4f4f4;
				width: 96%;
				height: 40px;
				line-height: 40px;
				text-align: left;
				color: #000;
				font-size: 13px;
				padding-left: 10px;
			}

			.mui-bar .mui-btn {
					font-weight: 400;
					position: relative;
					z-index: 20;
					top: 1px;
					margin-top: 0;
					padding:0px;
			}
		</style>

	<header class="mui-bar mui-bar-nav">
		<form class="" action="/wechat/Performance/index" method="post">
			<div class="search">
			<span class="s_con"><input type="text" class="content" name='name' value="<?php echo $name?>" placeholder="请输入签约人姓名"><i class="clear"></i>	</span>
			<button type="submit" class="mui-btn mui-btn-blue s_btn">搜索</button>
		</div>
	</form>
	</header>
	<body>
		<div class="mui-content" style="margin-top:-12px">
		    <ul class="mui-table-view">


						<?php  $a = 1;  foreach($house_area as $k => $v) {

							?>

							<li class="mui-table-view-cell">
									<a class="mui-navigate-right mui-ellipsis" href="/wechat/Performance/detail/id/<?php echo $k?>/area/<?php echo $area?>">
												第<?php echo $a?>名<span class="mui-pull-right"><?php
																	$name = AdminUser::model()->find("id='$k'");
																	echo $name->nickname;
												?></span>
									</a>
							</li>

					<?php	$a++; }?>
		        </ul>
		</div>
		<script src="js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>
	</body>

</html>
