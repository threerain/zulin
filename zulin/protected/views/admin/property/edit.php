<style>
    .control-group{margin-bottom:0px !important;margin-top:0px !important;padding-bottom: 10px !important;}
    select{height:34px;}
    .control-label{font-weight:bold !important;width:86px !important;}
    .control-labela{width:130px !important;}
    .yj-xg-btn{width: 95%;margin:15px auto;}
    .yj-xg-btn div {width: 24.9%;float:left;}
    .control-label{font-weight:bold !important;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);

  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
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

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>车辆-编辑</div>

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
                                <form action="/admin/property/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $model->id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="yj-xg-btn">
                                        <div style="background:#0160cb;"><a href="javascript:void(0)" style="color:white;">修改车辆基本信息 </a></div>
                                        <div><a href="javascript:void(0)">添加车源信息 </a></div>
                                        <div><a href="javascript:void(0)">添加车主相关信息</a></div>
                                        <div><a href="javascript:void(0)">添加车源图片信息</a></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <div class="control-group" style="float:left;margin-top:-10px;" >
                                            <label class="control-label control-labela">录入人<span class="required">*</span></label>
                                            <div class="controls" style="font-size:14px;line-height:31px;color:#555;width:274px !important;">
                                                <?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"";?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;margin-top:-10px;" >
                                            <label class="control-label control-labela">归属人<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input type="hidden" name="ascription_id" id="ascription_id" class="select2" style="width:220px;" value="<?php echo $model==null?"":$model->ascription_id;?>">
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车源基本信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">车源类型<span class="required"></span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input type="text" name="room_type" id="room_type" value="<?php  echo $model->room_type?str_replace([1,2,3,4,5],['轿车','客车','SUV','商务'],$model->room_type):"";?>" disabled=true class="m-wrap">
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">品牌<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input type="text" name="estate_id"  value="<?php  $item=BaseEstate::model()->find("id='$model->estate_id'");echo $item?$item->name:"";?>" disabled=true class="m-wrap">
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">类型<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input type="text" name="building_id"  id="building_id" value="<?php $building=BaseBuilding::model()->find("id='$model->building_id'"); echo $building?$building->name:"";?>" disabled=true class="m-wrap">
                                            </div>
                                        </div>
                                       <div class="control-group rules" style="float:left;">
                                            <label class="control-label control-labela">规则</label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="room_number_rule" type="text" readonly=true style="border:0px !important" class="select2 m-wrap" value="<?php echo "$building->room_number_rule";?>"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                       <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">车源编号<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="house_no" type="text" class="m-wrap" id="house_no" disabled=true placeholder="只能输入数字,字母和-" value="<?php echo $model==null?"":$model->house_no;?>" onkeyup="value=value.replace(/[^\A-\Z0-9\-]/g,'')" />
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">车牌号<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="room_area" type="text"  class="m-wrap" value="<?php echo $model->room_area;?>" maxlength="10"  required onblur="check(this.value,this);">
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela" >幼狮承租建筑面积<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="area" type="text"  id="area" class="m-wrap" value="<?php echo $model->area;?>" maxlength="10"  onblur="check(this.value,this);">
                                            </div>
                                        </div> -->
                                        <script>
                                            $("input[name='room_area']").change(
                                             function(){
                                                var room_area=$("input[name='room_area']").val();
                                                 document.getElementById("area").value=room_area;
                                            });
                                        </script>
                                        <div style="clear:both;"></div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">使用面积</label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="sum_area" type="text" value="<?php echo $propertydetail->sum_area?$propertydetail->sum_area/100:'';?>" placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>
                                            </div>
                                        </div> -->
                                        <div class="control-group" style="float:left">
                                            <label class="control-label control-labela">项目属性</label>
                                            <div class="controls" style="width:274px !important;">
                                                <input type="text" name="type" id="type" value="<?php echo $building?str_replace([1,2,3],['A1','A2','A3'],$building->type):"";?>" disabled=true class="m-wrap">
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">朝向</label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="orientation" class="m-wrap">
                                                    <option value=""></option>
                                                    <option value="南" <?php echo $model->orientation=="南"?"selected":""?> >南</option>
                                                    <option value="南北" <?php echo $model->orientation=="南北"?"selected":""?> >南北</option>
                                                    <option value="东" <?php echo $model->orientation=="东"?"selected":""?> >东</option>
                                                    <option value="东南" <?php echo $model->orientation=="东南"?"selected":""?> >东南</option>
                                                    <option value="东北" <?php echo $model->orientation=="东北"?"selected":""?> >东北</option>
                                                    <option value="西" <?php echo $model->orientation=="西"?"selected":""?> >西</option>
                                                    <option value="西南" <?php echo $model->orientation=="西南"?"selected":""?> >西南</option>
                                                    <option value="西北" <?php echo $model->orientation=="西北"?"selected":""?> >西北</option>
                                                    <option value="北" <?php echo $model->orientation=="北"?"selected":""?> >北</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">空置日期</label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="idle_time" type="text" class="m-wrap" id="datepicker1" value="<?php echo $model->idle_time?date('Y-m-d',$model->idle_time):'';?>" />
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">付款方式</label>
                                            <div class="controls" style="width:274px !important;" >
                                                <span>
                                                   押&nbsp<input type="text" name="deposit" maxlength="3" value="<?php echo $model->deposit;?>" onkeyup="value=value.replace(/[^0-9]+/,'')" placeholder="整数" class="m-wrap" style="width:60px">
                                                </span>
                                                <span style="margin-left:10px">
                                                   付&nbsp<input type="text" name="pay" maxlength="3" value="<?php echo $model->pay;?>" onkeyup="value=value.replace(/[^0-9]+/,'')"  placeholder="整数" class="m-wrap" style="width:60px">
                                                </span>
                                            </div>
                                        </div> -->
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">预计购入资金</label>
                                            <div class="controls" style="width:299px !important;">
                                                <input name="price" type="text" class="m-wrap" value="<?php echo $model->price?$model->price/100:'';?>" placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>元
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">车源状态</label>
                                            <div class="controls" style="width:274px !important;" style="font-size:14px;line-height:31px;width:220px;">
                                            <?php
                                                if(Property::PurchaseContract($model->id)){
                                                  echo '幼狮车源';
                                                }else{
                                            ?>
                                                <label class="radio">
                                                    <input name="status" type="radio" value="1" <?php echo $model==null?"":$model->status=="1"?"checked":""; ?> class="m-wrap"/>未租
                                                </label>
                                                <label class="radio">
                                                    <input name="status" type="radio"  value="2" <?php echo $model==null?"":$model->status=="2"?"checked":""; ?> class="m-wrap"/>他租
                                                </label>
                                            <?php
                                                }
                                            ?>
                                            </div>
                                        </div> -->
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">现状</label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="status_now" style="height:34px;">
                                                    <option value="">请选择</option>
                                                    <option value="1" <?php echo $model->status_now==1?"selected":""; ?>>未出库</option>
                                                    <option value="2" <?php echo $model->status_now==2?"selected":""; ?>>近期可出库</option>
                                                    <option value="3" <?php echo $model->status_now==3?"selected":""; ?>>近期不可出库</option>
                                                    <option value="4" <?php echo $model->status_now==4?"selected":""; ?>>维修中</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="add" style="float:left;<?php if($model->status_now==2||$model->status_now==3){echo "";}else{echo "display:none";}; ?>">
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label control-labela">到期时间</label>
                                                <div class="controls" style="width:274px !important;">
                                                    <input name="end_time" type="text" id="datepicker" value="<?php echo $model->end_time?date('Y-m-d',$model->end_time):'';?>" class="m-wrap">
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group">
                                            <label class="control-label control-labela">备注</label>
                                            <div class="controls">
                                                <textarea  name="time_memo" type="text" maxlength="255" style="resize: none;width:500px;height:120px;"><?php echo $model->time_memo;?></textarea>
                                            </div>
                                        </div>
                                        <script>
                                            $("select[name='status_now']").click(function(){
                                              if($(this).val()==2 ||$(this).val()==3 ){
                                                $(".add").show();
                                              }else{
                                                $(".add").hide();
                                              }
                                            });
                                        </script>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:30px;"> 车源详细信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车辆高度</label>
                                            <div class="controls">
                                                <input name="width" type="text" value="<?php echo $propertydetail->width?$propertydetail->width/100:'';?>" placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>m
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">公里数</label>
                                            <div class="controls">
                                                <input name="height" type="text" value="<?php echo $propertydetail->height?$propertydetail->height/100:'';?>" placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>m
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label">项目单层面积</label>
                                            <div class="controls">
                                                <input name="area_one" type="text" value="<?php echo $propertydetail->area_one?$propertydetail->area_one/100:'';?>" placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">箱数</label>
                                            <div class="controls">
                                                <input name="ti" type="text" placeholder="只能输入整数" value="<?php echo $propertydetail==null?"":$propertydetail->ti;?>" maxlength="7" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label">几户</label>
                                            <div class="controls">
                                                <input name="hu" type="text" placeholder="只能输入整数" value="<?php echo $propertydetail==null?"":$propertydetail->hu;?>" maxlength="7" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap"/>
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左C柱</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="sunshine" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->sunshine=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="sunshine" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->sunshine=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="sunshine" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->sunshine=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右A柱</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="french_window" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->french_window=="1"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="french_window" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->french_window=="0"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左前翼子板内衬</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="crutch" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->crutch=="1"?"checked":""; ?> class="m-wrap"/>有
                                                </label>
                                                <label class="radio">
                                                    <input name="crutch" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->crutch=="0"?"checked":""; ?> class="m-wrap"/>无
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">前防撞梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="door" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->door=="0"?"checked":""; ?> class="m-wrap"/>单扇
                                                </label>
                                                <label class="radio">
                                                    <input name="door" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->door=="1"?"checked":""; ?> class="m-wrap"/>双扇
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">后围板</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="spray" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->spray=="0"?"checked":""; ?> class="m-wrap"/>朝上
                                                </label>
                                                <label class="radio">
                                                    <input name="spray" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->spray=="1"?"checked":""; ?> class="m-wrap"/>朝下
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左前减震器座</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="hide" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->hide=="1"?"checked":""; ?> class="m-wrap"/>有
                                                </label>
                                                <label class="radio">
                                                    <input name="hide" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->hide=="0"?"checked":""; ?> class="m-wrap"/>无
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左B柱</label>
                                            <div class="controls" style="width:260px">
                                                <label class="radio">
                                                    <input name="leak" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->leak=="1"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="leak" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->leak=="0"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;margin-left: 0px !important">
                                            <label class="control-label" style="width:129px !important">右前翼子板内衬</label>
                                            <div class="controls" style="width:260px;">
                                                <label class="radio">
                                                    <input name="house_same" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->house_same=="1"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="house_same" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->house_same=="0"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">后防撞梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="corridor_toilet" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->corridor_toilet=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="corridor_toilet" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->corridor_toilet=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="corridor_toilet" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->corridor_toilet=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右前纵梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="other_rentor" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->other_rentor=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="other_rentor" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->other_rentor=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="other_rentor" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->other_rentor=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">后备箱底板</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="original_decoration" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->original_decoration=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="original_decoration" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->original_decoration=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="original_decoration" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->original_decoration=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右前减震器座</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="toplight" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->toplight=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="toplight" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->toplight=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="toplight" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->toplight=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右侧底边梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="ground" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->ground=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="ground" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->ground=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="ground" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->ground=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左前纵梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="baseboard" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->baseboard=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="baseboard" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->baseboard=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="baseboard" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->baseboard=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左车顶边梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="partition" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->partition=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="partition" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->partition=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="partition" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->partition=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左侧底边梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="ceiling" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->ceiling=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="ceiling" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->ceiling=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="ceiling" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->ceiling=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">水箱框架</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="lamp" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->lamp=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="lamp" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->lamp=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="lamp" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->lamp=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">防火墙</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="wall" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->wall=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="wall" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->wall=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="wall" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->wall=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左后翼子板内衬</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="plug" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->plug=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="plug" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->plug=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="plug" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->plug=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左后纵梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="door_window" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->door_window=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="door_window" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->door_window=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="door_window" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->door_window=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右后翼子板内衬</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="room_layout" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->room_layout=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="room_layout" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->room_layout=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="room_layout" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->room_layout=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右车顶边梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="logo_front" type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->logo_front=="0"?"checked":""; ?> class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="logo_front" type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->logo_front=="1"?"checked":""; ?> class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="logo_front" type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->logo_front=="2"?"checked":""; ?> class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:30px;"> 车主个人信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主姓名<span class="required">*</span></label>
                                            <div class="controls">
                                                <input name="owner_name" type="text" axlength="10" value="<?php echo $ownersg==null?"":$ownersg->owner_name; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">身份证号</label>
                                            <div class="controls">
                                                <input name="id_card" type="text" maxlength="18" onkeyup="value=value.replace(/^[a-zA-Z]+\D*|^\d{0,16}[a-zA-Z]+|[^0-9Xx]/g,'')" value="<?php echo $ownersg==null?"":$ownersg->id_card; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">性别</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="owner_gender" type="radio" value="1" <?php echo $ownersg==null?"":$ownersg->owner_gender=="1"?"checked":""; ?> class="m-wrap"/>女
                                                </label>
                                                <label class="radio">
                                                    <input name="owner_gender" type="radio" value="2" <?php echo $ownersg==null?"":$ownersg->owner_gender=="2"?"checked":""; ?> class="m-wrap"/>男
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">年龄</label>
                                            <div class="controls">
                                                <input name="owner_age" type="text" maxlength="4" onkeyup="value=value.replace(/[^0-9]+/,'')" value="<?php echo $ownersg==null?"":$ownersg->owner_age; ?>" placeholder="只能输入整数" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">所在城市</label>
                                            <div class="controls">
                                                <input name="owner_city" type="text" maxlength="20" value="<?php echo $ownersg==null?"":$ownersg->owner_city; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">籍贯</label>
                                            <div class="controls">
                                                <input name="owner_roots" type="text" maxlength="10" value="<?php echo $ownersg==null?"":$ownersg->owner_roots; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">职位</label>
                                            <div class="controls">
                                                <input name="owner_position" maxlength="20" type="text" value="<?php echo $ownersg==null?"":$ownersg->owner_position; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">从事行业</label>
                                            <div class="controls">
                                                <input name="owner_trade" maxlength="20" type="text" value="<?php echo $ownersg==null?"":$ownersg->owner_trade; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <?php
                                            $admin_id =  Yii::app()->session['admin_uid'];
                                            $admin = AdminUser::model()->find("id='$admin_id'");
                                            if($admin->type==0) {
                                                foreach(explode("/",$ownersg->owner_contact) as $key=>$value){
                                        ?>
                                            <div class="control-group">
                                                <label class="control-label">联系方式</label>
                                                <div class="controls">
                                                    <input name="owner_contact[]" type="text"onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" value="<?php echo $value; ?>" class="m-wrap"/>
                                                   <?php if($key==0){?>
                                                    <input name="" type="button" class="span1 m-wrap add_contact" style="width:60px;" value="添加"/>
                                                    <?php }else{?>
                                                    <input name="" type="button" class="span1 m-wrap del_contact" style="width:60px;" value="删除"/>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php
                                                }
                                            }else{
                                            foreach(explode("/",$ownersg->owner_contact) as $key=>$value){
                                        ?>
                                            <div class="control-group">
                                                <label class="control-label">联系方式</label>
                                                <div class="controls">
                                                    <input name="owner_contact[]" readonly type="text"onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" value="<?php echo $value; ?>" class="m-wrap"/>
                                                    <?php if($key==0){?>
                                                        <input name="" type="button" class="span1 m-wrap add_contact" style="width:60px;" value="添加"/>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                        <div class="contact_box"></div>
                                        <script>
                                            $(".add_contact").click(function(){
                                                var html = $("#all_contact").clone();
                                                html.removeAttr('id');
                                                html.show();
                                                $(".contact_box").append(html)
                                                $(".del_contact").click(function(){
                                                    $(this).parent().parent().remove();
                                                })
                                            })
                                            $(".del_contact").click(function(){
                                               $(this).parent().parent().remove();
                                            })
                                        </script>
                                        <div style="clear:both;"></div>
                                        <br>
                                        <br>
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">代理人信息</span>
                                        <br>
                                        <?php
                                        if($propertyagent){
                                            foreach($propertyagent as $key=>$value){
                                        ?>
                                        <div>
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label">姓名</label>
                                                <div class="controls">
                                                    <input name="agent_name[]" type="text" value="<?php echo $value->agent_name?>" maxlength="20" class="m-wrap"/>
                                                </div>
                                            </div>
                                            <?php
                                                $admin_id =  Yii::app()->session['admin_uid'];
                                                $admin = AdminUser::model()->find("id='$admin_id'");
                                                if($admin->type==0) {
                                            ?>
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label">电话</label>
                                                <div class="controls">
                                                    <input name="agent_phone[]" value="<?php echo $value->agent_phone?>"  type="text" onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" class="m-wrap"/>
                                                    <?php if($key==0 || empty($propertyagent) ){?>
                                                    <input name="" type="button" class="span1 m-wrap add_agent" style="width:60px;" value="添加"/>
                                                    <?php }else{ ?>
                                                    <input name="" type="button" class="span1 m-wrap del_agent" style="width:60px;" value="删除"/>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label">电话</label>
                                                <div class="controls">
                                                    <input name="agent_phone[]" value="<?php echo $value->agent_phone?>"  readonly type="text"  class="m-wrap"/>
                                                    <?php if($key==0 || empty($propertyagent) ){?>
                                                    <input name="" type="button" class="span1 m-wrap add_agent" style="width:60px;" value="添加"/>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <?php }?>
                                            <div style="clear:both;"></div>
                                        </div>
                                        <?php
                                            }
                                        }else{
                                        ?>
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label">姓名</label>
                                                <div class="controls">
                                                    <input name="agent_name[]" type="text" value="<?php echo $value->agent_name?>" maxlength="20" class="m-wrap"/>
                                                </div>
                                            </div>
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label">电话</label>
                                                <div class="controls">
                                                    <input name="agent_phone[]" value="<?php echo $value->agent_phone?>" type="text" onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" class="m-wrap"/>
                                                    <?php if($key==0 || empty($propertyagent) ){?>
                                                    <input name="" type="button" class="span1 m-wrap add_agent" style="width:60px;" value="添加"/>
                                                    <?php }else{ ?>
                                                    <input name="" type="button" class="span1 m-wrap del_agent" style="width:60px;" value="删除"/>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="agent_box" style="clear:both;"></div>
                                        <script>
                                            $(".add_agent").click(function(){
                                                var html = $("#all_agent").clone();
                                                html.removeAttr('id');
                                                html.show();
                                                $(".agent_box").append(html)
                                                $(".del_agent").click(function(){
                                                    $(this).parent().parent().parent().remove();
                                                })
                                            })
                                            $(".del_agent").click(function(){
                                               $(this).parent().parent().parent().remove();
                                            })
                                        </script>
                                        <div style="clear:both;"></div>
                                        <br>
                                        <br>
                                        <!-- <span style="font-size:16px;font-weight:bold;margin-left:30px;"> 经营公司信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">企业名称</label>
                                            <div class="controls">
                                                <input name="company" type="text" maxlength="20" value="<?php echo $ownersg==null?"":$ownersg->company; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">主要经营范围</label>
                                            <div class="controls">
                                                <input name="business_scope" type="text" maxlength="255" value="<?php echo $ownersg==null?"":$ownersg->business_scope; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">经营项目</label>
                                            <div class="controls">
                                                <input name="business_project" type="text" maxlength="255" value="<?php echo $ownersg==null?"":$ownersg->business_project; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">公司类型</label>
                                            <div class="controls">
                                                <input name="company_type" type="text" maxlength="255" value="<?php echo $ownersg==null?"":$ownersg->company_type; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">核心经营项目</label>
                                            <div class="controls">
                                                <input name="core_project" type="text" maxlength="255" value="<?php echo $ownersg==null?"":$ownersg->core_project; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">办公人数</label>
                                            <div class="controls">
                                                <input name="people" type="text" value="<?php echo $ownersg==null?"":$ownersg->people; ?>" placeholder="只能输入整数" maxlength="7" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <br>
                                        <br>
                                        <span style="font-size:16px;font-weight:bold;margin-left:30px;"> 车主关联信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主亲属公司</label>
                                            <div class="controls">
                                                <input name="rel_company" type="text" maxlength="20" value="<?php echo $ownersg==null?"":$ownersg->rel_company; ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主朋友公司</label>
                                            <div class="controls">
                                                <input name="friend_company" type="text" maxlength="20" value="<?php echo $ownersg==null?"":$ownersg->friend_company;  ?>" class="m-wrap"/>
                                            </div>
                                        </div> -->
<!--                                         <div class="control-group" style="float:left;">
                                            <label class="control-label">车主朋友公司</label>
                                            <div class="controls">
                                                <input name="friend_company1" type="text" maxlength="20" value="<?php //echo $ownersg==null?"":$ownersg->friend_company1;  ?>" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>-->
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label">车主关联上下游公司</label>
                                            <div class="controls">
                                                <input name="relation_company" type="text" maxlength="100" value="<?php echo $ownersg==null?"":$ownersg->relation_company; ?>" class="m-wrap"/>
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:30px;">车源图片(图片类型不能选重复并且不能为空)：</span>
                                        <br>
                                        <div id="propertys">
    <!--图片-->                         <?php
                                            $count=0;
                                            if($photo){
                                                foreach ($photo as $k => $v){

                                                    if ($v){
                                                        $a='';
                                                        foreach ($v as $k1 => $v1){
                                                            if ($k1==0){
                                                                $a=",".$v1->url;
                                                            }
                                                            else{
                                                                $a.=",".$v1->url;
                                                            }

                                                        }
                                                    }

                                        ?>
                                            <div class="control-group">
                                                <label class="control-label">图片类型</label>
                                                <div class="controls">
                                                    <select name="type_photo[]">
                                                        <option value="">请选择图片类型</option>
                                                        <option value="1" <?php echo $k==1? "selected":""?>>车源内饰</option>
                                                        <option value="2" <?php echo $k==2? "selected":""?>>车源外部图片</option>
                                                        <option value="3" <?php echo $k==3? "selected":""?>>车源前景图（细）</option>
                                                        <option value="4" <?php echo $k==4? "selected":""?>>车源后景图（细）</option>
                                                        <option value="5" <?php echo $k==5? "selected":""?>>车源左侧图（细）</option>
                                                        <option value="6" <?php echo $k==6? "selected":""?>>车源右侧图(细)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group" >
                                                <div class="controls">
                                                    <label class="control-label" style="text-align:left;">
                                                        <input type="hidden" name="property_photo[]" value="<?php  echo $v?$a:''?>"/>
                                                        <span id="PlaceHolder_property_photo<?php echo $k?>"></span>
                                                    </label>
                                                    <label class="control-label"></label>
                                                    <label class="control-label">
                                                        <input type="button" class="btn red" value="编辑图片" style="height:31px!important;">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="control-group" style="margin:0;height:160px;">
                                                <div class="controls">
                                                    <div class="upload_progress">
                                                        <span class="localname"></span>
                                                    </div>
                                                    <div class="fieldset flash" id="fsUploadProgress_property_photo<?php echo $k?>">
                                                        <span class="legend"></span>
                                                    </div>
                                                    <div id="property_photo_div<?php echo $k?>" style="height:160px;<?php echo $k==null?'display: none':''; ?>">
                                                        <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:150px;float:left;margin-left:10px'/>
                                                        <?php
                                                            if ($v):?>
                                                            <?php foreach ($v as $k1 => $v1):?>
                                                                <a target="_Blank" href="<?php echo $v1->url; ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                                            <?php endforeach; ?>

                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>

                                    <script>
                                        //遍历出来的图片
                                        var swf_property_photo;

                                           $(function(){
                                            var settings_property_photo = {
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
                                                    progressTarget : "fsUploadProgress_property_photo<?php echo $k?>",
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "100",
                                                button_height: "30",
                                                button_placeholder_id: "PlaceHolder_property_photo<?php echo $k?>",
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">+图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 20,
                                                button_text_top_padding: 6,
                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_estate<?php echo $k?>_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_estate<?php echo $k?>_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };

                                     // alert(nummore.length);
                                            swf_property_photo = new SWFUpload(settings_property_photo);
                                         })

                                        function uploadSuccess_estate<?php echo $k?>_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;
                                    //alert($count);
                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            $("#property_photo_div<?php echo $k?>").append(new_img);
                                            $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                            document.getElementsByName("property_photo[]")[<?php echo $count?>].value=document.getElementsByName("property_photo[]")[<?php echo $count?>].value+','+file_url;
                                            $("#property_photo_div<?php echo $k?>").show();
                                        }

                                        function fileQueued_estate<?php echo $k?>_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }
                                            </script>
                                    <?php
                                                $count++;
                                            }
                                        }
                                    ?>
                                    </div>
                                    <div style="display:none" class="selecta">
                                        <div class="control-group">
                                            <label class="control-label">车源照片</label>
                                            <div class="controls">
                                                <select name="type_photo[]">
                                                    <option value="">请选择图片类型</option>
                                                    <option value="1">楼梯外观</option>
                                                    <option value="2">交通图</option>
                                                    <option value="3">格局图</option>
                                                    <option value="4">平面图</option>
                                                    <option value="5">外景图</option>
                                                    <option value="6">办公室内(地面)</option>
                                                    <option value="7">办公室内(室内吊顶)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls" style="margin-top:20px;">
                                                <label class="control-label" style="text-align:left;float:left;">
                                                    <input type="hidden" name="property_photo[]" value=""/>

                                                    <span id="PlaceHolder_property_photo"></span>
                                                </label>
                                                <label class="control-label"></label>
                                                <label class="control-label">
                                                     <input type="button" class="btn red" value="编辑图片" style="height:31px!important;">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="margin:0;">
                                            <div class="controls">
                                                <div class="upload_progress">
                                                    <span class="localname"></span>
                                                </div>
                                                <div class="fieldset flash" id="fsUploadProgress_property_photo">
                                                    <span class="legend"></span>
                                                </div>
                                                <div id="property_photo_div" style="float:left;100%;height:200px;display: none;">
                                                    <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id='add_property' type="button" class="btn blue">添加</button>
                                            <button id='del_property' type="button" class="btn red">删除</button>
                                        </div>
                                    </div>
                                </div>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
                                    <style>
                                        .theFont{font-size: 20px;}
                                    </style>
                                    <input type="hidden" value="<?php echo $count?>" name="the_count"/>
                                    <script>

                                    //点击添加多个图片
                                    var nummore =$('.more');
                                    var the_count=$("input[name='the_count']").val();
                                    $("button[id='add_property']").live("click",function(e){
                                    mores =$('.selecta').clone();
                                    mores.removeClass('selecta');
                                    mores.show();
                                    mores.addClass('more');
                                    nummore =$('.more');
                                    mores.find("#PlaceHolder_property_photo").attr('id','PlaceHolder_property_photo'+nummore.length+'a');
                                    mores.find("#fsUploadProgress_property_photo").attr('id','fsUploadProgress_property_photo'+nummore.length+'a');
                                    mores.find("#property_photo_div").attr('id','property_photo_div'+nummore.length+'a');
                                    //mores.find(".property_photo_show").attr('class','property_photo_show'+nummore.length);

                                    var the_number=parseInt(the_count)+parseInt(nummore.length);
                                    // console.log(nummore.length);
                                    $('#propertys').append(mores);
                                    //添加图片
                                      //console.log(mores);
                                        var swf_property_photo;
                                        //alert('swf_property_photo'+nummore.length);
                                        // window.onload = function() {
                                            var settings_property_photo = {
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
                                                    progressTarget : 'fsUploadProgress_property_photo'+nummore.length+'a',
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "100",
                                                button_height: "30",
                                                button_placeholder_id: 'PlaceHolder_property_photo'+nummore.length+'a',
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">+图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 20,
                                                button_text_top_padding: 6,
                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_property_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_property_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };
                                     // alert(nummore.length);
                                            swf_property_photo = new SWFUpload(settings_property_photo);

                                        // };
                                        function uploadSuccess_property_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;
                                    // alert(nummore.length);
                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            $('#property_photo_div'+nummore.length+'a').append(new_img);
                                            $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                             document.getElementsByName("property_photo[]")[the_number].value=document.getElementsByName("property_photo[]")[the_number].value+','+file_url;
                                            $('#property_photo_div'+nummore.length+'a').show();
                                        }

                                        function fileQueued_property_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }

                                        //alert(nummore.length);

                                    });

                                    $("button[id='del_property']").live('click',function(){
                                    var delmore = $('.more');
                                    $('.more').eq(delmore.length-1).remove();
                                    if(delmore.length==0){
                                    alert('最后一个图片不能删除');
                                    }
                                    })

                                    // //添加图片单个
                                        var swf_property_photo;

                                        window.onload = function() {
                                            var settings_property_photo = {
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
                                                    progressTarget : "fsUploadProgress_property_photo"+the_count,
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "100",
                                                button_height: "30",
                                                button_placeholder_id: "PlaceHolder_property_photo"+the_count,
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">+图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 20,
                                                button_text_top_padding: 6,

                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_property_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_property_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };

                                            swf_property_photo = new SWFUpload(settings_property_photo);

                                        };
                                        function uploadSuccess_property_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;

                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            console.log();
                                            $("#property_photo_diva").append(new_img);
                                            $(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                            document.getElementsByName("property_photo[]")[the_count].value=document.getElementsByName("property_photo[]")[the_count].value+','+file_url;
                                            $("#property_photo_diva").show();
                                        }

                                        function fileQueued_property_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }
                                    </script>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
                                </form>
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
<script>
    $(function(){
        $(".yj-xg-xbox").eq(0).css({display:"block"})
        $(".yj-xg-btn div").click(function(){
            var index=$(".yj-xg-btn div").index(this)
            $(".yj-xg-xbox").css({display:"none"}).eq(index).css({display:"block"})
        })
        $('.yj-xg-btn').children('div').click(function(){
            $('.yj-xg-btn').children('div').css('background','white');
            $('.yj-xg-btn').children('div').children('a').css('color','blue');
            $(this).css('background','#0160cb');
            $(this).children('a').css('color','white');
        })
    })
//日期
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
  var picker = new Pikaday({
    field: document.getElementById('datepicker1'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
<!-- //图片删除 -->

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
<div class="control-group" id="all_contact" style="display:none">
    <label class="control-label">联系方式</label>
    <div class="controls">
        <input name="owner_contact[]" value="" type="text" placeholder=""onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" class="m-wrap"/>
        <input name="" type="button" class="span1 m-wrap del_contact" style="width:60px;" value="删除"/>
    </div>
</div>
<div id="all_agent" style="display:none">
    <div class="control-group" style="float:left;">
        <label class="control-label">姓名</label>
        <div class="controls">
            <input name="agent_name[]" type="text" placeholder="" maxlength="20" class="m-wrap"/>
        </div>
    </div>
    <div class="control-group" style="float:left;">
        <label class="control-label">电话</label>
        <div class="controls">
            <input name="agent_phone[]" value="" type="text" placeholder=""onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" class="m-wrap"/>
            <input type="button" class="span1 m-wrap del_agent" style="width:60px;" value="删除"/>
        </div>
    </div>
    <div style="clear:both;"></div>
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
