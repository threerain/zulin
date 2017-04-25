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

            <div class="caption"><i class="icon-globe"></i>罚款单列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body" style="margin-top:20px;">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr class="yj-title-th">
                    <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                    <th class="hidden-480">录入人</th>
                    <th class="hidden-480">罚款项</th>
                    <th class="hidden-480">罚款日期</th>
                    <th class="hidden-480">罚款金额</th>
                    <th class="hidden-480">罚款原因</th>
                    <th class="hidden-480">罚款结算方式</th>
                    <th class="hidden-480">处罚方</th>
                    <th class="hidden-480">被罚方</th>
                    <th class="hidden-480">操作</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  if($list){
                    foreach($list as $user){
                  ?>
                      <tr class="odd gradeX">
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$user->creater_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="hidden-480"><?php echo $user->fine_items; ?></td>
                        <td class="hidden-480"><?php echo $user->fine_date?date("Y-m-d",$user->fine_date):"";?></td>
                        <td class="hidden-480"><?php echo $user->fine_amount/100;?></td>
                        <td class="hidden-480"><?php echo $user->fine_reason; ?></td>
                        <td class="hidden-480"><?php echo $user->fine_settlement; ?></td>
                        <td class="hidden-480"><?php echo $user->punish_people; ?></td>
                        <td class="hidden-480"><?php echo $user->punished_people; ?></td>
                        <td class="hidden-480"><a href="/admin/decoration/TicketDetail/id/<?php echo $user->id;?>">详情</a></td>
                      </tr>
                <?php
                    }
                  }
                ?>
                </tbody>
              </table>
              <button type="button" class="btn" onClick="javascript:history.go(-1)" style="margin-top:30px;">返回</button>
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
