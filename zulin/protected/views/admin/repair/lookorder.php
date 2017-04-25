<style>
	.controls span{width:100px;float:left;text-align:right;margin-right:50px;}
</style>
<style>
	.dataTables_filter{padding-left:100px;margin-top:25px!important;}
	div>b{font-size:18px;margin-left:30px;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



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
                                <div  class="form-horizontal js-submit">

                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <!--内容开始-->
                     <div class="dataTables_filter" style="margin-bottom:10px;margin-left:95px">
                      <span class="test line21"><b>制单人:</b>
												<?php
															$user = AdminUser::model()->find("id='$model->criter_id'");
															echo $user->nickname;
												?>
                      </span>
                       </div>
											 <?php if($model->repair_user_type==1){
												 ?>
												 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
														<span class="test line21"><b>报修租户:</b>
																<?php

																				echo $model->name;
																?>
														</span>
												 </div>
											 <?php }else{?>
												 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
													<span class="test line21"><b>报修部门:</b>
														 <?php
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
																 ?>
													</span>
													</div>
													<div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
													 <span class="test line21"><b>报修人员:</b>
															 <?php
																			 $user = AdminUser::model()->find("id='$model->urs_user_id'");
																			 if($user){
																				 echo $user->nickname;
																			 }
																	 ?>
													 </span>
													</div>
												<?php } ?>
                       <div class="dataTables_filter" style="margin-bottom:10px;margin-left:105px">
                      <span class="test line21"><b>电话:</b>
													<?php
															echo $model->phone;
													?>
                      </span>
                       </div>

                      <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
                      <span class="test line21"><b>报修品牌:</b>
													<?php
														$data=CmsProperty::model()->find("id='$model->property_id'");
														$item=BaseEstate::model()->find("id='$data->estate_id'");
														echo $item->name;
													?>
                      </span>
                       </div>

                       <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
                      <span class="test line21"><b>报修系列:</b>
													<?php
															$data=CmsProperty::model()->find("id='$model->property_id'");
															$item=BaseBuilding::model()->find("id='$data->building_id'");
															echo $item->name;
													?>
                      </span>
                       </div>

                       <div class="dataTables_filter" style="margin-bottom:10px;margin-left:93px">
                      <span class="test line21"><b>编号:</b>
												<?php
														$item=CmsProperty::model()->find("id='$model->property_id'");
														echo $item->house_no;
												?>
                      </span>
                       </div>

                         <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
                      <span class="test line21"><b>报修隐患:</b>
													<?php
																echo $model->hidden;
													?>
                      </span>
                       </div>


                        <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
                      <span class="test line21"><b>隐患详情:</b>
													<?php
														echo $model->hidden_infor;
													?>
                      </span>
                       </div>


											 <?php if($model->repair_type==1 || $model->repair_type==2){?>

																								 <div class="dataTables_filter" style="margin-bottom:10px">
																							 <span class="test line21"><b>车主约定维修结束日期:</b>
																								 <?php
																									  if($model->hope_end_time!=null) {
																															echo date('Y-m-d',$model->hope_end_time);
																										}
																								 ?>
																							 </span>
																								</div>

											 <?php } ?>


	                      <div class="dataTables_filter" style="margin-bottom:10px;margin-left:90px">
	                       <span class="test line21"><b>维修方:</b>
	 												<?php
	 														 if($model->service_type ==1){
	 															 			echo '车主';
	 														 }else if($model->service_type ==2){
	 															 			echo '幼狮';
	 														 }else if($model->service_type ==3){
	 															 			echo '租户';
	 														 }else {
																 			echo '幼狮';
															 }

	 												?>
	                       </span>
	                      </div>
                       <div class="dataTables_filter" style="margin-bottom:10px;margin-left:66px">
                      <span class="test line21"><b>费用承担方:</b>
												<?php
														$bear_type	= $model->bear_type;
														$bear_type = explode(',',$model->bear_type);
														if($bear_type!=null) {
																foreach($bear_type as $key=>$value) {
																				if($value == 1){
																							 echo '车主'.'&nbsp';
																				}else if($value == 2){
																							 echo '幼狮'.'&nbsp';
																				}else if($value == 3){
																							 echo '前租户'.'&nbsp';
																				}else if($value == 4){
																							 echo '租户'.'&nbsp';
																				}
																			}
														}

												?>
                      </span>
                       </div>
                           <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
											         <span class="test line21"><b>进展状态:</b>
											 								<?php
											 										if($model->evolve_type==1){
											 												echo '未接单';
											 											}else if($model->evolve_type==2){
											 												echo '已接单';
											 											}else if($model->evolve_type==3){
											 												echo '已联系维修';
											 											}else if($model->evolve_type==4){
											 												echo '已完工';
											 											}else if($model->evolve_type==5){
											 												echo '车主维修';
											 											}else if($model->evolve_type==6){
											 												echo '已解决';
											 											}else if($model->evolve_type==7){
											 												echo '未解决';
											 												}
											 								?>
											         </span>
											      </div>

                         <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">
                      <span class="test line21">
                       <b>隐患图片:</b>
                      </span>
                      <span class="test line21">
                        <button class="btn red" type="button" style="margin-top:-7px;" id="button1">
						预览</button>
                      </span>
                       </div>
											 <!-- 隐患图片 -->
											 <div class="control-group" style="display:none;" id='image'>
											 <?php
											 			$invoice = SerHiddenPhoto::model()->find("after_id='$model->id'");
											 			$photo = explode(',',$invoice['url']);
														unset($photo[0]);
														foreach($photo as $key=>$val){?>
																		<div class="controls">
																			<img src="<?php echo $val?>" alt="" style="width:500px;height:500px;"/><a href="/admin/SerAfterSales/download?id=<?php echo $val?>"  style='max-width:100px;max-height:100px;background:#d84a38;color:#fff;float:left;margin-left:10px'>下载</a>
																		</div>
												<?php		}
											 ?>
										 </div>

										 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:80px">


                        <form class="" action="/admin/repair/getorder/id/<?php echo $id?>" >
                          <button class="btn btn-primary" type="submit" style="margin-top:-7px;">
              确认接单</button>
                        <button class="btn" type="button" style="margin-top:-7px;" onclick="history.go(-1)">
            返回</button>
                        </form>

                       </div>
                            </div>



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
<!-- 预览照片 -->
<script type="text/javascript">
		$("#button1").click(function(){
						$("#image").toggle();
		})
</script>
