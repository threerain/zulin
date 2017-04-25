<?php

class DecorationController extends BackgroundBaseController
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
        $k_sctime=Yii::app()->request->getParam("k_sctime");//录入日期开始
        $k_ectime=Yii::app()->request->getParam("k_ectime");//录入日期结束
        $k_project_stime=Yii::app()->request->getParam("k_project_stime");//整体工程起日
        $k_project_etime=Yii::app()->request->getParam("k_project_etime");//整体工程止日
        $k_docking_people=Yii::app()->request->getParam("k_docking_people");//质量管理对接人
        $k_decstatus=Yii::app()->request->getParam("k_decstatus");
        $pagesize=10;
        /*
            根据车源查出车源的ID对应上合同
         */
        //商圈-编号的搜索开始
        $decoration_id1=[];
        $decoration_id2=[];
        $decoration_id3=[];
        $decoration_id4=[];
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
                        $res=QualityDecorationProperty::model()->findAll("property_id='$value->id'");
                        foreach($res as $key=>$v){
                            $decoration_id1[]="'".$v->decoration_id."'";
                        }
                    }
                }
            }
        }
        $decoration_id1 = implode(',',$decoration_id1);
        //品牌
        if($k_estates){
            $estates=BaseEstate::model()->findAll("name like '%".$k_estates."%' and deleted=0");
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
                        $res=QualityDecorationProperty::model()->findAll("property_id='$value->id'");
                        foreach($res as $key=>$v){
                            $decoration_id2[]="'".$v->decoration_id."'";
                        }
                    }
                }
            }
        }
        $decoration_id2 = implode(',',$decoration_id2);
        //系列
        if($k_building){
            $building=BaseBuilding::model()->findAll("name like '%".$k_building."%'  and deleted=0");
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
                        $res=QualityDecorationProperty::model()->findAll("property_id='$value->id'");
                        foreach($res as $key=>$v){
                            $decoration_id3[]="'".$v->decoration_id."'";
                        }
                    }
                }
            }
        }
        $decoration_id3 = implode(',',$decoration_id3);
        //编号
        if($k_number){
            $property4=CmsProperty::model()->findAll("house_no like '%".$k_number."%' and deleted=0");
            foreach ($property4 as $key => $value) {
                if($value){
                    $res=QualityDecorationProperty::model()->findAll("property_id='$value->id'");
                    foreach($res as $key=>$v){
                        $decoration_id4[]="'".$v->decoration_id."'";
                    }
                }
            }
        }
        $decoration_id4 = implode(',',$decoration_id4);
        //商圈-编号的搜索结束

        $admin=AdminUser::model()->findAll("nickname like '%".$k_docking_people."%'");//质量管理对接人
        $admin_id="";
        foreach ($admin as $key => $value) {
            if ($key==0){
                $admin_id.="'".$value->id."'";
            }
            else{
                $admin_id.=","."'".$value->id."'";
            }

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
                    $decoration_id[]="'".$item->decoration_id."'";
                }
            }
            $decoration_id=array_flip($decoration_id);
            $decoration_id=array_flip($decoration_id);
            $decoration_id=implode(",",$decoration_id);
        }
        $condition="1=1 and t.deleted=0";
        $condition.=" and  ( 1=1  ";
            // if($k_area!=null || $k_estates!=null || $k_building!=null || $k_number!=null){
            //     if($decoration_id){
            //         $condition.= " and  id in ($decoration_id) ";
            //     }else{
            //         $condition.= " and  id in ('') ";
            //     }
            // }
            //商圈-编号的搜索开始
            if($k_area!=null){
                if($decoration_id1){
                    $condition.= " and  id in ($decoration_id1) ";
                }else{
                    $condition.= " and  id in ('') ";
                }
            }
            if($k_estates!=null){
                if($decoration_id2){
                    $condition.= " and  id in ($decoration_id2) ";
                }else{
                    $condition.= " and  id in ('') ";
                }
            }
            if($k_building!=null){
                if($decoration_id3){
                    $condition.= " and  id in ($decoration_id3) ";
                }else{
                    $condition.= " and  id in ('') ";
                }
            }
            if($k_number!=null){
                if($decoration_id4){
                    $condition.= " and  id in ($decoration_id4) ";
                }else{
                    $condition.= " and  id in ('') ";
                }
            }
            //商圈-编号的搜索结束
            $k_time1=strtotime($k_sctime);
            $k_time2=strtotime($k_ectime)+24*3600;
            if ($k_sctime) {
                $condition.=" and ctime >= '$k_time1' ";
            }
            if ($k_ectime) {
                $condition.=" and ctime <= '$k_time2' ";
            }
            $k_project_stime1=strtotime($k_project_stime);
            $k_project_etime2=strtotime($k_project_etime);
            if ($k_project_stime || $k_project_etime) {
                $condition.=" and project_start_time >= '$k_project_stime1' and  project_end_time <= '$k_project_etime2'";
            }
            if ($k_docking_people!=null) {
                if($admin_id){
                    $condition.= " and  docking_people in ($admin_id) ";
                }else{
                    $condition.= " and  docking_people in ('')";
                }
            }
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
        $criteria->order='t.ctime DESC';
        $count = QualityDecoration::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list = QualityDecoration::model()->findAll($criteria);
        $ursarr=UrsPropertyDetail::model()->arr();
        if($k_decstatus==null){
           $k_decstatus=[];
        }
        $this->render("index",array(
            'list'=>$list,
            'pages'=>$pager,
            'k_area'=>$k_area,
            'k_estates'=>$k_estates,
            'k_building'=>$k_building,
            'k_number'=>$k_number,
            'k_sctime'=>$k_sctime,
            'k_ectime'=>$k_ectime,
            'k_project_stime'=>$k_project_stime,
            'k_project_etime'=>$k_project_etime,
            'k_docking_people'=>$k_docking_people,
            'k_decstatus'=>$k_decstatus,
            'search'=>$search,
            'ursarr'=>$ursarr,
        ));
    }

    public function actionAdd()//添加预算信息
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $this->render("add",array(
            'referer'=>$referer,
        ));
    }

    public function actionAddSave()//添加预算信息功能
    {
        $referer =Yii::app()->request->getParam("referer");
        $property_id =Yii::app()->request->getParam("property_id");//所在车源id
        $supervisor =Yii::app()->request->getParam("supervisor");
        $foreman =Yii::app()->request->getParam("foreman");
        $docking_people =Yii::app()->request->getParam("docking_people");
        $project_start_time =Yii::app()->request->getParam("project_start_time");
        $project_end_time =Yii::app()->request->getParam("project_end_time");
        $docking_date =Yii::app()->request->getParam("docking_date");
        $attachment_photo =Yii::app()->request->getParam("attachment_photo");//上传附件
        $attachment_photo = explode(",",$attachment_photo);
        array_shift($attachment_photo);
        $attachment =Yii::app()->request->getParam("attachment_photo_show");//附件名

        $list_photo =Yii::app()->request->getParam("list_photo");//上传CAD图片
        $list_photo = explode(",",$list_photo);
        array_shift($list_photo);
        $budget_photo =Yii::app()->request->getParam("budget_photo");//上传价格预算扫描件
        $budget_photo = explode(",",$budget_photo);
        array_shift($budget_photo);
        $list_material =Yii::app()->request->getParam("list_material");
        $unit =Yii::app()->request->getParam("unit");
        $material_brands =Yii::app()->request->getParam("material_brands");
        $number =Yii::app()->request->getParam("number");
        $unit_price =Yii::app()->request->getParam("unit_price");
        $total =Yii::app()->request->getParam("total");
        if($project_start_time){
            $project_start_time =strtotime($project_start_time);
        }
        if($project_end_time){
            $project_end_time =strtotime($project_end_time);
        }
        if($docking_date){
            $docking_date =strtotime($docking_date);
        }
        $contract_id=[];
        foreach($property_id as $value){
           $contract_id[]=Property::PurchaseContractAll($value)['id'];
            if(in_array('', $contract_id)){
                $this->OutputJson(0,"合同不存在",null);
            }
        }
        if(count($property_id)>1){
            $contract=array_unique($contract_id);
            if(count($contract)!=1){
                $this->OutputJson(0,"这几个车源不在一个合同上",null);
            }else{
                $contract_id=$contract;
            }
        }else if(count($property_id)==1){
            $contract_id=$contract_id;
        }
       $contract_id = implode("",$contract_id);
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $model = new QualityDecoration;
            $model->id = Guid::create_guid();
            $model->contract_id = $contract_id;
            $model->decoration_type = 1;
            $model->status = 1;
            $model->supervisor = $supervisor;
            $model->foreman = $foreman;
            $model->docking_people = $docking_people;
            $model->project_start_time = $project_start_time;
            $model->project_end_time = $project_end_time;
            $model->docking_date = $docking_date;
            $model->creater_id = Yii::app()->session['admin_uid'];
            $model->ctime = time();
            $model->deleted = 0;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            $show_order =1;
            foreach ($list_material as $k => $v) {
                $budget_settlement = new QualityBudgetSettlement;
                $budget_settlement->id = Guid::create_guid();
                $budget_settlement->decoration_id = $model->id;
                $budget_settlement->type = 1;
                $budget_settlement->list_material = $v;
                $budget_settlement->unit = $unit[$k];
                $budget_settlement->material_brands = $material_brands[$k];
                $budget_settlement->number = $number[$k]*100;
                $budget_settlement->unit_price = $unit_price[$k]*100;
                $budget_settlement->total = $total[$k]*100;
                $budget_settlement->creater_id = Yii::app()->session['admin_uid'];
                $budget_settlement->show_order = $show_order;
                $budget_settlement->ctime = time();
                $budget_settlement->deleted = 0;
                $show_order++;
                $budget_settlement->ctime = time();
                $budget_settlement->deleted = 0;
                if (!$budget_settlement->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(0,json_encode($budget_settlement->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            if(!empty($property_id)){//装修管理表和车源关联表
                foreach($property_id as $k => $v){
                    $data = new QualityDecorationProperty;
                    $data->id = Guid::create_guid();
                    $data->decoration_id = $model->id;
                    $data->property_id = $v;
                    $data->ctime = time();
                    $data->deleted = 0;
                    if(!$data->save()){
                        $this->OutputJson(0,json_encode($data->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }

            }

            if($attachment){//上传附件
                array_shift($attachment);
                foreach($attachment as $k => $v){
                    if($v){
                        $list_decoration_photo = new QualityDecorationPhoto;
                        $list_decoration_photo->id = Guid::create_guid();
                        $list_decoration_photo->decoration_id = $model->id;
                        $list_decoration_photo->photo_type = 4;
                        $list_decoration_photo->attachment = $v;
                        $list_decoration_photo->url = $attachment_photo[$k];
                        $list_decoration_photo->ctime = time()+$k;
                        $list_decoration_photo->deleted = 0;
                        if(!$list_decoration_photo->save()){
                            $this->OutputJson(0,json_encode($list_decoration_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            if($list_photo){//上传CAD图片
                foreach($list_photo as $k => $v){
                    $list_decoration_photo = new QualityDecorationPhoto;
                    $list_decoration_photo->id = Guid::create_guid();
                    $list_decoration_photo->decoration_id = $model->id;
                    $list_decoration_photo->photo_type = 1;
                    $list_decoration_photo->url = $v;
                    $list_decoration_photo->ctime = time()+$k;
                    $list_decoration_photo->deleted = 0;
                    if(!$list_decoration_photo->save()){
                        $this->OutputJson(0,json_encode($list_decoration_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            if($budget_photo){//上传价格预算扫描件
                foreach($budget_photo as $k => $v){
                    $budget_decoration_photo = new QualityDecorationPhoto;
                    $budget_decoration_photo->id = Guid::create_guid();
                    $budget_decoration_photo->decoration_id = $model->id;
                    $budget_decoration_photo->photo_type = 2;
                    $budget_decoration_photo->url = $v;
                    $budget_decoration_photo->ctime = time()+$k;
                    $budget_decoration_photo->deleted = 0;
                    if(!$budget_decoration_photo->save()){
                        $this->OutputJson(0,json_encode($budget_decoration_photo->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/decoration");

    }

    public function actionCreate()//添加结算信息
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $quality_follow = UrsDecorationFollow::model()->find("decoration_id='$id' order by ctime desc");//结算
        $this->render("create",array(
            'referer'=>$referer,
            'decoration_id'=>$id,
            'quality_follow'=>$quality_follow,
        ));
    }
    public function actionCreateSave()//添加结算信息功能
    {
        $referer =Yii::app()->request->getParam("referer");
        $decoration_id =Yii::app()->request->getParam("decoration_id");//所在装修列表id
        $settlement_photo =Yii::app()->request->getParam("settlement_photo");//上传价格结算扫描件
        $settlement_photo = explode(",",$settlement_photo);
        array_shift($settlement_photo);
        $list_material =Yii::app()->request->getParam("list_material");
        $unit =Yii::app()->request->getParam("unit");
        $material_brands =Yii::app()->request->getParam("material_brands");
        $number =Yii::app()->request->getParam("number");
        $unit_price =Yii::app()->request->getParam("unit_price");
        $total =Yii::app()->request->getParam("total");
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $model = QualityDecoration::model()->find("id = '$decoration_id'");
            $model->status = 3;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            $show_order =1;
            foreach ($list_material as $k => $v) {//价格结算
                $budget_settlement = new QualityBudgetSettlement;
                $budget_settlement->id = Guid::create_guid();
                $budget_settlement->decoration_id = $decoration_id;
                $budget_settlement->type = 2;
                $budget_settlement->list_material = $v;
                $budget_settlement->unit = $unit[$k];
                $budget_settlement->material_brands = $material_brands[$k];
                $budget_settlement->number = $number[$k]*100;
                $budget_settlement->unit_price = $unit_price[$k]*100;
                $budget_settlement->total = $total[$k]*100;
                $budget_settlement->creater_id = Yii::app()->session['admin_uid'];
                $budget_settlement->show_order = $show_order;
                $budget_settlement->ctime = time();
                $budget_settlement->deleted = 0;
                $show_order++;
                if (!$budget_settlement->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(0,json_encode($budget_settlement->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }
            if($settlement_photo){//上传价格结算扫描件
                foreach($settlement_photo as $k => $v){
                    $settlement_dphoto = new QualityDecorationPhoto;
                    $settlement_dphoto->id = Guid::create_guid();
                    $settlement_dphoto->decoration_id = $decoration_id;
                    $settlement_dphoto->photo_type = 3;
                    $settlement_dphoto->url = $v;
                    $settlement_dphoto->ctime = time()+$k;
                    $settlement_dphoto->deleted = 0;
                    if(!$settlement_dphoto->save()){
                        $this->OutputJson(0,json_encode($settlement_dphoto->errors,JSON_UNESCAPED_UNICODE),null);
                    }
                }
            }

            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        /*返回*/
        $this->OutputJson(301,'',"/admin/decoration");
    }

    public function actionEdit()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $id = Yii::app()->request->getParam("id");
        $model = QualityDecoration::model()->find(" t.id='$id'");
        $quality_budget = QualityBudgetSettlement::model()->findAll("decoration_id='$id' and type=1 order by show_order");//预算
        $quality_settlement = QualityBudgetSettlement::model()->findAll("decoration_id='$id' and type=2 order by show_order");//结算
        if($id){
            $data = QualityDecorationProperty::model()->findAll(array(
                'select'=>array('property_id'),
                'condition'=>"decoration_id = '$id'",
            ));
            $allinfo = [];//车源全部信息
            $area = [];
            $sum_area=0;
            foreach ($data as $key => $value) {
                    $property = CmsProperty::model()->find(array(
                        'select'=>array('estate_id,building_id,house_no,area'),
                        'condition'=>"id = '$value->property_id' and deleted=0",
                    ));
                    $building_name = BaseBuilding::model()->find(array(
                        'select'=>array('name'),
                        'condition'=>"id = '$property->building_id'",
                    ));
                    $estate_name = BaseEstate::model()->find(array(
                        'select'=>array('name'),
                        'condition'=>"id = '$property->estate_id'",
                    ));
                    $allinfo[$key]['building_name'] = $building_name->name;
                    $allinfo[$key]['estate_name']   = $estate_name->name;
                    $allinfo[$key]['house_no']      = $property->house_no;
                    $allinfo[$key]['building_id']   = $property->building_id;
                    $allinfo[$key]['room_type']     = $property->room_type;
                    $allinfo[$key]['estate_id']     = $property->estate_id;
                    $sum_area                       = $sum_area+$property->area;
                    $area['sum_area']               = $sum_area;
                    $allinfo[$key]['property_id']   = $value->property_id;
            }
        }
        $photo = QualityDecorationPhoto::model()->findAll("decoration_id='$id' order by ctime");
        $list_photo=[];
        $budget_photo=[];
        $settlement_photo=[];
        $attachment_photo=[];
        $attachment=[];
        if($photo){
            foreach ($photo as $key => $value) {
                if($value->photo_type==1){//CAD图
                    $list_photo[]=$value->url;
                }
                if($value->photo_type==2){//预算扫描件
                    $budget_photo[]=$value->url;
                }
                if($value->photo_type==3){//结算扫描件
                    $settlement_photo[]=$value->url;
                }
                if($value->photo_type==4){//附件
                    $attachment_photo[]=$value->url;
                    $attachment[]=$value->attachment;
                }
            }
        }
        $this->render("edit",array(
            'model'=>$model,
            'referer'=>$referer,
            'allinfo'=>$allinfo,
            'sum_area'=>$area,
            'quality_budget'=>$quality_budget,
            'quality_settlement'=>$quality_settlement,
            'list_photo'=>$list_photo,
            'budget_photo'=>$budget_photo,
            'settlement_photo'=>$settlement_photo,
            'attachment_photo'=>$attachment_photo,
            'attachment'=>$attachment,
        ));
    }

    public function actionEditSave()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        // $property_id =Yii::app()->request->getParam("property_id");//所在车源id
        $supervisor =Yii::app()->request->getParam("supervisor");
        $foreman =Yii::app()->request->getParam("foreman");
        $docking_people =Yii::app()->request->getParam("docking_people");
        $project_start_time =Yii::app()->request->getParam("project_start_time");
        $project_end_time =Yii::app()->request->getParam("project_end_time");
        $docking_date =Yii::app()->request->getParam("docking_date");

        $attachment_photo =Yii::app()->request->getParam("attachment_photo");//上传附件
        $attachment_photo= explode(",",$attachment_photo);
        array_shift($attachment_photo);

        $attachment =Yii::app()->request->getParam("attachment_photo_show");//附件名
        if($attachment!=null){
            array_shift($attachment);
        }

        $list_photo =Yii::app()->request->getParam("list_photo");//上传CAD图片
        $list_photo = explode(",",$list_photo);
        array_shift($list_photo);

        $budget_photo =Yii::app()->request->getParam("budget_photo");//上传价格预算扫描件
        $budget_photo = explode(",",$budget_photo);
        array_shift($budget_photo);
        $list_material =Yii::app()->request->getParam("list_material");
        $unit =Yii::app()->request->getParam("unit");
        $material_brands =Yii::app()->request->getParam("material_brands");
        $number =Yii::app()->request->getParam("number");
        $unit_price =Yii::app()->request->getParam("unit_price");
        $total =Yii::app()->request->getParam("total");

        $settlement_photo =Yii::app()->request->getParam("settlement_photo");//上传价格结算扫描件
        $settlement_photo = explode(",",$settlement_photo);
        array_shift($settlement_photo);
        $set_list_material =Yii::app()->request->getParam("set_list_material");
        $set_unit =Yii::app()->request->getParam("set_unit");
        $set_material_brands =Yii::app()->request->getParam("set_material_brands");
        $set_number =Yii::app()->request->getParam("set_number");
        $set_unit_price =Yii::app()->request->getParam("set_unit_price");
        $set_total =Yii::app()->request->getParam("set_total");
        if($project_start_time){
            $project_start_time =strtotime($project_start_time);
        }
        if($project_end_time){
            $project_end_time =strtotime($project_end_time);
        }
        if($docking_date){
            $docking_date =strtotime($docking_date);
        }
        // if(count($property_id)==0){
        //     $this->OutputJson(0,"车源不存在",null);
        // }
        // $contract_id=[];
        // foreach($property_id as $value){
        //    $contract_id[]=Property::PurchaseContractAll($value)['id'];
        // }
        // if(count($property_id)>1){
        //     $contract=array_unique($contract_id);
        //     if(count($contract)!=1){
        //         $this->OutputJson(0,"这几个车源不在一个合同上",null);
        //     }else{
        //         $contract_id=$contract;
        //     }
        // }else if(count($property_id)==1){
        //     $contract_id=$contract_id;
        // }
       // $contract_id = implode("",$contract_id);
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $model = QualityDecoration::model()->find("id = '$id'");
            // $model->contract_id = $contract_id;
            $model->supervisor = $supervisor;
            $model->foreman = $foreman;
            $model->docking_people = $docking_people;
            $model->project_start_time = $project_start_time;
            $model->project_end_time = $project_end_time;
            $model->docking_date = $docking_date;
            if(Yii::app()->request->getParam("status")==2){
                $model->status = 1;
                $model->creater_id = Yii::app()->session['admin_uid'];
                $model->ctime = time();
                $model->deleted = 0;
            }
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            // QualityDecorationProperty::model()->deleteAll("decoration_id = '$id'");
            // if(!empty($property_id)){//装修管理表和车源关联表
            //     foreach($property_id as $k => $v){
            //         $data = new QualityDecorationProperty;
            //         $data->id = Guid::create_guid();
            //         $data->decoration_id = $id;
            //         $data->property_id = $v;
            //         $data->ctime = time();
            //         $data->deleted = 0;
            //         if(!$data->save()){
            //             $this->OutputJson(0,json_encode($data->errors,JSON_UNESCAPED_UNICODE),null);
            //         }
            //     }

            // }
            QualityDecorationPhoto::model()->deleteAll("decoration_id = '$id' and photo_type = 4");
            if($attachment){//上传附件
                foreach($attachment as $k => $v){
                    if($v){
                        $list_decoration_photo = new QualityDecorationPhoto;
                        $list_decoration_photo->id = Guid::create_guid();
                        $list_decoration_photo->decoration_id = $model->id;
                        $list_decoration_photo->photo_type = 4;
                        $list_decoration_photo->attachment = $v;
                        $list_decoration_photo->url = $attachment_photo[$k];
                        $list_decoration_photo->ctime = time()+$k;
                        $list_decoration_photo->deleted = 0;
                        if(!$list_decoration_photo->save()){
                            $this->OutputJson(0,json_encode($list_decoration_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            if(!empty($list_photo)){//上传CAD图片
                QualityDecorationPhoto::model()->deleteAll("decoration_id = '$id' and photo_type = 1");
                foreach($list_photo as $k => $v){
                    if($v){
                        $list_decoration_photo = new QualityDecorationPhoto;
                        $list_decoration_photo->id = Guid::create_guid();
                        $list_decoration_photo->decoration_id = $id;
                        $list_decoration_photo->photo_type = 1;
                        $list_decoration_photo->url = $v;
                        $list_decoration_photo->ctime = time()+$k;
                        $list_decoration_photo->deleted = 0;
                        if(!$list_decoration_photo->save()){
                            $this->OutputJson(0,json_encode($list_decoration_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            if($list_material){
                QualityBudgetSettlement::model()->deleteAll("decoration_id = '$id' and type=1");
                $show_order =1;
                foreach ($list_material as $k => $v) {//价格预算
                    $budget_settlement = new QualityBudgetSettlement;
                    $budget_settlement->id = Guid::create_guid();
                    $budget_settlement->decoration_id = $id;
                    $budget_settlement->type = 1;
                    $budget_settlement->list_material = $v;
                    $budget_settlement->unit = $unit[$k];
                    $budget_settlement->material_brands = $material_brands[$k];
                    $budget_settlement->number = $number[$k]*100;
                    $budget_settlement->unit_price = $unit_price[$k]*100;
                    $budget_settlement->total = $total[$k]*100;
                    $budget_settlement->show_order = $show_order;
                    $show_order++;
                    if (!$budget_settlement->save()){
                        if(Yii::app()->request->isAjaxRequest){
                            $this->OutputJson(0,json_encode($budget_settlement->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            if(!empty($budget_photo)){//上传价格预算扫描件
                QualityDecorationPhoto::model()->deleteAll("decoration_id = '$id' and photo_type = 2");
                foreach($budget_photo as $k => $v){
                    if($v){
                        $budget_decoration_photo = new QualityDecorationPhoto;
                        $budget_decoration_photo->id = Guid::create_guid();
                        $budget_decoration_photo->decoration_id = $id;
                        $budget_decoration_photo->photo_type = 2;
                        $budget_decoration_photo->url = $v;
                        $budget_decoration_photo->ctime = time()+$k;
                        $budget_decoration_photo->deleted = 0;
                        if(!$budget_decoration_photo->save()){
                            $this->OutputJson(0,json_encode($budget_decoration_photo->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }
            if($set_list_material){
                QualityBudgetSettlement::model()->deleteAll("decoration_id = '$id' and type=2");
                $the_order =1;
                foreach ($set_list_material as $k => $v) {//价格结算
                    $settlement = new QualityBudgetSettlement;
                    $settlement->id = Guid::create_guid();
                    $settlement->decoration_id = $id;
                    $settlement->type = 2;
                    $settlement->list_material = $v;
                    $settlement->unit = $set_unit[$k];
                    $settlement->material_brands = $set_material_brands[$k];
                    $settlement->number = $set_number[$k]*100;
                    $settlement->unit_price = $set_unit_price[$k]*100;
                    $settlement->total = $set_total[$k]*100;
                    $settlement->show_order = $the_order;
                    $the_order++;
                    if (!$settlement->save()){
                        if(Yii::app()->request->isAjaxRequest){
                            $this->OutputJson(0,json_encode($settlement->errors,JSON_UNESCAPED_UNICODE),null);
                        }
                    }
                }
            }

            if(!empty($settlement_photo)){//上传价格结算扫描件
                QualityDecorationPhoto::model()->deleteAll("decoration_id = '$id' and photo_type = 3");
                foreach($settlement_photo as $k => $v){
                    if($v){
                        $settlement_dphoto = new QualityDecorationPhoto;
                        $settlement_dphoto->id = Guid::create_guid();
                        $settlement_dphoto->decoration_id = $id;
                        $settlement_dphoto->photo_type = 3;
                        $settlement_dphoto->url = $v;
                        $settlement_dphoto->ctime = time()+$k;
                        $settlement_dphoto->deleted = 0;
                        if(!$settlement_dphoto->save()){
                            $this->OutputJson(0,json_encode($settlement_dphoto->errors,JSON_UNESCAPED_UNICODE),null);
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
        $this->OutputJson(301,'',"/admin/decoration");

    }
    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//获取修改的合同id
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            QualityDecoration::model()->updateAll(array('deleted'=>'1'),'id=:pid',array(':pid'=>$id));//删除装修管理主表
            QualityDecorationProperty::model()->updateAll(array('deleted'=>'1'),'decoration_id=:pass',array(':pass'=>$id));//删除装修管理主表和车源表
            QualityBudgetSettlement::model()->updateAll(array('deleted'=>'1'),'decoration_id=:pass',array(':pass'=>$id));//删除预算结算表
            QualityDecorationPhoto::model()->updateAll(array('deleted'=>'1'),'decoration_id=:pass',array(':pass'=>$id));//删除图片表
            QualityFine::model()->updateAll(array('deleted'=>'1'),'decoration_id=:pass',array(':pass'=>$id));//删除罚款单表
            UrsDecorationFollow::model()->updateAll(array('deleted'=>'1'),'decoration_id=:pass',array(':pass'=>$id));//删除跟进表数据
            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,"删除失败",null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }
         $this->redirect("/admin/decoration");
    }

    public function actionDetail()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $id = Yii::app()->request->getParam("id");
        $model = QualityDecoration::model()->find(" t.id='$id'");
        $quality_budget = QualityBudgetSettlement::model()->findAll("decoration_id='$id' and type=1 order by show_order");//预算
        $quality_settlement = QualityBudgetSettlement::model()->findAll("decoration_id='$id' and type=2 order by show_order");//结算
        $quality_follow = UrsDecorationFollow::model()->find("decoration_id='$id' order by ctime desc");//实际工程起止日
        if($id){
            $data = QualityDecorationProperty::model()->findAll(array(
                'select'=>array('property_id'),
                'condition'=>"decoration_id = '$id'",
            ));
            $allinfo = [];//车源全部信息
            $area = [];
            $sum_area=0;
            foreach ($data as $key => $value) {
                    $property = CmsProperty::model()->find(array(
                        'select'=>array('estate_id,building_id,house_no,area'),
                        'condition'=>"id = '$value->property_id' and deleted=0",
                    ));
                    $building_name = BaseBuilding::model()->find(array(
                        'select'=>array('name'),
                        'condition'=>"id = '$property->building_id'",
                    ));
                    $estate_name = BaseEstate::model()->find(array(
                        'select'=>array('name'),
                        'condition'=>"id = '$property->estate_id'",
                    ));
                    $allinfo[$key]['building_name'] = $building_name->name;
                    $allinfo[$key]['estate_name']   = $estate_name->name;
                    $allinfo[$key]['house_no']      = $property->house_no;
                    $allinfo[$key]['building_id']   = $property->building_id;
                    $allinfo[$key]['room_type']     = $property->room_type;
                    $allinfo[$key]['estate_id']     = $property->estate_id;
                    $sum_area                       = $sum_area+$property->area;
                    $area['sum_area']               = $sum_area;
                    $allinfo[$key]['property_id']   = $value->property_id;
            }
        }
        $photo = QualityDecorationPhoto::model()->findAll("decoration_id='$id' order by ctime");
        $list_photo=[];
        $budget_photo=[];
        $settlement_photo=[];
        $attachment_photo=[];
        $attachment=[];
        if($photo){
            foreach ($photo as $key => $value) {
                if($value->photo_type==1){//CAD图
                    $list_photo[]=$value->url;
                }
                if($value->photo_type==2){//预算扫描件
                    $budget_photo[]=$value->url;
                }
                if($value->photo_type==3){//结算扫描件
                    $settlement_photo[]=$value->url;
                }
                if($value->photo_type==4){//附件
                    $attachment_photo[]=$value->url;
                    $attachment[]=$value->attachment;
                }
            }
        }
        $this->render("detail",array(
            'model'=>$model,
            'referer'=>$referer,
            'allinfo'=>$allinfo,
            'sum_area'=>$area,
            'quality_budget'=>$quality_budget,
            'quality_settlement'=>$quality_settlement,
            'list_photo'=>$list_photo,
            'budget_photo'=>$budget_photo,
            'settlement_photo'=>$settlement_photo,
            'attachment_photo'=>$attachment_photo,
            'attachment'=>$attachment,
            'quality_follow'=>$quality_follow,
        ));
    }

    public function actionDownLoad()//下载图片
    {
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
        download($filename, '图片');
    }
    public function actionDownLoadAttachment()//下载附件
    {
        $filename = Yii::app()->request->getParam('url');
        $attachment = Yii::app()->request->getParam('attachment');
        if($filename != null){
            $filename = Yii::app()->basePath.'/../'.$filename;
        }
        header("Content-type:text/html;charset=utf-8");

        function download($file, $down_name){
         $suffix = substr($file,strrpos($file,'.')); //获取文件后缀
         // $down_name = $down_name.$suffix; //新文件名，就是下载后的名字
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
        download($filename,$attachment);
    }
    public function actionTicket()//写罚款单
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $this->render("ticket",array(
            'referer'=>$referer,
            'decoration_id'=>$id,
        ));
    }
    public function actionTicketSave()//写罚款单的操作
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $decoration_id =Yii::app()->request->getParam("decoration_id");//所在装修列表id
        $fine_items = Yii::app()->request->getParam("fine_items");
        $fine_date = Yii::app()->request->getParam("fine_date");
        $fine_amount = Yii::app()->request->getParam("fine_amount");
        $fine_reason = Yii::app()->request->getParam("fine_reason");
        $fine_settlement = Yii::app()->request->getParam("fine_settlement");
        $punish_people = Yii::app()->request->getParam("punish_people");
        $punished_people = Yii::app()->request->getParam("punished_people");
        if ($fine_date) {
            $fine_date=strtotime($fine_date);
        }
        /*数据库操作*/
        $transaction = Yii::app()->db->beginTransaction(); //开启事务
        try {
            $model = new QualityFine;
            $model->id = Guid::create_guid();
            $model->decoration_id = $decoration_id;
            $model->fine_items = $fine_items;
            $model->fine_date = $fine_date;
            $model->fine_amount = $fine_amount*100;
            $model->fine_reason = $fine_reason;
            $model->fine_settlement = $fine_settlement;
            $model->punish_people = $punish_people;
            $model->punished_people = $punished_people;
            $model->creater_id = Yii::app()->session['admin_uid'];
            $model->ctime = time();
            $model->deleted = 0;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }
            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,json_encode($e,JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/decoration");
        }
        else{
            $this->redirect("/admin/decoration");
        }
    }

    public function actionTicketList()//罚款单列表
    {
        $decoration_id =Yii::app()->request->getParam("id");
        $pagesize=10;
        $criteria=new CDbCriteria;
        $criteria->addCondition("decoration_id='$decoration_id'");
        $criteria->order="t.ctime desc";
        $count=QualityFine::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list = QualityFine::model()->findAll($criteria);
        $this->render("ticketlist",array(
            'list'=>$list,
            'pages'=>$pager,
        ));
    }

    public function actionTicketDetail()//罚款单详情
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model = QualityFine::model()->find(" t.id='$id'");
        $this->render("ticketdetail",array(
            'model'=>$model,
        ));
    }

    public function actionDecorationFollowAdd()//写装修跟进
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $ursarr=UrsPropertyDetail::model()->arr();
        $this->render("adddecorationfollow",array(
            'referer'=>$referer,
            'ursarr'=>$ursarr,
            'decoration_id'=>$id,
        ));
    }

    public function actionDecorationFollowAddSave()//添加装修跟进
    {
        $decoration_id = Yii::app()->request->getParam('decoration_id');
        $decoration_status = Yii::app()->request->getParam('decoration_status');
        $responsible_people=Yii::app()->request->getParam("responsible_people");
        $decoration_team=Yii::app()->request->getParam("decoration_team");
        $phone=Yii::app()->request->getParam("phone");
        $money=Yii::app()->request->getParam("money");
        $decoration_details=Yii::app()->request->getParam("decoration_details");

        $actual_start_time =Yii::app()->request->getParam("actual_start_time");//完工信息
        $actual_end_time =Yii::app()->request->getParam("actual_end_time");
        if($actual_start_time){
            $actual_start_time =strtotime($actual_start_time);
        }
        if($actual_end_time){
            $actual_end_time =strtotime($actual_end_time);
        }
        $actual_expected=Yii::app()->request->getParam("actual_expected");
        $reason=Yii::app()->request->getParam("reason");
        $total_settlement_days=Yii::app()->request->getParam("total_settlement_days");
        $settlement=Yii::app()->request->getParam("settlement");
        $construction_quality=Yii::app()->request->getParam("construction_quality");
        $feedback_remarks=Yii::app()->request->getParam("feedback_remarks");
        $creater_id=Yii::app()->session['admin_uid'];
        $data = QualityDecorationProperty::model()->findAll("decoration_id='$decoration_id'");
        foreach($data as $value){
            $decorationfollow = new UrsDecorationFollow();
            $decorationfollow->id = Guid::create_guid();
            $decorationfollow->decoration_id = $decoration_id;
            $decorationfollow->property_id = $value->property_id;
            $decorationfollow->decoration_status = $decoration_status;
            $decorationfollow->responsible_people = $responsible_people;
            $decorationfollow->decoration_team = $decoration_team;
            $decorationfollow->phone = $phone;
            $decorationfollow->money = $money*100;
            $decorationfollow->decoration_details = $decoration_details;
            $decorationfollow->creater_id = $creater_id;
            $decorationfollow->ctime = time();
            $decorationfollow->deleted = 0;
            $decorationfollow->actual_start_time = $actual_start_time;
            $decorationfollow->actual_end_time = $actual_end_time;
            $decorationfollow->actual_expected = $actual_expected*100;
            $decorationfollow->reason = $reason;
            $decorationfollow->total_settlement_days = $total_settlement_days*100;
            $decorationfollow->settlement = $settlement;
            $decorationfollow->construction_quality = $construction_quality;
            $decorationfollow->feedback_remarks = $feedback_remarks;
            if (!$decorationfollow->save()){
                $this->result(0,$decorationfollow->errors,null);
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/decoration");
        }
        else{
            $this->redirect("/admin/decoration");
        }
    }

    public function actionDecorationFollow()//查看装修跟进
    {
        $keyword_decoration_status=Yii::app()->request->getParam("keyword_decoration_status");
        $keyword_start_time=Yii::app()->request->getParam("keyword_start_time");
        $keyword_end_time=Yii::app()->request->getParam("keyword_end_time");
        $decoration_id =Yii::app()->request->getParam("id");
        $pagesize=10;
        $property_id = QualityDecorationProperty::model()->find("decoration_id='$decoration_id'")['property_id'];
        $condition="1=1 and t.deleted=0 ";
         $condition.=" and  ( 1=1  ";
            if($property_id){
                $condition.= " and property_id='$property_id'";
            }
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
            'keyword_decoration_id'=>$decoration_id,
        ));
    }

    public function actionDecorationDetail()//装修跟进详情
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

    public function actionDecorationDelete()//删除装修跟进
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
}
