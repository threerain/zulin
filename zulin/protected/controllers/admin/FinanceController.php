<?php

class FinanceController extends BackgroundBaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

    public $title='财务管理';

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
      $keyword_id=Yii::app()->request->getParam("keyword_id");
      $keyword_estates=Yii::app()->request->getParam("keyword_estates");
      $keyword_building=Yii::app()->request->getParam("keyword_building");
      $keyword_room_number=Yii::app()->request->getParam("keyword_room_number");
      $pagesize=10;
      // var_dump(Yii::app()->request->getParam());die();
      /*
          根据车源查出车源的ID对应上合同
       */
      //如果车源三个参数齐全查出固定的合同
      $proarr1=[];
      $proarr2=[];
      $proarr3=[];
      //papers_ok
      //品牌
      $condition = '1=1 and deleted=0 ';
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

      if(!empty($keyword_estates) && !empty($keyword_building) && !empty($keyword_room_number)){
          $res_arr = array_intersect($proarr1,$proarr2,$proarr3);
      }else if(!empty($keyword_estates) && !empty($keyword_building)){
          $res_arr = array_intersect($proarr1,$proarr2);
      }else if(!empty($keyword_building) && !empty($keyword_room_number)){
          $res_arr = array_intersect($proarr2,$proarr3);
      }else if(!empty($keyword_estates) && !empty($keyword_room_number)){
          $res_arr = array_intersect($proarr1,$proarr3);
      }else{
          $res_arr=array_merge($proarr1,$proarr2,$proarr3);
      }
      $data=[];
      foreach($res_arr as $value ){
          $data[]=$value;
      }
      //var_dump($res1);
      //exit;
      //$res1=CmsPurchaseProperty::model()->findAll("property_id in (".$data.")");
      //var_dump($res1);
      //exit;
      $property_id='';
      foreach ($data as $key => $value) {
          if ($key==0){
              $property_id.="'".$value."'";
          }
          else{
              $property_id.=","."'".$value."'";
          }
      }
      //var_dump($property_id);
      //die();
      if(!empty($keyword_estates) || !empty($keyword_building) || !empty($keyword_room_number)) {
              if($property_id==null) {
                    $condition .= ' and 1=0 ';
              }
      }
      $contract_id="";
      if($property_id){
          $contract_id="";
          $res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.") and type=0");
          foreach($res as $key=>$value){
              //$contract_id[]=$value;
              if ($key==0){
                  $contract_id.="'".$value->contract_id."'";
              }
              else{
                  $contract_id.=","."'".$value->contract_id."'";
              }
          }

      }

      if($contract_id!=null) {
            $condition .= " and contract_id in ({$contract_id})";
      }

        $criteria=new CDbCriteria;
        $criteria->condition = $condition;
        $criteria->order='t.ctime DESC';
        $count = FinReceivables::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =FinReceivables::model()->findAll($criteria);
        if(!empty($news_type) && !empty($news_content_id) && !empty($news_id)){
            $modelnewss = UserNews::model()->find("id='$news_id' and user_news_id='{$_SESSION['admin_uid']}'");
            $modelnewss->status = 1;
            $modelnewss->save();
            if(empty($list)){
                $alert_error = 10;
                $this->redirect("/admin/usernews?alert_error=".$alert_error.'&news_type='.$news_type);
            }
        }
        $this->render("index",array(
            'keyword_id' => $keyword_id,
            'keyword_estates'=> $keyword_estates,
            'keyword_building' => $keyword_building,
            'keyword_room_number' => $keyword_room_number,
            'list'=>$list,
            'pages'=>$pager,
            'payment_name'=>$payment_name,
            'type'=>$type,
            'news_content_id'=>$news_content_id,
        ));
    }
    /**
     * 添加
     */
    public function actionAdd()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $this->render("add",array(
            'referer'=>$referer,
        ));
    }
    /**
     * 添加数据
     */
    public function actionAddSave()
    {

        $referer= $_SERVER['HTTP_REFERER'];
        $house_nu = Yii::app()->request->getParam('room_number'); //车源ID
        $payee_money = Yii::app()->request->getParam('payee_money'); //付款金额
        $cycle_start = strtotime(Yii::app()->request->getParam('cycle_start'));//付款开始时间
        $cycle_end = strtotime(Yii::app()->request->getParam('cycle_end'));  //付款结束时间

        //利用车源ID查询出合同ID
        if($house_nu) {
              $list = CmsPurchaseProperty::model()->find("property_id='$house_nu'");
        }
        $model =new FinReceivables();
        $model->id=Guid::create_guid();
        $model->admin_id=$_SESSION['admin_uid'];
        $model->payee_money=$payee_money*100;
        $model->cycle_start=$cycle_start;
        $model->cycle_end=$cycle_end;
        $model->contract_id=$list->contract_id;
        $model->ctime=time();
        $model->deleted=0;



        if (!$model->save()){
            $this->redirect($referer);
        }
         $this->OutputJson(301,'',"/admin/finance");
    }
    /**
     * 删除数据
     */
    public function actionDelete()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//获取id
        $model = FinReceivables::model()->find("contract_id='$id'");//删除
        $model->deleted = 1;
        if(!$model->save()) {
          $this->OutputJson(301,'',"/admin/finance");
      
        }
        $this->redirect($referer);

        CmsNews::userDel($id,9);//删除
    }
    /**
     * 财务确认数据
     */
    public function actionFinConfirm()
    {
        $referer = $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");//获取id
        $fin_confirm_id = $_SESSION['admin_uid'];//财务确认人id
        $fin_confirm_time = time();//财务确认人id
        FinReceivables::model()->updateAll(array('type'=>'3','fin_confirm_id'=>$fin_confirm_id,'fin_confirm_time'=>$fin_confirm_time),'id=:pid',array(':pid'=>$id));//确认
        $this->redirect($referer);
    }
    /**
     * 详情
     */
    public function actionDetail()
    {
        $id =Yii::app()->request->getParam("id");
        $model = FinReceivables::model()->find("id='$id' and deleted = 0");
        if(empty($model)){
           $this->redirect('index');
        }
        $data = [];
        if(!empty($model['contract_id'])){
            $house = CmsPurchaseProperty::model()->findAll("contract_id ='{$model['contract_id']}' and deleted = 0");
            if(!empty($house)){
                foreach ($house as $k => $v) {
                    $data[$k]['property_id'] = $v['property_id'];//车源id
                    $property = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0");//车源信息
                    $data[$k]['estate_id'] = BaseEstate::model()->find("id = '{$property['estate_id']}' and deleted = 0")['name'];//品牌
                    $data[$k]['building_id'] = BaseBuilding::model()->find("id = '{$property['building_id']}' and deleted = 0")['name'];//系列
                    $data[$k]['house_no'] = CmsProperty::model()->find("id = '{$v['property_id']}' and deleted = 0")['house_no'];//编号
                }
            }
        }
        //获取图片
        $list = FinPayPhoto::model()->findAll("fin_id='$id' and deleted = 0 ");
        $list_photo =[];
        if($list){
            foreach ($list as $key => $value) {
                $list_photo[]=$value->url;
            }
        }
        $this->render('detail',array(
            'model'=> $model,
            'list_photo'=> $list_photo,
            'data'=> $data,
        ));
    }

    /**
     * 现在未知干嘛
     */
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
 * 以下为实际付款信息
 */
    /**
     * 实际付款信息的列表
     * @return [type] [description]
     */
    public function actionPaymentList()
    {
        $referer=$_SERVER['HTTP_REFERER'];
        $estate =Yii::app()->request->getParam("estate");
        $building =Yii::app()->request->getParam("building");
        $room_number =Yii::app()->request->getParam("room_number");
        $id =Yii::app()->request->getParam("id");
        $status =Yii::app()->request->getParam("status",'1');

        if(!$status){
            $status =1;
        }

        //如果车源三个参数齐全查出固定的合同
        $proarr1=[];
        $proarr2=[];
        $proarr3=[];
        //品牌
        if($estate){
            $estates=BaseEstate::model()->findAll("name like '%".$estate."%' and deleted=0");
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
            $buildings=BaseBuilding::model()->findAll("name like '%".$building."%'  and deleted=0");
            if($buildings){
                $building_id="";
                foreach ($buildings as $key => $value) {
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


        if(!empty($estate) && !empty($building) && !empty($room_number)){
            $res_arr = array_intersect($proarr1,$proarr2,$proarr3);
        }else if(!empty($estate) && !empty($building)){
            $res_arr = array_intersect($proarr1,$proarr2);
        }else if(!empty($building) && !empty($room_number)){
            $res_arr = array_intersect($proarr2,$proarr3);
        }else if(!empty($estate) && !empty($room_number)){
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
            $res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.") and deleted=0");
            foreach($res as $key=>$value){

                if ($key==0){
                    $contract_id.="'".$value->contract_id."'";
                }
                else{
                    $contract_id.=","."'".$value->contract_id."'";
                }
            }

        }

        $search =$estate.$building.$room_number;
        //如果搜索条件为空，则显示全部
        if($search==''){
            $condition="1=1 and t.deleted=0 and contract_id != '0' and status = $status";
        //如果搜索房间信息并且为空，
        }elseif($estate.$building.$room_number!=''){
            if($contract_id==''){
                $condition = '1=0';
            }else{
                $condition="1=1 and t.deleted=0 and contract_id != '0' and status = $status ";
            }
        //如果不搜索房间信息
        }else{
            $condition="1=1 and t.deleted=0 and contract_id != '0' and status = $status";
        }


        if($contract_id){
            $condition.= " and  contract_id in ($contract_id) and status = $status";
        }

        $criteria=new CDbCriteria;
        $criteria->addCondition($condition);
        $criteria->order="t.status desc";
        $list = CmsPurchasePayment::model()->findAll($criteria);

        $status2 = [1=>'未付款',2=>'付部分',3=>'付清'];

        $this->render("paymentlist",array(
            'list'=>$list,
            'estate'=>$estate,
            'building'=>$building,
            'room_number'=>$room_number,
            'status2'=>$status2,
        ));

    }

    /**
     * [付款确认，可多次付款]
     * @return [type] [description]
     */

    /*
    付款进行拆分，留下余额和下次付款日期
     */
    public function actionPayConfirm(){
        //接收应收ID
        $id =Yii::app()->request->getParam("id");
        $contract_id =Yii::app()->request->getParam("contract_id");
        $model = CmsPurchasePayment::model()->find(" id ='$id'");
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
            $payment_date =Yii::app()->request->getParam("payment_date");
            $start_time =Yii::app()->request->getParam("start_time");
            $end_time =Yii::app()->request->getParam("end_time");
            $amount =Yii::app()->request->getParam("amount")*100;
            $id =Yii::app()->request->getParam("id");//应收id
            $oldmodel = CmsPurchasePayment::model()->find(" id ='$id'");
            $transaction = Yii::app()->db->beginTransaction(); //开启事务

            $child = CmsPurchasePayment::model()->findAll("parent_id = '$id'");

            $should_amount = 0;
            //算出已经付款的额度
            if($child){
                foreach ($child as $key => $value) {
                    $should_amount += $value->amount;
                }
            }
            //如果已经付过款的额度和要付的额度相加大于应该付的钱，那就返回错误
            if(($should_amount+$amount)>$oldmodel->amount){
                $this->OutputJson(0,json_encode('总额大于应付总额',JSON_UNESCAPED_UNICODE),null);
            }else{
                $model = new CmsPurchasePayment();
                $model->id = Guid::create_guid();
                $model->parent_id = $id;
                $model->payment_date = strtotime($payment_date);
                $model->contract_id = 0;
                $model->start_time = strtotime($start_time);
                $model->end_time = strtotime($end_time);
                $model->amount = $amount;
                $model->ctime = time();
                $model->deleted=0 ;
                $model->type = $oldmodel->type;
                $model->status = 1;
                $model->creater_id = $_SESSION['admin_uid'];
                if(!$model->save()){
                    $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
                }
            }

            //2.
            if(($should_amount+$amount)==$oldmodel->amount){
                $oldmodel->status = 3;//付清
                //付清之后，将付款计划的提交单子重置状态
                $cpp = CmsPurchasePayable::model()->find("id = '$oldmodel->payable_id'");
                $cpp ->dump = 3;
                if(!$cpp->save()){
                    $this->OutputJson(0,json_encode($cpp->errors.'付款计划更改失败',JSON_UNESCAPED_UNICODE),null);
                }

            }else{
                $oldmodel->status = 2;//付部分
            }
            if(!$oldmodel->save()){
                $this->OutputJson(0,json_encode($oldmodel->errors.'付款状态更改失败',JSON_UNESCAPED_UNICODE),null);
            }

            $transaction->commit(); //提交事务会真正的执行数据库操作
        }catch (Exception $e){
            $this->OutputJson(0,json_encode($e.'事务出错',JSON_UNESCAPED_UNICODE),null);
            $transaction->rollback(); //如果操作失败, 数据回滚
        }

        $this->OutputJson(301,'',"/admin/finance/paymentlist/id/".$contract_id);

    }
    /**
     * [每一个提款单子的付款情况]
     * @return [type] [description]
     */
    public function actionPayConfirmList()
    {
        $id =Yii::app()->request->getParam("id");
        $list = CmsPurchasePayment::model()->findAll(" parent_id ='$id'");
        $this->render('payconfirmlist',array(
            'list'=>$list,
            ));

    }
}
