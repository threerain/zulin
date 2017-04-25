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
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  //Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property-split.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property-split.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();
    ");
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

                                <div class="caption"><i class="icon-reorder"></i>车源-拆分车源</div>

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
                                <form action="/admin/property/splitaddsave" id="form_add"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <!-- <div class="control-group">
                                        <label class="control-label">区域<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="district_id">
                                                <?php 
                                                    //$aa=BaseDistrict::model()->findAll("deleted=0");  foreach ($aa as $key => $value) {
                                                ?>
                                                <option value="<?php //echo $value->id?>"><?php //echo $value->name?></option>
                                                <?php //}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">商圈<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="area_id">

                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="control-group">
                                        <label class="control-label">品牌</label>
                                        <div class="controls">
                                            <!-- <input type="text" name="estate_id" id="estate_id" class="span4"> -->
                                            <?php $item=BaseEstate::model()->find("id='$property->estate_id'"); echo $item?$item->name:"";?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">系列</label>
                                        <div class="controls">
                                            <!-- <input type="text" name="building_id" id="building_id" class="span4"> -->
                                            <?php $item=BaseBuilding::model()->find("id='$property->building_id'"); echo $item?$item->name:"";?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">编号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="house_no" type="text" value="<?php echo $property->house_no."-"?>" class="span2 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">产品类型</label>
                                        <div class="controls">
                                            <select name="room_type" disabled=true>
                                                <option value=""></option>
                                                <option value="1" <?php echo $property->room_type==1?"selected":""?> >轿车</option>
                                                <option value="2" <?php echo $property->room_type==2?"selected":""?> >客车</option>
                                                <option value="3" <?php echo $property->room_type==3?"selected":""?> >SUV</option>
                                                <option value="4" <?php echo $property->room_type==4?"selected":""?> >商务</option>
                                            </select>
                                            <?php //echo $property->room_type?>
                                        </div>
                                    </div>
                                    <!-- <div class="control-group">
                                        <label class="control-label">户型</label>
                                        <div class="controls">
                                            <select class="span1" name="ting">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>厅
                                            <select class="span1" name="shi">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>室
                                            <select class="span1" name="chu">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>厨
                                            <select class="span1" name="wei">
                                                <option value=""></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>卫
                                        </div>
                                        
                                    </div> -->
                                    <div class="control-group">
                                        <label class="control-label">朝向<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="orientation" required>
                                                <option value=""></option>
                                                <option value="南">南</option>
                                                <option value="南北">南北</option>
                                                <option value="东">东</option>
                                                <option value="东南">东南</option>
                                                <option value="东北">东北</option>
                                                <option value="西">西</option>
                                                <option value="西南">西南</option>
                                                <option value="西北">西北</option>
                                                <option value="北">北</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">面积<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="area" type="text" placeholder="单位：㎡" class="span2 m-wrap"/>㎡
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button id='sdf' type="submit" class="btn blue submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
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
<style>
    .theFont{font-size: 20px;}
</style>
<script>
    // var districtid=$("select[name='district_id']").val();
    // $.ajax("/admin/ajax/getarea", {
    //     data: {
    //         id:districtid
    //     },
    //     dataType: "json"
    // }).done(function (data) {
    //     var options="";
    //     if(data.length>0){
    //         options+="<option value=''></option>";
    //         for(var i=0;i<data.length;i++){
    //             options+="<option value="+data[i].id+">"+data[i].title+"</option>";
    //         }
    //         $("select[name='area_id']").html(options);
    //     }
    // });

    // $("select[name='district_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示 
    //     $("select[name='area_id']").empty();
    //     var districtid=$("select[name='district_id']").val();
    //     if(null!= districtid && ""!=districtid){
    //         $.ajax("/admin/ajax/getarea", {
    //             data: {
    //                 id:districtid
    //             },
    //             dataType: "json"
    //         }).done(function (data) {
    //             var options="";
    //             if(data.length>0){
    //                 options+="<option value=''></option>";
    //                 for(var i=0;i<data.length;i++){
    //                     options+="<option value="+data[i].id+">"+data[i].title+"</option>";
    //                 }
    //                 $("select[name='area_id']").html(options);
    //             }
    //         });
    //     }
    //     else{
    //         $("#second").hide();
    //     }
    // });

    // $("select[name='area_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示 
    //     $("select[name='estate_id']").empty();
    //     var areaid=$("select[name='area_id']").val();
    //     if(null!= areaid && ""!=areaid){
    //         $.ajax("/admin/ajax/getestate", {
    //             data: {
    //                 id:areaid
    //             },
    //             dataType: "json"
    //         }).done(function (data) {
    //             var options="";
    //             if(data.length>0){
    //                 options+="<option value=''></option>";
    //                 for(var i=0;i<data.length;i++){
    //                     options+="<option value="+data[i].id+">"+data[i].title+"</option>";
    //                 }
    //                 $("select[name='estate_id']").html(options);
    //             }
    //         });
    //     }
    //     else{
    //         $("#second").hide();
    //     }
    // });



   //  $("#estate_id").on("change",function(e){ 
   //      alert(1234);
   // });

    

</script>


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