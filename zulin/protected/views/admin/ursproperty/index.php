<style>
  .dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
  #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  #sales{background-color:#fff;display:none;z-index:1;position:fixed;min-width:900px;min-height:400px;height:800px;left:30%;top:10%;overflow:auto!important;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;}
  #closemodel2{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  input{width:150px;}
  select{width:150px;}
</style>
<?php if(empty($news_content_id)){ ?>
    echo  "<style>  #jqaddlink{display:none!important;} </style>";
<?php } ?>
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
  App.init();
  FormValidation.init();
  FormComponents.init();
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
                  <form action="/admin/ursproperty/index">
                    <div class="dataTables_filter">
                      <input type="hidden" value="<?php echo $search ?>" name="search">
                      <span>
                        商圈：<input type="text"  value="<?php echo $keyword_area;?>"  name="keyword_area">
                      </span>
                      <span>
                        品牌：<input type="text" value="<?php echo $keyword_estates;?>" name="keyword_estates">
                      </span>
                      <span>
                        系列：<input type="text"  value="<?php echo $keyword_building;?>" name="keyword_building">
                      </span>
                      <span>
                        编号：<input type="text" value="<?php echo $keyword_room_number;?>" name="keyword_room_number">
                      </span>
                      <span>
                        </button><input type="checkbox" id="highsearch">高级搜索</button>
                      </span>
                      <button id="sample_editable_1_new" class="btn btn-primary" type="submit">搜索 <i class="icon-search"></i></button>
                    </div>
                    <div id="content" style="display:none;">
                      <div class="dataTables_filter">
                        <span>
                          装修状态：
                          <?php
                          foreach ($ursarr['decoration_status'] as $key => $value) {
                          ?>
                            <input type="checkbox" name="k_decstatus[]" value="<?php echo $key;?>" <?php if(in_array("$key",$k_decstatus)){echo 'checked';}else{ echo '';}?> ><?php echo $value;?>
                          <?php }?>
                        </span>
                      </div>
                      <div class="dataTables_filter" style="">
                        <span>
                          状态：
                          <select name="keyword_status_now">
                            <?php foreach ($ursarr['status_now'] as $key => $value) {?>
                            <option value="<?php echo $key?>"<?php echo $keyword_status_now==$key? "selected":""?>><?php echo $value ?></option>
                            <?php }?>
                          </select>
                        </span>
                      </div>
                    </div>
                    <script type="text/javascript">
                      var bb = $("input[name=search]").val();
                       if(bb == 2){
                          $("#content").css("display","block")
                          $("#highsearch").attr("checked",true)
                       }
                      //点高级搜索时不让隐藏的隐藏
                      $(function(){
                        $("#highsearch").click(function(){
                            var aa = $("input[name=search]").val();
                            $("#content").toggle();
                            if(aa == 1 || aa == ''){
                                $("input[name=search]").val(2);
                            }else{
                                $("input[name=search]").val(1);
                            }
                        })

                      })
                    </script>
                  </form>
                <div class="btn-group pull-right"> </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr class="yj-title-th">
                    <th class="hidden-480">合同ID</th>
                    <th class="hidden-480">商圈</th>
                    <th class="hidden-480">品牌</th>
                    <th class="hidden-480">系列</th>
                    <th class="hidden-480">编号</th>
                    <th class="hidden-480">面积</th>
                    <th class="hidden-480">收购月租金</th>
                    <th class="hidden-480">单价</th>
                    <th class="hidden-480">底价</th>
                    <th class="hidden-480">状态</th>
                    <th class="hidden-480">装修状态</th>
                    <th class="hidden-480">操作</th>
                  </tr>
                </thead>
                <tbody>
               <?php
                if($list){
                  ?>
                  <?php
                    foreach($list as $model){
                  ?>
                      <tr>
                        <td style="vertical-align: middle"><?php echo $model->id; ?></td>
                        <!--<td class="hidden-480 yj-cz"><?php //$item=BaseEstate::model()->find("id='$model->estate_id'"); echo $item?$item->name:""; ?></td>-->
                        <td class="hidden-480 yj-cz">
                          <table class="table" style="border:0px;">
                          <?php
                            $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->id'");
                            if($res){
                              $count=1;
                              foreach($res as $value){
                                $a=CmsProperty::model()->find("split_partent_id='$value->property_id' and  deleted='0'");
                                if($a){
                                  $data=CmsProperty::model()->findAll("split_partent_id='$value->property_id' and  deleted='0'");
                                  foreach($data as $v){
                                    $item=BaseArea::model()->find("id='$v->area_id'");
                                    echo '<tr rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                    if($item){
                                      echo $item->name;
                                    }
                                    echo '</td></tr>';
                                    $count++;
                                  }
                                }else{
                                  $data=CmsProperty::model()->find("id='$value->property_id'");
                                  $item=BaseArea::model()->find("id='$data->area_id'");
                                  echo '<tr rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                  if($item){
                                    echo $item->name;
                                  }
                                  echo '</td></tr>';
                                  $count++;
                                }
                              }
                            }
                          ?>
                          </table>
                        </td>
                        <td>
                          <table class="table" style="border:0px;">
                          <?php
                            if($res){
                              $count=1;
                              foreach($res as $value){
                                if($a){
                                  foreach($data as $v){
                                    $item=BaseEstate::model()->find("id='$v->estate_id'");
                                    echo '<tr rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                    if($item){
                                      echo $item->name;
                                    }
                                    echo '</td></tr>';
                                    $count++;
                                  }
                                }else{
                                  $item=BaseEstate::model()->find("id='$data->estate_id'");
                                  echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                  if($item){
                                    echo $item->name;
                                  }
                                  echo '</td></tr>';
                                  $count++;
                                }
                              }
                            }
                          ?>
                          </table>
                        </td>
                        <td>
                          <table class="table" style="border:0px;">
                          <?php
                            if($res){
                              $count=1;
                              foreach($res as $value){
                                if($a){
                                  foreach($data as $v){
                                    $item=BaseBuilding::model()->find("id='$v->building_id'");
                                    echo '<tr rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                    if($item){
                                      echo $item->name;
                                    }
                                    echo '</td></tr>';
                                    $count++;
                                  }
                                }else{
                                  $item=BaseBuilding::model()->find("id='$data->building_id'");
                                  echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                  if($item){
                                    echo $item->name;
                                  }
                                  echo '</td></tr>';
                                  $count++;
                                }
                              }
                            }
                          ?>
                          </table>
                        </td>
                        <td style="vertical-align: middle">
                          <table class="table" style="border:0px;">
                          <?php
                            if($res){
                              $count=1;
                              foreach ($res as $key => $value) {
                                if($a){
                                  foreach($data as $v){
                                    echo '<tr rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                    if($v && $v->house_no== $house_nos){
                                      echo $v->house_no;
                                    }else if($v){
                                      echo $v->house_no;
                                    }
                                    echo '</td></tr>';
                                    $count++;
                                  }
                                }else{
                                  $item=CmsProperty::model()->find("id='$value->property_id'");
                                  if($item && $item->house_no == $house_nos){
                                  echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td style="border-left:0px;color:red">';
                                    echo $item->house_no;
                                  }else if($item){
                                      echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td style="border-left:0px;">';
                                     echo $item->house_no;
                                  }
                                  echo '</td></tr>';
                                  $count++;
                                }
                              }
                            }
                          ?>
                          </table>
                        </td>
                        <td>
                          <table class="table" style="border:0px;">
                          <?php
                            if($res){
                              $count=1;
                              foreach ($res as $key => $value) {
                                if($a){
                                  foreach($data as $v){
                                    echo '<tr rowspan="<?php echo $count ?>"><td  style="border-left:0px;">';
                                    if($v){
                                      echo $v->area;
                                    }
                                    echo '</td></tr>';
                                    $count++;
                                  }
                                }else{
                                  $item=CmsProperty::model()->find("id='$value->property_id'");
                                   if($item){
                                      echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td style="border-left:0px;">';
                                      echo $item->area;
                                    }
                                  echo '</td></tr>';
                                  $count++;
                                }
                              }
                            }
                          ?>
                          </table>
                        </td>
                        <td style="vertical-align: middle">
                          <?php
                            $time=time();
                            $data=CmsPurchasePayRule::model()->find("contract_id='$model->id' and start_time<='$time' and end_time>='$time'");
                            $term=CmsPurchasePayRule::model()->find("contract_id='$model->id' and start_time>='$time' and the_order='0'");
                            if($data){
                              echo $data?$data->monthly_rent/100:"";
                              echo $data?'元':'';
                            }else if($term){
                              echo $term?$term->monthly_rent/100:"";
                              echo $term?'元':'';
                            }
                          ?>
                        </td>
                        <td style="vertical-align: middle">
                          <?php
                            $time=time();
                            if($data){
                              echo $data?$data->price_per_meter/100:"";
                              echo $data?'元/㎡/天':'';
                            }else if($term){
                              echo $term?$term->price_per_meter/100:"";
                              echo $term?'元/㎡/天':'';
                            }
                          ?>
                        </td>
                        <td>
                          <table class="table" style="border:0px;">
                          <?php
                            $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->id'");
                            if($res){
                              $count=1;
                              foreach ($res as $key => $value) {
                                $a=CmsProperty::model()->find("split_partent_id='$value->property_id' and  deleted='0'");
                                if($a){
                                  $data=CmsProperty::model()->findAll("split_partent_id='$value->property_id' and  deleted='0'");
                                  foreach($data as $v){
                                    $item=UrsPropertyDetail::model()->find("property_id='$v->id'");
                                    echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td style="border-left:0px;">';
                                    echo ($item->base_price/100).'元/㎡/天';
                                    echo '</td></tr>';
                                    $count++;
                                  }
                                }else{
                                  $item=UrsPropertyDetail::model()->find("property_id='$value->property_id'");
                                  echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td style="border-left:0px;">';
                                  echo ($item->base_price/100).'元/㎡/天';
                                  echo '</td></tr>';
                                  $count++;
                                }

                              }
                            }
                          ?>
                          </table>
                        </td>
                        <td>
                          <table class="table" style="border:0px;">
                          <?php
                           $c = Property::property_id("'$model->id'");

                           foreach ($c as $kc => $vc) {
                            $b = Property::status($vc);
                            echo '<tr class="odd gradeX" ><td style="border-left:0px;">';
                            echo $b;
                            echo '</td></tr>';
                           }
                          ?>
                          </table>
                        </td>
                        <td>
                          <table class="table" style="border:0px;">
                          <?php
                            $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->id'");
                            if($res){
                              $count=1;
                              foreach ($res as $key => $value) {
                                $item=UrsDecorationFollow::model()->find(array(
                                  'condition'=>"property_id='$value->property_id' and deleted='0'",
                                  'order'=>'ctime desc',
                                ));
                                echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td style="border-left:0px;">';
                                if($item && ($item->decoration_status)!=0){
                                  echo $ursarr['decoration_status']["$item->decoration_status"];
                                }else{
                                  echo '未装修';
                                }
                                echo '</td></tr>';
                                $count++;
                              }
                            }
                          ?>
                          </table>
                        </td>
                        <td>
                          <table class="table" style="border:0px;">
                          <?php
                            $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->id'");
                            if($res){
                              $count=1;
                              foreach ($res as $key => $value) {
                                $a=CmsProperty::model()->find("split_partent_id='$value->property_id' and  deleted='0'");
                                if($a){
                                  foreach($data as $v){
                                  echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td  style="vertical-align:middle;border-left:0px;">';
                                  ?>
                                    <div class="btn-operation">
                                      <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                                        操作
                                        <span class="caret"></span>
                                      </a>
                                      <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                                          <?php if(AdminPositionModul::has_modul("602_02")) {?>
                                             <a href="/admin/ursproperty/edit/id/<?php echo $v->id;?>/contract_id/<?php echo $model->id;?>" >编辑</a>
                                          <?php }?>
                                          <a href="/admin/ursproperty/detail/id/<?php echo $v->id;?>/contract_id/<?php echo $model->id;?>" >详情</a>
                                          <?php
                                            $data=UrsSalesControl::model()->find("property_id='$v->id' and deleted='0'");
                                            if(!$data){
                                          ?>
                                          <?php if(AdminPositionModul::has_modul("602_05")) {?>
                                            <a  href="javascript:;"  class="sales_control" id="<?php echo $v->id;?>" id1="<?php echo $model->id;?>" >添加至销控</a>
                                        <?php  }?>
                                          <?php
                                            }
                                          ?>
                                          <?php if(AdminPositionModul::has_modul("602_04")) {?>
                                              <a href="/admin/ursproperty/decorationfollow/id/<?php echo $v->id;?>" >查看装修跟进</a>
                                          <?php }?>
                                      </ul>
                                    </div>

                                    <?php
                                    echo '</td></tr>';
                                    $count++;
                                  }
                                }else{
                                echo '<tr class="odd gradeX" rowspan="<?php echo $count ?>"><td  style="vertical-align:middle;border-left:0px;">';
                                ?>
                              <div class="btn-operation">
                                <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                                  操作
                                  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                                    <?php if(AdminPositionModul::has_modul("602_02")) {?>
                                       <a href="/admin/ursproperty/edit/id/<?php echo $value->property_id;?>/contract_id/<?php echo $model->id;?>" >编辑</a>
                                    <?php }?>
                                    <a href="/admin/ursproperty/detail/id/<?php echo $value->property_id;?>/contract_id/<?php echo $model->id;?>" >详情</a>
                                    <?php
                                      $data=UrsSalesControl::model()->find("property_id='$value->property_id' and deleted='0'");
                                      if(!$data){
                                    ?>
                                    <?php if(AdminPositionModul::has_modul("602_05")) {?>
                                      <a  href="javascript:;"  class="sales_control" id="<?php echo $value->property_id;?>" id1="<?php echo $model->id;?>" >添加至销控</a>
                                  <?php  }?>
                                    <?php
                                      }
                                    ?>
                                    <?php if(AdminPositionModul::has_modul("602_04")) {?>
                                        <a href="/admin/ursproperty/decorationfollow/id/<?php echo $value->property_id;?>" >查看装修跟进</a>
                                    <?php }?>
                                </ul>
                              </div>

                                    <?php
                                    echo '</td></tr>';
                                    $count++;
                                    }
                                // $item=CmsProperty::model()->find("id='$value->property_id'");
                              }
                            }
                          ?>
                          </table>
                        </td>
                      </tr>
                    <?php
                      }
                    }
                    ?>
                </tbody>
              </table>

              <!-- 添加到销控 -->
              <script language="javascript" type="text/javascript">
                //选中元素
                $('.sales_control').click(function(){
                  var property_id=$(this).attr('id');
                  var contract_id=$(this).attr('id1');
                  document.getElementById("property_id").value=property_id;
                  document.getElementById("contract_id").value=contract_id;
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
                    <input type="hidden" name="property_id" id="property_id" value="">
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
                        <input type="radio"  value='1' name="sales_type" required/>新收房上销控
                        <input type="radio"   value='2' name="sales_type" />违约/到期上销控
                      </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:0px">
                      <div class="controls control">
                        <label>&nbsp;销售报价<span class="required" style="color:red">*</span></label>
                        <input type="text" name="unit_price" value="" required onkeyup="value=value.replace(/[^\d.]/g,'')">元/㎡/天
                      </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:0px">
                      <div class="controls control">
                        <label>&nbsp;&nbsp;定价人<span class="required" style="color:red">*</span></label>
                        <input type="text" name="price_maker" maxlength="36" required>
                      </div>
                    </div>
                    <div class="control-group" style="margin-bottom:0px !important;margin-left:-10px">
                      <div class="controls control">
                        <label>&nbsp;&nbsp;销售面积<span class="required" style="color:red">*</span></label>
                        <input type="text" name="area" value="" maxlength="36" required>
                      </div>
                    </div>
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
                        <input type="text" id="datepicker" name="live_date" />
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
                      <button type="button" class="btn" id='btnn' >取消</button>
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
                <div class="span8" >
                  <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">
                    <?php
                    // $ps = Yii::app()->params['pageSetting'];
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
  $('#btnn').click(function(){
    document.getElementById("sales").style.display = "none";
  })
  $('#btnn1').click(function(){
    document.getElementById("follow").style.display = "none";
  })
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
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
