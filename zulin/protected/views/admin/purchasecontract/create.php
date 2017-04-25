<style>
    .control-group label{font-size:13px!important;font-weight: normal;}
    .inputcss{margin-left:3px;margin-top: -24px;}
    .inputcss label{width: 80px!important;}
    .date-picker{width:171px!important;}
    .inputcss div>input{width:200px;}
    .inputcss div>select{width:200px;}
    p{margin-left:50px;}
    #a{height:30px!important;margin-top:-24px;margin-left:-5px;}
    #b{height:30px!important;margin-top:-24px;margin-left:-5px;}
    #c{height:30px!important;margin-top:-24px;margin-left:-5px;}
    #d{height:30px!important;margin-top:-24px;margin-left:-5px;}
    #e{height:30px!important;margin-top:-24px;margin-left:-5px;}
    #g{height:30px!important;margin-top:-24px;margin-left:-5px;}
    #f{height:30px!important;margin-top:-24px;margin-left:-5px;}
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

<!-- BEGIN PAGE LEVEL SCRIPTS -->;
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/cms_purchase_contract.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_purchase_contract.js',CClientScript::POS_END);
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

                <div class="caption"><i class="icon-reorder"></i>收房合同-新增</div>

            </div>

            <div class="portlet-body form">

                <!-- BEGIN FORM-->
                <form action="/admin/purchasecontract/createsave" id="form_create"  method="post"  class="form-horizontal js-submit">

<div class="xxk-lp-1" style="display:none">
    <div class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        输入格式有误，请检查输入的数据.
    </div>
    <div class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></button>
        数据输入验证成功!
    </div>
    <div id="propertys">
        <div class="control-group" style="float:left;">
            <label class="control-label">品牌<span class="required">*</span></label>
            <div class="controls">
                <input type="hidden" name="estate_id[]" id="estate_id" class="span4 select2" style="width:230px">
            </div>
        </div>
        <div class="control-group" style="float:left">
            <label class="control-label">系列<span class="required">*</span></label>
            <div class="controls">
                <input type="hidden" name="building_id[]" id="building_id" class="span4 select2" style="width:230px">
            </div>
        </div>
        <div class="control-group" style="float:left">
            <label class="control-label">编号<span class="required">*</span></label>
            <div class="controls">
                <input type="hidden" name="room_number[]" id="room_number" class="span4 select2" style="width:230px">
                <input type="hidden" name="property_id[]" id="property_id">
            </div>
        </div>
            <br>
            <br>
            <br>
        <div class="control-group" style="float:left;clear:both;">
            <label class="control-label">车源类型</label>
            <div class="controls">
                <select name="room_type[]" id="room_type" >
                    <option value=""></option>
                    <option value="1">轿车</option>
                    <option value="2">客车</option>
                    <option value="3">SUV</option>
                    <option value="4">商务</option>
                </select>
            </div>
        </div>
        <div class="control-group" style="float:left">
            <label class="control-label">签约面积<span class="required">*</span></label>
            <div class="controls">
                <input name="area[]" id="area" type="text" placeholder="单位㎡" class="span6 m-wrap"/><label class="radio">㎡</label>
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">房本面积<span class="required">*</span></label>
            <div class="controls">
                <input name="house_area[]" id="area<?php echo $key?>" value="<?php echo CmsPurchaseProperty::model()->find("contract_id = '$contract_id' and property_id = '$value[property_id]' ")->house_area ?>"  type="text" placeholder="单位㎡" class="span6 m-wrap"/><label class="radio">㎡</label>
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">产权证编号<span class="required">*</span></label>
            <div class="controls">
                <input name="property_card[]"  value=""  type="text" placeholder="" style="width:250px!important" class="span80 m-wrap"/>
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">车源地址<span class="required">*</span></label>
            <div class="controls">
                <input name="property_address[]"  value=""  type="text" placeholder="" style="width:250px!important" class="span80 m-wrap"/>
            </div>
        </div>
         <br>
         <br>
         <br>
    </div>
    <div style="display:none;clear:both;" class="select">
        <div class="control-group"  style="float:left">
            <label class="control-label">品牌<span class="required">*</span></label>
            <div class="controls">
                <input type="hidden" name="estate_id[]" id="estate_id" class="span4 select2 estate" style="width:230px">
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">系列<span class="required">*</span></label>
            <div class="controls">
                <input type="hidden" name="building_id[]" id="building_id" class="span4 select2 building" style="width:230px">
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">编号<span class="required">*</span></label>
            <div class="controls">
                <input type="hidden" name="room_number[]" id="room_number" class="span4 select2 room" style="width:230px">
                <input type="hidden" name="property_id[]" id="property_id">
            </div>
        </div>
            <br>
            <br>
            <br>
        <div class="control-group" style="float:left;clear:both;">
            <label class="control-label">车源类型</label>
            <div class="controls">
                <select name="room_type[]" id="room_type" >
                    <option value=""></option>
                    <option value="1">轿车</option>
                    <option value="2">客车</option>
                    <option value="3">SUV</option>
                    <option value="4">商务</option>
                </select>
            </div>
        </div>

        <div class="control-group"  style="float:left">
            <label class="control-label">面积<span class="required">*</span></label>
            <div class="controls">
                <input name="area[]" id="area"  type="text" placeholder="单位㎡" class="span6 m-wrap"/><label class="radio">㎡</label>
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">房本面积<span class="required">*</span></label>
            <div class="controls">
                <input name="house_area[]" id="area<?php echo $key?>" value="<?php echo CmsPurchaseProperty::model()->find("contract_id = '$contract_id' and property_id = '$value[property_id]' ")->house_area ?>"  type="text" placeholder="单位㎡" class="span6 m-wrap"/><label class="radio">㎡</label>
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">产权证编号<span class="required">*</span></label>
            <div class="controls">
                <input name="property_card[]"  value=""  type="text" placeholder="" style="width:250px!important" class="span80 m-wrap"/>
            </div>
        </div>
        <div class="control-group"  style="float:left">
            <label class="control-label">车源地址<span class="required">*</span></label>
            <div class="controls">
                <input name="property_address[]"  value=""  type="text" placeholder="" style="width:250px!important" class="span80 m-wrap"/>
            </div>
        </div>
         <br>
         <br>
         <br>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="control-group">
        <div class="controls">
            <button id='add_property' type="button" class="btn btn-primary">添加车源</button>
            <button id='del_property' type="button" class="btn red">删除车源</button>
        </div>
    </div>
</div>
    <!-- ////////////////////////////// 以上为品牌添加 -->
<div class="xxk-lp-1" style="display:none">
        <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            输入格式有误，请检查输入的数据.
        </div>
        <div class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            数据输入验证成功!
        </div>
        <div class="control-group" style="margin-top:20px;">
            <label class="control-label">承租人<span class="required">*</span></label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" name="lessee2" value="华溯商贸" />
                    华溯商贸
                </label>
                <label class="radio">
                    <input type="radio" name="lessee2" value="幼狮科技" />
                    幼狮科技
                </label>
                <label class="radio">
                    <input type="radio" name="lessee2" value="其它" />
                    其它
                </label>
                    <input name="lessee" type="text" style="display:none" class="span2 m-wrap"/>
            </div>
        </div>
        <div class="control-group">
                <label class="control-label">车主类型</label>
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="owner_type" value="1"  />
                        公司
                    </label>
                    <label class="radio">
                        <input type="radio" name="owner_type" value="2" checked/>
                        个人
                    </label>
                </div>
        </div>
        <div class="control-group inputcss" style="float:left;">
            <label class="control-label">收款人</label>
            <div class="controls">
                <input type="text" name="payee" value="">
            </div>
        </div>
        <div class="control-group inputcss" style="float:left;">
            <label class="control-label">开户行</label>
            <div class="controls">
                <input type="text" name="bank" value="">
            </div>
        </div>
        <div class="control-group inputcss" style="float:left;">
            <label class="control-label">账号</label>
            <div class="controls">
               <input type="text" name="bank_account" onkeyup="this.value=this.value.replace(/\D/g,'').replace(/....(?!$)/g,'$& ')" />
            </div>
        </div>
        <div style="clear:both;"></div>


        <div id="company" style="display:none;">
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">公司名称</label>
                <div class="controls">
                   <input type="text" name="company_name" value="">
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">法人姓名</label>
                <div class="controls">
                   <input type="text" name="corporation" value="">
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">身份证号</label>
                <div class="controls">
                    <input type="text" name="corporation_id_card" value="">
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">性别</label>
                <div class="controls">
                   <label class="radio">
                        <input type="radio" name="corporation_gender" value="m"  />
                        男
                    </label>
                    <label class="radio">
                        <input type="radio" name="corporation_gender" value="f"  />
                        女
                    </label>
                </div>
            </div>

            <div class="control-group inputcss" style="clear:both;float:left;">
                <label class="control-label">签约人姓名</label>
                <div class="controls">
                    <input type="text" name="contractor" value="" >
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">身份证号</label>
                <div class="controls">
                    <input type="text" name="contractor_id_card" value="" >
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">手机号</label>
                <div class="controls">
                    <input type="text" name="contractor_phone" value="" >
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">性别</label>
                <div class="controls">
                    <label class="radio">
                        <input type="radio" name="contractor_gender" value="m" />
                        男
                    </label>
                    <label class="radio">
                        <input type="radio" name="contractor_gender" value="f" />
                        女
                    </label>
                </div>
            </div>

                <style>
                    .control-labela{float:left;line-height:34px;text-align:right}
                    .label1{margin:0px 15px;}
                    .label2{width:500px;}
                </style>
                <p style="clear:both;float:left;">
                         注：如果证件齐全了，请勾选上“新增图片”按钮前方的勾选项。
                </p>
                <div class="control-group" style="margin-top:60px;clear:both;">
                    <label class="control-label">营业执照</label>
                    <div class="controls">
                        <label class="control-labela" style="text-align: left;">
                            <input type="checkbox" name="business_license" />
                            <input type="hidden" name="business_license_photo" />
                            <span id="PlaceHolder_business_license_photo"></span>
                             <input type="button" class="btn red" value="编辑图片" id="a">
                        </label>
                        <label class="control-labela label1">备注</label>
                        <label class="control-labela label2">
                             <input name="business_license_text" type="text" class="span12 m-wrap" style="width:400px;"/>
                        </label>
                    </div>
                </div>
                <div class="control-group" style="margin:0;">
                    <div class="controls">
                        <div class="upload_progress">
                            <span class="localname"></span>
                        </div>
                        <div class="fieldset flash" id="fsUploadProgress_business_license_photo">
                            <span class="legend"></span>
                        </div>
                        <div id="business_license_photo_div" style="float:left;100%;height:200px;display: none;">
                          <img name="business_license_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                        </div>
                    </div>
                </div>

                <div class="control-group" style="margin-top:30px;">
                    <label class="control-label">法人证件</label>
                    <div class="controls">
                        <label class="control-labela" style="text-align: left;">
                            <input type="checkbox" name="corporation_pic" />
                            <input type="hidden" name="corporation_photo" />
                            <span id="PlaceHolder_corporation_photo"></span>
                            <input type="button" class="btn red" value="编辑图片" id="b">
                        </label>
                        <label class="control-labela label1">备注</label>
                        <label class="control-labela label2">
                            <input name="corporation_text" type="text" class="span12 m-wrap" style="width:400px;"/>
                        </label>
                    </div>
                </div>
                <div class="control-group" style="margin:0;">
                    <div class="controls">
                        <div class="upload_progress">
                            <span class="localname"></span>
                        </div>
                        <div class="fieldset flash" id="fsUploadProgress_corporation_photo">
                            <span class="legend"></span>
                        </div>
                        <div id="corporation_photo_div" style="float:left;100%;height:200px;display: none;">
                            <img name="corporation_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                        </div>
                    </div>
                </div>
        </div>


        <div id="personal">

            <div id="chanquan">
                <div class="control-group inputcss" style="float:left;clear:both;">
                    <label class="control-label">产权人</label>
                    <div class="controls">
                        <input name="owner[]" type="text" value="" />
                    </div>
                </div>

                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">联系方式</label>
                    <div class="controls">
                        <input name="owner_phone[]" type="text" value="" />
                    </div>
                </div>

                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">身份证号</label>
                    <div class="controls">
                        <input name="owner_id_card[]" type="text" value="" />
                    </div>
                </div>

                <div class="control-group inputcss" style="float:left;">
                    <label class="control-label">性别</label>
                    <div class="controls">
                        <select name="owner_gender[]" style="width:60px;"><option></option>
                            <option value="m">男</option>
                            <option value="f">女</option>
                        </select>
                        <input type="button" value="添加" style="width:60px;" class="span1 m-wrap addcqr" >
                        <input type="button" value="删除" style="width:60px;" class="span1 m-wrap delcqr" >
                    </div>
                </div>
            </div>

            <div id="quanren"></div>

            <div class="control-group inputcss" style="clear:both;float:left;">
                <label class="control-label">代理人</label>
                <div class="controls">
                    <input name="agent" type="text" value="" />
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">联系方式</label>
                <div class="controls">
                    <input type="text" name="agent_phone" value="">
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">身份证号</label>
                <div class="controls">
                    <input type="text" name="agent_id_card" value="">
                </div>
            </div>
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">性别</label>
                <div class="controls">
                    <select name="agent_gender" style="width:60px;" ><option></option>
                        <option value="m" >男</option>
                        <option value="f" >女</option>
                    </select>
                </div>
            </div>
            <div style="clear:both"></div>
            <p style="clear:both;float:left;">
                     注：如果证件齐全了，请勾选上“新增图片”按钮前方的勾选项。
            </p>

        </div>



        <div class="control-group" style="margin-top:30px;">
            <label class="control-label">产权人身份证复印件</label>
            <div class="controls">
                <label class="control-labela" style="text-align: left;">
                    <input type="checkbox" name="id_card" />
                    <input type="hidden" name="id_card_photo" />
                    <span id="PlaceHolder_id_card_photo"></span>
                     <input type="button" class="btn red" value="编辑图片" id="c">

                </label>
                <label class="control-labela label1">备注</label>
                <label class="control-labela label2">
                    <input name="id_card_text" type="text" class="span12 m-wrap" style="width:400px;"/>
                </label>
            </div>
        </div>
        <div class="control-group" style="margin:0;">
            <div class="controls">
                <div class="upload_progress">
                    <span class="localname"></span>
                </div>
                <div class="fieldset flash" id="fsUploadProgress_id_card_photo">
                    <span class="legend"></span>
                </div>

                <div id="id_card_photo_div" style="float:left;100%;height:200px;display: none;">
                    <img name="id_card_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                </div>
            </div>
        </div>

        <div class="control-group" style="margin-top:30px;">
            <label class="control-label">房产证</label>
            <div class="controls">
                <label class="control-labela" style="text-align: left;">
                    <input type="checkbox" name="house_property_card" />
                    <input type="hidden" name="house_property_card_photo" />
                    <span id="PlaceHolder_house_property_card_photo"></span>
                    <input type="button" class="btn red" value="编辑图片" id="d">

                </label>
                <label class="control-labela label1">备注</label>
                <label class="control-labela label2">
                   <input name="house_property_card_text1"  type="text" class="span12 m-wrap" style="width:400px;"/>
                </label>
            </div>
        </div>
        <div class="control-group" style="margin:0;">
            <div class="controls">
                <div class="upload_progress">
                    <span class="localname"></span>
                </div>
                <div class="fieldset flash" id="fsUploadProgress_house_property_card_photo">
                    <span class="legend"></span>
                </div>

                <div id="house_property_card_photo_div" style="float:left;100%;height:200px;display: none;">
                    <img name="house_property_card_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                </div>
            </div>
        </div>
        <!-- <div class="control-group" style="margin-top:80px;">
            <label class="control-labela label1">详细地址</label>
            <label class="control-labela label2" style="text-align: left; ">
                <input name="house_property_card_text[]" placeholder="详细地址" type="text"  class="span12 m-wrap"/>
            </label>
            <label class="control-labela">
                <input type="button" value="添加" style="width:60px;margin-top:-2px;" class="span1 m-wrap" id="h_text">
            </label>
            <br/>
            <br/>
            <label class='control-labela house_text label2' style='text-align:left;margin-left:86px;clear:both;'></label>
            <script>
                $(function(){
                    $("#h_text").click(function(){
                        var html1=$("<div style='clear:both;'></div>"+"<label  class='control-labela' style='text-align:left;'>"+"<input name='house_property_card_text[]' placeholder='详细地址' type='text' style='width:500px' class='span12 m-wrap'/>"+"<input type='button' value='删除' style='width:60px;' class='span1 m-wrap h_text_del' >"+"</label>")
                       $(".house_text").append(html1)

                       $(".h_text_del").on('click',function(){
                            $(this).parent().remove();
                        })
                    })
                })
            </script>
        </div> -->

        <div class="control-group" style="margin-top:30px;">
            <label class="control-label">不动产授权委托书</label>
            <div class="controls">
                <label class="control-labela" style="text-align: left;">
                    <input type="checkbox" name="immovable_authorisation" />
                    <input type="hidden" name="immovable_authorisation_photo" />
                    <span id="PlaceHolder_immovable_authorisation_photo"></span>
                     <input type="button" class="btn red" value="编辑图片" id="e">

                </label>
                <label class="control-labela label1">备注</label>
                <label class="control-labela label2">
                    <input name="immovable_authorisation_text" type="text" class="span12 m-wrap" style="width:400px;"/>
                </label>
            </div>
        </div>
        <div class="control-group" style="margin:0;">
            <div class="controls">
                <div class="upload_progress">
                    <span class="localname"></span>
                </div>
                <div class="fieldset flash" id="fsUploadProgress_immovable_authorisation_photo">
                    <span class="legend"></span>
                </div>
                <div id="immovable_authorisation_photo_div" style="float:left;100%;height:200px;display: none;">
                    <img name="immovable_authorisation_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                </div>
            </div>
        </div>

        <div class="control-group" style="margin-top:30px;">
            <label class="control-label">车主授权代理人委托书</label>
            <div class="controls">
                <label class="control-labela" style="text-align: left;">
                    <input type="checkbox" name="accredited_representative" />
                    <input type="hidden" name="accredited_representative_photo" />
                    <span id="PlaceHolder_accredited_representative_photo"></span>
                     <input type="button" class="btn red" value="编辑图片" id="f">

                </label>
                <label class="control-labela label1">备注</label>
                    <label class="control-labela label2">
                    <input name="accredited_representative_text" type="text" class="span12 m-wrap" style="width:400px;"/>
                </label>

            </div>
        </div>
        <div class="control-group" style="margin:0;">
            <div class="controls">
                <div class="upload_progress">
                    <span class="localname"></span>
                </div>
                <div class="fieldset flash" id="fsUploadProgress_accredited_representative_photo">
                    <span class="legend"></span>
                </div>

                <div id="accredited_representative_photo_div" style="float:left;100%;height:200px;display: none;">
                    <img name="accredited_representative_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                </div>
            </div>
        </div>

        <div class="control-group" style="margin-top:30px;">
            <label class="control-label">委托人身份证复印件</label>
            <div class="controls">
                <label class="control-labela" style="text-align: left;">
                    <input type="checkbox" name="authorized_id_card" />
                    <input type="hidden" name="authorized_id_card_photo" />
                    <span id="PlaceHolder_authorized_id_card_photo"></span>
                     <input type="button" class="btn red" value="编辑图片" id="g">

                </label>
               <label class="control-labela label1">备注</label>
                    <label class="control-labela label2">
                    <input name="authorized_id_card_text" type="text" class="span12 m-wrap" style="width:400px;"/>
                </label>
            </div>
        </div>
        <div class="control-group" style="margin:0;">
            <div class="controls">
                <div class="upload_progress">
                    <span class="localname"></span>
                </div>
                <div class="fieldset flash" id="fsUploadProgress_authorized_id_card_photo">
                    <span class="legend"></span>
                </div>

                <div id="authorized_id_card_photo_div" style="float:left;100%;height:200px;display: none;">
                    <img name="authorized_id_card_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                </div>
            </div>
        </div>

        <div class="control-group" style="margin-top:30px;">
            <label class="control-label">车源交割单</label>
            <div class="controls">
                <label class="control-labela" style="text-align: left;">
                    <input type="checkbox" name="house_delivery_order" />
                    <input type="hidden" name="house_delivery_order_photo" />
                    <span id="PlaceHolder_house_delivery_order_photo"></span>
                     <input type="button" class="btn red" value="编辑图片" id="g">

                </label>
               <label class="control-labela label1">备注</label>
                    <label class="control-labela label2">
                    <input name="house_delivery_order_text" type="text" class="span12 m-wrap" style="width:400px;"/>
                </label>
            </div>
        </div>

        <div class="control-group" style="margin:0;">
            <div class="controls">
                <div class="upload_progress">
                    <span class="localname"></span>
                </div>
                <div class="fieldset flash" id="fsUploadProgress_house_delivery_order_photo">
                    <span class="legend"></span>
                </div>

                <div id="house_delivery_order_photo_div" style="float:left;100%;height:200px;display: none;">
                    <img name="house_delivery_order_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                </div>
            </div>
        </div>


        <div class="control-group" style = "clear:both;float:left;">
            <label class="control-label">所有证件<span class="required">*</span></label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" name="papers_ok" value="1"  style="width:50px">全
                </label>
                <label class="radio">
                    <input type="radio" name="papers_ok" value="0" checked  style="width:50px">不全
                </label>
            </div>
        </div>

</div>
<div class="xxk-lp-1" style="display:none">
    <div class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        输入格式有误，请检查输入的数据.
    </div>
    <div class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></button>
        数据输入验证成功!
    </div>
    <p style="font-size:20px;margin-top:30px;margin-bottom:30px;font-weight:bold;margin-left: 18px;">添加租期信息</p>

    <div class="control-group inputcss">
        <label class="control-label">免租方式<span class="required">*</span></label>
        <div class="controls">
            <label class="radio">
                <input type="radio" name="free_type" value="1"  checked style="width:50px">期外免租
            </label>
            <label class="radio">
                <input type="radio" name="free_type" value="2"  style="width:50px">期内免租
            </label>
            <label class="radio">
                <input type="radio" name="free_type" value="3"  style="width:50px">期内期外
            </label>
        </div>
    </div>
    <div id="free_clone">
        <div class="control-group inputcss">
            <label class="control-label">免租期<span class="required">*</span></label>
            <div class="controls">
                <input name="free_lease_start[]" type="text" class="span3 m-wrap date-picker" required/>至<input name="free_lease_end[]" type="text" class="span3 m-wrap date-picker" required/>
                <input name="" type="button" class="span1 m-wrap add_free" style="width:60px;" value="添加"/>
                <input  type="button" class="span1 m-wrap del_free"        style="width:60px;" value="删除"/>
            </div>
        </div>
    </div>
    <div class="free-box"></div>

    <div class="control-group inputcss">
        <label class="control-label">租期<span class="required">*</span></label>
        <div class="controls">
            <input name="lease_term_start" class="m-wrap span3 date-picker" size="16" type="text" value="" />至<input id="lease_term_end" name="lease_term_end" class="m-wrap span3 date-picker" size="16" type="text" value="" />
            <input id="lease_term_year" name="lease_term_year" class="span1" size="16" type="text" value="" onkeyup="value=value.replace(/[^\d.]/g,'')" placeholder="数字" />年<input id="lease_term_month" name="lease_term_month" class="span1" size="16" type="text" value="" onkeyup="value=value.replace(/[^\d.]/g,'')" placeholder="数字" />月<input id="lease_term_day" name="lease_term_day" class="span1" size="16" type="text" value="" onkeyup="value=value.replace(/[^\d.]/g,'')" placeholder="数字" />日
        </div>
    </div>
    <div id="lease_term_list" style="padding-left:30px;">
    </div>

    <p style="font-size:20px;margin-top:30px;margin-bottom:30px;font-weight:bold;margin-left: 18px;">添加付款信息</p>
    <div id="pay_clone">
        <div class="control-group inputcss" style="margin-left:-10px;float:left;clear:both;">
            <label class="control-label">押<span class="required" >*</span></label>
            <div class="controls">
                <input type="text" name="deposit_month[]" style="width:25px" value="" placeholder="数字" onkeyup="value=value.replace(/[^\d.]/g,'')">
            </div>
        </div>
        <div class="control-group inputcss" style="float:left;margin-left:-10px;">
            <label class="control-label">付<span class="required" >*</span></label>
            <div class="controls">
                <input type="text"  name="pay_month[]" style="width:25px" value="" placeholder="数字" onkeyup="value=value.replace(/[^\d.]/g,'')">
            </div>
        </div>
        <div class="control-group inputcss" style="float:left;">
            <label class="control-label">日期区间<span class="required">*</span></label>
            <div class="controls">
                <input name="deposit_start_time[]" type="text" class="span3 m-wrap date-picker"/ style="width:171px" value="" >至<input name="deposit_end_time[]" type="text" class="span3 m-wrap date-picker"  style="width:171px" value=""/>
                <input  type="button" style="width:60px;" class="span1 m-wrap del_deposit" value="删除"/>
                <input  type="button" style="width:60px;" class="span1 m-wrap tj"  value="添加"/>
            </div>
        </div>
    </div>
    <div class="tj-box"></div>

    <div class="control-group inputcss" style="float:left;clear:both;width:350px;">
            <label class="control-label" style="width:115px!important;">提前几天付款<span class="required">*</span></label>
            <div class="controls">
               <input type="text" name="advance_days" style="width:157px;" value="" required placeholder="数字" onkeyup="value=value.replace(/[^\d.]/g,'')">
            </div>
        </div>
    <div class="control-group inputcss" style="float:left;width:350px;">
        <label class="control-label" style="width:115px!important;">押金<span class="required">*</span></label>
        <div class="controls">
            <input type="text" name="deposit" style="width:100px;" placeholder="数字" value="" required onkeyup="value=value.replace(/[^\d.]/g,'')">(元)
        </div>
    </div>
    <div class="control-group inputcss" style="float:left;width:350px;">
        <label class="control-label" style="width:115px!important;">备注</label>
        <div class="controls">
            <input type="text" name="deposit_memo"  value="">
        </div>
    </div>

    <div class="control-group inputcss" style="float:left;clear:both;width:350px;">
        <label class="control-label" style="width:115px!important;">押金付款日期<span class="required">*</span></label>
        <div class="controls">
            <input name="deposit_pay_time" type="text" class="span3 m-wrap date-picker"/ style="width:171px" value="" required>
        </div>
    </div>
    <div class="control-group inputcss" style="float:left;width:350px;">
        <label class="control-label" style="width:115px!important;">首期租金付款日期<span class="required">*</span></label>
        <div class="controls">
            <input name="rent_start_time" type="text" class="span3 m-wrap date-picker"/ style="width:171px" value="" required>
        </div>
    </div>
    <div class="control-group inputcss" style="float:left;width:350px;">
        <label class="control-label" style="width:115px!important;">二期租金付款日期<span class="required">*</span></label>
        <div class="controls">
            <input name="rent_second_time" type="text" class="span3 m-wrap date-picker"/ style="width:171px" value="" required>
        </div>
    </div>


    <div  class="tj-3y" style="float:left;">
        <div class="control-group ">
            <label class="control-label">物业费</label>
            <div class="controls">
                <input type="checkbox" name="property_fee" />
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label">取暖费</label>
            <div class="controls">
                <input type="checkbox" name="heating_fee" />
            </div>
        </div>

        <div class="control-group ">
            <label class="control-label" style="width:80px">制冷</label>
            <div class="controls">
                <input type="checkbox" name="cool"/>
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label">发票</label>
            <div class="controls">
                <input type="checkbox" name="invoice" id="invoice"/>
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label">其它</label>
            <div class="controls">
                <input type="checkbox" id="other" name="other" />
            </div>
        </div>
        <script>
            $("#other").click(function(){
                if($("#other").attr("checked") == "checked"){
                    $(".property_memo").show();
                }else{
                    $(".property_memo").hide();
                }
            })
        </script>
        <div class="control-group property_memo" style="float:left;display:none;">
            <label class="control-label">备注</label>
            <div class="controls">
                <input type="text"  name="property_memo" style="width:300px;" value="">
            </div>
        </div>
    </div>
        <div class="control-group invoice_s " style="float:left;">
            <label class="control-label">税率</label>
            <div class="controls">
                <input type="text" placeholder="数字" style="width:100px;" name="tax_rate" value="" onkeyup="value=value.replace(/[^\d.]/g,'')"/>%
            </div>
        </div>
        <div class="control-group invoice_s " style="float:left;">
            <label class="control-label">税金金额</label>
            <div class="controls">
                <input type="text" placeholder="数字" name="tax" style="width:100px;" value="" onkeyup="value=value.replace(/[^\d.]/g,'')" class="invoice_s"/>元/月
            </div>
        </div>
        <script>
            $(".invoice_s").hide();
            $("#invoice").click(function(){
                if($("#invoice").attr("checked") == "checked"){
                    $(".invoice_s").show();
                }else{
                    $(".invoice_s").hide();
                }
            })
        </script>
        <div class="control-group inputcss" style="float:left;clear:both;">
            <label class="control-label ">总应付租金</label>
            <div class="controls">
                <input type="text" placeholder="数字"  name="rent_sum"  onkeyup="value=value.replace(/[^\d.]/g,'')" style="width:100px;">(元)
            </div>
        </div>

        <div class="control-group inputcss" style="margin-left:30px;float:left;">
            <label class="control-label ">备注</label>
            <div class="controls">
                <input type="text" name="rent_sum_memo"   style="width:300px;">
            </div>
        </div>

        <div style="font-size:14px;margin-bottom:30px;clear:both;">
            <div class="control-group inputcss" style="float:left;">
                <label class="control-label">合同佣金</label>
                <div class="controls">
                    <input type="text" placeholder="数字"  name="commission"  onkeyup="value=value.replace(/[^\d.]/g,'')" style="width:100px;">(元)
                </div>
            </div>
        </div>
</div>
<div class="xxk-lp-1" style="display:none">
    <div class="alert alert-error hide">
        <button class="close" data-dismiss="alert"></button>
        输入格式有误，请检查输入的数据.
    </div>
    <div class="alert alert-success hide">
        <button class="close" data-dismiss="alert"></button>
        数据输入验证成功!
    </div>
    <p style="font-size:20px;margin-top:30px;margin-bottom:30px;font-weight:bold;">签约信息</p>
    <div class="yj-qy-xx">
          <div class="control-group">
            <label class="control-label">签约日</label>
            <div class="controls">
                <input name="signing_date" class="m-wrap span3 date-picker"  size="16" type="text" value="" / style="width:155px;">
            </div>
          </div>

        <div class="control-group">
            <label class="control-label">合同状态</label>
            <div class="controls">
                <select name="status">
                    <?php foreach (Yii::app()->params['contract_status'] as $key => $value) {
                    ?>

                    <?php
                        if ($key<5||$key==8||$key==9){
                    ?>
                        <option value="<?php echo $key;?>" <?php echo $key==-1?'selected':''?>><?php echo $value ?></option>
                        <?php
                    }
                        ?>
                    <?php
                    }?>
                </select>
            </div>
        </div>
    
    </div>

    <div class="yj-qy-xx" style="clear:both;">

        <div class="control-group" style="clear:both;float:left">
            <label class="control-label">渠道公司</label>
            <div class="controls">
                <input type="hidden" name="channel_id" id="channel_id" class="span6 select2" style="width:320px">
            </div>
        </div>
        <div class="control-group" style="clear:both;">
            <label class="control-label">渠道人员</label>
            <div class="controls">
                <input type="hidden" name="channel_manager_id[]"  id="channel_manager_id" class="span6 select2 " style="width:230px">
                <input type="button" value="添加" style="width:60px;display:none;" class="span1 m-wrap addqudao" >
                <input type="button" value="删除" style="width:60px;display:none;" class="span1 m-wrap delqudao" >
            </div>
        </div>
        <div class="qudao" style="clear:both;display:none;">
            <div class="control-group" style="">
                <label class="control-label">渠道人员</label>
                <div class="controls">
                    <input type="hidden" name="channel_manager_id[]"  id="channel_manager_id" class="span6 select2 channel_manager_id" style="width:230px">
                    <input type="button" value="添加" style="width:60px;display:none;" class="span1 m-wrap addqudao" >
                    <input type="button" value="删除" style="width:60px;display:none;" class="span1 m-wrap delqudao" >
                </div>
            </div>
        </div>

        <div id="qudaorenyuan"></div>
        <script>
            $(function(){
                $(".submit").click(function(){
                    $(".qudao").eq(0).remove();
                })
            })
            $(".addqudao").eq(0).show();
            $(".delqudao").eq(0).hide();
            $(".addqudao").live('click',function(){
                qudao = $(".qudao").eq(0).clone();

                var num = $(".addqudao").length;
                // qudao.find("#channel_manager_id").attr('id','channel_manager_id'+num)
                $("#qudaorenyuan").append(qudao);
                $("#qudaorenyuan").find(".addqudao").remove();
                $("#qudaorenyuan").find(".delqudao").show();
                $("#qudaorenyuan").find(".qudao").show();
                $(".delqudao").click(function(){
                    $(this).parent().parent().remove();
                })
                handlechannel_manager_id2Selec2();
            })
                var handlechannel_manager_id2Selec2 = function () {
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
                    $("#qudaorenyuan").find(".channel_manager_id").select2({
                        placeholder: "",
                        minimumInputLength: 1,
                        ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                            url: "/admin/channelmanager/ajaxlist",
                            dataType: 'json',
                            data: function (term, page) {
                                return {
                                    channel_id : $('#channel_id').attr('data'),
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
                            var id = $(element).val();
                            if (id !== "") {
                                $.ajax("/admin/channelmanager/ajaxitem", {
                                    data: {
                                        id:id,
                                        apikey: "ju6z9mjyajq2djue3gbvv26t"
                                    },
                                    dataType: "json"
                                }).done(function (data) {
                                    callback(data);
                                });
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

        </script>

            <br>
            <br>
            <br>
            <br>
        </div>
        <div class="control-group" style="clear:both;">
            <label class="control-label">补充条款</label>
            <div class="controls">
                <textarea name="addition" class="span6 m-wrap" rows="8"></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">备注</label>
            <div class="controls">
                <!-- <input name="memo" type="text" class="span6 m-wrap"/> -->
                <textarea name="memo" class="span6 m-wrap" rows="8"></textarea>
            </div>
        </div>
</div>
<br>
<br>
<div class="form-actions" style="margin-top:100px;margin-bottom:30px;">
    <div  class="btn btn-primary  syiye">上一页</div>
    <div  class="btn btn-primary xyiye">下一页</div>
    <button id='sfd' type="submit" class="btn btn-primary submit js-btnadd">保存</button>
    <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
</div>

    </form>
    <script>
        $(function(){
            var ycL=$(".xxk-lp-1")
            var leng=$(".xxk-lp-1").length
            $("#sfd").hide();
            $(".syiye").hide();
            ycL.eq(0).css({display:"block"})
            var num=0
            $(".xyiye").click(function(){
                num++
                if(num>ycL.length-1){
                    num=3
                }
                if(num==3){
                    $('.xyiye').hide();
                    $("#sfd").show();
                }else{
                    $('.syiye').show();

                }
                console.log(num)
                ycL.css({display:"none"}).eq(num).css({display:"block"})
            })
            $(".syiye").click(function(){
                num--
                if(num<0){
                    num=0
                }
                if(num==0){
                    $('.syiye').hide();
                }else{
                    $('.xyiye').show();

                }
                console.log(num)
                ycL.css({display:"none"}).eq(num).css({display:"block"})
            })
        })
    </script>
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

//房产证图片
var settings_house_property_card_photo = {
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
progressTarget : "fsUploadProgress_house_property_card_photo",
cancelButtonId : "btnCancel"
},
debug: false,

// Button settings
button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
button_width: "100",
button_height: "30",
button_placeholder_id: "PlaceHolder_house_property_card_photo",
button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
button_disabled : false,

button_text: '<span class="theFont">新增图片</span>',
button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
button_text_left_padding: 20,
button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
file_queued_handler : fileQueued_house_property_card_photo,
file_queue_error_handler : fileQueueError,
file_dialog_complete_handler : fileDialogComplete,
upload_start_handler : uploadStart,
upload_progress_handler : uploadProgress,
upload_error_handler : uploadError,
upload_success_handler : uploadSuccess_house_property_card_photo,
upload_complete_handler : uploadComplete,
queue_complete_handler : queueComplete  // Queue plugin event
};
swf_house_property_card_photo = new SWFUpload(settings_house_property_card_photo);

//产权人身份证件
var settings_id_card_photo = {
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
progressTarget : "fsUploadProgress_id_card_photo",
cancelButtonId : "btnCancel"
},
debug: false,

// Button settings
button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
button_width: "100",
button_height: "30",
button_placeholder_id: "PlaceHolder_id_card_photo",
button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
button_disabled : false,

button_text: '<span class="theFont">新增图片</span>',
button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
button_text_left_padding: 20,
button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
file_queued_handler : fileQueued_id_card_photo,
file_queue_error_handler : fileQueueError,
file_dialog_complete_handler : fileDialogComplete,
upload_start_handler : uploadStart,
upload_progress_handler : uploadProgress,
upload_error_handler : uploadError,
upload_success_handler : uploadSuccess_id_card_photo,
upload_complete_handler : uploadComplete,
queue_complete_handler : queueComplete  // Queue plugin event
};
swf_id_card_photo = new SWFUpload(settings_id_card_photo);




//不动产授权委托书图片
var settings_immovable_authorisation_photo = {
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
progressTarget : "fsUploadProgress_immovable_authorisation_photo",
cancelButtonId : "btnCancel"
},
debug: false,

// Button settings
button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
button_width: "100",
button_height: "30",
button_placeholder_id: "PlaceHolder_immovable_authorisation_photo",
button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
button_disabled : false,

button_text: '<span class="theFont">新增图片</span>',
button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
button_text_left_padding: 20,
button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
file_queued_handler : fileQueued_immovable_authorisation_photo,
file_queue_error_handler : fileQueueError,
file_dialog_complete_handler : fileDialogComplete,
upload_start_handler : uploadStart,
upload_progress_handler : uploadProgress,
upload_error_handler : uploadError,
upload_success_handler : uploadSuccess_immovable_authorisation_photo,
upload_complete_handler : uploadComplete,
queue_complete_handler : queueComplete  // Queue plugin event
};
swf_immovable_authorisation_photo = new SWFUpload(settings_immovable_authorisation_photo);

//车主授权代理人委托书图片
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
            if(count==0){
                alert("租期不得小于一年");
                $("input[name='lease_term_start']").val('');
                $("input[name='lease_term_end']").val('');
            }
$("#lease_term_list").html("");
for (var i = 0; i < count; i++) {
var html='<div class="control-group inputcss">'+
    '                        <label class="control-label">第'+(i+1)+'年<span class="required">*</span></label>'+
    '                        <div class="controls">'+
    '                            <input name="term_start[]" class="m-wrap span3 date-picker  span2"  size="16" type="text" value="" required />至'+
    '                            <input name="term_end[]" class="m-wrap span3 date-picker span2"  size="16" type="text" value="" required />'+
    '                            月租金<span class="required" style="color:red;">*</span><input name="sub_monthly_rent[]" type="text" placeholder="单位元" class="span1 m-wrap" required />(元)'+
    '                            单价<input name="sub_price_per_meter[]" type="text" placeholder="单位元/天/㎡" class="span1 m-wrap"/>(元/天/㎡)'+
    '                            递增方式<input name="increasing_number[]" type="text" class="span1 m-wrap"/>'+
    '                            <select name="increasing_mode[]" class="span1"><option value=1>%</option><option value=2>元</option><select>'+
    '                        </div>'+
    '                    </div>';
$("#lease_term_list").append(html);
};

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

//产权人身份证件
function uploadSuccess_id_card_photo(fileObj, server_data){
$(".progressWrapper").hide();
var json=JSON.parse(server_data);
if (json.code==0)
{
alert(json.message);
return;
}
var file_name=json.data.file_name;
var file_url=json.data.file_url;



var oo = document.getElementsByName("id_card_photo_show")[0];
var new_img = $(oo).clone();
$(new_img).show();
$(new_img).attr("src",file_url);
$("#id_card_photo_div").append(new_img);$(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
document.getElementsByName("id_card_photo")[0].value=document.getElementsByName("id_card_photo")[0].value+','+file_url;
$("#id_card_photo_div").show();
}

function fileQueued_id_card_photo(file){

var stats = swf_id_card_photo.getStats();
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
//车主授权代理人委托书
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



$("input[name*='sub_monthly_rent[]']").live("change",function(e){
    if ($(this).val()!=""){
        var area = $("input[name='area[]']");
        var mianji = 0;
        for (var i = 0; i < area.length-1; i++) {
             parseFloat(area[i].value);
             mianji = parseFloat(mianji);
             mianji = mianji + parseFloat(area[i].value);
        }
            if (!mianji){
            alert("车源信息不完整");
            }
            var p=$(this).val()*12/365/mianji;
            if(!p){
                $(this).parent().children("input[name*='sub_price_per_meter']").val("");
            }else{
                $(this).parent().children("input[name*='sub_price_per_meter']").val(p.toFixed(2));

            }
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
            if(!p){
                $("input[name='rent_sum']").val("");
            }else{
                $("input[name='rent_sum']").val(p);
            }

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
'<input name="wuye_start[]" value="" type="text" class="span3 m-wrap date-picker"/>至'+
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
'<input name="qunuan_start[]" value="" type="text" class="span3 m-wrap date-picker"/>至'+
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
            var html = $("#chanquan").clone();
            html.find("input[name='owner[]']").val('');
            html.find("input[name='owner_phone[]']").val('');
            html.find("input[name='owner_id_card[]']").val('');
            html.find("input[name='owner_gender[]']").val('');
            $("#quanren").append(html)
            $("#quanren").find(".delcqr").show();
            $("#quanren").find(".addcqr").hide();
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
            html.find("input[name='deposit_month[]']").val('');
            html.find("input[name='pay_month[]']").val('');
            html.find("input[name='deposit_start_time[]']").val('');
            html.find("input[name='deposit_end_time[]']").val('');
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
            html.find("input[name='free_lease_start[]']").val('');
            html.find("input[name='free_lease_end[]']").val('');
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
