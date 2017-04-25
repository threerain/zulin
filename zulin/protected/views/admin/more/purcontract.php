<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>华亮房产 -- 先锋地产机构、专业人、信誉人&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp合同编号<?php echo $model->id?></title>
  </head>
  <body>
  <style>
    body{
      text-align: center;
      height: 100%;
      position: relative;
    }
    div{
      position: absolute;
      margin: auto;
      top: 0;
      right: 0;
      left:0;
      bottom: 0;
      width: 85%;
      height: 20%;
    }
    .tc{text-align:center;}
    h1{
        font-size:40px;
      }
    span {
      display: block;}
    .f22{
      font-size: 20px;
    }
    p{
      font-size: 20px; text-align:left;
      line-height: 2;}
    input{border: none;border-bottom: 1px solid#333333;outline: none; font-size:20px!important;text-align:center}
    u{
        font-size:20px!important;
    }
    input[disabled]{
        background-color:white;
        color:#000000;
    }
  </style>
        <div class="">
            <h1 class="tc">租赁资产管理合同</h1>
            <span class="tc f22">经纪成交版</span>
            <p>出租方（甲方）：<input type="text" style="width: 450px" disabled value='<?php

                    echo $owner1;

            ?>'/> </p>


              <p>承租方（乙方）：<input type="text" style="width: 169px" disabled value="<?php echo $model->lessee?>"/> 代理方：<u style="font-size:16px">北京幼狮科技有限公司</u>   </p>
                <p>居间方（丙方）：<input type="text" style="width: 450px" disabled value='北京华亮房地产经纪有限公司'/></p>
                <br><br>
               <p>&nbsp;&nbsp;依据《中华人民共和国合同法》及有关法律、法规的规定，甲、乙、丙三方在平等、自愿的基础上，就乙方承租甲方车源，丙方提供居间服务等事宜，经各方友好协商一致，签订本合同以资信守。</p>
            <p><b>&nbsp;&nbsp; 第一条  车源基本情况</b>
               <br>&nbsp;（一）车源坐落于北京市<u> <?php
                            if($address!=null) {

                            echo   $address;
                          }else {
                            echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
                          }

               ?> </u>,承租区域建筑面积<u> <?php echo $area?> </u>平方米（最终以车源所有权证标注的建筑面积为准）。<br>
                  &nbsp;（二）车源权属状况：甲方持有（口 车源所有权证/口 车源买卖合同/口 商品房预售合同/口 二手房网签合同/口 其它车源证明文件）,车源所有权证书编号：<u> <?php echo rtrim($property_card,',')?> </u>，车源（
                  口是/口否）已设定了抵押。甲方保证出租的车源权属无瑕疵、无债务纠纷，车源设施符合出租条件。<br><br>
                 <b>&nbsp;&nbsp; 第二条  车源租赁情况</b><br>
                  &nbsp;&nbsp;租赁用途：<u> 办公 </u>，甲方应当协助乙方办理营业执照。<br>
                  <br><b>&nbsp;&nbsp; 第三条  租赁期限及免租期</b><br>
                    &nbsp;    <?php
                              if($model->free_type!=null) {
                                    if($model->free_type==1) {
                                          $a = '合同期限外';
                                    }else if($model->free_type==2) {
                                          $a =  '合同期限内';
                                    }else if($model->free_type==3) {
                                          $a = '合同期限内期外';
                                    }

                              }else {
                                          $a =  '合同期限内';
                              }

                                foreach($freelease as $k=>$v) {
                                if($k==0) {?>
                                  &nbsp;（一）甲方承诺在租赁<?php echo $a?>给予乙方
                            <?php
                          }else {?>
                                  &nbsp;&nbsp;&nbsp;&nbsp;甲方承诺在租赁<?php echo  $a?>给予乙方
                        <?php  }
                            ?><u> <?php

                                                                  $val = $v->end_time - $v->start_time + 60*60*20;
                                                                  $val = date('m',$val);
                                                                  echo $val-1;
                            ?> </u>个月的免租期，<br>
                  &nbsp;&nbsp;  自<u> <?php echo date('Y',$v->start_time)?> </u>年<u> <?php echo date('m',$v->start_time)?> </u>月<u> <?php echo date('d',$v->start_time)?> </u>日至<u> <?php echo date('Y',$v->end_time)?> </u>年<u> <?php echo date('m',$v->end_time)?> </u>月<u> <?php echo date('d',$v->end_time)?> </u>日止。免租期内乙方不支付租金，以便于乙方与入住方协商洽谈、进行装饰装修及办理入住手续等事宜。免租期内物业管理费用、供暖费和制冷费由甲方自行缴纳。<br> <?php  }?>
                  &nbsp;（二）本合同车源租赁期限为<u> <?php

                          echo $model->lease_term_year?$model->lease_term_year:" "

                  ?> </u>年，自<u> <?php echo date('Y',$model->lease_term_start)?> </u>年<u> <?php echo date('m',$model->lease_term_start)?> </u>月<u> <?php echo date('d',$model->lease_term_start)?> </u>日至<u> <?php echo date('Y',$model->lease_term_end)?> </u>年<u> <?php echo date('m',$model->lease_term_end)?> </u>月<u> <?php echo date('d',$model->lease_term_end)?> </u>日止。<br>
                  &nbsp;（三）甲方应于<input type="text" style="width:40px"  value="">年<input type="text" style="width:40px"  value="">月<input type="text" style="width:40px"  value="">日将车源按约定条件交付给乙方。《车源交割清单》（见附件一）经甲乙双方交验签字（盖章）确认及将房门钥匙移交视为交付完成。<br>
                  &nbsp;（四）若合同期满乙方仍有承租人使用该车源，乙方应提前90天通知甲方，双方协商认可后签订延长期合同，本合同期限最长可自动顺延一年。在同等市场条件下，乙方拥有优先承租权。<br><br>

                <b>&nbsp;&nbsp; 第四条 租金和押金</b><br>
                  &nbsp;（一）乙方按照下列标准向甲方支付租金（以人民币进行结算）：<br>
                  <!--  -->
                  <?php foreach (CmsPurchasePayRule::model()->findAll("contract_id='$model->id' order by the_order") as $key => $value) {?>
                    &nbsp;<u> <?php echo date("Y",$value->start_time)?> </u>年<u> <?php echo date("m",$value->start_time)?> </u>月<u> <?php echo date("d",strtotime('+1 day',$value->end_time))?> </u>日至<u> <?php echo date("Y",$value->end_time)?> </u>年<u> <?php echo date("m",$value->start_time)?> </u>月<u> <?php echo date("d",$value->end_time)?> </u>日,
                    租金为<u> ¥<?php echo $value->monthly_rent/100?>.00 </u>元/月（大写人民币：<u> <?php echo rtrim($this->num_to_rmb($value->monthly_rent/100),'元')?> </u>元/月）;<br>
                <?php  }?>

                        &nbsp;（二）租金支付方式为：押<?php
                                    $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");
                                    $len = count($pay);
                                    $pay = $pay[0];
                                    if (sizeof($pay)>0){

                                ?>
                                  <u> <?php echo rtrim($this->num_to_rmb($pay->deposit_month),'元')?> </u>付<u> <?php

                                      echo rtrim($this->num_to_rmb($pay->pay_month),'元')?> </u>

                                <?php
                              } ?><br>
                        &nbsp;1、车源押金：<u> ¥<?php echo $model->deposit/100?>.00 </u>元，支付时间为<u> <?php echo $model->deposit_pay_time?date('Y',$model->deposit_pay_time):''?> </u>年<u> <?php echo $model->deposit_pay_time?date('m',$model->deposit_pay_time):''?> </u>月<u> <?php echo $model->deposit_pay_time?date('d',$model->deposit_pay_time):''?> </u>日支付;<br>
                        &nbsp;2、押金是乙方向甲方支付的合法履约的保证金。租赁期满后5日内甲方退换乙方。<br>
                        &nbsp;3、首期租金：<u> ¥<?php


                              echo  ($money[0]['monthly_rent']/100)*$num[0]['pay_month'];

                        ?>.00 </u>元（大写人民币：<u> <?php

                                    echo rtrim($this->num_to_rmb(($money[0]['monthly_rent']/100)*$num[0]['pay_month']),'元');

                        ?> </u>元整），支付时间为<u> <?php

                                      echo date('Y',$model->deposit_pay_time);

                        ?> </u>年<u> <?php

                                      echo date('m',$model->deposit_pay_time)

                        ?> </u>月<u> <?php

                                    echo date('d',$model->deposit_pay_time);

                        ?> </u>日前；租金每<u> <?php echo rtrim($this->num_to_rmb($num[0]['pay_month']),'元')?> </u>个月支付一次，于付款月起租日<?php echo $model->advance_days?>日前支付下一次租金，即第二期租金的支付时间为：<u> <?php

                                echo  date('Y',$model->rent_second_time);

                        ?> </u>年<u> <?php

                                echo date('m',$model->rent_second_time);

                        ?> </u>月<u> <?php

                                echo date('d',$model->rent_second_time);

                          ?> </u>日前，<?php



                          ?> 第三期租金的支付时间为 <u> <?php

                                $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

                                if (sizeof($pay)>0){
                                    foreach ($pay as $key => $value) {
                                          $val = round($value->pay_month);

                                          $day = strtotime("+".$val." months -1 day",$model->rent_second_time);
                                          $day = strtotime("-".$model->advance_days."days",$day);
                                          echo date('Y',$day);

                                    }
                                  }
                          ?> </u>年<u> <?php

                                $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

                                if (sizeof($pay)>0){
                                    foreach ($pay as $key => $value) {
                                          $val = round($value->pay_month);

                                          $day = strtotime("+".$val." months -1 day",$model->rent_second_time);
                                          $day = strtotime("-".$model->advance_days."days",$day);

                                          echo date('m',$day);

                                    }
                                  }
                          ?> </u>月<u> <?php

                                $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

                                if (sizeof($pay)>0){
                                    foreach ($pay as $key => $value) {
                                          $val = round($value->pay_month);

                                          $day = strtotime("+".$val." months -1 day",$model->rent_second_time);
                                          $day = strtotime("-".$model->advance_days."days",$day);

                                          echo date('d',$day);

                                    }
                                  }
                          ?> </u>日，合同期每期租金以此类推。<br>
                        &nbsp;（三）租金的结算方式 口 以转账的方式 口 现金支付<br>
                        &nbsp;甲方指定收款账户为：<br>
                        &nbsp;名&nbsp;称：<input type="text" style="width:500px;text-align:left" disabled value="<?php echo $model->payee ?>";><br>
                        &nbsp;开户行：<input type="text" style="width:500px;text-align:left" disabled value="<?php echo $model->bank?>";><br>
                        &nbsp;账&nbsp;号：<input type="text" style="width:500px;text-align:left" disabled value="<?php preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{0,4})([\d]{0,})?/', $model->bank_account,$match);
                                                         unset($match[0]);
                                                         echo implode(' ', $match) ?>";><br><br>
                <b>&nbsp;&nbsp; 第五条 相关费用的承担责任</b> <br>
                        &nbsp;（一） 甲方自行承担在承租期内及免租期内的物业管理费、供暖费、制冷费。<br>
                        &nbsp;（二）在承租期内，乙方自行承担在使用期间的相关费用（水费、电费、燃气费、宽带费、停车费等），乙方按物业管理机构提供的交费通知单交付。<br>
                        &nbsp;（三）在承租期内，乙方自行报装电话、宽带，相关费用由乙方自行承担。<br>
                        &nbsp;（四）在承租期内，甲方应负责协助为乙方或车源实际使用人开具车源租金发票（增值税普通发票或增值税专用发票），发票需缴纳的税费由 □甲方 □乙方（或车源实际使用人）承担。<br>
                        &nbsp;（五）甲方同意，在承租期内，若乙方垫付了应由甲方支付的费用，乙方应出示相关缴费凭据并可在下次车源租金中直接扣除。<br>  <br>
                <b>&nbsp;&nbsp; 第六条  甲方的权利义务</b> <br>
                        &nbsp;（一）甲方应保证出租车源的建筑结构和设备设施符合建筑、消防、电路、防水等方面的安全标准，不得危及乙方使用安全。<br>
                        &nbsp;（二）在承租期，如乙方需要车源权属证明等证件原件，甲方应予以提供或出示。<br>
                        &nbsp;（三）承租期内，该车源主体结构、设备设施的维修责任。<br>
                        &nbsp;&nbsp;&nbsp;对于该车源的主要结构、固定管道线路及固定设施（包括制热、制冷、排风、上下水、电路及燃气等设施）发生自然损坏、故障或合理使用而导致的老化、耗损，乙方应及时通知甲方修复。甲方应在接到乙方通知后的5日内进行维修。逾期不维修的，乙方可代为维修，费用由甲方承担（乙方应出示相关维修支付凭据，并可在下次车源租金中直接扣除）。<br>
                        &nbsp;&nbsp;&nbsp;因上述原因进行维修的，在车源恢复到正常使用前的期间，影响乙方无法正常使用，维修天数的租金由甲方承担，从支付甲方的下一次房租中扣除。<br>
                        &nbsp;（四）在承租期内，甲方转让车源应提前三个月通知乙方，乙方在同等价格条件下享有优先购买的权利。且甲方应与买受人对本合同进行交接完毕，不得影响乙方在本合同项下的权利义务。<br><br>
                <b>&nbsp;&nbsp; 第七条  乙方的权利义务</b> <br>
                        &nbsp;（一）承租期内，甲方同意将乙方加价出租该车源的溢价部分作为管理服务费由乙方收取，乙方收取租金高于支付甲方的租金部分用于对承租车源进行装饰、装修、添置办公设备、设施等，但乙方不得拆除、破坏承租区域建筑的主体结构。 <br>
                        &nbsp;（二）由于乙方装修或使用原因，导致房间的主要结构固定管道线路及设施发生损害、故障乙方须及时修复或照价赔偿。<br>
                        &nbsp;（三）甲方拖欠物业费或其它相关费用导致乙方不能正常使用的情况下，为保证乙方正常办理装修手续或正常使用，乙方可自行缴费，款项乙方在付下次租金时在房租里直接扣除。<br><br>
                <b>&nbsp;&nbsp; 第八条  转租</b> <br>
                        &nbsp;&nbsp;甲方同意乙方可在承租期内将车源部分或全部出租给第三方使用，乙方负责对第三方进行监督、管理，并自行承担与第三方的全部权利义务关系。<br><br>
                <b>&nbsp;&nbsp; 第九条  合同解除</b> <br>
                        &nbsp;（一）经甲乙双方协商一致，可以解除本合同。<br>
                        &nbsp;（二）因不可抗力导致本合同无法继续履行的，本合同自行解除。<br>
                        &nbsp;（三）甲方有下列情形之一的，乙方有权单方解除合同；<br>
                        &nbsp;&nbsp;1、甲方有下列情形之一的，乙方有权单方解除合同；<br>
                        &nbsp;&nbsp;2、交付的车源不符合约定的使用条件或影响乙方安全、健康的。<br>
                        &nbsp;&nbsp;3、不承担约定的维修义务，致使乙方无法正常使用车源达10日的。<br>
                        &nbsp;&nbsp;4、未提前说明重大安全隐患，如漏水、漏电等<br>
                        &nbsp;&nbsp;5、甲方未能配合乙方（或车源实际使用人）开具增值税专用发票及增值税普通发票。<br>
                        &nbsp;&nbsp;6、甲方提前终止合同。<br>
                        &nbsp;（四）乙方有下列情形之一的，甲方有权单方解除合同：<br>
                        &nbsp;&nbsp;1、无故延迟支付租金达10日的。<br>
                        &nbsp;&nbsp;2、擅自拆除或破坏车源建筑主体结构。<br>
                        &nbsp;&nbsp;3、利用车源从事违法犯罪活动。<br>
                        &nbsp;&nbsp;4、因装修造成车源重大安全隐患的。<br>
                        &nbsp;&nbsp;5、乙方提前终止合同。<br><br>
                <b>&nbsp;&nbsp; 第十条  违约责任</b> <br>
                          &nbsp;&nbsp;（一）甲方有第九条第（三）款约定的情形之一的，应按2个月租金为标准向乙方支付违约金，同时退还乙方已支付押金及未使用租期租金，如甲方违约仍需足额支付乙方对该车源多次进行装饰、装修、添附设备、设施及乙方对他方赔偿所支付的全部费用；乙方有第九条第（四）款约定的情形之一的，应按2个月租金为标准向甲方支付违约金，甲方应退还乙方剩余押金及未使用租期租金。<br>
                        &nbsp;（二）甲方在签订本合同后，保证乙方该车源可注册，宽带网络可正常报装使用，如因原租户营业执照未迁出，或因原租户宽带网络未注销，影响乙方正常注册，或正常报装使用宽带网络，双方应本着友好协商，甲方应在10日内解决上述问题。如甲方10日内仍未解决上述问题，视甲方违约，需支付乙方两个月房租作为违约金，并支付乙方对该车源进行装饰、装修、添附设备、设施及乙方对他方赔偿所支付的全部费用，同时乙方有权解除本合同。
                        <br><br>
                <b>&nbsp;&nbsp; 第十一条 合同争议的解决办法</b> <br>
                        &nbsp;&nbsp;本合同各项条款发生的争议，由双方当事人协商解决；协商不成的，依法向有管辖权的人民法院起诉，或按照另行达成的仲裁条款或仲裁协议申请仲裁。<br><br>
                <b>&nbsp;&nbsp; 第十一条 合同争议的解决办法</b> <br>
                        &nbsp;（一）甲乙双方一致同意，可通过在本合同中书写的手机号码以短信、微信方式进行相关通知的送达，在短信、微信发送成功后即视为完成送达。<br>
                        &nbsp;（二）甲乙双方在本合同中书写的地址即为本合同下任何书面通知的有效送达地址，若因接收方拒收或地址错误等情况致使无法送达的，均以付邮日（以邮戳为准）后3日即视为通知方已依本合同给予书面通知。若任何一方联络地址变更的，应及时通知对方。
                        <br><br>
                <b>&nbsp;&nbsp; 第十三条  其他</b> <br>
                        &nbsp;（一）本合同签订当日，甲方向丙方支付居间服务费：<input type="text" style="width:75px"  value="">元。<br>
                        &nbsp;（二）本合同经甲乙双方签字盖章后生效。本合同（及附件）一式叁份，甲、乙、丙方各持一份。<br>
                        &nbsp;（三）本合同生效后，各方对合同内容的变更或补充应采取书面形式，作为本合同的附件。甲方应签署附件《不动产授权委托书》，该委托书与本合同具有同等的法律效力。<br><br>
               <b>&nbsp;&nbsp;第十四条  补充条款</b> <br>
                      &nbsp; 以下条款内容与本合同其它各条款具备同等法律效力,若补充条款与原合同不一致或发生冲突时，应以补充条款为准。<br>
                        <u><?php

                                    $b = str_replace('￥','¥',$model->addition);
                                    $c = str_replace('(2).','<br>(2).',$b);
                                    $d = str_replace('(3).','<br>(3).',$c);
                                    $e = str_replace('(4).','<br>(4).',$d);
                                    $f = str_replace('(5).','<br>(5).',$e);
                                    $g = str_replace('(6).','<br>(6).',$f);
                                    $h = str_replace('(7).','<br>(7).',$g);
                                    $i = str_replace('(8).','<br>(8).',$h);
                                    $j = str_replace('(9).','<br>(9).',$i);
                                    $k = str_replace('(10).','<br>(10).',$j);

                                    echo $k;

                         ?></u><br><br>

                        <b> 出租人（甲方）：<input type="text" name="" style="width:119px;font-size:10px" value="">&nbsp&nbsp承租人（乙方）：<input type="text" name="" style="width:119px;font-size:10px" value=""></b>　<br>
                        联系地址：<input type="text" name="" style="width:180px;font-size:10px" value="">&nbsp&nbsp联系地址：<input type="text" name="" style="width:185px" value="">
                        <br>联系方式：<input type="text" name="" style="width:180px;" disabled value="">&nbsp&nbsp系方方式：<input type="text" name="" style="width:185px;font-size:10px" value="400-078-8800">
                        <br>委托代理人 ：<input type="text" name="" style="width:150px;font-size:10px" value="">&nbsp&nbsp委托代理人：<input type="text" name="" style="width:165px;font-size:10px" value=""><br>
                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp年&nbsp&nbsp月&nbsp&nbsp日                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp年&nbsp&nbsp月&nbsp&nbsp日<br><br>


                            <b> 居间方（丙方）：<input type="text" name="" style="width:119px;font-size:10px" value=""></b><br>
                            房地产经纪人：<input type="text" name="" style="width:140px;font-size:10px" value="">
                            <br>资质证书号：<input type="text" name="" style="width:160px;font-size:10px" value="">
                            <br>联系地址：<input type="text" name="" style="width:180px;font-size:10px" value="">
                            <br>联系方式：<input type="text" name="" style="width:180px;font-size:10px" value=""><br>
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp年&nbsp&nbsp月&nbsp&nbsp日




                      </p>

        </div>
  </body>
</html>
