<style>
    input{border:1px solid #aaa!important;height:20px!important;}
    select{border:1px solid #aaa!important;}
    .control-group{margin-left:50px;}
</style>

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

                        <div class="portlet box blue">

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
                                <form action="/admin/changepwd/save" id="form_sample_3"  method="post"  class="form-horizontal js-submit">
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
                                    <div class="control-group" style="margin:30px 50px;">
                                        <label class="control-label"><b>账号</b><span class="required">*</span></label>
                                        <div class="controls">
                                           <b> <?php echo $model==null?"":$model->account;?></b>
                                        </div>
                                    </div>
                                       <div class="control-group">
                                        <label class="control-label"><b>新密码&nbsp;&nbsp;</label>
                                        <div class="controls">
                                            <input name="password" type="password" class="span2 m-wrap" value=""/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">重复密码</label>
                                        <div class="controls">
                                            <input name="r_password" type="password" class="span2 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label"><b>昵称<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="nickname" type="text" class="span2 m-wrap" value="<?php echo $model==null?"":$model->nickname;?>" required disabled="true" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label"><b>部门<span class="required">*</span></label>
                                        <div class="controls" id="department">
                                            <select name="department_id[]" required disabled="true">
                                                <option value=""></option>
                                                <?php foreach (AdminDepartment::model()->findAll("deleted=0 and level = 0") as $key => $value) {
                                                    
                                                ?>
                                                <option  value="<?php echo $value->id?>"><?php echo $value->name ?></option>
                                                <?php }?>
                                                <option selected  value="<?php echo $model->department_id?>"><?php echo AdminDepartment::model()->find(" id = '$model->department_id'")->name ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <script>

                                        $("select[name='department_id[]']").live('change',function(){
                                            $("select[name='department_id[]']:gt("+$(this).index()+")").remove();
                                            var parent_id = $(this).val();
                                            $.post('/admin/position/getchilddepartment',{parent_id:parent_id},function(msg){
                                                msg = eval(msg)
                                                if(msg!=0){
                                                    var str = '';
                                                    for (var i = 0; i < msg.length; i++) {
                                                        str+='<option value="'+msg[i]['id']+'">'+msg[i]['name']+'</option>'
                                                    }
                                                    var str2 ='<select name="department_id[]" ><option value=""></option>'+str+'</select>';
                                                    $("#department").append(str2);                                                    
                                                }

                                            })      
                                        })                                  
                                    </script>
                                    <div class="control-group">
                                        <label class="control-label"><b>职务<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="position_id" required disabled="true">
                                                <option value=""></option>
                                                <?php 
                                                foreach (AdminPosition::model()->findAll("deleted=0 and department_id ='$model->department_id' ") as $key => $value) {
                                                ?>
                                                <option <?php echo $value->id==$model->position_id?"selected":"" ?> value="<?php echo $value->id?>"><?php echo $value->name ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <script>
                                        $("select[name='department_id[]']").live('change',function(){
                                            $.post('/admin/position/list',{department_id:$(this).val()},function(msg){
                                                msg = eval(msg)
                                                var str = '';
                                                for (var i = 0; i < msg.length; i++) {
                                                    str+='<option value="'+msg[i]['id']+'">'+msg[i]['name']+'</option>'
                                                }
                                                $("select[name=position_id]").html(str);
                                            })
                                        })
                                    </script>
                                    <div class="control-group">
                                        <label class="control-label"><b>头像&nbsp;&nbsp;</label>
<!--                                         <div class="controls">
                                            <input name="avatar" type="text" class="span6 m-wrap"/>
                                        </div> -->
                                        <div class="controls">
                                            <input type="hidden" name="avatar" value="<?php echo $model==null?"":$model->avatar;?>" />

                                            <span id="spanButtonPlaceHolder"></span>
                                            <div class="upload_progress">
                                                <span class="localname"></span>
                                                <!-- <span class="progress" style="width: 400px;">100% 保存成功</span> -->
                                            </div>
                                            <div class="fieldset flash" id="fsUploadProgress">
                                                <span class="legend"></span>
                                            </div>
                                            <div id="avatar_div" style="float:left;width:200px;height:200px;">
                                              <img name="avatar_show" src="<?php echo $model==null?"":$model->avatar;?>" style='max-width:200px;max-height:200px;'/>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="control-group">
                                        <label class="control-label">性别</label>
                                        <div class="controls">
                                            <label class="radio">
                                                <input type="radio" name="gender" <?php echo $model==null?"":$model->gender=='f'?'checked':'';?> value="f" />
                                                男
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="gender" <?php echo $model==null?"":$model->gender=='m'?'checked':'';?> value="m"  />
                                                女
                                            </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">出生年月</label>
                                        <div class="controls">
                                            <div class="input-append date form_datetime">
                                                <input type="text" id="datepicker" value="<?php echo $model->birthday==null?"":date('Y-m-d',$model->birthday)?>" name="birthday"/>
                                            </div>
                                        </div>
                                    </div>
                                    <link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
                                    <script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
                                    <script type="text/javascript">
                                      var picker = new Pikaday({
                                          field: document.getElementById('datepicker'),
                                          firstDay: 1,
                                          minDate: new Date('1949-01-01'),
                                          maxDate: new Date('2030-12-31'),
                                          yearRange: [1949,2030]
                                      });
                                    </script>
                                    <div class="control-group">
                                        <label class="control-label">联系电话</label>
                                        <div class="controls">
                                            <input name="phone" type="text" value="<?php echo $model==null?"":$model->phone?>" class="span2 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">身份证号</label>
                                        <div class="controls">
                                            <input name="id_card" value="<?php echo $model==null?"":$model->id_card?>" type="text" class="span3 m-wrap"/>
                                        </div>
                                    </div>
                                    <!--                                     <div class="control-group">
                                        <label class="control-label">身份证图片<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="id_card_img" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div> -->
                                    <div class="control-group">
                                        <label class="control-label">银行</label>
                                        <div class="controls">
                                            <input name="bank" type="text" value="<?php echo $model==null?"":$model->bank?>" class="span3 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">银行卡号</label>
                                        <div class="controls">
                                            <input name="bank_card" type="text" value="<?php echo $model==null?"":$model->bank_card?>" class="span3 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">工号</label>
                                        <div class="controls">
                                            <input name="work_no" type="text" value="<?php echo $model==null?"":$model->work_no?>" class="span2 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">通讯地址</label>
                                        <div class="controls">
                                            <input name="address" type="text" value="<?php echo $model==null?"":$model->address?>" class="span6 m-wrap"/>
                                        </div>
                                    </div>                    
                                    <div class="form-actions">
                                        <button id='' type="submit" class="btn btn-primary submit js-btnadd">保存</button>
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