<style>
#jqaddlink{display:none!important;}
  .dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
  #follow{background-color:#fff;display:none;z-index:1;position:fixed;width:50%;top:20%;left:30%;overflow:auto;height:60%;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;}
  #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  #sales{background-color:#fff;display:none;z-index:1;position:fixed;min-width:900px;min-height:400px;height:800px;left:30%;top:10%;overflow:auto!important;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;}
  #closemodel2{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  .control-group{margin-left:-5px !important;}
  input{width:110px;}
  select{width:110px;}
</style>
<?php
/* @var $this RecController */
/* @var $dataProvider CActiveDataProvider */

// $this->breadcrumbs=array(
//   'Recs',
// );

// $this->menu=array(
//   array('label'=>'Create Rec', 'url'=>array('create')),
//   array('label'=>'Manage Rec', 'url'=>array('admin')),
// );
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);

  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
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
            <div class="caption"><i class="icon-globe"></i>车源列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid" style="height:120px;">
                <form action="/admin/property/index">
                    <div class="dataTables_filter" style='margin-left:0;padding:0;'>
                      <input type="hidden" value="<?php echo $search ?>" name="search">
                      <!-- <span>
                        商圈：<input type="text"  value="<?php echo $k_district;?>"  name="k_district">
                      </span> -->
                      <span>
                        品牌：<input type="text" value="<?php echo $k_estates;?>"  name="k_estates">
                      </span>
                      <span>
                        类型：<input type="text"  value="<?php echo $k_building;?>"  name="k_building">
                      </span>
                      <span>
                        汽车编号：<input type="text" value="<?php echo $k_house_no;?>"  name="k_house_no">
                      </span>
                      <span>
                        </button><input type="checkbox" id="highsearch">高级搜索</button>
                      </span>
                      <button id="sample_editable_1_new" class="btn btn-primary" type="submit">搜索 <i class="icon-search"></i></button>
                    </div>
                    <div id="content" style="display:none;">
                      <div class="dataTables_filter" style='margin-left:0;padding:0;'>
                        <!-- <span>
                          面积：<input type="text" style="width:60px;"  value="<?php echo $k_area1;?>" name="k_area1">到<input type="text" style="width:60px;" value="<?php echo $k_area2;?>" name="k_area2">
                        </span> -->
                        <span>
                          归属人：<input type="text" value="<?php echo $k_ascription;?>"  name="k_ascription">
                        </span>
                        <span>
                          产品类型：
                          <select name="k_room_type" id="">
                          <?php foreach ($arr['room_type'] as $key => $value) {
                          ?>
                            <option value="<?php echo $key?>"  <?php echo $k_room_type==$key? "selected":""?>><?php echo $value ?></option>
                          <?php
                          }?>
                          </select>
                        </span>
                        <!-- <span>
                          车源状态：
                          <select name="k_status" id="">
                            <option value="0" <?php echo $k_status==0?'selected=selected':''?>>请选择</option>
                            <option value="1" <?php echo $k_status==1?'selected=selected':''?>>未租车源</option>
                            <option value="2" <?php echo $k_status==2?'selected=selected':''?>>他租车源</option>
                            <option value="3" <?php echo $k_status==3?'selected=selected':''?>>幼狮车源</option>
                          </select>
                        </span> -->
                      </div>
                      <div class="dataTables_filter" style='margin-left:0;padding:0;'>
                        <span >
                          项目属性：
                          <select name="k_type" id="">
                            <option value="0">请选择</option>
                            <option value="1" <?php echo $k_type==1?'selected=selected':''?>>A1</option>
                            <option value="2" <?php echo $k_type==2?'selected=selected':''?>>A2</option>
                            <option value="3" <?php echo $k_type==3?'selected=selected':''?>>A3</option>
                          </select>
                        </span>
                        <span>
                          是否有车主电话：
                          <select name="k_owner_contact" id="">
                            <option value="0" <?php echo $k_owner_contact==0?'selected=selected':''?>>请选择</option>
                            <option value="1" <?php echo $k_owner_contact==1?'selected=selected':''?>>有</option>
                            <option value="2" <?php echo $k_owner_contact==2?'selected=selected':''?>>无</option>
                          </select>
                        </span>
                        <span>
                          现状：
                          <select name="k_status_now" id="">
                          <?php foreach ($arr['status_now'] as $key => $value) {
                          ?>
                            <option value="<?php echo $key?>"  <?php echo $k_status_now==$key? "selected":""?>><?php echo $value ?></option>
                          <?php
                          }?>
                          </select>
                        </span>
                        <!-- <span>
                          几次约见：
                          <select name="k_meet" id="">
                          <?php foreach ($arr['meet'] as $key => $value) {
                          ?>
                            <option value="<?php echo $key?>"  <?php echo $k_meet==$key? "selected":""?>><?php echo $value ?></option>
                          <?php
                          }?>
                          </select>
                        </span> -->
                        <span style="margin-right:10px" class="line3">录入日期：<input type="text" id="datepicker" value="<?php echo $k_ctime1;?>" name="k_ctime1" />&nbsp;至&nbsp;<input type="text" id="datepicker1" value="<?php echo $k_ctime2;?>" name="k_ctime2" /></span>
                      </div>
                    </div>
                    <script type="text/javascript">
                        var bb = $("input[name=search]").val();
                         if(bb == 2){
                            $("#content").css("display","block")
                            $("#highsearch").attr("checked",true)
                         }
                    </script>

                    <script type="text/javascript">
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
                </form>
                <div class="btn-group pull-right">
                <?php if(AdminPositionModul::has_modul("501_01")) {?>
                <a href="/admin/property/add">
                  <button id="sample_editable_1" class="btn btn-primary">
                  新建 <i class="icon-plus"></i>
                  </button>
                </a>
                <?php }?>
              </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr class="yj-title-th">

                    <th class="hidden-480">车源类型</th>
                    <th class="hidden-480">车源属性</th>
                    <th class="hidden-480">品牌</th>
                    <th class="hidden-480">类型</th>
                    <th class="hidden-480">编号</th>
                    <!-- <th class="hidden-480">预计资金</th> -->
                    <!-- <th class="hidden-480">车辆状态</th> -->
                    <th class="hidden-480">车主电话</th>
                    <th class="hidden-480">现状</th>
                    <th class="hidden-480">归属人</th>
                    <th class="hidden-480">time</th>
                    <th >操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($list){
                    ?>
                    <?php
                    foreach($list as $user){
                      ?>
                      <tr>

                        <td ><?php if($user->room_type){echo $arr['room_type']["$user->room_type"]; }?></td>
                        <td ><?php $item=BaseBuilding::model()->find("id='$user->building_id'"); echo $item?str_replace([1,2,3],['A1','A2','A3'],$item->type):""; ?></td>
                        <td  ><?php $item=BaseEstate::model()->find("id='$user->estate_id'"); echo $item?$item->name:""; ?></td>
                        <td ><?php $item=BaseBuilding::model()->find("id='$user->building_id'"); echo $item?$item->name:""; ?></td>
                        <td ><?php echo CHtml::encode($user->house_no); ?></td>
                        <!-- <td><?php echo $user->price && $user->area?round(($user->price/100*12/365)/$user->area,2).'元/㎡/天':'';?></td> -->
                        <!-- <td>
                          <?php
                            if(Property::PurchaseContract($user->id)){
                              echo '幼狮车源';
                            }else if($user->status!==null){
                              echo $user->status==1?'未租':'他租';
                            }
                          ?>
                        </td> -->
                        <td><?php $item=CmsOwnerSg::model()->find("property_id='$user->id'");if($item&&$item->owner_contact){echo '有';}else if($item&&$item->owner_contact==0){echo '无';}; ?></td>
                        <td><?php if($user->status_now){echo $arr['status_now']["$user->status_now"]; }?></td>
                        <td><?php if($user->ascription_id){$item=AdminUser::model()->find("id='$user->ascription_id'"); echo $item?$item->nickname:""; }?></td>
                        <td><?php echo date('Y-m-d',$user->ctime)  ?></td>
                        <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                             <a href="/admin/property/detail/id/<?php echo $user->id;?>" style="display:block">详情</a>
                              <?php if(AdminPositionModul::has_modul("501_02")) {?>
                              <a href="/admin/property/edit/id/<?php echo $user->id;?>" style="display:block">编辑</a>
                              <?php }else if(AdminPositionModul::has_modul("501_08")) {
                                          $creater_id = Yii::app()->session['admin_uid'];

                                          $creater_name  = CmsProperty::model()->find("creater_id='$creater_id' and id='$user->id'");

                                          if($creater_name!=null) {?>
                                <a href="/admin/property/edit/id/<?php echo $user->id;?>" style="display:block">编辑</a>
                              <?php
                             }
                            }?>
                            <?php if(AdminPositionModul::has_modul("501_13")) {?>
                              <a href="javascript:;"  class="fow" id="<?php echo $user->id;?>" style="display:block">写跟进</a>

                            <?php
                          }else if(AdminPositionModul::has_modul("501_15")) {
                            $admin_uid = Yii::app()->session['admin_uid'];
                            $area_id = AdminUser::model()->find("id='$admin_uid'");
                            $area_name1 = AdminDepartment::model()->find("id='$area_id->department_id'");
                            $area_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");

                            if($area_name) {
                              $base_id = BaseArea::model()->find("name='$area_name->name'");
                              if($base_id!=null) {
                                $name = CmsProperty::model()->findAll("area_id='$base_id->id'");
                                // var_dump($name);
                                if($name!=null) {?>
                                  <a href="javascript:;"  class="fow" id="<?php echo $user->id;?>" style="display:block">写跟进</a>
                                <?php
                                }
                              }
                            }
                          }
                            ?>

                               <?php
                                if(AdminPositionModul::has_modul("501_04")) {?>
                              <a href="/admin/property/follow/id/<?php echo $user->id;?>" style="display:block">查看跟进</a>
                               <?php } if(UrsSalesControl::model()->find("property_id='$user->id' and deleted=0")) {?>
                                   <a  href="javascript:void(0);"  style="color:black" class="sales_control1"  >已添加至销控</a>
                               <?php }else {?>
                                   <a  href="javascript:;"  class="sales_control" id="<?php echo $user->id;?>"  >添加至销控</a>
                               <?php }?>
                              <?php
                                if(AdminPositionModul::has_modul("501_09")) {?>

                              <!-- <a href="/admin/property/log/id/<?php echo $user->id;?>" style="display:block">查看修改日志</a> -->
                              <?php }?>
                              <?php if(AdminPositionModul::has_modul("501_05")) {?>
                              <!-- <a href="/admin/property/split/id/<?php echo $user->id;?>" style="display:block">拆分</a> -->
                              <?php }?>
                              <?php if(AdminPositionModul::has_modul("501_03")) {?>
                                <a href="" address="/admin/property/delete/id/<?php echo $user->id;?>" style="display:block" class="delete" data-toggle="modal" data-target="#about-modal">删除</a>
                              <?php }?>
                            </ul>
                          </div>


                        </td>
                        <!-- <td ><span class="label label-success">Approved</span></td> -->
                      </tr>
                      <?php
                    ?>
                    <?php
                  }
                }
                  ?>
                </tbody>
              </table>

              <script language="javascript" type="text/javascript">
                //选中元素
                $('.fow').click(function(){
                  var property_id=$(this).attr('id');
                  document.getElementById("property_id").value=property_id;
                  // $("#property_id").value="aa";
                  if(document.getElementById("follow").style.display != "block")
                  {
                    document.getElementById("follow").style.display = "block";
                  }
                  else
                  {
                    document.getElementById("follow").style.display = "none";
                  }
                });
              </script>
              <div id="follow" class="portlet-body form" id="form_add"  method="post"  class="form-horizontal js-submit">
                <div style="height:40px;background:#167AC7;margin-bottom:20px;" class="portlet-title">
                   <div class="caption" style="line-height:40px;font-size:20px;text-indent:30px;">写跟进</div>
                </div>
                <form action="/admin/property/followaddsave" id="form_add"  method="post"  class="form-horizontal js-submit">
                    <input type="hidden" name="property_id" id="property_id" value="">
                    <div class="alert alert-error hide">
                        <button class="close" data-dismiss="alert"></button>
                        输入格式有误，请检查输入的数据.
                    </div>
                    <div class="alert alert-success hide">
                        <button class="close" data-dismiss="alert"></button>
                        数据输入验证成功!
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;">
                        <div class="controls">
                            <span>跟进类型：</span>
                            <select name="type">
                                <option value="1" selected>带看</option>
                                <!-- <option >租期跟进</option> -->
                                <option value="2">电话</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;">
                        <div class="controls">
                          &nbsp;跟进人：<input type="text" name="name"  value="<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:'' ?>" disabled=true style="width:110px !important;">
                        </div>
                    </div>
                    <div class="control-group see" style="margin-bottom:0px !important;">
                        <div class="controls">
                            跟进状态：
                            <select name="see_way">
                          <?php foreach ($arr['see_way'] as $key => $value) {
                          ?>
                            <option value="<?php echo $key?>"><?php echo $value ?></option>
                          <?php
                          }?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;width:550px;">
                        <div class="controls">
                            详&nbsp;&nbsp;情：
                            <textarea name="detail" maxlength="255" rows="7" style="width:320px;resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button  type="submit" class="btn btn-primary submit js-btnadd follo" style="margin-left:150px;">确定</button>
                        <button type="button" class="btn"  id="btnn">取消</button>
                    </div>
                     <div class="control-group" id="closemodel">
                       ×
                    </div>
                </form>
              </div>
              <!-- 添加到销控 -->
              <script language="javascript" type="text/javascript">
                //选中元素
                $('.sales_control').click(function(){
                  var property_id=$(this).attr('id');
                  var contract_id=$(this).attr('id1');
                  document.getElementById("property_id2").value=property_id;
                  // document.getElementById("contract_id").value=contract_id;
                  // $("#property_id").value="aa";
                  if(document.getElementById("sales").style.display != "block")
                  {
                    document.getElementById("sales").style.display = "block";
                  }
                  else
                  {
                    document.getElementById("sales").style.display = "none";
                  }
                });
              </script>
              <div id="sales" class="portlet-body form"   method="post"   class="form-horizontal js-submit">
                <div style="height:40px;background:#167AC7;margin-bottom:20px;" class="portlet-title">
                   <div class="caption" style="line-height:40px;font-size:20px;text-indent:30px;">添加至销控</div>
                </div>
                <form action="/admin/ursproperty/SalesControlAddSave"   method="post"  class="form-horizontal js-submit">
                    <input type="hidden" name="idd" id="property_id2" value="">
                    <input type="hidden" name="contract_id" id="contract_id" value="">
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:0px">
                      <div class="controls control">
                        <label>&nbsp;&nbsp;操作人<span class="required" style="color:red">*</span></label>
                        <?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:''; ?>
                      </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:-45px">
                      <div class="controls control">
                        <label>请选择上销控类型<span class="required" style="color:red">*</span></label>
                        <input type="radio"  value='1' name="sales_type" required/>新收车源上销控
                        <input type="radio"   value='2' name="sales_type" />违约/到期车源上销控
                      </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:0px">
                      <div class="controls control">
                        <label>&nbsp;销售报价<span class="required" style="color:red">*</span></label>
                        <input type="text" name="unit_price" value="" required onkeyup="value=value.replace(/[^\d.]/g,'')">元/天
                      </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:0px">
                      <div class="controls control">
                        <label>&nbsp;&nbsp;定价人<span class="required" style="color:red">*</span></label>
                        <input type="text" name="price_maker" maxlength="36" required>
                      </div>
                    </div>
                    <!-- <div class="control-group" style="margin-bottom:0px !important;margin-left:-10px">
                      <div class="controls control">
                        <label>&nbsp;&nbsp;销售面积<span class="required" style="color:red">*</span></label>
                        <input type="text" name="area" value="" maxlength="36" required>
                      </div>
                    </div> -->
                    <div class="">
                      <div class="control-group" style="margin-bottom:0px !important;margin-left:-10px">
                        <div class="controls control">
                          <label>&nbsp;&nbsp;&nbsp;联系人<span class="required" style="color:red;">*</span></label>
                          <input type="text" name="name[]" value="" maxlength="36" required>
                            <button class="btn red addqudao" type="button" style="margin-top:1px;">增加</button>
                        </div>
                      </div>
                      <div class="control-group" style="margin-bottom:0px !important;margin-left:-10px">
                        <div class="controls control">
                          <label>&nbsp;&nbsp;联系电话<span class="required" style="color:red">*</span></label>
                          <input type="number" name="phone[]" value="" maxlength="11"  required>
                        </div>
                      </div>
                    </div>
                    <div class='test' id="qudaorenyuan"></div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:0px">
                      <div class="controls control">
                        <label>可入住日期：</label>
                        <input type="text" id="datepicker2" name="live_date" />
                      </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:0px">
                      <div class="controls control">
                        <label style="float:left">礼品设置:</label>
                        <input type="number" min="0" value = '0' name="number[]"  required  style="width:60px;float:left"><span style="float:left">-</span>
                        <input type="number" min="1" value = '9'   name="number[]"required  style="width:60px;float:left"><span style="float:left">天</span>
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id" class="span6 select2" style="width:220px" value=""  title="">
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id1" class="span6 select2" style="width:220px" value=""  title="">

                        <div style="clear:both"></div>
                        <div style="margin:10px 0"></div>
                        <input type="number" min="1" value = '10'   name="number[]"  required  style="width:60px;margin-left:63px;float:left"><span style="float:left">-</span>
                        <input type="number" min="1" value = '20'  name="number[]"  required  style="width:60px;float:left"><span style="float:left">天</span>
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id2" class="span6 select2" style="width:220px" value=""  title="">
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id3" class="span6 select2" style="width:220px" value=""  title="">

                        <div style="clear:both"></div>
                        <div style="margin:10px 0"></div>
                        <input type="number" min="1" value = '21' name="number[]"  required  style="width:60px;margin-left:63px;float:left"><span style="float:left">-</span>
                        <input type="number" min="1" value = '35' name="number[]"  required  style="width:60px;float:left"><span style="float:left">天</span>
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id4" class="span6 select2" style="width:220px" value=""  title="">
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id5" class="span6 select2" style="width:220px" value=""  title="">

                        <div style="clear:both" ></div>
                        <div style="margin:10px 0"></div>
                        <input type="number" min="1" value = '36'  name="number[]" id="number[]" required  style="width:60px;margin-left:60px;float:left"><span style="float:left">-</span>
                        <input type="number" min="1" value = '199' name="number[]" id="number[]" required  style="width:60px;float:left"><span style="float:left">天</span>
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id6" class="span6 select2" style="width:220px" value=""  title="">
                        <input type="hidden" name="acq_broker[]" required id="channel_manager_id7" class="span6 select2" style="width:220px" value=""  title="">
                        <div class="" id="qudao" style="display:none">
                          <div class="control-group" style="margin-bottom:0px !important;margin-left:-10px">
                            <div class="controls control">
                              <label>&nbsp;&nbsp;&nbsp;联系人<span class="required" style="color:red">*</span></label>
                              <input type="text" name="name[]" value="" maxlength="36" >
                                <button class="btn red delqudao" type="button" style="margin-top:1px;">删除</button>
                            </div>
                          </div>
                          <div class="control-group" style="margin-bottom:0px !important;margin-left:-10px">
                            <div class="controls control">
                              <label>&nbsp;&nbsp;联系电话<span class="required" style="color:red">*</span></label>
                              <input type="number" name="phone[]" value="" maxlength="11"  >
                            </div>
                          </div>
                        </div>
                        <script>
                        $(function(){
                            var handlechannel_manager_id2Selec2 = function () {
                                function format(state) {
                                    if (!state.id) return state.text; // optgroup
                                    return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
                                }
                                function movieFormatResult(movie) {
                                    var markup = "<table class='movie-result'><tr>";
                                    if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                                        markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
                                    }
                                    markup += "<td valign='top'><h5>" + movie.title + "</h5>";
                                    if (movie.critics_consensus !== undefined) {
                                        markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
                                    } else if (movie.synopsis !== undefined) {
                                        markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
                                    }
                                    markup += "</td></tr></table>"
                                    return markup;
                                }

                                function movieFormatSelection(movie) {
                                    return movie.title;
                                }
                                $("#channel_manager_id").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });
                                $("#channel_manager_id1").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });
                                $("#channel_manager_id2").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });
                                $("#channel_manager_id3").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });
                                $("#channel_manager_id4").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });
                                $("#channel_manager_id5").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });
                                $("#channel_manager_id6").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });
                                $("#channel_manager_id7").select2({
                                    placeholder: "",
                                    minimumInputLength: 1,
                                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                        url: "/admin/ursproperty/ajaxlists",
                                        dataType: 'json',
                                        data: function (term, page) {
                                            return {
                                                q: term, // search term
                                                page_limit: 10,
                                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                                            };
                                        },
                                        results: function (data, page) { // parse the results into the format expected by Select2.
                                            // since we are using custom formatting functions we do not need to alter remote JSON data
                                            return {
                                                results: data.movies
                                            };
                                        }
                                    },
                                    initSelection: function (element, callback) {
                                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                                        // this function resolves that id attribute to an object that select2 can render
                                        // using its formatResult renderer - that way the movie name is shown preselected
                                        var id = $(element).val();
                                        if (id !== "") {
                                            $.ajax("/admin/ursproperty/ajaxitem", {
                                                data: {
                                                    id:id,
                                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                                },
                                                dataType: "json"
                                            }).done(function (data) {
                                                callback(data);
                                            });
                                        }
                                    },
                                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                                    escapeMarkup: function (m) {
                                        return m;
                                    } // we do not want to escape markup since we are displaying html in results
                                });

                            }
                            handlechannel_manager_id2Selec2();
                        })

                        </script>
                        <div style="clear:both" class="add_type"></div>
                        <div style="margin:10px 0"></div>
                      </div>
                    </div>

                    <div style="margin-left:200px;margin-top:20px;">
                      <button type="submit" class="btn btn-primary submit js-btnadd">提交</button>
                      <button type="button" class="btn" id='btnn3' >取消</button>
                    </div>
                     <div class="control-group" id="closemodel">
                       ×
                    </div>
                </form>
              </div>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style="float:left;margin:30px auto;width:99%;text-align:center;">
                    <?php
                    $this->widget('NewLinkPager', array(
                      'pages' => $pages,
                      ));
                      ?>
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
<div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="modal-label">本站点提示...</h4>
          </div>
          <div class="modal-body">
              <p>确定要删除吗?</p>
          </div>
          <div class="modal-footer">
               <a id="left" class="btn btn-primary" href="" onclick="javascript:return true;">确定</a>
               <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
          </div>
      </div>
  </div>
</div>
<script>
$(".delete").click(function(){
    var id =  $(this).attr('address');
    //点击确定时传值到控制器
    $("#left").attr('href',id);
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

  //点高级搜索时不让隐藏的隐藏
  $(function(){
    $("#highsearch").click(function(){
        var aa = $("input[name=search]").val();
    console.log(aa);
        $("#content").toggle();
        if(aa == 1 || aa == ''){
            $("input[name=search]").val(2);
        }else{
            $("input[name=search]").val(1);
        }
    })

  })
</script>

<script>
$(function(){
  $("#follow").draggable();
    })
</script>
<script>
$(function(){
  $("#closemodel").click(function(){
    $("#follow").hide();
  });
})
$('#btnn').click(function(){
  $("#follow").hide();
})
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
<script type="text/javascript">
  $('#btnn3').click(function(){
    document.getElementById("sales").style.display = "none";
  })
  $('#btnn1').click(function(){
    document.getElementById("follow").style.display = "none";
  })
  var picker = new Pikaday({
    field: document.getElementById('datepicker2'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
</script>
<script>
/*拖动面板效果*/
$(function(){
  $("#follow").draggable();
  $("#sales").draggable();
    })
</script>
<script>
$(function(){
  $("#closemodel2").click(function(){
    $("#follow").hide();
  });
  $("#closemodel").click(function(){
    $("#sales").hide();
  })
})
</script>

<div id="name_num1" style="float:left;display:none">
    <div style="clear:both"></div>
    <input type="number" min="1" value = ''  name="number[]"  required  style="width:33px;margin-left:63px;float:left"><span style="float:left">-</span>
    <input type="number" min="1" value = ''  name="number[]"  required  style="width:33px;float:left"><span style="float:left">天</span>
    <input type="hidden" name="acq_broker[]" required id="channel_manager_ids"  class="span6 select2 numbers1" style="width:220px" value=""  title="">
    <script type="text/javascript">

        $(function(){
            var handlechannel_manager_id2Selec2 = function () {
                function format(state) {
                    if (!state.id) return state.text; // optgroup
                    return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
                }
                function movieFormatResult(movie) {
                    var markup = "<table class='movie-result'><tr>";
                    if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                        markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
                    }
                    markup += "<td valign='top'><h5>" + movie.title + "</h5>";
                    if (movie.critics_consensus !== undefined) {
                        markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
                    } else if (movie.synopsis !== undefined) {
                        markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
                    }
                    markup += "</td></tr></table>"
                    return markup;
                }

                function movieFormatSelection(movie) {
                    return movie.title;
                }
                $('channel_manager_ids').select2({
                    placeholder: "",
                    minimumInputLength: 1,
                    ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                        url: "/admin/channelmanager/ajaxlist",
                        dataType: 'json',
                        data: function (term, page) {
                            return {
                                channel_id : $('#channel_id').val(),
                                q: term, // search term
                                page_limit: 10,
                                apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                            };
                        },
                        results: function (data, page) { // parse the results into the format expected by Select2.
                            // since we are using custom formatting functions we do not need to alter remote JSON data
                            return {
                                results: data.movies
                            };
                        }
                    },
                    initSelection: function (element, callback) {
                        // the input tag has a value attribute preloaded that points to a preselected movie's id
                        // this function resolves that id attribute to an object that select2 can render
                        // using its formatResult renderer - that way the movie name is shown preselected
                        var id = $(element).val();
                        if (id !== "") {
                            $.ajax("/admin/channelmanager/ajaxitem", {
                                data: {
                                    id:id,
                                    apikey: "ju6z9mjyajq2djue3gbvv26t"
                                },
                                dataType: "json"
                            }).done(function (data) {
                                callback(data);
                            });
                        }
                    },
                    formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                    formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                    dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                    escapeMarkup: function (m) {
                        return m;
                    } // we do not want to escape markup since we are displaying html in results
                });



            }
            handlechannel_manager_id2Selec2();
        })
    </script>
    <input type="hidden" name="acq_broker[]" required    class="span6 select2 numbers2" style="width:220px" value=""  title="">
    <script type="text/javascript">
        // var num2 = 'channel_manager_ids'+$(".more").length+$(".more").length;
        // $('#numbers').attr('id',num2)
    </script>
    <input  class="span1 m-wrap del_name_num" value="删除" style="width:60px;float:left" type="button">
    <script>
    // $(function(){
    //     var handlechannel_manager_id2Selec2 = function () {
    //         function format(state) {
    //             if (!state.id) return state.text; // optgroup
    //             return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
    //         }
    //         function movieFormatResult(movie) {
    //             var markup = "<table class='movie-result'><tr>";
    //             if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
    //                 markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
    //             }
    //             markup += "<td valign='top'><h5>" + movie.title + "</h5>";
    //             if (movie.critics_consensus !== undefined) {
    //                 markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
    //             } else if (movie.synopsis !== undefined) {
    //                 markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
    //             }
    //             markup += "</td></tr></table>"
    //             return markup;
    //         }

    //         function movieFormatSelection(movie) {
    //             return movie.title;
    //         }
    //         $(num1).select2({
    //             placeholder: "",
    //             minimumInputLength: 1,
    //             ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
    //                 url: "/admin/channelmanager/ajaxlist",
    //                 dataType: 'json',
    //                 data: function (term, page) {
    //                     return {
    //                         channel_id : $('#channel_id').val(),
    //                         q: term, // search term
    //                         page_limit: 10,
    //                         apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
    //                     };
    //                 },
    //                 results: function (data, page) { // parse the results into the format expected by Select2.
    //                     // since we are using custom formatting functions we do not need to alter remote JSON data
    //                     return {
    //                         results: data.movies
    //                     };
    //                 }
    //             },
    //             initSelection: function (element, callback) {
    //                 // the input tag has a value attribute preloaded that points to a preselected movie's id
    //                 // this function resolves that id attribute to an object that select2 can render
    //                 // using its formatResult renderer - that way the movie name is shown preselected
    //                 var id = $(element).val();
    //                 if (id !== "") {
    //                     $.ajax("/admin/channelmanager/ajaxitem", {
    //                         data: {
    //                             id:id,
    //                             apikey: "ju6z9mjyajq2djue3gbvv26t"
    //                         },
    //                         dataType: "json"
    //                     }).done(function (data) {
    //                         callback(data);
    //                     });
    //                 }
    //             },
    //             formatResult: movieFormatResult, // omitted for brevity, see the source of this page
    //             formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
    //             dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
    //             escapeMarkup: function (m) {
    //                 return m;
    //             } // we do not want to escape markup since we are displaying html in results
    //         });
    //         $(num2).select2({
    //             placeholder: "",
    //             minimumInputLength: 1,
    //             ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
    //                 url: "/admin/channelmanager/ajaxlist",
    //                 dataType: 'json',
    //                 data: function (term, page) {
    //                     return {
    //                         channel_id : $('#channel_id').val(),
    //                         q: term, // search term
    //                         page_limit: 10,
    //                         apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
    //                     };
    //                 },
    //                 results: function (data, page) { // parse the results into the format expected by Select2.
    //                     // since we are using custom formatting functions we do not need to alter remote JSON data
    //                     return {
    //                         results: data.movies
    //                     };
    //                 }
    //             },
    //             initSelection: function (element, callback) {
    //                 // the input tag has a value attribute preloaded that points to a preselected movie's id
    //                 // this function resolves that id attribute to an object that select2 can render
    //                 // using its formatResult renderer - that way the movie name is shown preselected
    //                 var id = $(element).val();
    //                 if (id !== "") {
    //                     $.ajax("/admin/channelmanager/ajaxitem", {
    //                         data: {
    //                             id:id,
    //                             apikey: "ju6z9mjyajq2djue3gbvv26t"
    //                         },
    //                         dataType: "json"
    //                     }).done(function (data) {
    //                         callback(data);
    //                     });
    //                 }
    //             },
    //             formatResult: movieFormatResult, // omitted for brevity, see the source of this page
    //             formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
    //             dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
    //             escapeMarkup: function (m) {
    //                 return m;
    //             } // we do not want to escape markup since we are displaying html in results
    //         });


    //     }
    //     handlechannel_manager_id2Selec2();
    // })

    </script>
</div>
<script type="text/javascript">
    //添加
        $("#add_name_num").click(function(){
            mores =$('#name_num1').clone();
            mores.show();
            mores.addClass('more');
            mores.removeAttr('id');
            mores.css("float",'none');
            $('.add_type').append(mores);
        })
        //刪除
        $(".del_name_num").live('click',function(){
          $(this).parents(".more").remove()
        })

</script>
    <script type="text/javascript">
    $(".addqudao").live('click',function(){

         var qudao = $("#qudao").clone();

         qudao.removeAttr('id');
         qudao.show();
       var num = $(".addqudao").length;
       // qudao.find("#channel_manager_id").attr('id','channel_manager_id'+num)
       $("#qudaorenyuan").append(qudao);
       $("#qudaorenyuan").find(".addqudao").remove();
       $("#qudaorenyuan").find(".delqudao").show();
        })

        $(".delqudao").live('click',function(){
           $(this).parent().parent().parent().remove();
        })
    </script>
