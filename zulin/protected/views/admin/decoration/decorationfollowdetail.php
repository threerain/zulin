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
  .control-labels{float:left;width:224px;padding-top:5px;text-align:right;}
</style>

<?php //css
  //<!-- BEGIN PAGE LEVEL STYLES -->
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-admin.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();");
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

                                <div class="caption"><i class="icon-reorder"></i>装修跟进详情</div>

                                <div class="tools">
                                </div>

                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                              <input type="hidden" name="property_id" id="property_id_decoration" value="">
                              <div class="control-group">
                              </div>
                              <div class="control-group">
                                <label class="control-labels">跟进人：</label>
                                <div class="controls">
                                  <?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"";?>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-labels">跟进时间：</label>
                                <div class="controls">
                                  <?php echo $model->ctime?date("Y.m.d H:i:s",$model->ctime):""; ?>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-labels">装修状态：</label>
                                <div class="controls">
                                  <?php echo $ursarr['decoration_status']["$model->decoration_status"]; ?>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-labels">装修队：</label>
                                <div class="controls">
                                  <?php echo $model->decoration_team; ?>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-labels">产品质量区域负责人：</label>
                                <div class="controls">
                                  <?php $data=AdminUser::model()->find("id='$model->responsible_people'"); echo $data?$data->nickname:""; ?>
                                </div>
                              </div> 
                              <div class="control-group">
                                <label class="control-labels">电话：</label>
                                <div class="controls">
                                  <?php echo $model->phone; ?>
                                </div>
                              </div> 
                              <div class="control-group">
                                <label class="control-labels">产生金额：</label>
                                <div class="controls">
                                  <?php echo $model->money/100; ?>
                                </div>
                              </div>   
                              <div class="control-group">
                                <label class="control-labels">装修详情：</label>
                                <div class="controls">
                                  <textarea name="decoration_details" readonly=true rows="5" style="width:600px;resize:none;"><?php echo $model->decoration_details; ?></textarea>
                                </div>
                              </div>             
                              <div class="control-group">
                                <div class="controls control">
                                  <label style="color:red;">完工信息（以下信息非必填项目完工时填写）</label>
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-labels">实际花费与预计花费的差额：</label>
                                <div class="controls">
                                  <?php echo $model->actual_expected?($model->actual_expected/100).'元':''; ?>
                                </div>
                              </div> 
                              <div class="control-group">
                                <label class="control-labels">差额原因：</label>
                                <div class="controls">
                                  <textarea name="reason"  rows="5" readonly=true style="width:600px;resize:none;"><?php echo $model->reason; ?></textarea>
                                </div>
                              </div> 
                              <div class="control-group">
                                <label class="control-labels">工程装修折合结算总天数：</label>
                                <div class="controls">
                                  <?php echo $model->total_settlement_days?$model->total_settlement_days/100:''; ?>
                                </div>
                              </div>  
                              <div class="control-group">
                                <label class="control-labels">是否已结算：</label>
                                <div class="controls">
                                    <?php
                                      if($model->settlement==1){
                                        echo '是';
                                      }
                                      if($model->settlement==2){
                                        echo '否';
                                      }
                                    ?>
                                </div>
                              </div>  
                              <div class="control-group">
                                <label class="control-labels">施工质量：</label>
                                <div class="controls">
                                  <?php
                                    if($model->construction_quality==1){
                                      echo '优';
                                    }else if($model->construction_quality==2){
                                      echo '良';
                                    }else if($model->construction_quality==3){
                                      echo '一般';
                                    }else if($model->construction_quality==4){
                                      echo '差';
                                    }
                                  ?>
                                </div>
                              </div> 
                              <div class="control-group">
                                <label class="control-labels">销售同事产品卖相反馈及备注：</label>
                                <div class="controls">
                                  <textarea name="feedback_remarks"  rows="5" readonly=true style="width:600px;resize:none;"><?php echo $model->feedback_remarks; ?></textarea>
                                </div>
                                <button type="button" class="btn" style="margin-left:400px!important;" onClick="javascript:history.go(-1)">返回</button>
                              </div> 
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
