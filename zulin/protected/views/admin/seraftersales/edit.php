<style>
	.dataTables_filter{padding-left:100px;margin-top:25px!important;}
	div>b{font-size:18px;margin-left:30px;}
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
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();");
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

                                <div class="caption"><b class="icon-reorder"><span style="font-size:16px;">售后信息</span></b></div>

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
														      <form action="/admin/seraftersales/EnterEdit" id="form_edit"  method="post"  class="form-horizontal js-submit">
																		<input type="hidden" name="solve" value="1">
																		<input type="hidden" name='id' value="<?php echo $id?>">
																		<input type="hidden" name="referer" value="<?php echo $referer?>">
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
															  <div class="control-group">
															    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
															    <div class="controls control" style="margin-top:30px;">
															      <label style="margin-left:105px">&nbsp;制单人：<?php
																								$user = AdminUser::model()->find("id='$model->criter_id'");
																								echo $user->nickname;
																		?></label>
															    </div>
															  </div>

															  <div class="control-group" style="margin-top:-30px">
															        <label class="controls control" style="margin-left:210px">报修人：</label>
															        <select class="" name="repair_user_type" id="test" >
															            <option value='1' <?php echo $model->repair_user_type==1?'selected':''?>>租户</option>
															            <option value='2' <?php
																					if($model->repair_type==1 || $model->repair_type==2 || $model->repair_user_type==2) {
																							echo 'selected';
																					}

																					?>>内部报修</option>
															        </select>
															  </div>
															<!--这里是隐藏显示1-->
															<div id="content1">
															  <div class="control-group" style="margin-top:-30px">
															    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

															      <label style="margin-left:225px">姓名：<input type="text" name='name' class='del' value="<?php
																										if($model->repair_user_type==1){
																													echo $model->name;
																										}

																		?>" maxlength="40"  ><span style="color:red">*</span></label>

															  </div>

															<!--这里是隐藏显示1结束--></div>

															<!--这里是隐藏显示2-->
															<div id="content2" style="display:none;margin-top:-30px">
																<div class="control-group" style="margin-left:120px;">
																		<label class="control-label" style="margin-left:125px">部门:</label>
																		<div class="controls" style="margin-left:-40px;">
																				<input type="hidden" name="department_id" id="department_id" class="span4 select2 del1" style="width:230px"
																				<?php echo $model->repair_user_type==2?"required":''?>
																					value='<?php
																								if($model->department_id) {
																										echo $model->department_id;
																								}else if($model->urs_user_id) {
																										$user_id = AdminUser::model()->find("id='$model->urs_user_id'");
																										if($user_id) {
																												$department_id = AdminDepartment::model()->find("id='$user_id->department_id'");
																												echo $department_id->id;
																										}
																								}
																							?>'

																					title="<?php
																								$department = AdminDepartment::model()->find("id='$model->department_id'");
																								if($department){
																									echo $department->name;
																								}else if($model->urs_user_id) {
																										$user_id = AdminUser::model()->find("id='$model->urs_user_id'");
																										if($user_id) {
																												$department_id = AdminDepartment::model()->find("id='$user_id->department_id'");
																												echo $department_id->name;
																										}
																								}

																					?>"
																		><span style="color:red">*</span>
																		</div>
																</div>
																<div class="control-group" style="margin-left:120px;margin-top:-30px">
																		<label class="control-label" style="margin-left:125px">姓名:</label>
																			<div class="controls" style="margin-left:-40px;">
																				<input type="hidden" name="urs_user_id" id="urs_user_id" class="span4 select2 del2" style="width:230px"
																						value='<?php echo $model->urs_user_id?>'
																						title="<?php
																										 $user = AdminUser::model()->find("id='$model->urs_user_id'");
																										 if($user){
																											 echo $user->nickname;
																										 }
																					 ?>"		required
																				><span style="color:red">*</span>
																			</div>
																</div>
															<!--这里是隐藏显示2结束--></div>
															<div class="control-group" style="margin-top:-30px">
																<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
																<div class="controls control">
																	<label style="margin-left:135px">电话：<input type="text" name='phone' maxlength="11" placeholder="请输入纯数字" value="<?php echo $model->phone?>" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-]+/,'');}).call(this)" onblur="this.v();">
																	</label>
																</div>
															</div>
															  <div class="control-group" style="margin-left:245px;margin-top:-30px">
															      <label class="control-label">品牌:</label>
															      <div class="controls" style="margin-left:-40px;">
																			<input type="hidden" name="estate_id"  class="estate_id span4 select2"  id="estate_id"  value="estate_id" required
																	title="<?php
																						$data=CmsProperty::model()->find("id='$model->property_id'");
																						if($data){
																							$item=BaseEstate::model()->find("id='$data->estate_id'");
																							echo $item->name;
																						}


																	 ?>" style="width:230px">	<span style='color:red'>*</span>
															      </div>
															  </div>
															  <div class="control-group" style="margin-left:245px;margin-top:-30px">
															      <label class="control-label">系列:</label>
															      <div class="controls" style="margin-left:-40px;">
															          <input type="hidden" name="building_id" id="building_id" class="span4 select2" style="width:230px" accept="text/html" value="building_id" title="<?php
																									$data=CmsProperty::model()->find("id='$model->property_id'");
																									if($data){
																										$item=BaseBuilding::model()->find("id='$data->building_id'");
																										echo $item->name;
																									}

																				?>"><span style="color:red">*</span>
															      </div>
															  </div>
															  <div class="control-group" style="margin-left:245px;margin-top:-30px">
															      <label class="control-label">编号:</label>
															      <div class="controls" style="margin-left:-40px;">
															          <input type="hidden" name="room_number" id="room_number" class="span4 select2" style="width:230px" value="<?php echo $model->property_id?>" accept="text/html"
																					title="<?php
																								$item=CmsProperty::model()->find("id='$model->property_id'");
																								if($item){
																									echo $item->house_no;
																								}
																					?>"
																				><span style="color:red">*</span>
															          <input type="hidden" name="property_id[]" id="property_id">
															      </div>
															  </div>
															  <div class="control-group" style="margin-top:-30px">
															    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
															    <div class="controls control" style="margin-left:223px">
															      <label>类型：<select name='repair_type' id='repair' disabled="disabled" required>
																					<?php
																								$type = SerAfterSales::model()->arr1();
																						  	foreach ($type['repair_type'] as $key => $value) {
																						?>
																							<option value="<?php echo $key?>" <?php echo $model->repair_type == $key?"selected":''?> ><?php echo $value ?></option>
																					<?php
																						}?>
																		</select>
															    </div>
															  </div>
															  <div class="control-group" style="margin-top:-30px;">
															    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
															    <div class="controls control" style="margin-left:195px">
															      <label>报修隐患：<textarea  name='hidden' style="height:50px;width:200px" required><?php echo $model->hidden?></textarea><span style="color:red">*</span></label>
															    </div>
															  </div>

															  <div class="control-group" style="margin-top:-30px;">
															    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
															    <div class="controls control" style="margin-left:195px">
															      <label>隐患详情：<textarea name="hidden_infor" style="height:80px;width:400px"><?php echo $model->hidden_infor?></textarea>
															    </div>
															  </div>
																<div class="control-group" style="margin-left:135px;margin-top:-30px">
																	<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
																	<div class="controls control">
																		<span style="font-size:15px">费用承担方：</span>
																			<label class="checkbox" style="inline-block">
																					<input type="checkbox" name="bear_type[]" value="1" <?php
																											$bear_type	= $model->bear_type;
																											$bear_type = explode(',',$model->bear_type);
																											if($bear_type) {
																												foreach($bear_type as $key=>$value) {
																																	if($value==1) {
																																			echo 'checked';
																																	}else{
																																			echo '';
																																	}
																												}
																											}

																					?>  />
																					车主
																			</label>
																			<label class="checkbox">
																					<input type="checkbox" name="bear_type[]" value="2"
																					<?php
																								$bear_type	= $model->bear_type;
																								$bear_type = explode(',',$model->bear_type);
																								if($bear_type) {
																									foreach($bear_type as $key=>$value) {
																														if($value==2) {
																																echo 'checked';
																														}else{
																																echo '';
																														}
																									}
																								}
																					?>
																					  />
																					幼狮
																			</label>
																			<label class="checkbox">
																					<input type="checkbox" name="bear_type[]" value="3"  <
																					<?php
																								$bear_type	= $model->bear_type;
																								$bear_type = explode(',',$model->bear_type);
																								if($bear_type) {
																									foreach($bear_type as $key=>$value) {
																														if($value==3) {
																																echo 'checked';
																														}else{
																																echo '';
																														}
																									}
																								}
																					?>
																					/>
																					前租户
																			</label>
																			<label class="checkbox">
																					<input type="checkbox" name="bear_type[]" value="4"
																					<?php
																								$bear_type	= $model->bear_type;
																								$bear_type = explode(',',$model->bear_type);
																								if($bear_type) {
																									foreach($bear_type as $key=>$value) {
																														if($value==4) {
																																echo 'checked';
																														}else{
																																echo '';
																														}
																									}
																								}
																					?>
																					/>
																					租户
																			</label>
																	</div>
																</div>
																<div class="control-group" style="margin-left:165px;margin-top:-30px">
																	<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
																	<div class="controls control">
																		<span style="font-size:15px">维修方：</span>
																			<label class="radio" style="inline-block">
																					<input type="radio" name="service_type" value="1" <?php echo $model->service_type==1?'checked':''?>  />
																					车主
																			</label>
																			<label class="radio">
																					<input type="radio" name="service_type" value="2"  <?php echo $model->service_type==2?'checked':''?>  />
																					幼狮
																			</label>
																			<label class="radio">
																					<input type="radio" name="service_type" value="3"  <?php echo  $model->service_type==3?'checked':''?>  />
																					租户
																			</label>
																	</div>
																</div>
																<?php if($model->repair_type==1 || $model->repair_type==2){ ?>
																	<div class="control-group" style="margin-top:-30px">
																		<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
																		<div class="controls control">
																			<label>与车主/租户约定维修期限：<input type="text" name='hope_time' id="datepicker" value="<?php echo $model->hope_end_time?date("Y-m-d",$model->hope_end_time):''?>" ></label>
																		</div>
																	</div>
																	<script type="text/javascript">
																	var picker = new Pikaday({
																			field: document.getElementById('datepicker'),
																			firstDay: 1,
																			minDate: new Date('2010-01-01'),
																			maxDate: new Date('2030-12-31'),
																			yearRange: [2000,2030]
																	});

																	</script>
																<?php }?>

																<?php if($model->repair_type==1 || $model->repair_type==2 || $model->repair_type==6 || $model->repair_type==7 || $model->repair_type==8){
																?>
																<div class="control-group">
																	<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
																	<div class="controls control" style="margin-top:-30px">
																		<label>实际维修结束日期：<input type="text" value="<?php echo $model->real_end_time?date("Y-m-d",$model->real_end_time):''?>" name="end_time" id="datepicker1" ></label>
																	</div>
																</div>
																<script type="text/javascript">

																		 var picker = new Pikaday({

																				 field: document.getElementById('datepicker1'),
																				 firstDay: 1,
																				 minDate: new Date('2010-01-01'),
																				 maxDate: new Date('2030-12-31'),
																				 yearRange: [2000,2030]
																		 });

																 </script>
																<?php }?>
																	<br><br>
															   <div class="control-group" style="clear:both;margin-bottom:30px;margin-top:-60px;margin-left:145px;clear:both">
															     <label class="control-label" style="margin-left:-20px;width:100px;"></label>
																	<span class="test line21" style="font-size:18px;">
																	 <b>隐患图片:</b>
																	</span>
																</div>
																	<!-- <span class="test line21">
																		<button class="btn red" type="button" style="margin-top:-7px;" id="button1">
												预览</button>
																	</span> -->

													       <!-- 上传隐患图片开始 -->
													                 <div class="control-group" style="margin-left:200px">
													                     <div class="controls">
													                         <span>
													                             <input type="hidden" name="hidden_photo" value="<?php echo$invoice['url']; ?>"/>
													                             <span id="PlaceHolder_hidden_photo"></span>
													                         </span>
													                         <span>
													                      <input type="button" class="btn red" value="编辑图片" style="margin-top:-20px;height:30px!important;">
													                 </span>
													                     </div>
													                 </div>
													                 <div class="control-group" style="margin-left:200px">
													                     <div class="controls">
													                         <div class="upload_progress">
													                             <span class="localname"></span>
													                         </div>
													                         <div class="fieldset flash" id="fsUploadProgress_hidden_photo">
													                             <span class="legend"></span>
													                         </div>
													                         <div id="hidden_photo_div" style="float:left;30%;height:40px;">
													                             <img name="hidden_photo_show" src="" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/>
																											 <?php
																 											 			$invoice = SerHiddenPhoto::model()->find("after_id='$model->id'");
																 											 			$photo = explode(',',$invoice['url']);
																															unset($photo[0]);
																															foreach($photo as $key=>$val){
																																			if($val){
																																?>

																 																<img name="hidden_photo_show" src="<?php echo $val?>" alt="" style='
																													 max-width:100px;max-height:100px;float:left;margin-left:10px;<?php echo $invoice['url']?"display:block":"display:none"?>'/><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
																 												<?php		}
																													}
																 											 ?>
													                         </div>
													                     </div>
													                 </div>
													 <!-- 上传隐患图片结束 -->


															    <div class="control-group" style="clear:both;text-align:center;margin-left:300px">
															     <div class="controls control" style="margin-top:30px;text-align:center;">
																		 <span class="test line21">
		 																	<button class="btn btn-primary" type="submit" style="margin-top:-7px;" id='button2'>
		 											保存</button>
		 																</span>
																		 <?php if($model->repair_type==3 || $model->repair_type==4 || $model->repair_type==5){?>
																			 <span class="test line21">
																				<button class="btn btn-primary" type="submit" style="margin-top:-7px;" onclick="solve_one()">
														客服已解决</button>
																			</span>
																		 <?php }?>
																		 <span class="test line21">
																			 <button class="btn" type="button" style="margin-top:-7px;" onclick="history.go(-1)">
													 取消</button>
																		 </span>

															    </div>

															    </div>

                       </div>

									</form>
            <!--内容结束区域-->
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
<script type="text/javascript">
  $('#btnn').click(function(){
    document.getElementById("sales").style.display = "none";
  })
  $('#btnn1').click(function(){
    document.getElementById("follow").style.display = "none";
  })
</script>



<script>
			var val = $("#test").val();
			if(val==1){
				$("#content2").hide();
				$("#content1").show();
			}else{
				$("#content2").show();
				$("#content1").hide();
			}
			if(val==2){
					$(".del").removeAttr("required");
			}
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
<!-- 预览照片 -->
<script type="text/javascript">
		$("#button1").click(function(){
						$("#image").toggle();
		})
</script>
<!-- 客服已解决函数 -->
<script type="text/javascript">
function solve_one(){
	$("input[name=solve]").val(0);
	// var b= $("#repair").val();
	// if(b=="")
	// {
	//  alert("类型选项不能为空");
	//  return false;
	// }
	// document.forms.form_edit.action="/admin/SerAfterSales/EnterEdit";
	// document.forms.form_edit.submit();
}
</script>
<!-- 已存在的照片删除  -->

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
            $(this).parent().parent().parent().next().find('.del_photo').show();
            $('.del_photo').click(function(){
                var del_photo_url = $(this).prev().attr('src');
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
