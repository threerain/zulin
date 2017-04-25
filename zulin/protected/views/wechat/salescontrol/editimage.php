<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>车源图片编辑</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/weui.css" rel="stylesheet" />
		<script src="/css/wechat/js/jquery-1.8.2.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
		<style>
		.weui-icon-success {
		    font-size: 21px;
		    color: #09BB4A;
		    margin-left: 61%;
		}
		.weui-uploader__bd {
		    overflow: hidden;
		    margin-left: 2%;
		}

		body{overflow-x:hidden;}
		</style>
	</head>
<body>
	<input type="hidden" name="contract_id" id="contract_id" value="<?php echo $contract_id ?>">
	<input type="hidden" name="referer" id="referer" value="<?php echo $referer ?>">
	<input type="hidden" name="imageurl" id="imageurl" value="">
		<div class="weui-uploader">
		    <div class="weui-uploader__hd">
		    </div>
		    <div class="weui-uploader__bd" >
		        <ul class="weui-uploader__files" id="uploaderFiles">
		        <?php foreach ($imageurl as $key => $value): ?>
		        	<!-- weui-uploader__file_status -->
	            	<li class="weui-uploader__file  single" mark ='0' data="<?php echo $value;?>" style="background-image:url(<?php echo $value ?>)">
					<i class="weui-icon-success" style="display:none;"></i>
		            </li>		        	
		        <?php endforeach ?>
		        </ul>
		    </div>
		</div>
		<div class="weui-tab">
		    <div class="weui-navbar">
		        <div class="weui-navbar__item select">
		            全选
		        </div>
		        <div class="weui-navbar__item deleted">
		            删除
		        </div>
		        <div class="weui-navbar__item back">
		           <a href="<?php echo $referer; ?>">返回</a>
		        </div>
		    </div>
		</div>
		<div id="toast" style="display: none;">
		    <div class="weui-mask_transparent"></div>
		    <div class="weui-toast">
		        <i class="weui-icon-success-no-circle weui-icon_toast"></i>
		        <p class="weui-toast__content">修改成功</p>
		    </div>
		</div>
		<div class="weui-footer weui-footer_fixed-bottom">
		    <p class="weui-footer__links">
		        <a href="/wechat/salescontrol/index" class="weui-footer__link">销控列表</a>
		    </p>
		    <p class="weui-footer__text">Copyright &copy; 2016-2018 幼狮科技</p>
		</div>
	<script>
		$(".weui-navbar__item").click(function(){
			$(".weui-navbar__item").removeClass('weui-bar__item_on');
		})
		$(".single").click(function(){
			if($(this).attr('mark')==0){
				var single = $(this);
				single.attr('mark',1);
				var icon = $(this).find(".weui-icon-success");
				icon.show();
			}else{
				var single = $(this);
				single.attr('mark',0);
				var icon = $(this).find(".weui-icon-success");
				icon.hide();
			}
		})
		$(".deleted").click(function(){
			//获取所有被选中的
			var single = $(".single");
			var url ='';
			for (var i = single.length - 1; i >= 0; i--) {
				if(single.eq(i-1).attr('mark')==0){
					url +=single.eq(i-1).attr('data')+',';
				}
			}
			var contract_id = $("#contract_id").val();
			var referer = $("#referer").val();
			$.post('/wechat/salescontrol/EditImageSave',{url:url,contract_id:contract_id},function(msg){
				if(msg==1){
					$("#toast").show('slow');
					setTimeout("$('#toast').hide()",3000);
					window.location.href=referer;
				}
			})
		})
		//全选
		$(".select").click(function(){
			var single = $(".single");
			for (var i = single.length - 1; i >= 0; i--) {
				single.eq(i-1).attr('mark',1);
			}
			var icon = $(".weui-icon-success");
			for (var i = icon.length - 1; i >= 0; i--) {
				icon.eq(i-1).show();
			}
		})
		$(".select").toggle(
			function(){
				$(this).text('取消');
					var single = $(".single");
				for (var i = single.length - 1; i >= 0; i--) {
					single.eq(i-1).attr('mark',1);
				}
				var icon = $(".weui-icon-success");
				for (var i = icon.length - 1; i >= 0; i--) {
					icon.eq(i-1).show();
				}
			},
			function(){
				$(this).text('全选');
				var single = $(".single");
				for (var i = single.length - 1; i >= 0; i--) {
					single.eq(i-1).attr('mark',0);
				}
				var icon = $(".weui-icon-success");
				for (var i = icon.length - 1; i >= 0; i--) {
					icon.eq(i-1).hide();
				}
			})
	</script>
	</body>
</html>
