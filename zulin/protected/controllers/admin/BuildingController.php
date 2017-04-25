<?php

class BuildingController extends BackgroundBaseController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    // public $layout='//layouts/backgroundcenter2';

    public $title='管理员管理';

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $keyword =Yii::app()->request->getParam("keyword");

        $pagesize=10;

        $estates=BaseEstate::model()->findAll("name like '%".$keyword."%' and deleted=0");

        $estates_id="";
        foreach ($estates as $key => $value) {
            if ($key==0){
                $estates_id.="'$value->id'";
            }
            else{
                $estates_id.=",'$value->id'";
            }

        }

        $criteria=new CDbCriteria;


        if ($keyword){
            if ($estates_id){
                $criteria->condition="1=1 and deleted=0 and (t.estate_id in ($estates_id) or t.name like ('%".$keyword."%'))";
            }
            else{
                $criteria->condition="1=1 and deleted=0 and ( t.name like ('%".$keyword."%'))";
            }

        }
        else
        {
            $criteria->condition="1=1 and deleted=0 ";
        }

        $criteria->order="t.ctime desc";
        $count = BaseBuilding::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =BaseBuilding::model()->findAll($criteria);

        $this->render("index",array(
            'list'=>$list,
            'pages'=>$pager,
            'keyword'=>$keyword,
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
        $referer= $_SERVER['HTTP_REFERER'];

        $estate_id =Yii::app()->request->getParam("estate_id");
        $name =Yii::app()->request->getParam("name");
        $room_type =Yii::app()->request->getParam("room_type");
        $type =Yii::app()->request->getParam("type");
        $room_number_rule =Yii::app()->request->getParam("room_number_rule");
        if (in_array("",$room_number_rule)){
            $this->OutputJson(0,"车辆规则不能为空",null);
        }
        $room_number_rule = implode("或",$room_number_rule);
        $model =BaseBuilding::model()->find(" t.estate_id='$estate_id' and name='$name' and deleted=0");
        if ($model){
            $this->OutputJson(0,"车辆类型已存在已存在",null);
        }

        $model =new BaseBuilding();
        $model->id=Guid::create_guid();
        $model->estate_id=$estate_id;
        $model->name=$name;
        $model->room_type=$room_type;
        $model->type=$type;
        $model->room_number_rule=$room_number_rule;
        // $model->deleted=0;
        $model->ctime=time();
        if (!$model->save()){
            // var_dump($model->errors);
            // die();
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/building");
        }
        else{
            $this->redirect($referer);
        }

        $this->redirect($referer);
    }

    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =BaseBuilding::model()->find(" t.id='$id'");
        $this->render("edit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");

        $name =Yii::app()->request->getParam("name");
        $estate_id =Yii::app()->request->getParam("estate_id");
        $room_type =Yii::app()->request->getParam("room_type");
        $type =Yii::app()->request->getParam("type");
        $room_number_rule =Yii::app()->request->getParam("room_number_rule");
        if (in_array("",$room_number_rule)){
            $this->OutputJson(0,"编号规则不能为空",null);
        }
        $room_number_rule = implode("或",$room_number_rule);
        $data =BaseBuilding::model()->find(" t.estate_id='$estate_id' and name='$name' and id<>'$id' and deleted=0");
        if ($data){
            $this->OutputJson(0,"该品牌中的系列名已存在",null);
        }

        $model =BaseBuilding::model()->find(" t.id='$id'");
        if ($model){
            $model->estate_id=$estate_id;
            $model->name=$name;
            $model->room_type=$room_type;
            $model->type=$type;
            $model->room_number_rule=$room_number_rule;
            if (!$model->save()){
                if(Yii::app()->request->isAjaxRequest){
                    $this->OutputJson(0,$model->errors,null);
                }
            }
        }
        CmsProperty::model()->updateAll(array('room_type'=>"$room_type"),'building_id=:pid',array(':pid'=>$id));
        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,"",$referer);
        }
        else{
            $this->redirect($referer);
        }
    }

    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =BaseBuilding::model()->find(" t.id='$id'");
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
        $count = BaseBuilding::model()->count($criteria);



        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =BaseBuilding::model()->findAll($criteria);
        //$data["total"]=10;

        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->name;
            $_data["room_type"]=$user->room_type;
            $_data["type"]=$user->type;
            $_data["room_number_rule"]=$user->room_number_rule;
            $data["movies"][]=$_data;
        }
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }

    public function actionAjaxlistByEstateID()
    {
        $data=null;
        $criteria=new CDbCriteria;
        $keyword =Yii::app()->request->getParam("q");
        $estate_id =Yii::app()->request->getParam("estate_id");
        if ($keyword){
            $criteria->condition="1=1 and t.estate_id='$estate_id' and t.deleted=0 and t.name like '%$keyword%'";
        }

        // else
        // {
        //     $criteria->condition="1=1 and t.deleted=0";
        // }

        //$criteria->order='t.ctime DESC';
        $count = BaseBuilding::model()->count($criteria);



        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =BaseBuilding::model()->findAll($criteria);
        //$data["total"]=10;
        $data=[];
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->name;
            $_data["room_type"]=$user->room_type;
            $_data["type"]=$user->type;
            $data["movies"][]=$_data;
        }
        //$data["more"]=false;
        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);

        die();
    }

}
