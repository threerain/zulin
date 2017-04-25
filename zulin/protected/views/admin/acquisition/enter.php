<style media="screen">
   label{margin-left:80px; };
   .control-group{margin-bottom:0px !important;margin-top:0px !important;padding-bottom: 10px !important;}
   input{width:200px!important}

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

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i></div>

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
                                <div  class="form-horizontal js-submit">

                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                <form action="/admin/acquisition/enter"  method="get" style="margin:0">
                                    <div class="control-group">
                                        <label  >合同：

                                            <?php echo $id?>
                                    <!-- <button id="sample_editable_1_new" class="btn blue" type="submit">
                                        搜索 <i class="icon-search"></i>
                        </button> -->
                                      </label>
                                    </div>
                                 </form>
                                     <div class="control-group"  style="margin-top:-30px;">
                                        <label style="margin-left:80px" >品牌：

                                            <?php echo $property[0]['estate_name'] ?>
                                        </label>
                                    </div>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:80px">系列：

                                            <?php echo $property[0]['building_name']  ?>
                                        </label>
                                    </div>
                                    <?php foreach($property as $key => $value):?>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:65px">编号：

                                            <?php echo $value['house_no'] ?>
                                        </label>
                                    </div>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:80px" >面积：

                                            <?php echo $value['area'] ?>
                                        </label>
                                    </div>
                                <?php endforeach ?>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:40px">合同月租金：

                                            <?php

                                                  $pay = CmsPurchasePayRule::model()->find("contract_id = '$list->id' order by the_order ");

                                                  if($pay) {
                                                     echo $pay->monthly_rent/100;
                                                  }
                                            ?>
                                          </label>
                                    </div>
                                       <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:40px">实际月租金：

                                            <?php echo $model?$model->acq_monthly_rent/100:''?>
                                      </label>
                                    </div>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:25px">合同标注佣金：

                                            <?php echo $list->commission/100?>
                                        </label>
                                    </div>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:-1px">车主实际支付佣金：

                                          <?php echo $model?$model->acq_real_commission/100:''?>
                                        </label>
                                    </div>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:55px">返回差额：

                                          <?php

                        											 if($model['acq_fan']){
                        												 	if($model['acq_real_commission']) {
                        														$a = ($model['acq_real_commission']/100-$model['acq_fan']/100);
                        														echo $a;

                        													}else {
                                                    $pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id' order by the_order" );
                        														$a = $list->commission/100-$type['acq_fan']/100;
                        														echo $a;


                        													}

                        											 }else{
                        												 		if($model['acq_real_commission']) {
                        															$pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id' order by the_order" );
                        															$a = $model['acq_real_commission']/100-$pay->monthly_rent/100*0.6;
                        															echo $a;


                        														}else {
                        															$pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id' order by the_order");
                        															$a = $list->commission/100-$pay->monthly_rent/100*0.6;
                        															echo $a;



                        														}
                        											 }

                        										 ?>
                                          </label>
                                    </div>
                                     <div class="control-group" style="margin-top:-30px;">
                                        <label style="margin-left:55px">渠道人员：

                                          <?php
                                                if($model->acq_broker!=null) {
                                                        $broker = explode(',',$model->acq_broker);

                                                        foreach($broker as $k => $v) {
                                                            $channel = CmsChannelManager::model()->find("id = '$v'");
                                                            echo $channel->name."&nbsp";
                                                        }
                                                }

                                            ?>
                                        </div>

                                        </label>
                                </div>

                                    <div class="form-actions" style="margin-top:-30px;">
                                    <form method='post' action='/admin/acquisition/pass' style="margin-left:30px">
                                        <input type='hidden' name='id' value="<?php echo $id?>">
                                        <input type='hidden' name='referer' value="<?php echo $referer?>">
                                        <button id='pass' type="submit" class="btn btn-primary">确认通过</button>
                                        <button id='nopass'  type="button" class="btn" >不通过</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </form>

                                    </div>

                                <div id='through' style='margin-left:180px; display:none'>
                                    <form action='/admin/acquisition/pass' method='post'>
                                       <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                        <label >不通过原因<span style="color:red">*</span></label><br>

                                        <textarea style="border:dotted 2px #00CC33; width:500px; height:100px" name='reason'  required ></textarea>
                                        <button id='tijiao' type="submit" class="btn btn-primary">提交</button>
                                        <button id='quxiao' type="button" class="btn" >取消</button>

                               </form>
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
<script type="text/javascript">



     jQuery('#nopass').click(function(){

            $('#through').css('display','block');

     })

     jQuery('#quxiao').click(function(){

           $('#through').css('display','none');
     })



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

        <button data-dismiss="modal" class="btn blue">OK</button>

    </div>

</div>
