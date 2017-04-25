
<style>
  .dataTables_filter{margin-top:20px!important;padding-left:60px;}
  div>b{font-size:16px;font-weight:bold;}
  b{font-size:14px;font-weight:normal;}
  .dataTables_filter span{margin-right:20px;}
    .control-group{margin-bottom:0px !important;margin-top:0px !important;padding-bottom: 10px !important;}
    .controls{font-size:13px;line-height:36px;color:#555;width:220px;margin-top:1px !important;}
    .control-label{padding-top: 0px !important;width:100px !important;}
    .control-dd{width:300px;font-size:15px;float:left}
</style>
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
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);//(validation验证js)
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    ");
?>
        <div class="page-content">

            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

            <div id="portlet-config" class="modal hide">

                <div class="modal-header">

                    <button data-dismiss="modal" class="close" type="button"></button>

                    <h3>portlet Settings</h3>

                </div>

                <div class="modal-body">

                    <p>Here will be a configuration form</p>

                </div>

            </div>

            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

            <!-- BEGIN PAGE CONTAINER-->

            <div class="container-fluid">

                <!-- BEGIN PAGE HEADER-->

                <div class="row-fluid" style="min-height:10px;"></div>

                <!-- END PAGE HEADER-->



                <!-- BEGIN PAGE CONTENT-->

                <div class="row-fluid">

                    <div class="span12">

                        <!-- BEGIN VALIDATION STATES-->

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>客服-详情</div>

                                <div class="tools">
<!--
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                              </div>
<!--客服外勤人员-->
                            <div class="portlet-body form" style="overflow:hidden;">
                                <!-- BEGIN FORM-->
                        <div class="span8" style="margin-left:40px;margin-top:30px;">
                          <form action=""  id="form_edit"  method="post"  class="form-horizontal js-submit">
                              <input type="hidden" name="id" value="<?php echo $model->id ?>">
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label">合同ID:</label>
                                    <div class="controls">
                                     <a href="/admin/purchasecontract/detail/id/<?php echo $model==null?"":$model->contract_id;?>"><?php echo $model->contract_id?></a>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label">客服外勤人员:</label>
                                    <div class="controls">
                                     <?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"";?>
                                    </div>
                                </div>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label">实际收房日期:</label>
                                    <div class="controls">
                                      <?php echo $model->actual_date?date('Y-m-d',$model->actual_date):"";?>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                              <?php foreach($data as $k => $v) { ?>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label" >品牌:</label>
                                    <div class="controls">
                                      <?php echo $v['estate_id'] ?>
                                    </div>
                                </div>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label" >系列:</label>
                                    <div class="controls">
                                      <?php echo $v['building_id'] ?>
                                    </div>
                                </div>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label" >编号:</label>
                                    <div class="controls">
                                      <?php echo $v['house_no'] ?>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                              <?php }  ?>
                                <div class="control-group" style="float:left;">
                                    <label class="control-label" >华亮收购人:</label>
                                    <div class="controls">
                                     <?php $item=AdminUser::model()->find("id='$model->hualiang_id'"); echo $item?$item->nickname:"";?>
                                    </div>
                                </div>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label" >幼狮销售:</label>
                                    <div class="controls">
                                      <?php $item=AdminUser::model()->find("id='$model->sale_id'"); echo $item?$item->nickname:"";?>
                                    </div>
                                </div>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label" >质量管理部:</label>
                                    <div class="controls">
                                      <?php $item=AdminUser::model()->find("id='$model->quality_id'"); echo $item?$item->nickname:"";?>
                                    </div>
                                </div>
                                <div class="control-group" style="float:left;" >
                                    <label class="control-label" >幼狮装饰:</label>
                                    <div class="controls">
                                      <?php $item=AdminUser::model()->find("id='$model->decorate_id'"); echo $item?$item->nickname:"";?>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                              <!-- 上传收房清单图片 -->
                              <div class="dataTables_filter" style="margin-bottom:3px;clear:both;">
                                <span style="font-size:14px;line-height:36px;">
                                  收房清单:
                                </span>
                              </div>
                              <div class="control-group" style="margin-top:1px;">
                                  <div class="controls">
                                      <div id="list_photo_div" style="float:left;<?php echo $list_photo==null?'display: none':''; ?>">
                                      <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                      <?php if ($list_photo): ?>
                                          <?php foreach ($list_photo as $key => $value): ?>
                                            <a target="_Blank" href="<?php echo $value ?>"><img name="list_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                            <a style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/serpurcontract/download?url=<?php echo $value;?>">下载</a>
                                          <?php endforeach ?>
                                      <?php endif ?>
                                      </div>
                                  </div>
                              </div>
                    <!-- 上传收房清单图片结束 -->
                          <div style="border:1px solid #C0C0C0; width:1100px;min-height:200px">
                          <div class="dataTables_filter" style="clear:both;margin-left:-15px;"><b>水电费记录</b></div>
                          <?php
                          if($ser_Hydropower){
                              foreach($ser_Hydropower as $key=>$value){
                          ?>
                            <div class="dataTables_filter" style="margin-left:20px;margin-top:20px">
                              <div class="control-dd" style="margin-left:-30px">
                                <span>
                                <b>表底数/电费余额:</b><?php echo $value->electricity_fees/100;?>
                                  <?php
                                    if($value->electricity_unit==1){
                                      echo '度';
                                    }
                                    if($value->electricity_unit==2){
                                      echo '元';
                                    }
                                  ?>
                                </span>
                              </div>
                            <div><br><br>
                                <div class="control-dd" style="margin-left:45px">
                                热水:<?php echo $value->hot_water/100;?>
                                  <?php
                                    if($value->hot_unit==1){
                                      echo '立方';
                                    }
                                    if($value->hot_unit==2){
                                      echo '元';
                                    }
                                  ?>
                                </div>
                                <div class="control-dd">
                                中水:<?php echo $value->middle_water/100;?>
                                  <?php
                                    if($value->middle_unit==1){
                                      echo '立方';
                                    }
                                    if($value->middle_unit==2){
                                      echo '元';
                                    }
                                  ?>
                                </div>
                                <div class="control-dd" >
                                  冷水:<?php echo $value->cold_water/100;?>
                                  <?php
                                    if($value->cold_unit==1){
                                      echo '立方';
                                    }
                                    if($value->cold_unit==2){
                                      echo '元';
                                    }
                                  ?>
                                </div>
                            </div><br><br>
                            <div >
                                  <div class="control-dd" style="margin-left:30px">
                                  燃气表:<?php echo $value->gas_meter/100; ?>
                                  <?php
                                    if($value->gas_unit==1){
                                      echo '立方';
                                    }
                                    if($value->gas_unit==2){
                                      echo '元';
                                    }
                                  ?>
                                </div><br>
                            </div>
                     </div>
                      <?php
                          }
                        }
                      ?><br>
                      <div style="margin-left:45px;padding-left:60px;clear:both;">
                        <div >
                      支付方式:<?php echo $model->pay_method;?>
                    </div><br>
                        <div>
                         实际付款:<?php echo $model->actual_payment/100;?>元
                       </div>
                      </div>
                  </div><br>
                      <!--这里是特殊费用-->
                      <div style="border:1px solid #C0C0C0; width:1100px;min-height:200px">
                      <div class="dataTables_filter" style="clear:both;"><b>特殊费用</b></div>
                          <?php
                            if($house_no){
                              foreach($house_no as $k=>$value){
                          ?>
                            <div class="dataTables_filter" style="margin-left:20px;margin-bottom:10px;clear:both;" >
                                <div class="control-dd" style="margin-left:30px">
                                  编号:<?php echo $house_no[$k];?>
                                </div>
                                <div class="control-dd" style="margin-left:10px">
                                  类型:
                                  <?php
                                    if($type[$k]==1){
                                      echo '费用预留';
                                    }
                                    if($type[$k]==2){
                                      echo '费用缴纳';
                                    }
                                  ?>
                                </div><br><br>
                                  <div class="control-dd" style="margin-left:15px">
                                    费用详情:<?php echo $details[$k];?>
                                </div><br><br>
                                  <div style="margin-left:25px">
                                   费用金额:<?php echo $amount[$k];?>元
                                </div>
                            </div>
                            <?php
                              }
                            }
                            ?>
                        </div><br>
                      <div style="border:1px solid #C0C0C0; width:1100px;min-height:200px">
                      <div  class="dataTables_filter" style="clear:both;"><b>隐患记录</b></div>
                      <!--这里是隐患记录-->
                      <?php
                        if($ser_aftersales){
                          foreach($ser_aftersales as $key=>$value){
                      ?>
                      <div class="dataTables_filter" style="margin-left:20px;">
                        <div style="margin-bottom:10px;">
                          <div class="control-dd" style="margin-left:-15px">
                          客服外勤人员:<?php $item=AdminUser::model()->find("id='$value->criter_id'"); echo $item?$item->nickname:"";?>
                        </div>
                          <br/>
                        </div>
                        <div class="control-dd" style="margin-bottom:10px;margin-left:30px">
                          编号:<?php $house_no=Property::house_no($value->property_id); echo $house_no; ?>
                        </div>
                        <div  style="margin-bottom:50px">
                          <div class="control-dd">
                          维修方:
                            <?php
                              if($value->service_type==1){
                                echo '车主';
                              }
                              if($value->service_type==2){
                                echo '幼狮';
                              }
                            ?>
                          </div>
                        </div>
                        <div style="margin-bottom:10px;clear:both;">
                          <div class="control-dd" style="margin-left:15px">
                        报修隐患:<?php echo $value->hidden;?>
                        </div>
                          <br/><br>

                        <div class="control-dd" style="margin-left:15px">
                          隐患详情:<?php echo $value->hidden_infor;?><br><br>
                        </div>
                        </div>
                        <!-- 图片开始 -->
                        <?php
                          $ser_hidden_photo = SerHiddenPhoto::model()->find("after_id='$value->id'");
                          if($ser_hidden_photo){
                              $ser_hidden_photo=$ser_hidden_photo->url;
                              $ser_hidden_photo = explode(",",$ser_hidden_photo);
                              array_shift($ser_hidden_photo);
                        ?>
                        <div style="clear:both"><div class="control-dd" style="margin-left:15px">隐患图片:</div></div>
                        <div class="control-group" style="margin:0;clear:both;">
                            <div class="controls">
                                <div id="property_photo_div" style="float:left;height:100px;<?php echo $ser_hidden_photo==null?'display: none':''; ?>">
                                  <?php foreach ($ser_hidden_photo as $key => $v): ?>
                                    <a target="_Blank" href="<?php echo $v ?>"><img name="property_photo_show" src="<?php echo $v ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
                                    <a style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/serpurcontract/download?url=<?php echo $v;?>">下载</a>
                                  <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <?php

                          }
                        ?>
                         <!-- 图片结束 -->
                        <div  style="margin-bottom:10px;clear:both;">
                          <div class="control-dd" style="margin-left:-15px;margin-top:-10px">
                            隐患预计花费:<?php echo $value->hidden_cost/100;?>
                          </div>
                          <br/>
                          <div class="control-dd" style="margin-top:5px">
                          费用承担方:
                            <?php
                              if($value->bear_type==1){
                                echo '车主';
                              }
                              if($value->bear_type==2){
                                echo '幼狮';
                              }
                            ?>
                          </div>
                          <br><br>
                        </div>
                      </div>
                      <?php
                          }
                        }
                      ?>
                      <div class="dataTables_filter" style="margin-left:20px;">
                        <div class="control-dd" style="margin-left:-80px">
                          约定车主维修结束日期:<?php $data=SerAfterSales::model()->find("ser_contract_id='$model->id' and service_type=1 "); echo $data->hope_end_time?date("Y.m.d",$data->hope_end_time):""; ?>
                        </div>
                        <br><br>
                        <div style="margin-left:10px;font-size:15px">
                           车主电话:<?php echo $model->owner_phone; ?>
                        </div>
                      </div>
                      <!--这里是隐患结束-->
                    </div>
                      <button type="button" class="btn"  onclick="javascript:history.go(-1);"  style="margin-left:800px!important;margin-bottom:30px;">返回</button>
                    </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
<!-- 隐藏的水电费 -->
<div id="ser_hydropower" style="display:none">
    <div class="span8">
        <div class="dataTables_filter" style="margin-bottom:10px">
          <span>
          <b>表底数/电费余额:</b><input type="text"  value=""  name="electricity_fees[]" >
            <select name="electricity_unit[]" id="" >
        <option value="">请选择</option>
        <option value="1" >度</option>
        <option value="2">元</option>
            </select>
          </span>
        </div>
    </div>
     <div class="span8">
        <div class="dataTables_filter" style="margin-bottom:10px">
          <span>
          <b>热水</b><input type="text"  value=""  name="hot_water[]" >
            <select name="hot_unit[]" id="" >
        <option value="">请选择</option>
        <option value="1" >立方</option>
        <option value="2">元</option>
            </select>
          </span>

            <span>
          <b>中水</b><input type="text"  value=""  name="middle_water[]" >
            <select name="middle_unit[]" id="" >
        <option value="">请选择</option>
        <option value="1" >立方</option>
        <option value="2">元</option>
            </select>
          </span>
          <span>
          <b>冷水</b><input type="text"  value=""  name="cold_water[]" >
            <select name="cold_unit[]" id="" >
        <option value="">请选择</option>
        <option value="1" >立方</option>
        <option value="2">元</option>
            </select>
          </span>
        </div>
    </div>
   <div class="span8">
        <div class="dataTables_filter" style="margin-bottom:10px">
          <span>
          <b>燃气表:</b><input type="text"  value=""  name="gas_meter[]" >
            <select name="gas_unit[]" id="" >
        <option value="">请选择</option>
        <option value="1" >立方</option>
        <option value="2">元</option>
            </select>
          </span>
        </div>
    </div>
</div>
<!-- 隐藏的特殊费用 -->
<div id="addspecial" style="display:none;">
    <div class="dataTables_filter" style="margin-bottom:10px">
        <div class="span8">
            <div class="dataTables_filter" style="margin-bottom:10px">
              <span>
              <b>编号:</b>
                <select name="house_no[]" class="house_no">
                </select>
              </span>
            </div>
        </div>
        <div class="span8">
            <div class="dataTables_filter" style="margin-bottom:10px">
              <span>
              <b>类型:</b>
                <select name="type[]" id="">
          <option value="">请选择</option>
          <option value="1">费用预留</option>
          <option value="2">费用缴纳</option>
                </select>
              </span>
            </div>
        </div>
    <div style="clear:both"></div>
      <span>
      <b> 费用详情:</b><input type="text"  value=""  name="details[]">
      </span>
       <span>
      <b> 费用金额:</b><input type="text"  value=""  name="amount[]">元
      </span>
    </div>
</div>
<!-- 多编号的时出来 -->
<div class="span8 " id="addroom" style="display:none">
   <div class="dataTables_filter" style="margin-bottom:10px">

        <span class="test line21"><b>品牌:</b>
          <span class="estates"></span>
   </span>
   <span class="test line21"><b>系列:</b>
    <span class="buildings"></span>
   </span>
    <span class="test line21"><b>编号:</b>
            <span class="rooms" ></span>
    </span>
   </div>
 </div>
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
