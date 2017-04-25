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

                                <div class="caption"><i class="icon-reorder"></i>应收-拆分</div>

                                <div class="tools">
                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="/admin/payable/savepay" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $model->id ?>">
                                    <input type="hidden" name="contract_id" value="<?php echo $contract_id?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group" style="margin-top:30px;">
                                        <label class="control-label">付款日<span class="required">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="datepicker0" value="<?php echo date('Y-m-d',$model->pay_date ) ?>" name="pay_date" required/>
                                        </div>
                                    </div>   
                                    <div class="control-group">
                                        <label class="control-label">付款周期<span class="required">*</span></label>
                                            <div class="controls" >
                                            <input type="text" id="datepicker1" value="<?php echo date('Y-m-d',$model->start_time) ?>" name="start_time" required/>至<input type="text" id="datepicker2" value="<?php echo date('Y-m-d',$model->end_time)  ?>" name="end_time" required/>
                                              <script type="text/javascript">
                                                var picker = new Pikaday({
                                                    field: document.getElementById('datepicker0'),
                                                    firstDay: 1,
                                                    minDate: new Date('2010-01-01'),
                                                    maxDate: new Date('2030-12-31'),
                                                    yearRange: [2000,2130]
                                                });
                                                var picker = new Pikaday({
                                                    field: document.getElementById('datepicker1'),
                                                    firstDay: 1,
                                                    minDate: new Date('2010-01-01'),
                                                    maxDate: new Date('2030-12-31'),
                                                    yearRange: [2000,2030]
                                                });
                                                var picker = new Pikaday({
                                                    field: document.getElementById('datepicker2'),
                                                    firstDay: 1,
                                                    minDate: new Date('2010-01-01'),
                                                    maxDate: new Date('2030-12-31'),
                                                    yearRange: [2000,2030]
                                                });
                                              </script>
                                            </div>
                                    </div>                                      
                                    <div class="control-group">
                                        <label class="control-label">付款金额<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="amount" type="text" class="span2 m-wrap" value="<?php echo $model->amount/100 ?>" required/>元
                                        </div>
                                    </div> 

                                    <div class="control-group">
                                        <label class="control-label" style="font-size:14px;width:100px;">是否需要发票<span class="required">*</span></label>
                                        <div class="controls">
                                            <label class="control-label">
                                               <input name="invoice" type="radio" <?php echo $model->invoice==1?'checked':'' ?> value="1"/>是
                                            </label> 
                                            <label class="control-label">
                                                <input name="invoice" type="radio" <?php echo $model->invoice==0?'checked':'' ?> value="0"/>否
                                            </label>
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
<script>
    function getNowFormatDate() {
        var date = new Date();
        var seperator1 = "-";
        var seperator2 = ":";
        var month = date.getMonth() + 1;
        var strDate = date.getDate();
        if (month >= 1 && month <= 9) {
            month = "0" + month;
        }
        if (strDate >= 0 && strDate <= 9) {
            strDate = "0" + strDate;
        }
        var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
                + " " + date.getHours() + seperator2 + date.getMinutes()
                + seperator2 + date.getSeconds();
        return currentdate;
    }

    $(function(){
        $("input[name='add_cjjl']").click(function(){
            var time = getNowFormatDate();
            var html = "<div class='controls'>"+time+" 备注 ：     <input name='cjjl[]' type='text' class='span6 m-wrap' value=''/></div><br>";
            $(this).parent().parent().append(html);

        })                                            
    })
</script>