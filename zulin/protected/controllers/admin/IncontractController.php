<?php
//收房合同
class IncontractController extends BackgroundBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/backgroundcenter2';

	public $title='收房合同管理';

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$keyword =Yii::app()->request->getParam("keyword");

		$pagesize=10;

        $criteria=new CDbCriteria;
        if ($keyword){
        	$criteria->condition="1=1 and t.deleted=0 and (t.account like ('%".$keyword."%') or t.nickname like ('%".$keyword."%'))";
        }
        else
        {
        	$criteria->condition="1=1 and t.deleted=0";
        }

        $criteria->order='t.ctime DESC';
        $count = AdminUser::model()->count($criteria);

        $pager=new CPagination($count);
        $pager->pageSize=$pagesize;
        $pager->applyLimit($criteria);

        $list =AdminUser::model()->findAll($criteria);

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

        $account =Yii::app()->request->getParam("account");
        $password =Yii::app()->request->getParam("password");
        $nickname =Yii::app()->request->getParam("nickname");
        $avatar =Yii::app()->request->getParam("avatar");

        $model =AdminUser::model()->find(" t.account='$account' && deleted=0");
        if ($model){
            $this->OutputJson(0,"账号已存在",null);
        }

        $model =new AdminUser();
        $model->id=Guid::create_guid();
        $model->account=$account;
        $model->password=md5($password);
        $model->nickname=$nickname;
        $model->avatar=$avatar;
        $model->create_user_id=Yii::app()->session['admin_uid'];
        $model->last_login_time=time();
        $model->deleted=0;
        $model->ctime=time();


        if (!$model->save()){
            if(Yii::app()->request->isAjaxRequest){

                $this->OutputJson(0,$model->errors,null);
            }

        }

        if(Yii::app()->request->isAjaxRequest){
            $this->OutputJson(301,'',"/admin/admin");
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

        $model =AdminUser::model()->find(" t.id='$id'");

        $this->render("edit",array(
            'model'=>$model,
            'referer'=>$referer,
        ));
    }

    public function actionEditSave()
    {
        $id =Yii::app()->request->getParam("id");
        $referer =Yii::app()->request->getParam("referer");

        $password =Yii::app()->request->getParam("password");
        $nickname =Yii::app()->request->getParam("nickname");
        $avatar =Yii::app()->request->getParam("avatar");


        $model =AdminUser::model()->find(" t.id='$id'");
        if ($model){
            if ($password){
                $model->password=md5($password);
            }
            $model->nickname=$nickname;
            if ($avatar){
                $model->avatar=$avatar;
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
