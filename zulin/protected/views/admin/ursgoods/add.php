<style>
    .control-group{
        padding-bottom: 0px;
    }
    .control-label{
        width:80px!important;
    }

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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/urs_goods.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/urs_goods.js',CClientScript::POS_END);
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

                                <div class="caption"><i class="icon-reorder"></i>礼品-新增</div>

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
                                <form action="/admin/ursgoods/addsave" id="form_add"  method="post"  class="form-horizontal js-submit">
                                    <!-- 隐藏域(申请人名字) -->
                                    <input type="hidden" name="admin_uname"  value="<?php echo  $_SESSION['admin_uname']; ?>">
                                    <!-- 隐藏域(申请人id) -->
                                    <input type="hidden" name="admin_uid" value="<?php echo  $_SESSION['admin_uid']; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                     <div class="control-group" style="float:left;margin-bottom: 0px;height:53px" >
                                         <label class="control-label" >申请人：</label>
                                         <div class="controls">
                                             <input type="text" disabled="true" value="<?php echo  $_SESSION['admin_uname']; ?>">
                                         </div>
                                    </div>
                                    <div class="control-group" style="float:left;margin-bottom: 0px;height:53px" >
                                        <label class="control-label" >部门：</label>
                                        <div class="controls">
                                            <input type="text" disabled="true" value="<?php echo $department; ?>">
                                        </div>
                                   </div>
                                    <div class="control-group"  style="float:left;margin-bottom: 0px;height:53px">
                                        <label class="control-label">组别：</label>
                                        <div class="controls">
                                            <input type="text" disabled="true" value="<?php echo  $department_group; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group" style="float:left;margin-bottom: 0px;margin-right:0px;height:53px"  id="qwe">
                                        <label class="control-label">负责人：</label>
                                         <div class="controls">
                                            <input type="text" disabled="true" value="<?php echo  $department_principal; ?>">
                                         </div>
                                    </div>
                                    <div class="information">
                                        <div class="control-group"  style="float:left">
                                            <label class="control-label">品牌<span class="required">*</span>：</label>
                                            <div class="controls">
                                                <input type="hidden" name="estate_id[]" readmin="请选择正确的品牌" id="estate_id" class="span4 select2 estate" style="width:220px;margin-right:0px" required>
                                            </div>
                                        </div>
                                        <div class="control-group"  style="float:left">
                                            <label class="control-label">系列<span class="required">*</span>：</label>
                                            <div class="controls">
                                                <input type="hidden" name="building_id[]" readmin="请选择正确的系列" id="building_id" class="span4 select2 building" style="width:220px" required>
                                            </div>
                                        </div>
                                        <div class="control-group"  style="float:left" id="qwe">
                                            <label class="control-label">编号<span class="required">*</span>：</label>
                                            <div class="controls" >
                                                <input type="hidden" name="room_number[]"  readmin="请选择正确的编号" id="room_number" class="span4 select2 room" style="width:220px" required><span style="color:red">(多编号只输入一个即可)</span>
                                            </div>
                                        </div>
                                    </div>
                                     <script type="text/javascript">
                                    //     //未完成
                                    //     $(".select2-drop-active").click(function(){
                                    //         var room_number = $(this).parents('.deleted').attr('sid');
                                    //         //发送ajax
                                    //         $.post('/admin/ursgoods/AjaxChannel',{room_number:room_number},function(data){
                                    //             if(data){
                                    //                 $('.channel_id').html("<p>"+data.channel_id+"</p>");
                                    //                 $('.channel_manager_id').html("<p>"+data.channel_manager_id+"</p>");
                                    //             }
                                    //         })
                                    //     })

                                  </script>
                                    <div style="clear:both"></div>
                                    <div class="control-group" style="float:left;">
                                        <label class="control-label">渠道公司：<span class=""></span></label>
                                        <div class="controls">
                                            <input type="text" disabled="true" value="" class="channel_id">
                                        </div>
                                    </div>
                                     <div class="control-group" style="float:left;">
                                        <label class="control-label">渠道人员：<span class=""></span></label>
                                        <div class="controls">
                                            <input type="text" disabled="true" value="" class="channel_manager_id">
                                        </div>
                                    </div> 
                                    <div style="clear:both"></div>

                                    <!-- <div id="name_num" style="float:left"> -->
                                        <div class="control-group" style="float:left">
                                             <label class="control-label">申请礼品<span class="" style="color:red">*</span>：</label>
                                              <div class="controls">
                                                    <select name="ys_goods_storage_id[]" id="" required  readmin="请选择礼品">
                                                    <?php foreach ($goods as $k => $v){ ?>
                                                        <option value="<?php echo $v['id'] ?>" ><?php echo $v['goods_name'] ?>(<?php echo $v['goods_unit'] ?>)</option> 
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                         
                                        </div>
                                        <div class="control-group" style="float:left">
                                            <label class="control-label">数量<span class="required" style="color:red">*</span>: </label>
                                            <div class="controls">
                                                <input type="number" min="1" name="number[]" id="number[]" required  readmin="请申请正确的数量">
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                    <div class="control-group" style="float:left">
                                        <div class="controls">
                                            <button id="add_name_num" type="button" class="btn green">添加礼品</button>
                                            <button id="del_name_num" type="button" class="btn red">删除礼品</button>
                                        </div>
                                    </div>
                                    <div style="clear:both" class="dell"></div>
                                    <script type="text/javascript">
                                        //添加
                                        $("#add_name_num").click(function(){
                                            mores =$('#name_num1').clone();
                                            mores.show();
                                            mores.addClass('more');
                                            mores.removeAttr('id');
                                            mores.css("float",'none');
                                            $('.dell').append(mores);
                                        })
                                        //刪除
                                        $("#del_name_num").click(function(){
                                            var delmore = $('.more');
                                            $('.more').eq(delmore.length-1).remove();
                                        })

                                    </script>
                                    <div style="clear:both"></div>
                                    <div class="control-group">
                                        <label class="control-label">备注<span class="required" style="color:red">*</span>: </label>
                                        <div class="controls">
                                            <textarea  name="remark"  id="house_no" readmin="请输入备注" style="resize:none";></textarea>
                                            <span style="margin:0 10px;font-size:16px"></span>
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
                                        <button id='sdf' type="submit" class="btn green submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
                            
                                </form>
                                <!-- END FORM-->
                                <div id="name_num1" style="float:left;display:none">
                                    <div class="control-group" style="float:left">
                                        <label class="control-label">申请礼品<span class="" style="color:red">*</span>：</label>
                                         <div class="controls">
                                        <select name="ys_goods_storage_id[]" id="" required>
                                        <?php foreach ($goods as $k => $v){ ?>
                                            <option value="<?php echo $v['id'] ?>" ><?php echo $v['goods_name'] ?>(<?php echo $v['goods_unit'] ?>)</option> 
                                        <?php } ?>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="control-group" style="float:left">
                                            <label class="control-label">数量<span class="required" style="color:red">*</span>: </label>
                                        <div class="controls">
                                            <input type="number" min="1" required value="" name="number[]" id="number">
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                </div>
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
<script type="text/javascript">
    function check(v){
        var a=/^[0-9]*(\.[0-9]{1,2})?$/;
        if(!a.test(v)){
            alert("格式不正确");
            $("#number").attr("value","");
        }
    }
</script>