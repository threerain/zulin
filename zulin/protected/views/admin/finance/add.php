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
<style type="text/css">

    .control-group {
        padding-bottom: 0px;
        margin-right:120px
    }
    .control-label{
        width:110px!important;
        text-align:right
    }
    .controls{
        padding-left:35px
    }
</style>
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


//
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();
    ");
?>
<?php //css
  //<!-- BEGIN PAGE LEVEL STYLES -->
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);

  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;

  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
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

                        <div class="portlet box green">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>收款人-新增</div>

                                <div class="tools">
                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="/admin/finance/addsave" id="form_add"  method="post"  class="form-horizontal js-submit">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
																		<div class="control-group" >
																				<label class="control-label">品牌<span class="required">*</span></label>
																				<div class="controls" style="margin-left:-60px;">
																						<input type="hidden" name="estate_id" id="estate_id" class="span4 select2" required style="width:230px">
																				</div>
																		</div>
																		<div class="control-group" >
																				<label class="control-label">系列<span class="required">*</span></label>
																				<div class="controls" style="margin-left:-60px;">
																						<input type="hidden" name="building_id" id="building_id" class="span4 select2" required style="width:230px">
																				</div>
																		</div>
																		<div class="control-group" >
																				<label class="control-label">编号<span class="required">*</span></label>
																				<div class="controls" style="margin-left:-60px;">
																						<input type="hidden" name="room_number" id="room_number" class="span4 select2" required style="width:230px">
																						<input type="hidden" name="property_id[]" id="property_id">
																				</div>
																		</div>
                                    <div class="control-group">
                                        <label class="control-label">付款金额<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="payee_money" type="text"  required class=""/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">收款日期<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="datepicker3" value="" name="cycle_start" type="text" required>
                                        		至
                                            <input id="datepicker4" value="" name="cycle_end" type="text" required>
                                        </div>
                                    </div>

                                    <script type="text/javascript">
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
                                    <div class="form-actions">
                                        <button  type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<style>
    .theFont{font-size: 20px;}
</style>
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
