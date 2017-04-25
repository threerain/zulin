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
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <p style="font-size:15px">申请人: <?php
                                                      $operator_id = CmsOutroom::model()->find("contract_id = '$model->id'");
                                                      if($operator_id){
                                                        $operator = AdminUser::model()->find("id = '$operator_id->operator_id'");
                                                        echo $operator?$operator['account']:'';
                                                      }
                                                      ?></p>
                                        </div>
                                    </div>
                                    <?php
                                        $operator_id = CmsOutroom::model()->find("contract_id = '$model->id'");
                                        if($operator_id['check_type']==2){
                                          ?>
                                          <div class="control-group">
                                              <div class="controls">
                                                  <p style="font-size:15px">销售总监: <?php
                                                              $operator = AdminUser::model()->find("id = '$operator_id->check_one'");
                                                              echo $operator?$operator['account']:'';
                                                            ?></p>
                                              </div>
                                          </div>
                                        <?php
                                        }
                                    ?>
                                    <div class="control-group">
                                       <div class="controls">
                                            <p style="font-size:15px">品牌: <?php echo $property[0]['estate_name'] ?></p>
                                       </div>
                                   </div>
                                    <div class="control-group">
                                       <div class="controls">
                                            <p style="font-size:15px">系列: <?php echo $property[0]['building_name'] ?></p>

                                       </div>
                                   </div>
                                   <?php foreach($property as $key => $value):?>

                                    <div class="control-group">
                                       <div class="controls">
                                            <p style="font-size:15px">编号: <?php echo $value['house_no']?></p>

                                       </div>
                                   </div>
                                 <?php endforeach ?>

                                    <div class="control-group">
                                        <div class="controls">
                                          <p style="font-size:15px">合同ID: <a href="/admin/salecontract/detail/id/<?php echo $id;?>"><?php echo $id;?></a></p>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <div class="controls">
                                             <p style="font-size:15px">月租金:  <?php echo $pay?$pay->monthly_rent/100:''?></p>

                                        </div>
                                    </div>
                                     <div class="control-group">
                                        <div class="controls">
                                            <p style="font-size:15px" >返佣金:<?php echo $list['commission']?$list->commission/100:$model->commission/100?></p>
                                          </div>
                                        </div>
                                        <div class="control-group">

                                           <div class="controls">
                                                <p style="font-size:15px">渠道公司: <?php  $channel = CmsChannel::model()->find("id='$model->channel_id'"); echo $channel?$channel['name']:'';?> </p>
                                           </div>
                                       </div>
                                             <div class="control-group">
                                                <div class="controls">
                                                     <p style="font-size:15px">渠道公司负责人:<?php  $channel_manager = CmsChannelManager::model()->find("id='$model->channel_manager_id'"); echo $channel_manager?$channel_manager['name']:''?></p>

                                                </div>
                                            </div>
                                            <div class="control-group">
                                               <div class="controls">
                                                    <p style="font-size:15px">是否已提交发票: <?php
                                                        $invoice = CmsOutroom::model()->find("contract_id='$id'");
                                                        if($invoice){
                                                          if($invoice['invoice_type']==1){
                                                            echo '是';
                                                          }else{
                                                            echo '否';
                                                          };

                                                        }

                                                     ?></p>

                                               </div>
                                           </div>
                                           <?php
                                           $invoice = CmsOutroom::model()->find("contract_id='$id'");
                                           if($invoice){
                                               if($invoice){
                                                 ?>
                                                 <div class="control-group">
                                                     <div class="controls">
                                                         <p style="font-size:15px">返佣用户名: <?php
                                                             $commission = CmsOutroom::model()->find("contract_id='$id'");
                                                             echo  $commission->commission_user;
                                                          ?></p>
                                                     </div>
                                                 </div>
                                                 <div class="control-group">
                                                     <div class="controls">
                                                         <p style="font-size:15px">返佣银行: <?php
                                                             $commission = CmsOutroom::model()->find("contract_id='$id'");
                                                             echo  $commission->commission_bank;
                                                          ?></p>
                                                     </div>
                                                 </div>
                                                 <div class="control-group">
                                                     <div class="controls">
                                                         <p style="font-size:15px">返佣卡号: <?php
                                                             $commission = CmsOutroom::model()->find("contract_id='$id'");
                                                             echo  $commission->commission_num;
                                                          ?></p>
                                                     </div>
                                                 </div>
                                                 <div class="control-group">
                                                     <div class="controls">
                                                         <p style="font-size:15px">打款金额: <?php
                                                             $commission = CmsOutroom::model()->find("contract_id='$id'");
                                                             echo  $commission->amount_money/100;
                                                          ?></p>
                                                     </div>
                                                 </div>
                                           <?php
                                             }
                                           }?>
                                           <div class="control-group">
                                              <div class="controls">
                                                   <p style="font-size:15px">备注:<?php
                                                   $remark = CmsOutroom::model()->find("contract_id='$id'");
                                                   echo $remark?$remark->remark:''
                                                   ?></p>

                                              </div>
                                          </div>
                                          <div class="control-group">
                                             <div class="controls">
                                               <button id='tijiao' type="submit" class="btn green submit js-btnadd">查询</button>
                                             </div>
                                         </div>
                                            <div class="form-actions">
                                              <form action='/admin/outroom/morepass' method='post'>
                                                  <input type="hidden" name="id" value="<?php echo $id ?>">
                                                  <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                                  <div class="control-group">
                                                      <label class="control-label">实际返佣金:</span></label>
                                                     <div class="controls">
                                                       <input  type="text" name="commission" required onkeyup="value=value.replace(/[^\d.]/g,'')">
                                                     </div>
                                                 </div>
                                                <button type="submit" id='pass' class="btn green" >审核通过</button>
                                                <button type="button" id='nopass'   class="btn red" >审核不通过</button>
                                                <button type="button" class="btn"  onclick="javascript:history.go(-1);">返回</button>
                                              </form>
                                            </div>
                                    </div>

                                    <div id='through' style='margin-left:180px;display:none'>
                                        <form action='/admin/outroom/nopass' method='post'>
                                          <p style='font-size:15px'>
                                            不通过原因：
                                          </p>
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                            <textarea style="border:dotted 2px #00CC33; width:500px; height:100px" name='reason'  required ></textarea>
                                            <button id='tijiao' type="submit" class="btn green submit js-btnadd">提交</button>
                                            <button id='quxiao' type="button" class="btn" >取消</button>

                                   </form>
                                   </div>


                                </div>

                                <script type="text/javascript">



                                     jQuery('#nopass').click(function(){

                                            $('#through').css('display','block');

                                     })

                                     jQuery('#quxiao').click(function(){

                                           $('#through').css('display','none');
                                     })



                                </script>

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
