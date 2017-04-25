<style>
#jqaddlink{display:none!important;}
</style>
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

            <div class="caption"><i class="icon-globe"></i>渠道公司人员维护列表</div>
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
                  <form action="/admin/channelmanager/index" style="margin-top:20px;margin-bottom:20px;padding-left:30px;" >
                      <div class="dataTables_filter" id="sample_1_filter">
                        <label style="float:left;">
                          <b>关键词:</b> <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="渠道人员姓名" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                        <label style="float:left;">
                          <b>公司名称:</b> <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="渠道公司名称" value="<?php echo $keyword_company;?>" name="keyword_company">
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
                  <?php if(AdminPositionModul::has_modul("005_04")) {?>
                    <div class="btn-group pull-right">
                      <a href="/admin/channelmanager/create">
                        <button id="sample_editable_1" class="btn btn-primary">
                        新建 <i class="icon-plus"></i>
                        </button>
                      </a>
                    </div>
                  <?php }?>

                  <div class="btn-group pull-right">
<!--                     <a href="/admin/user/create">
                      <button id="sample_editable_1" class="btn green">
                      新建 <i class="icon-plus"></i>
                      </button>
                    </a> -->
                  </div>
<!--                   <div class="btn-group pull-right">

                    <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>

                    </button>

                    <ul class="dropdown-menu pull-right">

                      <li><a href="#">Print</a></li>

                      <li><a href="#">Save as PDF</a></li>

                      <li><a href="#">Export to Excel</a></li>

                    </ul>

                  </div> -->
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th>
                    <th class="hidden-480">ID</th>
                    <th class="hidden-480">渠道公司</th>
                    <th class="hidden-480">姓名</th>
                    <th class="hidden-480">电话</th>
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
                    foreach($list as $model){
                      ?>
                      <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="ids" value="<?php echo CHtml::encode($model->id); ?>" /></td>
                        <td class="hidden-480"><?php echo substr($model->id, 25) ; ?></td>
                        <td class="hidden-480"><?php $item=CmsChannel::model()->find("id='$model->channel_id'"); echo $item?$item->name:""; ?></td>
                        <td class="hidden-480"><?php echo $model->name; ?></td>
                        <td class="hidden-480"><?php echo $model->phone; ?></td>
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="hidden-480"><?php echo date("Y-m-d H:i:s",$model->ctime); ?></td>
                        <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                            <?php if(AdminPositionModul::has_modul("005_02")) {?>
                              <a href="/admin/channelmanager/edit/id/<?php echo $model->id;?>">编辑</a>
                            <?php }?>
                            <?php if(AdminPositionModul::has_modul('005_03')) {?>
                              <a href="" address="/admin/channelmanager/delete/id/<?php echo $model->id;?>" style="display:block" class="delete" data-toggle="modal" data-target="#about-modal">删除</a>                              
                          <?php }?>
                            </ul>
                          </div> 



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
                  <div class="dataTables_paginate paging_bootstrap pagination" style="float:left;margin:30px auto;width:99%;text-align:center;">
                    <?php
                    $this->widget('NewLinkPager', array(
                      'pages' => $pages,
                      ));
                      ?>
                  </div>
                </div>
              </div>

                <div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="modal-label">本站点提示...</h4>
                          </div>
                          <div class="modal-body">
                              <p>确定要删除吗?</p>
                          </div>
                          <div class="modal-footer">
                               <a id="left" class="btn btn-primary" href="" onclick="javascript:return true;">确定</a>
                               <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
                          </div>
                      </div>
                  </div>
                </div>
                <script>
                $(".delete").click(function(){
                    var id =  $(this).attr('address');
                    //点击确定时传值到控制器
                    $("#left").attr('href',id);
                })
                </script>

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
