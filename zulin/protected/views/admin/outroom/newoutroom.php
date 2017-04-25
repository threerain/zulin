


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
            <?php if($id) {
                  foreach($id as $k=>$v) {
                      $list = Cmsoutroom::model()->find("contract_id= '$v'");
                      $user = AdminUser::model()->find("id='$list->operator_id'");
                  	  $area_name1 = AdminDepartment::model()->find("id='$user->department_id'");
                  	  $area_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");
                  	  $pay = CmsPurchasePayRule::model()->find("contract_id='$v' order by the_order");
                  	  $res = CmsPurchaseProperty::model()->find("contract_id='$v'");
                  	  $res1 = CmsPurchaseProperty::model()->findAll("contract_id='$v'");
                  	  if($res){
                  	    $data = CmsProperty::model()->find("id='$res->property_id'");
                  	    if($data){
                  	      $item = BaseEstate::model()->find("id='$data->estate_id'");  //品牌
                  	      $item2 = BaseBuilding::model()->find("id='$data->building_id'");	//系列
                  	    }
                  	    $item_id = '';
                  	    foreach ($res1 as $key => $value) {
                  	      $item3 = CmsProperty::model()->find("id='$value->property_id'");
                  	      $item_id .= $item3->house_no.' ';    //编号
                  	      }
                  	   }
                  	   $real_commission = $list->amount_money/100;
                  	   $real_commission1 = $this->num_to_rmb($real_commission);
                  	   $b = $list->pay_type;  //支付类型
                       $c = '';
                       $d = '';
                       $f = '';
                  	   if($b==1){
                  	     $c = '√';
                  	   }else if($b==2){
                  	     $d = '√';
                  	   }else if($b==3){
                  	     $f = '√';
                  	   }

                  	   $check_three = AdminUser::model()->find("id='$list->check_three'");
                  	   $g =	$check_three->nickname;  //公司领导
                  		 $check_two = AdminUser::model()->find("id='$list->check_two'");
                  	   $t =	$check_two->nickname;  //审批人
                  	   $money_two = AdminUser::model()->find("id='$list->money_two_type'");
                  	   $h =	$money_two->nickname;  //财务主管
                  	   $money_one = AdminUser::model()->find("id='$list->money_one_type'");
                  	   $i =	$money_one->nickname;  //会计

                  	   preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/',$list->commission_num,$match);
                  	   unset($match[0]);
                  	   $m = implode(' ', $match);
                  		 $gs = "月租金".$pay->monthly_rent/100;
                  		 $gs .= "*";
                  		 $gs .= 12;
                  		 $gs .="*";
                  		 $gs .=0.8;
                  		 $gs .= "=";
                  		 $gs .= number_format($pay->monthly_rent/100*0.96,2);
                       if($list!=null) {?>

                         <table width="744"  border="1">
                                                 <caption><h2>出 车 佣 金 支 出 凭 单</h2><br><p style="text-align:left;padding:0;margin:0;">No:<?php echo $list->id?></p></caption>
                                                 <tbody>
                                                   <tr >
                                                     <td height="40"  colspan="2"><b>申请部门：</b><?php echo $area_name->name." ".$area_name1->name?></td>
                                                     <td height="40"	width="230"><b>申请人：</b><?php echo $user->nickname ?></td>
                                                     <td height="40" width="230"><div align="left"><?php echo date("Y年m月d日",$list->ctime)?></div></td>
                                                   </tr>
                                                   <tr>
                                                     <td width="255" height="89"><div align="center"><b>摘 要</b></div></td>
                                                     <td colspan="3"><div align="left"><b>佣 金</b>:<?php echo number_format($pay->monthly_rent/100*0.96,2)?>元<b><br>项 目:</b><?php echo $item->name." ".$item2->name." ".$item_id?><br><b>公 式:</b><?php echo $gs?><br><b>备 注:</b><?php echo $list->remark?></div></td>
                                                   </tr>
                                                   <tr >
                                                     <td height="40" height="25"><div align="center"><b>金 额</b></div></td>
                                                     <td height="40" colspan="3"><div align="center"><?php echo $real_commission1?>&nbsp;&nbsp;￥<u><?php echo number_format($real_commission,2)?>元</u></div></td>
                                                   </tr>
                                                   <tr >
                                                     <td height="40" height="30"><div align="center"><b>收款人/单位名称</b></div></td>
                                                     <td height="40" colspan="3"><div align="center"><?php echo $list->commission_user?></div></td>
                                                   </tr>
                                                   <tr>
                                                     <td height="40"><div align="center"><b>开户银行</b></div></td>
                                                     <td height="40" colspan="3"><div align="center"><?php echo $list->commission_bank?></div></td>
                                                   </tr>
                                                   <tr>
                                                     <td height="40"><div align="center"><b>银行账号</b></div></td>
                                                     <td height="40" colspan="3"><div align="center"><?php echo $m?></div></td>
                                                   </tr>
                                                   <tr>
                                                     <td height="40" colspan="2"><div  align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;附单据&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;张&nbsp;&nbsp;</b></div></td>
                                                     <td height="40" colspan="2">现金支付（<?php echo $c?>）&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;银行汇款（<?php echo $d?>）&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;转账支票（<?php echo $f?>）</td>
                                                   </tr>

                                                 </tbody>
                                               </table>
                                               <div align="left"><b>公司领导：</b><?php echo $g?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>财务主管：</b><?php echo $h?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>会计：</b><?php echo $i?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>审批人：</b><?php echo $t?></div>


              <?php   }
               }
            }?>
        <!-- END EXAMPLE TABLE PORTLET-->
      </div>
    </div>
  </div>
  <!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER-->
</div>
