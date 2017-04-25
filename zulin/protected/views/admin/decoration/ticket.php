<style>	
	.modal-body{font-size:18px;text-indent: 20px;}
	#modal-label{text-align:center;font-size:22px;}
	#about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
	#left{background:#167bcd;color:#fff;margin-right:10px;}
	#left:hover{background:#0160cb!important;}
	#table input{border:0 none!important;color:#222;font-weight:bold;text-align:center;}
	#table{margin-left:-70px;}
  .help-inline{color:red;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
<div class="page-content">
  <div id="portlet-config" class="modal hide">
    <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>portlet Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here will be a configuration form</p>
    </div>
  </div>
  <!-- BEGIN PAGE CONTAINER-->        
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid" style="min-height:10px;"></div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">
            <div class="caption"><i class="icon-reorder"></i>装修管理-写罚款单</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">            	
                <div style="margin-left:40px;margin-bottom:500px;">
                 <form  action="/admin/decoration/TicketSave" id="form_add"  method="post"  class="form-horizontal js-submit" style="margin:0;height:120px;margin-top:30px;" >
                    <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      输入格式有误，请检查输入的数据.
                    </div>
                    <div class="alert alert-success hide">
                      <button class="close" data-dismiss="alert"></button>
                      数据输入验证成功!
                    </div>
                    <input type="hidden" name="decoration_id" value="<?php echo $decoration_id; ?>">
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        &nbsp;罚款项<span style="color:red;">*</span><input type="text"  value="" name="fine_items" maxlength="75" required />
                      </span>                                                               
                    </div> 
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款日期<span style="color:red;">*</span><input type="text" id="datepicker" value="" name="fine_date" required />
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款金额<span style="color:red;">*</span><input type="text"  value="" maxlength="7" name="fine_amount" onblur="check(this.value,this);" required />
                      </span>                                                               
                    </div>                
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款原因<span style="color:red;">*</span><textarea name="fine_reason" maxlength="172" required class="span6 m-wrap" rows="8"></textarea>
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款方式<span style="color:red;">*</span><input type="text"  value=""  name="fine_settlement" maxlength="172" required>
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        &nbsp;处罚方<span style="color:red;">*</span><input type="text"  value=""  name="punish_people" maxlength="50" required>
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        &nbsp;被罚方<span style="color:red;">*</span><input type="text"  value=""  name="punished_people" maxlength="50" required>
                      </span>                                                               
                    </div>
                    <div class="control-group" style="clear:both;">
                      <div class="controls">
                        <button type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                      </div>
                    </div>
                  </form>            
                </div>
              </div>
            </div>
          </div>  
          <!-- END EXAMPLE TABLE PORTLET-->
      </div> 
    </div>
  </div>
    <!-- END PAGE CONTENT-->
</div>
  <!-- END PAGE CONTAINER-->
</div>
<!-- 隐藏的品牌系列编号 -->
<div style="display:none;clear:both;" class="select">
  <div class="dataTables_filter" style="margin-bottom:20px;">
    <span>
      品牌<span style="color:red;">*</span><input type="hidden" name="estate_id[]" id="estate_id" class="select2 estate" style="width:230px">
    </span>
    <span>
      系列<span style="color:red;">*</span><input type="hidden" name="building_id[]" id="building_id" class="select2 building" style="width:230px">
    </span>
    <span>
      编号<span style="color:red;">*</span>
        <input type="hidden" name="room_number[]" id="room_number" class="select2 room" style="width:230px">
        <input type="hidden" name="property_id[]" id="property_id">
    </span>                                          
  </div>
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
<script>
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  }); 
</script>