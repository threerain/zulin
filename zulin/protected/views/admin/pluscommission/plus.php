<style>
#jqaddlink{display:none!important;}
</style>

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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/cms_purchase_contract.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


  Yii::app()->clientScript->registerScript("","
    App.init();
    TableManaged.init();");
?>



<style>
	#sample_1_wrapper{margin-top:29px;}
	#sample_1_wrapper input{height:83%;border:1px solid #a4a4a5;border-right-width:0;width:85px;}
	#sample_1_wrapper button{background:#167bcd;font-size:18px;color:#fff;}
	.container-fluid{margin-left:14px;}
	#specialfont{font-size:18px;margin-left:10px;color:#333;}
	#speciletitle{font-size:22px;background:url(/css/admin/image/liebaio.png) no-repeat center left #a4a4a5;padding-left:40px;background-position:10px 8px;}
	table{margin-top:15px;}
	#sample_editable_1_new{height:33px;}
	#sample_editable_1_new:hover{background:#0160cb!important;}
	#sample_editable_1:hover{background:#0160cb!important;}
	#sample_editable_1{margin-right:20px;}
	td a{margin-right:10px;}
	.modal-body{font-size:18px;text-indent: 20px;}
	#modal-label{text-align:center;font-size:22px;}
	#about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
	#left{background:#167bcd;color:#fff;margin-right:10px;}
	#left:hover{background:#0160cb!important;}
    #signer_detail{background-color:#fff;display:none;z-index:1;position:fixed;width:33%;top:20%;left:40%;height:auto;border-top:3px solid #222;border-radius:20px;border:1px solid #167ac7 !important;}
    #signer_detail_closevalue{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}  
    .form-horizontal .control-label {
    float: left;
    width: 74px;
    padding-top: 5px;
    text-align: right;
}
</style>

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
          <div class="portlet-title" id="speciletitle">

            <div class="caption">财务提成-列表</div>

            <div class="tools">            
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">

                <div class="span6">
                  <a id="purchase" href="/admin/pluscommission/index/type/0">收房</a>
                  <a id="sale" href="/admin/pluscommission/index/type/1">出车</a>
                  <?php foreach ($signerlist as $key => $value): ?>
                    <a href="/admin/pluscommission/plusindex/signer/<?php echo $value; ?>/type/<?php echo $type?>"><?php echo $value; ?></a>
                  <?php endforeach ?>
                  <form action="/admin/pluscommission/plusindex" style="margin:0" >
                      <div class="dataTables_filter" id="sample_1_filter">
                      <input type="hidden" name="type" value="<?php echo $type?>">
                        <label style="float:left;">
                        <span id="specialfont"> 签约人: </span> <input type="text" aria-controls="sample_1" class="m-wrap medium " placeholder="例：张三" value="<?php echo $signer;?>" name="signer">
                        </label>
                      </div>
                      <div class="btn-group">
                        <button id="sample_editable_1_new" class="btn green" type="submit">
                          搜索 <i class="icon-search"></i>
                        </button>
                      </div>
                  </form>
                  总计：<?php echo $total/100;?>元
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th class="hidden-480" style="text-align:center">合同ID</th>
                    <th class="hidden-480" style="text-align:center">项目</th>
                    <th class="hidden-480" style="text-align:center">项目面积</th>
                    <th class="hidden-480" style="text-align:center">签约人</th>
                    <th class="hidden-480" style="text-align:center">签约面积(㎡)</th>
                    <th class="hidden-480" style="text-align:center">汇款金额(元)</th>
                    <th class="hidden-480" style="text-align:center">提成比例(‰)</th>
                    <th class="hidden-480" style="text-align:center">提成等级</th>
                    <th class="hidden-480" style="text-align:center">面积分成</th>
                    <th class="hidden-480" style="text-align:center">提成金额(元)</th>
                    <th class="hidden-480" style="text-align:center">管佣</th>
                    <th style="text-align:center">操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($list){
                    ?>
                    <?php
                    foreach($list as  $value){
                      ?>
                      <tr class="odd gradeX">
                        <td><?php echo $value['contract_id']; ?></td>
                        <td>
                        <?php 
                        $arr = Property::allinfo($value['contract_id']);
                        foreach ($arr as $k => $v) {
                          echo '品牌:'.$v['estate_name'].' 系列:'.$v['building_name'].' 编号:'.$v['house_no'].'<br>';
                        }
                         ?>
                        </td>
                        <td><?php
                          $total = 0;
                         foreach (CmsPurchaseProperty::model()->findAll("contract_id = '$value[contract_id]'") as $k1 => $v1) {
                            $total += $v1->area;
                          } ; 
                          echo $total;

                         ?></td>
                        <td><?php echo AdminUser::model()->find("id= '$value[signer]'")->nickname; ?></td>
                        <td><?php echo $value['area']; ?></td>
                        <td><?php echo $value['amount']; ?></td>
                        <td class="center hidden-480"><?php echo $value['scale']?></td>
                        <td class="center hidden-480"><?php echo $value['level']?></td>
                        <td class="center hidden-480"><?php echo $value['area_scale']?></td>
                        <td class="center hidden-480"><?php echo $value['money']/100?></td>
                        <td><?php echo AdminUser::model()->find("id= '$value[guanyong]'")->nickname; ?></td>
                        <td>
                      <div class="btn-operation">
                        <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                          操作
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                          <a href="/admin/notice/detail/id/<?php echo $value->id;?>">查看</a>
                          <?php if(AdminPositionModul::has_modul("401_02")){?>
                            <a href="/admin/notice/edit/id/<?php echo $value->id;?>">编辑</a>
                            <?php }?>
                          <?php if(AdminPositionModul::has_modul("401_03")) {?>
                            <a href="" address="/admin/notice/delete/id/<?php echo $value->id;?>" style="display:block" class="delete" data-toggle="modal" data-target="#about-modal">删除</a>
                          <?php }?>
                        </ul>
                      </div>
                        </td>

                        <!-- <td ><span class="label label-success">Approved</span></td> -->
                      </tr>

                      <?php
                    }
                    ?>
                    <?php
                  }
                  ?>
                </tbody>
              </table>


<script>
$(".delete").click(function(){
    var id =  $(this).attr('address');
    //点击确定时传值到控制器
    $("#left").attr('href',id);
})
</script>

            <div id="signer_detail" class="portlet-body form" id="form_add"  method="post"  class="form-horizontal js-submit">
              <div style="height:40px;background:#167AC7;margin-bottom:20px;" class="portlet-title">
                 <div class="caption" style="line-height:40px;font-size:20px;text-indent:30px;">违约设置</div>
              </div>
              <form action="/admin/purchasecontract/signer_detail" id="form_add"  method="post"  class="form-horizontal js-submit">
                  <input type="hidden" name="contract_id" id="contract_id" value="">
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
                          
                      </div>
                  </div>
                  <div class="form-actions">
                      <button  type="submit" class="btn btn-primary submit js-btnadd follo" style="margin-left:150px;">确定</button>
                      <button type="button" class="btn"  id="btnn">取消</button>
                  </div>
                   <div class="control-group" id="signer_detail_closevalue">
                     ×
                  </div>
              </form>
            </div>

              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
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
<script>
$(function(){
  $("#signer_detail").draggable();//模态框的拖拽性
  $("#signer_detail_closevalue").click(function(){
    $("#signer_detail").hide();//关闭模态框
  });

})

$('#btnn').click(function(){
  $("#signer_detail").hide();//点击取消关闭模态框
})


//选中元素
$('.signer').click(function(){
  var contract_id=$(this).attr('data');
  document.getElementById("contract_id").value=contract_id;
  // $("#property_id").value="aa";
  if(document.getElementById("signer_detail").style.display != "block")
  {
    document.getElementById("signer_detail").style.display = "block";
  }
  else
  {
    document.getElementById("signer_detail").style.display = "none";
  }
});
</script>

  <script>
  
  $(function(){

    var type = $("input[name=type]").val()

    if(type==1){
      $("#sale").css({background:"#ccc213"});
    }else{
      $("#purchase").css({background:"#ccc213"});
    }
  })


  </script>
