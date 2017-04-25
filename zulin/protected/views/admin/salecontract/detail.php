<style>
    .control-group{margin-bottom:0px !important;padding-bottom: 10px !important;}
    .controls{font-size:16px;line-height:19px;color:#555;width:170px;}
    .controlss{font-size:16px;line-height:35px;color:#555;}
    .form-horizontal .control-label{padding-top: 0px;!important;}
    .label{padding-top: 0px !important;font-size: 14px;font-weight: normal;line-height: 20px;margin-bottom: 5px}
    textarea{margin-left: 20px;margin-top: 5px}
    .yj-xg-btn{width: 95%;margin:15px auto;}
    .yj-xg-btn div {width: 24.9%;float:left;}
    .docs-pictures li {
    width:100%!important;}
</style>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
<!-- END PAGE LEVEL PLUGINS -->;
<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/picjquery/assets/js/jquery.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/picjquery/dist/viewer.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/picjquery/assets/js/main.js',CClientScript::POS_END);

?>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/css/normalize.css');
// Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/css/default.css');其存在使得文件加载异常慢，先注释掉
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/dist/viewer.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/css/main.css');
?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->;
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/cms_sale_contract.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_sale_contract.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/chosen.jquery.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/bootstrap-datepicker.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.inputmask.bundle.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
App.init();
FormValidation.init();
FormComponents.init();
");
?>

<!-- END PAGE LEVEL SCRIPTS -->;
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

                        <div class="caption"><i class="icon-reorder"></i>出车合同-详情</div>

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
	<form action="/admin/salecontract/editsave" id="form_create"  method="post"  class="form-horizontal js-submit">
        <input type="hidden" name="id" value="<?php echo $model->id ?>">
        <input type="hidden" name="referer" value="<?php echo $referer; ?>">
        <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            输入格式有误，请检查输入的数据.
        </div>
        <div class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            数据输入验证成功!
        </div>
        <div class="yj-xg-btn" style="margin:30px auto;">
            <div><a href="javascript:void(0)">品牌信息</a></div>
            <div><a href="javascript:void(0)">交易人信息</a></div>
            <div><a href="javascript:void(0)">租期信息</a></div>
            <div><a href="javascript:void(0)">签约信息</a></div>
        </div>

        <script>
        $(function(){
            $('.yj-xg-btn').children('div').click(function(){
                $('.yj-xg-btn').children('div').css('background','white');
                $('.yj-xg-btn').children('div').children('a').css('color','blue');
                $(this).css('background','#0160cb');
                $(this).children('a').css('color','white');
            })
        })
        </script>
        <div  class="yj-xg-box" style="border-width:0;margin:30px;">
    		<div class="yj-xg-xbox"  style="display:none">
    		<p style="font-size:20px;margin:40px 50px;">合同ID: <?php echo $contract_id; ?></p>
    		<input type="hidden" name="contract_id" value="<?php echo $contract_id ?>">
            <?php foreach ($property as $key => $value): ?>
             <div id="propertys">

                    <div class="control-group"  style="float:left;clear:both;">
                        <label class="control-label">品牌<span class="required">*</span></label>
                        <div class="controls">
                            <?php echo $value['estate_name']  ?>
                        </div>
                    </div>
                    <div class="control-group"  style="float:left">
                        <label class="control-label">系列<span class="required">*</span></label>
                        <div class="controls">
                            <?php echo $value['building_name']  ?>
                        </div>
                    </div>
                    <div class="control-group"  style="float:left">
                        <label class="control-label">编号<span class="required">*</span></label>
                        <div class="controls">
                            <?php echo $value['house_no'] ?>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="control-group" style="float:left;clear:both;">
                        <label class="control-label">车源类型</label>
                        <div class="controls">
                                <?php echo  $value['room_type']==1?'轿车':'' ?>
                                <?php echo  $value['room_type']==2?'客车':'' ?>
                                <?php echo  $value['room_type']==3?'SUV':'' ?>
                                <?php echo  $value['room_type']==4?'商务':'' ?>
                        </div>
                    </div>


            </div>
            <?php endforeach ?>

        </div>        
		<!-- ////////////////////////////// 以上为品牌添加 -->
      <div class="yj-xg-xbox"  style="display:none">
		<div class="xxk-lp-1">
			<div class="control-group">
				<label class="control-label">出租人<span class="required">*</span></label>
                <div class="controls">
                    <?php echo $model->lessor ?>
                </div>
			</div>
			<div class="control-group">
				<label class="control-label" style="width:70px;">承租人类型</label>
				<div class="controls">
						<?php echo $model==null?"":$model->lessee_type=="1"?"公司":""; ?>
						<?php echo $model==null?"":$model->lessee_type=="2"?"个人":""; ?>
				</div>
			</div>

                <div class="control-group inputcss " style="float:left;">
                    <label class="control-label">收款人</label>
                    <div class="controls">
                        <?php echo $model->payee?>
                    </div>
                </div>
                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">开户行</label>
                    <div class="controls">
                        <?php echo $model->bank?>
                    </div>
                </div>
                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">账号</label>
                    <div class="controls" style="width:200px;">
                       <?php preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{0,4})([\d]{0,})?/', $model->bank_account,$match);
                      unset($match[0]);
                      echo implode(' ', $match)?>
                    </div>
                </div>
                <div style="clear:both;"></div>

			<!--    公司 -->
			<div id="company" style="<?php echo $model->lessee_type==1?"":"display:none;"; ?>">
                    <div class="control-group inputcss " style="float:left;">
                        <label class="control-label">公司名称</label>
                        <div class="controls">
                          <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo  $item?$item->company_name:'' ?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">法人姓名</label>
                        <div class="controls">
                           <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo  $item?$item->corporation:'' ?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">身份证号</label>
                        <div class="controls">
                            <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo  $item?$item->corporation_id_card:'' ?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">性别</label>
                        <div class="controls">
                                <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo $item['corporation_gender']?$item['corporation_gender']=='m'?"男":'女':''?>
                        </div>
                    </div>

                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">公司类型</label>
                        <div class="controls">
                                <?php 
                                $lessee_company_types=CmsCompanyType::model()->findAll("deleted=0");
                                foreach ($lessee_company_types as $key => $value) {
                                    echo $model->lessee_company_type==$value->id?"$value->name":"";
                                } 
                                ?>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">签约人</label>
                        <div class="controls">
                           <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo  $item?$item->contractor:'' ?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">身份证号</label>
                        <div class="controls">
                           <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo  $item?$item->contractor_id_card:'' ?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">手机号</label>
                        <div class="controls">
                            <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo  $item?$item->contractor_phone:'' ?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label">性别</label>
                        <div class="controls">
                               <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo $item['corporation_gender']?$item['corporation_gender']=='m'?"男":'女':''?>
                        </div>
                    </div>
                <style>
                    .control-labela{float:left;line-height:34px;text-align:right}
                    .label1{margin:0px 15px;}
                    .label2{width:500px;}
                </style>
				<div class="control-group" style="clear:both;margin-top:118px;">
					<label class="control-label">营业执照</label>
					<div class="controls">
                        <label class="control-labela label1">备注</label>
                        <label class="control-labela label2">
                            <?php echo $model->business_license_text ?>
                        </label>
					</div>

				</div>
				<div class="control-group1" style="margin-left:100px;">
					<div class="controls1">
						<div id="business_license_photo_div" style="float:left;100%;height:200px;<?php echo $business_license_photo==null?'display:none':''; ?>">
                                <ul class="docs-pictures clearfix">
                                    <?php if ($business_license_photo): ?>
                                        <?php foreach ($business_license_photo as $key => $value): ?>
                                                <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
						</div>
					</div>
				</div>
				<div class="control-group" style="clear:both;margin-top:40px;">
					<label class="control-label">法人证件</label>
					<div class="controls">
                        <label class="control-labela label1">备注</label>
                        <label class="control-labela label2">
                            <?php echo $model->corporation_text ?>

                        </label>
					</div>
				</div>
				<div class="control-group1" style="margin-left:100px;">
					<div class="controls1">
						<div id="corporation_photo_div" style="float:left;100%;height:200px;<?php echo $corporation_photo==null?'display:none':''; ?>">
                            <ul class="docs-pictures clearfix">
                                <?php if ($corporation_photo): ?>
                                    <?php foreach ($corporation_photo as $key => $value): ?>
                                            <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
						</div>
					</div>
				</div>
			</div>
			<div id="personal" style="<?php echo $model->lessee_type==2?"":"display:none;"; ?>">
                    <?php $owner1=CmsPurchaseContractOwner::model()->findAll("contract_id='$model->id' and type=1");
                        if($owner1){
                            foreach($owner1 as $key => $value){
                                $id=$value['owner_id'];
                                $owner3=CmsOwner::model()->find("id='$id'");
                    ?>
                    <div id="chengzu">
                        <div class="control-group inputcss" style="clear:both;float:left;">
                            <label class="control-label">承租人</label>
                            <div class="controls">
                                <?php echo $owner3? $owner3->name:'' ?>
                            </div>
                        </div>
                        <div class="control-group inputcss" style="float:left;">
                            <label class="control-label">联系方式</label>
                            <div class="controls">
                                <?php echo $owner3? $owner3->mobile:''?>
                            </div>
                        </div>
                        <div class="control-group inputcss" style="float:left;">
                            <label class="control-label">身份证号</label>
                            <div class="controls">
                                <?php echo $owner3?$owner3->id_card_no:''?>
                            </div>
                        </div>
                        <div class="control-group inputcss" style="float:left;">
                                <label class="control-label">性别</label>
                                <div class="controls">
                                        <?php echo $owner3->gender?$owner3->gender=='m'? '男':'女':'';?>
                                </div>
                        </div>
                    </div>
                <div id="zuren"></div>
                <?php }
                   ?>
                <?php 
                    }else{
                    ?>
                <?php }?>
                <div style="clear:both"></div>
                        <!-- 以上为承租人 -->
                        <!-- 以下为代理人 -->

                <?php $owner1=CmsPurchaseContractOwner::model()->findAll("contract_id='$model->id' and type=2");
                    if($owner1){
                        foreach($owner1 as $key => $value){
                            $id=$value['owner_id'];
                            $owner=CmsOwner::model()->find("id='$id'");
                ?>
                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">代理人</label>
                    <div class="controls">
                        <?php echo $owner? $owner->name:'' ?>
                    </div>
                </div>
                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">联系方式</label>
                    <div class="controls">
                        <?php echo $owner?$owner->mobile:''?>
                    </div>
                </div>
                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">身份证号</label>
                    <div class="controls">
                        <?php echo $owner?$owner->id_card_no:''?>
                    </div>
                </div>
                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">性别</label>
                    <div class="controls">
                        <?php echo $owner->gender?$owner->gender=='m'? '男':'女':'';?>
                    </div>
                </div>
                <?php
                        }
                    }else{
                ?>
                <?php
                    }
                ?>

				<div class="control-group" style="clear:both;margin-top:106px;">
					<label class="control-label">承租人证件</label>
					<div class="controls">
                        <label class="control-labela label1">备注</label>
                        <label class="control-labela label2">
                            <?php echo $model->id_card_text ?>
                        </label>
					</div>
				</div>
				<div class="control-group1" style="margin-left:100px;">
					<div class="controls1">
						<div id="client_id_card_photo_div" style="float:left;100%;height:200px;<?php echo $client_id_card_photo==null?'display:none':''; ?>;">
                             <ul class="docs-pictures clearfix">
                                <?php if ($client_id_card_photo): ?>
                                    <?php foreach ($client_id_card_photo as $key => $value): ?>
                                            <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>

						</div>
					</div>
				</div>
			</div>

			<div class="control-group" style="clear:both;margin-top:40px;">
				<label class="control-label">承租人授权代理人委托书</label>
				<div class="controls">
                    <label class="control-labela label1">备注</label>
                    <label class="control-labela label2">
                        <?php echo $model->accredited_representative_text ?>
                    </label>
				</div>
			</div>
			<div class="control-group1" style="margin-left:100px;">
				<div class="controls1">
					<div id="accredited_representative_photo_div" style="float:left;100%;height:200px;<?php echo $accredited_representative_photo==null?'display:none':''; ?>">
                             <ul class="docs-pictures clearfix">
                                <?php if ($accredited_representative_photo): ?>
                                    <?php foreach ($accredited_representative_photo as $key => $value): ?>
                                            <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
					</div>
				</div>
			</div>

			<div class="control-group" style="clear:both;margin-top:40px;">
				<label class="control-label">委托人身份证复印件</label>
                    <label class="control-labela label1">备注</label>
                    <label class="control-labela label2">
                        <?php echo $model->authorized_id_card_text ?>
                    </label>
				</div>
			</div>
			<div class="control-group1" style="margin-left:100px;">
				<div class="control1s">
					<div id="authorized_id_card_photo_div" style="float:left;100%;height:200px;<?php echo $authorized_id_card_photo==null?'display:none':''; ?>">
                             <ul class="docs-pictures clearfix">
                                <?php if ($authorized_id_card_photo): ?>
                                    <?php foreach ($authorized_id_card_photo as $key => $value): ?>
                                            <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
					</div>
				</div>
			</div>

			<div class="control-group" style="clear:both;margin-top:40px;">
				<label class="control-label">车源交割单</label>
				<div class="controls">
                    <label class="control-labela label1">备注</label>
                    <label class="control-labela label2">
                        <?php echo $model->house_delivery_order_text ?>

                    </label>
				</div>
			</div>
			<div class="control-group1" style="margin-left:100px;">
				<div class="controls1">
					<div id="house_delivery_order_photo_div" style="float:left;100%;height:200px;<?php echo $house_delivery_order_photo==null?'display:none':''; ?>">
                             <ul class="docs-pictures clearfix">
                                <?php if ($house_delivery_order_photo): ?>
                                    <?php foreach ($house_delivery_order_photo as $key => $value): ?>
                                            <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </ul>
					</div>
				</div>
			</div>
            <div class="control-group " style = "clear:both;float:left;">
                <label class="control-label">所有证件<span class="required">*</span></label>
                <div class="controls">
                    <?php echo $model->papers_ok==1?'全':'';?>
                    <?php echo $model->papers_ok==0?'不全':'';?>
                </div>
            </div>
		</div>


      </div>
      <div class="yj-xg-xbox"  style="display:none">
                    <div class="xxk-lp-1">
                        <p style="font-size:20px;margin:30px 50px;font-weight:bold;margin-left:18px;">租期信息</p>
                        <div class="control-group inputcss">
                            <label class="control-label">免租方式</label>
                            <div class="controls">
                                    <?php echo $model->free_type==1?'期外免租':'';?>
                                    <?php echo $model->free_type==2?'期内免租':'';?>
                                    <?php echo $model->free_type==3?'期内期外':'';?>
                            </div>
                        </div>

                        

                        <?php
                            $freelease=CmsPruchaseFreeLease::model()->findAll("contract_id='$model->id' order by start_time");
                            if (sizeof($freelease)>0){
                                foreach ($freelease as $key => $value) {
                        ?>
                            <div id="free_clone">
                                <div class="control-group inputcss">
                                    <label class="control-label">免租期</label>
                                    <div class="controlss">
                                        <?php echo $value->start_time?date('Y-m-d',$value->start_time):"";?>&nbsp;至&nbsp;<?php echo $value->end_time?date('Y-m-d',$value->end_time):"";?>
                                    </div>
                                </div>
                            </div>        
                                <?php }?>
                        <?php
                            }else{
                        ?> 
                            <div id="free_clone">
                                <div class="control-group inputcss">
                                    <label class="control-label">免租期</label>
                                    <div class="controlss">
                                        无
                                    </div>
                                </div>
                            </div> 
                        <?php
                            }

                        ?>  

                        <div class="control-group inputcss">
                            <label class="control-label">租期<span class="required" >*</span></label>
                            <div class="controlss">
                                <?php echo $model->lease_term_start?date('Y-m-d',$model->lease_term_start):""?>&nbsp;至&nbsp;<?php echo $model->lease_term_end?date('Y-m-d',$model->lease_term_end):""?>&nbsp;&nbsp;&nbsp;
                                <?php echo $model->lease_term_year?$model->lease_term_year.'年':" "?><?php echo $model->lease_term_month?$model->lease_term_month.'月':" "?><?php echo $model->lease_term_day?$model->lease_term_day.'日':" "?>
                            </div>
                        </div>

                        <div id="lease_term_list">
							<?php
								foreach (CmsPurchasePayRule::model()->findAll("contract_id='$model->id' order by the_order") as $key => $value) {
							?>
								<div class="control-group inputcss">
								<label class="control-label">第<?php echo $value->the_order+1 ?>年<span class="required" >*</span></label>
                                <div class="controlss">
                                  <?php echo $value->start_time?date('Y-m-d',$value->start_time):"";?>&nbsp;至&nbsp;<?php echo $value->end_time?date('Y-m-d',$value->end_time):"";?>
                                    月租金&nbsp;<?php echo $value->monthly_rent?$value->monthly_rent/100:""?>(元)
                                    单价&nbsp;<?php echo $value->price_per_meter?$value->price_per_meter/100:""?>(元/天/㎡)
                                    <?php if ($value->increasing_mode==1){?>
                                        递增方式&nbsp;<?php echo $value->increasing_number?$value->increasing_number:""?>
                                    <?php }elseif ($value->increasing_mode==2) {
                                    ?>
                                        递增方式&nbsp;<?php echo $value->increasing_number?$value->increasing_number/100:""?>
                                    <?php
                                    }
                                    else{
                                    ?>
                                    <?php
                                    }
                                    ?>

                                        <?php echo $value->increasing_mode==1?"%":""; ?>
                                        <?php echo $value->increasing_mode==2?"元":""; ?>
                                </div>
							</div>
							<?php
								}
							?>

                        </div>
                        
                        <p style="font-size:20px;margin-top:30px;margin-bottom:30px;font-weight:bold;margin-left: 18px;">付款信息</p>

                        <?php
                                $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");
                                if (sizeof($pay)>0){
                                    foreach ($pay as $key => $value) {
                            ?>
                        <div id="pay_clone">
                            <div class="control-group " style="float:left;clear:both;">
                                <label class="control-label">押<span class="required">*</span></label>
                                <div class="controls" style="width:30px;">
                                    <?php echo $value->deposit_month;?>
                                </div>                                
                            </div>
                            <div class="control-group" style="float:left;margin-left:-30px;">
                                <label class="control-label">付<span class="required">*</span></label>
                                <div class="controls" style="width:30px;">
                                    <?php echo $value->pay_month;?>
                                </div>
                            </div>
                            <div class="control-group inputcss" style="float:left;">
                                <label class="control-label">日期区间<span class="required">*</span></label>
                                <div class="controls" style="width:220px;">
                                    <?php echo $value->start_time?date('Y-m-d',$value->start_time):''?>&nbsp;至&nbsp;<?php echo $value->end_time?date('Y-m-d',$value->end_time):''?>
                                </div>
                            </div>
                        </div>     
                            <?php }
                            }else{
                            ?>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="tj-box"></div>

                        <div class="control-group inputcss" style="float:left;clear:both;">
                        <label class="control-label" style="width:129px!important;">提前几天付款<span class="required">*</span></label>
                        <div class="controls" style="width:150px;">
                           <?php echo $model==null?"":$model->advance_days;?>
                        </div>
                    </div>  
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label" style="width:129px!important;">押金<span class="required">*</span></label>
                        <div class="controls" style="width:150px;">
                            <?php echo $model==null?"":$model->deposit/100;?>(元)
                        </div>
                    </div>                    
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label" style="width:129px!important;">备注</label>
                        <div class="controls" style="width:150px;">
                            <?php echo $model==null?"":$model->deposit_memo;?>
                        </div>
                    </div>

                    <div class="control-group inputcss" style="float:left;clear:both;">
                        <label class="control-label" style="width:129px!important;">押金付款日期<span class="required">*</span></label>
                        <div class="controls" style="width:150px;">
                            <?php echo $model->deposit_pay_time?date('Y-m-d',$model->deposit_pay_time):''?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label" style="width:129px!important;">首期租金付款日期<span class="required">*</span></label>
                        <div class="controls" style="width:150px;">
                            <?php echo $model->rent_start_time?date('Y-m-d',$model->rent_start_time):''?>
                        </div>
                    </div>
                    <div class="control-group inputcss" style="float:left;">
                        <label class="control-label" style="width:129px!important;">二期租金付款日期<span class="required">*</span></label>
                        <div class="controls" style="width:150px;">
                            <?php echo $model->rent_second_time?date('Y-m-d',$model->rent_second_time):''?>
                        </div>
                    </div>
                        <div style="">

                        <?php if ($model->invoice==1): ?>
                            <div class="control-group invoice_s " style="float:left;">
                                <label class="control-label">税率</label>
                                <div class="controls">
                                    <input type="text" style="width:100px;" name="tax_rate" value="<?php echo $model==null?"":$model->tax_rate==0?"":$model->tax_rate/100;?>"/>%
                                </div>
                            </div>
                            <div class="control-group invoice_s " style="float:left;">
                                <label class="control-label">税金金额</label>
                                <div class="controls">
                                    <input type="text" name="tax" style="width:100px;" value="<?php echo $model==null?"":$model->tax/100==0?"":$model->tax/100;?>" class="invoice_s"/>元/月
                                </div>
                            </div>                            
                        <?php endif ?>


						<script>
							$("#invoice").click(function(){
								if($("#invoice").attr("checked") == "checked"){
									$(".invoice_s").show();
								}else{
									$(".invoice_s").hide();
								}
							})
                            if($("#invoice").attr("checked") == "checked"){
                                    $(".invoice_s").show();
                                }else{
                                    $(".invoice_s").hide();
                            }
						</script>
                        <div class="control-group inputcss" style="float:left;clear:both;">
                            <label class="control-label" style="width:100px">总应付租金</label>
                            <div class="controls">
                                <?php echo $model->rent_sum/100; ?>(元)
                            </div>
                        </div>
                        <div class="control-group inputcss" style="float:left;">
                            <label class="control-label">合同佣金</label>
                            <div class="controls">
                                <?php echo $model->commission/100; ?>(元)
                            </div>
                        </div>
                        <div class="control-group inputcss" style="margin-left:30px;float:left;">
                            <label class="control-label">备注</label>
                            <div class="controls">
                                <?php echo $model->rent_sum_memo; ?>
                            </div>
                        </div>

                    </div>
                    <div style="text-align: center;margin-top:100px;margin-bottom:13px;">
                    </div>
      </div>
      <div class="yj-xg-xbox"  style="display:none">
            <div class="xxk-lp-1">
                    <p style="font-size:20px;margin:30px 50px;font-weight:bold;">签约信息</p>
                    <div class="yj-qy-xx">
                          <div class="control-group">
                            <label class="control-label" style="width:90px">幼狮签约人<!-- 司公业务员ID（） --></label>
           <div class="controls">
                <?php echo AdminUser::model()->find("id='$model->salesman_id'")->nickname; ?>
           </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label">签约日</label>
                            <div class="controls">
                                <?php echo $model->signing_date?date('Y-m-d',$model->signing_date):""?>
                            </div>
                          </div>
            <div class="control-group" style="float:left">
                <label class="control-label">渠道公司</label>
                <div class="controls">
                    <?php echo CmsChannel::model()->find("id='$model->channel_id'")->name ?>
                </div>
            </div>
            <?php if ($model->channel_manager_id): ?>
                <?php $arr = explode(',',$model->channel_manager_id) ;
                    foreach ($arr as $key => $value) {
                    ?>
                        <div class="control-group" style="clear:both;float:left">
                            <label class="control-label">渠道人员</label>
                            <div class="controls">
                                <?php echo CmsChannelManager::model()->find("id='$value'")->name  ?>
                            </div>
                        </div>
                    <?php
                    }

                ?>
            <?php endif ?> 
                          <br>
                          <br>
                          <br> <br>
                    </div>
                    <div class="yj-qy-xx">
                             <div class="control-group" style="clear:both;">
                                <label class="control-label" style="width:90px">客服交房日</label>
                                <div class="controls">
                                    <?php echo $model->the_date?date('Y-m-d',$model->the_date):""?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" style="width:90px">客服交房人<!-- 公司业务员ID（） --></label>
                                <div class="controls">
                                    <?php echo AdminUser::model()->find("id='$model->recycle_id'")->nickname ?>
                             </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">合同状态</label>
                                <div class="controls">
                                        <?php foreach (Yii::app()->params['contract_status'] as $key => $value) {
                                        ?>
                                              <?php 
                                                    if ($key!=1) {
                                                       ?>
                                                        <?php echo $model->status==$key? " $value ":""?>
                                                    <?php 
                                                        }
                                                        ?>
                                        <?php
                                        }?>
                                </div>
                            </div>
                            <?php if ($model->break_contract): ?>
                                <div class="control-group" id="break_contract" style="float:left;">
                                    <label class="control-label" >违约原因</label>
                                    <div class="controls">
                                    <?php 
                                   switch ($model->break_contract)
                                        {
                                        case $model->break_contract==1:
                                            echo '提前退租';
                                            break;  
                                        case $model->break_contract==2:
                                            echo '申请换租->扩租';
                                            break;
                                        case $model->break_contract==3:
                                            echo '申请换租->缩租';
                                            break;
                                        case $model->break_contract==4:
                                            echo '申请换租->同租';
                                            break;
                                        case $model->break_contract==5:
                                            echo '转租';
                                            break;
                                        }
                                     ?>
                                    </div>
                                </div>                                
                            <?php endif ?>
                            <?php if ($model->break_contract_text): ?>
                                <div class="control-group" id="break_contract_text" style="float:left;">
                                    <label class="control-label">其他原因</label>
                                    <div class="controls">
                                        <?php echo $model->break_contract_text; ?>
                                    </div>
                                </div>                                
                            <?php endif ?>

                          <br>
                          <br>
                          <br>
                           <br>
                        </div>

                            <div class="control-group" style="clear:both;">
                                <label class="control-label">补充条款</label>
                                <div class="controls" style="width:800px;">
                                    <?php echo $model->addition ?>
                                </div>
                            </div>

                            <div class="control-group" style="">
                                <label class="control-label">备注</label>
                                <div class="controls" style="width:800px;">
                                    <?php echo $model->memo ?>
                                </div>
                            </div>
                </div>
                 <div style="text-align: center;margin-top:100px;margin-bottom:13px;">
                </div>
      </div>
    </div>
    <script>
        $(function(){
             $(".yj-xg-xbox").eq(0).css({display:"block"})
            $(".yj-xg-btn div").click(function(){
              var index=$(".yj-xg-btn div").index(this)
              $(".yj-xg-xbox").css({display:"none"}).eq(index).css({display:"block"})
            })
        })
    </script>
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
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<style>
    .theFont{font-size: 20px;}
</style>

<script>

    var swf_business_license_photo;
    var swf_organization_code_photo;
    var swf_corporation_photo;
    var swf_client_id_card_photo;
    var swf_house_property_card_photo;
    var swf_immovable_authorisation_photo;
    var swf_accredited_representative_photo;
    var swf_authorized_id_card_photo;
    var swf_house_delivery_order_photo;

    window.onload = function() {

//图集图片
        var settings_business_license_photo = {
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
                progressTarget : "fsUploadProgress_business_license_photo",
                cancelButtonId : "btnCancel"
            },
            debug: false,

// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_business_license_photo",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">新增图片</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued_business_license_photo,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess_business_license_photo,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swf_business_license_photo = new SWFUpload(settings_business_license_photo);

//图集图片
//法人图片
        var settings_corporation_photo = {
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
                progressTarget : "fsUploadProgress_corporation_photo",
                cancelButtonId : "btnCancel"
            },
            debug: false,

// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_corporation_photo",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">新增图片</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued_corporation_photo,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess_corporation_photo,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swf_corporation_photo = new SWFUpload(settings_corporation_photo);


//承租人授权代理人委托书图片
        var settings_accredited_representative_photo = {
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
                progressTarget : "fsUploadProgress_accredited_representative_photo",
                cancelButtonId : "btnCancel"
            },
            debug: false,

// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_accredited_representative_photo",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">新增图片</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued_accredited_representative_photo,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess_accredited_representative_photo,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swf_accredited_representative_photo = new SWFUpload(settings_accredited_representative_photo);

//委托人身份证图片
        var settings_authorized_id_card_photo = {
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
                progressTarget : "fsUploadProgress_authorized_id_card_photo",
                cancelButtonId : "btnCancel"
            },
            debug: false,

// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_authorized_id_card_photo",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">新增图片</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued_authorized_id_card_photo,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess_authorized_id_card_photo,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swf_authorized_id_card_photo = new SWFUpload(settings_authorized_id_card_photo);


        //承租人证件
        var settings_client_id_card_photo = {
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
                progressTarget : "fsUploadProgress_client_id_card_photo",
                cancelButtonId : "btnCancel"
            },
            debug: false,

// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_client_id_card_photo",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">新增图片</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued_client_id_card_photo,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess_client_id_card_photo,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swf_client_id_card_photo= new SWFUpload(settings_client_id_card_photo);

//车源交割单图片
        var settings_house_delivery_order_photo = {
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
                progressTarget : "fsUploadProgress_house_delivery_order_photo",
                cancelButtonId : "btnCancel"
            },
            debug: false,

// Button settings
            button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
            button_width: "100",
            button_height: "30",
            button_placeholder_id: "PlaceHolder_house_delivery_order_photo",
            button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
            button_disabled : false,

            button_text: '<span class="theFont">新增图片</span>',
            button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
            button_text_left_padding: 20,
            button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
            file_queued_handler : fileQueued_house_delivery_order_photo,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : fileDialogComplete,
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess_house_delivery_order_photo,
            upload_complete_handler : uploadComplete,
            queue_complete_handler : queueComplete  // Queue plugin event
        };
        swf_house_delivery_order_photo = new SWFUpload(settings_house_delivery_order_photo);

        var startDate=0;
        $("input[name='lease_term_start']").datepicker().on("changeDate",function(e){
            startDate=e.date.valueOf();
        });

        $("input[name='lease_term_end']").datepicker().on("changeDate",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示
            if (startDate==0){
                alert("请选择开始时间");
                return;
            }
            else if (e.date.valueOf() < startDate){
                alert("结束时间不能小于开始时间");
                return;
            }
            else{
//alert(e.date.valueOf()-startDate);
            }

            var start=new Date(startDate);
            var startyear=start.getFullYear();
            var startmonth=start.getMonth();
            var startdate=start.getDate();

            var end=new Date(e.date.valueOf());
            var endyear=end.getFullYear();
            var endmonth=end.getMonth();
            var enddate=end.getDate();

            var count=endyear-startyear;
            $("#lease_term_list").html("");
            for (var i = 0; i < count; i++) {
                var html='<div class="control-group inputcss">'+
                    '                        <label class="control-label">第'+(i+1)+'年<span class="required">*</span></label>'+
                    '                        <div class="controls">'+
                    '                            <input name="term_start[]" class="m-wrap m-ctrl-medium date-picker  span2"  size="16" type="text" value="" required />&nbsp;至&nbsp;'+
                    '                            <input name="term_end[]" class="m-wrap m-ctrl-medium date-picker span2"  size="16" type="text" value="" required />'+
                    '                            月租金<input name="sub_monthly_rent[]" type="text"  class="span1 m-wrap"/>(元)'+
                    '                            单价<input name="sub_price_per_meter[]" type="text"  class="span1 m-wrap"/>(元/天/㎡)'+
                    '                            递增方式<input name="increasing_number[]" type="text" class="span1 m-wrap"/>'+
                    '                            <select name="increasing_mode[]" class="span1"><option value=1>%</option><option value=2>元</option><select>'+
                    '                        </div>'+
                    '                    </div>';
                $("#lease_term_list").append(html);
            };
// var year=now.getYear(start);
// alert(year);

//var applyyear = startDate.getfullyear();
//alert(applyyear);


            $("input[name='term_start[]']").datepicker({format: "yyyy-mm-dd"});
            $("input[name='term_end[]']").datepicker({format: "yyyy-mm-dd"});
        });


    };
    function uploadSuccess_business_license_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("business_license_photo_show")[0].src=file_url;
        var oo = document.getElementsByName("business_license_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#business_license_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("business_license_photo")[0].value=document.getElementsByName("business_license_photo")[0].value+','+file_url;
        $("#business_license_photo_div").show();
    }

    function fileQueued_business_license_photo(file){

        var stats = swf_business_license_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    //承租人照片
    function uploadSuccess_client_id_card_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("corporation_photo_show")[0].src=file_url;
//        document.getElementsByName("corporation_photo")[0].value=file_url;
//        $("#corporation_photo_div").show();

        var oo = document.getElementsByName("client_id_card_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#client_id_card_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("client_id_card_photo")[0].value=document.getElementsByName("client_id_card_photo")[0].value+','+file_url;
        $("#client_id_card_photo_div").show();
    }

    function fileQueued_client_id_card_photo(file){

        var stats = swf_client_id_card_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    //法人
    function uploadSuccess_corporation_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("corporation_photo_show")[0].src=file_url;
//        document.getElementsByName("corporation_photo")[0].value=file_url;
//        $("#corporation_photo_div").show();

        var oo = document.getElementsByName("corporation_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#corporation_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("corporation_photo")[0].value=document.getElementsByName("corporation_photo")[0].value+','+file_url;
        $("#corporation_photo_div").show();
    }

    function fileQueued_corporation_photo(file){

        var stats = swf_corporation_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    //房产证
    function uploadSuccess_house_property_card_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("house_property_card_photo_show")[0].src=file_url;
//        document.getElementsByName("house_property_card_photo")[0].value=file_url;
//        $("#house_property_card_photo_div").show();

        var oo = document.getElementsByName("house_property_card_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#house_property_card_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("house_property_card_photo")[0].value=document.getElementsByName("house_property_card_photo")[0].value+','+file_url;
        $("#house_property_card_photo_div").show();
    }

    function fileQueued_house_property_card_photo(file){

        var stats = swf_house_property_card_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }
    //不动产授权委托书
    function uploadSuccess_immovable_authorisation_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("immovable_authorisation_photo_show")[0].src=file_url;
//        document.getElementsByName("immovable_authorisation_photo")[0].value=file_url;
//        $("#immovable_authorisation_photo_div").show();

        var oo = document.getElementsByName("immovable_authorisation_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#immovable_authorisation_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("immovable_authorisation_photo")[0].value=document.getElementsByName("immovable_authorisation_photo")[0].value+','+file_url;
        $("#immovable_authorisation_photo_div").show();
    }

    function fileQueued_immovable_authorisation_photo(file){

        var stats = swf_immovable_authorisation_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }
    //承租人授权代理人委托书
    function uploadSuccess_accredited_representative_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("accredited_representative_photo_show")[0].src=file_url;
//        document.getElementsByName("accredited_representative_photo")[0].value=file_url;
//        $("#accredited_representative_photo_div").show();
        var oo = document.getElementsByName("accredited_representative_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#accredited_representative_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("accredited_representative_photo")[0].value=document.getElementsByName("accredited_representative_photo")[0].value+','+file_url;
        $("#accredited_representative_photo_div").show();
    }

    function fileQueued_accredited_representative_photo(file){

        var stats = swf_accredited_representative_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }
    //委托人身份证复
    function uploadSuccess_authorized_id_card_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("authorized_id_card_photo_show")[0].src=file_url;
//        document.getElementsByName("authorized_id_card_photo")[0].value=file_url;
//        $("#authorized_id_card_photo_div").show();

        var oo = document.getElementsByName("authorized_id_card_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#authorized_id_card_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("authorized_id_card_photo")[0].value=document.getElementsByName("authorized_id_card_photo")[0].value+','+file_url;
        $("#authorized_id_card_photo_div").show();
    }

    function fileQueued_authorized_id_card_photo(file){

        var stats = swf_authorized_id_card_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }
    //车源交割单
    function uploadSuccess_house_delivery_order_photo(fileObj, server_data){
        $(".progressWrapper").hide();
        var json=JSON.parse(server_data);
        if (json.code==0)
        {
            alert(json.message);
            return;
        }
        var file_name=json.data.file_name;
        var file_url=json.data.file_url;

//        document.getElementsByName("house_delivery_order_photo_show")[0].src=file_url;
//        document.getElementsByName("house_delivery_order_photo")[0].value=file_url;
//        $("#house_delivery_order_photo_div").show();

        var oo = document.getElementsByName("house_delivery_order_photo_show")[0];
        var new_img = $(oo).clone();
        $(new_img).show();
        $(new_img).attr("src",file_url);
        $("#house_delivery_order_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
        document.getElementsByName("house_delivery_order_photo")[0].value=document.getElementsByName("house_delivery_order_photo")[0].value+','+file_url;
        $("#house_delivery_order_photo_div").show();
    }

    function fileQueued_house_delivery_order_photo(file){

        var stats = swf_house_delivery_order_photo.getStats();
        stats.successful_uploads--;
        this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
    }

    $("input[name='lessee_type']").click(function(){
        if($(this).val()==1){
            $("#company").show();
            $("#personal").hide();
        }
        else{
            $("#company").hide();
            $("#personal").show();
        }

//$("#lessee_type").css("display","none");
//$(".heka_word2 p").html($("#content").html());
    });

    $("select[name='channel_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示
        $("select[name='channel_manager_id']").empty();
        var channelid=$("#channel_id").val();
        if(null!= channelid && ""!=channelid){
            $.ajax("/admin/ajax/getchannelmanager", {
                data: {
                    id:channelid
                },
                dataType: "json"
            }).done(function (data) {
                var options="";
                if(data.length>0){
                    options+="<option value=''";
                    for(var i=0;i<data.length;i++){
                        options+="<option value="+data[i].id+">"+data[i].title+"</option>";
                    }
                    $("select[name='channel_manager_id']").html(options);
                }
            });
        }
        else{
            $("#second").hide();
        }
    });


    $("input[name*='sub_monthly_rent[]']").live("change",function(e){
    if ($(this).val()!=""){
        var area = $("input[name='area[]']");
        var mianji = 0;
        for (var i = 0; i < area.length-1; i++) {
             parseFloat(area[i].value);
             mianji = parseFloat(mianji);
             mianji = mianji + parseFloat(area[i].value);
        }
        if (mianji==""){
        alert("请填写面积");
        }
        var p=$(this).val()*12/365/mianji;
        $(this).parent().children("input[name*='sub_price_per_meter']").val(p.toFixed(2));
        }
        else{
        $(this).parent().children("input[name*='sub_price_per_meter']").val("");
        }
    });

    $("input[name*='sub_monthly_rent[]']").live("change",function(e){
        if ($(this).val()!=""){
            var m_rent = $("input[name='sub_monthly_rent[]']");
            var money = 0;
            for (var i = 0; i < m_rent.length; i++) {
                 parseFloat(m_rent[i].value);
                 money = parseFloat(money);
                 money = money + parseFloat(m_rent[i].value);
            }
            var p= money*12;
            $("input[name='rent_sum']").val(p);
        }
    });


    $("input[name='lessee2']").live("click",function(e){
        if ($(this).val()=="其它"){
            $("input[name='lessee']").val("");
            $("input[name='lessee']").show();
        }
        else{
            $("input[name='lessee']").val($(this).val());
            $("input[name='lessee']").hide();
        }

    });

    var nummore =$('.more');
    $("button[id='add_property']").live("click",function(e){
        mores =$('.select').clone();
        mores.removeClass('select');
        mores.show();
        mores.addClass('more');
        nummore =$('.more');
        mores.find("#area").attr('id','area'+nummore.length);
        mores.find("#room_type").attr('id','room_type'+nummore.length);
        mores.find("#property_id").attr('id','property_id'+nummore.length);

//        mores.find("input[name='estate_id']").attr('name','estate_id'+nummore.length);
//        mores.find("input[name='area']").attr('name','area'+nummore.length);
//        mores.find("input[name='property_id']").attr('name','property_id'+nummore.length);
//        mores.find("input[name='room_type']").attr('name','room_type'+nummore.length);
        $('#propertys').append(mores);
        handleSelectEstate();
        handleSelectBuilding();
        handleSelectHouseNo();

    });
    $("button[id='del_property']").live('click',function(){
        var delmore = $('.more');
        $('.more').eq(delmore.length-1).remove();
        if(delmore.length==0){
            alert('最后一个车源不能删除');
        }
    })

    var handleSelectEstate = function () {
        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }

        function movieFormatResult(movie) {
            var markup = "<table class='movie-result'><tr>";
            if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
            }
            markup += "<td valign='top'><h5>" + movie.title + "</h5>";
            if (movie.critics_consensus !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
            } else if (movie.synopsis !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
            }
            markup += "</td></tr></table>"
            return markup;
        }

        function movieFormatSelection(movie) {
// $.ajax("/admin/ajax/getbuilding", {
//     data: {
//         id:movie.id
//     },
//     dataType: "json"
// }).done(function (data) {
//     var options="";
//     if(data.length>0){
//         options+="<option value=''";
//         for(var i=0;i<data.length;i++){
//             if ($("select[name='building_id']").val()==data[i].id){
//                 options+="<option selected value="+data[i].id+">"+data[i].title+"</option>";
//             }
//             else{
//                 options+="<option value="+data[i].id+">"+data[i].title+"</option>";
//             }

//         }
//         $("select[name='building_id']").html(options);
//     }
// });
//$("#building_id").val("");
            /*  $("#building_id").select2("val", "");
             $("#room_number").select2("val", "");
             $("input[name='area']").val(""); */
            return movie.title;
        }

        mores.find('.estate').select2({
            placeholder: "",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/admin/estate/ajaxlist",
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term, // search term
                        page_limit: 10,
                        apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {
                        results: data.movies
                    };
                }
            },
            initSelection: function (element, callback) {
// the input tag has a value attribute preloaded that points to a preselected movie's id
// this function resolves that id attribute to an object that select2 can render
// using its formatResult renderer - that way the movie name is shown preselected
                var id=element.val();
                var title=element.attr("title");
                if(id!=''&&title!=""){
                    callback({id:id,title:title});
                }
            },
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) {
                return m;
            } // we do not want to escape markup since we are displaying html in results
        });
    }

    var handleSelectBuilding = function () {
        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }

        function movieFormatResult(movie) {
            var markup = "<table class='movie-result'><tr>";
            if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
            }
            markup += "<td valign='top'><h5>" + movie.title + "</h5>";
            if (movie.critics_consensus !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
            } else if (movie.synopsis !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
            }
            markup += "</td></tr></table>"
            return markup;
        }

        function movieFormatSelection(movie) {
// $.ajax("/admin/ajax/getbuilding", {
//     data: {
//         id:movie.id
//     },
//     dataType: "json"
// }).done(function (data) {
//     var options="";
//     if(data.length>0){
//         options+="<option value=''";
//         for(var i=0;i<data.length;i++){
//             if ($("select[name='house_no']").val()==data[i].id){
//                 options+="<option selected value="+data[i].id+">"+data[i].title+"</option>";
//             }
//             else{
//                 options+="<option value="+data[i].id+">"+data[i].title+"</option>";
//             }

//         }
//         $("select[name='house_no']").html(options);
//     }
// });
            /*   $("#room_number").select2("val", "");
             $("input[name='area']").val(""); */
            return movie.title;
        }

        mores.find('.building').select2({
            placeholder: "",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/admin/building/ajaxlistbyestateid",
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term, // search term
                        estate_id:$("#estate_id").val(),
                        page_limit: 10,
                        apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {
                        results: data.movies
                    };
                }
            },
            initSelection: function (element, callback) {
// the input tag has a value attribute preloaded that points to a preselected movie's id
// this function resolves that id attribute to an object that select2 can render
// using its formatResult renderer - that way the movie name is shown preselected
                var id=element.val();
                var title=element.attr("title");
                if(id!=''&&title!=""){
                    callback({id:id,title:title});
                }
            },
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) {
                return m;
            } // we do not want to escape markup since we are displaying html in results
        });
    }

    var handleSelectHouseNo = function () {
        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }

        function movieFormatResult(movie) {
            var markup = "<table class='movie-result'><tr>";
            if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
            }
            markup += "<td valign='top'><h5>" + movie.title + "</h5>";
            if (movie.critics_consensus !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
            } else if (movie.synopsis !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
            }
            markup += "</td></tr></table>"
            return markup;
        }

        function movieFormatSelection(movie) {

            $.ajax("/admin/property/ajaxlistbyid", {
                data: {
                    id:movie.id
                },
                dataType: "json"
            }).done(function (data) {

// console.log("#area"+nummore.length)
                $("#area"+nummore.length).val(data.area);
                $("#room_type"+nummore.length).val(data.room_type);
                $("#property_id"+nummore.length).val(data.property_id);
            });

            return movie.title;
        }

        mores.find('.room').select2({
            placeholder: "",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/admin/property/ajaxlistbybuildingid",
                dataType: 'json',
                data: function (term, page) {
                    return {
                        q: term, // search term
                        building_id:$("#building_id").val(),
                        page_limit: 10,
                        apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {
                        results: data.movies
                    };
                }
            },
            initSelection: function (element, callback) {
// the input tag has a value attribute preloaded that points to a preselected movie's id
// this function resolves that id attribute to an object that select2 can render
// using its formatResult renderer - that way the movie name is shown preselected
                var id=element.val();
                var title=element.attr("title");
                if(id!=''&&title!=""){
                    callback({id:id,title:title});
                }
            },
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) {
                return m;
            } // we do not want to escape markup since we are displaying html in results
        });
    }
    $("input[name='lessor2']").live("click",function(e){
        if ($(this).val()=="其它"){
            $("input[name='lessor']").val("");
            $("input[name='lessor']").show();
        }
        else{
            $("input[name='lessor']").val($(this).val());
            $("input[name='lessor']").hide();
        }

    });
    //物业费
    $("input[name='add_wy']").on("click",function(e){
    //alert("11");
    //$(this).parent().css({"color":"red","border":"2px solid red"});
    html='<div><label class="control-labela label1">物业费</label><label class="control-labela" style="margin-right:20px;">'+
    '<input name="wuye_money[]" value="" type="text" class="span12 m-wrap"/>'+'</label><div class="controls" style="margin-bottom:10px">'+
    '<input name="wuye_start[]" value="" type="text" class="span3 m-wrap date-picker"/>&nbsp;至&nbsp;'+
    '<input name="wuye_end[]" value="" type="text"class="span3 m-wrap date-picker"/>'+'<input  type="button" class="span1 m-wrap del_wy" value="删除"/>'+
    '</div></div>';
    $(".wuye").append(html);
    $(".del_wy").click(function(){
        $(this).parent().parent().remove();
    })

    $("input[name='wuye_start[]']").datepicker({format: "yyyy-mm-dd"});
    $("input[name='wuye_end[]']").datepicker({format: "yyyy-mm-dd"});
    });

    //取暖费
    $("input[name='add_qunuan']").on("click",function(e){
    //alert("11");
    //$(this).parent().css({"color":"red","border":"2px solid red"});
    html='<div><label class="control-labela label1">取暖费</label><label class="control-labela" style="margin-right:20px;">'+
    '<input name="qunuan_money[]" value="" type="text" class="span12 m-wrap"/>'+'</label><div class="controls" style="margin-bottom:10px">'+
    '<input name="qunuan_start[]" value="" type="text" class="span3 m-wrap date-picker"/>&nbsp;至&nbsp;'+
    '<input name="qunuan_end[]"  value="" type="text"class="span3 m-wrap date-picker"/>'+'<input  type="button" class="span1 m-wrap del_qunuan" value="删除"/>'+
    '</div></div>';
    $(".qunuan").append(html);
    $(".del_qunuan").click(function(){
        $(this).parent().parent().remove();
    })

    $("input[name='qunuan_start[]']").datepicker({format: "yyyy-mm-dd"});
    $("input[name='qunuan_end[]']").datepicker({format: "yyyy-mm-dd"});
    });

</script>
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
<script>
    $(function(){
        $(".delcqr").eq(0).hide();
        $(".delcqr").click(function(){
            $(this).parent().parent().remove();
        });
        $(".addcqr").click(function(){ 
            var html = $("#chengzu").clone();
            $("#zuren").append(html)
            $("#zuren").find(".delcqr").show();
            $("#zuren").find(".addcqr").hide();
            $(".delcqr").click(function(){
                $(this).parent().parent().parent().remove();
            })
        })
    })    
</script>
<script>
    $(function(){
        $(".del_deposit").eq(0).hide();
        $(".del_deposit").click(function(){
            $(this).parent().parent().remove();
        })
        $(".tj").click(function(){ 
            var html = $("#pay_clone").clone();
            $(".tj-box").append(html)
            $(".tj-box").find(".del_deposit").show();
            $(".tj-box").find(".tj").hide();
            $(".del_deposit").click(function(){
            $(this).parent().parent().parent().remove();
        })
        $("input[name='deposit_start_time[]']").datepicker({format: "yyyy-mm-dd"});
        $("input[name='deposit_end_time[]']").datepicker({format: "yyyy-mm-dd"});
        })
    })
</script>

<script>
    $(function(){
        $(".del_free").eq(0).hide();
        $(".del_free").click(function(){
            $(this).parent().parent().remove();
        })
        $(".add_free").click(function(){ 
            var html = $("#free_clone").clone();
            $(".free-box").append(html)
            $(".free-box").find(".del_free").show();
            $(".free-box").find(".add_free").hide();
            $(".del_free").click(function(){
            $(this).parent().parent().parent().remove();
        })
    $("input[name='free_lease_start[]']").datepicker({format: "yyyy-mm-dd"});
    $("input[name='free_lease_end[]']").datepicker({format: "yyyy-mm-dd"});
        })
    })
</script>
<script>
    $("#invoice").click(function(){
        if($("#invoice").attr("checked") == "checked"){
            $(".invoice_s").show();
        }else{
            $(".invoice_s").hide();
        }
    })
    if($("#invoice").attr("checked") == "checked"){
            $(".invoice_s").show();
        }else{
            $(".invoice_s").hide();
    }
</script>