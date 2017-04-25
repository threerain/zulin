  <div class="header navbar navbar-inverse navbar-fixed-top">

    <!-- BEGIN TOP NAVIGATION BAR -->

    <div class="navbar-inner">

      <div class="container-fluid">

        <!-- BEGIN LOGO -->

        <a class="brand" href="/admin/home" style="margin-left:20px;">

        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/image/logo.png" alt="logo" />

        </a>

        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->

        <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

        <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/image/menu-toggler.png" alt="" />

        </a>

        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->

        <ul class="nav pull-right">



          <!-- END NOTIFICATION DROPDOWN -->

          <!-- BEGIN INBOX DROPDOWN -->

          <li class="dropdown" id=""  style="text-indent:0px;letter-spacing: 0px;margin-right:-40px;">

            <a href="/admin/usernews" class="dropdown-toggle" >

            <i class="icon-envelope"></i>

            <span class="badge" ></span>

            </a>

            <ul class="dropdown-menu extended inbox">


            </ul>

          </li>



          <!-- END TODO DROPDOWN -->

          <!-- BEGIN USER LOGIN DROPDOWN -->

          <li class="dropdown user" style="margin-left:50px;text-indent:0px;">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <img alt="" style="width:29px;height:29px;" src="<?php $uid = yii::app()->session['admin_uid']; $avatar = AdminUser::model()->findbypk($uid)->avatar; echo $avatar?$avatar:'/css/admin/image/avatar1_small.jpg'; ?>" />

            <span class="username"><?php echo Yii::app()->session['admin_uname'];?></span>

            <i class="icon-angle-down" style="text-indent:0px;"></i>

            </a>

            <ul class="dropdown-menu">

              <li><a href="/admin/login/logout"><i class="icon-key" style="text-indent:35px;"></i>退出</a></li>

            </ul>

          </li>

          <!-- END USER LOGIN DROPDOWN -->

        </ul>

        <!-- END TOP NAVIGATION MENU -->

      </div>

    </div>

    <!-- END TOP NAVIGATION BAR -->

  </div>
