<?php

class WxauthController extends Controller
{
	public $layout = '//layouts/phonelogin';
	public $islogin=false;
	/**
	 * Declares class-based actions.
	 */
	public function init()
	{
		session_start();
		if(isset(Yii::app()->session['loginFlag'])){
            $this->islogin=true;
        }
        else
        {
        	$this->redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf4935d9379bedc41&redirect_uri=http%3a%2f%2fwww.youshispace.com%2fwechat%2fwechat%2faccesstoken&response_type=code&scope=snsapi_userinfo&state=salescontrol#wechat_redirect');
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
