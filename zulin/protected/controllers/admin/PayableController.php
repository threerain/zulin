<?php

class PayableController extends BackgroundBaseController
{
    //应付月房租
    public function actionIndex(){
        //车源与合同关联表
        //合同表
        //周期月租金表
        //付款方式表
        $start_date = Yii::app()->request->getParam("start_date");
        $end_date   = Yii::app()->request->getParam("end_date");
        $estates    = Yii::app()->request->getParam("estates");
        $building   = Yii::app()->request->getParam("building");
        $room_number= Yii::app()->request->getParam("room_number");
        $pagesize= Yii::app()->request->getParam("pagesize");
        $dump= Yii::app()->request->getParam("dump",'0');

        if($pagesize==''){
            $pagesize=10;
        }
        $start_date = strtotime($start_date);
        $end_date   = strtotime($end_date);
        $arr = [];
        $tmp = [];
        $tmp2 = [];

        $condition  = "1=1 and t.deleted=0 and dump = $dump ";
        if(!$start_date){
            $start_date = strtotime(date('Y-m').'-1');
        }
        if(!$end_date){
            $end_date = strtotime('+ 1 month -1 day',$start_date);
        }
        if($start_date){
            $condition .= " and pay_date >= $start_date ";
        }
        if($end_date){
            $condition .= " and pay_date <= $end_date ";
        }
        
        //车源搜索
        //如果车源三个参数齐全查出固定的合同
        $proarr1=[];
        $proarr2=[];
        $proarr3=[];
        //papers_ok
        //品牌
        if($estates){
            $estates=BaseEstate::model()->findAll("name like '%".trim($estates)."%' and deleted=0");
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
                $property=CmsProperty::model()->findAll("estate_id in ($estates_id)");
                foreach ($property as $key => $value) {
                        $proarr1[] = $value->id;
                }
            }
        }

        //系列
        if($building){
            $building=BaseBuilding::model()->findAll("name like '%".$building."%'  and deleted=0");
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
                $property2=CmsProperty::model()->findAll("building_id in ($building_id)");
                foreach ($property2 as $key => $value) {
                    $proarr2[] = $value->id;
                }
            }
        }
        //编号
        if($room_number){
            $property3=CmsProperty::model()->findAll("house_no like '%".$room_number."%' and deleted=0");
            foreach ($property3 as $key => $value) {
                $proarr3[] = $value->id;
            }
        }


        if(!empty($estates) && !empty($building) && !empty($room_number)){
            $res_arr = array_intersect($proarr1,$proarr2,$proarr3);
        }else if(!empty($estates) && !empty($building)){
            $res_arr = array_intersect($proarr1,$proarr2);
        }else if(!empty($building) && !empty($room_number)){
            $res_arr = array_intersect($proarr2,$proarr3);
        }else if(!empty($estates) && !empty($room_number)){
            $res_arr = array_intersect($proarr1,$proarr3);
        }else{
            $res_arr=array_merge($proarr1,$proarr2,$proarr3);
        }
        $data=[];
        foreach($res_arr as $value ){
            $data[]=$value;
        }


        $property_id='';
        foreach ($data as $key => $value) {
            if ($key==0){
                $property_id.="'".$value."'";
            }
            else{
                $property_id.=","."'".$value."'";
            }
        }

        $contract_id="";
        if($property_id){
            $contract_id="";
            $res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.") and type=0");
            foreach($res as $key=>$value){
                if ($key==0){
                    $contract_id.="'".$value->contract_id."'";
                }
                else{
                    $contract_id.=","."'".$value->contract_id."'";
                }
            }
            if($contract_id!=''){
                $condition .=" and contract_id in ($contract_id) ";
            }else{
                $condition .=" and 1=0 ";
            }
        }


        $criteria=new CDbCriteria;
        $criteria->condition=$condition;
        $criteria->order="t.pay_date ";
        $count = CmsPurchasePayable::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $data = CmsPurchasePayable::model()->findAll($criteria);

        //条数正确
        $order = 0;    $a = 0; $sum =0; $sum_ya =0;

        foreach ($data as $key => $value) {
            //根据合同ID查出产权人或者公司（法人）
            $owner_type = CmsPurchaseContract::model()->find(" id = '$value->contract_id' and type = 0 and deleted =0 and status in (0,-1) ");

            if($owner_type){
                
                //根据合同ID查询所有的车源
                if($owner_type->id!=''){
                    $property = Property::allinfo($owner_type->id);
                }
                $arr[$key]['contract_id'] = $owner_type->id;
                $arr[$key]['property'] = $property;
                $arr[$key]['payable'] = $value;
                $arr[$key]['company']='';
                $arr[$key]['owner']=[];
                $arr[$key]['mobile'] =[];
                $arr[$key]['ya'] = '';
                $arr[$key]['pay'] = ''; 
                $arr[$key]['bank'] ='';
                $arr[$key]['banaccount'] ='';
                $arr[$key]['payee'] ='';
                $arr[$key]['wuye'] =0;
                $arr[$key]['qunuan'] =0;
                $arr[$key]['pay_id'] =$value->id;
                $arr[$key]['dump']   =$value->dump;

                if($owner_type->owner_type==1){
                    //车主类型为公司
                    $company = CmsCompany::model()->find(" contract_id = '$owner_type->id'");
                    // var_dump($company->company_name);
                    $arr[$key]['company'] = $company->company_name;
                    $arr[$key]['mobile'][0] =$company ->contractor_phone;

                }elseif ($owner_type->owner_type==2) {
                    //车主类型为个人
                    $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$owner_type->id' and type=1");
                    // var_dump($owner);
                    foreach ($owner as $ko => $vo) {
                        $ownername = CmsOwner::model()->find("id = '$vo->owner_id'");
                        //tmp此处为车主名字的数组集合
                       $tmp[] = $ownername->name; $tmp2[] =$ownername->mobile;
                    }
                    // var_dump($tmp);
                    $arr[$key]['owner'] =$tmp;
                    $arr[$key]['mobile'] =$tmp2;
                    $tmp =[];
                    $tmp2 =[];
                }   
                //收款银行
                $arr[$key]['bank'] =$owner_type->bank;
                $arr[$key]['bank_account'] =$owner_type->bank_account;

                $arr[$key]['payee'] =$owner_type->payee; 
                //押金
                if($value->the_order ==0){
                    $arr[$key]['yajin'] = $arr[$key]['payable']->amount;//押金
                    $arr[$key]['payable']->amount = 0;
                }else{
                    $arr[$key]['yajin'] = 0;
                }
                $sum_ya += $arr[$key]['yajin'];   
                $sum += $arr[$key]['payable']->amount;          
                //查出该时间段内的付款方式
                $start_time = $arr[$key]['payable']->start_time;
                $end_time = $arr[$key]['payable']->end_time;
                //判断时间
                $paykind = null;
                $paykind = CmsDepositPay::model()->find("contract_id = '$owner_type->id' and start_time <= $start_time and end_time >= $end_time");
                if($paykind){
                    $arr[$key]['ya'] = $paykind->deposit_month;
                    $arr[$key]['pay'] = $paykind->pay_month;                
                }                          
            }
        }
        $estates    = Yii::app()->request->getParam("estates");
        $building   = Yii::app()->request->getParam("building");
        $room_number= Yii::app()->request->getParam("room_number");
        $this->render('index',array(
            'list'=>$arr,
            'sum'=>$sum/100,
            'sum_ya'=>$sum_ya/100,
            'pages'=>$pager,
            'start_date' => $start_date ,
            'end_date' => $end_date  , 
            'room_number'=>$room_number,
            'building'=>$building,
            'estates'=>$estates,
            'pagesize'=>$pagesize,
            'dump'=>$dump,

            ));
    }
    //应收月房租
    public function actionIndexs(){
        //车源与合同关联表
        //合同表
        //周期月租金表
        //付款方式表
        $start_date = Yii::app()->request->getParam("start_date");
        $end_date   = Yii::app()->request->getParam("end_date");
        $estates    = Yii::app()->request->getParam("estates");
        $building   = Yii::app()->request->getParam("building");
        $room_number= Yii::app()->request->getParam("room_number");
        $pagesize= Yii::app()->request->getParam("pagesize");

        if($pagesize==''){
            $pagesize=10;
        }
        $start_date = strtotime($start_date);
        $end_date   = strtotime($end_date);
        $arr = [];
        $tmp = [];
        $tmp2 = [];

        $condition  = "1=1 and t.deleted=0 ";
        if(!$start_date){
            $start_date = strtotime(date('Y-m').'-1');
        }
        if(!$end_date){
            $end_date = strtotime('+ 1 month -1 day',$start_date);
        }
        if($start_date){
            $condition .= " and pay_date >= $start_date ";
        }
        if($end_date){
            $condition .= " and pay_date <= $end_date ";
        }
        //车源搜索
        //如果车源三个参数齐全查出固定的合同
        $proarr1=[];
        $proarr2=[];
        $proarr3=[];
        //papers_ok
        //品牌
        if($estates){
            $estates=BaseEstate::model()->findAll("name like '%".$estates."%' and deleted=0");
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
                $property=CmsProperty::model()->findAll("estate_id in ($estates_id)");
                foreach ($property as $key => $value) {
                        $proarr1[] = $value->id;
                }
            }
        }

        //系列
        if($building){
            $building=BaseBuilding::model()->findAll("name like '%".$building."%'  and deleted=0");
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
                $property2=CmsProperty::model()->findAll("building_id in ($building_id)");
                foreach ($property2 as $key => $value) {
                    $proarr2[] = $value->id;
                }
            }
        }
        //编号
        if($room_number){
            $property3=CmsProperty::model()->findAll("house_no like '%".$room_number."%' and deleted=0");
            foreach ($property3 as $key => $value) {
                $proarr3[] = $value->id;
            }
        }


        if(!empty($estates) && !empty($building) && !empty($room_number)){
            $res_arr = array_intersect($proarr1,$proarr2,$proarr3);
        }else if(!empty($estates) && !empty($building)){
            $res_arr = array_intersect($proarr1,$proarr2);
        }else if(!empty($building) && !empty($room_number)){
            $res_arr = array_intersect($proarr2,$proarr3);
        }else if(!empty($estates) && !empty($room_number)){
            $res_arr = array_intersect($proarr1,$proarr3);
        }else{
            $res_arr=array_merge($proarr1,$proarr2,$proarr3);
        }
        $data=[];
        foreach($res_arr as $value ){
            $data[]=$value;
        }

        $property_id='';
        foreach ($data as $key => $value) {
            if ($key==0){
                $property_id.="'".$value."'";
            }
            else{
                $property_id.=","."'".$value."'";
            }
        }

        $contract_id="";
        if($property_id){
            $contract_id="";
            $res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.") and type=1");
            foreach($res as $key=>$value){
                if ($key==0){
                    $contract_id.="'".$value->contract_id."'";
                }
                else{
                    $contract_id.=","."'".$value->contract_id."'";
                }
            }
            if($contract_id!=''){
                $condition .=" and contract_id in ($contract_id) ";
            }else{
                $condition .=" and 1=0 ";

            }
        }

        $criteria=new CDbCriteria;
        $criteria->condition=$condition;
        $criteria->order="t.pay_date and t.contract_id ";
        // $criteria->join="RIGHT JOIN cms_purchase_contract c ON c.id = t.contract_id and c.type =1 and c.status = 0 ";
        $count = CmsPurchaseReceivable::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $data = CmsPurchaseReceivable::model()->findAll($criteria);
        $order = 0;
        $sum = 0;
        $sum = 0;
        foreach ($data as $key => $value) {

            //根据合同ID查出产权人或者公司（法人）
            $owner_type = CmsPurchaseContract::model()->find(" id = '$value->contract_id' and type = 1 and deleted =0 and status in (0,-1)");
            if($owner_type){
                //根据合同ID查询所有的车源
                if($owner_type->id!=''){
                    $property = Property::allinfo($owner_type->id);
                }
                $sum += $value->amount;
                $arr[$key]['contract_id'] = $value->contract_id;
                $arr[$key]['property'] = $property;
                $arr[$key]['payable'] = $value;

                $arr[$key]['company']='';
                $arr[$key]['owner']=[];
                $arr[$key]['mobile'] =[];
                $arr[$key]['banaccount'] ='';
                $arr[$key]['ya'] = '';
                $arr[$key]['pay'] = ''; 
                $arr[$key]['bank'] ='';
                $arr[$key]['payee'] ='';
                $arr[$key]['wuye'] =0;
                $arr[$key]['qunuan'] =0;
                $arr[$key]['recieve_id'] =$value->id;
                if($owner_type->lessee_type==1){
                    //承租人类型为公司
                    $company = CmsCompany::model()->find(" contract_id = '$owner_type->id'");
                    if($company){
                        $arr[$key]['company'] = $company->company_name;
                        $arr[$key]['mobile'][0] =$company ->contractor_phone;                        
                    }
                }elseif ($owner_type->lessee_type==2) {
                    //承租人类型为个人
                    $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$owner_type->id' and type=1");
                    foreach ($owner as $ko => $vo) {
                        $ownername = CmsOwner::model()->find("id = '$vo->owner_id'");
                        //tmp此处为车主名字的数组集合
                       $tmp[] = $ownername->name; $tmp2[] =$ownername->mobile;
                    }
                    $arr[$key]['owner'] =$tmp;
                    $arr[$key]['mobile'] =$tmp2;
                    $tmp =[];
                    $tmp2 =[];
                }   
                //收款银行
                $arr[$key]['bank'] =$owner_type->bank;
                $arr[$key]['bank_account'] =$owner_type->bank_account;
                //收款人
                $arr[$key]['payee'] =$owner_type->payee; 
                //押金
                if($value->the_order ==0){
                    $arr[$key]['yajin'] = $arr[$key]['payable']->amount;
                    $arr[$key]['payable']->amount = 0;
                }else{
                    $arr[$key]['yajin'] = 0;
                }  
                $sum_ya += $arr[$key]['yajin'];
                /*
                 *查出该时间段内的付款方式

                 */
                $start_time = $arr[$key]['payable']->start_time;
                $end_time = $arr[$key]['payable']->end_time;
                //判断时间
                $paykind = null;
                $paykind = CmsDepositPay::model()->find("contract_id = '$owner_type->id' and start_time <= $start_time and end_time >= $end_time");

                if($paykind){
                    $arr[$key]['ya'] = $paykind->deposit_month;
                    $arr[$key]['pay'] = $paykind->pay_month;                
                }else{
                    //如果合同录入出现错误，抛出错误。
                    
                    throw new Exception("ID为".$owner_type->id."的合同，在开始时间为".date('Y-m-d',$start_time)."结束时间为".date('Y-m-d',$end_time)."押几付几的日期出现异常，请去合同修正"); 
                }                      
            }
        }

        $estates    = Yii::app()->request->getParam("estates");
        $building   = Yii::app()->request->getParam("building");
        $room_number= Yii::app()->request->getParam("room_number");
        $this->render('indexs',array(
            'list'=>$arr,
            'sum'=>$sum/100,
            'sum_ya'=>$sum_ya/100,
            'pages'=>$pager,
            'start_date' => $start_date ,
            'end_date' => $end_date  , 
            'room_number'=>$room_number,
            'building'=>$building,
            'estates'=>$estates,

            ));
    }
    //应收月房租编辑（主要为催缴记录）
    public function actionEdityuerecieve(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id = Yii::app()->request->getParam('id');
        $owner = Yii::app()->request->getParam('owner');
        $owner = explode(',', $owner );
        $contract_id = Yii::app()->request->getParam('contract_id');
        $model = PayPhoneRecord::model()->findAll("payable_id = '$id'");

        $contract =  CmsPurchaseContract::model()->find("id = '$contract_id'");

        //如果为公司,签约人电话
        if($contract->lessee_type==1){
            $company = CmsCompany::model()->find("contract_id = '$contract_id'");
            //如果两个号码的，以/分割开的取出来
            $ren['contractor_phone'] = explode('/',$company->contractor_phone);
            $ren['contractor'] = $company->contractor;
        }else{
            //承租人电话  代理人电话
            $owner = CmsPurchaseContractOwner::model()->findAll("contract_id = '$contract_id' and  type=1;");
            $agent    = CmsPurchaseContractOwner::model()->find("contract_id = '$contract_id' and  type=2;");

            foreach ($owner as $key => $value) {

                $ren['owner'] = CmsOwner::model()->find("id = '$value->owner_id'")->name;
                $ren['owner_phone'] = explode('/',CmsOwner::model()->find("id = '$value->owner_id'")->mobile);

            }
            foreach ($agent as $key => $value) {

                $ren['agent'] = CmsOwner::model()->find("id = '$value->owner_id'")->name;
                $ren['agent_phone'] = explode('/',CmsOwner::model()->find("id = '$value->owner_id'")->mobile);

            } 
            
        }

        $this->render('edityue',array(
            'referer'=>$referer,
            'owner'=>$owner,
            'contract_id'=>$contract_id,
            'id'=>$id,
            'model'=>$model,
            'ren'=>$ren,
            'type'=>$contract->lessee_type,
            ));
    }
    public function actionSaveyuerecieve(){

        $contract_id = Yii::app()->request->getParam('contract_id');
        $id = Yii::app()->request->getParam('id');
        $count = PayPhoneRecord::model()->count("payable_id = '$id'");
        $call_time = Yii::app()->request->getParam('call_time');
        $count_time = count($call_time);
        $last = array_pop($call_time );
        $cjjl = Yii::app()->request->getParam('cjjl');
        $last_cjjl = array_pop($cjjl );
        //查出这个应付的催缴记录条数
        if($count!=$count_time){
            try{
                $model = new PayPhoneRecord();
                $model->id =Guid::create_guid();
                $model->contract_id =  $contract_id ;
                $model->payable_id = $id;
                $model->call_time = strtotime($last);
                $model->memo = $last_cjjl;
                if(!$model->save()){
                    $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
                }             
            }catch(Exception $e){
                $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            }
        }


        $this->OutputJson(301,'','/admin/payable/indexs');

    }
    //应付编辑视图
    public function actionEditpay(){
        //接收应收ID
        $id =Yii::app()->request->getParam("id");
        $contract_id =Yii::app()->request->getParam("contract_id");
        $model = CmsPurchasePayable::model()->find(" id ='$id'");
        $referer=$_SERVER['HTTP_REFERER'];
        //根据应用id查出对应的车主，和联系方式，以及应该
        $this->render('editpay',array(
            'referer'=>$referer,    
            'model'=>$model,
            'contract_id'=>$contract_id,
            ));
    }
    //应付删除
    public function actionDeletepay(){
        //接收应收ID
        $id =Yii::app()->request->getParam("id");
        $contract_id =Yii::app()->request->getParam("contract_id");
        $model = CmsPurchasePayable::model()->find(" id ='$id'");
        $referer=$_SERVER['HTTP_REFERER'];
        $model->deleted =1;
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }else{
            $this->redirect($referer);
        }
        
    }
    //手动添加应付
    public function actionAddpay(){

        $contract_id =Yii::app()->request->getParam("contract_id");
        $referer=$_SERVER['HTTP_REFERER'];
        $this->render('addpay',array(
        'referer'=>$referer,    
        'contract_id'=>$contract_id,    
        )); 
    }
    //新增应付的保存
    public function actionSaveAddPay(){

        $contract_id =Yii::app()->request->getParam("contract_id");
        $pay_date =Yii::app()->request->getParam("pay_date");
        $start_time =Yii::app()->request->getParam("start_time");
        $end_time =Yii::app()->request->getParam("end_time");
        $amount =Yii::app()->request->getParam("amount")*100;
        $invoice =Yii::app()->request->getParam("invoice");

        $model = new CmsPurchasePayable();
        $model->id = Guid::create_guid();
        $model->pay_date = strtotime($pay_date);
        $model->contract_id = $contract_id;
        $model->start_time = strtotime($start_time);
        $model->end_time = strtotime($end_time);
        $model->amount = $amount;
        $model->invoice = $invoice;  
        $model->ctime = time();  
        $model->deleted=0 ;
        $model->type = 2;  
        $model->the_order = 100;  
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }

        $this->OutputJson(301,'',"/admin/purchasecontract/payable/id/".$contract_id);

        $referer=$_SERVER['HTTP_REFERER'];
        $this->render('editpay',array(
        'referer'=>$referer,    
        ));   
    }
    //收购应付存储
    public function actionSavepay(){

        $id =Yii::app()->request->getParam("id");
        $pay_date =Yii::app()->request->getParam("pay_date");
        $start_time =Yii::app()->request->getParam("start_time");
        $end_time =Yii::app()->request->getParam("end_time");
        $amount =Yii::app()->request->getParam("amount")*100;
        $invoice =Yii::app()->request->getParam("invoice");
        try{
            $model = CmsPurchasePayable::model()->find(" id ='$id'");
            $model->pay_date = strtotime($pay_date);
            $model->start_time = strtotime($start_time);
            $model->end_time = strtotime($end_time);
            $model->amount = $amount;
            $model->invoice = $invoice;  
            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }          
        }catch(Exception $e){
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/purchasecontract/payable/id/".$model->contract_id);
    }
    //应收编辑视图
    public function actionEditrecieve(){
        //接收应收ID
        $id =Yii::app()->request->getParam("id");
        $model = CmsPurchaseReceivable::model()->find(" id ='$id'");
        $referer=$_SERVER['HTTP_REFERER'];
        //根据应用id查出对应的车主，和联系方式，以及应该
        $this->render('editrecieve',array(
            'referer'=>$referer,    
            'model'=>$model,
            ));
    }
    //销售应收存储
    public function actionSaverecieve(){
        $id =Yii::app()->request->getParam("id");
        $pay_date =Yii::app()->request->getParam("pay_date");
        $start_time =Yii::app()->request->getParam("start_time");
        $end_time =Yii::app()->request->getParam("end_time");
        $amount =Yii::app()->request->getParam("amount")*100;
        $invoice =Yii::app()->request->getParam("invoice");
        try{
            $model = CmsPurchaseReceivable::model()->find(" id ='$id'");
            $model->pay_date = strtotime($pay_date);
            $model->start_time = strtotime($start_time);
            $model->end_time = strtotime($end_time);
            $model->amount = $amount;
            $model->invoice = $invoice;  
            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }          
        }catch(Exception $e){
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/salecontract/payable/id/".$model->contract_id);
    }
    //销售应收新增视图
    public function actionAddRecieve(){

        $contract_id =Yii::app()->request->getParam("contract_id");

        $referer=$_SERVER['HTTP_REFERER'];
        $this->render('addrecieve',array(
        'referer'=>$referer,    
        'contract_id'=>$contract_id,    
        )); 
    }
    public function actionDeleteRecieve(){
        //接收应收ID
        $id =Yii::app()->request->getParam("id");
        $contract_id =Yii::app()->request->getParam("contract_id");
        $model = CmsPurchaseReceivable::model()->find(" id ='$id'");
        $referer=$_SERVER['HTTP_REFERER'];
        $model->deleted =1;
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }else{
            $this->redirect($referer);
        }
    }
    //销售应收新增视图->保存
    public function actionSaveAddRecieve(){
        $contract_id =Yii::app()->request->getParam("contract_id");
        $pay_date =Yii::app()->request->getParam("pay_date");
        $start_time =Yii::app()->request->getParam("start_time");
        $end_time =Yii::app()->request->getParam("end_time");
        $amount =Yii::app()->request->getParam("amount")*100;
        $invoice =Yii::app()->request->getParam("invoice");

        $model = new CmsPurchaseReceivable();
        $model->id = Guid::create_guid();
        $model->pay_date = strtotime($pay_date);
        $model->contract_id = $contract_id;
        $model->start_time = strtotime($start_time);
        $model->end_time = strtotime($end_time);
        $model->amount = $amount;
        $model->invoice = $invoice;  
        $model->ctime = time();  
        $model->deleted=0 ;
        $model->type = 2;  
        $model->the_order = 100;  
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }

        $this->OutputJson(301,'',"/admin/salecontract/payable/id/".$contract_id);

        $referer=$_SERVER['HTTP_REFERER'];
        $this->render('editpay',array(
        'referer'=>$referer,    
        ));   
    }
    //批量修改日期
    public function actionEditpaydate(){
        $referer=$_SERVER['HTTP_REFERER'];
        $contract_id = Yii::app()->request->getParam("contract_id");
        $day = Yii::app()->request->getParam("day");
        $type = Yii::app()->request->getParam("type");
        if($type==1){
            $purchasepayble = CmsPurchasePayable::model()->findAll("contract_id = '$contract_id' and the_order >0");
            foreach ($purchasepayble as $key => $value) {
                if($day>0){
                    $value->pay_date = strtotime("+ $day days",$value->pay_date);
                }else{
                    $value->pay_date = strtotime(" $day days",$value->pay_date);
                }
                if(!$value->save()){
                    $this->OutputJson(0,json_encode($value->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
        }else{
            $purchasereceivable = CmsPurchaseReceivable::model()->findAll("contract_id = '$contract_id' and the_order >0");
            foreach ($purchasereceivable as $key => $value) {
                if($day>0){
                    $value->pay_date = strtotime("+ $day days",$value->pay_date);
                }else{
                    $value->pay_date = strtotime(" $day days",$value->pay_date);
                }
                if(!$value->save()){
                    $this->OutputJson(0,json_encode($value->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
        }
        $this->redirect($referer);

    }

    public function actionDumpCashOut(){

        $id = Yii::app()->request->getParam("id");
        $payable = CmsPurchasePayment::model()->find("payable_id = '$id'");
        $property = Property::allinfo($payable->contract_id);//车源所有信息
        foreach ($property as $key => $value) {
            $project .= $value['estate_name'].$value['building_name'].$value['house_no'].';';//项目名称
        }
        $rmb =$this->num_to_rmb($payable->amount/100);//人民币大写
        $contract = CmsPurchaseContract::model()->find(" id = '$payable->contract_id' and type = 0 and deleted =0 and status in (0,-1) ");

        preg_match('/([\d]{4})([\d]{4})([\d]{4})([\d]{4})([\d]{0,})?/', $contract->bank_account,$match);
        unset($match[0]);
        $bank_account =  implode(' ', $match);//开户行账号
        $proposer = AdminUser::model()->find("id = '$_SESSION[admin_uid]'")->nickname;//申请人
        $paykind = CmsDepositPay::model()->find("contract_id = '$payable->contract_id' and start_time <= $payable->start_time and end_time >= $payable->end_time");
        
        //查找收款人的信息，根据合同ID
        $receive =FinReceivables::model()->find("contract_id = '$payable->contract_id'");

// 
        echo '<style>
            .printbottom{margin-bottom:280px;}
            .printbottom:last-child{margin-bottom:0px;}
            table{margin-left:30px;}
            div{margin-left:30px;}
            </style>
            <table width="850"  border="1" style="border-collapse:collapse!important">
            <caption><h2> 支 出 凭 单</h2><!--<p style="text-align:left;padding:0;margin:0;">No:'.$payable->id.'</p> --></caption> 
            <tbody>
               <tr >
                 <td height="40" width="230" ><div align="left">附单据&nbsp;&nbsp;张</div></td>
                 <td width="300">&nbsp;&nbsp;&nbsp;&nbsp;'.date("Y年m月d日",$payable->payment_date).'</td>
                 <td height="40" colspan="2"><b>第&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号</b></td>
               </tr>
               <tr>
                    <td width="255" height="150"><div align="center"><b>付款摘要</b></div></td>
                    <td colspan="3">
                        <div align="left">
                            <b>项 目:</b>'.$project.'
                            <br><br><b>租 期:</b>'.date("Y年m月d日",$payable->start_time).'-'.date("Y年m月d日",$payable->end_time).'<br><br>
                            <b>付款方式:</b>押'.$paykind->deposit_month.'付'.$paykind->pay_month.'
                        </div>
                    </td>
               </tr>
               <tr >
                 <td height="30" height="25"><div align="center"><b>计人民币</b></div></td>
                 <td height="30" colspan="3"><div >'.$rmb.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;¥<u style="text-decoration:none;border-bottom:1px solid #555;padding-bottom:2px;">'.number_format($payable->amount/100,2).'元</u></div></td>
               </tr>
               <tr >
                 <td height="25" height="30"><div align="center"><b>收款人/单位名称</b></div></td>
                 <td height="25" colspan="3"><div align="center">'.$contract->payee.'</div></td>
               </tr>
               <tr>
                 <td height="25"><div align="center"><b>开户银行</b></div></td>
                 <td height="25" colspan="3"><div align="center">'.$contract->bank.'</div></td>
               </tr>
               <tr>
                 <td height="25"><div align="center"><b>银行账号</b></div></td>
                 <td height="25" colspan="3"><div align="center">'.$bank_account.'</div></td>
               </tr>
               <tr>
                    <td height="80"><div align="center"><b>租户收款信息</b></div></td>
                    <td height="80" colspan="3"><div align="left"><b>租期:</b>'.$a = $receive?date("Y年m月d日",$receive->cycle_start).'-':''.$b = $receive?date("Y年m月d日",$receive->cycle_end):''.'<b><br><br>金额:</b>'.$money = $receive?number_format($receive->payee_money/100,2).'元':''.'</div></td>
               </tr>

                </tbody>
               </table>
               <div align="left" class="printbottom" ><b>财务主管：</b>'.$h.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>记账：</b>'.$h.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>出纳：</b>'.$g.' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>审核：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><b>制单：'.$proposer.'</b></div>';
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
                return "零元整";
            }else{
                return $c . "整";
            }
            }

    /*
    付款进行拆分，留下余额和下次付款日期
     */
                          
    public function actionSplit(){
        //接收应收ID
        $id =Yii::app()->request->getParam("id");
        $contract_id =Yii::app()->request->getParam("contract_id");
        $model = CmsPurchasePayable::model()->find(" id ='$id'");
        $referer=$_SERVER['HTTP_REFERER'];
        //根据应用id查出对应的车主，和联系方式，以及应该
        $this->render('split',array(
            'referer'=>$referer,    
            'model'=>$model,
            'contract_id'=>$contract_id,
            ));
    }

    /**
     *付款拆分的保存，主要功能为保存拆出来的数据（用户录入）
     *另外将原有的数据更改日期与金额
     * 
     */
    
    public function actionSplitSave(){

        try {
            //1.第一条添加新的数据
            $contract_id =Yii::app()->request->getParam("contract_id");
            $pay_date =Yii::app()->request->getParam("pay_date");
            $start_time =Yii::app()->request->getParam("start_time");
            $end_time =Yii::app()->request->getParam("end_time");
            $amount =Yii::app()->request->getParam("amount")*100;
            $invoice =Yii::app()->request->getParam("invoice");
            $id =Yii::app()->request->getParam("id");//应收id
            $oldmodel = CmsPurchasePayable::model()->find(" id ='$id'"); 
            $transaction1 = Yii::app()->db->beginTransaction(); //开启事务

            $model = new CmsPurchasePayable();
            $model->id = Guid::create_guid();
            $model->pay_date = strtotime($pay_date);
            $model->contract_id = $contract_id;
            $model->start_time = strtotime($start_time);
            $model->end_time = strtotime($end_time);
            $model->amount = $amount;
            $model->invoice = $invoice;  
            $model->ctime = time();  
            $model->deleted=0 ;
            $model->type = $oldmodel->type;
            $model->the_order = $oldmodel->the_order;  
            if($oldmodel->type==1){
                $model->the_order = 1;  
            }
            $model->status = 1;  
            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors.'新增出错',JSON_UNESCAPED_UNICODE),null);
            }

            //2.将旧数据减去金额，和对应正确的日期
 
            $end_time = strtotime($end_time);
            $oldmodel->pay_date = strtotime('+1 day',$end_time);//付款日  
            $oldmodel->contract_id = $contract_id;
            $oldmodel->start_time = strtotime('+1 day',$end_time);//租期开始时间
            //结束时间不动
            $oldmodel->amount =$oldmodel->amount - $amount;//金额 = 金额-提交的金额
            $oldmodel->invoice = $invoice;  //发票
            $oldmodel->ctime = time();  
            $oldmodel->deleted=0 ;
            $oldmodel->status = 1;  
            if(!$oldmodel->save()){
                $this->OutputJson(0,json_encode($model->errors.'旧改出错',JSON_UNESCAPED_UNICODE),null);
            }
            $transaction1->commit(); //提交事务会真正的执行数据库操作
        }catch (Exception $e){
            $this->OutputJson(0,json_encode($e.'事务出错',JSON_UNESCAPED_UNICODE),null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }

        $this->OutputJson(301,'',"/admin/purchasecontract/payable/id/".$contract_id);

    }
    /**
     * 此处为合并多个付款，主要针对二次谈判导致的付款金额和日期大幅度更改。
     * @return [type] [description]
     */
    public function actionCombine(){

        $contract_id =Yii::app()->request->getParam("contract_id");
        $id =Yii::app()->request->getParam("id");


        $ids= implode("','",$_POST['id']);

        $payables = CmsPurchasePayable::model()->findAll("id in ('$ids') order by pay_date");

        foreach ($payables as $key => $value) {
            $amount += $value->amount;
            $the_order = $value->the_order;
        }

        $model = new CmsPurchasePayable();
        $model->id = Guid::create_guid();
        $model->pay_date = $payables[0]->pay_date;;
        $model->contract_id = $contract_id;
        $model->start_time = $payables[0]->start_time;
        $model->end_time = $payables[count($payables)-1]->end_time;
        $model->amount = $amount;
        $model->invoice = $invoice;  
        $model->ctime = time();  
        $model->deleted=0 ;
        $model->type = 2;  
        $model->the_order = $the_order;  
        $model->status = 1;  
        CmsPurchasePayable::model()->deleteAll("id in ('$ids') order by pay_date");

        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }

    }

    //付款
    public function actionPayment(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $payable=CmsPurchasePayable::model()->find("t.id='$id'");

        $this->render("payment",array(
            'referer'=>$referer,
            'id'=>$id,
            'payable'=>$payable,
        ));
    }

    //发起付款单子
    public function actionPaymentSave(){

        $payable_id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");
        $memo=Yii::app()->request->getParam("memo");
        $payable=CmsPurchasePayable::model()->find("t.id='$payable_id'");
        $contract=CmsPurchaseContract::model()->find("t.id='$payable->contract_id'");

        try {

            //判断一下，防止重复提交单子，污染数据
            $result = CmsPurchasePayment::model()->find("payable_id = '$payable_id'");
            $result2 = CmsPurchasePayment::model()->find("payable_id = '$payable_id'and start_time = $payable->start_time and end_time = $payable->end_time");
            if($result || $result2){
                $this->OutputJson(0,'付款支出单已经提交',null);
                return false;
            }


            $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
            $payable->dump = 1;//保存后将原来的应付状态进行更改。
            if (!$payable->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$payable->errors,null);
                }
            }    
            $model =new CmsPurchasePayment();
            $model->id=Guid::create_guid();
            $model->contract_id=$payable->contract_id;
            $model->payable_id=$payable_id;
            $model->start_time=$payable->start_time;
            $model->end_time=$payable->end_time;
            $model->type=$payable->type;
            $model->creater_id=Yii::app()->session['admin_uid'];
            $model->amount=$payable->amount;
            $model->payment_date=$payable->pay_date;
            $model->memo=$memo;
            $model->deleted=0;
            $model->ctime=time();
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }        
            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {

            $this->OutputJson(0,json_encode($e.'事务出错',JSON_UNESCAPED_UNICODE),null);
            $transaction1->rollback(); //如果操作失败, 数据回滚

        }
        $this->OutputJson(301,'',$referer);

    }



}
