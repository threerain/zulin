<?php

class PropertyController extends BackgroundBaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';

    public $title='车源管理';

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $search =Yii::app()->request->getParam("search");
        $k_district =Yii::app()->request->getParam("k_district");
        $k_type =Yii::app()->request->getParam("k_type");
        $k_room_type =Yii::app()->request->getParam("k_room_type");
        $k_estates=Yii::app()->request->getParam("k_estates");
        $k_building=Yii::app()->request->getParam("k_building");
        $k_house_no=Yii::app()->request->getParam("k_house_no");
        $k_status=Yii::app()->request->getParam("k_status");
        $k_owner_contact=Yii::app()->request->getParam("k_owner_contact");
        $k_status_now=Yii::app()->request->getParam("k_status_now");
        $k_area1=Yii::app()->request->getParam("k_area1");
        $k_area2=Yii::app()->request->getParam("k_area2");
        $k_meet=Yii::app()->request->getParam("k_meet");
        $k_ascription=Yii::app()->request->getParam("k_ascription");//归属人
        $k_ctime1=Yii::app()->request->getParam("k_ctime1");
        $k_ctime2=Yii::app()->request->getParam("k_ctime2");
        $pagesize=10;

        // 归属人
        if($k_ascription){
            $ascription=AdminUser::model()->findAll("nickname like '%".$k_ascription."%'");
            $ascription_id="";
            foreach ($ascription as $key => $value) {
                if ($key==0){
                    $ascription_id.="'".$value->id."'";
                }
                else{
                    $ascription_id.=","."'".$value->id."'";
                }

            }
        }

        //商圈
        if($k_district){
            $district=BaseArea::model()->findAll("name like '%".$k_district."%' and deleted=0");
            $district_id="";
            foreach ($district as $key => $value) {
                if ($key==0){
                    $district_id.="'".$value->id."'";
                }
                else{
                    $district_id.=","."'".$value->id."'";
                }
            }
        }
        //分类
        if($k_type){
            $estates_type=BaseBuilding::model()->findAll("type='$k_type' and deleted=0");
            $estates_type_id="";
            foreach ($estates_type as $key => $value) {
                if ($key==0){
                    $estates_type_id.="'".$value->id."'";
                }
                else{
                    $estates_type_id.=","."'".$value->id."'";
                }

            }  
        }
        if($k_estates){
            $estates=BaseEstate::model()->findAll("name like '%".$k_estates."%' and deleted=0");
            $estates_id="";
            foreach ($estates as $key => $value) {
                if ($key==0){
                    $estates_id.="'".$value->id."'";
                }
                else{
                    $estates_id.=","."'".$value->id."'";
                }

            }
        }
        if($k_building){
            $building=BaseBuilding::model()->findAll("name like '%".$k_building."%'  and deleted=0");
            $building_id="";
            foreach ($building as $key => $value) {
                if ($key==0){
                    $building_id.="'".$value->id."'";
                }
                else{
                    $building_id.=","."'".$value->id."'";
                }

            }
        }
        if($k_meet){
            $propertyfollow=CmsPropertyFollow::model()->findAll("see_way=4");//约见
            $follow_id=[];
            foreach ($propertyfollow as $key => $value) {
                $follow_id[]=$value->property_id;
            }
            $pro_meet1=[];
            $pro_meet2=[];
            $pro_meet3=[];
            $meet=array_count_values($follow_id);
            foreach ($meet as $key => $value) {
                if($value==1){
                    $pro_meet1[]=$key;
                }else if($value==2){
                    $pro_meet2[]=$key;
                }else{
                    $pro_meet3[]=$key;
                }
            }
            $pro_meet1=implode("','",$pro_meet1);
            $pro_meet1="'$pro_meet1'";
            $pro_meet2=implode("','",$pro_meet2);
            $pro_meet2="'$pro_meet2'";
            $pro_meet3=implode("','",$pro_meet3);
            $pro_meet3="'$pro_meet3'";
        }
        //车源状态搜索
        if($k_status){
            $property_urs=[];
            $property_id='';
            $purchasecontract1=CmsPurchaseContract::model()->findAll("type='0' and deleted='0' and status in(0,9,-1)");
            $purchasecontract_id=[];
            foreach($purchasecontract1 as $v=>$k){
                $purchasecontract_id[]=$k->id;
            }

            foreach($purchasecontract_id as $v){
                $property_urs[]=CmsPurchaseProperty::model()->find("contract_id='$v' and deleted=0")['property_id'];
            }
        }

        $condition="1=1 and t.deleted=0 and t.split=0 and merge=0";
        $condition.=" and  ( 1=1  ";
        if ($k_ascription!=null) {
            if($ascription_id){
                $condition.= " and  ascription_id in ($ascription_id) ";
            }else{
                $condition.= " and  ascription_id in ('') ";
            }
        }
        if ($k_house_no){
            $condition.= " and house_no like ('%".$k_house_no."%') ";
        }
        if ($k_district){
            if($district_id){
                $condition.=" and area_id in (".$district_id.") ";
            }else{
                 $condition.= " and  area_id in ('') ";
            }
        }
        if ($k_room_type){
            $condition.= " and room_type =$k_room_type";
        }
        if ($k_type && $estates_type_id){
            $condition.=" and building_id in (".$estates_type_id.") ";
        }
        if ($k_estates){
            if($estates_id){
                $condition.=" and estate_id in (".$estates_id.") ";
            }else{
                 $condition.= " and  estate_id in ('') ";
            }
        }
        if ($k_building) {
            if($building_id){
                $condition.=" and building_id in (".$building_id.") ";
            }else{
                 $condition.= " and  building_id in ('') ";
            }
        }
        if ($k_status==1){
            $property_status=CmsProperty::model()->findAll("status=1 and deleted='0'");
            $property_status_id=[];
            foreach($property_status as $v){
                $property_status_id[]=$v->id;
            }
            $property_id1=array_diff($property_status_id,$property_urs);
            $property_id2=[];
            foreach ($property_id1 as $key => $value) {
                $property_id2[]="'".$value."'";
            }
            $property_id=implode(",",$property_id2);
            if($property_id){
                $condition.=" and id in (".$property_id.") ";
            }else{
                $condition.=" and id in ('') ";
            }
        }
        if ($k_status==2){
            $property_status=CmsProperty::model()->findAll("status=2 and deleted='0'");
            $property_status_id=[];
            foreach($property_status as $v){
                $property_status_id[]=$v->id;
            }
            $property_id1=array_diff($property_status_id,$property_urs);
            $property_id2=[];
            foreach ($property_id1 as $key => $value) {
                $property_id2[]="'".$value."'";
            }
            $property_id=implode(",",$property_id2);
            if($property_id){
                $condition.=" and id in (".$property_id.") ";
            }else{
                $condition.=" and id in ('') ";
            }
        }
        if($k_status==3){
            foreach ($property_urs as $key => $value) {
                if ($key==0){
                    $property_id.="'".$value."'";
                }
                else{
                    $property_id.=","."'".$value."'";;
                }
            }
            if($property_id){
                $condition.=" and id in (".$property_id.") ";
            }else{
                $condition.=" and id in ('') ";
            }
        }
        if($k_owner_contact==1){
            $ownersg=CmsOwnerSg::model()->findAll();
            $ownersg_id=[];
            foreach ($ownersg as $key => $value) {
                if($value->owner_contact!=null){
                    $ownersg_id[]=$value->property_id;
                }
            }
            $ownersg_id=implode("','",$ownersg_id);
            $ownersg_id="'$ownersg_id'";
            if($ownersg_id){
                $condition.=" and id in (".$ownersg_id.") ";
            }else{
                $condition.=" and id in ('') ";
            }

        }
        if($k_owner_contact==2){
            $ownersg=CmsOwnerSg::model()->findAll();
            $ownersg_id=[];
            foreach ($ownersg as $key => $value) {
                if($value->owner_contact==null){
                    $ownersg_id[]=$value->property_id;
                }
            }
            $ownersg_id=implode("','",$ownersg_id);
            $ownersg_id="'$ownersg_id'";
            if($ownersg_id){
                $condition.=" and id in (".$ownersg_id.") ";
            }else{
                $condition.=" and id in ('') ";
            }
        }
        if ($k_status_now){
            $condition.= " and status_now =$k_status_now";
        }
        if ($k_area1) {
            $condition.=" and area >= $k_area1";
        }
        if ($k_area2) {
            $condition.=" and area <= $k_area2";
        }

        if($k_meet==1){
            if($pro_meet1){
                $condition.=" and id in (".$pro_meet1.") ";
            }else{
                $condition.=" and id in ('') ";
            }
        }
        if($k_meet==2){
            if($pro_meet2){
                $condition.=" and id in (".$pro_meet2.") ";
            }else{
                $condition.=" and id in ('') ";
            }

        }
        if($k_meet==3){
            if($pro_meet3){
                $condition.=" and id in (".$pro_meet3.") ";
            }else{
                $condition.=" and id in ('') ";
            }

        }
        $k_start=strtotime($k_ctime1);
        $k_end=strtotime($k_ctime2)+24*3600;
        if ($k_ctime1) {
            $condition.=" and ctime >= '$k_start' ";
        }
        if ($k_ctime2) {
            $condition.=" and ctime <= '$k_end' ";
        }

        //设置本商圈可查看的数据
        $admin_uid = Yii::app()->session['admin_uid'];
        $area_id = AdminUser::model()->find("id='$admin_uid'");
        if(AdminPositionModul::has_modul("501_07") && $area_id->type==1) {
          $area_name1 = AdminDepartment::model()->find("id='$area_id->department_id'");
          $de = AdminPosition::model()->find("department_id='$area_name1->id'");
          if($de->name == '商圈负责人') {
              $area_name = $area_name1;
          }else {
              $area_name = AdminDepartment::model()->find("id='$area_name1->parent_id'");
          }
          if($area_name) {
            $base_id = BaseArea::model()->find("name='$area_name->name'");
            if($base_id!=null) {
              $name = CmsProperty::model()->findAll("area_id='$base_id->id'");
              // var_dump($name);
              if($name!=null) {
                    $area_id1 = '';

                    foreach($name as $key => $value) {
                          if($key==0) {
                              $area_id1 .= "'".$value->area_id."'";
                          }
                          if($key!=0) {
                              $area_id1 .= ','."'".$value->area_id."'";
                          }
                    }

                    if($area_id1!= null) {
                          $condition.=" and area_id in ($area_id1)";
                    }else {
                          $condition.=' and 1=0';
                    }
              }else {
                    $condition.=' and 1=0';
              }
            }else {
                  $condition.=' and 1=0';
            }
          }else {
                $condition.=' and 1=0';
          }

        }
        $condition.=")";

        $criteria=new CDbCriteria;
        $criteria->condition=$condition;
        $criteria->order='t.utime DESC';
        $count = CmsProperty::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list =CmsProperty::model()->findAll($criteria);
        $arr=CmsProperty::model()->arr();
        $this->render("index",array(
            'list'=>$list,
            'arr'=>$arr,
            'pages'=>$pager,
            'k_district'=>$k_district,
            'k_type'=>$k_type,
            'k_room_type'=>$k_room_type,
            'k_estates'=>$k_estates,
            'k_building'=>$k_building,
            'k_house_no'=>$k_house_no,
            'k_status'=>$k_status,
            'k_owner_contact'=>$k_owner_contact,
            'k_status_now'=>$k_status_now,
            'k_area1'=>$k_area1,
            'k_area2'=>$k_area2,
            'k_meet'=>$k_meet,
            'k_ascription'=>$k_ascription,
            'k_ctime1'=>$k_ctime1,
            'k_ctime2'=>$k_ctime2,
            'search'=>$search,
        ));

        // echo "string";
        // $this->render("index");
    }

    public function actionAdd()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $this->render("add",array(
            'referer'=>$referer,
        ));
    }

    public function actionAddSave()
    {
        $referer =Yii::app()->request->getParam("referer");
        // $referer= $_SERVER['HTTP_REFERER'];
        $estate_id =Yii::app()->request->getParam("estate_id");
        $estate_group_id = BaseEstate::model()->find("id='$estate_id'")['estate_group_id'];
        $area_id = BaseEstateGroup::model()->find("id='$estate_group_id'")['area_id'];
        $district_id = BaseArea::model()->find("id='$area_id'")['district_id'];
        $room_type =Yii::app()->request->getParam("room_type");
        $building_id =Yii::app()->request->getParam("building_id");
        $house_no =Yii::app()->request->getParam("house_no");
        $room_area =Yii::app()->request->getParam("room_area");
        $area =Yii::app()->request->getParam("area");
        $price =Yii::app()->request->getParam("price");
        $orientation =Yii::app()->request->getParam("orientation");
        $idle_time =Yii::app()->request->getParam("idle_time");
        $deposit =Yii::app()->request->getParam("deposit");
        $pay =Yii::app()->request->getParam("pay");
        // $status =Yii::app()->request->getParam("status");
        $status_now =Yii::app()->request->getParam("status_now");
        $end_time =Yii::app()->request->getParam("end_time");
        $time_memo =Yii::app()->request->getParam("time_memo");

        //车源详细信息cms_property_detail
        $width =Yii::app()->request->getParam("width");
        $height =Yii::app()->request->getParam("height");
        $area_one =Yii::app()->request->getParam("area_one");
        $sum_area =Yii::app()->request->getParam("sum_area");
        $ti =Yii::app()->request->getParam("ti");
        $hu =Yii::app()->request->getParam("hu");
        $sunshine =Yii::app()->request->getParam("sunshine");
        $french_window =Yii::app()->request->getParam("french_window");
        $crutch =Yii::app()->request->getParam("crutch");
        $door =Yii::app()->request->getParam("door");
        $spray =Yii::app()->request->getParam("spray");
        $hide =Yii::app()->request->getParam("hide");
        $leak =Yii::app()->request->getParam("leak");
        $house_same =Yii::app()->request->getParam("house_same");
        $corridor_toilet =Yii::app()->request->getParam("corridor_toilet");
        $other_rentor =Yii::app()->request->getParam("other_rentor");
        $original_decoration =Yii::app()->request->getParam("original_decoration");
        $toplight =Yii::app()->request->getParam("toplight");
        $ground =Yii::app()->request->getParam("ground");
        $baseboard =Yii::app()->request->getParam("baseboard");
        $logo_front =Yii::app()->request->getParam("logo_front");
        $plug =Yii::app()->request->getParam("plug");
        $door_window =Yii::app()->request->getParam("door_window");
        $room_layout =Yii::app()->request->getParam("room_layout");
        $ceiling =Yii::app()->request->getParam("ceiling");
        $lamp =Yii::app()->request->getParam("lamp");
        $wall =Yii::app()->request->getParam("wall");
        $partition =Yii::app()->request->getParam("partition");

        //车主个人信息cms_owner_sg
        $owner_name =Yii::app()->request->getParam("owner_name");
        $owner_contact =Yii::app()->request->getParam("owner_contact");
        $owner_contact = implode("/",$owner_contact);
        $id_card =Yii::app()->request->getParam("id_card");
        $owner_gender =Yii::app()->request->getParam("owner_gender");
        $owner_age =Yii::app()->request->getParam("owner_age");
        $owner_city =Yii::app()->request->getParam("owner_city");
        $owner_roots =Yii::app()->request->getParam("owner_roots");
        $owner_position =Yii::app()->request->getParam("owner_position");
        $owner_trade =Yii::app()->request->getParam("owner_trade");

        //代理人信息cms_property_agent
        $agent_name =Yii::app()->request->getParam("agent_name");
        $agent_phone =Yii::app()->request->getParam("agent_phone");

        //公司信息cms_owner_sg
        $company =Yii::app()->request->getParam("company");
        $business_scope =Yii::app()->request->getParam("business_scope");
        $business_project =Yii::app()->request->getParam("business_project");
        $company_type =Yii::app()->request->getParam("company_type");
        $core_project =Yii::app()->request->getParam("core_project");
        $people =Yii::app()->request->getParam("people");

        $rel_company =Yii::app()->request->getParam("rel_company");//
        $relation_company =Yii::app()->request->getParam("relation_company");
        $friend_company =Yii::app()->request->getParam("friend_company");
        // $friend_company1 =Yii::app()->request->getParam("friend_company1");
        $type_photo =Yii::app()->request->getParam("type_photo");
        array_pop($type_photo);
        $property_photo =Yii::app()->request->getParam("property_photo");//车源图片
        array_pop($property_photo);
        if (in_array("",$type_photo)){
            $this->OutputJson(0,"车源照片类型不能为空",null);
        }
        if (in_array("",$property_photo)){
            $this->OutputJson(0,"车源图片不能为空",null);
        }
        $mode =CmsProperty::model()->find(" t.building_id='$building_id' and deleted=0 and house_no='$house_no'");
        if ($mode){
            $this->OutputJson(0,"编号已存在",null);
        }
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $model =new CmsProperty();
            $model->id=Guid::create_guid();
            $model->room_type=$room_type;
            $model->district_id=$district_id;//存区域id
            $model->estate_group_id=$estate_group_id;
            $model->area_id=$area_id;
            $model->estate_id=$estate_id;
            $model->building_id=$building_id;
            $model->house_no=$house_no;
            $model->room_area=$room_area;
            $model->area=$area;
            $model->price=$price*100;
            $model->orientation=$orientation;
            if ($idle_time){
                $idle_time=strtotime($idle_time);
                $model->idle_time=$idle_time;
            }
            $model->deposit=$deposit;
            $model->pay=$pay;
            $model->status=1;
            $model->status_now=$status_now;

            if ($end_time){
                $end_time=strtotime($end_time);
                $model->end_time=$end_time;
            }
            $model->time_memo=$time_memo;

            //$model->property_certificate_address=$property_certificate_address?$property_certificate_address:"";
            $model->ascription_id=Yii::app()->session['admin_uid'];
            $model->creater_id=Yii::app()->session['admin_uid'];
            $model->utime=time();
            $model->ctime=time();
            $model->deleted=0;

            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
            $propertydetail =new CmsPropertyDetail();
            $propertydetail->id=Guid::create_guid();
            $propertydetail->property_id=$model->id;
            $propertydetail->width=$width*100;
            $propertydetail->height=$height*100;
            $propertydetail->area_one=$area_one*100;
            $propertydetail->sum_area=$sum_area*100;
            $propertydetail->ti=$ti;
            $propertydetail->hu=$ti;
            $propertydetail->sunshine=$sunshine;
            $propertydetail->french_window=$french_window;
            $propertydetail->crutch=$crutch;
            $propertydetail->door=$door;
            $propertydetail->spray=$spray;
            $propertydetail->hide=$hide;
            $propertydetail->leak=$leak;
            $propertydetail->house_same=$house_same;
            $propertydetail->corridor_toilet=$corridor_toilet;
            $propertydetail->other_rentor=$other_rentor;
            $propertydetail->original_decoration=$original_decoration;
            $propertydetail->toplight=$toplight;
            $propertydetail->ground=$ground;
            $propertydetail->baseboard=$baseboard;
            $propertydetail->logo_front=$logo_front;
            $propertydetail->plug=$plug;
            $propertydetail->door_window=$door_window;
            $propertydetail->room_layout=$room_layout;
            $propertydetail->ceiling=$ceiling;
            $propertydetail->lamp=$lamp;
            $propertydetail->wall=$wall;
            $propertydetail->partition=$partition;
            $propertydetail->ctime=time();
            $propertydetail->deleted=0;
            if (!$propertydetail->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$propertydetail->errors,null);
                }
            }
            foreach($agent_name as $k => $v){
                if($v || $agent_phone[$k] ){
                    $propertagent =new CmsPropertyAgent();//代理人信息
                    $propertagent->id=Guid::create_guid();
                    $propertagent->property_id=$model->id;
                    $propertagent->agent_name=$v;
                    $propertagent->agent_phone=$agent_phone[$k];
                    $propertagent->show_order=$k;
                    $propertagent->ctime=time();
                    $propertagent->deleted=0;
                    if (!$propertagent->save()){
                        if(Yii::app()->request->isAjaxRequest){
                            $this->OutputJson(0,$propertagent->errors,null);
                        }
                    }
                }
            }

            $ownersg =new CmsOwnerSg();
            $ownersg->id=Guid::create_guid();
            $ownersg->property_id=$model->id;
            $ownersg->owner_name=$owner_name;
            $ownersg->owner_contact=$owner_contact;
            $ownersg->id_card=$id_card;
            $ownersg->owner_gender=$owner_gender;
            $ownersg->owner_age=$owner_age;
            $ownersg->owner_city=$owner_city;
            $ownersg->owner_roots=$owner_roots;
            $ownersg->owner_position=$owner_position;
            $ownersg->owner_trade=$owner_trade;

            $ownersg->company=$company;
            $ownersg->business_scope =$business_scope;
            $ownersg->business_project =$business_project;
            $ownersg->company_type =$company_type;
            $ownersg->core_project =$core_project;
            $ownersg->people =$people;
            $ownersg->rel_company =$rel_company;
            $ownersg->relation_company = $relation_company;
            $ownersg->friend_company = $friend_company;
            // $ownersg->friend_company1 = $friend_company1;
            $ownersg->ctime=time();
            $ownersg->deleted=0;
            if (!$ownersg->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$ownersg->errors,null);
                }
            }

            //车源图片
            if(!empty($type_photo)&&!empty($property_photo)){
                $order=0;
                foreach($type_photo as $k=>$value){
                    $property_photo[$k] = explode(",",$property_photo[$k]);
                    array_shift($property_photo[$k]);
                    foreach($property_photo[$k] as $k1=>$v1){
                        $propertyphoto = new CmsPropertyPhoto();
                        $propertyphoto->id = Guid::create_guid();
                        $propertyphoto->property_id = $model->id;
                        $propertyphoto->type_photo = $value;
                        $propertyphoto->url = $v1;
                        $propertyphoto->ctime = time();
                        $propertyphoto->show_order = $order;
                        if(!$propertyphoto->save()){
                            $this->OutputJson(0,json_encode($propertyphoto->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                    $order++;
                }
            }

            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/property");
    }

    public function actionEdit()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $id = Yii::app()->request->getParam("id");

        $model = CmsProperty::model()->find(" t.id='$id' and deleted='0'");
        $propertydetail = CmsPropertyDetail::model()->find(" t.property_id='$id' and deleted='0'");
        $ownersg = CmsOwnerSg::model()->find(" t.property_id='$id' and deleted='0'");
        $propertyagent = CmsPropertyAgent::model()->findAll(" t.property_id='$id' and deleted='0' order by show_order");
        //图片
        $photo = CmsPropertyPhoto::model()->findAll("property_id='$id' order by show_order");
        $v=[];
        foreach($photo as $value){
           $v[$value->type_photo][]=$value;
        }

        $this->render("edit",array(
            'model'=>$model,
            'propertydetail'=>$propertydetail,
            'ownersg'=>$ownersg,
            'photo'=>$v,
            'propertyagent'=>$propertyagent,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");
        // $room_type =Yii::app()->request->getParam("room_type");
        // $district_id =Yii::app()->request->getParam("district_id");
        // $estate_group_id =Yii::app()->request->getParam("estate_group_id");
        // $estate_id =Yii::app()->request->getParam("estate_id");
        // $area_id =Yii::app()->request->getParam("area_id");
        // $building_id =Yii::app()->request->getParam("building_id");
        // $house_no =Yii::app()->request->getParam("house_no");
        $room_area =Yii::app()->request->getParam("room_area");
        $area =Yii::app()->request->getParam("area");
        $price =Yii::app()->request->getParam("price");
        if($price==null){
            $price=0;
        }
        $orientation =Yii::app()->request->getParam("orientation");
        // $property_certificate_address =Yii::app()->request->getParam("property_certificate_address");

        $idle_time =Yii::app()->request->getParam("idle_time");
        $deposit =Yii::app()->request->getParam("deposit");
        $pay =Yii::app()->request->getParam("pay");
        $status =Yii::app()->request->getParam("status");
        $status_now =Yii::app()->request->getParam("status_now");
        $end_time =Yii::app()->request->getParam("end_time");
        $time_memo =Yii::app()->request->getParam("time_memo");
        $ascription_id =Yii::app()->request->getParam("ascription_id");

        //代理人信息cms_property_agent
        $agent_name =Yii::app()->request->getParam("agent_name");
        $agent_phone =Yii::app()->request->getParam("agent_phone");

        //车源详细信息cms_property_detail
        $width =Yii::app()->request->getParam("width");
        $height =Yii::app()->request->getParam("height");
        $area_one =Yii::app()->request->getParam("area_one");
        $sum_area =Yii::app()->request->getParam("sum_area");
        if($width==null){
            $width=0;
        }
        if($height==null){
            $height=0;
        }
        if($area_one==null){
            $area_one=0;
        }
        if($sum_area==null){
            $sum_area=0;
        }
        $ti =Yii::app()->request->getParam("ti");
        $hu =Yii::app()->request->getParam("hu");
        $sunshine =Yii::app()->request->getParam("sunshine");
        $french_window =Yii::app()->request->getParam("french_window");
        $crutch =Yii::app()->request->getParam("crutch");
        $door =Yii::app()->request->getParam("door");
        $spray =Yii::app()->request->getParam("spray");
        $hide =Yii::app()->request->getParam("hide");
        $leak =Yii::app()->request->getParam("leak");
        $house_same =Yii::app()->request->getParam("house_same");
        $corridor_toilet =Yii::app()->request->getParam("corridor_toilet");
        $other_rentor =Yii::app()->request->getParam("other_rentor");
        $original_decoration =Yii::app()->request->getParam("original_decoration");
        $toplight =Yii::app()->request->getParam("toplight");
        $ground =Yii::app()->request->getParam("ground");
        $baseboard =Yii::app()->request->getParam("baseboard");
        $logo_front =Yii::app()->request->getParam("logo_front");
        $plug =Yii::app()->request->getParam("plug");
        $door_window =Yii::app()->request->getParam("door_window");
        $room_layout =Yii::app()->request->getParam("room_layout");
        $ceiling =Yii::app()->request->getParam("ceiling");
        $lamp =Yii::app()->request->getParam("lamp");
        $wall =Yii::app()->request->getParam("wall");
        $partition =Yii::app()->request->getParam("partition");

        //车主个人信息cms_owner_sg
        $owner_name =Yii::app()->request->getParam("owner_name");
        $id_card =Yii::app()->request->getParam("id_card");
        $owner_gender =Yii::app()->request->getParam("owner_gender");
        $owner_age =Yii::app()->request->getParam("owner_age");
        $owner_city =Yii::app()->request->getParam("owner_city");
        $owner_roots =Yii::app()->request->getParam("owner_roots");
        $owner_position =Yii::app()->request->getParam("owner_position");
        $owner_trade =Yii::app()->request->getParam("owner_trade");
        $owner_contact =Yii::app()->request->getParam("owner_contact");
        $owner_contact=array_filter($owner_contact);
        $owner_contact = implode("/",$owner_contact);
        //公司信息cms_owner_sg
        $company =Yii::app()->request->getParam("company");
        $business_scope =Yii::app()->request->getParam("business_scope");
        $business_project =Yii::app()->request->getParam("business_project");
        $company_type =Yii::app()->request->getParam("company_type");
        $core_project =Yii::app()->request->getParam("core_project");
        $people =Yii::app()->request->getParam("people");

        $rel_company =Yii::app()->request->getParam("rel_company");
        $relation_company =Yii::app()->request->getParam("relation_company");
        $friend_company =Yii::app()->request->getParam("friend_company");
        // $friend_company1 =Yii::app()->request->getParam("friend_company1");
        //车源图片
        $type_photo =Yii::app()->request->getParam("type_photo");
        array_pop($type_photo);
        $property_photo =Yii::app()->request->getParam("property_photo");//车源图片
        array_pop($property_photo);
        if (in_array("",$type_photo)){
            $this->OutputJson(0,"车源照片类型不能为空",null);
        }
        if (in_array("",$property_photo)){
            $this->OutputJson(0,"车源图片不能为空",null);
        }
        $model =CmsProperty::model()->find("id='$id' and deleted='0'");
        if ($model){
            //日志存储
            $end_time1=strtotime($end_time);
            $idle_time1=strtotime($idle_time);
            $price1=$model->price/100;
            $model_old=['ascription_id'=>"$model->ascription_id","room_area"=>"$model->room_area","area"=>"$model->area","price"=>"$price1","orientation"=>"$model->orientation","idle_time"=>"$model->idle_time","deposit"=>"$model->deposit","pay"=>"$model->pay","status"=>"$model->status","status_now"=>"$model->status_now","end_time"=>"$model->end_time","time_memo"=>"$model->time_memo"];
            $model_new=['ascription_id'=>"$ascription_id","room_area"=>"$room_area","area"=>"$area","price"=>"$price","orientation"=>"$orientation","idle_time"=>"$idle_time1","deposit"=>"$deposit","pay"=>"$pay","status"=>"$status","status_now"=>"$status_now","end_time"=>"$end_time1","time_memo"=>"$time_memo"];
            $model_now=array_diff_assoc($model_new,$model_old);
            $model_arr=['ascription_id'=>'归属人',"room_area"=>"房本建筑面积","area"=>"幼狮承租建筑面积","price"=>"月租金","orientation"=>"朝向","idle_time"=>"空置时间","deposit"=>"押","pay"=>"付","status"=>"车源状态","status_now"=>"现状","end_time"=>"到期时间","time_memo"=>"备注"];
            $content="";
            $arr=CmsProperty::model()->arr();
            foreach($model_now as $key=>$value){
                $old=$model->$key;
                $new=$value;
                if($key=='ascription_id'){//归属人
                    if($model->$key){
                        $ascription_oldid=$model->$key;
                        $item1=AdminUser::model()->find("id='$ascription_oldid'");
                        $old=$item1->nickname;
                    }else{
                        $old='';
                    }
                    $item2=AdminUser::model()->find("id='$value'");
                    $new=$item2->nickname;
                }

                //车源状态
                if($key=='status'){
                    if($model->$key==null){
                        $old="";
                    }else{
                        $old=$arr['status'][$model->$key];
                    }
                    $new=$arr['status'][$value];
                }

                //现状
                if($key=='status_now'){
                    if($model->$key==null){
                        $old="";
                    }else{
                        $old=$arr['status_now'][$model->$key];
                    }
                    $new=$arr['status_now'][$value];
                }

                //到期时间
                if($key=='end_time'){
                    if($model->$key==null){
                        $old='';
                    }else{
                        $old=date('Y-m-d',$model->$key);
                    }
                    $new=date('Y-m-d',$value);
                }
                //空置时间
                if($key=='idle_time'){
                    if($model->$key==null){
                        $old='';
                    }else{
                        $old=date('Y-m-d',$model->$key);
                    }
                    if($value){
                       $new=date('Y-m-d',$value);
                    }else{
                        $new='';
                    }
                }
                //月租金
                if($key=='price'){
                    $old=$model->$key/100;
                    $new=$value;
                }
                $content.="$model_arr[$key]:把"."'".$old."'"."修改为"."'"."$new"."' ";
            }

            //车源详细信息日志存储
            $propertydetail =CmsPropertyDetail::model()->find("t.property_id='$id' and deleted='0'");
            $width1=$propertydetail->width/100;
            $height1=$propertydetail->height/100;
            $area_one1=$propertydetail->area_one/100;
            $sum_area1=$propertydetail->sum_area/100;
            if($propertydetail){
                $detail_old=['width'=>"$width1",'height'=>"$height1","area_one"=>"$area_one1","sum_area"=>"$sum_area1","ti"=>"$propertydetail->ti","hu"=>"$propertydetail->hu","sunshine"=>"$propertydetail->sunshine","french_window"=>"$propertydetail->french_window","crutch"=>"$propertydetail->crutch","door"=>"$propertydetail->door","spray"=>"$propertydetail->spray","hide"=>"$propertydetail->hide","leak"=>"$propertydetail->leak","house_same"=>"$propertydetail->house_same","corridor_toilet"=>"$propertydetail->corridor_toilet","other_rentor"=>"$propertydetail->other_rentor","original_decoration"=>"$propertydetail->original_decoration","toplight"=>"$propertydetail->toplight","ground"=>"$propertydetail->ground","baseboard"=>"$propertydetail->baseboard",
                "logo_front"=>"$propertydetail->logo_front","plug"=>"$propertydetail->plug","door_window"=>"$propertydetail->door_window","room_layout"=>"$propertydetail->room_layout","ceiling"=>"$propertydetail->ceiling","lamp"=>"$propertydetail->lamp","wall"=>"$propertydetail->wall","partition"=>"$propertydetail->partition"];
            }else{
                $detail_old=['width'=>"",'height'=>"","area_one"=>"","sum_area"=>"","ti"=>"","hu"=>"","sunshine"=>"","french_window"=>"","crutch"=>"","door"=>"","spray"=>"","hide"=>"","leak"=>"","house_same"=>"","corridor_toilet"=>"","other_rentor"=>"","original_decoration"=>"","toplight"=>"","ground"=>"","baseboard"=>"",
                "logo_front"=>"","plug"=>"","door_window"=>"","room_layout"=>"","ceiling"=>"","lamp"=>"","wall"=>"","partition"=>""];
            }

            $detail_new=['width'=>"$width",'height'=>"$height","area_one"=>"$area_one","sum_area"=>"$sum_area","ti"=>"$ti","hu"=>"$hu","sunshine"=>"$sunshine","french_window"=>"$french_window","crutch"=>"$crutch","door"=>"$door","spray"=>"$spray","hide"=>"$hide","leak"=>"$leak","house_same"=>"$house_same","corridor_toilet"=>"$corridor_toilet","other_rentor"=>"$other_rentor","original_decoration"=>"$original_decoration","toplight"=>"$toplight","ground"=>"$ground","baseboard"=>"$baseboard",
            "logo_front"=>"$logo_front","plug"=>"$plug","door_window"=>"$door_window","room_layout"=>"$room_layout","ceiling"=>"$ceiling","lamp"=>"$lamp","wall"=>"$wall","partition"=>"$partition"];
            $detail_now=array_diff_assoc($detail_new,$detail_old);
            $detail_arr=['width'=>"车源进深",'height'=>"车源净层高","area_one"=>"项目单层面积","sum_area"=>"使用面积","ti"=>"几梯","hu"=>"几户","sunshine"=>"采光性","french_window"=>"落地窗","crutch"=>"明显立柱","door"=>"户门大小","spray"=>"喷淋头","hide"=>"窗外有遮挡物","leak"=>"车源是否漏水","house_same"=>"车源面积与房本一致","corridor_toilet"=>"楼道及卫生间","other_rentor"=>"同层其他租户","original_decoration"=>"车源原始装修","toplight"=>"户内顶灯","ground"=>"地面品质","baseboard"=>"踢脚线品质",
            "logo_front"=>"隔断logo墙和前台品质","plug"=>"地插墙插布局合理性","door_window"=>"户门／窗户品质","room_layout"=>"车源布局合理性","ceiling"=>"吊顶品质","lamp"=>"灯具品质","wall"=>"墙面品质","partition"=>"隔断品质"];

            foreach($detail_now as $key=>$value){
                if($propertydetail){
                    $old=$propertydetail->$key;
                }else{
                    $old="";
                }
                $new=$value;
                if($key=='sunshine'){
                    if($propertydetail==null || $propertydetail->$key==null){
                        $old="";
                    }else{
                        $old=$arr['sunshine'][$propertydetail->$key];
                    }
                    $new=$arr['sunshine'][$value];
                }

                if($key=='french_window' || $key=='leak' || $key=='house_same'){
                    if($propertydetail==null || $propertydetail->$key==null){
                        $old="";
                    }else{
                        $old=$arr['french_window'][$propertydetail->$key];
                    }
                    $new=$arr['french_window'][$value];
                }

                if($key=='crutch' || $key=='hide'){
                    if($propertydetail==null || $propertydetail->$key==null){
                        $old="";
                    }else{
                        $old=$arr['crutch'][$propertydetail->$key];
                    }
                    $new=$arr['crutch'][$value];
                }

                if($key=='door'){
                    if($propertydetail==null || $propertydetail->$key==null){
                        $old="";
                    }else{
                        $old=$arr['door'][$propertydetail->$key];
                    }
                    $new=$arr['door'][$value];
                }

                if($key=='spray'){
                    if($propertydetail==null || $propertydetail->$key==null){
                        $old="";
                    }else{
                        $old=$arr['spray'][$propertydetail->$key];
                    }
                    $new=$arr['spray'][$value];
                }

                if($key=='corridor_toilet' || $key=='other_rentor'|| $key=='original_decoration'||$key=='toplight' ||$key=='ground'|| $key=='baseboard'||$key=='logo_front'||$key=='plug' ||$key=='door_window'|| $key=='room_layout'||$key=='ceiling' ||$key=='lamp'||$key=='wall' ||$key=='partition'){
                    if($propertydetail==null || $propertydetail->$key==null){
                        $old="";
                    }else{
                        $old=$arr['corridor_toilet'][$propertydetail->$key];
                    }
                    $new=$arr['corridor_toilet'][$value];
                }
                if($key=='width' || $key=='height' || $key=='area_one' || $key=='sum_area'){
                    $old=$propertydetail->$key/100;
                    $new=$value;
                }
                $content.="$detail_arr[$key]:把"."'".$old."'"."修改为"."'"."$new"."' ";
            }

            //车主个人信息日志存储
            $ownersg = CmsOwnerSg::model()->find(" t.property_id='$id' and deleted='0'");
            if($ownersg){
                $ownersg_old=['owner_name'=>"$ownersg->owner_name",'owner_contact'=>"$ownersg->owner_contact","id_card"=>"$ownersg->id_card","owner_gender"=>"$ownersg->owner_gender","owner_age"=>"$ownersg->owner_age","owner_city"=>"$ownersg->owner_city","owner_roots"=>"$ownersg->owner_roots","owner_position"=>"$ownersg->owner_position","owner_trade"=>"$ownersg->owner_trade","company"=>"$ownersg->company","business_scope"=>"$ownersg->business_scope","business_project"=>"$ownersg->business_project","company_type"=>"$ownersg->company_type","core_project"=>"$ownersg->core_project","people"=>"$ownersg->people","rel_company"=>"$ownersg->rel_company","relation_company"=>"$ownersg->relation_company","friend_company"=>"$ownersg->friend_company"];
            }else{
                $ownersg_old=['owner_name'=>"",'owner_contact'=>"","id_card"=>"","owner_gender"=>"","owner_age"=>"","owner_city"=>"","owner_roots"=>"","owner_position"=>"","owner_trade"=>"","company"=>"","business_scope"=>"","business_project"=>"","company_type"=>"","core_project"=>"","people"=>"","rel_company"=>"","relation_company"=>"","friend_company"=>""];
            }

            $ownersg_new=['owner_name'=>"$owner_name",'owner_contact'=>"$owner_contact","id_card"=>"$id_card","owner_gender"=>"$owner_gender","owner_age"=>"$owner_age","owner_city"=>"$owner_city","owner_roots"=>"$owner_roots","owner_position"=>"$owner_position","owner_trade"=>"$owner_trade","company"=>"$company","business_scope"=>"$business_scope","business_project"=>"$business_project","company_type"=>"$company_type","core_project"=>"$core_project","people"=>"$people","rel_company"=>"$rel_company","relation_company"=>"$relation_company","friend_company"=>"$friend_company"];
            $ownersg_now=array_diff_assoc($ownersg_new,$ownersg_old);
            $ownersg_arr=['owner_name'=>"车主姓名",'owner_contact'=>"联系方式","id_card"=>"身份证号","owner_gender"=>"性别","owner_age"=>"年龄","owner_city"=>"所在城市","owner_roots"=>"籍贯","owner_position"=>"职位","owner_trade"=>"从事行业","company"=>"企业名称","business_scope"=>"主要经营范围","business_project"=>"经营项目","company_type"=>"公司类型","core_project"=>"核心经营项目","people"=>"办公人数","rel_company"=>"车主亲属公司","relation_company"=>"车主关联上下游公司","friend_company"=>"车主朋友公司"];
            foreach($ownersg_now as $key=>$value){
                if($ownersg){
                    $old=$ownersg->$key;
                }else{
                    $old="";
                }

                $new=$value;
                if($key=='owner_gender'){
                    if($ownersg==null || $ownersg->$key==null){
                        $old="";
                    }else{
                        $old=$arr['owner_gender'][$ownersg->$key];
                    }
                    $new=$arr['owner_gender'][$value];
                }
                $content.="$ownersg_arr[$key]:把"."'".$old."'"."修改为"."'"."$new"."' ";
            }

            if($content){
                $propertylog = new CmsPropertyLog;
                $propertylog->id=Guid::create_guid();
                $propertylog->property_id=$id;
                $propertylog->content=$content;
                $propertylog->create_user_id=Yii::app()->session['admin_uid'];
                $propertylog->deleted=0;
                $propertylog->ctime=time();
                if(!$propertylog->save()){
                    $this->OutputJson(0,json_encode($propertylog->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }

            //修改车源
            $old_model =CmsProperty::model()->find("t.id<>'$id' and deleted=0 and t.building_id='$building_id' and house_no='$house_no'");
            if ($old_model){
                $this->OutputJson(0,"编号已存在",null);
            }
            // $model->building_id=$building_id;
            // $model->house_no=$house_no;
            $model->room_area=$room_area;
            $model->area=$area;
            $model->price=$price*100;
            $model->orientation=$orientation;
            if ($idle_time){
                $idle_time=strtotime($idle_time);
            }
            $model->idle_time=$idle_time;
            $model->deposit=$deposit;
            $model->pay=$pay;
            $model->status=$status;
            $model->status_now=$status_now;

            if ($end_time){
                $end_time=strtotime($end_time);
            }
            $model->end_time=$end_time;
            $model->time_memo=$time_memo;
            //$model->property_certificate_address=$property_certificate_address?$property_certificate_address:"";
            $model->creater_id=Yii::app()->session['admin_uid'];
            $model->ascription_id=$ascription_id;
            $model->utime=time();
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }

            //车源详细信息cms_property_detail
            $propertydetail = CmsPropertyDetail::model()->find("property_id='$id' and deleted='0'");
            if($propertydetail==null){
                $propertydetail=new CmsPropertyDetail();
                $propertydetail->id=Guid::create_guid();
            }
                $propertydetail->property_id=$id;
                // $propertydetail =CmsPropertyDetail::model()->find(" t.property_id='$id'");
                $propertydetail->width=$width*100;
                $propertydetail->height=$height*100;
                $propertydetail->area_one=$area_one*100;
                $propertydetail->sum_area=$sum_area*100;
                $propertydetail->ti=$ti;
                $propertydetail->hu=$hu;
                $propertydetail->sunshine=$sunshine;
                $propertydetail->french_window=$french_window;
                $propertydetail->crutch=$crutch;
                $propertydetail->door=$door;
                $propertydetail->spray=$spray;
                $propertydetail->hide=$hide;
                $propertydetail->leak=$leak;
                $propertydetail->house_same=$house_same;
                $propertydetail->corridor_toilet=$corridor_toilet;
                $propertydetail->other_rentor=$other_rentor;
                $propertydetail->original_decoration=$original_decoration;
                $propertydetail->toplight=$toplight;
                $propertydetail->ground=$ground;
                $propertydetail->baseboard=$baseboard;
                $propertydetail->logo_front=$logo_front;
                $propertydetail->plug=$plug;
                $propertydetail->door_window=$door_window;
                $propertydetail->room_layout=$room_layout;
                $propertydetail->ceiling=$ceiling;
                $propertydetail->lamp=$lamp;
                $propertydetail->wall=$wall;
                $propertydetail->partition=$partition;
                $propertydetail->deleted=0;
                $propertydetail->ctime=time();
                if (!$propertydetail->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(0,$propertydetail->errors,null);
                    }
                }

            CmsPropertyAgent::model()->updateAll(array('deleted'=>'1'),'property_id=:pass',array(':pass'=>$id));
            foreach($agent_name as $k => $v){
                if($v || $agent_phone[$k] ){
                    $propertagent =new CmsPropertyAgent();//代理人信息
                    $propertagent->id=Guid::create_guid();
                    $propertagent->property_id=$id;
                    $propertagent->agent_name=$v;
                    $propertagent->agent_phone=$agent_phone[$k];
                    $propertagent->show_order=$k;
                    $propertagent->ctime=time();
                    $propertagent->deleted=0;
                    if (!$propertagent->save()){
                        if(Yii::app()->request->isAjaxRequest){
                            $this->OutputJson(0,$propertagent->errors,null);
                        }
                    }
                }
            }

            $ownersg = CmsOwnerSg::model()->find("property_id='$id' and deleted='0'");
            if($ownersg==null){
                $ownersg=new CmsOwnerSg();
                $ownersg->id=Guid::create_guid();
            }
            $ownersg->property_id=$id;
            $ownersg->owner_name=$owner_name;
            $ownersg->owner_contact=$owner_contact;
            $ownersg->id_card=$id_card;
            $ownersg->owner_gender=$owner_gender;
            $ownersg->owner_age=$owner_age;
            $ownersg->owner_city=$owner_city;
            $ownersg->owner_roots=$owner_roots;
            $ownersg->owner_position=$owner_position;
            $ownersg->owner_trade=$owner_trade;

            $ownersg->company=$company;
            $ownersg->business_scope =$business_scope;
            $ownersg->business_project =$business_project;
            $ownersg->company_type =$company_type;
            $ownersg->core_project =$core_project;
            $ownersg->people =$people;
            $ownersg->rel_company =$rel_company;
            $ownersg->relation_company = $relation_company;
            $ownersg->friend_company = $friend_company;
            // $ownersg->friend_company1 = $friend_company1;
            $ownersg->deleted = 0;
            $ownersg->ctime = time();
            if (!$ownersg->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$ownersg->errors,null);
                }
            }

            //写入品牌图片表
            if($property_photo){
                $order=0;
                foreach($type_photo as $k=>$value){

                    if(!empty($property_photo[$k])){

                        CmsPropertyPhoto::model()->deleteAll("property_id='$id' and show_order='$k'");
                        $property_photo[$k] = explode(",",$property_photo[$k]);
                        array_shift($property_photo[$k]);
                        foreach($property_photo[$k] as $k1=>$v1){
                            $model_property = new CmsPropertyPhoto;
                            $model_property->id = Guid::create_guid();
                            $model_property->property_id = $model->id;
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
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",$referer);
        }
        else{
            $this->redirect($referer);
        }
    }

    public function actionDetail()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model = CmsProperty::model()->find(" t.id='$id' and deleted='0'");
        $propertydetail = CmsPropertyDetail::model()->find(" t.property_id='$id' and deleted='0'");
        $ownersg = CmsOwnerSg::model()->find(" t.property_id='$id' and deleted='0'");
        $propertyagent = CmsPropertyAgent::model()->findAll(" t.property_id='$id' and deleted='0' order by show_order");
        //图片
        $photo = CmsPropertyPhoto::model()->findAll("property_id='$id' order by show_order");
        $v=[];
        foreach($photo as $value){
           $v[$value->type_photo][]=$value;
        }

        $this->render("detail",array(
            'model'=>$model,
            'propertydetail'=>$propertydetail,
            'ownersg'=>$ownersg,
            'photo'=>$v,
            'propertyagent'=>$propertyagent,
            'referer'=>$referer,
        ));
    }

    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            CmsProperty::model()->updateAll(array('deleted'=>'1'),'id=:pid',array(':pid'=>$id));
            CmsPropertyDetail::model()->updateAll(array('deleted'=>'1'),'property_id=:pid',array(':pid'=>$id));
            CmsOwnerSg::model()->updateAll(array('deleted'=>'1'),'property_id=:pid',array(':pid'=>$id));
            CmsPropertyFollow::model()->updateAll(array('deleted'=>'1'),'property_id=:pid',array(':pid'=>$id));
            CmsPropertyLog::model()->updateAll(array('deleted'=>'1'),'property_id=:pid',array(':pid'=>$id));
            CmsPropertyPhoto::model()->updateAll(array('deleted'=>'1'),'property_id=:pid',array(':pid'=>$id));
            CmsPropertyAgent::model()->updateAll(array('deleted'=>'1'),'property_id=:pid',array(':pid'=>$id));
            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,"删除失败",null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }

        $this->redirect($referer);
    }

//查看日志
    public function actionLog()
    {
        $property_id =Yii::app()->request->getParam("id");
        $pagesize=10;

        $criteria=new CDbCriteria;

        $criteria->addCondition("property_id='$property_id'");
        $criteria->order="t.ctime desc";
        $count=CmsPropertyLog::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list = CmsPropertyLog::model()->findAll($criteria);
        $this->render("log",array(
            'list'=>$list,
            'pages'=>$pager,
        ));
    }

//添加跟进
    public function actionFollowAddSave()
    {
        $property_id = Yii::app()->request->getParam('property_id');
        $type =Yii::app()->request->getParam("type");
        $see_way =Yii::app()->request->getParam("see_way");
        $detail=Yii::app()->request->getParam("detail");
        $start_time=Yii::app()->request->getParam("start_time");
        $end_time=Yii::app()->request->getParam("end_time");
        $house_status=Yii::app()->request->getParam("house_status");

        $propertyfollow =new CmsPropertyFollow();
        $propertyfollow->id=Guid::create_guid();
        $propertyfollow->property_id=$property_id;
        $propertyfollow->type=$type;
        $propertyfollow->creater_id=Yii::app()->session['admin_uid'];
        $propertyfollow->follow_time=time();
        $propertyfollow->see_way=$see_way;
        $propertyfollow->detail=$detail;
        if ($start_time){
            $start_time=strtotime($start_time);
            $propertyfollow->start_time=$start_time;
        }
        if ($end_time){
            $end_time=strtotime($end_time);
            $propertyfollow->end_time=$end_time;
        }
        $propertyfollow->house_status=$house_status;

        if (!$propertyfollow->save()){
            $this->result(0,$propertyfollow->errors,null);
        }
        $this->OutputJson(301,'',"/admin/property");
    }

//查看跟进
    public function actionFollow()
    {
        $property_id =Yii::app()->request->getParam("id");
        $pagesize=10;

        $criteria=new CDbCriteria;

        $criteria->addCondition("property_id='$property_id'");
        $criteria->order="t.follow_time desc";
        $count=CmsPropertyFollow::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list = CmsPropertyFollow::model()->findAll($criteria);
        // $list1 =CmsPropertyFollow::model()->findAll("type='1' and property_id='$property_id'");
        // $list2 =CmsPropertyFollow::model()->findAll("type='2' and property_id='$property_id'");
        $this->render("followlist",array(
            'list'=>$list,
            'pages'=>$pager,
        ));
    }

    public function actionSplit(){
        //$k =Yii::app()->request->getParam("k");
        $id =Yii::app()->request->getParam("id");
        //$pagesize=10;

        $criteria=new CDbCriteria;
        //if($k){
            $criteria->condition="1=1 and t.deleted=0 and split_partent_id='$id'";
        // }
        // else{
        //     $criteria->condition="1=1 and t.deleted=0";
        // }

        $criteria->order='t.ctime DESC';
        // $count = CmsProperty::model()->count($criteria);

        // $pager=new CPagination($count);
        // $pager->pageSize=$pagesize;
        // $pager->applyLimit($criteria);

        $list =CmsProperty::model()->findAll($criteria);

        $this->render("splitindex",array(
            'property_id'=>$id,
            'list'=>$list,
            // 'pages'=>$pager,
            // 'k'=>$k,
        ));
    }

    public function actionSplitAdd(){
        $referer= $_SERVER['HTTP_REFERER'];
        $property_id=Yii::app()->request->getParam("id");
        $property=CmsProperty::model()->find("id='$property_id'");

        $this->render("splitadd",array(
            'referer'=>$referer,
            'property_id'=>$property_id,
            'property'=>$property,
        ));
    }

    public function actionSplitAddSave()
    {
        $referer= $_SERVER['HTTP_REFERER'];

        $property_id =Yii::app()->request->getParam("property_id");
        $property=CmsProperty::model()->find("id='$property_id'");

        $district_id =$property->district_id;
        $estate_group_id =$property->estate_group_id;
        $area_id =$property->area_id;
        $estate_id =$property->estate_id;
        $building_id =$property->building_id;

        $house_no =Yii::app()->request->getParam("house_no");
        $room_type =$property->room_type;
        // $ting =Yii::app()->request->getParam("ting");
        // $shi =Yii::app()->request->getParam("shi");
        // $chu =Yii::app()->request->getParam("chu");
        // $wei =Yii::app()->request->getParam("wei");

        $orientation =Yii::app()->request->getParam("orientation");
        $area =Yii::app()->request->getParam("area");

        $model =CmsProperty::model()->find(" t.building_id='$building_id' and house_no='$house_no' and deleted='0'");
        if ($model){
            $this->OutputJson(0,"编号已存在",null);
        }

        $a=CmsProperty::model()->findAll("split_partent_id='$property_id' and deleted='0'");
        $s_area=0;
        foreach($a as $v){
            $s_area=$s_area+$v->area;
        }
        $a_area=($property->area)-$s_area;//剩余面积
        $area = round($area,2);

        if ($area-0.01>$a_area){
            $this->OutputJson(0,"拆分面积大于本房间实际剩余面积",null);
        }

        $model =new CmsProperty();
        $model->id=Guid::create_guid();

        // $estate=BaseEstate::model()->find("id='$estate_id'");
        // $area_id=$estate->area_id;
        // $basearea=BaseArea::model()->find("id='$area_id'");
        // $district_id=$basearea->district_id;
        $model->district_id=$district_id;
        $model->estate_group_id=$estate_group_id;
        $model->area_id=$area_id;

        $model->estate_id=$estate_id;
        $model->building_id=$building_id;
        $model->house_no=$house_no;
        $model->room_type=$room_type;
        // $model->ting=$ting;
        // $model->shi=$shi;
        // $model->chu=$chu;
        // $model->wei=$wei;
        $model->orientation=$orientation;
        $model->area=$area;
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->ctime=time();

        $model->split=1;
        $model->split_partent_id=$property_id;
        $model->deleted=0;

        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$model->errors,null);
            }
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/property/split/id/$property_id");
        }
        else{
            $this->redirect($referer);
        }

        $this->redirect($referer);
    }

    public function actionSplitEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =CmsProperty::model()->find(" t.id='$id'");

        $this->render("splitedit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionSplitEditSave()
    {
        $id =Yii::app()->request->getParam("id");

        $referer =Yii::app()->request->getParam("referer");
        //$district_id =Yii::app()->request->getParam("district_id");
        //$area_id =Yii::app()->request->getParam("area_id");
        // $estate_id =Yii::app()->request->getParam("estate_id");
        // $building_id =Yii::app()->request->getParam("building_id");

        $house_no =Yii::app()->request->getParam("house_no");

        // $room_type =Yii::app()->request->getParam("room_type");
        // $ting =Yii::app()->request->getParam("ting");
        // $shi =Yii::app()->request->getParam("shi");
        // $chu =Yii::app()->request->getParam("chu");
        // $wei =Yii::app()->request->getParam("wei");
        $orientation =Yii::app()->request->getParam("orientation");
        $area =Yii::app()->request->getParam("area");

        $a =CmsProperty::model()->find(" t.id='$id'")['split_partent_id'];
        $b =CmsProperty::model()->find(" t.id='$a'")['area'];//整体房间面积
        $c=CmsProperty::model()->findAll("split_partent_id='$a' and deleted='0' and t.id<>'$id'");
        $s_area=0;
        foreach($c as $v){
            $s_area=$s_area+$v->area;
        }
        $a_area=$b-$s_area;//剩余面积

        $area = round($area,2);
        if ($a_area-0.01>$area){
            $this->OutputJson(0,"拆分面积大于本房间实际剩余面积",null);
        }
        $model =CmsProperty::model()->find(" t.id='$id'");
        if ($model){
            $old_model =CmsProperty::model()->find("t.id<>'$id' and t.building_id='$model->building_id' and house_no='$house_no' and deleted='0'");
            if ($old_model){
                $this->OutputJson(0,"编号已存在",null);
            }

            $model->house_no=$house_no;
            $model->orientation=$orientation;
            $model->area=$area;

            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",$referer);
        }
        else{
            $this->redirect($referer);
        }
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
            download($filename, '车源图片');
    }

    public function actionAjaxlistByBuildingID()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $k =Yii::app()->request->getParam("q");
        $building_id =Yii::app()->request->getParam("building_id");
        if ($k){
            $criteria->condition="1=1 and t.building_id='$building_id' and t.deleted=0 and t.house_no like '%$k%'";
        }

        // else
        // {
        //     $criteria->condition="1=1 and t.deleted=0";
        // }

        //$criteria->order='t.ctime DESC';
        $count = CmsProperty::model()->count($criteria);



        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =CmsProperty::model()->findAll($criteria);
        //$data["total"]=10;
        if ($list){
            foreach ($list as $key => $user) {
                $_data["id"]=$user->id;
                $_data["title"]=$user->house_no;
                $data["movies"][]=$_data;
            }
        }
        else{
            $_data["id"]="";
            $_data["title"]="";
            $data["movies"][]=$_data;
        }
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }

    public function actionAjaxlistByID()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $property_id =Yii::app()->request->getParam("id");
        $criteria->condition="1=1 and t.id='$property_id' and t.deleted=0";

        $property =CmsProperty::model()->find($criteria);
        if ($property){
            $data["id"]=$property->id;
            $data["area"]=$property->area;
            $data["room_type"]=$property->room_type;
            $data["property_id"]=$property->id;
        }
        else{
            $data["id"]="";
            $data["area"]=0;
            $data["property_id"]="";
        }
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }
}
