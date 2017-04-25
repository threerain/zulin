<style>
#jqaddlink{display:none!important;}
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
  input{width:150px;}
  select{width:150px;}
  b{font-weight:normal;}
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
        <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">

            <div class="caption"><i class="icon-globe"></i>报表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid" style="min-height:120px;">
                  <form  style="margin:0;margin-top:30px;" action="/admin/sersellcontract/index">
                  </form>
             </div>


              <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                  <th class="hidden-480">报表</th>
                  <th class="hidden-480">时间</th>
                  <th style="width:150px">操作</th>
                </tr>
              </thead>
              <?php $date = date("Y-m-d",time()-24*60*60) ?>
              <tbody>
                      <?php if(AdminPositionModul::has_modul("903_02")) {?>
                      <tr  class="deleted">
                      <form action="/admin/export/excel" method="post">
                          <td style="text-align: left !important;">综合支持基础数据</td>
                          <td style="">开始时间<input type="text" name="time_start" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_start" required >结束时间<input type="text" name="time_end" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_end" required ></td>
                          <script type="text/javascript">
                            var picker = new Pikaday({
                              field: document.getElementById('time_start'),
                              firstDay: 1,
                              minDate: new Date('2015-12-27'),
                              maxDate: new Date('<?php echo $date ?>'),
                              yearRange: [2000,2030]
                            });
                            var picker = new Pikaday({
                              field: document.getElementById('time_end'),
                              firstDay: 1,
                              minDate: new Date('2015-12-27'),
                              maxDate: new Date('<?php echo $date ?>'),
                              yearRange: [2000,2030]
                            });
                          </script>
                          <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                             <input type="submit" value="导出" class="detail">
                            </ul>
                            </div>
                          </td>
                        </form>
                      </tr>
                       <?php }?>

                   <?php if(AdminPositionModul::has_modul("903_02")) {?>
                      <tr  class="deleted">
                      <form action="/admin/export/SaleControll" method="post">
                          <td style="text-align: left !important;">销控表导出</td>
                          <td><?php echo date("Y-m-d",time())?></td>
                          <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                             <input type="submit" value="导出" class="detail">
                            </ul>
                            </div>
                          </td>
                        </form>
                      </tr>
                       <?php }?>
                       <tr  class="deleted">
                        <form action="/admin/export/ExcelPur" method="post">
                           <td style="text-align: left !important;">应收表导出</td>
                           <td style="">开始时间<input type="text" name="time_start" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_start1" required >结束时间<input type="text" name="time_end" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_end1" required ></td>
                           <script type="text/javascript">
                             var picker = new Pikaday({
                               field: document.getElementById('time_start1'),
                               firstDay: 1,
                               minDate: new Date('2015-12-27'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                             var picker = new Pikaday({
                               field: document.getElementById('time_end1'),
                               firstDay: 1,
                               minDate: new Date('2015-12-27'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                           </script>
                           <td>
                           <div class="btn-operation">
                             <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                               操作
                               <span class="caret"></span>
                             </a>
                             <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                              <input type="submit" value="导出" class="detail">
                             </ul>
                             </div>
                           </td>
                        </form>
                       </tr>
                        <tr  class="deleted">
                        <form action="/admin/export/SaleScore" method="post">
                           <td style="text-align: left !important;">销售日报表</td>
                           <td style="">开始时间<input type="text" name="time_start" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_start2" required >结束时间<input type="text" name="time_end" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_end2" required ></td>
                           <script type="text/javascript">
                             var picker = new Pikaday({
                               field: document.getElementById('time_start2'),
                               firstDay: 1,
                               minDate: new Date('2015-12-27'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                             var picker = new Pikaday({
                               field: document.getElementById('time_end2'),
                               firstDay: 1,
                               minDate: new Date('2015-12-27'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                           </script>
                           <td>
                           <div class="btn-operation">
                             <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                               操作
                               <span class="caret"></span>
                             </a>
                             <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                              <input type="submit" value="导出" class="detail">
                             </ul>
                             </div>
                           </td>
                        </form>
                       </tr>
                       <tr  class="deleted">
                        <form action="/admin/export/ClientFollow" method="post">
                           <td style="text-align: left !important;">销售带看跟进</td>
                           <td style="">开始时间<input type="text" name="time_start" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_start3" required >结束时间<input type="text" name="time_end" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_end3" required ></td>
                           <script type="text/javascript">
                             var picker = new Pikaday({
                               field: document.getElementById('time_start3'),
                               firstDay: 1,
                               minDate: new Date('2015-12-27'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                             var picker = new Pikaday({
                               field: document.getElementById('time_end3'),
                               firstDay: 1,
                               minDate: new Date('2015-12-27'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                           </script>
                           <td>
                           <div class="btn-operation">
                             <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                               操作
                               <span class="caret"></span>
                             </a>
                             <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                              <input type="submit" value="导出" class="detail">
                             </ul>
                             </div>
                           </td>
                        </form>
                       </tr>
                       <tr  class="deleted">
                        <form action="/admin/export/SellOrder" method="post">
                           <td style="text-align: left !important;">业绩排行报表</td>
                           <td style="">开始时间<input type="text" name="time_start" value="<?php echo date("Y-m-d",time()-24*60*60) ?>"  id="time_start4" required >结束时间<input type="text" name="time_end" value="<?php echo date("Y-m-d",time()) ?>"  id="time_end4" required ></td>
                           <script type="text/javascript">
                             var picker = new Pikaday({
                               field: document.getElementById('time_start4'),
                               firstDay: 1,
                               minDate: new Date('2017-3-1'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                             var picker = new Pikaday({
                               field: document.getElementById('time_end4'),
                               firstDay: 1,
                               minDate: new Date('2017-3-30'),
                               maxDate: new Date('2030-1-1'),
                               yearRange: [2000,2030]
                             });
                           </script>
                           <td>
                           <div class="btn-operation">
                             <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                               操作
                               <span class="caret"></span>
                             </a>
                             <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                              <input type="submit" value="导出" class="detail">
                             </ul>
                             </div>
                           </td>
                        </form>
                       </tr>
              </tbody>
            </table>

              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">


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
         aria-hidden="true" style="margin-top:90px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-label">本站点提示...</h4>
                </div>
                <div class="modal-body">
                    <p>确定要删除吗?</p>
                </div>
                <div class="modal-footer">
                     <a id="left" class="btn btn-primary dels">确定</a>

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
