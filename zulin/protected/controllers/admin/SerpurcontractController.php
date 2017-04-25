<?php

class SerpurcontractController extends BackgroundBaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';

    public $title='';

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        //搜索
        $k_area =Yii::app()->request->getParam("k_area");
        $search =Yii::app()->request->getParam("search");
        $k_estates=Yii::app()->request->getParam("k_estates");
        $k_building=Yii::app()->request->getParam("k_building");
        $k_number=Yii::app()->request->getParam("k_number");
        $k_actual_date=Yii::app()->request->getParam("k_actual_date");
        $k_admin=Yii::app()->request->getParam("k_admin");
        $k_source=Yii::app()->request->getParam("k_source");

        //实际收房日期
        $k_sdate=Yii::app()->request->getParam("k_sdate");
        $k_edate=Yii::app()->request->getParam("k_edate");

        //合同规定收房日期
        $k_spurchase=Yii::app()->request->getParam("k_spurchase");
        $k_epurchase=Yii::app()->request->getParam("k_epurchase");

        $pagesize=10;

        /*
            根据车源查出车源的ID对应上合同
         */
        //商圈-编号的搜索开始
        $contract_id1=[];
        $contract_id2=[];
        $contract_id3=[];
        $contract_id4=[];
        if($k_area){
            $areas=BaseArea::model()->findAll("name like '%".$k_area."%'");
            if($areas){
                $areas_id="";
                foreach ($areas as $key => $value) {
                    if ($key==0){
                        $areas_id.="'".$value->id."'";
                    }
                    else{
                        $areas_id.=","."'".$value->id."'";
                    }
                }
                $property1=CmsProperty::model()->findAll("area_id in ($areas_id)");
                foreach ($property1 as $key => $value) {
                    if($value){
                        $res=CmsPurchaseProperty::model()->findAll("property_id='$value->id'");
                        foreach($res as $key=>$v){
                            $contract_id1[]="'".$v->contract_id."'";
                        }
                    }
                }
            }
        }
        $contract_id1 = implode(',',$contract_id1);
        //品牌
        if($k_estates){
            $estates=BaseEstate::model()->findAll("name like '%".$k_estates."%'");
            if($estates){
                $estates_id="";
                foreach ($estates as $key => $value) {
                    if ($key==0){
                        $estates_id.="'".$value->id."'";
                    }
                    else{
                        $estates_id.=","."'".$value->id."'";
                    }
                }
                $property2=CmsProperty::model()->findAll("estate_id in ($estates_id)");
                foreach ($property2 as $key => $value) {
                    if($value){
                        $res=CmsPurchaseProperty::model()->findAll("property_id='$value->id'");
                        foreach($res as $key=>$v){
                            $contract_id2[]="'".$v->contract_id."'";
                        }
                    }
                }
            }
        }
        $contract_id2 = implode(',',$contract_id2);
        //系列
        if($k_building){
            $building=BaseBuilding::model()->findAll("name like '%".$k_building."%'");
            if($building){
                $building_id="";
                foreach ($building as $key => $value) {
                    if ($key==0){
                        $building_id.="'".$value->id."'";
                    }
                    else{
                        $building_id.=","."'".$value->id."'";
                    }
                }
                $property3=CmsProperty::model()->findAll("building_id in ($building_id)");
                foreach ($property3 as $key => $value) {
                    if($value){
                        $res=CmsPurchaseProperty::model()->findAll("property_id='$value->id'");
                        foreach($res as $key=>$v){
                            $contract_id3[]="'".$v->contract_id."'";
                        }
                    }
                }
            }
        }
        $contract_id3 = implode(',',$contract_id3);
        //编号
        if($k_number){
            $property4=CmsProperty::model()->findAll("house_no like '%".$k_number."%' and deleted=0");
            foreach ($property4 as $key => $value) {
                if($value){
                    $res=CmsPurchaseProperty::model()->findAll("property_id='$value->id'");
                    foreach($res as $key=>$v){
                        $contract_id4[]="'".$v->contract_id."'";
                    }
                }
            }
        }
        $contract_id4 = implode(',',$contract_id4);
        //商圈-编号的搜索结束
        //外勤人
        if($k_admin){
            $admin=AdminUser::model()->findAll("nickname like '%".$k_admin."%'");
            $admin_id="";
            foreach ($admin as $key => $value) {
                if ($key==0){
                    $admin_id.="'".$value->id."'";
                }
                else{
                    $admin_id.=","."'".$value->id."'";
                }

            }
        }

        $condition="1=1 and t.deleted=0";
        $condition.=" and  ( 1=1  ";
            //商圈-编号的搜索开始
            if($k_area!=null){
                if($contract_id1){
                    $condition.= " and  contract_id in ($contract_id1) ";
                }else{
                    $condition.= " and  contract_id in ('') ";
                }
            }
            if($k_estates!=null){
                if($contract_id2){
                    $condition.= " and  contract_id in ($contract_id2) ";
                }else{
                    $condition.= " and  contract_id in ('') ";
                }
            }
            if($k_building!=null){
                if($contract_id3){
                    $condition.= " and  contract_id in ($contract_id3) ";
                }else{
                    $condition.= " and  contract_id in ('') ";
                }
            }
            if($k_number!=null){
                if($contract_id4){
                    $condition.= " and  contract_id in ($contract_id4) ";
                }else{
                    $condition.= " and  contract_id in ('') ";
                }
            }
            //商圈-编号的搜索结束
            if ($k_admin!=null) {
                if($admin_id){
                    $condition.= " and  creater_id in ($admin_id) ";
                }else{
                    $condition.= " and  creater_id in ('') ";
                }
            }
            $k_date1=strtotime($k_sdate);
            $k_date2=strtotime($k_edate);
            if ($k_sdate) {
                $condition.=" and actual_date >= '$k_date1' ";
            }
            if ($k_edate) {
                $condition.=" and actual_date <= '$k_date2' ";
            }

            if($k_source==车主){
                $condition.=" and source = 0 ";
            }

            if($k_source==租户){
                $condition.=" and source = 1 ";
            }

            //合同规定收房日期
            $k_spurchase1=strtotime($k_spurchase);
            $k_epurchase2=strtotime($k_epurchase);
            if ($k_spurchase) {
                $condition.=" and purchase_contract_date >= '$k_spurchase1' ";
            }
            if ($k_epurchase) {
                $condition.=" and purchase_contract_date <= '$k_epurchase2' ";
            }
        $condition.=")";

        $criteria=new CDbCriteria;
        $criteria->condition=$condition;

        $criteria->order='t.ctime DESC';
        $count = SerPurContract::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list = SerPurContract::model()->findAll($criteria);
        $this->render("index",array(
            'list'=>$list,
            'pages'=>$pager,
            'k_area'=>$k_area,
            'k_estates'=>$k_estates,
            'k_building'=>$k_building,
            'k_number'=>$k_number,
            'k_admin'=>$k_admin,
            'k_source'=>$k_source,
            'k_spurchase'=>$k_spurchase,
            'k_epurchase'=>$k_epurchase,
            'k_sdate'=>$k_sdate,
            'k_edate'=>$k_edate,
            'search'=>$search,
        ));
    }

    public function actionAdd()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model =SerPurContract::model()->find(" t.id='$id'");
        //获取楼房 系列 编号
        $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['contract_id']}'");
        $data = [];
        if(!empty($models)){
            foreach ($models as $k => $v) {
                $data[$k]['property_id'] = $v['property_id'];//车源id
                $property = CmsProperty::model()->find("id = '{$v['property_id']}'");//车源信息

                $data[$k]['estate_id'] = BaseEstate::model()->find("id = '{$property['estate_id']}'")['name'];//品牌
                $data[$k]['building_id'] = BaseBuilding::model()->find("id = '{$property['building_id']}'")['name'];//系列
                $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}'")['house_no'];//编号
            }
        }

        $referer= $_SERVER['HTTP_REFERER'];
        $this->render("add",array(
            'referer'=>$referer,
            'data'=>$data,
            'id'=>$id,
        ));
    }

    public function actionAddSave()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $creater_id=Yii::app()->session['admin_uid'];
        $actual_date =Yii::app()->request->getParam("actual_date");//实际收房日期
        $property_id =Yii::app()->request->getParam("property_id");//所在车源id
        $hualiang_id =Yii::app()->request->getParam("hualiang_id");
        $sale_id =Yii::app()->request->getParam("sale_id");
        $quality_id =Yii::app()->request->getParam("quality_id");
        $decorate_id =Yii::app()->request->getParam("decorate_id");
        $pay_method =Yii::app()->request->getParam("pay_method");
        $actual_payment =Yii::app()->request->getParam("actual_payment");
        $owner_phone =Yii::app()->request->getParam("owner_phone");
        $hope_end_time =Yii::app()->request->getParam("hope_end_time");
        //收房清单图片
        $list_photo =Yii::app()->request->getParam("list_photo");
        $list_photo = explode(",",$list_photo);
        array_shift($list_photo);
        //编号对应的车源ID
        $house_no_hidden =Yii::app()->request->getParam("house_no_hidden");
        if($actual_date){
            $actual_date =strtotime($actual_date);
        }
        if($hope_end_time){
            $hope_end_time =strtotime($hope_end_time);
        }
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $model =SerPurContract::model()->find(" t.id='$id'");
            $model->creater_id=$creater_id;
            $model->actual_date=$actual_date;
            $model->hualiang_id=$hualiang_id;
            $model->sale_id=$sale_id;
            $model->quality_id=$quality_id;
            $model->decorate_id=$decorate_id;
            $model->pay_method=$pay_method;
            $model->actual_payment=$actual_payment*100;
            $model->owner_phone=$owner_phone;
            $model->ctime=time();
            $model->deleted=0;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }

            //收房清单图片存储
            foreach($list_photo as $k => $v){
                $list_contract_photo = new SerContractPhoto;
                $list_contract_photo->id = Guid::create_guid();
                $list_contract_photo->ser_contract_id = $id;
                $list_contract_photo->url = $v;
                $list_contract_photo->ctime = time()+$k;
                $list_contract_photo->deleted = 0;
                if(!$list_contract_photo->save()){
                    $this->OutputJson(0,json_encode($list_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            //水电费记录
            Service::Special($id);

            //特殊费用
            Service::Hydropower($id);
            //隐患
            $service_type =Yii::app()->request->getParam("service_type");
            $hidden =Yii::app()->request->getParam("hidden");
            $hidden_infor =Yii::app()->request->getParam("hidden_infor");
            $hidden_cost =Yii::app()->request->getParam("hidden_cost");
            $bear_type =Yii::app()->request->getParam("bear_type");
            //隐患图片
            $property_photo =Yii::app()->request->getParam("property_photo");
            //隐患记录
            foreach($house_no_hidden as $k => $v){
                if($hidden[$k]){
                    $ser_after_sales = new SerAfterSales;
                    $ser_after_sales->id = Guid::create_guid();
                    $ser_after_sales->criter_id = Yii::app()->session['admin_uid'];
                    $ser_after_sales->urs_user_id = Yii::app()->session['admin_uid'];
                    $ser_after_sales->contract_id = $model->contract_id;
                    $ser_after_sales->ser_contract_id = $id;
                    $ser_after_sales->property_id = $v;
                    if($service_type[$k]==1){
                       $ser_after_sales->evolve_type = 5;
                       $ser_after_sales->hope_end_time=$hope_end_time;
                    }
                    if($service_type[$k]==2){
                       $ser_after_sales->evolve_type = 1;
                    }
                    $ser_after_sales->service_type = $service_type[$k];
                    $ser_after_sales->hidden = $hidden[$k];
                    $ser_after_sales->hidden_infor = $hidden_infor[$k];
                    $ser_after_sales->hidden_cost = $hidden_cost[$k]*100;
                    $ser_after_sales->bear_type = $bear_type[$k];
                    $ser_after_sales->repair_type = 1;
                    $ser_after_sales->ctime = time()+$k;
                    $ser_after_sales->deleted = 0;
                    if(!$ser_after_sales->save()){
                        $this->OutputJson(0,json_encode($ser_after_sales->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                    //隐患图片
                    if($property_photo){
                        foreach($property_photo as $key => $value){
                            $ser_hidden_photo = new SerHiddenPhoto;
                            $ser_hidden_photo->id = Guid::create_guid();
                            $ser_hidden_photo->after_id = $ser_after_sales->id;
                            $ser_hidden_photo->url = $value;
                            $ser_hidden_photo->ctime = time()+$key;
                            $ser_hidden_photo->deleted = 0;
                            if(!$ser_hidden_photo->save()){
                                $this->OutputJson(0,json_encode($ser_hidden_photo->errors,JSON_UNESCAPED_UNICODE),null);
                            }
                        }
                    }
                }
            }
            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/serpurcontract");

    }
    public function actionEdit()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model =SerPurContract::model()->find(" t.id='$id'");
        //水电费
        $ser_Hydropower =SerHydropower::model()->findAll("ser_contract_id='$id' order by show_order");
        //特殊费用
        $ser_SpecialCost =SerSpecialCost::model()->findAll("ser_contract_id='$id' order by show_order");
        $house_no=[];
        $type=[];
        $details=[];
        $amount=[];
        foreach($ser_SpecialCost as $k=>$value){
            $house_no[]=$value->house_no;
            $type[]=$value->type;
            $details[]=$value->details;
            $amount[]=$value->amount/100;
        }

        //交割单图片
        $photo=SerContractPhoto::model()->findAll("ser_contract_id='$id' order by ctime");
        //根据合同id查品牌系列编号
        // $property = Property::allinfo($model->contract_id);
        //获取楼房 系列 编号
        $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['contract_id']}'");
        $data = [];
        if(!empty($models)){
            foreach ($models as $k => $v) {
                $data[$k]['property_id'] = $v['property_id'];//车源id
                $property = CmsProperty::model()->find("id = '{$v['property_id']}'");//车源信息

                $data[$k]['estate_id'] = BaseEstate::model()->find("id = '{$property['estate_id']}'")['name'];//品牌
                $data[$k]['building_id'] = BaseBuilding::model()->find("id = '{$property['building_id']}'")['name'];//系列
                $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}'")['house_no'];//编号
            }
        }
        $list_photo=[];
        if($photo){
            foreach ($photo as $key => $value) {
                $list_photo[]=$value->url;
            }
        }
        $this->render("edit",array(
            'model'=>$model,
            // 'property'=>$property[0],
            'list_photo'=>$list_photo,
            'ser_Hydropower'=>$ser_Hydropower,
            'house_no'=>$house_no,
            'type'=>$type,
            'details'=>$details,
            'amount'=>$amount,
            'data'=> $data,
        ));
    }

    public function actionEditSave()
    {

        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $creater_id=Yii::app()->session['admin_uid'];
        $actual_date =Yii::app()->request->getParam("actual_date");//实际收房日期
        $property_id =Yii::app()->request->getParam("property_id");//所在车源id
        $hualiang_id =Yii::app()->request->getParam("hualiang_id");
        $sale_id =Yii::app()->request->getParam("sale_id");
        $quality_id =Yii::app()->request->getParam("quality_id");
        $decorate_id =Yii::app()->request->getParam("decorate_id");
        $pay_method =Yii::app()->request->getParam("pay_method");
        $actual_payment =Yii::app()->request->getParam("actual_payment");
        //收房清单图片
        $list_photo =Yii::app()->request->getParam("list_photo");
        $list_photo = explode(",",$list_photo);
        array_shift($list_photo);
        // var_dump($list_photo);
        // exit;
        //合同id
        $Property = new Property();
        $contract = $Property::PurchaseContract($property_id[0]);
        if($actual_date){
            $actual_date =strtotime($actual_date);
        }
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $model =SerPurContract::model()->find("id = '$id'");
            $model->actual_date=$actual_date;
            $model->hualiang_id=$hualiang_id;
            $model->sale_id=$sale_id;
            $model->quality_id=$quality_id;
            $model->decorate_id=$decorate_id;
            $model->pay_method=$pay_method;
            $model->actual_payment=$actual_payment*100;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
            if(!empty($list_photo)){
                //收房清单图片存储
                SerContractPhoto::model()->deleteAll("ser_contract_id = '$id'");
                foreach($list_photo as $k => $v){
                    if($v){
                        $list_contract_photo = new SerContractPhoto;
                        $list_contract_photo->id = Guid::create_guid();
                        $list_contract_photo->ser_contract_id = $id;
                        $list_contract_photo->url = $v;
                        $list_contract_photo->ctime = time()+$k;
                        $list_contract_photo->deleted = 0;
                        if(!$list_contract_photo->save()){
                            $this->OutputJson(0,json_encode($list_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }
            /**
             * 特殊费用修改方法
             */
            $house_no =Yii::app()->request->getParam("house_no");//车源id
            $type =Yii::app()->request->getParam("type");//缴费类型
            $details =Yii::app()->request->getParam("details");//费用详情
            $amount =Yii::app()->request->getParam("amount");//费用金额
            $show_order =1;
            SerSpecialCost::model()->deleteAll("ser_contract_id = '$id'");
            foreach ($house_no as $k => $v) {
                    $modelSpecial = new SerSpecialCost;
                    $modelSpecial->id = Guid::create_guid();
                    $modelSpecial->ser_contract_id = $id;//收房交房列表的id
                    $modelSpecial->house_no = $v;
                    $modelSpecial->type = $type[$k];
                    $modelSpecial->details = $details[$k];
                    $modelSpecial->amount = $amount[$k]*100;
                    $modelSpecial->show_order = $show_order;
                    $modelSpecial->ctime = time();
                    $modelSpecial->deleted = 0;
                    $show_order++;
                    if(!$modelSpecial->save()){
                        $this->OutputJson(0,json_encode($modelSpecial->errors,JSON_UNESCAPED_UNICODE),null);
                    }
            }
            /**
             *水电费用修改方法
             */
            // $hydropower_type =Yii::app()->request->getParam("hydropower_type");
            $electricity_fees =Yii::app()->request->getParam("electricity_fees");
            $electricity_unit =Yii::app()->request->getParam("electricity_unit");
            $hot_water =Yii::app()->request->getParam("hot_water");
            $hot_unit =Yii::app()->request->getParam("hot_unit");
            $middle_water =Yii::app()->request->getParam("middle_water");
            $middle_unit =Yii::app()->request->getParam("middle_unit");
            $cold_water =Yii::app()->request->getParam("cold_water");
            $cold_unit =Yii::app()->request->getParam("cold_unit");
            $gas_meter =Yii::app()->request->getParam("gas_meter");
            $gas_unit =Yii::app()->request->getParam("gas_unit");
            SerHydropower::model()->deleteAll("ser_contract_id = '$id'");
            $show_orders =1;
            foreach ($electricity_fees as $k => $v) {
                $modelHydropower = new SerHydropower;
                $modelHydropower->id = Guid::create_guid();
                $modelHydropower->ser_contract_id = $id;//收房交房列表的id
                $modelHydropower->electricity_fees = $v*100;
                $modelHydropower->electricity_unit = $electricity_unit[$k];
                $modelHydropower->hot_water = $hot_water[$k]*100;
                $modelHydropower->hot_unit = $hot_unit[$k];
                $modelHydropower->middle_water = $middle_water[$k]*100;
                $modelHydropower->middle_unit = $middle_unit[$k];
                $modelHydropower->cold_water = $cold_water[$k]*100;
                $modelHydropower->cold_unit = $cold_unit[$k];
                $modelHydropower->gas_meter = $gas_meter[$k]*100;
                $modelHydropower->gas_unit = $gas_unit[$k];
                $modelHydropower->show_order = $show_orders;
                $modelHydropower->ctime = time();
                $modelHydropower->deleted = 0;
                $show_orders++;
                if(!$modelHydropower->save()){
                    $this->OutputJson(0,json_encode($modelHydropower->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }

            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/serpurcontract");

    }

    //下载图片
    public function actionDownLoad(){

            $filename = Yii::app()->request->getParam('url');
            if($filename != null){
                    $filename = Yii::app()->basePath.'/../'.$filename;
            }
            header("Content-type:text/html;charset=utf-8");

            function download($file, $down_name){
             $suffix = substr($file,strrpos($file,'.')); //获取文件后缀
             $down_name = $down_name.$suffix; //新文件名，就是下载后的名字
             //判断给定的文件存在与否
             if(!file_exists($file)){
              die("您要下载的文件已不存在，可能是被删除");
             }
             $fp = fopen($file,"r");

             $file_size = filesize($file);
             //下载文件需要用到的头
             header("Content-type: application/octet-stream");
             header("Accept-Ranges: bytes");
             header("Accept-Length:".$file_size);
             header("Content-Disposition: attachment; filename=".$down_name);
             $buffer = 1024;
             $file_count = 0;
             //向浏览器返回数据
             while(!feof($fp) && $file_count < $file_size){
              $file_con = fread($fp,$buffer);
              $file_count += $buffer;
              echo $file_con;
             }
             fclose($fp);
            }
            download($filename, '交割单图片');
    }

    public function actionDetail()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//收房列表id
        $model =SerPurContract::model()->find(" t.id='$id'");
        //水电费
        $ser_Hydropower =SerHydropower::model()->findAll("ser_contract_id='$id' order by show_order");
        //特殊费用
        $ser_SpecialCost =SerSpecialCost::model()->findAll("ser_contract_id='$id' order by show_order");
        $house_no=[];
        $type=[];
        $details=[];
        $amount=[];
        foreach($ser_SpecialCost as $k=>$value){
            $house_no[]=Property::house_no($value->house_no);
            $type[]=$value->type;
            $details[]=$value->details;
            $amount[]=$value->amount/100;
        }
        //交割单图片
        $photo=SerContractPhoto::model()->findAll("ser_contract_id='$id' order by ctime");
       //获取楼房 系列 编号
       $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['contract_id']}'");
       $data = [];
       if(!empty($models)){
           foreach ($models as $k => $v) {
               $data[$k]['property_id'] = $v['property_id'];//车源id
               $property = CmsProperty::model()->find("id = '{$v['property_id']}'");//车源信息

               $data[$k]['estate_id'] = BaseEstate::model()->find("id = '{$property['estate_id']}'")['name'];//品牌
               $data[$k]['building_id'] = BaseBuilding::model()->find("id = '{$property['building_id']}'")['name'];//系列
               $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}'")['house_no'];//编号
           }
       }
        $list_photo=[];
        if($photo){
            foreach ($photo as $key => $value) {
                $list_photo[]=$value->url;
            }
        }
        //隐患详情
        $ser_aftersales = SerAfterSales::model()->findAll("ser_contract_id='$id' order by ctime");
        // var_dump($ser_aftersales);
        // exit;
        $this->render("detail",array(
            'model'=>$model,
            'data'=> $data,
            'list_photo'=>$list_photo,
            'ser_Hydropower'=>$ser_Hydropower,
            'house_no'=>$house_no,
            'type'=>$type,
            'details'=>$details,
            'amount'=>$amount,
            'ser_aftersales'=>$ser_aftersales,
        ));
    }

    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//获取修改的合同id
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $count_sell =SerPurContract::model()->updateAll(array('deleted'=>'1'),'id=:pid',array(':pid'=>$id));//删除出车主表
            $count_photo =SerContractPhoto::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除清单表
            $count_hydropower =SerHydropower::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除水电表
            $count_special =SerSpecialCost::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除特殊费用表
            $after =SerAfterSales::model()->findAll("ser_contract_id= '$id'");//隐患表
            foreach ($after as $key => $value) {
                SerHiddenPhoto::model()->updateAll(array('deleted'=>'1'),'after_id=:pass',array(':pass'=>$value['id']));//删除隐患表
            }
            $count_after =SerAfterSales::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除隐患照片表
            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,"删除失败",null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }
         $this->redirect("/admin/serpurcontract");
    }

    //填一个编号自动获取剩余的编号
    public function actionAjaxRoom()
    {
        //获取编号
        $room_number = Yii::app()->request->getParam("room_number");
        //查看
        $model = Property::PurchaseContractAll($room_number);
        $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['id']}'");
        $data = [];
        if(!empty($models)){
            foreach ($models as $k => $v) {
                $data[$k]['property_id'] = $v['property_id'];
                $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}'")['house_no'];
            }
            header('Content-Type:application/json;charset=utf-8');
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }

    }

}
