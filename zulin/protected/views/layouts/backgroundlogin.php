<style>
  .login{position:absolute;width:100%;height:100%;}
  #logoinhead{height:12%;width:100%;background:url(/css/admin/image/logoheaderbackground.png) no-repeat 5% 50%;background-size:10% 80%;}
  .content{height:80%;width:100%;background:#00f;}
  #logoinfooter{height:8%;width:100%;background:#fff;text-align:center;font-size:14px;line-height:80px;}
</style>


<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

  <meta charset="utf-8" />

  <title>幼狮空间ERP系统</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <meta content="" name="description" />

  <meta content="" name="author" />

  <!-- BEGIN GLOBAL MANDATORY STYLES -->

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap.min.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/font-awesome.min.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style-metro.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style-responsive.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/default.css" rel="stylesheet" type="text/css" id="style_color"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/uniform.default.css" rel="stylesheet" type="text/css"/>

  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL STYLES -->

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/login.css" rel="stylesheet" type="text/css"/>

  <!-- END PAGE LEVEL STYLES -->

  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/metronic/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="login">

  <!-- BEGIN LOGO -->

 <!--这里是登录的头部信息--> <div id="logoinhead"></div>

  <!-- END LOGO -->

  <!-- BEGIN LOGIN -->
  <div class="content">

    <!-- BEGIN LOGIN FORM -->

    <?php echo $content; ?>

    <!-- END LOGIN FORM -->        

    <!-- BEGIN FORGOT PASSWORD FORM -->

    <form class="form-vertical forget-form" action="index.html">

      <h3 class="">Forget Password ?</h3>

      <p>Enter your e-mail address below to reset your password.</p>

      <div class="control-group">

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-envelope"></i>

            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email" />

          </div>

        </div>

      </div>

      <div class="form-actions">

        <button type="button" id="back-btn" class="btn">

        <i class="m-icon-swapleft"></i> Back

        </button>

        <button type="submit" class="btn green pull-right">

        Submit <i class="m-icon-swapright m-icon-white"></i>

        </button>            

      </div>

    </form>

    <!-- END FORGOT PASSWORD FORM -->

    <!-- BEGIN REGISTRATION FORM -->

    <form class="form-vertical register-form" action="index.html">

      <h3 class="">Sign Up</h3>

      <p>Enter your account details below:</p>

      <div class="control-group">

        <label class="control-label visible-ie8 visible-ie9">Username</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-user"></i>

            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="username"/>

          </div>

        </div>

      </div>

      <div class="control-group">

        <label class="control-label visible-ie8 visible-ie9">Password</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-lock"></i>

            <input class="m-wrap placeholder-no-fix" type="password" id="register_password" placeholder="Password" name="password"/>

          </div>

        </div>

      </div>

      <div class="control-group">

        <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-ok"></i>

            <input class="m-wrap placeholder-no-fix" type="password" placeholder="Re-type Your Password" name="rpassword"/>

          </div>

        </div>

      </div>

      <div class="control-group">

        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

        <label class="control-label visible-ie8 visible-ie9">Email</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-envelope"></i>

            <input class="m-wrap placeholder-no-fix" type="text" placeholder="Email" name="email"/>

          </div>

        </div>

      </div>

      <div class="control-group">

        <div class="controls">

          <label class="checkbox">

          <input type="checkbox" name="tnc"/> I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>

          </label>  

          <div id="register_tnc_error"></div>

        </div>

      </div>

      <div class="form-actions">

        <button id="register-back-btn" type="button" class="btn">

        <i class="m-icon-swapleft"></i>  Back

        </button>

        <button type="submit" id="register-submit-btn" class="btn green pull-right">

        Sign Up <i class="m-icon-swapright m-icon-white"></i>

        </button>            

      </div>

    </form>

    <!-- END REGISTRATION FORM -->

  </div>

  <!-- END LOGIN -->

  <!-- BEGIN COPYRIGHT -->
<div id="logoinfooter">
2017 &copy; lizhaohui
</div>


  <!-- END COPYRIGHT -->

  <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

  <!-- BEGIN CORE PLUGINS -->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery-1.10.1.js" type="text/javascript"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

  <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/bootstrap.min.js" type="text/javascript"></script>

  <!--[if lt IE 9]>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/excanvas.min.js"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/respond.min.js"></script>  

  <![endif]-->   

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.slimscroll.min.js" type="text/javascript"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.blockui.min.js" type="text/javascript"></script>  

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.cookie.min.js" type="text/javascript"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.uniform.min.js" type="text/javascript" ></script>

  <!-- END CORE PLUGINS -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.validate.min.js" type="text/javascript"></script>

  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN PAGE LEVEL SCRIPTS -->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/app.js" type="text/javascript"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/login.js" type="text/javascript"></script>      

  <!-- END PAGE LEVEL SCRIPTS --> 

  <script>

    jQuery(document).ready(function() {     

      App.init();

      Login.init();

    });

  </script>

  <!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->


</html>

<script>
function KeyDown()
{
  if (event.keyCode == 13)
  {
    event.returnValue=false;
    event.cancel = true;
    Form1.btnsubmit.click();
  }
}
</script>