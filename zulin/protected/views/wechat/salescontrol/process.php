<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
		<style>
			.mui-table-view{margin-bottom:10px;}
			.mui-input-row{border:1px solid #ccc;margin-bottom:5px;border-radius:5px;}
		</style>
	</head>

	<body>
		<script src="/css/wechat/js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init()
		</script>
		<header class="mui-bar mui-bar-nav">
		    <a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
		    <h1 class="mui-title">写跟进</h1>
		</header>
		<div class="mui-content">
			<form>
				<ul class="mui-table-view">
			        <li class="mui-table-view-cell">
			            <a class="mui-navigate-right" href="#sheet" id="openSheet" >
			               选择区域
			            </a>
			        </li>
			   </ul>
			   	<ul class="mui-table-view">
			    <li class="mui-table-view-cell">
			            <a class="mui-navigate-right" href="#sheet1" id="openSheet" >
			              选择组团
			            </a>
			        </li>
			      </ul>


			     <p style='color:#333;font-size:20px;padding:10px;'>日汇总</p>

			    <div class="mui-input-row">
					<label>每日标识负责项目渠道</label>
					<input type="text" placeholder="普通输入框">
				</div>
			      <div class="mui-input-row">
					<label>每日标识负组团渠道</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>每日标识区域渠道</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>每日标识大区目渠道</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>每日标识其他渠道</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>微信通讯录渠道总数</label>
					<input type="text" placeholder="普通输入框">
				</div>

			       <div class="mui-input-row">
					<label>每日添加新增渠道数量</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>每日电话咨询量</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>今日首次带看量汇总</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>今日复看带看量汇总</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>今日约见面积汇总</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>今日约见套数汇总</label>
					<input type="text" placeholder="普通输入框">
				</div>
			       <div class="mui-input-row">
					<label>今日意向客户</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>签约面积</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>签约套数</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>销售渠道微信标识截图</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>今日约见套数汇总</label>
					<input type="text" placeholder="普通输入框">
				</div>






			    <p style='color:#333;font-size:20px;padding:10px;'>客户跟进</p>


			       <div class="mui-input-row">
					<label>面积</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>经纪公司</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>联系人</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>电话</label>
					<input type="text" placeholder="普通输入框">
				</div>
			      <div class="mui-input-row">
					<label>客户状态</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>预算</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 	<ul class="mui-table-view">
					    <li class="mui-table-view-cell">
					            <a class="mui-navigate-right" href="#sheet3" id="openSheet" >
					              是否二看
					            </a>
			        </li>
			      </ul>
			       <div class="mui-input-row">
					<label>意向客户项目编号</label>
					<input type="text" placeholder="普通输入框">
				</div>
					<ul class="mui-table-view">
					    <li class="mui-table-view-cell">
					            <a class="mui-navigate-right" href="#sheet4" id="openSheet" >
					              是否负责任
					            </a>
			        </li>
			      </ul>
			       <div class="mui-input-row">
					<label>订房时间</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>跟进情况</label>
					<input type="text" placeholder="普通输入框">
				</div>
				 <div class="mui-input-row">
					<label>幼狮对接人</label>
					<input type="text" placeholder="普通输入框">
				</div>
				<button type="button" class="mui-btn mui-btn-grey mui-btn-block">增加</button>
				<textarea rows="10"></textarea>
		</form>











		    <div id="sheet" class="mui-popover mui-popover-bottom mui-popover-action ">
		        <!-- 可选择菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#">菜单1</a>
		          </li>
		          <li class="mui-table-view-cell">
		            <a href="#">菜单2</a>
		          </li>
		        </ul>
		        <!-- 取消菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#sheet"><b>取消</b></a>
		          </li>
		        </ul>
		    </div>
		     <div id="sheet1" class="mui-popover mui-popover-bottom mui-popover-action ">
		        <!-- 可选择菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#">菜单1</a>
		          </li>
		          <li class="mui-table-view-cell">
		            <a href="#">菜单2</a>
		          </li>
		        </ul>
		        <!-- 取消菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#sheet1"><b>取消</b></a>
		          </li>
		        </ul>
		    </div>

		     <div id="sheet3" class="mui-popover mui-popover-bottom mui-popover-action ">
		        <!-- 可选择菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#">菜单1</a>
		          </li>
		          <li class="mui-table-view-cell">
		            <a href="#">菜单2</a>
		          </li>
		        </ul>
		        <!-- 取消菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#sheet3"><b>取消</b></a>
		          </li>
		        </ul>
		    </div>

		      <div id="sheet4" class="mui-popover mui-popover-bottom mui-popover-action ">
		        <!-- 可选择菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#">菜单1</a>
		          </li>
		          <li class="mui-table-view-cell">
		            <a href="#">菜单2</a>
		          </li>
		        </ul>
		        <!-- 取消菜单 -->
		        <ul class="mui-table-view">
		          <li class="mui-table-view-cell">
		            <a href="#sheet4"><b>取消</b></a>
		          </li>
		        </ul>
		    </div>
		</div>
	</body>

</html>
