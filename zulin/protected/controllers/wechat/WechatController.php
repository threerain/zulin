<?php

class WechatController extends Controller
{
    Public $token = 'lizhaohui';
    Public $appid = 'wxf4935d9379bedc41';
    Public $appsecret = '1ef2c61b17d15261b88c6dce88940518';
     //微信服务接入时，服务器需授权验证
    public function actionValid()
    {
        $echoStr = $_GET["echostr"];
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        //valid signature , option
        if($this->checkSignature($signature,$timestamp,$nonce)){
            echo $echoStr;
        }
    }


    //参数校验
    private function checkSignature($signature,$timestamp,$nonce)
    {
        $token = $this->token;
        if (!$token) {
            echo 'TOKEN is not defined!';
        }else{
            $tmpArr = array($token, $timestamp, $nonce);
            // use SORT_STRING rule
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode( $tmpArr );
            $tmpStr = sha1( $tmpStr );

            if( $tmpStr == $signature ){
                return true;
            }else{
                return false;
            }
        }
    }

    public function actionAccesstoken()
    {
        $code = $_GET["code"];
        $state = $_GET["state"];
        $appid = $this->appid;
        $appsecret = $this->appsecret;
        $request_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';

        //初始化一个curl会话
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//close certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        $result = $this->response($result);

        //获取token和openid成功，数据解析
        $access_token = $result['access_token'];
        $refresh_token = $result['refresh_token'];
        $openid = $result['openid'];
        //请求微信接口，获取用户信息
        $userInfo = $this->getUserInfo($access_token,$openid);
        $user_check = WechatUser::model()->find("openid = '$openid'");
        $headimgurl = $userInfo['headimgurl'];
        $nickname = $userInfo['nickname'];

        if($userInfo){
            if ($user_check) {
                //更新用户资料
                $user_check ->openid = $openid;
                $user_check ->nickname = $userInfo['nickname'];
                $user_check ->sex = $userInfo['sex'];
                $user_check ->city = $userInfo['city'];
                $user_check ->province = $userInfo['province'];
                $user_check ->country = $userInfo['country'];
                $user_check ->headimgurl = $userInfo['headimgurl'];
                $user_check ->access_token = $access_token;
                $user_check ->refresh_token = $refresh_token;
                $user_check->save();
            } else {
                //保存用户资料
                $user = new WechatUser();
                $user ->openid = $openid;
                $user ->nickname = $userInfo['nickname'];
                $user ->sex = $userInfo['sex'];
                $user ->city = $userInfo['city'];
                $user ->province = $userInfo['province'];
                $user ->country = $userInfo['country'];
                $user ->headimgurl = $userInfo['headimgurl'];
                $user ->access_token = $access_token;
                $user ->refresh_token = $refresh_token;
                if(!$user->save()){
                    var_dump($user->errors);exit;
                }

            }            
        }else{
            echo '<script>alert("发生错误，请重试")</script>';exit;

        }



        //前端网页的重定向
        if ($openid) {

            $wechatuser = WechatUser::model()->find("openid=:openid ",
                array(
                    ':openid'    => $openid,
                )
            );

            Session::save($openid);
            $_SESSION['user'] = $wechatuser->nickname;
            $_SESSION['user_id'] = $wechatuser->openid;
            if($wechatuser->status==0){
                //如果未注册，跳转到注册页面
                $this->redirect('/wechat/bond/index?openid='.$openid.'&headimgurl='.$headimgurl.'&nickname='.$nickname);
            }elseif ($wechatuser->status==1) {
                $_SESSION['loginFlag'] = 1;
                //已注册，跳转到参数带的控制器内
                $this->redirect('/wechat/'.$state.'/index?openid='.$openid);
            }
        } elseif ($wechatuser->status==2) {
            echo '<script>alert("审批未通过，请联系管理员")</script>';
        }
    }

    public function getUserInfo($access_token,$openid)
    {
        $request_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        //初始化一个curl会话
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//close certificate
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = $this->response($result);
        return $result;
    }

    public function actionUserinfo()
    {
        if(isset($_REQUEST["openid"])){
            $openid = $_REQUEST["openid"];
            $user = WechatUser::find()->where(['openid'=>$openid])->one();
            if ($user) {
                $result['error'] = 0;
                $result['msg'] = '获取成功';
                $result['user'] = $user;
            } else {
                $result['error'] = 1;
                $result['msg'] = '没有该用户';
            }
        } else {
            $result['error'] = 1;
            $result['msg'] = 'openid为空';
        }
        return $result;
    }
    private function response($text)
    {
        return json_decode($text, true);
    }

}
