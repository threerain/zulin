  <style>
    li img.mainpic{width:15px;height:15px;margin-left:-15px;margin-right:12px;}
    li li{text-indent: 20px;margin:0;}
    li{text-indent:20px;letter-spacing: 2px}
  </style>
    <div class="page-sidebar nav-collapse collapse">

      <!-- BEGIN SIDEBAR MENU -->

      <ul class="page-sidebar-menu">

        <li>

          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

          <div class="sidebar-toggler hidden-phone"></div>

          <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

        </li>

        <li>

          <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

<!--           <form class="sidebar-search">

            <div class="input-box">

              <a href="javascript:;" class="remove"></a>

              <input type="text" placeholder="Search..." />

              <input type="button" class="submit" value=" " />

            </div>

          </form> -->

          <!-- END RESPONSIVE QUICK SEARCH FORM -->

        </li>

        <!-- <li>

          <a href="javascript:;">

          <i class="icon-user"></i>

          <span class="title">车源管理</span>

          <span class="arrow <?php //echo Yii::app()->controller->id=="admin/accountuser"||
            //Yii::app()->controller->id=="admin/userstatistics"||
            //Yii::app()->controller->id=="admin/authenticateuser"||
            //Yii::app()->controller->id=="admin/authenticateenterprise"||
            //Yii::app()->controller->id=="admin/authenticateother"||
            //Yii::app()->controller->id=="admin/authenticateweibo"||
            //Yii::app()->controller->id=="admin/authenticatecar"
            //?"open":"" ?>"></span>

          </a>

          <ul class="sub-menu" style="display: <?php //echo Yii::app()->controller->id=="admin/accountuser"||
            //Yii::app()->controller->id=="admin/property"
            //?"block":"none" ?>;">

            <li class="<?php //echo Yii::app()->controller->id=="admin/property"&&$this->getAction()->getId()=="index"?"active":"" ?>">

              <a href="/admin/property">

              车源列表</a>

            </li>

          </ul>
        </li> -->
        <?php //if(AdminPositionModul::show_menu(Yii::app()->session['admin_uid'],"公告")) {?>
        <li <?php echo Yii::app()->controller->id=="admin/notice"
          ?"open":"" ?>>

          <a href="javascript:;">

         <img src="/css/admin/image/gg.png" class="mainpic">

          <span class="title">公告</span>

          <span class="arrow <?php echo Yii::app()->controller->id=="admin/notice"?"open":"" ?>"></span>

          </a>

          <ul class="sub-menu" style="display: <?php echo Yii::app()->controller->id=="admin/home"||
            Yii::app()->controller->id=="admin/notice"
            ?"block":"none" ?>;">
            <?php //if(AdminPositionModul::has_modul("101_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/notice"?"active open":"" ?>">

              <a href="/admin/notice">

              公告管理</a>

            </li>
            <?php //}?>
            <?php //if(AdminPositionModul::has_modul("101_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/home"?"active open":"" ?>">

              <a href="/admin/home">

              最新消息</a>

            </li>
            <?php //}?>
          </ul>

        </li>
        <?php //}?>

      <?php if(AdminPositionModul::show_menu(Yii::app()->session['admin_uid'],"幼狮合同")) {?>
        <li class="<?php echo
            Yii::app()->controller->id=="admin/purchasecontract" ||
            Yii::app()->controller->id=="admin/salecontract"
          ?"open":"" ?>" >
          <a href="javascript:;">
            <img src="/css/admin/image/hg.png" class="mainpic">
            <span class="title">合同管理</span>
            <span class="arrow"></span>
          </a>
          <ul class="sub-menu" style="display: <?php echo Yii::app()->controller->id=="admin/news"||
            Yii::app()->controller->id=="admin/purchase"||
            Yii::app()->controller->id=="admin/purchasecontract" ||
            Yii::app()->controller->id=="admin/salecontract"
            ?"block":"none" ?>;">

            <?php if(AdminPositionModul::has_modul("102_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/salecontract"?"active open":"" ?>">

              <a href="/admin/salecontract">

              出车合同</a>

            </li>
            <?php }?>
              <li class="<?php echo Yii::app()->controller->id=="admin/outroom"?"active":"" ?>">

                  <a href="/admin/outroom">

                      出车佣金管理</a>

              </li>
          </ul>
        </li>
      <?php }?>



    <?php if(AdminPositionModul::show_menu(Yii::app()->session['admin_uid'],"收购管理")) {?>
        <li class="<?php echo Yii::app()->controller->id=="admin/property"
          ?"open":"" ?>">

          <a href="javascript:;">

          <img src="/css/admin/image/sg.png" class="mainpic">

          <span class="title">收购管理</span>

          <span class="arrow "></span>

          </a>

          <ul class="sub-menu" style="display: <?php echo Yii::app()->controller->id=="admin/property"
            ?"block":"none" ?>;">
            <?php if(AdminPositionModul::has_modul("501_06")) {?>
              <li class="<?php echo Yii::app()->controller->id=="admin/property"?"active":"" ?>">

                <a href="/admin/property">

                收入车辆</a>

              </li>
            <?php }?>
          </ul>
        </li>
        <?php }?>
    <?php if(AdminPositionModul::show_menu(Yii::app()->session['admin_uid'],"数据管理")) {?>
        <li class="<?php echo Yii::app()->controller->id=="admin/ursproperty"
          ?"open":"" ?>">

          <a href="javascript:;">

          <img src="/css/admin/image/xg.png" class="mainpic">

          <span class="title">数据管理</span>

          <span class="arrow "></span>

          </a>

          <ul class="sub-menu" style="display: <?php echo  Yii::app()->controller->id=="admin/ursproperty"||
              Yii::app()->controller->id=="admin/salescontrol"||

              Yii::app()->controller->id=="admin/ursgoods"
            ?"block":"none" ?>;">
<!--            --><?php //if(AdminPositionModul::has_modul("602_01")) {?>
<!--              <li class="--><?php //echo Yii::app()->controller->id=="admin/ursproperty"?"active":"" ?><!--">-->
<!---->
<!--                <a href="/admin/ursproperty">-->
<!---->
<!--                幼狮车源管理</a>-->
<!---->
<!--              </li>-->
<!--            --><?php //}?>
            <?php if(AdminPositionModul::has_modul("603_01")) {?>
              <li class="<?php echo Yii::app()->controller->id=="admin/salescontrol"?"active":"" ?>">

                  <a href="/admin/salescontrol">

                  销售销控管理</a>

                </li>

            <?php }?>
              <?php if(AdminPositionModul::has_modul("604_01")) {?>
                <li class="<?php echo Yii::app()->controller->id=="admin/property"?"active":"" ?>">



                      <a href="javascript:;">



                      <span class="title">礼品管理</span>

                      <span class="arrow "></span>

                      </a>

                      <ul class="sub-menu" style="display: <?php echo
                          Yii::app()->controller->id=="admin/ursgoods/goodsindex"||
                          Yii::app()->controller->id=="admin/ursgoods"
                          ?"block":"none" ?>;">
                          <?php if(AdminPositionModul::has_modul("604_09")) {?>
                            <li class="<?php echo Yii::app()->controller->id=="/admin/ursgoods/goodsindex"?"active":"" ?>">

                              <a href="/admin/ursgoods/goodsindex">

                              礼品维护</a>

                            </li>
                          <?php }?>
                          <!-- <?php if(AdminPositionModul::has_modul("604_10")) {?>
                            <li class="<?php echo Yii::app()->controller->id=="/admin/ursgoods"?"active":"" ?>">

                              <a href="/admin/ursgoods">

                              礼品申请管理</a>

                            </li>
                          <?php }?> -->

                      </ul>



                  </li>
              <?php }?>


          </ul>
        </li>
        <?php }?>

        <?php if(AdminPositionModul::show_menu(Yii::app()->session['admin_uid'],"基础数据")) {?>
        <li class="<?php echo Yii::app()->controller->id=="admin/jichu"||
          Yii::app()->controller->id=="admin/changepwd"
          ?"open":"" ?>">




          <a href="javascript:;">

         <img src="/css/admin/image/sj.png" class="mainpic">

          <span class="title">基础数据</span>

          <span class="arrow "></span>

          </a>

          <ul class="sub-menu" style="display: <?php echo Yii::app()->controller->id=="admin/district"||
            Yii::app()->controller->id=="admin/area" ||
            Yii::app()->controller->id=="admin/estategroup" ||
            Yii::app()->controller->id=="admin/estate" ||
            Yii::app()->controller->id=="admin/building" ||
            Yii::app()->controller->id=="admin/channel" ||
            Yii::app()->controller->id=="admin/channelmanager" ||
            Yii::app()->controller->id=="admin/companytype"
            ?"block":"none" ?>;">

            <!-- <li class="">

              <a href="user">

              分组权限</a>

            </li> -->
            <!-- <?php if(AdminPositionModul::has_modul("001_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/district"?"active":"" ?>">

              <a href="/admin/district">

              区域维护</a>

            </li>
            <?php }?>
            <?php if(AdminPositionModul::has_modul("002_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/area"?"active":"" ?>">

              <a href="/admin/area">

              商圈维护</a>

            </li>
            <?php }?>

            <?php if(AdminPositionModul::has_modul("008_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/estategroup"?"active":"" ?>">

              <a href="/admin/estategroup">

              组团维护</a>

            </li>
            <?php }?> -->

            <?php if(AdminPositionModul::has_modul("003_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/estate"?"active":"" ?>">

              <a href="/admin/estate">

              车辆品牌</a>

            </li>
            <?php }?>
            <?php if(AdminPositionModul::has_modul("006_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/building"?"active":"" ?>">

              <a href="/admin/building">

              车辆系列</a>

            </li>
            <?php }?>
            <?php if(AdminPositionModul::has_modul("004_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/channel"?"active":"" ?>">

              <a href="/admin/channel">

              渠道公司维护</a>

            </li>
            <?php }?>
            <?php if(AdminPositionModul::has_modul("005_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/channelmanager"?"active":"" ?>">

              <a href="/admin/channelmanager">

              渠道公司人员维护</a>

            </li>
            <?php }?>
            <!-- <?php if(AdminPositionModul::has_modul("007_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/companytype"?"active":"" ?>">

              <a href="/admin/companytype">

              公司类型维护</a>

            </li>
            <?php }?> -->
          </ul>

        </li>
        <?php }?>

        <li class="<?php echo Yii::app()->controller->id=="admin/admin"||
          Yii::app()->controller->id=="admin/changepwd"
          ?"open":"" ?>">

          <a href="javascript:;">

          <img src="/css/admin/image/yh_normal.png" class="mainpic">

          <span class="title">用户管理</span>

          <span class="arrow "></span>

          </a>

          <ul class="sub-menu" style="display: <?php echo
            Yii::app()->controller->id=="admin/department"||
            Yii::app()->controller->id=="admin/position"||
            Yii::app()->controller->id=="admin/admin"||
            Yii::app()->controller->id=="admin/changepwd"||
            Yii::app()->controller->id=="admin/wechat"
            ?"block":"none" ?>;">
            <?php if(AdminPositionModul::show_menu(Yii::app()->session['admin_uid'],"用户管理")) {?>
            <?php if(AdminPositionModul::has_modul("202_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/department"?"active":"" ?>">

              <a href="/admin/department">

              部门管理</a>

            </li>
            <?php }?>
            <?php if(AdminPositionModul::has_modul("203_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/position"?"active":"" ?>">

              <a href="/admin/position">

              职务管理</a>

            </li>
            <?php }?>
            <?php if(AdminPositionModul::has_modul("201_01")) {?>
            <li class="<?php echo Yii::app()->controller->id=="admin/admin"?"active":"" ?>">

              <a href="/admin/admin">

              用户列表</a>

            </li>
            <?php }?>
            <?php }?>
            <li class="<?php echo Yii::app()->controller->id=="admin/changepwd"?"active":"" ?>">

              <a href="/admin/changepwd">

              修改密码</a>

            </li>
          </ul>

        </li>

        <!--
        <li class="last ">

          <a href="charts.html">

          <i class="icon-bar-chart"></i>

          <span class="title">Visual Charts</span>

          </a>

        </li> -->

      </ul>

      <!-- END SIDEBAR MENU -->

    </div>
 <script type="text/javascript">

     var res = setInterval(aa,180000);
     var res1 = setTimeout(aa,10);
     //函数
     function aa(){
          $.ajax({
                 type: "POST",
                 dataType: "json",
                 url: "/admin/home/check",
                 timeout: 80000, //ajax请求超时时间80秒
                 data: {time: "80"}, //40秒后无论结果服务器都返回数据
                 success: function(data, textStatus) {
                     // var number_s = 0;
                     //多人可以操作的消息
                     // for(var i=0;i<data['news'].length;i++){
                     //     var htmls = $('.news'+i).hasClass('news'+i) ;
                     //     if(htmls  && data['news'][i] != 0){
                     //         $('.news'+i).html(data['news'][i]);
                     //         number_s += +data['news'][i];
                     //     }
                     // }
                     //单人操作的消息
                     // for(var i=0;i<=data['usernews'].length;i++){
                     //     var htmls = $('.usernews'+i).hasClass('usernews'+i);
                     //     if(htmls && data['usernews'][i] != 0){
                     //         $('.usernews'+i).html(data['usernews'][i]);
                     //         $('#usernews'+i).show();
                     //         number_s += +data['usernews'][i];
                     //     }
                     // }
                     if(data != 0){
                         $(".badge").html(data) //总条数 总经理级别的
                         $(".external").css('display','none')
                     }
                 },
                 //没有结果
                 error: function(XMLHttpRequest, textStatus, errorThrown) {

                 }
             });
     }
 </script>
