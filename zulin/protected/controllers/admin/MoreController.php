<?php

class MoreController extends Controller
{
  //去除YII自带模板
  public $layout="//layouts/phonelogin.php";


        /**
            *数字大小写转换
        **/
        function daxie($number){
              $number=substr($number,0,2);
              $arr=array("零","一","二","三","四","五","六","七","八","九");
              if(strlen($number)==1){
              $result=$arr[$number];
              }else{
               if($number==10){
                $result="十";
               }else{
                if($number<20){
                $result="十";
                }else{
                $result=$arr[substr($number,0,1)]."十";
                }
                if(substr($number,1,1)!="0"){
                $result.=$arr[substr($number,1,1)];
                }
               }
              }
              return $result;
              }
        /**
        *数字金额转换成中文大写金额的函数
        *String Int $num 要转换的小写数字或小写字符串
        *return 大写字母
        *小数位为两位
        **/

        function num_to_rmb($num){
        $c1 = "零壹贰叁肆伍陆柒捌玖";
        $c2 = "分角元拾佰仟万拾佰仟亿";
        //精确到分后面就不要了，所以只留两个小数位
        $num = round($num, 2);
        //将数字转化为整数
        $num = $num * 100;
        if (strlen($num) > 10) {
            return "金额太大，请检查";
        }
        $i = 0;
        $c = "";
        while (1) {
            if ($i == 0) {
                //获取最后一位数字
                $n = substr($num, strlen($num)-1, 1);
            } else {
                $n = $num % 10;
            }
            //每次将最后一位数字转化为中文
            $p1 = substr($c1, 3 * $n, 3);
            $p2 = substr($c2, 3 * $i, 3);
            if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '元'))) {
                $c = $p1 . $p2 . $c;
            } else {
                $c = $p1 . $c;
            }
            $i = $i + 1;
            //去掉数字最后一位了
            $num = $num / 10;
            $num = (int)$num;
            //结束循环
            if ($num == 0) {
                break;
            }
        }
        $j = 0;
        $slen = strlen($c);
        while ($j < $slen) {
            //utf8一个汉字相当3个字符
            $m = substr($c, $j, 6);
            //处理数字中很多0的情况,每次循环去掉一个汉字“零”
            if ($m == '零元' || $m == '零万' || $m == '零亿' || $m == '零零') {
                $left = substr($c, 0, $j);
                $right = substr($c, $j + 3);
                $c = $left . $right;
                $j = $j-3;
                $slen = $slen-3;
            }
            $j = $j + 3;
        }
        //这个是为了去掉类似23.0中最后一个“零”字
        if (substr($c, strlen($c)-3, 3) == '零') {
            $c = substr($c, 0, strlen($c)-3);
        }
        //将处理的汉字加上“整”
        if (empty($c)) {
            return "零元";
        }else{
            return $c . "";
        }
        }

    //生成网页版单子版合同  出车合同
    public function actionIndex()
    {
          header("Content-Type:text/html;charset=utf-8");
          $contract_id = Yii::app()->request->getParam('id'); //接受打印合同id
          // $contract_id = 'URS-XS-KJ-16060004';
      //开始查询产权人  @param $owner1
          if($contract_id) {
                  $model = CmsPurchaseContract::model()->find("id='$contract_id'");//查询出对应的合同
                  $owner = CmsPurchaseContractOwner::model()->findAll("contract_id= '$contract_id' and type=0");

                  if($owner){
                    $owner1 = '';
                    $len = count($owner);
        						foreach($owner as $key => $value) {
                                    $id = $value['owner_id'];
                                    $owner3 = CmsOwner::model()->find("id='$id'");
                                    if($key+1!=$len) {
                                      $owner1 .= $owner3->name.'/';
                                    }else{
                                      $owner1 .= $owner3->name;
                                    }
            }
          }
          //产权人查询结束

          //承租人  @param $lessee\
          $item = CmsCompany::model()->find("contract_id = '$contract_id'");
          if($model->lessee_type==1) {

                  $lessee = $item->company_name;

          }elseif($model->lessee_type==2) {
            $owner1=CmsPurchaseContractOwner::model()->findAll("contract_id='$model->id' and type=1");
            $owner = '';
                if($owner1){
                    foreach($owner1 as $key => $value){
                        $id=$value['owner_id'];
                        $owner3=CmsOwner::model()->find("id='$id'");
                          if($key==0) {
                            $owner .= $owner3->name;
                          }else {
                              $owner .='/'.$owner3->name;
                          }
                      }
                      $lessee = $owner;
                    }
          }
          //车源地址  @param $address
          // $property_id = CmsPurchaseProperty::model()->find("contract_id='$contract_id'");
          // $property_name = CmsPurchasecontract::model()->find("property_id='$property_id->property_id' and type=0");
          //   $house_property_card_text=explode(",",$property_name->house_property_card_text);
          //   $address = '';
          //   foreach($house_property_card_text as $key=>$value) {
          //           $address = $value;
          //   }
        //车源地址结束

        //车源性质 @param $property_type
        $property_type = CmsProperty::model()->find("id='$property_id->property_id'")->room_type;
        if($property_type==1) {
              $room_type = '轿车';
        }elseif ($property_type==2) {
              $room_type = '客车';
        }elseif($property_type==3) {
              $room_type = 'SUV';
        }elseif($property_type==4) {
              $room_type = '商务';
        }
        //车源面积 $area
        $area = CmsPurchaseProperty::model()->findAll("contract_id = '$contract_id'  ");
        $pur = Contract::purchasecontract($contract_id);
        // var_dump($pur);
        $pur_card = '';
        $address = '';
        //获取收房合同ID
        if($pur!=null) {
          foreach($pur as $k=>$v) {
              if($v->property_card!=null) {
                  $pur_card .= $v->property_card.',';
                }
              if($v->property_address!=null) {
                  $address .= $v->property_address.',';
              }
          }

          if($pur_card!=null) {
                  $pur_card = rtrim($pur_card,',');
          }
        }
        if($address!=null) {
                  $address = rtrim($address,',');
                  $address = str_replace('区','区(县)',$address);

        }
        // var_dump($address);
        // var_dump($pur);
        //房产证编号
        $property_card = '';
        $pro_id = [];
        $areas = '';
        foreach($area as $k=>$v) {
              $areas += $v->area;
        }

        //车源性质 @param $type
        $type = '';
        if($model->room_type==1) {
            $type = '轿车';
        }elseif($model->room_type==2) {
            $type = '客车';
        }elseif($model->room_type==3) {
            $type = 'SUV';
        }elseif($model->room_type==4) {
            $type = '商务';
        }
        //车源性质结束

      //免租期有多个 @param $freelease
      $freelease=CmsPruchaseFreeLease::model()->findAll("contract_id='$model->id' order by start_time");

      $money = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order");

      $num = CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

      // 租期付款

        // var_dump($pur_card);
      $this->render('index',array(
                'pur_card' => $pur_card,
                'model' => $model,
                'lessee' => $lessee,
                'address' => $address,
                'areas' => $areas,
                'room_type' => $room_type,
                'freelease' => $freelease,
                'money' => $money,
                'num' => $num,
      ));

      }

    }
      //生成电子版的收房合同
    public function actionPur() {

          $contract_id = Yii::app()->request->getParam('id');  //接收收房合同Id


          $model = CmsPurchaseContract::model()->find("id='$contract_id'");  //合同信息
          //产权人
          $owner = CmsPurchaseContractOwner::model()->findAll("contract_id= '$contract_id' and type=1");
          if($owner){
            $owner1 = '';
            $len = count($owner);
            foreach($owner as $key => $value) {
                            $id = $value['owner_id'];
                            $owner3 = CmsOwner::model()->find("id='$id'");
                            if($key+1!=$len) {
                              $owner1 .= $owner3->name.'/';
                            }else{
                              $owner1 .= $owner3->name;
                }
            }
          }


                    //车源地址  @param $address
                    $property_id = CmsPurchaseProperty::model()->findAll("contract_id='$contract_id'");
                    $address = '';
                    $property_card = '';
                    foreach($property_id as $k=>$v) {
                          if($v->property_address!=null) {
                            $address .= $v->property_address.',';
                          }
                          if($v->property_card!=null) {
                            $property_card = $v->property_card.',';
                          }
                    }
                  $prperty_card = rtrim($property_card,',');
                  $address = rtrim($address,',');
                  $address = str_replace('区','区(县)',$address);
                  //车源地址结束

                  //车源面积 $area
                  $area = CmsPurchaseProperty::model()->find("contract_id = '$contract_id'  ")->area;

                  //免租期有多个 @param $freelease
                  $freelease=CmsPruchaseFreeLease::model()->findAll("contract_id='$model->id' order by start_time");
                  $money = CmsPurchasePayRule::model()->findAll("contract_id = '$model->id' order by the_order");

                  $num = CmsDepositPay::model()->findAll("contract_id='$model->id' order by end_time");

          $this->render('purcontract',array(
                  'property_card' => $property_card,
                  'model' => $model,
                  'owner1' => $owner1,
                  'address' => $address,
                  'area' => $area,
                  'freelease' => $freelease,
                  'money' => $money,
                  'num' => $num,
          ));

    }
  }
