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
<?php if (AdminPositionModul::has_modul("1102_01")): ?>
                    
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
    
<?php if (AdminPositionModul::has_modul("1102_02")): ?>
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


<?php if (AdminPositionModul::has_modul("1102_03")): ?>
        <div class="control-group " style="float:left;">
            <label class="control-label">房产证详细信息</label>
            <div class="controls">
                <?php echo $house_property_card_text ?>
            </div>
        </div>    
<?php endif ?>


<?php if (AdminPositionModul::has_modul("1103_08")): ?>
        
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


<?php if (AdminPositionModul::has_modul("1102_04")): ?>
        <?php
            $freelease=CmsPruchaseFreeLease::model()->findAll("contract_id='$id' order by start_time");
            if (sizeof($freelease)>0){
                foreach ($freelease as $key => $value) {
        ?>               
                <div class="control-group" style="clear:both;" >
                    <label class="control-label">免租期<span class="required">*</span></label>
                    <div class="controlss">
                        <?php echo $value->start_time?date('Y-m-d',$value->start_time):"";?>至<?php echo $value->end_time?date('Y-m-d',$value->end_time):"";?>
                    </div>
                </div>
                <?php }?>
        <?php
            }
        ?> 
        <div class="control-group " >
            <label class="control-label">租期<span class="required" >*</span></label>
            <div class="controlss">
                <?php echo $limit['lease_term_start']?date('Y-m-d',$limit['lease_term_start']):""?>至<?php echo $limit['lease_term_end']?date('Y-m-d',$limit['lease_term_end']):""?>
                <?php echo $limit['lease_term_year']?$limit['lease_term_year']:""?>年<?php echo $limit['lease_term_month']?$limit['lease_term_month']:""?>月<?php echo $limit['lease_term_day']?$limit['lease_term_day']:""?>日
            </div>
        </div>
        <div id="lease_term_list">
            <?php
                foreach (CmsPurchasePayRule::model()->findAll("contract_id='$id' order by the_order") as $key => $value) {
            ?>
                <div class="control-group " >
                <label class="control-label">第<?php echo $value->the_order+1 ?>年<span class="required" >*</span></label>
                <div class="controlss">
                  <?php echo $value->start_time?date('Y-m-d',$value->start_time):"";?>至<?php echo $value->end_time?date('Y-m-d',$value->end_time):"";?>
                    月租金<?php echo $value->monthly_rent?$value->monthly_rent/100:""?>(元)
                    单价<?php echo $value->price_per_meter?$value->price_per_meter/100:""?>(元/天/㎡)
                    <?php if ($value->increasing_mode==1){?>
                        递增方式<?php echo $value->increasing_number?$value->increasing_number:""?>
                    <?php }elseif ($value->increasing_mode==2) {
                    ?>
                        递增方式<?php echo $value->increasing_number?$value->increasing_number/100:""?>
                    <?php
                    }
                    else{
                    ?>
                    <?php
                    }
                    ?>

                        <?php echo $value->increasing_mode==1?"%":""; ?>
                        <?php echo $value->increasing_mode==2?"元":""; ?>
                </div>
            </div>
            <?php
                }
            ?>

                        </form>
                    </div>   
                </div>
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

