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
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
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

                        <div class="portlet box">

                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>幼狮车源-编辑</div>
                                <div class="tools">
                                </div>
                            </div>

                            <div class="portlet-body form" style="float:left;width:600px;">
                                <!-- BEGIN FORM-->
                                <form action="/admin/ursproperty/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $ursproperty==null?"":$ursproperty->id;?>">
                                    <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
                                    <input type="hidden" name="contract_id" value="<?php echo $contract_id;?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group" style="margin-top:20px;">
                                        <label class="control-label">底价：</label>
                                        <div class="controls">
                                              <input type="text" name="base_price" value="<?php echo $ursproperty==null?"":$ursproperty->base_price/100;?>" >元/㎡/天  
                                        </div>                                       
                                    </div>
                                    <div class="control-group" style="margin-top:20px;">
                                        <label class="control-label">朝向：</label>
                                        <div class="controls">
                                            <select name="orientation" class="m-wrap">
                                                <option value=""></option>
                                                <option value="南" <?php echo $orientation=="南"?"selected":""?> >南</option>
                                                <option value="南北" <?php echo $orientation=="南北"?"selected":""?> >南北</option>
                                                <option value="东" <?php echo $orientation=="东"?"selected":""?> >东</option>
                                                <option value="东南" <?php echo $orientation=="东南"?"selected":""?> >东南</option>
                                                <option value="东北" <?php echo $orientation=="东北"?"selected":""?> >东北</option>
                                                <option value="西" <?php echo $orientation=="西"?"selected":""?> >西</option>
                                                <option value="西南" <?php echo $orientation=="西南"?"selected":""?> >西南</option>
                                                <option value="西北" <?php echo $orientation=="西北"?"selected":""?> >西北</option>
                                                <option value="北" <?php echo $orientation=="北"?"selected":""?> >北</option>
                                            </select>
                                        </div>                                       
                                    </div>
                                    <span style="font-size:16px;font-weight:bold;margin-left:30px;">幼狮车源图片(图片类型不能选重复并且不能为空)：</span>
                                    <br>
                                    <br>
                                    <div id="propertys">
<!--图片-->                         <?php 
                                        $count=0;
                                        if($photo){
                                            foreach ($photo as $k => $v){
                                                
                                                if ($v){
                                                    $a='';
                                                    foreach ($v as $k1 => $v1){
                                                        if ($k1==0){
                                                            $a=",".$v1->url;
                                                        }
                                                        else{
                                                            $a.=",".$v1->url;
                                                        }
                                                        
                                                    }
                                                }      
                                            
                                    ?>
                                        <div class="control-group">
                                            <label class="control-label">图片类型</label>
                                            <div class="controls">
                                                <select name="type_photo[]">
                                                  <?php foreach ($arr['type_photo'] as $key => $value) {
                                                  ?>
                                                    <option value="<?php echo $key?>"  <?php echo $key==$k? "selected":""?>><?php echo $value ?></option>
                                                  <?php
                                                  }?>   
                                                </select> 
                                            </div>
                                        </div>  
                                        <div class="control-group" >
                                            <div class="controls">
                                                <label class="control-label" style="text-align:left;">
                                                    <input type="hidden" name="property_photo[]" value="<?php  echo $v?$a:''?>"/>                                                   
                                                    <span id="PlaceHolder_property_photo<?php echo $k?>"></span>
                                                </label>
                                                <label class="control-label"></label> 
                                                <label class="control-label">
                                                    <input type="button" class="btn red" value="编辑图片" style="height:31px!important;">
                                                </label> 
                                            </div>
                                        </div>
                                        <div class="control-group" style="margin:0;">
                                            <div class="controls">
                                                <div class="upload_progress">
                                                    <span class="localname"></span>
                                                </div>
                                                <div class="fieldset flash" id="fsUploadProgress_property_photo<?php echo $k?>">
                                                    <span class="legend"></span>
                                                </div>
                                                <div id="property_photo_div<?php echo $k?>" style="float:left;100%;height:200px;<?php echo $k==null?'display: none':''; ?>">
                                                    <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                    <?php 
                                                        if ($v):?>
                                                        <?php foreach ($v as $k1 => $v1):?>                       
                                                            <a target="_Blank" href="<?php echo $v1->url; ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                                        <?php endforeach; ?>
                                                        
                                                    <?php endif ?>                                
                                                </div>
                                            </div>
                                        </div>

                                    <script>
                                        //遍历出来的图片
                                        var swf_property_photo;
                                       
                                           $(function(){
                                            var settings_property_photo = {
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
                                                    progressTarget : "fsUploadProgress_property_photo<?php echo $k?>",
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "100",
                                                button_height: "30",
                                                button_placeholder_id: "PlaceHolder_property_photo<?php echo $k?>",
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">+图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 20,
                                                button_text_top_padding: 6,
                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_estate<?php echo $k?>_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_estate<?php echo $k?>_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };

                                     // alert(nummore.length);
                                            swf_property_photo = new SWFUpload(settings_property_photo);
                                         })                   

                                        function uploadSuccess_estate<?php echo $k?>_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;
                                    //alert($count);
                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            $("#property_photo_div<?php echo $k?>").append(new_img);
                                            $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                            document.getElementsByName("property_photo[]")[<?php echo $count?>].value=document.getElementsByName("property_photo[]")[<?php echo $count?>].value+','+file_url;
                                            $("#property_photo_div<?php echo $k?>").show();
                                        }

                                        function fileQueued_estate<?php echo $k?>_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }                                 
                                            </script>
                                    <?php 
                                                $count++;
                                            }
                                        }
                                    ?> 
                                    </div>
                                    <div style="display:none" class="selecta">    
                                        <div class="control-group">
                                            <label class="control-label">图片类型</label>
                                            <div class="controls">
                                                <select name="type_photo[]">
                                                  <?php foreach ($arr['type_photo'] as $key => $value) {
                                                  ?>
                                                    <option value="<?php echo $key?>"><?php echo $value ?></option>
                                                  <?php
                                                  }?>   
                                                </select> 
                                            </div>
                                        </div>  
                                        <div class="control-group">
                                            <div class="controls" style="margin-top:20px;">
                                                <label class="control-label" style="text-align:left;float:left;">
                                                    <input type="hidden" name="property_photo[]" value=""/>
                                                    
                                                    <span id="PlaceHolder_property_photo"></span>
                                                </label>
                                                <label class="control-label"></label> 
                                                <label class="control-label">
                                                     <input type="button" class="btn red" value="编辑图片" style="height:31px!important;">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="margin:0;">
                                            <div class="controls">
                                                <div class="upload_progress">
                                                    <span class="localname"></span>
                                                </div>
                                                <div class="fieldset flash" id="fsUploadProgress_property_photo">
                                                    <span class="legend"></span>
                                                </div>
                                                <div id="property_photo_div" style="float:left;100%;height:200px;display: none;">
                                                    <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id='add_property' type="button" class="btn btn-primary">添加车源图片</button>
                                            <button id='del_property' type="button" class="btn red">删除车源图片</button>
                                        </div>
                                    </div>                                                                                           
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
                                    <style>
                                        .theFont{font-size: 20px;}
                                    </style>    
                                    <input type="hidden" value="<?php echo $count?>" name="the_count"/>                                
                                    <script>
                                    
                                    //点击添加多个图片
                                    var nummore =$('.more');
                                    var the_count=$("input[name='the_count']").val();
                                    $("button[id='add_property']").live("click",function(e){
                                    mores =$('.selecta').clone();
                                    mores.removeClass('selecta');
                                    mores.show();
                                    mores.addClass('more');
                                    nummore =$('.more');
                                    mores.find("#PlaceHolder_property_photo").attr('id','PlaceHolder_property_photo'+nummore.length+'a');
                                    mores.find("#fsUploadProgress_property_photo").attr('id','fsUploadProgress_property_photo'+nummore.length+'a');
                                    mores.find("#property_photo_div").attr('id','property_photo_div'+nummore.length+'a');
                                    //mores.find(".property_photo_show").attr('class','property_photo_show'+nummore.length);
                                    
                                    var the_number=parseInt(the_count)+parseInt(nummore.length);
                                    // console.log(nummore.length);
                                    $('#propertys').append(mores);
                                    //添加图片
                                      //console.log(mores);
                                        var swf_property_photo;
                                        //alert('swf_property_photo'+nummore.length);
                                        // window.onload = function() {
                                            var settings_property_photo = {
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
                                                    progressTarget : 'fsUploadProgress_property_photo'+nummore.length+'a',
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "100",
                                                button_height: "30",
                                                button_placeholder_id: 'PlaceHolder_property_photo'+nummore.length+'a',
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">+图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 20,
                                                button_text_top_padding: 6,
                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_property_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_property_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };
                                     // alert(nummore.length);
                                            swf_property_photo = new SWFUpload(settings_property_photo);
                                                                    
                                        // };
                                        function uploadSuccess_property_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;
                                    // alert(nummore.length);
                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            $('#property_photo_div'+nummore.length+'a').append(new_img);
                                            $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                             document.getElementsByName("property_photo[]")[the_number].value=document.getElementsByName("property_photo[]")[the_number].value+','+file_url;
                                            $('#property_photo_div'+nummore.length+'a').show();
                                        }

                                        function fileQueued_property_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }

                                        //alert(nummore.length);

                                    });   

                                    $("button[id='del_property']").live('click',function(){
                                    var delmore = $('.more');
                                    $('.more').eq(delmore.length-1).remove();
                                    if(delmore.length==0){
                                    alert('最后一个图片不能删除');
                                    }
                                    })

                                    // //添加图片单个
                                        var swf_property_photo;

                                        window.onload = function() {
                                            var settings_property_photo = {
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
                                                    progressTarget : "fsUploadProgress_property_photo"+the_count,
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "100",
                                                button_height: "30",
                                                button_placeholder_id: "PlaceHolder_property_photo"+the_count,
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">+图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 20,
                                                button_text_top_padding: 6,

                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_property_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_property_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };

                                            swf_property_photo = new SWFUpload(settings_property_photo);
                                                                    
                                        };
                                        function uploadSuccess_property_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;

                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            console.log();
                                            $("#property_photo_diva").append(new_img);
                                            $(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                            document.getElementsByName("property_photo[]")[the_count].value=document.getElementsByName("property_photo[]")[the_count].value+','+file_url;
                                            $("#property_photo_diva").show();
                                        }

                                        function fileQueued_property_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }        
                                    </script>
                                    <div class="form-actions">
                                        <button  type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
                                </form>

                                <!-- END FORM-->
                            </div>

                            <!-- 调取车源管理的图片 -->
                            <div  style="float:left;margin-left:20px;margin-top:27px;width:600px;">
                                <span style="font-size:16px;font-weight:bold;margin-left:30px;">车源图片：</span>
                                <?php 
                                    $count=0;
                                    if($property_photo){
                                        foreach ($property_photo as $k => $v){
                                            
                                            if ($v){
                                                $a='';
                                                foreach ($v as $k1 => $v1){
                                                    if ($k1==0){
                                                        $a=",".$v1->url;
                                                    }
                                                    else{
                                                        $a.=",".$v1->url;
                                                    }
                                                    
                                                }
                                            }      
                                        
                                ?>
                                    <div class="control-group">
                                        <!-- <label class="control-label">车源图片</label> -->
                                        <div class="controls">
                                            <select name="type_photo[]" disabled=true>
                                                <option value="">请选择图片类型</option>
                                                <option value="1" <?php echo $k==1? "selected":""?> >楼梯外观</option>
                                                <option value="2" <?php echo $k==2? "selected":""?>>交通图</option>
                                                <option value="3" <?php echo $k==3? "selected":""?>>格局图</option>
                                                <option value="4" <?php echo $k==4? "selected":""?>>平面图</option>
                                                <option value="5" <?php echo $k==5? "selected":""?>>外景图</option>
                                                <option value="6" <?php echo $k==6? "selected":""?>>办公室内(地面)</option>
                                                <option value="7" <?php echo $k==7? "selected":""?>>办公室内(室内吊顶)</option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="control-group" style="clear:both;">
                                        <div class="controls">
                                            <div id="property_photo_div<?php echo $k?>" style="float:left;100%;height:200px;<?php echo $k==null?'display: none':''; ?>">
                                                <?php 
                                                    if ($v):?>
                                                    <?php foreach ($v as $k1 => $v1):?>                       
                                                        <a target="_Blank" href="<?php echo $v1->url; ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                                    <?php endforeach; ?>
                                                    
                                                <?php endif ?>                                
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                            $count++;
                                        }
                                    }else{
                                        echo "<span style='font-size:16px;font-weight:bold;'>没有车源图片</span>";
                                    }
                                ?> 
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
    var districtid=$("select[name='district_id']").val();
    $.ajax("/admin/ajax/getarea", {
        data: {
            id:districtid
        },
        dataType: "json"
    }).done(function (data) {
        var options="";
        if(data.length>0){
            options+="<option value=''></option>";
            for(var i=0;i<data.length;i++){
                options+="<option value="+data[i].id+">"+data[i].title+"</option>";
            }
            $("select[name='area_id']").html(options);
        }
    });

    $("select[name='district_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示 
        $("select[name='area_id']").empty();
        var districtid=$("select[name='district_id']").val();
        if(null!= districtid && ""!=districtid){
            $.ajax("/admin/ajax/getarea", {
                data: {
                    id:districtid
                },
                dataType: "json"
            }).done(function (data) {
                var options="";
                if(data.length>0){
                    options+="<option value=''></option>";
                    for(var i=0;i<data.length;i++){
                        options+="<option value="+data[i].id+">"+data[i].title+"</option>";
                    }
                    $("select[name='area_id']").html(options);
                }
            });
        }
        else{
            $("#second").hide();
        }
    });

    $("select[name='area_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示 
        $("select[name='estate_id']").empty();
        var areaid=$("select[name='area_id']").val();
        if(null!= areaid && ""!=areaid){
            $.ajax("/admin/ajax/getestate", {
                data: {
                    id:areaid
                },
                dataType: "json"
            }).done(function (data) {
                var options="";
                if(data.length>0){
                    options+="<option value=''></option>";
                    for(var i=0;i<data.length;i++){
                        options+="<option value="+data[i].id+">"+data[i].title+"</option>";
                    }
                    $("select[name='estate_id']").html(options);
                }
            });
        }
        else{
            $("#second").hide();
        }
    });



    $("#estate_id").on("change",function(e){ 
        alert(1234);
   });

    

</script>


<script>
<!-- 图片删除 -->
    $(function(){
        $('.red').live('click',function(){
            $(this).parent().parent().parent().next().find('.del_photo').show();
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