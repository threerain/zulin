<style>
#jqaddlink{display:none!important;}

  #level{background-color:#fff;display:none;z-index:1;position:fixed;width:33%;top:20%;left:40%;height:40%;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;} 
    #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}  

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

            <div class="caption"><i class="icon-globe"></i>职务列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span6">
                  <form action="/admin/position/index" style="margin-top:20px;margin-bottom:20px;padding-left:30px;">
                      <div class="dataTables_filter" id="sample_1_filter">
                        <label style="float:left;">
                          <b>职位:</b> <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="职位" value="<?php echo $keyword;?>" name="keyword">
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
                  <?php if(AdminPositionModul::has_modul("203_05")) {?>
                    <div class="btn-group pull-right">
                      <a href="/admin/position/add">
                        <button id="sample_editable_1" class="btn btn-primary"s>
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
                    <th>ID</th>
                    <th class="hidden-480">职务名</th>
                    <th class="hidden-480">部门名</th>
                    <th class="hidden-480">父级部门</th>
                    <th class="hidden-480">创建人</th>
                    <th class="hidden-480">创建时间</th>
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
                        <td><?php echo CHtml::encode(substr($user->id, 25)); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->name); ?></td>
                        <td class="hidden-480"><?php echo AdminDepartment::model()->find("id = '$user->department_id'")->name;?></td>
                        <td class="hidden-480"><?php $admindepartment = AdminDepartment::model()->find("id = '$user->department_id'");echo
                        AdminDepartment::model()->find("id='$admindepartment->parent_id'")->name;
                        ?></td>
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$user->create_user_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="center hidden-480"><?php echo date('Y-m-d H:i:s', $user->ctime); ?></td>
                        <td>
                          <?php if(AdminPositionModul::has_modul("203_02")) {?>
                              <a href="/admin/position/edit/id/<?php echo $user->id;?>">编辑</a>
                          <?php }?>
                          <?php if(AdminPositionModul::has_modul("203_03")) {?>
                            <a href="/admin/position/delete/id/<?php echo $user->id;?>" onclick="javascript:return confirm('确实要删除吗?');">删除</a>
                          <?php }?>
                          <?php if(AdminPositionModul::has_modul("203_04")) {?>
                            <a href="/admin/position/modul/id/<?php echo $user->id;?>">权限</a>
                          <?php }?>
                          <?php if(AdminPositionModul::has_modul("203_02")&&($model->status==0||$model->status==9||$model->status==-1)) {?>
                          <a class="levelset" data="<?php echo $user->id ?>" href="javascript:;"  style="display:block">提成等级</a>
                          <?php }?>
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

            <div id="level" class="portlet-body form" id="form_add"  method="post"  class="form-horizontal js-submit">
              <div style="height:40px;background:#167AC7;margin-bottom:20px;" class="portlet-title">
                 <div class="caption" style="line-height:40px;font-size:20px;text-indent:30px;">提成等级</div>
              </div>
              <form action="/admin/position/levelsave" id="form_add"  method="post"  class="form-horizontal js-submit">
                  <input type="hidden" name="position_id" id="position_id" value="">
                  <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      输入格式有误，请检查输入的数据.
                  </div>
                  <div class="alert alert-success hide">
                      <button class="close" data-dismiss="alert"></button>
                      数据输入验证成功!
                  </div>
                  <div class="control-group" style="margin-bottom:0px !important;">
                      <div class="controls">
                          <span>提成等级:</span>
                          <select name="level" id="">
                            <option value="0">请选择</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                          </select>
                      </div>
                      <div class="controls">
                          <span>提成类型:</span>
                          <select name="type" id="">
                            <option value="0">请选择</option>
                            <option value="1">提成</option>
                            <option value="2">管佣</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-actions">
                      <button  type="submit" class="btn btn-primary submit js-btnadd follo" style="margin-left:150px;">确定</button>
                      <button type="button" class="btn"  id="btnn">取消</button>
                  </div>
                   <div class="control-group" id="closemodel">
                     ×
                  </div>
              </form>
            </div>

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
<script>
$(function(){
  $("#level").draggable();//模态框的拖拽性
  $("#closemodel").click(function(){
    $("#level").hide();//关闭模态框
  });
})
$('#btnn').click(function(){
  $("#level").hide();//点击取消关闭模态框
})
//选中元素
$('.levelset').click(function(){
  var id=$(this).attr('data');

  $.post('/admin/position/level',{id:id},function(msg){
    $("select[name=level]").val(msg.level);
    $("select[name=type]").val(msg.type);
  },'json')

  document.getElementById("position_id").value=id;
  // $("#property_id").value="aa";
  if(document.getElementById("level").style.display != "block")
  {
    document.getElementById("level").style.display = "block";
  }
  else
  {
    document.getElementById("level").style.display = "none";
  }
});
</script>