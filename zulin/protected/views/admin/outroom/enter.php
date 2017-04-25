<style>
  .myformitem .itemp{float:left;width:200px;text-align:right;padding-right:20px;line-height:30px;height:30px;}
  .myformitem .iteminput{float:left;line-height:30px;}
  .myformitem{clear:both;}
  .myform{padding-bottom:50px;overflow:hidden;}
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



                        <!-- BEGIN VALIDATION STATES-->

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder">返佣审核</i></div>

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

                      <div class='myform'>
                            <h4 style='text-indent:50px;margin:30px;'>返佣审核</h4>

                            <div class='myformitem'>
                                <p class='itemp'>申请人 :</p>
                                <p class='iteminput'>
                                    <?php
                                          $user = AdminUser::model()->find("id='$list->operator_id'");
                                          echo $user->nickname;
                                    ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>申请人部门 :</p>
                                <p class='iteminput'>
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
                                <p class='itemp'>制单人 :</p>
                                <p class='iteminput'>
                                    <?php
                                          $user = AdminUser::model()->find("id='$list->proposer_id'");
                                          echo $user->nickname;
                                      ?>
                                </p>
                            </div>
                             <div class='myformitem'>
                                <p class='itemp'>品牌 :</p>
                                <p class='iteminput' style="width:200px">
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

                                    ?>
                                </p>
                                <p class='itemp'>系列 :</p>
                                <p class='iteminput' style="width:200px">
                                    <?php
                                        $res = CmsPurchaseProperty::model()->find("contract_id='$id'");
                                        if($res){
                                          $data=CmsProperty::model()->find("id='$res->property_id'");
                                          if($data){
                                            $item=BaseBuilding::model()->find("id='$data->building_id'");
                                            echo $item?$item->name:"";
                                            echo '&nbsp';
                                          }
                                         }
                                    ?>
                                </p>
                                <p class='itemp'>编号 :</p>
                                <p class='iteminput'>
                                    <?php
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
                             <!-- <div class='myformitem'>
                                <p class='itemp'>月租金 :</p>
                                <p class='iteminput'>
                                    <a href="#">合同ID</a>
                                </p>
                            </div> -->
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
                                <p class='itemp'>渠道负责人 :</p>
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
                                     <?php
                                          if($list->invoice_type==1) {
                                                echo '是';
                                          }
                                          if($list->invoice_type==2) {
                                                echo '否';
                                          }
                                     ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>规定返佣金 :</p>
                                <p class='iteminput'>
                                  <?php

                                        $pay = CmsPurchasePayRule::model()->find("contract_id='$model->id' order by the_order");

                                        echo $pay?number_format($pay->monthly_rent/100*0.96,2):''
                                  ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>备注 :</p>
                                <p class='iteminput'>
                                    <?php echo  $list->remark?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>收款户名 :</p>
                                <p class='iteminput'>
                                    <?php echo $list->commission_user?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>账号 :</p>
                                <p class='iteminput'>
                                    <?php echo $list->commission_bank ?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>开户行 :</p>
                                <p class='iteminput'>
                                    <?php echo $list->commission_bank?>
                                </p>
                            </div>
                            <div class='myformitem'>
                                <p class='itemp'>实际返佣金 :</p>
                                <p class='iteminput'>
                                    <?php echo $list->amount_money/100?>
                                </p>
                            </div>
                            <?php if($list->check_type!=null) {?>
                              <div class='myformitem'>
                                  <p class='itemp'>状态 :</p>
                                  <p class='iteminput'>
                                      <?php if($list->check_type==null) {
                                          echo '未申请';
                                      }else if($list->check_type==1) {
                                          echo '未审核';
                                      }else if($list->check_type==2 ) {
                                            echo '审核中'."<br>";
                                            $check_one = AdminUser::model()->find("id='$list->check_one'");
                                            echo $check_one->nickname."已通过";
                                      }else if($list->check_type==3) {
                                            echo '审核中'."<br>";
                                            $check_one = AdminUser::model()->find("id='$list->check_one'");
                                            echo $check_one->nickname."已通过"."<br>";
                                            $check_two = AdminUser::model()->find("id='$list->check_two'");
                                            echo $check_two->nickname."已通过";
                                      }else if($list->check_type==5) {
                                              echo '审核未通过';
                                      }else if($list->check_type==6) {
                                              echo '财务未审核'."<br>";
                                              $check_one = AdminUser::model()->find("id='$list->check_one'");
                                              echo $check_one->nickname."已通过"."<br>";
                                              $check_two = AdminUser::model()->find("id='$list->check_two'");
                                              echo $check_two->nickname."已通过"."<br>";
                                              $check_three = AdminUser::model()->find("id='$list->check_three'");
                                              echo $check_three->nickname."已通过"."<br>";
                                      }else if($list->check_type==7 ) {
                                            echo '财务审核中'."<br>";
                                            $check_one = AdminUser::model()->find("id='$list->check_one'");
                                            echo $check_one->nickname."已通过"."<br>";
                                            $check_two = AdminUser::model()->find("id='$list->check_two'");
                                            echo $check_two->nickname."已通过"."<br>";
                                            $check_three = AdminUser::model()->find("id='$list->check_three'");
                                            echo $check_three->nickname."已通过"."<br>";
                                            $money_one = AdminUser::model()->find("id='$list->money_one_type'");
                                            echo $money_one->nickname."已通过"."<br>";
                                      }else if($list->check_type==8) {
                                        echo '财务通过'."<br>";
                                        $check_one = AdminUser::model()->find("id='$list->check_one'");
                                        echo $check_one->nickname."已通过"."<br>";
                                        $check_two = AdminUser::model()->find("id='$list->check_two'");
                                        echo $check_two->nickname."已通过"."<br>";
                                        $check_three = AdminUser::model()->find("id='$list->check_three'");
                                        echo $check_three->nickname."已通过"."<br>";
                                        $money_one = AdminUser::model()->find("id='$list->money_one_type'");
                                        echo $money_one->nickname."已通过"."<br>";
                                        $money_one = AdminUser::model()->find("id='$list->money_two_type'");
                                        echo $money_one->nickname."已通过"."<br>";
                                      }else if($list->check_type==10) {
                                            echo '已打款';
                                      }
                                      ?>
                                  </p>
                              </div>
                            <?php }?>
                              <?php
                                    if($list->check_type == 5) {?>
                                        <div class='myformitem'>
                                            <p class='itemp'>未通过原因 :</p>
                                            <p class='iteminput'>
                                                <?php
                                                        echo $list->reason;
                                                ?>
                                            </p>
                                        </div>
                                  <?php    }
                              ?>
                            <div class='myformitem' style='padding-left:200px;'>
                              <form style='margin-top:30px;' method="post" action="/admin/outroom/pass" class='myform'>
                                <input type="hidden" name="id" value="<?php echo $id?>">
                                <?php if($list->check_type!=8 ) {
                                      $id = Yii::app()->session["admin_uid"];
                                      $name = AdminUser::model()->find("id='$id'");
                                      if($name->nickname=="李冰"||$name->nickname=="牛腾飞"||$name->nickname=="何红梅"||$name->nickname=="黄鑫"||$name->nickname=="陈淑明"||$name->nickname=="尹卓") {?>
                                        <button class='btn btn-primary'>审核通过</button>
                                        <button class='btn btn-primary' type="button"   id='nopasslist'>审核不通过</button>

                                    <?php  }
                                             }else if($list->check_type==8) {
                                                $id = Yii::app()->session["admin_uid"];
                                                $name = AdminUser::model()->find("id='$id'");
                                                if($name->nickname=="韩剑侠") {?>


                                    <button class='btn btn-primary'>确认打款</button>

                               <?php
                              }

                                    }
                                ?>

                                <button class='btn btn-default' onclick="history.go(-1)">取消</button>
                            </div>
                          </form>

<form style='margin-top:-60px;display:none'  method="post" action="/admin/outroom/nopass" id='nopasscontent' class='myform'>
                            <input type="hidden" name="id" value="<?php echo $id?>">
                            <input type="hidden" name="referer" value="<?php echo $referer?>">
                            <div class='myformitem'>
                                <p class='itemp'>审核不通过原因 :</p>
                                <p class='iteminput'>
                                    <textarea placeholder="审核不同过原因" name="reason"></textarea>
                                </p>
                            </div>
                             <div class='myformitem' style='margin-top:60px;padding-left:200px;'>
                                <button class='btn btn-primary'>提交</button>
                                <button class='btn btn-default' type="button" id="nopass1">取消</button>
                            </div>
</form>
                      </div>











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
<script>

$(function(){
  $('#nopasslist').click(function(){
    $('#nopasscontent').toggle();
  })
  $("#nopass1").click(function() {
      $("#nopasscontent").toggle();
  })

})

</script>
