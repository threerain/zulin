<style>
#jqaddlink{display:none!important;}
  .dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
  #sales{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-600px;border-top:3px solid #222;border-radius:20px;border-top: 1px solid #167ac7!important;}
  #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
 /* #follow{background-color:#fff;display:none;z-index:1;position:fixed;;width:50%;;top:20%;left:30%;overflow:auto;height:60%;border-top:3px solid #222;border-radius:20px;border: 1px solid #167ac7!important;}*/
  #closemodel2{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}

    #sample_editable_1_new{height:33px;}
  #sample_editable_1_new:hover{background:#0160cb!important;}
  #sample_editable_1:hover{background:#0160cb!important;}
  #sample_editable_1{margin-right:20px;}
  td a{margin-right:10px;}
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
  .control-labels{float:left;width:224px;padding-top:5px;text-align:right;margin-top:6px !important;}
  .control-group{margin-top:2px !important;padding-bottom:16px !important;}
</style>
<?php
$this->breadcrumbs=array(
    'Admins'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List admin', 'url'=>array('index')),
    array('label'=>'Manage admin', 'url'=>array('admin')),
);
?>
<?php //css
  //<!-- BEGIN PAGE LEVEL STYLES -->
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
   Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
  App.init();
  FormValidation.init();
  FormComponents.init();
  ");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
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
            <div class="caption"><i class="icon-globe"></i>装修管理列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid" style="height:120px;">
                <form  action="/admin/decoration/index" style="margin:0;margin-top:30px;">
                  <div class="dataTables_filter">
                    <input type="hidden" value="<?php echo $search ?>" name="search">
                    <span>
                      商圈：<input type="text"  value="<?php echo $k_area;?>"  name="k_area" style="width:150px;">
                    </span>
                    <span>
                      品牌：<input type="text" value="<?php echo $k_estates;?>" name="k_estates" style="width:150px;">
                    </span>
                    <span>
                      系列：<input type="text"  value="<?php echo $k_building;?>" name="k_building" style="width:150px;">
                    </span>
                    <span>
                      编号：<input type="text" value="<?php echo $k_number;?>" name="k_number" style="width:150px;">
                    </span>
                    <span>
                      </button><input type="checkbox" id="highsearch">高级搜索</button>
                    </span>
                    <button id="sample_editable_1_new" class="btn btn-primary" type="submit">搜索 <i class="icon-search"></i></button>
                  </div>
                  <div id="content" style="display:none;">
                    <div class="dataTables_filter">
                      <span>录入日期：<input type="text" id="datepicker1" value="<?php echo $k_sctime;?>" name="k_sctime" style="width:150px;" />&nbsp;至&nbsp;<input type="text" id="datepicker2" value="<?php echo $k_ectime;?>"  name="k_ectime" style="width:150px;" /></span>
                      <span>整体工程起止日:<input type="text" id="datepicker3" value="<?php echo $k_project_stime;?>" name="k_project_stime" style="width:150px;"/>&nbsp;至&nbsp;<input type="text" id="datepicker4" value="<?php echo $k_project_etime;?>" name="k_project_etime" style="width:150px;"/></span>
                      <span style="margin-top:10px;">
                        质量管理对接人：<input type="text" value="<?php echo $k_docking_people;?>" name="k_docking_people" style="width:150px;margin-top:10px;">
                      </span>
                    </div>
                    <div class="dataTables_filter">
                      装修状态：
                      <?php
                      foreach ($ursarr['decoration_status'] as $key => $value) {
                      ?>
                        <input type="checkbox" name="k_decstatus[]" value="<?php echo $key;?>" <?php if(in_array("$key",$k_decstatus)){echo 'checked';}else{ echo '';}?> ><?php echo $value;?>
                      <?php }?>
                    </div>
                  </div>
                  <script type="text/javascript">
                      var bb = $("input[name=search]").val();
                       if(bb == 2){
                          $("#content").css("display","block")
                          $("#highsearch").attr("checked",true)
                       }
                  </script>
                </form>
                <div class="btn-group pull-right">
                  <?php if(AdminPositionModul::has_modul("802_09")) {?>
                    <a href="/admin/decoration/add">
                    <button id="sample_editable_1" class="btn btn-primary">
                        新增<i class="icon-plus"></i>
                    </button>
                    </a>
                  <?php }?>
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover"><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                  <!-- <th class="hidden-480">收房合同</th> -->
                  <th class="hidden-480">商圈</th>
                  <th class="hidden-480">品牌</th>
                  <th class="hidden-480">系列</th>
                  <th class="hidden-480">编号</th>
                  <th class="hidden-480">建筑面积</th>
                  <th class="hidden-480">录入日期</th>
                  <th class="hidden-480">整体工程起止日</th>
                  <th class="hidden-480">质量管理对接人</th>
                  <th class="hidden-480">类型</th>
                  <th class="hidden-480">预算结算状态</th>
                  <th class="hidden-480">装修状态</th>
                  <th >操作</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if($list){
                  foreach($list as $model){
              ?>
                <tr>
                  <!-- <td><?php //echo $model->contract_id; ?></td> -->
                  <td>
                    <?php
                      $res=QualityDecorationProperty::model()->find("decoration_id='$model->id'");
                      if($res){
                        $data=CmsProperty::model()->find("id='$res->property_id'");
                        $item=BaseArea::model()->find("id='$data->area_id'");
                        echo $item?$item->name:"";
                       }
                    ?>
                  </td>
                  <td>
                    <?php
                      $res=QualityDecorationProperty::model()->find("decoration_id='$model->id'");
                      if($res){
                        $data=CmsProperty::model()->find("id='$res->property_id'");
                        $item=BaseEstate::model()->find("id='$data->estate_id'");
                        echo $item?$item->name:"";
                       }
                    ?>
                  </td>
                  <td>
                    <?php
                      $res=QualityDecorationProperty::model()->find("decoration_id='$model->id'");
                      if($res){
                        $data=CmsProperty::model()->find("id='$res->property_id'");
                        $item=BaseBuilding::model()->find("id='$data->building_id'");
                        echo $item?$item->name:"";
                       }
                    ?>
                  </td>
                  <td>
                    <?php
                      $res=QualityDecorationProperty::model()->findAll("decoration_id='$model->id'");
                      if($res){
                        foreach ($res as $key => $value) {
                          $item=CmsProperty::model()->find("id='$value->property_id'");
                          echo $item?$item->house_no.'<br>':"";
                        }

                      }
                    ?>
                  </td>
                  <td>
                    <?php
                      $res=QualityDecorationProperty::model()->findAll("decoration_id='$model->id'");
                      if($res){
                        $sum_area=0;
                        foreach ($res as $key => $value) {
                          $item=CmsProperty::model()->find("id='$value->property_id'");
                          $sum_area=$sum_area+$item->area;
                        }
                        echo $sum_area;
                      }
                    ?>
                  </td>
                  <td><?php echo $model->ctime?date("Y-m-d",$model->ctime):""; ?></td>
                  <td><?php echo $model->project_start_time?date("Y-m-d",$model->project_start_time).'到':"";echo $model->project_end_time?date("Y-m-d",$model->project_end_time):""; ?></td>
                  <td><?php $item=AdminUser::model()->find("id='$model->docking_people'"); echo $item?$item->nickname:"";?></td>
                  <td><?php if($model->decoration_type==1){echo '自主装修';}else if($model->decoration_type==2){echo '装修二次升级';}else if($model->decoration_type==3){echo '租户意向装修';}?></td>
                  <td><?php $data=QualityDecoration::model()->status();echo $data['status']["$model->status"];?></td>
                  <td>
                    <?php
                      $item=UrsDecorationFollow::model()->find(array(
                        'condition'=>"decoration_id='$model->id' and deleted='0'",
                        'order'=>'ctime desc',
                      ));
                      if($item){
                        echo $item->decoration_status?$ursarr['decoration_status']["$item->decoration_status"]:'未装修';
                      }else{
                        echo '未装修';
                      }
                    ?>
                  </td>
                  <td>
                  <div class="btn-operation">
                    <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                      操作
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                        <a href="/admin/decoration/detail/id/<?php echo $model->id;?>" style="display:block">详情</a>
                  
                    <?php
                      if($model->status!=2 && AdminPositionModul::has_modul("802_02")){
                    ?>
                    <a href="/admin/decoration/edit/id/<?php echo $model->id;?>" style="display:block">编辑</a>
                    <?php
                      }
                    ?>
                    <?php if(AdminPositionModul::has_modul("802_03")) {?>
                      <a href="" address="/admin/decoration/delete/id/<?php echo $model->id;?>" style="display:block" class="delete" data-toggle="modal" data-target="#about-modal">删除</a>
                    <?php }?>
                    <?php
                      if($model->status==1){
                    ?>
                    <?php if(AdminPositionModul::has_modul("802_04")) {?>
                      <a href="/admin/decoration/create/id/<?php echo $model->id;?>" style="display:block">添加结算单信息</a>
                    <?php }?>
                    <?php
                      }else if($model->status==2){
                    ?>
                      <?php if(AdminPositionModul::has_modul("802_10")) {?>
                        <a href="/admin/decoration/edit/id/<?php echo $model->id;?>" style="display:block">添加预算信息</a>
                      <?php }?>
                    <?php
                      }
                    ?>
                    <?php if(AdminPositionModul::has_modul("802_05")) {?>
                      <a href="/admin/decoration/ticket/id/<?php echo $model->id;?>" style="display:block">罚款单</a>
                    <?php }?>
                    <?php if(AdminPositionModul::has_modul("802_06")) {?>
                      <a href="/admin/decoration/ticketlist/id/<?php echo $model->id;?>" style="display:block">查看罚款单</a>
                    <?php }?>
                    <?php if(AdminPositionModul::has_modul("802_07")) {?>
                      <a href="/admin/decoration/DecorationFollowAdd/id/<?php echo $model->id;?>" style="display:block">写装修跟进</a>
                    <?php }?>
                    <?php if(AdminPositionModul::has_modul("802_08")) {?>
                      <a href="/admin/decoration/decorationfollow/id/<?php echo $model->id;?>" >查看装修跟进</a>
                    <?php }?>
                      </ul>
                    </div>  
                  </td>
                </tr>
              <?php
                  }
                }
              ?>
              </tbody>
            </table>
<!-- 删除弹出框 -->
  <div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label"
         aria-hidden="true">
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
<!-- 删除结束狂 -->

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
<div id="errModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">

    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h3 id="myModalLabel2">错误</h3>

    </div>

    <div class="modal-body">

        <p>Body goes here...</p>

    </div>

    <div class="modal-footer">

        <button data-dismiss="modal" class="btn green">OK</button>

    </div>

</div>

<script>
  //点高级搜索时不让隐藏的隐藏
  $(function(){
    $("#highsearch").click(function(){
        var aa = $("input[name=search]").val();
    console.log(aa);
        $("#content").toggle();
        if(aa == 1 || aa == ''){
            $("input[name=search]").val(2);
        }else{
            $("input[name=search]").val(1);
        }
    })

  })

/*拖动面板效果*/
$(function(){
  $("#follow").draggable();
})

  jQuery('#btnn').click(function(){
    document.getElementById("follow").style.display = "none";
  })
  $('#closemodel2').click(function(){
    document.getElementById("follow").style.display = "none";
  })
  //日期
  var picker = new Pikaday({
    field: document.getElementById('datepicker1'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });

  var picker = new Pikaday({
    field: document.getElementById('datepicker2'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
  var picker = new Pikaday({
    field: document.getElementById('datepicker3'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
  var picker = new Pikaday({
    field: document.getElementById('datepicker4'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
</script>
