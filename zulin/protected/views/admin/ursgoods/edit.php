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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/urs_goods.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/urs_goods.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
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

                                <div class="caption"><i class="icon-reorder"></i>礼品-修改</div>

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
                                <form action="/admin/ursgoods/editsave"  id="form_edit" method="post"  class="form-horizontal js-submit">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <!-- 隐藏域(申请人名字) -->
                                    <input type="hidden" name="admin_uname" value="<?php echo   $model['admin_uname']; ?>">
                                    <!-- 隐藏域(申请人id) -->
                                    <input type="hidden" name="admin_uid" value="<?php echo  $model['admin_uid']; ?>">
                                    <!-- 隐藏域(礼品的id) -->
                                    <input type="hidden" name="id" value="<?php echo  $model['id']; ?>">
                                    <div class="control-group">
                                        <label class="control-label">申请人</label>
                                        <div class="controls">
                                            <?php echo  $model['admin_uname']; ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">部门:</label>
                                        <div class="controls">
                                            <?php echo $list['department']; ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">组别:</label>
                                        <div class="controls">
                                            <?php echo  $list['department_group']; ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">负责人:</label>
                                        <div class="controls">
                                            <?php echo  $list['department_principal']; ?>
                                        </div>
                                    </div>
                                    <div class="control-group"  style="float:left">
                                        <label class="control-label">品牌<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="hidden" required  title="<?php echo $list['estate_id'] ?>"  value="<?php echo $list['estate_id'] ?>" name="estate_id[]" id="estate_id" class="span4 select2 estate" style="width:230px">
                                        </div>
                                    </div>
                                    <div class="control-group"  style="float:left">
                                        <label class="control-label">系列<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="hidden" required title="<?php echo $list['building_id'] ?>" value="<?php echo $list['building_id'] ?>" name="building_id[]" id="building_id" class="span4 select2 building" style="width:230px">
                                            
                                        </div>
                                    </div>
                                    <div class="control-group"  style="float:left">
                                        <label class="control-label">编号<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="hidden" required value="<?php echo $list['$property_id']   ?>" name="room_number[]" id="room_number" class="span4 select2 room" 
                                               title="<?php echo $list['room_number'] ?>" style="width:230px"><span style="color:red">(修改编号时请从品牌开始修改,多编号只输入一个即可)</span>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label"><span class="required"></span></label>
                                    </div> <br>
                                    <div class="control-group">
                                        <label class="control-label">渠道公司:</label>
                                        <div class="controls">
                                            <span class="channel_id"><?php echo  $list['channel_id']; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">渠道人员:</label>
                                        <div class="controls">
                                            <span class="channel_manager_id"><?php echo  $list['channel_manager_id']; ?></span>
                                        </div>
                                    </div>
                                    
                                    <?php foreach ($goods as $k=> $v){  if($k == 0){?>
                                        <div id="name_num" style="float:left">
                                            <div class="control-group">
                                              <span>申请礼品：
                                                <select name="ys_goods_storage_id[]" id="" required>
                                                <?php foreach ($_goods as $kk => $vv){ ?>
                                                  <option value="<?php echo $vv['id'] ?>" <?php echo $vv['id']== $v['ys_goods_storage_id']?'selected=selected':'' ?> ><?php echo $vv['goods_name'].'('.$vv['goods_unit'].')' ?></option> 
                                                <?php } ?>
                                                </select>
                                              </span>
                                            </div><br>

                                            <div class="control-group">
                                                <label class="control-label">数量: </label>
                                                <div class="controls">
                                                    <input type="number" min="1" required value="<?php echo $v['number']  ?>" name="number[]" id="number">
                                                </div>
                                            </div>
                                        </div>
                                    <?php }} ?>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id="add_name_num" type="button" class="btn green">添加礼品</button>
                                            <button id="del_name_num" type="button" class="btn red">删除礼品</button>
                                        </div>
                                    </div>
                                    <div style="clear:both" class="dell"></div>
                                     <?php foreach ($goods as $k=> $v){  if($k > 0){?>
                                        <div id="name_num" class="more" >
                                            <div class="control-group">
                                              <span>申请礼品
                                                <select name="ys_goods_storage_id[]" id="" required>
                                                <?php foreach ($_goods as $kk => $vv){ ?>
                                                  <option value="<?php echo $vv['id'] ?>" <?php echo $vv['id']== $v['ys_goods_storage_id']?'selected=selected':'' ?> ><?php echo $vv['goods_name'].'('.$vv['goods_unit'].')' ?></option> 
                                                <?php } ?>
                                                </select>
                                              </span>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">数量: </label>
                                                <div class="controls">
                                                    <input type="text" required value="<?php echo $v['number'] ?>" name="number[]" id="number">
                                                </div>
                                            </div>
                                            <div class="control-group delll">
                                        <label class="control-label">备注: </label>
                                        <div class="controls">
                                            <textarea  name="remark"  id="house_no" readmin="请输入备注" style="resize:none";><?php echo $list['remark']?$list['remark']:''; ?></textarea>
                                        </div>
                                    </div>
                                        </div>
                                    <?php }} ?>
                                    <script type="text/javascript">
                                        //添加
                                        $("#add_name_num").click(function(){
                                            mores =$('#name_numl').clone();
                                            mores.show()
                                            mores.addClass('more');
                                            mores.removeAttr('id');
                                            mores.css("float",'none');
                                            $('.delll').prepend(mores);
                                        })
                                        //刪除
                                        $("#del_name_num").click(function(){
                                            var delmore = $('.more');
                                            $('.more').eq(delmore.length-1).remove();
                                        })

                                    </script>
                                    <div class="control-group delll">
                                        <label class="control-label">备注: </label>
                                        <div class="controls">
                                            <textarea  name="remark"  id="house_no" readmin="请输入备注" style="resize:none";><?php echo $list['remark']?$list['remark']:''; ?></textarea>
                                        </div>
                                    </div>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
                                    <style>
                                        .theFont{font-size: 20px;}
                                    </style>                                    
                                    <div class="form-actions">
                                        <button type="submit" class="btn green submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
                                </form>
                                <div id="name_numl" style="float:left;display:none">
                                    <div class="control-group">
                                      <span>申请礼品：
                                        <select name="ys_goods_storage_id[]" id="" required>
                                        <?php foreach ($_goods as $kk => $vv){ ?>
                                          <option value="<?php echo $vv['id'] ?>" <?php echo $vv['id']== $v['ys_goods_storage_id']?'selected=selected':'' ?> ><?php echo $vv['goods_name'].'('.$vv['goods_unit'].')' ?></option> 
                                        <?php } ?>
                                        </select>
                                      </span>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">数量: </label>
                                        <div class="controls">
                                            <input type="number" min="1" required value="" name="number[]" id="number">
                                        </div>
                                    </div>
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