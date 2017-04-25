<style type="text/css">
    .dataTables_filter label{
        margin-left: 10px!important;
    }
    input{width:150px!important;}


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
                  <form action="/admin/finance/index" style="margin-top:20px;margin-bottom:20px;padding-left:30px;" >
                    <div class="" style="margin-bottom:10px;margin-left:50px;" id="page1">
                      <input type="hidden" value="<?php echo $search ?>" name="search">

                      <!-- <span>合同ID：<input type="text" value="<?php echo $keyword_id;?>" name="keyword_id"></span> -->
                      <span>品牌:<input type="text" value="<?php echo $keyword_estates;?>" style="width:150px" name="keyword_estates"></span>
                      <span>系列：<input type="text"  value="<?php echo $keyword_building;?>"  style="width:150px" name="keyword_building"></span>
                     <span>编号：<input type="text" value="<?php echo $keyword_room_number;?>"  style="width:150px" name="keyword_room_number"></span>
                     <button id="sample_editable_1_new" class="btn btn-primary" type="submit" >
                     搜索 <i class="icon-search"></i></button>
                               </span>
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
                    <th class="hidden-480">合同ID</th>
                    <th class="hidden-480">品牌</th>
                    <th class="hidden-480">系列</th>
                    <th class="hidden-480">编号</th>
                    <th class="hidden-480">收款时间</th>
                    <th class="hidden-480">收款金额</th>
                    <th >操作</th>
                  </tr>
                </thead>
                <tbody>
                    <?php if($list) {
                              foreach($list as $k=>$v) {?>
                                <tr>
                                  <td><?php echo $v->contract_id?></td>
                                  <td><?php
                                     $res = CmsPurchaseProperty::model()->find("contract_id='$v->contract_id'");
                                     if($res){
                                       $data = CmsProperty::model()->find("id='$res->property_id'");
                                       if($data){
                                         $item = BaseEstate::model()->find("id='$data->estate_id'");
                                         echo $item?$item->name:"";
                                       }
                                      }
                                     ?>
                                  </td>
                                  <td><?php
                                     $res=CmsPurchaseProperty::model()->find("contract_id='$v->contract_id'");
                                     if($res){
                                       $data=CmsProperty::model()->find("id='$res->property_id'");
                                       if($data){
                                         $item=BaseBuilding::model()->find("id='$data->building_id'");
                                         echo $item?$item->name:"";
                                       }
                                      }
                                     ?>
                                  </td>
                                  <td><?php
                                     $res=CmsPurchaseProperty::model()->findAll("contract_id='$v->contract_id' ");
                                     if($res){
                                       foreach ($res as $key => $value) {
                                         $item=CmsProperty::model()->find("id='$value->property_id'");
                                         echo $item?$item->house_no.'<br>':"";
                                       }
                                     }
                                     ?>
                                  </td>
                                  <td><?php
                                              echo date("Y-m-d",$v->cycle_start)."至".date("Y-m-d",$v->cycle_end);
                                      ?>
                                  </td>
                                  <td><?php echo number_format($v->payee_money/100,2);?></td>
                                  <td>
                                  <div class="btn-operation">
                                    <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                                      操作
                                      <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                                    <?php if(AdminPositionModul::has_modul("301_04")) {?>
                                      <a href="/admin/finance/detail/id/<?php echo $user->id;?>"><span>确认</span></a>
                                    <?php }?>
                                    <?php if (AdminPositionModul::has_modul("301_03")) { ?>
                                    <a href="/admin/finance/delete/id/<?php echo $value->contract_id;?>" onclick="javascript:return confirm('确实要删除吗?');">删除</a>
                                    <?php } ?>
                                      </ul>
                                    </div>
                                  </td>
                                </tr>
                        <?php
                              }
                          }?>


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
