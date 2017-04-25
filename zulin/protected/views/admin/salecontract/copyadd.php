<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/cms_contract_copy.js',CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/chosen.jquery.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/bootstrap-datepicker.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.inputmask.bundle.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
App.init();
FormValidation.init();
");
?>
<style>
    .control-group label{font-size:13px!important;font-weight: normal;}
    p{margin-left:50px;}
    #a{height:35px!important;margin-top:-5px;margin-left:-5px;}
    #b{height:31px!important;margin-top:0px;margin-left:-5px;width:100px!important;}
    #c{height:35px!important;margin-top:-5px;margin-left:-5px;}
    #d{height:35px!important;margin-top:-5px;margin-left:-5px;}
    #e{height:35px!important;margin-top:-5px;margin-left:-5px;}
     #g{height:35px!important;margin-top:-5px;margin-left:-5px;}
    #f{height:35px!important;margin-top:-5px;margin-left:-5px;}
</style>
<!-- END PAGE LEVEL SCRIPTS -->;
<div class="page-content">
        <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            输入格式有误，请检查输入的数据.
        </div>
        <div class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            数据输入验证成功!
        </div>
    <div id="portlet-config" class="modal hide">
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="min-height:10px;"></div>
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet box ">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>合同-复印件</div>
                    </div>
                    <form action="/admin/purchasecontract/copyaddsave" id="form_create"  method="post"  class="form-horizontal js-submit">
                    <input type="hidden" value="<?php echo $contract_id ?>" name="contract_id">
                    <input type="hidden" value="<?php echo $referer ?>" name="referer">
                        <div class="control-group" style="margin-top:60px;">
                            <label class="control-label">复印件</label>
                            <div class="controls">
                                <label class="control-labela" style="text-align: left;float:left;margin-right:15px;cursor:pointer;">
                                    <input type="hidden" name="contract_copy" />
                                    <span id="PlaceHolder_contract_copy"></span>
                                </label>
                                <label class="control-labela label2">
                                    <input type="button" class="btn blue" value="编辑图片" id="b">
                                </label>
                            </div>
                            <div class="control-group" style="margin:0;clear:both;">
                                <div class="controls">
                                    <div class="upload_progress">
                                        <span class="localname"></span>
                                    </div>
                                    <div class="fieldset flash" id="fsUploadProgress_contract_copy">
                                        <span class="legend"></span>
                                    </div>
                                    <div id="contract_copy_div" style="float:left;100%;height:200px;display: none;">
                                        <img name="contract_copy_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <div class="form-actions">
                        <button id='sdf' type="submit" class="btn blue submit js-btnadd">保存</button>
                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                    </div>
                    </form>
                </div>   
            </div>
        </div>
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
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<style>
.theFont{font-size: 20px;}
</style>

<script>
    var swf_contract_copy;
    window.onload = function() {
        //合同复印件
        var settings_contract_copy = {
            flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
            upload_url: "/upload/avatar", //pdf
            file_post_name:"filename",
            post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
            file_size_limit : "2 MB",
            file_types : "*.jpg;*.jpeg;*.png",
            file_types_description : "图片文件",
            file_upload_limit : 0,
            file_queue_limit : 0,
            custom_settings : {
            progressTarget : "fsUploadProgress_contract_copy",
            cancelButtonId : "btnCancel"
            },
            debug: false,

            // Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_contract_copy",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">添加图片</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff;}",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

            // The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued_contract_copy,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess_contract_copy,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swf_contract_copy = new SWFUpload(settings_contract_copy);

        //车主授权代理人委托书
        function uploadSuccess_contract_copy(fileObj, server_data){
            $(".progressWrapper").hide();
            var json=JSON.parse(server_data);
            if (json.code==0)
            {
                alert(json.message);
                return;
            }
            var file_name=json.data.file_name;
            var file_url=json.data.file_url;
            var oo = document.getElementsByName("contract_copy_show")[0];
            var new_img = $(oo).clone();
            $(new_img).show();
            $(new_img).attr("src",file_url);
            $("#contract_copy_div").append(new_img);
            $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');
            $(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
            document.getElementsByName("contract_copy")[0].value=document.getElementsByName("contract_copy")[0].value+','+file_url;
            $("#contract_copy_div").show();
        }
        function fileQueued_contract_copy(file){
            var stats = swf_contract_copy.getStats();
            stats.successful_uploads--;
            this.setStats(stats);
        }
    }
</script>
<!-- 图片删除 -->
<script>        
        $(function(){
            $('.blue').on('click',function(){
                $(this).parent().parent().next().find('.del_photo').show();
                $('.del_photo').click(function(){
                    var del_photo_url = $(this).prev().children().attr('src');
                    var dataStr = $(this).parent().parent().parent().prev().find("input[type='hidden']").val();
                    var dataStrArr=dataStr.split(",");
                    var newarr =[] ;
                    for (var i = dataStrArr.length - 1; i >= 0; i--) {
                       if(dataStrArr[i]!=del_photo_url&&dataStrArr[i]!=''){
                            newarr.push(dataStrArr[i]);
                       }
                    }
                    var str = newarr.join(',');
                    str=str.substr(0,str.length);
                    console.log(str)
                    $(this).parent().parent().parent().prev().find("input[type='hidden']").val(','+str);
                    $(this).prev().remove();
                    $(this).remove();
                })
            })
        })

</script>
