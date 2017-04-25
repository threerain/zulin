			<style>
			  .modal-body{font-size:18px;text-indent: 20px;}
			  #modal-label{text-align:center;font-size:22px;}
			  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
				#follow{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:50%px;left:50%;top:50%;overflow:auto;border:3px solid #222;border-radius:20px;border: 1px solid #167ac7!important;}
				#follow1{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:50%px;left:50%;top:50%;overflow:auto;border:3px solid #222;border-radius:20px;border: 1px solid #167ac7!important;}
				#closemodel2{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
				#closemodel3{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
			  #left{background:#167bcd;color:#fff;margin-right:10px;}
			  #left:hover{background:#0160cb!important;}
				span{font-size:14px}
			#jqaddlink{display:none!important;}
			input{width:150px;}
			select{width:150px};
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
				  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);
			  //<!-- END PAGE LEVEL PLUGINS -->;

			  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
			  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
			  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
			  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
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
			<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
			<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
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

			            <div class="caption"><i class="icon-globe"></i>售后列表</div>
			            <div class="tools">
			<!--               <a href="javascript:;" class="collapse"></a>
			              <a href="#portlet-config" data-toggle="modal" class="config"></a>
			              <a href="javascript:;" class="reload"></a>
			              <a href="javascript:;" class="remove"></a> -->
			            </div>
			          </div>
			          <div class="portlet-body">
			            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
			              <div class="row-fluid" style="height:120px">
			                <div >
			                <form  style="margin-left:50px;margin-top:30px;" action="/admin/repair/index" >
			                  <input type="hidden" value="<?php echo $search ?>" name="search">
													<span>
												 商圈：<input type="text"  value="<?php echo $keyword_area?>"  name="keyword_area">
													</span>
													<span>
											     品牌：<input type="text" value="<?php echo $keyword_estates?>" name="keyword_estates">
													</span>
													<span>
													   系列：<input type="text"  value="<?php echo $keyword_building?>" name="keyword_building">
													</span>
													<span>
													编号：<input type="text" value="<?php echo $keyword_room_number?>" name="keyword_room_number">
			                      	<!--<button id="highsearch" class="btn red" type="button" style="height:32px;line-height:20px;" onclick="show()">
									高级 </button><input type="checkbox">-->
									<input type="checkbox" id="highsearch">高级搜索
									<button id="sample_editable_1_new" class="btn btn-primary" type="submit" >
									搜索 <i class="icon-search"></i></button>
			                      </span>
			                      <span>
			                      </button>
													</span><br><br>




			   <!--高级搜索的隐藏框-->
			  <div id="content" style="display:none;">
			                    <div class="dataTables_filter" style="margin-bottom:10px">
			                      <span>
			                    报修时间：<input type="text"  value="<?php echo $keyword_ctime?>" id="datepicker"  name="keyword_ctime">至<input type="text"  id="datepicker1"  value="<?php echo $keyword_ctime1?>"  name="keyword_ctime1">
			                      </span>
			                      <span>
			  									 制单人：<input type="text"  id='criter' value="<?php echo $keyword_criter?>"  name="keyword_criter">
													</span>

			                      <span>
			  										 报修人(租户)：<input type="text" id='name' value="<?php echo $keyword_name?>"  name="keyword_name">
			  										</span>
			                      <span>
			  									报修人(幼狮)：<input type="text"  id='urs_user' value="<?php echo $keyword_urs_user?>"  name="keyword_urs_user">
			                    </span><br><br>
			                    <span class="test line21">维修类型：
			                      <select name="keyword_repair_type" id="repair_type">
			                              <option>请选择</option>
			                        <?php
			                              $type = Seraftersales::model()->arr1();
			                              foreach ($type['repair_type'] as $key => $value) {
			                          ?>
			                            <option value="<?php echo $key?>" <?php echo $keyword_repair_type==$key?"selected":''?> ><?php echo $value ?></option>
			                        <?php
			                          }?>
			                      </select>
			                   </span>
			                      <span class="test line21">状态：
			                        <select name="keyword_evolve_type" id="evolve_type">
			                                <option>请选择</option>
			                          <?php
			                                $type = Seraftersales::model()->arr1();
			                                foreach ($type['evolve_type'] as $key => $value) {
			                            ?>
			                              <option value="<?php echo $key?>" <?php echo $keyword_evolve_type==$key?"selected":''?> ><?php echo $value ?></option>
			                          <?php
			                            }?>
			                        </select>
			                     </span>
			                   </div>
			  </div>
			                </form>
											<div class="btn-group pull-right"> </div>
			                <!-- 高级搜索隐藏 -->
			                <script type="text/javascript">
			                    var bb = $("input[name=search]").val();
			                     if(bb == 2){
			                        $("#content").css("display","block")
			                        $("#highsearch").attr("checked",true)
			                     }
			                </script>
			                <!-- 高级搜索隐藏结束 -->
			                </div>
			              </div>


			              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
			                <thead>
			                  <tr class="yj-title-th">
			                    <th class="hidden-480">商圈</th>
			                    <th class="hidden-480">品牌</th>
			                    <th class="hidden-480">系列</th>
			                    <th class="hidden-480">编号</th>
			                    <th class="hidden-480">报修人</th>
			                    <th class="hidden-480">制单人</th>
			                    <th class="hidden-480">报修时间</th>
			                    <th class="hidden-480">类型</th>
			                    <th class="hidden-480">状态</th>
			                    <th class="hidden-480">操作</th>
			                  </tr>
			                </thead>
			                <tbody>
												<?php foreach($list as $key => $value){
												?>

			                    <tr class="yj-title-th">
			                      <td class="hidden-480"><?php
																$data=CmsProperty::model()->find("id='$value->property_id'");
																if($data){
																	$item=BaseArea::model()->find("id='$data->area_id'");
																if($item){
																		echo $item->name;
																}
																}

														 ?></td>
			                      <td class="hidden-480"><?php
																$data=CmsProperty::model()->find("id='$value->property_id'");
																if($data){
																	$item=BaseEstate::model()->find("id='$data->estate_id'");
																	echo $item->name;
																}

														?></td>
			                      <td class="hidden-480"><?php
																$data=CmsProperty::model()->find("id='$value->property_id'");
																if($data){
																	$item=BaseBuilding::model()->find("id='$data->building_id'");
																	echo $item->name;
																}

														?></td>
			                      <td class="hidden-480"><?php
															  $item=CmsProperty::model()->find("id='$value->property_id'");
																if($item){
																	echo $item->house_no;
																}
														?></td>
			                      <td class="hidden-480"><?php
																if($value->repair_user_type==1){
																		echo $value->name."(租户)";
																}else{
																		$user = AdminUser::model()->find("id='$value->urs_user_id'");
																			if($user){
																				echo $user->nickname."(幼狮)";

																			}
																}
														?></td>
			                      <td class="hidden-480"><?php
			  													$user = AdminUser::model()->find("id='$value->criter_id'");
																	echo $user->nickname;
														?></td>
			                      <td class="hidden-480"><?php
																echo date('Y-m-d H:i:s',$value->ctime);
														?></td>
			                      <td class="hidden-480"><?php
																	if($value->repair_type==1){
																						echo '收房隐患';
																	}else if($value->repair_type==2){
																						echo '交房隐患';
																	}else if($value->repair_type==3){
																						echo '咨询开发票';
																	}else if($value->repair_type==4){
																						echo '注册迁址';
																	}else if($value->repair_type==5){
																						echo '投诉';
																	}else if($value->repair_type==6){
																						echo '维修';
																	}else if($value->repair_type==7) {
																		       echo '租户意向装修';
																	}else if($value->repair_type==8) {
																					 echo '装修二次升级';
																	}
														?></td>
														<td class="hidden-480"><?php
																	if($value->evolve_type==1){
																						echo '质管未接单';
																	}else if($value->evolve_type==2){
																						echo '质管已接单';
																	}else if($value->evolve_type==3){
																						echo '已联系维修方';
																	}else if($value->evolve_type==4){
																						echo '已完工';
																	}
														?></td>
			                      <td>
															<div class="btn-operation">
			                          <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
			                            操作
			                            <span class="caret"></span>
			                          </a>
			                          <ul class="dropdown-menu" style="left:-20px; width:130px !important;">
																<a href="/admin/repair/details/id/<?php echo $value->id?>"  style="display:block">详情</a>

															<?php if($value->evolve_type == 1 && AdminPositionModul::has_modul("801_02")) {?>
																<a href="/admin/repair/lookorder/id/<?php echo $value->id?>"  >接单</a>
																<?php $follow = QualityProject::model()->find("after_id='$value->id'");
																		if($follow && AdminPositionModul::has_modul("801_07")) {?>
																			<a href="/admin/repair/edit/id/<?php echo $value->id?>" style="display:block">编辑</a>
																<?php		}
																?>
														<?php	}?>
			                      <?php if($value->evolve_type == 2 && $value->repair_type !=8 && $value->repair_type !=7) {?>
																<?php if(AdminPositionModul::has_modul("801_03")) {?>
																	<a href="javascript:void(0)" class="fow getafter" style="display:block"  after="<?php echo $value->id?>">添加工程基本信息</a>
															<?php	}?>


														<?php }?>
														<?php if($value->evolve_type == 3) {
																$follow = ProjectFollow::model()->findAll("after_id='$value->id'");

															 if($follow){
																 			$a = count($follow);
																			if($follow[$a-1]['project_type'] != 2) {

															?>
															<a href="javascript:void(0)" class='decoration'address="/admin/repair/critedecoration/id/<?php echo $value->id?>" after="<?php echo $value->id?>" style="display:block">填写维修跟进</a>
														<?php
																}
																}else if($follow == null) { ?>
																<a href="javascript:void(0)" class='decoration'address="/admin/repair/critedecoration/id/<?php echo $value->id?>" after="<?php echo $value->id?>" style="display:block">填写维修跟进</a>
														<?php	}
																?>
																<?php if(AdminPositionModul::has_modul("801_05")) {?>
																	<a href="/admin/repair/lookfollow/id/<?php echo $value->id?>"  style="display:block">查看维修跟进</a>
																<?php }?>
															<?php if(AdminPositionModul::has_modul("801_07")) {?>
																<a href="/admin/repair/edit/id/<?php echo $value->id?>" style="display:block">编辑</a>
															<?php }?>
														<?php }?>
														<?php if($value->evolve_type == 4) {?>
															<?php if(AdminPositionModul::has_modul("801_05")) {?>
																<a href="/admin/repair/lookfollow/id/<?php echo $value->id?>"  style="display:block">查看维修跟进</a>
															<?php }?>
														<?php }?>
														<?php if($value->evolve_type == 2 && $value->repair_type == 8 ) {?>

														<?php }?>
														<?php if(AdminPositionModul::has_modul("801_06")) {?>
															<a data-toggle="modal" data-target="#about-modal" href="" address="/admin/repair/delete/id/<?php echo $value->id;?>" style='display:block;' class='delete'>删除</a>
													 <?php	}?>
												 </ul>
											 </div>
			                    </tr>
													<div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label"
													         aria-hidden="true">
													        <div class="modal-dialog">
													            <div class="modal-content">
													                <div class="modal-header">
													                    <h4 class="modal-title" id="modal-label">本站点提示...</h4>
													                </div>
													                <div class="modal-body">
													                    <p>确定要删除吗?</p>
													                </div>
													                <div class="modal-footer">
													                     <a id="left" class="btn btn-primary add" href="" onclick="javascript:return true;">确定</a>
													                     <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
													                </div>
													            </div>
													        </div>
													    </div>
													<?php }?>

			                </tbody>
			              </table>
										<!-- <div class="modal fade" id="about-modal2" tabindex="-1" role="dialog" aria-labelledby="modal-label"
														 aria-hidden="true">
														<div class="modal-dialog">
																<div class="modal-content">
																		<div class="modal-header">
																				<h4 class="modal-title" id="modal-label">本站点提示...</h4>
																		</div>
																		<div class="modal-body">
																				<p>确定要接单吗?</p>
																		</div>
																		<div class="modal-footer">
																				 <a id="left" class="btn btn-primary getord" href="" onclick="javascript:return true;">确定</a>
																				 <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
																		</div>
																</div>
														</div>
												</div> -->
			              <div class="row-fluid">
			                <div class="span4">
			                  <div class="dataTables_info" id="sample_1_info"></div>
			                </div>
			                <div class="span8">
			                  <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">
			                    <?php
			                    // $ps = Yii::app()->params['pageSetting'];
			                    $this->widget('NewLinkPager', array(
			                      'pages' => $pages,
			                      ));
			                      ?>
			                  </div>
			                </div>
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

			<div id="follow1"  style="background-color:#fff;border:1px solid gray;display:none;z-index:1;position:fixed;width:60%;;top:10%;left:30%;overflow:auto;height:60% ">
				<div style="height:50px;background:#167AC7;margin-bottom:30px; "  class="portlet-title">
						<div class="caption" style="line-height:50px;font-size:20px;text-indent:30px;color:#fff">添加维修跟进</div>
					</div>
					<div class="control-group" style="margin-top:0px!important" id="closemodel3">
							 ×
						</div>
						<script>
						$(function(){
							$("#closemodel3").click(function(){
								$("#follow1").hide();
							});
						})
						</script>
			<form action="/admin/repair/Createfollow"  id="form_add"  method="post"  class="form-horizontal js-submit">
						<input type="hidden" name="after_id1" value="">
						<div class="control-group">
							<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
							<div class="controls control">
								<label>跟进人：<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:'' ?></label>
							</div>
						</div>
						<div class="control-group">
							<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
							<div class="controls control">
								<label>维修进度：
											<select class="boy" name="project_type" id="test">
													<option value='1' >进行中</option>
														<option value='2'>已完工</option>
											</select>
								 </label>
							</div>
						</div>
						<div class="control-group">
							<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
							<div class="controls control">
								<label>维修详情：<textarea name="project_infor1" style="height:100px; width:400px" required></textarea><span style="color:red">*</span>
							</div>
						</div>
						<div id="content1" style="clear:both;display:none">
							<div class="control-group">
								<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
								<div class="controls control" style="margin-left:60px">
									<label>实际完工时间：<input type="text" name='end_time' id="end_time"></label>
								</div>
							</div>
							<script type="text/javascript">
									var picker = new Pikaday({
											field: document.getElementById('end_time'),
											firstDay: 1,
											minDate: new Date('2010-01-01'),
											maxDate: new Date('2030-12-31'),
											yearRange: [2000,2030]
									});
							</script>
							<div class="control-group">
								<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
								<div class="controls control" style="margin-left:90px">
									<label>实际花费：<input type="text" name='real_cost' onblur="check(this.value,this)" placeholder="请输入数字(最多保留两位小数)">元</label>
								</div>
							</div>
							<div class="control-group" style="margin-left:-8px">
								<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
								<div class="controls control">
									<label>与预计花费的差额：<input type="text" name='spread' onblur="check(this.value,this)" placeholder="请输入数字(最多保留两位小数)">元</label>
								</div>
							</div>
							<div class="control-group">
							<div class="controls control">
								<label>差额原因：<textarea name="spread_reason" ></textarea>
							</div>
						</div>
						<div class="control-group">
							<div class="controls control" style="margin-left:60px" >
							实际费用承担方：
								<label class="radio">车主<input type="radio" name="bear_type" value="1"> </label>
								<label class="radio">幼狮<input type="radio" name="bear_type" value="2"> </label>
								<label class="radio">租户<input type="radio" name="bear_type" value="3"> </label>
								<label class="radio">前租户<input type="radio" name="bear_type" value="4"> </label>


							</div>
						</div>
						<div class="control-group">
							<div class="controls control" style="margin-left:120px">
								<label>原因：<textarea name="reason" ></textarea>
							</div>
						</div>
					</div>
					<div class="control-group" style="clear:both;">
					 <div class="controls control" style="margin-top:30px;">

														<button id="sample_editable_2" class="btn btn-primary" type="submit">
														提交
														</button>
														 <button id="quxiao1" class="btn "  type="button">
														取消
														</button>

					</div>
				</div>
					</div>
				</form>
			</div>

			<div id="follow"  style="background-color:#fff;border:1px solid gray;display:none;z-index:1;position:fixed;width:50%;;top:20%;left:30%;overflow:auto;height:60% ">
				<div style="height:50px;background:#167AC7;margin-bottom:30px; "  class="portlet-title">
						<div class="caption" style="line-height:50px;font-size:20px;text-indent:30px;color:#fff">添加工程信息</div>
					</div>
					<div class="control-group" style="margin-top:0px!important" id="closemodel2">
							 ×
						</div>
						<script>
						$(function(){
						  $("#closemodel2").click(function(){
						    $("#follow").hide();
						  });
						})
						</script>
			<form action="/admin/repair/CreateOrder"  id="form_add"  method="post"  class="form-horizontal js-submit">
						<input type="hidden" name="after_id" value="">

			    <style>
			        .control{float:left;}
			    </style>
					<div class="control-group" >
				    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
				    <div class="controls control" >
				      <label>工程维修人：<input type="text" name='name' required><span style="color:red">*</span></label>
				    </div>
				  </div>
					<div class="control-group" style="margin-left:35px;margin-top:-30px">
					    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
					    <div class="controls control">
					      <label>工程维修电话：<input type="text" name='phone' maxlength='11' onblur="check_phone(this.value,this);" PlaceHolder="请输入11位的手机号" required><span style="color:red">*</span></label>
					    </div>
					  </div>
						<div class="control-group" style="margin-left:35px;margin-top:-30px">
								<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
								<div class="controls control">
									<label>工程维修隶属：<input type="text" name='subjection' required><span style="color:red">*</span></label>
								</div>
							</div>
							<div class="control-group" style="margin-left:35px;margin-top:-30px">
									<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
								  <div class="controls control">
										<label>工程内部报价：<input type="text" name='project_cost' placeholder="请输入数字(最多保留两位小数)" onblur="check(this.value,this);" required>元<span style="color:red">*</span></label>
									</div>
							</div>

			  <div class="control-group" style="margin-top:-30px">
			    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
			    <div class="controls control">
			      <label>实际维修项：<textarea name="real_option" maxlength="255"></textarea>
			    </div>
			  </div>
				<div class="control-group" style="margin-left:155px;margin-top:-20px">
					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
						<label>维修详情：<textarea name="option_infor" maxlength="255"></textarea>
				</div>
				<div class="control-group" style="margin-top:-30px">
					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
					<div class="controls control">
						<label>质量保修期：<input type="text" name='mass_time' id="mass_time" required >&nbsp至&nbsp;<input type="text" name='mass_time1' id="mass_time1" required><span style="color:red">*</span></lable>
					</div>
				</div>
				<div class="control-group" style="margin-left:130px;margin-top:-20px">
					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
						<label>开始维修时间：<input type="text" name='start_time' id="start_time" required><span style="color:red">*</span></lable>
				</div>
				<div class="control-group" style="margin-left:115px;margin-top:-20px">
					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

						<label>施工预估完成日：<input type="text" name='hope_end_time' id="hope_end_time"  required ><span style="color:red">*</span></lable>

				</div>
				<!-- 引入时间插件 -->
				<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
				<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
				<script type="text/javascript">
						var picker = new Pikaday({
								field: document.getElementById('mass_time'),
								firstDay: 1,
								minDate: new Date('2010-01-01'),
								maxDate: new Date('2030-12-31'),
								yearRange: [2000,2030]
						});
						var picker = new Pikaday({
								field: document.getElementById('mass_time1'),
								firstDay: 1,
								minDate: new Date('2010-01-01'),
								maxDate: new Date('2030-12-31'),
								yearRange: [2000,2030]
						});
						var picker = new Pikaday({
								field: document.getElementById('start_time'),
								firstDay: 1,
								minDate: new Date('2010-01-01'),
								maxDate: new Date('2030-12-31'),
								yearRange: [2000,2030]
						});
						var picker = new Pikaday({
								field: document.getElementById('hope_end_time'),
								firstDay: 1,
								minDate: new Date('2010-01-01'),
								maxDate: new Date('2030-12-31'),
								yearRange: [2000,2030]
						});

				</script>
			    <div class="control-group" style="clear:both;">
			     <div class="controls control" style="margin-top:10px;">

			                      <button id="sample_editable_2" class="btn btn-primary" type="submit">
			                      提交
			                      </button>
			                       <button id="quxiao" class="btn "  type="button">
			                      取消
			                      </button>

			    </div>
			  </div>
			    </div>
			  </form>
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


			<!-- 新增保修单 -->
			<script language="javascript" type="text/javascript">
			  //选中元素
			  $('.fow').click(function(){
					$("#follow").toggle();
					var after_id = $(this).attr('after');
					$("input[name=after_id]").val(after_id);

			  });
				$("#quxiao").click(function() {
					$("#follow").css('display','none');
				})
				$('.decoration').click(function(){
					$("#follow1").toggle();
					var after_id = $(this).attr('after');
					$("input[name=after_id1]").val(after_id);
				});
				$("#quxiao1").click(function() {
					$("#follow1").css('display','none');
				})

				$("#test").change(function() {
					if($(this).val() == 1) {
							$("#content1").hide();
					}
					if($(this).val()==2) {
							$("#content1").show();
					}
				})

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
			$(".getorder").click(function(){
					var id =	$(this).attr('address');
					$(".getord").attr('href',id);
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
			 /*拖动面板效果*/
			 $(function(){
				 $("#follow").draggable();
			   $("#follow1").draggable();
			   $("#sales").draggable();
			     })

			 </script>
