<style>
	.dataTables_filter{padding-left:10px;margin-top:20px!important;}
	.help-inline{color:red !important;}
	div>b{font-size:19px;margin-left:30px;font-weight:bold;}
	b{font-weight:normal;}

	label{display:inline;}
	div>b{font-size:19px;margin-left:30px;font-weight:bold;}
	b{font-weight:normal;}
	.form-horizontal .control-group {
	    margin-bottom: 0px;
	}
	.control-group {
	    padding-bottom: 0px;
	    margin-right:120px
	}
	.control-label{
		width:460px!important;
		text-align:right;

	}

	.controls{
		padding-left:35px
	}
	input{width:150px;}
	select{width:150px;}
</style>
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
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);//(验证js)
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
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

                                <div class="caption"><i class="icon-reorder"></i>客服-新增</div>

                                <div class="tools">
<!--
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                            	</div>
<!--客服外勤人员-->
                            <div class="portlet-body form" style="overflow:hidden;">
                                <!-- BEGIN FORM-->
                                <div class="span8" style="margin-left:40px;">
				                  <form action="/admin/serpurcontract/addsave"  id="form_add"  method="post"  class="form-horizontal js-submit">
				                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
				                    <div class="dataTables_filter" style="margin-bottom:10px">
				                      <span>
				                       客服外勤人员：<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:''; ?>
				                      </span>
				                      <span class="test line21">实际收房日期<span class="required" style="color:red">*</span>
				                        <input type="text" id="datep" value="" name="actual_date" required/>
				                      </span>
				                    </div>
				                    <?php foreach($data as $k => $v) { ?>
									<div class="dataTables_filter add_roomnumber" style="margin-bottom:10px">
					                  <span class="test line21"><b>品牌<span class="required" style="color:red">*&nbsp;</span><?php echo $v['estate_id'] ?></b>
					                  </span>
					                  <span class="test line21" style="margin-left:20px"><b>系列<span class="required" style="color:red">*&nbsp;</span><?php echo $v['building_id'] ?></b>
					                  </span>
					                  <span class="test line21" style="margin-left:20px"><b>编号<span class="required" style="color:red">*&nbsp;</span><?php echo $v['house_no'] ?></b>
					                  </span>
					                </div>
									<?php } ?>
			                       <div class="dataTables_filter" style="margin-bottom:10px;clear:both;">
				                      <span class="test line21">华亮收购人：
										<input type="hidden" name="hualiang_id" id="hualiang_id" class="select2" style="width:200px;">
				                      </span>
				                      <span class="test line21">幼狮销售：
				                        <input type="hidden" name="sale_id" id="sale_id" class="select2" style="width:200px;">
				                      </span>
				                      <span class="test line21">质量管理部：
				                        <input type="hidden" name="quality_id" id="quality_id" class="select2" style="width:200px;">
				                      </span>
				                      <span class="test line21">幼狮装饰：
				                        <input type="hidden" name="decorate_id" id="decorate_id" class="select2" style="width:200px;">
				                       <!--  <button class="btn red" type="button" style="margin-top:-7px;">
										上传收房清单图片</button> -->
				                      </span>
				                      <!-- 上传收房清单图片 -->
                                        <div class="control-group" style="margin-top:30px;">
                                            <div class="controls" style="margin-top:5px;">
                                                <span style="float:left;">
                                                    <input type="hidden" name="list_photo" style="height:35px!important;"/>
                                                    <span id="PlaceHolder_list_photo"></span>
                                                </span>
                                                <span>
				                                     <input type="button" class="btn red" value="编辑图片" style="height:35px!important;">
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
                                                <div id="list_photo_div" style="float:left;100%;height:130px;display: none;">
                                                    <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                </div>
                                            </div>
                                        </div>
										<!-- 上传收房清单图片结束 -->
			                       </div>

		                    <div class="span8" style="margin-top:20px;margin-left:-20px;"><b>水电费记录</b></div>
		                    		<div class="dellhydropower">
		                                <div >
						                    <div class="dataTables_filter" style="margin-bottom:10px">
						                      <span class="control-label">
						                      <b>表底数/电费余额：</b><input type="text"  maxlength="11" value=""  name="electricity_fees[]" onblur="check_next(this.value,this);" >
						                        <select name="electricity_unit[]" id="" >
													<option value="">请选择</option>
													<option value="1" >度</option>
													<option value="2">元</option>
						                        </select>
						                      </span>
						                    </div>
						                </div>
		                                 <div  style="margin-top:-20px;margin-left:40px;text-align:center">
						                    <div class="dataTables_filter" style="margin-bottom:10px;margin-left:-40px">
						                      <span class="control-label">
						                      <b>热水：</b><input type="text"  value="" maxlength="11" name="hot_water[]" onblur="check_next(this.value,this);">
						                        <select name="hot_unit[]" id="" >
													<option value="">请选择</option>
													<option value="1" >立方</option>
													<option value="2">元</option>
						                        </select>
						                      </span>

						                        <span class="control-label">
						                      <b>中水：</b><input type="text"  value=""  maxlength="11" name="middle_water[]" onblur="check_next(this.value,this);">
						                        <select name="middle_unit[]" id="" >
													<option value="">请选择</option>
													<option value="1" >立方</option>
													<option value="2">元</option>
						                        </select>
						                      </span>
						                      <span class="control-label">
						                      <b>冷水：</b><input type="text"  value=""  maxlength="11" name="cold_water[]" onblur="check_next(this.value,this);">
						                        <select name="cold_unit[]" id="" >
													<option value="">请选择</option>
													<option value="1" >立方</option>
													<option value="2">元</option>
						                        </select>
						                      </span>
						                    </div>
						                </div>
		                               <div >
						                    <div class="dataTables_filter" style="margin-bottom:10px">
						                      <span class="control-label">
						                      <b>燃气表：</b><input type="text"  value="" maxlength="11"  name="gas_meter[]" onblur="check_next(this.value,this);">
						                        <select name="gas_unit[]" id="" >
													<option value="">请选择</option>
													<option value="1" >立方</option>
													<option value="2">元</option>
						                        </select>
						                      </span>

						                    </div>
						                </div>
														<div  style="float:left;width:200px;height:50px;margin-left:110px">
																<label class="control-label"></label>

																		<button class="btn red addser_hydropower" type="button" style="margin-top:-7px;">添加</button>
																		<button class="btn red delser_hydropower" type="button" style="margin-top:-7px;">删除 </button>

														</div>
														<div style="clear:both;"></div>
					    			 </div>

										 				<div style="clear:both"></div>
														<div style="margin-bottom:10px;margin-top:10px;margin-left:85px;">
																<span  style="width:260px!important;float:left">
																<b>支付方式：</b><input type="text"  value=""  name="pay_method" maxlength="127" >
															</span>
																<span  style="width:300px!important;float:left;">
																<b>实际付款：</b><input type="text"  value=""  name="actual_payment"  maxlength="11" onblur="check(this.value,this);">元
																</span>
															</div>

					                <script type="text/javascript">
					                	//添加
					                	$(".addser_hydropower").click(function(){
					                		mores =$("#ser_hydropower").clone();
					                		mores.show();
					                		mores.addClass('moreser_hydropower');
					                		mores.removeAttr('id');
					                		mores.css("float",'none');
					                		$('.dellhydropower').append(mores);
					                	})
					                	//删除
					                	$(".delser_hydropower").click(function(){
					                		var delmore = $('.moreser_hydropower');
					                		$('.moreser_hydropower').eq(delmore.length-1).remove();
					                	})
					                </script>
								    <!--这里是特殊费用-->
								    <div id="test2" style="margin-top:30px;clear:both;">
			                           <div class="dellspecial"  style="margin-top:30px;">
			                           		<div class="span8" style="margin-top:30px;margin-left:-20px;clear:both;"><b>特殊费用</b></div>
						                    <div class="dataTables_filter" style="margin-bottom:10px;margin-left:25px;">
				                                <div class="span8">
								                    <div class="dataTables_filter" style="margin-bottom:10px;">
								                      <span>
										              <b>编号：</b>
										                <select name="house_no[]" class="house_no">
			                                              <?php foreach ($data as $kk => $vv) { ?>
			                                                <option value="<?php echo $vv['property_id'] ?>" <?php echo $vv['property_id']== $v['house_no']?"selected" :'' ?> ><?php echo $vv['house_no'] ?></option>
			                                              <?php } ?>
										                </select>
								                      </span>
								                    </div>
								                </div>
				                                <div class="span8" style="margin-left:10px;margin-top:-20px">
								                    <div class="dataTables_filter" style="margin-bottom:10px;margin-left:2px">
								                      <span>
								                      <b>类型：</b>
								                        <select name="type[]" id="">
															<option value="">请选择</option>
															<option value="1">费用预留</option>
															<option value="2">费用缴纳</option>
								                        </select>
								                      </span>
								                    </div>
								                </div>
												<div style="clear:both;"></div>
												<div>
							                       <span>
							                      <b> 费用金额：</b><input type="text"  value="" maxlength="7" name="amount[]" onblur="check(this.value,this);">元
							                      </span>
							                      <br/>
							                      <br/>
							                      <span >
							                      <b> 费用详情：</b><textarea   value="" name="details[]" class="span6 m-wrap" style="resize: none;width:650px;height:120px;"   maxlength="255"></textarea>
							                      </span>
												</div>
						                    </div>
						                </div>
						                <div class="span8" style="margin-top:30px;margin-left:30px;padding-left:30px;">
						               		<button class="btn red addser_special_cost" type="button" style="margin-top:-7px;">增加</button>
						                	<button class="btn red delser_special_cost" type="button" style="margin-top:-7px;">删除</button>
						                </div>
							            <script type="text/javascript">
											//添加
											$(".addser_special_cost").click(function(){
												mores =$("#addspecial").clone();
												mores.show();
												mores.addClass('morespecial');
												mores.removeAttr('id');
												mores.css("float",'none');
												$('.dellspecial').append(mores);
											})
											//删除
											$(".delser_special_cost").click(function(){
												var delmore = $('.morespecial');
												$('.morespecial').eq(delmore.length-1).remove();
											})
										</script>
									</div>
									<div style="clear:both;"></div>
			   						<div style="margin-top:50px;margin-left:-20px;clear:both;"><b>隐患记录</b></div>
			 						<!--这里是隐患记录-->
	 								<div class="dellafter" style="clear:both;margin-left:25px;">
	                       				<div class="dataTables_filter" style="margin-bottom:10px">
					                      <span>
					                      <b>客服外勤人员：</b><?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:''; ?>
					                      </span>
					                    </div>
					                    <div class="dataTables_filter" style="margin-bottom:10px;">
					                      <span style="margin-left:40px">
					                      <b>编号：</b>
					                        <select name="house_no_hidden[]" class="house_no">
							                  <?php foreach ($data as $kk => $vv) { ?>
							                    <option value="<?php echo $vv['property_id'] ?>" <?php echo $vv['property_id']== $v['house_no']?"selected" :'' ?> ><?php echo $vv['house_no'] ?></option>
							                  <?php } ?>
					                        </select>
					                      </span>
					                    </div>
	                        			 <div class="dataTables_filter" style="margin-bottom:10px;">
					                      <span style="margin-left:40px">
					                      <b>维修方：</b>
					                      </span>
					                      <span class="listtab">
				                      		<select name="service_type[]">
				                      			<option value="2">幼狮</option>
												<option value="1">车主</option>
				                        	</select>
					                      </span>
					                    </div>
					                	 <div class="dataTables_filter" style="margin-bottom:10px">
					                      <span style="margin-left:30px">
					                      <b>报修隐患：</b><input type="text"  value="" maxlength="127" name="hidden[]">
					                      </span>
					                      <br/>
					                      <br/>
					                      <span style="margin-left:30px">
					                      <b>隐患详情：</b><textarea  name="hidden_infor[]" value="" class="span6 m-wrap" style="resize: none;resize:none;width:600px;height:120px;" maxlength="255"></textarea><br>
					                      </span>
					                    </div>
					                    <!-- 图片开始 -->
                                        <div class="control-group">
                                            <div class="controls" style="margin-top:20px;margin-left:1px;">
                                                <span style="float:left;margin-right:30px;">
                                                    <input type="hidden" name="property_photo[]" />
                                                    <span id="PlaceHolder_property_photo"></span>
                                                </span>
                                                <span>
				                                     <input type="button" class="btn red" value="编辑图片" style="height:32px!important;">
				                                </span>
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
                                         <!-- 图片结束 -->
	                       				<div  style="margin-bottom:10px;clear:both;">
					                      <span style="margin-left:15px">
					                      <b> 隐患预计花费：</b><input type="text"  value=""  name="hidden_cost[]" maxlength="7" onblur="check(this.value,this);">元
					                      </span>
					                      <br/>
					                      <span style="float:left;margin-top:10px;margin-left:25px">
					                      <b>费用承担方：</b>
					                      </span>
					                      <span style="float:left;margin-top:10px;">
					                    	<select name="bear_type[]">
												<option value="2">幼狮</option>
												<option value="1">车主</option>
				                        	</select>
					                      </span>
					                      <br>
					                    </div>
									</div>
									<div style="clear:both;margin-top:30px;margin-bottom:20px;">
									  	<span style="margin-top:30px;margin-bottom:20px;margin-left:10px">
									  		<b>约定维修结束日期：</b><input type="text" id="datep1" value="" name="hope_end_time" />(维修方是车主时填)
									 	</span>
									 	<br><div style="height:10px"></div>
				                      	<span style="margin-top:30px;margin-bottom:30px;margin-left:60px;">
				                      		<b> 车主电话：</b><input type="text"  value="" onblur="check_phone(this.value,this);" placeholder="维修方是车主时填" name="owner_phone">
				                      	</span>
			                      	</div>
								 <!--这里是隐患结束-->
								<!--这里以上是内容框-->
							        <div class="dataTables_filter" style="margin-top:20px">
				                       <span>
				                      <b>
				                      	<div class="span8" style="margin-left:50px">
						               		<button class="btn red addser_after" type="button" style="margin-top:-7px;">增加</button>
						                	<button class="btn red delser_after" type="button" style="margin-top:-7px;">删除</button>
						                </div>
						               </b>
				                      </span>
							        </div>
							        <script type="text/javascript">
										//删除
										$(".delser_after").click(function(){
											var delmore = $('.more');
											$('.more').eq(delmore.length-1).remove();
										})
									</script>
				                    <div class="form-actions" style="clear:both;text-align:center">
				                    	<button  type="submit" class="btn btn-primary">保存</button>
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
<style>
    .theFont{font-size: 20px;}
</style>
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

        button_text: '<span class="theFont">上传收房清单</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 5,
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
    document.getElementsByName("list_photo")[0].value=document.getElementsByName("list_photo")[0].value+','+file_url;
    $("#list_photo_div").show();
}

function fileQueued_list_photo(file){

    var stats = swf_list_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}

</script>
<!-- 隐藏的水电费 -->
<div id="ser_hydropower" style="display:none;margin-top:40px;">
    <div >
        <div class="dataTables_filter" style="margin-bottom:10px">
          <span class="control-label">
          <b>表底数/电费余额：</b><input type="text"  maxlength="11" value=""  name="electricity_fees[]" onblur="check_next(this.value,this);" >
            <select name="electricity_unit[]" id="" >
				<option value="">请选择</option>
				<option value="1" >度</option>
				<option value="2">元</option>
            </select>
          </span>
        </div>
    </div>
     <div  style="margin-top:-20px;margin-left:40px;text-align:center">
        <div class="dataTables_filter" style="margin-bottom:10px;margin-left:-40px">
          <span class="control-label">
          <b>热水：</b><input type="text"  value="" maxlength="11" name="hot_water[]" onblur="check_next(this.value,this);">
            <select name="hot_unit[]" id="" >
				<option value="">请选择</option>
				<option value="1" >立方</option>
				<option value="2">元</option>
            </select>
          </span>

            <span class="control-label">
          <b>中水：</b><input type="text"  value=""  maxlength="11" name="middle_water[]" onblur="check_next(this.value,this);">
            <select name="middle_unit[]" id="" >
				<option value="">请选择</option>
				<option value="1" >立方</option>
				<option value="2">元</option>
            </select>
          </span>
          <span class="control-label">
          <b>冷水：</b><input type="text"  value=""  maxlength="11" name="cold_water[]" onblur="check_next(this.value,this);">
            <select name="cold_unit[]" id="" >
				<option value="">请选择</option>
				<option value="1" >立方</option>
				<option value="2">元</option>
            </select>
          </span>
        </div>
    </div>
   <div >
        <div class="dataTables_filter" style="margin-bottom:10px">
          <span class="control-label">
          <b>燃气表：</b><input type="text"  value="" maxlength="11"  name="gas_meter[]" onblur="check_next(this.value,this);">
            <select name="gas_unit[]" id="" >
				<option value="">请选择</option>
				<option value="1" >立方</option>
				<option value="2">元</option>
            </select>
          </span>

        </div>
    </div>
	<div style="clear:both;"></div>
 </div>

<!-- 隐藏的特殊费用 -->

<div id="addspecial" style="display:none;">
    <div class="dataTables_filter" style="margin-bottom:10px;margin-left:25px;">
        <div class="span8">
            <div class="dataTables_filter" style="margin-bottom:10px">
              <span>
              <b>编号：</b>
                <select name="house_no[]" class="house_no">
                  <?php foreach ($data as $kk => $vv) { ?>
                    <option value="<?php echo $vv['property_id'] ?>" <?php echo $vv['property_id']== $v['house_no']?"selected" :'' ?> ><?php echo $vv['house_no'] ?></option>
                  <?php } ?>
                </select>
              </span>
            </div>
        </div>
        <div class="span8" style="margin-left:10px;margin-top:-20px">
            <div class="dataTables_filter" style="margin-bottom:10px;margin-left:2px">
              <span>
              <b>类型：</b>
                <select name="type[]" id="">
					<option value="">请选择</option>
					<option value="1">费用预留</option>
					<option value="2">费用缴纳</option>
                </select>
              </span>
            </div>
        </div>
		<div style="clear:both"></div>
			<div>
	       <span>
	      <b>费用金额：</b><input type="text"  value="" maxlength="7" name="amount[]" onblur="check(this.value,this);">元
	      </span>
	      <br/>
	      <br/>
	      <span>
	      <b>费用详情：</b><textarea   value="" name="details[]" class="span6 m-wrap" style="resize: none;width:650px;height:120px;"   maxlength="255"></textarea>
		  </span>
		</div>
    </div>
</div>
<!-- 隐藏的隐患记录 -->
	 								<div id="addafter" style="display:none;clear:both;margin-top:60px;">
					                    <div class="dataTables_filter" style="margin-bottom:10px;">
					                      <span style="margin-left:40px">
					                      <b>编号：</b>
					                        <select name="house_no_hidden[]" class="house_no">
							                  <?php foreach ($data as $kk => $vv) { ?>
							                    <option value="<?php echo $vv['property_id'] ?>" <?php echo $vv['property_id']== $v['house_no']?"selected" :'' ?> ><?php echo $vv['house_no'] ?></option>
							                  <?php } ?>
					                        </select>
					                      </span>
					                    </div>
	                        			 <div class="dataTables_filter" style="margin-bottom:10px;">
					                      <span style="margin-left:40px">
					                      <b>维修方：</b>
					                      </span>
					                      <span class="listtab">
				                      		<select name="service_type[]">
				                      			<option value="2">幼狮</option>
												<option value="1">车主</option>
				                        	</select>
					                      </span>
					                    </div>
					                	 <div class="dataTables_filter" style="margin-bottom:10px">
					                      <span style="margin-left:30px">
					                      <b>报修隐患：</b><input type="text"  value="" maxlength="127" name="hidden[]">
					                      </span>
					                      <br/>
					                      <br/>
					                      <span style="margin-left:30px">
					                      <b>隐患详情：</b><textarea  name="hidden_infor[]" value="" class="span6 m-wrap" style="resize: none;resize:none;width:600px;height:120px;" maxlength="255"></textarea><br>
					                      </span>
					                    </div>
					                    <!-- 图片开始 -->
                                        <div class="control-group">
                                            <div class="controls" style="margin-top:20px;margin-left:1px;">
                                                <span style="float:left;margin-right:30px;">
                                                    <input type="hidden" name="property_photo[]" />
                                                    <span id="PlaceHolder_property_photo"></span>
                                                </span>
                                                <span>
				                                     <input type="button" class="btn red" value="编辑图片" style="height:32px!important;">
				                                </span>
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
                                         <!-- 图片结束 -->
	                       				<div  style="margin-bottom:10px;clear:both;">
					                      <span style="margin-left:15px">
					                      <b> 隐患预计花费：</b><input type="text"  value=""  name="hidden_cost[]" maxlength="7" onblur="check(this.value,this);">元
					                      </span>
					                      <br/>
					                      <span style="float:left;margin-top:10px;margin-left:25px">
					                      <b>费用承担方：</b>
					                      </span>
					                      <span style="float:left;margin-top:10px;">
					                    	<select name="bear_type[]">
												<option value="2">幼狮</option>
												<option value="1">车主</option>
				                        	</select>
					                      </span>
					                      <br>
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


<script type="text/javascript">
jQuery('#sample .group-checkable').change(function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
        if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }
    });
    jQuery.uniform.update(set);
});

jQuery('#sample .group-checkable').change(function () {
    var set = jQuery(this).attr("data-set");
    var checked = jQuery(this).is(":checked");
    jQuery(set).each(function () {
        if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }
    });
    jQuery.uniform.update(set);
});
//实际收房日期
  var picker = new Pikaday({
    field: document.getElementById('datep'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
  //预计维修结束时间
  var picker = new Pikaday({
    field: document.getElementById('datep1'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
</script>

<!-- 隐患图片开始 -->
<script>
//添加多个类型
var nummore =$('.more');
$(".addser_after").live("click",function(e){
mores =$("#addafter").clone();
mores.show();
mores.addClass('more');
mores.removeAttr('id');
mores.css("float",'none');
$('.dellafter').append(mores);
nummore =$('.more');
mores.find("#PlaceHolder_property_photo").attr('id','PlaceHolder_property_photo'+nummore.length);
mores.find("#fsUploadProgress_property_photo").attr('id','fsUploadProgress_property_photo'+nummore.length);
mores.find("#property_photo_div").attr('id','property_photo_div'+nummore.length);
//mores.find(".property_photo_show").attr('class','property_photo_show'+nummore.length);
// $('#propertys').append(mores);
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
                progressTarget : 'fsUploadProgress_property_photo'+nummore.length,
                cancelButtonId : "btnCancel"
            },
            debug: false,
// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: 'PlaceHolder_property_photo'+nummore.length,
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
        $('#property_photo_div'+nummore.length).append(new_img);
        $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("property_photo[]")[nummore.length].value=document.getElementsByName("property_photo[]")[nummore.length].value+','+file_url;
        $('#property_photo_div'+nummore.length).show();

    }

    function fileQueued_property_photo(file){

        var stats = swf_property_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    //alert(nummore.length);

});

// //添加图片
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
                progressTarget : "fsUploadProgress_property_photo",
                cancelButtonId : "btnCancel"
            },
            debug: false,
// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_property_photo",
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
        $("#property_photo_div").append(new_img);
        $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("property_photo[]")[0].value=document.getElementsByName("property_photo[]")[0].value+','+file_url;
        $("#property_photo_div").show();
    }

    function fileQueued_property_photo(file){

        var stats = swf_property_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

</script>

<!-- 隐患图片结束 -->

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
	function check_next(v,b){//验证是数字的  小数点后两位的  然后给后面的添加属性required 使用方法-> onblur="check_next(this.value,this);"
	    var a=/^[0-9]*(\.[0-9]{1,2})?$/;
	    if(!a.test(v)){
	         b.placeholder = "请填写正确的数据";
	         b.value = '' ;
	    }else{
	        if(b.value != ''){
	            $(b).next().next().attr("required",true);
	        }else{
	            $(b).next().next().attr("required",false);
	        }
	    }
	}
function check(v,b){//验证是数字的 小数点后两位的 onblur="check(this.value,this);"
    var a=/^[0-9]*(\.[0-9]{1,2})?$/;
    if(!a.test(v)){
         b.placeholder = "请填写正确的数据";
         b.value = '' ;
    }
}
function check_phone(v,b){//手机号验证 onblur="check_phone(this.value,this);"
    var a=/^1[3|4|5|7|8]\d{9}$/;
    if(!a.test(v)){
        b.placeholder = "请输入正确的手机号";
        b.value = '' ;
    }
}
</script>
