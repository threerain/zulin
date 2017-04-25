<style>
	.portlet-title{background:font-size:22px;background:url(/css/admin/image/erpressiongfactory.png) no-repeat center left #167ac7!important;
	background-position:10px 6px!important;padding-left:40px!important;}
	.portlet-body{border:1px solid #167ac7!important;border-top-width:0!important;}
	.form-actions{background:#fff;border:0;}
	.controls{margin-top:7px;}
	#btn{color:#fff;background:#167ac7;margin-left:-90px;}
	#btn:hover{background:#0160cb!important;}
	.control-group{margin-top:12px;margin-bottom:-5px;max-height: 1000px;}
	.btn{font-size:16px;}
    .form-horizontal .control-label {
    float: left;
    width: 65px;
    padding-top: 0;
    text-align: right;
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
  // Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-district.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



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

                        <div class="portlet box">

                            <div class="portlet-title">

                                <div class="caption">跟进-详情</div>

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
                                <form action="/admin/notice/editsave" id="form_sample_3"  method="post"  class="form-horizontal js-submit">
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
                                        <label class="control-label">标题<span class="required">*</span></label>
                                        <div class="controls">
                                            <?php echo $model==null?"":$model->title;?>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">谈判日期<span class="required">*</span></label>
                                        <div class="controls">
                                            <?php echo date("Y-m-d",$model==null?"":$model->talk_time);?>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">跟进人<span class="required">*</span></label>
                                        <div class="controls">
                                            <?php echo $model==null?"":$model->follower;?>
                                        </div>
                                    </div> 

                                    <div class="control-group">
                                        <label class="control-label">结果<span class="required">*</span></label>
                                        <div class="controls">
                                                <?php echo $model->result==1?"成功":'';?>
                                                <?php echo $model->result==2?"待优化":'';?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">目标<span class="required">*</span></label>
                                        <div class="controls">
                                            <?php echo $model==null?"":$model->target;?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">联系方式<span class="required">*</span></label>
                                        <div class="controls">
                                            <?php echo $model==null?"":$model->phone;?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">内容<span class="required">*</span></label>
                                        <div class="controls">
                                            <?php echo $model==null?"":$model->content;?>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">下次方案<span class="required">*</span></label>
                                        <div class="controls" style="font-size:15px;">
                                           <?php echo $model==null?"":$model->plan;?>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">下次日期<span class="required">*</span></label>
                                        <div class="controls">
                                            <?php echo date("Y-m-d",$model==null?"":$model->next_time);?>
                                        </div>
                                    </div>
                                                   
                                    <div class="form-actions">
                                        <button type="button" class="btn" id="btn" onclick="javascript:history.go(-1);">返回</button>
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
