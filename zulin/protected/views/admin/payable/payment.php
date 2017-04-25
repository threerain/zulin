
  <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');  
  //Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2.min.css');  
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
  <!-- END PAGE LEVEL PLUGINS -->;

  <!-- BEGIN PAGE LEVEL SCRIPTS -->;
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/cms_purchase_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_purchase_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/chosen.jquery.min.js',CClientScript::POS_END);  
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);  
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/bootstrap-datepicker.js',CClientScript::POS_END); 
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.inputmask.bundle.min.js',CClientScript::POS_END);  
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();
    FormComponents.init();
    ");
?>
  <!-- END PAGE LEVEL SCRIPTS -->;
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

                                <div class="caption"><i class="icon-reorder"></i>收房合同-付款</div>

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
                                <form action="/admin/payable/paymentsave" id="form_create"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
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
                                        <label class="control-label">付款类型</label>
                                        <div class="controls">
                                            <select name="type" disabled="true">
                                                <option value=""></option>
                                                <option value="1" <?php echo $payable->type==1?'selected':'' ?>>押金</option>
                                                <option value="2" <?php echo $payable->type==2?'selected':'' ?>>房租</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">合同付款日期</label>
                                        <div class="controls">
                                            <input name="pay_date" disabled="true" class="m-wrap m-ctrl-medium date-picker" size="16" type="text" value="<?php 
                                            echo date('Y-m-d',$payable->pay_date);
                                             ?>" />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">付款周期<span class="required">*</span></label>
                                            <div class="controls" >
                                            <input type="text" disabled="true" id="datepicker1" value="<?php echo date('Y-m-d',$payable->start_time) ?>" name="start_time" required/>至<input disabled="true" type="text" id="datepicker2" value="<?php echo date('Y-m-d',$payable->end_time)  ?>" name="end_time" required/>
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
                                        <label class="control-label">金额<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="amount" disabled="true" type="text" class="span2 m-wrap" value="<?php echo $payable->amount/100 ?>" />元
                                        </div>
                                    </div>

                    <!--                                     <div class="control-group">
                                        <label class="control-label">备注</label>
                                        <div class="controls">
                                            <input name="memo" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div> -->

                                    <div class="form-actions">
                                        <button id='' type="submit" class="btn btn-primary submit js-btnadd">确认</button>
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
