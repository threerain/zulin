
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    TableManaged.init();");
?>
  <!-- End PAGE LEVEL SCRIPTS -->

<div class="page-content">
  <!-- BEGIN PAGE CONTAINER-->        
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid" style="min-height:10px;"></div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey" >
          <div class="portlet-title">

            <div class="caption"><i class="icon-globe"></i>付款列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body" style="margin-top: 34px;">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">

                <form action="/admin/finance/PaymentList" style="margin:0" >
                    <div class="dataTables_filter" style="margin-bottom:10px" id="">
                      <input type="hidden" name ="status" value="<?php echo $status; ?>">
                      <span>&nbsp&nbsp;品牌:<input type="text" value="<?php echo $estate;?>" name="estate"></span>
                      <span>&nbsp&nbsp;系列：<input type="text"  value="<?php echo $building;?>" name="building"></span>
                      <span>编号：<input type="text" value="<?php echo $room_number;?>" name="room_number"></span>
                      <button id="sample_editable_1_new" class="btn btn-primary" type="submit" >
                      搜索 <i class="icon-search"></i></button>
                        </button>
                    </span>
                      <span>

                    </div>
                    <div class="dataTables_filter" style="margin-bottom:10px">
                     
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
              </div>
            <ul class="nav nav-tabs">
              <li id="yitijiao"><a  href="/admin/finance/PaymentList/status/1" >未付款</a></li>
              <li id="yitijiao"><a  href="/admin/finance/PaymentList/status/2" >付部分</a></li>
              <li id="yifukuan"><a  href="/admin/finance/PaymentList/status/3" >已付清</a></li>
            </ul>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr>
                    <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                    <th class="hidden-480">付款合同</th>
                    <th class="hidden-480">项目</th>
                    <th class="hidden-480">付款日</th>
                    <th class="hidden-480">付款类型</th>
                    <th class="hidden-480">付款金额</th>
                    <th class="hidden-480">发起人</th>
                    <th class="hidden-480">付款时间</th>
                    <th class="hidden-480">付款备注</th>
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
                      <tr class="odd gradeX">
                        <td><?php echo $model->contract_id ?></td>
                        <td>
                        <?php $property = Property::allinfo($model->contract_id);
                        foreach ($property as $key => $value) {
                          echo $value['estate_name'].$value['building_name'].$value['house_no'];   
                        }
                         ?>

                        <td class="hidden-480"><?php echo date("Y-m-d",$model->payment_date); ?></td>
                        <td class="hidden-480">
                            <?php echo $model->type==1?"押金":""; ?>
                            <?php echo $model->type==2?"房租":""; ?>
                        </td>

                        <td class="hidden-480"><?php echo $model->amount/100; ?></td>
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="hidden-480"><?php echo date("Y-m-d",$model->ctime); ?></td>
                        <td class="hidden-480"><?php echo $model->memo; ?></td>
                        <td class="hidden-480"><?php echo $status2[$model->status]?$status2
                        [$model->status]:'状态错误'; ?></td>
                        <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                            <?php if(AdminPositionModul::has_modul("301_04")) {?>
                              <a href="/admin/finance/PayConfirm/id/<?php echo $model->id;?>"><span>确认</span></a>
                            <?php }?>
                            <?php if(AdminPositionModul::has_modul("301_01")) {?>
                              <a href="/admin/finance/PayConfirmList/id/<?php echo $model->id;?>"><span>付款记录</span></a>
                            <?php }?>

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
                  <div class="dataTables_paginate paging_bootstrap pagination">

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
  <!-- END PAGE CONTAINER-->
</div>

