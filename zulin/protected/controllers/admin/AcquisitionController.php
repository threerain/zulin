<?php

class AcquisitionController extends BackgroundBaseController{

 	public $contract_id = 0;
    public function actionIndex(){
        $search =Yii::app()->request->getParam("search");
		    $keyword_id=Yii::app()->request->getParam("keyword_id");
        $keyword_estates=Yii::app()->request->getParam("keyword_estates");
        $keyword_building=Yii::app()->request->getParam("keyword_building");
        $keyword_room_number=Yii::app()->request->getParam("keyword_room_number");
        $keyword_acq_type=Yii::app()->request->getParam("keyword_acq_type");
		    $keyword_signing_date1=Yii::app()->request->getParam("keyword_signing_date1");
		    $keyword_signing_date2=Yii::app()->request->getParam("keyword_signing_date2");
		    $keyword_acq_broker=Yii::app()->request->getParam("keyword_acq_broker");
        $keyword_center_time=Yii::app()->request->getParam("keyword_center_time");
        $keyword_center_time1=Yii::app()->request->getParam("keyword_center_time1");
        $pagesize=10;
        /*
            根据车源查出车源的ID对应上合同
         */
        //如果车源三个参数齐全查出固定的合同
        $proarr1=[];
        $proarr2=[];
        $proarr3=[];
        //papers_ok
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
        $contract_id="";
        if($property_id){
            $contract_id="";
            $res=CmsPurchaseProperty::model()->findAll("property_id in (".$property_id.")");
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




        // $search = $keyword_id.$keyword_estates.$keyword_building.$keyword_room_number.$keyword_acq_type.$keyword_signing_date1.$keyword_signing_date2;
       // 如果搜索条件为空，则显示全部

      if($keyword_estates.$keyword_building.$keyword_room_number !=''){
            if($contract_id==''){
                $condition = '1=0';
            }else{
                $condition="1=1 and t.deleted=0 and type=0 ";
            }
        }else{
          $condition = '1=1 and t.deleted=0 and type=0';
        }
        $condition.=" and  ( 1=1  ";
        $type = CmsAcquisitionCommission::model()->findAll("acq_type ='$keyword_acq_type' ");
          if($keyword_acq_type == 1){

                    $type = CmsAcquisitionCommission::model()->findAll('acq_type in (2,3,4,5)');
                    $type_id=[];
                    foreach ($type as $key => $value) {
                        if($value->contract_id!=null){
                            $type_id[]=$value->contract_id;
                        }
                    }
                    $type_id=implode("','",$type_id);
                    $type_id="'$type_id'";
                    $condition.=" and id not in (".$type_id.") ";
          }
          //查询渠道人员
              if($keyword_acq_broker) {
                $broker = CmsChannelManager::model()->findAll("name like '%".$keyword_acq_broker."%'");
                if(empty($broker)) {
                        $condition .= ' and 1=0';
                }
              }
              if($broker) {
                $outroom_id = [];
                foreach ($broker as $key => $value) {
                      $room = CmsAcquisitionCommission::model()->findAll("acq_broker like '%".$value->id."%'");
                      foreach ($room as $k=>$v ) {
                          $outroom_id[] = $v->contract_id;
                      }
                }
              if($outroom_id==null) {
                    $condition .= " and 1=0 ";
              }
            }

          if($outroom_id!=null) {
              $outroom_id1 = '';
              foreach($outroom_id as $k => $v) {
                  if($k==0) {
                      $outroom_id1 .= "'".$v."'";
                  }else {
                      $outroom_id1 .= ','."'".$v."'";
                  }
              }

              $condition .= " and id in ($outroom_id1)";
          }
          if($keyword_acq_type==2){
              $type=CmsAcquisitionCommission::model()->findAll('acq_type =2');
              $type_id=[];
              foreach ($type as $key => $value) {
                  if($value->contract_id!=null){
                      $type_id[]=$value->contract_id;
                  }else{
                      $condition.=" and 1=0 ";
                  }
              }
              $type_id=implode("','",$type_id);
              $type_id="'$type_id'";
              $condition.=" and id in (".$type_id.") ";
          }
          if($keyword_acq_type==3){
              $type=CmsAcquisitionCommission::model()->findAll('acq_type =3');
              $type_id=[];
              foreach ($type as $key => $value) {
                  if($value->contract_id!=null){
                      $type_id[]=$value->contract_id;
                  }else{
                      $condition.=" and 1=0 ";
                  }
              }
              $type_id=implode("','",$type_id);
              $type_id="'$type_id'";
              $condition.=" and id in (".$type_id.") ";
          }
          if($keyword_acq_type==4){
                $type=CmsAcquisitionCommission::model()->findAll('acq_type =4');
                $type_id=[];
                foreach ($type as $key => $value) {
                    if($value->contract_id!=null){
                        $type_id[]=$value->contract_id;
                    }else{
                        $condition.=" and 1=0 ";
                    }
                }
                $type_id=implode("','",$type_id);
                $type_id="'$type_id'";
                $condition.=" and id in (".$type_id.") ";
            }
            if($keyword_acq_type==5){
                  $type=CmsAcquisitionCommission::model()->findAll('acq_type =5');
                  $type_id=[];
                  foreach ($type as $key => $value) {
                      if($value->contract_id!=null){
                          $type_id[]=$value->contract_id;
                      }else{
                        $condition.="and 1=0";
                      }
                  }
                  $type_id=implode("','",$type_id);
                  $type_id="'$type_id'";
                  $condition.=" and id in (".$type_id.") ";
              }


		//合同ID搜索
      if ($keyword_id){
          $condition.= " and id like ('%".$keyword_id."%') ";
      }


  		//品牌,系列,编号搜索
  		if($contract_id){
              $condition.= " and  id in ($contract_id) ";
          }

		//签约日期
		$keyword_signing_start=strtotime($keyword_signing_date1);
		$keyword_signing_end=strtotime($keyword_signing_date2)+24*3600;
        if ($keyword_signing_date1) {
            $condition.=" and signing_date >= '$keyword_signing_start' ";
        }
        if ($keyword_signing_date2) {
            $condition.=" and signing_date <= '$keyword_signing_end' ";
        }
    // 佣金结算日

    if($keyword_center_time!=null && $keyword_center_time1!=null) {
            $start = strtotime($keyword_center_time);
            $end = strtotime($keyword_center_time1);
            $acq = CmsAcquisitionCommission::model()->findAll("center_time >= '$start' and center_time <= '$end'");
            // var_dump($acq);

          if($acq) {
              $aqc_id = '';
            foreach ($acq as $key => $value) {
                if ($key==0){
                    $acq_id.="'".$value->contract_id."'";
                }
                else{
                    $acq_id.=","."'".$value->contract_id."'";

                }

            }
            $condition.=" and id in ($acq_id) ";

          }
    }
      //  if($keyword_center_time) {
      //       $condition.=" and center_time >= '$start' ";
      //  }
      //  if($keyword_center_time1) {
      //       $condition.=" and center_time <= '$end'";
      //  }
        $condition.=")";
        $referer = $_SERVER['HTTP_REFERER'];
        $criteria=new CDbCriteria;
        // if($keyword){
        //     $criteria->addCondition("t.room_number like '%$keyword%' ");
        // }
        // $criteria->addCondition("t.deleted=0  and type=1");
        $criteria->condition=$condition;
        $criteria->order="t.atime desc";
        $count=CmsPurchaseContract::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list = CmsPurchaseContract::model()->findAll($criteria);
        // var_dump($list);
        $this->render('index',array(
			       'list'=>$list,
             'referer' => $referer,
            'pages'=>$pager,
            'keyword_id'=>$keyword_id,
            'keyword_estates'=>$keyword_estates,
            'keyword_acq_type' => $keyword_acq_type,
            'keyword_building'=>$keyword_building,
            'keyword_room_number'=>$keyword_room_number,
			      'keyword_signing_date1'=>$keyword_signing_date1,
            'keyword_signing_date2'=>$keyword_signing_date2,
            'keyword_center_time' => $keyword_center_time,
            'keyword_center_time1' => $keyword_center_time1,
            'keyword_acq_broker' => $keyword_acq_broker,
            'search' => $search

		));
    }
    //  修改佣金结算日
    public function actionEntertime() {
        $referer = $_SERVER['HTTP_REFERER'];

        $id = Yii::app()->request->getParam('id');
        $time = Yii::app()->request->getParam("enter_time");
        $enter = CmsAcquisitionCommission::model()->find("id='$id'");
        if($time!=null) {
              $time = strtotime($time);
              $enter->center_time = $time;
              if(!$enter->save()) {
                        $this->OutputJson(0,$model->errors,null);
              }
        }
        $this->redirect($referer);
    }
    	public function actionEdit(){
    		$referer= $_SERVER['HTTP_REFERER'];
    		$id = Yii::app()->request->getParam('id');
    		$estates = BaseEstate::model()->findAll(" t.id = '$id'");
    		$model = CmsPurchaseContract::model()->find("t.id='$id'");
            $list = CmsAcquisitionCommission::model()->find("contract_id = '$id'");

    		$property = Property::allinfo($id);

    		$this->render('edit',array(
                   'id' => $id,
 				   'property' => $property,
 				   'model' => $model,
                   'list' => $list,
 				   'referer'  => $referer
    			));

    	}
    public function actionEditSave(){

    	$referer = Yii::app()->request->getParam('referer');
    	$contract_id = Yii::app()->request->getParam('id');
   		$acq_monthly_rent = Yii::app()->request->getparam('acq_monthly_rent');
   		$acq_real_commission = Yii::app()->request->getParam('acq_real_commission');
   		$acq_fan = Yii::app()->request->getParam('acq_fan');
   		$acq_other = Yii::app()->request->getParam('acq_other');
   		$acq_remark = Yii::app()->request->getParam('acq_remark');
   		$acq_price = Yii::app()->request->getParam('acq_price');
   		$acq_broker = Yii::app()->request->getParam('acq_broker');
      $channel_id = Yii::app()->request->getParam('channel_id');
	    $user_id = Yii::app()->session['admin_uid'];
        $user = AdminUser::model()->find("id = '$user_id'");
        $acq_user = $user['account'];

            $model = CmsAcquisitionCommission::model()->find("contract_id = '$contract_id'");

        if(!$model){

            $model = new CmsAcquisitionCommission();
            $model->id = Guid::create_guid();
        }
        $model->acq_type = 2;
    	  $model->contract_id = $contract_id;
        $model->acq_monthly_rent = $acq_monthly_rent*100;
        $model->acq_real_commission = $acq_real_commission*100;
        $model->acq_fan = $acq_fan*100;
        $model->acq_other = $acq_other*100;
        $model->acq_remark = $acq_remark;
        $model->acq_price = $acq_price*100;
        if($acq_broker) {
              $broker_id = '';
            foreach ($acq_broker as $key => $value) {
                if ($key==0){
                    $broker_id.=$value;
                }
                else{
                    $broker_id.=",".$value;

                }
                  $model->acq_broker = $broker_id;
            }

        }
        $model->channel_id = $channel_id;
        $model->acq_user = $acq_user;

        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }
        $purchase = CmsPurchaseContract::model()->find("id='$contract_id'");
        $purchase->atime = time();

        if (!$purchase->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$purchase->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"$referer");
        }
        else{
            $this->redirect($referer);
        }

        $this->redirect($referer);
    }
    public function actionEnter(){

               $referer= $_SERVER['HTTP_REFERER'];

                $id = Yii::app()->request->getParam("id");

                $property = Property::allinfo($id);
                $model = CmsAcquisitionCommission::model()->find("contract_id = '$id'");
                $list = CmsPurchaseContract::model()->find("id = '$id'");
                $pay = CmsPurchasePayRule::model()->find("contract_id='$id'");
                $this->render('enter',array(
                        'id' => $id,
                        'property' => $property,
                        'model' => $model,
                        'pay' => $pay,
                        'list' => $list,
                        'referer' => $referer
                ));
    }
    public function actionPass(){

                $referer = Yii::app()->request->getParam('referer');

                $id =  Yii::app()->request->getParam('id');
                $reason = Yii::app()->request->getParam('reason');
                // var_dump($id);
                $model = CmsAcquisitionCommission::model()->find("contract_id = '$id'");
                $purchase = CmsPurchaseContract::model()->find("id='$id'");
                $purchase->atime = time();
                if (!$purchase->save()){
                    if(Yii::app()->request->isAjaxRequest){

                        $this->OutputJson(0,$purchase->errors,null);
                    }

                }
                $model->acq_type = 3;
                if($reason){
                    $model->acq_reason = $reason;
                    $model->acq_type = 5;
                }else {
                  $model->center_time = time();
                }

                if (!$model->save()){
                    if(Yii::app()->request->isAjaxRequest){

                        $this->OutputJson(0,$model->errors,null);
                    }

                }

                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(301,'',"/admin/acquisition");
                }
                else{
                    $this->redirect($referer);
                }

                $this->redirect($referer);
            }
     public function actionDetails(){

                $referer = $_SERVER['HTTP_REFERER'];
                $id = Yii::app()->request->getParam('id');
                $model = CmsAcquisitionCommission::model()->find("contract_id = '$id'");


                $this->render('details',array(

                        'id' => $id,
                        'referer'  => $referer,
                        'model' => $model
                    ));
     }
    public function actionEditEnter(){

               $referer = Yii::app()->request->getParam('referer');
               $id = Yii::app()->request->getParam('id');
               $acq_broker = Yii::app()->request->getParam('acq_broker');
               $acq_bank_num = Yii::app()->request->getParam('acq_bank_num');
               $acq_bank = Yii::app()->request->getParam('acq_bank');
               $acq_real_rent = Yii::app()->request->getParam('acq_real_rent');
               $channel_id = Yii::app()->request->getParam('channel_id');
               $model = CmsAcquisitionCommission::model()->find("contract_id = '$id'");

               $model->acq_broker = $acq_broker;
               $model->acq_bank = $acq_bank;
               $model->acq_bank_num = $acq_bank_num;
               $model->acq_real_rent = $acq_real_rent*100;
               $model->acq_type = 4;
               if (!$model->save()){

                    if(Yii::app()->request->isAjaxReturn){

                        $this->OutputJson(0,$model->errors,null);
                    }
               }

               if(Yii::app()->request->isAjaxRequest){
                        $this->OutputJson(301,'','/admin/acquisition');
               }else{
                       $this->redirect($referer);
               }

                       $this->redirect($referer);
    }

    public function actionSureDetails(){

        $referer= $_SERVER['HTTP_REFERER'];
            $id = Yii::app()->request->getParam('id');

            $estates = BaseEstate::model()->findAll(" t.id = '$id'");
            $list = CmsPurchaseContract::model()->find("t.id='$id'");
            $pay = CmsPurchasePayRule::model()->find("contract_id='$id'");
            $model = CmsAcquisitionCommission::model()->find("contract_id = '$id'");
            $property = Property::allinfo($id);
            $this->render('suredetails',array(
                   'id' => $id,
                   'property' => $property,
                   'model' => $model,
                   'pay' => $pay,
                   'list' => $list,
                   'referer'  => $referer
                ));
    }

}
