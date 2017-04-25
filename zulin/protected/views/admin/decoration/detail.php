<style>
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
  #table input{border:0 none!important;color:#222;font-weight:bold;text-align:center;}
  #table{margin-left:-70px;}
  #table,#testtr{overflow:auto!important;}
   #table .yj-title-th th input{width:150px!important;}
    #table .testtd td input{width:150px!important;}
    input{border: 0px !important;}
    textarea{border: 0px !important;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
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
            <div class="caption"><i class="icon-reorder"></i>装修管理-详情</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div style="margin-left:40px;margin-bottom:50px">
                  <form  action="/admin/decoration/EditSave" style="margin:0;margin-top:30px;" id="form_add"  method="post"  class="form-horizontal js-submit">
                    <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      输入格式有误，请检查输入的数据.
                    </div>
                    <div class="alert alert-success hide">
                      <button class="close" data-dismiss="alert"></button>
                      数据输入验证成功!
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:20px;">
                      <span style="margin-left:52px;">
                        录入人：<?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"无";?>
                      </span>
                    </div>
                    <?php foreach ($allinfo as $key => $value): ?>
                    <div class="dataTables_filter" style="margin-bottom:20px;margin-left:65px;clear:both;">
                        <div style="float:left;width:350px;">
                          品牌：<?php echo $value['estate_name'] ;?>
                        </div>
                        <div style=";float:left;width:240px;">
                          系列：<?php echo $value['building_name']  ?>
                        </div>
                        <div style="float:left;width:240px;margin-left:40px;">
                          编号：<?php echo $value['house_no'] ?>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <?php endforeach ?>
                    <div  class="dataTables_filter" style="margin-bottom:20px;margin-left:28px;">
                      建筑总面积：<?php echo $sum_area['sum_area'].'㎡'; ?>
                    </div>
                  <?php if($model->status!=2):?>
                    <div class="dataTables_filter" style="margin-bottom:20px;margin-left:40px;clear:both;">
                        <div style="float:left;width:310px;">
                          工程工长：<?php echo $model->foreman;?>
                        </div>
                        <div style="float:left;width:295px;">
                          工程管理部人员：<?php $item=AdminUser::model()->find("id='$model->supervisor'"); echo $item?$item->nickname:"";?>
                        </div>
                        <div style="float:left;width:240px;">
                          施工管理部人员：<?php $item=AdminUser::model()->find("id='$model->docking_people'"); echo $item?$item->nickname:"";?>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:20px;clear:both;">
                        <div style="float:left;width:260px;">
                          整体工程起止日：<?php echo $model->project_start_time?date('Y-m-d',$model->project_start_time):""?>至<?php echo $model->project_end_time?date('Y-m-d',$model->project_end_time):""?>
                        </div>
                        <div style="float:left;width:260px;">
                          施工管理部与工程对接方案日期：<?php echo $model->docking_date?date('Y-m-d',$model->docking_date):""?>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:3px;margin-left:26px;">
                      <span>
                        附件(下载)：
                      </span>
                    </div>
                    <!-- 上传附件 -->
                    <div class="dataTables_filter" style="<?php echo $attachment==null?'display: none':''; ?>">
                      <div class="control-group" style="margin:0;">
                        <?php if ($attachment): ?>
                            <?php foreach ($attachment as $key => $value): ?>
                        <div class="controls">
                          <div id="attachment_photo_div">
                            <a class="download" href="/admin/decoration/downloadAttachment?url=<?php echo $attachment_photo[$key];?>&&attachment=<?php echo $value; ?>"><?php echo $value; ?></a>
                          </div>
                        </div>
                          <?php  endforeach ?>
                        <?php endif ?>
                      </div>
                    </div>
                    <!--上传附件结束 -->
                    <!-- 上传CAD图片 -->
                    <div class="control-group" style="margin:0;">
                      <div class="controls">
                        <div id="list_photo_div" style="float:left;height:130px;<?php echo $list_photo==null?'display: none':''; ?>">
                          <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                          <?php if ($list_photo): ?>
                          <?php foreach ($list_photo as $key => $value): ?>
                            <a target="_Blank" href="<?php echo $value ?>"><img name="list_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
                            <a class="download" style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/decoration/download?url=<?php echo $value;?>">下载</a>
                          <?php  endforeach ?>
                          <?php endif ?>
                        </div>
                      </div>
                    </div>
                    <!-- 上传CAD图片结束 -->

                    <div class="btn-group pull-left">
                      <h4>价格预算</h4>
                    </div>
                    <!-- 上传价格预算扫描件 -->
                    <div class="dataTables_filter" style="clear:both;">
                      <div class="control-group" style="margin:0;">
                        <div class="controls">
                            <div id="budget_photo_div" style="float:left;100%;height:130px;<?php echo $budget_photo==null?'display: none':''; ?>">
                              <img name="budget_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'>
                              <?php if ($budget_photo): ?>
                              <?php foreach ($budget_photo as $key => $value): ?>
                                <a target="_Blank" href="<?php echo $value ?>"><img name="budget_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:120px;float:left;margin-left:10px'/></a>
                                <a class="download" style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/decoration/download?url=<?php echo $value;?>">下载</a>
                              <?php  endforeach ?>
                              <?php endif ?>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- 上传价格预算扫描件 -->
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>注明：若工期延期，按照延期天数，视情节轻重给予工长500--1000元/天处罚。若装修材料规格及品牌未按照公司规定标准与上述报表不符有弄虚作行为，则视情节轻重给予工长5000--50000元处罚，并承担因工程施工质量及材料质量问题所造成的一切后续安全责任。若工长在工程装修报价时漏项，则按照漏项部分总金额的50%给予工长处罚，若情况特别严重者，将给予总工程款的50%给予处罚。（如有特殊情况需幼狮装饰总经理签字，方可降低处罚或避免处罚。）</span>
                    </div>
                    <div class="span8">
                      <table class="table table-striped table-bordered table-hover" id="table"><!-- ID sample_1目前没用,js中控制显示效果 -->
                        <thead>
                          <tr class="yj-title-th">
                            <th><input type="text" value="序号"></th>
                            <th><input type="text" value="施工清单及材料"></th>
                            <th><input type="text" value="单位"></th>
                            <th><input type="text" value="材料规格及品牌"></th>
                            <th><input type="text" value="数量"></th>
                            <th><input type="text" value="单价"></th>
                            <th><input type="text" value="预算合计"></th>
                          </tr>
                        </thead>
                        <?php
                            if($quality_budget){
                        ?>
                        <tbody id="testtr">
                        <?php
                          $count=1;
                          foreach ($quality_budget as $key => $value){
                        ?>
                        <tr class="testtd">
                          <td><?php echo $count;?></td>
                          <td><?php echo $value->list_material;?></td>
                          <td><?php echo $value->unit;?></td>
                          <td><?php echo $value->material_brands;?></td>
                          <td><?php echo $value->number?$value->number/100:"";?></td>
                          <td><?php echo $value->unit_price?$value->unit_price/100:"";?></td>
                          <td><?php echo $value->total?$value->total/100:"";?></td>
                       </tr>
                        <?php
                            $count++;
                          }
                        ?>
                        </tbody>
                        <?php }?>
                      </table>
                    </div>
                    <div style="clear:both;"></div>
                    <?php
                      if($quality_settlement || $settlement_photo):
                    ?>
                      <div class="btn-group pull-left">
                        <h4>价格结算</h4>
                      </div>
                      <div style="clear:both;"></div>
                      <div style="clear:both;">
                        <span style="margin-left:118px;">
                          录入人：<?php $data = QualityBudgetSettlement::model()->find("decoration_id='$model->id' and type=2"); $item=AdminUser::model()->find("id='$data->creater_id'"); echo $item?$item->nickname:"无";?>
                        </span>
                      </div>
                      <div class="dataTables_filter">
                        <span style="line-height:33px;margin-left:65px;">实际工程起止日：<?php echo $quality_follow->actual_start_time?date('Y-m-d',$quality_follow->actual_start_time):""?>&nbsp;至&nbsp;<?php echo $quality_follow->actual_end_time?date('Y-m-d',$quality_follow->actual_end_time):""?></span>
                      </div>
                      <div class="dataTables_filter">
                        <span style="line-height:33px;">实际花费与预计花费的差额：<?php echo $quality_follow->actual_expected;?></span>
                      </div>
                      <div class="dataTables_filter">
                        <span style="line-height:33px;margin-left:105px;">差额原因：<textarea name="reason"  rows="5" style="width:350px;resize: none;" readonly=true ><?php echo $quality_follow->reason;?></textarea></span>
                      </div>
                      <!-- 上传价格结算扫描件 -->
                      <div class="dataTables_filter" style="clear:both;">
                        <div class="control-group" style="margin:0;">
                          <div class="controls">
                              <div id="settlement_photo_div" style="float:left;100%;height:130px;<?php echo $settlement_photo==null?'display: none':''; ?>">
                                <img name="settlement_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'>
                                <?php if ($settlement_photo): ?>
                                <?php foreach ($settlement_photo as $key => $value): ?>
                                  <a target="_Blank" href="<?php echo $value ?>"><img name="settlement_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:120px;float:left;margin-left:10px'/></a>
                                  <a class="download" style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/decoration/download?url=<?php echo $value;?>">下载</a>
                                <?php  endforeach ?>
                                <?php endif ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      <!-- 上传价格结算扫描件 -->
                      <div class="span8">
                        <table class="table table-striped table-bordered table-hover" id="table"><!-- ID sample_1目前没用,js中控制显示效果 -->
                          <thead >
                            <tr class="yj-title-th">
                              <th><input type="text" value="序号"></th>
                              <th><input type="text" value="施工清单及材料"></th>
                              <th><input type="text" value="单位"></th>
                              <th><input type="text" value="材料规格及品牌"></th>
                              <th><input type="text" value="数量"></th>
                              <th><input type="text" value="单价"></th>
                              <th><input type="text" value="预算合计"></th>
                            </tr>
                          </thead>
                          <tbody id="testtr2">
                          <?php
                            $count=1;
                            foreach ($quality_settlement as $key => $value){
                          ?>
                            <tr class="testtd2">
                              <td><?php echo $count;?></td>
                              <td><?php echo $value->list_material;?></td>
                              <td><?php echo $value->unit;?></td>
                              <td><?php echo $value->material_brands;?></td>
                              <td><?php echo $value->number?$value->number/100:"";?></td>
                              <td><?php echo $value->unit_price?$value->unit_price/100:"";?></td>
                              <td><?php echo $value->total?$value->total/100:"";?></td>
                           </tr>
                          <?php
                              $count++;
                            }
                          ?>
                          </tbody>
                        </table>
                      </div>
                    <?php endif ?>
                  <?php endif ?>
                    <div class="form-actions" style="clear:both;margin-top:100px;text-align:center;">
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
