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

                                <div class="caption"><i class="icon-reorder"></i>应收-编辑</div>

                                <div class="tools">
                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="/admin/payable/saveyuepay" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="contract_id" value="<?php echo $contract_id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>


                                    <?php if ($ren['contractor']): ?>
                                            <div class="control-group">
                                                <label class="control-label">签约人</label>
                                                <div class="controls">
                                                   <label class="control-label"><?php echo  $ren['contractor'] ?>：</label>
                                                   <?php foreach ($ren['contractor_phone'] as $key => $value): ?>
                                                    <input name="house_no" type="text" disabled="true" class="span2 m-wrap" value="<?php echo $value  ?>"/>       
                                                   <?php endforeach ?>
                                                   
                                                </div>
                                            </div>                                             
                                    <?php endif ?>
                                    <?php if ($ren['owner']): ?>
                                            <div class="control-group">
                                                <label class="control-label">产权人</label>
                                                <div class="controls">
                                                   <?php if ($ren['owner_phone']): ?>
                                                       <?php foreach ($ren['owner_phone'] as $key => $value): ?>
                                                        <label class="control-label"><?php echo  $ren['owner'] ?>：</label>
                                                        <input name="house_no" type="text" disabled="true" class="span2 m-wrap" value="<?php echo $value  ?>"/>       
                                                       <?php endforeach ?>                                                       
                                                   <?php endif ?>

                                                   
                                                </div>
                                            </div>                                             
                                    <?php endif ?>
                                    <?php if ($ren['agent']): ?>
                                            <div class="control-group">
                                                <label class="control-label">代理人</label>
                                                <div class="controls">
                                                   <label class="control-label"><?php echo  $ren['agent'] ?>：</label>
                                                   <?php foreach ($ren['agent_phone'] as $key => $value): ?>
                                                    <input name="house_no" type="text" disabled="true" class="span2 m-wrap" value="<?php echo $value  ?>"/>       
                                                   <?php endforeach ?>
                                                   
                                                </div>
                                            </div>                                             
                                    <?php endif ?>



                                    <div class="control-group">
                                        <label class="control-label">催缴记录<span class="required">*</span></label>
                                        <?php if ($model): ?>
                                            <?php foreach ($model as $k => $v): ?>
                                                <div class="controls">
                                                    <span><?php echo date('Y-m-d H:i:s',$v->call_time)  ?> 备注 ：     </span>
                                                    <input type="hidden" id = 'call_time' name = "call_time[]" value = "">     
                                                    <input name="cjjl[]" type="text" placeholder="注：请手动填写本次催缴记录" class="span6 m-wrap" value="<?php echo $v->memo ?>"/>
                                                     <input name="add_cjjl" type="button" class="span1 m-wrap" value="添加记录"/>
                                                </div>
                                                <br>                                                
                                            <?php endforeach ?>
                                        <?php else: ?>
                                                <div class="controls">
                                                    <span id="first_time"></span>
                                                    <input type="hidden" id = 'call_time' name = "call_time[]" value = "">     
                                                    <input name="cjjl[]" type="text" placeholder="注：请手动填写本次催缴记录" class="span6 m-wrap" value=""/>
                                                    <input name="add_cjjl" type="button" class="span1 m-wrap" value="添加记录"/>
                                                </div>
                                        <?php endif ?>
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
        var time = getNowFormatDate();
        $('#first_time').append(time+' 备注 ：     ');
        $('#call_time').val(time);
        $("input[name='add_cjjl']").click(function(){
            var time = getNowFormatDate();
            var html = "<div class='controls'>"+time+" 备注 ：     <input name='cjjl[]' type='text' placeholder='注：请手动填写本次催缴记录' class='span6 m-wrap' value=''/><input type='hidden' name='call_time[]' value='"+time+"' /></div><br>";
            $(this).parent().parent().append(html);

        })                                            
    })
</script>