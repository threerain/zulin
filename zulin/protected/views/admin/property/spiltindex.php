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
              <div class="row-fluid">
                <div class="span6">
                  
                </div>
                <div class="span6">
                  <div class="btn-group pull-right">
                    <a href="/admin/property/splitadd/id/<?php echo $property_id?>">
                      <button id="sample_editable_1" class="btn btn-primary">
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
                    <th class="hidden-480">品牌</th>
                    <th class="hidden-480">系列</th>
                    <th class="hidden-480">编号</th>
                    <th class="hidden-480">创建人</th>
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
                        <td><?php echo CHtml::encode(substr($user->id, 25)); ?></td>
                        <td class="hidden-480"><?php $item=BaseEstate::model()->find("id='$user->estate_id'"); echo $item?$item->name:""; ?></td>
                        <td class="hidden-480"><?php $item=BaseBuilding::model()->find("id='$user->building_id'"); echo $item?$item->name:""; ?></td>
                         <td class="hidden-480"><?php echo CHtml::encode($user->house_no); ?></td>
                          <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$user->creater_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="center hidden-480"><?php echo date('Y-m-d H:i:s', $user->ctime); ?></td>
                        <td>
                          <?php //echo CHtml::link(CHtml::encode('查看'), array('details', 'id'=>$user->id)); ?> 
                          <?php //if ($user->istop){?>
                          <?php //echo CHtml::link(CHtml::encode('取消置顶'), array('untop', 'id'=>$user->id)); ?>
                          <?php //}else {?>
                          <?php //echo CHtml::link(CHtml::encode('置顶'), array('top', 'id'=>$user->id)); ?>
                          <?php //}?>
                          <!-- <a href="/admin/accountuser/delete/id/<?php //echo $user->id;?>" onclick="javascript:return confirm('删除主贴所有回复都会删除，确实要删除吗?');">删除</a> -->
                          <a href="/admin/property/splitedit/id/<?php echo $user->id;?>">修改</a>
                          <a href="/admin/property/splitdelete/id/<?php echo $user->id;?>" onclick="javascript:return confirm('确实要删除吗?');">删除</a>
                          
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






