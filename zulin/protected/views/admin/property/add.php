<style>
    .control-group{margin-bottom:0px !important;margin-top:0px !important;padding-bottom: 10px !important;}
    select{height:34px;}
    .control-label{font-weight:bold !important;width:86px !important;}
    .control-labela{width:130px !important;}
    .yj-xg-btn{width: 95%;margin:15px auto;}
    .yj-xg-btn div {width: 24.9%;float:left;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
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

                                <div class="caption"><i class="icon-reorder"></i>车辆-新增</div>

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
                                <form action="/admin/property/addsave" id="form_add"  method="post"  class="form-horizontal js-submit">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式优误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="yj-xg-btn">
                                        <div style="background:#0160cb;"><a href="javascript:void(0)" style="color:white;">添加车辆基本信息 </a></div>
                                        <div><a href="javascript:void(0)">添加车源详细信息 </a></div>
                                        <div><a href="javascript:void(0)">添加车主相关信息</a></div>
                                        <div><a href="javascript:void(0)">添加车源图片信息</a></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                        <div class="control-group" style="float:left;margin-top:-10px;">
                                            <label class="control-label control-labela">录入人<span class="required">*</span></label>
                                            <div class="controls" style="font-size:14px;line-height:31px;color:#555;width:274px !important;">
                                                <?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:'';?>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;margin-top:-10px;">
                                            <label class="control-label control-labela">归属人<span class="required">*</span></label>
                                            <div class="controls" style="font-size:14px;line-height:31px;color:#555;width:274px !important;">
                                                <?php echo  $item?$item->nickname:'';?>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车辆基本信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">品牌<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input type="hidden" name="estate_id" id="estate_id" class="select2" style="width:220px;">
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">系列<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="building_id" id="building_id" class="m-wrap" >
                                                </select>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;" >
                                            <label class="control-label control-labela">汽车类型<span class="required"></span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="room_type" id="room_type" readonly class="m-wrap">
                                                </select>
                                            </div>
                                        </div>
                                       <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">规则<span class="required"></span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="room_number_rule" id="room_number_rule" class="m-wrap" style="width:220px;">
                                                </select>
                                <!--                 <input name="room_number_rule" type="text" readonly=true  value="" style="border:0px !important" id="room_number_rule" class="m-wrap"/> -->
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">汽车编号<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="house_no" type="text" value="" id="house_no" class="m-wrap" placeholder="注:A代表字母,0代表数字" onkeyup="value=value.replace(/[^\A-\Z0-9\-]/g,'')" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <!-- <label class="control-label control-labela">车源号<span class="required">*</span></label>   -->
                                        <script>
                                            // 车源号规则
                                            $("select[name='building_id']").change(
                                             function(){
                                                var qq = $("#building_id").val();

                                                    $.ajax("/admin/ajax/GetHouseRule", {
                                                        data: {
                                                            id:qq
                                                        },
                                                        dataType: "json"
                                                    }).done(function (data) {
                                                        var options="";
                                                        if(data.length>0){
                                                            for(var i=0;i<data.length;i++){
                                                                if (i==0){
                                                                    options+="<option selected value="+data[i].title+">"+data[i].title+"</option>";
                                                                }
                                                                else{
                                                                    options+="<option value="+data[i].title+">"+data[i].title+"</option>";
                                                                }
                                                            }
                                                            $("select[name='room_number_rule']").html(options);
                                                        }
                                                        var b="";
                                                        b+="<option selected value="+data[0].type+">"+data[0].type+"</option>";
                                                        $("select[name='type']").html(b);
                                                        var a="";
                                                        a+="<option selected value="+data[0].room_type+">"+data[0].room_types+"</option>";
                                                        $("select[name='room_type']").html(a);

                                                    });
                                            });

                                            $("input[name='house_no']").blur(function(){
                                                var room_number_rule=$("select[name='room_number_rule']").val();
                                                var house_no=$("#house_no").val();
                                                if(room_number_rule && house_no){
                                                    if(house_no.length!=room_number_rule.length){
                                                        this.value='';
                                                        alert("车源号位数不正确");
                                                        return;
                                                    }
                                                    var house_no_arr=house_no.split('');
                                                    var room_rule_arr=room_number_rule.split('');
                                                    for (var i = house_no_arr.length - 1; i >= 0; i--) {
                                                        if(room_rule_arr[i]=='-'){
                                                            if(house_no_arr[i]!=room_rule_arr[i]){
                                                                alert("不符合车源号-规则");
                                                                this.value='';
                                                                return;
                                                            }
                                                        }
                                                        //判断车源号规则里的字母
                                                        if(room_rule_arr[i]=='A'){
                                                            if(!isNaN(parseInt(house_no_arr[i])) || house_no_arr[i]=='-'){
                                                                alert("不符合车源号字母规则");
                                                                this.value='';
                                                                return;
                                                            }
                                                        }
                                                        //判断车源号规则里的数字
                                                        if(room_rule_arr[i]=='0'){
                                                                // console.log(room_rule_arr[i]);
                                                            if(isNaN(parseInt(house_no_arr[i]))){
                                                                alert("不符合车源号数字规则");
                                                                this.value='';
                                                                return;
                                                            }
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">汽车车牌号<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="room_area" type="text"  class="m-wrap" required value=""  >
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela control-label control-labelaa" style="">幼狮承租建筑面积<span class="required">*</span></label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="area" type="text"  id="area" class="m-wrap" value=""  maxlength="7" onblur="check(this.value,this);">㎡
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
                                                <input name="sum_area" type="text" placeholder="只能输入整数或小数"  class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>㎡
                                            </div>
                                        </div> -->
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">预计收购资金</label>
                                            <div class="controls" style="width:299px !important;">
                                                <input name="price" type="text"  placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>元
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">汽车属性</label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="type" id="type" readonly class="m-wrap">
                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">朝向</label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="orientation" class="m-wrap">
                                                    <option value=""></option>
                                                    <option value="南">南</option>
                                                    <option value="南北">南北</option>
                                                    <option value="东">东</option>
                                                    <option value="东南">东南</option>
                                                    <option value="东北">东北</option>
                                                    <option value="西">西</option>
                                                    <option value="西南">西南</option>
                                                    <option value="西北">西北</option>
                                                    <option value="北">北</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">空置日期</label>
                                            <div class="controls" style="width:274px !important;">
                                                <input name="idle_time" type="text" id="datepicker1" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">付款方式</label>
                                            <div class="controls" style="width:274px !important;">
                                                <span>
                                                   &nbsp;押&nbsp<input type="text" name="deposit" placeholder="整数" maxlength="3" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap" style="width:55px">
                                                </span>
                                                <span style="margin-left:10px">
                                                   付&nbsp<input type="text" name="pay" placeholder="整数" maxlength="3" onkeyup="value=value.replace(/[^0-9]+/,'')"  class="m-wrap" style="width:55px">
                                                </span>
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label control-labela">现状</label>
                                            <div class="controls" style="width:274px !important;">
                                                <select name="status_now" class="m-wrap">
                                                    <option value="">请选择</option>
                                                    <option value="1">未出库</option>
                                                    <option value="2">近期可出库</option>
                                                    <option value="3">近期不可出库</option>
                                                    <option value="4">维修中</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="add" style="display:none;float:left;">
                                            <div class="control-group" style="float:left;">
                                                <label class="control-label control-labela">到期时间</label>
                                                <div class="controls" style="width:274px !important;">
                                                    <input name="end_time" type="text" id="datepicker" class="m-wrap">
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group">
                                            <label class="control-label control-labela">备注</label>
                                            <div class="controls">
                                                <textarea  name="time_memo" type="text" maxlength="255"  style="resize: none;width:500px;height:120px;"></textarea>
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
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车辆检测报告</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车辆高度</label>
                                            <div class="controls">
                                                <input name="width" type="text" placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>m
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">公里数</label>
                                            <div class="controls">
                                                <input name="height" type="text"  placeholder="只能输入整数或小数" class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>m
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label">项目单层面积</label>
                                            <div class="controls">
                                                <input name="area_one" type="text" placeholder="只能输入整数或小数"  class="m-wrap" maxlength="7" onblur="check(this.value,this);"/>㎡
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">箱数</label>
                                            <div class="controls">
                                                <input name="ti" type="text" placeholder="只能输入整数" maxlength="3" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label">几户</label>
                                            <div class="controls">
                                                <input name="hu" type="text" placeholder="只能输入整数" maxlength="3" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap"/>
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左C柱</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="sunshine" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="sunshine" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <!-- <label class="radio">
                                                    <input name="sunshine" type="radio" value="2" class="m-wrap"/>差
                                                </label> -->
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右A柱</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="french_window" type="radio" value="1" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="french_window" type="radio" value="0" class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>

                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左前翼子板内衬</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="crutch" type="radio" value="1" class="m-wrap"/>忧
                                                </label>
                                                <label class="radio">
                                                    <input name="crutch" type="radio" value="0" class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">前防撞梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="door" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="door" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">后围板</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="spray" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="spray" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左前减震器座</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="hide" type="radio" value="1" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="hide" type="radio" value="0" class="m-wrap"/>无
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左B柱</label>
                                            <div class="controls" style="width:260px">
                                                <label class="radio">
                                                    <input name="leak" type="radio" value="1" class="m-wrap"/>是
                                                </label>
                                                <label class="radio">
                                                    <input name="leak" type="radio" value="0" class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;margin-left: 0px !important">
                                            <label class="control-label" style="width:129px !important">右前翼子板内衬</label>
                                            <div class="controls" style="width:260px;">
                                                <label class="radio">
                                                    <input name="house_same" type="radio" value="1" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="house_same" type="radio" value="0" class="m-wrap"/>良
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">后防撞梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="corridor_toilet" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="corridor_toilet" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="corridor_toilet" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右前纵梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="other_rentor" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="other_rentor" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="other_rentor" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">后备箱底板</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="original_decoration" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="original_decoration" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="original_decoration" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右前减震器座</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="toplight" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="toplight" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="toplight" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右侧底边梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="ground" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="ground" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="ground" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左前纵梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="baseboard" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="baseboard" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="baseboard" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左车顶边梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="partition" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="partition" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="partition" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左侧底边梁</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="ceiling" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="ceiling" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="ceiling" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">水箱框架</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="lamp" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="lamp" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="lamp" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">防火墙</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="wall" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="wall" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="wall" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左后翼子板内衬</label>
                                            <div class="controls" style="width:250px;">
                                                <label class="radio">
                                                    <input name="plug" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="plug" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="plug" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">左后纵梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="door_window" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="door_window" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="door_window" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右后翼子板内衬</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="room_layout" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="room_layout" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="room_layout" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">右车顶边梁</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="logo_front" type="radio" value="0" class="m-wrap"/>优
                                                </label>
                                                <label class="radio">
                                                    <input name="logo_front" type="radio" value="1" class="m-wrap"/>良
                                                </label>
                                                <label class="radio">
                                                    <input name="logo_front" type="radio" value="2" class="m-wrap"/>差
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车主个人信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主姓名<span class="required">*</span></label>
                                            <div class="controls">
                                                <input name="owner_name" type="text" maxlength="10" required class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">身份证号</label>
                                            <div class="controls">
                                                <input name="id_card" type="text" placeholder=""  maxlength="18" onkeyup="value=value.replace(/^[a-zA-Z]+\D*|^\d{0,16}[a-zA-Z]+|[^0-9Xx]/g,'')" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">性别</label>
                                            <div class="controls" style="width:220px;">
                                                <label class="radio">
                                                    <input name="owner_gender" type="radio" value="1" class="m-wrap"/>女
                                                </label>
                                                <label class="radio">
                                                    <input name="owner_gender" type="radio" value="2" class="m-wrap"/>男
                                                </label>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">年龄</label>
                                            <div class="controls">
                                                <input name="owner_age" type="text" placeholder="只能输入整数" maxlength="4" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">所在城市</label>
                                            <div class="controls">
                                                <input name="owner_city" type="text" placeholder=""  maxlength="20" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">籍贯</label>
                                            <div class="controls">
                                                <input name="owner_roots" type="text" placeholder="" maxlength="10" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">职位</label>
                                            <div class="controls">
                                                <input name="owner_position" type="text" maxlength="20" placeholder="" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">从事行业</label>
                                            <div class="controls">
                                                <input name="owner_trade" type="text" placeholder="" maxlength="20" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group">
                                            <label class="control-label">联系方式</label>
                                            <div class="controls">
                                                <input name="owner_contact[]" value="" type="text" placeholder="" onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" class="m-wrap"/>
                                                <input name="" type="button" class="span1 m-wrap add_contact" style="width:60px;" value="添加"/>
                                            </div>
                                        </div>
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
                                        </script>
                                        <div style="clear:both;"></div>
                                        <br>
                                        <br>
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">代理人信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">姓名</label>
                                            <div class="controls">
                                                <input name="agent_name[]" type="text" placeholder="" maxlength="20" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">电话</label>
                                            <div class="controls">
                                                <input name="agent_phone[]" value="" type="text" placeholder="" onkeyup="value=value.replace(/[^\0-\9-]/g,'')"  maxlength="11" class="m-wrap"/>
                                                <input name="" type="button" class="span1 m-wrap add_agent" style="width:60px;" value="添加"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="agent_box"></div>
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
                                        </script>

                                        <br>
                                        <br>
                                        <!-- <span style="font-size:16px;font-weight:bold;margin-left:55px;">经营公司信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">企业名称</label>
                                            <div class="controls">
                                                <input name="company" type="text" placeholder="" maxlength="20" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">主要经营范围</label>
                                            <div class="controls">
                                                <input name="business_scope" type="text" placeholder="" maxlength="255" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">经营项目</label>
                                            <div class="controls">
                                                <input name="business_project" type="text" placeholder="" maxlength="255" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">公司类型</label>
                                            <div class="controls">
                                                <input name="company_type" type="text" placeholder="" maxlength="255" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">核心经营项目</label>
                                            <div class="controls">
                                                <input name="core_project" type="text" placeholder="" maxlength="255" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">办公人数</label>
                                            <div class="controls">
                                                <input name="people" type="text" placeholder="只能输入整数" maxlength="7" onkeyup="value=value.replace(/[^0-9]+/,'')" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div style="clear:both;"></div>
                                        <br>
                                        <br>
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车主关联信息</span>
                                        <br>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主亲属公司</label>
                                            <div class="controls">
                                                <input name="rel_company" type="text" maxlength="20" class="m-wrap"/>
                                            </div>
                                        </div> -->
<!--                                         <div class="control-group" style="float:left;">
                                            <label class="control-label">车主朋友公司</label>
                                            <div class="controls">
                                                <input name="friend_company" type="text" maxlength="20" class="m-wrap"/>
                                            </div>
                                        </div> -->
                                        <!-- <div class="control-group" style="float:left;">
                                            <label class="control-label">车主朋友公司</label>
                                            <div class="controls">
                                                <input name="friend_company1" type="text" maxlength="20" class="m-wrap"/>
                                            </div>
                                        </div>
                                        <div class="control-group" style="float:left;">
                                            <label class="control-label">车主关联上下游公司</label>
                                            <div class="controls">
                                                <input name="relation_company" type="text"  maxlength="100" class="m-wrap"/>
                                            </div>
                                        </div> -->
                                        <div style="clear:both;"></div>
                                    </div>
                                    <div class="yj-xg-xbox"  style="display:none">
                                        <span style="font-size:16px;font-weight:bold;margin-left:55px;">车源图片(图片类型不能选重复并且不能为空)</span>
                                        <br>
    <!--图片-->
                                        <div id="propertys">
                                        </div>
                                        <div style="display:none" class="select">
                                            <div class="control-group">
                                                <label class="control-label">图片类型</label>
                                                <div class="controls">
                                                    <select name="type_photo[]">
                                                        <option value="">请选择图片类型</option>
                                                        <option value="1">车源内饰</option>
                                                        <option value="2">车源外部图片</option>
                                                        <option value="3">车源前景图（细）</option>
                                                        <option value="4">车源后景图（细）</option>
                                                        <option value="5">车源左侧图（细）</option>
                                                        <option value="6">车源右侧图(细)</option>
                                                        <!-- <option value="7">车源(室内吊顶)</option> -->
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- 图片开始 -->
                                            <div class="control-group" style="clear:both;">
                                                <div class="controls" style="margin-top:10px;">
                                                    <span style="float:left;">
                                                        <input type="hidden" name="property_photo[]" />
                                                        <span id="PlaceHolder_property_photo"></span>
                                                    </span>
                                                    <span>
                                                         <input type="button" class="btn red" value="编辑" style="height:31px!important;margin-left:10px;">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <div class="upload_progress">
                                                        <span class="localname"></span>
                                                    </div>
                                                    <div class="fieldset flash" id="fsUploadProgress_property_photo">
                                                        <span class="legend"></span>
                                                    </div>
                                                    <div id="property_photo_div" style="height:160px;display: none;">
                                                        <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:150px;float:left;margin-left:10px'/>
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- 图片结束 -->
                                        </div>

                                        <div class="control-group" style="margin-top:-5px;">
                                            <div class="controls">
                                                <button id='add_property' type="button" class="btn btn-primary">添加</button>
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
                                    <script>
                                    //添加多个类型
                                    var nummore =$('.more');
                                    $("button[id='add_property']").live("click",function(e){
                                    mores =$('.select').clone();
                                    mores.removeClass('select');
                                    mores.show();
                                    mores.addClass('more');
                                    nummore =$('.more');
                                    mores.find("#PlaceHolder_property_photo").attr('id','PlaceHolder_property_photo'+nummore.length);
                                    mores.find("#fsUploadProgress_property_photo").attr('id','fsUploadProgress_property_photo'+nummore.length);
                                    mores.find("#property_photo_div").attr('id','property_photo_div'+nummore.length);
                                    //mores.find(".property_photo_show").attr('class','property_photo_show'+nummore.length);

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
                                                    progressTarget : 'fsUploadProgress_property_photo'+nummore.length,
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "65",
                                                button_height: "30",
                                                button_placeholder_id: 'PlaceHolder_property_photo'+nummore.length,
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">上传</span>',
                                                button_text_style: ".theFont {font-size: 14; color:#ffffff;margin-left:-20px !important;}",
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
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            $('#property_photo_div'+nummore.length).append(new_img);
                                            $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                            document.getElementsByName("property_photo[]")[nummore.length].value=document.getElementsByName("property_photo[]")[nummore.length].value+','+file_url;
                                            $('#property_photo_div'+nummore.length).show();
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
                                    </script>
                                    <div class="form-actions">
                                        <button type="submit" class="btn submit js-btnadd btn-primary">保存</button>
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
    .theFont{font-size: 20px;text-align:center !;}
</style>
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

<script>
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
</script>

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
