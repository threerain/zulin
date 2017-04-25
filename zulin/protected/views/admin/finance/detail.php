<style type="text/css">
    .control-group{
        padding-bottom: 10px;
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-admin.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();
    ");
?>
    <style type="text/css">
        .control-label{
            width: 500px;
        } 
    </style>
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

                                <div class="caption"><i class="icon-reorder"></i>收款人-详情</div>

                                <div class="tools">
                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                    <div class="control-group">
                                        <label class="control-label">财务申请人: <span ><?php echo CHtml::encode(AdminUser::model()->find("id = '$model->admin_id'")['nickname'])?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">付款户名: <span ><?php echo CHtml::encode($model->payment_name); ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">付款银行: <span ><?php echo CHtml::encode($model->payment_bank); ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">付款银行账号: <span ><?php echo CHtml::encode($model->payment_number); ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">收款户名: <span ><?php echo CHtml::encode($model->payee); ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">收款银行: <span ><?php echo CHtml::encode($model->payee_bank); ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">收款银行账号: <span ><?php echo CHtml::encode($model->payee_number); ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">收款金额: <span ><?php echo CHtml::encode($model->payee_money)/100; ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">收款时间: <span ><?php echo CHtml::encode(date('Y-m-d',$model->payment_time)); ?></span></label>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">状态: <span ><?php echo CHtml::encode(str_replace(['1','2','3'], ['客服未确认','客服已确认','客服已确认'], $model->type)); ?></span></label>
                                    </div>
                                    <?php if ($model->type > 1) { ?>
                                        <div class="control-group">
                                            <label class="control-label">客服确认人: <span ><?php echo CHtml::encode(AdminUser::model()->find("id = '$model->confirm_id'")['nickname'])."<span style='margin-left:50px'>".CHtml::encode($model->confirm_time ? date('Y-m-d',$model->confirm_time) : '')."</span>" ?></span></label>
                                        </div>
                                        <?php
                                            $arr_house = [];
                                            $house = CmsPurchaseProperty::model()->findAll("contract_id ='$model->contract_id' and deleted = 0");
                                            if($house){
                                                foreach ($house as $k_house => $v_house) {
                                                    //车源id
                                                    $information = CmsProperty::model()->findAll("id = '{$v_house['property_id']}' and deleted = 0")[0];
                                                    //品牌
                                                    $list['estate_id'] = BaseEstate::model()->findAll("id = '{$information['estate_id']}' and deleted = 0")[0]['name'];
                                                    //系列
                                                    $list['building_id'] = BaseBuilding::model()->findAll("id = '{$information['building_id']}' and deleted = 0")[0]['name'];
                                                    //编号
                                                    $list['house_no'] = $information['house_no'];
                                                    $arr_house[] = $list['estate_id'].' / '.$list['building_id'].' / '.$list['house_no'];
                                                }
                                            }

                                         ?>
                                         <?php  foreach ($arr_house as $key => $value) { ?>
                                            <div class="control-group">
                                                <label class="control-label">品牌: <span ><?php echo $value; ?></span></label>
                                            </div>
                                        <?php  }?>
                                        <div class="control-group">
                                            <label class="control-label">租户: <span ><?php echo CHtml::encode($model->tenant_name); ?></span></label>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">付款周期: <span ><?php echo CHtml::encode(date('Y-m-d',$model->cycle_start)).'至'.CHtml::encode(date('Y-m-d',$model->cycle_end)); ?></span></label>
                                        </div>
                                        <div style="clear:both"></div> 
                                        <div class="control-grou" style="min-height:30px;margin-left: 50px;margin-top: 20px;">
                                            <button class="btn red " type="button" style="margin-top:-7px;" onclick="yulan()">预览</button>   
                                            <?php  foreach($list_photo as $k => $v) {    ?>                      
                                                <span class="test line21 yulans" style="display:none">
                                                  <a href="/admin/sersellcontract/download?id=<?php echo "$v" ?>&names='付款截图'" >下载</a><a target="_Blank" href="<?php echo $v ?>"><img src="<?php echo $v ?>" style="width:150px;height:100px;vertical-align:top" alt=""></a>
                                                </span> 
                                            <?php } ?>
                                        </div>
                                        <script type="text/javascript">
                                            function yulan(){
                                                $(".yulans").toggle();
                                            }
                                        </script>
                                    <?php } if ($model->type == 3) {?>
                                    <div class="control-group" >
                                        <label class="control-label" >财务确认已查看: <?php echo CHtml::encode(AdminUser::model()->find("id = '$model->fin_confirm_id'")['nickname'])."<span style='margin-left:50px'>".CHtml::encode($model->fin_confirm_time ? date('Y-m-d',$model->fin_confirm_time): '')."</span>"?></label>
                                    </div>
                                    <?php } ?>
                                    <?php if($model->type == 2){ ?>
                                        <div class="control-group" style="height:50px">
                                            <label class="control-label" >
                                                <a href="/admin/finance/finconfirm/id/<?php echo $model->id;?>" onclick="javascript:return confirm('确实要确认吗?');"><button class="btn-primary"><span style="">需确认收到消息</span></button></a>
                                            </label>
                                        </div>

                                    <?php    } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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