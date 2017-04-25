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

                                <div class="caption"><i class="icon-reorder">返佣信息</i></div>

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
                                    <?php foreach($property as $key => $value):?>
                                     <div class="control-group">
                                        <div class="controls">
                                             <p style="font-size:15px">品牌: <?php echo $value['estate_name'] ?></p>
                                        </div>
                                    </div>
                                     <div class="control-group">
                                        <div class="controls">
                                             <p style="font-size:15px">系列: <?php echo $value['building_name'] ?></p>

                                        </div>
                                    </div>
                                     <div class="control-group">
                                        <div class="controls">
                                             <p style="font-size:15px">编号: <?php echo $value['house_no']?></p>

                                        </div>
                                    </div>

                                <?php endforeach ?>
                                <div class="control-group">
                                    <div class="controls">
                                        <p style="font-size:15px">合同ID: <a href="/admin/salecontract/detail/id/<?php echo $id;?>"><?php echo $id; ?></a></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <p style="font-size:15px">月租金: <?php
                                            $pay = CmsPurchasePayRule::model()->find("contract_id='$id'");
                                            echo $pay?$pay->monthly_rent/100:'';
                                         ?></p>
                                    </div>
                                </div>
                                <div class="control-group">
                                      <div class="controls">
                                          <p style="font-size:15px">返佣金: <?php
                                            $commission = CmsPurchaseContract::model()->find("id='$id'");

                                                  echo $commission?$commission->commission/100:'';


                                           ?></p>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                        <div class="controls">
                                            <p style="font-size:15px">实际返佣金: <?php
                                                  echo $list?$list->commission/100:'';
                                             ?></p>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                          <div class="controls">
                                              <p style="font-size:15px">首期租金: <?php
                                                    echo $list?$list->commission/100:'';
                                               ?></p>
                                          </div>
                                      </div>
                                      <div class="control-group">
                                            <div class="controls">
                                                <p style="font-size:15px">押金: <?php
                                                      echo $list?$list->commission/100:'';
                                                 ?></p>
                                            </div>
                                        </div>
                                  <div class="control-group">
                                      <div class="controls">
                                          <p style="font-size:15px">渠道公司: <?php
                                                $channel_id = CmsPurchaseContract::model()->find("id='$id'");
                                                if($channel_id){
                                                    $channel = CmsChannel::model()->find("id='$channel_id->channel_id'");
                                                    echo $channel?$channel->name:'';
                                                }
                                           ?></p>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <div class="controls">
                                          <p style="font-size:15px">渠道负责人: <?php
                                              $manager = CmsPurchaseContract::model()->find("id='$id'");
                                              if($manager){
                                                $channel_manager = CmsChannelManager::model()->find("id='$manager->channel_manager_id'");
                                                echo $channel_manager?$channel_manager->name:'';
                                              }

                                           ?></p>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <div class="controls">
                                          <p style="font-size:15px">是否提交发票: <?php
                                              $invoice = CmsOutroom::model()->find("contract_id='$id'");
                                              if($invoice){
                                                if($invoice['invoice_type']==1){
                                                  echo '是';?>
                                                  <div class="control-group">
                                                        <div class="controls">
                                                            <p style="font-size:15px">发票图片:<a href="javascript:void(0)" id='preview'>预览</a>&nbsp;&nbsp;<a href="/admin/outroom/download?id=<?php
                                                            $invoice = CmsOutroom::model()->find("contract_id='$id'");
                                                                if($invoice){
                                                                      echo $invoice->avatar;
                                                                }
                                                            ?>"
                                                              >下载</a>
                                                        </p>
                                                        </div>
                                                    </div>
                                                    <div class="control-group" style="display:none;" id='image'>
                                                          <div class="controls">
                                                              <img src="<?php
                                                              $invoice = CmsOutroom::model()->find("contract_id='$id'");
                                                                  if($invoice['avatar']!=null){
                                                                        echo $invoice->avatar;
                                                                  }
                                                              ?>" alt="" style="width:500px;height:500px;"/>
                                                          </div>
                                                      </div>
                                              <?php  }else{
                                                  echo '否';
                                                };

                                              }

                                           ?></p>
                                      </div>
                                  </div>

                                    <div class="control-group" style = "margin-left:100px;  ";>
                                      <form action="/admin/outroom/entercommission" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                          <input type="hidden" name="id" value="<?php echo $id ?>">
                                          <input type="hidden" name="referer" value="<?php echo $referer?>">
                                        <button  type="submit" class="btn green submit js-btnadd">确认返佣</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1)" >返回</button>
                                      </form>
                                    </div>

                                        <!-- BEGIN FORM-->
                                        <!-- <div id="follow" class="portlet-body form" style="background-color:#fff;border:1px solid black;display:none;z-index:1;position:fixed;width:1000px;top:10%;left:30%;">
                                        <form action="/admin/outroom/entercommission" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            <input type="hidden" name="referer" value="<?php echo $referer?>">
                                            <div class="alert alert-error hide">
                                                <button class="close" data-dismiss="alert"></button>
                                                输入格式有误，请检查输入的数据.
                                            </div>
                                            <div class="alert alert-success hide">
                                                <button class="close" data-dismiss="alert"></button>
                                                数据输入验证成功!
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">操作人：</label>
                                                     <p style="font-size:15px"></p>

                                                <div class="controls">

                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label">返佣用户名：</label>
                                                <div class="controls">
                                                    <input name="commission_user" type="text"   required class="span2 m-wrap" value=""/ style="width:250px">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">返佣银行：</label>
                                                <div class="controls">
                                                    <input name="commission_bank" type="text"  required  class="span2 m-wrap" value=""/ style="width:250px">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">返佣卡号：</label>
                                                <div class="controls">
                                                    <input name="commission_num" type="text" required  class="span2 m-wrap" value=""/ style="width:250px" onkeyup="value=value.replace(/[^\d.]/g,'')">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">打款金额：</label>
                                                <div class="controls">
                                                    <input name="amount_money" type="text" required  class="span2 m-wrap" value=""/ style="width:250px" onkeyup="value=value.replace(/[^\d.]/g,'')">
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button id='sdf' type="submit" class="btn green submit js-btnadd">确认返佣</button>
                                                <button type="button" class="btn" id="quxiao" >取消</button>
                                            </div>
                                        </form>
                                              </div> -->
                                        <!-- END FORM-->


                               </div>
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
      $('#follow').toggle();
    })
    $("#quxiao").click(function(){
      $('#follow').css("display","none");
    })
    $("#preview").click(function(){
      $("#image").toggle();
    })
</script>
<!-- <script type="text/javascript">
$("#down").click(function(){

      var a = $(this).attr('address');
     alert(a);
      //var address = encodeURIComponent(a);
      // alert(address);
      $.ajax("/admin/outroom/download", {

          data: {
              id:a
          },
          dataType: "json"
      }).done(function(data){
         console.log();
      })
});
</script> -->
