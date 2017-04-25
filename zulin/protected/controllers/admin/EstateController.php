
<?php

/*
品牌管理
*/

class EstateController extends BackgroundBaseController
{
    //const PAGE_SIZE = 20;
    //protected function beforeRender($view)
    //{
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/ui/js/admin/faxingorder.js",CClientScript::POS_END );  
    //    return true;
    //}

    public function actionIndex(){
        $keyword_group=Yii::app()->request->getParam("keyword_group");
        $keyword=Yii::app()->request->getParam("keyword");
        $pagesize=10;
        $estategroup=BaseEstateGroup::model()->findAll("name like '%".$keyword_group."%' and deleted=0");

        $estategroup_id="";
        foreach ($estategroup as $key => $value) {
            if ($key==0){
                $estategroup_id.="'".$value->id."'";
            }
            else{
                $estategroup_id.=","."'".$value->id."'";
            }
            
        }
        $condition="1=1 and t.deleted=0 ";
        $condition.=" and  ( 1=1  ";
        if ($keyword_group){
            if($estategroup_id){
                $condition.=" and estate_group_id in (".$estategroup_id.") ";
            }else{
                 $condition.= " and  estate_group_id in ('') ";
            }
        }

        if($keyword){
            $condition.= " and t.name like '%$keyword%'";
        }
        $condition.=")";
        $criteria=new CDbCriteria;
        $criteria->condition=$condition;
        $criteria->order="t.ctime desc";
        $count=BaseEstate::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        
        $list = BaseEstate::model()->findAll($criteria);

        $this->render('index',array(
			'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
            'keyword_group'=>$keyword_group,
		));
    }  

    public function actionCreate(){
        $estate_photo_type = array('1' =>"品牌内部照片" ,'2' =>"品牌外部照片",'3'=>"品牌照片",'4'=>"哈哈");
        $referer=$_SERVER['HTTP_REFERER'];
        $this->render("create",array(
            'referer'=>$referer,
            'estate_photo_type'=>$estate_photo_type,
        ));
    }

    public function actionCreateSave(){  

        $referer=$_SERVER['HTTP_REFERER'];
        $estate_group_id =Yii::app()->request->getParam("estate_group_id");
        // $area_id = BaseEstateGroup::model()->find("id='$estate_group_id'")['area_id']; 
        $name =Yii::app()->request->getParam("name");
        // $type =Yii::app()->request->getParam("type");
        $long =Yii::app()->request->getParam("long",0);
        $lat =Yii::app()->request->getParam("lat",0);
        $address =Yii::app()->request->getParam("address");
        $introduce =Yii::app()->request->getParam("introduce");
        $average_price =Yii::app()->request->getParam("average_price");
        $parking_space =Yii::app()->request->getParam("parking_space");
        $building_age =Yii::app()->request->getParam("building_age");
        $property_fee =Yii::app()->request->getParam("property_fee");


       // $type_photo =Yii::app()->request->getParam("type_photo");
       //  array_pop($type_photo); 
       //  // var_dump($type_photo);
       //  // exit;
       //  $estate_photo =Yii::app()->request->getParam("estate_photo");//品牌图片
       //  array_pop($estate_photo);

        $model =BaseEstate::model()->find("t.name='$name' && estate_group_id='$estate_group_id' && deleted=0");
        if($model){
            $this->OutputJson(0,"品牌已存在",null);
        }

        $model =new BaseEstate();
        $model->id=Guid::create_guid();
        // $model->area_id=$area_id;
        $model->estate_group_id=$estate_group_id;

        $model->name=$name;
        // $model->type=$type;
        $model->long=$long;
        $model->lat=$lat;
        $model->address=$address;
        $model->introduce=$introduce;
        $model->average_price=$average_price;
        $model->parking_space=$parking_space;
        $model->building_age=$building_age;
        $model->property_fee=$property_fee;
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;
        $model->ctime=time();

        //写入品牌图片表
        // if($type_photo){
        //     $order=0;
        //     foreach($type_photo as $k=>$value){
        //         $estate_photo[$k] = explode(",",$estate_photo[$k]);
        //         array_shift($estate_photo[$k]); 
        //         foreach($estate_photo[$k] as $k1=>$v1){ 

        //             $base_estate_photo = new BaseEstatePhoto;
        //             $base_estate_photo->id = Guid::create_guid();
        //             $base_estate_photo->estate_id = $model->id; 
        //             $base_estate_photo->type = $value;           
        //             $base_estate_photo->url = $v1;
        //             $base_estate_photo->ctime = time();
        //             $base_estate_photo->show_order = $order;
                 
        //             if(!$base_estate_photo->save()){
        //                 $this->OutputJson(0,json_encode($base_estate_photo->errors,JSON_UNESCAPED_UNICODE),null);
        //             } 
        //         } 
        //         $order++;                                    
        //     }
        // }
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }

       $this->OutputJson(301,'',"/admin/estate");
    }

    public function actionEdit(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");
        $estate_photo_type = array('1' =>"品牌内部照片" ,'2' =>"品牌外部照片",'3'=>"品牌照片",'4'=>"哈哈");
        $model=BaseEstate::model()->find("t.id='$id'");
        $photo=BaseEstatePhoto::model()->findAll("estate_id='$id' order by show_order");
        $v=[];
        foreach($photo as $value){
           $v[$value->type][]=$value;
        }
        // ksort($v);
        $this->render('edit',array(
            'model'=>$model,
			'estate_photo_type'=>$estate_photo_type,
            'referer'=>$referer,
            'photo'=>$v,
		));

    }  

    public function actionEditSave(){  
        $referer =Yii::app()->request->getParam("referer");
        $id =Yii::app()->request->getParam("id");
        $estate_group_id=Yii::app()->request->getParam("estate_group_id");
        // $area_id = BaseEstateGroup::model()->find("id='$estate_group_id'")['area_id']; 
        // $type_photo =Yii::app()->request->getParam("type_photo");
        // $estate_photo =Yii::app()->request->getParam("estate_photo");//品牌图片
        $data = BaseEstate::model()->find(" t.name='$name' && estate_group_id='$estate_group_id' && deleted=0 && t.id<>'$id'");
        if ($data){
            $this->OutputJson(0,"该组团中的品牌名已存在",null);
        }

        $model=BaseEstate::model()->find("t.id='$id'");
        if($model){
            // $model->area_id =$area_id;
            $model->estate_group_id =Yii::app()->request->getParam("estate_group_id");
            $model->name =Yii::app()->request->getParam("name");
            // $model->type =Yii::app()->request->getParam("type");
            $model->long=Yii::app()->request->getParam("long",0);
            $model->lat=Yii::app()->request->getParam("lat",0);
            $model->address=Yii::app()->request->getParam("address");
            $model->introduce=Yii::app()->request->getParam("introduce");
            $model->average_price=Yii::app()->request->getParam("average_price");
            $model->parking_space=Yii::app()->request->getParam("parking_space");
            $model->building_age=Yii::app()->request->getParam("building_age");
            $model->property_fee=Yii::app()->request->getParam("property_fee");

            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }

            //写入品牌图片表
            // if($type_photo){                        
            //         $order=0;
            //     foreach($type_photo as $k=>$value){

            //         if(!empty($estate_photo[$k])){ 

            //             $old = BaseEstatePhoto::model()->findAll("estate_id='$id' and show_order='$k'");
            //             //$old = BaseEstatePhoto::model()->findAll("estate_id='$id' and type='$value'");
            //             foreach ($old as $key => $v2) {
            //                 $file=dirname(YII::app()->basePath).$v2->url;
            //                 $result = @unlink ($file); 
            //             }
            //             BaseEstatePhoto::model()->deleteAll("estate_id='$id' and show_order='$k'"); 
            //             // var_dump($estate_photo[$k]); 
            //             // exit;                  
            //             $estate_photo[$k] = explode(",",$estate_photo[$k]);
            //             array_shift($estate_photo[$k]); 

            //             foreach($estate_photo[$k] as $k1=>$v1){ 
                            
            //                 $base_estate_photo = new BaseEstatePhoto;
            //                 $base_estate_photo->id = Guid::create_guid();
            //                 $base_estate_photo->estate_id = $model->id; 
            //                 $base_estate_photo->type = $value;           
            //                 $base_estate_photo->url = $v1;
            //                 $base_estate_photo->ctime = time();
            //                 $base_estate_photo->show_order=$order;
            //                 if(!$base_estate_photo->save()){
            //                     $this->OutputJson(0,json_encode($base_estate_photo->errors,JSON_UNESCAPED_UNICODE),null);
            //                 } 
            //             }
            //         }
            //         else{
                     
            //               $old = BaseEstatePhoto::model()->findAll("estate_id='$id' and show_order='$k'");

            //               foreach ($old as $ko => $vo) {
            //                 $vo->show_order = $order;         
            //                 $vo->type   = $value;   
            //                 if(!$vo->save()){
            //                     $this->OutputJson(0,json_encode($vo->errors,JSON_UNESCAPED_UNICODE),null);
            //                 }  
            //               }
            //              //$aa = BaseEstatePhoto::model()->findAll("estate_id='$id' and show_order='$k'");
            //              // $aa->type=$value;
            //              // var_dump($aa);
            //              // exit;
            //         }
            //         $order++;
            //     }
            // }           
        }


        $this->OutputJson(301,'',$referer);
    } 


    public function actionDelete(){
		$referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=BaseEstate::model()->find("t.id='$id'");
        $model->deleted=1;
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }
        $old = BaseEstatePhoto::model()->findAll("estate_id='$id'");
        foreach ($old as $key => $v2) {
            $file=dirname(YII::app()->basePath).$v2->url;
            $result = @unlink ($file); 
        }
        BaseEstatePhoto::model()->deleteAll("estate_id='$id'"); 
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',$_SERVER['HTTP_REFERER']);
        }
        else{
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    } 

    public function actionAjaxlist()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $keyword =Yii::app()->request->getParam("q");
        if ($keyword){
            $criteria->condition="1=1 and t.deleted=0 and t.name like '%$keyword%'";
        }
        else
        {
            $criteria->condition="1=1 and t.deleted=0";
        }

        //$criteria->order='t.ctime DESC';
        $count = BaseEstate::model()->count($criteria);



        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =BaseEstate::model()->findAll($criteria);
        //$data["total"]=10;
        
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->name;
            // $_data["type"]=$user->type;
            $data["movies"][]=$_data;
        }
        
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }

    public function actionAjaxlistestate()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $keyword =Yii::app()->request->getParam("q");
        $admin_uid = Yii::app()->session['admin_uid'];
        $user = AdminUser::model()->find("id='$admin_uid'");
        $department_id = AdminDepartment::model()->find("id='$user->department_id' and deleted=0");
        $area_name = AdminDepartment::model()->find("id='$department_id->parent_id' and deleted=0");
        $area_id = BaseArea::model()->find("name='$area_name->name' and deleted=0");

        $estate_group_ids = BaseEstateGroup::model()->findAll("area_id='$area_id->id' and deleted=0");
        $estate_group_id='';
        foreach($estate_group_ids as $key=>$value){
            if ($key==0){
                $estate_group_id.="'".$value->id."'";
            }
            else{
                $estate_group_id.=","."'".$value->id."'";
            }
        }
        if($area_id){//只能搜本商圈下的品牌（部门中有商圈，又有添加车源的权限）
            $criteria->condition="1=1 and t.deleted=0 and estate_group_id in(".$estate_group_id.") and t.name like '%$keyword%'";
        }else{//（部门中无商圈，但是有添加车源的权限）
            $criteria->condition="1=1 and t.deleted=0 and t.name like '%$keyword%'";
        }

        //$criteria->order='t.ctime DESC';
        $count = BaseEstate::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =BaseEstate::model()->findAll($criteria);
        //$data["total"]=10;
        
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["estate_group_id"]=$estate_group_id;
            $_data["title"]=$user->name;
            // $_data["type"]=$user->type;
            $data["movies"][]=$_data;
        }
        
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }

    public function actionAjaxitem()
    {
        $id =Yii::app()->request->getParam("id");
        $criteria=new CDbCriteria;
        $item =BaseEstate::model()->find("id='$id'");

        $_data["id"]=$item->id;
        $_data["title"]=$item->nickname;
        $data=$_data;

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }
}