<style type="text/css">


</style>
<?php

  $this->PAGE_LEVEL_STYLES='<link href="/css/admin/select2_metro.css" rel="stylesheet" type="text/css"/>'."\r\n";
  $this->PAGE_LEVEL_STYLES.='  <link href="/css/admin/DT_bootstrap.css" rel="stylesheet" type="text/css"/>';

  $this->PAGE_LEVEL_PLUGINS.='<script type="text/javascript" src="/css/admin/js/select2.min.js"></script>'."\r\n";
  $this->PAGE_LEVEL_PLUGINS.='  <script type="text/javascript" src="/css/admin/js/jquery.dataTables.js"></script>'."\r\n";
  $this->PAGE_LEVEL_PLUGINS.='  <script type="text/javascript" src="/css/admin/js/DT_bootstrap.js"></script>'."\r\n";
  $this->PAGE_LEVEL_SCRIPTS.='<script type="text/javascript" src="/css/admin/js/app.js"></script>'."\r\n";
  $this->PAGE_LEVEL_SCRIPTS.='  <script type="text/javascript" src="/css/admin/js/table-managed.js"></script>'."\r\n";

  Yii::app()->clientScript->registerScript("","
    App.init();
    TableManaged.init();");
?>
<?php if(empty($news_content_id)){ ?>
    echo  "<style>  #jqaddlink{display:none!important;} </style>";
<?php } ?>

<div class="page-content">
  <!-- BEGIN PAGE CONTAINER-->        

  <div class="container-fluid">

    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid" style="min-height:10px;"></div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">

            <div class="caption"><i class="icon-globe"></i>收款人列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span6">
                </div>
                <div class="span6" style="margin-top:40px;">
                  <div class="btn-group pull-right">
                    
                  </div>
                  <div class="btn-group pull-right">

                  </div>

                </div>
              </div>
              <div id="msg"></div>   
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th class="hidden-480">付款户名</th>
                    <th class="hidden-480">付款银行</th>
                    <th class="hidden-480">付款银行账号</th>
                    <th class="hidden-480">收款户名</th>
                    <th class="hidden-480">收款银行</th>
                    <th class="hidden-480">收款银行账号</th>
                    <th class="hidden-480">收款金额</th>
                    <th class="hidden-480">收款时间</th>
                    <th >操作</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
                  if($list){
                    ?>
                    <?php
                    foreach($list as $user){
                      ?>
                      <tr class="odd gradeX ">
                        <td><?php echo CHtml::encode($user->payment_name); ?></td>
                        <td><?php echo CHtml::encode($user->payment_bank); ?></td>
                        <td><?php echo CHtml::encode($user->payment_number); ?></td>
                        <td><?php echo CHtml::encode($user->payee); ?></td>
                        <td><?php echo CHtml::encode($user->payee_bank); ?></td>
                        <td><?php echo CHtml::encode($user->payee_number); ?></td>
                        <td><?php echo CHtml::encode($user->payee_money)/100; ?></td>
                        <td><?php echo CHtml::encode(date('Y-m-d',$user->payment_time)); ?></td>
                        
                        <td>
                                <a href="/admin/confirm/confirm/id/<?php echo $user->id;?>"><span style="color:red">收款人确认</span></a>
                        </td>
                      </tr>
                          <?php }} ?>
                </tbody>
              </table>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">
                    <?php
                    $this->widget('NewLinkPager', array(
                      'pages' => $pages,
                      ));
                      ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div> 
      </div>

 </div>

    <!-- END PAGE CONTENT-->
  </div>
  <!-- END PAGE CONTAINER-->
</div>

<script type="text/javascript">
            jQuery('#sample .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                    } else {
                        $(this).attr("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                    } else {
                        $(this).attr("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });    
</script>






