
<style>
#jqaddlink{display:none!important;}
	.dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
	 #follow{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-600px;border-top:3px solid #222;border-radius:20px;border-top: 1px solid #167ac7!important;}
	#closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  #closemodel1{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
	#follow1{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-600px;border-top:3px solid #222;border-radius:20px;border-top: 1px solid #167ac7!important;}
	/*a{display:inline-block!important;}*/
	input{width:150px;}
	select{width:150px;}
	table{padding:0px}
	body{
			font-size:13px!important;
	}
</style>
<!-- BEGIN PAGE LEVEL STYLES -->
<?php
// Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
// Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);
?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);

//
Yii::app()->clientScript->registerScript("","
  App.init();
  FormComponents.init();
  FormValidation.init();
  ");

 ?>

 <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
 <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
 <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
 <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
 <style>
		 .theFont{font-size: 20px;}
 </style>
<!-- End PAGE LEVEL SCRIPTS -->
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

          <div class="caption"><i class="icon-globe"></i>出车佣金管理</div>
          <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a> -->
          </div>
        </div>
        <div class="portlet-body">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
                <form action="/admin/outroom/index" style="margin:0" >
									<input type="hidden" value="<?php echo $search ?>" name="search">

                    <div class="dataTables_filter" style="margin-bottom:10px" id="">
                      <span>合同ID：<input type="text" value="<?php echo $keyword_id;?>" name="keyword_id"></span>
                      <span>&nbsp&nbsp;品牌:<input type="text" value="<?php echo $keyword_estates;?>" name="keyword_estates"></span>

                      <span>&nbsp&nbsp;系列：<input type="text"  value="<?php echo $keyword_building;?>" name="keyword_building"></span>
											<span>编号：<input type="text" value="<?php echo $keyword_room_number;?>" name="keyword_room_number"></span>
<!--											<input type="checkbox" id="highsearch">高级搜索-->
											<button id="sample_editable_1_new" class="btn btn-primary" type="submit" >
											搜索 <i class="icon-search"></i></button>
												</button>
										</span>
											<span>

                    </div><br>
               <div id="content" style="display:none;">
								&nbsp;&nbsp;&nbsp;&nbsp; <span>状态:&nbsp;
									 <select name="keyword_check_type" id="">
											 <option value="">请选择</option>
											 <option value="9" <?php echo $keyword_check_type==9?'selected=selected':''?>>未申请</option>
											 <option value="1" <?php echo $keyword_check_type==1?'selected=selected':''?>>未审核</option>
											 <option value="2" <?php echo $keyword_check_type==2?'selected=selected':''?>>审核中</option>
											 <option value="6" <?php echo $keyword_check_type==6?'selected=selected':''?>>财务未审核</option>
											 <option value="7" <?php echo $keyword_check_type==7?'selected=selected':''?>>财务审核中</option>
											 <option value="8" <?php echo $keyword_check_type==8?'selected=selected':''?>>财务通过</option>
											 <option value="5" <?php echo $keyword_check_type==5?'selected=selected':''?>>审核未通过</option>
											 <option value="10" <?php echo $keyword_check_type==10?'selected=selected':''?>>已打款</option>
									 </select>
								 </span>
							 </div>


                    <div class="dataTables_filter" style="margin-bottom:10px">
											<!-- 高级搜索隐藏 -->
											<script type="text/javascript">
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
													var bb = $("input[name=search]").val();
													 if(bb == 2){
															$("#content").css("display","block")
															$("#highsearch").attr("checked",true)
													 }
											</script>
											<!-- 高级搜索隐藏结束 -->
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


                      </script>

                </form>
							<a href="javascript:validate()" target="_blank">批量打印</a>
							<?php $id = Yii::app()->session['admin_uid'];
										$user = AdminUser::model()->find("id='$id'");
										if($user->nickname=="尹卓" || $user->nickname=="陈淑明") {?>
											<a href="javascript:validate1()" target="_blank">批量审核</a>
								<?php		}else if($user->nickname=="韩剑侠") {?>
										<a href="javascript:validate1()" target="_blank">批量确认</a>
							<?php	}
							?>
							<form class="" action="" id="myform" method="post">
									<input type="hidden" name="referer" value="<?php echo $referer?>">
            <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->

									<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th>
				  <th class="hidden-480">合同id</th>
                  <th class="hidden-480">品牌</th>
                  <th class="hidden-480">系列</th>
                  <th class="hidden-480">编号</th>
                  <!-- <th class="hidden-480">单价<br>(元/天/㎡)</th> -->
                  <th class="hidden-480">月租金</th>
                  <th class="hidden-480">出车佣金(月租金96%)</th>
                  <th class="hidden-480">实际佣金</th>
                  <th class="hidden-480">渠道公司</th>
                  <th class="hidden-480">渠道人员</th>
									<th class="hidden-480">申请人</th>
                  <!-- <th class="hidden-480">制单人</th> -->
<!--              		<th class="hidden-480">返佣状态</th>-->
                  <th >操作</th><br>
                </tr>
              </thead>
              <tbody>
                <?php
                if($list){
                  ?>
                  <?php
                  foreach($list as $model){
                    ?>
                    <tr class="odd gradeX">

												<td><input type="checkbox" class="checkboxes" name="id[]" value="<?php echo $model->id; ?>" /></td>
                      <td class="hidden-480 "><?php echo $model->id; ?></td>
                      <!--<td class="hidden-480 "><?php //$item=BaseEstate::model()->find("id='$model->estate_id'"); echo $item?$item->name:""; ?></td>-->
                     <td class='hidden-480 '>  <?php
                        $res = CmsPurchaseProperty::model()->find("contract_id='$model->id'");
                        if($res){
                          $data = CmsProperty::model()->find("id='$res->property_id'");
                          if($data){
                            $item = BaseEstate::model()->find("id='$data->estate_id'");
                            echo $item?$item->name:"";
                          }
                         }
                        ?>
                        </td>
                                <td class="hidden-480 ">
                        <?php
                            $res=CmsPurchaseProperty::model()->find("contract_id='$model->id'");
                        if($res){
                          $data=CmsProperty::model()->find("id='$res->property_id'");
                          if($data){
                            $item=BaseBuilding::model()->find("id='$data->building_id'");
                            echo $item?$item->name:"";
                          }
                         }
                        ?>
                        </td>
                                <td style="vertical-align: middle">
                        <?php
                        $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->id'");
                        if($res){
                          foreach ($res as $key => $value) {
                            $item=CmsProperty::model()->find("id='$value->property_id'");
                            echo $item?$item->house_no.'<br>':"";
                          }

                        }
                        ?>
                      </td>
                    <?php  $type = CmsOutroom::model()->find("contract_id = '$model->id'");

                    ?>
										<!-- 实际月租金 -->
										<td class="hidden-480 "><?php $pay = CmsPurchasePayRule::model()->find("contract_id='$model->id' order by the_order"); echo $pay?number_format($pay->monthly_rent/100,2):''?></td>
										<!-- 出车佣金 -->
									  <td class="hidden-480 "><?php $pay = CmsPurchasePayRule::model()->find("contract_id='$model->id' order by the_order"); echo $pay?number_format($pay->monthly_rent/100*0.96,2):''?></td>
										<!-- 实际佣金 -->
										<td class="hidden-480"></td>

									  <td class="hidden-480 "><?php
                                            $channel_id = CmsPurchaseContract::model()->find("id='$model->id'");
                                            if($channel_id){
                                                $channel = CmsChannel::model()->find("id='$channel_id->channel_id'");
                                                echo $channel?$channel['name']:'';
                                            }

                    ?></td>
                    <td class="hidden-480 "><?php
                                          $channel_manager_id = CmsPurchaseContract::model()->find("id='$model->id'");
                                          if($channel_manager_id){
                                              $channel_manager = CmsChannelManager::model()->find("id='$channel_manager_id->channel_manager_id'");
                                              echo $channel_manager?$channel_manager['name']:'';
                                          }
                    ?></td>
										<td class="hidden-480 "><?php
                              $operator_id = CmsOutroom::model()->find("contract_id = '$model->id'");
                              if($operator_id){
                                $operator = AdminUser::model()->find("id = '$operator_id->operator_id'");
                                echo $operator?$operator['nickname']:'';
                              }
                              // if($operator_id['check_type']==4){
                              //   $operator = AdminUser::model()->find("id = '$operator_id->operator_id'");
                              //   echo $operator?$operator['account']:'';
                              // }
                              // if($operator_id['check_type']==2){
                              //   $operator = AdminUser::model()->find("id = '$operator_id->check_one'");
                              //   echo $operator?$operator['account']:'';
                              // }
                              // if($operator_id['check_type']==3){
                              //   $operator = AdminUser::model()->find("id = '$operator_id->check_two'");
                              //   echo $operator?$operator['account']:'';
                              // }
                              // if($operator_id['check_type']==5){
                              //   $operator = AdminUser::model()->find("id = '$operator_id->check_two'");
                              //   echo $operator?$operator['account']:'';
                              // }
                              // if($operator_id['check_type']==6){
                              //   $operator = AdminUser::model()->find("id = '$operator_id->check_two'");
                              //   echo $operator?$operator['account']:'';
                              // }
                              ?></td>
															<!-- <td class="hidden-480"></td> -->

                      <td class="hidden-480 ">
												<div class="btn-operation">
													<a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
														操作
														<span class="caret"></span>
													</a>
													<ul class="dropdown-menu" style="left: -38px;width:140px !important;">

															<?php $check_type = CmsOutroom::model()->find("contract_id = '$model->id'");
																		if($check_type['check_type'] !=8 && $check_type['check_type'] !=10 ) {?>
																			<a href="/admin/outroom/edit/id/<?php echo $model->id;?>" style="display:inline-block!important;">

																					<?php if($check_type['check_type']==null) {
																								echo '申请返佣';
																					}else {
																									echo '编辑';
																					}

																					?>

																			</a><br>

															<?php
																	}
															?>

															<?php $check_type = CmsOutroom::model()->find("contract_id = '$model->id'");
																					if($check_type['check_type'] !=8 && $check_type['check_type'] !=10 && $check_type['check_type'] != 5 && $check_type['check_type'] != null) {
																						$id = Yii::app()->session["admin_uid"];
																						$name = AdminUser::model()->find("id='$id'");
																						if($name->nickname=="李冰"||$name->nickname=="牛腾飞"||$name->nickname=="何红梅"||$name->nickname=="黄鑫"||$name->nickname=="陈淑明"||$name->nickname=="尹卓") {?>

																				<a href="/admin/outroom/enter/id/<?php echo $model->id;?>" style="display:inline-block!important">审核</a><br>



																					<?php  }
																									 }else if($list->check_type==8) {
																											$id = Yii::app()->session["admin_uid"];
																											$name = AdminUser::model()->find("id='$id'");
																											if($name->nickname=="韩剑侠") {?>


																	<a href="/admin/outroom/enter/id/<?php echo $model->id;?>" style="display:inline-block!important">审核</a><br>



															 <?php
															}

																		}
																?>


												 			<a href="/admin/outroom/details/id/<?php echo $model->id;?>"style="display:inline-block!important">详情</a>


										</ul>
									</div>
                        </td>
                      <!-- <td ><span class="label label-success">Approved</span></td> -->
                    </tr>
                    <?php
                  }
                  ?>
                  <?php
                }
                ?>
              </tbody>
            </table>
					</form>

            <div class="row-fluid">
              <div class="span4">
                <div class="dataTables_info" id="sample_1_info"></div>
              </div>
              <div >
                <div class="dataTables_paginate paging_bootstrap pagination" style='margin:30px auto;width:99%;text-align:center;'>
                  <?php
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
</script>
<script type="text/javascript">
			function validate(){
					document.getElementById('myform').action = "/admin/outroom/newoutroom";
					document.getElementById('myform').submit();
			}
			function validate1(){
					document.getElementById('myform').action = "/admin/outroom/passmore";
					document.getElementById('myform').submit();
			}
</script>
