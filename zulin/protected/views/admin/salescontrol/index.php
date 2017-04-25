<style>
  .dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
  #sales{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-600px;border-top:3px solid #222;border-radius:20px;border-top: 1px solid #167ac7!important;}
  #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;z-index:100;}

  #closemodel2{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  input{width:150px;}
  select{width:150px;}
  .table td{padding:5px;}
</style>
<?php if(empty($news_content_id)){ ?>
    echo  "<style>  #jqaddlink{display:none!important;} </style>";
<?php } ?>
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
<!-- BEGIN PAGE LEVEL STYLES -->
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
// Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);
?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
// Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
//<!-- END PAGE LEVEL PLUGINS -->;

//<!-- BEGIN PAGE LEVEL SCRIPTS -->;
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
 Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
  App.init();
  FormValidation.init();
  FormComponents.init();
  ");
?>

<!-- End PAGE LEVEL SCRIPTS -->
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

          <div class="caption"><i class="icon-globe"></i>销控管理</div>
          <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a> -->
          </div>
        </div>
        <div class="portlet-body">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">

            <div class="row-fluid" style="height:120px">
              <div >
                <form action="/admin/salescontrol/index" style="margin:30px 30px 0px" >
                    <div class="dataTables_filter" style="margin-bottom:10px" id="">
                        <input type="hidden" name='search' value="<?php echo $search ?>">
                      <span>品牌:<input type="text" value="<?php echo $keyword_estates?>" name="keyword_estates"></span>

                      <span>系列：<input type="text"  value="<?php echo $keyword_building?>" name="keyword_building"></span>
                      <span>编号：<input type="text" value="<?php echo $keyword_room_number?>" name="keyword_room_number"></span>
                      <button id="sample_editable_1_new" class="btn btn-primary" type="submit" >
                        搜索 <i class="icon-search"></i>
                      </button>


                    </span>
                    </div><br>
                     <div id="content" style="display:none;">

                       <span style="margin-left:50px"> 朝向：<input type="text" value="<?php echo $keyword_orientation?>" name="keyword_orientation">
                          组团：<input type="text" name="keyword_estate_group_id" value="<?php echo $keyword_estate_group_id;?>">
                       </span>
                       <span><br><br>
                         <span>&nbsp;
                           装修状态：
                           <?php
                           foreach ($ursarr['decoration_status'] as $key => $value) {
                           ?>
                             <input type="checkbox" name="keyword_decoration_status[]" value="<?php echo $key;?>" <?php if(in_array("$key",$keyword_decoration_status)){echo 'checked';}else{ echo '';}?> ><?php echo $value;?>
                           <?php }?>
                         </span>
                     </div>
                    <div class="dataTables_filter" style="margin-bottom:10px">
                     <script type="text/javascript">
                          var picker = new Pikaday({
                              field: document.getElementById('datepicker'),
                              firstDay: 1,
                              minDate: new Date('2010-01-01'),
                              maxDate: new Date('2030-12-31'),
                              yearRange: [2000,2030]
                          });

                          var picker = new Pikaday({
                              field: document.getElementById('datepicker1'),
                              firstDay: 1,
                              minDate: new Date('2010-01-01'),
                              maxDate: new Date('2030-12-31'),
                              yearRange: [2000,2030]
                          });


                      </script>

                      <!-- 高级搜索隐藏 -->
                      <script type="text/javascript">
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
                          var bb = $("input[name=search]").val();
                           if(bb == 2){
                              $("#content").css("display","block")
                              $("#highsearch").attr("checked",true)
                           }
                      </script>
                      <!-- 高级搜索隐藏结束 -->

                </form>

            </div>

            <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                  <!-- <th class="hidden-480">合同id</th> -->
<!--                  <th class="hidden-480">商圈</th>-->
<!--                  <th class="hidden-480">组团</th>-->
                  <th class="hidden-480">品牌</th>
                  <th class="hidden-480">系列</th>
                  <th class="hidden-480">编号</th>
<!--                  <th class="hidden-480">销售面积</th>-->
                  <th class="hidden-480">租车报价</th>
                  <!-- <th class="hidden-480">单价<br>(元/天/㎡)</th> -->
                  <th class="hidden-480">参考月租金</th>
<!--                  <th class="hidden-480">朝向</th>-->
                  <th class="hidden-480">礼品</th>
<!--                  <th class="hidden-480">出车预警</th>-->
<!--                  <th class="hidden-480">装修状态</th>-->
                  <th class="hidden-480">车源操作</th>
<!--                  <th class="hidden-480">跟进操作</th>-->
                </tr>
              </thead>
              <tbody>

                    <?php foreach($list as $model){
                      ?>
                      <!-- 查询合同 -->
                    <tr  >
                      <!-- <td  ><?php
                        echo $list?$model->contract_id:'';
                        if(!empty($news_type)){
                            echo "<sup class=''  style='color:red;font-size:12px'>新消息</sup>";
                        } ?>
                      </td> -->

                      <!-- 品牌 -->
                      <td >
                        <!-- <table class="table" style="border:0px;"> -->
                        <?php
                          $res=CmsProperty::model()->find("id='$model->property_id' and deleted='0'");
                          $item=BaseEstate::model()->find("id='$res->estate_id'"); echo $item?$item->name:"";
                        ?>
                        <!-- </table> -->
                      </td>
                      <!-- 系列 -->
                      <td >
                        <?php
                         $res=CmsProperty::model()->find("id='$model->property_id' and deleted='0'");
                         $item=BaseBuilding::model()->find("id='$res->building_id'"); echo $item?$item->name:"";
                        ?>
                      </td>
                      <!-- 编号 -->
                      <td >

                        <?php
                        $res=CmsProperty::model()->find("id='$model->property_id' and deleted='0'");
                        echo $res->house_no;
                        ?>

                      </td>


                      <!-- 参考单价 -->
                      <td style="vertical-align: middle">

                      <?php
                              echo $model->unit_price/100;
                              echo '元/天';

                          ?>
                      </td>
                      <!-- 参考月租金 -->
                      <td style="vertical-align: middle">

                        <?php
                                      echo round($model->unit_price/100*365/12,2);
                                      echo '元';

                        ?>

                      </td>

                      <!-- 礼品 -->
                      <td>

                        <?php

                                    $item=UrsGoodsDetail::model()->find("property_id='$model->property_id'  and deleted = 0")['json'];
                                    $item=(Array)json_decode($item);
                                    $check= 1;
                                    foreach ($item as $key_item => $value_item) {
                                        if($check == 1){
                                            $key_item = explode('-',$key_item);
                                            $value_item_one = explode(',',$value_item);
                                        }
                                        $check++;
                                    }

                                    if($value_item_one){
                                        foreach ($value_item_one as $key_s => $value_s) {
                                            $goods = UrsGoodsStorage::model()->find("id = '$value_s'");
                                            if($goods){
                                                echo $goods['goods_name'].'('.$goods['goods_unit'].')' ."<br>";
                                            }
                                        }
                                    }
                                    unset($value_item_one);
                                    unset($check);

                                    $count++;

                        ?>
                      </td>
                      <!-- 车源相关操作 -->
                      <td style="vertical-align: middle; text-align:center">

                        <!-- <a href="#" style='display:block'>车源详情</a><a href="#" style='display:block'>移出销控</a><a href="#" style='display:block'>查看跟进</a> -->


                            <!-- <tr rowspan="<?php echo $count ?>" style="text-align:center"><td style="vertical-align:middle;border-left:0px;text-align:center"> -->
                              <div class="btn-operation" style="margin-left:60px">
                                <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                                  操作
                                  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="left:-20px; width:100px !important;margin-bottom:20px!important;">


                              <a href="/admin/salescontrol/detail/id/<?php echo $model->property_id;?>" style="display:block">车源详情</a>
                            <?php if(AdminPositionModul::has_modul("603_02")) {?>
                              <a href="/admin/salescontrol/delete/id/<?php echo $model->property_id;?>" style="display:block">移出销控</a>
                          <?php  }?>

                          <!-- 权限没设定 -->
                          <?php if(AdminPositionModul::has_modul("603_07")) {?>
                              <a href="/admin/salescontrol/edit?property_id=<?php echo $model->property_id?>" style="display:block">编辑</a>

                          <?php  }
                        }
                        ?>

                      </div>
                    </ul>
                  </div>
                      </td>

                    </tr>

              </tbody>
            </table>
            <div class="row-fluid" style='margin-top:60px;'>
              <div class="span4">
                <div class="dataTables_info" id="sample_1_info"></div>
              </div>
              <div class="span12" >
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





    <!-- 写跟进 -->
    <script language="javascript" type="text/javascript">
      //选中元素
      $('.fow').click(function(){
        var property_id=$(this).attr('id');
        document.getElementById("property_id").value=property_id;
        // $("#property_id").value="aa";
        if(document.getElementById("follow").style.display != "block")
        {
          document.getElementById("follow").style.display = "block";
        }
        else
        {
          document.getElementById("follow").style.display = "none";
        }
        $(".quxiao").click(function(){
          $("#follow").css('display','none');
        })
      });
    </script>
    <style media="screen">
      #follow{background-color:#fff;display:none;z-index:1;position:fixed;width:50%;top:20%;left:30%;overflow:auto;height:60%;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;}
    </style>
  <div id="follow" class="portlet-body form" >
   <div style="height:50px;background:#167AC7;margin-bottom:30px;" class="portlet-title">
      <div class="caption" style="line-height:50px;font-size:20px;text-indent:30px;color:#fff">写跟进</div>
    </div>
    <form action="/admin/salescontrol/salefollow"   method="post"  class="form-horizontal js-submit">
        <style>
            .control{float:left;}
        </style>
      <input type="hidden" name="property_id" id="property_id" value="<?php ?>">
      <div class="control-group">
        <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
        <div class="controls control">
          <label>跟进类型：</label>
            <select name="type">
                <option value="1" selected>带看</option>
                <option value="2">电话</option>
            </select>
        </div>
      </div>
      <div class="control-group">
        <div class="controls control">
          <label>所属商圈</label><input type="text" value="<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); if($item->department_id){$data = AdminDepartment::model()->find("id = '$item->department_id'");echo  $data?$data->name:'';} ?>" disabled=true>
        </div>
        <div class="controls control">
          <label>所属小组</label><input type="text" value="<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); if($item->department_id){$data = AdminDepartment::model()->find("id = '$item->department_id'");echo  $data?$data->name:'';} ?>" disabled=true>
        </div>
        <div class="controls control">
          <label>带看人姓名</label><input type="text" value="<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:'' ?>" disabled=true>
        </div>
      </div>
<!--                     <div class="control-group">
        <div class="controls">
          渠道公司：<input type="hidden" name="channel_id" id="channel_id" class="span6 select2" style="width:320px">
        </div>
        <div class="controls">
          渠道人员姓名：<input type="hidden" name="channel_manager_id"  id="channel_manager_id" class="span6 select2" style="width:230px">
        </div>
      </div> -->
      <div class="control-group">
          <div class="controls control">
            <label style="float:left;line-height:36px;">渠道公司<span style="color:red;font-size:13px;">*</span></label>
              <input type="hidden" name="channel_id" id="channel_id" required class="select2" style="width:164px">
          </div>
          <div class="controls control">
            <label style="float:left;line-height:36px;">渠道人员<span style="color:red;font-size:13px;">*</span></label>
             <input type="hidden" name="channel_manager_id" required id="channel_manager_id" class="select2" style="width:164px">
          </div>
      </div>
        <!-- <div class="control-group" style="float:left;">
            <label class="control-label" style="font-size:12px;">渠道公司<span style="color:red">*</span></label>
            <div class="controls control">
                <input type="hidden" name="channel_id" id="channel_id" required class="select2" style="width:180px">
            </div>
        </div>
        <div class="control-group" style="float:left;">
            <label class="control-label" style="font-size:12px;">渠道人员<span style="color:red">*</span></label>
            <div class="controls control">
               <input type="hidden" name="channel_manager_id" required id="channel_manager_id" class="select2" style="width:180px">
            </div>
        </div> -->
      <div class="control-group" style="clear:both;">
        <div class="controls control">
          电&nbsp;&nbsp;话:<input type="text" name="phone" maxlength="11" onkeyup="value=value.replace(/[^\d.]/g,'')" >
        </div>
        <div class="controls control" style="margin-left:100px">
        订房日期<span style="color:red">*</span><input type="text" id="datepicker" name="room_time" required />
        </div>
      </div>
      <div class="control-group">
        <div class="controls control">
          客户业态<span style="color:red">*</span><input type="text" required name="customer_business" maxlength="80" >
        </div>
        <div class="controls control" style="margin-left:100px">
          预&nbsp;&nbsp;算<span style="color:red;">*</span><input type="text" name="budget" required maxlength="11" placeholder="只能填数字或小数点" onkeyup="value=value.replace(/[^\d.]/g,'')" >
        </div>
      </div>
      <div class="control-group">
        <div class="controls control">
          需求面积<span style="color:red">*</span><input type="text" name="demand_area"  required maxlength='11' placeholder="只能填数字或小数点。" onkeyup="value=value.replace(/[^\d.]/g,'')">㎡
        </div>
        <div class="controls control">
          需求商圈<span style="color:red">*</span><input type="text" required name="demand_district"maxlength='36' >
        </div>
      </div>
      <div class="control-group">
        <div class="controls control" style="margin-left:80px">
          是否负责人:
          <label class="radio">
              <input type="radio"  name="responsible_person" value="1" />
              是
          </label>
          <label class="radio">
              <input type="radio" name="responsible_person" value="2" />
              否
          </label>
        </div>
      </div>
      <div class="control-group">
        <div class="controls control">
            跟进情况:
            <textarea name="follow_detail"  maxlength="255" rows="8" style="width:600px;"></textarea>
        </div>
      </div>
      <div style="margin-left:250px;margin-top:25px;">
        <button  type="submit" class="btn btn-primary">确定</button>
        <button type="button" style="border-radius:0!important;" onclick="quxiao22()">取消</button>
      </div>
      <div class="control-group" id="closemodel" >
                       ×
       </div>
  </form>
</div>
      <script type="text/javascript">
      var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        firstDay: 1,
        minDate: new Date('2010-01-01'),
        maxDate: new Date('2030-12-31'),
        yearRange: [2000,2030]
      });
</script>
<script>
$(function(){
  $("#follow").draggable();
  $("#sales").draggable();
    })
</script>
<script>
$(function(){
  $("#closemodel").click(function(){
    $("#follow").hide();
  });
})
function quxiao22() {
  $("#follow").hide();
}
</script>
