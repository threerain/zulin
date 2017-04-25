<style>
  .dataTables_filter{padding-left:100px;margin-top:40px!important;}
  label{display:inline;}
  div>b{font-size:19px;margin-left:30px;font-weight:bold;}
  b{font-weight:normal;}
  .control-group{
      float: left;
      width:300px;
  }
  .control-label{
       float: left;
       padding-right:10px!important;
       text-align:right
  }
  .controls{
       float: left
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();");
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
          <div class="container-fluid">
              <div class="row-fluid" style="min-height:10px;"></div>
              <div class="row-fluid">
                  <div class="span12">
                      <div class="portlet box green">
                          <div class="portlet-title">
                              <div class="caption"><i class="icon-reorder"></i>交房-详情</div>
                              <div class="tools">
                              </div>
                          </div>
                          <div class="portlet-body form" style="overflow:hidden;">
                          <div style="border:1px solid #C0C0C0; width:1100px;min-height:200px;margin-left:30px;margin-bottom:30px">
                          <div class="span8" style="margin-top:20px;margin-bottom:0px;"><b>基本信息</b></div>
                              <div class="control-group">
                                  <label class="control-label">客服交房人: </label>
                                  <div class="controls">
                                      <span><?php echo AdminUser::model()->find("id='{$model['creater_id']}' and deleted=0")['nickname']  ?></span>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >实际交房日期：</label>
                                  <div class="controls">
                                      <span><?php echo date('Y-m-d',$model['actual_date']) ?></span>
                                  </div>
                              </div>
                              <div style="clear:both"></div>
                              <?php foreach($data as $k => $v) { ?>  
                                  <div class="control-group">
                                      <label class="control-label" >楼&nbsp;&nbsp;  盘：</label>
                                      <div class="controls">
                                          <span><?php echo $v['estate_id'] ?></span>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label" >楼&nbsp; &nbsp;  栋：</label>
                                      <div class="controls">
                                          <span><?php echo $v['building_id'] ?></span>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label" >编号：</label>
                                      <div class="controls">
                                          <span><?php echo $v['house_no'] ?></span>
                                      </div>
                                  </div>
                                  <div style="clear:both"></div>
                              <?php }  ?> 
                              <div class="control-group">
                                  <label class="control-label" >到场人员类型：</label>
                                  <div class="controls">
                                      <span><?php echo str_replace([1,2],['租户本人','代理人'],$model['information_type']) ?></span>
                                  </div>
                              </div> 
                              <div style="clear:both"></div>
                              <div  id="zuhu" <?php echo $model['information_type']==1 ? "style='display:black;' ":"style='display:none;' " ?>>
                                  <div class="control-group">
                                      <label class="control-label" >租户姓名：</label>
                                      <div class="controls">
                                          <span><?php echo $model['tenant'] ?></span>
                                      </div>
                                  </div>
                                  <?php $tenant_phone = explode('/',$model['tenant_phone']); ?>
                                  <div class="control-group">
                                      <label class="control-label" >电话1：</label>
                                      <div class="controls">
                                          <span><?php echo $tenant_phone[0] ? $tenant_phone[0] :'' ?></span>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label" >电话2：</label>
                                      <div class="controls">
                                          <span><?php echo !empty($tenant_phone[1]) ? $tenant_phone[1] :'无' ?></span>
                                      </div>
                                  </div>
                              </div> 
                              <div  id="dailiren" <?php echo $model['information_type']==2 ? "style='display:black;'' ":"style='display:none;' " ?>>
                                  <div class="control-group">
                                      <label class="control-label" >代理人类型：</label>
                                      <div class="controls">
                                          <span><?php echo str_replace([1,2,3,4,5],['朋友','华亮','物业公司','职员','亲戚'],$model['agent_type']) ?></span>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label" >代理人姓名：</label>
                                      <div class="controls">
                                          <span><?php echo $model['agent'] ?></span>
                                      </div>
                                  </div>
                                  <?php $agent_phone = explode('/',$model['agent_phone']);?>
                                  <div class="control-group">
                                      <label class="control-label" >电话1：</label>
                                      <div class="controls">
                                          <span><?php echo $agent_phone[0] ? $agent_phone[0] :'' ?></span>
                                      </div>
                                  </div>
                                  <div class="control-group">
                                      <label class="control-label" >电话2：</label>
                                      <div class="controls">
                                          <span><?php echo !empty($agent_phone[1]) ? $agent_phone[1] :'无' ?></span>
                                      </div>
                                  </div>
                              </div>
                              <div style="clear:both"></div> 
                              <div class="control-group">
                                  <button class="btn red " type="button" style="margin-top:-7px;" onclick="yulan()">预览</button>   
                                  <?php  foreach($list_photo as $k => $v) {    ?>                      
                                      <span class="test line21 yulans" style="display:none">
                                        <a href="/admin/sersellcontract/download?id=<?php echo "$v" ?>&names='交房清单'" >下载</a><a target="_Blank" href="<?php echo $v ?>"><img src="<?php echo $v ?>" style="width:150px;height:100px;vertical-align:top" alt=""></a>
                                      </span> 
                                  <?php } ?>
                              </div>
                              <script type="text/javascript">
                                  function yulan(){
                                      $(".yulans").toggle();
                                  }
                              </script> 
                              <div style="clear:both"></div> 
                           </div> 
                              <div style="border:1px solid #C0C0C0; width:1100px;min-height:200px;margin-left:30px;margin-bottom:30px">
                          <div class="" style="margin-top:20px;"><b>水电费记录</b></div>
                          <?php foreach($hydropower as $k => $v) {    ?> 
                              <div class="control-group">
                                  <label class="control-label" >类型：</label>
                                  <div class="controls">
                                      <span><?php echo $v['hydropower_type'] ? str_replace([1,2],['总表','分表'],$v['hydropower_type']): '无' ?></span>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >热水：</label>
                                  <div class="controls">
                                      <span><?php echo $v['hot_water']  ? $v['hot_water']/100 ."/".str_replace([1,2],['立方','元'],$v['hot_unit']) :"无剩余" ?></span>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >中水：</label>
                                  <div class="controls">
                                      <span><?php echo $v['middle_water']  ? $v['middle_water']/100 ."/".str_replace([1,2],['立方','元'],$v['middle_unit']) :"无剩余" ?></span>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >冷水：</label>
                                  <div class="controls">
                                      <span><?php echo $v['cold_water']  ? $v['cold_water']/100 ."/".str_replace([1,2],['立方','元'],$v['cold_unit']) :"无剩余" ?></span>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >电费：</label>
                                  <div class="controls">
                                      <span><?php echo $v['electricity_fees']  ? $v['electricity_fees']/100 ."/".str_replace([1,2],['度','元'],$v['electricity_unit']) :"无剩余" ?></span>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >燃气：</label>
                                  <div class="controls">
                                      <?php echo $v['gas_meter']  ? $v['gas_meter']/100 ."/".str_replace([1,2],['立方','元'],$v['gas_unit']) :"无剩余" ?>
                                  </div>
                              </div>
                              <div style="clear:both"></div>
                          <?php } ?>
                              <div class="control-group">
                                  <label class="control-label" >支付方式：</label>
                                  <div class="controls">
                                      <?php echo $model['pay_method'] ? $model['pay_method'] :"无" ?>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >实际付款：</label>
                                  <div class="controls">
                                      <?php echo  $model['actual_payment'] ? $model['actual_payment']/100 :"无付款" ?>
                                  </div>
                              </div>
                              <div style="clear:both"></div></div>
                              <div style="border:1px solid #C0C0C0; width:1100px;min-height:200px;margin-left:30px;margin-bottom:30px">
                          <div class="" style="margin-top:20px;"><b>特殊费用</b></div>
                               <?php foreach($special as $k => $v) {    ?> 
                                    <div class="control-group">
                                        <label class="control-label" >编号：</label>
                                        <div class="controls">
                                            <?php echo CmsProperty::model()->find("id = '{$v['house_no']}' and deleted = 0")['house_no'] ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" >类型：</label>
                                        <div class="controls">
                                            <?php echo  $v['type'] ? str_replace([1,2],['费用预留','费用缴纳'],$v['type']):"无" ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" >费用金额：</label>
                                        <div class="controls">
                                            <?php echo $v['amount'] ? $v['amount']/100 : "无" ?>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div class="control-group" style="width:600px">
                                        <label class="control-label" >费用详情：</label>
                                        <div class="controls">
                                            <textarea disabled="true" name="details[]" class="span6 m-wrap" style="resize: none;width:300px" ><?php echo $v['details'] ? $v['details'] : "无" ?></textarea>
                                            
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                              <?php } ?>
                              </div> 
                              <div style="border:1px solid #C0C0C0; width:1100px;min-height:200px;margin-left:30px;margin-bottom:30px">
                          <div class="" style="margin-top:20px;"><b>售后报修</b></div>
                              <div class="control-group">
                                  <label class="control-label" >外勤人员：</label>
                                  <div class="controls">
                                      <?php echo AdminUser::model()->find("id='{$model['creater_id']}' and deleted=0")['nickname']  ?>
                                  </div>
                              </div>
                              <div style="clear:both"></div>
                              <?php foreach($hidden as $k => $v) {    
                                   $property = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0");//车源信息

                              ?> 
                              <div class="control-group">
                                  <label class="control-label" >报修品牌：</label>
                                  <div class="controls">
                                      <?php echo BaseEstate::model()->find("id = '{$property['estate_id']}' and deleted = 0")['name'] ?>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >报修系列：</label>
                                  <div class="controls">
                                      <?php echo BaseBuilding::model()->find("id = '{$property['building_id']}' and deleted = 0")['name'] ?>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >编号：</label>
                                  <div class="controls">
                                      <?php echo $property['house_no'] ?>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label" >报修隐患：</label>
                                  <div class="controls">
                                      <?php echo $v['hidden']?$v['hidden']:"无" ?>
                                  </div>
                              </div>
                              <div class="control-group" style="width:600px">
                                  <label class="control-label" >隐患详情：</label>
                                  <div class="controls">
                                      <textarea disabled="true" name="details[]" class="span6 m-wrap" style="resize: none;width:300px" ><?php echo $v['hidden_infor'] ? $v['hidden_infor']:"无" ?></textarea>
                                  </div>
                              </div> 
                              <?php $hiddenphoto = SerHiddenPhoto::model()->find("after_id = '{$v['id']}'")['url'];
                                    $hiddenphotos = explode(",",$hiddenphoto);
                                    array_shift($hiddenphotos);

                              ?>

                                  <div class="control-group" style="width:600px">
                                      <label class="control-label" ><button class="btn red aaa" type="button" style="margin-top:-7px;">预览</button></label>
                                      <div class="controls">
                                      </div>
                                  </div>
                                  <div style="clear:both"></div>

                                   <?php  foreach ($hiddenphotos as $kk => $vv){  ?>
                                      <span style="display:none" class="hiddenphoto  yulanss">
                                          <a href="/admin/sersellcontract/download?id=<?php echo $vv ?>&names='交房售后'">下载</a><a target="_Blank" href="<?php echo $vv ?>"><img src="<?php echo $vv ?>" style="width:150px;height:150px;vertical-align:top" alt="" ></a>
                                      </span> 
                                  <?php } ?>
                                  <script type="text/javascript">
                                     $(".aaa").click(function(){
                                       $(".yulanss").toggle();
                                     })
                                 </script> 
                                 <div style="clear:both"></div>
                              <?php } ?>

                              </div> 

                       

                             
                          </div>            
                      </div>
                  </div>
              </div>
          </div>
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
<script>
$(function(){
  $("#follow").draggable(); 
    })
</script>