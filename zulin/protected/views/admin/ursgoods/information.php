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
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/ys_goods.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/urs_goods.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    ");
    // FormValidation.init();
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

                                <div class="caption"><i class="icon-reorder"></i>礼品-添加购买信息</div>

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
                                <form action="/admin/ursgoods/informationsave" id="form_add"  method="post"  class="form-horizontal js-submit">
                                    <!-- 隐藏域(ursgoods id) -->
                                    <input type="hidden" name="id"  value="<?php echo  $id; ?>">
                                    <!-- 隐藏域(申请人id) -->
                                    <input type="hidden" name="information_user" value="<?php echo  $_SESSION['admin_uid']; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">购买人<span class="required" style="color:red">*</span>: </label>
                                        <div class="controls">
                                            <input type="text" name="buy_user" required id="buy_user" readmin="请输入备注" >
                                            <span style="margin:0 10px;font-size:16px"></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                      <span>购买方式<span class="requ ired" style="color:red">*</span>：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <select name="buy_way" id="" required  >
                                            <option value="1" >线上</option> 
                                            <option value="2" >线下</option> 
                                        </select>
                                        <span style="margin:0 10px;font-size:16px"></span>
                                      </span>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">申请的金额:</label>
                                        <div class="controls totals">
                                            <?php echo  $totals; ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">实际购买的金额<span class="required" style="color:red">*</span>: </label>
                                        <div class="controls">
                                            <input type="number" min="0" name="buy_money" required id="buy_money" onblur="check(this.value);">
                                            <span style="margin:0 10px;font-size:16px"></span>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                          function check(v){
                                              var a=/^[0-9]*(\.[0-9]{1,2})?$/;
                                              if(!a.test(v)){
                                                  alert("格式不正确");
                                                  $("#buy_money").attr("value","");
                                              }
                                          }
                                  </script>
                                    <div class="control-group subsidy" style="display:none">
                                        <label class="control-label">财务额外贴补:</label>
                                        <div class="controls subsidys">
                                        </div>
                                        <br><br>
                                        <input type="radio" name="shen" value="1" style="margin:0" checked>申请财务额外贴补&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="hidden" name="subsidy" id="subsidy" value="">
                                    </div>
                                    <div class="control-group back" style="display:none">
                                        <label class="control-label">返还给财务:</label>
                                        <div class="controls backs">
                                        </div><br><br>
                                        <input type="radio" name="shenqing" value="3" style="margin:0"  checked>申请返钱给财务
                                        <input type="hidden" name="back" id="back" value="">
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">上传发票</label>
                                        <div class="controls">
                                            <input type="hidden" name="buy_fapiao" />

                                            <span id="spanButtonPlaceHolder"></span>
                                            <div class="upload_progress">
                                                <span class="localname"></span>
                                                <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                            </div>
                                            <div class="fieldset flash" id="fsUploadProgress">
                                                <span class="legend"></span>
                                            </div>
                                            <div id="avatar_div" style="float:left;width:200px;height:200px;">
                                              <img name="avatar_show" src="<?php ?>" style='max-width:200px;max-height:200px;'/>
                                            </div>
                                        </div>
                                    </div>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
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
                                            document.getElementsByName("buy_fapiao")[0].value=file_url;
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
                                    <style>
                                        .theFont{font-size: 20px;}
                                    </style>                                    
                                    <div class="form-actions">
                                        <button id='sdf' type="submit" class="btn green submit js-btnadd">保存</button>
                                    </div>
                                    <script type="text/javascript">
                                        
                                        var totals = $(".totals").html();
                                        $("#buy_money").blur(function(){
                                            var back = $("#back").val();
                                            var buy_money = $("#buy_money").val();
                                            if(buy_money-totals > 0){
                                                $(".subsidys").html(buy_money-totals+"元");
                                                $(".subsidy").css("display","block");
                                                $("#subsidy").val(buy_money-totals);

                                            }
                                            if(totals-buy_money > 0){
                                                $(".backs").html(totals-buy_money+"元");
                                                $(".back").css("display","block");
                                                $("#back").val(totals-buy_money);

                                            }
                                        })
                                        $('input[name=buy_money]').focus(function(){
                                            $(".subsidy").css("display","none");
                                            $(".back").css("display","none");
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
<script>
//日期
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });

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