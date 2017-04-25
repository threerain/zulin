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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-admin.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
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

                                <div class="caption"><i class="icon-reorder"></i>管理员-编辑</div>

                                <div class="tools">

                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="/admin/position/editsave" id="form_sample_3"  method="post"  class="form-horizontal js-submit">
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

                                    <div class="control-group">
                                        <label class="control-label"><b>部门<span class="required">*</span></label>
                                        <div class="controls" id="department">
                                            <select name="department_id[]">
                                                <option value=""></option>
                                                <?php foreach (AdminDepartment::model()->findAll("deleted=0 and level = 0") as $key => $value) {
                                                    
                                                ?>
                                                <option  value="<?php echo $value->id?>"><?php echo $value->name ?></option>
                                                <?php }?>
                                                <option selected  value="<?php echo $model->department_id?>"><?php echo AdminDepartment::model()->find(" id = '$model->department_id'")->name ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <script>

                                        $("select[name='department_id[]']").live('change',function(){
                                            $("select[name='department_id[]']:gt("+$(this).index()+")").remove();
                                            var parent_id = $(this).val();
                                            $.post('/admin/position/getchilddepartment',{parent_id:parent_id},function(msg){
                                                msg = eval(msg)
                                                if(msg!=0){
                                                    var str = '';
                                                    for (var i = 0; i < msg.length; i++) {
                                                        str+='<option value="'+msg[i]['id']+'">'+msg[i]['name']+'</option>'
                                                    }
                                                    var str2 ='<select name="department_id[]" ><option value=""></option>'+str+'</select>';
                                                    $("#department").append(str2);                                                    
                                                }

                                            })      
                                        })                                  
                                    </script>
                                    <div class="control-group">
                                        <label class="control-label" style="margin-top:8px;margin-left:20px;"><b>职务名</b><span class="required">*</span></label>
                                        <div class="controls">
                                            <input style="height:20px;border:1px solid #aaa" name="name" type="text" class="span6 m-wrap" value="<?php echo $model==null?"":$model->name;?>"/>
                                        </div>
                                    </div>    

                                    <div class="form-actions">
                                        <button id='' type="submit" class="btn btn-primary submit js-btnadd">保存</button>
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

<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
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