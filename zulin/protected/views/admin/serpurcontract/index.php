<style>
#jqaddlink{display:none!important;}
	.modal-body{font-size:18px;text-indent: 20px;}
	#modal-label{text-align:center;font-size:22px;}
	#about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;left:50%;right:50%;}
	#left{background:#167bcd;color:#fff;margin-right:10px;}
	#left:hover{background:#0160cb!important;}
  .dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
  input{width:150px;}
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

            <div class="caption"><i class="icon-globe"></i>收房列表</div>
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
                  <form action="/admin/serpurcontract/index">
                      <div class="dataTables_filter">
                        <input type="hidden" value="<?php echo $search ?>" name="search">
                        <span>
                          商圈：<input type="text"  value="<?php echo $k_area;?>"  name="k_area">
                        </span>
                        <span>
                          品牌：<input type="text" value="<?php echo $k_estates;?>" name="k_estates">
                        </span>
                        <span>
                          系列：<input type="text"  value="<?php echo $k_building;?>" name="k_building">
                        </span>
                        <span>
                          编号：<input type="text" value="<?php echo $k_number;?>" name="k_number">
                        </span>
                        <span>
                          </button><input type="checkbox" id="highsearch">高级搜索</button>
                        </span>
                        <button id="sample_editable_1_new" class="btn btn-primary" type="submit">搜索 <i class="icon-search"></i></button>
                      </div>
                      <div id="content" style="display:none;margin-bottom:10px;" >
                        <div class="dataTables_filter">
                          <span >
                            实际收房日期：<input type="text" id="datepicker1" value="<?php echo $k_sdate;?>" name="k_sdate" />&nbsp;至&nbsp;<input type="text" id="datepicker2" value="<?php echo $k_edate;?>"  name="k_edate" />
                          </span>
                          <span >
                            合同规定收房日期：<input type="text" id="datepicker3" value="<?php echo $k_spurchase;?>" name="k_spurchase" />&nbsp;至&nbsp;<input type="text" id="datepicker4" value="<?php echo $k_epurchase;?>"  name="k_epurchase" />
                          </span>
                        </div>
                        <div class="dataTables_filter">
                          <span>外勤人员：<input type="text"  value="<?php echo $k_admin;?>" name="k_admin"></span>
                          <span>来源：
                          <select name="k_source">
                            <option value="null" selected>请选择</option>
                            <option value="车主" <?php echo $k_source==车主?'selected=selected':''?>>车主</option>
                            <option value="租户" <?php echo $k_source==租户?'selected=selected':''?>>租户</option>
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
                    </script>
                    <div class="btn-group pull-right"> </div>
                  </form>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                  <th class="hidden-480">合同id</th>
                  <th class="hidden-480">商圈</th>
                  <th class="hidden-480">品牌</th>
                  <th class="hidden-480">系列</th>
                  <th class="hidden-480">编号</th>
                  <th class="hidden-480">客服外勤人员</th>
                  <th class="hidden-480">合同规定收房日期</th>
                  <th class="hidden-480">实际收房日期</th>
                  <th class="hidden-480">来源</th>
                  <th class="hidden-480">状态</th>
                  <th >操作</th>
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
                  <td><a href="/admin/purchasecontract/detail/id/<?php echo $model==null?"":$model->contract_id;?>"><?php echo $model->contract_id; ?></a></td>
                  <td>
                    <?php
                      $res=CmsPurchaseProperty::model()->find("contract_id='$model->contract_id'");
                      if($res){
                        $data=CmsProperty::model()->find("id='$res->property_id'");
                        $item=BaseArea::model()->find("id='$data->area_id'");
                        echo $item?$item->name:"";
                       }
                    ?>
                  </td>
                  <td>
                    <?php
                      $res=CmsPurchaseProperty::model()->find("contract_id='$model->contract_id'");
                      if($res){
                        $data=CmsProperty::model()->find("id='$res->property_id'");
                        $item=BaseEstate::model()->find("id='$data->estate_id'");
                        echo $item?$item->name:"";
                       }
                    ?>
                  </td>
                  <td>
                    <?php
                      $res=CmsPurchaseProperty::model()->find("contract_id='$model->contract_id'");
                      if($res){
                        $data=CmsProperty::model()->find("id='$res->property_id'");
                        $item=BaseBuilding::model()->find("id='$data->building_id'");
                        echo $item?$item->name:"";
                       }
                    ?>
                  </td>
                  <td>
                    <?php
                      $res=CmsPurchaseProperty::model()->findAll("contract_id='$model->contract_id'");
                      if($res){
                        foreach ($res as $key => $value) {
                          $item=CmsProperty::model()->find("id='$value->property_id'");
                          echo $item?$item->house_no.'<br>':"";
                        }

                      }
                    ?>
                  </td>
                  <td><?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:""; ?></td>
                  <td><?php  echo $model->purchase_contract_date?date("Y-m-d",$model->purchase_contract_date):""; ?></td>
                  <td><?php echo $model->actual_date?date("Y-m-d",$model->actual_date):"";?></td>
                  <td><?php echo $model->source?"租户":"车主";?></td>
                  <td><?php echo $model->actual_date?"已收房":"未收房";?></td>
             			<td>
                    <div class="btn-operation">
                      <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                        操作
                        <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                        <?php if(AdminPositionModul::has_modul("701_02") && empty($model->actual_date)) {?>
                        <a href="/admin/serpurcontract/add/id/<?php echo $model->id;?>">收房</a>
                        <?php }?>
                          <a href="/admin/serpurcontract/detail/id/<?php echo $model->id;?>" style="display:block">详情</a>

                        <?php if(AdminPositionModul::has_modul("701_03") && $model->actual_date) {?>
                          <a href="/admin/serpurcontract/edit/id/<?php echo $model->id;?>" style="display:block">编辑</a>
                        <?php }?>
                        <?php if(AdminPositionModul::has_modul("701_04")) {?>
                          <a href="" address="/admin/serpurcontract/delete/id/<?php echo $model->id;?>" style="display:block" class="delete" data-toggle="modal" data-target="#about-modal">删除</a>
                       <?php  }?>
                      </ul>
                    </div>
             			</td>
                  </tr>
                    <?php
                  }
                  ?>
                  <?php
                }
                ?>
              </tbody>
            </table>

              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style='margin:30px auto;width:99%;text-align:center;'>
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
          <!-- END EXAMPLE TABLE PORTLET-->
      </div>
    </div>
  </div>
    <!-- END PAGE CONTENT-->
</div>
  <!-- END PAGE CONTAINER-->
</div>

  <div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label"
           aria-hidden="true">
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
    field: document.getElementById('datepicker1'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
   var picker = new Pikaday({
    field: document.getElementById('datepicker2'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
   var picker = new Pikaday({
    field: document.getElementById('datepicker3'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
   var picker = new Pikaday({
    field: document.getElementById('datepicker4'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
</script>

<script>
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
