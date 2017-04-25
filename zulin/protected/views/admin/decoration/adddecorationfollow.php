<style>
  .dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
  #sales{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-600px;border-top:3px solid #222;border-radius:20px;border-top: 1px solid #167ac7!important;}
  #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  #follow{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-600px;border-top:3px solid #222;border-radius:20px;border-top: 1px solid #167ac7!important;padding-bottom:30px;}
  #closemodel2{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}

    #sample_editable_1_new{height:33px;}
  #sample_editable_1_new:hover{background:#0160cb!important;}
  #sample_editable_1:hover{background:#0160cb!important;}
  #sample_editable_1{margin-right:20px;}
  td a{margin-right:10px;}
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
  .control-labels{float:left;width:224px;padding-top:8px;text-align:right;}
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

                                <div class="caption"><i class="icon-reorder"></i>添加装修跟进</div>

                                <div class="tools">
                                </div>

                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="/admin/decoration/DecorationFollowAddSave"   method="post"  class="form-horizontal js-submit" >
                                    <input type="hidden" name="decoration_id"  value="<?php echo $decoration_id;  ?>">
                                    <div class="control-group">
                                    </div>
                                    <div class="control-group" style="clear:both;">
                                      <label class="control-labels">跟进人：</label>
                                      <div class="controls" style="line-height:26px;">
                                        <?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:''; ?>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">装修状态：</label>
                                      <div class="controls">
                                        <select name="decoration_status" id="">
                                          <?php foreach ($ursarr['decoration_status'] as $key => $value) {
                                          if($key!==0){
                                            ?>
                                              <option value="<?php echo $key?>" ><?php echo $value ?></option>
                                          <?php
                                           }
                                          }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div id="once">
                                      <div class="control-group">
                                        <label class="control-labels">施工管理商圈负责人：</label>
                                        <div class="controls">
                                          <input type="text"  id="responsible_people" name="responsible_people" style="width:220px"  maxlength="18">
                                        </div>
                                      </div>
                                      <div class="control-group">
                                        <label class="control-labels">装修队：</label>
                                        <div class="controls">
                                          <input type="text" name="decoration_team"  maxlength="100">
                                        </div>
                                      </div>
                                      <div class="control-group">
                                        <label class="control-labels">电话：</label>
                                        <div class="controls">
                                          <input type="text" name="phone"  placeholder="" onblur="check_phone(this.value,this);">
                                        </div>
                                      </div>
                                      <div class="control-group">
                                          <label class="control-labels">产生金额：</label>
                                        <div class="controls">
                                          <input type="text" name="money" value="" maxlength="7"  onblur="check(this.value,this);">元
                                        </div>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">装修详情：</label>
                                      <div class="controls">
                                          <textarea name="decoration_details"  rows="5" style="width:500px;" maxlength="255"></textarea>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <div class="controls">
                                        <label style="color:red;">完工信息（非必填，完工时填写）</label>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">实际工程起止日：</label>
                                      <div class="controls">
                                        <input type="text" id="datepicker" value="" class="m-wrap" style="width:90px;" name="actual_start_time"/>至<input type="text" id="datepicker1" value="" class="m-wrap" style="width:90px;" name="actual_end_time"/>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">实际花费与预计花费的差额：</label>
                                      <div class="controls">
                                        <input type="text" name="actual_expected" onblur="check(this.value,this);" maxlength="9">元
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">差额原因：</label>
                                      <div class="controls">
                                        <textarea name="reason"  rows="5" style="width:500px;" maxlength="127"></textarea>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">工程装修折合结算总天数：</label>
                                      <div class="controls">
                                        <input type="text" name="total_settlement_days" onblur="check(this.value,this);" maxlength="7">
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">是否已结算：</label>
                                      <div class="controls"  style="margin-top:2px !important">
                                        <label class="radio" >
                                          <input name="settlement" type="radio" value="1" class="span2 m-wrap"/>是
                                        </label>
                                        <label class="radio">
                                          <input name="settlement" type="radio"  value="2" class="span2 m-wrap"/>否
                                        </label>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">施工质量：</label>
                                      <div class="controls" style="margin-top:2px !important">
                                        <label class="radio" >
                                          <input name="construction_quality" type="radio" value="1" class="span2 m-wrap"/>优
                                        </label>
                                        <label class="radio" >
                                          <input name="construction_quality" type="radio"  value="2" class="span2 m-wrap"/>良
                                        </label>
                                        <label class="radio" >
                                          <input name="construction_quality" type="radio"  value="3" class="span2 m-wrap"/>一般
                                        </label>
                                        <label class="radio" >
                                          <input name="construction_quality" type="radio"  value="4" class="span2 m-wrap"/>差
                                        </label>
                                      </div>
                                    </div>
                                    <div class="control-group">
                                      <label class="control-labels">销售同事产品卖相反馈及备注：</label>
                                      <div class="controls">
                                        <textarea name="feedback_remarks"  rows="5" style="width:500px;" maxlength="255"></textarea>
                                      </div>
                                    </div>
                                    <div style="margin-left:250px;margin-top:25px;margin-bottom:20px;">
                                      <button type="submit" class="btn btn-primary submit js-btnadd">确定</button>
                                      <button type="button" class="btn" id="btnn">取消</button>
                                    </div>
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
  //日期
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