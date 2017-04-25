<?php

class BackgroundBaseController extends Controller
{
	public $layout='//layouts/background_right';
	public $islogin=false;
	/**
	 * Declares class-based actions.
	 */
	public function init()
	{
		$admin_uid = Yii::app()->session['admin_uid'];
		$login_time = AdminUser::model()->find("id = '$admin_uid'")['login_time'];
		if(isset(Yii::app()->session['admin_uid']) && Yii::app()->session['login_time'] == $login_time){
			//判断是否是ajax请求
			if (Yii::app()->request->isAjaxRequest) {
            	$this->islogin=true;
            	return;
        	}
	        	// if($_SERVER['HTTP_REFERER']==''){
	        	// 	echo 'you do not have permission to access the requested data or object!';
	        	// 	exit;
	        	// }
        }else{
        	$this->redirect('/admin/index');
        }
		return;
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function OutputJson($code,$message,$data){
		$result["code"]=$code;
		$result["responsetime"]=date("Y-m-d H:i:s",time());
		$result["msg"]=$message;
		$result["data"]=$data;

		header('Content-Type:application/json;charset=utf-8');
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
		die();
	}
}