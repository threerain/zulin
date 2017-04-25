<?php

class BondController extends Controller
{
    public $layout="//layouts/phonelogin.php";

    public function actionIndex(){
        $openid=Yii::app()->request->getParam("openid");
        $headimgurl=Yii::app()->request->getParam("headimgurl");
        $nickname=Yii::app()->request->getParam("nickname");
        $state=Yii::app()->request->getParam("state");
        $headimgurl =urlencode($headimgurl);

        //判断是否已经提交了审批
        $valid =  Validation::model()->find("openid = '$openid'")['status'];
        if($valid!=null){
          if($valid==0) {
              $this->redirect('save');
          }else if($valid==1){
              $this->redirect('/wechat/'.$state.'/index?openid='.$openid);
          }else if($valid==2) {
              echo  '<script>arlert("您的审核没有通过")</script>';
          }
        }else {
            $this->render('index',array(
                'openid'=>$openid,
                'headimgurl'=>$headimgurl,
                'nickname'=>$nickname,
                ));

          }
    }

    public function actionValid(){
    	//先验证密码是否正确
        $username=Yii::app()->request->getParam("username");
        $password = Yii::app()->request->getParam("password");
        $openid = Yii::app()->request->getParam("openid");
        $nickname = Yii::app()->request->getParam("nickname");
        $headimgurl = Yii::app()->request->getParam("headimgurl");
        $model = AdminUser::model()->find("account=:uname and deleted=0",
                array(
                    ':uname'    => $username,
                )
            );

         if($model){
            if(md5($password)==$model->password){
                $msg["code"]   = 200;
                $msg["msg"]    = "登录成功";
                $msg["href"]    = "/wechat/bond/save?username=$username&openid=$openid&nickname=$nickname&headimgurl=$headimgurl";

            }
            else{
                $msg["code"]   = 2;
                $msg["msg"]    = "用户名或密码错误";
            }
        }
        else
        {
            $msg["code"]   = 3;
            $msg["msg"]    = "用户名不存在";
        }

        echo json_encode($msg);
    }
    public function actionSave(){
    	//将申请的人存入一个验证表待审批
    	//
    	$username=Yii::app()->request->getParam("username");
        $openid=Yii::app()->request->getParam("openid");
        $nickname=Yii::app()->request->getParam("nickname");
    	$headimgurl=Yii::app()->request->getParam("headimgurl");
      $valid = Validation::model()->find("account='$username'");
      if($valid) {
            echo '<script>alert("您已经提交申请，请耐心等待管理员的审批")</script>';
            $this->redirect("/wechat/bond/save?username=$username&openid=$openid&nickname=$nickname&headimgurl=$headimgurl");
      }else {
          $valid = new Validation();
          $valid ->account = $username;
          $valid ->openid = $openid;
          $valid ->nickname = $nickname;
          $valid ->headimgurl = $headimgurl;
          $valid ->status = 0;
        if($valid->save()){
          $this->render('save');
        }else{
          echo '<script>alert("提交失败，原因未知，请联系管理员")</script>';
        }
      }

    }

}
