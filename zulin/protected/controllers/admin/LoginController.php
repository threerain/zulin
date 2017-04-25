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
            $model->login_time = time();
            $model->save();

            if(md5($password)==$model->password){

// $msg["code"]   = 2;
//                 $msg["msg"]    = "登录成功";
//                 $msg["data"]=md5($password).$model->password;
// echo json_encode($msg);
// return;
                //登录成功，找到用户的权限
                // $perms = "";
                // if($model->position){
                //     $Positions = SysPosition::model()->findAll("id in (:p)",array(
                //         ":p"=>$model->position,
                //     ));

                //     if($Positions){
                //         foreach($Positions as $_position){
                //             $perms = $_position->perms.",".$perms;
                //         }
                //     }

                // }
                
                Yii::app()->session['admin_uid']      = $model->id;
                Yii::app()->session['admin_uname']    = $model->account;
                Yii::app()->session['login_time']    = $model->login_time;

                $user_log = new UserLog();

                $user_log->id  = Guid::create_guid();

                $user_log->user_id = $model->id;

                $user_log->log_time = time();

                $user_log->log_ip = $_SERVER['REMOTE_ADDR'];

                $user_log->save();

                // $model->last_login_time=time();
                // $model->save();

                //Yii::app()->session['admin_perms']    = $perms;
                // Yii::app()->session['admin_truename'] = $model->nick;
                // Yii::app()->session['admin_avatar']   = $model->head;
                // Yii::app()->session['admin_displayname']   = $model->nick!=""?$model->nick:$model->userName;
                //Yii::app()->session['admin_role']  = $model->role;

                $msg["code"]   = 200;
                $msg["msg"]    = "登录成功";
                $msg["data"]="/admin/home";
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


        // $model_log = new LogLogin();
        // $model_log->username = $username;
        // $model_log->password = $log_password;
        // $model_log->status   = $log_status;
        // $model_log->ip       = ip2long(Yii::app()->request->userHostAddress);
        // $model_log->ctime    = time();
        // $model_log->ext_data = "web";
        // $model_log->save();

         
        echo json_encode($msg);
    }
    
    public function actionLogout(){
        unset(Yii::app()->session['admin_uid']);
        unset(Yii::app()->session['admin_uname']);
        unset(Yii::app()->session['admin_perms']);
        unset(Yii::app()->session['admin_truename']);
        unset(Yii::app()->session['admin_avatar']);

        $this->redirect('/admin/index');
    }
}
