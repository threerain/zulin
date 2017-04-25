<style>
	.dataTables_filter{padding-left:100px;margin-top:25px!important;}
	div>b{font-size:18px;margin-left:30px;}
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
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
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

                                <div class="caption"><b class="icon-reorder"><span style="font-size:16px;">售后信息</span></b></div>

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
                          			<form action="/admin/repair/enteredit"    method="post"  class="form-horizontal js-submit">
                          						<input type="hidden" name="after_id" value="<?php echo $id?>">
                          			    <style>
                          			        .control{float:left;}
                          			    </style>
                          					<div class="control-group" >
                          				    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          				      <label style="margin-left:110px">工程维修人：<input type="text" name='name' value="<?php echo $model?$model->name:''?>" required></label>

                          				  </div>
                          					<div class="control-group" style="margin-top:-30px">
                          					    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          					      <label style="margin-left:95px">工程维修电话：<input type="text" name='phone' value="<?php echo $model?$model->phone:''?>" maxlength='11' onblur="check_phone(this.value,this);" PlaceHolder="请输入11位的手机号" required></label>

                          					  </div>
                          						<div class="control-group" style="margin-top:-30px">
                          								<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          									<label style="margin-left:95px">工程维修隶属：<input type="text" name='subjection' value="<?php echo $model?$model->subjection:''?>" required></label>

                          							</div>
                          							<div class="control-group" style="margin-top:-30px">
                          									<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          										<label style="margin-left:95px">工程内部报价：<input type="text" name='project_cost' maxlength="7" value="<?php echo $model?$model->project_cost/100:''?>" placeholder="请输入数字(最多保留两位小数)" onblur="check(this.value,this);" required></label>

                          							</div>>

                          			  <div class="control-group" style="margin-top:-50px">
                          			    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          			      <label style="margin-left:110px">实际维修项：<textarea name="real_option" maxlength="255"><?php echo $model?$model->real_option:''?></textarea>

                          			  </div>
                          				<div class="control-group" style="margin-top:-30px">
                          					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          						<label style="margin-left:125px">维修详情：<textarea name="option_infor" maxlength="255"><?php echo $model?$model->option_infor:''?></textarea>

                          				</div>
                          				<div class="control-group" style="margin-top:-30px">
                          					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          						<label style="margin-left:110px">质量保修期：<input type="text" name='mass_time' id="mass_time" value="<?php echo $model?date('Y-m-d',$model->mass_time):''?>" required>&nbsp至&nbsp;<input type="text" name='mass_time1' value="<?php echo $model?date('Y-m-d',$model->mass_time1):''?>" id="mass_time1" ></lable>

                          				</div>
                          				<div class="control-group" style="margin-top:-30px">
                          					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          						<label  style="margin-left:95px">开始维修时间：<input type="text" name='start_time' id="start_time" value="<?php echo $model?date("Y-m-d",$model->start_time):''?>"  ></lable>

                          				</div>
                          				<div class="control-group" style="margin-top:-30px">
                          					<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->

                          						<label style="margin-left:80px">施工预估完成日：<input type="text" name='hope_end_time' id="hope_end_time" value="<?php echo $model?date("Y-m-d",$model->hope_end_time):''?>" ></lable>

                          				</div>
                          			    <div class="control-group" style="clear:both;margin-top:-30px">
                          			     <div class="controls control" style="margin-top:30px;">

                          			                      <button id="sample_editable_2" class="btn red" type="submit">
                          			                      提交
                          			                      </button>
                          			                       <button  class="btn blue"  type="button" onclick="history.go(-1)">
                          			                      取消
                          			                      </button>

                          			    </div>
                          			  </div>
                          			    </div>
                          			  </form>
            <!--内容结束区域-->
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
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
<script type="text/javascript">
    var picker = new Pikaday({
        field: document.getElementById('mass_time'),
        firstDay: 1,
        minDate: new Date('2010-01-01'),
        maxDate: new Date('2030-12-31'),
        yearRange: [2000,2030]
    });
    var picker = new Pikaday({
        field: document.getElementById('mass_time1'),
        firstDay: 1,
        minDate: new Date('2010-01-01'),
        maxDate: new Date('2030-12-31'),
        yearRange: [2000,2030]
    });
    var picker = new Pikaday({
        field: document.getElementById('start_time'),
        firstDay: 1,
        minDate: new Date('2010-01-01'),
        maxDate: new Date('2030-12-31'),
        yearRange: [2000,2030]
    });
    var picker = new Pikaday({
        field: document.getElementById('hope_end_time'),
        firstDay: 1,
        minDate: new Date('2010-01-01'),
        maxDate: new Date('2030-12-31'),
        yearRange: [2000,2030]
    });
    </script>
