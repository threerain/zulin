<style>
#jqaddlink{display:none!important;}
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

            <div class="caption"><i class="icon-globe"></i>用户列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span6">
                  <form action="/admin/admin/index" style="margin-top:20px;margin-bottom:20px;padding-left:30px;" >
                      <div class="dataTables_filter" id="sample_1_filter">
                        <label style="float:left;">
                          关键词: <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="关键词" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                      </div>
                      <div class="btn-group">
                        <button id="sample_editable_1_new" class="btn btn-primary" type="submit">
                          搜索 <i class="icon-search"></i>
                        </button>
                      </div>
                  </form>
                </div>
                <div class="span6" style="margin-top:40px;">

                  <div class="btn-group pull-right">

                  </div>

                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th class="hidden-480">ID</th>
                    <th class="hidden-480">账号</th>
                    <th class="hidden-480">微信昵称</th>
                    <th class="hidden-480">头像</th>
                    <th class="hidden-480">状态</th>
                    <th class="hidden-480">申请时间</th>
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
                      <tr class="odd gradeX">
                        <td><?php echo $user->id ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->account); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->nickname); ?></td>
                        <td class="center hidden-480"><img style="width:50px;height:50px;" src="<?php echo $user->headimgurl?$user->headimgurl:'/css/admin/image/avatar1_small.jpg'; ?>"> </td>
                        <td class="center hidden-480"><?php
                        if($user->status==0){
                          echo '待审核';
                        }elseif($user->status==1){
                          echo '审核通过';
                        }elseif($user->status==2){
                          echo '审核不通过';
                        }
                        ?></td>
                        <td class="center hidden-480"><?php echo  $user->ctime; ?></td>
                        <td>
                        <div class="btn-operation">
                          <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                            操作
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                            <?php if(AdminPositionModul::has_modul("101_03")&&$user->status==0||$user->status==2) {?>
                              <a class="edit"  href="/admin/wechat/edit/id/<?php echo $user->id;?>/openid/<?php echo $user->openid?>?status=1" style="display:block">通过</a>
                            <?php }?>

                            <?php if(AdminPositionModul::has_modul("101_16")||$user->status==1||$user->status==0) {?>
                              <a class="edit"   href="/admin/wechat/edit/id/<?php echo $user->id;?>/openid/<?php echo $user->openid?>?status=2" style="display:block">不通过</a>
                            <?php }?>
                          </ul>
                        </div>
                        </td>
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
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>
    </div>
    <!-- END PAGE CONTENT-->
  </div>
  <!-- END PAGE CONTAINER-->
</div>
