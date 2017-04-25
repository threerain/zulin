<style>
  .myformitem .itemp{float:left;width:200px;text-align:right;padding-right:20px;line-height:30px;height:30px;}
  .myformitem .iteminput{float:left;height:30px;line-height:30px;}
  .myformitem{clear:both;}
  .myform{padding-bottom:50px;}
  .radio input[type="radio"], .checkbox input[type="checkbox"] {
    float: left;
    margin-left: 0px;
    margin-top: -10px;
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
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
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



                        <!-- BEGIN VALIDATION STATES-->

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder">申请返佣</i></div>

                                <div class="tools">
<!--
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                            </div>
                       </div>
                       <!-- 头部结束区域 -->
                    <form class="" action="/admin/outroom/create" id="form_edit" method="post">
                            <input type="hidden" name="id" value='<?php echo $id?>'>
                            <input type="hidden" name="referer" value='<?php  echo $referer?>'>
                            <div class="alert alert-error hide">
                                <button class="close" data-dismiss="alert"></button>
                                输入格式有误，请检查输入的数据.
                            </div>
                            <div class="alert alert-success hide">
                                <button class="close" data-dismiss="alert"></button>
                                数据输入验证成功!
                            </div>
                      <div class='myform'>

                            <h4 style='text-indent:50px;margin:30px;'>返佣信息</h4>

                            <div class='myformitem'>
                                <p class='itemp'>申请人 :</p>
                                <p class='iteminput'>
                                  	<input type="hidden" name="operator_id" id="hualiang_id" class="select2" style="width:200px;"
                                    value="<?php echo $list->operator_id?>" >
                                </p>
                            </div>

                            <div class='myformitem'>
                                <p class='itemp'>申请部门 :</p>
                                <p class='iteminput' id="shenqing">
                                    <?php
                                        $user =AdminUser::model()->find("id='$list->operator_id'");
                                        $area_name1 = AdminDepartment::model()->find("id='$user->department_id'");
                                        $area_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");
                                        echo $area_name1->name.'&nbsp';
                                        echo $area_name->name;
                                    ?>
                                </p>
                            </div>

                             <div class='myformitem'>
                                <p class='itemp'>申请部门总监 :</p>
                                <p class='iteminput'>
                                  <input type="hidden" name="director_id" data="" id="sale_id" class="select2" style="width:200px;" value="<?php echo $list->director_id?>">
                                </p>
                            </div>
                             <div class='myformitem'>
                                <p class='itemp'>项目 :</p>
                                <p class='iteminput' style="width:1000px">
                                    <?php
                                    $res = CmsPurchaseProperty::model()->find("contract_id='$id'");
                                    if($res){
                                      $data = CmsProperty::model()->find("id='$res->property_id'");
                                      if($data){
                                        $item = BaseEstate::model()->find("id='$data->estate_id'");
                                        echo $item?$item->name:"";
                                        echo '&nbsp';
                                      }
                                     }

                                     if($res){
                                       $data=CmsProperty::model()->find("id='$res->property_id'");
                                       if($data){
                                         $item=BaseBuilding::model()->find("id='$data->building_id'");
                                         echo $item?$item->name:"";
                                         echo '&nbsp';
                                       }
                                      }
                                      $res = CmsPurchaseProperty::model()->findAll("contract_id='$id'");
                                      if($res){
                                        foreach ($res as $key => $value) {
                                          $item = CmsProperty::model()->find("id='$value->property_id'");
                                          echo $item?$item->house_no:"";
                                          echo '&nbsp';

                                        }

                                      }
                                    ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>月租金 :</p>
                                <p class='iteminput'>
                                    <?php

                                          $pay = CmsPurchasePayRule::model()->find("contract_id='$model->id' order by the_order");

                                          echo $pay?number_format($pay->monthly_rent/100,2):''
                                    ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>渠道公司 :</p>
                                <p class='iteminput'>
                                    <?php
                                    $channel_id = CmsPurchaseContract::model()->find("id='$id'");
                                    if($channel_id){
                                        $channel = CmsChannel::model()->find("id='$channel_id->channel_id'");
                                        echo $channel?$channel['name']:'';
                                    }

                                    ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>渠道公司人员 :</p>
                                <p class='iteminput'>
                                  <?php
                                        $channel_manager_id = CmsPurchaseContract::model()->find("id='$id'");
                                        if($channel_manager_id){
                                            $channel_manager = CmsChannelManager::model()->find("id='$channel_manager_id->channel_manager_id'");
                                            echo $channel_manager?$channel_manager['name']:'';
                                        }
                                  ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>付款方式 :</p>
                                <p class='iteminput'>
                                      <?php

                                          $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");
                                          if (sizeof($pay)>0){
                                              foreach ($pay as $key => $value) {

                                            echo  '押'.$value->deposit_month.'付'.$value->pay_month;
                                      }
                                    }
                                      ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>首期租金 :</p>
                                <p class='iteminput'>
                                    <?php
                                                $criteria2 = new CDbCriteria;
                                                $criteria2->addCondition("t.deleted=0 and contract_id='$id'  and type=2 and the_order<2");
                                                $criteria2->order = "t.start_time";
                                                $list2 = CmsPurchaseReceivable::model()->findAll($criteria2)[0];
                                                $criteria = new CDbCriteria();
                                                $criteria->select = 'sum(amount) as amount';
                                                $criteria->addCondition("payable_id='$list2->id'");
                                                $payments=CmsPurchaseReceived::model()->find($criteria);
                                                if ($payments){
                                                  if ($payments->amount){
                                                    // echo $payments->amount;echo "-";
                                                    // echo $model->amount;
                                                    if($payments->amount>=$list2->amount){
                                                      echo "已收清";
                                                    }
                                                    else{
                                                      echo "未收清:已收".$payments->amount/100;echo "元 未收";
                                                      echo $list2->amount/100-$payments->amount/100;
                                                      echo '元';
                                                    }
                                                  }
                                                  else{
                                                    echo "待填写";//否
                                                  }
                                                }
                                                else{
                                                  echo "待填写";//否
                                                }


                                    ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>押金 :</p>
                                <p class='iteminput'>
                                  <?php

                                              $criteria2 = new CDbCriteria;
                                              $criteria2->addCondition("t.deleted=0 and contract_id='$id'  and type=1 and the_order<2");
                                              $criteria2->order = "t.start_time";
                                              $list2 = CmsPurchaseReceivable::model()->findAll($criteria2)[0];
                                              $criteria = new CDbCriteria();
                                              $criteria->select = 'sum(amount) as amount';
                                              $criteria->addCondition("payable_id='$list2->id'");
                                              $payments=CmsPurchaseReceived::model()->find($criteria);
                                              if ($payments){
                                                if ($payments->amount){
                                                  // echo $payments->amount;echo "-";
                                                  // echo $model->amount;
                                                  if($payments->amount>=$list2->amount){
                                                    echo "是";
                                                  }
                                                  else{
                                                    echo "未收清:已收".$payments->amount/100;echo "元 未收";
                                                    echo $list2->amount/100-$payments->amount/100;
                                                    echo '元';
                                                  }
                                                }
                                                else{
                                                  echo "";//否
                                                }
                                              }
                                              else{
                                                echo "";//否
                                              }


                                  ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>是否已经提交发票 :</p>
                                <p class='iteminput'>
                                   <input type='radio' name='invoice' value='1' <?php echo $list->invoice_type==1?"checked":''?> style='clear:both;float:none;' id='ok'>是&nbsp;&nbsp;&nbsp;&nbsp;
                                  <input type='radio' name='invoice' value='2' <?php echo $list->invoice_type==2?"checked":''?> style='clear:both;float:none;' id='no'>否
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>支付方式 :</p>
                                <p class='iteminput'>
                                   <input type='radio' required name='pay_type' value='1' <?php echo $list->pay_type==1?"checked":''?> style='clear:both;float:none;' id='ok'>现金支付&nbsp;&nbsp;&nbsp;&nbsp;
                                   <input type='radio' name='pay_type' value='2' <?php echo $list->pay_type==2?"checked":''?> style='clear:both;float:none;' id='no'>银行汇款&nbsp;&nbsp;&nbsp;&nbsp;
                                  <input type='radio' name='pay_type' value='2' <?php echo $list->pay_type==2?"checked":''?> style='clear:both;float:none;' id='no'>转账支票
                                  <span style='color:#f00'>*</span>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>规定返佣金额 :</p>
                                <p class='iteminput'>
                                  <?php

                                        $pay = CmsPurchasePayRule::model()->find("contract_id='$model->id' order by the_order");

                                        echo $pay?number_format($pay->monthly_rent/100*0.96,2):''
                                  ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>实际返佣金额 :</p>
                                <p class='iteminput'>
                                    <input type='text' name="amount_money" value="<?php echo $list->amount_money/100?$list->amount_money/100:''?>" required maxlength="10" placeholder="请输入数字,最多保留两位小数"  onblur="check(this.value,this);"><span style='color:#f00'>*</span>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp' style='height:60px;'>备注 :</p>
                                <p class='iteminput' style='height:60px;'>
                                    <textarea name="remark"><?php echo $list->remark ?></textarea>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>收款户名 :</p>
                                <p class='iteminput'>
                                    <input type='text' name="commission_user" value="<?php echo $list->commission_user?>" required><span style='color:#f00'>*</span>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>开户银行 :</p>
                                <p class='iteminput'>
                                    <input type='text' maxlength="40" name="commission_bank" value="<?php echo $list->commission_bank?>" required><span style='color:#f00'>*</span>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>收款账号 :</p>
                                <p class='iteminput'>
                                    <input type='text' onkeyup="value=value.replace(/[^\-?\d.]/g,'')" maxlength="20" name="commission_num" value="<?php echo $list->commission_num ?>" required><span style='color:#f00'>*</span>
                                </p>
                            </div>
                            <div class='myformitem' style='margin-top:60px;padding-left:200px;'>
                                <button class='btn btn-primary'>提交申请</button>
                                <button class='btn' type="button" onclick="history.go(-1)">取消</button>
                            </div>

                      </div>
</form>










                        <!-- END VALIDATION STATES-->
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
<script type="text/javascript">
$("#sdf").click(function(){
      var room_number = $("#room_number").val();
      $.ajax("/admin/outroom/getPurchase", {
          data: {
              id:room_number
          },
          dataType: "json"
      }).done(function (data) {
        if(data.contract==1){
              alert('您输入的车源已存在!');
              return;
        }


        if(data.contract != ''){
          var a ='';
          for(var i in data[0]){

            a += data[0][i]+"&nbsp;";
          }

          $(".fangjianhao1").html('编号:'+a);
          $('#loupan1').html("品牌:"+data.estate);
          $('#loudong1').html("系列:"+data.building);
          $("#contract").html('合同ID:'+"<a href='/admin/salecontract/detail/id/"+data.contract+"'>"+data.contract+"</a>");
          $("#channel").html("渠道公司:"+data.channel);
          $("#channel_manager").html("渠道负责人:"+data.manager);
          $("#commission").html("返佣金:"+data.commission);
          $("#monthly_rent").html("月租金:"+data.rent);
          $("#user").html("返佣用户名:"+data.commission_user);
          $("#bank").html("返佣银行:"+data.commission_bank);
          $("#num").html("返佣卡号:"+data.commission_num);
          $("#money").html("返佣金额:"+data.amount_money);
          $("#getContract").val(data.contract);
        }else{
          alert("您查询的车源没有签订出车合同!");
        }

      });

});
</script>
