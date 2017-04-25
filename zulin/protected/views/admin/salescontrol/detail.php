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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



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

                        <div class="portlet box green">

                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>销控-详情</div>
                                <div class="tools">
                                </div>
                            </div>

                            <div class="portlet-body form" style="float:left;">
                                <!-- BEGIN FORM-->
                                <form action="/admin/ursproperty/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $ursproperty==null?"":$ursproperty->id;?>">
                                    <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <style>
                                        .control{width:200px;float:left;margin-left:30px;}
                                        .gift{width:80px;float:left;margin-left:30px;}
                                    </style>
                                    <div class="control-group">
                                        <div class="control">类型：<?php if($property->room_type){echo $arrproperty['room_type']["$property->room_type"]; }?></div>
                                        <div class="control">类别：<?php $item=BaseBuilding::model()->find("id='$property->building_id'");echo $item?str_replace([1,2,3],['A1','A2','A3'],$item->type):""; ?></div>
                                    </div>
                                    <div class="control-group"  >
                                        <div class="control">品牌：<?php $item=BaseEstate::model()->find("id='$property->estate_id'"); echo $item?$item->name:""; ?></div>
                                        <div class="control">编号：<?php echo $property->house_no; ?></div>
                                    </div>
                                    <div class="control-group"  >
                                        <div class="control">系列：<?php $item=BaseBuilding::model()->find("id='$property->building_id'"); echo $item?$item->name:""; ?></div>
                                        <div class="control">单价：
                                      <?php
                                        $item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
                                        echo $item?$item->unit_price/100:"";
                                      ?>
                                        </div>
                                    </div>
                                    <div class="control-group"  >
                                        <div class="control">月租金：
                                          <?php
                                            $item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
                                            if($item->area!=null) {
                                                echo $item?round($item->unit_price/100*365/12,2):"";

                                            }else  {

                                                echo $item?round($item->unit_price/100*365/12,2):"";
                                            }
                                          ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="propertys">
<!--图片-->                         <?php
                                        if($photo){
                                            foreach ($photo as $k => $v){

                                                if ($v){
                                                    $a='';
                                                    foreach ($v as $k1 => $v1){
                                                        if ($k1==0){
                                                            $a=",".$v1->url;
                                                        }
                                                        else{
                                                            $a.=",".$v1->url;
                                                        }

                                                    }
                                                }
                                    ?>
                                        <div class="control-group">
                                            <label class="control-label">车源照片</label>
                                            <div class="controls">
                                                <select name="type_photo[]">
                                                  <?php foreach ($arr['type_photo'] as $key => $value) {
                                                  ?>
                                                    <option value="<?php echo $key?>"  <?php echo $key==$k? "selected":""?>><?php echo $value ?></option>
                                                  <?php
                                                  }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group" style="margin:0;">
                                            <div class="controls">
                                                <div class="upload_progress">
                                                    <span class="localname"></span>
                                                </div>
                                                <div class="fieldset flash" id="fsUploadProgress_property_photo<?php echo $k?>">
                                                    <span class="legend"></span>
                                                </div>
                                                <div id="property_photo_div<?php echo $k?>" style="float:left;100%;height:200px;<?php echo $k==null?'display: none':''; ?>">
                                                    <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                    <?php
                                                        if ($v):?>
                                                        <?php foreach ($v as $k1 => $v1):?>
                                                            <a target="_Blank" href="<?php echo $v1->url; ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                                        <?php endforeach; ?>

                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </div>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
                                    <style>
                                        .theFont{font-size: 20px;}
                                    </style>
                                    <button type="button" class="btn" onClick="javascript:history.go(-1)">返回</button>
                                </form>

                                <!-- END FORM-->
                            </div>

                            <!-- 调取车源管理的图片 -->
                            <div  style="float:left;margin-left:150px;">
                                <div class="control-group" style="height:450px;">
                                </div>
                                <span style="font-size:20px;">车源图片：</span>
                                <?php
                                    $count=0;
                                    if($property_photo){
                                        foreach ($property_photo as $k => $v){

                                            if ($v){
                                                $a='';
                                                foreach ($v as $k1 => $v1){
                                                    if ($k1==0){
                                                        $a=",".$v1->url;
                                                    }
                                                    else{
                                                        $a.=",".$v1->url;
                                                    }

                                                }
                                            }

                                ?>
                                    <div class="control-group">
                                        <!-- <label class="control-label">车源图片</label> -->
                                        <div class="controls">
                                            <select name="type_photo[]" disabled=true>
                                                <option value="">请选择图片类型</option>
                                                <option value="1" <?php echo $k==1? "selected":""?> >楼梯外观</option>
                                                <option value="2" <?php echo $k==2? "selected":""?>>交通图</option>
                                                <option value="3" <?php echo $k==3? "selected":""?>>格局图</option>
                                                <option value="4" <?php echo $k==4? "selected":""?>>平面图</option>
                                                <option value="5" <?php echo $k==5? "selected":""?>>外景图</option>
                                                <option value="6" <?php echo $k==6? "selected":""?>>办公室内(地面)</option>
                                                <option value="7" <?php echo $k==7? "selected":""?>>办公室内(室内吊顶)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" style="margin:0;">
                                        <div class="controls">
                                            <div id="property_photo_div<?php echo $k?>" style="float:left;100%;height:200px;<?php echo $k==null?'display: none':''; ?>">
                                                <?php
                                                    if ($v):?>
                                                    <?php foreach ($v as $k1 => $v1):?>
                                                        <a target="_Blank" href="<?php echo $v1->url; ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                                    <?php endforeach; ?>

                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                            $count++;
                                        }
                                    }else{
                                        echo '没有车源图片';
                                    }
                                ?>
                                </div>
                        </div>

                        <!-- END VALIDATION STATES-->
                      </div>

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
    var districtid=$("select[name='district_id']").val();
    $.ajax("/admin/ajax/getarea", {
        data: {
            id:districtid
        },
        dataType: "json"
    }).done(function (data) {
        var options="";
        if(data.length>0){
            options+="<option value=''></option>";
            for(var i=0;i<data.length;i++){
                options+="<option value="+data[i].id+">"+data[i].title+"</option>";
            }
            $("select[name='area_id']").html(options);
        }
    });

    $("select[name='district_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示
        $("select[name='area_id']").empty();
        var districtid=$("select[name='district_id']").val();
        if(null!= districtid && ""!=districtid){
            $.ajax("/admin/ajax/getarea", {
                data: {
                    id:districtid
                },
                dataType: "json"
            }).done(function (data) {
                var options="";
                if(data.length>0){
                    options+="<option value=''></option>";
                    for(var i=0;i<data.length;i++){
                        options+="<option value="+data[i].id+">"+data[i].title+"</option>";
                    }
                    $("select[name='area_id']").html(options);
                }
            });
        }
        else{
            $("#second").hide();
        }
    });

    $("select[name='area_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示
        $("select[name='estate_id']").empty();
        var areaid=$("select[name='area_id']").val();
        if(null!= areaid && ""!=areaid){
            $.ajax("/admin/ajax/getestate", {
                data: {
                    id:areaid
                },
                dataType: "json"
            }).done(function (data) {
                var options="";
                if(data.length>0){
                    options+="<option value=''></option>";
                    for(var i=0;i<data.length;i++){
                        options+="<option value="+data[i].id+">"+data[i].title+"</option>";
                    }
                    $("select[name='estate_id']").html(options);
                }
            });
        }
        else{
            $("#second").hide();
        }
    });



    $("#estate_id").on("change",function(e){
        alert(1234);
   });



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
