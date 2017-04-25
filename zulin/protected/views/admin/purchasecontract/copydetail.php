<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/picjquery/assets/js/jquery.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/picjquery/dist/viewer.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/picjquery/assets/js/main.js',CClientScript::POS_END);

?>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/css/normalize.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/css/default.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/dist/viewer.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/picjquery/css/main.css');
?>

<!-- END PAGE LEVEL SCRIPTS -->;
<div class="page-content">
    <div id="portlet-config" class="modal hide">
    </div>
    <div class="container-fluid">
        <div class="row-fluid" style="min-height:10px;"></div>
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet box ">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>合同-复印件</div>
                    </div>
                    <!-- content -->
                    <div class="htmleaf-container">
                        <div class="container">
                            <div class="row">
                              <div class="col-sm-12 col-md-3">
                              </div>
                              <div class="col-sm-8 col-md-6">
                                <div class="docs-galley">
                                  <ul class="docs-pictures clearfix">
                                    <?php if ($contract_copy):?>
                                        <?php foreach ($contract_copy as $key => $value):?>
                                            <li style="max-width:100px;float:left;margin-left:10px;"><img data-original="<?php echo $value->url; ?>" src="<?php echo $value->url; ?>" alt="Picture"></li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                  </ul>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <a href="" class="btn "  onclick="javascript:history.go(-1)" style="margin-left:10%;margin-top:10%;">返回</a>
                    <!-- content_end -->
                </div>   
            </div>
        </div>
    </div>
</div>
   


