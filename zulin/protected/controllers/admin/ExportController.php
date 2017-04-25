
<?php

/*
商圈维护
*/

class ExportController extends BackgroundBaseController
{

        //转换数组
      function object2array($object) {
        if (is_object($object)) {
          foreach ($object as $key => $value) {
            $array[$key] = $value;
          }
        }
        else {
          $array = $object;
        }
        return $array;
        }


    public function actionExport(){

        // $model = CmsPurchaseProperty::model()->findAll("deleted=0  order by property_id ");
        $model = CmsPurchaseProperty::model()->findAll("deleted=0 and type=1  order by property_id ");



        $arr = [];

        $arr = array('房间ID'=>array(
	        '品牌'=>'品牌',
	        '系列'=>'系列',
	        '编号'=>'编号',
            '签约日'=>'签约日',
	        // '车主公司'=>'车主公司',
	        // '车主'=>'车主',
	        // '收房代理人'=>'收房代理人',
	        '租户公司'=>'租户公司',
	        '租户签约人'=>'租户签约人',
            '签约人电话'=>'签约人电话',
            '签约人性别'=>'签约人性别',
	        '租户'=>'租户',
            '租户电话'=>'租户电话',
            '租户性别'=>'租户性别',
	        '租户代理人'=>'租户代理人',
            '租户代理人电话'=>'租户代理人电话',
            '租户代理人性别'=>'租户代理人性别',
	        // '地址'=>'地址',
        	));
        foreach ($model as $key => $value) {

                $tmp = Property::allinfo($value['contract_id'])[0];
                $arr[$value['property_id']]['品牌'] = $tmp['estate_name'];
                $arr[$value['property_id']]['系列'] = $tmp['building_name'];
                $arr[$value['property_id']]['编号'] = $tmp['house_no'];
            	$cpc = CmsPurchaseContract::model()->find("id = '$value[contract_id]'");
                $arr[$value['property_id']]['签约日'] = date('Y-m-d',$cpc->signing_date);

            	// $arr[$value['property_id']]['车主公司'] = '';
             //    $arr[$value['property_id']]['车主'] = '';

             //    $arr[$value['property_id']]['收房代理人'] = '';
                $arr[$value['property_id']]['租户公司'] = '';
                $arr[$value['property_id']]['租户签约人'] = '';
                $arr[$value['property_id']]['签约人电话'] = '';
                $arr[$value['property_id']]['签约人性别'] = '';
                $arr[$value['property_id']]['租户'] = '';
                $arr[$value['property_id']]['租户电话'] = '';
                $arr[$value['property_id']]['租户性别'] = '';
                $arr[$value['property_id']]['租户代理人'] = '';
                $arr[$value['property_id']]['租户代理人电话'] = '';
                $arr[$value['property_id']]['租户代理人性别'] = '';
                if($value['type']==0){
                	// $arr[$value['property_id']]['地址'] = $cpc->house_property_card_text;
                }

            // if($value['type']==0){
            //     //根据合同id查出产权人owner_type house_property_card_text
            //     //公司
            //     if($cpc->owner_type ==1){
            //         $cc = CmsCompany::model()->find("contract_id = '$value[contract_id]' ")->company_name;
            //     	$arr[$value['property_id']]['车主公司'] = $cc;

            //     }elseif($cpc->owner_type ==2){
            //     //个人
            //     //
            //         $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$value[contract_id]' and type =1");
            //         $yezhu = '';
            //         foreach ($owner as $key1 => $value1) {
            //         	$yezhu .=CmsOwner::model()->find("id = '$value1->owner_id'")->name.'/';
            //         }

            //         $agent = CmsPurchaseContractOwner::model()->findAll("contract_id = '$value[contract_id]' and type =2");
            //         $dailiren = '';
            //         foreach ($agent as $key2 => $value2) {
            //         	$dailiren .=CmsOwner::model()->find("id = '$value2->owner_id'")->name.'/';
            //         }
            //         $arr[$value['property_id']]['车主'] = $yezhu;
            //         $arr[$value['property_id']]['收房代理人'] = $dailiren;
            //     }

            // }else

            if($value['type']==1){
                //根据合同id查出产权人owner_type
                //公司
                if($cpc->lessee_type ==1){
                    $cc = CmsCompany::model()->find("contract_id = '$value[contract_id]' ")->company_name;
                    $contractor = CmsCompany::model()->find("contract_id = '$value[contract_id]' ");
                    $contractor_phone = CmsCompany::model()->find("contract_id = '$value[contract_id]' ");
                    $arr[$value['property_id']]['租户公司'] = $cc;
                    $arr[$value['property_id']]['租户签约人'] = $contractor->contractor;
                    $arr[$value['property_id']]['签约人电话'] = $contractor->contractor_phone;
                    $arr[$value['property_id']]['签约人性别'] = $contractor->corporation_gender?$contractor->corporation_gender=='f'?'女':'男':'';

                }elseif($cpc->lessee_type ==2){
                //个人
                    $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$value[contract_id]'  and type =1");
                    $yezhu = '';
                    $yezhudianhua ='';
                    $zhxb ='';
                    foreach ($owner as $key3 => $value3) {
                        $yezhu .=CmsOwner::model()->find("id = '$value3->owner_id'")->name.'/';
                        $yezhudianhua .=CmsOwner::model()->find("id = '$value3->owner_id'")->mobile.',';
                    	$zhxb .=CmsOwner::model()->find("id = '$value3->owner_id'")->gender?CmsOwner::model()->find("id = '$value3->owner_id'")->gender=='f'?'女':'男':''.',';

                    }
                    $agent = CmsPurchaseContractOwner::model()->findAll("contract_id = '$value[contract_id]' and type =2");
                    $dailiren = '';
                    $dailirendianhua='';
                    $dlxb ='';
                    foreach ($agent as $key4 => $value4) {
                        $dailiren .=CmsOwner::model()->find("id = '$value4->owner_id'")->name.'/';
                        $dailirendianhua .=CmsOwner::model()->find("id = '$value4->owner_id'")->mobile.',';
                        $dlxb .=CmsOwner::model()->find("id = '$value4->owner_id'")->gender?CmsOwner::model()->find("id = '$value3->owner_id'")->gender=='f'?'女':'男':''.',';
                    }
                    $arr[$value['property_id']]['租户'] = $yezhu;
                    $arr[$value['property_id']]['租户电话'] = $yezhudianhua;
                    $arr[$value['property_id']]['租户性别'] = $zhxb;
                    $arr[$value['property_id']]['租户代理人'] = $dailiren;
                    $arr[$value['property_id']]['租户代理人电话'] = $dailirendianhua;
                    $arr[$value['property_id']]['租户代理人性别'] = $dlxb;

                }
            }

        }

        $excel = new Excel();

        $excel->download($arr,'美霞');

    }

      //应收报表
    public function actionExcelPur() {
          //查询数据的时间段
          $time_start = strtotime($_POST['time_start']);
          $time_end = strtotime($_POST['time_end']);
          if(!$time_start){
              $start_date = time();
          }
          if(!$time_end){
              $end_date = strtotime('+ 1 month ',time());
          }
          $data1 = CmsPurchaseReceivable::model()->findAll(" pay_date >= $time_start  and pay_date  <= $time_end and deleted=0 and type =2   order by pay_date  and contract_id");
          $data2 = CmsPurchaseReceivable::model()->findAll(" pay_date >= $time_start  and pay_date  <= $time_end and deleted=0 and type =1   order by pay_date  and contract_id");
          // var_dump($data2);die();

          $data = array_merge($data1,$data2);

          header("content-type:text/html;charset=utf-8");
          // var_dump(count($data));die();
            if($data!=null) {
                    foreach ($data as $key => $value) {
                      $model = CmsPurchaseContract::model()->find(" id = '$value->contract_id' and type = 1 and deleted =0 and status in (0,-1)");
                        if($model!=null) {
                          $property = Property::allinfo($model->id);
                          $datas[$key][]=$property[0]['estate_name']; //项目名称
                          $house_no ='';
                          foreach ($property as $k => $v) {
                              $house_no .= $v['building_name'].$v['house_no'].'/';
                              // $area += CmsPurchaseProperty::model()->find("contract_id = '$value->id' and property_id = '$v[property_id]' ")->area;
                          }
                          $house_no = str_replace('座','-',$house_no);
                          $house_no = str_replace('号楼','-',$house_no);
                          $datas[$key][]=substr($house_no,0,-1)?substr($house_no,0,-1):''; //编号
                          // var_dump($model->lessee_type);die();
                          if($model->lessee_type==1) {
                              //车主类型为公司
                              $company = CmsCompany::model()->find(" contract_id = '$model->id'");
                              // var_dump($company->company_name);
                              $datas[$key][] = $company->company_name;
                          }elseif ($model->lessee_type==2) {
                              //车主类型为个人
                              $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$model->id' and type=1 ");
                              $tmp = [];
                              foreach ($owner as $ko => $vo) {
                                  $ownername = CmsOwner::model()->find("id = '$vo->owner_id'");
                                  //tmp此处为车主名字的数组集合
                                 $tmp[] = $ownername->name;
                                //  $tmp2[] =$ownername->mobile;
                              }
                              // var_dump($tmp);
                              $owner1 = '';
                              foreach($tmp as $k1=>$v1) {

                                  $owner1 .= $v1.'/';
                              }

                              $datas[$key][] = rtrim($owner1,'/');
                              // $arr[$owner_type->id]['mobile'] =$tmp2;
                            }
                              //付款日
                              $datas[$key][] = date('Y-m-d',$value->pay_date) ;
                              //周期
                              if($value->type==1) {
                                  $datas[$key][] = '押金';
                              }else if($value->type==2) {
                                $datas[$key][] = date("Y-m-d",$value->start_time).'至'.date("Y-m-d",$value->end_time);
                              }
                              //付款方式
                              $datas[$key][]='押'.CmsDepositPay::model()->find("contract_id='$model->id'")->deposit_month.'付'.CmsDepositPay::model()->find("contract_id='$model->id'")->pay_month; //面积
                              //应收房租
                              $datas[$key][] = $value->amount/100;

                              //月租金
                              if($value->type==1) {
                                //押金
                                if($data->the_order ==0){
                                    $datas[$key][] = $model->deposit/100;
                                }else{
                                    $datas[$key][] = 0;
                                }
                              }else if($value->type==2) {
                                    $datas[$key][] = $value->amount/100/CmsDepositPay::model()->find("contract_id='$model->id'")->pay_month;
                              }
                              //户名
                              $datas[$key][] = $model->payee;
                              //银行账户
                              $str = $model['bank_account'];
                                 preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/', $str,$match);
                                 unset($match[0]);
                              $datas[$key][] = $model['bank'];
                              //账号
                              $datas[$key][] = implode(' ', $match);

                          }
                        }

            }



                      // $datas[$key][]=$area; //面积
                      ;
                      // $datas[$key][]=CmsPurchasePayRule::model()->find("contract_id='$value->id'")->price_per_meter/100; //单价
                      // $datas[$key][]=CmsPurchasePayRule::model()->find("contract_id='$value->id'")->monthly_rent/100; //月租金

                      //付款日



                          // 创建一个excel
                          $objPHPExcel = new PHPExcel();
                          // Set document properties
                          $objPHPExcel->getProperties()->setCreator("liyuequn")->setLastModifiedBy("liyuequn")->setTitle("base_contract")->setSubject("base_contract")->setDescription("base_contract")->setKeywords("基础数据")->setCategory("综合支持");
                          $objPHPExcel->setActiveSheetIndex(0)
                              ->setCellValue('A1', '项目名称')
                              ->setCellValue('B1', '编号')
                              ->setCellValue('C1', '租户')
                              ->setCellValue('D1', '付款日')
                              ->setCellValue('E1', '周期')
                              ->setCellValue('F1', '付款方式')
                              ->setCellValue('G1', '应收房租')
                              ->setCellValue('H1', '月租金')
                              ->setCellValue('I1', '户名')
                              ->setCellValue('J1', '收款银行')
                              ->setCellValue('K1', '账号')
                          ;

                          // Rename worksheet
                          $objPHPExcel->getActiveSheet()->setTitle('应收表-' . date('Y-m-d'));
                          // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                          $objPHPExcel->setActiveSheetIndex(0);
                          $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
                          $objPHPExcel->getActiveSheet()->freezePane('A2');
                          $i = 2;


                          foreach($datas as $data){
                              $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[0])->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                              $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[1]);
                              $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[2]);
                              $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'. $i, $data[3],PHPExcel_Cell_DataType::TYPE_STRING);
                              $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

                              // 设置文本格式
                              $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'. $i, $data[4],PHPExcel_Cell_DataType::TYPE_STRING);
                              $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
                              $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[5]);
                              $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[6]);
                              $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[7]);
                              $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $data[8]);
                              $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $data[9]);
                              $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $data[10]);
                              $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $data[11]);
                              $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $data[12]);

                              $i++ ;
                          }
                          $objActSheet = $objPHPExcel->getActiveSheet();

                          // 设置CELL填充颜色
                          $cell_fill = array(
                            'A1',
                            'B1',
                            'C1',
                            'D1',
                            'E1',
                            'F1',
                            'G1',
                            'H1',
                            'I1',
                            'J1',
                            'K1',
                            'L1',
                            'M1',
                          );
                          foreach($cell_fill as $cell_fill_val){
                              $cellstyle = $objActSheet->getStyle($cell_fill_val);
                              // background
                              // $cellstyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('fafa00');
                              // set align
                              $cellstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                              // font
                              $cellstyle->getFont()->setSize(12)->setBold(true);
                              // border
                              $cellstyle->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                              $cellstyle->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                              $cellstyle->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                              $cellstyle->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                          }

                          $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

                          $objActSheet->getColumnDimension('A')->setWidth(18.5);
                          $objActSheet->getColumnDimension('B')->setWidth(23.5);
                          $objActSheet->getColumnDimension('C')->setWidth(12);
                          $objActSheet->getColumnDimension('D')->setWidth(12);
                          $objActSheet->getColumnDimension('E')->setWidth(12);
                          $objActSheet->getColumnDimension('F')->setWidth(12);
                          $objActSheet->getColumnDimension('G')->setWidth(24);
                          $objActSheet->getColumnDimension('H')->setWidth(24);
                          $objActSheet->getColumnDimension('I')->setWidth(12);
                          $objActSheet->getColumnDimension('J')->setWidth(12);
                          $objActSheet->getColumnDimension('k')->setWidth(12);
                          $objActSheet->getColumnDimension('L')->setWidth(12);
                          $objActSheet->getColumnDimension('M')->setWidth(12);

                          $filename = '2015030423';
                          ob_end_clean();//清除缓冲区,避免乱码
                          header('Content-Type: application/vnd.ms-excel');
                          header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
                          header('Cache-Control: max-age=0');
                          // If you're serving to IE 9, then the following may be needed
                          header('Cache-Control: max-age=1');
                          // If you're serving to IE over SSL, then the following may be needed
                          header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                          header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                          header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                          header('Pragma: public'); // HTTP/1.0
                          $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
                          $objWriter->save('php://output');

    }
    //销售基础数据
    public function actionExcel(){

        // $datas = array(
        //     array('王城', '男', '18', '1997-03-13', '18948348924'),
        //     array('李飞虹', '男', '21', '1994-06-13', '159481838924'),
        //     array('王芸', '女', '18', '1997-03-13', '18648313924'),
        //     array('郭瑞', '男', '17', '1998-04-13', '15543248924'),
        //     array('李晓霞', '女', '19', '1996-06-13', '18748348924'),
        // );

        //查询出所需要的数据
        $time_start = strtotime($_POST['time_start']) ;
        $time_end   = strtotime($_POST['time_end']);

        $model = CmsPurchaseContract::model()->findAll("deleted=0 and signing_date >=$time_start and signing_date <=$time_end and type =1");
        header("Content-type: text/html; charset=utf-8");
        if(!$model){
            $warning='<script>alert("选定的日期内没有可以导出的对象")</script>';die;
        }

        foreach ($model as $key => $value) {
            $property = Property::allinfo($value->id);
            $datas[$key][]=$property[0]['estate_name']; //项目名称
            $house_no ='';
            $area =0;
            foreach ($property as $k => $v) {
                $house_no .= $v['building_name'].$v['house_no'].'/';

                $area += CmsPurchaseProperty::model()->find("contract_id = '$value->id' and property_id = '$v[property_id]' ")->area;

            }
            $datas[$key][]=substr($house_no,0,-1)?substr($house_no,0,-1):'';; //编号
            $datas[$key][]=$area; //面积
            ;
            $datas[$key][]=CmsPurchasePayRule::model()->find("contract_id='$value->id'")->price_per_meter/100; //单价
            $datas[$key][]=CmsPurchasePayRule::model()->find("contract_id='$value->id'")->monthly_rent/100; //月租金
            $datas[$key][]='押'.CmsDepositPay::model()->find("contract_id='$value->id'")->deposit_month.'付'.CmsDepositPay::model()->find("contract_id='$value->id'")->pay_month; //面积
            $datas[$key][]=date('Y-m-d',$value->lease_term_start).'至'.date('Y-m-d',$value->lease_term_end);
            $freelease=CmsPruchaseFreeLease::model()->find("contract_id='$value->id'");
            $datas[$key][]=date('Y-m-d',$freelease->start_time).'至'.date('Y-m-d',$freelease->end_time);//免租期
            $datas[$key][]=$value->signing_date?date('Y-m-d',$value->signing_date):"";
            $CmsContractSigner = CmsContractSigner::model()->findAll("contract_id = '$value->id' and deleted=0 ");
            $signer = '';
            foreach ($CmsContractSigner as $k2 => $v2) {
                $signer .= AdminUser::model()->find(array(
                    'select'=>'nickname',
                    'condition'=>"id = '$v2->signer'"
                    ))->nickname.'、';
            }

            $datas[$key][]=substr($signer,0,-3)?substr($signer,0,-3):'';//签约人
            $datas[$key][]='';//签约人

            //根据合同id查出产权人owner_type
            //公司
            $name='';
            $phone='';
            if($value->lessee_type ==1){
                $cc = CmsCompany::model()->find("contract_id = '$value->id' ")->company_name;
                $contractor = CmsCompany::model()->find("contract_id = '$value->id' ");
                $contractor_phone = CmsCompany::model()->find("contract_id = '$value->id' ");
                $name = $contractor->contractor;
                $phone = $contractor->contractor_phone;
                $datas[$key][]=$name;//签约人
                $datas[$key][]=$phone;//签约人

            }elseif($value->lessee_type ==2){
            //个人
                $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$value->id' and type =1");
                foreach ($owner as $key3 => $value3) {
                    $name .=CmsOwner::model()->find("id = '$value3->owner_id'")->name;
                    $phone .=CmsOwner::model()->find("id = '$value3->owner_id'")->mobile;

                }
                $datas[$key][]=$name;//签约人
                $datas[$key][]=$phone;//签约人

            }

        }


        // 创建一个excel
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("liyuequn")->setLastModifiedBy("liyuequn")->setTitle("base_contract")->setSubject("base_contract")->setDescription("base_contract")->setKeywords("基础数据")->setCategory("综合支持");
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '项目名称')
            ->setCellValue('B1', '编号')
            ->setCellValue('C1', '面积')
            ->setCellValue('D1', '单价')
            ->setCellValue('E1', '月租金')
            ->setCellValue('F1', '付款方式')
            ->setCellValue('G1', '签约年限')
            ->setCellValue('H1', '免租期')
            ->setCellValue('I1', '签约日期')
            ->setCellValue('J1', '销售签约人')
            ->setCellValue('K1', '部门负责人')
            ->setCellValue('L1', '客户姓名')
            ->setCellValue('M1', '客户电话')
        ;

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('工程对接-' . date('Y-m-d'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
        $objPHPExcel->getActiveSheet()->freezePane('A2');
        $i = 2;


        foreach($datas as $data){
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[0])->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[1]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[2]);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'. $i, $data[3],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

            // 设置文本格式
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'. $i, $data[4],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[5]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[6]);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[7]);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $data[8]);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $data[9]);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $data[10]);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $data[11]);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $data[12]);

            $i++ ;
        }
        $objActSheet = $objPHPExcel->getActiveSheet();

        // 设置CELL填充颜色
        $cell_fill = array(
          'A1',
          'B1',
          'C1',
          'D1',
          'E1',
          'F1',
          'G1',
          'H1',
          'I1',
          'J1',
          'K1',
          'L1',
          'M1',
        );
        foreach($cell_fill as $cell_fill_val){
            $cellstyle = $objActSheet->getStyle($cell_fill_val);
            // background
            // $cellstyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('fafa00');
            // set align
            $cellstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            // font
            $cellstyle->getFont()->setSize(12)->setBold(true);
            // border
            $cellstyle->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
        }

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $objActSheet->getColumnDimension('A')->setWidth(18.5);
        $objActSheet->getColumnDimension('B')->setWidth(23.5);
        $objActSheet->getColumnDimension('C')->setWidth(12);
        $objActSheet->getColumnDimension('D')->setWidth(12);
        $objActSheet->getColumnDimension('E')->setWidth(12);
        $objActSheet->getColumnDimension('F')->setWidth(12);
        $objActSheet->getColumnDimension('G')->setWidth(24);
        $objActSheet->getColumnDimension('H')->setWidth(24);
        $objActSheet->getColumnDimension('I')->setWidth(12);
        $objActSheet->getColumnDimension('J')->setWidth(12);
        $objActSheet->getColumnDimension('k')->setWidth(12);
        $objActSheet->getColumnDimension('L')->setWidth(12);
        $objActSheet->getColumnDimension('M')->setWidth(12);

        $filename = '2015030423';
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');

    }

    //销控表的导出
    public function actionSaleControll()
    {

        $model = UrsSalesControl::model()->findAll("deleted=0 order by live_date desc ");
        header("Content-type: text/html; charset=utf-8");
        foreach ($model as $key => $value) {
            $datas[$key][]= Property::estate($value->property_id); //项目名称
            $building = Property::building($value->property_id);

            //字符串替换，"座、号楼"都替换成"-",独栋替换成空

            $building =str_replace('座', '-', $building);
            $building =str_replace('号楼', '-', $building);
            $building =str_replace('独栋', '', $building);

            $datas[$key][]=$building.Property::house_no($value->property_id); //编号
            $datas[$key][]=$value->area; //面积
            $datas[$key][]=$value->unit_price/100; //单价
            $datas[$key][]=round($value->unit_price/100*$value->area*365/12,2); //月租金
            $datas[$key][]= CmsProperty::model()->find("id='$value->property_id'")->orientation; //朝向

            $res_actual_date=SerPurContract::model()->find("contract_id='$value->contract_id' and deleted='0'")['actual_date'];
            if(!$res_actual_date){
                $res_actual_date=CmsPurchaseContract::model()->find("id='$value->contract_id'")['the_date'];
            }

            $json = UrsGoodsDetail::model()->find("contract_id = '$value->contract_id' and property_id ='$value->property_id' and deleted=0 ")->json;
            $item = json_decode($json);

            if(!$res_actual_date){
                $check= 1;
                foreach ($item as $key_item => $value_item) {
                    if($check == 1){
                        $key_item = explode('-',$key_item);
                        $value_item_one = explode(',',$value_item);
                    }
                    $check++;
                }
                if($value_item_one){
                    foreach ($value_item_one as $key_s => $value_s) {
                        $goods = UrsGoodsStorage::model()->find("id = '$value_s'");
                        $datas[$key][].= $goods['goods_name'].'('.$goods['goods_unit'].')' ."\n"; //礼品
                    }
                }

                unset($value_item_one);
                unset($check);
            }else{
                $data_set = ceil((time()-$res_actual_date)/(24*60*60));
                    $check= 1;
                    foreach ($item as $key_item => $value_item) {
                        if($check == 1){
                            $key_item = explode('-',$key_item);
                            $value_item_one = explode(',',$value_item);
                        }else{
                            $key_item = explode('-',$key_item);
                            if($key_item[0] <= $data_set && $key_item[1] >= $data_set){
                                $value_items = explode(',',$value_item);
                            }
                        }
                        $check++;
                    }
                    $value_items = $value_items ? $value_items : $value_item_one;
                    if($value_items){
                        foreach ($value_items as $key_s => $value_s) {
                            $goods = UrsGoodsStorage::model()->find("id = '$value_s'");
                            $datas[$key][].= $goods['goods_name'].'('.$goods['goods_unit'].')' ."\n"; //礼品

                        }
                    }
                    unset($value_items);
                    unset($value_item_one);
            }

            $mode=CmsPurchaseContract::model()->find("id='$value->contract_id' and deleted=0 and status in (0,-1)");
            $time=time();
            if($value->sales_type==2) {
                if(($value->live_date+9*24*60*60-$time)>=0){$warning='荣誉房';}else if(($value->live_date+20*24*60*60-$time)>=0 &&($value->live_date+9*24*60*60-$time)<=0 ){ $warning='快销房';}else if(($value->live_date+35*24*60*60-$time)>=0 &&($value->live_date+20*24*60*60-$time)<=0 ){ $warning='风险房';}else if(($value->live_date+35*24*60*60-$time)<=0){ $warning='亏损房';}
                $warning_day = (time()-$value->live_date)/(24*60*60);
            }

            $datas[$key][]= $warning;//出车预警
            //把人名的逗号换成换行
            $value->name = rtrim($value->name,',');
            $value->name = str_replace(',',"\n",$value->name);
            $datas[$key][]= $value->name;//负责人
            //把联系方式的逗号换成换行
            $value->phone = rtrim($value->phone,',');
            $value->phone = str_replace(',',"\n",$value->phone);
            $datas[$key][]= $value->phone;//联系方式
            $estate_id = CmsProperty::model()->find("id= '$value->property_id'")->estate_id;
            $type = BaseEstate::model()->find("id='$estate_id'")->type;
            $datas[$key][]= 'A'.$type;//项目属性
            $signing_date = Property::PurchaseContractNow($value->property_id)->signing_date;
            $datas[$key][]= $signing_date?date('Y.m.d',$signing_date):'';//收购签约日
            $contract_id = Property::PurchaseContractNow($value->property_id)->id;

            $start_time = CmsPruchaseFreeLease::model()->find("contract_id = '$contract_id'")->start_time;
            $datas[$key][]= $start_time?date('Y.m.d',$start_time):'';//收购免租起始日
            $end_time     =CmsPruchaseFreeLease::model()->find("contract_id = '$contract_id'")->end_time;
            $datas[$key][]=$end_time?date('Y.m.d',$end_time):'' ;//收购免租结束日
            $datas[$key][]=(int)$warning_day;//出车预警天数
            $live_date = UrsSalesControl::model()->find("contract_id = '$contract_id'")->live_date;
            $datas[$key][]= $live_date?date('Y.m.d',$live_date):'' ;//收房日==销控的可入住日期
            $time =time();
            $purchaseprice = CmsPurchasePayRule::model()->find("contract_id = '$contract_id' and start_time < $time and end_time > $time")->price_per_meter/100;
            $first_purchaseprice = CmsPurchasePayRule::model()->find("contract_id = '$contract_id' order by start_time")->price_per_meter/100;
            $datas[$key][]=$purchaseprice?$purchaseprice:$first_purchaseprice; //收购单价
            $datas[$key][]= UrsPropertyDetail::model()->find("contract_id = '$contract_id'")->base_price/100;//销售底价
            $datas[$key][]= round(UrsPropertyDetail::model()->find("contract_id = '$contract_id'")->base_price/100*$value->area*365/12,2);//销售底价月租
            $datas[$key][]= Property::area($value->property_id);//区域

            $decoration=UrsPropertyDetail::model()->arr();

            $datas[$key][]=  $decoration['decoration_status'][UrsDecorationFollow::model()->find("property_id = '$value->property_id'")->decoration_status];//装修状态

        }
        foreach ($datas as $key => $value) {
            $new_datas[$value[8]][]=$value;
        }
        ksort($new_datas);
        $newarr=[];
        foreach ($new_datas as $key => $value) {
            foreach ($value as $k1 => $v1) {
                array_push($newarr,$v1);
            }
        }
        $datas =$newarr;

        // 创建一个excel
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("liyuequn")->setLastModifiedBy("liyuequn")->setTitle("base_contract")->setSubject("base_contract")->setDescription("base_contract")->setKeywords("基础数据")->setCategory("综合支持");
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '项目名称')
            ->setCellValue('B1', '编号')
            ->setCellValue('C1', '面积')
            ->setCellValue('D1', '单价')
            ->setCellValue('E1', '月租金')
            ->setCellValue('F1', '朝向')
            ->setCellValue('G1', '礼品1')
            ->setCellValue('H1', '礼品2')
            ->setCellValue('I1', '预警')
            ->setCellValue('J1', '负责人')
            ->setCellValue('K1', '联系方式')
            ->setCellValue('L1', '项目属性')
            ->setCellValue('M1', '收购签约日')
            ->setCellValue('N1', '免租起始日')
            ->setCellValue('O1', '免租结束日')
            ->setCellValue('P1', '预警天数')
            ->setCellValue('Q1', '客服销售收房日')
            ->setCellValue('R1', '收购单价')
            ->setCellValue('S1', '销售底价')
            ->setCellValue('T1', '销售底价房租')
            ->setCellValue('U1', '区域')
            ->setCellValue('V1', '装修状态')
        ;

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('销控-' . date('Y-m-d'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
        $objPHPExcel->getActiveSheet()->freezePane('A2');
        $i = 2;


        foreach($datas as $data){
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[0])->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[1]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[2]);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'. $i, $data[3],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

            // 设置文本格式
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'. $i, $data[4],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[5]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[6]);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[7]);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $data[8]);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, "$data[9]");
            $objPHPExcel->getActiveSheet()->getStyle('J' . $i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $data[10]);
            $objPHPExcel->getActiveSheet()->getStyle('K' . $i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $data[11]);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $data[12]);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $data[13]);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $data[14]);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $data[15]);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $data[16]);
            $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $data[17]);
            $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $data[18]);
            $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $data[19]);
            $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $data[20]);
            $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $data[21]);

            $i++ ;
        }
        $objActSheet = $objPHPExcel->getActiveSheet();

        // 设置CELL填充颜色
        $cell_fill = array(
          'A1',
          'B1',
          'C1',
          'D1',
          'E1',
          'F1',
          'G1',
          'H1',
          'I1',
          'J1',
          'K1',
          'L1',
          'M1',
          'N1',
          'O1',
          'P1',
          'Q1',
          'R1',
          'S1',
          'T1',
          'U1',
          'V1',
        );
        foreach($cell_fill as $cell_fill_val){
            $cellstyle = $objActSheet->getStyle($cell_fill_val);
            // background
            // $cellstyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('fafa00');
            // set align
            $cellstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            // font
            $cellstyle->getFont()->setSize(12)->setBold(true);
            // border
            $cellstyle->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
        }

        // $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

        $objActSheet->getColumnDimension('A')->setWidth(18.5);
        $objActSheet->getColumnDimension('B')->setWidth(23.5);
        $objActSheet->getColumnDimension('C')->setWidth(12);
        $objActSheet->getColumnDimension('D')->setWidth(12);
        $objActSheet->getColumnDimension('E')->setWidth(12);
        $objActSheet->getColumnDimension('F')->setWidth(12);
        $objActSheet->getColumnDimension('G')->setWidth(24);
        $objActSheet->getColumnDimension('H')->setWidth(24);
        $objActSheet->getColumnDimension('I')->setWidth(12);
        $objActSheet->getColumnDimension('J')->setWidth(12);
        $objActSheet->getColumnDimension('k')->setWidth(12);
        $objActSheet->getColumnDimension('L')->setWidth(12);
        $objActSheet->getColumnDimension('M')->setWidth(12);
        $objActSheet->getColumnDimension('N')->setWidth(12);
        $objActSheet->getColumnDimension('O')->setWidth(12);
        $objActSheet->getColumnDimension('P')->setWidth(12);
        $objActSheet->getColumnDimension('Q')->setWidth(12);
        $objActSheet->getColumnDimension('R')->setWidth(12);
        $objActSheet->getColumnDimension('S')->setWidth(12);
        $objActSheet->getColumnDimension('T')->setWidth(12);
        $objActSheet->getColumnDimension('U')->setWidth(12);
        $objActSheet->getColumnDimension('V')->setWidth(12);

        $filename = date('Ymd',time()).'销控';
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');
    }

    //销售人员的日业绩表
    public function actionSaleScore(){

      //查询出所需要的数据
      $time_start = $_POST['time_start'];
      $time_end   = $_POST['time_end'];

      $datasobj = WechatFollow::model()->findAll(" ctime> '$time_start' and ctime <'$time_end' order by district");
      if(empty($datasobj)){
        echo '<script>alert("选定的日期内没有可以导出的对象")</script>';
        // $this->redirect($_SERVER['HTTP_REFERER']);
        die;
      }
      $arr = [1=>'大望路慈云寺',2=>'朝阳门东直门',3=>'三里屯三元桥',4=>'CBD崇文门',5=>'CBD核心建国门'];

      foreach ($datasobj as $key => $value) {
        $datas[]=$value->attributes;
        unset($datas[$key]['id']);
        unset($datas[$key]['remark']);
        unset($datas[$key]['ctime']);
        unset($datas[$key]['url']);
        $user = Validation::model()->find("openid = '$value->openid'")->account;
        $datas[$key][user] = AdminUser::model()->find("account = '$user'")->nickname;
        $datas[$key][area] = $arr[$value->district];

      }


        // 创建一个excel
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("liyuequn")->setLastModifiedBy("liyuequn")->setTitle("saleScore")->setSubject("saleScore")->setDescription("saleScore")->setKeywords("销售每日报表")->setCategory("综合支持");
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '发起人姓名')
            ->setCellValue('C1', '发起人部门')
            ->setCellValue('D1', '选择组团')
            ->setCellValue('E1', '每日标识负责项目渠道')
            ->setCellValue('F1', '每日标识组团渠道')
            ->setCellValue('G1', '每日标识区域渠道')
            ->setCellValue('H1', '每日标识大区渠道')
            ->setCellValue('I1', '每日标识其它渠道')
            ->setCellValue('J1', '每日添加新增渠道数量')
            ->setCellValue('K1', '微信通讯录渠道总数')
            ->setCellValue('L1', '每日电话咨询量')
            ->setCellValue('M1', '今日首次-带看量汇总')
            ->setCellValue('N1', '今日复看-带看量汇总')
            ->setCellValue('O1', '今日金融公司带看量')
            ->setCellValue('P1', '今日金融公司带看比例')
            ->setCellValue('Q1', '今日约见-面积汇总')
            ->setCellValue('R1', '今日约见-套数汇总')
            ->setCellValue('S1', '今日意向客户')
            ->setCellValue('T1', '签约面积')
            ->setCellValue('U1', '签约套数')
        ;

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('销售每日报表-' . date('Y-m-d'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
        $objPHPExcel->getActiveSheet()->freezePane('A2');
        $i = 2;


        foreach($datas as $data){

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[0])->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[user]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[area]);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'. $i, $data[group],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

            // 设置文本格式
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'. $i, $data[project_channel],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[group_channel]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[estate_channel]);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[big_channel]);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $data[other_channel]);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $data[new_channel_num]);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $data[wechat_channel_num]);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $data[phone_num]);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $data[look_one_num]);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $data[look_two_num]);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $data[14]);
            $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $data[15]);
            $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $data[meet_area_num]);
            $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $data[meet_muit_num]);
            $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $data[client]);
            $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $data[sign_area]);
            $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $data[sign_muit]);

            $i++ ;
        }
        $objActSheet = $objPHPExcel->getActiveSheet();

        // 设置CELL填充颜色
        $cell_fill = array(
          'A1',
          'B1',
          'C1',
          'D1',
          'E1',
          'F1',
          'G1',
          'H1',
          'I1',
          'J1',
          'K1',
          'L1',
          'M1',
          'N1',
          'O1',
          'P1',
          'Q1',
          'R1',
          'S1',
          'T1',
          'U1',
        );
        foreach($cell_fill as $cell_fill_val){
            $cellstyle = $objActSheet->getStyle($cell_fill_val);
            // background
            // $cellstyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('fafa00');
            // set align
            $cellstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            // font
            $cellstyle->getFont()->setSize(12)->setBold(true);
            // border
            $cellstyle->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
        }

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $objActSheet->getColumnDimension('A')->setWidth(12);
        $objActSheet->getColumnDimension('B')->setWidth(12);
        $objActSheet->getColumnDimension('C')->setWidth(12);
        $objActSheet->getColumnDimension('D')->setWidth(12);
        $objActSheet->getColumnDimension('E')->setWidth(12);
        $objActSheet->getColumnDimension('F')->setWidth(12);
        $objActSheet->getColumnDimension('G')->setWidth(12);
        $objActSheet->getColumnDimension('H')->setWidth(12);
        $objActSheet->getColumnDimension('I')->setWidth(12);
        $objActSheet->getColumnDimension('J')->setWidth(12);
        $objActSheet->getColumnDimension('k')->setWidth(12);
        $objActSheet->getColumnDimension('L')->setWidth(12);
        $objActSheet->getColumnDimension('M')->setWidth(12);
        $objActSheet->getColumnDimension('N')->setWidth(12);
        $objActSheet->getColumnDimension('O')->setWidth(12);
        $objActSheet->getColumnDimension('P')->setWidth(12);
        $objActSheet->getColumnDimension('Q')->setWidth(12);
        $objActSheet->getColumnDimension('R')->setWidth(12);
        $objActSheet->getColumnDimension('S')->setWidth(12);
        $objActSheet->getColumnDimension('T')->setWidth(12);

        $filename = date("y-m-d",time());
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');
    }

    public function actionClientFollow(){

      //查询出所需要的数据
      $time_start = $_POST['time_start'];
      $time_end   = $_POST['time_end'];

      $datasobj = ClientFollow::model()->findAll(" ctime> '$time_start' and ctime <'$time_end' order by ctime");

      $arr = [1=>'大望路慈云寺',2=>'朝阳门东直门',3=>'三里屯三元桥',4=>'CBD崇文门',5=>'CBD核心建国门'];

      if(empty($datasobj)){
        echo '<script>alert("选定的日期内没有可以导出的对象")</script>';die;
      }


      foreach ($datasobj as $key => $value) {
        $datas[]=$value->attributes;
        $user = Validation::model()->find("openid = '$value->openid'")->account;
        $datas[$key][user] = AdminUser::model()->find("account = '$user'")->nickname;
        $wechatFollow =  WechatFollow::model()->find("id ='$value->follow_id'");
        $datas[$key][district] = $arr[$wechatFollow->district];
        $datas[$key][property] = Property::estate($value->property_id).Property::building($value->property_id).Property::house_no($value->property_id);
        $datas[$key][remark] = $wechatFollow->remark;

      }
      foreach ($datas as $key => $value) {
        $newdata[$value[district]][] = $value;
      }
      ksort($newdata);
      $newarr = [];
      foreach ($newdata as $key => $value) {
          foreach ($value as $k1 => $v1) {
              array_push($newarr,$v1);
          }
      }
      $datas = $newarr;

        // 创建一个excel
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("liyuequn")->setLastModifiedBy("liyuequn")->setTitle("saleScore")->setSubject("saleScore")->setDescription("saleScore")->setKeywords("销售每日报表")->setCategory("综合支持");
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '发起人部门')
            ->setCellValue('B1', '带看房间')
            ->setCellValue('C1', '面积/㎡')
            ->setCellValue('D1', '经纪公司')
            ->setCellValue('E1', '联系人')
            ->setCellValue('F1', '电话')
            ->setCellValue('G1', '客户业态')
            ->setCellValue('H1', '预算')
            ->setCellValue('I1', '是否二看')
            ->setCellValue('J1', '意向客户项目编号')
            ->setCellValue('K1', '是否负责人')
            ->setCellValue('L1', '订房时间')
            ->setCellValue('M1', '跟进情况')
            ->setCellValue('N1', '幼狮对接人')
            ->setCellValue('O1', '备注')
        ;

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('销售每日报表-' . date('Y-m-d'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
        $objPHPExcel->getActiveSheet()->freezePane('A2');
        $i = 2;


        foreach($datas as $data){

            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[district])->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[property]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[area]);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'. $i, $data[company],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

            // 设置文本格式
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'. $i, $data[linkman],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[phone]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[format]);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[budget]);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $data[two_see]);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $data[house_no]);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $data[prineinal]);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $data[order_time]);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $data[follow_info]);
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $data[urs_people]);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $data[remark]);

            $i++ ;
        }
        $objActSheet = $objPHPExcel->getActiveSheet();

        // 设置CELL填充颜色
        $cell_fill = array(
          'A1',
          'B1',
          'C1',
          'D1',
          'E1',
          'F1',
          'G1',
          'H1',
          'I1',
          'J1',
          'K1',
          'L1',
          'M1',
          'N1',
          'O1',
        );
        foreach($cell_fill as $cell_fill_val){
            $cellstyle = $objActSheet->getStyle($cell_fill_val);
            // background
            // $cellstyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('fafa00');
            // set align
            $cellstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            // font
            $cellstyle->getFont()->setSize(12)->setBold(true);
            // border
            $cellstyle->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
        }

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $objActSheet->getColumnDimension('A')->setWidth(12);
        $objActSheet->getColumnDimension('B')->setWidth(12);
        $objActSheet->getColumnDimension('C')->setWidth(12);
        $objActSheet->getColumnDimension('D')->setWidth(12);
        $objActSheet->getColumnDimension('E')->setWidth(12);
        $objActSheet->getColumnDimension('F')->setWidth(12);
        $objActSheet->getColumnDimension('G')->setWidth(12);
        $objActSheet->getColumnDimension('H')->setWidth(12);
        $objActSheet->getColumnDimension('I')->setWidth(12);
        $objActSheet->getColumnDimension('J')->setWidth(12);
        $objActSheet->getColumnDimension('k')->setWidth(12);
        $objActSheet->getColumnDimension('L')->setWidth(12);
        $objActSheet->getColumnDimension('M')->setWidth(12);
        $objActSheet->getColumnDimension('N')->setWidth(12);
        $objActSheet->getColumnDimension('O')->setWidth(12);


        $filename = 'ClientFollow'.date("y-m-d",time());
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');

    }

    public function actionPurchaseExcel(){

        // $datas = array(
        //     array('王城', '男', '18', '1997-03-13', '18948348924'),
        //     array('李飞虹', '男', '21', '1994-06-13', '159481838924'),
        //     array('王芸', '女', '18', '1997-03-13', '18648313924'),
        //     array('郭瑞', '男', '17', '1998-04-13', '15543248924'),
        //     array('李晓霞', '女', '19', '1996-06-13', '18748348924'),
        // );

        //查询出所需要的数据
        // $time_start = strtotime($_POST['time_start']) ;
        // $time_end   = strtotime($_POST['time_end']);
        $time_start = strtotime('2017-01-1');
        $time_end = strtotime('2017-01-2');



        $model = CmsPurchaseContract::model()->findAll("deleted=0 and signing_date >=$time_start and signing_date <=$time_end and type =0");
        header("Content-type: text/html; charset=utf-8");
        if(!$model){
            $warning='<script>alert("选定的日期内没有可以导出的对象")</script>';die;
        }

        foreach ($model as $key => $value) {
            $property = Property::allinfo($value->id);
            $datas[$key][]=$property[0]['estate_name']; //项目名称
            $house_no ='';
            $area =0;
            foreach ($property as $k => $v) {
                $house_no .= $v['building_name'].$v['house_no'].'/';

                $area += CmsPurchaseProperty::model()->find("contract_id = '$value->id' and property_id = '$v[property_id]' ")->area;

            }
            $datas[$key][]=substr($house_no,0,-1)?substr($house_no,0,-1):'';; //编号
            $datas[$key][]=$area; //面积
            ;
            $datas[$key][]=CmsPurchasePayRule::model()->find("contract_id='$value->id'")->price_per_meter/100; //单价
            $datas[$key][]=CmsPurchasePayRule::model()->find("contract_id='$value->id'")->monthly_rent/100; //月租金
            $datas[$key][]='押'.CmsDepositPay::model()->find("contract_id='$value->id'")->deposit_month.'付'.CmsDepositPay::model()->find("contract_id='$value->id'")->pay_month; //面积
            $datas[$key][]=date('Y-m-d',$value->lease_term_start).'至'.date('Y-m-d',$value->lease_term_end);
            $freelease=CmsPruchaseFreeLease::model()->find("contract_id='$value->id'");//此处免租期，暂时先取第一条数据
            $datas[$key][]=date('Y-m-d',$freelease->start_time).'至'.date('Y-m-d',$freelease->end_time);//免租期
            $datas[$key][]=$value->signing_date?date('Y-m-d',$value->signing_date):"";
            $CmsContractSigner = CmsContractSigner::model()->findAll("contract_id = '$value->id' and deleted=0 ");
            $signer = '';
            foreach ($CmsContractSigner as $k2 => $v2) {
                $signer .= AdminUser::model()->find(array(
                    'select'=>'nickname',
                    'condition'=>"id = '$v2->signer'"
                    ))->nickname.'、';
            }

            $datas[$key][]=substr($signer,0,-3)?substr($signer,0,-3):'';//签约人
            $datas[$key][]='';//签约人

            //根据合同id查出产权人owner_type
            //公司
            $name='';
            $phone='';
            if($value->lessee_type ==1){
                $cc = CmsCompany::model()->find("contract_id = '$value->id' ")->company_name;
                $contractor = CmsCompany::model()->find("contract_id = '$value->id' ");
                $contractor_phone = CmsCompany::model()->find("contract_id = '$value->id' ");
                $name = $contractor->contractor;
                $phone = $contractor->contractor_phone;
                $datas[$key][]=$name;//签约人
                $datas[$key][]=$phone;//签约人

            }elseif($value->lessee_type ==2){
            //个人
                $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$value->id' and type =1");
                foreach ($owner as $key3 => $value3) {
                    $name .=CmsOwner::model()->find("id = '$value3->owner_id'")->name;
                    $phone .=CmsOwner::model()->find("id = '$value3->owner_id'")->mobile;

                }
                $datas[$key][]=$name;//签约人
                $datas[$key][]=$phone;//签约人

            }

        }
        echo '<pre>';
        var_dump($datas);exit;


        // 创建一个excel
        $objPHPExcel = new PHPExcel();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("liyuequn")->setLastModifiedBy("liyuequn")->setTitle("base_contract")->setSubject("base_contract")->setDescription("base_contract")->setKeywords("基础数据")->setCategory("综合支持");
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '项目名称')
            ->setCellValue('B1', '编号')
            ->setCellValue('C1', '面积')
            ->setCellValue('D1', '单价')
            ->setCellValue('E1', '月租金')
            ->setCellValue('F1', '付款方式')
            ->setCellValue('G1', '签约年限')
            ->setCellValue('H1', '免租期')
            ->setCellValue('I1', '签约日期')
            ->setCellValue('J1', '销售签约人')
            ->setCellValue('K1', '部门负责人')
            ->setCellValue('L1', '客户姓名')
            ->setCellValue('M1', '客户电话')
        ;

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('工程对接-' . date('Y-m-d'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
        $objPHPExcel->getActiveSheet()->freezePane('A2');
        $i = 2;


        foreach($datas as $data){
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[0])->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[1]);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[2]);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'. $i, $data[3],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

            // 设置文本格式
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'. $i, $data[4],PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[5]);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[6]);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[7]);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $data[8]);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $data[9]);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $data[10]);
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $data[11]);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $data[12]);

            $i++ ;
        }
        $objActSheet = $objPHPExcel->getActiveSheet();

        // 设置CELL填充颜色
        $cell_fill = array(
          'A1',
          'B1',
          'C1',
          'D1',
          'E1',
          'F1',
          'G1',
          'H1',
          'I1',
          'J1',
          'K1',
          'L1',
          'M1',
        );
        foreach($cell_fill as $cell_fill_val){
            $cellstyle = $objActSheet->getStyle($cell_fill_val);
            // background
            // $cellstyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('fafa00');
            // set align
            $cellstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            // font
            $cellstyle->getFont()->setSize(12)->setBold(true);
            // border
            $cellstyle->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
            $cellstyle->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
        }

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $objActSheet->getColumnDimension('A')->setWidth(18.5);
        $objActSheet->getColumnDimension('B')->setWidth(23.5);
        $objActSheet->getColumnDimension('C')->setWidth(12);
        $objActSheet->getColumnDimension('D')->setWidth(12);
        $objActSheet->getColumnDimension('E')->setWidth(12);
        $objActSheet->getColumnDimension('F')->setWidth(12);
        $objActSheet->getColumnDimension('G')->setWidth(24);
        $objActSheet->getColumnDimension('H')->setWidth(24);
        $objActSheet->getColumnDimension('I')->setWidth(12);
        $objActSheet->getColumnDimension('J')->setWidth(12);
        $objActSheet->getColumnDimension('k')->setWidth(12);
        $objActSheet->getColumnDimension('L')->setWidth(12);
        $objActSheet->getColumnDimension('M')->setWidth(12);

        $filename = '2015030423';
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');

    }

    //销售人员业绩排行表
    public function actionSellOrder()
    {



          //本月结束时间
          $EndDate =  strtotime(Yii::app()->request->getParam('time_end'));

          $BeginDate = strtotime(Yii::app()->request->getParam('time_start'));
          //查询签约人
          $name = Yii::app()->request->getParam('name');

          if($name!=null) {
            $user_id = AdminUser::model()->findAll( "nickname like '%".$name."%'");
          }
          //签约人ID
          $name_id = [];
          if($user_id!=null) {
                foreach($user_id as $k=>$v) {
                        $name_id[] = $v->id;
                }
          }
          $model = CmsContractSigner::model()->findAll(" sign_date>='$BeginDate' and sign_date<='$EndDate' and deleted=0 and type=1 group by signer");


          //	存储签约人ID
          $signer_id = [];

          foreach($model as  $v) {
                      $signer_id[] = $v->signer;
          }

          if($name_id!=null) {
                    $signer_id = 	array_intersect($name_id,$signer_id);
          }
          //寻找签约人所签署的合同及签约比例
          $contract_id = [];
          $scale = [];
          if($signer_id) {
                foreach($signer_id as $k=>$v) {

                        $contract = CmsContractSigner::model()->findAll("signer='$v' and type=1 and sign_date>='$BeginDate' and deleted=0 and sign_date<='$EndDate'");

                          foreach($contract as $key=>$va) {
                            $model = CmsPurchaseContract::model()->find("id='$va->contract_id' and deleted=0 ");
                                if($model!=null) {
                                  $contract_id[$v][] = $va->contract_id;
                                  $scale[$v][] = $va->scale;
                                }

                          }

                }

          }

          /*
                多重遍历
                第一层遍历:遍历出签约人所对应的合同 $k 为签约人ID
                第二层遍历：计算出合同所对应的车源面积及签约比例，算出每个签约人所签约的面积
          **/

            if($contract_id) {
                    foreach($contract_id as $k=>$v) {
                        $a = $scale[$k];

                      $hosue_area = [];
                      $house = '';
                      foreach($v as $k1 => $v1) {
                            $area = CmsPurchaseProperty::model()->findAll("contract_id='$v1'");

                            $house1  = '';
                            //合同上所有的面积汇总
                            foreach($area as $k2=>$v2) {
                                  $size = $v2->area ;
                                  $house1 += $size;
                            }
                            //按比例填写出最后签约总面积
                          $house += $house1*$a[$k1];

                      }
                          $house_area[$k] = $house ;
                          unset($house);
                    }
                  }

                          if($house_area!=null) {
                                  arsort($house_area);
                          }else {
                                  $house_area = [];
                          }
                          var_dump($house_area);
                          $area = '';
                $data = [];
                $list = CmsContractSigner::model()->findAll(" sign_date>='$BeginDate' and sign_date<='$EndDate' and type=1 and deleted=0  order by signer");
                foreach($list as $key=>$val) {
                      $v = $this->object2array($val);
                      foreach($house_area as $k1=>$v1) {
                            if($val->signer==$k1) {
                                  array_unshift($v,$v1);
                            }
                      }
                      $data[] = $v;
                }
                $arr1 = array_map(create_function('$n', 'return $n[0];'), $data);
                array_multisort($arr1,SORT_DESC,$data );

                header("Content-type: text/html; charset=utf-8");
                //遍历开始 按面积进行排序
                  $a = 1;
                  foreach($data as $k=>$v) {

                      $name = AdminUser::model()->find("id= '{$v[signer]}'");
                      $department = AdminDepartment::model()->find("id='$name->department_id'");

                      //区域
                      $datas[$k][] = $department->name;
                      //排名
                      $datas[$k][] = $a;
                      if($data[$k]['signer']!=$data[$k+1]['signer']) {
                            $a++;
                      }
                      //签单人
                      $datas[$k][] = $name->nickname;
                      //签约面积
                      $datas[$k][] = $v[0];
                      //签约套数 及 面积
                      $model = CmsContractSigner::model()->findAll(" sign_date>='$BeginDate' and sign_date<='$EndDate' and type=1 and deleted=0 and signer='{$v[signer]}'");
                      $scale = 0;
                      foreach($model as $k1=>$v1) {
                        $list = CmsPurchaseContract::model()->find("id='$v1->contract_id'  and deleted=0 and status in (0,-1)");
                        if($list!=null) {
                          $scale += $v1->scale;
                        }
                      }
                      $datas[$k][] = $scale;
                      //业绩量/整体业绩 $num 车源总面积
                      $num = array_sum($house_area);
                      $b = $v[0]/$num*100;
                      $datas[$k][] = sprintf("%.2f",$b).'%';
                      //级别
                      $pur_id = Contract::purchasecontract($v['contract_id']);
                      // if(is_array($pur_id)) {
                      //     echo 'a';
                      // }else {
                      //     var_dump($v['contract_id']);
                      // }
                        foreach($pur_id as $key=>$value) {
                            $mode = UrsSalesControl::model()->find("contract_id='$value->contract_id' ");
                        }



                      $list = CmsPurchaseContract::model()->find("id='{$v[contract_id]}'");
                      if($mode==null) {
                            $datas[$k][] = '荣誉房';
                      }else {
                            if($list->signing_date - $mode->live_date<=9*24*60*60) {
                              $datas[$k][] = '荣誉房';
                            } else if(($list->signing_date - $mode->live_date>=10*24*60*60) && ($list->signing_date - $mode->live_date<=20*24*60*60)) {
                              $datas[$k][] = '快消房';
                            } else if(($list->signing_date - $mode->live_date>=21*24*60*60) && ($list->signing_date - $mode->live_date<=35*24*60*60)) {
                              $datas[$k][] = '风险房';
                            } else if($list->signing_date - $mode->live_date>36*24*60*60) {
                              $datas[$k][] = '亏损房';
                            }else {
                              $datas[$k][] = '数据有误';
                            }
                      }

                      //面积
                      $area1 = CmsPurchaseProperty::model()->findAll("contract_id='{$v[contract_id]}'");
                      $house_area2  = '';
                      $size = '';
                      //合同上所有的面积汇总
                      foreach($area1 as $k3=>$v3) {
                            $size = $v3->area ;
                            $house4 += $size;
                      }
                      //按比例填写出最后签约总面积
                      $house = $house4*$v['scale'];
                      $datas[$k][] = $house;
                      $house4 = '';
                      $datas[$k][] = $v['scale'];
                      //项目
                      $model_p = CmsPurchaseContract::model()->find(" id = '{$v[contract_id]}' and type = 1 and deleted =0 and status in (0,-1)");
                        if($model_p!=null) {
                          $property = Property::allinfo($model_p->id);
                          $datas[$k][]=$property[0]['estate_name']; //项目名称
                          $house_no1 ='';
                          foreach ($property as $k5 => $v5) {
                              $house_no1 .= $v5['building_name'].$v5['house_no'].'/';
                              // $area += CmsPurchaseProperty::model()->find("contract_id = '$value->id' and property_id = '$v[property_id]' ")->area;
                          }
                          $house_no = str_replace('座','-',$house_no1);
                          $house_no = str_replace('号楼','-',$house_no1);
                          $datas[$k][]=substr($house_no,0,-1)?substr($house_no1,0,-1):''; //编号
                  }
                    //月租金
                        $pay = CmsPurchasePayRule::model()->find("contract_id='{$v[contract_id]}' order by the_order");

                        $datas[$k][] = number_format($pay->monthly_rent/100,2);
                }
                  // var_dump($dates);die();
                  // die();
                  // 创建一个excel
                  $objPHPExcel = new PHPExcel();
                  // Set document properties
                  $objPHPExcel->getProperties()->setCreator("liyuequn")->setLastModifiedBy("liyuequn")->setTitle("base_contract")->setSubject("base_contract")->setDescription("base_contract")->setKeywords("基础数据")->setCategory("综合支持");
                  $objPHPExcel->setActiveSheetIndex(0)
                      ->setCellValue('A1', '区域')
                      ->setCellValue('B1', '销售排名')
                      ->setCellValue('C1', '签单人')
                      ->setCellValue('D1', '签约面积㎡')
                      ->setCellValue('E1', '签约套数')
                      ->setCellValue('F1', '业绩量/整体业绩')
                      ->setCellValue('G1', '级别')
                      ->setCellValue('H1', '面积')
                      ->setCellValue('I1', '套数')
                      ->setCellValue('J1', '项目名称')
                      ->setCellValue('K1', '编号')
                      ->setCellValue('L1', '月租金')
                  ;

                  // Rename worksheet
                  $objPHPExcel->getActiveSheet()->setTitle('销控-' . date('Y-m-d'));
                  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
                  $objPHPExcel->setActiveSheetIndex(0);
                  $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
                  $objPHPExcel->getActiveSheet()->freezePane('A2');
                  $i = 2;


                  foreach($datas as $data){
                      $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[0])->getStyle('A'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                      $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[1]);
                      $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[2]);
                      $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'. $i, $data[3],PHPExcel_Cell_DataType::TYPE_STRING);
                      $objPHPExcel->getActiveSheet()->getStyle('D' . $i)->getNumberFormat()->setFormatCode("@");

                      // 设置文本格式
                      $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'. $i, $data[4],PHPExcel_Cell_DataType::TYPE_STRING);
                      $objPHPExcel->getActiveSheet()->getStyle('E' . $i)->getAlignment()->setWrapText(true);
                      $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $data[5]);
                      $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $data[6]);
                      $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $data[7]);
                      $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $data[8]);
                      $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $data[9]);
                      $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $data[10]);
                      $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $data[11]);
                      $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $data[12]);
                      $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $data[13]);
                      $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $data[14]);
                      $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $data[15]);
                      $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $data[16]);
                      $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $data[17]);
                      $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $data[18]);
                      $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $data[19]);
                      $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $data[20]);

                      $i++ ;
                  }
                  $objActSheet = $objPHPExcel->getActiveSheet();

                  // 设置CELL填充颜色
                  $cell_fill = array(
                    'A1',
                    'B1',
                    'C1',
                    'D1',
                    'E1',
                    'F1',
                    'G1',
                    'H1',
                    'I1',
                    'J1',
                    'K1',
                    'L1',
                    'M1',
                    'N1',
                    'O1',
                    'P1',
                    'Q1',
                    'R1',
                    'S1',
                    'T1',
                    'U1',
                  );
                  foreach($cell_fill as $cell_fill_val){
                      $cellstyle = $objActSheet->getStyle($cell_fill_val);
                      // background
                      // $cellstyle->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('fafa00');
                      // set align
                      $cellstyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                      // font
                      $cellstyle->getFont()->setSize(12)->setBold(true);
                      // border
                      $cellstyle->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                      $cellstyle->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                      $cellstyle->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                      $cellstyle->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN)->getColor()->setARGB('FFFF0000');
                  }

                  $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

                  $objActSheet->getColumnDimension('A')->setWidth(18.5);
                  $objActSheet->getColumnDimension('B')->setWidth(23.5);
                  $objActSheet->getColumnDimension('C')->setWidth(12);
                  $objActSheet->getColumnDimension('D')->setWidth(12);
                  $objActSheet->getColumnDimension('E')->setWidth(12);
                  $objActSheet->getColumnDimension('F')->setWidth(12);
                  $objActSheet->getColumnDimension('G')->setWidth(24);
                  $objActSheet->getColumnDimension('H')->setWidth(24);
                  $objActSheet->getColumnDimension('I')->setWidth(12);
                  $objActSheet->getColumnDimension('J')->setWidth(12);
                  $objActSheet->getColumnDimension('k')->setWidth(12);
                  $objActSheet->getColumnDimension('L')->setWidth(12);
                  $objActSheet->getColumnDimension('M')->setWidth(12);
                  $objActSheet->getColumnDimension('N')->setWidth(12);
                  $objActSheet->getColumnDimension('O')->setWidth(12);
                  $objActSheet->getColumnDimension('P')->setWidth(12);
                  $objActSheet->getColumnDimension('Q')->setWidth(12);
                  $objActSheet->getColumnDimension('R')->setWidth(12);
                  $objActSheet->getColumnDimension('S')->setWidth(12);
                  $objActSheet->getColumnDimension('T')->setWidth(12);
                  $objActSheet->getColumnDimension('U')->setWidth(12);

                  $filename = date('Ymd',time()).'销控';
                  ob_end_clean();//清除缓冲区,避免乱码
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
                  header('Cache-Control: max-age=0');
                  // If you're serving to IE 9, then the following may be needed
                  header('Cache-Control: max-age=1');
                  // If you're serving to IE over SSL, then the following may be needed
                  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                  header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
                  header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                  header('Pragma: public'); // HTTP/1.0
                  $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
                  $objWriter->save('php://output');
    }

}
