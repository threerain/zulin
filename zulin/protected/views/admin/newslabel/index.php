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

            <div class="caption"><i class="icon-globe"></i>幼狮车源列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span6">
                  <form action="/admin/newslabel/index" style="margin:0" >
                      <div class="dataTables_filter" id="sample_1_filter">
                        <label style="float:left;">
                          关键词: <input type="text" aria-controls="sample_1" class="m-wrap medium" placeholder="关键词" value="<?php echo $keyword;?>" name="keyword">
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
                    <a href="/admin/newslabel/add">
                      <button id="sample_editable_1" class="btn green">
                      新建 <i class="icon-plus"></i>
                      </button>
                    </a>
                  </div>
                  <div class="btn-group pull-right">
<!--                     <a href="/admin/user/create">
                      <button id="sample_editable_1" class="btn green">
                      新建 <i class="icon-plus"></i>
                      </button>
                    </a> -->
                  </div>
<!--                   <div class="btn-group pull-right">

                    <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>

                    </button>

                    <ul class="dropdown-menu pull-right">

                      <li><a href="#">Print</a></li>

                      <li><a href="#">Save as PDF</a></li>

                      <li><a href="#">Export to Excel</a></li>

                    </ul>

                  </div> -->
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th>
                    <th>ID</th>
                    <th class="hidden-480">品牌ID</th>
                    <th class="hidden-480">系列ID</th>
                    <th class="hidden-480">编号</th>
                    <th class="hidden-480">录入人ID</th>
                    <th class="hidden-480">创建时间</th>

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
                      <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" name="ids" value="<?php echo CHtml::encode($user->id); ?>" /></td>
                        <td><?php echo CHtml::encode($user->id); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->estate_id); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->buding_id); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->house_no); ?></td>
                        <td class="hidden-480"><?php echo CHtml::encode($user->creater_id); ?></td>
                        <td class="center hidden-480"><?php echo date('Y-m-d H:i:s', $user->ctime); ?></td>
                        <td>
                          <?php //echo CHtml::link(CHtml::encode('查看'), array('details', 'id'=>$user->id)); ?> 
                          <?php //if ($user->istop){?>
                          <?php //echo CHtml::link(CHtml::encode('取消置顶'), array('untop', 'id'=>$user->id)); ?>
                          <?php //}else {?>
                          <?php //echo CHtml::link(CHtml::encode('置顶'), array('top', 'id'=>$user->id)); ?>
                          <?php //}?>
                          <!-- <a href="/admin/newslabel/delete/id/<?php //echo $user->id;?>" onclick="javascript:return confirm('删除主贴所有回复都会删除，确实要删除吗?');">删除</a> -->
                          <a href="/admin/newslabel/edit/id/<?php echo $user->id;?>">修改</a>
                          <a href="/admin/newslabel/delete/id/<?php echo $user->id;?>" onclick="javascript:return confirm('确实要删除吗?');">删除</a>
                          
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
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination">
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






