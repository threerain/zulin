<?php

class UrspropertyController extends BackgroundBaseController
{

    public $title='幼狮车源管理';
    public function actionIndex()
    {
        //搜索
        $search =Yii::app()->request->getParam("search");
        $keyword_area =Yii::app()->request->getParam("keyword_area");
        $news_type =Yii::app()->request->getParam("news_type");
        $news_content_id =Yii::app()->request->getParam("news_content_id");
        $news_id =Yii::app()->request->getParam("news_id");
        $keyword_estates=Yii::app()->request->getParam("keyword_estates");
        $keyword_building=Yii::app()->request->getParam("keyword_building");
        $keyword_room_number=Yii::app()->request->getParam("keyword_room_number");
        $keyword_status_now=Yii::app()->request->getParam("keyword_status_now");
        $keyword_sale_rhythm=Yii::app()->request->getParam("keyword_sale_rhythm");
        $k_decstatus=Yii::app()->request->getParam("k_decstatus");

        //合同
        // $time=time();
        // $purchasecontract1=CmsPurchaseContract::model()->findAll("type='0' and status='0'  and deleted='0'");//
        // $purchasecontract_id=[];
        // foreach($purchasecontract1 as $v=>$k){
        //     $a=CmsPruchaseFreeLease::model()->find("contract_id='$k->id' and start_time<='$time' and the_order='0'")['start_time'];
        //     $b=CmsPurchaseContract::model()->find("id='$k->id' and lease_term_start<='$time' and type='0' and status='0'  and deleted='0'");
        //     $c=CmsPurchaseContract::model()->find("id='$k->id' and type='0' and status='0' and lease_term_end>='$time' and deleted='0'");
        //     if(!empty($a) || !empty($b)){
        //         if(!empty($c)){
        //             $purchasecontract_id[]="'".$k->id."'";
        //         }
        //     }
        // }
        // $purchasecontract_id=implode(",",$purchasecontract_id);
        $pagesize=10;

        /*
            根据车源查出车源的ID对应上合同
         */
        //商圈-编号的搜索开始
        if($keyword_area){
            $contract_id1=[];
            $areas=BaseArea::model()->findAll("name like '%".$keyword_area."%'");
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
                $property1=CmsProperty::model()->findAll("area_id in ($areas_id) ");
                foreach ($property1 as $key => $value) {
                    if($value){
                        $res=CmsPurchaseProperty::model()->findAll("property_id='$value->id'");
                        foreach($res as $key=>$v){
                            $contract_id1[]="'".$v->contract_id."'";
                        }
                    }
                }
            }
            $contract_id1 = implode(',',$contract_id1);
        }
        //品牌
        if($keyword_estates){
            $contract_id2=[];
            $estates=BaseEstate::model()->findAll("name like '%".$keyword_estates."%'");
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
            $contract_id2 = implode(',',$contract_id2);
        }
        //系列
        if($keyword_building){
            $contract_id3=[];
            $building=BaseBuilding::model()->findAll("name like '%".$keyword_building."%'");
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
            $contract_id3 = implode(',',$contract_id3);
        }

        //编号
        if($keyword_room_number){
            $contract_id4=[];
            $property4=CmsProperty::model()->findAll("house_no like '%".$keyword_room_number."%'");
            foreach ($property4 as $key => $value) {
                if($value){
                    $res=CmsPurchaseProperty::model()->findAll("property_id='$value->id'");
                    foreach($res as $key=>$v){
                        $contract_id4[]="'".$v->contract_id."'";
                    }
                }
            }
            $contract_id4 = implode(',',$contract_id4);
        }
        //商圈-编号的搜索结束
        //已租还是未租
        if($keyword_status_now!=0){
            $time=time();
            $purchasecontract1=CmsPurchaseContract::model()->findAll("type='0' and deleted='0' and status in(0,9,-1)");
            $purchasecontract_id=[];
            foreach($purchasecontract1 as $v=>$k){
                $purchasecontract_id[]="'".$k->id."'";
            }
            $purchasecontract_id=implode(",",$purchasecontract_id);
            $arr = explode(',',$purchasecontract_id);
            $purchasecontract_id = $this->Property_Status($arr,$keyword_status_now);
            $purchasecontract_id = @implode(',',$purchasecontract_id);
        }

        if($k_decstatus!=null){//装修状态
            $decoration_status='';
            foreach ($k_decstatus as $key => $value) {
                if ($key==0){
                    $decoration_status.="'".$value."'";
                }
                else{
                    $decoration_status.=","."'".$value."'";
                }
            }
            $ursproperty=UrsDecorationFollow::model()->findAll("decoration_status in ($decoration_status) and deleted='0'");
            $decoration_id=[];
            foreach($ursproperty as $value){
                $item=UrsDecorationFollow::model()->find(array(
                    'condition'=>"decoration_id='$value->decoration_id' and deleted='0'",
                    'order'=>'ctime desc',
                ));
                if(in_array("$item->decoration_status",$k_decstatus)){
                    $res=QualityDecoration::model()->findAll("id='$item->decoration_id' and deleted='0'");
                    foreach ($res as $key => $value){
                        $decoration_id[]="'".$value->contract_id."'";
                    }
                }
            }
            $decoration_id=array_flip($decoration_id);
            $decoration_id=array_flip($decoration_id);
            $decoration_id=implode(",",$decoration_id);
        }
        $condition="1=1 and t.deleted=0 and type=0";

        //下销控  消息提醒
        if(!empty($news_type) && !empty($news_content_id) && !empty($news_id)){
            $usernews = UserNews::model()->find("1=1 and id= '$news_id' and user_news_id = '{$_SESSION['admin_uid']}'");
            if(!empty($usernews)){
                $contract_id = Property::PurchaseContract($news_content_id)['id'];
                $house_nos = CmsProperty::model()->find("id = '$news_content_id' and deleted = 0")['house_no'];
                $condition.= " and id = '$contract_id ' ";

            }else{
                $this->redirect('/admin/home');
            }
        }else{
            $house_nos = '';
        }

        $condition.=" and  ( 1=1 and type='0'  and deleted='0' and status in(0,9,-1)";
        if($keyword_status_now!=0){
            if($purchasecontract_id){
                $condition.=" and id in (".$purchasecontract_id.") ";
            }else{
                $condition.=" and id in ('') ";
            }
        }
       //商圈-编号的搜索开始
        if($keyword_area!=null){
            if($contract_id1){
                $condition.= " and  id in ($contract_id1) ";
            }else{
                $condition.= " and  id in ('') ";
            }
        }
        if($keyword_estates!=null){
            if($contract_id2){
                $condition.= " and  id in ($contract_id2) ";
            }else{
                $condition.= " and  id in ('') ";
            }
        }
        if($keyword_building!=null){
            if($contract_id3){
                $condition.= " and  id in ($contract_id3) ";
            }else{
                $condition.= " and  id in ('') ";
            }
        }
        if($keyword_room_number!=null){
            if($contract_id4){
                $condition.= " and  id in ($contract_id4) ";
            }else{
                $condition.= " and  id in ('') ";
            }
        }
        //商圈-编号的搜索结束
        if($k_decstatus){
            if($decoration_id){
                $condition.= " and  id in ($decoration_id)";
            }else{
                $condition.= " and  id in ('')";
            }
        }
        $condition.=")";
            $criteria=new CDbCriteria;
            $criteria->condition=$condition;
            $criteria->order='t.last_time desc';
            $count = CmsPurchaseContract::model()->count($criteria);
            $pager=new CPagination($count);
            $pager->pageSize=$pagesize;
            $pager->applyLimit($criteria);
            $list =CmsPurchaseContract::model()->findAll($criteria);

        if(!empty($news_type) && !empty($news_content_id)  && !empty($news_id)){
            $modelnewss = UserNews::model()->find("id='$news_id' and user_news_id='{$_SESSION['admin_uid']}'");
            $modelnewss->status = 1;
            $modelnewss->save();
            if(empty($list)){
                $alert_error = 8;
                $this->redirect("/admin/usernews?alert_error=".$alert_error.'&news_type='.$news_type);
            }
        }


        $ursarr=UrsPropertyDetail::model()->arr();
        if($k_decstatus==null){
           $k_decstatus=[];
        }
        $this->render("index",array(
            'list'=>$list,
            'ursarr'=>$ursarr,
            'pages'=>$pager,
            'keyword_area'=>$keyword_area,
            'keyword_estates'=>$keyword_estates,
            'keyword_building'=>$keyword_building,
            'keyword_room_number'=>$keyword_room_number,
            'keyword_status_now'=>$keyword_status_now,
            'keyword_sale_rhythm'=>$keyword_sale_rhythm,
            'k_decstatus'=>$k_decstatus,
            'news_type'=>$news_type,
            'news_content_id'=>$news_content_id,
            'house_nos'=>$house_nos,
            'search'=>$search,
        ));

    }

    //已租还是未租的搜索
    public function Property_Status($list,$keyword_status_now){
        foreach ($list as $key => $value) {
            //查出车源ID
            $property_id =  Property::property_id($value);
            foreach ($property_id as $k => $v) {
                $status[$k] = Property::status($v);
                if($status[$k] == '未租'){
                    $status[$k] = 1;
                }else{
                    $status[$k] = 2;
                }
                if($status[$k]!=$keyword_status_now){
                    if(count($property_id)<2){
                        unset($list[$key]);
                    }else{
                        if(2*count($property_id)==array_sum($status)||array_sum($status)==count($property_id)){
                            unset($list[$key]);
                        }
                    }
                }
            }

        }
        return $list;
    }

    //修改页面
    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//车源id
        $contract_id =Yii::app()->request->getParam("contract_id");//合同ID
        $orientation=CmsProperty::model()->find("id='$id' and  deleted=0")['orientation'];//朝向

        //车源图片
        $propertyphoto=CmsPropertyPhoto::model()->findAll("property_id='$id' order by show_order");
        $v1=[];
        foreach($propertyphoto as $val){
            $v1[$val->type_photo][]=$val;
        }
        $ursproperty=UrsPropertyDetail::model()->find("property_id='$id'");

        //幼狮车源图片
        $v=[];
        if($ursproperty){
            //幼狮车源信息表有这条数据时
            $ursproperty_id=$ursproperty->id;
            $ursphoto=UrsPhoto::model()->findAll("property_id='$ursproperty_id' order by show_order");
            foreach($ursphoto as $value){
               $v[$value->type_photo][]=$value;
            }
        }
        $arr=UrsPropertyDetail::model()->arr();
        $this->render("edit",array(
            'property_id'=>$id,
            'contract_id'=>$contract_id,
            'property_photo'=>$v1,
            'photo'=>$v,
            'ursproperty'=>$ursproperty,
            'orientation'=>$orientation,
            'referer'=>$referer,
            'arr'=>$arr,
        ));
    }

    //修改操作
    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");//幼狮车源信息表id
        $property_id =Yii::app()->request->getParam("property_id");
        $referer =Yii::app()->request->getParam("referer");
        $base_price =Yii::app()->request->getParam("base_price");
        $orientation =Yii::app()->request->getParam("orientation");

        //车源图片
        $type_photo =Yii::app()->request->getParam("type_photo");
        array_pop($type_photo);
        $property_photo =Yii::app()->request->getParam("property_photo");
        array_pop($property_photo);
        if (in_array("",$property_photo)){
            $this->OutputJson(0,"车源图片不能为空",null);
        }
        if (in_array("",$type_photo)){
            $this->OutputJson(0,"车源照片类型不能为空",null);
        }
        $date=CmsProperty::model()->find("id='$property_id' and  deleted=0");//朝向
        $date->orientation=$orientation;
        if (!$date->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$date->errors,null);
            }
        }
        //车源详细信息cms_property_detail
        $ursproperty = UrsPropertyDetail::model()->find("id = '$id' and deleted=0 ");
        if($ursproperty==null){
            $ursproperty=new UrsPropertyDetail();
            $ursproperty->id=Guid::create_guid();
            $ursproperty->ctime=time();
            $ursproperty->deleted=0;
        }
        $ursproperty->property_id = Yii::app()->request->getParam("property_id");
        $ursproperty->contract_id=Yii::app()->request->getParam("contract_id");
        $ursproperty->base_price=$base_price*100;
        if (!$ursproperty->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$ursproperty->errors,null);
            }
        }

        //写入品牌图片表
        if($type_photo){
            $order=0;
            foreach($type_photo as $k=>$value){
                if(!empty($property_photo[$k])){
                    UrsPhoto::model()->deleteAll("property_id='$id' and show_order='$k'");
                    $property_photo[$k] = explode(",",$property_photo[$k]);
                    array_shift($property_photo[$k]);
                    foreach($property_photo[$k] as $k1=>$v1){
                        $model_property = new UrsPhoto;
                        $model_property->id = Guid::create_guid();
                        $model_property->property_id = $ursproperty->id;
                        $model_property->type_photo = $value;
                        $model_property->url = $v1;
                        $model_property->ctime = time();
                        $model_property->show_order=$order;
                        if(!$model_property->save()){
                            $this->OutputJson(0,json_encode($model_property->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
                $order++;
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",$referer);
        }
        else{
            $this->redirect($referer);
        }

    }

    //幼狮车源详情
    public function actiondetail()
    {
        $referer= $_SERVER['HTTP_REFERER'];

        //车源id
        $id =Yii::app()->request->getParam("id");
        $contract_id =Yii::app()->request->getParam("contract_id");//合同ID
        //车源图片
        $propertyphoto=CmsPropertyPhoto::model()->findAll("property_id='$id' order by show_order");
        $v1=[];
        foreach($propertyphoto as $val){
            $v1[$val->type_photo][]=$val;
        }
        $ursproperty=UrsPropertyDetail::model()->find("property_id='$id'");
        //幼狮车源图片
        $v=[];
        if($ursproperty){
            //幼狮车源信息表有这条数据时
            $ursproperty_id=$ursproperty->id;
            $ursphoto=UrsPhoto::model()->findAll("property_id='$ursproperty_id' order by show_order");
            foreach($ursphoto as $value){
               $v[$value->type_photo][]=$value;
            }
        }
       //确认消息已知
       // CmsNews::userConfirm($id,8);
        //查询车源管理表信息
        $property=CmsProperty::model()->find("id='$id'");
        $arrproperty=CmsProperty::model()->arr();
        $arr=UrsPropertyDetail::model()->arr();
        $this->render("detail",array(
            'property_id'=>$id,
            'property_photo'=>$v1,
            'photo'=>$v,
            'ursproperty'=>$ursproperty,
            'property'=>$property,
            'referer'=>$referer,
            'arr'=>$arr,
            'arrproperty'=>$arrproperty,
            'contract_id'=>$contract_id,
        ));
    }

    public function actionDecorationFollow()
    {
        $keyword_decoration_status=Yii::app()->request->getParam("keyword_decoration_status");
        $keyword_start_time=Yii::app()->request->getParam("keyword_start_time");
        $keyword_end_time=Yii::app()->request->getParam("keyword_end_time");
        $property_id =Yii::app()->request->getParam("id");
        $pagesize=10;

        $condition="1=1 and t.deleted=0 and t.property_id='$property_id'";
        $condition.=" and  ( 1=1  ";
        //装修状态
        if ($keyword_decoration_status){
            $condition.= " and decoration_status = $keyword_decoration_status";
        }
        if ($keyword_start_time) {
            $start_time=strtotime($keyword_start_time);
            $condition.=" and ctime >= $start_time";
        }
        if ($keyword_end_time) {
            $end_time=strtotime($keyword_end_time)+24*3600;
            $condition.=" and ctime <= $end_time";
        }
        $condition.=")";
        $criteria=new CDbCriteria;
        $criteria->condition=$condition;
        $criteria->order="t.ctime desc";
        $count=UrsDecorationFollow::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list = UrsDecorationFollow::model()->findAll($criteria);
        $ursarr=UrsPropertyDetail::model()->arr();
        $this->render("decorationfollowlist",array(
            'list'=>$list,
            'pages'=>$pager,
            'ursarr'=>$ursarr,
            'keyword_decoration_status'=>$keyword_decoration_status,
            'keyword_start_time'=>$keyword_start_time,
            'keyword_end_time'=>$keyword_end_time,
            'keyword_property_id'=>$property_id,
        ));
    }

    //幼狮车源装修跟进详情
    public function actionDecorationDetail()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        //幼狮车源跟进id
        $id =Yii::app()->request->getParam("id");
        $model =UrsDecorationFollow::model()->find(" t.id='$id'");
        $ursarr = UrsPropertyDetail::model()->arr();
        $this->render("decorationfollowdetail",array(
            'model'=>$model,
            'ursarr'=>$ursarr,
        ));
    }

    //删除幼狮车源装修安装跟进
    public function actionDecorationDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model =UrsDecorationFollow::model()->find(" t.id='$id'");
        $model->deleted=1;
        if (!$model->save()){
            $this->result(0,$model->errors,null);
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,$referer);
        }
        else{
            $this->redirect($referer);
        }
    }


    public function actionAjaxlists()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $keyword =Yii::app()->request->getParam("q");
        if ($keyword){
            $criteria->condition="1=1 and t.deleted=0 and t.goods_name like '%$keyword%'";
        }
        $count = UrsGoodsStorage::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);
        $list =UrsGoodsStorage::model()->findAll($criteria);
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->goods_name;
            $data["movies"][]=$_data;
        }
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }
    public function actionAjaxitem()
    {
        $id =Yii::app()->request->getParam("id");
        $criteria=new CDbCriteria;
        $item =UrsGoodsStorage::model()->find("id='$id'");

        $_data["id"]=$item->id;
        $_data["title"]=$item->goods_name;
        $data=$_data;

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }
    //添加销售销控
    public function actionSalesControlAddSave()
    {
        $property_id = Yii::app()->request->getParam('idd');
        // var_dump($property_id);die();
        // $contract_id = Yii::app()->request->getParam('contract_id');
        $unit_price = Yii::app()->request->getParam('unit_price');
        $price_maker = Yii::app()->request->getParam('price_maker');
        $area = Yii::app()->request->getParam('area'); //销售面积
        $sales_type = Yii::app()->request->getParam('sales_type'); //上销控类型
        $live_date = Yii::app()->request->getParam('live_date');
        $live_dates = Yii::app()->request->getParam('live_date');
        $acq = Yii::app()->request->getParam('acq_broker');
        $number = Yii::app()->request->getParam('number');
        $phone = Yii::app()->request->getParam('phone'); //联系人电话
        $name = Yii::app()->request->getParam('name'); //联系人姓名
        array_pop($name);
        array_pop($phone);
        $json = [];
        $json[$number[0].'-'.$number[1]] = $acq[0].','.$acq[1];
        $json[$number[2].'-'.$number[3]] = $acq[2].','.$acq[3];
        $json[$number[4].'-'.$number[5]] = $acq[4].','.$acq[5];
        $json[$number[6].'-'.$number[7]] = $acq[6].','.$acq[7];
        $json = json_encode($json);
        $creater_id=Yii::app()->session['admin_uid'];
        if($live_date){
           $live_date = strtotime($live_date);
        }
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            if($property_id){
                $mode = UrsSalesControl::model()->find("property_id='$property_id' and deleted=0 ");
                if($mode==null){
                    $salescontrol =new UrsSalesControl();
                    $salescontrol->id=Guid::create_guid();
                    $salescontrol->property_id=$property_id;
                    // $salescontrol->contract_id=$contract_id;
                    $salescontrol->unit_price=$unit_price*100;
                    $salescontrol->price_maker=$price_maker;
                    $salescontrol->area = $area;
                    $salescontrol->sales_type = $sales_type;
                    $salescontrol->live_date=$live_date;
                    $salescontrol->creater_id=$creater_id;
                    $salescontrol->ctime=time();
                    $phone = implode(',',$phone);
                    $phone = rtrim($phone,',');
                    $salescontrol->phone=$phone;
                    $name = implode(',',$name);
                    $name = rtrim($name,',');
                    $salescontrol->name=$name;
                    $salescontrol->deleted=0;
                    if (!$salescontrol->save()){
                        $this->result(0,$salescontrol->errors,null);
                    }
                    //写进礼品
                    $goods =new UrsGoodsDetail();
                    $goods->id=Guid::create_guid();
                    $goods->property_id=$property_id;
                    // $goods->contract_id=$contract_id;
                    $goods->json=$json;
                    $goods->creater=$creater_id;
                    $goods->up_creater='';
                    $goods->ctime=time();
                    $goods->deleted=0;
                    if (!$goods->save()){
                        $this->result(0,$goods->errors,null);
                    }
                }
                //写入消息
                //消息提醒开始
                // $house_no = '-'.CmsProperty::model()->find("id = '$property_id' and deleted = 0")['house_no'];
                // $information = CmsProperty::model()->find("id = '$property_id' and deleted = 0");
                // // 品牌
                // $estate_id = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
                // //系列
                // $building_id = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];
                //
                // $news_title = '新增销控('.$estate_id.' '.$building_id.$house_no.')';
                // CmsNews::user_news($property_id,7,'1101_07',$news_title);
                // //短信提醒
                // $content = '【幼狮空间】幼狮空间提醒您：新增销控［'.$estate_id.' '.$building_id.''.$house_no.'，'.$information['area'].'㎡，报价'.$unit_price.'元/天／㎡，可入住时间'.$live_dates.'］>>请登录幼狮ERP系统查看消息详情';
                //
                // $message = new Message();
                // $status = $message->sendmsg('1201_01',$content);

                //消息结束
            }


            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e){
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }

        $this->redirect("/admin/property");
    }
    public function actionAjaxlist()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $keyword =Yii::app()->request->getParam("q");
        $channel_id =Yii::app()->request->getParam("channel_id");

        if ($keyword){
            $criteria->condition="1=1 and t.deleted=0 and t.name like '%$keyword%' and channel_id = '$channel_id'";
        }
        $count = CmsChannelManager::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);
        $list =CmsChannelManager::model()->findAll($criteria);
        foreach ($list as $key => $user) {
                $_data["id"]=$user->id;
                $_data["title"]=$user->name;
                $data["movies"][]=$_data;
        }
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

    }
}
