<style>
#jqaddlink{display:none!important;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
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
</style>






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

            <div class="caption">跟进--列表</div>
            <div class="tools">

            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span6">
                  <form action="/admin/notice/index" style="margin:0" >
                      <div class="dataTables_filter" id="sample_1_filter">
                        <label style="float:left;">
                        <span id="specialfont"> 关键词: </span> <input type="text" aria-controls="sample_1" class="m-wrap medium " placeholder="关键词" value="<?php echo $keyword;?>" name="keyword">
                        </label>
                      </div>
                      <div class="btn-group">
                        <button id="sample_editable_1_new" class="btn green" type="submit">
                          搜索 <i class="icon-search"></i>
                        </button>
                      </div>
                  </form>
                </div>
                <div class="span6">
                  <div class="btn-group pull-right">
                    <?php
                      if (AdminPositionModul::has_modul("102_13")) {
                    ?>
                    <a href="/admin/purchasecontract/secondtalk/contract_id/<?php echo $contract_id?>">
                      <button id="sample_editable_1" class="btn green">
                      新建 <i class="icon-plus"></i>
                      </button>
                    </a>
                    <?php }?>
                  </div>
                  <div class="btn-group pull-right">
<!--                     <a href="/admin/user/create">
                      <button id="sample_editable_1" class="btn green">
                      新建 <i class="icon-plus"></i>
                      </button>
                    </a> -->
                  </div>

                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th style="text-align:center">ID</th>
                    <th class="hidden-480" style="text-align:center">标题</th>
                    <th class="hidden-480" style="text-align:center">跟进人</th>
                    <th class="hidden-480" style="text-align:center">跟进时间</th>
                    <th style="text-align:center">操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($list){
                    ?>
                    <?php
                    foreach($list as $user){
                      ?>
                      <tr class="odd gradeX">
                        <td><?php echo $user->the_order; ?></td>
                        <td><?php echo CHtml::encode($user->title); ?></td>
                        <td><?php echo $user->follower ?></td>
                        <td class="center hidden-480"><?php echo date('Y-m-d H:i:s', $user->talk_time); ?></td>
                        <td>

                      <div class="btn-operation">
                        <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                          操作
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                          <a href="/admin/purchasecontract/Secondtalk_detail/id/<?php echo $user->id;?>">查看</a>
                          <?php if(AdminPositionModul::has_modul("102_14")){?>
                            <a href="/admin/purchasecontract/Secondtalk_edit/id/<?php echo $user->id;?>">编辑</a>
                            <?php }?>
                          <?php if(AdminPositionModul::has_modul("102_15")) {?>
                            <a href="" address="/admin/purchasecontract/Secondtalk_delete/id/<?php echo $user->id;?>" style="display:block" class="delete" data-toggle="modal" data-target="#about-modal">删除</a>
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
