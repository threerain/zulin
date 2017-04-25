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
    <div class="row-fluid" >

      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">
            <div class="caption"><i class="icon-globe"></i>收房合同应付列表</div>

          </div>



          <div class="portlet-body" >
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            
              <form action="/admin/payable/index" style="margin-left:30px;height:74px;margin-top:30px;" >
                <div class="" style="margin-bottom:10px">
                <input type="hidden" name="dump" value="<?php echo $dump; ?>">
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
            <ul class="nav nav-tabs">
              <li id="weitijiao"><a  href="/admin/payable">未提交</a></li>
              <li id="yitijiao"><a  href="/admin/payable/index/dump/1" >已提交</a></li>
              <li id="yifukuan"><a  href="/admin/payable/index/dump/3" >已付款</a></li>
            </ul>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr class="yj-title-th">
                    <th class="hidden-480">品牌</th>
                    <th class="">系列</th>
                    <th class="">编号</th>
                    <th class="">车主</th>
                    <th class="">周期</th>
                    <th class="">付款日</th>
                    <th class="">付款方式</th>
                    <th class="">应付房租</th>
                    <th class="">月租金</th>
                    <th class="">押金</th>
                          <!--                     <th class="">物业费</th>
                    <th class="">取暖费</th> -->
                    <th class="">户名</th>
                    <th class="">收款银行</th>
                    <th class="">状态</th>
                    <th >操作</th>
                  </tr>
                </thead>
                <tbody>

                 <?php if ($list): ?>
                    <?php foreach ($list as $key => $value): ?>
                      <tr class="odd gradeX">
                        <!-- <td class=""><a target="_blank" href="/admin/purchasecontract/payable/id/<?php echo $value['contract_id'] ?>"><?php echo $value['contract_id'] ?></a></td> -->
                        <td class="hidden-480">
                        <?php echo $value['property'][0]['estate_name'] ?>
                        </td>
                        <td class="">
                        <?php echo $value['property'][0]['building_name'] ?>
                        </td>
                         <td class="" >
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
                        <td class=""><?php echo date('Y-m-d',$value['payable']->start_time) ?>至<?php echo date('Y-m-d',$value['payable']->end_time) ?></td>
                        <td class="" style="<?php echo strtotime('+3 days')>=$value['payable']->pay_date?'color:red':''; ?> " <?php  ?>><?php echo date('Y-m-d',$value['payable']->pay_date) ?></td>
                        <td class="">押 <?php echo $value['ya'] ?> 付<?php echo $value['pay'] ?></td>
                        <td class=""><?php echo round($value['payable']->amount/100,2)  ?></td>
                        <?php if ($value['pay']!=0): ?>
                        <td class=""><?php echo round($value['payable']->amount/100/$value['pay'],2)  ?></td>
                        <?php else: ?>
                        <td class="">0</td>
                        <?php endif ?>
                        <td class=""><?php echo $value['yajin']/100 ?></td>
                        <td class=""><?php echo $value['payee'] ?></td>
                        <td class=""><?php $str = $value['bank_account'];
                      preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/', $str,$match);
                      unset($match[0]);
                      echo $value['bank'].'<br>'.'账号：'.implode(' ', $match) ?></td>
                      <td><?php echo $value['dump']==1?'已提交':($value['dump']==3?'已付款':'未提交') ?></td>
                        <td class="">
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                            <?php if(AdminPositionModul::has_modul("901_02")&&$value['dump']!=1) {?>
                              <a href="/admin/purchasecontract/payable/id/<?php echo $value['contract_id'] ?>">编辑</a>
                            <?php }?>
                           <!--  <?php if(AdminPositionModul::has_modul("901_03")) {?>
                              <a href="/admin/purchasecontract/paymentlist/id/<?php echo $value['pay_id'] ?>">付款记录</a>
                            <?php }?> -->
                            <?php if(AdminPositionModul::has_modul("901_04")&&$value['dump']!=1) {?>
                              <a href="/admin/payable/payment/id/<?php echo $value['pay_id'] ?>">提交付款</a>
                            <?php }?>
                            <?php if(AdminPositionModul::has_modul("901_04")&&$value['dump']==1) {?>
                              <a  class="dump" href="/admin/payable/DumpCashOut/id/<?php echo $value['pay_id'] ?>">打印支出单</a>
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
<script>
  $(function(){
    var dump = $("input[name=dump]").val()
    if(dump==0){
      $("#weitijiao").css({background:"#ddd"});
    }else if(dump==1){
      $("#yitijiao").css({background:"#ddd"});
    }else if(dump ==3){
      $("#yifukuan").css({background:"#ddd"});
    }
  })
</script>
