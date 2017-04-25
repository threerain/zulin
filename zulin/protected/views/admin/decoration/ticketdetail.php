<style> 
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
  #table input{border:0 none!important;color:#222;font-weight:bold;text-align:center;}
  #table{margin-left:-70px;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
?>
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

            <div class="caption"><i class="icon-globe"></i>罚款单详情</div>
            <div class="tools">
            </div>
          </div>
         <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">             
                <div style="margin-left:40px;margin-bottom:500px;">
                  <form  style="margin:0;height:120px;margin-top:30px;" >
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        &nbsp;罚款项：<?php echo $model->fine_items;?>
                      </span>                                                               
                    </div> 
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款日期：<?php echo $model->fine_date?date("Y-m-d",$model->fine_date):"";?>
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款金额：<?php echo $model->fine_amount/100;?>
                      </span>                                                               
                    </div>                
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款原因：<?php echo $model->fine_reason;?>
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        罚款方式：<?php echo $model->fine_settlement;?>
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        &nbsp;处罚方：<?php echo $model->punish_people;?>
                      </span>                                                               
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>
                        &nbsp;被罚方：<?php echo $model->punished_people;?>
                      </span>                                                               
                    </div>
                    <div class="form-actions" style="clear:both;margin-top:50px;">
                      <button type="button" class="btn"  onclick="javascript:history.go(-1);">返回</button>
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
