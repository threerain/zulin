<!doctype html>
<html>
<style media="screen">
.select2-choice{
								height: 35px !important;

							}
</style>
	<head>
		<meta charset="UTF-8">
		<title>客户跟进</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
		<link href="/css/wechat/css/main.css" rel="stylesheet" />
		<!-- <link href="/css/wechat/css/mobiscroll_002.css" rel="stylesheet" type="text/css">
		<link href="/css/wechat/css/mobiscroll.css" rel="stylesheet" type="text/css">
		<link href="/css/wechat/css/mobiscroll_003.css" rel="stylesheet" type="text/css"> -->
		<?php //css
		  //<!-- BEGIN PAGE LEVEL STYLES -->
		  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
		  //<!-- END PAGE LEVEL STYLES -->
		?>

		<?php //script
		  //<!-- BEGIN PAGE LEVEL PLUGINS -->
		  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
		  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
		  Yii::app()->clientScript->registerScript("","
		    FormComponents.init();
		    ");
		?>
		<style>
			.mui-table-view{margin-bottom:10px;}
			.mui-input-row{border:1px solid #ccc;margin-bottom:5px;border-radius:5px;}
		</style>
	</head>

	<body>
		<script src="/css/wechat/js/mui.min.js"></script>
		<!-- <script src="/css/wechat/js/jquery-3.0.0.js"></script> -->
		 <script src="/css/wechat/js/jquery-1.8.2.min.js"></script>
		<!-- <script src="/css/wechat/js/mobiscroll_002.js" type="text/javascript"></script>
		<script src="/css/wechat/js/mobiscroll_004.js" type="text/javascript"></script>
		<script src="/css/wechat/js/mobiscroll.js" type="text/javascript"></script>
		<script src="/css/wechat/js/mobiscroll_003.js" type="text/javascript"></script>
		<script src="/css/wechat/js/mobiscroll_005.js" type="text/javascript"></script> -->

		<script type="text/javascript">
			mui.init()
		</script>
		<div class="mui-content">
			<a href="/wechat/follow/myfollow/openid/<?php echo $openid?>"><button type="button" class="mui-btn mui-btn-blue mui-btn-outlined" style='margin-left:10px;'>我的跟进</button></a>
			<form action="/wechat/follow/add" method="post" onsubmit="return test()" enctype="multipart/form-data">
				<input type="hidden" name="openid" value="<?php echo $openid?>">
				<div class="mui-input-row">
				 <label>选择区域</label>
				 <select class="a" name="district">
						<option value=""  >请选择(必填)</option>
						<option value="1" >大望路慈云寺</option>
						<option value="2">朝阳门东直门</option>
						<option value="3">三里屯三元桥</option>
						<option value="4">CBD崇文门</option>
						<option value="5">CBD核心建国门</option>
					</select>
			 </div>
			 <div class="mui-input-row">
				<label>选择组团</label>
				<select  class="b" name="group" >
					 <option value="" >请选择(必填)</option>
					 <option value="1">第一组团</option>
					 <option value="2">第二组团</option>
					 <option value="3">第三组团</option>
				 </select>
			</div>

			     <p style='color:#333;font-size:20px;padding:10px;'>日汇总</p>

			    <div class="mui-input-row">
					<label>每日标识负责项目渠道</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="c" name="project_channel">
				</div>
			      <div class="mui-input-row">
					<label>每日标识负组团渠道</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="d" name="group_channel">
				</div>
				 <div class="mui-input-row">
					<label>每日标识区域渠道</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="e" name="estate_channel">
				</div>
				 <div class="mui-input-row">
					<label>每日标识大区目渠道</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="f" name="big_channel">
				</div>
				 <div class="mui-input-row">
					<label>每日标识其他渠道</label>
					<input type="number"  pattern="[0-9]*" pattern="[0-9]*" placeholder="请输入(必填)" class="g" name="other_channel">
				</div>
				 <div class="mui-input-row">
					<label>微信通讯录渠道总数</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="h" name="wechat_channel_num">
				</div>

			       <div class="mui-input-row">
					<label>每日添加新增渠道数量</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="i" name="new_channel_num">
				</div>
				 <div class="mui-input-row">
					<label>每日电话咨询量</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="j" name="phone_num">
				</div>
				 <div class="mui-input-row">
					<label>今日首次带看量汇总</label>
					<input type="number"  pattern="[0-9]*"placeholder="请输入(必填)" class="k" name="look_one_num">
				</div>
				 <div class="mui-input-row">
					<label>今日复看带看量汇总</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="l" name="look_two_num">
				</div>
				 <div class="mui-input-row">
					<label>今日约见面积汇总</label>
					<input type="text" placeholder="请输入(必填)" class="m" name="meet_area_num">
				</div>
				 <div class="mui-input-row">
					<label>今日约见套数汇总</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="n" name="meet_muit_num">
				</div>
			       <div class="mui-input-row">
					<label>今日意向客户</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)" class="o" name="client">
				</div>
				 <div class="mui-input-row">
					<label>签约面积</label>
					<input type="text" placeholder="请输入(必填)" class="p" name="sign_area">
				</div>
				 <div class="mui-input-row">
					<label>签约套数</label>
					<input type="number"  pattern="[0-9]*" placeholder="请输入(必填)"  maxlength="8" class="q" name="sign_muit">
				</div>
				 <div class="mui-input-row">
					<label>销售渠道微信标识截图</label>
					<input type="file" placeholder="普通输入框"  name="url" >
				</div>
				<div class="dellhydropower " id="follow">
					<div style='color:#333;font-size:20px;padding:10px;' class="hah">客户跟进</div>

				<div class="mui-input-row">
					<label>品牌</label>
					<input type="text" placeholder="请输入(必填)" data=''; class="t" name="estate_name[]">
					<input type="hidden"  name="estate[]">
				</div>
				<ul class="mui-table-view searchResult_estate" style="display:none;">
				</ul>
				<script>
					$(function(){
						function getResult(liyuequn){

							var value = liyuequn.find("input[name='estate_name[]']").val();

							$.post('/wechat/property/estate',{estate:value},function(msg){
								var str ='';
								for (var i = msg.length - 1; i >= 0; i--) {
									str += '<li class="mui-table-view-cell estate_list" id="'+msg[i]['estate_id']+'">'+msg[i]['name']+'</li>' 
								}
								liyuequn.find(".searchResult_estate").html(str);
								liyuequn.find(".estate_list").click(function(){
									
									liyuequn.find(".searchResult_estate").hide();
									var name =$(this).html();
									liyuequn.find("input[name='estate_name[]']").val(name);
									var id =$(this).attr('id');
									liyuequn.find("input[name='estate[]']").val(id);
								})
							},'json')
						}
						$("input[name='estate_name[]']").on('input',function(){
							var liyuequn  = $(this).parent().parent();
							if(this.value.length){
								liyuequn.find('.searchResult_estate').show();
								getResult(liyuequn);
							}else{
								liyuequn.find(".searchResult_estate").hide();
							}
						})

					})
				</script>
				<div class="mui-input-row">
					<label>系列</label>
					<input type="text" placeholder="请输入(必填)" data=''; class="t" name="building_name[]">
					<input type="hidden"  name="building[]">
				</div>
				<ul class="mui-table-view searchResult_building" style="display:none;">
				</ul>
				<script>
					$(function(){
						function getResult(liyuequn){
							var value = liyuequn.find("input[name='building_name[]']").val();
							var estate_id = liyuequn.find("input[name='estate[]']").val();
							$.post('/wechat/property/building',{building:value,estate_id:estate_id},function(msg){
								var str ='';
								for (var i = msg.length - 1; i >= 0; i--) {
									str += '<li class="mui-table-view-cell building_list" id="'+msg[i]['building_id']+'">'+msg[i]['name']+'</li>' 
								}
								liyuequn.find(".searchResult_building").html(str);
								liyuequn.find(".building_list").click(function(){
									
									liyuequn.find(".searchResult_building").hide();
									var name =$(this).html();
									liyuequn.find("input[name='building_name[]']").val(name);
									var id =$(this).attr('id');
									liyuequn.find("input[name='building[]']").val(id);
								})

							},'json')

						}

						$("input[name='building_name[]']").on('input',function(){
							var liyuequn  = $(this).parent().parent();
							if(this.value.length){
								liyuequn.find(".searchResult_building").show();
								getResult(liyuequn);
							}else{
								liyuequn.find(".searchResult_building").hide();
							}
						})

					})
				</script>
				<div class="mui-input-row">
					<label>编号</label>
					<input type="text" placeholder="请输入(必填)" data=''; class="t" name="house_no_name[]">
					<input type="hidden"  name="property_id[]">
				</div>
				<ul class="mui-table-view searchResult_house_no" style="display:none;">
				</ul>
				<script>
					$(function(){
						function getResult(liyuequn){
							var value = liyuequn.find("input[name='house_no_name[]']").val();
							var estate_id = liyuequn.find("input[name='estate[]']").val();
							var building_id = liyuequn.find("input[name='building[]']").val();

							$.post('/wechat/property/house_no',{building_id:building_id,estate_id:estate_id,house_no:value},function(msg){
								var str ='';
								for (var i = msg.length - 1; i >= 0; i--) {
									str += '<li class="mui-table-view-cell house_no_list" id="'+msg[i]['house_no']+'">'+msg[i]['name']+'</li>' 
								}
								liyuequn.find(".searchResult_house_no").html(str);
								liyuequn.find(".house_no_list").click(function(){
									
									liyuequn.find(".searchResult_house_no").hide();
									var name =$(this).html();
									liyuequn.find("input[name='house_no_name[]']").val(name);
									var id =$(this).attr('id');
									liyuequn.find("input[name='property_id[]']").val(id);
									$.post('/wechat/property/area',{property_id:id},function(msg){
										liyuequn.find("input[name='area[]']").val(msg+'㎡');
									})
								})

							},'json')

						}

						$("input[name='house_no_name[]']").on('input',function(){
							var liyuequn  = $(this).parent().parent();
							if(this.value.length){
								liyuequn.find(".searchResult_house_no").show();
								getResult(liyuequn);
							}else{
								liyuequn.find(".searchResult_house_no").hide();
							}
						})

					})
				</script>
				<div class="mui-input-row">
					<label>面积</label>
					<input type="text" placeholder="㎡" class="t" disabled="true" name="area[]">
				</div>
				 <div class="mui-input-row">
					<label>经纪公司</label>
					<input type="text" placeholder="请输入(必填)" class="u" name="company[]">
				</div>
				 <div class="mui-input-row">
					<label>联系人</label>
					<input type="text" placeholder="请输入(必填)" class="v" name="linkman[]">
				</div>
				 <div class="mui-input-row">
					<label>电话</label>
					<input type="number"  pattern="[0-9]*" maxlength="11" placeholder="请输入(必填)" class="w" name="phone[]">
				</div>
						<div class="mui-input-row">
					<label>客户业态</label>
					<input type="text" placeholder="请输入(必填)" class="x" name="format[]">
				</div>
				 <div class="mui-input-row">
					<label>预算</label>
					<input type="text" placeholder="请输入(必填)" class="y" name="budget[]">
				</div>
				<div class="mui-input-row">
				 <label>是否二看(必填)</label>
				 <select class="z" name="two_see[]">
						<option value="" >请选择</option>
						<option value="1">是</option>
						<option value="2">否</option>
					</select>
			 </div>
				<div class="mui-input-row">
					<label>意向客户项目编号</label>
					<input type="text" placeholder="请输入(必填)" class="aa" name="house_no[]">
				</div>
				<div class="mui-input-row">
				 <label>是否负责人(必填)</label>
				 <select class="bb" name="prineinal[]">
						<option value="" >请选择</option>
						<option value="1">是</option>
						<option value="2">否</option>
					</select>
			 </div>
						 <div class="mui-input-row">
					<label>订房时间</label>
					<input type="text" placeholder="请输入(必填)"   name="order_time[]"  >
				</div>
				<!-- <script type="text/javascript">
							$(function () {
						var currYear = (new Date()).getFullYear();
						var opt={};
						opt.date = {preset : 'date'};
						opt.datetime = {preset : 'datetime'};
						opt.time = {preset : 'time'};
						opt.default = {
							theme: 'android-ics light', //皮肤样式
									display: 'modal', //显示方式
									mode: 'scroller', //日期选择模式
							dateFormat: 'yyyy-mm-dd',
							lang: 'zh',
							showNow: true,
							nowText: "今天",
									startYear: currYear - 10, //开始年份
									endYear: currYear + 10 //结束年份
						};

							$(".appDate").mobiscroll($.extend(opt['date'], opt['default']));

							});
					</script> -->
				 <div class="mui-input-row">
					<label>跟进情况</label>
					<input type="text" class="dd"  placeholder="请输入(必填)" name="follow_info[]">
				</div>
				 <div class="mui-input-row">
					<label>幼狮对接人</label>
					<input type="text" placeholder="请输入(必填)" class="ee" name="urs_people[]">
				</div>
				</div>
				<button type="button" class="mui-btn mui-btn-green mui-btn-block addser_hydropower">增加</button>
				<div class="mui-input-row">
				 <label>备注</label>
			 </div>
				<textarea rows="3"></textarea>
		     	<button type="submit" class="mui-btn mui-btn-blue mui-btn-block">提交</button>
		 </form>

		</div>
		<script type="text/javascript">
				function test() {
					var a = document.getElementsByClassName("a");
								if(a[0].value == '') {
										mui.toast("所选区域不能为空");
										return false;
								}
					var b = document.getElementsByClassName("b");
								if(b[0].value == '') {
										mui.toast("所选组团不能为空");
										return false;
								}
					var c = document.getElementsByClassName("c");
								if(c[0].value == '') {
										mui.toast("每日标识负责项目渠道不能为空");
										return false;
								}
					var d = document.getElementsByClassName("d");
								if(d[0].value == '') {
										mui.toast("每日标识负责组团渠道不能为空");
										return false;
								}
					var e = document.getElementsByClassName("e");
								if(e[0].value == '') {
										mui.toast("每日标识区域渠道不能为空");
										return false;
								}
					var f = document.getElementsByClassName("f");
								if(f[0].value == '') {
										mui.toast("每日标识大区目渠道不能为空");
										return false;
								}
					var g = document.getElementsByClassName("g");
								if(g[0].value == '') {
										mui.toast("每日标识其它渠道不能为空");
										return false;
								}
					var h = document.getElementsByClassName("h");
								if(h[0].value == '') {
										mui.toast("每日添加新增渠道数量不能为空");
										return false;
								}
					var i = document.getElementsByClassName("i");
								if(i[0].value == '') {
										mui.toast("每日电话咨询量不能为空");
										return false;
								}
					var j = document.getElementsByClassName("j");
								if(j[0].value == '') {
										mui.toast("今日首次带看量汇总不能为空");
										return false;
								}
					var k = document.getElementsByClassName("k");
								if(k[0].value == '') {
										mui.toast("今日复看带看量汇总不能为空");
										return false;
								}
					var l = document.getElementsByClassName("l");
								if(l[0].value == '') {
										mui.toast("今日约见面积汇总不能为空");
										return false;
								}
					var m = document.getElementsByClassName("m");
								if(m[0].value == '') {
										mui.toast("今日约见套数汇总不能为空");
										return false;
								}
					var o = document.getElementsByClassName("o");
								if(o[0].value == '') {
										mui.toast("今日意向客户不能为空");
										return false;
								}
					var p = document.getElementsByClassName("p");
								if(p[0].value == '') {
										mui.toast("签约面积不能为空");
										return false;
								}
					var q = document.getElementsByClassName("q");
								if(q[0].value == '') {
										mui.toast("签约套数不能为空");
										return false;
								}
					var r = document.getElementsByClassName("r");
								if(r[0].value == '') {
										mui.toast("今日约见套数汇总不能为空");
										return false;
								}
					var s = document.getElementsByClassName("s");
								for(var i=0;i<s.length;i++) {
									if(s[i].value == '') {
											mui.toast("品牌不能为空");
											return false;
									}
								}

					var t = document.getElementsByClassName("t");
									for(var i=0;i<t.length;i++) {
										if(t[i].value == '') {
												mui.toast("面积不能为空");
												return false;
										}
									}

					var u = document.getElementsByClassName("u");
								for(var i=0;i<u.length;i++) {
									if(u[i].value == '') {
											mui.toast("经纪公司不能为空");
											return false;
									}
								}

					var v = document.getElementsByClassName("v");
								for(var i=0;i<v.length;i++) {
									if(v[i].value == '') {
											mui.toast("联系人不能为空");
											return false;
									}
								}

					var w = document.getElementsByClassName("w");
								for(var i=0;i<w.length;i++) {
									if(w[i].value == '') {
											mui.toast("电话不能为空");
											return false;
									}
								}

					var x = document.getElementsByClassName("x");
								for(var i=0;i<x.length;i++) {
									if(x[i].value == '') {
											mui.toast("客户业态不能为空");
											return false;
									}
								}

					var y = document.getElementsByClassName("y");
								for(var i=0;i<y.length;i++) {
									if(y[i].value == '') {
											mui.toast("预算不能为空");
											return false;
									}
								}

					var z = document.getElementsByClassName("z");
								for(var i=0;i<z.length;i++) {
									if(z[i].value == '') {
											mui.toast("是否二看不能为空");
											return false;
									}
								}

					var aa = document.getElementsByClassName("aa");
								for(var i=0;i<aa.length;i++) {
									if(aa[i].value == '') {
											mui.toast("意向租户项目编号不能为空");
											return false;
									}
								}

					var bb = document.getElementsByClassName("bb");
								for(var i=0;i<bb.length;i++) {
									if(bb[i].value == '') {
											mui.toast("是否负责人不能为空");
											return false;
									}
								}

					var cc = document.getElementsByClassName("cc");
								for(var i=0;i<cc.length;i++) {
									if(cc[i].value == '') {
											mui.toast("订房时间不能为空");
											return false;
									}
								}

					var dd = document.getElementsByClassName("dd");
								for(var i=0;i<dd.length;i++) {
									if(dd[i].value == '') {
											mui.toast("跟进情况不能为空");
											return false;
									}
								}

					var ee = document.getElementsByClassName("ee");
								for(var i=0;i<ee.length;i++) {
									if(ee[i].value == '') {
											mui.toast("幼狮对接人不能为空");
											return false;
									}
								}
							}

		</script>
		<script type="text/javascript">
			//添加
			$(".addser_hydropower").click(function(){

			//  var newdom = document.getElementsByClassName("kong");
			// 	for(var i=0;i<newdom.length;i++){
			// 		$(newdom[i]).addClass('model');
			// 	}

				//
				// mores =$("#follow").clone();
				// mores.show();
				// mores.addClass('moreser_hydropower');
				// mores.removeAttr('id');
				// mores.css("float",'none');
				// $('.dellhydropower').after(mores)
				var len = $(".dellhydropower").length;
				console.log(len);
				mores = $("#follow").clone();
				mores.find("input").val('');
				$(".dellhydropower").eq(len-1).after(mores);
				$(".hah").eq(len).html("客户跟进("+len+")<a class='delser_hydropower' style='float:right;cursor: pointer'>删除</a>");
			})
			//删除
		$(".delser_hydropower").live('click',function(){
			//
			// var newdom = document.getElementsByClassName("model");
			//  for(var i=0;i<newdom.length;i++){
			//
			// 	 $(newdom[i]).removeClass('model');
			//
			//  }
					 $(this).parents(".dellhydropower").remove();
			})



		</script>
	</body>

</html>
