<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>销售销控管理</title>
    <script src="/css/wechat/js/mui.min.js"></script>
    <link href="/css/wechat/css/mui.min.css" rel="stylesheet"/>
    <link type="text/css" rel="stylesheet" href="/css/wechat/css/demo.css">
    <script src="/css/wechat/js/jquery-1.8.2.min.js"></script>
    <script src="/css/wechat/js/demo.js"></script>
    <script type="text/javascript" charset="utf-8">
      	mui.init();
    </script>
    <style>
      a{
        display:block;
        color:#4F4F4F;
      }
		    p {
		    font-size: 14px;
		    margin-top: 0;
		    margin-bottom: 8px;
		    color: #8f8f94;
		}
    li:first-child{border:0!important;}
   		 .content{padding:10px;overflow:hidden;border-top:1px solid #aaa;}
    	.pic{float:left;width:30%}
    	.pic img{width:120px;height:80px;}
    	.text{text-align:left;float:left;padding-left:20px;width:60%}
    	.text p{color:#333;}
    	.onetext{margin-left:20px;color:#f00;}
    	.threetext{margin-left:30px;color:#00f;}
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
</head>
<body>
	<header class="mui-bar mui-bar-nav">
    <form class="" action="/wechat/salescontrol/index" method="post">
      <div class="search">
      <span class="s_con"><input type="text" class="content" name='keyword_estate' value="<?php echo $estate?>" placeholder="请输入品牌名称"><i class="clear"></i></span>
      <button type="submit" class="mui-btn mui-btn-blue s_btn">搜索</button>
    </div>
  </form>
  </header>

	<div class="mui-content">
    <!-- screening -->
    <div class="screening">
        <ul>
            <li class="Sort"><span>商圈</span></li>
            <li class="Brand"><span>项目类型</span></li>
            <li class="meishi"><span>单价</span></li>
            <li class="Regional" id='order'><span>面积</span></li>
        </ul>
    </div>
    <!-- End screening -->

    <!--排序-->
    <div class="grade-eject">
        <ul class="grade-w" id="gradew">
          <li></li>
          <li> <a href="/wechat/salescontrol/index/">不限</a></li>
          <li> <a href="/wechat/salescontrol/index/order/area1">100㎡以下</a></li>
          <li> <a href="/wechat/salescontrol/index/order/area2">100㎡以上-150㎡以下</a></li>
          <li> <a href="/wechat/salescontrol/index/order/area3">150㎡以上-200㎡以下</a></li>
          <li> <a href="/wechat/salescontrol/index/order/area4">200㎡以上-300㎡以下</a></li>
          <li> <a href="/wechat/salescontrol/index/order/area5">300㎡以上-500㎡以下</a></li>
          <li> <a href="/wechat/salescontrol/index/order/area6">500㎡以上-1000㎡以下</a></li>
          <li> <a href="/wechat/salescontrol/index/order/area7">1000㎡以上</a></li>
        </ul>
    </div>
    <!-- End 排序 -->
    <script type="text/javascript">



    </script>
    <!-- 商圈-->
    <div class="Sort-eject Sort-height">
        <ul class="Sort-Sort" id="Sort-Sort">
            <li></li>
              <li> <a href="/wechat/salescontrol/index/">不限</li></a>
              <li> <a href="/wechat/salescontrol/index/order/1">大望路慈云寺</a></li>
              <li> <a href="/wechat/salescontrol/index/order/2">三里屯三元桥</a></li>
              <li> <a href="/wechat/salescontrol/index/order/3">朝阳门东直门</a></li>
              <li> <a href="/wechat/salescontrol/index/order/4">CBD南崇文门</a></li>
              <li> <a href="/wechat/salescontrol/index/order/5">CBD核心建国门</a></li>
        </ul>
    </div>

    <!--项目类型-->
    <div class="Category-eject">
        <ul class="Category-w" id="Categorytw">
            <li></li>
            <li> <a href="/wechat/salescontrol/index">不限</li></a>
            <li> <a href="/wechat/salescontrol/index/order/6">轿车</a></li>
            <li> <a href="/wechat/salescontrol/index/order/7">客车</a></li>
            <li> <a href="/wechat/salescontrol/index/order/8">SUV</a></li>
            <li> <a href="/wechat/salescontrol/index/order/9">商务</a></li>
            <li> <a href="/wechat/salescontrol/index/order/10">商务</a></li>
        </ul>
    </div>
    <!-- End 专业 -->

    <!-- 更多 -->
    <div class="meishi22">
        <ul class="meishia-w" id="meishia">
            <li></li>
            <li> <a href="/wechat/salescontrol/index">不限</a></li>
            <li> <a href="/wechat/salescontrol/index/order/11">3-4/㎡/天</a></li>
            <li> <a href="/wechat/salescontrol/index/order/12">4-5/㎡/天</a></li>
            <li> <a href="/wechat/salescontrol/index/order/13">5-6/㎡/天</a></li>
            <li> <a href="/wechat/salescontrol/index/order/14">6-8/㎡/天</a></li>
            <li> <a href="/wechat/salescontrol/index/order/15">8-10/㎡/天</a></li>
            <li> <a href="/wechat/salescontrol/index/order/16">10元以上</a></li>
        </ul>
        <!-- <ul class="meishia-t" id="meishib">
            <li onclick="meishib(this)"><a href="#">地质学</a> </li>
            <li onclick="meishib(this)"><a href="#">临床医学  </a></li>
            <li onclick="meishib(this)"><a href="#">工商管理</a> </li>
            <li onclick="meishib(this)"><a href="#">生物学 </a></li>
            <li onclick="meishib(this)"><a href="#">材料科学与工程 </a></li>
        </ul> -->
    </div>
    <!-- <div style="height:3rem">

    </div> -->
    <!-- 遍历出销售销控里面的车源信息 -->

    <?php if($model) {
          echo $username;
          foreach($model as $k=>$v) {?>
          <a href="/wechat/salescontrol/details/id/<?php echo $v->property_id ?>/contract_id/<?php echo $v->contract_id?>/openid/<?php echo $openid?>"><div class='content'>
              <div class="pic">
                <?php  if($v->url!=null) {

                          $url = explode(',',$v->url);?>
                          <img src="<?php echo $url[0]?>">
        <?php

        }else{?>

          <img src="/css/image/urs.jpg">

          <?php    }

                ?>
              </div>
              <!-- 商圈 -->
              <div class="text">
                <p class='one'><?php
                            $area = CmsProperty::model()->find("id='$v->property_id'");
                            $name = BaseArea::model()->find("id='$area->area_id'");
                            echo $name->name;
                ?><span class='onetext'><?php

                $mode=CmsPurchaseContract::model()->find("id='$v->contract_id' and deleted=0 and status=0");
                $time = time();
                if($v->sales_type!=null) {
                  if(($v->live_date+9*24*60*60-$time)>=0){echo '荣誉房';}else if(($v->live_date+20*24*60*60-$time)>=0 &&($v->live_date+9*24*60*60-$time)<=0 ){ echo '快销房';}else if(($v->live_date+35*24*60*60-$time)>=0 &&($v->live_date+20*24*60*60-$time)<=0 ){ echo '风险房';}else if(($v->live_date+35*24*60*60-$time)<=0){ echo '亏损房';}

                }else  {
                  if(($mode->lease_term_start_real+9*24*60*60-$time)>=0){echo '荣誉房';}else if(($mode->lease_term_start_real+20*24*60*60-$time)>=0 &&($mode->lease_term_start_real+9*24*60*60-$time)<=0 ){ echo '快销房';}else if(($mode->lease_term_start_real+35*24*60*60-$time)>=0 &&($mode->lease_term_start_real+20*24*60*60-$time)<=0 ){ echo '风险房';}else if(($mode->lease_term_start_real+35*24*60*60-$time)<=0){ echo '亏损房';}

                }
                ?></span></p>
                <!-- 品牌 系列 编号 -->
                <p class='two'><?php
                            $area = CmsProperty::model()->find("id='$v->property_id'");
                            $estate = BaseEstate::model()->find("id='$area->estate_id'");
                            echo $estate->name.'&nbsp';
                            $name = BaseBuilding::model()->find("id='$area->building_id'");
                            echo $name->name."&nbsp";
                            echo $area->house_no;
                ?></span></p>
                <p class='three'><span><?php
                            $area = CmsProperty::model()->find("id='$v->property_id'");
                            echo $area->area.'㎡';
                ?></span><span class='threetext'><?php echo $v->unit_price/100?>元/㎡/天</span></p>
              </div>
            </div></a>

    <?php
       }
    }?>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery-3.0.0.js" ></script>
		<script type="text/javascript">
			$('.content').on('keyup',function(){
				$('.clear').show();
			});
			$('.clear').click(function(){
				$('.content').val('');
			});
		</script>
</body>
</html>
