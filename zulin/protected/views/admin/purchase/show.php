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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



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

                        <div class="portlet box green">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>管理员-编辑</div>

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
                                <form action="/admin/property/editsave" id="form_sample_3"  method="post"  class="form-horizontal js-submit">
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
<!--                                     <div class="control-group">
                                        <label class="control-label">账号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="account" type="text" class="span6 m-wrap" value="<?php //echo $model==null?"":$model->account;?>"/>
                                        </div>
                                    </div>  
                                    <div class="control-group">
                                        <label class="control-label">昵称<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="nickname" type="text" class="span6 m-wrap" value="<?php //echo $model==null?"":$model->nickname;?>"/>
                                        </div>
                                    </div> -->
                                    
                                
                                   <div class="control-group">
                                        <label class="control-label">车主<span class="required">*</span></label>
                                        <div class="controls">
                                        <input type="text" class='span6' disabled="" placeholder="<?php echo $model->owner ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">联系方式<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span4' disabled="" placeholder="<?php echo $model->phone ?>" class="m-wrap medium">
                                            <label class="radio">
                                            <div class="radio">
                                            <span><input type="radio" value="option1" name="optionsRadios1"
                                                <?php 
                                                    if($model->contact_information_type == 1){
                                                        echo "checked='checked'";
                                                }
                                                ?>
                                            /></span>
                                            </div>
                                            车主
                                            </label>
                                             <label class="radio">
                                            <div class="radio"><span>
                                            <input type="radio" value="option1" name="optionsRadios1"
                                            <?php 
                                                    if($model->contact_information_type == 2){
                                                        echo "checked='checked'";
                                                }
                                                ?>
                                            /></span>
                                            </div>
                                            代理人
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">收款人<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->payee ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">开户行<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->bank ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">银行账号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->bank_account ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label">租期开始时间<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->lease_term_start ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">租期结束时间<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->lease_term_end ?>" class="m-wrap medium">
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
                                           <input type="text" class='span6' disabled="" placeholder="<?php echo $model->deposit ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                     <div class="control-group">
                                        <label class="control-label">押金备注<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->deposit_memo ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">押金几个月<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->deposit_month ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">付租金几个月<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->pay_month ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">租金<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->monthly_rent ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    


                                    <!-- 暂定 -->
                                   
                                    <div class="control-group">
                                        <label class="control-label">租金<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->monthly_rent ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <!-- <div class="control-group">
                                        <label class="control-label">付款方式<span class="required">*</span></label>
                                        <div class="controls">
                                           <input type="text" class='span6' disabled="" placeholder="<?php echo $model->owner ?>" class="m-wrap medium">
                                        </div>
                                    </div> -->
                                    <hr />
                                    <!-- 暂定 -->


                                    <div class="control-group">
                                        <label class="control-label">提前几天付款<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->advance_days ?>" class="m-wrap medium"><span></span>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="control-group">
                                        <label class="control-label">佣金<span class="required">*</span></label>
                                        <div class="controls">
                                           <input type="text" class='span6' disabled="" placeholder="<?php echo $model->commission ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">业务员<span class="required">*</span></label>
                                        <div class="controls">
                                           <input type="text" class='span6' disabled="" placeholder="<?php echo $model->salesman_id ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                     <div class="control-group">
                                        <label class="control-label">片区负责人<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->manager_id ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                   
                                    <div class="control-group">
                                        <label class="control-label">签约日<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" class='span6' disabled="" placeholder="<?php echo $model->signing_date ?>" class="m-wrap medium">
                                        </div>
                                    </div>
                                    <hr />
                                    

                                       
                                    <div class="control-group">

                                        <label class="control-label">凭证<span class="required">*</span></label>

                                        <div class="controls">

                                            <div class="row-fluid">

                                                <div class="span4">

                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">全权委托资产管理合同
                                                    <div class="checker"></div> 
                                                    </label>
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        不动产授权委托书
                                                    <div class="checker"></div> 
                                                    </label>
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        房产证复印件
                                                    <div class="checker"></div> 
                                                    </label>
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        车主授权代理人委托书
                                                    <div class="checker"></div> 
                                                    </label>
                                                    <label class="checkbox line">
                                                        <input type="checkbox" value="">
                                                        委托人身份证复印件
                                                    <div class="checker"></div> 
                                                    </label>

                                                    <!-- <label class="checkbox line">

                                                    <div class="checker"><span><input type="checkbox" value=""></span></div> 

                                                    </label>

                                                    <label class="checkbox line">

                                                    <div class="checker"><span><input type="checkbox" value=""></span></div> Checkbox 3

                                                    </label> -->

                                                </div>

                                                <!-- <div class="span3">

                                                    <label class="checkbox line">

                                                    <div class="checker"><span><input type="checkbox" value=""></span></div> Checkbox 4

                                                    </label>

                                                    <label class="checkbox line">

                                                    <div class="checker"><span><input type="checkbox" value=""></span></div> Checkbox 5

                                                    </label>

                                                    <label class="checkbox line">

                                                    <div class="checker"><span><input type="checkbox" value=""></span></div> Checkbox 6

                                                    </label>

                                                </div> -->

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