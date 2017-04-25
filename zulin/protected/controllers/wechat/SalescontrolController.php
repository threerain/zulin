<?php
//销售销控手机微信端

class SalescontrolController extends WxauthController
{
    //去除YII自带模板
    public $layout="//layouts/phonelogin.php";

    public function actionIndex() {
      $name = Yii::app()->request->getParam("name");
      $keyword_estates = Yii::app()->request->getParam("keyword_estate");
      $order = Yii::app()->request->getParam('order');
      $openid = Yii::app()->request->getParam('openid');
      $condition = ' 1=1 and deleted=0';
      //品牌
      $proarr1 = [];
      if($keyword_estates){
            //找出相应的全部品牌
          $estates=BaseEstate::model()->findAll("name like '%".$keyword_estates."%' and deleted=0");
          if($estates){
              $estates_id="";
              foreach ($estates as $key => $value) {
                  if ($key==0){
                      $estates_id.="'".$value->id."'";
                  }
                  else{
                      $estates_id.=","."'".$value->id."'";
                  }
              }

              //根据品牌查出对应的车源
              $property=CmsProperty::model()->findAll("estate_id in ($estates_id)");
              foreach ($property as $key => $value) {
                      $proarr1[] = $value->id;
              }
          }else {
            $condition .= " and 1=0";
          }

          if($proarr1) {
            $property_id="";
            foreach ($proarr1 as $key => $value) {
                if ($key==0){
                    $property_id.="'".$value."'";
                }
                else{
                    $property_id.=","."'".$value."'";
                }
            }
            $condition .= " and property_id in ($property_id)";
          }

      }

      $criteria = new CDbCriteria;
      if($order) {
        //这里是查询商圈的地方
        if($order=='1' || $order=='2' || $order=='3' || $order=='4' || $order=='5' ) {
            if($order==1) {
                $area = BaseArea::model()->find("name='大望路慈云寺'")['id'];
            }else
            if($order==2) {
                $area = BaseArea::model()->find("name='三里屯三元桥'")['id'];
            }else
            if($order==3) {
                $area = BaseArea::model()->find("name='朝阳门东直门'")['id'];
            }else
            if($order==4) {
                $area = BaseArea::model()->find("name='CBD南崇文门'")['id'];
            }else
            if($order==5) {
                $area = BaseArea::model()->find("name='CBD核心建国门'")['id'];
            }
            $property = CmsProperty::model()->findAll("area_id='$area'");
            if($property) {
              $property_id1 = '';
                  foreach($property as $k=>$v) {
                        if($k==0) {
                              $property_id1 = "'".$v->id."'";
                        }else {
                              $property_id1 .= ","."'".$v->id."'";
                        }
                  }

                  $condition .= " and property_id in ($property_id1)";
            }
        }

        //查询商圈结束

              //查询产品类型开始
              if($order=='6' || $order=='7' || $order=='8' || $order=='9' || $order=='10' ) {
                  if($order==6) {
                      $property = CmsProperty::model()->findAll("room_type='1'");
                  }else
                  if($order==7) {
                      $property = CmsProperty::model()->findAll("room_type='2'");
                  }else
                  if($order==8) {
                      $property = CmsProperty::model()->findAll("room_type='3'");
                  }else
                  if($order==9) {
                      $property = CmsProperty::model()->findAll("room_type='4'");
                  }else
                  if($order==10) {
                      $property = CmsProperty::model()->findAll("room_type='5'");
                  }
                  if($property) {
                    $property_id1 = '';
                        foreach($property as $k=>$v) {
                              if($k==0) {
                                    $property_id1 = "'".$v->id."'";
                              }else {
                                    $property_id1 .= ","."'".$v->id."'";
                              }
                        }

                        $condition .= " and property_id in ($property_id1)";
                  }
              }
              //产品类型查看结束

              //价格区间查询
              if($order=='11') {
                    $condition .= ' and unit_price >=300 and unit_price <= 400';
              }
              if($order=='12') {
                    $condition .= ' and unit_price >=400 and unit_price <= 500';
              }
              if($order=='13') {
                      $condition .= ' and unit_price >= 500 and unit_price <= 600';
              }
              if($order=='14') {
                        $condition .= ' and unit_price >= 600 and unit_price <= 800';
              }
              if($order=='15') {
                    $condition .= ' and unit_price >= 800 and unit_price <= 1000';
              }
              if($order=='16') {
                    $condition .= ' and unit_price >1000';
              }
              //价格区间查询结束


              //面积区间查询
              if($order=='area1') {
                  $condition .= ' and area <100';
              }else if($order=='area2') {
                  $condition .= ' and area >=100 and area <= 150';
              }else if($order=='area3') {
                  $condition .= ' and area >150 and area <=200';
              }else if($order=='area4') {
                  $condition .= ' and area >200 and area<=300';
              }else if($order=='area5') {
                  $condition .= ' and area >300 and area<=500';
              }else if($order=='area6') {
                  $condition .= ' and area >500 and area<=1000';
              }else if($order=='area7') {
                  $condition .= ' and area>1000';
                }
            }
            //面积查询结束
  		$criteria->condition = $condition;
  		$criteria->order = 't.ctime desc';
      $model = UrsSalesControl::model()->findAll($criteria);
      $this->render("index",array(
            'openid' => $openid,
            "model" => $model,
            'estate' => $keyword_estates,
      ));
    }
    //详情
    public function actionDetails() {

      //车源id
      $id =Yii::app()->request->getParam("id");
      $contract_id = Yii::app()->request->getParam("contract_id");
      $openid = Yii::app()->request->getParam('openid');


      //查询装修ID
      $de = QualityDecoration::model()->find("contract_id= '$contract_id'")->id;

      //查询装修照片
      $photo = QualityDecorationPhoto::model()->findAll("decoration_id='$de' order by ctime");

      $list_photo=[];
      $budget_photo=[];
      $settlement_photo=[];
      $attachment_photo=[];
      $attachment=[];
      if($photo){
          foreach ($photo as $key => $value) {
              if($value->photo_type==1){//CAD图
                  $list_photo[]=$value->url;
              }
              if($value->photo_type==2){//预算扫描件
                  $budget_photo[]=$value->url;
              }
              if($value->photo_type==3){//结算扫描件
                  $settlement_photo[]=$value->url;
              }
              if($value->photo_type==4){//附件
                  $attachment_photo[]=$value->url;
                  $attachment[]=$value->attachment;
              }
          }
        }
      //车源图片
      $propertyphoto = CmsPropertyPhoto::model()->findAll("property_id='$id' order by show_order");
      $v1=[];
      foreach($propertyphoto as $val){
          $v1[$val->type_photo][]=$val;
      }
      $ursproperty = UrsPropertyDetail::model()->find("property_id='$id'");
      //幼狮车源图片
      $v=[];
      if($ursproperty){
          //幼狮车源信息表有这条数据时
          $ursproperty_id=$ursproperty->id;
          $ursphoto=UrsPhoto::model()->findAll("property_id='$ursproperty_id' order by show_order");
          foreach($ursphoto as $value){
             $v[$value->type_photo][]=$value;
          }
      }

      //查询车源管理表信息
      $property=CmsProperty::model()->find("id='$id'");
      $arrproperty=CmsProperty::model()->arr();
      $arr=UrsPropertyDetail::model()->arr();
      $appid = 'wxf4935d9379bedc41';
      $appsecret = '1ef2c61b17d15261b88c6dce88940518';
      $js = new JSSDK($appid,$appsecret);
      $signPackage =  $js->getSignPackage();
      $this->render("detail",array(
          'signPackage' => $signPackage,
          'openid' => $openid,
          'property_id'=>$id,
          'contract_id' => $contract_id,
          'property_photo'=>$v1,
          'photo'=>$v,
          'ursproperty'=>$ursproperty,
          'property'=>$property,
          'referer'=>$referer,
          'arr'=>$arr,
          'arrproperty'=>$arrproperty,
          'list_photo'=>$list_photo,
          'budget_photo'=>$budget_photo,
          'settlement_photo'=>$settlement_photo,
          'attachment_photo'=>$attachment_photo,
          'attachment'=>$attachment,
      ));
    }
    //跳转 卖相评价页面
    public function actionEvaluate() {
      $id = Yii::app()->request->getParam('id');
      $openid = Yii::app()->request->getParam('openid');
      $referer = $_SERVER['HTTP_REFERER'];
      $this->render('evaluate',array(
            'openid' => $openid,
            'id' => $id,
            'referer' => $referer,
      ));
    }
    //跳转 图片上传页面
    public function actionUploadimage() {
      $id = Yii::app()->request->getParam('id');//这个是合同
      $openid = Yii::app()->request->getParam('openid');
      $referer = $_SERVER['HTTP_REFERER'];

      $appid = 'wxf4935d9379bedc41';
      $appsecret = '1ef2c61b17d15261b88c6dce88940518';
      $js = new JSSDK($appid,$appsecret);
      $signPackage =  $js->getSignPackage();

      $this->render('uploadimage',array(
            'openid' => $openid,
            'contract_id' => $id,
            'referer' => $referer,
            'signPackage'=>$signPackage,
      ));
    }

    public function actionUploadmedia(){

      $appid = 'wxf4935d9379bedc41';
      $appsecret = '1ef2c61b17d15261b88c6dce88940518';
      $wx = new JSSDK($appid,$appsecret);
      $accessToken = $wx->getAccessToken();
      $serverId = $_POST['serverId'];
      $contract_id = $_POST['contract_id'];

      $save_path = "data/wechat/".date('ym').'/';

      if (!file_exists($save_path)) {
        mkdir($save_path,0755,true);
      }
      // 要存在你服务器哪个位置？
      $targetName = $save_path.date('YmdHis').'-'.rand(0,9999).'.jpg';

      if(file_exists($targetName)){
        $targetName = $save_path.date('YmdHis').'-'.rand(0,9999).'.jpg';
      }

      $model = UrsSalesControl::model()->find("contract_id = '$contract_id' and deleted=0");
      $model->url .= '/'.$targetName.',';

      if(!$model->save()){
        echo '1';
      }else{
        echo '2';
      }

      $ch = curl_init("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$accessToken}&media_id={$serverId}");
      $fp = fopen($targetName, 'wb');
      curl_setopt($ch, CURLOPT_FILE, $fp);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_exec($ch);
      curl_close($ch);
      fclose($fp);

    }

    public function actionEditImage()
    { 
      $id = Yii::app()->request->getParam('id');
      $model = UrsSalesControl::model()->find("contract_id = '$id' and deleted=0");
      $referer = $_SERVER['HTTP_REFERER'];

      $image = $model->url;
      $arr = explode(',',$image);
      unset($arr[count($arr)-1]);
      $this->render('editimage',array(
        'imageurl'=>$arr,
        'contract_id' => $id,
        'referer' => $referer,

        ));
    }
    public function actionEditImageSave()
    {
      $id = Yii::app()->request->getParam('contract_id');
      $url = Yii::app()->request->getParam('url');
      $model = UrsSalesControl::model()->find("contract_id = '$id' and deleted=0");
      $model->url = $url;
      if(!$model->save()) {
          $this->OutputJson(0,$model->errors,null);
      }else{
          echo '1';
      }

    }

    //处理卖相评价
    public function actionSaveeval() {
      $id = Yii::app()->request->getParam('id');
      $eval = Yii::app()->request->getParam('eval');
      $referer = Yii::app()->request->getParam('referer');
      $openid = Yii::app()->request->getParam('openid');
      $model =  new UrsSalesEval();
      if($model!=null) {
            $model->eval = $eval;
            $model->id =  Guid::create_guid();
            $model->contract_id = $id;
            $model->openid = $openid;
            if(!$model->save()) {
                      $this->OutputJson(0,$model->errors,null);
            }
            $this->redirect($referer);
      }
    }
}
