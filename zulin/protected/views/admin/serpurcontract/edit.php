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

                                <div class="caption"><i class="icon-reorder"></i>客服-编辑</div>

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
				                  <form action="/admin/serpurcontract/editsave"  id="form_edit"  method="post"  class="form-horizontal js-submit">
				                    <input type="hidden" name="id" value="<?php echo $model->id ?>">
				                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
				                    <div class="dataTables_filter" style="margin-bottom:10px">
				                      <span>
				                      <b>  客服外勤人员：</b><?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"";?>
				                      </span>
				                      <span class="test line21" style="margin-left:20px"><b>实际收房日期<span class="required" style="color:red">*</span></b>
				                        <input type="text" id="datep" required value="<?php echo $model->actual_date?date('Y-m-d',$model->actual_date):"";?>" name="actual_date" />
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
				                      <span class="test line21" ><b>华亮收购人：</b>
										<input type="hidden" name="hualiang_id" id="hualiang_id" class="select2" style="width:200px;" value="<?php echo $model==null?"":$model->hualiang_id;?>">
				                      </span>
				                      <span class="test line21" style="margin-left:10px"><b>幼狮销售：</b>
				                        <input type="hidden" name="sale_id" id="sale_id" class="select2" style="width:200px;" value="<?php echo $model==null?"":$model->sale_id;?>">
				                      </span>
				                      <span class="test line21" style="margin-left:10px"><b>质量管理部：</b>
				                        <input type="hidden" name="quality_id" id="quality_id" class="select2" style="width:200px;" value="<?php echo $model==null?"":$model->quality_id;?>">
				                      </span>
				                      <span class="test line21" style="margin-left:10px"><b>幼狮装饰：</b>
				                        <input type="hidden" name="decorate_id" id="decorate_id" class="select2" style="width:200px;" value="<?php echo $model==null?"":$model->decorate_id;?>">
				                      </span>
				                      <!-- 上传收房清单图片 -->
                                        <div class="control-group" style="margin-top:30px">
                                            <div class="controls" style="margin-top:20px;margin-left:30px;margin-right:20px;">
                                                <span style="float:left;">
                                                    <input type="hidden" name="list_photo" value="<?php $a =  ','.implode(',',$list_photo);echo $list_photo?$a:'' ?>"/>
                                                    <span id="PlaceHolder_list_photo"></span>
                                                </span>
                                                <!-- <span><input type="button" class="btn red" value="下载"></span> -->
                                                <span style="float:left;">
				                                     <input type="button" class="btn red" value="编辑图片" style="height:32px!important;">
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
                                                <div id="list_photo_div" style="float:left;height:130px;<?php echo $list_photo==null?'display: none':''; ?>">
                                                <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                <?php if ($list_photo): ?>
                               					 	<?php foreach ($list_photo as $key => $value): ?>
					                                	<a target="_Blank" href="<?php echo $value ?>"><img name="list_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
					                                	<img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
					                                <?php  endforeach ?>
					                            <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
										<!-- 上传收房清单图片结束 -->
			                       </div>

		                        	<div style="margin-top:20px;margin-left:-20px;"><b>水电费记录</b></div>
					                <?php

					                    foreach($ser_Hydropower as $key=>$value){
					                ?>
		                    		<div class="dellhydropower">
															<div >
													<div class="dataTables_filter" style="margin-bottom:10px">
														<span class="control-label">
														<b>表底数/电费余额：</b><input type="text"  maxlength="11" value="<?php echo $value->electricity_fees?$value->electricity_fees/100:'';?>"  name="electricity_fees[]" onblur="check_next(this.value,this);" >
															<select name="electricity_unit[]" id="" >
																<option value="">请选择</option>
																<option value="1" <?php echo $value->electricity_unit==1?"selected":""?> >度</option>
																<option value="2" <?php echo $value->electricity_unit==2?"selected":""?>>元</option>
															</select>
														</span>
													</div>
											</div>
																<div  style="margin-top:-20px;margin-left:40px;text-align:center">
													 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:-40px">
														 <span class="control-label">
														 <b>热水：</b><input type="text"  maxlength="11" value="<?php echo $value->hot_water?$value->hot_water/100:'';?>"  name="hot_water[]" onblur="check_next(this.value,this);">
															 <select name="hot_unit[]" id="" >
																	 <option value="">请选择</option>
																	 <option value="1"  <?php echo $value->hot_unit==1?"selected":""?> >立方</option>
																	 <option value="2" <?php echo $value->hot_unit==2?"selected":""?>>元</option>
															 </select>
														 </span>

															 <span class="control-label">
														 <b>中水：</b><input type="text"  value="<?php echo $value->middle_water?$value->middle_water/100:'';?>"   maxlength="11" name="middle_water[]" onblur="check_next(this.value,this);">
															 <select name="middle_unit[]" id="" >
																	 <option value="">请选择</option>
																	 <option value="1" <?php echo $value->cold_unit==1?"selected":""?>>立方</option>
																	 <option value="2" <?php echo $value->cold_unit==2?"selected":""?>>元</option>
															 </select>
														 </span>
														 <span class="control-label">
														 <b>冷水：</b><input type="text"  value="<?php echo $value->gas_meter?$value->gas_meter/100:'';?>"  maxlength="11" name="cold_water[]" onblur="check_next(this.value,this);">
															 <select name="cold_unit[]" id="" >
																	 <option value="">请选择</option>
																	 <option value="1" <?php echo $value->gas_unit==1?"selected":""?>>立方</option>
																	 <option value="2" <?php echo $value->gas_unit==2?"selected":""?>>元</option>
															 </select>
														 </span>
													 </div>
											 </div>
															 <div >
														<div class="dataTables_filter" style="margin-bottom:10px">
															<span class="control-label">
															<b>燃气表：</b><input type="text"  maxlength="11" value="<?php echo $value->gas_meter?$value->gas_meter/100:'';?>" name="gas_meter[]" onblur="check_next(this.value,this);">
																<select name="gas_unit[]" id="" >
											<option value="">请选择</option>
											<option value="1" <?php echo $value->gas_unit==1?"selected":""?> >立方</option>
											<option value="2" <?php echo $value->gas_unit==2?"selected":""?> >元</option>
																</select>
															</span>
														</div>
													</div>
													
														<div  style="float:left;width:200px;height:50px;margin-left:110px">
														<label class="control-label"></label>

																<?php if($key==0 || $ser_Hydropower==null) {?>
																	<button class="btn red addser_hydropower" type="button" style="margin-top:-7px;">添加</button>
																<?php }else{?>	
																<button class="btn red delser_hydropower" type="button" style="margin-top:-7px;">删除 </button>
																<?php }?>

														</div>
													<div style="clear:both;"></div>
					    			 </div><br>
					    			<?php
						                }

					                ?>
					                <div class="hydropower"></div>
													<div style="margin-bottom:10px;margin-left:15px;clear:both">
															<span  style="margin-left:70px;width:260px!important;float:left">
															<b>支付方式：</b><input type="text"  value="<?php echo $model->pay_method;?>"  name="pay_method" maxlength="127" >
														</span>
															<span  style="width:300px!important;float:left;">
															<b>实际付款：</b><input type="text"  value="<?php echo $model->actual_payment/100?$model->actual_payment/100:'';?>"   name="actual_payment"  maxlength="11" onblur="check(this.value,this);">元
															</span>
														</div>
					                <script type="text/javascript">
    
                                            $(".addser_hydropower").click(function(){ 
                                                var html = $("#ser_hydropower").clone();
                                                html.removeAttr('id');
                                                html.show();
                                                $(".hydropower").append(html)
                                                $(".delser_hydropower").click(function(){
                                                    $(this).parent().parent().remove();
                                                })
                                            })
                                            $(".delser_hydropower").click(function(){
                                               $(this).parent().parent().remove();
                                            })



					                </script>
													<!--这里是特殊费用-->
											    <div id="test2" style="margin-top:30px;clear:both;">
						                           <div class="dellspecial"  style="margin-top:30px;">
						                           		<div class="span8" style="margin-top:30px;margin-left:-20px;clear:both;"><b>特殊费用</b></div>
																					<?php
																						if($house_no){
																							foreach($house_no as $k=>$value){
																					?>
									                    <div class="dataTables_filter" style="margin-bottom:10px">
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
																		<option value="1" <?php echo $type[$k]==1?"selected":""?>>费用预留</option>
																		<option value="2" <?php echo $type[$k]==2?"selected":""?>>费用缴纳</option>
											                        </select>
											                      </span>
											                    </div>
											                </div>
															<div style="clear:both;"></div>
															<div style="margin-left:-2px">
										                       <span>
										                      <b> 费用金额：</b><input type="text"  value="<?php echo $amount[$k]?$amount[$k]:'';?>"  maxlength="7" name="amount[]" onblur="check(this.value,this);">元
															  </span>
															  <br/>
															  <br/>
																<span>
										                      		<b> 费用详情：</b><textarea   value="" name="details[]" class="span6 m-wrap" style="resize: none;width:650px;height:120px;"   maxlength="255"><?php echo $details[$k];?></textarea>
										                      																	<?php if($k==0 || $house_no==null) {?>
																	<button class="btn red addser_special_cost" type="button" style="margin-top:-7px;">增加</button>
																<?php }else {?>
																	<button class="btn red deltsf" type="button" style="margin-top:-7px;">删除</button>
																<?php }?>
										                      	</span>
															</div>
									                    </div>
									                </div>
																	<?php
																		}
																	}
																	?>

							            <script type="text/javascript">
				                        $(function(){
						                	$(".deltsf").live('click',function(){
				                            //删除其父类P标签
				                            $(this).parent().parent().parent().remove()
				                            })
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
											// $(".delser_special_cost").click(function(){
											// 	var delmore = $('.morespecial');
											// 	$('.morespecial').eq(delmore.length-1).remove();
											// })
				                        })
										</script>
									</div>
				                    <div class="form-actions" style="margin-left:600px!important;margin-bottom:30px;margin-top:30px;">
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
window.onload = function() {
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
        button_text_left_padding:5,
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

};
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
	<div  style="float:left;width:200px;height:50px;margin-left:110px">
		<label class="control-label"></label>
		<button class="btn red delser_hydropower" type="button" style="margin-top:-7px;">删除</button>
	</div>
	<div style="clear:both;"></div>
 </div>

<!-- 隐藏的特殊费用 -->
<div id="addspecial" style="display:none;">
    <div class="dataTables_filter" style="margin-bottom:10px">
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
			<div style="margin-left:-2px">
	       <span>
	      <b>费用金额：</b><input type="text"  value="" maxlength="7" name="amount[]" onblur="check(this.value,this);">元
	      </span>
	      <br/>
	      <br/>
	      <span>
	      <b>费用详情：</b><textarea   value="" name="details[]" class="span6 m-wrap" style="resize: none;width:650px;height:120px;"   maxlength="255"></textarea>
	      <button class="btn red deltsf" type="button" style="margin-top:-7px;">删除</button>
	      </span>
		</div>

    </div>
</div>
<!-- 多编号的时出来 -->
<div class="span8 " id="addroom" style="display:none">
   <div class="dataTables_filter" style="margin-bottom:10px">

        <span class="test line21"><b>品牌：</b>
        	<span class="estates"></span>
   </span>
   <span class="test line21"><b>系列：</b>
		<span class="buildings"></span>
   </span>
    <span class="test line21"><b>编号：</b>
            <span class="rooms" ></span>
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
                console.log(str)
                $(this).parent().parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>
