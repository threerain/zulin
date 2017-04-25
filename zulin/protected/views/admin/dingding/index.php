<style type="text/css">
    .dataTables_filter label{
        margin-left: 10px!important;
    }



</style>
<?php if(empty($news_content_id)){ ?>
    echo  "<style>  #jqaddlink{display:none!important;} </style>";
<?php } ?>
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
                <div class="" style="margin-top:15px">
                  <form action="https://oapi.dingtalk.com/department/list"  method ="get" style="margin-top:20px;margin-bottom:20px;padding-left:30px;" >
                        <input type="text" name="access_token" value="81eff94bd47d36ffa7556f2f5123be93">
                        <input type="text" name="lang">
                        <input type="text" name="id">
                        <button id="sample_editable_1_new" class="btn btn-primary" type="submit">
                          搜索 <i class="icon-search"></i>
                        </button>
                      </div>
                  </form>

                </div>
              </div>
                
                  <div class="btn-group pull-right">
                    <?php  if(AdminPositionModul::has_modul("301_02")) {?>
                      <a href="/admin/finance/add">
                        <button id="sample_editable_1" class="btn btn-primary">
                        新建 <i class="icon-plus"></i>
                        </button>
                      </a>
                    <?php }?>

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
                    <th class="hidden-480">状态</th>
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
                       <td><?php $biantai =CHtml::encode($user->payee_money) ;echo !empty($biantai) ? CHtml::encode($user->payee_money)/100:''; ?></td>
                        <td><?php echo CHtml::encode(str_replace(['1','2','3'], ['客服未确认','客服已确认','财务已知'], $user->type) ); ?></td>
                        <td>
                        <div class="btn-operation">
                          <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                            操作
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                          <?php if(AdminPositionModul::has_modul("301_04")) {?>
                            <a href="/admin/finance/detail/id/<?php echo $user->id;?>"><span>详情</span></a>
                          <?php }?>
                          <?php if (AdminPositionModul::has_modul("301_03")) { ?>
                          <a href="/admin/finance/delete/id/<?php echo $user->id;?>" onclick="javascript:return confirm('确实要删除吗?');">删除</a>
                          <?php } ?>
                            </ul>
                            </div>
                        </td>
                      </tr>
                      <?php
                    }}
                    ?>
                </tbody>
              </table>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">
                    <?php
                    // $ps = Yii::app()->params['pageSetting'];
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
