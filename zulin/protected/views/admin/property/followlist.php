
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
    <div class="row-fluid" >
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey" >
          <div class="portlet-title">

            <div class="caption"><i class="icon-globe"></i>跟进列表</div>
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
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample" style="margin-top:20px;"><!-- ID sample_1目前没用,js中控制显示效果 -->
                  <thead>
                    <tr class="yj-title-th">
                      <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                      <th class="hidden-480">跟进人</th>
                      <th class="hidden-480">跟进时间</th>
                      <th class="hidden-480">跟进类型</th>
                      <th class="hidden-480">跟进状态</th>
                      <th class="hidden-480">跟进详情</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($list){
                      foreach($list as $user){
                    ?>
                        <tr class="odd gradeX">
                          <td><?php $item=AdminUser::model()->find("id='$user->creater_id'"); echo $item?$item->nickname:""; ?></td>
                          <td><?php echo $user->follow_time?date("Y-m-d H:i:s",$user->follow_time):""; ?></td>
                          <td><?php if($user->type==1){echo '带看'; }else{echo '电话';}?></td>
                          <td><?php $arr=CmsProperty::model()->arr(); echo $user->see_way?$arr['see_way'][$user->see_way]:''?></td>
                          <td class="hidden-480" style="text-align:left !important"><?php echo $user->detail; ?></td>
                        </tr>
                  <?php
                      }
                    }
                  ?>
                  </tbody>
              </table>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style="float:left;margin-left:500px;margin-bottom:15px;">
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
