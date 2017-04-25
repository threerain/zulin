<?php

class SerSellContractController extends BackgroundBaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

    public $title='出车';

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $keyword_admin =trim(Yii::app()->request->getParam("keyword_admin"));
        $search =Yii::app()->request->getParam("search");
        $keyword_area =trim(Yii::app()->request->getParam("keyword_area"));
        $keyword_estates =trim(Yii::app()->request->getParam("keyword_estates"));
        $keyword_building =trim(Yii::app()->request->getParam("keyword_building"));
        $keyword_room_number =trim(Yii::app()->request->getParam("keyword_room_number"));
        $keyword_ctime3 =Yii::app()->request->getParam("keyword_ctime3");//start 规定交房日期
        $keyword_ctime4 =Yii::app()->request->getParam("keyword_ctime4");//end  规定交房日期
        $keyword_ctime5 =Yii::app()->request->getParam("keyword_ctime5");//start 实际交房日期
        $keyword_ctime6 =Yii::app()->request->getParam("keyword_ctime6");//end 实际交房日期
        $k_source =Yii::app()->request->getParam("k_source");
        // $keyword_ctime7 =Yii::app()->request->getParam("keyword_ctime7");//start  规定车主维修结束日期
        // $keyword_ctime8 =Yii::app()->request->getParam("keyword_ctime8");//end  规定车主维修结束日期



        //出车搜索
        $condition = "1=1 and deleted=0  ";
        //外勤人
        if(!empty($keyword_admin)){
            $admin=AdminUser::model()->findAll("nickname like '%".$keyword_admin."%'");
            $admin_id="";
            foreach ($admin as $key => $value) {
                if ($key==0){
                    $admin_id.="'".$value->id."'";
                }
                else{
                    $admin_id.=","."'".$value->id."'";
                }

            }
            if(!empty($admin_id)) {
                $condition.=" and creater_id in (".$admin_id.")";
            }else{
                $condition.=" and creater_id in ('')";
            }
        }
        //来源
        if($k_source==车主){
            $condition.=" and source = 0 ";
        }

        if($k_source==租户){
            $condition.=" and source = 1 ";
        }


        if($keyword_ctime5){//实际交房日期
            $keyword_ctime5s = strtotime($keyword_ctime5);
            $condition .= " and actual_date >= '$keyword_ctime5s' ";
        }
        if($keyword_ctime6){//实际交房日期
            $keyword_ctime6s = strtotime($keyword_ctime6);
            $condition .= " and actual_date <= '$keyword_ctime6s' ";
        }
        // if($keyword_ctime7){//规定车主维修开始日期
        //     $keyword_ctime7s = strtotime($keyword_ctime7);
        //     $condition .= " and hope_end_time >= '$keyword_ctime7s' ";
        // }
        // if($keyword_ctime8){//规定车主维修结束日期
        //     $keyword_ctime8s = strtotime($keyword_ctime8);
        //     $condition .= " and hope_end_time <= '$keyword_ctime8s' ";
        // }
        if($keyword_ctime3){//规定交房日期
            $keyword_ctime3s = strtotime($keyword_ctime3);
            $condition .= " and set_date >= '$keyword_ctime3s' ";
        }
        if($keyword_ctime4){//规定实际交房日期
            $keyword_ctime4s = strtotime($keyword_ctime4);
            $condition .= " and set_date <= '$keyword_ctime4s' ";
        }
        /*
            根据车源查出车源的ID对应上合同
         */
        //如果车源四个参数齐全查出固定的合同
        $proarr0=[];
        $proarr1=[];
        $proarr2=[];
        $proarr3=[];
        //商圈
        if($keyword_area){
            $areas=BaseArea::model()->findAll("name like '%".$keyword_area."%' and deleted=0");
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
                $property=CmsProperty::model()->findAll("area_id in ($areas_id)");
                foreach ($property as $key => $value) {
                        $proarr0[] = $value->id;
                }
            }
        }

        //品牌
        if($keyword_estates){
            $estates=BaseEstate::model()->findAll("name like '%".$keyword_estates."%' and deleted=0");
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
        if($keyword_building){
            $building=BaseBuilding::model()->findAll("name like '%".$keyword_building."%'  and deleted=0");
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
        if($keyword_room_number){
            $property3=CmsProperty::model()->findAll("house_no like '%".$keyword_room_number."%' and deleted=0");
            foreach ($property3 as $key => $value) {
                $proarr3[] = $value->id;
            }
        }
        if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_room_number)){
            $res_arr = array_intersect($proarr0,$proarr1,$proarr2,$proarr3);
        }else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_building)){
            $res_arr = array_intersect($proarr0,$proarr1,$proarr2);
        }else if(!empty($keyword_area) && !empty($keyword_estates) && !empty($keyword_room_number)){
            $res_arr = array_intersect($proarr0,$proarr1,$proarr3);
        }else if(!empty($keyword_area) && !empty($keyword_building) && !empty($keyword_room_number)){
            $res_arr = array_intersect($proarr0,$proarr2,$proarr3);
        }else if(!empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_room_number)){
            $res_arr = array_intersect($proarr1,$proarr2,$proarr3);
        }else if(!empty($keyword_area) && !empty($keyword_estates)){
            $res_arr = array_intersect($proarr0,$proarr1);
        }else if(!empty($keyword_area) && !empty($keyword_building)){
            $res_arr = array_intersect($proarr0,$proarr2);
        }else if(!empty($keyword_area) && !empty($keyword_room_number)){
            $res_arr = array_intersect($proarr0,$proarr3);
        }else if(!empty($keyword_estates) && !empty($keyword_building)){
            $res_arr = array_intersect($proarr1,$proarr2);
        }else if(!empty($keyword_estates) && !empty($keyword_room_number)){
            $res_arr = array_intersect($proarr1,$proarr3);
        }else if(!empty($keyword_building) && !empty($keyword_room_number)){
            $res_arr = array_intersect($proarr2,$proarr3);
        }else{
            $res_arr=array_merge($proarr0,$proarr1,$proarr2,$proarr3);
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
            $res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.")");
            foreach($res as $key=>$value){
                if ($key==0){
                    $contract_id.="'".$value->contract_id."'";
                }
                else{
                    $contract_id.=","."'".$value->contract_id."'";
                }
            }
        }
        if($keyword_area || $keyword_estates || $keyword_building || $keyword_room_number){
            if($contract_id){
                $condition.= " and  contract_id in ($contract_id) ";
            }else{
                $condition.= " and  contract_id in ('') ";
            }
        }

        //开始
        $pagesize =10;
        $criteriass=new CDbCriteria;
        $criteriass->condition= $condition;
        $criteriass->order='t.ctime DESC';
        $count = SerSellContract::model()->count($criteriass);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteriass);
        //最终信息
        $model =SerSellContract::model()->findAll($criteriass);
        //写入信息
        $list=[];
        foreach ($model as $k => $v) {
            //区域品牌系列编号
            $purchaseproperty = CmsPurchaseProperty::model()->findAll("contract_id ='{$v['contract_id']}'");
            //获取编号
            $house_no = '';
            foreach ($purchaseproperty as $k => $p) {
                if($k == 0){
                    $house_no .= CmsProperty::model()->find("id = '{$p['property_id']}'")['house_no'];
                }else{
                    $house_no .= '<br>'.CmsProperty::model()->find("id = '{$p['property_id']}'")['house_no'];
                }
            }
            $information = CmsProperty::model()->find("id = '{$purchaseproperty[0]['property_id']}'");
            $estate = BaseEstate::model()->find("id = '{$information['estate_id']}'")['name'];//品牌
            $building = BaseBuilding::model()->find("id = '{$information['building_id']}'")['name'];//系列
            $area = BaseArea::model()->find("id = '{$information['area_id']}'")['name'];//区域
            $the_date = CmsPurchaseContract::model()->find("id ='{$v['contract_id']}' ")['the_date'];//合同约定日期
            $lists = $v->attributes;
            $lists['estate'] = $estate;
            $lists['building'] = $building;
            $lists['house_no'] = $house_no;
            $lists['area'] = $area;
            $lists['the_date'] = $the_date;
            $list[]=$lists;
        }
        $this->render("index",array(
            "list" => $list,
            'pages'=>$pager,
            "keyword_admin" => $keyword_admin,
            "search" => $search,
            "keyword_estates" => $keyword_estates,
            "keyword_building" => $keyword_building,
            "keyword_room_number" => $keyword_room_number,
            "keyword_ctime3" => $keyword_ctime3,
            "keyword_ctime4" => $keyword_ctime4,
            "keyword_ctime5" => $keyword_ctime5,
            "keyword_ctime6" => $keyword_ctime6,
            // "keyword_ctime7" => $keyword_ctime7,
            // "keyword_ctime8" => $keyword_ctime8,
            "keyword_area" => $keyword_area,
            "k_source" => $k_source,
            ));
    }

    public function actionAdd()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//获取修改的合同id
        $model = SerSellContract::model()->find("id='$id' and deleted = 0");
        if(empty($model)){
            $this->redirect($referer);
        }
        //获取楼房 系列 编号
        $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['contract_id']}'");
        $data = [];
        if(!empty($models)){
            foreach ($models as $k => $v) {
                $data[$k]['property_id'] = $v['property_id'];//车源id
                $property = CmsProperty::model()->find("id = '{$v['property_id']}'");//车源信息

                $data[$k]['estate_id'] = BaseEstate::model()->find("id = '{$property['estate_id']}' ")['name'];//品牌
                $data[$k]['building_id'] = BaseBuilding::model()->find("id = '{$property['building_id']}'")['name'];//系列
                $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}'")['house_no'];//编号
            }
        }

        $this->render('add',array(
                    'model'=> $model,
                    'data'=> $data
                    ));
    }

    public function actionAddSave()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $creater_id = $_SESSION['admin_uid'];//创建人/外勤人员
        $id =Yii::app()->request->getParam("id");//获取修改的合同id
        $model = SerSellContract::model()->find("id='$id' and deleted = 0");

        //判断是否已经交房
        if (!empty($model['actual_date'])){
            $this->OutputJson(0,"该合同已经交房",null);
        }
        $actual_date =Yii::app()->request->getParam("actual_date");//实际出车日期
        if($actual_date){
            $actual_date =strtotime($actual_date);
        }
        $information_type =Yii::app()->request->getParam("information_type");//收房人类型
        $tenant =Yii::app()->request->getParam("tenant");//租户本人
        $tenant_phone =Yii::app()->request->getParam("tenant_phone").'/'.Yii::app()->request->getParam("tenant_phone2");;//租户本人手机
        $agent =Yii::app()->request->getParam("agent");//代理人姓名
        $agent_phone =Yii::app()->request->getParam("agent_phone").'/'.Yii::app()->request->getParam("agent_phone2");//代理人姓名手机
        $agent_type =Yii::app()->request->getParam("agent_type");//代理人类型
        $pay_method =Yii::app()->request->getParam("pay_method");//支付方式：
        $actual_payment =Yii::app()->request->getParam("actual_payment");//实际付款 水电燃气费用

        $hidden_phone =Yii::app()->request->getParam("hidden_phone").'/'.Yii::app()->request->getParam("hidden_phone2");//隐患记录时车主电话
        $hope_end_time =Yii::app()->request->getParam("hope_end_time");//预计修好时间
        if($hope_end_time){
            $hope_end_time =strtotime($hope_end_time);
        }

        //出车清单图片
        $list_photo =Yii::app()->request->getParam("list_photo");
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            //添加主表
            $model->creater_id = $creater_id;
            $model->actual_date = $actual_date;
            $model->tenant = $tenant;
            $model->information_type = $information_type;
            if(!empty($tenant_phone)){
                $model->tenant_phone = $tenant_phone;
            }
            if(!empty($agent_phone)){
                $model->agent_phone = $agent_phone;
            }
            $model->agent = $agent;
            $model->agent_type = $agent_type;
            $model->pay_method = $pay_method;
            $model->actual_payment = $actual_payment*100;
            if(!empty($hidden_phone)){
                $model->hidden_phone = $hidden_phone;
            }
            // $model->hope_end_time = $hope_end_time;
            $model->deleted = 0;
            $model->ctime = time();
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
            // 出车清单图片存储
            if($list_photo != ',' && !empty($list_photo)){
                $list_photo = explode(",",$list_photo);
                array_shift($list_photo);
                foreach($list_photo as $k => $v){
                    $list_contract_photo = new SerContractPhoto;
                    $list_contract_photo->id = Guid::create_guid();
                    $list_contract_photo->ser_contract_id = $model->id;
                    $list_contract_photo->url = $v;
                    $list_contract_photo->ctime = time()+$k;
                    $list_contract_photo->deleted = 0;
                    if(!$list_contract_photo->save()){
                        $this->OutputJson(0,$model->errors,null);
                    }
                }
            }

            Service::Hydropower($model->id);//水电燃气
            Service::Special($model->id);//特殊费用
            Service::Hidden($model->id);//隐患记录


            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {

            $this->OutputJson(0,"添加失败",null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }
        $this->OutputJson(301,'',"/admin/Sersellcontract");
    }
    /**
     * 修改
     */
    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//获取修改的合同id
        $model = SerSellContract::model()->find("id='$id' and deleted = 0");
        if(empty($model)){
            $this->redirect('index');
        }
        //获取楼房 系列 编号
        $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['contract_id']}' and deleted = 0");
        $data = [];
        if(!empty($models)){
            foreach ($models as $k => $v) {
                $data[$k]['property_id'] = $v['property_id'];//车源id
                $property = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0");//车源信息

                $data[$k]['estate_id'] = BaseEstate::model()->find("id = '{$property['estate_id']}' and deleted = 0")['name'];//品牌
                $data[$k]['building_id'] = BaseBuilding::model()->find("id = '{$property['building_id']}' and deleted = 0")['name'];//系列
                $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0")['house_no'];//编号
            }
        }
        $list = SerContractPhoto::model()->findAll("ser_contract_id='{$model['id']}' and deleted = 0 ");//获取出车清单图片
        $list_photo =[];
        if(!empty($list)){
            foreach ($list as $key => $value) {
                $list_photo[]=$value->url;
            }
        }
        $hydropower =  SerHydropower::model()->findAll("ser_contract_id='{$model['id']}' and deleted = 0 ");//获取水电费
        $special =  SerSpecialCost::model()->findAll("ser_contract_id='{$model['id']}' and deleted = 0 "); //特殊费用
        $this->render('edit',array(
            'model'=> $model,
            'list_photo'=> $list_photo,
            'data'=> $data,
            'hydropower'=> $hydropower,
            'special'=> $special,
            'referer'=> $referer
            ));
    }
    /**
     * 执行修改
     */
    public function actionEditSave()
    {

        $id =Yii::app()->request->getParam("id");//要修改的出车id
        $creater_id = $_SESSION['admin_uid'];//创建人/外勤人员
        $actual_date =Yii::app()->request->getParam("actual_date");//实际出车日期
        if($actual_date){
            $actual_date =strtotime($actual_date);
        }
        $tenant =Yii::app()->request->getParam("tenant");//租户本人
        $tenant_phone =Yii::app()->request->getParam("tenant_phone").'/'.Yii::app()->request->getParam("tenant_phone2");//租户本人手机
        $agent =Yii::app()->request->getParam("agent");//代理人姓名
        $information_type =Yii::app()->request->getParam("information_type");//收房人类型
        $agent_phone =Yii::app()->request->getParam("agent_phone").'/'.Yii::app()->request->getParam("agent_phone2");//代理人姓名手机
        $agent_type =Yii::app()->request->getParam("agent_type");//代理人类型
        $pay_method =Yii::app()->request->getParam("pay_method");//支付方式：
        $actual_payment =Yii::app()->request->getParam("actual_payment")*100;//实际付款 水电燃气费用
        //出车清单图片
        $list_photo =Yii::app()->request->getParam("list_photo");
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            //添加主表
            $model =  SerSellContract::model()->find("id='$id' and deleted = 0");
            $model->creater_id = $creater_id;
            $model->actual_date = $actual_date;
            $model->information_type = $information_type;
            if($information_type == 1){
                $model->tenant = $tenant;
                $model->tenant_phone = $tenant_phone;
                $model->agent = '';
                $model->agent_phone = '';
            }else{
                $model->tenant = '';
                $model->tenant_phone = '';
                $model->agent = $agent;
                $model->agent_phone = $agent_phone;
            }
            $model->agent_type = $agent_type;
            $model->pay_method = $pay_method;
            $model->actual_payment = $actual_payment;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
            //出车清单图片存储 先修改数据库里面存的数据  改成deleted=1
            $photo =  SerContractPhoto::model()->findAll("ser_contract_id='$id' and deleted = 0");
            $count =SerContractPhoto::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));
            if(!empty($photo) && $count < 1){
                $this->OutputJson(0,json_encode($list_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
            }
            // var_dump($list_photo);die;
                // var_dump($list_photo);die;
            if($list_photo != ',' && !empty($list_photo)){


                $list_photo = explode(",",$list_photo);
                array_shift($list_photo);

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
            }
            //水电燃气 先修改数据库里面存的数据  改成deleted=1
            $hydropower =  SerHydropower::model()->findAll("ser_contract_id='$id' and deleted = 0");
            $count_hydropower=SerHydropower::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));
            // if(!empty($hydropower) && $count_hydropower < 1){
            //         $this->OutputJson(0,json_encode($list_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
            // }//如果水电燃气是必填的时候打开
            Service::Hydropower($id);
            //特殊费用 先修改数据库里面存的数据  改成deleted=1
            $special =  SerSpecialCost::model()->findAll("ser_contract_id='$id' and deleted = 0");
            $count_special=SerSpecialCost::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));
            // if(!empty($special) && $count_special < 1){
            //         $this->OutputJson(0,json_encode($list_contract_photo->errors,JSON_UNESCAPED_UNICODE),null);
            // }////如果特殊费用是必填的时候打开
            Service::Special($id);

            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,"添加失败",null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }



        $this->OutputJson(301,'',"/admin/Sersellcontract");
    }
    public function actionDetail()
    {
       $referer= $_SERVER['HTTP_REFERER'];
       $id =Yii::app()->request->getParam("id");//获取修改的合同id

       $model = SerSellContract::model()->find("id='$id' and deleted = 0");
       if(empty($model)){
           $this->redirect('index');
       }
       //获取楼房 系列 编号
       $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['contract_id']}' and deleted = 0");
       $data = [];
       if(!empty($models)){
           foreach ($models as $k => $v) {
               $data[$k]['property_id'] = $v['property_id'];//车源id
               $property = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0");//车源信息

               $data[$k]['estate_id'] = BaseEstate::model()->find("id = '{$property['estate_id']}' and deleted = 0")['name'];//品牌
               $data[$k]['building_id'] = BaseBuilding::model()->find("id = '{$property['building_id']}' and deleted = 0")['name'];//系列
               $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0")['house_no'];//编号
           }
       }
       //获取出车清单图片
       $list = SerContractPhoto::model()->findAll("ser_contract_id='{$model['id']}' and deleted = 0 ");
       $list_photo =[];
       if($list){
           foreach ($list as $key => $value) {
               $list_photo[]=$value->url;
           }
       }
       $hydropower =  SerHydropower::model()->findAll("ser_contract_id='{$model['id']}' and deleted = 0 ");//获取水电费
       $special =  SerSpecialCost::model()->findAll("ser_contract_id='{$model['id']}' and deleted = 0 ");//特殊费用
       $hidden =  SerAfterSales::model()->findAll("ser_contract_id='{$model['id']}' and deleted = 0 ");//隐患

       $this->render('detail',array(
           'model'=> $model,
           'list_photo'=> $list_photo,
           'data'=> $data,
           'hydropower'=> $hydropower,
           'special'=> $special,
           'hidden'=> $hidden,
           'referer'=> $referer
           ));
    }
    public function actionDeleted()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//获取修改的合同id
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $count_sell =SerSellContract::model()->updateAll(array('deleted'=>'1'),'id=:pid',array(':pid'=>$id));//删除出车主表数据
            $count_photo =SerContractPhoto::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除清单表数据
            $count_hydropower =SerHydropower::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除水电表数据
            $count_special =SerSpecialCost::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除特殊费用表数据
            $after =SerAfterSales::model()->findAll("ser_contract_id= '$id'");//隐患表
            foreach ($after as $key => $value) {
                SerHiddenPhoto::model()->updateAll(array('deleted'=>'1'),'after_id=:pass',array(':pass'=>$value['id']));//删除隐患表数据
            }
            $count_after =SerAfterSales::model()->updateAll(array('deleted'=>'1'),'ser_contract_id=:pass',array(':pass'=>$id));//删除隐患照片表数据
            if($count_sell<1){
                    $this->OutputJson(0,'操作失败',null);
            }

           $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,"添加失败",null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }

        $this->redirect($referer);

    }
    /**
     * add页面发送ajax获取编号
     */
    public function actionAjaxRoom()
    {
        //获取编号
        $room_number = Yii::app()->request->getParam("room_number");
        //查看
        $model = Property::SaleContract($room_number);
        $models = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['id']}' and deleted = 0");
        $data = [];
        if(!empty($models)){
            foreach ($models as $k => $v) {
                $data[$k]['property_id'] = $v['property_id'];
                $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0")['house_no'];
            }
            header('Content-Type:application/json;charset=utf-8');
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }

    }
    /**
     * 下载
     */
    public function actionDownload()
    {

        $filename = Yii::app()->request->getParam("id");
        $names = Yii::app()->request->getParam("names");
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
        download($filename, $names);

    }
    /**
     * 编辑规定收房日期
     */
    public function actionEdits()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//
        $set_date =Yii::app()->request->getParam("set_date");//
        $model = SerSellContract::model()->find("id='$id' and deleted = 0");
        $model->set_date = strtotime($set_date);
        $model->save();
        $this->redirect($referer);

    }

}
