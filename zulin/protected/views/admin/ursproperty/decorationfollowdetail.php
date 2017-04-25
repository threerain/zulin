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
  // Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
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
                                <div class="controls control">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;跟进人：<?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"";?>
                                </div>
                              </div>
                              <div class="control-group">
                                <div class="controls control">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日期：<?php echo $model->ctime?date("Y.m.d H:i:s",$model->ctime):""; ?>
                                </div>
                              </div>
                              <div class="control-group">
                                <div class="controls control">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装修状态：<?php echo $ursarr['decoration_status']["$model->decoration_status"]; ?>
                                </div>
                              </div>
                              <div class="control-group">
                                <div class="controls control">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装修队：<?php echo $model->decoration_team; ?>
                                </div>
                              </div>
                              <div class="control-group">
                                <div class="controls control">
                                  产品质量区域负责人：<?php $item=AdminUser::model()->find("id='$model->responsible_people'"); echo $item?$item->nickname:""; ?>
                                </div>
                              </div> 
                              <div class="control-group">
                                <div class="controls control">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;电话：<?php echo $model->phone; ?>
                                </div>
                              </div>
                              <div class="control-group">
                                <div class="controls control">
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;产生金额：<?php echo $model->money/100; ?>
                                </div>
                              </div>                
                              <div class="control-group">
                                <div class="controls control">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;装修详情：                            
                                    <textarea name="decoration_details"  readonly=true rows="6" style="width:600px;resize:none;"><?php echo $model->decoration_details; ?></textarea>
                                </div>
                              </div>
                              <button type="button" class="btn" onClick="javascript:history.go(-1)">返回</button>
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
