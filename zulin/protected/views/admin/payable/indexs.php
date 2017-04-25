<style>
#jqaddlink{display:none!important;}
span{font-size: 14px;}
 input{width:150px;}
 select{width:150px;}
  input,select{border:1px solid #aaa!important;}

  #footer{float:left!important;width:300px;}
 /*模态框弹出层*/
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
}
</style>
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
            <div class="caption"><i class="icon-globe"></i>出车合同应收列表</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" style="height:0px;" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid" style="height:126px;" >
                <form action="/admin/payable/indexs" style="margin-left:30px;margin-top:30px;" >
                    <div class="">
                        <span>
                          品牌：<input type="text" value="<?php echo $estates;?>" name="estates">
                        </span>
                        <span>
                          系列：<input type="text"  value="<?php echo $building;?>" name="building">
                        </span>
                        <span>
                          编号：<input type="text" value="<?php echo $room_number;?>" name="room_number">
                        </span>
                        <span>
                          应付日期：<input  type="text" id="datepicker" value="<?php echo date('Y-m-d', $start_date ); ?>" name="start_date"/>
                          至<input  type="text" id="datepicker2" value="<?php echo date('Y-m-d', $end_date) ?>" name="end_date"/>
                        </span>
                        <span>
                          显示页数：
                          <select name="pagesize" style="width:80px;" id="">
                            <option value="20" <?php echo $pagesize==20?'selected':'' ?>>20</option>
                            <option value="50" <?php echo $pagesize==50?'selected':'' ?>>50</option>
                            <option value="100" <?php echo $pagesize==100?'selected':'' ?>>100</option>
                            <option value="300" <?php echo $pagesize==300?'selected':'' ?>>300</option>
                            <option value="1000" <?php echo $pagesize==1000?'selected':'' ?>>1000</option>
                          </select>
                        </span>
                        <script type="text/javascript">
                            var picker = new Pikaday({
                              field: document.getElementById('datepicker'),
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
                        </script>
                        <button id="sample_editable_1_new" class="btn blue" type="submit" style="margin-left:-3px;">
                          搜索 <i class="icon-search"></i>
                        </button>
                    </div> 
                </form>

              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr class="yj-title-th">
                    <th class="">单位计划</th>
                    <th class="">品牌</th>
                    <th class="">系列</th>
                    <th class="">编号</th>
                    <th class="">租户</th>
                    <th class="">付款日</th>
                    <th class="">周期</th>
                    <!-- <th class="">联系方式</th> -->
                    <th class="">付款方式</th>
                    <th class="">应收房租</th>
                    <th class="">押金</th>
                    <th class="">月租金</th>
                    <th class="">户名</th>
                    <th class="">收款银行</th>
                    <!-- <th class="">备注</th> -->
                    <th >操作</th>
                  </tr>
                </thead>
                <tbody>

                 <?php if ($list): ?>
                    <?php foreach ($list as $key => $value): ?>
                      <tr class="odd gradeX">
                        <td class=""><a target="_blank" href="/admin/salecontract/payable/id/<?php echo $value['contract_id'] ?>"><?php echo $value['contract_id'] ?></a></td>
                        <td class="">
                        <?php echo $value['property'][0]['estate_name'] ?>
                        </td>
                        <td class="">
                        <?php echo $value['property'][0]['building_name'] ?>
                        </td>
                         <td class="">
                         <?php foreach ($value['property'] as $k => $v): ?>
                            <?php echo $v['house_no'].'<br>' ?>
                          <?php endforeach ?>
                        </td>
                        <td class="" style="width:100px;">

                      <?php if ($value['owner']): ?>
                          <?php foreach ($value['owner'] as $k1 => $v1): ?>
                            <?php echo $v1; ?><br><br>
                          <?php endforeach ?>
                      <?php else: ?> <?php echo $value['company'] ?>
                      <?php endif ?>
                        </td>
                        <td class=""><?php echo date('Y-m-d',$value['payable']->pay_date) ?></td>
                        <td class=""><?php echo date('Y-m-d',$value['payable']->start_time) ?>至<?php echo date('Y-m-d',$value['payable']->end_time) ?></td>
<!--                         <td class="">
                      <?php if ($value['mobile']): ?>
                          <?php foreach ($value['mobile'] as $k2 => $v2): ?>
                            <?php echo $v2; ?><br><br>
                          <?php endforeach ?>
                      <?php else: ?> 电话丢失
                      <?php endif ?>
                        </td> -->
                        <td class="">押 <?php echo $value['ya'] ?> 付<?php echo $value['pay'] ?></td>
                        <td class=""><?php echo $value['payable']->amount/100 ?></td>
                        <td class=""><?php echo $value['yajin']/100?$value['yajin']/100 :'' ?></td>
                        <td class=""><?php echo $value['payable']->amount/100/$value['pay'] ?></td>
                        <td class=""><?php echo $value['payee'] ?></td>
                        <td class=""><?php $str = $value['bank_account'];
                      preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/', $str,$match);
                      unset($match[0]);
                      echo $value['bank'].'<br>'.'账号：'.implode(' ', $match) ?></td>
                        <!-- <td class="">备注</td> -->


                        <td class="">
                        	<div class="btn-operation">
		                        <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
		                          操作
		                          <span class="caret"></span>
		                        </a>
		                        <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
		                          <?php if(AdminPositionModul::has_modul("902_03")) {?>
		                            <a href="/admin/payable/editrecieve/id/<?php echo $value['recieve_id'] ?>">编辑</a>
		                          <?php }?>
		                          <?php if(AdminPositionModul::has_modul("902_05")) {?>
		                            <a href="/admin/salecontract/paymentlist/id/<?php echo $value['recieve_id'] ?>">收款记录</a>
		                          <?php }?>
		                          <?php if(AdminPositionModul::has_modul("902_04")) {?>
		                            <a href="/admin/salecontract/payment/id/<?php echo $value['recieve_id'] ?>">收款</a>
		                          <?php }?>
		                          <?php if(AdminPositionModul::has_modul("902_06")) {?>
		                            <a href="/admin/payable/edityuerecieve?id=<?php echo $value['recieve_id'] ?>&phone=<?php
		                              echo $phone = implode(',', $value['mobile']);
		                           ?>&owner=<?php echo $owner = implode(',',$value['owner']) ?>&contract_id=<?php echo $key ?>">催缴记录</a>

	                          <?php }?>
			                    </ul>
		                    </div>   
                       </td>




                      </tr>
                    <?php endforeach ?>
                 <?php endif ?>
                 <tr>
                  
                  <td>应收房租:<?php echo number_format($sum); ?></td>
                  <td>应收押金:<?php echo number_format($sum_ya); ?></td>
                  <td>合计:<?php echo number_format($sum+$sum_ya); ?></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                 </tr>
                </tbody>
              </table>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">
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

