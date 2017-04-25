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
                      <div class="dataTables_filter" id="sample_1_filter">
                        <label style="float:left;">
                          <b>部门:</b> <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="部门名" value="<?php echo $department;?>" name="department">
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
                  <?php if(AdminPositionModul::has_modul("201_05")) {?>
                    <div class="btn-group pull-right">
                      <a href="/admin/admin/add">
                        <button id="sample_editable_1" class="btn btn-primary">
                        新建 <i class="icon-plus"></i>
                        </button>
                      </a>
                    </div>
                  <?php }?>

                  <div class="btn-group pull-right">

                  </div>

                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th>
                    <th>ID</th>
                    <th class="hidden-480">账号</th>
                    <th class="hidden-480">昵称</th>
                    <th class="hidden-480">职务</th>
                    <th class="hidden-480">部门</th>
                    <th class="hidden-480">父级部门</th>
                    <th class="hidden-480">头像</th>
                    <th class="hidden-480">最后登录时间</th>
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
                        <td><input type="checkbox" class="checkboxes" name="ids" value="<?php echo CHtml::encode($user->id); ?>" /></td>
                        <td><?php echo CHtml::encode(substr($user->id, 25)); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->account); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->nickname); ?></td>
                        <td class="hidden-480"><?php echo AdminPosition::model()->find("id = '$user->position_id'")->name ; ?></td>
                        <td class="hidden-480"><?php echo AdminDepartment::model()->find("id = '$user->department_id'")->name ; ?></td>
                        <td class="hidden-480"><?php $admindepartment = AdminDepartment::model()->find("id = '$user->department_id'");echo
                        AdminDepartment::model()->find("id='$admindepartment->parent_id'")->name;
                        ?></td>
                        <td class="center hidden-480"><img style="width:50px;height:50px;" src="<?php echo $user->avatar?$user->avatar:'/css/admin/image/avatar1_small.jpg'; ?>"> </td>
                        <td class="center hidden-480"><?php echo date('Y-m-d H:i:s', $user->login_time); ?></td>
                        <td>
                          <?php //echo CHtml::link(CHtml::encode('查看'), array('details', 'id'=>$user->id)); ?>
                          <?php //if ($user->istop){?>
                          <?php //echo CHtml::link(CHtml::encode('取消置顶'), array('untop', 'id'=>$user->id)); ?>
                          <?php //}else {?>
                          <?php //echo CHtml::link(CHtml::encode('置顶'), array('top', 'id'=>$user->id)); ?>
                          <?php //}?>
                          <!-- <a href="/admin/accountuser/delete/id/<?php //echo $user->id;?>" onclick="javascript:return confirm('删除主贴所有回复都会删除，确实要删除吗?');">删除</a> -->
                          <?php if(AdminPositionModul::has_modul("201_04")) {?>
                            <a href="/admin/admin/edit/id/<?php echo $user->id;?>">编辑</a>
                          <?php }?>
                          <?php if(AdminPositionModul::has_modul("201_02")) {?>
                            <a href="/admin/admin/delete/id/<?php echo $user->id;?>" onclick="javascript:return confirm('确实要删除吗?');">删除</a>
                          <?php }?>

                        </td>
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
