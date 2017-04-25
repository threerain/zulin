<style>	
	.modal-body{font-size:18px;text-indent: 20px;}
	#modal-label{text-align:center;font-size:22px;}
	#about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
	#left{background:#167bcd;color:#fff;margin-right:10px;}
	#left:hover{background:#0160cb!important;}
  #table input{border:0 none!important;color:#222;font-weight:bold;text-align:center;}
  #table{margin-left:-70px;}
  #table,#testtr{overflow:auto!important;}
   #table .yj-title-th th input{width:150px!important;}
    #table .testtd td input{width:150px!important;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
?>
<div class="page-content">
  <div id="portlet-config" class="modal hide">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>portlet Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here will be a configuration form</p>
    </div>
  </div>
  <!-- BEGIN PAGE CONTAINER-->        
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid" style="min-height:10px;"></div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">
            <div class="caption"><i class="icon-reorder"></i>装修管理-添加结算单信息</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid"> 
              <!-- 价格结算开始表单 -->           	
                <div style="margin-left:40px;margin-bottom:500px;">
                  <form  action="/admin/decoration/CreateSave" style="margin:0;height:120px;margin-top:30px;" id="form_add"  method="post"  class="form-horizontal js-submit">
                    <input type="hidden" name="decoration_id" value="<?php echo $decoration_id; ?>">
                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span style="line-height:33px;margin-left:65px;">实际工程起止日：<input type="text" id="datepicker" disabled value="<?php echo $quality_follow->actual_start_time?date('Y-m-d',$quality_follow->actual_start_time):""?>" class="m-wrap" name="actual_start_time"/>&nbsp;至&nbsp;<input type="text" id="datepicker1" disabled value="<?php echo $quality_follow->actual_end_time?date('Y-m-d',$quality_follow->actual_end_time):""?>" class="m-wrap" name="actual_end_time"/></span>  
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span style="line-height:33px;">实际花费与预计花费的差额：<input type="text" name="actual_expected" disabled value="<?php echo $quality_follow->actual_expected;?>" maxlength="18"></span>  
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span style="line-height:33px;margin-left:105px;">差额原因：<textarea name="reason"  rows="5" style="width:350px;" disabled maxlength="127"><?php echo $quality_follow->reason;?></textarea></span>  
                    </div>
                    <div class="btn-group pull-left">  
                      <h4>价格结算</h4>
                    </div> 
                    <!-- 上传价格结算扫描件 -->
                    <div class="dataTables_filter">
                      <div class="control-group">
                        <div class="controls" style="margin-top:20px;">
                          <span style="float:left;">
                              <input type="hidden" name="settlement_photo" />
                              <span id="PlaceHolder_settlement_photo"></span>
                          </span>
                          <span>
                            <input type="button" class="btn red" value="编辑图片" style="height:30px!important;">
                          </span>
                        </div>
                      </div>
                      <div class="control-group" style="margin:0;">
                        <div class="controls">
                            <div class="upload_progress">
                                <span class="localname"></span>
                            </div>
                            <div class="fieldset flash" id="fsUploadProgress_settlement_photo">
                                <span class="legend"></span>
                            </div>
                            <div id="settlement_photo_div" style="float:left;100%;height:130px;display: none;">
                                <img name="settlement_photo_show" src="" style='display:none;max-width:100px;max-height:120px;float:left;margin-left:10px'/>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- 上传价格结算扫描件 -->
                    <div class="span8">
                      <div class="btn-group pull-right">  
                        <button id="add" class="btn btn-primary fow" type="button" style="float:right">
                            新增<i class="icon-plus"></i>
                        </button>
                      </div> 
                      <table class="table table-striped table-bordered table-hover" id="table"><!-- ID sample_1目前没用,js中控制显示效果 -->
                        <thead >
                          <tr class="yj-title-th">
                            <th><input type="text" value="序号"></th>
                            <th><input type="text" value="施工清单及材料"></th>
                            <th><input type="text" value="单位"></th>
                            <th><input type="text" value="材料规格及品牌"></th>
                            <th><input type="text" value="数量"></th>
                            <th><input type="text" value="单价"></th>
                            <th><input type="text" value="预算合计"></th>
                          </tr>
                        </thead>
                        <tbody id="testtr">                       
                          <tr class="testtd">
                            <td><input type="text"  class="xuhao" value="1"></td>
                            <td><input type="text" maxlength="127" name="list_material[]"></td>
                            <td><input type="text" maxlength="25" name="unit[]"></td>
                            <td><input type="text" maxlength="127" name="material_brands[]"></td>
                            <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="number[]"></td>
                            <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="unit_price[]"></td>
                            <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="total[]"></td>
                         </tr>
                        </tbody>
                      </table>
                      <div class="form-actions" style="clear:both;margin-top:100px;text-align:center;">
                        <button type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                      </div> 
                    </div>
                  </form> 
                 <!--  价格结算结束表单-->
                </div>
              </div>
            </div>
          </div>  
          <!-- END EXAMPLE TABLE PORTLET-->
      </div> 
    </div>
  </div>
    <!-- END PAGE CONTENT-->
</div>
  <!-- END PAGE CONTAINER-->
</div>

<!-- 隐藏的品牌系列编号 -->
<div style="display:none;clear:both;" class="select">
  <div class="dataTables_filter" style="margin-bottom:20px;">
    <span>
      品牌：<input type="hidden" name="estate_id[]" id="estate_id" class="select2 estate" style="width:230px">
    </span>
    <span>
      系列：<input type="hidden" name="building_id[]" id="building_id" class="select2 building" style="width:230px">
    </span>
    <span>
      编号：<input type="hidden" name="room_number[]" id="room_number" class="select2 room" style="width:230px">
            <input type="hidden" name="property_id[]" id="property_id">
    </span>  
    <span>
      建筑面积：<input name="area[]" id="area"  readonly=true type="text" placeholder="单位：㎡" class="m-wrap"/><span class="radio">㎡</span><!-- 建筑总面积 -->
    </span>                                           
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

<!-- 图片 -->
<style>
    .theFont{font-size: 20px;}
</style>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<script>
var swf_settlement_photo;
window.onload = function() {
    // 上传上传结算扫描件
    var settings_settlement_photo = {
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
            progressTarget : "fsUploadProgress_settlement_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_settlement_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">+添加扫描件</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_settlement_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_settlement_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_settlement_photo = new SWFUpload(settings_settlement_photo);
                            
};

function uploadSuccess_settlement_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("settlement_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("settlement_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#settlement_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("settlement_photo")[0].value=document.getElementsByName("settlement_photo")[0].value+','+file_url;
    $("#settlement_photo_div").show();
}

function fileQueued_settlement_photo(file){

    var stats = swf_settlement_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}
</script>
<!-- 图片删除 -->
<script>
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
                $(this).parent().parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>    
<script>
$(function(){
  var i=1;
  $("#add").click(function(){
    i++;
    $("#testtr").append($('.testtd').eq(0).clone()).find('tr').last().find('input').val('');
    $(".xuhao").last().val(i);
  })
})

</script>
