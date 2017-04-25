<style>
  .dataTables_filter{margin-top:40px!important;padding-left:40px;}
  label{display:inline;}
  div>b{font-size:19px;font-weight:bold;}
  b{font-weight:normal;}
  .control-group {
      padding-bottom: 0px;
      margin-right:120px
  }
  .control-label{
    width:110px!important;
    text-align:right
  }
  .controls{
    padding-left:35px
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/service.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/service.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
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
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>客服-编辑</div>
                                </div>
                            </div>
      <form action="/admin/sersellcontract/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
                        <div class="portlet-body form" style="overflow:hidden;">
                                                <div class="alert alert-error hide">
                                                    <button class="close" data-dismiss="alert"></button>
                                                    输入格式有误，请检查输入的数据.
                                                </div>
                                                <div class="alert alert-success hide">
                                                    <button class="close" data-dismiss="alert"></button>
                                                    数据输入验证成功!
                                                </div>
                          <div class="span8" style="margin-top:20px;margin-bottom:0px;"><b>基本信息</b></div>
                          <div class="span8">
                              <div class="control-group" style="float:left;">
                                  <label class="control-label" >客服外勤人员：</label>
                                  <div class="controls" style="padding-left:35px">
                                    <input type="text" disabled="true" value="<?php echo AdminUser::model()->find("id='{$model['creater_id']}' and deleted=0")['nickname']  ?>">
                                  </div>
                              </div>
                              <div class="control-group" style="float:left;">
                                  <label class="control-label" >实际交房日期：</label>
                                  <div class="controls" style="padding-left:35px">
                                    <input type="text" id="actual_date" value="<?php echo date('Y-m-d',$model->actual_date);?>" name="actual_date" required>
                                  </div>
                              </div>
                              <div style="clear:both"></div>
                          
                              <script type="text/javascript">
                                var picker = new Pikaday({
                                  field: document.getElementById('actual_date'),
                                  firstDay: 1,
                                  minDate: new Date('2010-01-01'),
                                  maxDate: new Date('2030-12-31'),
                                  yearRange: [2000,2030]
                                });
                              </script>
                              <input type="hidden" name='id' value="<?php echo $model['id'] ?>">
                              <?php foreach($data as $k => $v) { ?>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >品牌：</label>
                                      <div class="controls" style="padding-left:35px">
                                        <input type="text" disabled="true" id="actual_date" value="<?php echo $v['estate_id'] ?>" name="actual_date" required>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >系列：</label>
                                      <div class="controls" style="padding-left:35px">
                                        <input type="text" disabled="true" id="actual_date" value="<?php echo $v['building_id'] ?>" name="actual_date" required>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >编号：</label>
                                      <div class="controls" style="padding-left:35px">
                                        <input type="text" disabled="true" id="actual_date" value="<?php echo $v['house_no'] ?>" name="actual_date" required>
                                      </div>
                                  </div>
                              <?php } ?>
                              <div style="clear:both"></div>
                              <div class="control-group" style="height:40px">
                                  <label class="control-label">交房到场人员<span class="" style="color:red">*</span>：</label>
                                  <div class="controls">
                                      <label class="radio">
                                          <input type="radio" name="information_type" value ="1" <?php echo $model['information_type']==1?"checked":'' ?> style="margin:0" onclick="tab1()" required>
                                          租户本人
                                      </label>
                                      <label class="radio">
                                         <input type="radio" name="information_type" value ="2" <?php echo $model['information_type']==2?"checked":'' ?> style="margin:0" onclick="tab2()" required>
                                          代理人
                                      </label>
                                  </div>
                              </div>
                              <div style="clear:both"></div>
                              <div id="zuhu" <?php echo $model['information_type']==1 ? "style='display:black;' ":"style='display:none;' " ?> >
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >租户姓名<span class="" style="color:red">*</span>：</label>
                                      <div class="controls" >
                                        <input type="text" value="<?php echo $model['tenant'] ?>" name="tenant" <?php echo $model['information_type']==1 ? "required":"" ?>>
                                      </div>
                                  </div>
                                  <?php $tenant_phone = explode('/',$model['tenant_phone']);?>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >电话1<span class="" style="color:red">*</span>：</label>
                                      <div class="controls" >
                                        <input type="text" value="<?php echo $tenant_phone[0]?$tenant_phone[0] :'' ?>" <?php echo $model['information_type']==1 ? "required":"" ?> name ="tenant_phone" onblur="check_phone(this.value,this);">
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >电话2<span class="" style="color:red"></span>：</label>
                                      <div class="controls" >
                                        <input type="text" value="<?php echo isset($tenant_phone[1]) ? $tenant_phone[1] :'' ?>"   name ="tenant_phone2" onblur="check_phone(this.value,this);">
                                      </div>
                                  </div>
                              </div> 
                              <div  id="dailiren" <?php echo $model['information_type']==2 ? "style='display:black;'' ":"style='display:none;' " ?>>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >代理人类型<span class="" style="color:red">*</span>：</label>
                                      <div class="controls" >
                                          <select name="agent_type" id="agent_type" <?php echo $model['information_type']==2 ? "required":"" ?>>
                                                <option value="1" <?php echo $model['agent_type']==1?"selected" :'' ?> >朋友</option>
                                                <option value="2" <?php echo $model['agent_type']==2?"selected" :'' ?> >华亮</option> 
                                                <option value="3" <?php echo $model['agent_type']==3?"selected" :'' ?> >物业公司</option> 
                                                <option value="4" <?php echo $model['agent_type']==4?"selected" :'' ?> >职员</option> 
                                                <option value="5" <?php echo $model['agent_type']==5?"selected" :'' ?> >亲戚</option> 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >代理人姓名<span class="" style="color:red">*</span>：</label>
                                      <div class="controls" >
                                          <input name ="agent" value="<?php echo $model['agent'] ?>" type="text" <?php echo $model['information_type']==2 ? "required":"" ?>>
                                      </div>
                                  </div>
                                  <?php $agent_phone = explode('/',$model['agent_phone']);?>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >电话1<span class="" style="color:red">*</span>：</label>
                                      <div class="controls" >
                                          <input name="agent_phone" value="<?php echo $agent_phone[0]?$agent_phone[0] :'' ?>" <?php echo $model['information_type']==2 ? "required":"" ?> type="text" onblur="check_phone(this.value,this);">
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >电话2<span class="" style="color:red"></span>：</label>
                                      <div class="controls" >
                                          <input name="agent_phone2" value="<?php echo isset($agent_phone[1]) ? $agent_phone[1] :'' ?>"  type="text" onblur="check_phone(this.value,this);">
                                      </div>
                                  </div>
                              </div> 
                                    <div style="clear:both"></div>             
                                <div class="control-group" style="margin-top:30px"> 
                                    <div class="controls" style="margin-top:20px;margin-left:30px;margin-right:20px;">
                                        <span style="float:left;">
                                            <input type="hidden" name="list_photo" value="<?php $a =  ','.implode(',',$list_photo);echo $list_photo?$a:'' ?>"/>
                                            <span id="PlaceHolder_list_photo"></span>
                                        </span>
                                        <!-- <span><input type="button" class="btn red" value="下载"></span> -->
                                        <span style="float:left;">
                                     <input type="button" class="btn red" value="编辑图片" style="height:32px!important;">
                                </span>
                                    </div>
                                </div>
                                <div class="control-group" style="margin:0;">
                                    <div class="controls">
                                        <div class="upload_progress">
                                            <span class="localname"></span>
                                        </div>
                                        <div class="fieldset flash" id="fsUploadProgress_list_photo">
                                            <span class="legend"></span>
                                        </div>
                                        <div id="list_photo_div" style="float:left;height:130px;<?php echo $list_photo==null?'display: none':''; ?>">
                                        <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                        <?php if ($list_photo): ?>
                                  <?php foreach ($list_photo as $key => $value): ?>
                                    <a target="_Blank" href="<?php echo $value ?>"><img name="list_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
                                    <img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                  <?php  endforeach ?>
                              <?php endif ?>
                                        </div>
                                    </div>
                          </div>
                          <div class="span8" style="margin-top:20px;margin-bottom:0px;"><b>水电费记录</b></div>
                          <?php foreach($hydropower as $k => $v) {   if($k == 0){ ?> 
                              <div class=" dellhydropower">
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >类型：</label>
                                      <div class="controls" >
                                          <select name="hydropower_type[]" id="" >
                                              <option value="">请选择类型</option>
                                              <option value="1" <?php echo $v['hydropower_type']==1?"selected" :'' ?>  >总表</option> 
                                              <option value="2" <?php echo $v['hydropower_type']==2?"selected" :'' ?> >分表</option> 
                                          </select>
                                      </div>
                                  </div>
                                  <div style="clear:both"></div>
                                  
                                  <div class="control-group" style="float:left;margin-right:0px">
                                      <label class="control-label" >热水：</label>
                                      <div class="controls" >
                                          <input type="text"  value="<?php echo $v['hot_water'] ? $v['hot_water']/100 :''?>"  name="hot_water[]" onblur="check_next(this.value,this);">
                                          <select name="hot_unit[]" id="" style="width:120px">
                                              <option value="">请选择单位</option>
                                              <option value="1"  <?php echo $v['hot_unit']==1?"selected" :'' ?> >立方</option> 
                                              <option value="2" <?php echo $v['hot_unit']==2?"selected" :'' ?> >元</option> 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;margin-right:0px">
                                      <label class="control-label" >中水：</label>
                                      <div class="controls" >
                                          <input type="text"  value="<?php echo $v['middle_water'] ? $v['middle_water']/100:'' ?>"  name="middle_water[]" onblur="check_next(this.value,this);">
                                          <select name="middle_unit[]" id="" style="width:120px" >
                                              <option value="">请选择单位</option>
                                              <option value="1" <?php echo $v['middle_unit']==1?"selected" :'' ?> >立方</option> 
                                              <option value="2" <?php echo $v['middle_unit']==2?"selected" :'' ?> >元</option> 
                                          </select>
                                      </div>
                                  </div>
                                  <!-- <div style="clear:both"></div> -->

                                  <div class="control-group" style="float:left;margin-right:0px">
                                      <label class="control-label" >冷水：</label>
                                      <div class="controls" >
                                          <input type="text"  value="<?php echo $v['cold_water'] ? $v['cold_water']/100:"" ?>"  name="cold_water[]" onblur="check_next(this.value,this);">
                                          <select name="cold_unit[]" id="" style="width:120px">
                                              <option value="">请选择单位</option>
                                              <option value="1" <?php echo $v['cold_unit']==1?"selected" :'' ?> >立方</option> 
                                              <option value="2" <?php echo $v['cold_unit']==2?"selected" :'' ?> >元</option> 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;margin-right:0px">
                                      <label class="control-label" >表底数/电费余额：</label>
                                      <div class="controls" >
                                          <input type="text"  value="<?php echo $v['electricity_fees'] ? $v['electricity_fees']/100 : ''?>"  name="electricity_fees[]" onblur="check_next(this.value,this);">
                                          <select name="electricity_unit[]" id="" style="width:120px">
                                              <option value="">请选择单位</option>
                                              <option value="1" <?php echo $v['electricity_unit']==1?"selected" :'' ?> >度</option> 
                                              <option value="2" <?php echo $v['electricity_unit']==2?"selected" :'' ?> >元</option> 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;margin-right:0px">
                                      <label class="control-label" >燃气表：</label>
                                      <div class="controls" >
                                          <input type="text"  value="<?php echo $v['gas_meter'] ? $v['gas_meter']/100 : ''?>"  name="gas_meter[]" onblur="check_next(this.value,this);">
                                          <select name="gas_unit[]" id="" style="width:120px">
                                              <option value="">请选择单位</option>
                                              <option value="1" <?php echo $v['gas_unit']==1?"selected" :'' ?> >立方</option> 
                                              <option value="2" <?php echo $v['gas_unit']==2?"selected" :'' ?> >元</option> 
                                          </select>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;margin-right:0px">
                                      <label class="control-label" ><button class="btn red addser_hydropower" type="button" style="margin-top:-7px;">添加 </button></label>
                                      <div class="controls" >
                                          
                                      </div>
                                  </div>
                              <div style="clear:both"></div>
                              </div>
                            <?php }else{?>
                                <div class="span8 moreser_hydropower" style="float:none"  >        
                                    <div class="control-group" style="float:left;">
                                        <label class="control-label" >类型：</label>
                                        <div class="controls" >
                                            <select name="hydropower_type[]" id="" >
                                                <option value="">请选择类型</option>
                                                <option value="1" <?php echo $v['hydropower_type']==1?"selected" :'' ?>  >总表</option> 
                                                <option value="2" <?php echo $v['hydropower_type']==2?"selected" :'' ?> >分表</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div class="control-group" style="float:left;margin-right:0px">
                                        <label class="control-label" >热水：</label>
                                        <div class="controls" >
                                            <input type="text"  value="<?php echo $v['hot_water'] ? $v['hot_water']/100 :''?>"  name="hot_water[]" onblur="check_next(this.value,this);">
                                            <select name="hot_unit[]" id="" style="width:120px">
                                                <option value="">请选择单位</option>
                                                <option value="1"  <?php echo $v['hot_unit']==1?"selected" :'' ?> >立方</option> 
                                                <option value="2" <?php echo $v['hot_unit']==2?"selected" :'' ?> >元</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" style="float:left;margin-right:0px">
                                        <label class="control-label" >中水：</label>
                                        <div class="controls" >
                                            <input type="text"  value="<?php echo $v['middle_water'] ? $v['middle_water']/100:'' ?>"  name="middle_water[]" onblur="check_next(this.value,this);">
                                            <select name="middle_unit[]" id="" style="width:120px" >
                                                <option value="">请选择单位</option>
                                                <option value="1" <?php echo $v['middle_unit']==1?"selected" :'' ?> >立方</option> 
                                                <option value="2" <?php echo $v['middle_unit']==2?"selected" :'' ?> >元</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" style="float:left;margin-right:0px">
                                        <label class="control-label" >冷水：</label>
                                        <div class="controls" >
                                            <input type="text"  value="<?php echo $v['cold_water'] ? $v['cold_water']/100:"" ?>"  name="cold_water[]" onblur="check_next(this.value,this);">
                                            <select name="cold_unit[]" id="" style="width:120px">
                                                <option value="">请选择单位</option>
                                                <option value="1" <?php echo $v['cold_unit']==1?"selected" :'' ?> >立方</option> 
                                                <option value="2" <?php echo $v['cold_unit']==2?"selected" :'' ?> >元</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" style="float:left;margin-right:0px">
                                        <label class="control-label" >表底数/电费余额：</label>
                                        <div class="controls" >
                                            <input type="text"  value="<?php echo $v['electricity_fees'] ? $v['electricity_fees']/100 : ''?>"  name="electricity_fees[]" onblur="check_next(this.value,this);">
                                            <select name="electricity_unit[]" id="" style="width:120px">
                                                <option value="">请选择单位</option>
                                                <option value="1" <?php echo $v['electricity_unit']==1?"selected" :'' ?> >度</option> 
                                                <option value="2" <?php echo $v['electricity_unit']==2?"selected" :'' ?> >元</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group" style="float:left;margin-right:0px">
                                        <label class="control-label" >燃气表：</label>
                                        <div class="controls" >
                                            <input type="text"  value="<?php echo $v['gas_meter'] ? $v['gas_meter']/100 : ''?>"  name="gas_meter[]" onblur="check_next(this.value,this);">
                                            <select name="gas_unit[]" id="" style="width:120px">
                                                <option value="">请选择单位</option>
                                                <option value="1" <?php echo $v['gas_unit']==1?"selected" :'' ?> >立方</option> 
                                                <option value="2" <?php echo $v['gas_unit']==2?"selected" :'' ?> >元</option> 
                                            </select>
                                        </div>
                                    </div>  
                                </div>   
                                <div style="clear:both"></div>
                            <?php }}?>
                            <div class="control-group" style="float:left;">
                                <label class="control-label" >支付方式：</label>
                                <div class="controls" >
                                    <input type="text"  value="<?php echo $model['pay_method'] ?>"  name="pay_method" >
                                </div>
                            </div>
                            <div class="control-group" style="float:left;">
                                <label class="control-label" >实际收款：</label>
                                <div class="controls" >
                                    <input type="text"  value="<?php echo $model['actual_payment'] ? $model['actual_payment']/100:"" ?>"  name="actual_payment" onblur="check(this.value,this);">元
                                </div>
                            </div>
                            <script type="text/javascript">
                              //添加
                              $(".addser_hydropower").click(function(){
                                mores =$("#ser_hydropower").clone();
                                mores.show();
                                mores.addClass('moreser_hydropower');
                                mores.removeAttr('id');
                                mores.css("float",'none');
                                $('.dellhydropower').after(mores);
                              })
                              //删除
                              $(".delser_hydropower").live('click',function(){
                                  $(this).parents(".moreser_hydropower").remove()
                              })
                            </script>
              
                      <!-- 特殊费用 -->
                          <div class="span8" style="margin-top:20px;margin-bottom:0px;"><b>特殊费用</b></div>
                              <?php foreach ($special as $k => $v) { if($k == 0){?>
                                  <div class=" ">
                                      <div class="control-group" style="float:left;">
                                          <label class="control-label" >编号：</label>
                                          <div class="controls" >
                                              <select name="house_no[]" class="house_no">
                                                  <?php foreach ($data as $kk => $vv) { ?>
                                                      <option value="<?php echo $vv['property_id'] ?>" <?php echo $vv['property_id']== $v['house_no']?"selected" :'' ?> ><?php echo $vv['house_no'] ?></option> 
                                                  <?php } ?>
                                              </select>
                                          </div>
                                      </div> 
                                 
                                      <div class="control-group" style="float:left;">
                                          <label class="control-label" >类型：</label>
                                          <div class="controls" >
                                              <select name="type[]" id="">
                                                  <option value="">请选择类型</option>
                                                  <option value="1" <?php echo $v['type']== 1?"selected" :'' ?> >费用预留</option> 
                                                  <option value="2" <?php echo $v['type']== 2?"selected" :'' ?> >费用缴纳</option> 
                                              </select>
                                          </div>
                                      </div> 
                                      <div class="control-group" style="float:left;">
                                          <label class="control-label" >费用金额：</label>
                                          <div class="controls" >
                                              <input type="text"  value="<?php echo $v['amount'] ? $v['amount']/100:"" ?>"  name="amount[]" onblur="check(this.value,this);">元
                                          </div>
                                      </div>  

                                      <div class="control-group" style="float:left;">
                                          <label class="control-label" >费用详情：</label>
                                          <div class="controls" >
                                            <textarea  name="details[]" class="span6 m-wrap" style="resize: none;width:300px" ><?php echo $v['details'] ? $v['details'] : "无" ?></textarea>
                                          </div>
                                      </div>
                                      <div class="control-group" style="float:left;">
                                          <label class="control-label" ><button class="btn red addser_special_cost" type="button" style="margin-top:-7px;">添加 </button></label>
                                          <div class="controls" >
                                          </div>
                                      </div>
                                  <div style="clear:both"></div>  
                                  </div>
                              <?php }else{ ?>
                              <div class=" morespecial"  style="float:none">
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >编号：</label>
                                      <div class="controls" >
                                          <select name="house_no[]" class="house_no">
                                              <?php foreach ($data as $kk => $vv) { ?>
                                                  <option value="<?php echo $vv['property_id'] ?>" <?php echo $vv['property_id']== $v['house_no']?"selected" :'' ?> ><?php echo $vv['house_no'] ?></option> 
                                              <?php } ?>
                                          </select>
                                      </div>
                                  </div> 
                                  
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >类型：</label>
                                      <div class="controls" >
                                          <select name="type[]" id="">
                                              <option value="">请选择类型</option>
                                              <option value="1" <?php echo $v['type']== 1?"selected" :'' ?> >费用预留</option> 
                                              <option value="2" <?php echo $v['type']== 2?"selected" :'' ?> >费用缴纳</option> 
                                          </select>
                                      </div>
                                  </div> 
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >费用金额：</label>
                                      <div class="controls" >
                                          <input type="text"  value="<?php echo $v['amount'] ? $v['amount']/100:"" ?>"  name="amount[]" onblur="check(this.value,this);">元
                                      </div>
                                  </div>  

                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" >费用详情：</label>
                                      <div class="controls" >
                                        <textarea  name="details[]" class="span6 m-wrap" style="resize: none;width:300px" ><?php echo $v['details'] ? $v['details'] : "无" ?></textarea>
                                      </div>
                                  </div>
                                  <div class="control-group" style="float:left;">
                                      <label class="control-label" ><button class="btn red delser_special_cost" type="button" style="margin-top:-7px;">删除 </button></label>
                                      <div class="controls" >
                                      </div>
                                  </div>   

                                                      
                            
                              </div>

                        <?php }} ?>
                        <div class=" dellspecial" style='clear:both'>
                        </div>

              <script type="text/javascript">
                //添加
                $(".addser_special_cost").click(function(){
                  mores =$("#addspecial").clone();
                  mores.show();
                  mores.addClass('morespecial');
                  mores.removeAttr('id');
                  mores.css("float",'none');
                  $('.dellspecial').after(mores);
                })
                //删除
                $(".delser_special_cost").live('click',function(){
                  $(this).parents(".morespecial").remove()
                })
              </script>
                         
                       <div class="span8" style="text-align:center;margin-top:30px;margin-bottom:20px;">
                              <button  type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                              <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                         </div>
                            </div>
                        </div>
                      </form>
                    </div>
                </div>
                <!-- END PAGE CONTENT-->         
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
<style>
    .theFont{font-size: 20px;}
</style>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<script>
// 上传收房清单图片
var swf_list_photo;
// window.onload = function() {
    var settings_list_photo = {
        flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
        upload_url: "/upload/avatar", //pdf
        file_post_name:"filename",
        post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
        file_size_limit : "2 MB",
        file_types : "*.jpg;*.jpeg;*.png",
        file_types_description : "图片文件",
        file_upload_limit : 0,
        file_queue_limit : 0,
        custom_settings : {
            progressTarget : "fsUploadProgress_list_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_list_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">上传交房清单</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 5,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_list_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_list_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_list_photo = new SWFUpload(settings_list_photo);
                            
// };
function uploadSuccess_list_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("list_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("list_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#list_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("list_photo")[0].value=document.getElementsByName("list_photo")[0].value+','+file_url;
    $("#list_photo_div").show();
}

function fileQueued_list_photo(file){

    var stats = swf_list_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}

</script>




                  <div class="" id="ser_hydropower" style="display:none">        
                      <div class="control-group" style="float:left;">
                          <label class="control-label" >类型：</label>
                          <div class="controls" >
                              <select name="hydropower_type[]" id="" >
                                  <option value="">请选择类型</option>
                                  <option value="1" >总表</option> 
                                  <option value="2" >分表</option> 
                              </select>
                          </div>
                      </div>
                      <div style="clear:both"></div>
                      <div class="control-group" style="float:left;margin-right:0px">
                          <label class="control-label" >热水：</label>
                          <div class="controls" >
                              <input type="text"  value="">
                              <select name="hot_unit[]" id="" style="width:120px">
                                  <option value="">请选择单位</option>
                                  <option value="1"   >立方</option> 
                                  <option value="2" >元</option> 
                              </select>
                          </div>
                      </div>
                      <div class="control-group" style="float:left;margin-right:0px">
                          <label class="control-label" >中水：</label>
                          <div class="controls" >
                              <input type="text"  value="">
                              <select name="middle_unit[]" id="" style="width:120px" >
                                  <option value="">请选择单位</option>
                                  <option value="1" >立方</option> 
                                  <option value="2" >元</option> 
                              </select>
                          </div>
                      </div>
                      <div class="control-group" style="float:left;margin-right:0px">
                          <label class="control-label" >冷水：</label>
                          <div class="controls" >
                              <input type="text"  value="">
                              <select name="cold_unit[]" id="" style="width:120px">
                                  <option value="">请选择单位</option>
                                  <option value="1" >立方</option> 
                                  <option value="2" >元</option> 
                              </select>
                          </div>
                      </div>
                      <div class="control-group" style="float:left;margin-right:0px">
                          <label class="control-label" >表底数/电费余额：</label>
                          <div class="controls" >
                              <input type="text"  value="">
                              <select name="electricity_unit[]" id="" style="width:120px">
                                  <option value="">请选择单位</option>
                                  <option value="1" >度</option> 
                                  <option value="2" >元</option> 
                              </select>
                          </div>
                      </div>
                      <div class="control-group" style="float:left;margin-right:0px">
                          <label class="control-label" >燃气表：</label>
                          <div class="controls" >
                              <input type="text"  value="">
                              <select name="gas_unit[]" id="" style="width:120px">
                                  <option value="">请选择单位</option>
                                  <option value="1" >立方</option> 
                                  <option value="2" >元</option> 
                              </select>
                          </div>
                      </div>
                      <div class="control-group" style="float:left;margin-right:0px">
                          <label class="control-label" ><button class="btn red delser_hydropower" type="button" style="margin-top:-7px;">删除 </button></label>
                          <div class="controls" >
                          </div>
                      </div>
                      <div style="clear:both"></div>
                  </div>
                          
                          
                        
                              
                     
                     
                    <!-- ///////// -->
                    <div class="" id = "addspecial" style="display:none">
                        <div class="control-group" style="float:left;">
                            <label class="control-label" >编号：</label>
                            <div class="controls" >
                                <select name="house_no[]" class="house_no">
                                    <?php foreach ($data as $kk => $vv) { ?>
                                        <option value="<?php echo $vv['property_id'] ?>"><?php echo $vv['house_no'] ?></option> 
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        
                        <div class="control-group" style="float:left;">
                            <label class="control-label" >类型：</label>
                            <div class="controls" >
                                <select name="type[]" id="">
                                    <option value="">请选择类型</option>
                                    <option value="1" >费用预留</option> 
                                    <option value="2">费用缴纳</option> 
                                </select>
                            </div>
                        </div> 
                        <div class="control-group" style="float:left;">
                            <label class="control-label" >费用金额：</label>
                            <div class="controls" >
                                <input type="text"  value=""  name="amount[]" onblur="check(this.value,this);">元
                            </div>
                        </div>  

                        <div class="control-group" style="float:left;">
                            <label class="control-label" >费用详情：</label>
                            <div class="controls" >
                              <textarea  name="details[]" class="span6 m-wrap" style="resize: none;width:300px" ></textarea>
                            </div>
                        </div>
                        <div class="control-group" style="float:left;">
                            <label class="control-label" ><button class="btn red delser_special_cost" type="button" style="margin-top:-7px;">删除 </button></label>
                            <div class="controls" >
                            </div>
                        </div>  
                        <div style="clear:both"></div> 
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
<script>
      function tab1(){
          $("#zuhu").css("display","block")
          $("#dailiren").css("display","none")
          $("input[name=tenant]").attr("required",true);
          $("input[name=tenant_phone]").attr("required",true);
          $("#agent_type").removeAttr("required",false);
          $("input[name=agent]").removeAttr("required",false);
          $("input[name=agent_phone]").removeAttr("required",false);
      }
        function tab2(){
            $("#zuhu").css("display","none")
            $("#dailiren").css("display","block")
            $("#agent_type").attr("required",true);
            $("input[name=agent]").attr("required",true);
            $("input[name=agent_phone]").attr("required",true);
            $("input[name=tenant]").removeAttr("required");
            $("input[name=tenant_phone]").removeAttr("required");
        }


</script>

<!-- 图片删除 -->
<script>
    $(function(){
        $('.red').live('click',function(){
            $(this).parent().parent().parent().next().find('.del_photo').show();
            $('.del_photo').click(function(){
                var del_photo_url = $(this).prev().children().attr('src');
                var dataStr = $(this).parent().parent().parent().prev().find("input[type='hidden']").val();
                var dataStrArr=dataStr.split(",");
                var newarr =[] ;
                for (var i = dataStrArr.length - 1; i >= 0; i--) {
                   if(dataStrArr[i]!=del_photo_url&&dataStrArr[i]!=''){
                        newarr.push(dataStrArr[i]);
                   }
                }
                var str = newarr.join(',');
                str=str.substr(0,str.length);
                console.log(str)
                $(this).parent().parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>
