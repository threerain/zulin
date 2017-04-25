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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-purchase.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();
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

                        <div class="portlet box green">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>购买-新增</div>

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
                                <form action="/admin/purchase/addsave" id="form_sample_2"  method="post"  class="form-horizontal js-submit">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label">品牌<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="estate">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">编号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="owner"  type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">面积<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="area"  type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>                                    
                                    <div class="control-group">
                                        <label class="control-label">车主<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="owner"  type="text" class="span6 m-wrap" placeholder="owner"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">联系方式<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="phone" type="text" class="span4 m-wrap" placeholder="contact_information_type 1=车主,2=代理人"/>
                                            <label class="radio">
                                            <div class="radio"><span><input type="radio" value="1" name="contact_information_type"></span></div>
                                            车主
                                            </label>
                                             <label class="radio">
                                            <div class="radio"><span><input type="radio" value="2" name="contact_information_type"></span></div>
                                            代理人
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">车主类型<span class="required">*</span></label>
                                        <div class="controls">
                                            <label class="radio">
                                            <div class="radio"><span><input type="radio" value="1" name="owner_type"></span></div>
                                            公司
                                            </label>
                                             <label class="radio">
                                            <div class="radio"><span><input type="radio" value="2" name="owner_type"></span></div>
                                            个人
                                            </label>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">

                                        

                                        <div class="controls">
                                            <div class="row-fluid">

                                                <div class="span10">
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="" name="property_fee">
                                                        营业执照
                                                         <input type="hidden" name="avatar" />
                                                        <span id="spanButtonPlaceHolder"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div class="span10">
                                                        <div class=""id="avatar_div" style="float:left;padding-top:50px;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="controls">
                                            <div class="row-fluid">

                                                <div class="span10">
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="" name="property_fee">
                                                        组代
                                                         <input type="hidden" name="avatar" />
                                                        <span id="spanButtonPlaceHolder"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div class="span10">
                                                        <div class=""id="avatar_div2" style="float:left;padding-top:50px;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <label class="control-label">法人<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="payee" type="text" class="span6 m-wrap" placeholder=""/>
                                        </div>
                                        <label class="control-label">经办人<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="payee" type="text" class="span6 m-wrap" placeholder=""/>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="row-fluid">

                                                <div class="span10">
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="" name="property_fee">
                                                        身份证
                                                         <input type="hidden" name="avatar" />
                                                        <span id="spanButtonPlaceHolder"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div class="span10">
                                                        <div class=""id="avatar_div2" style="float:left;padding-top:50px;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label">收款人<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="payee" type="text" class="span6 m-wrap" placeholder="payee"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">开户行<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="bank" type="text" class="span6 m-wrap" placeholder="bank"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">银行账号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="bank_account" type="text" class="span6 m-wrap" placeholder="bank_account"/>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label">租期开始时间<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="lease_term_start" type="text" class="span6 m-wrap" placeholder="lease_term_start"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">租期结束时间<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="lease_term_end" type="text" class="span6 m-wrap" placeholder="lease_term_end"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">免租期<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="" type="text" class="span3 m-wrap" placeholder="暂无字段"/> ---
                                            <input name="" type="text" class="span3 m-wrap" placeholder="暂无字段"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">免租期<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="" type="text" class="span3 m-wrap" placeholder="暂无字段"/> ---
                                            <input name="" type="text" class="span3 m-wrap" placeholder="暂无字段"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">押金<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="deposit" type="text" class="span6 m-wrap" placeholder="deposit"/>
                                        </div>
                                    </div>
                                     <div class="control-group">
                                        <label class="control-label">押金备注<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="deposit_memo" type="text" class="span6 m-wrap" placeholder="deposit_memo"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">押金几个月<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="deposit_month" type="text" class="span6 m-wrap" placeholder="deposit_month"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">付租金几个月<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="pay_month" type="text" class="span6 m-wrap" placeholder="pay_month"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">付款方式<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="estate">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">租金<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="monthly_rent" type="text" class="span6 m-wrap" placeholder="monthly_rent"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">单价<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="monthly_rent2" type="text" class="span6 m-wrap" placeholder=""/>
                                        </div>
                                    </div>
                                    
                                    <hr />
                                   

                                    <div class="control-group">
                                        <label class="control-label">提前几天付款<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="advance_days" type="text" class="span2 m-wrap" placeholder="advance_days"/><span></span>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label">佣金<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="commission" type="text" class="span6 m-wrap" placeholder="commission"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">市场部签约人<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="salesman_id" type="text" class="span6 m-wrap" placeholder="salesman_id"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">渠道公司名称<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="salesman_id" type="text" class="span6 m-wrap" placeholder="salesman_id"/>
                                        </div>
                                    </div>     
                                    <div class="control-group">
                                        <label class="control-label">渠道人员姓名<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="salesman_id" type="text" class="span6 m-wrap" placeholder="salesman_id"/>
                                        </div>
                                    </div>                                   
<!--                                      <div class="control-group">
                                        <label class="control-label">片区负责人<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="manager_id" type="text" class="span6 m-wrap" placeholder="manager_id"/>
                                        </div>
                                    </div> -->
                                   <!--  <div class="control-group">
                                        <label class="control-label">电表<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="estate_id" type="text" class="span6 m-wrap" placeholder="暂无字段"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">钥匙<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="estate_id" type="text" class="span6 m-wrap" placeholder="暂无字段"/>
                                        </div>
                                    </div> -->
                                    <div class="control-group">
                                        <label class="control-label">收房日<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="signing_date" type="text" class="span6 m-wrap" placeholder="signing_date"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">签约日<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="signing_date" type="text" class="span6 m-wrap" placeholder="signing_date"/>
                                        </div>
                                    </div>
                                    <hr />
                                    

                                       
                                    <div class="control-group">

                                        <label class="control-label">凭证附件<span class="required">*</span></label>

                                        <div class="controls">

                                            <div class="row-fluid">
<!--                                                 <div class="span10">
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="" name="property_fee">
                                                        收房委托人证件及委托书
                                                         <input type="hidden" name="avatar" />
                                                        <span id="spanButtonPlaceHolder"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div class="span10">
                                                        <div class=""id="avatar_div" style="float:left;padding-top:50px;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div>
                                                    
                                                </div> -->
                                                <div class="span10">
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        不动产授权委托书
                                                         <input type="hidden" name="avatar1" />
                                                        <span id="spanButtonPlaceHolder1"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress1">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div class="span10"> 
                                                        <div id="avatar_div1" style="float:left;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show1" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="span10">
                                                    <hr>
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        房产证复印件
                                                        <input type="hidden" name="avatar2" />
                                                        <span id="spanButtonPlaceHolder2"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress2">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div >
                                                        <div id="avatar_div2" style="float:left;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show2" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span10">
                                                    <hr>
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        车主授权代理人委托书
                                                        <input type="hidden" name="avatar3" />
                                                        <span id="spanButtonPlaceHolder3"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress3">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div class="span10">
                                                        <div id="avatar_div3" style="float:left;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show3" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="span10">
                                                    <hr>
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        委托人身份证复印件
                                                        <input type="hidden" name="avatar4" />
                                                        <span id="spanButtonPlaceHolder4"></span>
                                                        <div class="upload_progress">
                                                            <span class="localname"></span>
                                                            <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                                        </div>
                                                        <div class="fieldset flash" id="fsUploadProgress4">
                                                            <span class="legend"></span>
                                                        </div>
                                                    </label>
                                                    <div>
                                                        <div id="avatar_div4" style="float:left;width:200px;height:200px;display: none;">
                                                          <img name="avatar_show4" src="" style='max-width:200px;max-height:200px;'/>
                                                        </div>
                                                    </div>
                                                </div>
                                       

                                            </div>

                                        </div>

                                    </div>

                                        

                                    <div class="form-actions">
                                        <button id='sdf' type="submit" class="btn green submit js-btnadd">保存</button>
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



<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<style>
    .theFont{font-size: 20px;}
</style>
<script>
    var swfu;
    var _global_settings;
    var swfu1;
    var _global_settings1;
    var swfu2;
    var _global_settings2;
    var swfu3;
    var _global_settings3;
    var swfu4;
    var _global_settings4;
    window.onload = function() {
        //图集图片
        var settings = {
            flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
            upload_url: "/upload/avatar", //pdf
            file_post_name:"filename",
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "2 MB",
            file_types : "*.jpg;*.jpeg;*.png",
            file_types_description : "图片文件",
            file_upload_limit : 5,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "spanButtonPlaceHolder",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">证件上传</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        _global_settings=settings;
        swfu = new SWFUpload(settings);

        //图集图片
        var settings1 = {
            flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
            upload_url: "/upload/avatar", //pdf
            file_post_name:"filename",
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "2 MB",
            file_types : "*.jpg;*.jpeg;*.png",
            file_types_description : "上传图片",
            file_upload_limit : 1,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress1",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "spanButtonPlaceHolder1",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">证件上传</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued1,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess1,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        _global_settings1=settings1;
        swfu1 = new SWFUpload(settings1);

         //图集图片
        var settings2 = {
            flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
            upload_url: "/upload/avatar", //pdf
            file_post_name:"filename",
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "2 MB",
            file_types : "*.jpg;*.jpeg;*.png",
            file_types_description : "上传图片",
            file_upload_limit : 1,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress2",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "spanButtonPlaceHolder2",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">证件上传</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued2,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess2,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        _global_settings2=settings2;
        swfu2 = new SWFUpload(settings2);

        //图集图片
        var settings3 = {
            flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
            upload_url: "/upload/avatar", //pdf
            file_post_name:"filename",
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "2 MB",
            file_types : "*.jpg;*.jpeg;*.png",
            file_types_description : "上传图片",
            file_upload_limit : 1,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress3",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "spanButtonPlaceHolder3",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">证件上传</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued3,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess3,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        _global_settings3=settings3;
        swfu3 = new SWFUpload(settings3);

        //图集图片
        var settings4 = {
            flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
            upload_url: "/upload/avatar", //pdf
            file_post_name:"filename",
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "2 MB",
            file_types : "*.jpg;*.jpeg;*.png",
            file_types_description : "上传图片",
            file_upload_limit : 1,
            file_queue_limit : 0,
            custom_settings : {
                progressTarget : "fsUploadProgress4",
                cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "spanButtonPlaceHolder4",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">证件上传</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued4,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess4,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        _global_settings4=settings4;
        swfu4 = new SWFUpload(settings4);
    };


    function uploadSuccess(fileObj, server_data){
        var json=JSON.parse(server_data);
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

        document.getElementsByName("avatar_show")[0].src=file_url;
        document.getElementsByName("avatar")[0].value=file_url;
        $("#avatar_div").show();

        $(".progressWrapper").hide();
    }

    function fileQueued(file){

        var stats = swfu.getStats();
        stats.successful_uploads--;

        // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    function uploadSuccess1(fileObj, server_data){
        var json=JSON.parse(server_data);
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

        document.getElementsByName("avatar_show1")[0].src=file_url;
        document.getElementsByName("avatar1")[0].value=file_url;
        $("#avatar_div1").show();

        $(".progressWrapper").hide();
    }

    function fileQueued1(file){

        var stats = swfu1.getStats();
        stats.successful_uploads--;

        // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    function uploadSuccess2(fileObj, server_data){
        var json=JSON.parse(server_data);
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

        document.getElementsByName("avatar_show2")[0].src=file_url;
        document.getElementsByName("avatar2")[0].value=file_url;
        $("#avatar_div2").show();

        $(".progressWrapper").hide();
    }

    function fileQueued2(file){

        var stats = swfu2.getStats();
        stats.successful_uploads--;

        // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    function uploadSuccess3(fileObj, server_data){
        var json=JSON.parse(server_data);
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

        document.getElementsByName("avatar_show3")[0].src=file_url;
        document.getElementsByName("avatar3")[0].value=file_url;
        $("#avatar_div3").show();

        $(".progressWrapper").hide();
    }

    function fileQueued3(file){

        var stats = swfu3.getStats();
        stats.successful_uploads--;

        // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    function uploadSuccess4(fileObj, server_data){
        var json=JSON.parse(server_data);
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

        document.getElementsByName("avatar_show4")[0].src=file_url;
        document.getElementsByName("avatar4")[0].value=file_url;
        $("#avatar_div4").show();

        $(".progressWrapper").hide();
    }

    function fileQueued4(file){

        var stats = swfu4.getStats();
        stats.successful_uploads--;

        // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }
    // function del(file)
    // {
    //     var upload=document.getElementsByName("avatar")[0].value;

    //     upload=upload.replace(file,'');
    //     upload=upload.replace(",,",',');
    //     if (upload.substr(0,1)==',') upload=upload.substr(1);
    //     upload=upload.replace(/,$/gi,"");
    //     //alert(upload);
    //     document.getElementsByName("avatar")[0].value=upload;

    //     $("#"+"p"+file.replace('.','')).remove();
    // }
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