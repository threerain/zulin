<?php

class ChangepwdController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/backgroundcenter2';
    public $PAGE_LEVEL_STYLES = null ;
    public $PAGE_LEVEL_PLUGINS=null;
    public $PAGE_LEVEL_SCRIPTS=null;

	public $title='管理员管理';

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{  

        $uid = Yii::app()->session['admin_uid'];
        $username = Yii::app()->session['admin_uname'];
        $model = AdminUser::model()->findbypk($uid);

        $this->render("edit",array(
            'model'=>$model,
        ));

	}

    public function actionSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");
        $department_id =Yii::app()->request->getParam("department_id");
        if($department_id[count($department_id)-1]==''){
            $department_id = $department_id[count($department_id)-2];
        }else{
            $department_id = $department_id[count($department_id)-1];
        }

        $model =AdminUser::model()->find(" t.id='$id'");
        if ($model){

            // if ($model->type==0){
            //     $this->OutputJson(0,"系统管理员，不能修改",null);
            // }

        if($_POST['password']==$_POST['r_password']){
            unset($_POST['r_password']);
        }else{
            $this->OutputJson(0,"密码不一致",null);
        }    
        foreach ($_POST as $key => $value) {

            if($key!='referer'){
                if($key=='password'){
                    if($value!=''){
                        $model->$key=md5($_POST['password']); 
                    }
                }elseif($key=='birthday'){
                    if($value!=''){
                        $model->$key = strtotime($_POST['birthday']);
                    }else{
                        $model->$key=null;
                    }
                }elseif($key=='department_id')
                {
                    $model->$key = $department_id;
                }else{
                    $model->$key = $value;
                }                
            }
        }
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

        $model =AdminUser::model()->find(" t.id='$id'");
        if ($model->type==0){
            $this->OutputJson(0,"系统管理员，不能删除",null);
        }
        $model->deleted=1;
        if (!$model->save()){
            $this->OutputJson(0,$model->errors,null);
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
            $criteria->condition="1=1 and t.deleted=0 and t.nickname like '%$keyword%'";
        }
        // else
        // {
        //     $criteria->condition="1=1 and t.deleted=0";
        // }

        //$criteria->order='t.ctime DESC';
        $count = AdminUser::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=10;//$pagesize;
        $pager->applyLimit($criteria);

        $list =AdminUser::model()->findAll($criteria);
        //$data["total"]=10;

        
        foreach ($list as $key => $user) {
            $_data["id"]=$user->id;
            $_data["title"]=$user->nickname;
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
        $item =AdminUser::model()->find("id='$id'");

        $_data["id"]=$item->id;
        $_data["title"]=$item->nickname;
        $data=$_data;

        header('Content-Type:application/json;charset=utf-8');
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        
        die();
    }
}
