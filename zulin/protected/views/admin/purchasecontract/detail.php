<style>
    .control-group{margin-bottom:0px !important;margin-top:10px;padding-bottom: 10px !important;}
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
    <!-- BEGIN PAGE LEVEL STYLES -->
    <?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
    ?>
    <!-- END PAGE LEVEL STYLES -->
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
    ?>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/cms_purchase_contract.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_purchase_contract.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/bootstrap-datepicker.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.inputmask.bundle.min.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();
    FormComponents.init();
    ");
    ?>
    <!-- END PAGE LEVEL SCRIPTS -->

    <div class="page-content">

    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

    <div id="portlet-config" class="modal hide">

    <div class="modal-header">

    <button data-dismiss="modal" class="close" type="button"></spanutton>

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

    <div class="caption"><i class="icon-reorder"></i>收房合同-详情</div>

    <div class="tools">
    </div>

    </div>

    <div class="portlet-body form">



    <!-- BEGIN FORM-->
    <form action="/admin/purchasecontract/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
    <input type="hidden" name="id" value="<?php echo $model->id ?>">
    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
    <div class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></spanutton>
        输入格式有误，请检查输入的数据.
    </div>
    <div class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></spanutton>
        数据输入验证成功!
    </div>
    <div class="yj-xg-btn" style="margin:30px auto;">
        <div><a href="javascript:void(0)">品牌信息</a></div>
        <div><a href="javascript:void(0)">交易人信息</a></div>
        <div><a href="javascript:void(0)">租期信息</a></div>
        <div><a href="javascript:void(0)">签约信息</a></div>
    </div>
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
                <div class="control-group"  style="float:left">
                    <label class="control-label">签约面积<span class="required">*</span></label>
                    <div class="controls">
                        <?php echo CmsPurchaseProperty::model()->find("contract_id = '$contract_id' and property_id = '$value[property_id]' ")->area ?>㎡
                    </div>
                </div>

                <div class="control-group"  style="float:left">
                    <label class="control-label">房本面积<span class="required">*</span></label>
                    <div class="controls">
                        <?php echo CmsPurchaseProperty::model()->find("contract_id = '$contract_id' and property_id = '$value[property_id]' ")->house_area ?>㎡
                    </div>
                </div>

        </div>
        <?php endforeach ?>
        </div>

      <div class="yj-xg-xbox"  style="display:none">
            <div class="xxk-lp-1">
                <div class="control-group">
                    <label class="control-label">承租人<span class="required">*</span></label>
                    <div class="controls">
                        <?php echo $model->lessee ?>
                    </div>
                </div>
                 <div class="control-group">
                        <label class="control-label">车主类型</label>
                        <div class="controls">
                                <?php echo $model==null?"":$model->owner_type=="1"?"公司":""; ?> 
                                <?php echo $model==null?"":$model->owner_type=="2"?"个人":""; ?> 
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

                <!-- 公司 -->
                 <div id="company" style="<?php echo $model->owner_type==1?"":"display:none;"; ?>">

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
                               <?php $item = CmsCompany::model()->find("contract_id = '$model->id'"); echo $item['contractor_gender']?$item['contractor_gender']=='m'?"男":'女':''?>
                        </div>
                    </div>
                        <style>
                            .control-labela{float:left;line-height:34px;text-align:right}
                            .label1{margin:0px 15px;}
                            .label2{width:500px;}
                        </style>

                           

                        <div class="control-group" style="clear:both;margin-top:125px;">
                            <label class="control-label">营业执照</label>
                            <div class="controls">
                                <label class="control-labela label1">备注</label>
                                <label class="control-labela label2">
                                    <?php echo $model->business_license_text ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group1" style="margin-left:100px;clear:both;overflow:auto;">
                            <div class="controls1">
                                <div id="business_license_photo_div" style="float:left;100%;height:200px;<?php echo $business_license_photo==null?'display:none;':''; ?>">
                                 <img name="business_license_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                      <ul class="docs-pictures clearfix">
                                        <?php if ($business_license_photo):?>
                                            <?php foreach ($business_license_photo as $key => $value):?>
                                                 <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="control-group" style="clear:both;">
                            <label class="control-label">法人证件</label>
                            <div class="controls">
                                <label class="control-labela label1">备注</label>
                                <label class="control-labela label2">
                                    <?php echo $model->corporation_text ?>
                                </label>
                            </div>
                        </div>
                        <div class="control-group1" style="margin-left:100px;overflow:auto;">
                            <div class="controls1">
                                <div id="corporation_photo_div" style="float:left;100%;height:200px;<?php echo $corporation_photo==null?'display:none;':''; ?>">
                                <img name="corporation_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
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
                    <div id="personal" style="<?php echo $model->owner_type==2?"":"display:none;"; ?>">
                       
				<?php $owner1=CmsPurchaseContractOwner::model()->findAll("contract_id='$model->id' and type=1");
					if($owner1){
						foreach($owner1 as $key => $value){
                            $id=$value['owner_id'];
                            $owner3=CmsOwner::model()->find("id='$id'");
				?>     
                    <div id="chanquan">
                        <div class="control-group inputcss" style="clear:both;float:left;">
                            <label class="control-label">产权人</label>
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
                <div id="quanren"></div>                                    
					<?php }
                       ?>
                    <?php 
					}else{
					?>
                        <?php }?>
                    <div style="clear:both"></div>
                        <!-- 以上为产权人 -->

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
                                        <?php echo  $owner->gender?$owner->gender=='m'? '男':'女':'' ?>
                                </div>
                            </div>
						<?php }
							}else{
						?>
						<?php
							}
						?>
                        <div style="clear:both"></div>
                        <div class="control-group" style="clear:both;margin-top:70px;">
                    
                            <label class="control-label">产权人身份证复印件</label>
                            <div class="controls">
                                <label class="control-labela label1">备注</label>
                                <label class="control-labela label2">
                                    <?php echo $model->id_card_text ?>
                                </label>
                            </div>
                        </div>

                        <div class="control-group1" style="margin-left:100px;overflow:auto;">
                            <div class="controls1">
                                <div id="id_card_photo_div" style="float:left;100%;height:200px;<?php echo $id_card_photo==null?'display:none;':''; ?>">
                                <div>
                                    <img name="id_card_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                </div>
                                <ul class="docs-pictures clearfix">
                                    <?php if ($id_card_photo): ?>
                                        <?php foreach ($id_card_photo as $key => $value): ?>
                                                <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="control-group" style="clear:both;">
                        <label class="control-label">房产证</label>
                        <div class="controls">
                            <label class="control-labela label1">备注</label>
                            <label class="control-labela label2">
                             <?php echo $model->house_property_card_text1 ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group1" style="margin-left:100px;overflow:auto;">
                        <div class="controls1">
                            <div id="house_property_card_photo_div" style="float:left;100%;height:200px;<?php echo $house_property_card_photo==null?'display:none;':''; ?>">
                                <ul class="docs-pictures clearfix">
                                    <?php if ($house_property_card_photo): ?>
                                        <?php foreach ($house_property_card_photo as $key => $value): ?>
                                                <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="control-group" style="margin-left:196px;clear:both;margin-top:80px;">
                        <?php
                           // $model->house_property_card_text;
                            $house_property_card_text=explode(",",$model->house_property_card_text);
                            foreach($house_property_card_text as $key => $value){
                        ?>
                        <p>
                        <label class="control-labela label1">详细地址</label>
                        <label class="control-labela label2" style="text-align:left;">
                            <?php echo $value?>
                        </label>
                        </p>
                        <?php
                            }
                        ?>
                     <p style='text-align:left;margin-left:85px;' class="house_text"></p>
                    </div>
                    <div class="control-group" style="clear:both;">
                        <label class="control-label">不动产授权委托书</label>
                        <div class="controls">
                            <label class="control-labela" style="text-align: left;">
                                <span id="PlaceHolder_immovable_authorisation_photo"></span>
                            </label>
                           <label class="control-labela label1">备注</label>
                                <label class="control-labela label2">
                                <?php echo $model->immovable_authorisation_text ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group1" style="margin-left:100px;overflow:auto;">
                        <div class="controls1">
                            <div class="upload_progress">
                                <span class="localname"></span>
                            </div>
                            <div class="fieldset flash" id="fsUploadProgress_immovable_authorisation_photo">
                                <span class="legend"></span>
                            </div>
                            <div id="immovable_authorisation_photo_div" style="float:left;100%;height:200px;<?php echo $immovable_authorisation_photo==null?'display:none;':''; ?>">
                             <img name="immovable_authorisation_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                <ul class="docs-pictures clearfix">
                                    <?php if ($immovable_authorisation_photo): ?>
                                        <?php foreach ($immovable_authorisation_photo as $key => $value): ?>
                                                <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value; ?>" src="<?php echo $value; ?>" style="" alt="Picture"></li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </ul>

                            </div>
                        </div>
                    </div>


                    <div class="control-group" style="clear:both;">
                        <label class="control-label">车主授权代理人委托书</label>
                        <div class="controls">
                           <label class="control-labela label1">备注</label>
                                <label class="control-labela label2">
                                <?php echo $model->accredited_representative_text ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group1" style="margin-left:100px;overflow:auto;">
                        <div class="controls1">
                            <div id="accredited_representative_photo_div" style="float:left;100%;height:200px;<?php echo $accredited_representative_photo==null?'display:none;':''; ?>">
                            <img name="accredited_representative_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
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
                    <div class="control-group"  style="clear:both;">
                        <label class="control-label">委托人身份证复印件</label>
                        <div class="controls">
                           <label class="control-labela label1">备注</label>
                                <label class="control-labela label2">
                                <?php echo $model->authorized_id_card_text ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group1" style="margin-left:100px;">
                        <!-- <label class="control-label">委托人身份证复印件</label> -->
                        <div class="controls1">
                            <div id="authorized_id_card_photo_div" style="float:left;100%;height:200px;<?php echo $authorized_id_card_photo==null?'display:none;':''; ?>">
                             <img name="authorized_id_card_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
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

                    <div class="control-group" style="clear:both;">
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
                            <div id="house_delivery_order_photo_div" style="float:left;100%;height:200px;<?php echo $house_delivery_order_photo==null?'display:none;':''; ?>">
                            <img name="house_delivery_order_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
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

            </div>
                    <div class="control-group" style = "clear:both;float:left;">
                        <label class="control-label">所有证件<span class="required">*</span></label>
                        <div class="controls">
                            <?php echo $model->papers_ok==1?'全':'';?>
                            <?php echo $model->papers_ok==0?'不全':'';?>
                        </div>
                    </div>
      </div>
      <div class="yj-xg-xbox"  style="display:none">
                    <div class="xxk-lp-1">
                        <p style="font-size:20px;margin:30px 50px;font-weight:bold;margin-left:18px;">租期信息</p>
                        <div class="control-group inputcss">
                            <label class="control-label">免租方式<span class="required">*</span></label>
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
                                    <label class="control-label">免租期<span class="required">*</span></label>
                                    <div class="controlss">
                                        <?php echo $value->start_time?date('Y-m-d',$value->start_time):"";?>&nbsp;至&nbsp;<?php echo $value->end_time?date('Y-m-d',$value->end_time):"";?>
                                    </div>
                                </div>
                            </div>        
                                <?php }?>
                        <?php
                            }else{
                        ?> 
                        <p style="font-size:14px;margin:30px 50px;">免租期</p>
                        
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
                                    <span>月租金</span>&nbsp;<?php echo $value->monthly_rent?$value->monthly_rent/100:""?>(元)
                                    <span>单价</span>&nbsp;<?php echo $value->price_per_meter?$value->price_per_meter/100:""?>(元/天/㎡)
                                    <?php if ($value->increasing_mode==1){?>
                                        <span>递增方式</span>&nbsp;<?php echo $value->increasing_number?$value->increasing_number:""?>
                                    <?php }elseif ($value->increasing_mode==2) {
                                    ?>
                                        <span>递增方式</span>&nbsp;<?php echo $value->increasing_number?$value->increasing_number/100:""?>
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
                            <div class="control-group " style="float:left;margin-left:0px;">
                                <label class="control-label">付<span class="required">*</span></label>
                                <div class="controls" style="width:30px;">
                                    <?php echo $value->pay_month;?>
                                </div>
                            </div>
                            <div class="control-group " style="float:left;">
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
                    <div style="" style="float:left;">                    
                        <div style="" class="tj-3y" style="float:left;" >
                            <div class="control-group" style="width:150px;">
                                <label class="control-label">物业费</label>
                                <div class="controls">
                                    <input type="checkbox" name="property_fee" <?php echo $model->property_fee==1?"checked":""; ?> />
                                </div>
                            </div>
                            <div class="control-group" style="width:150px;">
                                <label class="control-label">取暖费</label>
                                <div class="controls">
                                    <input type="checkbox" name="heating_fee" <?php echo $model->heating_fee==1?"checked":""; ?> />
                                </div>
                            </div>
                            <div class="control-group" style="width:150px;">
                                <label class="control-label" style="width:80px">制冷</label>
                                <div class="controls">
                                    <input type="checkbox" name="cool" <?php echo $model->cool==1?"checked":""; ?> />
                                </div>
                            </div>
                            <div class="control-group" style="width:150px;">
                                <label class="control-label">发票</label>
                                <div class="controls">
                                    <input type="checkbox" id="invoice" name="invoice" <?php echo $model->invoice==1?"checked":""; ?> />
                                </div>
                            </div>
                            <div class="control-group" style="width:150px;">
                                <label class="control-label">其它</label>
                                <div class="controls">
                                    <input type="checkbox" id="other" name="other" <?php echo $model->other==1?"checked":""; ?> />
                                </div>
                            </div>
                            <script>
                            $(function(){
                                if($("#other").attr("checked") == "checked"){
                                        $(".property_memo").show();
                                }
                                $("#other").click(function(){
                                    if($("#other").attr("checked") == "checked"){
                                        $(".property_memo").show();
                                    }else{
                                        $(".property_memo").hide();
                                    }
                                })                                
                            })
                            </script>
                            <div class="control-group property_memo " style="float:left;display:none;">
                                <label class="control-label">备注</label>
                                <div class="controls">
                                    <?php echo $model->property_memo; ?>
                                </div>
                            </div>
                        </div>

                        <?php if ($model->invoice==1): ?>
                            <div class="control-group invoice_s " style="float:left;">
                                <label class="control-label">税率</label>
                                <div class="controls">
                                    <?php echo $model==null?"":$model->tax_rate==0?"":$model->tax_rate/100;?>%
                                </div>
                            </div>
                            <div class="control-group invoice_s " style="float:left;">
                                <label class="control-label">税金金额</label>
                                <div class="controls">
                                    <?php echo $model==null?"":$model->tax/100==0?"":$model->tax/100;?>元/月
                                </div>
                            </div>                            
                        <?php endif ?>

                        </div>
                        <div class="control-group inputcss" style="float:left;clear:both;">
                            <label class="control-label" style="width:100px;">总应付租金</label>
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
       <div class="yj-xg-xbox"  style="display:none">
            <div class="xxk-lp-1">
                    <p style="font-size:20px;margin:30px 50px;font-weight:bold;">签约信息</p>
                    <div class="yj-qy-xx">
                          <div class="control-group">
                            <label class="control-label" >幼狮签约人<!-- 司公业务员ID（） --></label>
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
                                <label class="control-label" style="width:90px">客服收房日</label>
                                <div class="controls">
                                    <?php echo $model->the_date?date('Y-m-d',$model->the_date):""?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" style="width:90px">客服收房人<!-- 公司业务员ID（） --></label>
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
                                                if ($key<5||$key==8){
                                            ?>
                                            <?php echo $model->status==$key? "$value":""?>
                                                <?php 
                                            }
                                                ?>
                                        <?php
                                        }?>
                                </div>
                            </div>
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

        </div>
    </div>
    <script>
        $(function(){
            $(".yj-xg-xbox").eq(0).css({display:"block"})
            $(".yj-xg-btn div").click(function(){
                var index=$(".yj-xg-btn div").index(this)
                $(".yj-xg-xbox").css({display:"none"}).eq(index).css({display:"block"})
            })
            $('.yj-xg-btn').children('div').click(function(){
                $('.yj-xg-btn').children('div').css('background','white');
                $('.yj-xg-btn').children('div').children('a').css('color','blue');
                $(this).css('background','#0160cb');
                $(this).children('a').css('color','white');
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

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></spanutton>

    <h3 id="myModalLabel2">错误</h3>

    </div>

    <div class="modal-body">

    <p>Body goes here...</p>

    </div>

    <div class="modal-footer">

    <button data-dismiss="modal" class="btn green">OK</spanutton>

    </div>

    </div>
    <style>
    .theFont{font-size: 20px;}
    </style>

    <script>
        $(function(){
            $('.img').wrap(function(){
            return '<a href="' + this.src + '" title="' + this.alt + '"></a>';
            })
        })

    </script>

    <script>

    $("input[name='owner_type']").click(function(){
    if($(this).val()==1){
    $("#company").show();
    $("#personal").hide();
    }
    else{
    $("#company").hide();
    $("#personal").show();
    }
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
    options+="<option value=''></option>";
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

    <?php
    if ($model->channel_id && $model->channel_manager_id){
    ?>
    $.ajax("/admin/ajax/getchannelmanager", {
    data: {
    id:'<?php echo $model->channel_id?>'
    },
    dataType: "json"
    }).done(function (data) {
    var options="";
    if(data.length>0){
    options+="<option value=''></option>";
    for(var i=0;i<data.length;i++){
    if (data[i].id=="<?php echo $model->channel_manager_id?>"){
    options+="<option value="+data[i].id+" selected>"+data[i].title+"</option>";
    }
    else{
    options+="<option value="+data[i].id+" > "+data[i].title+"</option>";
    }
    }
    $("select[name='channel_manager_id']").html(options);
    }
    });
    <?php
    }
    ?>

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
    $(".del_free").click(function(){
        $(this).parent().remove();
    })

    $("button[id='add_property']").live("click",function(e){
    mores =$('.select').clone();
    mores.removeClass('select');
    mores.show();
    mores.addClass('more');
    nummore =$('.more');
    mores.find("#area").attr('id','area'+nummore.length);
    mores.find("#room_type").attr('id','room_type'+nummore.length);
    mores.find("#property_id").attr('id','property_id'+nummore.length);


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
<!-- 图片删除 -->




