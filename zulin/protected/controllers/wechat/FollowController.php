<?php


class FollowController extends Controller
{
    //去除YII自带模板
    public $layout="//layouts/phonelogin.php";

    public function actionIndex() {
        $openid = Yii::app()->request->getParam("openid");
        //渲染到主页面

        $model = WechatFollow::model()->findAll("openid= '$openid' ");
        $this->render("index",array(
              "openid" => $openid,
              "model"  => $model
         ));
    }

    /*
        上传文件函数
        pargam1 $filename 上传文件的信息
        pargam2 $path     存储文件路径
        pargam3 $typelist 文件格式,有默认值
        2017/2/10
    */
  function uploadFile($filename,$path,$typelist=null){
      //1. 获取上传文件的名字
      $upfile = $filename;
      if(empty($typelist)){
      $typelist=array("image/gif","image/jpg","image/jpeg","image/png");//允许的文件类型
      }
      //$path="upload3"; //指定上传文件的保存路径（相对的）
      $res=array("error"=>false);//存放返回的结果

      //2.过滤上传文件件的错误号
      if($upfile["error"]>0){
      switch($upfile["error"]){
      case 1:
      $res["info"]="上传的文件超过了 php.ini 中 upload_max_filesize 选项限制";
      break;
      case 2:
      $res["info"]="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项";
      break;
      case 3:
      $res["info"]="文件只有部分被上传";
      break;
      case 4:
      $res["info"]="没有文件被上传";
      break;
      case 6:
      $res["info"]="找不到临时文件夹。";
      break;
      case 7:
      $res["info"]="文件写入失败";
      break;
      default:
      $res["info"]="未知错误！";
      break;
      }
      return $res;
      }

      //3.本次文件大小的限制
      if($upfile["size"]>2000000){
      $res["info"]="上传文件过大！";
      return $res;
      }

      //4. 过滤类型
      if(!in_array($upfile["type"],$typelist)){
      $res["info"]="上传类型不符！".$upfile["type"];
      return $res;
      }

      //5. 初始化下信息(为图片产生一个随机的名字)
      $fileinfo = pathinfo($upfile["name"]);
      do{
      $newfile = date("YmdHis").rand(1000,9999).".".$fileinfo["extension"];//随机产生一个的文件名
      }while(file_exists($newfile));

      //6. 执行上传处理
      if(is_uploaded_file($upfile["tmp_name"])){
      if(move_uploaded_file($upfile["tmp_name"],$path."/".$newfile)){
      //将上传成功后的文件名赋给返回数组
      $res["info"]=$newfile;
      $res["error"]=true;
      return $res;
      }else{
      $res["info"]="上传文件失败！";
      }
      }else{
      $res["info"]="不是一个上传的文件！";
      }
      return $res;
      }


    // 添加跟进方法
    public function actionAdd() {
          // wechat_follow 表中存储数据
        $district = Yii::app()->request->getParam('district'); //选择区域
        $group = Yii::app()->request->getParam('group'); //选择组团
        $project_channel = Yii::app()->request->getParam("project_channel"); //每日标识负责项目渠道
        $group_channel = Yii::app()->request->getParam("group_channel"); //每日标识负责组团渠道
        $estate_channel = Yii::app()->request->getParam("estate_channel"); //每日标识区域渠道
        $big_channel    = Yii::app()->request->getParam("big_channel"); //每日标识大区目渠道
        $other_channel = Yii::app()->request->getParam("other_channel"); //每日标识其它渠道
        $wechat_channel_num = Yii::app()->request->getParam("wechat_channel_num"); //微信通讯录渠道总数
        $new_channel_num = Yii::app()->request->getParam("new_channel_num");  //每日新增渠道总数
        $phone_num = Yii::app()->request->getParam("phone_num"); //每日电话咨询量
        $look_one_num = Yii::app()->request->getParam("look_one_num"); //今日首次带看量汇总
        $look_two_num = Yii::app()->request->getParam("look_one_num");  //今日复看带看汇总
        $meet_area_num = Yii::app()->request->getParam("meet_area_num"); //今日约见面积汇总
        $client = Yii::app()->request->getParam("client"); //今日意向客户
        $sign_area = Yii::app()->request->getParam("sign_area"); //签约面积
        $sign_muit = Yii::app()->request->getParam("sign_muit"); //签约套数
        $meet_muit_num = Yii::app()->request->getParam("meet_muit_num"); //今日约见套数汇总
        $remark = Yii::app()->request->getParam("remark"); //备注
        $openid = Yii::app()->request->getParam("openid");  //微信用户openid

        $url = $_FILES['url'] ;
        $path = "data/wechat/follow/".date('ym').'/';

        if (!file_exists($path)) {
                mkdir($path,0755,true);
        }
        //调用上传文件函数
        $avatar =  $this->uploadFile($url,$path);
       
        //client_follow 表中存储数据
        $property_id = Yii::app()->request->getParam("property_id");//品牌
        $area = CmsPurchaseProperty::model()->find(array(
            'condition'=>"property_id = '$property_id'",
            'select'=>'house_area',
            ))->area; //面积
        $company = Yii::app()->request->getParam("company"); //经纪公司
        $linkman = Yii::app()->request->getParam("linkman"); //签约人
        $phone = Yii::app()->request->getParam("phone"); //电话
        $format = Yii::app()->request->getParam("format"); //客户业态
        $budget = Yii::app()->request->getParam("budget"); //预算
        $two_see = Yii::app()->request->getParam("two_see"); //是否二看
        $house_no = Yii::app()->request->getParam("house_no"); //意向客户项目编号
        $prineinal = Yii::app()->request->getParam("prineinal"); //是否负责人
        $order_time  = Yii::app()->request->getParam("order_time"); //预定时间
        $follow_info = Yii::app()->request->getParam("follow_info"); //跟进情况
        $urs_people = Yii::app()->request->getParam("urs_people"); //幼狮对接人

        $transaction = Yii::app()->db->BeginTransaction(); //开启事务
        try {
            //将数据存入到wechat_follow表中
              $model = new WechatFollow();
              $a =  Guid::create_guid();
              $model->id = $a;
              $model->url = $path.'/'.$avatar['info'];
              $model->openid = $openid;
              $model->district = $district;
              $model->group = $group;
              $model->project_channel = $project_channel;
              $model->group_channel = $group_channel;
              $model->estate_channel = $estate_channel;
              $model->big_channel = $big_channel;
              $model->other_channel = $other_channel;
              $model->new_channel_num = $new_channel_num;
              $model->wechat_channel_num = $wechat_channel_num;
              $model->phone_num = $phone_num;
              $model->look_one_num = $look_one_num;
              $model->look_two_num = $look_two_num;
              $model->meet_area_num = $meet_area_num;
              $model->meet_muit_num = $meet_muit_num;
              $model->client = $client;
              $model->sign_area = $sign_area;
              $model->sign_muit = $sign_muit;
              $model->ctime = date('Y-m-d H:i:s',time());
              $model->remark = $remark;

              if(!$model->save()){
                  var_dump($model->errors);die();
                }
                //将追加数据添加到client_follow表中，单条添加

              foreach($property_id as $k=>$v) {
                if($v!=null) {
                  $list = new ClientFollow();
                  $list->id = Guid::create_guid();
                  $list->follow_id = $a;
                  $list->openid = $openid;
                  $list->ctime = date('Y-m-d H:i:s',time());
                  $list->property_id = $v;
                  $list->area = $area[$k];
                  $list->company = $company[$k];
                  $list->linkman = $linkman[$k];
                  $list->phone = $phone[$k];
                  $list->budget = $budget[$k];
                  $list->house_no = $house_no[$k];
                  $list->two_see = $two_see[$k];
                  $list->prineinal = $prineinal[$k];
                  $list->order_time = $order_time[$k];
                  $list->follow_info = $follow_info[$k];
                  $list->format = $format[$k];
                  $list->urs_people = $urs_people[$k];
                  if(!$list->save()) {
                      var_dump($list->errors);die();
                  }
                }
              }
              $transaction->commit(); //提交事务
        } catch(Exception $e) {
          var_dump($e);
              $transaction->rollback(); //如果操作失败, 数据回滚
              exit;
        }
        $this->redirect("/wechat/follow/success/openid/".$openid);
    }
    //上传图片的方法
    public function actionPhoto() {

    }
    // 成功页面
    public function actionSuccess() {

      $openid = Yii::app()->request->getParam("openid");
      // var_dump($openid);
      $this->render("success",array(
          'openid' => $openid,

      ));
    }
    //我的跟进
    public function actionMyFollow() {
        $openid = Yii::app()->request->getParam("openid");

        $model = ClientFollow::model()->findAll("openid='$openid' order by ctime desc ");

        $this->render('myfollow',array(
            'openid' => $openid,
            'model' => $model,
        ));

    }
      //详情查看
    public function actionDetail() {

      $id = Yii::app()->request->getParam('id'); //接收client_follow 表的ID

      $model = ClientFollow::model()->find("id='$id'");
      $list = WechatFollow::model()->find("openid='$model->openid'");
      $this->render('detail',array(
            'model' => $model,
            'list'  => $list,
      ));

    }
}
