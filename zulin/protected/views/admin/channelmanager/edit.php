﻿
  <!-- BEGIN PAGE LEVEL STYLES -->
<?php
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');

?>
  <!-- END PAGE LEVEL STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);

  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_channel_manager.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/cms_channel_manager.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();
    FormComponents.init();"

    );
?>
  <!-- END PAGE LEVEL SCRIPTS -->

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

                                <div class="caption"><i class="icon-reorder"></i>渠道公司人员维护-编辑</div>

                                <div class="tools">
<!-- 
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="/admin/channelmanager/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $model->id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">渠道公司<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="hidden"  required name="channel_id" id="channel_id" class="span3 select2"  value="<?php echo $model->channel_id?>" title="">
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">姓名<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="name" type="text" maxlength="20" required  class="span3 m-wrap" value="<?php echo $model==null?"":$model->name;?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">电话</label>
                                        <div class="controls">
                                            <input name="phone" type="text" onblur="check_phone(this.value,this);" class="span3 m-wrap" value="<?php echo $model==null?"":$model->phone;?>"/>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
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