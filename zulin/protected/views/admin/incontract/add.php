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

                                <div class="caption"><i class="icon-reorder"></i>收房合同-新增</div>

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
                                <form action="/admin/admin/addsave" id="form_sample_2"  method="post"  class="form-horizontal js-submit">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">账号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="account" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">密码<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="password" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">重复密码<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="r_password" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">昵称<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="nickname" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">头像</label>
<!--                                         <div class="controls">
                                            <input name="avatar" type="text" class="span6 m-wrap"/>
                                        </div> -->
                                        <div class="controls">
                                            <input type="hidden" name="avatar" />

                                            <span id="spanButtonPlaceHolder"></span>
                                            <div class="upload_progress">
                                                <span class="localname"></span>
                                                <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                            </div>
                                            <div class="fieldset flash" id="fsUploadProgress">
                                                <span class="legend"></span>
                                            </div>
                                            <div id="avatar_div" style="float:left;width:200px;height:200px;display: none;">
                                              <img name="avatar_show" src="" style='max-width:200px;max-height:200px;'/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">性别</label>
                                        <div class="controls">
                                            <label class="radio">
                                                <input type="radio" name="gender" value="f" />
                                                男
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="gender" value="m" checked />
                                                女
                                            </label>
                                        </div>
                                    </div>
<!--                                     <div class="control-group">
                                        <label class="control-label">出生年月<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="birthday" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div> -->
                                    <div class="control-group">
                                        <label class="control-label">出生年月</label>
                                        <div class="controls">
                                            <div class="input-append date form_datetime">
                                                <input size="16" name="birthday" type="text" value="" readonly class="m-wrap">
                                                <span class="add-on"><i class="icon-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">联系电话<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="phone" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">身份证号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="id_card" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">身份证图片<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="id_card_img" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">银行<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="bank" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">银行卡号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="bank_card" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">银行卡图片<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="bank_card_img" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">工号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="work_no" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">通讯地址<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="address" type="text" class="span6 m-wrap"/>
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
            file_upload_limit : 1,
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

            button_text: '<span class="theFont">+图片</span>',
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