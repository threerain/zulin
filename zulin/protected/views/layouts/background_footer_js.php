 <!-- BEGIN CORE PLUGINS -->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery-1.10.1.min.js" type="text/javascript"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

  <!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/bootstrap.min.js" type="text/javascript"></script>

  <!--[if lt IE 9]>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/excanvas.min.js"></script>

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/respond.min.js"></script>  

  <![endif]-->   

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/breakpoints.min.js" type="text/javascript"></script>  

  <!--<script src="<?php //echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.slimscroll.min.js" type="text/javascript"></script>-->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.blockui.min.js" type="text/javascript"></script>  

  <!--<script src="<?php //echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.cookie.min.js" type="text/javascript"></script>-->

  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/jquery.uniform.min.js" type="text/javascript" ></script>

  <!-- END CORE PLUGINS -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <?php echo isset($this->PAGE_LEVEL_PLUGINS)?$this->PAGE_LEVEL_PLUGINS:"";?>
  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN PAGE LEVEL SCRIPTS -->
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/js/app.js"></script>
  <?php echo isset($this->PAGE_LEVEL_SCRIPTS)?$this->PAGE_LEVEL_SCRIPTS:"";?>
  <!-- END PAGE LEVEL SCRIPTS -->

  <script>

    // jQuery(document).ready(function() {     

    //   App.init();

    //   //Login.init();

    // });

  </script>