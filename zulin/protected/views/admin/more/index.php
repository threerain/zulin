<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>北京幼狮科技有限公司 -- 为梦想 、 造支点&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合同编号：<?php echo $model->id?></title>
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
  input{border: none;border-bottom: 1px solid#333333;outline: none; font-size: 20px!important;text-align:center}
  u{
        font-size:20px!important;
  }
  input[disabled]{
      background-color:white;
      color:#000000;
  }
</style>
<div>
  <h1 class="tc">北京市车源租赁合同</h1>
  <span class="tc f22"> 幼狮空间成交版</span>

  <p>出租方（甲方）：<input type="text" style="width: 177px" disabled value=''/> 代理方：<u style="font-size:16px">北京幼狮科技有限公司</u>   </p>
    <p>承租方（乙方）：<input type="text" style="width: 450px" disabled value="<?php echo $lessee;?>"/></p>
    <?php if($model->channel_id!=null) {?>
      <p>居间方（丙方）：<input type="text" style="width: 450px" disabled value='<?php

                $channel = CmsChannel::model()->find("id='$model->channel_id'");
                  echo $channel->name;
      ?>'/></p>
  <?php  }?>
  <input type="hidden" style="width: 450px" disabled value="<?php echo $lessee;?>"/>
    <br><br>
  <p> &nbsp;&nbsp;依据《中华人民共和国合同法》及有关法律、法规的规定，甲、乙<?php if($model->channel_id!=null) {
                                    echo '、丙三';
  }else {
              echo '双';
  }?>方在平等、自愿的基础上，就乙方承租甲方车源<?php if($model->channel_id!=null) {
                                          echo '，丙方提供居间服务等事宜';
  }?>，经各方友好协商一致，签订本合同以资信守。</p>
<p><b>&nbsp;&nbsp; 第一条  车源基本情况</b>
   <br>&nbsp;（一）车源坐落于北京市<u><?php
                if($address!=null) {

                echo   "&nbsp".$address."&nbsp";
              }else {

                echo '&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';

              }

   ?></u>,承租区域建筑面积<u> <?php echo $areas?> </u>平方米（最终以车源所有权证标注的建筑面积为准），产权证编号：<u><?php echo $pur_card?></u>。<br>
      &nbsp;（二）甲方保证出租的车源权属无瑕疵、无债务纠纷，车源设施符合出租条件。<br>
     <b>&nbsp;&nbsp; 第二条  车源租赁情况</b><br>
      &nbsp;&nbsp;租赁用途：<u> 办公 </u>，车源性质<u> 商品房 </u>，根据房产性质及政府相关规定可以进行工商注册的车源，甲方向乙方提供车主身份证复印件及车源所有权证复印件，乙方自行到相关部门办理工商注册事宜，并由乙方自行承担注册不成功之风险。
      <br><b>&nbsp;&nbsp; 第三条  租赁期限及免租期</b><br>
        <?php if($freelease!=null) {?>

          <?php
                  foreach($freelease as $k=>$v) {
                        if($k==0) {?>
                          &nbsp;（一）甲方承诺在租赁合同期限内给予乙方
                    <?php
                  }else {?>
                          &nbsp;&nbsp;&nbsp;&nbsp;甲方承诺在租赁合同期限外给予乙方
                <?php  }
                    ?>


                  <u> <?php

                                      $val = $v->end_time - $v->start_time;
                                      $date = $val/(24*3600);
                                      echo floor($date)+1;

                    ?></u> 天的免租期。自<u> <?php

                                                echo $v->start_time?date('Y',$v->start_time):"";

                    ?> </u>年<u> <?php

                                                echo $v->start_time?date('m',$v->start_time):"";

                    ?> </u>月<u> <?php

                                                echo $v->start_time?date('d',$v->start_time):"";

                    ?> </u>日至<u> <?php

                                                echo $v->start_time?date('Y',$v->end_time):"";

                    ?> </u>年<u> <?php

                                                echo $v->start_time?date('m',$v->end_time):"";

                    ?> </u>月<u> <?php

                                                echo $v->start_time?date('d',$v->end_time):"";

                    ?> </u>日止。免租期内乙方不支付租金，以便于乙方进行装饰装修及办理入驻手续等事宜。免租期内物业管理费、供暖费由 口 甲方  口 乙方 承担。<br>
        <?php
                }

        }?>

      &nbsp;<?php if($freelease!=null) {
                    echo '（二）';
          }else {
                  echo '（一）';
          }

          ?>本合同车源租赁期限为<u> <?php echo rtrim($this->num_to_rmb($model->lease_term_year),'元')?> </u>年。自<u> <?php echo date('Y',$model->lease_term_start);?> </u>年<u> <?php echo date('m',$model->lease_term_start);?> </u>月<u> <?php echo date('d',$model->lease_term_start)?> </u>日至<u> <?php echo date('Y',$model->lease_term_end)?> </u>年<u> <?php echo date('m',$model->lease_term_end)?> </u>月<u> <?php echo date('d',$model->lease_term_end)?> </u>日止。<br>
      &nbsp;<?php if($freelease!=null) {
                    echo '（三）';
          }else {
                  echo '（二）';
          }

          ?>合同期满乙方仍需用该车源，乙方应提前90天通知甲方，双方协商同意后另行签署新的租赁合同，若乙方未提前90日提出书面续租申请视为乙方放弃续租权，在此期间乙方应配合甲方带领未来租户看房。在同等市场条件下，乙方拥有优先承租权。<br>
      <b> &nbsp; &nbsp;第四条  租金和押金</b><br>
      &nbsp;（一）乙方按照下列标准向甲方支付租金（以人民币进行结算）：<br>
        <?php
              $payrule =  CmsPurchasePayRule::model()->findAll("contract_id='$model->id' order by the_order");
              foreach ( $payrule as $key => $value) {
      ?>
      <u> <?php

                    echo   date('Y',$value->start_time);

           ?> </u>年<u> <?php

                    echo   date('m',$value->start_time);

           ?> </u>月<u> <?php

                    echo  date('d',$value->start_time);

              ?> </u>日至<u> <?php

                  echo  date('Y',$value->end_time);

                  ?> </u>年<u> <?php

                      echo date('m',$value->end_time);

                  ?> </u>月<u> <?php

                          echo date('d',$value->end_time);

                   ?> </u>日,
          租金为<u> ¥<?php echo $value->monthly_rent/100?>.00 </u>元/月（大写人民币：<u><?php


                          $val = $this->num_to_rmb($value->monthly_rent/100);
                          echo rtrim($val,'元');
                ?>

          </u>元/月）；<br>
      <?php
          }
      ?>


      &nbsp;（二）租金支付方式为：押 <?php
                  $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");
                  if (sizeof($pay)>0){
                      foreach ($pay as $key => $value) {
              ?>
                  <u> <?php echo rtrim($this->num_to_rmb($value->deposit_month),'元')?> </u>付<u> <?php

                    echo rtrim($this->num_to_rmb($value->pay_month),'元')?> </u><br>

              <?php
            }
             }?>

      &nbsp;1、房租押金<u> ¥<?php echo ($model->deposit/100)?>.00 </u>元（大写人民币：<u><?php
                                echo rtrim($this->num_to_rmb($model->deposit/100),'元');

      ?> </u>元整），支付时间为<u> <?php
              echo date('Y',$model->deposit_pay_time);
      ?> </u>年<u> <?php
              echo  date('m',$model->deposit_pay_time);
       ?> </u>月<u> <?php
              echo date('d',$model->deposit_pay_time);
       ?> </u>日前支付。<br>
      &nbsp;2、押金是乙方向甲方交付的合法履约的保证金，如乙方在租赁期限届满之前违反本合同约定，押金作为违约金不予退还。租赁期满之日，甲乙双方结清各自承担费用，乙方须将工商注册地迁离此房后3个工作日内由甲方退还乙方押金。<br>
      &nbsp;3、首期租金<u> ¥<?php


            echo  ($money[0]['monthly_rent']/100)*$num[0]['pay_month'];

      ?>.00 </u>元（大写人民币：<u><?php

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



        ?> 第三期租金的支付时间为<u> <?php

              $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

              if (sizeof($pay)>0){
                  foreach ($pay as $key => $value) {
                        $val = round($value->pay_month);

                        $day = strtotime("+".$val." months ",$model->rent_second_time);
                        // $day = strtotime("-".$model->advance_days."days",$day);
                        echo date('Y',$day);

                  }
                }
        ?> </u>年<u> <?php

              $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

              if (sizeof($pay)>0){
                  foreach ($pay as $key => $value) {
                        $val = round($value->pay_month);

                        $day = strtotime("+".$val." months ",$model->rent_second_time);
                        // $day = strtotime("-".$model->advance_days."days",$day);

                        echo date('m',$day);

                  }
                }
        ?> </u>月<u> <?php

              $pay=CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

              if (sizeof($pay)>0){
                  foreach ($pay as $key => $value) {
                        $val = round($value->pay_month);

                        $day = strtotime("+".$val." months ",$model->rent_second_time);
                        // $day = strtotime("-".$model->advance_days."days",$day);

                        echo date('d',$day);

                  }
                }
        ?> </u>日前，合同期每期租金以此类推。<br>
     &nbsp; （三）租金的结算方式为：口 以转账方式；口 现金支付
      <br>&nbsp;&nbsp;甲方指定收款账户为：<br>
      &nbsp; 名&nbsp;称：<input type="text" style="width: 500px;text-align:left"/ disabled value="<?php echo $model->payee?>"  ><br>
      &nbsp; 开户行：<input type="text" style="width: 500px;text-align:left"/ disabled value="<?php echo $model->bank?>"><br>
      &nbsp; 帐&nbsp;号：<input type="text" style="width: 500px;text-align:left"/ disabled value=" <?php preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{0,4})([\d]{0,})?/', $model->bank_account,$match);
      unset($match[0]);
      echo implode(' ', $match)?>"><br>
      <b>&nbsp; 第五条  相关费用的承担方式</b><br>
      &nbsp; （一）甲方承担在承租期的物业管理费、供暖费。<br>
      &nbsp; （二）在承租期内，乙方自行承担在使用期间的相关费用（水费、电费、燃气费、宽带费、停车费等），乙方可按物业管理机构提供的交费通知单交付。<br>
      &nbsp; （三）在承租期内，乙方自行报装电话、宽带，相关费用由乙方自行承担。
      <br>&nbsp; （四）此合同租金仅含物业费、供暖费，出租车源所产生税费由乙方承担。甲方向乙方提供车主身份证明及车源所有权证复印件，由乙方自行到税务部门开具租房增值税普通发票。<br>
      <b>&nbsp; 第六条  甲方的权利义务</b><br>
      &nbsp;（一）甲方应保证出租车源的建筑结构和设备设施能达到使用要求，不得影响乙方正常使用。
      <br>&nbsp;（二）对于该车源的主要结构、固定管道线路及固定设施（包括制热、制冷、排风、上下水等设施）发生自然损害、故障或合理使用而导致的老化、耗损，乙方应及时通知甲方，由甲方对接本项目物业公司及时修复。
<br>
      &nbsp;<b> 第七条  乙方的权利义务</b><br>
      &nbsp;（一）承租期内，如乙方需要对承租车源进行装修或改动前应获得甲方书面同意，且装修或改动应符合国家相关法律法规规定以及物业管理规定，但乙方不得拆除、破坏承租区域建筑的主体结构。<br>
      &nbsp;（二）由于乙方装修或使用原因，导致房间的主要结构、固定管道线路及设施发生损害、故障乙方须及时修复或照价赔偿。<br>
      &nbsp;<b> 第八条  合同解除</b><br>
      &nbsp;（一）经甲乙双方协商一致，可以解除本合同。<br>
      &nbsp;（二）因不可抗力导致本合同无法继续履行的，本合同自行解除。<br>
      &nbsp;（三）甲方有下列情形之一的，乙方有权单方解除合同：<br>
      &nbsp; 1、交付的车源存在重大安全问题，导致乙方无法正常使用达15个工作日。<br>
      &nbsp; 2、车源主体固定设施严重损坏，致使乙方无法正常使用车源的。<br>
      &nbsp; 3、甲方不具备出租此房权利的。<br>
      &nbsp; 4、甲方提前终止合同的。<br>
      &nbsp;（四）乙方有下列情形之一的，甲方有权单方解除合同并立即收回车源：<br>
      &nbsp; 1、不按照约定支付租金达3日的。<br>
      &nbsp; 2、将车源转租、分租、转借给第三方的。<br>
      &nbsp; 3、从事违法活动或危害公共安全，妨碍他人正常工作生活的。<br>
      &nbsp; 4、擅自拆除或破坏车源建筑主体结构或因乙方装修造成车源重大安全隐患的。<br>
      &nbsp; 5、乙方提前终止合同的。<br>
      &nbsp;<b> 第九条  违约责任</b><br>
      &nbsp;（一）甲方有第八条第（三）款约定的情形之一的，应按2个月租金为标准向乙方支付违约金，同时退还乙方已支付押金及未使用租期租金；乙方有第八条第（四）款约定的情形之一的，应按2个月租金为标准向甲方支付违约金。<br>
      &nbsp;（二）租赁期内，甲方收回车源自用或乙方提前退租应提前3个月通知对方，如未提前通知对方，违约方应向守约方支付两个月房租作为未提前通知的租金补偿，同时乙方应配合甲方带领未来租户看房，本条款与违约责任条款第（一）款同时叠加适用。<br>
      &nbsp;（三）乙方在租赁车源内的工商注册等营业证照，应在租赁期满或合同解除后10日内迁出，逾期未迁出的，乙方须按日向甲方支付租金直至乙方实际将营业证照迁出之日止，甲方退还乙方剩余押金。<br>
      &nbsp;（四）由乙方原因违约本合同提前终止（包含租期结束），乙方须在终止或
      解除日3日内腾空车源并向甲方返还该车源，如乙方未能在3日内自行腾出该车源，甲方有权立即收回车源及钥匙，有权采取换锁、停水停电、阻止人员在承租
      区域进出经营等自我救济行为，同时可将屋内乙方物品清出至室外，甲方不承担
      任何保管及赔偿责任，乙方同意自行承担由此产生的全部后果和责任。<br>
      &nbsp; <b>第十条  送达条款</b><br>
      &nbsp;（一）甲乙双方一致同意，可通过在本合同中书写的手机号码以短信、微信方式进行相关通知的送达，在短信、微信发送成功后即视为完成送达。<br>
      &nbsp;（二）甲乙双方在本合同中书写的地址即为本合同下任何书面通知的有效送达地址，若因接收方拒收或地址错误等情况致使无法送达的，均以付邮日（以邮戳为准）后3日即视为通知方已依本合同给予书面通知。若任何一方联络地址变更的，应及时通知对方。<br>
      &nbsp; <b>第十一条  其他</b><br>
      &nbsp;（一）本合同经甲乙<?php if($model->channel_id!=null) {
                      echo '丙三';

      }else{
            echo '双';
      }?>方签字盖章后生效。本合同（及附件）一式<?php if($model->channel_id!=null) {
                  echo '叁';

      }else{
                  echo '贰';
      }?>份，甲、乙<?php if($model->channel_id!=null) {
                echo '、丙';
      }?>方各持一份。<br>
      &nbsp;（二）本合同生效后，各方对合同内容的变更或补充应采取书面形式，作为本合同的附件。<br>
      &nbsp;<b> 第十二条   补充条款</b><br>
      &nbsp; 以下条款内容与本合同其它各条款具备同等法律效力,若补充条款与本合同不一致或发生冲突时，应以补充条款为准。<br>
      <?php if($model->addition!=null) {?>
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
               ?></u>
      <?php }else {?>
                  <input type="text" name="" disabled style="width:600px;" value="以下空白">
      <?php }?>
      <br><br>
      <b> 出租人（甲方）：<input type="text" name="" style="width:119px;font-size:10px" value="">&nbsp&nbsp承租人（乙方）：<input type="text" name="" style="width:119px;font-size:10px" value=""></b>　<br>
      联系地址：<input type="text" name="" style="width:180px;font-size:10px" value="">&nbsp&nbsp联系地址：<input type="text" name="" style="width:185px" value="">
      <br>联系方式：<input type="text" name="" style="width:180px;" disabled value="400-078-8800">&nbsp&nbsp系方方式：<input type="text" name="" style="width:185px;font-size:10px" value="">
      <br>委托代理人 ：<input type="text" name="" style="width:150px;font-size:10px" value="">&nbsp&nbsp委托代理人：<input type="text" name="" style="width:165px;font-size:10px" value=""><br>
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp年&nbsp&nbsp月&nbsp&nbsp日                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp年&nbsp&nbsp月&nbsp&nbsp日<br><br>
      <?php if($model->channel_id!=null) {?>

          <b> 居间方（丙方）：<input type="text" name="" style="width:119px;font-size:10px" value=""></b><br>
          房地产经纪人：<input type="text" name="" style="width:140px;font-size:10px" value="">
          <br>资质证书号：<input type="text" name="" style="width:160px;font-size:10px" value="">
          <br>联系地址：<input type="text" name="" style="width:180px;font-size:10px" value="">
          <br>联系方式：<input type="text" name="" style="width:180px;font-size:10px" value=""><br>
          &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp年&nbsp&nbsp月&nbsp&nbsp日


      <?php  }?>


    </p>
  </div>
</body>
</html>
