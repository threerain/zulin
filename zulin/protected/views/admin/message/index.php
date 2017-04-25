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

            <div class="caption"><i class="icon-globe"></i>短信列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="">
                <div class="">
            <!--       <form action="/admin/admin/index" style="margin-top:20px;margin-bottom:20px;" >
                      <div class="dataTables_filter" id="sample_1_filter">
                        <label style="float:left;">
                          收信人: <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                        <label style="float:left;">
                          电话: <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                        <label style="float:left;">
                          收信内容: <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                        <label style="float:left;">
                          发送状态: <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                        <label style="float:left;">
                          发送时间: <input style="height:20px;border:1px solid #aaa" type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                      </div>
                      <div class="btn-group">
                        <button id="sample_editable_1_new" class="btn btn-primary" type="submit">
                          搜索 <i class="icon-search"></i>
                        </button>
                      </div>
                  </form> -->
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                   
                    <th>收信人</th>
                    <th class="hidden-480">电话</th>
                    <th class="hidden-480">内容</th>
                    <th class="hidden-480">发送状态</th>
                    <th class="hidden-480">发送时间</th>
                    <!-- <th >操作</th> -->
                  </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $key => $value){ ?>
                      
                   
                      <tr class="odd gradeX">
                       
                        <td><?php echo AdminUser::model()->find("id='{$value['admin_uid']}' ")['nickname'] ?></td>
                        <td class="hidden-480"><?php echo $value['phone'] ?></td>
                        <td class="hidden-480"><?php echo $value['content'] ?></td>
                        <td class="center hidden-80"><?php echo $value['status']==1 ?'提交成功':'提交失败' ?></td>
                        <td class="center hidden-80"><?php echo date('Y-m-d H:i:s',$value['ctime']) ?></td>
                      <!--   <td>
                            <div class="btn-operation">
                              <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                                操作
                                <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                                  <a href="">详情</a>
                                  <a href="">重新发送</a>
                                
                                </ul>
                              </div> 
                        </td> -->
                       
                      </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style="float:left;margin-left:600px;margin-bottom:15px;">
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
