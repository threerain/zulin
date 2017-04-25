
<style media="screen">
   div{overflow:visible}
   input{width:200px}
   .control-group{margin-top:-20px}\
   /*.checkbox{margin-right:30px;}
   .checker{margin-right:-19px;}*/
   .radio input[type="radio"], .checkbox input[type="checkbox"] {
    float: left;
    margin-left: 2px!important;
}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);

  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
  App.init();
  FormValidation.init();
  FormComponents.init();
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

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>新建报修单</div>

                                <div class="tools">
<!--
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                            </div>

                            <div class="portlet-body form">

                              <form action="/admin/seraftersales/create"  id="form_add"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="solve" value="1">
                                    <div class="alert alert-error hide">
                                                <button class="close" data-dismiss="alert"></button>
                                                输入格式有误，请检查输入的数据.
                                            </div>
                                            <div class="alert alert-success hide">
                                                <button class="close" data-dismiss="alert"></button>
                                                数据输入验证成功!
                                            </div>
                                  <style>
                                      .control{float:left;}
                                  </style>
                                <input type="hidden" name="property_id" id="property_id" value="">
                                <div class="control-group" >
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control" style="margin-left:90px;margin-top:40px!important">
                                    <label>制单人：<input type="text" value="<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:'' ?>" disabled=true></label>
                                  </div>
                                </div>
                                <div class="control-group">
                                      <label class="controls control">报修人<span style="color:red">*</span></label>
                                      <select class="" name="repair_user_type" id="test" required>
                                          <option value='1'>租户</option>
                                          <option value='2'>内部报修</option>
                                      </select>
                                </div>
                              <!--这里是隐藏显示1-->
                              <div id="content1">
                                <div class="control-group" style="margin-left:20px">
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control">
                                    <label>&nbsp;&nbsp;姓&nbsp;名<span style="color:red">*</span><input type="text" name='name' class='del' maxlength="40" placeholder="请输入租户名40字以内" required="required"></label>
                                  </div>
                                </div>

                              <!--这里是隐藏显示1结束--></div>

                              <!--这里是隐藏显示2-->
                              <div id="content2" style="display:none">
                                <div class="control-group" style="margin-left:110px;">
                                    <label class="control-label">部门<span class="required">*</span></label>
                                    <div class="controls" style="margin-left:-60px;">
                                        <input type="hidden" name="department_id" id="department_id" class="span4 select2 del1" required style="width:230px">
                                    </div>
                                </div>
                                <div class="control-group" style="margin-left:110px;">
                                    <label class="control-label">姓名<span class="required">*</span></label>
                                    <div class="controls" style="margin-left:-60px;">
                                        <input type="hidden" name="urs_user_id" id="urs_user_id" class="span4 select2 del2" required style="width:230px">
                                    </div>
                                </div>
                              <!--这里是隐藏显示2结束--></div>
                              <script type="text/javascript">
                                  $("#test").change(function(){
                                        if($(this).val()==1){
                                            $("input[name=name]").attr('required','required');
                                            $("#content1").show();
                                            $("#content2").hide();
                                        }
                                        if($(this).val()==2){
                                              $("input[name=name]").removeAttr('required');
                                              $("#content2").show();
                                              $("#content1").hide();
                                        }
                                  })
                              </script>
                              <div class="control-group">
                                <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                <div class="controls control" style="margin-left:60px;">
                                  <label>&nbsp;&nbsp;电&nbsp;话<span style="color:red">*</span><input type="text" name='phone' maxlength="11" placeholder="请输入纯数字"  required onblur="check_phone(this.value,this);"></label>
                                </div>
                              </div>
                                <div class="control-group" style="margin-left:120px;">
                                    <label class="control-label">品牌<span class="required">*</span></label>
                                    <div class="controls" style="margin-left:-60px;">
                                        <input type="hidden" name="estate_id" id="estate_id" class="span4 select2" style="width:230px">
                                    </div>
                                </div>
                                <div class="control-group" style="margin-left:120px;">
                                    <label class="control-label">系列<span class="required">*</span></label>
                                    <div class="controls" style="margin-left:-60px;">
                                        <input type="hidden" name="building_id" id="building_id" class="span4 select2" style="width:230px">
                                    </div>
                                </div>
                                <div class="control-group" style="margin-left:120px;">
                                    <label class="control-label">编号<span class="required">*</span></label>
                                    <div class="controls" style="margin-left:-60px;">
                                        <input type="hidden" name="room_number" id="room_number" class="span4 select2" style="width:230px">
                                        <input type="hidden" name="property_id[]" id="property_id">
                                    </div>
                                </div>
                                <div class="control-group">
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control" style="margin-left:75px">
                                    <label>类&nbsp;&nbsp;型<span style="color:red">*</span><select name='repair_type' id='repair' required="required">
                                              <option value=''>请选择</option>
                                          <?php
                                                $type = SerAfterSales::model()->arr();
                                                foreach ($type['repair_type'] as $key => $value) {
                                            ?>
                                              <option value="<?php echo $key?>"><?php echo $value ?></option>
                                          <?php
                                            }?>
                                    </select>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control" style="margin-left:75px">
                                    <label>报修隐患<span style="color:red">*</span><textarea name='hidden' maxlength='255' style="height:50px;width:200px" required></textarea></label>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control" style="margin-left:75px">
                                    <label>隐患详情:<textarea name="hidden_infor" maxlength='255' style="height:100px;width:400px"></textarea>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control">
                                    <span style="font-size:15px">费用承担方：</span>
                                      <label class="checkbox" >
                                         <input type="checkbox" name="bear_type[]" value="1"  style=' margin-left:2px!important;' />车主
                                      </label>
                                      <label class="checkbox" >
                                        <input type="checkbox" name="bear_type[]" value="2" style=' margin-left:2px!important;' />幼狮
                                      </label>
                                      <label class="checkbox">
                                        <input type="checkbox" name="bear_type[]" value="3"   style=' margin-left:2px!important;'/>前租户
                                      </label>
                                      <label class="checkbox">
                                          <input type="checkbox" name="bear_type[]" value="4"  style=' margin-left:2px!important;'/>租户
                                      </label>
                                  </div>
                                </div>
                                <div class="control-group">
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control">
                                    维修方：
                                      <label class="radio">
                                          <input type="radio" name="service_type" value="1"   />
                                          车主
                                      </label>
                                      <label class="radio">
                                          <input type="radio" name="service_type" value="2"   />
                                          幼狮
                                      </label>
                                      <label class="radio">
                                          <input type="radio" name="service_type" value="3"   />
                                          租户
                                      </label>
                                  </div>
                                </div>
                                 <div class="control-group" style="clear:both;margin-bottom:30px;">
                                  <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
                                  <div class="controls control">
                                    <!-- 上传隐患图片开始 -->

                                                  <div class="controls">
                                                      <span>
                                                          <input type="hidden" name="hidden_photo" />
                                                          <span id="PlaceHolder_hidden_photo">aa</span>
                                                      </span>
                                                    <span>
                                                        <input type="button" class="btn red" value="编辑图片" style="margin-top:-20px;height:32px!important;width:100px!important">
                                                    </span>
                                                  </div>

                                                  <div class="controls">
                                                      <div class="upload_progress">
                                                          <span class="localname"></span>
                                                      </div>
                                                      <div class="fieldset flash" id="fsUploadProgress_hidden_photo">
                                                          <span class="legend"></span>
                                                      </div>
                                                      <div id="hidden_photo_div" style="float:left;100%;display: none;">
                                                          <img name="hidden_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                      </div>
                                                  </div>

                              <!-- 上传隐患图片结束 -->

                                  </div>
                                  <div class="control-group" style="clear:both;"></div>
                                      <div class="controls control" style="margin-top:30px;">

                                                    <button id="sample_editable_2" class="btn btn-primary" type="submit" onclick="return x()" id="button1">
                                                    确认派单
                                                    </button>
                                                     <button id="sample_editable_3" class="btn btn-primary" type="submit"   onclick='solve_one();' >
                                                    客服已解决
                                                    </button>
                                                    <button id="sample_editable_4" class="btn btn-primary" type="submit"   onclick='solve_two();' >
                                                    客服未解决
                                                   </button>
                                                     <button  class="btn"  type="button" onclick="history.go(-1)">
                                                    取消
                                                    </button>

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
<!-- 引入图片上传所需的JS -->
<style>
    .theFont{font-size: 20px;}
</style>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<script>
// 上传隐患图片
var swf_hidden_photo;
// window.onload = function() {
    var settings_hidden_photo = {
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
            progressTarget : "fsUploadProgress_hidden_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_hidden_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">上传隐患图片</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_hidden_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_hidden_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_hidden_photo = new SWFUpload(settings_hidden_photo);

// };
function uploadSuccess_hidden_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("hidden_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("hidden_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#hidden_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("hidden_photo")[0].value=document.getElementsByName("hidden_photo")[0].value+','+file_url;
    $("#hidden_photo_div").show();
}

function fileQueued_hidden_photo(file){

    var stats = swf_hidden_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}

</script>
<!-- 图片删除 -->
<script>
    $(function(){
        $('.red').on('click',function(){
            $(this).parent().parent().next().find('.del_photo').show();
            $('.del_photo').click(function(){
                var del_photo_url = $(this).prev().children().attr('src');
                var dataStr = $(this).parent().parent().prev().find("input[type='hidden']").val();
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
                $(this).parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>


<!-- 新增保修单 -->
<script language="javascript" type="text/javascript">
  //选中元素
  $('.fow').click(function(){
    var property_id=$(this).attr('id');
    document.getElementById("property_id").value=property_id;
    // $("#property_id").value="aa";
    if(document.getElementById("follow").style.display != "block")
    {
      document.getElementById("follow").style.display = "block";
    }
    else
    {
      document.getElementById("follow").style.display = "none";
    }
    $("#quxiao").click(function(){
      $("#follow").css('display','none');
    })
  });
		function solve_one(){
			$("input[name=solve]").val(0);
			// var b= $("#repair").val();
		  // if(b=="")
		  // {
		  //  alert("类型选项不能为空");
		  //  return false;
		  // }
			// document.forms.form_add.action="/admin/seraftersales/create";
			// document.forms.form_add.submit();
		}
		function solve_two(){
			$("input[name=solve]").val(2);
      $("input[name=name]").attr("required","required");
			// var b= $("#repair").val();
			// if(b=="")
			// {
			//  alert("类型选项不能为空");
			//  return false;
			// }
			// document.forms.form_add.action="/admin/seraftersales/create";
			// document.forms.form_add.submit();
		}

</script>
<!-- 选择跳转 -->
<script type="text/javascript">
		$("#repair").change(function(){
			var val = $(this).val();
			if (val == 4){
						var anwser = confirm("是否要跳转到北京市企业信用信息网?");
						if(anwser){
							window.open("http://211.94.187.236/");
						}
			}
		})
$(".delete").click(function(){
		var id =	$(this).attr('address');
		$(".add").attr('href',id);
})
</script>
<script type="text/javascript">
$(function(){
  $("#highsearch").click(function(){
    $("#content").toggle();
  })

    $("#test").change(function(){
    if($(this).val()=='1'){
      $(".del").attr("required","required");
      $(".del1").removeAttr("required");
      $(".del2").removeAttr("required");
      $("#content2").hide();
      $("#content1").show();
    };
    if($(this).val()=='2'){
      $(".del").removeAttr("required");
      $("#content2").show();
      $("#content1").hide();
    };

  })
  $(".del").blur(function(){

    $(".del1").removeAttr("required");
    $(".del2").removeAttr("required");

    })
  })
</script>
<!-- 判断类型选项 -->
<script language=javascript>
function x()
{
 var b= $("#repair").val();
 if(b=="")
 {
  alert("类型选项不能为空");
  return false;
 }
}
</script>
<!-- 日期 -->
<script type="text/javascript">
		 var picker = new Pikaday({
				 field: document.getElementById('datepicker'),
				 firstDay: 1,
				 minDate: new Date('2010-01-01'),
				 maxDate: new Date('2030-12-31'),
				 yearRange: [2000,2030]
		 });

		 var picker = new Pikaday({
				 field: document.getElementById('datepicker1'),
				 firstDay: 1,
				 minDate: new Date('2010-01-01'),
				 maxDate: new Date('2030-12-31'),
				 yearRange: [2000,2030]
		 });
//
     	$(function(){
         $("#highsearch").click(function(){
             var aa = $("input[name=search]").val();
         console.log(aa);
             $("#content").toggle();
             if(aa == 1 || aa == ''){
                 $("input[name=search]").val(2);
             }else{
                 $("input[name=search]").val(1);
             }
         })

       })
 </script>
<script>
$(function(){
  $("#closemodel2").click(function(){
    $("#follow").hide();
  });
})
</script>
