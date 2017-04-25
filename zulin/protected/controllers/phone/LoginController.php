<?php

class LoginController extends Controller
{
    public function actionIndex(){
        
        $msg = array(
                     "code"=>0,
                     "msg"=>"登录失败",
                    );


        $username=Yii::app()->request->getParam("userName");
        $password = Yii::app()->request->getParam("userPwd");


        $log_password="";
        $log_status=0;

        $model = AdminUser::model()->find("account=:uname and deleted=0",
                array(
                    ':uname'    => $username,
                )
            );

        if($model){
            if(md5($password)==$model->password){

                Yii::app()->session['admin_uid']      = $model->id;
                Yii::app()->session['admin_uname']    = $model->account;

                $user_log = new UserLog();

                $user_log->id  = Guid::create_guid();

                $user_log->user_id = $model->id;

                $user_log->log_time = time();

                $user_log->log_ip = $_SERVER['REMOTE_ADDR'];

                $user_log->save();

                $msg["code"]   = 200;
                $msg["msg"]    = "登录成功";
                $msg["data"]="/phone/getowner";
            }
            else{
                $msg["code"]   = 2;
                $msg["msg"]    = "用户名或密码错误";
                $msg["data"]=2;
            }
            
        }
        else
        {
            $msg["code"]   = 3;
            $msg["msg"]    = "用户名不存在";
            $msg["data"]=2;
        }
       
        echo json_encode($msg);
    }
    
    public function actionLogout(){
        unset(Yii::app()->session['admin_uid']);
        unset(Yii::app()->session['admin_uname']);
        unset(Yii::app()->session['admin_perms']);
        unset(Yii::app()->session['admin_truename']);
        unset(Yii::app()->session['admin_avatar']);

        $this->redirect('/phone/index');
    }
}
