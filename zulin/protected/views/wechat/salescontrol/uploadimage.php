<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>车源图片上传</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/weui.css" rel="stylesheet" />
		<script src="/css/wechat/js/jquery-1.8.2.min.js"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
		<style>
			body,html{overflow-x:hidden;}
		</style>
	</head>

	<body>
	<input type="hidden" name="contract_id" id="contract_id" value="<?php echo $contract_id ?>">
	<input type="hidden" name="referer" id="referer" value="<?php echo $referer ?>">
		<div class="weui-uploader">
		    <div class="weui-uploader__hd">
		        <!-- <div class="weui-uploader__info">0/2</div> -->
		    </div>
		    <div style="height:50px;display:block;">
		    </div>

			<div class="weui-gallery">
			    <span class="weui-gallery__img" style="background-image: url(./images/pic_article.png);"></span>
			    <div class="weui-gallery__opr">
			        <a href="javascript:" class="weui-gallery__del">
			            <i class="weui-icon-delete weui-icon_gallery-delete"></i>
			        </a>
			    </div>
			</div>

		    <div class="weui-uploader__bd">
		        <ul class="weui-uploader__files" id="uploaderFiles">

				<!-- 		            <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
		                <div class="weui-uploader__file-content">
		                    <i class="weui-icon-warn"></i>
		                </div>
		            </li>
		            <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
		                <div class="weui-uploader__file-content">50%</div>
		            </li> -->

		        </ul>
		        <div class="weui-uploader__input-box">
		            <input id="uploaderInput" class="weui-uploader__input" type="button" accept="image/*" multiple />
		        </div>
		    </div>
		</div>
	    <div style="height:50px;display:block;">
	    </div>
		<a href="javascript:;" id="uploadImage" class="weui-btn weui-btn_primary">上传</a>
		<!-- <a href="javascript:;" id="checkJsApi" class="weui-btn weui-btn_primary">测试</a> -->

		<div class="weui-footer weui-footer_fixed-bottom">
		    <p class="weui-footer__links">
		        <a href="/wechat/salescontrol/index" class="weui-footer__link">销控列表</a>
		    </p>
		    <p class="weui-footer__text">Copyright &copy; 2016-2018 幼狮科技</p>
		</div>

		<div id="toast" style="display: none;">
		    <div class="weui-mask_transparent"></div>
		    <div class="weui-toast">
		        <i class="weui-icon-success-no-circle weui-icon_toast"></i>
		        <p class="weui-toast__content">上传成功</p>
		    </div>
		</div>
	</body>

	<script>
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

	// document.querySelector('#checkJsApi').onclick = function () {
	// 	wx.checkJsApi({
	// 	    jsApiList: [
	// 	    	'chooseImage',
	// 	    	'chooseImage',
	// 			'previewImage',
	// 			'uploadImage',
	// 			'downloadImage',
	// 			], // 需要检测的JS接口列表，所有JS接口列表见附录2,
	// 	    success: function(res) {
	// 	        // 以键值对的形式返回，可用的api值true，不可用为false
	// 	        // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
	// 	        alert(JSON.stringify(res));
	// 	    }
	// 	});
	// }

	var images = {
		localId: [],
		serverId: []
	};

	document.querySelector('#uploaderInput').onclick = function () {

		wx.chooseImage({
		    count: 9, // 默认9
		    sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
		    sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
		    success: function (res) {
		        images.localId = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
		        var str ='';
		        for (x in images.localId){
		        	str+="<li class='weui-uploader__file' data='"+images.localId[x]+"' style='background-image:url("+images.localId[x]+")'></li>";
		        }
		        $("#uploaderFiles").append(str);
		        $(".weui-uploader__info").html(res.localIds.length+'/9');

			  // 5.3 上传图片
				document.querySelector('#uploadImage').onclick = function () {
					if (images.localId.length == 0) {
					  alert('您还未选择照片！');
					  return;
					}
					var i = 0, length = images.localId.length;
					images.serverId = [];
					function upload() {
					  wx.uploadImage({
					    localId: images.localId[i],
					    success: function (res) {

					    	var contract_id = $("#contract_id").val();
					    	var referer = $("#referer").val();
							$.ajax({
							   type: "POST",
							   url: "/wechat/salescontrol/uploadmedia",
							   data: {serverId:res.serverId,contract_id:contract_id},
							   success: function(msg){
							     if(msg==1){
							     	alert('失败')
							     }else{
							     	i++;
								    //alert('已上传：' + i + '/' + length);
								    images.serverId.push(res.serverId);
								    
								    if (i < length) {
								    	upload();
								    }else{
								    	$("#toast").show();
								    	window.location.href=referer;
								    }
							     	
							     }
							   },
							   error: function(XMLHttpRequest, textStatus, errorThrown) {
								 // alert(XMLHttpRequest.status);
								 // alert(XMLHttpRequest.readyState);
								 // alert(textStatus);
							   },
							});

						    


					    },
					    fail: function (res) {
					      alert(JSON.stringify(res));
					    }
					  });
					}
					upload();

				};

		    }
		});

	}







	
	 
	</script>
	

</html>
