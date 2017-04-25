<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<?php $this->beginContent('//layouts/background_head'); ?>
      <?php echo $content; ?>
<?php $this->endContent(); ?>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

  <!-- BEGIN HEADER -->

<?php $this->beginContent('//layouts/background_body_head');?>
      <?php echo $content; ?>
<?php $this->endContent(); ?>


  <!-- END HEADER -->

  <!-- BEGIN CONTAINER -->

  <div class="page-container row-fluid">

    <!-- BEGIN SIDEBAR -->

<?php $this->beginContent('//layouts/background_body_sidebar'); ?>
      <?php echo $content; ?>
<?php $this->endContent(); ?>

    <!-- END SIDEBAR -->

    <?php echo $content; ?>
  </div>

  <!-- END CONTAINER -->

  <!-- BEGIN FOOTER -->

<?php $this->beginContent('//layouts/background_footer'); ?>
      <?php echo $content; ?>
<?php $this->endContent(); ?>

  <!-- END FOOTER -->

  <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<?php $this->beginContent('//layouts/background_footer_js'); ?>
      <?php echo $content; ?>
<?php $this->endContent(); ?>

  <!-- END JAVASCRIPTS -->


</body>
<!-- END BODY -->

</html>