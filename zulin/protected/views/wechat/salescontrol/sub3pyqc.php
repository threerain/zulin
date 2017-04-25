<!doctype html>
<html>

	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/css/wechat/css/mui.min.css" rel="stylesheet" />
	</head>

	<body>
		<!--下拉刷新的代码容器-->
		<div id="refreshContainer" class="mui-content mui-scroll-wrapper">
		  <div class="mui-scroll">

		    <!--数据列表 ajix添加的-->
		    <ul class="mui-table-view">
		        <li class="mui-table-view-cell mui-media">

		                <img class="mui-media-object mui-pull-left" src="img/1.jpg">
		                <div class="mui-media-body">
		                    幸福1
		                    <p class="mui-ellipsis">能和心爱的人一起睡觉，是件幸福的事情；可是，打呼噜怎么办？</p>
		                </div>

		        </li>
		        <li class="mui-table-view-cell mui-media">

		                <img class="mui-media-object mui-pull-left" src="img/10.jpg">
		                <div class="mui-media-body">
		                    木屋
		                    <p class="mui-ellipsis">想要这样一间小木屋，夏天挫冰吃瓜，冬天围炉取暖.</p>
		                </div>

		        </li>
		        <li class="mui-table-view-cell mui-media">

		                <img class="mui-media-object mui-pull-left" src="img/12.jpg">
		                <div class="mui-media-body">
		                    CBD
		                    <p class="mui-ellipsis">烤炉模式的城，到黄昏，如同打翻的调色盘一般.</p>
		                </div>

		        </li>
		    </ul>


		  </div>
		</div>

		<script src="js/mui.min.js"></script>
		<script type="text/javascript">
			mui.init({
				//下拉刷新
				pullRefresh:{
					//下拉上啦的容器
					container:"#refreshContainer",
					//下拉加载down
					down:{
						//可选择 也可以不配置 前三有默认的信息，可以不做任何修改 必填的配置是callback
						contentdown:"下拉可以刷新",
						contentover:'释放立即刷新',
						contentrefresh:"正在刷新...",
						callback:pulldownRefrech
					},
					//上啦加载更多的方法
					up:{

						callback:pulluprefretch
					}

				}


				}

		);

			function pulldownRefrech(){

				setTimeout(function(){
					var table=document.querySelector('.mui-table-view');
				for(var i=0;i<3;i++){
					var li=document.createElement('li');
					li.className="mui-table-view-cell mui-media";
					var str="";
					str+="<img class='mui-media-object mui-pull-left' src='img/12.jpg'>";
					str+="<div class='mui-media-body'>";
					str+="CBD";
					str+="<p class='mui-ellipsis'>烤炉模式的城，到黄昏，如同打翻的调色盘一般.</p>";
		            str+="</div>";
		            li.innerHTML=str;

		            //追加 1新的子节点 2关联节点,在那个节点加入
		            table.insertBefore(li,table.firstChild);

				}
				//加载内容追加之后 需要添加 这个 是数据像上面弹回去
				mui("#refreshContainer").pullRefresh().endPulldownToRefresh();

				},1500);

				//function放在延时器的里面 起到刷新的作用 不管数据是否加载的更多 都可以是有很好的的体验。
			}

			//上啦记载更多 和相似下拉


			function pulluprefretch(){

				setTimeout(function(){
					var table=document.querySelector('.mui-table-view');
				for(var i=0;i<3;i++){
					var li=document.createElement('li');
					li.className="mui-table-view-cell mui-media";
					var str="";
					str+="<img class='mui-media-object mui-pull-left' src='img/12.jpg'>";
					str+="<div class='mui-media-body'>";
					str+="CBD";
					str+="<p class='mui-ellipsis'>烤炉模式的城，到黄昏，如同打翻的调色盘一般.</p>";
		            str+="</div>";
		            li.innerHTML=str;

		            //追加 最后的节点后面
		            table.appendChild(li);

				}
				//加载内容 停止上啦动画
				mui("#refreshContainer").pullRefresh().endPullupToRefresh();

				},1500);

				//function放在延时器的里面 起到刷新的作用 不管数据是否加载的更多 都可以是有很好的的体验。
			}

			//下拉刷新 绝大部门在list页面展开
		</script>
	</body>

</html>
