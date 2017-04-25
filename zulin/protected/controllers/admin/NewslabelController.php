<?php

class NewslabelController extends BackgroundBaseController
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
        if ($keyword){
            $criteria->condition="1=1 and (t.estate_id like ('%".$keyword."%') or t.creater_id like ('%".$keyword."%') or t.buding_id like ('%".$keyword."%') or t.house_no like ('%".$keyword."%'))";
        }
        else
        {
            $criteria->condition="1=1";
        }

        $criteria->order='t.ctime DESC';
        $count = cms_property_new::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =cms_property_new::model()->findAll($criteria);

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

        $this->render("newslabelAdd",array(
            'referer'=>$referer,
        ));
    }

    public function actionAddSave()
    {
        $referer= $_SERVER['HTTP_REFERER'];

        $estate_id =Yii::app()->request->getParam("estate_id");
        $buding_id =Yii::app()->request->getParam("buding_id");
        $house_no =Yii::app()->request->getParam("house_no");

        // $model =cms_property_new::model()->find(" t.account='$account'");
        // if ($model){
        //     $this->OutputJson(0,"账号已存在",null);
        // }

        $model =new cms_property_new();
        $model->id=Guid::create_guid();
        $model->estate_id=$estate_id;
        $model->buding_id=$buding_id;
        $model->house_no=$house_no;
        $model->creater_id=Yii::app()->session['admin_uid'];
        // $model->last_login_time=time();
        // $model->deleted=0;
        $model->ctime=time();


        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/newslabel");
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

        $model =cms_property_new::model()->find(" t.id='$id'");

        $this->render("newslabelEdit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");
        $estate_id =Yii::app()->request->getParam("estate_id");
        $buding_id =Yii::app()->request->getParam("buding_id");
        $house_no =Yii::app()->request->getParam("house_no");


        $model =cms_property_new::model()->find(" t.id='$id'");
        if ($model){
           
            $model->estate_id=$estate_id;
            $model->buding_id=$buding_id;
            $model->house_no=$house_no;
            
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

        $model =cms_property_new::model()->find(" t.id='$id'");

        if (!$model->delete()){
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
