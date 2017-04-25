<?php

class UrsgoodsController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

	public $title='礼品管理';

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $keyword_contract_id =Yii::app()->request->getParam("keyword_contract_id");
        $keyword_admin_uname =Yii::app()->request->getParam("keyword_admin_uname");
        $keyword_status =Yii::app()->request->getParam("keyword_status");
        $keyword_signing_date1 =Yii::app()->request->getParam("keyword_signing_date1");
        $keyword_signing_date2 =Yii::app()->request->getParam("keyword_signing_date2");
        $pagesize=10;
        $condition = "1=1 and t.deleted=0";
        //合同id
        if($keyword_contract_id){
            $condition .= " and contract_id = '$keyword_contract_id' ";
        }
        //申请人
        if($keyword_admin_uname){
            $condition .= " and admin_uname = '$keyword_admin_uname' ";
        }
        //礼品状态
        if($keyword_status){
                $condition .= " and status = '$keyword_status' ";
        }
        // var_dump($condition);die;
        //开始时间
        if($keyword_signing_date1){
            $keyword_signing_start = strtotime($keyword_signing_date1);
            $condition .= " and ctime >= '$keyword_signing_start' ";
        }
        //结束时间
        if($keyword_signing_date2){
            $keyword_signing_end = strtotime($keyword_signing_date2);
            $condition .= " and ctime <= '$keyword_signing_end' ";
        }
        $criteria=new CDbCriteria;
        $criteria->condition= $condition;
        $criteria->order='t.ctime DESC';
        $count = Ursgoods::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list =UrsGoods::model()->findAll($criteria);
        //获取车源
        $arr = [];
        foreach ($list as $k=>$v) {
            $purchaseproperty = CmsPurchaseProperty::model()->findAll("contract_id ='{$v['contract_id']}' and deleted = 0");
            //获取编号
            $house_no = '';
            foreach ($purchaseproperty as $k => $p) {
                if($k == 0){
                    $house_no .= CmsProperty::model()->find("id = '{$p['property_id']}' and deleted = 0")['house_no'];
                }else{
                    $house_no .= '<br>'.CmsProperty::model()->find("id = '{$p['property_id']}' and deleted = 0")['house_no'];
                }
            }
            $information = CmsProperty::model()->find("id = '{$purchaseproperty[0]['property_id']}' and deleted = 0");
            //品牌
            $estate_id = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
            //系列
            $building_id = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];
            //部门
            $department = AdminDepartment::model()->find("id = '{$v['department']}' and deleted = 0")['name'];
            //小组
            $department_group = AdminDepartment::model()->find("id = '{$v['department_group']}' and deleted = 0")['name'];
            //负责人
            $department_principal = AdminUser::model()->find("id = '{$v['department_principal']}' and deleted = 0")['nickname'];
            //渠道公司
            $channel_id = CmsChannel::model()->find("id = '{$v['channel_id']}' and deleted = 0")['name'];
            //渠道人员
            $channel_manager_id = CmsChannelManager::model()->find("id = '{$v['channel_manager_id']}' and deleted = 0")['name'];
            //获取申请的礼品及数量
            $goodsmodel = UrsGoodsIndex::model()->findAll("ys_goods_id = '{$v['id']}' and deleted = 0");
            $names = '';
            $num_unit = '';
            foreach ($goodsmodel as $k => $vv) {
                $name = UrsGoodsStorage::model()->find("id = '{$vv['ys_goods_storage_id']}'")['goods_name'];
                $names .= $name.'<br>';
                $num_unit .= $vv['number'].'/'.$vv['unit'].'<br>';
            }
            $arrs = $v->attributes;
            $arrs['names'] = $names;
            $arrs['num_unit'] = $num_unit;
            $arrs['estate_id'] = $estate_id;
            $arrs['building_id'] = $building_id;
            $arrs['house_no'] = $house_no;
            $arrs['department'] = $department;
            $arrs['department_group'] = $department_group;
            $arrs['department_principal'] = $department_principal;
            $arrs['channel_id'] = $channel_id;
            $arrs['channel_manager_id'] = $channel_manager_id;
            $arr[] =$arrs;
        } 
        $goods = UrsGoodsStorage::model()->findAll("deleted = 0");
        $goods_id = [];
        $goods_name = [];
        foreach ($goods as $k => $v) {
            $goods_id[] = $v['id'];
            $goods_name[] = $v['goods_name'];
        }
        // var_dump($arr);die;
        $this->render("index",array(
            'list'=>$arr,
            'pages'=>$pager,
            'goods_id'=>$goods_id,
            'goods_name'=>$goods_name,
            'keyword_contract_id'=>$keyword_contract_id,
            'keyword_admin_uname'=>$keyword_admin_uname,
            'keyword_status'=>$keyword_status,
            'keyword_signing_date1'=>$keyword_signing_date1,
            'keyword_signing_date2'=>$keyword_signing_date2
        ));
    }
    /**
     * 详情
     */
    public function actionDetail()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =UrsGoods::model()->find(" t.id='$id' and deleted = 0");
        if(!$model){
            $this->render($referer);
        }
        $list = [];
        $list['check_two'] = AdminUser::model()->find("id = '{$model['check_two']}' and deleted = 0")['nickname'];//二审人员
        $list['check_finance'] = AdminUser::model()->find("id = '{$model['check_finance']}' and deleted = 0")['nickname'];//财务审核人员
        $list['cheques_user'] = AdminUser::model()->find("id = '{$model['cheques_user']}' and deleted = 0")['nickname'];//收款人
        $list['information_user'] = AdminUser::model()->find("id = '{$model['information_user']}' and deleted = 0")['nickname'];//填写购买信息的人
        $list['harvest_user'] = $model['harvest_user'];//收件人
        $contract_id = $model['contract_id'];
        $house = CmsPurchaseProperty::model()->find("contract_id ='$contract_id' and deleted = 0");
        //车源id
        $list['$property_id'] = $house['property_id'];
        $information = CmsProperty::model()->findAll("id = '{$house['property_id']}' and deleted = 0")[0];
        //品牌
        $list['estate_id'] = BaseEstate::model()->findAll("id = '{$information['estate_id']}' and deleted = 0")[0]['name'];
        //系列
        $list['building_id'] = BaseBuilding::model()->findAll("id = '{$information['building_id']}' and deleted = 0")[0]['name'];
        //编号
        $list['house_no'] = $information['house_no'];
        $list['status'] = $model['status'];
        //部门
        $list['department'] = AdminDepartment::model()->find("id = '{$model['department']}' and deleted = 0")['name'];
        //小组
        $list['department_group'] =AdminDepartment::model()->find("id = '{$model['department_group']}' and deleted = 0")['name'];
        //负责人
        $list['department_principal'] = AdminUser::model()->find("id = '{$model['department_principal']}' and deleted = 0")['nickname'];
        //渠道公司
        $channel = CmsChannel::model()->find("id= '{$model['channel_id']}'")['name'];
        $list['channel_id'] = $channel;
        //渠道人员
        $manager = CmsChannelManager::model()->find("id= '{$model['channel_manager_id']}'")['name'];
        $list['channel_manager_id'] = $manager;
        //获取已经申请的礼品
        $goods = UrsGoodsIndex::model()->findAll("ys_goods_id = '$id' and deleted = 0");
        foreach ($goods as $k => $v) {
            $v['ys_goods_storage_id'] = UrsGoodsStorage::model()->find("id= '{$v['ys_goods_storage_id']}' and deleted = 0")['goods_name'];
        }
        $this->render('detail',array(
            'model'=> $model,
            'list'=> $list,
            'goods'=> $goods,
            'referer'=> $referer,
            ));

    }
    /**
     * 申请礼品
     */
    public function actionAdd()
    {
        $goods = UrsGoodsStorage::model()->findAll();
        $admin_uid = ($_SESSION['admin_uid']);
        //获取分组
        $department_group = AdminUser::model()->find("id = '$admin_uid' and deleted = 0")['department_id'];
        //获取经理名称
        $department_principal = AdminUser::model()->find("department_id = '$department_group' and position_id = 2 and deleted = 0")['nickname'];
        //获取部门
        $department = AdminDepartment::model()->find("id = '$department_group' and deleted = 0")['parent_id'];
        //获取部门的名称 分组名称
        $department = AdminDepartment::model()->find("id = '$department' and deleted = 0")['name'];
        $department_group = AdminDepartment::model()->find("id = '$department_group'")['name'];
        $this->render("add",array(
            'goods' =>$goods,
            'department' =>$department,
            'department_group' =>$department_group,
            'department_principal' =>$department_principal
            ));
    }  
    /**
     * 申请礼品 添加
     */
    public function actionAddSave()
    {
        //接受参数
        $referer= $_SERVER['HTTP_REFERER'];
        $admin_uname =Yii::app()->request->getParam("admin_uname");//申请人昵称
        $admin_uid =Yii::app()->request->getParam("admin_uid");//申请人id
        $room_number =Yii::app()->request->getParam("room_number")[0];//所在车源id
        $ys_goods_storage_id =Yii::app()->request->getParam("ys_goods_storage_id");//申请的商品
        $remark =Yii::app()->request->getParam("remark");//备注
        $number =Yii::app()->request->getParam("number");//数量
        //判断礼品申请是否有相同的
        $arr1=$ys_goods_storage_id;
        $num1 = count($arr1);
        $arr2 = array_unique($arr1);
        $num2 = count($arr2);
        if($num2 != $num1){
            $this->OutputJson(0,"不要选择相同的礼品",null);
        }
        if(in_array("",$number)){
            $this->OutputJson(0,"请选择数量",null);
        }
        //获取分组id
        $department_group = AdminUser::model()->find("id = '$admin_uid' and deleted = 0")['department_id'];
        //获取经理id
        $department_principal = AdminUser::model()->find("department_id = '$department_group' and position_id = 2 and deleted = 0")['id'];
        //获取部门id
        $department = AdminDepartment::model()->find("id = '$department_group' and deleted = 0")['parent_id'];

        //合同id
        $Property = new Property();
        $contract = $Property::SaleContract($room_number);
        if (empty($contract)){
            $this->OutputJson(0,"合同输入有误",null);
        }
        // 判断是够已经申请了礼品
        if (UrsGoods::model()->findAll("contract_id = '{$contract['id']}' and deleted = 0 ")){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,"该合同已经申请了礼品",null);
            }
        }
        //添加数据
        $model = new UrsGoods();

        $guanlian_id=Guid::create_guid();
        $model->id=$guanlian_id;
        $model->admin_uname = $admin_uname;
        $model->admin_uid = $admin_uid;
        $model->department = $department;
        $model->department_group = $department_group;
        $model->department_principal = $department_principal;
        $model->channel_id = $contract['channel_id'];
        $model->contract_id = $contract['id'];
        $model->channel_manager_id = $contract['channel_manager_id'];
        $model->remark = $remark;
        $model->ctime = time();//申请时间
        $model->status = 1;//状态
        $model->deleted = 0;//申请状态是否删除
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
            // 添加关联表数据
            foreach ($ys_goods_storage_id as $k => $v) {
                $models = new UrsGoodsIndex;
                $models->id= Guid::create_guid();
                $models->ys_goods_id= $guanlian_id;
                $models->ys_goods_storage_id= $v;
                $models->number= $number[$k];
                $unit = UrsGoodsStorage::model()->find("id='$v'")['goods_unit'];
                $models->unit= $unit;
                $models->creat_user= $admin_uid;
                $models->deleted= 0;
                $models->ctime = time();
                if (!$models->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(0,$models->errors,null);
                    }
                }
            }
             $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,"添加失败",null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",'index');
        }else{

            $this->redirect('add');
        }
    }
    /**
     * 删除
     */
    public function actionDeleted()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =UrsGoods::model()->find(" t.id='$id' and deleted = 0");
        $models =UrsGoodsIndex::model()->findAll("ys_goods_id='$id' and deleted = 0");
        $model->deleted = 1;
        if($model->save()){
            foreach ($models as $k => $v) {
                $v->deleted = 1;
                if(!$v->save()){
                    $this->OutputJson(0,$v->errors,null);
                }
            }
            echo 1;
        }
        
    }
    /**
     * 修改
     */
    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $model =Ursgoods::model()->find(" t.id='$id' and deleted = 0");
        if(!$model){
            $this->render($referer);
        }
        $list = [];
        $contract_id = $model['contract_id'];
        $list['remark'] = $model['remark'];
        $house = CmsPurchaseProperty::model()->find("contract_id ='$contract_id' and deleted = 0");
        //车源id
        $list['$property_id'] = $house['property_id'];
        $information = CmsProperty::model()->findAll("id = '{$house['property_id']}' and deleted = 0")[0];
        //品牌
        $list['estate_id'] = BaseEstate::model()->findAll("id = '{$information['estate_id']}' and deleted = 0")[0]['name'];
        //系列
        $list['building_id'] = BaseBuilding::model()->findAll("id = '{$information['building_id']}' and deleted = 0")[0]['name'];
        //编号
        $list['room_number'] = $information['house_no'];
        //部门
        $list['department'] = AdminDepartment::model()->find("id = '{$model['department']}' and deleted = 0")['name'];
        //小组
        $list['department_group'] =AdminDepartment::model()->find("id = '{$model['department_group']}' and deleted = 0")['name'];
        //负责人
        $list['department_principal'] = AdminUser::model()->find("id = '{$model['department_principal']}' and deleted = 0")['nickname'];
        //渠道公司
        $channel = CmsChannel::model()->find("id= '{$model['channel_id']}'")['name'];
        $list['channel_id'] = $channel;
        //渠道人员
        $manager = CmsChannelManager::model()->find("id= '{$model['channel_manager_id']}'")['name'];
        $list['channel_manager_id'] = $manager;
        //获取已经申请的礼品
        $goods = UrsGoodsIndex::model()->findAll("ys_goods_id = '$id' and deleted = 0");
        //获取全部礼品
        // var_dump($list);die;
        $_goods = UrsGoodsStorage::model()->findAll();
        $this->render('edit',array(
            'model'=> $model,
            'list'=> $list,
            'goods'=> $goods,
            '_goods'=> $_goods,
            'referer'=> $referer
            ));
        
    }
    /**
     * 执行修改
     */
    public function actionEditSave()
    {
        // var_dump($_POST);DIE;
        $referer= $_SERVER['HTTP_REFERER'];
        $admin_uname =Yii::app()->request->getParam("admin_uname");//申请人账号
        $admin_uid =Yii::app()->request->getParam("admin_uid");//申请人id
        $id =Yii::app()->request->getParam("id");//申请的礼品表id
        //获取分组
        $department_group = AdminUser::model()->find("id = '$admin_uid' and deleted = 0")['department_id'];
        //获取经理
        $department_principal = AdminUser::model()->find("department_id = '$department_group' and position_id = 2 and deleted = 0")['id'];
        //获取部门
        $department = AdminDepartment::model()->find("id = '$department_group' and deleted = 0")['parent_id'];
        $room_number =Yii::app()->request->getParam("room_number")[0];//所在车源id
        $ys_goods_storage_id =Yii::app()->request->getParam("ys_goods_storage_id");//申请的商品
        $remark =Yii::app()->request->getParam("remark");//备注
        $number =Yii::app()->request->getParam("number");//数量
        //判断是够选择数量
        $arr1=$ys_goods_storage_id;
        $num1 = count($arr1);
        $arr2 = array_unique($arr1);
        $num2 = count($arr2);
        if($num2 != $num1){
             $this->redirect($referer);
        }
        //合同id
        $Property = new Property();
        $contract = $Property::SaleContract($room_number);
        if (empty($contract)){
            $this->redirect($referer);
        }
        // 判断是够已经申请了礼品
        if (UrsGoods::model()->findAll("contract_id = '{$contract['id']}' and deleted = 0 ")){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,"该合同已经申请了礼品",null);
            }
        }
        $transaction1 = Yii::app()->db->beginTransaction(); //开启事务
        try {
            //添加数据
            $model = UrsGoods::model()->find("id='$id' and deleted = 0 ");
            $model->admin_uname = $admin_uname;
            $model->admin_uid = $admin_uid;
            $model->department = $department;
            $model->department_group = $department_group;
            $model->department_principal = $department_principal;
            $model->channel_id = $contract['channel_id'];
            $model->contract_id = $contract['id'];
            $model->channel_manager_id = $contract['channel_manager_id'];
            $model->remark = $remark;
            $model->ctime = time();//申请时间
            $model->status = 1;//状态
            $model->deleted = 0;//申请状态是否删除
            // 删除原来的数据
            $modeldel = UrsGoodsIndex::model()->findAll("deleted = 0 and ys_goods_id='$id' ");
            foreach ($modeldel as $v) {
                $v->deleted = 1;
                $v->save();
            }
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
            // 添加关联表数据
            // var_dump($number);die;
            foreach ($ys_goods_storage_id as $k => $v) {
                $models = new UrsGoodsIndex();
                $models->id= Guid::create_guid();
                $models->ys_goods_id= $id;
                $models->ys_goods_storage_id= $v;
                $models->number= $number[$k];
                $unit = UrsGoodsStorage::model()->find("id='$v'")['goods_unit'];
                $models->unit= $unit;
                $models->creat_user= $admin_uid;
                $models->deleted= 0;
                $models->ctime = time();
                if (!$models->save()){
                    if(Yii::app()->request->isAjaxRequest){ 
                        $this->OutputJson(0,$models->errors,null);
                    }
                }
            }
            $transaction1->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $this->OutputJson(0,"添加失败",null);
            $transaction1->rollback(); //如果操作失败, 数据回滚
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",'index');
        }else{

            $this->redirect('index');
        }
        
    }
    /**
     * 审核礼品是否通过
     */
    public function actionExamine()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $list =UrsGoods::model()->find("id = '$id'");
        $arrs = $list->attributes;
        $house = CmsPurchaseProperty::model()->findAll("contract_id ='{$list['contract_id']}' and deleted = 0");
        $information = CmsProperty::model()->find("id = '{$house[0]['property_id']}' and deleted = 0");
        $house_no =[];
        foreach ($house as $k => $v) {
            $house_no[] = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0")['house_no'];
        }
        //二审人员
        if(!empty($list['check_two'])){
            $check_two = AdminUser::model()->find("id = '{$list['check_two']}' and deleted = 0")['nickname'];
            $arrs['check_two'] = $check_two;
        }
        //品牌
        $estate_id = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
        //系列
        $building_id = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];
        //部门
        $department = AdminDepartment::model()->find("id = '{$list['department']}' and deleted = 0")['name'];
        //小组
        $department_group = AdminDepartment::model()->find("id = '{$list['department_group']}' and deleted = 0")['name'];
        //负责人
        $department_principal = AdminUser::model()->find("id = '{$list['department_principal']}' and deleted = 0")['nickname'];
        //渠道公司
        $channel_id = CmsChannel::model()->find("id = '{$list['channel_id']}' and deleted = 0")['name'];
        //渠道人员
        $channel_manager_id = CmsChannelManager::model()->find("id = '{$list['channel_manager_id']}' and deleted = 0")['name'];
        $arrs['estate_id'] = $estate_id;
        $arrs['building_id'] = $building_id;
        $arrs['house_no'] = $house_no;
        $arrs['department'] = $department;
        $arrs['department_group'] = $department_group;
        $arrs['department_principal'] = $department_principal;
        $arrs['channel_id'] = $channel_id;
        $arrs['channel_manager_id'] = $channel_manager_id;
        $goods = UrsGoodsIndex::model()->findAll("deleted = 0 and ys_goods_id = '$id'");
        $_goods = [];
        foreach ($goods as $k => $v) {
            $name = UrsGoodsStorage::model()->find("deleted = 0 and id = '{$v['ys_goods_storage_id']}'")['goods_name'];
            $_goods[]=$name.'/'.$v['number'].'/'.$v['unit'];
        }
        $this->render("examine",array(
            'list'=>$arrs,
            '_goods'=>$_goods,
        ));
    }
    /**
     * 审核礼品是否通过处理 一审 二审 财务
     */
    public function actionExamineSave()
    {   
        $referer= $_SERVER['HTTP_REFERER'];
        $admin_uid = ($_SESSION['admin_uid']);
        $status = Yii::app()->request->getParam('status');
        $reason = Yii::app()->request->getParam('reason');
        $id = Yii::app()->request->getParam('id');
        $model = UrsGoods::model()->find("id='$id'");
        if(!$model){
            $this->render($referer);
        }
        //一审
        if($status == 2 | $status == 3 ){
            $model->check_one_time = time();
            if($status == 3){
                $model->check_one_reason = $reason;
            }
        }
        //二审人员
        if($status == 4 | $status == 5 ){
            $model->check_two = $admin_uid;
            $model->check_two_time = time();
            if($status == 5){
                $model->check_two_reason = $reason;
            }
        }
        //财务审核人员
        if($status == "no" | $status == 7 ){
            $model->check_finance = $admin_uid;
            $model->check_finance_time = time();
            if($status == "no"){
                $model->check_finance_reason = $reason;
            }
            /**
             * 这里缺少财务信息
             */
        }
        $model->status = $status;
        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$model->errors,null);
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",$referer);
        }else{
            $this->redirect('index');
        }
    }
    /**
     * 二审提交支单
     */
    public function actionTotals()
    {
        $referer =$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $totals =Yii::app()->request->getParam("totals");
        if(empty($totals)){
            $this->redirect($referer);
        }
        $model = UrsGoods::model()->find("id = '$id'");
        if($model){
            $model->totals = $totals*100;
            $model->status = 6;
            if($model->save()){
                if (!$model->save()){
                    if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(0,$model->errors,null);
                    }
                }
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(301,"",$referer);
                }else{
                    $this->redirect($referer);
                }
            }
        }
        $this->render($referer);
    }
    /**
     * 确认收款
     */
    public function actionCheques()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        // var_dump($referer);die;
        $admin_uid = ($_SESSION['admin_uid']);
        $id = Yii::app()->request->getParam('id');
        $model = UrsGoods::model()->find("id='$id'");
        if(empty($model)){
            $this->render($referer);
        }
        //收款人员
        $model->cheques_user = $admin_uid;
        $model->cheques_user_time = time();
        $model->status = 8;
        if(!$model->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$model->errors,null);
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"发生错误",$referer);
        }else{
            $this->redirect($referer);
        }
    }
    /**
     * 添加购买信息
     */
    public function actionInformation()
    {
        $id = Yii::app()->request->getParam('id');
        $model = UrsGoods::model()->find("id = '$id'and deleted = 0 ");
        $this->render('information',array(
            'id' => $id,
            'totals' => $model['totals']/100
            ));
    }
    /**
     * 添加购买信息
     */
    public function actionInformationSave()
    {
        $referer =$_SERVER['HTTP_REFERER'];
        $id = Yii::app()->request->getParam('id');
        $information_user = Yii::app()->request->getParam('information_user');//添加礼品信息的人
        $buy_user = Yii::app()->request->getParam('buy_user');//购买东西的人
        $buy_way = Yii::app()->request->getParam('buy_way');//购买方式1为线上 2位线下
        $buy_money = Yii::app()->request->getParam('buy_money');//实际购买的金钱
        $back_money = Yii::app()->request->getParam('back');//申请返给财务的钱
        $buy_fapiao = Yii::app()->request->getParam('buy_fapiao');//发票
        $subsidy_money = Yii::app()->request->getParam('subsidy');//申请补贴的钱
        $model = UrsGoods::model()->find("id = '$id' and deleted = 0 ");
        if($model){
            $model->buy_invoice = $buy_fapiao;
            $model->information_user = $information_user;
            $model->information_time = time();
            $model->buy_user = $buy_user;
            $model->buy_way = $buy_way;
            $model->buy_money = $buy_money*100;
            $model->back_money = $back_money*100;
            $model->subsidy_money = $subsidy_money*100;
            $model->status = 9;
        }
        if($model->save()){
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(301,"",$referer);
            }else{
                $this->redirect('index');
            }
        }
    }
    /**
     * 确认发放
     */
    public function actionHarvest()
    {
        $id = Yii::app()->request->getParam('id');
        $this->render('Harvest',array(
           'id' => $id,
           ));
    }
    /**
     * 确认发放信息添加
     */
    public function actionHarvestSave()
    {
        $id = Yii::app()->request->getParam('id');
        $harvest_user = Yii::app()->request->getParam('harvest_user');//发放东西的人
        $types = Yii::app()->request->getParam('way');
        $_name = Yii::app()->request->getParam('_name');
        $_phone = Yii::app()->request->getParam('_phone');
        $_card = Yii::app()->request->getParam('_card');
        $model = UrsGoods::model()->find("id = '$id' and deleted = 0 ");
        if($model){
            $model->harvest_user = $harvest_user;
            $model->types = $types;
            if($types==3){
                //代取人姓名
                $_name = Yii::app()->request->getParam('_name');
                //代取人电话
                $_phone = Yii::app()->request->getParam('_phone');
                //代取人身份证号
                $_card = Yii::app()->request->getParam('_card');
                //姓名电话身份证合并
                $remark = $_name.'/'.$_phone.'/'.$_card;
                $model->remark = $remark;
            }
            $model->status = 'aa';
            $model->harvest_time = time();
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$models->errors,null);
                }
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",'index');
        }else{
            $this->redirect('index');
        }
    }
    /**
     * 支出单
     */
    public function actionTotalss()
    {
        $referer =$_SERVER['HTTP_REFERER'];
        $id = Yii::app()->request->getParam('id');
        $model =UrsGoods::model()->find(" t.id='$id' and deleted = 0");
        if(!$model){
            $this->render($referer);
        }

        $list = [];
        $list['room_number'] = '';
        $contract_id = $model['contract_id'];
        $house = CmsPurchaseProperty::model()->findAll("contract_id ='$contract_id' and deleted = 0");
        //车源id
        foreach ($house as $k => $v) {
             $information = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0");
             //编号
             $list['room_number'] .= $information['house_no'].'&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        $list['$property_id'] = $house[0]['property_id'];
        $information = CmsProperty::model()->find("id = '{$house[0]['property_id']}' and deleted = 0");
        //品牌
        $list['estate_id'] = BaseEstate::model()->find("id = '{$information['estate_id']}' and deleted = 0")['name'];
        //系列
        $list['building_id'] = BaseBuilding::model()->find("id = '{$information['building_id']}' and deleted = 0")['name'];
        
        $list['id'] = $model['id'];
        //获取已经申请的礼品
        $goods = UrsGoodsIndex::model()->findAll("ys_goods_id = '$id' and deleted = 0");
        foreach ($goods as $k => $v) {
           $v['ys_goods_storage_id'] = UrsGoodsStorage::model()->find("id = '{$v['ys_goods_storage_id']}' and deleted = 0")['goods_name'];
        }
        $this->render('totals',array(
           'list' => $list,
           'goods' => $goods,
           'referer' => $referer,
           ));
    }
    /**
     * 支出单存储
     */
    public function actionTotalssave()
    {
        $id = Yii::app()->request->getParam('id');
        $totals_user = ($_SESSION['admin_uid']);//填写支出单的人
        $totals = Yii::app()->request->getParam('_totals');//支出款
        $totals_way = Yii::app()->request->getParam('way');//支出方式
        $totals_banks = Yii::app()->request->getParam('_banks');//收款人开户行
        $totals_name = Yii::app()->request->getParam('_name');//收款人名字
        $totals_number = Yii::app()->request->getParam('_number');//收款人账号
        $model = UrsGoods::model()->find("id = '$id' and deleted = 0 ");
        if($model){
            $model->totals = $totals;
            $model->totals_way = $totals_way;
            $model->totals_user = $totals_user;
            $model->totals_time = time();
            if($totals_way==1){
                 $model->totals_banks = $totals_banks;
                 $model->totals_name = $totals_name;
                 $model->totals_number = $totals_number;
            }
            if($totals_way==2 || $totals_way==3){
                 $model->totals_name = $totals_name;
                 $model->totals_number = $totals_number;
            }
            $model->status = 6;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$models->errors,null);
                }
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",'index');
        }else{
            $this->redirect('index');
        }
    }
    /**
     * 礼品维护
     */
    public function actionGoodsIndex()
    {
        $keyword_goods =Yii::app()->request->getParam("keyword_goods");
        $keyword_admin_uname =Yii::app()->request->getParam("keyword_admin_uname");
        $keyword_admin_unames =AdminUser::model()->find("nickname = '$keyword_admin_uname' and deleted = 0")['id'];
        $keyword_signing_date1 =Yii::app()->request->getParam("keyword_signing_date1");
        $keyword_signing_date2 =Yii::app()->request->getParam("keyword_signing_date2");
        $pagesize=10;
        $condition = "1=1 and t.deleted=0";
        //礼品
        if(!empty($keyword_goods)){
            $condition .= " and goods_name like '%".$keyword_goods."%'";
        }
        //申请人
        if(!empty($keyword_admin_unames)){
            $condition .= " and create_user_id like '%".$keyword_admin_unames."%'";
        }
        //开始时间
        if($keyword_signing_date1){
            $keyword_signing_start = strtotime($keyword_signing_date1);
            $condition .= " and ctime >= '$keyword_signing_start' ";
        }
        //结束时间
        if($keyword_signing_date2){
            $keyword_signing_end = strtotime($keyword_signing_date2);
            $condition .= " and ctime <= '$keyword_signing_end' ";
        }
       
        $criteria=new CDbCriteria;
        $criteria->condition = $condition;
        $criteria->order='t.ctime DESC';
        $count = UrsGoodsStorage::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        $list =UrsGoodsStorage::model()->findAll($criteria);
        foreach ($list as $k => $v) {
            $v['create_user_id'] = AdminUser::model()->find("id = '{$v['create_user_id']}' and deleted = 0")['nickname'];
        }
        $this->render('goodsindex',array(
            'list' => $list,
            'keyword_goods' => $keyword_goods,
            'keyword_admin_uname' => $keyword_admin_uname,
            'keyword_signing_date1' => $keyword_signing_date1,
            'keyword_signing_date2' => $keyword_signing_date2,
            'pages' => $pager,
            ));
    }
    /**
     * 礼品维护 添加
     */
    public function actionDoGoodsAdd()
    {   
        $goods_name = Yii::app()->request->getParam("goods_name");
        $goods_unit = Yii::app()->request->getParam("goods_unit");
        $goods_price = Yii::app()->request->getParam("goods_price");
        $model =UrsGoodsStorage::model()->find(" t.goods_name='$goods_name' and deleted=0");
        if ($model){
            $this->OutputJson(0,"礼品已存在",null);
        }
        $model = new UrsGoodsStorage;
        $model->id = Guid::create_guid();
        $model->goods_name = $goods_name;
        $model->goods_unit = $goods_unit;
        $model->goods_price = $goods_price;
        $model->ctime = time();
        $model->create_user_id = $_SESSION['admin_uid'];
        $model->deleted = 0;
        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){
                $this->OutputJson(0,$model->errors,null);
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",'goodsindex');
        }else{
            $this->redirect('goodsindex');
        }
    }
    /**
     * 礼品数量添加
     * @return [type] [description]
     */
    public function actionSaveStorge()
    {
        $id = Yii::app()->request->getParam("id");
        $goods_storge = Yii::app()->request->getParam("goods_storge");
        $goods = UrsGoodsStorage::model()->find("id= '$id'");
        $goods->goods_storge = $goods_storge;
        if(!$goods->save()){
            $this->OutputJson(301,"",'goodsindex');
        }

    }
    /**
     * 礼品记录
     */
    public function actionRecord(){
        $id = Yii::app()->request->getParam("id");
        $condition = "ys_goods_storage_id='$id' and deleted=0";
        $criteria=new CDbCriteria;
        $criteria->condition= $condition;
        $criteria->order='t.ctime DESC';
        $count = UrsGoodsIndex::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=15;
        $pager->applyLimit($criteria);
        $model =UrsGoodsIndex::model()->findAll($criteria);
        $list=[];
        foreach ($model as $k => $v) {
            $k =UrsGoods::model()->find("id='{$v['ys_goods_id']}' and deleted=0 and status='aa' ");
            if(!empty($k)){
                $list[]=$k;
            }
        }
        $this->render('record',array(
            'list'=>$list,
            'pages'=>$pager,
            ));
    }
//***********************************************



    public function actionAjaxitem()
    {
        $id =Yii::app()->request->getParam("id");
        $criteria=new CDbCriteria;
        $item =AdminUser::model()->find("id='$id'");

        $_data["id"]=$item->id;
        $_data["title"]=$item->nickname;
        $data=$_data;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }
    /**
     * 获取渠道公司和人员
     */
    public function actionAjaxChannel()
    {
        //获取编号
        $room_number = Yii::app()->request->getParam("room_number");
        //查看
        $model = Property::SaleContract($room_number);
        //查询公司渠道人员公司和人员
        if(!empty($model)){
            $_data["channel_id"]=CmsChannel::model()->find("id = '{$model->channel_id}'")['name'];
            $_data["channel_manager_id"]=CmsChannelManager::model()->find("id = '{$model->channel_manager_id}'")['name'];
            $data=$_data;
            header('Content-Type:application/json;charset=utf-8');
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }
}
