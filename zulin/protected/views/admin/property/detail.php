<style>
    .control-group{margin-bottom:0px !important;margin-top:0px !important;padding-bottom: 10px !important;}
    .controls{font-size:14px;line-height:36px;color:#555;width:220px;margin-top:1px !important;}
    .control-label{padding-top: 0px !important;width:86px !important;}
    .control-labela{width:130px !important;}
    /*.label{padding-top: 0px !important;font-size: 14px;font-weight: normal;line-height: 20px;margin-bottom: 5px}*/
    textarea{margin-left: 20px;margin-top: 5px}
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

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>车源-详情</div>

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
                                        <div style="background:#0160cb;"><a href="javascript:void(0)" style="color:white;">车源基本信息 </a></div>
                                        <div><a href="javascript:void(0)">车源详细信息 </a></div>
                                        <div><a href="javascript:void(0)">车主相关信息</a></div>
                                        <div><a href="javascript:void(0)">车源图片信息</a></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                        <div class="control-group" style="float:left;margin-top:-10px;">
                                            <label class="control-label control-labela">录入人</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"";?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;margin-top:-10px;">
                                            <label class="control-label control-labela">归属人</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php $item=AdminUser::model()->find("id='$model->ascription_id'"); echo $item?$item->nickname:"";?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:60px;">车源基本信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;" >
                                            <label class="control-label control-labela">产品类型</label>
                                            <div class="controls" style="width:274px !important;">
                                            <?php
                                                if($model->room_type==1){echo '轿车';}if($model->room_type==2){echo '客车';}
                                                if($model->room_type==3){echo 'SUV';}if($model->room_type==4){echo '商务';}if($model->room_type==5){echo '商务';}
                                            ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;" >
                                            <label class="control-label control-labela">区域</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php $item=BaseDistrict::model()->find("id='$model->district_id'"); echo $item?$item->name:"";  ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;" >
                                            <label class="control-label control-labela">商圈</label>
                                            <div class="controls" style="width:274px !important;">
                                               <?php $item=BaseArea::model()->find("id='$model->area_id'"); echo $item?$item->name:"";  ?>
                                            </div>
                                        </div>
                                       <div class="control-group" style="float:left;" >
                                            <label class="control-label control-labela">组团</label>
                                            <div class="controls" style="width:274px !important;">
                                               <?php $item=BaseEstateGroup::model()->find("id='$model->estate_group_id'"); echo $item?$item->name:"";  ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">品牌</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php $item=BaseEstate::model()->find("id='$model->estate_id'");echo $item?$item->name:"";  ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">系列</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php $building=BaseBuilding::model()->find("id='$model->building_id'");echo $building?$building->name:"";  ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">编号</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php echo $model==null?"":$model->house_no;?>
                                            </div>
                                        </div>
                                       <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">规则</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php echo $building?$building->room_number_rule:"";  ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">房本建筑面积</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php echo $model->room_area;?>㎡
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">幼狮承租建筑面积</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php echo $model->area;?>㎡
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">使用面积</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php echo $propertydetail->sum_area?($propertydetail->sum_area/100).'㎡':'';?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">项目属性</label>
                                            <div class="controls" style="width:274px !important;">
                                            <?php
                                                if($building->type==1){echo 'A1';}if($building->type==2){echo 'A2';}if($building->type==3){echo 'A3';}
                                            ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">朝向</label>
                                            <div class="controls" style="width:274px !important;">
                                            <?php
                                                if($model->orientation=="南"){echo '南';}if($model->orientation=="南北"){echo '南北';}
                                                if($model->orientation=="东"){echo '东';}if($model->orientation=="东南"){echo '东南';}
                                                if($model->orientation=="东北"){echo '东北';}if($model->orientation=="西"){echo '西';}
                                                if($model->orientation=="西南"){echo '西南';}if($model->orientation=="西北"){echo '西北';}if($model->orientation=="北"){echo '北';}
                                            ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">空置日期</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php echo $model->idle_time?date('Y-m-d',$model->idle_time):"";?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">付款方式</label>
                                            <div class="controls" style="width:274px !important;">
                                               押&nbsp<?php echo $model->deposit;?>付&nbsp<?php echo $model->pay;?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">月租金</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php echo $model->price?($model->price/100).'/元/月':'';?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">车源状态</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php
                                                    if(Property::PurchaseContract($model->id)){
                                                      echo '幼狮车源';
                                                    }else if($model->status!==null){
                                                      echo $model->status==1?'未租':'他租';
                                                    }
                                               ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">现状</label>
                                            <div class="controls" style="width:274px !important;">
                                                <?php
                                                    if($model->status_now==1){echo '未出库';}if($model->status_now==2){echo '近期可出库';}
                                                    if($model->status_now==3){echo '近期不可出库';}if($model->status_now==4){echo '维修中';}
                                                ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div style="float:left;<?php if($model->status_now==1||$model->status_now==4||$model->status_now==0){ echo "display:none";
                                        }?>">
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label control-labela">到期时间</label>
                                                <div class="controls" style="width:274px !important;">
                                                    <?php echo $model->end_time?date('Y-m-d',$model->end_time):"";?>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">备注</label>
                                            <div style="float:left;width:630px;height:170px;">
                                                <textarea  name="time_memo" type="text" style="resize:none;width:400px;height:120px;border:0px !important" readonly=true maxlength="255"><?php echo $model->time_memo;?></textarea>
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
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车源详细信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">房租进深</label>
                                            <div class="controls">
                                                <?php echo $propertydetail->width?($propertydetail->width/100).'m':'';?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车源净层高</label>
                                            <div class="controls">
                                                <?php echo $propertydetail->height?($propertydetail->height/100).'m':'';?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">项目单层面积</label>
                                            <div class="controls">
                                                <?php echo $propertydetail->area_one?($propertydetail->area_one/100).'㎡':'';?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">几梯</label>
                                            <div class="controls">
                                                <?php echo $propertydetail->ti==null?"":$propertydetail->ti;?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">几户</label>
                                            <div class="controls">
                                                <?php echo $propertydetail->hu==null?"":$propertydetail->hu;?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">采光性</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="sunshine" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->sunshine=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="sunshine" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->sunshine=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="sunshine" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->sunshine=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">落地窗</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="french_window" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->french_window=="1"?"checked":""; ?> class=" m-wrap"/>是
                                                </label>
                                                <label class="radio">
                                                    <input name="french_window" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->french_window=="0"?"checked":""; ?> class=" m-wrap"/>否
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">明显立柱</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="crutch" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->crutch=="1"?"checked":""; ?> class=" m-wrap"/>有
                                                </label>
                                                <label class="radio">
                                                    <input name="crutch" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->crutch=="0"?"checked":""; ?> class=" m-wrap"/>无
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">户门大小</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="door" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->door=="0"?"checked":""; ?> class=" m-wrap"/>单扇
                                                </label>
                                                <label class="radio">
                                                    <input name="door" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->door=="1"?"checked":""; ?> class=" m-wrap"/>双扇
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">喷淋头</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="spray" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->spray=="0"?"checked":""; ?> class=" m-wrap"/>朝上
                                                </label>
                                                <label class="radio">
                                                    <input name="spray" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->spray=="1"?"checked":""; ?> class=" m-wrap"/>朝下
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">窗外有遮挡物</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="hide" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->hide=="1"?"checked":""; ?> class=" m-wrap"/>有
                                                </label>
                                                <label class="radio">
                                                    <input name="hide" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->hide=="0"?"checked":""; ?> class=" m-wrap"/>无
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车源是否漏水</label>
                                            <div class="controls" style="width:230px">
                                                <label class="radio">
                                                    <input name="leak" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->leak=="1"?"checked":""; ?> class=" m-wrap"/>是
                                                </label>
                                                <label class="radio">
                                                    <input name="leak" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->leak=="0"?"checked":""; ?> class=" m-wrap"/>否
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;margin-left: 0px !important">
                                            <label class="control-label" style="width:129px !important">车源面积与房本一致</label>
                                            <div class="controls" style="width:260px;">
                                                <label class="radio">
                                                    <input name="house_same" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->house_same=="1"?"checked":""; ?> class=" m-wrap"/>是
                                                </label>
                                                <label class="radio">
                                                    <input name="house_same" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->house_same=="0"?"checked":""; ?> class=" m-wrap"/>否
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">楼道及卫生间</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="corridor_toilet" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->corridor_toilet=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="corridor_toilet" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->corridor_toilet=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="corridor_toilet" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->corridor_toilet=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">同层其他租户</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="other_rentor" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->other_rentor=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="other_rentor" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->other_rentor=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="other_rentor" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->other_rentor=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车源原始装修</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="original_decoration" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->original_decoration=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="original_decoration" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->original_decoration=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="original_decoration" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->original_decoration=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">户内顶灯</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="toplight" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->toplight=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="toplight" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->toplight=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="toplight" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->toplight=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">地面品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="ground" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->ground=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="ground" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->ground=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="ground" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->ground=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">踢脚线品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="baseboard" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->baseboard=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="baseboard" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->baseboard=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="baseboard" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->baseboard=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">隔断品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="partition" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->partition=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="partition" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->partition=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="partition" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->partition=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">吊顶品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="ceiling" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->ceiling=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="ceiling" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->ceiling=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="ceiling" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->ceiling=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">灯具品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="lamp" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->lamp=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="lamp" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->lamp=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="lamp" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->lamp=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">墙面品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="wall" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->wall=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="wall" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->wall=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="wall" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->wall=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">地插墙插布局合理性</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="plug" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->plug=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="plug" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->plug=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="plug" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->plug=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">户门／窗户品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="door_window" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->door_window=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="door_window" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->door_window=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="door_window" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->door_window=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车源布局合理性</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="room_layout" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->room_layout=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="room_layout" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->room_layout=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="room_layout" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->room_layout=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">隔断logo墙和前台品质</label>
                                            <div class="controls">
                                                <label class="radio">
                                                    <input name="logo_front" disabled=true type="radio" value="0" <?php echo $propertydetail==null?"":$propertydetail->logo_front=="0"?"checked":""; ?> class=" m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="logo_front" disabled=true type="radio" value="1" <?php echo $propertydetail==null?"":$propertydetail->logo_front=="1"?"checked":""; ?> class=" m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="logo_front" disabled=true type="radio" value="2" <?php echo $propertydetail==null?"":$propertydetail->logo_front=="2"?"checked":""; ?> class=" m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车主个人信息</span>
                                        <br>
                                        <div class="control-group"  style="float:left;">
                                            <label class="control-label">车主姓名</label>
                                            <div class="controls">
                                                <?php echo $ownersg->owner_name?$ownersg->owner_name:""; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">身份证号</label>
                                            <div class="controls">
                                                <?php echo $ownersg->id_card?$ownersg->id_card:""; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">性别</label>
                                            <div class="controls">
                                               <?php
                                                    if($ownersg->owner_gender==1){
                                                      echo '女';
                                                    }
                                                    if($ownersg->owner_gender==2){
                                                      echo '男';
                                                    }
                                               ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">年龄</label>
                                            <div class="controls">
                                                <?php echo $ownersg->owner_age==null?"":$ownersg->owner_age; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">所在城市</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->owner_city; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">籍贯</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->owner_roots; ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">职位</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->owner_position; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">从事行业</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->owner_trade; ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <?php
                                        $admin_uid = Yii::app()->session['admin_uid'];
                                        $admin = AdminUser::model()->find("id='$admin_uid'");
                                        if(AdminPositionModul::has_modul("501_17") ) {
                                            foreach(explode("/",$ownersg->owner_contact) as $key=>$value){
                                        ?>
                                          <div class="control-group" style="float:left;">
                                              <label class="control-label">联系方式</label>
                                              <div class="controls">
                                                  <?php echo $value;?>
                                              </div>
                                          </div>
                                        <?php
                                            if(!is_float(($key+1)/3)){ echo "<div style='clear:both;'></div>";}
                                             }
                                        }
                                        ?>
                                        <div style="clear:both;"></div>
                                        <br>
                                        <br>
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">代理人信息</span>
                                        <br>
                                        <?php
                                            foreach($propertyagent as $key=>$value){
                                        ?>
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label">姓名</label>
                                                <div class="controls">
                                                    <?php echo $value->agent_name?>
                                                </div>
                                            </div>
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label">电话</label>
                                                <div class="controls">
                                                    <?php echo $value->agent_phone?>
                                                </div>
                                            </div>
                                            <div style="clear:both;"></div>
                                        <?php }?>
                                        <br>
                                        <br>
                                        <span style="font-size:16px;font-weight:bold;margin-left:30px;"><b>经营公司信息</b> </span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">企业名称</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->company; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">主要经营范围</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->business_scope; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">经营项目</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->business_project; ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">公司类型</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->company_type; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">核心经营项目</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->core_project; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">办公人数</label>
                                            <div class="controls">
                                                <?php echo $ownersg->people==null?"":$ownersg->people; ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <br>
                                        <br>
                                        <span style="font-size:16px;font-weight:bold;margin-left:30px;"> <b>车主关联信息</b></span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主亲属公司</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->rel_company; ?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主朋友公司</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->friend_company;  ?>
                                            </div>
                                        </div>
<!--                                         <div class="control-group" style="float:left;">
                                            <label class="control-label">车主朋友公司</label>
                                            <div class="controls">
                                                <?php //echo $ownersg==null?"":$ownersg->friend_company1;  ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div> -->
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主关联上下游公司</label>
                                            <div class="controls">
                                                <?php echo $ownersg==null?"":$ownersg->relation_company; ?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:30px;"><b>车源图片：</b></span>
                                        <br>
                                        <br>
    <!--图片-->                         <?php
                                            $count=0;
                                            if($photo){
                                                foreach ($photo as $k => $v){
                                                    $count++;
                                        ?>
                                            <div class="control-group">
                                                <label class="control-label">图片类型</label>
                                                <div class="controls">
                                                    <select name="type_photo[]" disabled=true>
                                                        <option value="">请选择图片类型</option>
                                                        <option value="1" <?php echo $k==1? "selected":""?> >车源内饰</option>
                                                        <option value="2" <?php echo $k==2? "selected":""?>>车源内饰</option>
                                                        <option value="3" <?php echo $k==3? "selected":""?>>车源外部图片</option>
                                                        <option value="4" <?php echo $k==4? "selected":""?>>车源前景图（细）</option>
                                                        <option value="5" <?php echo $k==5? "selected":""?>>车源后景图（细）</option>
                                                        <option value="6" <?php echo $k==6? "selected":""?>>车源左侧图（细）</option>
                                                        <option value="7" <?php echo $k==7? "selected":""?>>车源右侧图（细）</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group" style="clear:both;display: block;">
                                                <div id="property_photo_div<?php echo $k?>" style="float:left;100%;height:100px;<?php echo $k==null?'display: none':''; ?>">
                                                    <img name="property_photo_show" src="" style='display:none;max-width:150px;max-height:150px;float:left;margin-left:10px'/>
                                                    <?php
                                                        if ($v):?>
                                                        <?php foreach ($v as $k1 => $v1):?>
                                                            <a target="_Blank" href="<?php echo $v1->url ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
                                                            <a style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px;float:left;" href="/admin/property/download?url=<?php echo $v1->url;?>">下载</a>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="form-actions">
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">返回</button>
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
</script>
