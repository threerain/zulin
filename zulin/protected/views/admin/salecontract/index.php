<style>
   input{width:150px;}
 select{width:150px;}
span{font-size: 14px;}
   #sample_editable_1_new{height:33px;}
  #sample_editable_1_new:hover{background:#0160cb!important;}
  #sample_editable_1:hover{background:#0160cb!important;}
  #sample_editable_1{margin-right:0px;}
  td a{margin-right:10px;}
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
    #weiyue{background-color:#fff;display:none;z-index:1;position:fixed;width:33%;top:20%;left:40%;height:auto;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;}
    #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
    #signer_edit{background-color:#fff;display:none;z-index:1;position:fixed;width:33%;top:20%;left:40%;height:auto;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;}
     #signer_edit_closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}

    .form-horizontal .control-label {
    float: left;
    width: 74px;
    padding-top: 5px;
    text-align: right;
}
</style>
<?php if(empty($news_content_id)){ ?>
    echo  "<style>  #jqaddlink{display:none!important;} </style>";
<?php } ?>
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
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
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
            <div class="caption"><i class="icon-globe"></i>出车合同列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
               <?php if(AdminPositionModul::has_modul("102_01")) {?>
              <div class="row-fluid" style="height:116px;">
                <form action="/admin/salecontract/index" style="margin:30px;" >
                  <div class="dataTables_filter" id="sample_1_filter">
                    <div class="dataTables_filter" style="margin-bottom:10px" id="">
                    <input type="hidden" value="<?php echo $search ?>" name="search">
                    <span>ID：<input type="text" value="<?php echo $k_id;?>" name="k_id"></span>
                    <span>品牌：<input type="text" value="<?php echo $k_estates;?>" name="k_estates"></span>
                    <span>系列：<input type="text"  value="<?php echo $k_building;?>" name="k_building"></span>
                    <span>编号：<input type="text" value="<?php echo $k_room_number;?>" name="k_room_number"></span>
                    <span>
                      </button><input type="checkbox" id="highsearch">高级搜索</button>
                    </span>
                    <button id="sample_editable_1_new" class="btn btn-primary" type="submit" style="margin-left:-34px;height:30px;line-height:20px;">
                      搜索 <i class="icon-search"></i>
                    </button>
                  </div>
                  <div id="content" style="display:none;">
                    <div class="dataTables_filter" style="margin-bottom:10px">
                      <span>承租人类型：
                        <select name="k_lessee_type" id="">
                          <option value="">请选择</option>
                          <option value="1" <?php echo $k_lessee_type==1?'selected=selected':''?>>公司</option>
                          <option value="2" <?php echo $k_lessee_type==2?'selected=selected':''?>>个人</option>
                        </select>
                      </span>
                      <span>出租人：<input type="text" value="<?php echo $lessor;?>" name="lessor"></span>


                      <span>录入人：<input type="text"  value="<?php echo $k_admin;?>" name="k_admin"></span>
                      <span>状态：
                      <select name="k_status" id="">
                        <option  value="" <?php echo $k_status===''?'selected':''?> >请选择</option>
                                    <?php foreach (Yii::app()->params['contract_status'] as $key => $value) {
                                    ?>
                                       <?php
                                            if ($key!=1){
                                        ?>
                                        <option value="<?php echo $key?>" <?php echo $k_status===$key? "selected":""?>><?php echo $value ?></option>
                                            <?php
                                        }
                                            ?>
                                    <?php
                                    }?>

                      </select>
                      </span>
                      <span >证件：
                      <select name="k_papers_ok" id="">
                        <option value="">请选择</option>
                        <option value="1" <?php echo $k_papers_ok==1?'selected=selected':''?>>全</option>
                        <option value="2" <?php echo $k_papers_ok==2?'selected=selected':''?>>不全</option>
                      </select>
                      </span>
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:10px">
                      <span style="margin-right:80px">录入日期：<input type="text" id="datepicker" value="<?php echo $k_ctime1;?>" name="k_ctime1" />&nbsp;至&nbsp;<input type="text" id="datepicker1" value="<?php echo $k_ctime2;?>" name="k_ctime2" /></span>
                      <span>签约日期：<input type="text" id="datepicker3" value="<?php echo $k_signing_date1;?>" name="k_signing_date1"/>&nbsp;至&nbsp;<input type="text" id="datepicker4" value="<?php echo $k_signing_date2;?>" name="k_signing_date2"/></span>
                        <span class="test">审核：
                          <select name="reviewed" id="">
                            <option value="" <?php echo $reviewed===''?'selected':''?>>请选择</option>
                            <option value="0" <?php echo $reviewed===0?'selected':''?>>未审核</option>
                            <option value="1" <?php echo $reviewed===1?'selected':''?>>已审核</option>
                          </select>
                        </span>
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
                    </div>
                  </div>
                  <script type="text/javascript">
                      $(function(){
                        if($("input[name=search]").val()==1){
                          $("#highsearch").attr('checked',true);
                          $("#content").show();
                        }
                        $("#highsearch").click(function(){
                          $("#content").toggle();
                          var value =  $("input[name=search]").val();
                          if(value==1){
                             $("input[name=search]").val(0);
                          }else{
                             $("input[name=search]").val(1);
                          }
                        })
                        $("#sample_editable_1_new").click(function(){
                          //没有搜索的话，就去掉高级搜索
                          if($("input[name=search]").val()!=1){
                            $("#content").remove();
                          }
                        })

                      })
                  </script>
                </form>
              </div>
                  <?php }?>
              <div class="btn-group pull-right">
                <?php if(AdminPositionModul::has_modul("101_02")) {?>
                <a href="/admin/salecontract/create">
                <button id="sample_editable_1" class="btn btn-primary">
                新建 <i class="icon-plus"></i>
                </button>
                </a>
                <?php }?>
              </div>
            </div>
            <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead>
                <tr>
                  <th class="">合同id</th>
                  <th class="">品牌</th>
                  <th class="">系列</th>
                  <th class="">编号</th>
                  <th class="">承租人类型</th>
                  <!-- <th class="">录入人</th> -->
                  <th class="">录入日期</th>
                  <th class="">签约日</th>
                  <th class="">签约人</th>
                  <!-- <th class="">单价(元/天/㎡)</th> -->
                  <th class="">状态</th>
                  <th class="">审核</th>
                  <th class="">证件</th>
                  <th>操作</th>
                  <th>合同复印件</th>
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
                      <td class="contract_id"><?php echo $model->id;
                        ?>
                        </td>
                        <td class=" ">
                          <?php
                            $res=CmsPurchaseProperty::model()->find("contract_id='$model->id'");
                            if($res){
                              $data=CmsProperty::model()->find("id='$res->property_id'");
                              $item=BaseEstate::model()->find("id='$data->estate_id'");
                              echo $item?$item->name:"";
                             }
                          ?>
                        </td>
                        <td class=" ">
                          <?php
                            $res=CmsPurchaseProperty::model()->find("contract_id='$model->id'");
                            if($res){
                              $data=CmsProperty::model()->find("id='$res->property_id'");
                              $item=BaseBuilding::model()->find("id='$data->building_id'");
                              echo $item?$item->name:"";
                             }
                          ?>
                        </td>
                        <td style="vertical-align: middle">
                          <?php
                            $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->id'");
                            if($res){
                              foreach ($res as $key => $value) {
                                $item=CmsProperty::model()->find("id='$value->property_id'");
                                echo $item?$item->house_no.'<br>':"";
                              }
                            }
                          ?>
                        </td>
                        <td class=" "><?php echo $model->lessee_type==1?'公司':'个人'; ?></td>
                        <!--<td class=" "><?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:""; ?></td> -->

                        <td class=" "><?php echo $model->ctime?date("Y-m-d",$model->ctime):""; ?></td>
                        <td class=" "><?php echo $model->signing_date?date("Y-m-d",$model->signing_date):""; ?></td>
                        <td class=" "><?php $ccs = CmsContractSigner::model()->findAll("contract_id = '$model->id'");
                        $nickname ='';
                        foreach ($ccs as $key => $value) {
                             $nickname .= AdminUser::model()->find("id = '$value->signer'")->nickname.'/';
                        } echo substr($nickname,0,-1) ; ?></td>
                        <td class=" "><?php echo Yii::app()->params['contract_status'][$model->status]; ?></td>
                        <td><?php echo $model->reviewed==1?'是':'否' ?></td>
                        <td class=" "><?php
                          echo $model->papers_ok==1?'全':'不全';
                          ?>
                        </td>

                        <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                              <?php if(AdminPositionModul::has_modul("102_08")) {?>

                              <a href="/admin/salecontract/detail/id/<?php echo $model->id;?>" style='display:block;'>详情</a>
                              <?php }?>

                              <?php if(AdminPositionModul::has_modul("102_03") && $model->reviewed!=1) {?>

                                <a href="/admin/salecontract/edit/id/<?php echo $model->id;?>" style='display:block;'>编辑</a>

                              <?php }?>
                              <!-- 审核后编辑-->
                              <?php if(AdminPositionModul::has_modul("101_16") && $model->reviewed==1) {?>
                                <a href="/admin/salecontract/edit/id/<?php echo $model->id;?>" style="display:block">编辑</a>
                              <?php }?>

                              <?php if(AdminPositionModul::has_modul("102_04") && $model->reviewed!=1) {?>
                              <a class="del_contract" data-toggle="modal" data-target="#about-modal" href="" address="/admin/salecontract/delete/id/<?php echo $model->id;?>" style='display:block;'>删除</a>
                              <?php }?>

<!---->
<!--                              --><?php //if(AdminPositionModul::has_modul("102_05")) {?>
<!--                              --><?php //if ($model->reviewed!=1){?>
<!--                              <a href="/admin/salecontract/reviewed/id/--><?php //echo $model->id;?><!--" style='display:block;'>审核</a>-->
<!--                              --><?php //}else{?>
<!--                              已审核-->
<!--                              --><?php //}?>
<!--                              --><?php //}?>
                              <?php if(AdminPositionModul::has_modul("102_03")&&($model->status==0||$model->status==9||$model->status==-1)) {?>
                                <a class="wei" data="<?php echo $model->id ?>" href="javascript:;"  style="display:block">违约设置</a>
                              <?php }?>
                              <?php if(AdminPositionModul::has_modul("102_03")&&($model->status==0||$model->status==9||$model->status==-1)) {?>
                              <a class="signer" data="<?php echo $model->id ?>" href="javascript:;"  style="display:block">补充签约人</a>
                              <?php }?>

                            </ul>
                          </div>
                        </td>
                        <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                              <?php if(AdminPositionModul::has_modul("102_10")) {?>
                                <a href="/admin/salecontract/copyedit/id/<?php echo $model->id;?>" style="display:block">编辑</a>
                              <?php }?>
                              <?php if(AdminPositionModul::has_modul("102_11")) {?>
                                <a href="/admin/salecontract/copydetail/id/<?php echo $model->id;?>" style="display:block">查看</a>
                              <?php }?>
                              <?php if(AdminPositionModul::has_modul("102_12")) {?>
                                <a class="del_copy" data-toggle="modal" data-target="#about-modal" href="" address="/admin/salecontract/copydelete/id/<?php echo $model->id;?>" style="display:block">删除</a>
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


            <div id="weiyue" class="portlet-body form" id="form_add"  method="post"  class="form-horizontal js-submit">
              <div style="height:40px;background:#167AC7;margin-bottom:20px;" class="portlet-title">
                 <div class="caption" style="line-height:40px;font-size:20px;text-indent:30px;">违约设置</div>
              </div>
              <form action="/admin/salecontract/weiyue" id="form_add"  method="post"  class="form-horizontal js-submit">
                  <input type="hidden" name="contract_id" id="contract_id" value="">
                  <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      输入格式有误，请检查输入的数据.
                  </div>
                  <div class="alert alert-success hide">
                      <button class="close" data-dismiss="alert"></button>
                      数据输入验证成功!
                  </div>
                  <div class="control-group" style="float:left;margin-left:20%;">
                      <label class="control-label" >违约类型:</label>
                      <div class="controls">
                          <select name="w_status" id="">
                                    <?php foreach (Yii::app()->params['contract_status'] as $key => $value) {
                                    ?>
                                       <?php
                                            if ($key!=1){
                                        ?>
                                        <option value="<?php echo $key?>" <?php echo $k_status===$key? "selected":""?>><?php echo $value ?></option>
                                            <?php
                                        }
                                            ?>
                                    <?php
                                    }?>
                          </select>
                      </div>
                  </div>
                  <div class="control-group" id="break_contract" style="display:none;float:left;margin-left:20%;">
                      <label class="control-label" >违约原因:</label>
                      <div class="controls">
                          <select name="break_contract" style="width:200px;">
                              <option value="1">提前退租</option>
                              <option value="2">申请换租->扩租</option>
                              <option value="3">申请换租->缩租</option>
                              <option value="4">申请换租->同租</option>
                              <option value="5">转租</option>
                              <option value="6">其他</option>
                          </select>
                      </div>
                  </div>
                  <div class="control-group" id="break_contract_text" style="display:none;float:left;margin-left:20%;">
                      <label class="control-label">其他原因:</label>
                      <div class="controls">
                          <input  name="break_contract_text"  type="text" value="" />
                      </div>
                  </div>
                            <script>
                            $("select[name=w_status]").change(function(){
                                //如果是违约，选择违约原因
                                if($(this).val()==5){
                                    $("#break_contract").show();
                                }else{
                                    $("#break_contract").hide();
                                }
                                $("select[name=break_contract]").change(function(){
                                    if($(this).val()==6){
                                        $("#break_contract_text").show();
                                    }else{
                                        $("#break_contract_text").hide();

                                    }
                                })

                            })
                            </script>
                  <div class="form-actions" style="clear:both;">
                      <button  type="submit" class="btn btn-primary submit js-btnadd follo" style="margin-left:100px;margin-bottom:100px;">确定</button>
                      <button type="button" class="btn" style="margin-bottom:100px;" id="btnn">取消</button>
                  </div>
                   <div class="control-group" id="closemodel">
                     ×
                  </div>
              </form>
            </div>
                        <div id="signer_edit" class="portlet-body form" id="form_add"  method="post"  class="form-horizontal js-submit">
              <div style="height:40px;background:#167AC7;margin-bottom:20px;" class="portlet-title">
                 <div class="caption" style="line-height:40px;font-size:20px;text-indent:30px;">合同编号:</div>
              </div>
              <form action="/admin/pluscommission/signer" id="form_add"  method="post"  class="form-horizontal js-submit">
                  <input type="hidden" name="contract_id" id="contract_id_signer" value="">
                  <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      输入格式有误，请检查输入的数据.
                  </div>
                  <div class="alert alert-success hide">
                      <button class="close" data-dismiss="alert"></button>
                      数据输入验证成功!
                  </div>

                  <div class="control-group">
                      <label class="control-label" >幼狮签约人<!-- 司公业务员ID（） --></label>
                      <div class="controls qianyueren" style="margin-top: 15px!important;" >

                      </div>
                  </div>

                  <div class="control-group">
                      <label class="control-label" >幼狮签约人<!-- 司公业务员ID（） --></label>
                      <div class="controls">
                          <input type="hidden" name="salesman_id[]" value="" id="salesman_id" class="span6 select2 salesman_id " style="width:200px;">
                          <input type="button" value="添加" style="width:60px;display:none;" class="span1 m-wrap addqudao" >
                          <input type="button" value="删除" style="width:60px;display:none;" class="span1 m-wrap delqudao" >
                      </div>
                  </div>

                  <div class="qudao" style="clear:both;display:none;">
                      <div class="control-group" style="">
                          <label class="control-label">幼狮签约人</label>
                          <div class="controls">
                              <input type="hidden" name="salesman_id[]"  id="salesman_id" class="span6 select2 salesman_id" style="width:200px">
                              <input type="button" value="添加" style="width:60px;display:none;" class="span1 m-wrap addqudao" >
                              <input type="button" value="删除" style="width:60px;display:none;" class="span1 m-wrap delqudao" >
                          </div>
                      </div>
                  </div>

                  <div id="qudaorenyuan"></div>



                  <div class="form-actions">
                      <button  type="submit" class="btn btn-primary submit js-btnadd follo" style="margin-left:150px;">确定</button>
                      <button type="button" class="btn"  id="signer_btnn">取消</button>
                  </div>
                   <div class="control-group" id="signer_edit_closemodel">
                     ×
                  </div>
              </form>
            </div>

            <div class="row-fluid">
              <div class="">
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
               <a id="left" class="btn btn-primary"  href="" onclick="javascript:return true;">确定</a>

               <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
          </div>
      </div>
  </div>
</div>
<script>
$(function(){

  $(".del_copy").click(function(){
    $("#left").attr('href',$(this).attr('address'));
  })
  $(".del_contract").click(function(){
    $("#left").attr('href',$(this).attr('address'));
  })
})
</script>
<script>
$(function(){
  $("#weiyue").draggable();  $("#signer_edit").draggable();//模态框的拖拽性
    })

$(function(){
  $("#closemodel").click(function(){
    $("#weiyue").hide();
  });
  $("#signer_edit_closemodel").click(function(){
    $("#signer_edit").hide();//关闭模态框
  });
})
$('#btnn').click(function(){
  $("#weiyue").hide();
})
$('#signer_btnn').click(function(){
$("#signer_edit").hide();//点击取消关闭模态框

})
</script>
  <script>
  $(".yongyou_id").blur(function(){
    var yongyou_id = $(this).val();
   var contract_id =  $(this).parent().parent().find(".contract_id").html();

    $.post('/admin/pluscommission/yongyou',{yongyou_id:yongyou_id,contract_id:contract_id},function(msg){
      if(msg==1){
        alert('保存失败')
      }
    })
  })
  </script>
<script>
  var handleSelec2 = function () {
      function format(state) {
          if (!state.id) return state.text; // optgroup
          return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
      }

      function movieFormatResult(movie) {
          var markup = "<table class='movie-result'><tr>";
          if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
              markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
          }
          markup += "<td valign='top'><h5>" + movie.title + "</h5>";
          if (movie.critics_consensus !== undefined) {
              markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
          } else if (movie.synopsis !== undefined) {
              markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
          }
          markup += "</td></tr></table>"
          return markup;
      }

      function movieFormatSelection(movie) {
          return movie.title;
      }

      $("#qudaorenyuan").find(".salesman_id").select2({
          placeholder: "",
          minimumInputLength: 1,
          ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
              url: "/admin/admin/ajaxlist",
              dataType: 'json',
              data: function (term, page) {
                  return {
                      q: term, // search term
                      page_limit: 10,
                      apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                  };
              },
              results: function (data, page) { // parse the results into the format expected by Select2.
                  // since we are using custom formatting functions we do not need to alter remote JSON data
                  return {
                      results: data.movies
                  };
              }
          },
          initSelection: function (element, callback) {
              // the input tag has a value attribute preloaded that points to a preselected movie's id
              // this function resolves that id attribute to an object that select2 can render
              // using its formatResult renderer - that way the movie name is shown preselected
              var id = $(element).val();
              if (id !== "") {
                  $.ajax("/admin/admin/ajaxitem", {
                      data: {
                          id:id,
                          apikey: "ju6z9mjyajq2djue3gbvv26t"
                      },
                      dataType: "json"
                  }).done(function (data) {
                      callback(data);
                  });
              }
          },
          formatResult: movieFormatResult, // omitted for brevity, see the source of this page
          formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
          dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
          escapeMarkup: function (m) {
              return m;
          } // we do not want to escape markup since we are displaying html in results
      });
      $("#salesman_id").select2({
          placeholder: "",
          minimumInputLength: 1,
          ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
              url: "/admin/admin/ajaxlist",
              dataType: 'json',
              data: function (term, page) {
                  return {
                      q: term, // search term
                      page_limit: 10,
                      apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                  };
              },
              results: function (data, page) { // parse the results into the format expected by Select2.
                  // since we are using custom formatting functions we do not need to alter remote JSON data
                  return {
                      results: data.movies
                  };
              }
          },
          initSelection: function (element, callback) {
              // the input tag has a value attribute preloaded that points to a preselected movie's id
              // this function resolves that id attribute to an object that select2 can render
              // using its formatResult renderer - that way the movie name is shown preselected
              var id = $(element).val();
              if (id !== "") {
                  $.ajax("/admin/admin/ajaxitem", {
                      data: {
                          id:id,
                          apikey: "ju6z9mjyajq2djue3gbvv26t"
                      },
                      dataType: "json"
                  }).done(function (data) {
                      callback(data);
                  });
              }
          },
          formatResult: movieFormatResult, // omitted for brevity, see the source of this page
          formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
          dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
          escapeMarkup: function (m) {
              return m;
          } // we do not want to escape markup since we are displaying html in results
      });
  }

  $(function(){
          $(".submit").click(function(){
            $(".qudao").eq(0).remove();
        })
          handleSelec2();
  })

  $(".addqudao").eq(0).show();
  $(".delqudao").eq(0).hide();
  $(".addqudao").live('click',function(){
      qudao = $(".qudao").eq(0).clone();

      var num = $(".addqudao").length;
      $("#qudaorenyuan").append(qudao);
      $("#qudaorenyuan").find(".addqudao").remove();
      $("#qudaorenyuan").find(".delqudao").show();
      $("#qudaorenyuan").find(".qudao").show();
      $(".delqudao").click(function(){
          $(this).parent().parent().remove();
      })
   handleSelec2();

})
  </script>
  <script language="javascript" type="text/javascript">
  //选中元素
  $('.wei').click(function(){
    var contract_id=$(this).attr('data');
    document.getElementById("contract_id").value=contract_id;
    // $("#property_id").value="aa";
    if(document.getElementById("weiyue").style.display != "block")
    {
      document.getElementById("weiyue").style.display = "block";
    }
    else
    {
      document.getElementById("weiyue").style.display = "none";
    }
  });

  $('.signer').click(function(){
  var contract_id=$(this).attr('data');
  document.getElementById("contract_id_signer").value=contract_id;
  // $("#property_id").value="aa";
  if(document.getElementById("signer_edit").style.display != "block")
  {
    document.getElementById("signer_edit").style.display = "block";
  }
  else
  {
    document.getElementById("signer_edit").style.display = "none";
  }
  $(".caption").html('合同编号:'+contract_id);

  $.post('/admin/pluscommission/getsigner',{contract_id:contract_id},function(msg){

    var str = '';
    for( x in msg ){
      str +=msg[x].name+':<input type="text" name="scale[]" value="'+msg[x].scale+'" style="width:20px;" />';
    }
    // str = str.substring(0,str.length-1);
    $("#signer_edit").find(".qianyueren").html(str)

    if(msg==null){
      $('.qianyueren').parent().remove();
    }
  },'json')
});
</script>
