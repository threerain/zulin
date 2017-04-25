<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2.min.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.inputmask.bundle.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
App.init();
");
?>
<style>
 .controls a>img{width:100px;height:160px;}
    .control-group{margin-bottom:0px !important;margin-top:0px !important;padding-bottom: 10px !important;}
    .controls{font-size:16px;line-height:19px;color:#555;width:220px;}
    .controlss{font-size:16px;line-height:35px;color:#555;}
    .form-horizontal .control-label{padding-top: 0px;!important;}
    .label{padding-top: 0px !important;font-size: 14px;font-weight: normal;line-height: 20px;margin-bottom: 5px}
    textarea{margin-left: 20px;margin-top: 5px}
    .yj-xg-btn{width: 95%;margin:15px auto;}
    .yj-xg-btn div {width: 24.9%;float:left;}
</style>
<!-- END PAGE LEVEL SCRIPTS -->;
<div class="page-content">
        <div class="alert alert-error hide">
            <button class="close" data-dismiss="alert"></button>
            输入格式有误，请检查输入的数据.
        </div>
        <div class="alert alert-success hide">
            <button class="close" data-dismiss="alert"></button>
            数据输入验证成功!
        </div>
    <div id="portlet-config" class="modal hide">
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="min-height:10px;"></div>
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet box ">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>合同-详情</div>
                    </div>
                    <form action="/admin/purchasecontract/copyeditsave" id="form_create"  method="post"  class="form-horizontal js-submit">
<?php if (AdminPositionModul::has_modul("1104_01")): ?>
                    
     <div class="control-group " style="float:left;">
        <label class="control-label">产权人身份证复印件</label>
        <div class="controls">
            <?php if ($limit['id_card_photo']): ?>
                <?php foreach ($limit['id_card_photo'] as $key => $value): ?>
                    <a  target = " _blank" href="<?php echo $value; ?>"><img src="<?php echo $value; ?>"  alt=""></a>
                <?php endforeach ?>            
            <?php endif ?>
        </div>
    </div>
<?php endif ?>
    
<?php if (AdminPositionModul::has_modul("1104_02")): ?>
        <div class="control-group " style="clear:both;float:left;">
            <label class="control-label">房产证</label>
            <div class="controls">
            <?php if ($limit['house_property_card_photo']): ?>
                <?php foreach ($limit['house_property_card_photo'] as $key => $value): ?>
                    <a target = " _blank" href="<?php echo $value; ?>"><img src="<?php echo $value; ?>" alt=""></a>
                <?php endforeach ?>            
            <?php endif ?>
            </div>
        </div>    
<?php endif ?>


<?php if (AdminPositionModul::has_modul("1104_03")): ?>
        <div class="control-group " style="float:left;">
            <label class="control-label">房产证详细信息</label>
            <div class="controls">
                <?php echo $house_property_card_text ?>
            </div>
        </div>    
<?php endif ?>


<?php if (AdminPositionModul::has_modul("1104_04")): ?>
        
    <div class="control-group " style="clear:both;float:left;">
        <label class="control-label">交割单</label>
        <div class="controls">
            <?php if ($limit['house_delivery_order_photo']): ?>
                <?php foreach ($limit['house_delivery_order_photo'] as $key => $value): ?>
                    <a target = " _blank" href="<?php echo $value; ?>"><img src="<?php echo $value; ?>" alt=""></a>
                <?php endforeach ?>            
            <?php endif ?>
        </div>
    </div>

<?php endif ?>    

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

<style>
.theFont{font-size: 20px;}
</style>

