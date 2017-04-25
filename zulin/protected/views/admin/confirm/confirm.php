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
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/urs_goods.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/urs_goods.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);
  
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
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

                                <div class="caption">确认收款人</div>

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
                                <form action="/admin/confirm/doconfirm"  id="form_add"  method="post"  class="form-horizontal js-submit forms">
                                    
                                    <!-- 隐藏域(申请人id) -->
                                    <input type="hidden" name="id" value="<?php echo CHtml::encode($model->id); ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">财务申请人: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode(AdminUser::model()->find("id = '$model->admin_id'")['nickname'])?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">付款户名: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode($model->payment_name); ?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px" >付款银行: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode($model->payment_bank); ?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">付款银行账号: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode($model->payment_number); ?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">收款户名: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode($model->payee); ?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">收款银行: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode($model->payee_bank); ?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">收款银行账号: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode($model->payee_number); ?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;margin-bottom: 10px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">收款金额: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode($model->payee_money)/100; ?>
                                        </div>
                                    </div>
                                    <div class="control-group" style="padding-bottom: 0px;";>
                                        <label class="control-label" style="width:100px;margin-right:30px">收款时间: </label>
                                        <div class="controls" style="margin-top:13px">
                                            <?php echo CHtml::encode(date('Y-m-d',$model->payment_time)); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="information">
                                        <div class="control-group"  style="float:left;text-align:right">
                                            <label class="control-label">品牌<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="hidden" name="estate_id[]" readmin="请选择正确的品牌" id="estate_id" class="span4 select2 estate" style="width:230px" required>
                                                <span style="margin:0 10px;font-size:16px"></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  style="float:left;text-align:right">
                                            <label class="control-label">系列<span class="required">*</span></label>
                                            <div class="controls">
                                                <input type="hidden" name="building_id[]" readmin="请选择正确的系列" id="building_id" class="span4 select2 building" style="width:230px" required>
                                                <span style="margin:0 10px;font-size:16px"></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  style="float:left;text-align:right" id="qwe">
                                            <label class="control-label">编号<span class="required">*</span></label>
                                            <div class="controls" >
                                                <input type="hidden" name="room_number[]"  readmin="请选择正确的编号" id="room_number" class="span4 select2 room" style="width:230px" required><span style="color:red">(多编号只输入一个即可)</span>
                                                <span style="margin:0 10px;font-size:16px" id = "qwer"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div class="control-group" style="float:left;text-align:right">
                                        <label class="control-label" style="width:80px">租户姓名<span class="required" style="color:red">*</span></label>
                                        <div class="controls">
                                            <input type="text"  name="tenant_name"  required >
                                            <span style="margin:0 10px;font-size:16px"></span>
                                        </div>
                                    </div>
                                    <div class="control-group" style="float:left;text-align:right">
                                        <label class="control-label">付款周期<span class="required">*</span></label>
                                        <div class="controls">
                                            <input id="datepicker3" value="" name="cycle_start" type="text" required>至
                                            <input id="datepicker4" value="" name="cycle_end" type="text" required>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>             
                                    <div class="">
                                        <div class="control-group" style="margin-top:30px;margin-left: 0px;padding-bottom: 0px;">
                                            <div class="controls">
                                                <span>
                                                    <input type="hidden" name="pay_photo" />
                                                    <span id="PlaceHolder_list_photo"></span>
                                                </span>
                                                <span>
                                                     <input type="button" class="btn red" value="编辑图片" style="margin-top:-18px;height:32px!important;">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="control-group" style="margin:0;">
                                            <div class="controls">
                                                <div class="upload_progress">
                                                    <span class="localname"></span>
                                                </div>
                                                <div class="fieldset flash" id="fsUploadProgress_list_photo">
                                                    <span class="legend"></span>
                                                </div>
                                                <div id="list_photo_div" style="float:left;100%;height:100px;display: none;">
                                                    <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                </div>
                                            </div>
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
                                    <style>
                                        .theFont{font-size: 20px;}
                                    </style>      
                                    <div style="clear:both"></div>                              
                                    <div class="form-actions" style="padding-left: 70px;">
                                        <button  type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                                        <button  type="submit" class="btn btn-primary submit js-btnadd message">发短信给销售人员</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
                                    <script type="text/javascript">
                                        $(".message").click(function(){
                                            $(".forms").attr('action','/admin/confirm/domessage');
                                            var b = $('input').removeAttr("required",false);
                                            var a = $(".forms").attr('action');
                                            console.log(b)
                                        })
                                    </script>
                                   
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
<style>
    .theFont{font-size: 20px;}
</style>

<div id="errModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">

    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h3 id="myModalLabel2"></h3>

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
<script>
// 上传收房清单图片
var swf_list_photo;
// window.onload = function() {
    var settings_list_photo = {
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
            progressTarget : "fsUploadProgress_list_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_list_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">付款截图</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 20,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_list_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_list_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_list_photo = new SWFUpload(settings_list_photo);
                            
// };
function uploadSuccess_list_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("list_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("list_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#list_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("pay_photo")[0].value=document.getElementsByName("pay_photo")[0].value+','+file_url;
    $("#list_photo_div").show();
}

function fileQueued_list_photo(file){

    var stats = swf_list_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}

</script>

<script>
    $(function(){
        $('.red').live('click',function(){

            $(this).parent().parent().parent().next().find('.del_photo').toggle();
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
