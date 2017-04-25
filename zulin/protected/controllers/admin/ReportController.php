<?php

class ReportController extends BackgroundBaseController
{

    public $title='幼狮车源管理';

    public function actionReport(){
    	$this->render("report");
    }

    public  function actionDetail(){
    	// $memcache = new Memcache; //创建一个memcache对象  
    	// $memcache->connect('localhost', 11211) or die ("Could not connect"); //连接Memcached服务器  
    	// $memcache->set('key', 'test'); //设置一个变量到内存中，名称是key 值是test  
    	// $get_value = $memcache->get('key'); //从内存中取出key的值  
    	// echo $get_value;  die;

    	$ctime =Yii::app()->request->getParam("ctime");
    	$type =Yii::app()->request->getParam("type");
    	$genre =Yii::app()->request->getParam("genre");
    	$excel =Yii::app()->request->getParam("excel");
    	$save_path = 'data/'.$genre.'/'.$ctime.'.txt';
    	if (!file_exists($save_path)) {
            echo '该日期已失效';die;
         }
         // var_dump($save_path);die;
    	$content = file_get_contents($save_path);
    	// var_dump($content);die;
    	// $model = SellReport::model()->find("type = '$type' and ctime = '$ctime'");
    	if($excel){
    	$content = mb_convert_encoding($content, 'gbk', 'utf-8');
			$file_name = '产品收购与销售情况对比明细'.date('Y-m-d',time()-(24*60*60));
		    header('Content-Type: text/xls');
		    header("Content-type:application/vnd.ms-excel;charset=utf-8");
		    $str = mb_convert_encoding($file_name, 'gbk', 'utf-8');
		    header('Content-Disposition: attachment;filename="' . $str . '.xls"');
		    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
		    header('Expires:0');
		    header('Pragma:public');
		    echo $content;
    	}else{
    		echo $content;	
    	}
    }
    // public  function actionExcel(){
    // 	$ctime =Yii::app()->request->getParam("ctime");
    // 	$type =Yii::app()->request->getParam("type");
    // 	$model = SellReport::model()->find("type = '$type' and ctime = '$ctime'");

    // 	$file_name = '产品收购与销售情况对比明细'.date('Y-m-d',time()-(24*60*60));
    //     header('Content-Type: text/xls');
    //     header("Content-type:application/vnd.ms-excel;charset=utf-8");
    //     $str = mb_convert_encoding($file_name, 'gbk', 'utf-8');
    //     header('Content-Disposition: attachment;filename="' . $str . '.xls"');
    //     header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    //     header('Expires:0');
    //     header('Pragma:public');
    //     echo $model->content;
    // }
    public function actionSell()
    {
        // $admin_id = Yii::app()->session['admin_uid'];
        // $admin = AdminUser::model()->find("id ='$admin_id'");
        // if($admin['type'] != 0){
         // die;
        // }
        
        $excel =Yii::app()->request->getParam("excel");
        set_time_limit(0);
        $time=time();
        $list=CmsPurchaseContract::model()->findAll("type='0' and status='0' and lease_term_start_real<='$time' and lease_term_end>='$time' and deleted='0'");//

            // 序号 商圈  组团  类别  产品类型=立项 项目名称/品牌 系列  编号 建筑面积/㎡  收房签约日 收房免租期  收购单价=收房月租*12/365/建筑面积   出车单价=出车月租金*12/365/建筑面积   产品收房日=客服实际收房日 前租户房租截止日  出车签约日=出车合同签约日 出车起租日=租期或免租期第一天 空置天数  出车次数  备注  序号  前租户房租截止日  租户起租日 前租户搬离日  待售  分租房间  幼狮与车主续约 与车主续约前租期  租户与幼狮续约 现租户搬走日  前租户名称
        $arrproperty=CmsProperty::model()->arr();
        $number = 0;
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
	        foreach ($list as $key => $value) {
	            $res=CmsPurchaseProperty::model()->findAll("contract_id='$value->id'");
	            foreach ($res as $k => $v) {
	                $data=CmsProperty::model()->find("id='$v->property_id'");
	                //序号
	                $number++;
	                //商圈
	                $area=BaseArea::model()->find("id='$data->area_id'")['name'];
	                //组团
	                $estate_group_id = BaseEstateGroup::model()->find("id='$data->estate_group_id'")['name'];
	                //产品类型
	                $room_type  = $arrproperty['room_type']["$data->room_type"];
	                // 类别
	                $estate_type=BaseBuilding::model()->find("id='$data->estate_id'");
	                $estate_type = $estate_type->type==1?'A类':'B类';
	                //项目名称
	                $estate=BaseEstate::model()->find("id='$data->estate_id'")['name'];
	                
	                //系列
	                $building=BaseBuilding::model()->find("id='$data->building_id'")['name'];
	                //编号
	                $house_no=$data->house_no;
	                 //备注
	                if($estate == '时间国际' || $estate == '万通中心'   || $estate == '恒基中心'  || $estate == '建外SOHO 1-5 #/10-14#'  || $estate == '蓝堡国际中心' || $estate == '远洋国际中心' || $estate == '建外SOHO  6-9#/15-18#' || $estate == '优士阁' || $estate == '银河SOHO' || $estate == 'SOHO尚都' || $estate == '东方银座' ){
	                	//时间国际
	                	if($estate == '时间国际'){
		                	if($building == 'H座'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//蓝堡国际中心
	                	if($estate == '蓝堡国际中心'){
		                	if($building == 'Ⅰ座'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//万通中心
	                	if($estate == '万通中心'){
		                	if($building == 'C座'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}	
	                	//恒基中心 
	                	if($estate == '恒基中心'){
		                	if($building == '3号楼'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	} 
	                	//建外SOHO 1-5 #/10-14#
	                	if($estate == '建外SOHO 1-5 #/10-14#'){
		                	if($building == '1号楼' || $building == '2号楼' || $building == '4号楼' || $building == '5号楼' ){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//远洋国际中心
	                	if($estate == '远洋国际中心'){
		                	if($building == 'C座'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//建外SOHO  6-9#/15-18#
	                	if($estate == '建外SOHO  6-9#/15-18#'){
		                	if($building == '7号楼' || $building == '8号楼'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//优士阁
	                	if($estate == '优士阁'){
		                	if($building == 'B座'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//银河SOHO
	                	if($estate == '银河SOHO'){
		                	if($building == '1号楼' || $building == '5号楼'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//SOHO尚都
	                	if($estate == 'SOHO尚都'){
		                	if($building == '南塔'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                	//东方银座
	                	if($estate == '东方银座'){
		                	if($room_type == '客车'){
		                		$status = 1;
		                	}else{
		                		$status = 2;
		                	}
	                	}
	                }else{
	                	$status = 1;
	                }
	                // $status = $number;
	                //建筑面积
	                $aream = $data->area;
	                //收房签约日
	                if($value->signing_date){
	                    $signing_date = date('Y-m-d',$value->signing_date);
	                }else{
	                    $signing_date = "";
	                }
	                // $signing_date = date('Y-m-d',$value->signing_date);
	                //收房免租期
	                $freelease=CmsPruchaseFreeLease::model()->findAll("contract_id='$value->id' order by start_time");
	                foreach ($freelease as $k1 => $v1) {
	                    if($k1 == 0){
	                        $freelease_str .= $v1->start_time ? date('Y-m-d',$v1->start_time) : ""; 
	                        $freelease_str .= $v1->end_time ? '至'.date('Y-m-d',$v1->end_time) : ""; 
	                        $freelease_day += $v1->start_time && $v1->end_time ? $v1->end_time - $v1->start_time + (24*60*60) : '';
	                    }else{
	                        $freelease_str .= $v1->start_time ? "<br>".date('Y-m-d',$v1->start_time) : ""; 
	                        $freelease_str .= '至'.$v1->end_time ? '至'.date('Y-m-d',$v1->end_time) : ""; 
	                        $freelease_day += $v1->start_time && $v1->end_time? $v1->end_time -$v1->start_time  + (24*60*60) : '';
	                    }

	                }
	                //收购单价
	                $price_per_meter = CmsPurchasePayRule::model()->find("contract_id='$value->id' and start_time < '$time' and end_time > '$time' and deleted = 0")['price_per_meter'];
	                if($price_per_meter){
	                    $price_per_meter = $price_per_meter/100;
	                }else{
	                    $price_per_meter = CmsPurchasePayRule::model()->find("contract_id='$value->id' and start_time > '$time' and deleted = 0 order by the_order")['price_per_meter']/100;
	                }

	                //产品收房日
	                $actual_date = SerPurContract::model()->find("contract_id='$value->id' and deleted = 0")['actual_date'];
	                $actual_dates = SerPurContract::model()->find("contract_id='$value->id' and deleted = 0")['actual_date'] ? date('Y-m-d',SerPurContract::model()->find("contract_id='$value->id' and deleted = 0")['actual_date']) :"";
	                //出车单价  产品收房日 出车签约日 出车起租日

	                $purchaseproperty = CmsPurchaseProperty::model()->findAll("deleted = 0 and property_id = '$v->property_id' ");
	                $aa = 0;
	                if($purchaseproperty) {
	                    foreach ($purchaseproperty as $v2) {
	                        $contracts =  CmsPurchaseContract::model()->find("id = '$v2->contract_id' and type = 1 and status=0 and deleted='0'");
	                        $contractss =  CmsPurchaseContract::model()->find("id = '$v2->contract_id' and type = 1 and deleted='0'");
	                        if(!empty($contracts) && !isset($contract)){
	                            $contract = $contracts;
	                        }
	                        if(!empty($contracts) && isset($contract)){
	                            $contract_last = $contracts;
	                        }
	                        if(!empty($contractss)){
	                            $aa++;
	                        }
	                    }
	                    if($contract){
	                        $price_per_meter_sale = CmsPurchasePayRule::model()->find("contract_id='$contract->id' and start_time < '$time' and end_time > 'end_time' and deleted = 0")['price_per_meter'];
	                        if($price_per_meter_sale){
	                            $price_per_meter_sale = $price_per_meter_sale/100;//出车单价
	                        }else{
	                             $price_per_meter_sale = CmsPurchasePayRule::model()->find("contract_id='$contract->id' and start_time >'$time' and deleted = 0 order by the_order")['price_per_meter']/100;
	                        }
	                        $is_sell = 1;

	                        $sale_signing_date = $contract['signing_date'] ? date('Y-m-d',$contract['signing_date']):"" ;//出车签约日
	                        $freelease_list=CmsPruchaseFreeLease::model()->findAll("contract_id='$contract->id' order by start_time");
	                        if(!empty($freelease_list[0]) && ($freelease_list[0]['start_time'] < $contract['lease_term_start'])){
	                            $lease_term_start = $freelease_list[0]['start_time'];
	                            $lease_term_starts =$lease_term_start ? date('Y-m-d',$lease_term_start) : "";//出车起租日
	                        }else{
		                		
		                		$lease_term_start = $contract['lease_term_start'];
		                		$lease_term_starts = $lease_term_start ? date('Y-m-d',$lease_term_start) : "";//出车起租日
		                	}
			                //空置天数 
			                	//新收房
			                	$vacant = ($lease_term_start - $actual_date - 24*60*60)/24/60/60;

		                }else{
		                	$is_sell = '';
		                	$price_per_meter_sale = '';
		                	$sale_signing_date='';//出车签约日
		                	$lease_term_starts = '';//出车起租日
		                	//空置天数 
			                	//新收房
		                		$time = date('Y-m-d',$time);
		                		$time = strtotime($time);
			                	// $vacant = ($actual_date - $time - 24*60*60)/24/60/60;
		                }
		                //前租户房租截止日
		                if(!isset($contract_last)){
		                	$lease_term_end = $contract_last['$lease_term_end'] ? date('Y-m-d',$contract_last['$lease_term_end']) : "";
		                }else{
		                	$lease_term_end= '';
		                }
		                //空置天数 出租二次以上的没弄

		                //备注
		               	// $lists[$number]['number'] = $number;
	                }
	                //被拆分的房子
	                if(!$purchaseproperty){
	                	$property = CmsProperty::model()->findAll("deleted = 0 and split_partent_id = '$v->property_id' ");
	                	foreach ($property as $kkk => $vvv) {
	                		$purchaseproperty[] = CmsPurchaseProperty::model()->findAll("deleted = 0 and property_id = '$vvv->id' ");
	                	}
	                	foreach ($purchaseproperty as $kkk1 => $vvv1) {
	                		foreach ($vvv1 as $kkk2 => $vvv2) {
	                			foreach ($vvv2 as $v2) {
	                			    $contracts =  CmsPurchaseContract::model()->find("id = '$v2->contract_id' and type = 1 and status=0 and deleted='0'");
	                			    $contractss =  CmsPurchaseContract::model()->find("id = '$v2->contract_id' and type = 1 and deleted='0'");
	                			    if(!empty($contracts) && !isset($contract)){
	                			        $contract[] = $contracts;
	                			    }
	                			    if(!empty($contracts) && isset($contract)){
	                			        $contract_last[] = $contracts;
	                			    }
	                			    if(!empty($contractss)){
	                			        $aa++;
	                			    }
	                			}
	                		}
	                	}
		                if($contract){
		                	foreach ($contract as $kkkk1 => $vvvv1) {
			                	$price_per_meter_sale = CmsPurchasePayRule::model()->find("contract_id='$vvvv1->id' and start_time < '$time' and end_time > 'end_time' and deleted = 0")['price_per_meter'];
			                	if($price_per_meter_sale){
			                		$price_per_meter_sale[] = $price_per_meter_sale;//出车单价
			                	}else{
			                		 $price_per_meter_sale[] = CmsPurchasePayRule::model()->find("contract_id='$vvvv1->id' and start_time > '$time' and deleted = 0 order by the_order")['price_per_meter'];
			                	}
		                		$price_per_meter_sale = (max($price_per_meter_sale)+min($price_per_meter_sale))/200;//出车单价
			                	$is_sell = 1;

			                	$sale_signing_date[] = $vvvv1['signing_date'] ? $vvvv1['signing_date']:"" ;//出车签约日
			                	$sale_signing_date = $sale_signing_date ? date('Y-m-d',max($sale_signing_date)):"" ;//出车签约日
			                	$freelease_list=CmsPruchaseFreeLease::model()->findAll("contract_id='$vvvv1->id' order by start_time");
			                	if(!empty($freelease_list[0]) && ($freelease_list[0]['start_time'] < $vvvv1['lease_term_start'])){
			                		$lease_term_start = $freelease_list[0]['start_time'];
			                		$lease_term_starts[] =$lease_term_start ? date('Y-m-d',$lease_term_start) : "";//出车起租日
			                	}else{
			                		
			                		$lease_term_start = $vvvv1['lease_term_start'];
			                		$lease_term_starts[] = $lease_term_start ? date('Y-m-d',$lease_term_start) : "";//出车起租日
			                	}
			                	$lease_term_starts = $lease_term_starts ? date('Y-m-d',max($lease_term_starts)) : "";//出车起租日
				                //空置天数 
				                	//新收房
				                	// $vacant = ($lease_term_start - $actual_date - 24*60*60)/24/60/60;

			                }
			                if(!$price_per_meter_sale){
			                	$is_sell = '';
			                	$price_per_meter_sale = '';
			                	$sale_signing_date='';//出车签约日
			                	$lease_term_starts = '';//出车起租日
			                	//空置天数 
				                	//新收房
			                		$time = date('Y-m-d',$time);
			                		$time = strtotime($time);
				                	// $vacant = ($actual_date - $time - 24*60*60)/24/60/60;
			                }
			                //前租户房租截止日
			                if(!isset($contract_last)){
			                	foreach ($contract_last as $key_last => $value_last) {
			                		$lease_term_end[] = $contract_last['$lease_term_end'] ? date('Y-m-d',$value_last['$lease_term_end']) : "";
			                	}
			                	$lease_term_end = date('Y-m-d',max($lease_term_end));
			                }else{
			                	$lease_term_end= '';
			                }
			                //空置天数 出租二次以上的没弄

			                //备注
			               	// $lists[$number]['number'] = $number;
		                }
	                }
	                // var_dump($area);die;
	               	$model = new Report();
	               	$model->id = Guid::create_guid();
	               	$model->area = $area;
	               	$model->estate_group_id = $estate_group_id;
	               	$model->estate_type = $estate_type;
	               	if($room_type == '商务' || $room_type == '轿车'){
	               		$room_type = '商务轿车';
	               	}
	               	$model->room_type = $room_type;
	               	$model->estate = $estate;
	               	$model->building = $building;
	               	$model->house_no= $house_no;
	               	$model->aream = $aream;
	               	$model->signing_date = $signing_date;
	               	$model->freelease_str = $freelease_str;
	               	$model->freelease_day = $freelease_day/24/60/60;
	               	$model->price_per_meter = $price_per_meter;
	               	$model->price_per_meter_sale = $price_per_meter_sale;
	               	$model->actual_date = $actual_dates;
	               	$model->sale_signing_date = $sale_signing_date;
	               	$model->lease_term_start = $lease_term_starts;
	               	// $lists[$number]['vacant'] = $vacant;
	               	$model->lease_term_end = $lease_term_end;
	               	$model->sale_count = $aa;
	               	$model->is_sell = $is_sell;
	               	$model->status = $status;
	               	$model->save();
	                unset($contract);
	                unset($freelease_str);
	                unset($freelease_day);
	            }

	        }
	        $transaction1->commit(); //提交事务会真正的执行数据库操作

	    } catch (Exception $e){
	        echo '操作失败';
	        $transaction1->rollback(); //如果操作失败, 数据回滚
	    }
        $this::test();
    }
    public static function Sum($aream,$report_where)
    {
        $sql = 'select sum('.$aream.') from '.$report_where;
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $command =$command->queryAll()[0]["sum($aream)"];
        return $command;
    }

    public static function count($where)
    {
        $sql = 'select count(*) from report '.$where.'group by status';
        $connection=Yii::app()->db;
        $command=$connection->createCommand($sql);
        $command =$command->queryAll();
        return $command;
    }

    public  function Test()
    {
        //商圈
        $basearea_list = BaseArea::model()->findAll("deleted = 0");
        foreach ($basearea_list as $k1 => $v1) {
            $area[$v1->name] = $this::sum('aream',"report where 1=1 and  area = '$v1->name'");
            $model_2 = BaseEstateGroup::model()->findAll("1=1 and area_id = '$v1->id' and deleted = 0");
            foreach ($model_2 as $k2 => $v2) {
                $group[$v1->name][$v2->name] =  $this::sum('aream',"report where 1=1 and  estate_group_id = '$v2->name' and  area = '$v1->name'");
                $model_3 = BaseEstate::model()->findAll("1=1 and estate_group_id = '$v2->id' and deleted = 0");
                foreach ($model_3 as $k3 => $v3) {
                    $estate[$v1->name][$v2->name][$v3->name] =  $this::sum('aream',"report where 1=1 and estate = '$v3->name' and  estate_group_id = '$v2->name' and  area = '$v1->name'");
                    $model_4 = $this::count("where 1=1 and estate = '$v3->name' and  estate_group_id = '$v2->name' and  area = '$v1->name'");
                    for ($i=1; $i <= count($model_4); $i++) { 
                    	$type_status[$v1->name][$v2->name][$v3->name][$i] = $this::sum('aream',"report where 1=1 and estate = '$v3->name' and  estate_group_id = '$v2->name' and  area = '$v1->name' and status= '$i'  ");
                    }
                }

            }
        }
        arsort($area);
        //头
        $number = 0;
        $lists['top'][] = "产品收购/销售核心数据（更新至".date('Y-m-d',time()-(24*60*60))."）";
        $color[$number]  ='列头';
        $lists[$number][] = '商圈';
        $lists[$number][] = '组团';
        $lists[$number][] = '类别';
        $lists[$number][] = '产品类型';
        $lists[$number][] = '项目名称';
        $lists[$number][] = '系列';
        $lists[$number][] = '编号';
        $lists[$number][] = '面积/㎡';
        $lists[$number][] = '收购单价';
        $lists[$number][] = '出车单价';
        $lists[$number][] = '产品收房日';
        $lists[$number][] = '出车签约日';
        $lists[$number][] = '收房签约日';
        $lists[$number][] = '收房免租期';
        $lists[$number][] = '收房免租期天数';
        // $lists[$number]['lease_term_start'] = '出车起租日';
        // $lists[$number]['vacant'] = '空置天数';
        // $lists[$number]['lease_term_end'] = '前租户房租截止日';
        $lists[$number][] = '出车次数';
        $lists[$number][] = '备注';
        foreach ($area as $k10 => $v10) {
            $model_area =  Report::model()->findAll(" area = '$k10'");
            if($group[$k10]){
              arsort($group[$k10]);
              foreach ($group[$k10] as $k11 => $v11) {
                  $model_group =  Report::model()->findAll(" area = '$k10' and estate_group_id = '$k11'");
                  if($estate[$k10][$k11]){
                      arsort($estate[$k10][$k11]);
                      foreach ($estate[$k10][$k11] as $k12 => $v12) {
	                      $aream = $this::sum('aream',"report where 1=1 and  area = '$k10' and estate_group_id = '$k11' and  estate = '$k12'");
	                      $models =  Report::model()->findAll(" area = '$k10' and estate_group_id = '$k11' and  estate = '$k12'");
                          if($type_status[$k10][$k11][$k12]){
	                          foreach ($type_status[$k10][$k11][$k12] as $k13 => $v13) {
		                          $model =  Report::model()->findAll(" area = '$k10' and estate_group_id = '$k11' and  estate = '$k12' and status = '$k13'  order by  price_per_meter ");
		                          $sum = $this::sum('price_per_meter',"report where 1=1 and  area = '$k10' and estate_group_id = '$k11' and  estate = '$k12' and status = '$k13' ");
		                          foreach ($model as $key => $value) {
		                              $number++;
		                              $lists[$number][] = $value->area;
		                              $lists[$number][] =$value->estate_group_id;
		                              $lists[$number][] = $value->estate_type;
		                              $lists[$number][] = $value->room_type;
		                              $lists[$number][] = $value->estate;
		                              $lists[$number][] = $value->building;
		                              $lists[$number][] = $value->house_no;
		                              $lists[$number][] = $value->aream;
		                              $lists[$number][] = $value->price_per_meter;
		                              $lists[$number][] =$value->price_per_meter_sale;
		                              $lists[$number][] = $value->actual_date;
		                              $lists[$number][] = $value->sale_signing_date;
		                              $lists[$number][] = $value->signing_date;
		                              $lists[$number][] = $value->freelease_str;
		                              $lists[$number][] = $value->freelease_day;
		                              // $lists[$number]['lease_term_start'] = $value->lease_term_start;
		                                // $lists[$number]['vacant'] = $vacant;
		                              // $lists[$number]['lease_term_end'] = $value->lease_term_end;
		                              $lists[$number][] = $value->sale_count;
		                              $lists[$number][] = '';
		                          }
		                          if($model){
			                          // 第一行
			                          $number++;
			                          $color[$number]  = '项目平均值';
			                          $lists[$number][] = $k10;
			                          $lists[$number][] = $k11;
			                          $lists[$number][] = '';
			                          $lists[$number][] = '';
			                          $lists[$number][] = $k12;
			                          $lists[$number][] = '';
			                          $lists[$number][] = '项目平均值';
			                          $lists[$number][] = '';
			                          if(count($model)){
			                              $lists[$number][] = round($sum/count($model),2);
			                          }else{
			                              $lists[$number][] = '';
			                          }
			                          $lists[$number][] = '';
			                          $lists[$number][] = '';
			                          $lists[$number][] = '';
			                          $lists[$number][] = '';
			                          $lists[$number][] = '';
			                          $lists[$number][] = '';
			                          // $lists[$number]['lease_term_start'] = '出车起租日';
			                          // $lists[$number]['vacant'] = '空置天数';
			                          // $lists[$number]['lease_term_end'] = '前租户房租截止日';
			                          $lists[$number][] = '';
			                          $lists[$number][] = '';
			                          
		                          }
		                      }
                          }

	                      // 第二行
	                      if($models){
		                      $number++;
		                      $color[$number]  = '项目总面积';
		                      $lists[$number][] = $k10;
		                      $lists[$number][] = $k11;
		                      $lists[$number][] = '';
		                      $lists[$number][] = '';
		                      $lists[$number][] = $k12;
		                      $lists[$number][] = '';
		                      $lists[$number][] = '项目总面积';
		                      $lists[$number][] = round($aream,2);
		                      $lists[$number][] = '项目总套数';
		                      $lists[$number][] = count($models);
		                      $lists[$number][] = '';
		                      $lists[$number][] = '';
		                      $lists[$number][] = '';
		                      $lists[$number][] = '';
		                      $lists[$number][] = '';
		                      // $lists[$number]['lease_term_start'] = '出车起租日';
		                      // $lists[$number]['vacant'] = '空置天数';
		                      // $lists[$number]['lease_term_end'] = '前租户房租截止日';
		                      $lists[$number][] = '';
		                      $lists[$number][] = '';
	                      }
                      } 
                  }
                  if($model_group){
	                  // 第一行
	                  $number++;
	                  $color[$number]  ='组团总面积';

	                  $lists[$number][] = $k10;
	                  $lists[$number][] = $k11;
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
	                  $lists[$number][] = '组团总面积';
	                  $lists[$number][] = round($v11,2);
	                  $lists[$number][] = '组团总套数';
	                  $lists[$number][] = count($model_group);
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
	                  // $lists[$number]['lease_term_start'] = '出车起租日';
	                  // $lists[$number]['vacant'] = '空置天数';
	                  // $lists[$number]['lease_term_end'] = '前租户房租截止日';
	                  $lists[$number][] = '';
	                  $lists[$number][] = '';
                  }
              }
            }
            if($model_area){
	            // 第一行
	            $number++;
	            $color[$number]  ='商圈总面积';
	            $lists[$number][] = $k10;
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            $lists[$number][] = '商圈总面积';
	            $lists[$number][] = round($v10,2);
	            $lists[$number][] = '商圈总套数';
	            $lists[$number][] = count($model_area);
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            $lists[$number][] = '';
	            // $lists[$number]['lease_term_start'] = '出车起租日';
	            // $lists[$number]['vacant'] = '空置天数';
	            // $lists[$number]['lease_term_end'] = '前租户房租截止日';
	            $lists[$number][] = '';
	            $lists[$number][] = '';
            }
        }
        $model_total =  Report::model()->findAll();
        $aream_total = $this::sum('aream',"report where 1=1 ");
        if($model_total){
	        // 第一行
	        $number++;
	        $color[$number]  ='产品总面积';
	        $lists[$number][] = '总计';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        $lists[$number][] = '产品总面积';
	        $lists[$number][] = round($aream_total,2);
	        $lists[$number][] = '产品总套数';
	        $lists[$number][] = count($model_total);
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
	        // $lists[$number]['lease_term_start'] = '出车起租日';
	        // $lists[$number]['vacant'] = '空置天数';
	        // $lists[$number]['lease_term_end'] = '前租户房租截止日';
	        $lists[$number][] = '';
	        $lists[$number][] = '';
        }
        Report::model()->deleteAll();
        // $excel = new Excel();

        // $excel->download($lists, '产品收购与销售情况对比明细'.date('Y-m-d',time()));
        // if($excel){
        // 	$file_name = '产品收购与销售情况对比明细'.date('Y-m-d',time());
	       //  header('Content-Type: text/xls');
	       //  header("Content-type:application/vnd.ms-excel;charset=utf-8");
	       //  $str = mb_convert_encoding($file_name, 'gbk', 'utf-8');
	       //  header('Content-Disposition: attachment;filename="' . $str . '.xls"');
	       //  header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	       //  header('Expires:0');
	       //  header('Pragma:public');
        // }
        $table_data .= '<table border=" 1px #BFBFBF">';
        // $table_data .= '<tr>';
   
        // $table_data .= "<td width = '50px' colspan='16'>".$headers_str."</td>";
        // $table_data .= '</tr>';
        //商圈总面积 E6B8B7
        //产品总面积 E6B8B7
        //项目平均值 C4D79B
        //项目总面积 CCC0DA
        //组团总面积 E6B8B7
        foreach ($lists as $key_lists => $line) {
            switch ($color[$key_lists])
            {
            case '商圈总面积':
              $table_data .= '<tr style="height:18px;background:#E6B8B7">';
              break;  
            case '产品总面积':
              $table_data .= '<tr style="height:18px;background:#E6B8B7">';
              break;
            case '项目平均值':
              $table_data .= '<tr style="height:18px;background:#C4D79B">';
              break;
            case '项目总面积':
              $table_data .= '<tr style="height:18px;background:#CCC0DA">';
              break;
            case '组团总面积':
              $table_data .= '<tr style="height:18px;background:#E6B8B7">';
              break;
            case '列头':
              $table_data .= '<tr style="height:50px;background:#8DB4E2">';
              break;
            default:
                $table_data .= '<tr style="height:18px;">';
            }
            foreach ($line as $key => &$item) {
                $item = mb_convert_encoding($item, 'gbk', 'utf-8');
                if($key_lists == 0){
                	if($key == 0 && count($line) > 2){
                	    $table_data .= "<td style='width:130px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if($key == 2 ||$key == 5  || $key == 7 || $key == 9 ){
                	    $table_data .= "<td style='width:70px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if($key == 3){
                	    $table_data .= "<td style='width:100px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}

                	if($key == 11  || $key == 12 || $key == 6 || $key == 8){
                	    $table_data .= "<td style='width:100px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if($key == 15  || $key == 14){
                	    $table_data .= "<td style='width:85px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if($key == 13 ){
                	    $table_data .= "<td style='width:240px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if($key == 16 ){
                	    $table_data .= "<td style='width:100px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if($key == 4 ){
                	    $table_data .= "<td style='width:200px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if($key ==1){
                	    $table_data .= "<td style='width:200px;font-size:18.71px;text-align:center;'>" . $item . "</td>";
                	}
                	if(count($line) < 2){
                	    $table_data .= "<td colspan='16' style='height:60px;font-size:30px;text-align:center;'>" . $item . "</td>";
                	}
                }else{
	                if($key == 0 && count($line) > 2){
	                    $table_data .= "<td style='width:130px;font-size:13.5px;text-align:center;'>" . $item . "</td>";
	                }
	                if($key == 2 ||$key == 5  || $key == 7 || $key == 9 ){
	                    $table_data .= "<td style='width:70px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }
	                if($key == 3){
	                    $table_data .= "<td style='width:100px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }

	                if($key == 11  || $key == 12 || $key == 6 || $key == 8){
	                    $table_data .= "<td style='width:100px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }
	                if($key == 15  || $key == 14){
	                    $table_data .= "<td style='width:85px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }
	                if($key == 13 ){
	                    $table_data .= "<td style='width:240px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }
	                if($key == 16 ){
	                    $table_data .= "<td style='width:100px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }
	                if($key == 4 ){
	                    $table_data .= "<td style='width:200px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }
	                if($key ==1){
	                    $table_data .= "<td style='width:200px;font-size:13.366px;text-align:center;'>" . $item . "</td>";
	                }
	                if(count($line) < 2){
	                    $table_data .= "<td colspan='16' style='height:60px;font-size:30px;text-align:center;'>" . $item . "</td>";
	                }
                }
            }
            $table_data .= '</tr>';
        }
        $table_data .= '</table>';
        if (!file_exists('data/sell')) {
            mkdir('data/sell',0777,true);
            
         }
        
        $save_path = "data/sell/".date('Y-m-d').'.txt';
        file_put_contents($save_path, $table_data);
        die();
        // echo $table_data;
        // $sellreport = new SellReport();
        // $sellreport->content = $table_data;
        // $sellreport->ctime = date("Y-m-d",time());
        // $sellreport->save();
    }
}
// 1.出车次数为2，出车签约日没有变（三里屯D1601） 已解决
// 2.收购单价是逐年递增的，到期没有变，显示的是第一年（万通c903） 已解决
// 3.车主有两套房但就签了一个合同，收购单价错误（住邦4-1205/1206） 已解决
// 4.一套房有2个或以上的租户，出车的信息是空的（尚都北塔507） 已解决
// 5 一个车主有好几套房，就签了一个合同 有重复信息  已解决
//6 出车单价都是净租金 没有除去税金  系统上面现在没有