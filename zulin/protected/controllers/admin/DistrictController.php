<?php

class DistrictController extends BackgroundBaseController
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

        $criteria=new CDbCriteria;
        if($keyword){
            $criteria->addCondition("name like ('%".$keyword."%') ");
        }



        // if ($keyword){
        //     $criteria->condition="1=1 and t.deleted=0 and (t.account like ('%".$keyword."%') or t.nickname like ('%".$keyword."%'))";
        // }
        // else
        // {
        //     $criteria->condition="1=1 and t.deleted=0";
        // }
        $criteria->addCondition("t.deleted=0");
        $criteria->order='t.ctime DESC';
        $count = BaseDistrict::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =BaseDistrict::model()->findAll($criteria);

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

        $city_id =Yii::app()->request->getParam("city_id");
        $name =Yii::app()->request->getParam("name");
        // $house_no =Yii::app()->request->getParam("house_no");
        // $creater_id =Yii::app()->request->getParam("creater_id");

        $model =BaseDistrict::model()->find(" t.name='$name' && city_id='$city_id' && deleted=0");
        if ($model){
            $this->OutputJson(0,"行政区已存在",null);
        }

        $model =new BaseDistrict();
        $model->id=Guid::create_guid();
        $model->city_id=$city_id;
        $model->name=$name;
        $model->ctime=time();
        $model->creater_id=Yii::app()->session['admin_uid'];
        $model->deleted=0;


        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/district");
        }
        else{
            $controller->redirect($referer);
        }

        $this->redirect($referer);
    }

    public function actionEdit()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =BaseDistrict::model()->find(" t.id='$id'");

        $this->render("edit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");
        $city_id =Yii::app()->request->getParam("city_id");
        $name =Yii::app()->request->getParam("name");

        $data =BaseDistrict::model()->find(" t.name='$name' && city_id='$city_id' && deleted=0 && t.id<>'$id'");
        if ($data){
            $this->OutputJson(0,"行政区已存在",null);
        }

        $model =BaseDistrict::model()->find(" t.id='$id'");
        if ($model){
           

            $model->city_id=$city_id;
            $model->name=$name;
            // $model->house_no=$house_no;
            // $model->creater_id=$creater_id;


            // if ($password){
            //     $model->password=md5($password);
            // }
            // $model->nickname=$nickname;
            // if ($avatar){
            //     $model->avatar=$avatar;
            // }

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

    public function actionDelete()
    {
        $referer= $_SERVER['HTTP_REFERER'];
        $id =Yii::app()->request->getParam("id");

        $model =BaseDistrict::model()->find(" t.id='$id'");
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
