
<?php

/*
组团管理
*/

class EstategroupController extends BackgroundBaseController
{
    //const PAGE_SIZE = 20;
    //protected function beforeRender($view)
    //{
        //Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/ui/js/admin/faxingorder.js",CClientScript::POS_END );  
    //    return true;
    //}

    public function actionIndex(){
        $keyword=Yii::app()->request->getParam("keyword");
        $pagesize=10;

        $criteria=new CDbCriteria;
        if($keyword){
            $criteria->addCondition("t.name like '%$keyword%' ");
        }
        $criteria->addCondition("t.deleted=0");
        $criteria->order="t.ctime desc";
        $count=BaseEstateGroup::model()->count($criteria);
        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);
        
        $list = BaseEstateGroup::model()->findAll($criteria);

        $this->render('index',array(
			'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
		));
    }  

    public function actionCreate(){  
        $referer=$_SERVER['HTTP_REFERER'];
        $this->render("create",array(
            'referer'=>$referer,
        ));
    }

    public function actionCreateSave(){  
        $referer=$_SERVER['HTTP_REFERER'];

        $area_id =Yii::app()->request->getParam("area_id");

        $name =Yii::app()->request->getParam("name");

        $model =BaseEstateGroup::model()->find("t.name='$name' && deleted=0");
        if($model){
            $this->OutputJson(0,"组团已存在",null);
        }

        $model =new BaseEstateGroup();
        $model->id=Guid::create_guid();
        $model->area_id=$area_id;

        $model->name=$name;
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;
        $model->ctime=time();

        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }
        $this->OutputJson(301,'',"/admin/estategroup");
    }

    public function actionEdit(){
        $referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=BaseEstateGroup::model()->find("t.id='$id'");
        
        $this->render('edit',array(
			'model'=>$model,
            'referer'=>$referer,
		));

    }  

    public function actionEditSave(){  
        $referer =Yii::app()->request->getParam("referer");
        $id =Yii::app()->request->getParam("id");
        $area_id=Yii::app()->request->getParam("area_id");
        $name=Yii::app()->request->getParam("name");
        $data = BaseEstateGroup::model()->find("t.name='$name' && area_id='$area_id' && deleted=0 && t.id<>'$id'");
        if ($data){
            $this->OutputJson(0,"该商圈中的组团名已存在",null);
        }
        $model=BaseEstateGroup::model()->find("t.id='$id'");
        if($model){
            //$model->password=md5($password);

            $model->area_id = $area_id;

            $model->name = $name;

            if(!$model->save()){
                $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
            }
        }
		$this->OutputJson(301,'',$referer);
    } 

    public function actionDelete(){
		$referer=$_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model=BaseEstateGroup::model()->find("t.id='$id'");
        $model->deleted=1;
        if(!$model->save()){
            $this->OutputJson(0,json_encode($model->errors,JSON_UNESCAPED_UNICODE),null);
        }

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

        // else
        // {
        //     $criteria->condition="1=1 and t.deleted=0";
        // }

        //$criteria->order='t.ctime DESC';
        $count = BaseEstateGroup::model()->count($criteria);



        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =BaseEstateGroup::model()->findAll($criteria);
        //$data["total"]=10;
        
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->name;
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
        $item =BaseEstateGroup::model()->find("id='$id'");

        $_data["id"]=$item->id;
        $_data["title"]=$item->nickname;
        $data=$_data;

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }
}