
<!-- BEGIN PAGE LEVEL STYLES -->
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
// Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
  App.init();
  ");
?>
<!-- End PAGE LEVEL SCRIPTS -->
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

          <div class="caption"><i class="icon-globe"></i>礼品记录</div>
          <div class="tools">

          </div>
        </div>
        <div class="portlet-body">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="span8">
                
            </div>
            <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                  <th class="hidden-480">购买人</th>
                  <th class="hidden-480">购买时间</th>
                  <th class="hidden-480">发放人</th>
                  <th class="hidden-480">发放时间</th>
                  <th class="hidden-480">发放方式</th>
                  <th >详情</th>
                </tr>
              </thead>
              <tbody>
                <?php if($list){ 
                    foreach($list as $k => $v){ ?>
                      <tr class="odd gradeX deleted" sid="<?php echo $v['id']?>">
                          <td class="hidden-480"><?php echo $v['buy_user']?></td>
                          <td class="hidden-480"><?php echo date('Y-m-d H:i:s',$v['information_time'])?></td>
                          <td class="hidden-480"><?php echo $v['harvest_user']?></td>
                          <td class="hidden-480"><?php echo $v['harvest_time']?></td>
                          <td class="hidden-480"><?php echo str_replace([1,2,3],['自取','邮寄到家','代取'],$v['types']) ?></td>
                          <td >
                              <a href="/admin/ursgoods/detail/id/<?php echo $v['id'] ?>">详情</a><br>           
                          </td>
                      </tr>
                <?php } } ?>
              </tbody>
            </table>
            

            
            <div class="row-fluid">
              <div class="span4">
                <div class="dataTables_info" id="sample_1_info"></div>
              </div>
              <div class="span8" style="width:500px">
                <div class="dataTables_paginate paging_bootstrap pagination">
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
<!-- //////////////////////////////// -->
<div class="page-content">
    <div class="container-fluid">
          

    </div>
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
    //删除
    $('.dels').click(function(){
        //获取id
        var id = $(this).parents('.deleted').attr('sid');
        var td = $(this);
        $.get('/admin/ursgoods/deleted',{id:id},function(data){
            if(data == 1){
                td.parents('.deleted').remove();
            }
        })
        //阻止默认行为
        return false;
    })

</script>
