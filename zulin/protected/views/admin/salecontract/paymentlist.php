
  <!-- BEGIN PAGE LEVEL STYLES -->
<?php
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
  <!-- END PAGE LEVEL STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    TableManaged.init();");
?>
  <!-- End PAGE LEVEL SCRIPTS -->

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

            <div class="caption"><i class="icon-globe"></i>出车合同已收列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span6">

                </div>
                <div class="span6">
                  <div class="btn-group pull-right">
                  </div>
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                    <th class="hidden-480">收款日</th>
                    <th class="hidden-480">收款类型</th>
                    <th class="hidden-480">收款金额</th>
                    <th class="hidden-480">收款人</th>
                    <th class="hidden-480">收款时间</th>
                    <th class="hidden-480">收款备注</th>
                    <!-- <th >操作</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($list){
                    ?>
                    <?php
                    foreach($list as $model){
                      ?>
                      <tr class="odd gradeX">
                        <td class="hidden-480"><?php echo date("Y-m-d",$model->payment_date); ?></td>
                        <td class="hidden-480">
                            <?php echo $model->type==1?"押金":""; ?>
                            <?php echo $model->type==2?"房租":""; ?>
                            <?php //echo $model->type==3?"免租期":""; ?>
                        </td>
                        <td class="hidden-480"><?php echo $model->amount/100; ?></td>
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="hidden-480"><?php echo date("Y-m-d",$model->ctime); ?></td>
                        <td class="hidden-480"><?php echo $model->memo; ?></td>
                        <!-- <td class="hidden-480">是否已开发票</td> -->
                        <!-- <td>
                          <a href="/admin/salecontract/payment/id/<?php //echo $model->id;?>">编辑</a>
                          <a href="/admin/salecontract/paymentlist/id/<?php //echo $model->id;?>">删除</a>
                        </td> -->
                        <!-- <td ><span class="label label-success">Approved</span></td> -->
                      </tr>
                      <?php
                    }
                    ?>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination">

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

