
  <!-- BEGIN PAGE LEVEL STYLES -->
<?php
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
  <!-- END PAGE LEVEL STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    TableManaged.init();");
?>
  <!-- End PAGE LEVEL SCRIPTS -->

<div class="page-content">
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

            <div class="caption"><i class="icon-globe"></i>收房合同应付列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span6">

                </div>
                <div class="span6">
                  <div class="btn-group pull-right">
                  </div>
                </div>
              </div>

              <form action="/admin/payable/combine" method="post">
              <input type="hidden" name="contract_id" value="<?php echo $contract_id ?>">
              
                 <div class="btn-group pull-left">
                  <?php if(AdminPositionModul::has_modul("101_08")) {?>
                  <!-- <a href="/admin/payable/addpay/contract_id/<?php echo $contract_id?>"> -->
                  <button id="sample_editable_1" class="btn btn-primary">
                  付款合并
                  </button>
                  </a>
                  <?php }?>
                </div> 
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th style="width:8px;">select</th>
                    <th class="hidden-480">拆分</th>
                    <th class="hidden-480">付款日</th>
                    <th class="hidden-480">付款周期</th>
                    <th class="hidden-480">付款项目</th>
                    <th class="hidden-480">付款金额(元)</th>
                    <th class="hidden-480">月租金(元)</th>
                    <th class="hidden-480">是否需要发票</th>
                    <th class="hidden-480">是否付款</th>
                    <th class="hidden-480">是否已开发票</th>
                    <th >操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($list2){
                    ?>
                    <?php
                    foreach($list2 as $key => $model){
                      ?>
                      <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="id[]" value="<?php echo $model->id; ?>" /></td>
                        <td><?php echo  $model->status==1?'拆':'' ?></td>
                        <td class="hidden-480"><?php echo date("Y-m-d",$model->pay_date); ?></td>
                        <td class="hidden-480"><?php echo date("Y-m-d",$model->start_time); ?>至<?php echo date("Y-m-d",$model->end_time); ?></td>
                        <td class="hidden-480"><?php echo $model->type==1?'押金':'首期租金' ?></td>
                        <td class="hidden-480"><?php echo $model->amount/100; ?></td>
                        <?php 
                          if ($key!=0) {
                           ?>
                        <td class="hidden-480"><?php echo $this->get_monthly_rent($contract_id,$model->start_time)/100; ?></td>
                           <?php 
                          }else{

                            ?>
                        <td class="hidden-480"> </td>

                            <?php 
                          }
                        ?>

                        <td class="hidden-480"><?php echo $contract->invoice==1?"是":"否"; ?></td>
                        <td class="hidden-480"><?php 
                          $criteria = new CDbCriteria();
                          $criteria->select = 'sum(amount) as amount';
                          $criteria->addCondition("payable_id='$model->id'");
                          $payments=CmsPurchasePayment::model()->find($criteria); 
                          if ($payments){
                            if ($payments->amount){
                              // echo $payments->amount;echo "-";
                              // echo $model->amount;
                              if($payments->amount>=$model->amount){
                                echo "是";
                              }
                              else{
                                echo "未付清:已付".$payments->amount/100;echo "元";
                              }
                            }
                            else{
                              echo "";//否
                            }
                          }
                          else{
                            echo "";//否
                          }
                        ?></td>
                        <td class="hidden-480"><?php echo $model->invoice?"是":""; ?></td>
                        <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                            <?php if(AdminPositionModul::has_modul("101_07") && $contract->reviewed==1) {?>
                            <a href="/admin/purchasecontract/payment/id/<?php echo $model->id;?>">付款</a>
                            <?php }?>

                             <a href="/admin/purchasecontract/paymentlist/id/<?php echo $model->id;?>">付款记录</a>  
                            <a href="/admin/payable/editpay/id/<?php echo $model->id;?>/contract_id/<?php echo $contract_id?>">修改</a>  
                            <a class="del_pay" data-toggle="modal" data-target="#about-modal"  href="" address="/admin/payable/deletepay/id/<?php echo $model->id;?>/contract_id/<?php echo $contract_id?>">删除</a>

                            <!--  <a href="/admin/purchasecontract/payment/id/<?php echo $model->id;?>">付款</a>  -->
                            <a href="/admin/payable/split/id/<?php echo $model->id;?>/contract_id/<?php echo $contract_id?>">拆分</a>  
                            <?php if(AdminPositionModul::has_modul("101_08") && $contract->reviewed==1) {?>
                            <?php if ($model->invoice==0){?>
                            <a href="/admin/purchasecontract/invoice/id/<?php echo $model->id;?>">已开发票</a>
                            <?php }?>
                            <?php }?>
                            </ul>
                          </div> 

  
                        </td>
                        <!-- <td ><span class="label label-success">Approved</span></td> -->
                      </tr>
                      <?php
                    }
                    ?>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
              </form>
              <br>
              <br>
              <br>
              <form action="/admin/payable/editpaydate">
              <input type="hidden" name="type" value="1">
              <input type="hidden" name="contract_id" value="<?php echo $contract_id ?>">
              <input type="number" name="day" class="span1">
              <button id="p_btn">批量修改提前付款天数</button>
            <script>
            $("#p_btn").click(function(){
              if($("input[name=day]").val()==''){
                alert('批量修改天数不能为空');
                return false;
              }
            })
            </script>

              </form>
              <form action="/admin/payable/combine" method="post">
              <input type="hidden" name="contract_id" value="<?php echo $contract_id ?>">
              
                 <div class="btn-group pull-left">
                  <?php if(AdminPositionModul::has_modul("101_08")) {?>
                  <!-- <a href="/admin/payable/addpay/contract_id/<?php echo $contract_id?>"> -->
                  <button id="sample_editable_1" class="btn btn-primary">
                  付款合并
                  </button>
                  </a>
                  <?php }?>
                </div> 
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th>
                    <th>拆分</th>
                    <th class="hidden-480">付款日</th>
                    <th class="hidden-480">付款周期</th>
                    <th class="hidden-480">付款金额(元)</th>
                    <th class="hidden-480">月租金(元)</th>
                    <th class="hidden-480">是否需要发票</th>
                    <th class="hidden-480">是否付款</th>
                    <th class="hidden-480">是否已开发票</th>
                    <th >操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($list){
                    ?>
                    <?php
                    foreach($list as $model){
                      ?>
                      <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="id[]" value="<?php echo $model->id; ?>" /></td>
                        <td><?php echo  $model->status==1?'拆':'' ?></td>
                        <td class="hidden-480"><?php echo date("Y-m-d",$model->pay_date); ?></td>
                        <td class="hidden-480"><?php echo date("Y-m-d",$model->start_time); ?>至<?php echo date("Y-m-d",$model->end_time); ?></td>
                        <td class="hidden-480"><?php echo $model->amount/100; ?></td>
                        <td class="hidden-480"><?php echo $this->get_monthly_rent($contract_id,$model->start_time)/100; ?></td>
                        <td class="hidden-480"><?php echo $contract->invoice==1?"是":"否"; ?></td>
                        <td class="hidden-480"><?php 
                          $criteria = new CDbCriteria();
                          $criteria->select = 'sum(amount) as amount';
                          $criteria->addCondition("payable_id='$model->id'");
                          $payments=CmsPurchasePayment::model()->find($criteria); 
                          if ($payments){
                            if ($payments->amount){
                              // echo $payments->amount;echo "-";
                              // echo $model->amount;
                              if($payments->amount>=$model->amount){
                                echo "是";
                              }
                              else{
                                echo "未付清:已付".$payments->amount/100;echo "元";
                              }
                            }
                            else{
                              echo "";//否
                            }
                          }
                          else{
                            echo "";//否
                          }
                        ?></td>
                        <td class="hidden-480"><?php echo $model->invoice?"是":""; ?></td>

                        <td>

                        <div class="btn-operation">
                          <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                            操作
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                          <?php if(AdminPositionModul::has_modul("101_07") && $contract->reviewed==1) {?>
                          <a href="/admin/purchasecontract/payment/id/<?php echo $model->id;?>">付款</a>
                          <?php }?>

                          <!--  <a href="/admin/purchasecontract/paymentlist/id/<?php echo $model->id;?>">付款记录</a>  -->
                          <a href="/admin/payable/editpay/id/<?php echo $model->id;?>/contract_id/<?php echo $contract_id?>">修改</a>  
                          <a class="del_pay" data-toggle="modal" data-target="#about-modal"  href="" address="/admin/payable/deletepay/id/<?php echo $model->id;?>/contract_id/<?php echo $contract_id?>">删除</a>

                          <!--  <a href="/admin/purchasecontract/payment/id/<?php echo $model->id;?>">付款</a>  -->
                          <a href="/admin/payable/split/id/<?php echo $model->id;?>/contract_id/<?php echo $contract_id?>">拆分</a>  
                          <?php if(AdminPositionModul::has_modul("101_08") && $contract->reviewed==1) {?>
                          <?php if ($model->invoice==0){?>
                          <a href="/admin/purchasecontract/invoice/id/<?php echo $model->id;?>">已开发票</a>
                          <?php }?>
                          <?php }?>
                          </ul>
                        </div>  
                        </td>
                        <!-- <td ><span class="label label-success">Approved</span></td> -->
                      </tr>
                      <?php
                    }
                    ?>
                    <?php
                  }
                  ?>
                </tbody>
              </table>

              </form>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination">

                    </div>
                  </div>
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

<div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-label">本站点提示...</h4>
                </div>
                <div class="modal-body">
                    <p>确定要删除吗?</p>
                </div>
                <div class="modal-footer">
                     <a id="left" class="btn btn-primary"  href="" onclick="javascript:return true;">确定</a>

                     <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
                </div>
            </div>
      </div>
</div>

<script>
$(function(){

  $(".del_pay").click(function(){

    $("#left").attr('href',$(this).attr('address'));
  })

})

</script>

<script type="text/javascript">
            jQuery('#sample .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                    } else {
                        $(this).attr("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                    } else {
                        $(this).attr("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });
</script>
