		<style>

			.test{width:20%;margin:1% 2%!important;}
			.test b{display:inline-block;width:6%;text-align:right;}
			.test select{margin-left:-3px;}
			.line3{width:40%;margin-left:3.5%;}
			.line4{width:40%;margin-left:7%;}
			input,select{border:1px solid #aaa!important;}
			#sample_editable_1_new{height:31px;margin-left:-5px;font-size:15px;line-height:15px;}
		  td a{margin-top:8px;}
		#footer{float:left!important;width:300px;}
		}
		<?php
		Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);

		?>
		</style>
		<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
		<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
		<div class="page-content">
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

		            <div class="caption"><i class="icon-globe"></i>跟进列表</div>

		          </div>
		          <div class="portlet-body">
		              <table class="table table-striped table-bordered table-hover" id="sample">
		                  <thead>
		                    <tr class="yj-title-th">
		                      <th class="hidden-480">跟进人</th>
		                      <th class="hidden-480">跟进日期</th>
		                      <th class="hidden-480">维修进度</th>
		                      <th class="hidden-480">维修详情</th>
		                    </tr>
		                  </thead>
		                  <tbody>
												<?php if($model) {
															foreach($model as $key=>$val) {

													?>
													<tr class="yj-title-th">
														<td class="hidden-480"><?php $item = AdminUser::model()->find("id = '$val->criter_id'"); echo  $item?$item->nickname:''?></td>
														<td class="hidden-480"> <?php echo date("Y-m-d H:i:s",$val->ctime)?> </td>
														<td class="hidden-480"> <?php
																		if($val->project_type==1) {
																				echo '进行中';
																		}else if($val->project_type==2) {
																				echo '已完工';
																		}
														 ?> </td>
														<td class="hidden-480"><?php

																		if($val->project_type ==1) {
																				echo wordwrap($val->project_infor,48,"<br>\n",TRUE);
																		}else if($val->project_type ==2) { ?>
																						维修详情:<?php echo wordwrap($val->project_infor,48,"<br>\n",TRUE).'<br>';?>
																						实际完工日期:<?php echo $val->end_time?date("Y-m-d",$val->end_time):'';
																															echo '<br>'?>
																						实际花费:<?php echo $val->real_cost?$val->real_cost/100:'';
																														echo '<br>'?>
																						与预计花费差额:<?php echo $val->spread?$val->spread/100:'';
																													echo '<br>'?>
																						差额原因:<?php echo $val->spread_reason?$val->spread_reason:'';
																													echo '<br>'?>
																						费用承担方:<?php
																									if($val->bear_type!=null) {
																												if($val->bear_type == 1) {
																														echo '车主维修'.'<br>';
																												}else if($val->bear_type == 2) {
																														echo '幼狮维修'.'<br>';
																												}else if($val->bear_type == 3) {
																														echo '租户'.'<br>';
																												}else if($val->bear_type == 4) {
																														echo '前租户'.'<br>';
																												}else {
																															echo '<br>';
																												}
																									}
																						?>
																						原因:<?php echo $val->reason?$val->reason:''?>
																	<?php	}

														?>  </td>
													</tr>
												<?php
													}
											}?>

		                  </tbody>

		              </table>
		              <div class="dataTables_filter" style="margin-bottom:10px">

		               <span class="test line21">
		                 <button class="btn" type="button" style="margin-top:-7px;" onclick="history.go(-1)">返回
		     </button>
		               </span>
		                </div>
		              <div class="row-fluid">
		                <div class="span4">
		                  <div class="dataTables_info" id="sample_1_info"></div>
		                </div>
		                <div class="span8">
		                  <div class="dataTables_paginate paging_bootstrap pagination">
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
