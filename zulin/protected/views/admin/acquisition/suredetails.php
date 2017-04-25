<style>
	.control-group{margin-top:30px;}
	span {text-align:right !important width:50px; height:50px}
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

                                <div class="caption">收购佣金详情<i class="icon-reorder"></i></div>

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
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div><br><br>
																	 <div  style="margin-bottom:10px;margin-left:150px">
																			<span class="test line21" style="font-size:15px"><b>合同:</b>
																				 	 <?php echo $id; ?>
																			</span>
																	 </div>
																	 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:150px">
																			<span class="test line21" style="font-size:15px"><b>品牌:</b>
																					 <?php echo $property[0]['estate_name'] ?>
																			</span>
																	 </div>
																	 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:150px">
																			<span class="test line21" style="font-size:15px"><b>系列:</b>
																					 <?php echo $property[0]['building_name'] ?>
																			</span>
																	 </div>


                                   <?php foreach($property as $key => $value):?>
																		 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:135px">
																				<span class="test line21" style="font-size:15px"><b>编号:</b>
																						 <?php echo $value['house_no']?>
																				</span>
																		 </div>

                                 <?php endforeach ?>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:90px">
																		<span class="test line21" style="font-size:15px"><b>合同签订日期:</b>
																				 <?php echo date("Y-m-d",$list->signing_date); ?>
																		</span>
																 </div>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:105px">
																		<span class="test line21" style="font-size:15px"><b>合同月租金:</b>
																			<?php

																				$purchase=CmsPurchaseContract::model()->find("id='$id' ");
																				if($purchase){
																					$data=CmsPurchasePayRule::model()->find("contract_id='$purchase->id' order by the_order  ");
																					echo $data?$data->monthly_rent/100:"";
																				}
																			?>
																		</span>
																 </div>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:105px">
																		<span class="test line21" style="font-size:15px"><b>实际月租金:</b>
																			<?php

																			$purchase=CmsPurchaseContract::model()->find("id='$id' ");
																			if($purchase){
																				$data=CmsPurchasePayRule::model()->find("contract_id='$purchase->id' order by the_order  ");
																				echo $model?$model->acq_monthly_rent/100:$data['monthly_rent']/100;
																			}
																		?>
																		</span>
																 </div>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:90px">
																		<span class="test line21" style="font-size:15px"><b>合同标注佣金:</b>
																				<?php echo $list?$list->commission/100:''?>
																		</span>
																 </div>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:60px">
																		<span class="test line21" style="font-size:15px"><b>车主实际支付佣金:</b>
																				<?php echo $model?$model->acq_real_commission/100:$list->commission/100?>
																		</span>
																 </div>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:60px">
																		<span class="test line21" style="font-size:15px"><b>&nbsp;&nbsp;实际结款金额:</b>
																			<?php


																			 if($model['acq_fan']){
																					if($model['acq_real_commission']) {
																						$a = ($model['acq_real_commission']/100-$model['acq_fan']/100);
																						echo  number_format($a-$model['acq_other']/100,2);

																					}else {
																						$a = $list->commission/100-$model['acq_fan']/100;

																						echo number_format( $a-$model['acq_other']/100,2);
																					}

																			 }else{
																						if($model['acq_real_commission']) {
																							$pay = CmsPurchasePayRule::model()->findAll("contract_id = '$list->id' order by the_order ");
																							$a = $model['acq_real_commission']/100-$pay[0]->monthly_rent/100*0.6;
																							echo number_format( $a-$model['acq_other']/100,2);


																						}else {
																							$pay = CmsPurchasePayRule::model()->findAll("contract_id = '$list->id' order by the_order ");
																							$a = $list->commission/100-$pay[0]->monthly_rent/100*0.6;

																							echo number_format( $a-$model['acq_other']/100,2);



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
																		?>
																		</span>
																 </div>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:120px">
																		<span class="test line21" style="font-size:15px"><b>渠道人员:</b>
																			<?php
																								//	$channel = CmsChannelManager::model()->find("id = '$type->acq_broker'");
																							//		echo $channel->name;
																							if($model->acq_broker!=null) {
																											$broker = explode(',',$model->acq_broker);

																											foreach($broker as $k => $v) {
																													$channel = CmsChannelManager::model()->find("id = '$v'");
																													echo $channel->name."&nbsp";
																											}
																							}
																			?>
																		</span>
																 </div>
																 <div class="dataTables_filter" style="margin-bottom:10px;margin-left:150px">
																		<span class="test line21" style="font-size:15px"><b>备注:</b>
																			<?php
																								//	$channel = CmsChannelManager::model()->find("id = '$type->acq_broker'");
																							//		echo $channel->name;
																							if($model->acq_remark!=null) {
																									echo $model->acq_remark;
																							}
																			?>
																		</span>
																 </div>
                                     <!-- <div class="control-group">

                                        <div class="controls">
                                             <p style="font-size:15px">返佣差额: <?php //echo $model?$model->acq_price/100:''?></p>

                                        </div>
                                    </div> -->
																		<div class="dataTables_filter" style="margin-bottom:10px;margin-left:150px">
																			 <span class="test line21" style="font-size:15px"><b>状态:</b>
																				 <?php

																								if($model && $model->acq_type == 4){
																										echo '已返佣';

																					 ?>
																					 <div style="height:8px"></div>
																			<div >
																				 <p style="font-size:15px;margin-left:-12px"><b>操作人</b>: <?php echo $model->acq_user?></p>
																			</div>
																			<div >
																				 <p style="font-size:15px;margin-left:-12px">返佣人: <?php echo $model->acq_broker?></p>
																			</div>
																			<div >
																				 <p style="font-size:15px;margin-left:-25px">返佣金额: <?php echo $model->acq_real_rent/100?></p>
																			</div>
																			<div >
																				 <p style="font-size:15px;margin-left:-25px">返佣银行: <?php echo $model->acq_bank?></p>
																			</div>
																			<div >
																				 <p style="font-size:15px;margin-left:-25px">返佣账户: <?php echo $model->acq_bank_num?></p>
																			</div>
																					 <?php
																								}else {
																												if($model && $model->acq_type ==5 ){
																																echo '审核未通过';
																													 ?>
																														<div >
																																 <p style="font-size:15px">原因: <?php echo $model->acq_reason?></p>
																														 </div>
																										 <?php
																												}else{
																														if($model && $model->acq_type == 3){
																																echo '已确认';
																												?>
																														 <div class="controls">
																																 <p style="font-size:15px;margin-left:-12px">确认人: <?php echo $model->acq_user?></p>
																														 </div>
																											 <?php
																														}else {

																										 echo '未返佣';

																								}
																						}
																				}
																				 ?>
																			 </span>
																		</div>
                                </div>

                                    <div class="form-actions">
                                        <?php
                                                if($model && $model->acq_type ==5 ){
                                                    ?>
                                                   <a href="/admin/acquisition/edit/id/<?php echo $model->contract_id;?>" ><button type="button" class="btn btn-primary"  >更正</button></a>
                                         <?php
                                                }

                                        ?>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">返回</button>
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
    .theFont{font-size: 15px;}

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
