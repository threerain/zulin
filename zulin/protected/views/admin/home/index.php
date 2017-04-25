<style>
/*取消返回列表的主页显示*/
  #jqaddlink{display:none!important;}
  #indextop{padding-left:50px;}
  #admin{margin-left:40px;font-size:18px;}
  /*轮播图效果的样式*/
  #indexcontent{margin-left:50px;margin-top:10px;}

  #list {height: 400px; position: absolute; z-index: 1;}
  #list img { float: left;}
  .carousel-control{display:inline-block!important;width:40px;height:40px;text-align:center;line-height:21px!important;margin-top:20px!important;}
  /*center有部分样式*/

  .informtop{
  height: 40px;
  overflow: hidden;  
  font-size: 20px;
  line-height: 40px;
  padding-left: 30px;
  background-image: -moz-linear-gradient(top, #167AC7,#167AC7); 
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #167AC7), color-stop(1, #167AC7)); 
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8fa1ff', endColorstr='#f05e6f', GradientType='0'); 
  border: 1px solid #167AC7;
  -moz-border-radius: 8px 8px 0 0;    
  -webkit-border-radius: 8px 8px 0 0;   
  border-radius: 8px 8px 0 0;
  color: #fff;
  position: relative;
  }
  .informtop a {
  position: absolute;
  right: 10px;
  bottom: 10px;
  display: inline;
  color: #fff;
  font-size: 12px;
  line-height: 24px;
}


   .informmiddle{height:230px;overflow:hidden;}
   .informmiddle ul{margin-top:20px;}
   .informmiddle li{list-style-type:none;margin-left:-20px;margin-bottom:10px;border-bottom:1px dotted #aaa;}
   .informmiddle li span{float:right;margin-right:30px;color:#666;}

  .informbottom{border-top:1px solid #aaa;height:100px;overflow:hidden;margin-top:10px;padding-left:20px;padding-right:20px;}
  .informbottom h4{text-align:center;}
  .informbottom h6{text-indent:2em;color:#222;}

  /*即时信息开始*/
  #message{width:35%;height:400px;border:1PX solid #aaa;border-radius:15px 15px 0 0;float:left;margin-left:30px;overflow:hidden;}

/*  .informmiddle2{height:400px;overflow:hidden;}
   .informmiddle2 ul{margin-top:20px;}
   .informmiddle2 li{list-style-type:none;margin-left:-20px;margin-bottom:10px;border-bottom:1px dotted #aaa;}
   .informmiddle2 li span{float:right;margin-right:30px;color:#666;}*/

   ul {
  list-style: none;   
}
a img {
  border: none;        
}
a {
  color: #333;
  text-decoration: none;    
}
a:hover {
  color: #ff0000;
}
#mooc {
  width: 100%;
  -moz-border-radius: 15px;     
  -webkit-border-radius: 15px;   
  border-radius: 15px;
  box-shadow: 2px 2px 10px #ababab;
  margin: 50px auto 0;
  text-align: left;             
}
/*  头部样式 */ 
#moocTitle {
  margin-top:-50px;
  height: 40px;
  overflow: hidden;  
  font-size: 20px;
  line-height: 40px;
  padding-left: 30px;
  background-image: -moz-linear-gradient(top, #167AC7,#167AC7); 
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #167AC7), color-stop(1, #167AC7)); 
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8fa1ff', endColorstr='#f05e6f', GradientType='0'); 
  border: 1px solid #167AC7;
  -moz-border-radius: 8px 8px 0 0;    
  -webkit-border-radius: 8px 8px 0 0;   
  border-radius: 8px 8px 0 0;
  color: #fff;
  position: relative;
}
#moocTitle a {
  position: absolute;
  right: 10px;
  bottom: 10px;
  display: inline;
  color: #fff;
  font-size: 12px;
  line-height: 24px;
}

#moocBot {
  width: 399px;
  height: 10px;
  overflow: hidden;     
}
/*  中间样式 */
#moocBox {
  height:400px;
  margin-top: 10px;  
}
#mooc ul li {
  height: 24px;
  margin-bottom:10px;
}
#mooc ul li a {
  float: left;
  display: block;
  height: 24px;
}
#mooc ul li span {
  float: right;
  color: #999;
}


/*2*/
#mooc2 {
  width: 100%;
  -moz-border-radius: 15px;     
  -webkit-border-radius: 15px;   
  border-radius: 15px;
  box-shadow: 2px 2px 10px #ababab;
  margin: 50px auto 0;
  text-align: left;             
}
/*  头部样式 */ 
#moocTitle2 {
  margin-top:-50px;
  height: 40px;
  overflow: hidden;  
  font-size: 20px;
  line-height: 40px;
  padding-left: 30px;
  background-image: -moz-linear-gradient(top, #167AC7,#167AC7); 
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #167AC7), color-stop(1, #167AC7)); 
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8fa1ff', endColorstr='#f05e6f', GradientType='0'); 
  border: 1px solid #167AC7;
  -moz-border-radius: 8px 8px 0 0;    
  -webkit-border-radius: 8px 8px 0 0;   
  border-radius: 8px 8px 0 0;
  color: #fff;
  position: relative;
}
#moocTitle2 a {
  position: absolute;
  right: 10px;
  bottom: 10px;
  display: inline;
  color: #fff;
  font-size: 12px;
  line-height: 24px;
}

#moocBot2 {
  height: 10px;
  overflow: hidden;     
}
/*  中间样式 */
#moocBox2 {
  height:400px;
  margin-top: 10px;
  overflow: hidden;   
}
#mooc2 ul li {
  height: 24px;
  margin-bottom:10px;
}
#mooc2 ul li a {
  float: left;
  display: block;
  overflow: hidden;
  height: 24px;
}
#mooc2 ul li span {
  float: right;
  color: #999;
}

/*3*/
#mooc3 {
  width: 100%;
  -moz-border-radius: 15px;     
  -webkit-border-radius: 15px;   
  border-radius: 15px;
  box-shadow: 2px 2px 10px #ababab;
  margin: 50px auto 0;
  text-align: left;             
}
/*  头部样式 */ 
#moocTitle3 {
  margin-top:-50px;
  height: 40px;
  overflow: hidden;  
  font-size:20px;
  line-height: 40px;
  padding-left: 30px;
   background-image: -moz-linear-gradient(top, #167AC7,#167AC7); 
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #167AC7), color-stop(1, #167AC7)); 
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#8fa1ff', endColorstr='#f05e6f', GradientType='0'); 
  border: 1px solid #167AC7;
  -moz-border-radius: 8px 8px 0 0;    
  -webkit-border-radius: 8px 8px 0 0;   
  border-radius: 8px 8px 0 0;
  color: #fff;
  position: relative;
}
#moocTitle3 a {
  position: absolute;
  right: 10px;
  bottom: 10px;
  display: inline;
  color: #fff;
  font-size: 12px;
  line-height: 24px;
}

#moocBot3 {
  height: 10px;
  overflow: hidden;     
}
/*  中间样式 */
#moocBox3 {
  height:400px;
  margin-top: 10px;
  overflow: hidden;   
}
#mooc3 ul li {
  height: 24px;
  margin-bottom:10px;
}
#mooc3 ul li a {
  float: left;
  display: block;
  height: 24px;
}
#mooc3 ul li span {
  float: right;
  color: #999;
}

    #container { width: 42%; height:450px;  margin-left:5%;position: relative;float:left;}
    #container .item{}
    #container img{width:100%;float:left;height:450px!important;}
    #conpanyinform{width:40%;height:456px;border:1PX solid #aaa;float:left;margin-left:32px;border-radius:15px 15px 0px 0px;}
    /*底部开始阶段*/
    #footer{height:350px;clear:both;margin-top:480px; margin-left:5%;}
    .footerleft{width:40.4%;border:1px;height:390px;overflow:hidden;float:left;margin-left:30px;float:left;margin-top:50px;}
    .footerright{width:43%;border:1px;height:390px;overflow:hidden;float:left;margin-left:51px;margin-top:50px;}
</style>
<?php //css
  //<!-- BEGIN PAGE LEVEL STYLES -->
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


  Yii::app()->clientScript->registerScript("","
    App.init();
    ");//TableManaged.init();
?>

<div class="page-content">
	<!-- BEGIN PAGE CONTAINER-->        
	<div class="container-fluid">
		<!-- BEGIN PAGE HEADER-->
		<div class="row-fluid" style="min-height:400px;border:2px solid #222" >
    <!-- 头部信息 -->
          <div id="indextop">
                <iframe name="weather_inc" src="http://i.tianqi.com/index.php?c=code&id=8" style="border:solid 1px transparent;float:left;margin-right:100px;vertical-align:middle;" width="225" height="90" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
                <div style="float:right;margin-right:100px;">
                    <h5 id="timecontent" style="text-align:right"></h5>
                </div>
               <!-- <iframe name="weather_inc" src="http://i.tianqi.com/index.php?c=code&id=7" style="border:solid 1px transparent;float:left;margin-right:100px;vertical-align:middle;" width="225" height="90" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe> -->
          </div>
        <!-- 头部结束 -->

          <!-- 内部开始 -->
          <div id="indexcontent" style="clear:both;margin-top:60px;">
          <!-- 轮播 -->
              <div id="container">
                  <div id="ad-carousel" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                          <div class="item active">
                              <img src="/css/admin/image/1.jpg" alt="1 slide">
                          </div>   
                          <div class="item">
                              <img src="/css/admin/image/2.jpg"" alt="2 slide">
                          </div>                   
                          <div class="item">
                              <img src="/css/admin/image/3.jpg" alt="3 slide">
                          </div>
                          <div class="item">
                              <img src="/css/admin/image/4.jpg" alt="4 slide">
                          </div>


                      </div>
                      <a class="left carousel-control" href="#ad-carousel" data-slide="prev"><span
                              class="glyphicon glyphicon-chevron-left" style="font-size:40px;">&lt;</span></a>
                      <a class="right carousel-control" href="#ad-carousel" data-slide="next"><span
                              class="glyphicon glyphicon-chevron-right" style="font-size:40px;">&gt;</span></a>
                  </div>
              </div>   
              <!--轮播结束  -->
              <!-- 公司公告开始 -->
                <div id="conpanyinform">
                    <div class="informtop">
                        <h4>公司公告<a target="_blank" href='/admin/notice'>更多&gt;&gt;</a></h4>
                    </div>
                    <div class="informmiddle">
                        <ul>
                            <?php if ($notice) {
                              # code...
                              foreach ($notice as $key => $value) {
                                ?>
                                <?php if ($value->type==1) {
                                  ?> <li><span><?php echo date('Y-m-d H:i:s',$value->ctime);?></span><a style="width: 220px; display:inline-block;overflow: hidden; text-overflow:ellipsis; white-space: nowrap;" target="_blank" href="/admin/notice/detail/id/<?php echo $value->id?>"><?php echo $value->title;?></a></li><?php
                                }?>
                                <?php
                              }
                            } ?>
                        </ul>

                    </div>
                    <div class="informbottom">
                          <h4>温馨提示</h4>
                          <h6 style='font-weight:bold;'>
                          <?php 
                          echo $warm->content;
                           ?>
                          </h6>
                    </div>
                </div>
               <!-- 公司公告结束 -->
               
          </div>
          <!-- 底部信息开始 -->
          <div id="footer">
                <div class="footerright">
                  <div  id="mooc3"> 
                    <!--  头部 -->
                    <div  id="moocTitle3">幼狮新车源<a href="/admin/salescontrol" target="_blank">更多>></a> </div>
                    <!--  头部结束 --> 
                    <!--  中间 -->
                    <div  id="moocBox3">
                        <ul>
                        <?php 
                          foreach ($property as $key => $value) { ?>
                          <li><a href="/admin/salescontrol/detail/id/<?php echo $value->property_id?>"><?php echo  Property::estate($value->property_id)?><?php echo Property::building($value->property_id)?><?php echo Property::house_no($value->property_id)?><span></a><span><?php echo $value->unit_price/100;?>元/天</span><span>可出库时间：<?php echo date('Y-m-d',$value->live_date) ;?></span></li><br>
                        <?php
                             
                          }

                         ?>
                            
                        </ul>
                    </div>

                    <!--  中间结束 --> 
                    <!--  底部 -->
                    <div  id ="moocBot3"> </div>
                    <!--  底部结束 --> 
                    <!--  公告结束 --> 
                  </div>
                </div>
                <div class="footerleft">
                  <div  id="mooc2"> 
                      <!--  头部 -->
                      <div  id="moocTitle2">业务公告<a target="_blank" href="/admin/notice" >更多>></a> </div>
                      <!--  头部结束 --> 
                      <!--  中间 -->
                      <div  id="moocBox2">
                          <ul>
                           <?php if($yewu){
                           foreach ($yewu as $key => $value) {
                            ?>
                            <li><a href="/admin/notice/detail/id/<?php echo $value->id?>"><?php echo $value->title?></a><span><?php echo date('Y-m-d H:i:s',$value->ctime) ?></span></li>
                             <?php 
                           }
                            } ?>
                   
                          </ul>
                      </div>

                      <!--  中间结束 --> 
                      <!--  底部 -->
                      <div  id ="moocBot2"> </div>
                      <!--  底部结束 --> 
                      <!--  公告结束 --> 
                  </div>
                </div>

          </div>

    </div>
		<!-- END PAGE HEADER-->
		
	</div>
	<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
<!-- 即时信息滚动 -->
<script type="text/javascript">
 var area = document.getElementById('moocBox');
 var iliHeight = 30;//单行滚动的高度
 var speed = 50;//滚动的速度
 var time;
 var delay= 2000;
 area.scrollTop=0;
 area.innerHTML+=area.innerHTML;//克隆一份一样的内容
 // alert()
 function startScroll(){
   time=setInterval("scrollUp()",speed);
   area.scrollTop++;
   // alert(area.scrollTop);
   }
 function scrollUp(){
   if(area.scrollTop % iliHeight==0){
     clearInterval(time);
     setTimeout(startScroll,delay);
   }else{ 
     area.scrollTop++;
     if(area.scrollTop >= area.scrollHeight/2){
      area.scrollTop =0;
     }
   }
 }
   a=setTimeout(startScroll,delay)
 </script>
<!-- 2 -->


  <script type="text/javascript">
 var area3 = document.getElementById('moocBox3');
 var iliHeight3 = 34;//单行滚动的高度
 var speed3 = 50;//滚动的速度
 var time3;
 var delay3= 2000;
 area3.scrollTop=0;
 area3.innerHTML+=area3.innerHTML;//克隆一份一样的内容
 // alert()
 function startScroll3(){
   time3=setInterval("scrollUp3()",speed3);
   area3.scrollTop++;
   // alert(area.scrollTop);
   }
 function scrollUp3(){
   if(area3.scrollTop % iliHeight3==0){
     clearInterval(time3);
     setTimeout(startScroll3,delay3);
   }else{ 
     area3.scrollTop++;
     if(area3.scrollTop >= area3.scrollHeight/2){
      area3.scrollTop =0;
     }
   }
 }
   c=setTimeout(startScroll3,delay3)
 </script>

<!-- 时间滚动nJS -->
<script type="text/javascript">
  function check(i){
    if(i<10){
      i="0"+i;
      }
      return i;
    }
 var arrweek=["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];
    function test(){
   
    var d=new Date();
    var y=d.getFullYear();
    var m=d.getMonth()+1;
    var da=d.getDate();
    var h=d.getHours();
    var mi=d.getMinutes();
    mi=check(mi);
    var s=d.getSeconds();
    s=check(s);
    var week=d.getDay();
    var str=y+"年"+m+"月"+da+"日"+"&nbsp;&nbsp;"+arrweek[week]+"<p><p>"+h+":"+mi+":"+s;
    document.getElementById("timecontent").innerHTML=str;
    }
      window.onload=setInterval("test()",0);
</script>
<script>
    $(function () {
        $('#ad-carousel').carousel();
        $('#menu-nav .navbar-collapse a').click(function (e) {
            var href = $(this).attr('href');
            var tabId = $(this).attr('data-tab');
            if ('#' !== href) {
                e.preventDefault();
                $(document).scrollTop($(href).offset().top - 70);
                if (tabId) {
                    $('#feature-tab a[href=#' + tabId + ']').tab('show');
                }
            }
        });
    });
</script>

