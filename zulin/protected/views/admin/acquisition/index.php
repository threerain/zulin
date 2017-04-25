<style>
	/*#page1 span{display:inline-block;width:20%;margin-left:10px;text-align:right;}*/
	span{font-size:14px}
	.dataTables_filter{margin-top:30px;}
#jqaddlink{display:none!important;}
input{width:150px;}
select{width:150px;}
</style>
<!-- BEGIN PAGE LEVEL STYLES -->
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
// Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
  App.init();
  TableManaged.init();");
?>
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

          <div class="caption"><i class="icon-globe"></i>收购佣金管理</div>
          <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a> -->
          </div>
        </div>
        <div class="portlet-body">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid" style="height:120px;">
              <div >
                <form action="/admin/acquisition/index"  >
                    <div class="dataTables_filter" style="margin-bottom:10px;margin-left:50px;" id="page1">
											<input type="hidden" value="<?php echo $search ?>" name="search">

                      <span>合同ID：<input type="text" value="<?php echo $keyword_id;?>" name="keyword_id"></span>
                      <span>品牌:<input type="text" value="<?php echo $keyword_estates;?>" name="keyword_estates"></span>
                      <span>系列：<input type="text"  value="<?php echo $keyword_building;?>" name="keyword_building"></span>
                     <span>编号：<input type="text" value="<?php echo $keyword_room_number;?>" name="keyword_room_number"></span>
											<input type="checkbox" id="highsearch">高级搜索
										 <button id="sample_editable_1_new" class="btn btn-primary" type="submit" >
										 搜索 <i class="icon-search"></i></button>
															 </span>
                    </div>

						<!--高级搜索的隐藏框-->
					 <div id="content" style="display:none;">
														 <div class="dataTables_filter" style="margin-bottom:10px">
															 <div class="dataTables_filter" style="margin-bottom:10px">
																 <span style="margin-left:60px;">状态:
																	 <select name="keyword_acq_type" id="">
												 <option value="">请选择</option>
												 <option value="1" <?php echo $keyword_acq_type==1?'selected=selected':''?>>未修改</option>
												 <option value="2" <?php echo $keyword_acq_type==2?'selected=selected':''?>>已修改，未确认</option>
												 <option value="5" <?php echo $keyword_acq_type==5?'selected=selected':''?>>审核未通过</option>
												 <option value="3" <?php echo $keyword_acq_type==3?'selected=selected':''?>>未返佣</option>
												 <option value="4" <?php echo $keyword_acq_type==4?'selected=selected':''?>>已返佣</option>
																	 </select>
																 </span>
																 <span style='margin-right:0px'>渠道人员：<input type='text' value="<?php echo $keyword_acq_broker;?>" name='keyword_acq_broker'></span>
																 <span style="margin-left:-0px;">合同日期：<input type="text" id="datepicker" value="<?php echo $keyword_signing_date1;?>" name="keyword_signing_date1" />&nbsp至&nbsp;<input type="text" id="datepicker1" value="<?php echo $keyword_signing_date2;?>" name="keyword_signing_date2" /></span>
																 <br><br>
																<span style="margin-left:20px;">佣金结算日：<input type="text" id="datepicker2" value="<?php echo $keyword_center_time;?>" name="keyword_center_time" />&nbsp至&nbsp;<input type="text" id="datepicker3" value="<?php echo $keyword_center_time1;?>" name="keyword_center_time1" /></span>
														 </div>
						</div>
                    </div>

                    <div class="dataTables_filter" style="margin-bottom:10px">
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
						var picker = new Pikaday({
								field: document.getElementById('datepicker2'),
								firstDay: 1,
								minDate: new Date('2010-01-01'),
								maxDate: new Date('2030-12-31'),
								yearRange: [2000,2030]
						});

						var picker = new Pikaday({
								field: document.getElementById('datepicker3'),
								firstDay: 1,
								minDate: new Date('2010-01-01'),
								maxDate: new Date('2030-12-31'),
								yearRange: [2000,2030]
						});


                      </script>

                </form>

            </div>
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
						<div style="height:20px"></div>
						<!-- 高级搜索隐藏结束 -->
						<b style="color:red;float:left">注：负数=幼狮支出 正数=幼狮盈利 零=持平</b>
						<b style='color:red;float:left'>&nbsp;佣金差额=车主实际支付佣金-华亮佣金 实际结款金额=佣金差额-其它金额</b>
            <table class="table table-striped table-bordered table-hover"  id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->

              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
									<th class="hidden-480">合同签订日期</th>
									<th class="hidden-480">品牌</th>
                  <th class="hidden-480">系列</th>
                  <th class="hidden-480">编号</th>

                  <th class="hidden-480">合同月租金</th>
                  <th class="hidden-480">实际月租金</th>
                  <!-- <th class="hidden-480">单价<br>(元/天/㎡)</th> -->
                  <th class="hidden-480">合同标注佣金</th>
                  <th class="hidden-480">车主实际支付佣金</th>
                  <th class="hidden-480">华亮佣金(实际月租金60%)</th>
									<th class="hidden-480">佣金差额</th>
									<th class="hidden-480">其它金额</th>
                  <th class="hidden-480">实际结款金额</th>
                  <th class="hidden-480">渠道人员</th>
									<th class="hidden-480">佣金结算日</td>
                  <th class="hidden-480">状态</th>
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
											<td class="hidden-480"><?php echo date("Y-m-d ",$model->signing_date)?></td>
                      <!--<td class="hidden-480 yj-cz"><?php //$item=BaseEstate::model()->find("id='$model->estate_id'"); echo $item?$item->name:""; ?></td>-->
                      <td class='hidden-480'>  <?php
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
                                 <td class="hidden-480">
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
                         $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->id' ");
                         if($res){
                           foreach ($res as $key => $value) {
                             $item=CmsProperty::model()->find("id='$value->property_id'");
                             echo $item?$item->house_no.'<br>':"";
                           }

                         }
                         ?>
                       </td>


                    <td class='hidden-480'>
              		<?php $pay = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order");

												echo number_format($pay[0]['monthly_rent']/100,2);

												?>
                    </td>
                    <?php  $type = CmsAcquisitionCommission::model()->find("contract_id = '$model->id'");

                    ?>
                    <td class='hidden-480'><?php
											if($type['acq_monthly_rent']) {
												echo number_format($type['acq_monthly_rent']/100,2);
											}else{
										 $pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id' order by the_order ");
										 if($pay['monthly_rent']) {
											 $a = $pay['monthly_rent']/100;
											 echo number_format($a,2);
										 }
											}


										?></td>
                    <td class='hidden-480'><?php echo $model->commission?number_format($model->commission/100,2):''?></td>
                    <td class='hidden-480'><?php
												if($type['acq_real_commission']) {
														echo $type['acq_real_commission']?number_format($type['acq_real_commission']/100,2):'';
												}else{
														echo $model->commission?number_format($model->commission/100,2):'';
												}

										 ?></td>
                    <td class='hidden-480'><?php
                    // $pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id'");


											 if($type['acq_fan']) {
												 echo 	number_format($type['acq_fan']/100,2);
											 }else{
												 	if($type['acq_monthly_rent']) {
														echo number_format($type['acq_monthly_rent']*0.6/100,2);
													}else {
														$pay = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order ");
														echo number_format($pay[0]->monthly_rent/100*0.6,2);
													}
											 }



                     ?></td>
                    <td class='hidden-480'><?php

											 if($type['acq_fan']){
												 	if($type['acq_real_commission']) {
														$a = ($type['acq_real_commission']/100-$type['acq_fan']/100);
														echo number_format($a,2);

													}else {
														$a = $model->commission/100-$type['acq_fan']/100;
														echo number_format($a,2);


													}

											 }else{
												 		if($type['acq_real_commission']) {
															$pay = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order" );
															$a = $type['acq_real_commission']/100-$pay[0]->monthly_rent/100*0.6;
															echo number_format($a,2);


														}else {
															$pay = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order");
															$a = $model->commission/100-$pay[0]->monthly_rent/100*0.6;
															echo number_format($a,2);



														}
											 }

										 ?></td>
										 <td class='hidden-480'><?php echo $type['acq_other']?number_format($type['acq_other']/100,2):number_format(0,2)?></td>
										 <td class='hidden-480'><?php

											 if($type['acq_fan']){
													if($type['acq_real_commission']) {
														$a = ($type['acq_real_commission']/100-$type['acq_fan']/100);
														echo  number_format($a-$type['acq_other']/100,2);

													}else {
														$a = $model->commission/100-$type['acq_fan']/100;

														echo number_format( $a-$type['acq_other']/100,2);
													}

											 }else{
														if($type['acq_real_commission']) {
															$pay = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order ");
															$a = $type['acq_real_commission']/100-$pay[0]->monthly_rent/100*0.6;
															echo number_format( $a-$type['acq_other']/100,2);


														}else {
															$pay = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order ");
															$a = $model->commission/100-$pay[0]->monthly_rent/100*0.6;

															echo number_format( $a-$type['acq_other']/100,2);



														}
											 }

										 ?></td>

                    <td class='hidden-480'><?php
															//	$channel = CmsChannelManager::model()->find("id = '$type->acq_broker'");
														//		echo $channel->name;
														if($type->acq_broker!=null) {
																		$broker = explode(',',$type->acq_broker);

																		foreach($broker as $k => $v) {
																				$channel = CmsChannelManager::model()->find("id = '$v'");
																				echo $channel->name."<br>";
																		}
														}
										?></td>
										<!-- 佣金结算日 -->
										<td class="hidden-480">

													<span class ="<?php echo $type->id.'1'?>" style="display:block">
														<?php echo $type['center_time']?date("Y-m-d",$type['center_time']):''?>
													</span>

                          <span class="<?php echo $type->id.'2'?>" style="display:none">
														<?php if($type->acq_type!='') {?>

															<form action="/admin/acquisition/entertime" style="margin: 0 ;" method="post">
																	<input type="hidden" name="referer" value="<?php echo $referer?>">
																	<input type="text" id="<?php echo $type->id?>" value="<?php echo $type['center_time']?date("Y-m-d",$type['center_time']):''?>" 	name="enter_time" required >
																	<input type="hidden"  value="<?php echo $type->id ?>"  name="id" required >
																	<input type="submit" value="确认">
																	<script type="text/javascript">
																				var picker = new Pikaday({
																						field: document.getElementById("<?php echo $type->id?>"),
																						firstDay: 1,
																						minDate: new Date('2010-01-01'),
																						maxDate: new Date('2030-12-31'),
																						yearRange: [2000,2030]
																				});

																	</script>
															</form>
														<?php }?>



                          </span>
										</td>
                    <td class="hidden-480"><?php  $acq_type = CmsAcquisitionCommission::model()->find("contract_id = '$model->id'");

                               if($acq_type['acq_type'] == ""){
                                    echo '未修改';
                               }
                               if($acq_type['acq_type'] == 2){
                                   echo '已修改,未确认';
                               }
                               if($acq_type['acq_type'] == 3){
                                   echo '未返佣';
                                }
                               if($acq_type['acq_type'] == 4){
                                  echo '已返佣';
                              }
                               if($acq_type['acq_type'] == 5){
                                  echo '审核未通过';
                              }
                     ?></td>
                      <td class="hidden-480">
												<div class="btn-operation">
													<a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
														操作
														<span class="caret"></span>
													</a>
													<ul class="dropdown-menu" style="left:-20px; width:100px !important;">
		                        <?php if($acq_type['acq_type'] == '' && AdminPositionModul::has_modul("502_02")) {?>
		                        <a href="/admin/acquisition/edit/id/<?php echo $model->id;?>" style="display:inline-block">修改返佣金</a><br>
		                        <?php }?>
		                         <?php if($acq_type['acq_type'] == 2 && AdminPositionModul::has_modul("502_03")) {?>
																<a href="/admin/acquisition/edit/id/<?php echo $model->id;?>" style="display:inline-block">修改返佣金</a><br>
				                        <a href="/admin/acquisition/enter/id/<?php echo $model->id;?>" style="display:inline-block">确认</a><br>
		                        <?php }?>
		                        <?php if($acq_type['acq_type'] == 3 && AdminPositionModul::has_modul("502_04")) {?>
														<a href="/admin/acquisition/edit/id/<?php echo $model->id;?>" style="display:inline-block">修改返佣金</a><br>
		                        <a href="/admin/acquisition/details/id/<?php echo $model->id;?>"  style="display:inline-block">财务返佣</a><br>
														<a href="#" class = "<?php echo $type->id;?>" address="<?php echo $type->id;?>">修改佣金结算日</a>
														<script type="text/javascript">
																	$(".<?php echo $type->id;?>").click(function(){
																			var id =  $(this).attr('address');
																			// alert($)
																			$(".<?php echo $type->id;?>1").toggle();
																			$(".<?php echo $type->id;?>2").toggle();
																	})
														</script>
		                        <?php }?>
														<a href="/admin/acquisition/suredetails/id/<?php echo $model->id;?>" style="display:inline-block">详情</a><br>
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
            <div class="row-fluid">
              <div class="span4">
                <div class="dataTables_info" id="sample_1_info"></div>
              </div>
              <div class="span8" >
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
